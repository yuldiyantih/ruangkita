@extends('layouts.admin')


@section(
'title',
'Dashboard Admin - RuangKita'
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

        background: #f7fafc;
    }


    .dashboard-table th {

        padding:
            10px 16px;

        color: #758899;

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
    ====================================================== --}}

<div class="dashboard-page-header">


    <h1>

        Dashboard

    </h1>


    <p>

        Selamat datang,
        {{ auth()->user()->name }}!

    </p>


</div>



{{-- =====================================================
         STATISTICS
    ====================================================== --}}

<div class="dashboard-stats">


    {{-- TOTAL PROJECT --}}

    <div class="dashboard-stat-card">


        <div class="dashboard-stat-icon blue">

            ▣

        </div>


        <div>

            <div class="dashboard-stat-label">

                Total Proyek

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

                Proyek Berjalan

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

                Proyek Selesai

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

                Total Pengeluaran

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
    ====================================================== --}}

<div class="dashboard-panel">


    <div class="dashboard-panel-header">


        <h3>

            Proyek Terbaru

        </h3>


        {{-- Route proyek akan kita aktifkan saat menu Proyek dibuat --}}

        <a href="#">

            Lihat Semua

        </a>


    </div>



    <div class="dashboard-table-wrapper">


        <table class="dashboard-table">


            <thead>

                <tr>

                    <th>
                        Nama Proyek
                    </th>

                    <th>
                        Client
                    </th>

                    <th>
                        Lokasi
                    </th>

                    <th>
                        Progress
                    </th>

                    <th>
                        Status
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
                                            }}"></div>

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

                            Berjalan

                        </span>


                        @elseif($project->status === 'completed')

                        <span
                            class="
                                            dashboard-badge
                                            dashboard-badge-completed
                                        ">

                            Selesai

                        </span>


                        @elseif($project->status === 'paused')

                        <span
                            class="
                                            dashboard-badge
                                            dashboard-badge-paused
                                        ">

                            Ditunda

                        </span>


                        @else

                        <span
                            class="
                                            dashboard-badge
                                            dashboard-badge-planning
                                        ">

                            Perencanaan

                        </span>

                        @endif


                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="5"
                        class="dashboard-empty-data">

                        Belum ada data proyek.

                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>


</div>



{{-- =====================================================
         BOTTOM GRID
    ====================================================== --}}

<div class="dashboard-bottom">


    {{-- =================================================
             UPCOMING SCHEDULE
        ================================================== --}}

    <div class="dashboard-panel">


        <div class="dashboard-panel-header">

            <h3>

                Jadwal Mendatang

            </h3>

        </div>


        @forelse($upcomingSchedules as $schedule)


        <div class="dashboard-schedule-row">


            <div class="dashboard-schedule-date">

                {{
                            $schedule->start_date
                            ?
                            \Carbon\Carbon::parse(
                                $schedule->start_date
                            )->format('d M Y')
                            :
                            '-'
                        }}

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

            Belum ada jadwal mendatang.

        </div>


        @endforelse


    </div>



    {{-- =================================================
             WARNING
        ================================================== --}}

    <div class="dashboard-panel">


        <div class="dashboard-panel-header">

            <h3>

                Peringatan

            </h3>

        </div>



        <div class="dashboard-warning">


            <div class="dashboard-warning-icon">

                ⚠

            </div>


            <div>


                <div class="dashboard-warning-title">

                    Jadwal proyek bertabrakan

                </div>


                <div class="dashboard-warning-text">

                    Periksa kembali jadwal proyek
                    yang berlangsung pada tanggal
                    yang sama.

                </div>


            </div>


        </div>



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

                    Nota belum diunggah

                </div>


                <div class="dashboard-warning-text">

                    Periksa pengeluaran proyek
                    yang belum memiliki bukti nota.

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