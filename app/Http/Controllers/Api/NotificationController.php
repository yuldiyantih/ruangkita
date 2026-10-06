<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::with('project')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $notifications,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat membuat notifikasi.',
            ], 403);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:150',
            'message' => 'required|string',
            'type' => 'required|in:project,schedule,progress,expense,documentation,message,ar,system',
            'is_read' => 'boolean',
        ]);

        $notification = Notification::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dibuat.',
            'data' => $notification,
        ], 201);
    }

    public function show(
        Request $request,
        Notification $notification
    ) {
        if ($notification->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke notifikasi ini.',
            ], 403);
        }

        $notification->load('project');

        return response()->json([
            'success' => true,
            'data' => $notification,
        ]);
    }

    public function update(
        Request $request,
        Notification $notification
    ) {
        if ($notification->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke notifikasi ini.',
            ], 403);
        }

        $validated = $request->validate([
            'is_read' => 'required|boolean',
        ]);

        $notification->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status notifikasi berhasil diperbarui.',
            'data' => $notification->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Notification $notification
    ) {
        if ($notification->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke notifikasi ini.',
            ], 403);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus.',
        ]);
    }
}
