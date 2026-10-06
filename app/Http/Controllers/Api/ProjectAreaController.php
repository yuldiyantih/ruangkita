<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectArea;
use Illuminate\Http\Request;

class ProjectAreaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = ProjectArea::with('project');

        if ($user->role !== 'admin') {
            $query->whereHas('project.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $areas = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $areas,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan area.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'area_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
        ]);

        $area = ProjectArea::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Area berhasil ditambahkan.',
            'data' => $area,
        ], 201);
    }

    public function show(Request $request, ProjectArea $projectArea)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $projectArea->project?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke area ini.',
            ], 403);
        }

        $projectArea->load('project');

        return response()->json([
            'success' => true,
            'data' => $projectArea,
        ]);
    }

    public function update(
        Request $request,
        ProjectArea $projectArea
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah area.',
            ], 403);
        }

        $validated = $request->validate([
            'area_name' => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
        ]);

        $projectArea->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Area berhasil diperbarui.',
            'data' => $projectArea->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        ProjectArea $projectArea
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus area.',
            ], 403);
        }

        $projectArea->delete();

        return response()->json([
            'success' => true,
            'message' => 'Area berhasil dihapus.',
        ]);
    }
}
