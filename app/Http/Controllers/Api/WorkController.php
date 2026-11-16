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
            'project_id' =>
            'required|exists:projects,project_id',

            'work_name' =>
            'required|string|max:150',

            'method_type' =>
            'required|in:daily,contract',

            'volume' =>
            'required|numeric|min:0',

            'unit' =>
            'required|string|max:50',

            'unit_price' =>
            'required|numeric|min:0',

            'duration_days' =>
            'required|integer|min:1',

            'total_cost' =>
            'required|numeric|min:0',

            'status' =>
            'nullable|in:planned,ongoing,completed,cancelled',

            'is_visible_to_client' =>
            'boolean',
        ]);

        $work = Work::create([
            'project_id' =>
            $validated['project_id'],

            'work_name' =>
            $validated['work_name'],

            'method_type' =>
            $validated['method_type'],

            'volume' =>
            $validated['volume'],

            'unit' =>
            $validated['unit'],

            'unit_price' =>
            $validated['unit_price'],

            'duration_days' =>
            $validated['duration_days'],

            'total_cost' =>
            $validated['total_cost'],

            'work_status' =>
            $validated['status']
                ?? null,

            'is_visible_to_client' =>
            $validated['is_visible_to_client']
                ?? false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil ditambahkan.',
            'data' => $work,
        ], 201);
    }

    public function show(
        Request $request,
        Work $work
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin'
            &&
            $work
            ->project
            ?->client
            ?->user_id !== $user->user_id
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
            'project_id' =>
            'sometimes|exists:projects,project_id',

            'work_name' =>
            'sometimes|string|max:150',

            'method_type' =>
            'sometimes|in:daily,contract',

            'volume' =>
            'sometimes|numeric|min:0',

            'unit' =>
            'sometimes|string|max:50',

            'unit_price' =>
            'sometimes|numeric|min:0',

            'duration_days' =>
            'sometimes|integer|min:1',

            'total_cost' =>
            'sometimes|numeric|min:0',

            'status' =>
            'sometimes|in:planned,ongoing,completed,cancelled',

            'is_visible_to_client' =>
            'boolean',
        ]);

        $data = [];

        if (array_key_exists('project_id', $validated)) {
            $data['project_id'] =
                $validated['project_id'];
        }

        if (array_key_exists('work_name', $validated)) {
            $data['work_name'] =
                $validated['work_name'];
        }

        if (array_key_exists('method_type', $validated)) {
            $data['method_type'] =
                $validated['method_type'];
        }

        if (array_key_exists('volume', $validated)) {
            $data['volume'] =
                $validated['volume'];
        }

        if (array_key_exists('unit', $validated)) {
            $data['unit'] =
                $validated['unit'];
        }

        if (array_key_exists('unit_price', $validated)) {
            $data['unit_price'] =
                $validated['unit_price'];
        }

        if (array_key_exists('duration_days', $validated)) {
            $data['duration_days'] =
                $validated['duration_days'];
        }

        if (array_key_exists('total_cost', $validated)) {
            $data['total_cost'] =
                $validated['total_cost'];
        }

        if (array_key_exists('status', $validated)) {
            $data['work_status'] =
                $validated['status'];
        }

        if (array_key_exists('is_visible_to_client', $validated)) {
            $data['is_visible_to_client'] =
                $validated['is_visible_to_client'];
        }

        $work->update($data);

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
