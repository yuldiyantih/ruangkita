<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search =
            $request->get('search');

        $projectId =
            $request->get('project');

        $category =
            $request->get('category');


        /*
        |--------------------------------------------------------------------------
        | DATA DOCUMENTATION
        |--------------------------------------------------------------------------
        */

        $documentations =
            Documentation::with([
                'project.client.user',
                'uploader',
            ])

            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        function ($q) use ($search) {

                            $q->where(
                                'title',
                                'like',
                                '%' . $search . '%'
                            )

                                ->orWhere(
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

            ->when(
                $category,
                function ($query) use ($category) {

                    $query->where(
                        'category',
                        $category
                    );
                }
            )

            ->orderByDesc('photo_date')

            ->orderByDesc('id')

            ->paginate(12)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | PROJECT
        |--------------------------------------------------------------------------
        */

        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalDocumentations =
            Documentation::count();


        $beforeCount =
            Documentation::where(
                'category',
                'before'
            )->count();


        $duringCount =
            Documentation::where(
                'category',
                'during'
            )->count();


        $afterCount =
            Documentation::where(
                'category',
                'after'
            )->count();


        return view(
            'admin.documentations.index',
            compact(
                'documentations',
                'projects',
                'search',
                'projectId',
                'category',
                'totalDocumentations',
                'beforeCount',
                'duringCount',
                'afterCount'
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
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.documentations.create',
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

                'category' => [
                    'required',
                    'in:before,during,after',
                ],

                'title' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'photo_date' => [
                    'nullable',
                    'date',
                ],

                'file' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FILE
        |--------------------------------------------------------------------------
        */

        $filePath =
            $request
            ->file('file')
            ->store(
                'documentations',
                'public'
            );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        Documentation::create([

            'project_id' =>
            $validated['project_id'],

            'uploaded_by' =>
            Auth::id(),

            'category' =>
            $validated['category'],

            'title' =>
            $validated['title']
                ?? null,

            'description' =>
            $validated['description']
                ?? null,

            'file_path' =>
            $filePath,

            'photo_date' =>
            $validated['photo_date']
                ?? null,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),

        ]);


        return redirect()
            ->route(
                'admin.documentations.index'
            )
            ->with(
                'success',
                'Dokumentasi berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        Documentation $documentation
    ) {
        $documentation->load([
            'project.client.user',
            'uploader',
        ]);


        return view(
            'admin.documentations.show',
            compact(
                'documentation'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Documentation $documentation
    ) {
        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.documentations.edit',
            compact(
                'documentation',
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
        Documentation $documentation
    ) {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'category' => [
                    'required',
                    'in:before,during,after',
                ],

                'title' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'photo_date' => [
                    'nullable',
                    'date',
                ],

                'file' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | FILE LAMA
        |--------------------------------------------------------------------------
        */

        $filePath =
            $documentation->file_path;


        /*
        |--------------------------------------------------------------------------
        | JIKA GANTI FOTO
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('file')
        ) {

            if (
                $filePath
                &&
                Storage::disk('public')
                ->exists($filePath)
            ) {

                Storage::disk('public')
                    ->delete($filePath);
            }


            $filePath =
                $request
                ->file('file')
                ->store(
                    'documentations',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $documentation->update([

            'project_id' =>
            $validated['project_id'],

            'category' =>
            $validated['category'],

            'title' =>
            $validated['title']
                ?? null,

            'description' =>
            $validated['description']
                ?? null,

            'photo_date' =>
            $validated['photo_date']
                ?? null,

            'file_path' =>
            $filePath,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),

        ]);


        return redirect()
            ->route(
                'admin.documentations.show',
                $documentation
            )
            ->with(
                'success',
                'Dokumentasi berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Documentation $documentation
    ) {
        if (
            $documentation->file_path
            &&
            Storage::disk('public')
            ->exists(
                $documentation->file_path
            )
        ) {

            Storage::disk('public')
                ->delete(
                    $documentation->file_path
                );
        }


        $documentation->delete();


        return redirect()
            ->route(
                'admin.documentations.index'
            )
            ->with(
                'success',
                'Dokumentasi berhasil dihapus.'
            );
    }
}
