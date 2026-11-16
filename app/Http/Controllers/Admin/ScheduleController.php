<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Schedule;
use App\Models\Work;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $projectId = $request->get('project');
        $workId = $request->get('work');
        $status = $request->get('status');

        $schedules = Schedule::with([
            'project.client.user',
            'work',
        ])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($projectId, function ($query) use ($projectId) {
                $query->where('project_id', $projectId);
            })
            ->when($workId, function ($query) use ($workId) {
                $query->where('work_id', $workId);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('schedule_status', $status);
            })
            ->orderBy('start_date')
            ->paginate(10)
            ->withQueryString();

        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        $works = Work::with('project')
            ->orderBy('work_name')
            ->get();

        $totalSchedules = Schedule::count();
        $plannedSchedules = Schedule::where('schedule_status', 'planned')->count();
        $ongoingSchedules = Schedule::where('schedule_status', 'ongoing')->count();
        $completedSchedules = Schedule::where('schedule_status', 'completed')->count();

        return view('admin.schedules.index', compact(
            'schedules',
            'projects',
            'works',
            'totalSchedules',
            'plannedSchedules',
            'ongoingSchedules',
            'completedSchedules',
            'search',
            'projectId',
            'workId',
            'status'
        ));
    }

    public function create()
    {
        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        // Hanya pekerjaan yang belum memiliki jadwal.
        $works = Work::with('project')
            ->whereDoesntHave('schedules')
            ->orderBy('work_name')
            ->get();

        return view('admin.schedules.create', compact(
            'projects',
            'works'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'work_id' => [
                'required',
                'exists:works,work_id',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $work = Work::findOrFail($validated['work_id']);

        $scheduleExists = Schedule::where(
            'work_id',
            $work->work_id
        )->exists();

        if ($scheduleExists) {
            return back()
                ->withInput()
                ->withErrors([
                    'work_id' => 'Pekerjaan ini sudah memiliki jadwal.',
                ]);
        }

        Schedule::create([
            'project_id' => $work->project_id,
            'work_id' => $work->work_id,
            'title' => $work->work_name,
            'description' => $validated['description'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'schedule_status' => $work->work_status,
        ]);

        return redirect()
            ->route('admin.schedules.index')
            ->with(
                'success',
                'Jadwal pekerjaan berhasil ditambahkan.'
            );
    }

    public function show(Schedule $schedule)
    {
        $schedule->load([
            'project.client.user',
            'work',
        ]);

        return view(
            'admin.schedules.show',
            compact('schedule')
        );
    }

    public function edit(Schedule $schedule)
    {
        $schedule->load('work');

        $projects = Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        $works = Work::with('project')
            ->where(function ($query) use ($schedule) {
                $query
                    ->whereDoesntHave('schedules')
                    ->orWhere(
                        'work_id',
                        $schedule->work_id
                    );
            })
            ->orderBy('work_name')
            ->get();

        return view('admin.schedules.edit', compact(
            'schedule',
            'projects',
            'works'
        ));
    }

    public function update(
        Request $request,
        Schedule $schedule
    ) {
        $validated = $request->validate([
            'work_id' => [
                'required',
                'exists:works,work_id',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $work = Work::findOrFail($validated['work_id']);

        $scheduleExists = Schedule::where(
            'work_id',
            $work->work_id
        )
            ->where(
                'schedule_id',
                '!=',
                $schedule->schedule_id
            )
            ->exists();

        if ($scheduleExists) {
            return back()
                ->withInput()
                ->withErrors([
                    'work_id' => 'Pekerjaan ini sudah memiliki jadwal lain.',
                ]);
        }

        $schedule->update([
            'project_id' => $work->project_id,
            'work_id' => $work->work_id,
            'title' => $work->work_name,
            'description' => $validated['description'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'schedule_status' => $work->work_status,
        ]);

        return redirect()
            ->route(
                'admin.schedules.show',
                $schedule
            )
            ->with(
                'success',
                'Jadwal pekerjaan berhasil diperbarui.'
            );
    }
}
