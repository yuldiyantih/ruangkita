@extends('layouts.admin')


@php

/*
|--------------------------------------------------------------------------
| DASHBOARD LANGUAGE
|--------------------------------------------------------------------------
*/

$pageLang = auth()->user()->language ?? 'id';


$translations = [

/*
|--------------------------------------------------------------------------
| BAHASA INDONESIA
|--------------------------------------------------------------------------
*/

'id' => [

'page_title' => 'Dashboard Admin',

'title' => 'Dashboard',

'welcome' => 'Selamat datang',

/*
| STATISTICS
*/

'total_projects' => 'Total Proyek',

'ongoing_projects' => 'Proyek Berjalan',

'completed_projects' => 'Proyek Selesai',

'total_expenses' => 'Total Pengeluaran',

/*
| LATEST PROJECT
*/

'latest_projects' => 'Proyek Terbaru',

'view_all' => 'Lihat Semua',

'project_name' => 'Nama Proyek',

'client' => 'Client',

'location' => 'Lokasi',

'progress' => 'Progress',

'status' => 'Status',

/*
| PROJECT STATUS
*/

'ongoing' => 'Berjalan',

'completed' => 'Selesai',

'paused' => 'Ditunda',

'planning' => 'Perencanaan',

'no_projects' => 'Belum ada data proyek.',

/*
| SCHEDULE
*/

'upcoming_schedule' => 'Jadwal Mendatang',

'no_schedule' => 'Belum ada jadwal mendatang.',

/*
| WARNING
*/

'warning' => 'Peringatan',

'schedule_conflict_title' =>
'Jadwal proyek bertabrakan',

'schedule_conflict_text' =>
'Periksa kembali jadwal proyek yang berlangsung pada tanggal yang sama.',

'receipt_missing_title' =>
'Nota belum diunggah',

'receipt_missing_text' =>
'Periksa pengeluaran proyek yang belum memiliki bukti nota.',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' => 'Admin Dashboard',

'title' => 'Dashboard',

'welcome' => 'Welcome',

/*
| STATISTICS
*/

'total_projects' => 'Total Projects',

'ongoing_projects' => 'Ongoing Projects',

'completed_projects' => 'Completed Projects',

'total_expenses' => 'Total Expenses',

/*
| LATEST PROJECT
*/

'latest_projects' => 'Latest Projects',

'view_all' => 'View All',

'project_name' => 'Project Name',

'client' => 'Client',

'location' => 'Location',

'progress' => 'Progress',

'status' => 'Status',

/*
| PROJECT STATUS
*/

'ongoing' => 'Ongoing',

'completed' => 'Completed',

'paused' => 'Paused',

'planning' => 'Planning',

'no_projects' => 'No project data available.',

/*
| SCHEDULE
*/

'upcoming_schedule' => 'Upcoming Schedule',

'no_schedule' => 'No upcoming schedule.',

/*
| WARNING
*/

'warning' => 'Warnings',

'schedule_conflict_title' =>
'Project schedule conflict',

'schedule_conflict_text' =>
'Check project schedules that take place on the same date.',

'receipt_missing_title' =>
'Receipt has not been uploaded',

'receipt_missing_text' =>
'Check project expenses that do not yet have receipt evidence.',

],

];


/*
|--------------------------------------------------------------------------
| ACTIVE TRANSLATION
|--------------------------------------------------------------------------
*/

$dt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@section(
'title',
$dt['page_title'] . ' - RuangKita'
)



