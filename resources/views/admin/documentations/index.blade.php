@extends('layouts.admin')

@section('title', 'Dokumentasi Proyek - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Dokumentasi',

'subtitle' =>
'Kelola foto dokumentasi sebelum, proses, dan setelah pengerjaan proyek.',

'add' =>
'Tambah Dokumentasi',

'total' =>
'Total Dokumentasi',

'before' =>
'Sebelum',

'during' =>
'Proses',

'after' =>
'Setelah',

'gallery' =>
'Galeri Dokumentasi',

'search_placeholder' =>
'Cari proyek, judul atau deskripsi...',

'all_projects' =>
'Semua Proyek',

'all_categories' =>
'Semua Kategori',

'search' =>
'Cari',

'reset' =>
'Reset',

'visible' =>
'Visible ke Client',

'internal' =>
'Internal Admin',

'uploaded_by' =>
'Diupload oleh',

'no_title' =>
'Tanpa Judul',

'no_description' =>
'Tidak ada deskripsi.',

'empty' =>
'Belum ada dokumentasi proyek.',

'detail' =>
'Detail',

'edit' =>
'Edit',

'delete' =>
'Hapus',

],


'en' => [

'title' =>
'Documentation',

'subtitle' =>
'Manage project photos before, during, and after project work.',

'add' =>
'Add Documentation',

'total' =>
'Total Documentation',

'before' =>
'Before',

'during' =>
'During',

'after' =>
'After',

'gallery' =>
'Documentation Gallery',

'search_placeholder' =>
'Search project, title or description...',

'all_projects' =>
'All Projects',

'all_categories' =>
'All Categories',

'search' =>
'Search',

'reset' =>
'Reset',

'visible' =>
'Visible to Client',

'internal' =>
'Admin Only',

'uploaded_by' =>
'Uploaded by',

'no_title' =>
'Untitled',

'no_description' =>
'No description.',

'empty' =>
'No project documentation available.',

'detail' =>
'Detail',

'edit' =>
'Edit',

'delete' =>
'Delete',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];

@endphp



@push('styles')

