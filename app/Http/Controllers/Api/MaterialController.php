<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Material::with('project');

        if ($user->role !== 'admin') {
            $query->whereHas('project.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $materials = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $materials,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan material.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'material_name' => 'required|string|max:150',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:150',
            'purchase_date' => 'nullable|date',
            'is_visible_to_client' => 'boolean',
        ]);

        $material = Material::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Material berhasil ditambahkan.',
            'data' => $material,
        ], 201);
    }

    public function show(Request $request, Material $material)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $material->project?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke material ini.',
            ], 403);
        }

        $material->load('project');

        return response()->json([
            'success' => true,
            'data' => $material,
        ]);
    }

    public function update(
        Request $request,
        Material $material
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah material.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'sometimes|exists:projects,id',
            'material_name' => 'sometimes|string|max:150',
            'quantity' => 'sometimes|numeric|min:0',
            'unit' => 'sometimes|string|max:50',
            'unit_price' => 'sometimes|numeric|min:0',
            'total_price' => 'sometimes|numeric|min:0',
            'supplier' => 'nullable|string|max:150',
            'purchase_date' => 'nullable|date',
            'is_visible_to_client' => 'boolean',
        ]);

        $material->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Material berhasil diperbarui.',
            'data' => $material->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Material $material
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus material.',
            ], 403);
        }

        $material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Material berhasil dihapus.',
        ]);
    }
}
