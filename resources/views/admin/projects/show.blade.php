@extends('layouts.admin')


@section(
'title',
'Detail Proyek - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'projects' =>
'Data Proyek',

'detail_project' =>
'Detail Proyek',

'subtitle' =>
'Informasi lengkap dan pengelolaan proyek renovasi.',

'edit_project' =>
'Edit Proyek',

'client' =>
'Client',

'location' =>
'Lokasi',

'project_type' =>
'Jenis Proyek',

'start_date' =>
'Tanggal Mulai',

'target_date' =>
'Target Selesai',

'budget' =>
'Anggaran',

'progress' =>
'Progress',

'status' =>
'Status',

'description' =>
'Deskripsi',

'planning' =>
'Perencanaan',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'paused' =>
'Ditunda',

'overview' =>
'Ringkasan',

'works' =>
'Pekerjaan',

'schedule' =>
'Jadwal',

'progress_tab' =>
'Progress',

'documentation' =>
'Dokumentasi',

'cost' =>
'Biaya',

'total_works' =>
'Total Pekerjaan',

'total_schedule' =>
'Total Jadwal',

'progress_updates' =>
'Update Progress',

'total_documentation' =>
'Dokumentasi',

'project_information' =>
'Informasi Proyek',

'no_description' =>
'Belum ada deskripsi proyek.',

'cover_empty' =>
'Belum ada foto cover proyek.',

'module_pending' =>
'Modul ini akan kita hubungkan setelah halaman terkait dibuat.',

],


'en' => [

'projects' =>
'Projects',

'detail_project' =>
'Project Detail',

'subtitle' =>
'Complete information and renovation project management.',

'edit_project' =>
'Edit Project',

'client' =>
'Client',

'location' =>
'Location',

'project_type' =>
'Project Type',

'start_date' =>
'Start Date',

'target_date' =>
'Target Completion',

'budget' =>
'Budget',

'progress' =>
'Progress',

'status' =>
'Status',

'description' =>
'Description',

'planning' =>
'Planning',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'paused' =>
'Paused',

'overview' =>
'Overview',

'works' =>
'Works',

'schedule' =>
'Schedule',

'progress_tab' =>
'Progress',

'documentation' =>
'Documentation',

'cost' =>
'Costs',

'total_works' =>
'Total Works',

'total_schedule' =>
'Total Schedules',

'progress_updates' =>
'Progress Updates',

'total_documentation' =>
'Documentation',

'project_information' =>
'Project Information',

'no_description' =>
'No project description available.',

'cover_empty' =>
'No project cover image available.',

'module_pending' =>
'This module will be connected after the related page is created.',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];


$projectStatus =
$project->status
??
'planning';


$projectStatusLabel =
match ($projectStatus) {

'ongoing'
=>
$dt['ongoing'],

'completed'
=>
$dt['completed'],

'paused'
=>
$dt['paused'],

default
=>
$dt['planning'],

};


$projectStatusClass =
match ($projectStatus) {

'ongoing'
=>
'admin-badge-success',

'completed'
=>
'admin-badge-primary',

'paused'
=>
'admin-badge-danger',

default
=>
'admin-badge-warning',

};

@endphp


@push('styles')

