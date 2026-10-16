@extends('layouts.admin')

@section('title', 'Detail Dokumentasi - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Detail Dokumentasi',

'subtitle' =>
'Lihat detail foto dokumentasi proyek.',

'back' =>
'Kembali',

'edit' =>
'Edit Dokumentasi',

'project' =>
'Proyek',

'category' =>
'Kategori',

'before' =>
'Sebelum',

'during' =>
'Proses',

'after' =>
'Setelah',

'photo_date' =>
'Tanggal Foto',

'uploaded_by' =>
'Diupload Oleh',

'visibility' =>
'Visibilitas',

'visible' =>
'Visible ke Client',

'internal' =>
'Internal Admin',

'description' =>
'Deskripsi',

'photo' =>
'Foto Dokumentasi',

'no_title' =>
'Tanpa Judul',

'no_description' =>
'Tidak ada deskripsi.',

],


'en' => [

'title' =>
'Documentation Detail',

'subtitle' =>
'View project documentation photo details.',

'back' =>
'Back',

'edit' =>
'Edit Documentation',

'project' =>
'Project',

'category' =>
'Category',

'before' =>
'Before',

'during' =>
'During',

'after' =>
'After',

'photo_date' =>
'Photo Date',

'uploaded_by' =>
'Uploaded By',

'visibility' =>
'Visibility',

'visible' =>
'Visible to Client',

'internal' =>
'Admin Only',

'description' =>
'Description',

'photo' =>
'Documentation Photo',

'no_title' =>
'Untitled',

'no_description' =>
'No description.',

],

];


$st =
$translations[$pageLang]
??
$translations['id'];


$categoryLabel =
match ($documentation->category) {

'before' =>
$st['before'],

'during' =>
$st['during'],

'after' =>
$st['after'],

default =>
'-',

};

@endphp



@push('styles')

