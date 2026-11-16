<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Schedule::with([
            'project',
            'work'
        ]);

        if ($user->role !== 'admin') {
            $query->whereHas(
                'project.client',
                function ($q) use ($user) {
                    $q->where(
                        'user_id',
                        $user->user_id
                    );
                }
            );
        }

        $schedules = $query
            ->orderBy('start_date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $schedules,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan jadwal.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' =>
            'required|exists:projects,project_id',

            'work_id' =>
            'nullable|exists:works,work_id',

            'title' =>
            'required|string|max:150',

            'description' =>
            'nullable|string',

            'start_date' =>
            'required|date',

            'end_date' =>
            'nullable|date|after_or_equal:start_date',

            'status' =>
            'nullable|in:planned,ongoing,completed,delayed,cancelled',
        ]);

        $schedule = Schedule::create([
            'project_id' =>
            $validated['project_id'],

            'work_id' =>
            $validated['work_id']
                ?? null,

            'title' =>
            $validated['title'],

            'description' =>
            $validated['description']
                ?? null,

            'start_date' =>
            $validated['start_date'],

            'end_date' =>
            $validated['end_date']
                ?? null,

            'schedule_status' =>
            $validated['status']
                ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil ditambahkan.',
            'data' => $schedule,
        ], 201);
    }

    public function show(
        Request $request,
        Schedule $schedule
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin'
            &&
            $schedule
            ->project
            ?->client
            ?->user_id !== $user->user_id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke jadwal ini.',
            ], 403);
        }

        $schedule->load([
            'project',
            'work'
        ]);

        return response()->json([
            'success' => true,
            'data' => $schedule,
        ]);
    }

    public function update(
        Request $request,
        Schedule $schedule
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah jadwal.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' =>
            'sometimes|exists:projects,project_id',

            'work_id' =>
            'nullable|exists:works,work_id',

            'title' =>
            'sometimes|string|max:150',

            'description' =>
            'nullable|string',

            'start_date' =>
            'sometimes|date',

            'end_date' =>
            'nullable|date|after_or_equal:start_date',

            'status' =>
            'sometimes|in:planned,ongoing,completed,delayed,cancelled',
        ]);

        $data = [];

        if (array_key_exists('project_id', $validated)) {
            $data['project_id'] =
                $validated['project_id'];
        }

        if (array_key_exists('work_id', $validated)) {
            $data['work_id'] =
                $validated['work_id'];
        }

        if (array_key_exists('title', $validated)) {
            $data['title'] =
                $validated['title'];
        }

        if (array_key_exists('description', $validated)) {
            $data['description'] =
                $validated['description'];
        }

        if (array_key_exists('start_date', $validated)) {
            $data['start_date'] =
                $validated['start_date'];
        }

        if (array_key_exists('end_date', $validated)) {
            $data['end_date'] =
                $validated['end_date'];
        }

        if (array_key_exists('status', $validated)) {
            $data['schedule_status'] =
                $validated['status'];
        }

        $schedule->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diperbarui.',
            'data' => $schedule->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Schedule $schedule
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus jadwal.',
            ], 403);
        }

        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dihapus.',
        ]);
    }
}
