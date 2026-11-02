@extends('layouts.admin')

@section('title', 'Augmented Reality')

@section('content')

@php
$pageLang = auth()->user()->language ?? 'id';

$translations = [
'id' => [
'title' => 'Augmented Reality',
'subtitle' => 'Kelola aset AR yang digunakan pada desain proyek.',
'add_asset' => 'Tambah AR Asset',
'name' => 'Nama',
'type' => 'Jenis',
'category' => 'Kategori',
'thumbnail' => 'Thumbnail',
'model' => 'Model 3D',
'status' => 'Status',
'action' => 'Aksi',
'active' => 'Aktif',
'inactive' => 'Nonaktif',
'edit' => 'Edit',
'delete' => 'Hapus',
'empty' => 'Belum ada AR Asset.',
'delete_confirm' => 'Yakin ingin menghapus AR Asset ini?',
'no_image' => 'Tidak ada gambar',
'no_model' => 'Tidak ada model',
'view_model' => 'Lihat Model',
],

'en' => [
'title' => 'Augmented Reality',
'subtitle' => 'Manage AR assets used in project designs.',
'add_asset' => 'Add AR Asset',
'name' => 'Name',
'type' => 'Type',
'category' => 'Category',
'thumbnail' => 'Thumbnail',
'model' => '3D Model',
'status' => 'Status',
'action' => 'Action',
'active' => 'Active',
'inactive' => 'Inactive',
'edit' => 'Edit',
'delete' => 'Delete',
'empty' => 'No AR Assets available.',
'delete_confirm' => 'Are you sure you want to delete this AR Asset?',
'no_image' => 'No image',
'no_model' => 'No model',
'view_model' => 'View Model',
],
];

$t = $translations[$pageLang] ?? $translations['id'];
@endphp

