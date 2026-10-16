@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

/*
|--------------------------------------------------------------------------
| BAHASA INDONESIA
|--------------------------------------------------------------------------
*/

'id' => [

'page_title' =>
'Detail Pekerjaan',

'works' =>
'Data Pekerjaan',

'detail' =>
'Detail Pekerjaan',

'subtitle' =>
'Informasi lengkap pekerjaan pada proyek.',

'edit' =>
'Edit Pekerjaan',

'project' =>
'Proyek',

'client' =>
'Client',

'method' =>
'Metode',

'volume' =>
'Volume',

'unit_price' =>
'Harga Satuan',

'duration' =>
'Durasi',

'day' =>
'hari',

'total_cost' =>
'Total Biaya',

'status' =>
'Status',

'visibility' =>
'Tampilan Client',

'daily' =>
'Harian',

'contract' =>
'Borongan',

'planned' =>
'Belum Dimulai',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'cancelled' =>
'Dibatalkan',

'visible' =>
'Ditampilkan ke Client',

'hidden' =>
'Disembunyikan dari Client',

'schedule_count' =>
'Jumlah Jadwal',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Work Detail',

'works' =>
'Works',

'detail' =>
'Work Detail',

'subtitle' =>
'Complete information for this project work.',

'edit' =>
'Edit Work',

'project' =>
'Project',

'client' =>
'Client',

'method' =>
'Method',

'volume' =>
'Volume',

'unit_price' =>
'Unit Price',

'duration' =>
'Duration',

'day' =>
'days',

'total_cost' =>
'Total Cost',

'status' =>
'Status',

'visibility' =>
'Client Visibility',

'daily' =>
'Daily',

'contract' =>
'Contract',

'planned' =>
'Not Started',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'cancelled' =>
'Cancelled',

'visible' =>
'Visible to Client',

'hidden' =>
'Hidden from Client',

'schedule_count' =>
'Schedule Count',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];


/*
|--------------------------------------------------------------------------
| STATUS LABEL
|--------------------------------------------------------------------------
*/

$statusLabel =
match ($work->status) {

'ongoing' =>
$dt['ongoing'],

'completed' =>
$dt['completed'],

'cancelled' =>
$dt['cancelled'],

default =>
$dt['planned'],

};


/*
|--------------------------------------------------------------------------
| STATUS CLASS
|--------------------------------------------------------------------------
*/

$statusClass =
match ($work->status) {

'ongoing' =>
'admin-badge-warning',

'completed' =>
'admin-badge-success',

'cancelled' =>
'admin-badge-danger',

default =>
'admin-badge-primary',

};

@endphp



@section(
'title',
$dt['page_title'] . ' - RuangKita'
)



@push('styles')

