<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArDesign;
use Illuminate\Http\Request;

class ArDesignController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = ArDesign::with([
            'project',
            'area',
            'client',
            'items.asset',
        ]);

        if ($user->role !== 'admin') {
            $query->where('client_id', function ($q) use ($user) {
                $q->select('id')
                    ->from('clients')
                    ->where('user_id', $user->id)
                    ->limit(1);
            });
        }

        $designs = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $designs,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            $client = $user->client;

            if (!$client) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data client belum tersedia.',
                ], 422);
            }
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'project_area_id' => 'required|exists:project_areas,id',
            'client_id' => 'nullable|exists:clients,id',
            'design_name' => 'required|string|max:150',
            'preview_image' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:draft,submitted,approved,rejected',
        ]);

        if ($user->role !== 'admin') {
            $validated['client_id'] = $user->client->id;
        }

        $design = ArDesign::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Desain AR berhasil dibuat.',
            'data' => $design,
        ], 201);
    }

    public function show(
        Request $request,
        ArDesign $arDesign
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $arDesign->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke desain ini.',
            ], 403);
        }

        $arDesign->load([
            'project',
            'area',
            'client',
            'items.asset',
        ]);

        return response()->json([
            'success' => true,
            'data' => $arDesign,
        ]);
    }

    public function update(
        Request $request,
        ArDesign $arDesign
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $arDesign->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses untuk mengubah desain ini.',
            ], 403);
        }

        $validated = $request->validate([
            'design_name' => 'sometimes|string|max:150',
            'preview_image' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'sometimes|in:draft,submitted,approved,rejected',
        ]);

        $arDesign->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Desain AR berhasil diperbarui.',
            'data' => $arDesign->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        ArDesign $arDesign
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $arDesign->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses untuk menghapus desain ini.',
            ], 403);
        }

        $arDesign->delete();

        return response()->json([
            'success' => true,
            'message' => 'Desain AR berhasil dihapus.',
        ]);
    }
}
