<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArAssetController extends Controller
{
    public function index()
    {
        $assets = ArAsset::latest()->get();

        return view(
            'admin.ar-assets.index',
            compact('assets')
        );
    }


    public function create()
    {
        return view(
            'admin.ar-assets.create'
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150'
            ],

            'asset_type' => [
                'required',
                'in:color,material,furniture'
            ],

            'category' => [
                'nullable',
                'string',
                'max:100'
            ],

            'color_code' => [
                'nullable',
                'string',
                'max:20'
            ],

            'texture' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'model_3d' => [
                'nullable',
                'file',
                'mimes:glb,gltf',
                'max:20480'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],
        ]);


        $texturePath = null;
        $modelPath = null;
        $thumbnailPath = null;


        if ($request->hasFile('texture')) {

            $texturePath = $request
                ->file('texture')
                ->store(
                    'ar/textures',
                    'public'
                );
        }


        if ($request->hasFile('model_3d')) {

            $modelPath = $request
                ->file('model_3d')
                ->store(
                    'ar/models',
                    'public'
                );
        }


        if ($request->hasFile('thumbnail')) {

            $thumbnailPath = $request
                ->file('thumbnail')
                ->store(
                    'ar/thumbnails',
                    'public'
                );
        }


        ArAsset::create([
            'name' => $validated['name'],

            'asset_type' =>
            $validated['asset_type'],

            'category' =>
            $validated['category']
                ?? null,

            'color_code' =>
            $validated['color_code']
                ?? null,

            'texture_path' =>
            $texturePath,

            'model_3d_path' =>
            $modelPath,

            'thumbnail_path' =>
            $thumbnailPath,

            'is_active' =>
            $request->boolean(
                'is_active'
            ),
        ]);


        return redirect()
            ->route(
                'admin.ar-assets.index'
            )
            ->with(
                'success',
                'AR Asset berhasil ditambahkan.'
            );
    }


    public function edit(ArAsset $arAsset)
    {
        return view(
            'admin.ar-assets.edit',
            compact('arAsset')
        );
    }


    public function update(
        Request $request,
        ArAsset $arAsset
    ) {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150'
            ],

            'asset_type' => [
                'required',
                'in:color,material,furniture'
            ],

            'category' => [
                'nullable',
                'string',
                'max:100'
            ],

            'color_code' => [
                'nullable',
                'string',
                'max:20'
            ],

            'texture' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'model_3d' => [
                'nullable',
                'file',
                'mimes:glb,gltf',
                'max:20480'
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
        ]);


        if ($request->hasFile('texture')) {

            if ($arAsset->texture_path) {

                Storage::disk('public')
                    ->delete(
                        $arAsset->texture_path
                    );
            }

            $arAsset->texture_path =
                $request
                ->file('texture')
                ->store(
                    'ar/textures',
                    'public'
                );
        }


        if ($request->hasFile('model_3d')) {

            if ($arAsset->model_3d_path) {

                Storage::disk('public')
                    ->delete(
                        $arAsset->model_3d_path
                    );
            }

            $arAsset->model_3d_path =
                $request
                ->file('model_3d')
                ->store(
                    'ar/models',
                    'public'
                );
        }


        if ($request->hasFile('thumbnail')) {

            if ($arAsset->thumbnail_path) {

                Storage::disk('public')
                    ->delete(
                        $arAsset->thumbnail_path
                    );
            }

            $arAsset->thumbnail_path =
                $request
                ->file('thumbnail')
                ->store(
                    'ar/thumbnails',
                    'public'
                );
        }


        $arAsset->name =
            $validated['name'];

        $arAsset->asset_type =
            $validated['asset_type'];

        $arAsset->category =
            $validated['category']
            ?? null;

        $arAsset->color_code =
            $validated['color_code']
            ?? null;

        $arAsset->is_active =
            $request->boolean(
                'is_active'
            );


        $arAsset->save();


        return redirect()
            ->route(
                'admin.ar-assets.index'
            )
            ->with(
                'success',
                'AR Asset berhasil diperbarui.'
            );
    }


    public function destroy(
        ArAsset $arAsset
    ) {

        if ($arAsset->texture_path) {

            Storage::disk('public')
                ->delete(
                    $arAsset->texture_path
                );
        }


        if ($arAsset->model_3d_path) {

            Storage::disk('public')
                ->delete(
                    $arAsset->model_3d_path
                );
        }


        if ($arAsset->thumbnail_path) {

            Storage::disk('public')
                ->delete(
                    $arAsset->thumbnail_path
                );
        }


        $arAsset->delete();


        return redirect()
            ->route(
                'admin.ar-assets.index'
            )
            ->with(
                'success',
                'AR Asset berhasil dihapus.'
            );
    }
}
