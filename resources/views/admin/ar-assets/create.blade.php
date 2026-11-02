@extends('layouts.admin')

@section('title', 'Tambah AR Asset')

@section('content')

@php
$pageLang = auth()->user()->language ?? 'id';

$translations = [
'id' => [
'title' => 'Tambah AR Asset',
'subtitle' => 'Tambahkan aset baru untuk digunakan pada fitur Augmented Reality.',
'name' => 'Nama Asset',
'type' => 'Jenis Asset',
'category' => 'Kategori',
'color_code' => 'Kode Warna',
'texture' => 'Texture',
'model_3d' => 'Model 3D',
'thumbnail' => 'Thumbnail',
'active' => 'Aktifkan Asset',
'save' => 'Simpan Asset',
'cancel' => 'Batal',
'choose_type' => 'Pilih jenis asset',
'color' => 'Warna',
'material' => 'Material',
'furniture' => 'Furniture',
'optional' => 'Opsional',
'model_help' => 'Format model: GLB atau GLTF. Maksimal 20 MB.',
'image_help' => 'Format gambar: JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.',
],

'en' => [
'title' => 'Add AR Asset',
'subtitle' => 'Add a new asset to be used in the Augmented Reality feature.',
'name' => 'Asset Name',
'type' => 'Asset Type',
'category' => 'Category',
'color_code' => 'Color Code',
'texture' => 'Texture',
'model_3d' => '3D Model',
'thumbnail' => 'Thumbnail',
'active' => 'Activate Asset',
'save' => 'Save Asset',
'cancel' => 'Cancel',
'choose_type' => 'Select asset type',
'color' => 'Color',
'material' => 'Material',
'furniture' => 'Furniture',
'optional' => 'Optional',
'model_help' => 'Model format: GLB or GLTF. Maximum 20 MB.',
'image_help' => 'Image format: JPG, JPEG, PNG, or WEBP. Maximum 5 MB.',
],
];

$t = $translations[$pageLang] ?? $translations['id'];
@endphp

<div style="padding:24px; max-width:900px; margin:auto;">

    <div style="margin-bottom:24px;">
        <h1 style="margin:0; font-size:28px; font-weight:700;">
            {{ $t['title'] }}
        </h1>

        <p style="margin:6px 0 0; color:#6b7280;">
            {{ $t['subtitle'] }}
        </p>
    </div>

    @if($errors->any())
    <div style="
            margin-bottom:20px;
            padding:16px;
            border-radius:10px;
            background:#fee2e2;
            color:#991b1b;
        ">
        <ul style="margin:0; padding-left:20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form
        action="{{ route('admin.ar-assets.store') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <div style="
            background:white;
            border:1px solid #e5e7eb;
            border-radius:14px;
            padding:24px;
        ">

            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['name'] }}
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    style="
                        width:100%;
                        padding:10px 12px;
                        border:1px solid #d1d5db;
                        border-radius:9px;
                    ">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['type'] }}
                </label>

                <select
                    name="asset_type"
                    id="asset_type"
                    required
                    style="
                        width:100%;
                        padding:10px 12px;
                        border:1px solid #d1d5db;
                        border-radius:9px;
                    ">
                    <option value="">
                        {{ $t['choose_type'] }}
                    </option>

                    <option value="color" {{ old('asset_type') === 'color' ? 'selected' : '' }}>
                        {{ $t['color'] }}
                    </option>

                    <option value="material" {{ old('asset_type') === 'material' ? 'selected' : '' }}>
                        {{ $t['material'] }}
                    </option>

                    <option value="furniture" {{ old('asset_type') === 'furniture' ? 'selected' : '' }}>
                        {{ $t['furniture'] }}
                    </option>
                </select>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['category'] }}
                    <span style="color:#9ca3af; font-weight:400;">
                        ({{ $t['optional'] }})
                    </span>
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category') }}"
                    placeholder="Living Room, Wall, Floor, Chair..."
                    style="
                        width:100%;
                        padding:10px 12px;
                        border:1px solid #d1d5db;
                        border-radius:9px;
                    ">
            </div>

            <div
                id="color_field"
                style="margin-bottom:18px; display:none;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['color_code'] }}
                </label>

                <div style="display:flex; gap:10px;">
                    <input
                        type="color"
                        id="color_picker"
                        value="{{ old('color_code', '#000000') }}"
                        style="
                            width:60px;
                            height:42px;
                            border:1px solid #d1d5db;
                            border-radius:9px;
                            cursor:pointer;
                        ">

                    <input
                        type="text"
                        name="color_code"
                        id="color_code"
                        value="{{ old('color_code') }}"
                        placeholder="#FFFFFF"
                        style="
                            flex:1;
                            padding:10px 12px;
                            border:1px solid #d1d5db;
                            border-radius:9px;
                        ">
                </div>
            </div>

            <div
                id="texture_field"
                style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['texture'] }}
                </label>

                <input
                    type="file"
                    name="texture"
                    accept=".jpg,.jpeg,.png,.webp">

                <div style="margin-top:6px; color:#6b7280; font-size:12px;">
                    {{ $t['image_help'] }}
                </div>
            </div>

            <div
                id="model_field"
                style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['model_3d'] }}
                </label>

                <input
                    type="file"
                    name="model_3d"
                    accept=".glb,.gltf">

                <div style="margin-top:6px; color:#6b7280; font-size:12px;">
                    {{ $t['model_help'] }}
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; margin-bottom:7px; font-weight:600;">
                    {{ $t['thumbnail'] }}
                </label>

                <input
                    type="file"
                    name="thumbnail"
                    accept=".jpg,.jpeg,.png,.webp">

                <div style="margin-top:6px; color:#6b7280; font-size:12px;">
                    {{ $t['image_help'] }}
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="
                    display:flex;
                    align-items:center;
                    gap:8px;
                    font-weight:600;
                    cursor:pointer;
                ">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}>

                    {{ $t['active'] }}
                </label>
            </div>

            <div style="
                display:flex;
                gap:10px;
                justify-content:flex-end;
                flex-wrap:wrap;
            ">

                <a
                    href="{{ route('admin.ar-assets.index') }}"
                    style="
                        padding:10px 16px;
                        border-radius:9px;
                        border:1px solid #d1d5db;
                        color:#374151;
                        text-decoration:none;
                        font-weight:600;
                    ">
                    {{ $t['cancel'] }}
                </a>

                <button
                    type="submit"
                    style="
                        padding:10px 18px;
                        border:none;
                        border-radius:9px;
                        background:#111827;
                        color:white;
                        font-weight:600;
                        cursor:pointer;
                    ">
                    {{ $t['save'] }}
                </button>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const assetType = document.getElementById('asset_type');
        const colorField = document.getElementById('color_field');
        const textureField = document.getElementById('texture_field');
        const modelField = document.getElementById('model_field');

        const colorPicker = document.getElementById('color_picker');
        const colorCode = document.getElementById('color_code');

        function updateFields() {
            const value = assetType.value;

            colorField.style.display =
                value === 'color' ? 'block' : 'none';

            textureField.style.display =
                value === 'material' ? 'block' : 'none';

            modelField.style.display =
                value === 'furniture' ? 'block' : 'none';
        }

        assetType.addEventListener('change', updateFields);

        colorPicker.addEventListener('input', function() {
            colorCode.value = colorPicker.value;
        });

        updateFields();

    });
</script>
@endpush