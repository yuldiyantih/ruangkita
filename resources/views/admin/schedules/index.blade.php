@extends('layouts.admin')


@section(
'title',
'Data Jadwal - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' => 'Data Jadwal',
'subtitle' =>
'Kelola seluruh jadwal pekerjaan dan proyek RuangKita.',

'add_schedule' =>
'Tambah Jadwal',

'total' =>
'Total Jadwal',

'planned' =>
'Akan Datang',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'list' =>
'Daftar Jadwal',

'search_placeholder' =>
'Cari judul jadwal...',

'all_projects' =>
'Semua Proyek',

'all_works' =>
'Semua Pekerjaan',

'all_status' =>
'Semua Status',

'search' =>
'Cari',

'reset' =>
'Reset',

'no' =>
'No',

'title_col' =>
'Judul',

'project' =>
'Proyek',

'work' =>
'Pekerjaan',

'start_date' =>
'Mulai',

'end_date' =>
'Selesai',

'status' =>
'Status',

'action' =>
'Aksi',

'planned_status' =>
'Akan Datang',

'ongoing_status' =>
'Sedang Berjalan',

'completed_status' =>
'Selesai',

'delayed_status' =>
'Terlambat',

'cancelled_status' =>
'Dibatalkan',

'empty' =>
'Belum ada data jadwal.',

],


'en' => [

'title' => 'Schedules',
'subtitle' =>
'Manage all RuangKita project and work schedules.',

'add_schedule' =>
'Add Schedule',

'total' =>
'Total Schedules',

'planned' =>
'Upcoming',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'list' =>
'Schedule List',

'search_placeholder' =>
'Search schedule title...',

'all_projects' =>
'All Projects',

'all_works' =>
'All Works',

'all_status' =>
'All Status',

'search' =>
'Search',

'reset' =>
'Reset',

'no' =>
'No',

'title_col' =>
'Title',

'project' =>
'Project',

'work' =>
'Work',

'start_date' =>
'Start',

'end_date' =>
'End',

'status' =>
'Status',

'action' =>
'Action',

'planned_status' =>
'Upcoming',

'ongoing_status' =>
'Ongoing',

'completed_status' =>
'Completed',

'delayed_status' =>
'Delayed',

'cancelled_status' =>
'Cancelled',

'empty' =>
'No schedule data available.',

],

];


