<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArAsset;
use Illuminate\Http\Request;

class ArAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = ArAsset::query();

        if ($request->user()->role !== 'admin') {
            $query->where('is_active', true);
        }

        $assets = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $assets,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan AR asset.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'asset_type' => 'required|in:color,material,furniture',
            'category' => 'nullable|string|max:100',
            'color_code' => 'nullable|string|max:20',
            'texture_path' => 'nullable|string|max:255',
            'model_3d_path' => 'nullable|string|max:255',
            'thumbnail_path' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $asset = ArAsset::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'AR asset berhasil ditambahkan.',
            'data' => $asset,
        ], 201);
    }

    public function show(
        Request $request,
        ArAsset $arAsset
    ) {
        if (
            $request->user()->role !== 'admin' &&
            !$arAsset->is_active
        ) {
            return response()->json([
                'success' => false,
                'message' => 'AR asset tidak tersedia.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $arAsset,
        ]);
    }

    public function update(
        Request $request,
        ArAsset $arAsset
    ) {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah AR asset.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:150',
            'asset_type' => 'sometimes|in:color,material,furniture',
            'category' => 'nullable|string|max:100',
            'color_code' => 'nullable|string|max:20',
            'texture_path' => 'nullable|string|max:255',
            'model_3d_path' => 'nullable|string|max:255',
            'thumbnail_path' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $arAsset->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'AR asset berhasil diperbarui.',
            'data' => $arAsset->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        ArAsset $arAsset
    ) {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus AR asset.',
            ], 403);
        }

        $arAsset->delete();

        return response()->json([
            'success' => true,
            'message' => 'AR asset berhasil dihapus.',
        ]);
    }
}