<style>
    /* =====================================================
       HEADER
    ===================================================== */

    .work-detail-header {
        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }



    /* =====================================================
       SUMMARY GRID
    ===================================================== */

    .work-detail-grid {
        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(3,
                minmax(0, 1fr));

        gap: 14px;
    }


    .work-detail-card {
        padding: 18px;
    }


    .work-detail-label {
        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .work-detail-value {
        color:
            var(--text-heading);

        font-size: 20px;

        font-weight: 700;
    }



    /* =====================================================
       DETAIL INFORMATION
    ===================================================== */

    .work-info-panel {
        padding: 20px;
    }


    .work-info-title {
        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .work-info-row {
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


    .work-info-row:last-child {
        border-bottom: none;
    }


    .work-info-label {
        color:
            var(--text-muted);
    }


    .work-info-value {
        color:
            var(--text-main);

        font-weight: 500;
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 850px) {

        .work-detail-grid {
            grid-template-columns:
                1fr 1fr;
        }

    }


    @media(max-width: 650px) {

        .work-detail-header {
            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .work-detail-grid {
            grid-template-columns:
                1fr;
        }


        .work-info-row {
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
===================================================== --}}

<div class="admin-breadcrumb">


    <a href="{{ route('admin.works.index') }}">

        {{ $dt['works'] }}

    </a>


    <span class="admin-breadcrumb-separator">
        /
    </span>


    <span class="admin-breadcrumb-current">

        {{ $dt['detail'] }}

    </span>


</div>



{{-- =====================================================
     PAGE HEADER
===================================================== --}}

<div class="work-detail-header">


    <div>


        <h1 class="admin-page-title">

            {{ $work->work_name }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>


    </div>



    <a
        href="{{ route('admin.works.edit', $work) }}"
        class="
            admin-btn
            admin-btn-warning
        ">

        ✎ {{ $dt['edit'] }}

    </a>


</div>



{{-- =====================================================
     SUMMARY
===================================================== --}}

<div class="work-detail-grid">


    {{-- PROJECT --}}

    <div class="admin-card work-detail-card">


        <div class="work-detail-label">

            {{ $dt['project'] }}

        </div>


        <div class="work-detail-value">

            {{
                $work->project->project_name
                ??
                '-'
            }}

        </div>


    </div>



    {{-- CLIENT --}}

    <div class="admin-card work-detail-card">


        <div class="work-detail-label">

            {{ $dt['client'] }}

        </div>


        <div class="work-detail-value">

            {{
                optional(
                    optional(
                        $work->project
                    )->client
                )->user->name
                ??
                '-'
            }}

        </div>


    </div>



    {{-- SCHEDULE COUNT --}}

    <div class="admin-card work-detail-card">


        <div class="work-detail-label">

            {{ $dt['schedule_count'] }}

        </div>


        <div class="work-detail-value">

            {{ $work->schedules->count() }}

        </div>


    </div>


</div>



{{-- =====================================================
     WORK INFORMATION
===================================================== --}}

<div class="admin-card work-info-panel">


    <div class="work-info-title">

        {{ $dt['detail'] }}

    </div>



    {{-- METHOD --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['method'] }}

        </div>


        <div class="work-info-value">

            {{
                $work->method_type === 'daily'
                    ? $dt['daily']
                    : $dt['contract']
            }}

        </div>


    </div>



    {{-- VOLUME --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['volume'] }}

        </div>


        <div class="work-info-value">

            {{
                $work->volume
                ??
                '-'
            }}

            {{
                $work->unit
                ??
                ''
            }}

        </div>


    </div>



    {{-- UNIT PRICE --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['unit_price'] }}

        </div>


        <div class="work-info-value">

            Rp
            {{
                number_format(
                    $work->unit_price ?? 0,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>


    </div>



    {{-- DURATION --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['duration'] }}

        </div>


        <div class="work-info-value">

            {{
                $work->duration_days
                ??
                '-'
            }}

            @if($work->duration_days)

            {{ $dt['day'] }}

            @endif

        </div>


    </div>



    {{-- TOTAL COST --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['total_cost'] }}

        </div>


        <div class="work-info-value">

            Rp
            {{
                number_format(
                    $work->total_cost ?? 0,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>


    </div>



    {{-- STATUS --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['status'] }}

        </div>


        <div class="work-info-value">

            <span
                class="
                    admin-badge
                    {{ $statusClass }}
                ">

                {{ $statusLabel }}

            </span>

        </div>


    </div>



    {{-- CLIENT VISIBILITY --}}

    <div class="work-info-row">


        <div class="work-info-label">

            {{ $dt['visibility'] }}

        </div>


        <div class="work-info-value">


            @if($work->is_visible_to_client)

            <span
                class="
                        admin-badge
                        admin-badge-success
                    ">

                {{ $dt['visible'] }}

            </span>

            @else

            <span
                class="
                        admin-badge
                        admin-badge-danger
                    ">

                {{ $dt['hidden'] }}

            </span>

            @endif


        </div>


    </div>


</div>


@endsection