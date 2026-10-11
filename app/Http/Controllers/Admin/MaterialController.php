<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $search =
            $request->get('search');

        $projectId =
            $request->get('project');

        $supplier =
            $request->get('supplier');

        $visibility =
            $request->get('visibility');


        $materials =
            Material::with([
                'project.client.user',
            ])
            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where(
                        'material_name',
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
                $supplier,
                function ($query) use ($supplier) {
                    $query->where(
                        'supplier',
                        $supplier
                    );
                }
            )
            ->when(
                $visibility !== null
                    && $visibility !== '',
                function ($query) use ($visibility) {
                    $query->where(
                        'is_visible_to_client',
                        (bool) $visibility
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        $suppliers =
            Material::whereNotNull('supplier')
            ->where('supplier', '!=', '')
            ->select('supplier')
            ->distinct()
            ->orderBy('supplier')
            ->pluck('supplier');


        $totalMaterials =
            Material::count();


        $totalMaterialValue =
            Material::sum('total_price');


        $visibleMaterials =
            Material::where(
                'is_visible_to_client',
                true
            )->count();


        $hiddenMaterials =
            Material::where(
                'is_visible_to_client',
                false
            )->count();


        return view(
            'admin.materials.index',
            compact(
                'materials',
                'projects',
                'suppliers',
                'totalMaterials',
                'totalMaterialValue',
                'visibleMaterials',
                'hiddenMaterials',
                'search',
                'projectId',
                'supplier',
                'visibility'
            )
        );
    }


    public function create()
    {
        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.materials.create',
            compact('projects')
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

                'material_name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'quantity' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'unit' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'unit_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'supplier' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'purchase_date' => [
                    'nullable',
                    'date',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],
            ]);


        $quantity =
            (float) $validated['quantity'];

        $unitPrice =
            (float) $validated['unit_price'];

        $totalPrice =
            $quantity * $unitPrice;


        Material::create([
            'project_id' =>
            $validated['project_id'],

            'material_name' =>
            $validated['material_name'],

            'quantity' =>
            $quantity,

            'unit' =>
            $validated['unit']
                ?? null,

            'unit_price' =>
            $unitPrice,

            'total_price' =>
            $totalPrice,

            'supplier' =>
            $validated['supplier']
                ?? null,

            'purchase_date' =>
            $validated['purchase_date']
                ?? null,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),
        ]);


        return redirect()
            ->route(
                'admin.materials.index'
            )
            ->with(
                'success',
                'Material berhasil ditambahkan.'
            );
    }


    public function show(Material $material)
    {
        $material->load([
            'project.client.user',
        ]);


        return view(
            'admin.materials.show',
            compact('material')
        );
    }


    public function edit(Material $material)
    {
        $projects =
            Project::with('client.user')
            ->orderBy('project_name')
            ->get();


        return view(
            'admin.materials.edit',
            compact(
                'material',
                'projects'
            )
        );
    }


    public function update(
        Request $request,
        Material $material
    ) {
        $validated =
            $request->validate([
                'project_id' => [
                    'required',
                    'exists:projects,id',
                ],

                'material_name' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'quantity' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'unit' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'unit_price' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'supplier' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'purchase_date' => [
                    'nullable',
                    'date',
                ],

                'is_visible_to_client' => [
                    'nullable',
                    'boolean',
                ],
            ]);


        $quantity =
            (float) $validated['quantity'];

        $unitPrice =
            (float) $validated['unit_price'];

        $totalPrice =
            $quantity * $unitPrice;


        $material->update([
            'project_id' =>
            $validated['project_id'],

            'material_name' =>
            $validated['material_name'],

            'quantity' =>
            $quantity,

            'unit' =>
            $validated['unit']
                ?? null,

            'unit_price' =>
            $unitPrice,

            'total_price' =>
            $totalPrice,

            'supplier' =>
            $validated['supplier']
                ?? null,

            'purchase_date' =>
            $validated['purchase_date']
                ?? null,

            'is_visible_to_client' =>
            $request->boolean(
                'is_visible_to_client'
            ),
        ]);


        return redirect()
            ->route(
                'admin.materials.show',
                $material
            )
            ->with(
                'success',
                'Material berhasil diperbarui.'
            );
    }
}
