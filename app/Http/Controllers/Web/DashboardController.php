<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Expense;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::user();

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'is_active' => $user->is_active,
        ];

        if ($user->role !== 'admin') {
            return redirect()
                ->route('client.dashboard');
        }

        // kode di bawahnya tetap


        #/----------------------/
        $totalProjects =
            Project::count();

        $ongoingProjects =
            Project::where(
                'status',
                'ongoing'
            )->count();

        $completedProjects =
            Project::where(
                'status',
                'completed'
            )->count();

        $totalExpenses =
            Expense::sum('amount');

        $latestProjects =
            Project::with('client.user')
            ->latest()
            ->take(5)
            ->get();

        $upcomingSchedules =
            Schedule::with('project')
            ->whereDate(
                'start_date',
                '>=',
                now()->toDateString()
            )
            ->orderBy('start_date')
            ->take(5)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalProjects',
                'ongoingProjects',
                'completedProjects',
                'totalExpenses',
                'latestProjects',
                'upcomingSchedules'
            )
        );
    }


    public function client()
    {
        $user = Auth::user();

        if ($user->role !== 'client') {
            return redirect()
                ->route('admin.dashboard');
        }

        $client = $user->client;

        $projects = $client
            ? $client
            ->projects()
            ->latest()
            ->get()
            : collect();

        return view(
            'client.dashboard',
            compact(
                'user',
                'projects'
            )
        );
    }
}
