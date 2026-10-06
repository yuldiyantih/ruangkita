<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArDesignItem;
use Illuminate\Http\Request;

class ArDesignItemController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = ArDesignItem::with([
            'design',
            'asset',
        ]);

        if ($user->role !== 'admin') {
            $query->whereHas('design.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $items = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'ar_design_id' => 'required|exists:ar_designs,id',
            'ar_asset_id' => 'required|exists:ar_assets,id',
            'position_x' => 'required|numeric',
            'position_y' => 'required|numeric',
            'position_z' => 'required|numeric',
            'rotation_x' => 'required|numeric',
            'rotation_y' => 'required|numeric',
            'rotation_z' => 'required|numeric',
            'scale_x' => 'required|numeric',
            'scale_y' => 'required|numeric',
            'scale_z' => 'required|numeric',
        ]);

        $design = \App\Models\ArDesign::findOrFail(
            $validated['ar_design_id']
        );

        if (
            $user->role !== 'admin' &&
            $design->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke desain ini.',
            ], 403);
        }

        $item = ArDesignItem::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item AR berhasil ditambahkan.',
            'data' => $item,
        ], 201);
    }

    public function show(
        Request $request,
        ArDesignItem $arDesignItem
    ) {
        $user = $request->user();

        $arDesignItem->load([
            'design.client',
            'asset',
        ]);

        if (
            $user->role !== 'admin' &&
            $arDesignItem->design?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke item AR ini.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $arDesignItem,
        ]);
    }

    public function update(
        Request $request,
        ArDesignItem $arDesignItem
    ) {
        $user = $request->user();

        $arDesignItem->load('design.client');

        if (
            $user->role !== 'admin' &&
            $arDesignItem->design?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke item AR ini.',
            ], 403);
        }

        $validated = $request->validate([
            'ar_asset_id' => 'sometimes|exists:ar_assets,id',
            'position_x' => 'sometimes|numeric',
            'position_y' => 'sometimes|numeric',
            'position_z' => 'sometimes|numeric',
            'rotation_x' => 'sometimes|numeric',
            'rotation_y' => 'sometimes|numeric',
            'rotation_z' => 'sometimes|numeric',
            'scale_x' => 'sometimes|numeric',
            'scale_y' => 'sometimes|numeric',
            'scale_z' => 'sometimes|numeric',
        ]);

        $arDesignItem->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item AR berhasil diperbarui.',
            'data' => $arDesignItem->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        ArDesignItem $arDesignItem
    ) {
        $user = $request->user();

        $arDesignItem->load('design.client');

        if (
            $user->role !== 'admin' &&
            $arDesignItem->design?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke item AR ini.',
            ], 403);
        }

        $arDesignItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item AR berhasil dihapus.',
        ]);
    }
}
