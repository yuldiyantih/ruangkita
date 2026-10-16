<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PESAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | SEMUA PROJECT + CLIENT
        |--------------------------------------------------------------------------
        */

        $projects = Project::query()
            ->with([
                'client.user',
            ])
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RINGKASAN PERCAKAPAN
        |--------------------------------------------------------------------------
        |
        | Satu project dianggap satu ruang percakapan.
        |
        */

        $conversations = $projects
            ->map(function ($project) use ($admin) {

                $clientUser =
                    $project
                    ->client
                    ?->user;

                if (!$clientUser) {
                    return null;
                }


                /*
                |--------------------------------------------------------------------------
                | PESAN TERAKHIR
                |--------------------------------------------------------------------------
                */

                $lastMessage = Message::query()
                    ->where(
                        'project_id',
                        $project->id
                    )
                    ->where(function ($query) use (
                        $admin,
                        $clientUser
                    ) {

                        $query
                            ->where(function ($subQuery) use (
                                $admin,
                                $clientUser
                            ) {

                                $subQuery
                                    ->where(
                                        'sender_id',
                                        $admin->id
                                    )
                                    ->where(
                                        'receiver_id',
                                        $clientUser->id
                                    );
                            })
                            ->orWhere(function ($subQuery) use (
                                $admin,
                                $clientUser
                            ) {

                                $subQuery
                                    ->where(
                                        'sender_id',
                                        $clientUser->id
                                    )
                                    ->where(
                                        'receiver_id',
                                        $admin->id
                                    );
                            });
                    })
                    ->latest('sent_at')
                    ->first();


                /*
                |--------------------------------------------------------------------------
                | PESAN BELUM DIBACA
                |--------------------------------------------------------------------------
                */

                $unread = Message::query()
                    ->where(
                        'project_id',
                        $project->id
                    )
                    ->where(
                        'sender_id',
                        $clientUser->id
                    )
                    ->where(
                        'receiver_id',
                        $admin->id
                    )
                    ->where(
                        'is_read',
                        false
                    )
                    ->count();


                return [
                    'user' => $clientUser,
                    'project' => $project,
                    'last_message' => $lastMessage,
                    'unread' => $unread,
                ];
            })
            ->filter()
            ->sortByDesc(function ($conversation) {

                if ($conversation['last_message']) {
                    return $conversation['last_message']->sent_at;
                }

                return $conversation['project']->created_at;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PROJECT TERPILIH
        |--------------------------------------------------------------------------
        */

        $selectedProject = null;

        if ($request->filled('project')) {

            $selectedProject =
                $projects->firstWhere(
                    'id',
                    (int) $request->project
                );
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA TIDAK ADA PROJECT DI URL
        |--------------------------------------------------------------------------
        */

        if (!$selectedProject) {

            $selectedProject =
                $conversations
                    ->first()['project']
                ?? null;
        }


        /*
        |--------------------------------------------------------------------------
        | CLIENT BERDASARKAN PROJECT
        |--------------------------------------------------------------------------
        */

        $selectedUser =
            $selectedProject
            ?->client
            ?->user;


        /*
        |--------------------------------------------------------------------------
        | PESAN DALAM PROJECT
        |--------------------------------------------------------------------------
        */

        $chatMessages = collect();


        if (
            $selectedProject
            &&
            $selectedUser
        ) {

            $chatMessages = Message::query()
                ->with([
                    'sender',
                    'receiver',
                    'project',
                ])
                ->where(
                    'project_id',
                    $selectedProject->id
                )
                ->where(function ($query) use (
                    $admin,
                    $selectedUser
                ) {

                    $query
                        ->where(function ($subQuery) use (
                            $admin,
                            $selectedUser
                        ) {

                            $subQuery
                                ->where(
                                    'sender_id',
                                    $admin->id
                                )
                                ->where(
                                    'receiver_id',
                                    $selectedUser->id
                                );
                        })
                        ->orWhere(function ($subQuery) use (
                            $admin,
                            $selectedUser
                        ) {

                            $subQuery
                                ->where(
                                    'sender_id',
                                    $selectedUser->id
                                )
                                ->where(
                                    'receiver_id',
                                    $admin->id
                                );
                        });
                })
                ->orderBy('sent_at')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | TANDAI SUDAH DIBACA
            |--------------------------------------------------------------------------
            */

            Message::query()
                ->where(
                    'project_id',
                    $selectedProject->id
                )
                ->where(
                    'sender_id',
                    $selectedUser->id
                )
                ->where(
                    'receiver_id',
                    $admin->id
                )
                ->where(
                    'is_read',
                    false
                )
                ->update([
                    'is_read' => true,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalConversations =
            $conversations
            ->filter(
                fn($item) =>
                $item['last_message'] !== null
            )
            ->count();


        $totalUnread = Message::query()
            ->where(
                'receiver_id',
                $admin->id
            )
            ->where(
                'is_read',
                false
            )
            ->count();


        $todayMessages = Message::query()
            ->where(function ($query) use ($admin) {

                $query
                    ->where(
                        'sender_id',
                        $admin->id
                    )
                    ->orWhere(
                        'receiver_id',
                        $admin->id
                    );
            })
            ->whereDate(
                'sent_at',
                today()
            )
            ->count();


        return view(
            'admin.messages.index',
            compact(
                'conversations',
                'selectedUser',
                'selectedProject',
                'chatMessages',
                'totalConversations',
                'totalUnread',
                'todayMessages'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM PESAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function send(Request $request)
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'receiver_id' => [
                'required',
                'exists:users,id',
            ],

            'project_id' => [
                'required',
                'exists:projects,id',
            ],

            'message_text' => [
                'nullable',
                'string',
                'max:3000',
            ],

            'attachment' => [
                'nullable',
                'file',
                'max:20480',
                'mimes:jpg,jpeg,png,webp,mp4,mov,webm,pdf,doc,docx,xls,xlsx,zip',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PESAN ATAU FILE WAJIB ADA
        |--------------------------------------------------------------------------
        */

        if (
            !$request->filled('message_text')
            &&
            !$request->hasFile('attachment')
        ) {

            return back()
                ->withErrors([
                    'message_text' =>
                    'Tulis pesan atau lampirkan file.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | RECEIVER HARUS CLIENT
        |--------------------------------------------------------------------------
        */

        $receiver = User::query()
            ->where(
                'id',
                $validated['receiver_id']
            )
            ->where(
                'role',
                'client'
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | PROJECT HARUS MILIK CLIENT TERSEBUT
        |--------------------------------------------------------------------------
        */

        $project = Project::query()
            ->where(
                'id',
                $validated['project_id']
            )
            ->whereHas(
                'client',
                function ($query) use ($receiver) {

                    $query->where(
                        'user_id',
                        $receiver->id
                    );
                }
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DATA ATTACHMENT
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;
        $attachmentName = null;
        $attachmentType = null;
        $attachmentSize = null;


        if ($request->hasFile('attachment')) {

            $file =
                $request->file(
                    'attachment'
                );


            $attachmentPath =
                $file->store(
                    'messages',
                    'public'
                );


            $attachmentName =
                $file->getClientOriginalName();


            $attachmentType =
                $file->getMimeType();


            $attachmentSize =
                $file->getSize();
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PESAN
        |--------------------------------------------------------------------------
        */

        Message::create([

            'project_id' =>
            $project->id,

            'sender_id' =>
            $admin->id,

            'receiver_id' =>
            $receiver->id,

            'message_text' =>
            $validated['message_text']
                ?? null,

            'attachment_path' =>
            $attachmentPath,

            'attachment_name' =>
            $attachmentName,

            'attachment_type' =>
            $attachmentType,

            'attachment_size' =>
            $attachmentSize,

            'is_read' =>
            false,

            'sent_at' =>
            now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE PROJECT YANG SAMA
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'admin.messages.index',
                [
                    'project' =>
                    $project->id,
                ]
            )
            ->with(
                'success',
                'Pesan berhasil dikirim.'
            );
    }
}