<style>
    /* =====================================================
       HEADER
    ===================================================== */

    .project-detail-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content:
            space-between;

        gap: 16px;
    }


    /* =====================================================
       HERO PROJECT
    ===================================================== */

    .project-hero {

        margin-bottom: 18px;

        padding: 22px;

        display: grid;

        grid-template-columns:
            180px minmax(0, 1fr) auto;

        gap: 22px;

        align-items: center;
    }


    .project-cover {

        width: 180px;
        height: 120px;

        overflow: hidden;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .project-cover img {

        width: 100%;
        height: 100%;

        object-fit: cover;
    }


    .project-hero-name {

        margin-bottom: 8px;

        color:
            var(--text-heading);

        font-size: 23px;

        font-weight: 700;
    }


    .project-hero-meta {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 14px;
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    .project-progress-box {

        min-width: 220px;
    }


    .project-progress-header {

        margin-bottom: 8px;

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 10px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .project-progress-header strong {

        color:
            var(--text-heading);

        font-size: 17px;
    }


    .project-progress-track {

        height: 9px;

        overflow: hidden;

        border-radius: 50px;

        background:
            var(--border);
    }


    .project-progress-fill {

        height: 100%;

        width: 0;

        border-radius: 50px;

        background:
            linear-gradient(90deg,
                var(--primary),
                var(--primary-light));

        transition:
            width .4s ease;
    }


    /* =====================================================
       TABS
    ===================================================== */

    .project-tabs {

        margin-bottom: 18px;

        padding: 7px;

        display: flex;

        align-items: center;

        gap: 6px;

        overflow-x: auto;
    }


    .project-tab {

        min-height: 40px;

        padding:
            0 15px;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        white-space: nowrap;

        color:
            var(--text-muted);

        text-decoration: none;

        font-size: 13px;

        font-weight: 600;

        transition: .2s;
    }


    .project-tab:hover {

        background:
            var(--input-bg);

        color:
            var(--primary);
    }


    .project-tab.active {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .project-summary-grid {

        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .project-summary-card {

        padding: 18px;
    }


    .project-summary-label {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .project-summary-value {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    /* =====================================================
       INFO PANEL
    ===================================================== */

    .project-detail-panel {

        margin-bottom: 18px;

        padding: 20px;
    }


    .project-detail-title {

        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .project-detail-row {

        padding:
            12px 0;

        display: grid;

        grid-template-columns:
            190px minmax(0, 1fr);

        gap: 15px;

        border-bottom:
            1px solid var(--border);

        font-size: 14px;
    }


    .project-detail-row:last-child {

        border-bottom:
            none;
    }


    .project-detail-label {

        color:
            var(--text-muted);
    }


    .project-detail-value {

        color:
            var(--text-main);

        font-weight: 500;
    }


    .project-description {

        white-space:
            pre-line;

        line-height:
            1.7;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1000px) {

        .project-hero {

            grid-template-columns:
                160px 1fr;
        }


        .project-progress-box {

            grid-column:
                1 / -1;
        }


        .project-summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 650px) {

        .project-detail-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .project-hero {

            grid-template-columns:
                1fr;
        }


        .project-cover {

            width: 100%;
            height: 190px;
        }


        .project-summary-grid {

            grid-template-columns:
                1fr;
        }


        .project-detail-row {

            grid-template-columns:
                1fr;

            gap: 5px;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     BREADCRUMB
====================================================== --}}

<div class="admin-breadcrumb">


    <a href="{{ route('admin.projects.index') }}">

        {{ $dt['projects'] }}

    </a>


    <span class="admin-breadcrumb-separator">
        /
    </span>


    <span class="admin-breadcrumb-current">

        {{ $dt['detail_project'] }}

    </span>


</div>



{{-- =====================================================
     HEADER
====================================================== --}}

<div class="project-detail-header">


    <div>

        <h1 class="admin-page-title">

            {{ $dt['detail_project'] }}

        </h1>

        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>

    </div>


    {{-- Edit route akan diaktifkan berikutnya --}}

    <a
        href="{{ route('admin.projects.edit', $project) }}"
        class="
            admin-btn
            admin-btn-warning
        ">

        ✎ {{ $dt['edit_project'] }}

    </a>


</div>



{{-- =====================================================
     PROJECT HERO
====================================================== --}}

<div class="admin-card project-hero">


    <div class="project-cover">


        @if($project->cover_image)

        <img
            src="{{
                    asset(
                        'storage/' .
                        $project->cover_image
                    )
                }}"
            alt="{{
                    $project->project_name
                }}">

        @else

        {{ $dt['cover_empty'] }}

        @endif


    </div>



    <div>


        <div class="project-hero-name">

            {{
                $project->project_name
                ??
                '-'
            }}

        </div>


        <div class="project-hero-meta">

            👤
            {{
                optional(
                    optional(
                        $project->client
                    )->user
                )->name
                ??
                '-'
            }}

        </div>


        <div class="project-hero-meta">

            ◉
            {{
                $project->location
                ??
                '-'
            }}

        </div>


        <div class="project-hero-meta">

            ⌂
            {{
                $project->project_type
                ??
                'Renovasi'
            }}

        </div>


        <span
            class="
                admin-badge
                {{ $projectStatusClass }}
            ">

            {{ $projectStatusLabel }}

        </span>


    </div>



    <div class="project-progress-box">


        <div class="project-progress-header">

            <span>

                {{ $dt['progress'] }}

            </span>

            <strong>

                {{
                    $project->progress_percentage
                    ??
                    0
                }}%

            </strong>

        </div>


        <div class="project-progress-track">

            <div
                class="project-progress-fill"
                data-progress="{{
                    $project->progress_percentage
                    ??
                    0
                }}"></div>

        </div>


    </div>


</div>



{{-- =====================================================
     PROJECT NAVIGATION
====================================================== --}}

<div class="admin-card project-tabs">


    <a
        href="#"
        class="
            project-tab
            active
        ">

        {{ $dt['overview'] }}

    </a>


    <a
        href="#"
        class="project-tab">

        {{ $dt['works'] }}

    </a>


    <a
        href="#"
        class="project-tab">

        {{ $dt['schedule'] }}

    </a>


    <a
        href="#"
        class="project-tab">

        {{ $dt['progress_tab'] }}

    </a>


    <a
        href="#"
        class="project-tab">

        {{ $dt['documentation'] }}

    </a>


    <a
        href="#"
        class="project-tab">

        {{ $dt['cost'] }}

    </a>


</div>



{{-- =====================================================
     SUMMARY
====================================================== --}}

<div class="project-summary-grid">


    <div class="admin-card project-summary-card">

        <div class="project-summary-label">

            {{ $dt['total_works'] }}

        </div>

        <div class="project-summary-value">

            {{
                $project->works
                    ->count()
            }}

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-label">

            {{ $dt['total_schedule'] }}

        </div>

        <div class="project-summary-value">

            {{
                $project->schedules
                    ->count()
            }}

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-label">

            {{ $dt['progress_updates'] }}

        </div>

        <div class="project-summary-value">

            {{
                $project->progressUpdates
                    ->count()
            }}

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-label">

            {{ $dt['total_documentation'] }}

        </div>

        <div class="project-summary-value">

            {{
                $project->documentations
                    ->count()
            }}

        </div>

    </div>


</div>



{{-- =====================================================
     PROJECT INFORMATION
====================================================== --}}

<div class="admin-card project-detail-panel">


    <div class="project-detail-title">

        {{ $dt['project_information'] }}

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['client'] }}

        </div>

        <div class="project-detail-value">

            {{
                optional(
                    optional(
                        $project->client
                    )->user
                )->name
                ??
                '-'
            }}

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['location'] }}

        </div>

        <div class="project-detail-value">

            {{
                $project->location
                ??
                '-'
            }}

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['project_type'] }}

        </div>

        <div class="project-detail-value">

            {{
                $project->project_type
                ??
                '-'
            }}

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['start_date'] }}

        </div>

        <div class="project-detail-value">

            @if($project->start_date)

            {{
                    \Carbon\Carbon::parse(
                        $project->start_date
                    )->format('d M Y')
                }}

            @else

            -

            @endif

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['target_date'] }}

        </div>

        <div class="project-detail-value">

            @if($project->target_end_date)

            {{
                    \Carbon\Carbon::parse(
                        $project->target_end_date
                    )->format('d M Y')
                }}

            @else

            -

            @endif

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['budget'] }}

        </div>

        <div class="project-detail-value">

            Rp
            {{
                number_format(
                    $project->budget_total
                    ??
                    0,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['status'] }}

        </div>

        <div class="project-detail-value">

            <span
                class="
                    admin-badge
                    {{ $projectStatusClass }}
                ">

                {{ $projectStatusLabel }}

            </span>

        </div>

    </div>



    <div class="project-detail-row">

        <div class="project-detail-label">

            {{ $dt['description'] }}

        </div>

        <div
            class="
                project-detail-value
                project-description
            ">

            {{
                $project->description
                ?: $dt['no_description']
            }}

        </div>

    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const progressBar =
                document.querySelector(
                    '.project-progress-fill'
                );


            if (!progressBar) {

                return;

            }


            let value =
                parseFloat(
                    progressBar.dataset.progress ??
                    0
                );


            if (isNaN(value)) {

                value = 0;

            }


            value =
                Math.max(
                    0,
                    Math.min(
                        100,
                        value
                    )
                );


            progressBar.style.width =
                value + '%';

        }
    );
</script>

@endpush