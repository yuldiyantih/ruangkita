@extends('layouts.admin')


@section(
'title',
'Data Proyek - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' => 'Data Proyek',

'subtitle' =>
'Kelola seluruh proyek renovasi yang terdaftar di RuangKita.',

'add_project' =>
'Tambah Proyek',

'total' =>
'Total Proyek',

'ongoing' =>
'Proyek Berjalan',

'completed' =>
'Proyek Selesai',

'planning' =>
'Proyek Perencanaan',

'list' =>
'Daftar Proyek',

'search_placeholder' =>
'Cari nama proyek, client, atau lokasi...',

'all_status' =>
'Semua Status',

'status_planning' =>
'Perencanaan',

'status_ongoing' =>
'Berjalan',

'status_completed' =>
'Selesai',

'status_paused' =>
'Ditunda',

'search' =>
'Cari',

'reset' =>
'Reset',

'no' =>
'No',

'project_name' =>
'Nama Proyek',

'client' =>
'Client',

'location' =>
'Lokasi',

'progress' =>
'Progress',

'budget' =>
'Anggaran',

'status' =>
'Status',

'action' =>
'Aksi',

'empty' =>
'Belum ada data proyek.',

],


'en' => [

'title' => 'Projects',

'subtitle' =>
'Manage all renovation projects registered in RuangKita.',

'add_project' =>
'Add Project',

'total' =>
'Total Projects',

'ongoing' =>
'Ongoing Projects',

'completed' =>
'Completed Projects',

'planning' =>
'Planning Projects',

'list' =>
'Project List',

'search_placeholder' =>
'Search project, client, or location...',

'all_status' =>
'All Status',

'status_planning' =>
'Planning',

'status_ongoing' =>
'Ongoing',

'status_completed' =>
'Completed',

'status_paused' =>
'Paused',

'search' =>
'Search',

'reset' =>
'Reset',

'no' =>
'No',

'project_name' =>
'Project Name',

'client' =>
'Client',

'location' =>
'Location',

'progress' =>
'Progress',

'budget' =>
'Budget',

'status' =>
'Status',

'action' =>
'Action',

'empty' =>
'No project data available.',

],

];


