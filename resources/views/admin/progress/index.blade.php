@extends('layouts.admin')

@section('title', 'Progress Proyek - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Progress Proyek',

'subtitle' =>
'Pantau perkembangan proyek dan catat update progress terbaru.',

'add' =>
'Tambah Progress',

'average' =>
'Rata-rata Progress',

'active' =>
'Proyek Aktif',

'completed' =>
'Proyek Selesai',

'attention' =>
'Perlu Perhatian',

'list' =>
'Daftar Progress',

'search_placeholder' =>
'Cari proyek atau catatan...',

'all_projects' =>
'Semua Proyek',

'search' =>
'Cari',

'reset' =>
'Reset',

'date' =>
'Tanggal',

'project' =>
'Proyek',

'progress' =>
'Progress',

'status' =>
'Status',

'notes' =>
'Catatan',

'photo' =>
'Foto',

'created_by' =>
'Dibuat Oleh',

'action' =>
'Aksi',

'not_started' =>
'Belum Mulai',

'running' =>
'Berjalan',

'almost' =>
'Hampir Selesai',

'done' =>
'Selesai',

'planning' =>
'Perencanaan',

'paused' =>
'Ditunda',

'no_photo' =>
'Tidak ada',

'distribution' =>
'Distribusi Status Proyek',

'latest' =>
'Progress Terbaru',

'empty' =>
'Belum ada data progress.',

],


