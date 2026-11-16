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

        $asset = ArAsset::create([
            'ar_asset_name' =>
            $validated['name'],

            'asset_type' =>
            $validated['asset_type'],

            'category' =>
            $validated['category']
                ?? null,

            'color_code' =>
            $validated['color_code']
                ?? null,

            'texture_path' =>
            $validated['texture_path']
                ?? null,

            'model_3d_path' =>
            $validated['model_3d_path']
                ?? null,

            'thumbnail_path' =>
            $validated['thumbnail_path']
                ?? null,

            'is_active' =>
            $validated['is_active']
                ?? true,
        ]);

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
            $request->user()->role !== 'admin'
            &&
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

        $data = [];

        if (array_key_exists('name', $validated)) {
            $data['ar_asset_name'] =
                $validated['name'];
        }

        if (array_key_exists('asset_type', $validated)) {
            $data['asset_type'] =
                $validated['asset_type'];
        }

        if (array_key_exists('category', $validated)) {
            $data['category'] =
                $validated['category'];
        }

        if (array_key_exists('color_code', $validated)) {
            $data['color_code'] =
                $validated['color_code'];
        }

        if (array_key_exists('texture_path', $validated)) {
            $data['texture_path'] =
                $validated['texture_path'];
        }

        if (array_key_exists('model_3d_path', $validated)) {
            $data['model_3d_path'] =
                $validated['model_3d_path'];
        }

        if (array_key_exists('thumbnail_path', $validated)) {
            $data['thumbnail_path'] =
                $validated['thumbnail_path'];
        }

        if (array_key_exists('is_active', $validated)) {
            $data['is_active'] =
                $validated['is_active'];
        }

        $arAsset->update($data);

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
