<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Work::with('project');

        if ($user->role !== 'admin') {
            $query->whereHas('project.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $works = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $works,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan pekerjaan.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'work_name' => 'required|string|max:150',
            'method_type' => 'required|in:daily,contract',
            'volume' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'nullable|in:planned,ongoing,completed,cancelled',
            'is_visible_to_client' => 'boolean',
        ]);

        $work = Work::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil ditambahkan.',
            'data' => $work,
        ], 201);
    }

    public function show(Request $request, Work $work)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $work->project?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke pekerjaan ini.',
            ], 403);
        }

        $work->load('project');

        return response()->json([
            'success' => true,
            'data' => $work,
        ]);
    }

    public function update(
        Request $request,
        Work $work
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah pekerjaan.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'sometimes|exists:projects,id',
            'work_name' => 'sometimes|string|max:150',
            'method_type' => 'sometimes|in:daily,contract',
            'volume' => 'sometimes|numeric|min:0',
            'unit' => 'sometimes|string|max:50',
            'unit_price' => 'sometimes|numeric|min:0',
            'duration_days' => 'sometimes|integer|min:1',
            'total_cost' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:planned,ongoing,completed,cancelled',
            'is_visible_to_client' => 'boolean',
        ]);

        $work->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil diperbarui.',
            'data' => $work->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Work $work
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus pekerjaan.',
            ], 403);
        }

        $work->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil dihapus.',
        ]);
    }
}