<style>
    .documentation-detail-page {
        max-width: 1100px;

        margin:
            0 auto;
    }


    .documentation-detail-header {
        margin-bottom: 22px;

        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 16px;
    }


    .documentation-detail-actions {
        display: flex;

        gap: 8px;
    }


    .documentation-detail-btn {
        min-height: 40px;

        padding:
            0 15px;

        border-radius: 9px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-detail-btn.back {
        border:
            1px solid var(--border);

        background:
            var(--card-bg);

        color:
            var(--text-muted);
    }


    .documentation-detail-btn.edit {
        background:
            var(--warning);

        color: #fff;
    }


    .documentation-detail-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.35fr) minmax(300px, .65fr);

        gap: 20px;
    }


    .documentation-detail-card {
        padding: 20px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-detail-photo {
        width: 100%;

        max-height: 560px;

        object-fit: contain;

        border-radius: 12px;

        background:
            #eef3f7;
    }


    .documentation-info-title {
        margin-bottom: 18px;

        color:
            var(--text-heading);

        font-size: 18px;

        font-weight: 700;
    }


    .documentation-info-row {
        padding:
            12px 0;

        border-bottom:
            1px solid var(--border);
    }


    .documentation-info-row:last-child {
        border-bottom: none;
    }


    .documentation-info-label {
        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 10px;

        text-transform: uppercase;

        font-weight: 700;
    }


    .documentation-info-value {
        color:
            var(--text-heading);

        font-size: 13px;

        line-height: 1.5;
    }


    .documentation-category-badge {
        padding:
            6px 10px;

        border-radius: 20px;

        display: inline-flex;

        background:
            var(--primary-soft);

        color:
            var(--primary);

        font-size: 10px;

        font-weight: 700;
    }


    .documentation-visibility-badge {
        padding:
            6px 10px;

        border-radius: 20px;

        display: inline-flex;

        font-size: 10px;

        font-weight: 700;
    }


    .documentation-visibility-badge.visible {
        background:
            #dcfce7;

        color:
            #15803d;
    }


    .documentation-visibility-badge.internal {
        background:
            #fee2e2;

        color:
            #b91c1c;
    }


    .documentation-description-card {
        margin-top: 20px;

        padding: 20px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-description-title {
        margin-bottom: 10px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .documentation-description-text {
        color:
            var(--text-main);

        font-size: 12px;

        line-height: 1.7;

        white-space:
            pre-line;
    }



    @media(max-width: 850px) {

        .documentation-detail-grid {
            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 700px) {

        .documentation-detail-header {
            flex-direction:
                column;

            align-items:
                flex-start;
        }


        .documentation-detail-actions {
            width: 100%;
        }


        .documentation-detail-btn {
            flex: 1;
        }

    }
</style>

@endpush



@section('content')

<div class="documentation-detail-page">


    <div class="documentation-detail-header">

        <div>

            <div class="admin-breadcrumb">

                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>

                <span class="admin-breadcrumb-separator">
                    /
                </span>

                <a href="{{ route('admin.documentations.index') }}">
                    Dokumentasi
                </a>

                <span class="admin-breadcrumb-separator">
                    /
                </span>

                <span class="admin-breadcrumb-current">
                    {{ $st['title'] }}
                </span>

            </div>


            <h1 class="admin-page-title">

                {{
                    $documentation->title
                    ??
                    $st['no_title']
                }}

            </h1>


            <p class="admin-page-subtitle">
                {{ $st['subtitle'] }}
            </p>

        </div>


        <div class="documentation-detail-actions">

            <a
                href="{{ route('admin.documentations.index') }}"
                class="documentation-detail-btn back">
                {{ $st['back'] }}
            </a>


            <a
                href="{{ route('admin.documentations.edit', $documentation) }}"
                class="documentation-detail-btn edit">
                {{ $st['edit'] }}
            </a>

        </div>

    </div>



    <div class="documentation-detail-grid">


        {{-- PHOTO --}}

        <div class="documentation-detail-card">

            <img
                src="{{ asset('storage/' . $documentation->file_path) }}"
                alt="{{ $documentation->title ?? 'Dokumentasi Proyek' }}"
                class="documentation-detail-photo">

        </div>



        {{-- INFO --}}

        <div class="documentation-detail-card">

            <div class="documentation-info-title">
                Informasi Dokumentasi
            </div>


            <div class="documentation-info-row">

                <div class="documentation-info-label">
                    {{ $st['project'] }}
                </div>

                <div class="documentation-info-value">

                    {{
                        $documentation
                            ->project
                            ?->project_name
                        ??
                        '-'
                    }}

                </div>

            </div>


            <div class="documentation-info-row">

                <div class="documentation-info-label">
                    {{ $st['category'] }}
                </div>

                <div class="documentation-info-value">

                    <span class="documentation-category-badge">
                        {{ $categoryLabel }}
                    </span>

                </div>

            </div>


            <div class="documentation-info-row">

                <div class="documentation-info-label">
                    {{ $st['photo_date'] }}
                </div>

                <div class="documentation-info-value">

                    {{
                        optional(
                            $documentation->photo_date
                        )->format('d M Y')
                        ??
                        '-'
                    }}

                </div>

            </div>


            <div class="documentation-info-row">

                <div class="documentation-info-label">
                    {{ $st['uploaded_by'] }}
                </div>

                <div class="documentation-info-value">

                    {{
                        $documentation
                            ->uploader
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>


            <div class="documentation-info-row">

                <div class="documentation-info-label">
                    {{ $st['visibility'] }}
                </div>

                <div class="documentation-info-value">

                    @if($documentation->is_visible_to_client)

                    <span class="documentation-visibility-badge visible">
                        {{ $st['visible'] }}
                    </span>

                    @else

                    <span class="documentation-visibility-badge internal">
                        {{ $st['internal'] }}
                    </span>

                    @endif

                </div>

            </div>

        </div>


    </div>



    {{-- DESCRIPTION --}}

    <div class="documentation-description-card">

        <div class="documentation-description-title">
            {{ $st['description'] }}
        </div>


        <div class="documentation-description-text">

            {{
                $documentation->description
                ??
                $st['no_description']
            }}

        </div>

    </div>


</div>

@endsection