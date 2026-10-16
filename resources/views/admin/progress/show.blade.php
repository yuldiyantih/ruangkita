@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' =>
'Detail Progress',

'dashboard' =>
'Dashboard',

'progress' =>
'Progress',

'detail_progress' =>
'Detail Progress',

'subtitle' =>
'Informasi lengkap perkembangan proyek.',

'back' =>
'Kembali',

'edit' =>
'Edit',

'progress_information' =>
'Informasi Progress',

'project' =>
'Proyek',

'client' =>
'Client',

'update_date' =>
'Tanggal Update',

'created_by' =>
'Dibuat Oleh',

'progress_notes' =>
'Catatan Progress',

'progress_status' =>
'Status Progress',

'project_progress' =>
'Progress Proyek',

'status' =>
'Status',

'completed' =>
'Selesai',

'almost_complete' =>
'Hampir Selesai',

'in_progress' =>
'Berjalan',

'not_started' =>
'Belum Mulai',

'progress_photo' =>
'Foto Progress',

'no_photo' =>
'Belum ada foto progress.',

],


'en' => [

'page_title' =>
'Progress Detail',

'dashboard' =>
'Dashboard',

'progress' =>
'Progress',

'detail_progress' =>
'Progress Detail',

'subtitle' =>
'Complete information about the project progress.',

'back' =>
'Back',

'edit' =>
'Edit',

'progress_information' =>
'Progress Information',

'project' =>
'Project',

'client' =>
'Client',

'update_date' =>
'Update Date',

'created_by' =>
'Created By',

'progress_notes' =>
'Progress Notes',

'progress_status' =>
'Progress Status',

'project_progress' =>
'Project Progress',

'status' =>
'Status',

'completed' =>
'Completed',

'almost_complete' =>
'Almost Complete',

'in_progress' =>
'In Progress',

'not_started' =>
'Not Started',

'progress_photo' =>
'Progress Photo',

'no_photo' =>
'No progress photo available.',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];


$percentage =
max(
0,
min(
100,
(int) $progressUpdate->percentage
)
);


$statusLabel =
match (true) {

$percentage >= 100 =>
$dt['completed'],

$percentage >= 75 =>
$dt['almost_complete'],

$percentage > 0 =>
$dt['in_progress'],

default =>
$dt['not_started'],

};


