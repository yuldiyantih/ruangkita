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
        $search =
            $request->get('search');

        $projectId =
            $request->get('project');

        $workId =
            $request->get('work');

        $status =
            $request->get('status');


        $schedules =
            Schedule::with([
                'project.client.user',
                'work',
            ])
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        'title',
                        'like',
                        '%' . $search . '%'
                    );
                }
            )
            ->when(
                $projectId,
                function ($query) use ($projectId) {

                    $query->where(
                        'project_id',
                        $projectId
                    );
                }
            )
            ->when(
                $workId,
                function ($query) use ($workId) {

                    $query->where(
                        'work_id',
                        $workId
                    );
                }
            )
            ->when(
                $status,
                function ($query) use ($status) {

                    $query->where(
                        'status',
                        $status
                    );
                }
            )
            ->orderBy('start_date')
            ->paginate(10)
            ->withQueryString();


        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy(
                'project_name'
            )
            ->get();


        $works =
            Work::with('project')
            ->orderBy('work_name')
            ->get();


        $totalSchedules =
            Schedule::count();


        $plannedSchedules =
            Schedule::where(
                'status',
                'planned'
            )->count();


        $ongoingSchedules =
            Schedule::where(
                'status',
                'ongoing'
            )->count();


        $completedSchedules =
            Schedule::where(
                'status',
                'completed'
            )->count();


        return view(
            'admin.schedules.index',
            compact(
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
            )
        );
    }



    public function create()
    {
        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy(
                'project_name'
            )
            ->get();


        $works =
            Work::with('project')
            ->orderBy('work_name')
            ->get();


        return view(
            'admin.schedules.create',
            compact(
                'projects',
                'works'
            )
        );
    }

    public function store(Request $request)
    {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'work_id' => [
                    'nullable',
                    'exists:works,id',
                ],

                'title' => [
                    'required',
                    'string',
                    'max:150',
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
                    'nullable',
                    'date',
                    'after_or_equal:start_date',
                ],

                'status' => [
                    'required',
                    'in:planned,ongoing,completed,delayed,cancelled',
                ],

            ]);


        if (!empty($validated['work_id'])) {

            $work =
                Work::findOrFail(
                    $validated['work_id']
                );


            if (
                (int) $work->project_id
                !==
                (int) $validated['project_id']
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'work_id' =>
                        'Pekerjaan yang dipilih tidak sesuai dengan proyek.',
                    ]);
            }
            $newStart =
                $validated['start_date'];


            $newEnd =
                $validated['end_date']
                ??
                $validated['start_date'];


            $conflictExists =
                Schedule::where(
                    'project_id',
                    $validated['project_id']
                )
                ->whereNotIn(
                    'status',
                    [
                        'completed',
                        'cancelled',
                    ]
                )
                ->where(function ($query) use (
                    $newStart,
                    $newEnd
                ) {

                    $query
                        ->whereDate(
                            'start_date',
                            '<=',
                            $newEnd
                        )
                        ->where(function ($q) use ($newStart) {

                            $q
                                ->whereNull('end_date')
                                ->whereDate(
                                    'start_date',
                                    '>=',
                                    $newStart
                                )
                                ->orWhereDate(
                                    'end_date',
                                    '>=',
                                    $newStart
                                );
                        });
                })
                ->exists();


            if ($conflictExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'start_date' =>
                        'Jadwal bertabrakan dengan jadwal lain pada proyek yang sama.',
                    ]);
            }
        }

        Schedule::create([

            'project_id' =>
            $validated['project_id'],

            'work_id' =>
            $validated['work_id']
                ??
                null,

            'title' =>
            $validated['title'],

            'description' =>
            $validated['description']
                ??
                null,

            'start_date' =>
            $validated['start_date'],

            'end_date' =>
            $validated['end_date']
                ??
                null,

            'status' =>
            $validated['status'],

        ]);


        return redirect()
            ->route(
                'admin.schedules.index'
            )
            ->with(
                'success',
                'Jadwal berhasil ditambahkan.'
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
        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        $works =
            Work::with('project')
            ->orderBy('work_name')
            ->get();


        return view(
            'admin.schedules.edit',
            compact(
                'schedule',
                'projects',
                'works'
            )
        );
    }

    public function update(
        Request $request,
        Schedule $schedule
    ) {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'work_id' => [
                    'nullable',
                    'exists:works,id',
                ],

                'title' => [
                    'required',
                    'string',
                    'max:150',
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
                    'nullable',
                    'date',
                    'after_or_equal:start_date',
                ],

                'status' => [
                    'required',
                    'in:planned,ongoing,completed,delayed,cancelled',
                ],

            ]);


        if (!empty($validated['work_id'])) {

            $work =
                Work::findOrFail(
                    $validated['work_id']
                );


            if (
                (int) $work->project_id
                !==
                (int) $validated['project_id']
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'work_id' =>
                        'Pekerjaan yang dipilih tidak sesuai dengan proyek.',
                    ]);
            }
        }


        /*
    |--------------------------------------------------------------------------
    | DETEKSI JADWAL BENTROK
    |--------------------------------------------------------------------------
    */

        $newStart =
            $validated['start_date'];


        $newEnd =
            $validated['end_date']
            ??
            $validated['start_date'];


        $conflictExists =
            Schedule::where(
                'project_id',
                $validated['project_id']
            )
            ->where(
                'id',
                '!=',
                $schedule->id
            )
            ->whereNotIn(
                'status',
                [
                    'completed',
                    'cancelled',
                ]
            )
            ->where(function ($query) use (
                $newStart,
                $newEnd
            ) {

                $query
                    ->whereDate(
                        'start_date',
                        '<=',
                        $newEnd
                    )
                    ->where(function ($q) use ($newStart) {

                        $q
                            ->whereNull('end_date')
                            ->whereDate(
                                'start_date',
                                '>=',
                                $newStart
                            )
                            ->orWhereDate(
                                'end_date',
                                '>=',
                                $newStart
                            );
                    });
            })
            ->exists();


        if ($conflictExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_date' =>
                    'Jadwal bertabrakan dengan jadwal lain pada proyek yang sama.',
                ]);
        }


        $schedule->update([

            'project_id' =>
            $validated['project_id'],

            'work_id' =>
            $validated['work_id']
                ??
                null,

            'title' =>
            $validated['title'],

            'description' =>
            $validated['description']
                ??
                null,

            'start_date' =>
            $validated['start_date'],

            'end_date' =>
            $validated['end_date']
                ??
                null,

            'status' =>
            $validated['status'],

        ]);


        return redirect()
            ->route(
                'admin.schedules.show',
                $schedule
            )
            ->with(
                'success',
                'Jadwal berhasil diperbarui.'
            );
    }
}
