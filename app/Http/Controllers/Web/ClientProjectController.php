<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Message;
use App\Models\ArAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ClientProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PROYEK SAYA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        // Hanya client yang boleh masuk
        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        $projects = $client
            ? $client->projects()
            ->latest()
            ->get()
            : collect();

        return view('client.projects.index', compact(
            'projects'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL PROYEK
    |--------------------------------------------------------------------------
    */

    public function show(Project $project)
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        // Client hanya boleh membuka proyek miliknya sendiri
        if (
            !$client ||
            $project->client_id !== $client->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }

        $project->load([
            'areas',
            'works',
            'schedules',
            'progressUpdates',
            'documentations'
        ]);

        return view('client.projects.show', compact(
            'project'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    |  JADWAL PROYEK
    |--------------------------------------------------------------------------
    */

    public function schedule(Project $project)
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (!$client || $project->client_id !== $client->id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }

        $project->load([
            'schedules' => function ($query) {
                $query->orderBy('start_date', 'asc');
            }
        ]);

        return view('client.projects.schedule', compact('project'));
    }
    /*
    |--------------------------------------------------------------------------
    | JADWAL SEMUA PROYEK CLIENT
    |--------------------------------------------------------------------------
    */

    public function allSchedules()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (!$client) {
            abort(403, 'Data client tidak ditemukan.');
        }

        $projects = $client->projects()
            ->with([
                'schedules' => function ($query) {
                    $query->orderBy('start_date', 'asc');
                }
            ])
            ->latest()
            ->get();

        return view('client.schedule', compact('projects'));
    }

    public function allProgress()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (!$client) {
            abort(403, 'Data client tidak ditemukan.');
        }

        $projects = $client->projects()
            ->with([
                'works',
                'progressUpdates' => function ($query) {
                    $query->orderBy('update_date', 'desc');
                },
                'areas',
            ])
            ->latest()
            ->get();

        return view(
            'client.progress',
            compact('projects')
        );
    }


    public function progress(Project $project)
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (
            !$client ||
            $project->client_id !== $client->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }

        $project->load([
            'progressUpdates' => function ($query) {
                $query->orderBy('update_date', 'desc');
            },
            'areas',
            'works'
        ]);

        $projects = collect([$project]);

        return view(
            'client.progress',
            compact('projects')
        );
    }


    public function documentation()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }


        $client = $user->client;

        if (!$client) {
            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | SEMUA PROJECT MILIK CLIENT
    |--------------------------------------------------------------------------
    */

        $projects =
            $client
            ->projects()
            ->latest()
            ->get();


        /*
    |--------------------------------------------------------------------------
    | PILIH PROJECT AKTIF
    |--------------------------------------------------------------------------
    */

        $selectedProject = null;


        if ($projects->count() > 0) {

            $requestedProjectId =
                request('project');


            if ($requestedProjectId) {

                $selectedProject =
                    $projects->firstWhere(
                        'id',
                        (int) $requestedProjectId
                    );
            }


            if (!$selectedProject) {

                $selectedProject =
                    $projects->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | LOAD DOCUMENTATION PROJECT
    |--------------------------------------------------------------------------
    */

        if ($selectedProject) {

            $selectedProject->load([

                'documentations' =>
                function ($query) {

                    $query
                        ->where(
                            'is_visible_to_client',
                            true
                        )
                        ->orderByDesc(
                            'photo_date'
                        )
                        ->orderByDesc(
                            'created_at'
                        );
                },

            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | STATISTIK DOCUMENTATION
    |--------------------------------------------------------------------------
    */

        $documentationStats = [

            'total' => 0,

            'before' => 0,

            'during' => 0,

            'after' => 0,

        ];


        if ($selectedProject) {

            $documents =
                $selectedProject
                ->documentations;


            $documentationStats['total'] =
                $documents->count();


            $documentationStats['before'] =
                $documents
                ->where(
                    'category',
                    'before'
                )
                ->count();


            $documentationStats['during'] =
                $documents
                ->where(
                    'category',
                    'during'
                )
                ->count();


            $documentationStats['after'] =
                $documents
                ->where(
                    'category',
                    'after'
                )
                ->count();
        }


        return view(
            'client.documentation',
            compact(
                'projects',
                'selectedProject',
                'documentationStats'
            )
        );
    }


    public function costs()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }


        $client = $user->client;

        if (!$client) {
            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | PROJECT CLIENT
    |--------------------------------------------------------------------------
    */

        $projects = $client->projects()
            ->latest()
            ->get();


        /*
    |--------------------------------------------------------------------------
    | PROJECT AKTIF
    |--------------------------------------------------------------------------
    */

        $selectedProject = null;


        if ($projects->count() > 0) {

            $requestedProjectId =
                request('project');


            if ($requestedProjectId) {

                $selectedProject =
                    $projects->firstWhere(
                        'id',
                        (int) $requestedProjectId
                    );
            }


            if (!$selectedProject) {

                $selectedProject =
                    $projects->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | LOAD BIAYA
    |--------------------------------------------------------------------------
    */

        if ($selectedProject) {

            $selectedProject->load([

                'paymentStages' => function ($query) {

                    $query
                        ->where(
                            'is_visible_to_client',
                            true
                        )
                        ->orderBy(
                            'sort_order'
                        );
                },


                'payments' => function ($query) {

                    $query
                        ->where(
                            'is_visible_to_client',
                            true
                        )
                        ->with(
                            'paymentStage'
                        )
                        ->orderByDesc(
                            'payment_date'
                        )
                        ->orderByDesc(
                            'created_at'
                        );
                },

            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | STATISTIK
    |--------------------------------------------------------------------------
    */

        $totalProject = 0;
        $totalPaid = 0;
        $remaining = 0;
        $paymentPercentage = 0;


        if ($selectedProject) {

            $totalProject =
                (int) (
                    $selectedProject->budget_total
                    ?? 0
                );


            $totalPaid =
                (int) $selectedProject
                    ->payments
                    ->where(
                        'status',
                        'verified'
                    )
                    ->sum(
                        'amount'
                    );


            $remaining =
                max(
                    0,
                    $totalProject
                        -
                        $totalPaid
                );


            if ($totalProject > 0) {

                $paymentPercentage =
                    round(
                        (
                            $totalPaid
                            /
                            $totalProject
                        )
                            *
                            100
                    );
            }
        }


        return view(
            'client.costs',
            compact(
                'projects',
                'selectedProject',
                'totalProject',
                'totalPaid',
                'remaining',
                'paymentPercentage'
            )
        );
    }


    public function messages()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }


        /*
    |--------------------------------------------------------------------------
    | DATA CLIENT
    |--------------------------------------------------------------------------
    */

        $client = $user->client;

        if (!$client) {
            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | PROJECT MILIK CLIENT
    |--------------------------------------------------------------------------
    */

        $projects = $client
            ->projects()
            ->latest()
            ->get();


        /*
    |--------------------------------------------------------------------------
    | PROJECT TERPILIH
    |--------------------------------------------------------------------------
    */

        $selectedProject = null;

        if ($projects->count() > 0) {

            $requestedProjectId =
                request('project');


            if ($requestedProjectId) {

                $selectedProject =
                    $projects->firstWhere(
                        'id',
                        (int) $requestedProjectId
                    );
            }


            if (!$selectedProject) {

                $selectedProject =
                    $projects->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | TEAM / ADMIN
    |--------------------------------------------------------------------------
    */

        $teamMembers = User::query()
            ->where('role', 'admin')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();


        /*
    |--------------------------------------------------------------------------
    | ADMIN TERPILIH
    |--------------------------------------------------------------------------
    */

        $selectedUser = null;

        if ($teamMembers->count() > 0) {

            $selectedUserId =
                request('user');


            if ($selectedUserId) {

                $selectedUser =
                    $teamMembers->firstWhere(
                        'id',
                        (int) $selectedUserId
                    );
            }


            if (!$selectedUser) {

                $selectedUser =
                    $teamMembers->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | PESAN AKTIF
    |--------------------------------------------------------------------------
    */

        $chatMessages = collect();


        if (
            $selectedUser
            &&
            $selectedProject
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
                    $user,
                    $selectedUser
                ) {

                    $query
                        ->where(function ($subQuery) use (
                            $user,
                            $selectedUser
                        ) {

                            $subQuery
                                ->where(
                                    'sender_id',
                                    $user->id
                                )
                                ->where(
                                    'receiver_id',
                                    $selectedUser->id
                                );
                        })

                        ->orWhere(function ($subQuery) use (
                            $user,
                            $selectedUser
                        ) {

                            $subQuery
                                ->where(
                                    'sender_id',
                                    $selectedUser->id
                                )
                                ->where(
                                    'receiver_id',
                                    $user->id
                                );
                        });
                })

                ->orderBy('sent_at')
                ->get();


            /*
        |--------------------------------------------------------------------------
        | TANDAI PESAN SEBAGAI SUDAH DIBACA
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
                    $user->id
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
    | RINGKASAN PERCAKAPAN
    |--------------------------------------------------------------------------
    */

        $conversations =
            $teamMembers->map(
                function ($member) use (
                    $user,
                    $selectedProject
                ) {

                    $lastMessage = null;
                    $unread = 0;


                    if ($selectedProject) {

                        $lastMessage =
                            Message::query()

                            ->where(
                                'project_id',
                                $selectedProject->id
                            )

                            ->where(function ($query) use (
                                $user,
                                $member
                            ) {

                                $query
                                    ->where(function ($subQuery) use (
                                        $user,
                                        $member
                                    ) {

                                        $subQuery
                                            ->where(
                                                'sender_id',
                                                $user->id
                                            )
                                            ->where(
                                                'receiver_id',
                                                $member->id
                                            );
                                    })

                                    ->orWhere(function ($subQuery) use (
                                        $user,
                                        $member
                                    ) {

                                        $subQuery
                                            ->where(
                                                'sender_id',
                                                $member->id
                                            )
                                            ->where(
                                                'receiver_id',
                                                $user->id
                                            );
                                    });
                            })

                            ->latest('sent_at')
                            ->first();


                        $unread =
                            Message::query()
                            ->where(
                                'project_id',
                                $selectedProject->id
                            )
                            ->where(
                                'sender_id',
                                $member->id
                            )
                            ->where(
                                'receiver_id',
                                $user->id
                            )
                            ->where(
                                'is_read',
                                false
                            )
                            ->count();
                    }


                    return [
                        'user' => $member,
                        'last_message' => $lastMessage,
                        'unread' => $unread,
                    ];
                }
            );


        return view(
            'client.messages',
            compact(
                'projects',
                'selectedProject',
                'conversations',
                'selectedUser',
                'chatMessages'
            )
        );
    }
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
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
    | PESAN ATAU ATTACHMENT WAJIB ADA
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
    | DATA CLIENT
    |--------------------------------------------------------------------------
    */

        $client = $user->client;

        if (!$client) {

            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | VALIDASI PROJECT MILIK CLIENT
    |--------------------------------------------------------------------------
    */

        $project = $client
            ->projects()
            ->where(
                'id',
                $validated['project_id']
            )
            ->firstOrFail();


        /*
    |--------------------------------------------------------------------------
    | VALIDASI RECEIVER HARUS ADMIN
    |--------------------------------------------------------------------------
    */

        $receiver = User::query()
            ->where(
                'id',
                $validated['receiver_id']
            )
            ->where(
                'role',
                'admin'
            )
            ->firstOrFail();


        /*
    |--------------------------------------------------------------------------
    | ATTACHMENT
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
            $user->id,

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
    | KEMBALI KE CHAT
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route(
                'client.messages',
                [
                    'user' =>
                    $receiver->id,
                ]
            )
            ->with(
                'success',
                'Pesan berhasil dikirim.'
            );
    }

    public function ar()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (!$client) {
            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | PROJECT CLIENT
    |--------------------------------------------------------------------------
    */

        $projects = $client->projects()
            ->with([
                'areas',
            ])
            ->latest()
            ->get();


        /*
    |--------------------------------------------------------------------------
    | PROJECT TERPILIH
    |--------------------------------------------------------------------------
    */

        $selectedProject = null;

        if ($projects->count() > 0) {

            $requestedProjectId =
                request('project');

            if ($requestedProjectId) {

                $selectedProject =
                    $projects->firstWhere(
                        'id',
                        (int) $requestedProjectId
                    );
            }

            if (!$selectedProject) {

                $selectedProject =
                    $projects->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | AREA / RUANGAN
    |--------------------------------------------------------------------------
    */

        $areas = collect();

        $selectedArea = null;

        if ($selectedProject) {

            $areas =
                $selectedProject
                ->areas
                ->sortBy('area_name')
                ->values();

            $requestedAreaId =
                request('area');

            if ($requestedAreaId) {

                $selectedArea =
                    $areas->firstWhere(
                        'id',
                        (int) $requestedAreaId
                    );
            }

            if (!$selectedArea && $areas->count() > 0) {

                $selectedArea =
                    $areas->first();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | AR ASSET
    |--------------------------------------------------------------------------
    |
    | Sementara ambil semua asset.
    | Nanti pada Tahap 3 Admin akan mengatur asset.
    |
    */

        $arAssets = ArAsset::query()
            ->latest()
            ->get();


        return view(
            'client.ar',
            compact(
                'projects',
                'selectedProject',
                'areas',
                'selectedArea',
                'arAssets'
            )
        );
    }


    public function settings()
    {
        $user = User::findOrFail(Auth::id());

        if ($user->role !== 'client') {
            return redirect()->route('admin.dashboard');
        }

        $client = $user->client;

        if (!$client) {
            abort(
                403,
                'Data client tidak ditemukan.'
            );
        }

        return view(
            'client.settings',
            compact(
                'user',
                'client'
            )
        );
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if ($user->role !== 'client') {
            abort(403);
        }

        $client = $user->client;

        if (!$client) {
            abort(403, 'Data client tidak ditemukan.');
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
    |--------------------------------------------------------------------------
    | FOTO PROFIL
    |--------------------------------------------------------------------------
    */

        $profilePhoto = $user->profile_photo;

        if ($request->hasFile('profile_photo')) {

            // hapus foto lama
            if ($user->profile_photo) {
                Storage::disk('public')->delete(
                    $user->profile_photo
                );
            }

            // simpan foto baru
            $profilePhoto = $request
                ->file('profile_photo')
                ->store(
                    'profile-photos',
                    'public'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'profile_photo' => $profilePhoto,
        ]);

        /*
    |--------------------------------------------------------------------------
    | UPDATE CLIENT
    |--------------------------------------------------------------------------
    */

        $client->update([
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()
            ->route('client.settings')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if ($user->role !== 'client') {
            abort(403);
        }

        $validated = $request->validate([
            'current_password' => [
                'required',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        if (
            !Hash::check(
                $validated['current_password'],
                $user->password
            )
        ) {

            return back()
                ->withErrors([
                    'current_password'
                    =>
                    'Password lama tidak sesuai.',
                ]);
        }


        /*
    |--------------------------------------------------------------------------
    | User model kamu menggunakan cast "hashed"
    |--------------------------------------------------------------------------
    |
    | Jadi kita cukup memberikan password baru.
    | Laravel akan melakukan hashing.
    |
    */

        $user->password =
            $validated['password'];

        $user->save();


        return redirect()
            ->route(
                'client.settings'
            )
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }

    public function updatePreferences(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($user->role !== 'client') {
            abort(403);
        }


        $validated = $request->validate([
            'language' => [
                'required',
                'in:id,en',
            ],

            'timezone' => [
                'required',
                'string',
                'max:50',
            ],

            'theme' => [
                'required',
                'in:light,dark',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | NOTIFIKASI
    |--------------------------------------------------------------------------
    */

        $user->notify_messages =
            $request->boolean(
                'notify_messages'
            );

        $user->notify_progress =
            $request->boolean(
                'notify_progress'
            );

        $user->notify_schedule =
            $request->boolean(
                'notify_schedule'
            );

        $user->notify_documentation =
            $request->boolean(
                'notify_documentation'
            );

        $user->notify_cost =
            $request->boolean(
                'notify_cost'
            );


        /*
    |--------------------------------------------------------------------------
    | PREFERENSI APLIKASI
    |--------------------------------------------------------------------------
    */

        $user->language =
            $validated['language'];

        $user->timezone =
            $validated['timezone'];

        $user->theme =
            $validated['theme'];


        $user->save();


        return redirect()
            ->route(
                'client.settings'
            )
            ->with(
                'success',
                'Pengaturan berhasil disimpan.'
            );
    }
}
