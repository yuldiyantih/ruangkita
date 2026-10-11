<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $search =
            $request->get('search');

        $projectId =
            $request->get('project');

        $status =
            $request->get('status');


        $works =
            Work::with([
                'project.client.user'
            ])
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        'work_name',
                        'like',
                        '%' . $search . '%'
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
                $status,
                function ($query) use ($status) {

                    $query->where(
                        'status',
                        $status
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy(
                'project_name'
            )
            ->get();


        $totalWorks =
            Work::count();


        $plannedWorks =
            Work::where(
                'status',
                'planned'
            )->count();


        $ongoingWorks =
            Work::where(
                'status',
                'ongoing'
            )->count();


        $completedWorks =
            Work::where(
                'status',
                'completed'
            )->count();


        return view(
            'admin.works.index',
            compact(
                'works',
                'projects',
                'totalWorks',
                'plannedWorks',
                'ongoingWorks',
                'completedWorks',
                'search',
                'projectId',
                'status'
            )
        );
    }



    public function create()
    {
        $projects =
            Project::with(
                'client.user'
            )
            ->orderBy(
                'project_name'
            )
            ->get();


        return view(
            'admin.works.create',
            compact(
                'projects'
            )
        );
    }



    public function store(Request $request)
    {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'work_name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'method_type' => [
                    'required',
                    'in:daily,contract',
                ],

                'volume' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'unit' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'unit_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'duration_days' => [
                    'nullable',
                    'integer',
                    'min:1',
                ],

                'status' => [
                    'required',
                    'in:planned,ongoing,completed,cancelled',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],

            ]);


        $volume =
            (float) (
                $validated['volume']
                ??
                0
            );


        $unitPrice =
            (float) (
                $validated['unit_price']
                ??
                0
            );


        $totalCost =
            $volume * $unitPrice;


        Work::create([

            'project_id' =>
            $validated['project_id'],

            'work_name' =>
            $validated['work_name'],

            'method_type' =>
            $validated['method_type'],

            'volume' =>
            $validated['volume']
                ??
                null,

            'unit' =>
            $validated['unit']
                ??
                null,

            'unit_price' =>
            $unitPrice,

            'duration_days' =>
            $validated['duration_days']
                ??
                null,

            'total_cost' =>
            $totalCost,

            'status' =>
            $validated['status'],

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),

        ]);


        return redirect()
            ->route(
                'admin.works.index'
            )
            ->with(
                'success',
                'Pekerjaan berhasil ditambahkan.'
            );
    }
    public function show(Work $work)
    {
        $work->load([
            'project.client.user',
            'schedules',
        ]);

        return view(
            'admin.works.show',
            compact('work')
        );
    }



    public function edit(Work $work)
    {
        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();

        return view(
            'admin.works.edit',
            compact(
                'work',
                'projects'
            )
        );
    }



    public function update(
        Request $request,
        Work $work
    ) {
        $validated =
            $request->validate([

                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'work_name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'method_type' => [
                    'required',
                    'in:daily,contract',
                ],

                'volume' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'unit' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'unit_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'duration_days' => [
                    'nullable',
                    'integer',
                    'min:1',
                ],

                'status' => [
                    'required',
                    'in:planned,ongoing,completed,cancelled',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],

            ]);


        $volume =
            (float) (
                $validated['volume']
                ??
                0
            );


        $unitPrice =
            (float) (
                $validated['unit_price']
                ??
                0
            );


        $totalCost =
            $volume
            *
            $unitPrice;


        $work->update([

            'project_id' =>
            $validated['project_id'],

            'work_name' =>
            $validated['work_name'],

            'method_type' =>
            $validated['method_type'],

            'volume' =>
            $validated['volume']
                ??
                null,

            'unit' =>
            $validated['unit']
                ??
                null,

            'unit_price' =>
            $unitPrice,

            'duration_days' =>
            $validated['duration_days']
                ??
                null,

            'total_cost' =>
            $totalCost,

            'status' =>
            $validated['status'],

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),

        ]);


        return redirect()
            ->route(
                'admin.works.show',
                $work
            )
            ->with(
                'success',
                'Data pekerjaan berhasil diperbarui.'
            );
    }
}