<div style="padding:24px;">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:16px;
        margin-bottom:24px;
        flex-wrap:wrap;
    ">
        <div>
            <h1 style="margin:0; font-size:28px; font-weight:700;">
                {{ $t['title'] }}
            </h1>

            <p style="margin:6px 0 0; color:#6b7280;">
                {{ $t['subtitle'] }}
            </p>
        </div>

        <a
            href="{{ route('admin.ar-assets.create') }}"
            style="
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            padding:11px 18px;
            border-radius:9px;
            background:#0d8fe8;
            color:#ffffff;
            text-decoration:none;
            font-size:14px;
            font-weight:700;
            border:none;
            cursor:pointer;">
            <span style="font-size:17px; line-height:1;">+</span>
            {{ $t['add_asset'] }}
        </a>
    </div>

    @if(session('success'))
    <div style="
            margin-bottom:18px;
            padding:12px 16px;
            border-radius:10px;
            background:#dcfce7;
            color:#166534;
        ">
        {{ session('success') }}
    </div>
    @endif

    <div style="
        background:white;
        border:1px solid #e5e7eb;
        border-radius:14px;
        overflow:auto;
    ">

        <table style="
            width:100%;
            border-collapse:collapse;
            min-width:1000px;
        ">

            <thead>
                <tr style="background:#f9fafb;">

                    <th style="padding:14px; text-align:left;">
                        {{ $t['thumbnail'] }}
                    </th>

                    <th style="padding:14px; text-align:left;">
                        {{ $t['name'] }}
                    </th>

                    <th style="padding:14px; text-align:left;">
                        {{ $t['type'] }}
                    </th>

                    <th style="padding:14px; text-align:left;">
                        {{ $t['category'] }}
                    </th>

                    <th style="padding:14px; text-align:left;">
                        {{ $t['model'] }}
                    </th>

                    <th style="padding:14px; text-align:left;">
                        {{ $t['status'] }}
                    </th>

                    <th style="padding:14px; text-align:center;">
                        {{ $t['action'] }}
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($assets as $asset)

                <tr style="border-top:1px solid #e5e7eb;">

                    {{-- THUMBNAIL --}}
                    <td style="padding:14px; vertical-align:middle;">

                        @if($asset->thumbnail_path)

                        <img
                            src="{{ asset('storage/' . $asset->thumbnail_path) }}"
                            alt="{{ $asset->name }}"
                            style="
                                        width:70px;
                                        height:70px;
                                        object-fit:cover;
                                        border-radius:10px;
                                        border:1px solid #e5e7eb;
                                    ">

                        @else

                        <div style="
                                    width:70px;
                                    height:70px;
                                    border-radius:10px;
                                    background:#f3f4f6;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:11px;
                                    text-align:center;
                                    color:#6b7280;
                                ">
                            {{ $t['no_image'] }}
                        </div>

                        @endif

                    </td>

                    {{-- NAME --}}
                    <td style="
                            padding:14px;
                            vertical-align:middle;
                            font-weight:600;
                        ">
                        {{ $asset->name }}
                    </td>

                    {{-- TYPE --}}
                    <td style="
                            padding:14px;
                            vertical-align:middle;
                        ">
                        {{ ucfirst($asset->asset_type) }}
                    </td>

                    {{-- CATEGORY --}}
                    <td style="
                            padding:14px;
                            vertical-align:middle;
                        ">
                        {{ $asset->category ?? '-' }}
                    </td>

                    {{-- MODEL 3D --}}
                    <td style="
                            padding:14px;
                            vertical-align:middle;
                            min-width:190px;
                        ">

                        @if($asset->model_3d_path)

                        <div style="width:180px;">

                            <model-viewer
                                src="{{ asset('storage/' . $asset->model_3d_path) }}"
                                camera-controls
                                auto-rotate
                                shadow-intensity="1"
                                style="
                                            width:180px;
                                            height:140px;
                                            background:#f3f4f6;
                                            border-radius:10px;
                                            display:block;
                                        ">
                            </model-viewer>

                            <a
                                href="{{ asset('storage/' . $asset->model_3d_path) }}"
                                target="_blank"
                                style="
                                            display:inline-block;
                                            margin-top:6px;
                                            color:#2563eb;
                                            text-decoration:none;
                                            font-size:12px;
                                            font-weight:600;
                                        ">
                                {{ $t['view_model'] }}
                            </a>

                        </div>

                        @else

                        <span style="color:#9ca3af;">
                            {{ $t['no_model'] }}
                        </span>

                        @endif

                    </td>

                    {{-- STATUS --}}
                    <td style="
                            padding:14px;
                            vertical-align:middle;
                        ">

                        @if($asset->is_active)

                        <span style="
                                    display:inline-block;
                                    padding:5px 10px;
                                    border-radius:999px;
                                    background:#dcfce7;
                                    color:#166534;
                                    font-size:12px;
                                    font-weight:700;
                                ">
                            {{ $t['active'] }}
                        </span>

                        @else

                        <span style="
                                    display:inline-block;
                                    padding:5px 10px;
                                    border-radius:999px;
                                    background:#fee2e2;
                                    color:#991b1b;
                                    font-size:12px;
                                    font-weight:700;
                                ">
                            {{ $t['inactive'] }}
                        </span>

                        @endif

                    </td>

                    {{-- ACTION --}}
                    <td style="
                    padding:14px;
                    text-align:center;
                    vertical-align:middle;
                    white-space:nowrap;
                    ">

                        <a
                            href="{{ route('admin.ar-assets.edit', $asset) }}"
                            title="{{ $t['edit'] }}"
                            style="
                display:inline-flex;
                align-items:center;
                justify-content:center;
                width:38px;
                height:38px;
                margin-right:6px;
                border-radius:9px;
                background:#e7f3ff;
                color:#087dcc;
                text-decoration:none;
                font-size:17px;
                font-weight:700;
                border:1px solid #d6ebff;
            ">
                            ✎
                        </a>

                        <form
                            action="{{ route('admin.ar-assets.destroy', $asset) }}"
                            method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm(this.dataset.message)"
                            data-message="{{ $t['delete_confirm'] }}">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                title="{{ $t['delete'] }}"
                                style="
                                display:inline-flex;
                                align-items:center;
                                justify-content:center;
                                width:38px;
                                height:38px;
                                padding:0;
                                border-radius:9px;
                                background:#feecec;
                                color:#e53935;
                                border:1px solid #fbdada;
                                font-size:16px;
                                cursor:pointer;
                            ">
                                🗑
                            </button>
                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td
                        colspan="7"
                        style="
                                padding:40px;
                                text-align:center;
                                color:#6b7280;
                            ">
                        {{ $t['empty'] }}
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


@push('scripts')

<script
    type="module"
    src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js">
</script>

@endpush