<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressUpdate;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->get('search');

        $projectId = $request->get('project');


        /*
        |--------------------------------------------------------------------------
        | DATA PROGRESS
        |--------------------------------------------------------------------------
        */

        $progressUpdates = ProgressUpdate::with([
            'project.client.user',
            'creator',
        ])

            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        function ($q) use ($search) {

                            $q->where(
                                'description',
                                'like',
                                '%' . $search . '%'
                            )

                                ->orWhereHas(
                                    'project',
                                    function ($project) use ($search) {

                                        $project->where(
                                            'project_name',
                                            'like',
                                            '%' . $search . '%'
                                        );
                                    }
                                );
                        }
                    );
                }
            )

            ->when(
                $projectId,
                function ($query) use ($projectId) {

                    $query->where(
                        'project_id',
                        $projectId
                    );
                }
            )

            ->orderByDesc('update_date')

            ->orderByDesc('id')

            ->paginate(10)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | DAFTAR PROJECT
        |--------------------------------------------------------------------------
        */

        $projects = Project::with(
            'client.user'
        )
            ->orderBy('project_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $averageProgress =
            Project::avg(
                'progress_percentage'
            )
            ?? 0;


        /*
         * Proyek aktif harus berdasarkan
         * status project, bukan persentase.
         */

        $activeProjects =
            Project::where(
                'status',
                'ongoing'
            )->count();


        $completedProjects =
            Project::where(
                'status',
                'completed'
            )->count();


        /*
         * Untuk sementara "Perlu Perhatian"
         * kita gunakan proyek yang ditunda.
         */

        $needsAttention =
            Project::where(
                'status',
                'paused'
            )->count();


        /*
        |--------------------------------------------------------------------------
        | DISTRIBUSI STATUS PROJECT
        |--------------------------------------------------------------------------
        */

        $totalProjects =
            Project::count();


        $completedCount =
            Project::where(
                'status',
                'completed'
            )->count();


        $runningCount =
            Project::where(
                'status',
                'ongoing'
            )->count();


        $pausedCount =
            Project::where(
                'status',
                'paused'
            )->count();


        /*
         * Status selain ongoing,
         * completed, dan paused
         * dianggap Perencanaan.
         */

        $planningCount =
            Project::whereNotIn(
                'status',
                [
                    'ongoing',
                    'completed',
                    'paused',
                ]
            )->count();


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE DISTRIBUSI
        |--------------------------------------------------------------------------
        */

        $completedPercent =
            $totalProjects > 0
            ? round(
                (
                    $completedCount
                    /
                    $totalProjects
                ) * 100
            )
            : 0;


        $runningPercent =
            $totalProjects > 0
            ? round(
                (
                    $runningCount
                    /
                    $totalProjects
                ) * 100
            )
            : 0;


        $planningPercent =
            $totalProjects > 0
            ? round(
                (
                    $planningCount
                    /
                    $totalProjects
                ) * 100
            )
            : 0;


        $pausedPercent =
            $totalProjects > 0
            ? round(
                (
                    $pausedCount
                    /
                    $totalProjects
                ) * 100
            )
            : 0;


        return view(
            'admin.progress.index',
            compact(
                'progressUpdates',
                'projects',
                'search',
                'projectId',
                'averageProgress',
                'activeProjects',
                'completedProjects',
                'needsAttention',
                'completedPercent',
                'runningPercent',
                'planningPercent',
                'pausedPercent'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.progress.create',
            compact(
                'projects'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'percentage' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:100',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'update_date' => [
                    'required',
                    'date',
                ],

                'photo' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO
        |--------------------------------------------------------------------------
        */

        $photoPath = null;


        if (
            $request->hasFile('photo')
        ) {

            $photoPath =
                $request
                ->file('photo')
                ->store(
                    'progress/photos',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PROGRESS
        |--------------------------------------------------------------------------
        */

        $progressUpdate =
            ProgressUpdate::create([

                'project_id' =>
                $validated['project_id'],

                'created_by' =>
                Auth::id(),

                'percentage' =>
                $validated['percentage'],

                'description' =>
                $validated['description']
                    ?? null,

                'update_date' =>
                $validated['update_date'],

                'photo_path' =>
                $photoPath,

            ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROGRESS PROJECT
        |--------------------------------------------------------------------------
        */

        $this->syncProjectProgress(
            $progressUpdate->project_id
        );


        return redirect()
            ->route(
                'admin.progress.index'
            )
            ->with(
                'success',
                'Progress proyek berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        ProgressUpdate $progressUpdate
    ) {
        $progressUpdate->load([
            'project.client.user',
            'creator',
        ]);


        return view(
            'admin.progress.show',
            compact(
                'progressUpdate'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        ProgressUpdate $progressUpdate
    ) {
        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.progress.edit',
            compact(
                'progressUpdate',
                'projects'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        ProgressUpdate $progressUpdate
    ) {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'percentage' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:100',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'update_date' => [
                    'required',
                    'date',
                ],

                'photo' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | PROJECT LAMA
        |--------------------------------------------------------------------------
        */

        $oldProjectId =
            $progressUpdate->project_id;


        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        $photoPath =
            $progressUpdate->photo_path;


        if (
            $request->hasFile('photo')
        ) {

            if (
                $photoPath
                &&
                Storage::disk('public')
                ->exists($photoPath)
            ) {

                Storage::disk('public')
                    ->delete($photoPath);
            }


            $photoPath =
                $request
                ->file('photo')
                ->store(
                    'progress/photos',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $progressUpdate->update([

            'project_id' =>
            $validated['project_id'],

            'percentage' =>
            $validated['percentage'],

            'description' =>
            $validated['description']
                ?? null,

            'update_date' =>
            $validated['update_date'],

            'photo_path' =>
            $photoPath,

        ]);


        /*
        |--------------------------------------------------------------------------
        | JIKA PROJECT DIPINDAHKAN
        |--------------------------------------------------------------------------
        */

        if (
            (int) $oldProjectId
            !==
            (int) $progressUpdate->project_id
        ) {

            $this->syncProjectProgress(
                $oldProjectId
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT SAAT INI
        |--------------------------------------------------------------------------
        */

        $this->syncProjectProgress(
            $progressUpdate->project_id
        );


        return redirect()
            ->route(
                'admin.progress.show',
                $progressUpdate
            )
            ->with(
                'success',
                'Progress proyek berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        ProgressUpdate $progressUpdate
    ) {
        $projectId =
            $progressUpdate->project_id;


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */

        if (
            $progressUpdate->photo_path
            &&
            Storage::disk('public')
            ->exists(
                $progressUpdate->photo_path
            )
        ) {

            Storage::disk('public')
                ->delete(
                    $progressUpdate->photo_path
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS PROGRESS
        |--------------------------------------------------------------------------
        */

        $progressUpdate->delete();


        /*
        |--------------------------------------------------------------------------
        | HITUNG ULANG PROJECT
        |--------------------------------------------------------------------------
        */

        $this->syncProjectProgress(
            $projectId
        );


        return redirect()
            ->route(
                'admin.progress.index'
            )
            ->with(
                'success',
                'Data progress berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SYNC PROJECT PROGRESS
    |--------------------------------------------------------------------------
    */

    private function syncProjectProgress(
        int $projectId
    ): void {

        $latestProgress =
            ProgressUpdate::where(
                'project_id',
                $projectId
            )
            ->orderByDesc(
                'update_date'
            )
            ->orderByDesc(
                'id'
            )
            ->first();


        Project::where(
            'id',
            $projectId
        )->update([

            'progress_percentage' =>
            $latestProgress
                ? $latestProgress->percentage
                : 0,

        ]);
    }
}
