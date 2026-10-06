<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Documentation::with([
            'project',
            'uploader',
        ]);

        if ($user->role !== 'admin') {
            $query->where('is_visible_to_client', true)
                ->whereHas('project.client', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
        }

        $documentations = $query
            ->latest('photo_date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $documentations,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan dokumentasi.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'category' => 'required|in:before,during,after',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'file_path' => 'required|string|max:255',
            'photo_date' => 'nullable|date',
            'is_visible_to_client' => 'boolean',
        ]);

        $validated['uploaded_by'] = $user->id;

        $documentation = Documentation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dokumentasi berhasil ditambahkan.',
            'data' => $documentation,
        ], 201);
    }

    public function show(
        Request $request,
        Documentation $documentation
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            (
                !$documentation->is_visible_to_client ||
                $documentation->project?->client?->user_id !== $user->id
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke dokumentasi ini.',
            ], 403);
        }

        $documentation->load([
            'project',
            'uploader',
        ]);

        return response()->json([
            'success' => true,
            'data' => $documentation,
        ]);
    }

    public function update(
        Request $request,
        Documentation $documentation
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah dokumentasi.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'sometimes|exists:projects,id',
            'category' => 'sometimes|in:before,during,after',
            'title' => 'sometimes|string|max:150',
            'description' => 'nullable|string',
            'file_path' => 'sometimes|string|max:255',
            'photo_date' => 'nullable|date',
            'is_visible_to_client' => 'boolean',
        ]);

        $documentation->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dokumentasi berhasil diperbarui.',
            'data' => $documentation->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Documentation $documentation
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus dokumentasi.',
            ], 403);
        }

        $documentation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumentasi berhasil dihapus.',
        ]);
    }
}