'en' => [

'title' =>
'Project Progress',

'subtitle' =>
'Monitor project development and record the latest progress updates.',

'add' =>
'Add Progress',

'average' =>
'Average Progress',

'active' =>
'Active Projects',

'completed' =>
'Completed Projects',

'attention' =>
'Needs Attention',

'list' =>
'Progress List',

'search_placeholder' =>
'Search project or notes...',

'all_projects' =>
'All Projects',

'search' =>
'Search',

'reset' =>
'Reset',

'date' =>
'Date',

'project' =>
'Project',

'progress' =>
'Progress',

'status' =>
'Status',

'notes' =>
'Notes',

'photo' =>
'Photo',

'created_by' =>
'Created By',

'action' =>
'Action',

'not_started' =>
'Not Started',

'running' =>
'In Progress',

'almost' =>
'Almost Complete',

'done' =>
'Completed',

'planning' =>
'Planning',

'paused' =>
'Paused',

'no_photo' =>
'None',

'distribution' =>
'Project Status Distribution',

'latest' =>
'Latest Progress',

'empty' =>
'No progress data available.',

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
       HEADER
    ===================================================== */

    .progress-page-header {
        margin-bottom: 22px;

        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 16px;
    }


    .progress-header-actions {
        display: flex;
        align-items: center;

        gap: 8px;

        flex-wrap: wrap;
    }


    .progress-add-btn {
        min-height: 42px;

        padding: 0 16px;

        border: none;
        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        background:
            var(--primary);

        color: #fff;

        text-decoration: none;

        font-size: 12px;
        font-weight: 700;

        box-shadow:
            0 6px 16px rgba(8, 119, 212, .16);

        transition:
            all .18s ease;
    }


    .progress-add-btn:hover {
        background:
            var(--primary-light);

        color: #fff;

        transform:
            translateY(-1px);
    }



    /* =====================================================
       SUMMARY
    ===================================================== */

    .progress-summary-grid {
        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .progress-summary-card {
        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .progress-summary-label {
        margin-bottom: 8px;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .progress-summary-value {
        color:
            var(--text-heading);

        font-size: 23px;
        font-weight: 700;
    }


    .progress-summary-value.primary {
        color:
            var(--primary);
    }


    .progress-summary-value.success {
        color:
            var(--success);
    }


    .progress-summary-value.warning {
        color:
            var(--warning);
    }



    /* =====================================================
       LIST
    ===================================================== */

    .progress-list-card {
        overflow: hidden;
    }


    .progress-list-header {
        padding: 17px 18px;

        border-bottom:
            1px solid var(--border);

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 14px;

        flex-wrap: wrap;
    }


    .progress-list-title {
        color:
            var(--text-heading);

        font-size: 17px;
        font-weight: 700;
    }



    /* =====================================================
       FILTER
    ===================================================== */

    .progress-filter {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 7px;

        flex: 1;

        min-width: 0;
    }


    .progress-filter input,
    .progress-filter select {
        height: 38px;

        padding:
            0 10px;

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


    .progress-filter input {
        width: 230px;
    }


    .progress-filter select {
        width: 165px;
    }


    .progress-filter input:focus,
    .progress-filter select:focus {
        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .progress-filter-btn {
        height: 38px;

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


    .progress-filter-btn.search {
        background:
            var(--primary);

        color: #fff;
    }


    .progress-filter-btn.reset {
        border:
            1px solid var(--border);

        background:
            var(--card-bg);

        color:
            var(--text-muted);
    }



    /* =====================================================
       TABLE
    ===================================================== */

    .progress-table-wrapper {
        overflow-x: auto;
    }


    .progress-table {
        width: 100%;

        border-collapse:
            collapse;

        font-size: 12px;
    }


    .progress-table th {
        padding: 12px;

        background:
            rgba(120, 145, 165, .07);

        color:
            var(--text-muted);

        text-align: left;

        white-space: nowrap;

        font-weight: 600;
    }


    .progress-table td {
        padding:
            13px 12px;

        border-top:
            1px solid var(--border);

        color:
            var(--text-main);

        vertical-align: middle;
    }


    .progress-table tbody tr:hover {
        background:
            rgba(8, 119, 212, .025);
    }


    .progress-project-name {
        color:
            var(--text-heading);

        font-weight: 700;
    }



    /* =====================================================
       PROGRESS BAR
    ===================================================== */

    .progress-bar-wrapper {
        min-width: 170px;
    }


    .progress-bar-track {
        height: 10px;

        overflow: hidden;

        border-radius: 10px;

        background:
            #e8eef4;
    }


    .progress-bar-fill {
        width: 0;

        height: 100%;

        border-radius: 10px;

        background:
            var(--primary);

        transition:
            width .25s ease;
    }


    .progress-bar-fill.done {
        background:
            var(--success);
    }


    .progress-bar-text {
        margin-top: 5px;

        color:
            var(--text-heading);

        font-size: 11px;
        font-weight: 700;
    }



    /* =====================================================
       STATUS
    ===================================================== */

    .progress-status {
        padding:
            6px 10px;

        border-radius: 20px;

        display: inline-flex;
        align-items: center;

        white-space: nowrap;

        font-size: 10px;
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

    .progress-photo {
        width: 48px;
        height: 48px;

        object-fit: cover;

        border-radius: 8px;

        border:
            1px solid var(--border);
    }


    .progress-no-photo {
        color:
            var(--text-muted);

        font-size: 11px;
    }



    /* =====================================================
       NOTES
    ===================================================== */

    .progress-notes {
        max-width: 230px;

        overflow: hidden;

        text-overflow:
            ellipsis;

        white-space: nowrap;

        color:
            var(--text-muted);
    }



    /* =====================================================
       ACTION
    ===================================================== */

    .progress-actions {
        display: flex;

        align-items: center;

        gap: 6px;
    }


    .progress-action-btn {
        width: 32px;
        height: 32px;

        padding: 0;

        border: none;

        border-radius: 7px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        text-decoration: none;

        cursor: pointer;

        font-size: 13px;

        font-weight: 700;
    }


    .progress-action-btn.view {
        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .progress-action-btn.edit {
        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .progress-action-btn.delete {
        background:
            var(--danger-bg);

        color:
            var(--danger);
    }


    .progress-delete-form {
        display: inline-flex;
    }



    /* =====================================================
       EMPTY
    ===================================================== */

    .progress-empty {
        padding: 30px;

        color:
            var(--text-muted);

        text-align: center;
    }



    /* =====================================================
       BOTTOM
    ===================================================== */

    .progress-bottom-grid {
        margin-top: 20px;

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 18px;
    }


    .progress-bottom-card {
        padding: 18px;
    }


    .progress-bottom-title {
        margin-bottom: 18px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .progress-stat-row {
        margin-bottom: 15px;

        display: grid;

        grid-template-columns:
            110px minmax(0, 1fr) 45px;

        gap: 12px;

        align-items: center;

        font-size: 12px;
    }


    .progress-stat-row:last-child {
        margin-bottom: 0;
    }


    .progress-stat-track {
        height: 10px;

        overflow: hidden;

        border-radius: 10px;

        background:
            #e8eef4;
    }


    .progress-stat-fill {
        width: 0;

        height: 100%;

        border-radius: 10px;

        background:
            var(--primary);

        transition:
            width .25s ease;
    }


    .progress-stat-fill.completed {
        background:
            var(--success);
    }


    .progress-stat-fill.planning {
        background:
            var(--warning);
    }


    .progress-stat-fill.paused {
        background:
            var(--danger);
    }



    /* =====================================================
       LATEST
    ===================================================== */

    .progress-recent-item {
        padding:
            11px 0;

        border-bottom:
            1px solid var(--border);

        display: grid;

        grid-template-columns:
            72px minmax(0, 1fr);

        gap: 10px;
    }


    .progress-recent-item:last-child {
        border-bottom: none;
    }


    .progress-recent-date {
        color:
            var(--primary);

        font-size: 11px;

        font-weight: 700;
    }


    .progress-recent-text {
        color:
            var(--text-main);

        font-size: 12px;

        line-height: 1.5;
    }


    .progress-recent-description {
        color:
            var(--text-muted);
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1100px) {

        .progress-summary-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }


        .progress-filter {
            width: 100%;

            justify-content:
                flex-start;

            flex-wrap: wrap;
        }

    }


    @media(max-width: 700px) {

        .progress-page-header {
            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .progress-header-actions {
            width: 100%;
        }


        .progress-add-btn {
            width: 100%;
        }


        .progress-summary-grid {
            grid-template-columns:
                1fr;
        }


        .progress-filter input,
        .progress-filter select {
            width: 100%;
        }


        .progress-filter-btn {
            flex: 1;
        }


        .progress-bottom-grid {
            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="progress-page-header">

    <div>

        <div class="admin-breadcrumb">

            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <span class="admin-breadcrumb-current">
                {{ $pt['title'] }}
            </span>

        </div>


        <h1 class="admin-page-title">
            {{ $pt['title'] }}
        </h1>


        <p class="admin-page-subtitle">
            {{ $pt['subtitle'] }}
        </p>

    </div>


    <div class="progress-header-actions">

        <a
            href="{{ route('admin.progress.create') }}"
            class="progress-add-btn">
            + {{ $pt['add'] }}
        </a>

    </div>

</div>



{{-- =====================================================
     SUMMARY
===================================================== --}}

<div class="progress-summary-grid">


    <div class="progress-summary-card">

        <div class="progress-summary-label">
            {{ $pt['average'] }}
        </div>

        <div class="progress-summary-value primary">

            {{ number_format($averageProgress, 0) }}%

        </div>

    </div>



    <div class="progress-summary-card">

        <div class="progress-summary-label">
            {{ $pt['active'] }}
        </div>

        <div class="progress-summary-value">

            {{ $activeProjects }}

        </div>

    </div>



    <div class="progress-summary-card">

        <div class="progress-summary-label">
            {{ $pt['completed'] }}
        </div>

        <div class="progress-summary-value success">

            {{ $completedProjects }}

        </div>

    </div>



    <div class="progress-summary-card">

        <div class="progress-summary-label">
            {{ $pt['attention'] }}
        </div>

        <div class="progress-summary-value warning">

            {{ $needsAttention }}

        </div>

    </div>


</div>



{{-- =====================================================
     LIST
===================================================== --}}

<div class="admin-card progress-list-card">


    <div class="progress-list-header">

        <div class="progress-list-title">
            {{ $pt['list'] }}
        </div>


        <form
            method="GET"
            action="{{ route('admin.progress.index') }}"
            class="progress-filter">

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="{{ $pt['search_placeholder'] }}">


            <select name="project">

                <option value="">
                    {{ $pt['all_projects'] }}
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


            <button
                type="submit"
                class="progress-filter-btn search">
                {{ $pt['search'] }}
            </button>


            <a
                href="{{ route('admin.progress.index') }}"
                class="progress-filter-btn reset">
                {{ $pt['reset'] }}
            </a>

        </form>

    </div>



    <div class="progress-table-wrapper">

        <table class="progress-table">

            <thead>

                <tr>

                    <th>
                        {{ $pt['date'] }}
                    </th>

                    <th>
                        {{ $pt['project'] }}
                    </th>

                    <th>
                        {{ $pt['progress'] }}
                    </th>

                    <th>
                        {{ $pt['status'] }}
                    </th>

                    <th>
                        {{ $pt['notes'] }}
                    </th>

                    <th>
                        {{ $pt['photo'] }}
                    </th>

                    <th>
                        {{ $pt['created_by'] }}
                    </th>

                    <th>
                        {{ $pt['action'] }}
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($progressUpdates as $progressUpdate)

                @php

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
                $pt['done'],

                $percentage >= 75 =>
                $pt['almost'],

                $percentage > 0 =>
                $pt['running'],

                default =>
                $pt['not_started'],

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


                <tr>


                    {{-- DATE --}}

                    <td>

                        {{
                                optional(
                                    $progressUpdate->update_date
                                )->format('d M Y')
                                ??
                                '-'
                            }}

                    </td>



                    {{-- PROJECT --}}

                    <td>

                        <div class="progress-project-name">

                            {{
                                    $progressUpdate
                                        ->project
                                        ?->project_name
                                    ??
                                    '-'
                                }}

                        </div>

                    </td>



                    {{-- PROGRESS --}}

                    <td>

                        <div class="progress-bar-wrapper">

                            <div class="progress-bar-track">

                                <div
                                    class="progress-bar-fill {{ $percentage >= 100 ? 'done' : '' }}"
                                    data-progress="{{ $percentage }}"></div>

                            </div>


                            <div class="progress-bar-text">

                                {{ $percentage }}%

                            </div>

                        </div>

                    </td>



                    {{-- STATUS --}}

                    <td>

                        <span
                            class="progress-status {{ $statusClass }}">

                            {{ $statusLabel }}

                        </span>

                    </td>



                    {{-- NOTES --}}

                    <td>

                        <div
                            class="progress-notes"
                            title="{{ $progressUpdate->description ?? '-' }}">

                            {{
                                    $progressUpdate->description
                                    ??
                                    '-'
                                }}

                        </div>

                    </td>



                    {{-- PHOTO --}}

                    <td>

                        @if($progressUpdate->photo_path)

                        <a
                            href="{{ asset('storage/' . $progressUpdate->photo_path) }}"
                            target="_blank">

                            <img
                                src="{{ asset('storage/' . $progressUpdate->photo_path) }}"
                                alt="Foto Progress"
                                class="progress-photo">

                        </a>

                        @else

                        <span class="progress-no-photo">

                            {{ $pt['no_photo'] }}

                        </span>

                        @endif

                    </td>



                    {{-- CREATOR --}}

                    <td>

                        {{
                                $progressUpdate
                                    ->creator
                                    ?->name
                                ??
                                '-'
                            }}

                    </td>



                    {{-- ACTION --}}

                    <td>

                        <div class="progress-actions">

                            <a
                                href="{{ route('admin.progress.show', $progressUpdate) }}"
                                class="progress-action-btn view"
                                title="Detail">
                                ◉
                            </a>


                            <a
                                href="{{ route('admin.progress.edit', $progressUpdate) }}"
                                class="progress-action-btn edit"
                                title="Edit">
                                ✎
                            </a>


                            <form
                                method="POST"
                                action="{{ route('admin.progress.destroy', $progressUpdate) }}"
                                class="progress-delete-form">

                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="progress-action-btn delete"
                                    title="Hapus">
                                    ×
                                </button>

                            </form>

                        </div>

                    </td>


                </tr>


                @empty

                <tr>

                    <td
                        colspan="8"
                        class="progress-empty">
                        {{ $pt['empty'] }}
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


</div>



{{-- =====================================================
     PAGINATION
===================================================== --}}

@if($progressUpdates->hasPages())

<div style="margin-top:16px;">

    {{ $progressUpdates->links() }}

</div>

@endif



{{-- =====================================================
     BOTTOM
===================================================== --}}

<div class="progress-bottom-grid">


    {{-- DISTRIBUSI STATUS PROYEK --}}

    <div class="admin-card progress-bottom-card">

        <div class="progress-bottom-title">

            {{ $pt['distribution'] }}

        </div>



        {{-- SELESAI --}}

        <div class="progress-stat-row">

            <span>
                {{ $pt['done'] }}
            </span>


            <div class="progress-stat-track">

                <div
                    class="progress-stat-fill completed"
                    data-progress="{{ $completedPercent }}"></div>

            </div>


            <strong>
                {{ $completedPercent }}%
            </strong>

        </div>



        {{-- BERJALAN --}}

        <div class="progress-stat-row">

            <span>
                {{ $pt['running'] }}
            </span>


            <div class="progress-stat-track">

                <div
                    class="progress-stat-fill"
                    data-progress="{{ $runningPercent }}"></div>

            </div>


            <strong>
                {{ $runningPercent }}%
            </strong>

        </div>



        {{-- PERENCANAAN --}}

        <div class="progress-stat-row">

            <span>
                {{ $pt['planning'] }}
            </span>


            <div class="progress-stat-track">

                <div
                    class="progress-stat-fill planning"
                    data-progress="{{ $planningPercent }}"></div>

            </div>


            <strong>
                {{ $planningPercent }}%
            </strong>

        </div>



        {{-- DITUNDA --}}

        <div class="progress-stat-row">

            <span>
                {{ $pt['paused'] }}
            </span>


            <div class="progress-stat-track">

                <div
                    class="progress-stat-fill paused"
                    data-progress="{{ $pausedPercent }}"></div>

            </div>


            <strong>
                {{ $pausedPercent }}%
            </strong>

        </div>


    </div>



    {{-- PROGRESS TERBARU --}}

    <div class="admin-card progress-bottom-card">

        <div class="progress-bottom-title">

            {{ $pt['latest'] }}

        </div>


        @forelse ($progressUpdates->take(3) as $recent)

        <div class="progress-recent-item">

            <div class="progress-recent-date">

                {{
                        optional(
                            $recent->update_date
                        )->format('d M')
                        ??
                        '-'
                    }}

            </div>


            <div class="progress-recent-text">

                <strong>

                    {{
                            $recent
                                ->project
                                ?->project_name
                            ??
                            '-'
                        }}

                </strong>

                — {{ $recent->percentage }}%


                @if($recent->description)

                <br>

                <span class="progress-recent-description">

                    {{ $recent->description }}

                </span>

                @endif

            </div>

        </div>


        @empty

        <div class="progress-empty">

            {{ $pt['empty'] }}

        </div>

        @endforelse


    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            /*
            |--------------------------------------------------------------------------
            | PROGRESS BARS
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    '.progress-delete-form'
                )
                .forEach(
                    function(form) {

                        form.addEventListener(
                            'submit',
                            function(event) {

                                const confirmed =
                                    confirm(
                                        'Yakin ingin menghapus data progress ini?'
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