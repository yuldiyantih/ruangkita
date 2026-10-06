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
}
