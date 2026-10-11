@extends('layouts.admin')


@section(
'title',
'Detail Jadwal - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'schedule' =>
'Data Jadwal',

'detail' =>
'Detail Jadwal',

'subtitle' =>
'Informasi lengkap jadwal proyek RuangKita.',

'edit' =>
'Edit Jadwal',

'project' =>
'Proyek',

'client' =>
'Client',

'work' =>
'Pekerjaan',

'start' =>
'Tanggal Mulai',

'end' =>
'Tanggal Selesai',

'status' =>
'Status',

'description' =>
'Deskripsi',

'planned' =>
'Akan Datang',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'delayed' =>
'Terlambat',

'cancelled' =>
'Dibatalkan',

'no_description' =>
'Belum ada deskripsi jadwal.',

],


'en' => [

'schedule' =>
'Schedules',

'detail' =>
'Schedule Detail',

'subtitle' =>
'Complete information about the RuangKita project schedule.',

'edit' =>
'Edit Schedule',

'project' =>
'Project',

'client' =>
'Client',

'work' =>
'Work',

'start' =>
'Start Date',

'end' =>
'End Date',

'status' =>
'Status',

'description' =>
'Description',

'planned' =>
'Upcoming',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'delayed' =>
'Delayed',

'cancelled' =>
'Cancelled',

'no_description' =>
'No schedule description available.',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];


$statusLabel =
match ($schedule->status) {

'ongoing' =>
$dt['ongoing'],

'completed' =>
$dt['completed'],

'delayed' =>
$dt['delayed'],

'cancelled' =>
$dt['cancelled'],

default =>
$dt['planned'],

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


@push('styles')

<style>
    .schedule-detail-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content:
            space-between;

        gap: 16px;
    }


    .schedule-summary-grid {

        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(3,
                minmax(0, 1fr));

        gap: 14px;
    }


    .schedule-summary-card {

        padding: 18px;
    }


    .schedule-summary-label {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .schedule-summary-value {

        color:
            var(--text-heading);

        font-size: 18px;

        font-weight: 700;
    }


    .schedule-info-panel {

        padding: 20px;
    }


    .schedule-info-title {

        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .schedule-info-row {

        padding: 12px 0;

        display: grid;

        grid-template-columns:
            190px minmax(0, 1fr);

        gap: 15px;

        border-bottom:
            1px solid var(--border);
    }


    .schedule-info-row:last-child {

        border-bottom: none;
    }


    .schedule-info-label {

        color:
            var(--text-muted);
    }


    .schedule-info-value {

        color:
            var(--text-main);

        font-weight: 500;
    }


    .schedule-description {

        white-space:
            pre-line;

        line-height: 1.7;
    }


    @media(max-width: 750px) {

        .schedule-summary-grid {

            grid-template-columns:
                1fr;
        }


        .schedule-info-row {

            grid-template-columns:
                1fr;

            gap: 5px;
        }


        .schedule-detail-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }

    }
</style>

@endpush



@section('content')


<div class="admin-breadcrumb">

    <a href="{{ route('admin.schedules.index') }}">
        {{ $dt['schedule'] }}
    </a>

    <span class="admin-breadcrumb-separator">
        /
    </span>

    <span class="admin-breadcrumb-current">
        {{ $dt['detail'] }}
    </span>

</div>



<div class="schedule-detail-header">

    <div>

        <h1 class="admin-page-title">

            {{ $schedule->title }}

        </h1>

        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>

    </div>


    <a
        href="{{ route('admin.schedules.edit', $schedule) }}"
        class="
            admin-btn
            admin-btn-warning
        ">
        ✎ {{ $dt['edit'] }}
    </a>

</div>



<div class="schedule-summary-grid">


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-label">
            {{ $dt['project'] }}
        </div>

        <div class="schedule-summary-value">

            {{
                $schedule->project->project_name
                ??
                '-'
            }}

        </div>

    </div>


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-label">
            {{ $dt['client'] }}
        </div>

        <div class="schedule-summary-value">

            {{
                optional(
                    optional(
                        $schedule->project
                    )->client
                )->user->name
                ??
                '-'
            }}

        </div>

    </div>


    <div class="admin-card schedule-summary-card">

        <div class="schedule-summary-label">
            {{ $dt['work'] }}
        </div>

        <div class="schedule-summary-value">

            {{
                $schedule->work->work_name
                ??
                '-'
            }}

        </div>

    </div>


</div>



<div class="admin-card schedule-info-panel">


    <div class="schedule-info-title">

        {{ $dt['detail'] }}

    </div>


    <div class="schedule-info-row">

        <div class="schedule-info-label">
            {{ $dt['start'] }}
        </div>

        <div class="schedule-info-value">

            {{
                $schedule->start_date
                    ? $schedule->start_date->format('d M Y')
                    : '-'
            }}

        </div>

    </div>


    <div class="schedule-info-row">

        <div class="schedule-info-label">
            {{ $dt['end'] }}
        </div>

        <div class="schedule-info-value">

            {{
                $schedule->end_date
                    ? $schedule->end_date->format('d M Y')
                    : '-'
            }}

        </div>

    </div>


    <div class="schedule-info-row">

        <div class="schedule-info-label">
            {{ $dt['status'] }}
        </div>

        <div class="schedule-info-value">

            <span
                class="
                    admin-badge
                    {{ $statusClass }}
                ">
                {{ $statusLabel }}
            </span>

        </div>

    </div>


    <div class="schedule-info-row">

        <div class="schedule-info-label">
            {{ $dt['description'] }}
        </div>

        <div
            class="
                schedule-info-value
                schedule-description
            ">

            {{
                $schedule->description
                ?: $dt['no_description']
            }}

        </div>

    </div>


</div>


@endsection