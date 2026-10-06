<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

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

        return view(
            'client.projects.progress',
            compact('project')
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
    | Semua proyek milik client
    |--------------------------------------------------------------------------
    */

        $projects = $client->projects()
            ->latest()
            ->get();


        /*
    |--------------------------------------------------------------------------
    | Tentukan proyek aktif
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
    | Load dokumentasi proyek terpilih
    |--------------------------------------------------------------------------
    */

        if ($selectedProject) {

            $selectedProject->load([

                'areas' => function ($query) {

                    $query->orderBy(
                        'area_name'
                    );
                },


                'areas.documentations' => function ($query) {

                    $query
                        ->where(
                            'is_visible_to_client',
                            true
                        )
                        ->orderBy(
                            'photo_date',
                            'asc'
                        )
                        ->orderBy(
                            'created_at',
                            'asc'
                        );
                },


                'documentations' => function ($query) {

                    $query
                        ->where(
                            'is_visible_to_client',
                            true
                        )
                        ->with(
                            'projectArea'
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
    | Statistik
    |--------------------------------------------------------------------------
    */

        $documentationStats = [

            'total' => 0,

            'photo' => 0,

            'video' => 0,

            'document' => 0,

        ];


        if ($selectedProject) {

            $documents =
                $selectedProject
                ->documentations;


            $documentationStats['total'] =
                $documents->count();


            $documentationStats['photo'] =
                $documents
                ->where(
                    'media_type',
                    'photo'
                )
                ->count();


            $documentationStats['video'] =
                $documents
                ->where(
                    'media_type',
                    'video'
                )
                ->count();


            $documentationStats['document'] =
                $documents
                ->where(
                    'media_type',
                    'document'
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
}