$pt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .project-page-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .project-summary-grid {

        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .project-summary-card {

        min-height: 105px;

        padding: 18px;

        display: flex;

        align-items: center;

        gap: 14px;
    }


    .project-summary-icon {

        width: 50px;
        height: 50px;

        flex-shrink: 0;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;
    }


    .project-summary-icon.blue {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .project-summary-icon.green {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    .project-summary-icon.purple {

        background:
            rgba(111, 66, 217, .12);

        color:
            #7551d7;
    }


    body.dark-mode .project-summary-icon.purple {

        background:
            rgba(151, 121, 225, .18);

        color:
            #b9a1ee;
    }


    .project-summary-icon.orange {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .project-summary-label {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .project-summary-number {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    /* =====================================================
   PANEL
===================================================== */

    .project-panel {

        overflow: hidden;
    }


    /* =====================================================
   PANEL HEADER
===================================================== */

    .project-panel-header {

        padding:
            16px 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 16px;

        border-bottom:
            1px solid var(--border);
    }


    .project-panel-title {

        flex-shrink: 0;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    /* =====================================================
   FILTER
===================================================== */

    .project-filter-form {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 9px;

        flex-wrap: nowrap;
    }


    .project-search {

        width: 300px;
    }


    .project-status-select {

        width: 210px;
    }


    .project-filter-form .admin-form-control {

        min-height: 44px;

        height: 44px;
    }


    /* =====================================================
   FILTER ACTIONS
===================================================== */

    .project-filter-actions {

        display: flex;

        align-items: center;

        gap: 9px;
    }


    .project-filter-actions .admin-btn {

        min-height: 44px;

        white-space: nowrap;
    }

    /* =====================================================
       PROJECT NAME
    ===================================================== */

    .project-name {

        color:
            var(--text-heading);

        font-weight: 700;
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    .project-progress {

        min-width: 150px;

        display: flex;

        align-items: center;

        gap: 8px;
    }


    .project-progress-track {

        width: 105px;
        height: 8px;

        overflow: hidden;

        flex-shrink: 0;

        border-radius: 50px;

        background:
            var(--border);
    }


    .project-progress-fill {

        width: 0;

        height: 100%;

        border-radius: 50px;

        background:
            linear-gradient(90deg,
                var(--primary),
                var(--primary-light));

        transition:
            width .35s ease;
    }


    .project-progress-number {

        min-width: 38px;

        color:
            var(--text-muted);

        font-size: 13px;

        white-space: nowrap;
    }


    /* =====================================================
       ACTION
    ===================================================== */

    .project-actions {

        display: flex;

        align-items: center;

        gap: 7px;
    }


    .project-action {

        width: 34px;
        height: 34px;

        flex-shrink: 0;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        font-size: 14px;

        transition:
            transform .2s ease,
            filter .2s ease;
    }


    .project-action:hover {

        transform:
            translateY(-1px);
    }


    .project-action.view {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .project-action.edit {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    /* =====================================================
       EMPTY DATA
    ===================================================== */

    .project-empty {

        padding:
            40px 20px !important;

        color:
            var(--text-muted) !important;

        text-align: center;
    }


    /* =====================================================
       PAGINATION
    ===================================================== */

    .project-pagination {

        padding:
            16px 18px;
    }


    /* =====================================================
       RESPONSIVE - TABLET
    ===================================================== */

    @media(max-width: 1150px) {

        .project-panel-header {

            align-items: flex-start;

            flex-direction: column;
        }


        .project-filter-form {

            width: 100%;

            justify-content: flex-start;

            flex-wrap: wrap;
        }


        .project-search {

            width: min(100%,
                    340px);
        }


        .project-status-select {

            width: 220px;
        }

    }


    @media(max-width: 650px) {

        .project-filter-form {

            flex-direction: column;

            align-items: stretch;
        }


        .project-search,
        .project-status-select {

            width: 100%;
        }


        .project-filter-actions {

            width: 100%;
        }


        .project-filter-actions .admin-btn {

            flex: 1;
        }

    }

    /* =====================================================
       RESPONSIVE - MOBILE
    ===================================================== */

    @media(max-width: 650px) {

        .project-page-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .project-summary-grid {

            grid-template-columns:
                1fr;
        }


        .project-filter-form {

            grid-template-columns:
                1fr;
        }


        .project-filter-actions {

            grid-column:
                auto;
        }


        .project-filter-actions {

            display: grid;

            grid-template-columns:
                repeat(2,
                    minmax(0, 1fr));
        }


        .project-filter-actions .admin-btn {

            width: 100%;
        }


        .project-search {

            width: 100%;
        }

    }


    @media(max-width: 420px) {

        .project-filter-actions {

            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


<div class="project-page-header">


    <div>

        <h1 class="admin-page-title">

            {{ $pt['title'] }}

        </h1>

        <p class="admin-page-subtitle">

            {{ $pt['subtitle'] }}

        </p>

    </div>


    <a
        href="{{ route('admin.projects.create') }}"
        class="
            admin-btn
            admin-btn-primary
        ">

        ＋ {{ $pt['add_project'] }}

    </a>


</div>



<div class="project-summary-grid">


    <div class="admin-card project-summary-card">

        <div class="project-summary-icon blue">
            ▣
        </div>

        <div>

            <div class="project-summary-label">
                {{ $pt['total'] }}
            </div>

            <div class="project-summary-number">
                {{ $totalProjects }}
            </div>

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-icon green">
            ▶
        </div>

        <div>

            <div class="project-summary-label">
                {{ $pt['ongoing'] }}
            </div>

            <div class="project-summary-number">
                {{ $ongoingProjects }}
            </div>

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-icon purple">
            ✓
        </div>

        <div>

            <div class="project-summary-label">
                {{ $pt['completed'] }}
            </div>

            <div class="project-summary-number">
                {{ $completedProjects }}
            </div>

        </div>

    </div>



    <div class="admin-card project-summary-card">

        <div class="project-summary-icon orange">
            ◷
        </div>

        <div>

            <div class="project-summary-label">
                {{ $pt['planning'] }}
            </div>

            <div class="project-summary-number">
                {{ $planningProjects }}
            </div>

        </div>

    </div>


</div>



<div class="admin-card project-panel">


    <div class="project-panel-header">


        <div class="project-panel-title">

            {{ $pt['list'] }}

        </div>



        <form
            method="GET"
            action="{{ route('admin.projects.index') }}"
            class="project-filter-form">


            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="
                    admin-form-control
                    project-search
                "
                placeholder="{{ $pt['search_placeholder'] }}">


            <select
                name="status"
                class="
                    admin-form-control
                    project-status-select
                ">

                <option value="">

                    {{ $pt['all_status'] }}

                </option>


                <option
                    value="planning"
                    @selected($status==='planning' )>

                    {{ $pt['status_planning'] }}

                </option>


                <option
                    value="ongoing"
                    @selected($status==='ongoing' )>

                    {{ $pt['status_ongoing'] }}

                </option>


                <option
                    value="completed"
                    @selected($status==='completed' )>

                    {{ $pt['status_completed'] }}

                </option>


                <option
                    value="paused"
                    @selected($status==='paused' )>

                    {{ $pt['status_paused'] }}

                </option>


            </select>



            <div class="project-filter-actions">


                <button
                    type="submit"
                    class="
                        admin-btn
                        admin-btn-primary
                    ">

                    {{ $pt['search'] }}

                </button>


                <a
                    href="{{ route('admin.projects.index') }}"
                    class="
                        admin-btn
                        admin-btn-secondary
                    ">

                    {{ $pt['reset'] }}

                </a>


            </div>


        </form>


    </div>


    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $pt['no'] }}</th>

                    <th>{{ $pt['project_name'] }}</th>

                    <th>{{ $pt['client'] }}</th>

                    <th>{{ $pt['location'] }}</th>

                    <th>{{ $pt['progress'] }}</th>

                    <th>{{ $pt['budget'] }}</th>

                    <th>{{ $pt['status'] }}</th>

                    <th>{{ $pt['action'] }}</th>

                </tr>

            </thead>


            <tbody>


                @forelse($projects as $project)


                @php

                $projectStatus =
                $project->status
                ??
                'planning';


                $projectStatusLabel =
                match ($projectStatus) {

                'ongoing'
                =>
                $pt['status_ongoing'],

                'completed'
                =>
                $pt['status_completed'],

                'paused'
                =>
                $pt['status_paused'],

                default
                =>
                $pt['status_planning'],

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


                <tr>


                    <td>

                        {{
                                $projects->firstItem()
                                +
                                $loop->index
                            }}

                    </td>


                    <td class="project-name">

                        {{
                                $project->project_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                optional(
                                    optional(
                                        $project->client
                                    )->user
                                )->name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                $project->location
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        <div class="project-progress">


                            <div class="project-progress-track">

                                <div
                                    class="project-progress-fill"
                                    data-progress="{{
                                    $project->progress_percentage
                                     ??
                                     0
                                    }}">
                                </div>

                            </div>
                        </div>


                        <span class="project-progress-number">

                            {{
                                        $project->progress_percentage
                                        ??
                                        0
                                    }}%

                        </span>


    </div>

    </td>


    <td>

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

    </td>


    <td>

        <span
            class="
                                    admin-badge
                                    {{ $projectStatusClass }}
                                ">

            {{ $projectStatusLabel }}

        </span>

    </td>


    <td>

        <div class="project-actions">

            <a
                href="{{route('admin.projects.show', $project)}}"
                class="project-action view"
                title="Detail Proyek">
                ◉
            </a>

            <a
                href="{{route('admin.projects.edit', $project)}}"
                class="project-action edit"
                title="Edit Proyek">
                ✎
            </a>

        </div>

    </td>


    </tr>


    @empty


    <tr>

        <td
            colspan="8"
            class="project-empty">

            {{ $pt['empty'] }}

        </td>

    </tr>


    @endforelse


    </tbody>


    </table>


</div>



@if($projects->hasPages())

<div class="project-pagination">

    {{ $projects->links() }}

</div>

@endif

</div>

@endsection
@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            document
                .querySelectorAll(
                    '.project-progress-fill'
                )
                .forEach(
                    function(bar) {

                        let value =
                            parseFloat(
                                bar.dataset.progress ??
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


                        bar.style.width =
                            value + '%';

                    }
                );

        }
    );
</script>

@endpush