<style>
    .documentation-page-header {
        margin-bottom: 22px;

        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 16px;
    }


    .documentation-add-btn {
        min-height: 42px;

        padding: 0 16px;

        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background:
            var(--primary);

        color: #fff;

        text-decoration: none;

        font-size: 12px;
        font-weight: 700;

        box-shadow:
            0 6px 16px rgba(8, 119, 212, .16);
    }


    .documentation-summary-grid {
        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .documentation-summary-card {
        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-summary-label {
        margin-bottom: 8px;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .documentation-summary-value {
        color:
            var(--text-heading);

        font-size: 23px;

        font-weight: 700;
    }


    .documentation-summary-value.primary {
        color:
            var(--primary);
    }


    .documentation-summary-value.warning {
        color:
            var(--warning);
    }


    .documentation-summary-value.success {
        color:
            var(--success);
    }



    /* FILTER */

    .documentation-filter-card {
        margin-bottom: 20px;

        padding: 16px 18px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        flex-wrap: wrap;
    }


    .documentation-filter-title {
        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    .documentation-filter {
        display: flex;

        gap: 8px;

        align-items: center;

        flex-wrap: wrap;
    }


    .documentation-filter input,
    .documentation-filter select {
        height: 39px;

        padding: 0 11px;

        border:
            1px solid var(--border);

        border-radius: 8px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 12px;
    }


    .documentation-filter input {
        width: 240px;
    }


    .documentation-filter select {
        width: 160px;
    }


    .documentation-filter-btn {
        height: 39px;

        padding:
            0 14px;

        border: none;

        border-radius: 8px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        text-decoration: none;

        font-size: 12px;
        font-weight: 700;
    }


    .documentation-filter-btn.search {
        background:
            var(--primary);

        color: #fff;
    }


    .documentation-filter-btn.reset {
        border:
            1px solid var(--border);

        background:
            var(--card-bg);

        color:
            var(--text-muted);
    }



    /* GALLERY */

    .documentation-gallery {
        display: grid;

        grid-template-columns:
            repeat(3,
                minmax(0, 1fr));

        gap: 18px;
    }


    .documentation-card {
        overflow: hidden;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-image-wrapper {
        position: relative;

        height: 210px;

        overflow: hidden;

        background:
            #e8eef4;
    }


    .documentation-image {
        width: 100%;
        height: 100%;

        object-fit: cover;

        display: block;
    }


    .documentation-category {
        position: absolute;

        top: 12px;
        left: 12px;

        padding:
            6px 10px;

        border-radius: 20px;

        background:
            rgba(15, 23, 42, .78);

        color: #fff;

        font-size: 10px;

        font-weight: 700;
    }


    .documentation-visibility {
        position: absolute;

        top: 12px;
        right: 12px;

        padding:
            6px 9px;

        border-radius: 20px;

        font-size: 9px;

        font-weight: 700;
    }


    .documentation-visibility.visible {
        background:
            #dcfce7;

        color:
            #15803d;
    }


    .documentation-visibility.internal {
        background:
            #fee2e2;

        color:
            #b91c1c;
    }


    .documentation-card-body {
        padding: 16px;
    }


    .documentation-project {
        margin-bottom: 5px;

        color:
            var(--primary);

        font-size: 11px;

        font-weight: 700;
    }


    .documentation-title {
        margin-bottom: 7px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .documentation-description {
        min-height: 38px;

        color:
            var(--text-muted);

        font-size: 11px;

        line-height: 1.5;
    }


    .documentation-meta {
        margin-top: 13px;

        padding-top: 12px;

        border-top:
            1px solid var(--border);

        display: flex;

        justify-content:
            space-between;

        gap: 8px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .documentation-actions {
        margin-top: 14px;

        display: grid;

        grid-template-columns:
            repeat(3,
                1fr);

        gap: 7px;
    }


    .documentation-action-btn {
        min-height: 34px;

        border: none;

        border-radius: 8px;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        text-decoration: none;

        font-size: 10px;

        font-weight: 700;
    }


    .documentation-action-btn.view {
        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .documentation-action-btn.edit {
        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .documentation-action-btn.delete {
        width: 100%;

        background:
            var(--danger-bg);

        color:
            var(--danger);
    }


    .documentation-delete-form {
        margin: 0;
    }


    .documentation-empty {
        grid-column:
            1 / -1;

        padding: 50px 20px;

        border:
            1px dashed var(--border);

        border-radius: 14px;

        color:
            var(--text-muted);

        text-align: center;

        background:
            var(--card-bg);
    }



    @media(max-width: 1100px) {

        .documentation-summary-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }


        .documentation-gallery {
            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 700px) {

        .documentation-page-header {
            flex-direction:
                column;

            align-items:
                flex-start;
        }


        .documentation-add-btn {
            width: 100%;
        }


        .documentation-summary-grid {
            grid-template-columns:
                1fr;
        }


        .documentation-gallery {
            grid-template-columns:
                1fr;
        }


        .documentation-filter {
            width: 100%;
        }


        .documentation-filter input,
        .documentation-filter select {
            width: 100%;
        }

    }
</style>

@endpush



@section('content')


<div class="documentation-page-header">

    <div>

        <div class="admin-breadcrumb">

            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <span class="admin-breadcrumb-current">
                {{ $dt['title'] }}
            </span>

        </div>


        <h1 class="admin-page-title">
            {{ $dt['title'] }}
        </h1>


        <p class="admin-page-subtitle">
            {{ $dt['subtitle'] }}
        </p>

    </div>


    <a
        href="{{ route('admin.documentations.create') }}"
        class="documentation-add-btn">
        + {{ $dt['add'] }}
    </a>

</div>



{{-- SUMMARY --}}

<div class="documentation-summary-grid">

    <div class="documentation-summary-card">

        <div class="documentation-summary-label">
            {{ $dt['total'] }}
        </div>

        <div class="documentation-summary-value primary">
            {{ $totalDocumentations }}
        </div>

    </div>


    <div class="documentation-summary-card">

        <div class="documentation-summary-label">
            {{ $dt['before'] }}
        </div>

        <div class="documentation-summary-value">
            {{ $beforeCount }}
        </div>

    </div>


    <div class="documentation-summary-card">

        <div class="documentation-summary-label">
            {{ $dt['during'] }}
        </div>

        <div class="documentation-summary-value warning">
            {{ $duringCount }}
        </div>

    </div>


    <div class="documentation-summary-card">

        <div class="documentation-summary-label">
            {{ $dt['after'] }}
        </div>

        <div class="documentation-summary-value success">
            {{ $afterCount }}
        </div>

    </div>

</div>



{{-- FILTER --}}

<div class="admin-card documentation-filter-card">

    <div class="documentation-filter-title">
        {{ $dt['gallery'] }}
    </div>


    <form
        method="GET"
        action="{{ route('admin.documentations.index') }}"
        class="documentation-filter">

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="{{ $dt['search_placeholder'] }}">


        <select name="project">

            <option value="">
                {{ $dt['all_projects'] }}
            </option>

            @foreach($projects as $project)

            <option
                value="{{ $project->id }}"
                @selected(
                (string) ($projectId ?? '' )===(string) $project->id
                )
                >
                {{ $project->project_name }}
            </option>

            @endforeach

        </select>


        <select name="category">

            <option value="">
                {{ $dt['all_categories'] }}
            </option>

            <option
                value="before"
                @selected(($category ?? '' )==='before' )>
                {{ $dt['before'] }}
            </option>

            <option
                value="during"
                @selected(($category ?? '' )==='during' )>
                {{ $dt['during'] }}
            </option>

            <option
                value="after"
                @selected(($category ?? '' )==='after' )>
                {{ $dt['after'] }}
            </option>

        </select>


        <button
            type="submit"
            class="documentation-filter-btn search">
            {{ $dt['search'] }}
        </button>


        <a
            href="{{ route('admin.documentations.index') }}"
            class="documentation-filter-btn reset">
            {{ $dt['reset'] }}
        </a>

    </form>

</div>



{{-- GALLERY --}}

<div class="documentation-gallery">


    @forelse($documentations as $documentation)

    @php

    $categoryLabel =
    match ($documentation->category) {

    'before' =>
    $dt['before'],

    'during' =>
    $dt['during'],

    'after' =>
    $dt['after'],

    default =>
    '-',

    };

    @endphp


    <div class="documentation-card">


        <div class="documentation-image-wrapper">

            <img
                src="{{ asset('storage/' . $documentation->file_path) }}"
                alt="{{ $documentation->title ?? 'Dokumentasi Proyek' }}"
                class="documentation-image">


            <div class="documentation-category">
                {{ $categoryLabel }}
            </div>


            @if($documentation->is_visible_to_client)

            <div class="documentation-visibility visible">
                {{ $dt['visible'] }}
            </div>

            @else

            <div class="documentation-visibility internal">
                {{ $dt['internal'] }}
            </div>

            @endif

        </div>



        <div class="documentation-card-body">


            <div class="documentation-project">

                {{
                        $documentation
                            ->project
                            ?->project_name
                        ??
                        '-'
                    }}

            </div>


            <div class="documentation-title">

                {{
                        $documentation->title
                        ??
                        $dt['no_title']
                    }}

            </div>


            <div class="documentation-description">

                {{
                        \Illuminate\Support\Str::limit(
                            $documentation->description
                            ??
                            $dt['no_description'],
                            100
                        )
                    }}

            </div>


            <div class="documentation-meta">

                <span>

                    {{
                            optional(
                                $documentation->photo_date
                            )->format('d M Y')
                            ??
                            '-'
                        }}

                </span>


                <span>

                    {{ $dt['uploaded_by'] }}:

                    {{
                            $documentation
                                ->uploader
                                ?->name
                            ??
                            '-'
                        }}

                </span>

            </div>



            <div class="documentation-actions">


                <a
                    href="{{ route('admin.documentations.show', $documentation) }}"
                    class="documentation-action-btn view">
                    {{ $dt['detail'] }}
                </a>


                <a
                    href="{{ route('admin.documentations.edit', $documentation) }}"
                    class="documentation-action-btn edit">
                    {{ $dt['edit'] }}
                </a>


                <form
                    method="POST"
                    action="{{ route('admin.documentations.destroy', $documentation) }}"
                    class="documentation-delete-form">

                    @csrf
                    @method('DELETE')


                    <button
                        type="submit"
                        class="documentation-action-btn delete">
                        {{ $dt['delete'] }}
                    </button>

                </form>


            </div>


        </div>


    </div>


    @empty

    <div class="documentation-empty">

        {{ $dt['empty'] }}

    </div>

    @endforelse


</div>



@if($documentations->hasPages())

<div style="margin-top:20px;">

    {{ $documentations->links() }}

</div>

@endif


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            document
                .querySelectorAll(
                    '.documentation-delete-form'
                )
                .forEach(
                    function(form) {

                        form.addEventListener(
                            'submit',
                            function(event) {

                                const confirmed =
                                    confirm(
                                        'Yakin ingin menghapus dokumentasi ini?'
                                    );


                                if (!confirmed) {

                                    event.preventDefault();

                                }

                            }
                        );

                    }
                );

        }
    );
</script>

@endpush