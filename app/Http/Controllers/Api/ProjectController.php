<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // =========================
    // DAFTAR PROJECT
    // =========================
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $projects = Project::with(['client.user', 'admin'])
                ->latest()
                ->get();
        } else {
            $projects = Project::with(['client.user', 'admin'])
                ->whereHas('client', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->latest()
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    // =========================
    // DETAIL PROJECT
    // =========================
    public function show(Request $request, Project $project)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $project->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke project ini.',
            ], 403);
        }

        $project->load([
            'client.user',
            'admin',
            'areas',
            'works',
            'schedules',
            'materials',
            'expenses',
            'progressUpdates',
            'documentations',
        ]);

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }

    // =========================
    // BUAT PROJECT
    // =========================
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat membuat project.',
            ], 403);
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'project_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'target_end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable|in:planning,ongoing,paused,completed,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'budget_total' => 'nullable|numeric|min:0',
            'cover_image' => 'nullable|string|max:255',
        ]);

        $validated['admin_id'] = $user->id;

        $project = Project::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dibuat.',
            'data' => $project,
        ], 201);
    }

    // =========================
    // UPDATE PROJECT
    // =========================
    public function update(
        Request $request,
        Project $project
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah project.',
            ], 403);
        }

        $validated = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'project_name' => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'location' => 'sometimes|string|max:255',
            'start_date' => 'nullable|date',
            'target_end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'sometimes|in:planning,ongoing,paused,completed,cancelled',
            'progress_percentage' => 'sometimes|integer|min:0|max:100',
            'budget_total' => 'sometimes|numeric|min:0',
            'cover_image' => 'nullable|string|max:255',
        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil diperbarui.',
            'data' => $project->fresh(),
        ]);
    }

    // =========================
    // HAPUS PROJECT
    // =========================
    public function destroy(
        Request $request,
        Project $project
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus project.',
            ], 403);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus.',
        ]);
    }
}