@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .dashboard-page-header {
        margin-bottom: 22px;
    }


    .dashboard-page-header h1 {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .dashboard-page-header p {
        color:
            var(--text-muted);

        font-size: 13px;
    }



    /* =====================================================
       STATISTICS
    ===================================================== */

    .dashboard-stats {
        margin-bottom: 21px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .dashboard-stat-card {
        min-height: 82px;

        padding: 15px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        display: flex;

        align-items: center;

        gap: 12px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .dashboard-stat-icon {
        width: 43px;

        height: 43px;

        flex-shrink: 0;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 19px;
    }


    .dashboard-stat-icon.blue {
        color: #0b73d1;

        background: #e7f2ff;
    }


    .dashboard-stat-icon.green {
        color: #119568;

        background: #e1f9ef;
    }


    .dashboard-stat-icon.purple {
        color: #7834d4;

        background: #f0e8ff;
    }


    .dashboard-stat-icon.orange {
        color: #e66a13;

        background: #fff0df;
    }


    .dashboard-stat-label {
        color:
            var(--text-muted);

        font-size: 11px;
    }


    .dashboard-stat-value {
        margin-top: 4px;

        color:
            var(--text-heading);

        font-size: 18px;

        font-weight: 700;
    }



    /* =====================================================
       PANEL
    ===================================================== */

    .dashboard-panel {
        margin-bottom: 20px;

        overflow: hidden;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .dashboard-panel-header {
        min-height: 52px;

        padding:
            0 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom:
            1px solid var(--border);
    }


    .dashboard-panel-header h3 {
        color:
            var(--text-heading);

        font-size: 15px;
    }


    .dashboard-panel-header a {
        color:
            var(--primary);

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;
    }


    .dashboard-panel-header a:hover {
        text-decoration: underline;
    }



    /* =====================================================
       TABLE
    ===================================================== */

    .dashboard-table-wrapper {
        overflow-x: auto;
    }


    .dashboard-table {
        width: 100%;

        border-collapse: collapse;
    }


    .dashboard-table thead {
        background:
            rgba(120, 145, 165, .07);
    }


    .dashboard-table th {
        padding:
            10px 16px;

        color:
            var(--text-muted);

        text-align: left;

        white-space: nowrap;

        font-size: 11px;

        font-weight: 600;
    }


    .dashboard-table td {
        padding:
            12px 16px;

        border-top:
            1px solid var(--border);

        color:
            var(--text-main);

        font-size: 12px;
    }


    .dashboard-project-name {
        color:
            var(--text-heading);

        font-weight: 600;
    }



    /* =====================================================
       PROGRESS
    ===================================================== */

    .dashboard-progress-row {
        display: flex;

        align-items: center;

        gap: 7px;
    }


    .dashboard-progress-track {
        width: 85px;

        height: 7px;

        overflow: hidden;

        border-radius: 30px;

        background: #e4eaf0;
    }


    .dashboard-progress-fill {
        width: 0;

        height: 100%;

        border-radius: 30px;

        background:
            linear-gradient(90deg,
                #1384dc,
                #22a3ed);

        transition:
            width .4s ease;
    }


    .dashboard-progress-number {
        color:
            var(--text-muted);

        font-size: 11px;
    }



    /* =====================================================
       BADGES
    ===================================================== */

    .dashboard-badge {
        padding:
            5px 9px;

        border-radius: 18px;

        display: inline-flex;

        white-space: nowrap;

        font-size: 10px;

        font-weight: 600;
    }


    .dashboard-badge-ongoing {
        color: #117653;

        background: #dff8ec;
    }


    .dashboard-badge-completed {
        color: #0967b2;

        background: #e3f1ff;
    }


    .dashboard-badge-planning {
        color: #986300;

        background: #fff2ce;
    }


    .dashboard-badge-paused {
        color: #b55318;

        background: #ffeadc;
    }



    /* =====================================================
       BOTTOM GRID
    ===================================================== */

    .dashboard-bottom {
        display: grid;

        grid-template-columns:
            minmax(0, 1.2fr) minmax(0, .8fr);

        gap: 18px;
    }



    /* =====================================================
       SCHEDULE
    ===================================================== */

    .dashboard-schedule-row {
        padding:
            13px 18px;

        display: grid;

        grid-template-columns:
            92px minmax(0, 1fr) minmax(0, 1fr);

        gap: 12px;

        border-bottom:
            1px solid var(--border);

        font-size: 12px;
    }


    .dashboard-schedule-row:last-child {
        border-bottom: none;
    }


    .dashboard-schedule-date {
        color: #eb9415;

        font-weight: 600;
    }


    .dashboard-schedule-title {
        color:
            var(--text-main);
    }


    .dashboard-schedule-project {
        color:
            var(--text-muted);
    }



    /* =====================================================
       WARNING
    ===================================================== */

    .dashboard-warning {
        padding:
            14px 17px;

        display: flex;

        gap: 11px;

        border-bottom:
            1px solid var(--border);
    }


    .dashboard-warning:last-child {
        border-bottom: none;
    }


    .dashboard-warning-icon {
        width: 36px;

        height: 36px;

        flex-shrink: 0;

        border-radius: 9px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #e85a27;

        background: #fff0e7;
    }


    .dashboard-warning-icon.yellow {
        color: #d58b07;

        background: #fff7db;
    }


    .dashboard-warning-title {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 600;
    }


    .dashboard-warning-text {
        color:
            var(--text-muted);

        font-size: 11px;

        line-height: 1.5;
    }



    /* =====================================================
       EMPTY DATA
    ===================================================== */

    .dashboard-empty-data {
        padding: 23px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 12px;
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1100px) {

        .dashboard-stats {
            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 850px) {

        .dashboard-bottom {
            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 600px) {

        .dashboard-stats {
            grid-template-columns:
                1fr;
        }


        .dashboard-schedule-row {
            grid-template-columns:
                1fr;

            gap: 5px;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     PAGE HEADER
===================================================== --}}

<div class="dashboard-page-header">

    <h1>
        {{ $dt['title'] }}
    </h1>


    <p>

        {{ $dt['welcome'] }},
        {{ auth()->user()->name }}!

    </p>

</div>



{{-- =====================================================
     STATISTICS
===================================================== --}}

<div class="dashboard-stats">


    {{-- TOTAL PROJECT --}}

    <div class="dashboard-stat-card">

        <div class="dashboard-stat-icon blue">
            ▣
        </div>


        <div>

            <div class="dashboard-stat-label">
                {{ $dt['total_projects'] }}
            </div>


            <div class="dashboard-stat-value">
                {{ $totalProjects }}
            </div>

        </div>

    </div>



    {{-- ONGOING PROJECT --}}

    <div class="dashboard-stat-card">

        <div class="dashboard-stat-icon green">
            ▰
        </div>


        <div>

            <div class="dashboard-stat-label">
                {{ $dt['ongoing_projects'] }}
            </div>


            <div class="dashboard-stat-value">
                {{ $ongoingProjects }}
            </div>

        </div>

    </div>



    {{-- COMPLETED PROJECT --}}

    <div class="dashboard-stat-card">

        <div class="dashboard-stat-icon purple">
            ✓
        </div>


        <div>

            <div class="dashboard-stat-label">
                {{ $dt['completed_projects'] }}
            </div>


            <div class="dashboard-stat-value">
                {{ $completedProjects }}
            </div>

        </div>

    </div>



    {{-- TOTAL EXPENSE --}}

    <div class="dashboard-stat-card">

        <div class="dashboard-stat-icon orange">
            Rp
        </div>


        <div>

            <div class="dashboard-stat-label">
                {{ $dt['total_expenses'] }}
            </div>


            <div class="dashboard-stat-value">

                Rp
                {{
                    number_format(
                        $totalExpenses,
                        0,
                        ',',
                        '.'
                    )
                }}

            </div>

        </div>

    </div>


</div>



{{-- =====================================================
     LATEST PROJECTS
===================================================== --}}

<div class="dashboard-panel">


    <div class="dashboard-panel-header">


        <h3>
            {{ $dt['latest_projects'] }}
        </h3>


        <a href="{{ route('admin.projects.index') }}">
            {{ $dt['view_all'] }}
        </a>


    </div>



    <div class="dashboard-table-wrapper">


        <table class="dashboard-table">


            <thead>

                <tr>

                    <th>
                        {{ $dt['project_name'] }}
                    </th>

                    <th>
                        {{ $dt['client'] }}
                    </th>

                    <th>
                        {{ $dt['location'] }}
                    </th>

                    <th>
                        {{ $dt['progress'] }}
                    </th>

                    <th>
                        {{ $dt['status'] }}
                    </th>

                </tr>

            </thead>


            <tbody>


                @forelse($latestProjects as $project)

                <tr>


                    <td class="dashboard-project-name">

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


                        <div class="dashboard-progress-row">


                            <div class="dashboard-progress-track">

                                <div
                                    class="dashboard-progress-fill"
                                    data-progress="{{
                                            $project->progress_percentage
                                            ??
                                            0
                                        }}">
                                </div>

                            </div>


                            <span class="dashboard-progress-number">

                                {{
                                        $project->progress_percentage
                                        ??
                                        0
                                    }}%

                            </span>


                        </div>


                    </td>


                    <td>


                        @if($project->status === 'ongoing')

                        <span
                            class="
                                        dashboard-badge
                                        dashboard-badge-ongoing
                                    ">

                            {{ $dt['ongoing'] }}

                        </span>


                        @elseif($project->status === 'completed')

                        <span
                            class="
                                        dashboard-badge
                                        dashboard-badge-completed
                                    ">

                            {{ $dt['completed'] }}

                        </span>


                        @elseif($project->status === 'paused')

                        <span
                            class="
                                        dashboard-badge
                                        dashboard-badge-paused
                                    ">

                            {{ $dt['paused'] }}

                        </span>


                        @else

                        <span
                            class="
                                        dashboard-badge
                                        dashboard-badge-planning
                                    ">

                            {{ $dt['planning'] }}

                        </span>

                        @endif


                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="5"
                        class="dashboard-empty-data">

                        {{ $dt['no_projects'] }}

                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>


</div>



{{-- =====================================================
     BOTTOM GRID
===================================================== --}}

<div class="dashboard-bottom">


    {{-- =================================================
         UPCOMING SCHEDULE
    ================================================== --}}

    <div class="dashboard-panel">


        <div class="dashboard-panel-header">

            <h3>
                {{ $dt['upcoming_schedule'] }}
            </h3>


            <a href="{{ route('admin.schedules.index') }}">
                {{ $dt['view_all'] }}
            </a>

        </div>


        @forelse($upcomingSchedules as $schedule)


        <div class="dashboard-schedule-row">


            <div class="dashboard-schedule-date">

                @if($schedule->start_date)

                {{
                            \Carbon\Carbon::parse(
                                $schedule->start_date
                            )
                            ->locale($pageLang)
                            ->translatedFormat('d M Y')
                        }}

                @else

                -

                @endif

            </div>


            <div class="dashboard-schedule-title">

                {{
                        $schedule->title
                        ??
                        '-'
                    }}

            </div>


            <div class="dashboard-schedule-project">

                {{
                        optional(
                            $schedule->project
                        )->project_name
                        ??
                        '-'
                    }}

            </div>


        </div>


        @empty


        <div class="dashboard-empty-data">

            {{ $dt['no_schedule'] }}

        </div>


        @endforelse


    </div>



    {{-- =================================================
         WARNING
    ================================================== --}}

    <div class="dashboard-panel">


        <div class="dashboard-panel-header">

            <h3>
                {{ $dt['warning'] }}
            </h3>

        </div>



        {{-- SCHEDULE WARNING --}}

        <div class="dashboard-warning">


            <div class="dashboard-warning-icon">
                ⚠
            </div>


            <div>


                <div class="dashboard-warning-title">

                    {{ $dt['schedule_conflict_title'] }}

                </div>


                <div class="dashboard-warning-text">

                    {{ $dt['schedule_conflict_text'] }}

                </div>


            </div>


        </div>



        {{-- RECEIPT WARNING --}}

        <div class="dashboard-warning">


            <div
                class="
                    dashboard-warning-icon
                    yellow
                ">

                !

            </div>


            <div>


                <div class="dashboard-warning-title">

                    {{ $dt['receipt_missing_title'] }}

                </div>


                <div class="dashboard-warning-text">

                    {{ $dt['receipt_missing_text'] }}

                </div>


            </div>


        </div>


    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {


            const progressBars =
                document.querySelectorAll(
                    '.dashboard-progress-fill'
                );


            progressBars.forEach(
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