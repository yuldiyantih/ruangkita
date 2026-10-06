<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $messages = Message::with([
            'project',
            'sender',
            'receiver',
        ])
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->latest('sent_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'receiver_id' => 'required|exists:users,id',
            'message_text' => 'required|string',
        ]);

        $validated['sender_id'] = $user->id;
        $validated['sent_at'] = now();

        $message = Message::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim.',
            'data' => $message,
        ], 201);
    }

    public function show(Request $request, Message $message)
    {
        $user = $request->user();

        if (
            $message->sender_id !== $user->id &&
            $message->receiver_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke pesan ini.',
            ], 403);
        }

        $message->load([
            'project',
            'sender',
            'receiver',
        ]);

        return response()->json([
            'success' => true,
            'data' => $message,
        ]);
    }

    public function update(
        Request $request,
        Message $message
    ) {
        $user = $request->user();

        if ($message->receiver_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya penerima yang dapat mengubah status pesan.',
            ], 403);
        }

        $validated = $request->validate([
            'is_read' => 'required|boolean',
        ]);

        $message->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Status pesan berhasil diperbarui.',
            'data' => $message->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Message $message
    ) {
        $user = $request->user();

        if (
            $message->sender_id !== $user->id &&
            $message->receiver_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke pesan ini.',
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus.',
        ]);
    }
}
