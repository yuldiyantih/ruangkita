<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgressUpdate;
use Illuminate\Http\Request;

class ProgressUpdateController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = ProgressUpdate::with([
            'project',
            'creator',
        ]);

        if ($user->role !== 'admin') {
            $query->whereHas('project.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $updates = $query
            ->latest('update_date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $updates,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan progress.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'percentage' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'update_date' => 'required|date',
            'photo_path' => 'nullable|string|max:255',
        ]);

        $validated['created_by'] = $user->id;

        $progressUpdate = ProgressUpdate::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Progress berhasil ditambahkan.',
            'data' => $progressUpdate,
        ], 201);
    }

    public function show(
        Request $request,
        ProgressUpdate $progressUpdate
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $progressUpdate->project?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke progress ini.',
            ], 403);
        }

        $progressUpdate->load([
            'project',
            'creator',
        ]);

        return response()->json([
            'success' => true,
            'data' => $progressUpdate,
        ]);
    }

    public function update(
        Request $request,
        ProgressUpdate $progressUpdate
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah progress.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'sometimes|exists:projects,id',
            'percentage' => 'sometimes|integer|min:0|max:100',
            'description' => 'nullable|string',
            'update_date' => 'sometimes|date',
            'photo_path' => 'nullable|string|max:255',
        ]);

        $progressUpdate->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Progress berhasil diperbarui.',
            'data' => $progressUpdate->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        ProgressUpdate $progressUpdate
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus progress.',
            ], 403);
        }

        $progressUpdate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Progress berhasil dihapus.',
        ]);
    }
}