$statusClass =
match (true) {

$percentage >= 100 =>
'done',

$percentage >= 75 =>
'almost',

$percentage > 0 =>
'running',

default =>
'not-started',

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

    .progress-detail-header {
        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content:
            space-between;

        gap: 16px;
    }


    .progress-detail-actions {
        display: flex;

        gap: 8px;

        flex-wrap: wrap;
    }


    .progress-detail-btn {
        min-height: 42px;

        padding:
            0 16px;

        border: none;

        border-radius: 10px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        text-decoration: none;

        cursor: pointer;

        font-size: 12px;

        font-weight: 700;

        transition:
            all .18s ease;
    }


    .progress-detail-btn.back {
        background:
            var(--primary);

        color: #fff;

        box-shadow:
            0 6px 16px rgba(8, 119, 212, .16);
    }


    .progress-detail-btn.back:hover {
        background:
            var(--primary-light);

        color: #fff;

        transform:
            translateY(-1px);
    }


    .progress-detail-btn.edit {
        background:
            var(--warning);

        color: #fff;

        box-shadow:
            0 6px 16px rgba(217, 119, 6, .14);
    }


    .progress-detail-btn.edit:hover {
        transform:
            translateY(-1px);
    }



    /* =====================================================
       GRID
    ===================================================== */

    .progress-detail-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.7fr) minmax(300px, .8fr);

        gap: 18px;

        align-items: start;
    }



    /* =====================================================
       CARD
    ===================================================== */

    .progress-detail-card {
        overflow: hidden;
    }


    .progress-detail-card-header {
        padding:
            17px 18px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    .progress-detail-card-body {
        padding: 18px;
    }



    /* =====================================================
       INFORMATION
    ===================================================== */

    .progress-detail-row {
        padding:
            12px 0;

        border-bottom:
            1px solid var(--border);

        display: grid;

        grid-template-columns:
            180px minmax(0, 1fr);

        gap: 16px;
    }


    .progress-detail-row:last-child {
        border-bottom: none;
    }


    .progress-detail-label {
        color:
            var(--text-muted);

        font-size: 12px;
    }


    .progress-detail-value {
        color:
            var(--text-heading);

        font-size: 13px;

        font-weight: 600;

        word-break:
            break-word;
    }



    /* =====================================================
       PROGRESS SUMMARY
    ===================================================== */

    .progress-summary-box {
        padding: 18px;

        border:
            1px solid rgba(8, 119, 212, .10);

        border-radius: 12px;

        background:
            rgba(8, 119, 212, .05);
    }


    .progress-summary-label {
        color:
            var(--text-muted);

        font-size: 12px;
    }


    .progress-large-value {
        margin:
            8px 0 15px;

        color:
            var(--primary);

        font-size: 35px;

        font-weight: 800;
    }


    .progress-detail-bar {
        height: 13px;

        overflow: hidden;

        border-radius: 10px;

        background:
            #e8eef4;
    }


    .progress-detail-bar-fill {
        width: 0;

        height: 100%;

        border-radius: 10px;

        background:
            var(--primary);

        transition:
            width .25s ease;
    }


    .progress-detail-bar-fill.done {
        background:
            var(--success);
    }



    /* =====================================================
       STATUS
    ===================================================== */

    .progress-status-wrapper {
        margin-top: 18px;

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 12px;
    }


    .progress-status-title {
        color:
            var(--text-muted);

        font-size: 12px;
    }


    .progress-status {
        padding:
            7px 11px;

        border-radius: 20px;

        display: inline-flex;

        align-items: center;

        font-size: 11px;

        font-weight: 700;
    }


    .progress-status.not-started {
        background:
            #edf1f5;

        color:
            var(--text-muted);
    }


    .progress-status.running {
        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .progress-status.almost {
        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .progress-status.done {
        background:
            var(--success-bg);

        color:
            var(--success);
    }



    /* =====================================================
       PHOTO
    ===================================================== */

    .progress-photo-card {
        margin-top: 18px;
    }


    .progress-detail-photo {
        display: block;

        width: 100%;

        max-height: 420px;

        object-fit: cover;

        border:
            1px solid var(--border);

        border-radius: 12px;
    }


    .progress-no-photo {
        padding: 35px;

        border:
            1px dashed var(--border);

        border-radius: 10px;

        background:
            rgba(120, 145, 165, .035);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 12px;
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 900px) {

        .progress-detail-grid {
            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 650px) {

        .progress-detail-header {
            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .progress-detail-actions {
            width: 100%;
        }


        .progress-detail-btn {
            flex: 1;
        }


        .progress-detail-row {
            grid-template-columns:
                1fr;

            gap: 5px;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="progress-detail-header">

    <div>

        <div class="admin-breadcrumb">

            <a href="{{ route('admin.dashboard') }}">

                {{ $dt['dashboard'] }}

            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <a href="{{ route('admin.progress.index') }}">

                {{ $dt['progress'] }}

            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <span class="admin-breadcrumb-current">

                {{ $dt['detail_progress'] }}

            </span>

        </div>


        <h1 class="admin-page-title">

            {{ $dt['detail_progress'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>

    </div>


    <div class="progress-detail-actions">

        <a
            href="{{ route('admin.progress.index') }}"
            class="progress-detail-btn back">

            ← {{ $dt['back'] }}

        </a>


        <a
            href="{{ route('admin.progress.edit', $progressUpdate) }}"
            class="progress-detail-btn edit">

            ✎ {{ $dt['edit'] }}

        </a>

    </div>

</div>



{{-- =====================================================
     MAIN
===================================================== --}}

<div class="progress-detail-grid">


    {{-- LEFT --}}

    <div class="admin-card progress-detail-card">

        <div class="progress-detail-card-header">

            {{ $dt['progress_information'] }}

        </div>


        <div class="progress-detail-card-body">


            {{-- PROJECT --}}

            <div class="progress-detail-row">

                <div class="progress-detail-label">

                    {{ $dt['project'] }}

                </div>

                <div class="progress-detail-value">

                    {{
                        $progressUpdate
                            ->project
                            ?->project_name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- CLIENT --}}

            <div class="progress-detail-row">

                <div class="progress-detail-label">

                    {{ $dt['client'] }}

                </div>

                <div class="progress-detail-value">

                    {{
                        $progressUpdate
                            ->project
                            ?->client
                            ?->user
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- DATE --}}

            <div class="progress-detail-row">

                <div class="progress-detail-label">

                    {{ $dt['update_date'] }}

                </div>

                <div class="progress-detail-value">

                    {{
                        optional(
                            $progressUpdate->update_date
                        )->format('d M Y')
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- CREATOR --}}

            <div class="progress-detail-row">

                <div class="progress-detail-label">

                    {{ $dt['created_by'] }}

                </div>

                <div class="progress-detail-value">

                    {{
                        $progressUpdate
                            ->creator
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- DESCRIPTION --}}

            <div class="progress-detail-row">

                <div class="progress-detail-label">

                    {{ $dt['progress_notes'] }}

                </div>

                <div class="progress-detail-value">

                    {{
                        $progressUpdate->description
                        ??
                        '-'
                    }}

                </div>

            </div>


        </div>

    </div>



    {{-- RIGHT --}}

    <div class="admin-card progress-detail-card">

        <div class="progress-detail-card-header">

            {{ $dt['progress_status'] }}

        </div>


        <div class="progress-detail-card-body">

            <div class="progress-summary-box">


                <div class="progress-summary-label">

                    {{ $dt['project_progress'] }}

                </div>


                <div class="progress-large-value">

                    {{ $percentage }}%

                </div>


                <div class="progress-detail-bar">

                    <div
                        class="progress-detail-bar-fill {{ $percentage >= 100 ? 'done' : '' }}"
                        data-progress="{{ $percentage }}">
                    </div>

                </div>


                <div class="progress-status-wrapper">

                    <span class="progress-status-title">

                        {{ $dt['status'] }}

                    </span>


                    <span
                        class="progress-status {{ $statusClass }}">

                        {{ $statusLabel }}

                    </span>

                </div>


            </div>

        </div>

    </div>


</div>



{{-- =====================================================
     PHOTO
===================================================== --}}

<div
    class="admin-card progress-detail-card progress-photo-card">

    <div class="progress-detail-card-header">

        {{ $dt['progress_photo'] }}

    </div>


    <div class="progress-detail-card-body">

        @if($progressUpdate->photo_path)

        <a
            href="{{ asset('storage/' . $progressUpdate->photo_path) }}"
            target="_blank">

            <img
                src="{{ asset('storage/' . $progressUpdate->photo_path) }}"
                alt="{{ $dt['progress_photo'] }}"
                class="progress-detail-photo">

        </a>

        @else

        <div class="progress-no-photo">

            {{ $dt['no_photo'] }}

        </div>

        @endif

    </div>

</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            document
                .querySelectorAll(
                    '[data-progress]'
                )
                .forEach(
                    function(bar) {

                        let value =
                            parseInt(
                                bar.dataset.progress || '0',
                                10
                            );

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