$st =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    .schedule-page-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }


    .schedule-summary-grid {

        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .schedule-summary-card {

        min-height: 105px;

        padding: 18px;

        display: flex;

        align-items: center;

        gap: 14px;
    }


    .schedule-summary-icon {

        width: 50px;
        height: 50px;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;

        font-size: 20px;
    }


    .schedule-summary-icon.blue {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .schedule-summary-icon.orange {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .schedule-summary-icon.green {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    .schedule-summary-icon.purple {

        background:
            rgba(111, 66, 217, .12);

        color:
            #7551d7;
    }


    .schedule-summary-label {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .schedule-summary-number {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    .schedule-panel {

        overflow: hidden;
    }


    .schedule-panel-header {

        padding:
            16px 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 14px;

        border-bottom:
            1px solid var(--border);
    }


    .schedule-panel-title {

        flex-shrink: 0;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .schedule-filter-form {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 9px;

        flex-wrap: nowrap;
    }


    .schedule-search {

        width: 220px;
    }


    .schedule-project-filter {

        width: 190px;
    }


    .schedule-work-filter {

        width: 190px;
    }


    .schedule-status-filter {

        width: 165px;
    }


    .schedule-filter-form .admin-form-control {

        height: 44px;

        min-height: 44px;
    }


    .schedule-actions {

        display: flex;

        align-items: center;

        gap: 7px;
    }


    .schedule-action {

        width: 34px;
        height: 34px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        font-size: 14px;
    }


    .schedule-action.view {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .schedule-action.edit {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .schedule-empty {

        padding:
            40px 20px !important;

        text-align: center;

        color:
            var(--text-muted) !important;
    }


    .schedule-pagination {

        padding:
            16px 18px;
    }


    @media(max-width: 1250px) {

        .schedule-panel-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .schedule-filter-form {

            width: 100%;

            justify-content: flex-start;

            flex-wrap: wrap;
        }

    }


    @media(max-width: 900px) {

        .schedule-summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 650px) {

        .schedule-page-header {

            align-items: flex-start;

            flex-direction: column;
        }


        .schedule-summary-grid {

            grid-template-columns:
                1fr;
        }


        .schedule-filter-form {

            flex-direction: column;

            align-items: stretch;
        }


        .schedule-search,
        .schedule-project-filter,
        .schedule-work-filter,
        .schedule-status-filter {

            width: 100%;
        }

    }
</style>

@endpush



@section('content')


<div class="schedule-page-header">


    <div>

        <h1 class="admin-page-title">

            {{ $st['title'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $st['subtitle'] }}

        </p>

    </div>


    <a
        href="{{ route('admin.schedules.create') }}"
        class="
            admin-btn
            admin-btn-primary
        ">

        ＋ {{ $st['add_schedule'] }}

    </a>


</div>



<div class="schedule-summary-grid">


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-icon blue">
            ▦
        </div>

        <div>

            <div class="schedule-summary-label">
                {{ $st['total'] }}
            </div>

            <div class="schedule-summary-number">
                {{ $totalSchedules }}
            </div>

        </div>

    </div>


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-icon purple">
            ◷
        </div>

        <div>

            <div class="schedule-summary-label">
                {{ $st['planned'] }}
            </div>

            <div class="schedule-summary-number">
                {{ $plannedSchedules }}
            </div>

        </div>

    </div>


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-icon orange">
            ▶
        </div>

        <div>

            <div class="schedule-summary-label">
                {{ $st['ongoing'] }}
            </div>

            <div class="schedule-summary-number">
                {{ $ongoingSchedules }}
            </div>

        </div>

    </div>


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-icon green">
            ✓
        </div>

        <div>

            <div class="schedule-summary-label">
                {{ $st['completed'] }}
            </div>

            <div class="schedule-summary-number">
                {{ $completedSchedules }}
            </div>

        </div>

    </div>


</div>



<div class="admin-card schedule-panel">


    <div class="schedule-panel-header">


        <div class="schedule-panel-title">

            {{ $st['list'] }}

        </div>


        <form
            method="GET"
            action="{{ route('admin.schedules.index') }}"
            class="schedule-filter-form">


            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="
                    admin-form-control
                    schedule-search
                "
                placeholder="{{ $st['search_placeholder'] }}">


            <select
                name="project"
                class="
                    admin-form-control
                    schedule-project-filter
                ">

                <option value="">
                    {{ $st['all_projects'] }}
                </option>


                @foreach($projects as $project)

                <option
                    value="{{ $project->id }}"
                    @selected(
                    (string) $projectId===(string) $project->id
                    )
                    >

                    {{ $project->project_name }}

                </option>

                @endforeach

            </select>


            <select
                name="work"
                class="
                    admin-form-control
                    schedule-work-filter
                ">

                <option value="">
                    {{ $st['all_works'] }}
                </option>


                @foreach($works as $work)

                <option
                    value="{{ $work->id }}"
                    @selected(
                    (string) $workId===(string) $work->id
                    )
                    >

                    {{ $work->work_name }}

                </option>

                @endforeach

            </select>


            <select
                name="status"
                class="
                    admin-form-control
                    schedule-status-filter
                ">

                <option value="">
                    {{ $st['all_status'] }}
                </option>

                <option
                    value="planned"
                    @selected($status==='planned' )>
                    {{ $st['planned_status'] }}
                </option>

                <option
                    value="ongoing"
                    @selected($status==='ongoing' )>
                    {{ $st['ongoing_status'] }}
                </option>

                <option
                    value="completed"
                    @selected($status==='completed' )>
                    {{ $st['completed_status'] }}
                </option>

                <option
                    value="delayed"
                    @selected($status==='delayed' )>
                    {{ $st['delayed_status'] }}
                </option>

                <option
                    value="cancelled"
                    @selected($status==='cancelled' )>
                    {{ $st['cancelled_status'] }}
                </option>

            </select>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">
                {{ $st['search'] }}
            </button>


            <a
                href="{{ route('admin.schedules.index') }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">
                {{ $st['reset'] }}
            </a>


        </form>


    </div>



    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $st['no'] }}</th>

                    <th>{{ $st['title_col'] }}</th>

                    <th>{{ $st['project'] }}</th>

                    <th>{{ $st['work'] }}</th>

                    <th>{{ $st['start_date'] }}</th>

                    <th>{{ $st['end_date'] }}</th>

                    <th>{{ $st['status'] }}</th>

                    <th>{{ $st['action'] }}</th>

                </tr>

            </thead>


            <tbody>


                @forelse($schedules as $schedule)


                @php

                $statusLabel =
                match ($schedule->status) {

                'ongoing' =>
                $st['ongoing_status'],

                'completed' =>
                $st['completed_status'],

                'delayed' =>
                $st['delayed_status'],

                'cancelled' =>
                $st['cancelled_status'],

                default =>
                $st['planned_status'],

                };


                $statusClass =
                match ($schedule->status) {

                'ongoing' =>
                'admin-badge-warning',

                'completed' =>
                'admin-badge-success',

                'delayed' =>
                'admin-badge-danger',

                'cancelled' =>
                'admin-badge-danger',

                default =>
                'admin-badge-primary',

                };

                @endphp


                <tr>


                    <td>

                        {{
                                $schedules->firstItem()
                                +
                                $loop->index
                            }}

                    </td>


                    <td>

                        <strong>
                            {{ $schedule->title }}
                        </strong>

                    </td>


                    <td>

                        {{
                                $schedule->project->project_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                $schedule->work->work_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                $schedule->start_date
                                    ? $schedule->start_date->format('d M Y')
                                    : '-'
                            }}

                    </td>


                    <td>

                        {{
                                $schedule->end_date
                                    ? $schedule->end_date->format('d M Y')
                                    : '-'
                            }}

                    </td>


                    <td>

                        <span
                            class="
                                    admin-badge
                                    {{ $statusClass }}
                                ">

                            {{ $statusLabel }}

                        </span>

                    </td>


                    <td>

                        <div class="schedule-actions">

                            <a
                                href="{{ route('admin.schedules.show', $schedule) }}"
                                class="schedule-action view"
                                title="Detail Jadwal">
                                ◉
                            </a>

                            <a
                                href="{{ route('admin.schedules.edit', $schedule) }}"
                                class="schedule-action edit"
                                title="Edit Jadwal">
                                ✎
                            </a>

                        </div>

                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="8"
                        class="schedule-empty">
                        {{ $st['empty'] }}
                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>


    @if($schedules->hasPages())

    <div class="schedule-pagination">

        {{ $schedules->links() }}

    </div>

    @endif


</div>


@endsection