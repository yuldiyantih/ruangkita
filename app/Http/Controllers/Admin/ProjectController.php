<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $projects = Project::with([
            'client.user'
        ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'project_name',
                        'like',
                        '%' . $search . '%'
                    )
                        ->orWhere(
                            'location',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhereHas(
                            'client.user',
                            function ($userQuery) use ($search) {

                                $userQuery->where(
                                    'name',
                                    'like',
                                    '%' . $search . '%'
                                );
                            }
                        );
                });
            })
            ->when($status, function ($query) use ($status) {

                $query->where(
                    'status',
                    $status
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


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


        $planningProjects =
            Project::where(
                'status',
                'planning'
            )->count();


        return view(
            'admin.projects.index',
            compact(
                'projects',
                'totalProjects',
                'ongoingProjects',
                'completedProjects',
                'planningProjects',
                'search',
                'status'
            )
        );
    }



    public function create()
    {
        $clients =
            Client::with('user')
            ->whereHas(
                'user',
                function ($query) {

                    $query->where(
                        'is_active',
                        true
                    );
                }
            )
            ->get();


        return view(
            'admin.projects.create',
            compact(
                'clients'
            )
        );
    }



    public function store(Request $request)
    {
        $validated =
            $request->validate([

                'client_id' => [
                    'required',
                    'exists:clients,id',
                ],

                'project_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'project_type' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'location' => [
                    'required',
                    'string',
                    'max:500',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'start_date' => [
                    'nullable',
                    'date',
                ],

                'target_end_date' => [
                    'nullable',
                    'date',
                    'after_or_equal:start_date',
                ],

                'status' => [
                    'required',
                    'in:planning,ongoing,completed,paused',
                ],

                'progress_percentage' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:100',
                ],

                'budget_total' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'cover_image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:3072',
                ],

            ]);


        $coverImage = null;


        if ($request->hasFile('cover_image')) {

            $coverImage =
                $request
                ->file('cover_image')
                ->store(
                    'projects/covers',
                    'public'
                );
        }


        Project::create([

            'client_id' =>
            $validated['client_id'],

            'admin_id' =>
            Auth::id(),

            'project_name' =>
            $validated['project_name'],

            'project_type' =>
            $validated['project_type']
                ??
                null,

            'location' =>
            $validated['location'],

            'description' =>
            $validated['description']
                ??
                null,

            'start_date' =>
            $validated['start_date']
                ??
                null,

            'target_end_date' =>
            $validated['target_end_date']
                ??
                null,

            'status' =>
            $validated['status'],

            'progress_percentage' =>
            $validated['progress_percentage']
                ??
                0,

            'budget_total' =>
            $validated['budget_total']
                ??
                0,

            'cover_image' =>
            $coverImage,

        ]);


        return redirect()
            ->route(
                'admin.projects.index'
            )
            ->with(
                'success',
                'Proyek berhasil ditambahkan.'
            );
    }

    public function show(Project $project)
    {
        $project->load([
            'client.user',
            'works',
            'schedules',
            'progressUpdates',
            'documentations',
        ]);


        return view(
            'admin.projects.show',
            compact(
                'project'
            )
        );
    }
    public function edit(Project $project)
    {
        $clients =
            Client::with('user')
            ->whereHas(
                'user',
                function ($query) {

                    $query->where(
                        'is_active',
                        true
                    );
                }
            )
            ->get();


        return view(
            'admin.projects.edit',
            compact(
                'project',
                'clients'
            )
        );
    }



    public function update(
        Request $request,
        Project $project
    ) {
        $validated =
            $request->validate([

                'client_id' => [
                    'required',
                    'exists:clients,id',
                ],

                'project_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'project_type' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'location' => [
                    'required',
                    'string',
                    'max:500',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'start_date' => [
                    'nullable',
                    'date',
                ],

                'target_end_date' => [
                    'nullable',
                    'date',
                    'after_or_equal:start_date',
                ],

                'status' => [
                    'required',
                    'in:planning,ongoing,completed,paused',
                ],

                'progress_percentage' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:100',
                ],

                'budget_total' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'cover_image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:3072',
                ],

            ]);


        $coverImage =
            $project->cover_image;


        if ($request->hasFile('cover_image')) {


            if (
                $coverImage
                &&
                Storage::disk('public')
                ->exists($coverImage)
            ) {

                Storage::disk('public')
                    ->delete($coverImage);
            }


            $coverImage =
                $request
                ->file('cover_image')
                ->store(
                    'projects/covers',
                    'public'
                );
        }


        $project->update([

            'client_id' =>
            $validated['client_id'],

            'project_name' =>
            $validated['project_name'],

            'project_type' =>
            $validated['project_type']
                ??
                null,

            'location' =>
            $validated['location'],

            'description' =>
            $validated['description']
                ??
                null,

            'start_date' =>
            $validated['start_date']
                ??
                null,

            'target_end_date' =>
            $validated['target_end_date']
                ??
                null,

            'status' =>
            $validated['status'],

            'progress_percentage' =>
            $validated['progress_percentage']
                ??
                0,

            'budget_total' =>
            $validated['budget_total']
                ??
                0,

            'cover_image' =>
            $coverImage,

        ]);


        return redirect()
            ->route(
                'admin.projects.show',
                $project
            )
            ->with(
                'success',
                'Data proyek berhasil diperbarui.'
            );
    }
}
