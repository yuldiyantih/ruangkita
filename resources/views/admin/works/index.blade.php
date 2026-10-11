@extends('layouts.admin')


@section(
'title',
'Data Pekerjaan - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Data Pekerjaan',

'subtitle' =>
'Kelola seluruh tahapan pekerjaan pada proyek RuangKita.',

'add_work' =>
'Tambah Pekerjaan',

'total' =>
'Total Pekerjaan',

'planned' =>
'Belum Dimulai',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'list' =>
'Daftar Pekerjaan',

'search_placeholder' =>
'Cari nama pekerjaan...',

'all_projects' =>
'Semua Proyek',

'all_status' =>
'Semua Status',

'search' =>
'Cari',

'reset' =>
'Reset',

'no' =>
'No',

'work_name' =>
'Nama Pekerjaan',

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

'total_cost' =>
'Total Biaya',

'status' =>
'Status',

'visible' =>
'Client',

'action' =>
'Aksi',

'daily' =>
'Harian',

'contract' =>
'Borongan',

'planned_status' =>
'Belum Dimulai',

'ongoing_status' =>
'Berjalan',

'completed_status' =>
'Selesai',

'cancelled_status' =>
'Dibatalkan',

'shown' =>
'Ditampilkan',

'hidden' =>
'Disembunyikan',

'empty' =>
'Belum ada data pekerjaan.',

],


'en' => [

'title' =>
'Works',

'subtitle' =>
'Manage all project work stages in RuangKita.',

'add_work' =>
'Add Work',

'total' =>
'Total Works',

'planned' =>
'Not Started',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'list' =>
'Work List',

'search_placeholder' =>
'Search work name...',

'all_projects' =>
'All Projects',

'all_status' =>
'All Status',

'search' =>
'Search',

'reset' =>
'Reset',

'no' =>
'No',

'work_name' =>
'Work Name',

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

'total_cost' =>
'Total Cost',

'status' =>
'Status',

'visible' =>
'Client',

'action' =>
'Action',

'daily' =>
'Daily',

'contract' =>
'Contract',

'planned_status' =>
'Not Started',

'ongoing_status' =>
'Ongoing',

'completed_status' =>
'Completed',

'cancelled_status' =>
'Cancelled',

'shown' =>
'Visible',

'hidden' =>
'Hidden',

'empty' =>
'No work data available.',

],

];


$wt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    .work-page-header {

        margin-bottom: 22px;

        display: flex;

        justify-content: space-between;

        align-items: flex-end;

        gap: 16px;
    }


    .work-summary-grid {

        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .work-summary-card {

        min-height: 105px;

        padding: 18px;

        display: flex;

        align-items: center;

        gap: 14px;
    }


    .work-summary-icon {

        width: 50px;
        height: 50px;

        flex-shrink: 0;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 20px;
    }


    .work-summary-icon.blue {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .work-summary-icon.orange {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .work-summary-icon.green {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    .work-summary-icon.purple {

        background:
            rgba(111, 66, 217, .12);

        color:
            #7551d7;
    }


    .work-summary-label {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .work-summary-number {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    .work-panel {

        overflow: hidden;
    }


    .work-panel-header {

        padding:
            16px 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 14px;

        border-bottom:
            1px solid var(--border);
    }


    .work-panel-title {

        flex-shrink: 0;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .work-filter-form {

        display: flex;

        justify-content: flex-end;

        align-items: center;

        gap: 9px;

        flex-wrap: nowrap;
    }


    .work-search {

        width: 230px;
    }


    .work-project-filter {

        width: 210px;
    }


    .work-status-filter {

        width: 170px;
    }


    .work-filter-form .admin-form-control {

        min-height: 44px;

        height: 44px;
    }


    .work-actions {

        display: flex;

        align-items: center;

        gap: 7px;
    }


    .work-action {

        width: 34px;
        height: 34px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        font-size: 14px;
    }


    .work-action.view {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .work-action.edit {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .work-empty {

        padding:
            40px 20px !important;

        text-align: center;

        color:
            var(--text-muted) !important;
    }


    .work-pagination {

        padding:
            16px 18px;
    }


    @media(max-width: 1200px) {

        .work-panel-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .work-filter-form {

            width: 100%;

            justify-content:
                flex-start;

            flex-wrap:
                wrap;
        }

    }


    @media(max-width: 900px) {

        .work-summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 650px) {

        .work-page-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .work-summary-grid {

            grid-template-columns:
                1fr;
        }


        .work-filter-form {

            flex-direction:
                column;

            align-items:
                stretch;
        }


        .work-search,
        .work-project-filter,
        .work-status-filter {

            width: 100%;
        }

    }
</style>

@endpush



@section('content')


<div class="work-page-header">


    <div>

        <h1 class="admin-page-title">

            {{ $wt['title'] }}

        </h1>

        <p class="admin-page-subtitle">

            {{ $wt['subtitle'] }}

        </p>

    </div>


    <a
        href="{{ route('admin.works.create') }}"
        class="
            admin-btn
            admin-btn-primary
        ">

        ＋ {{ $wt['add_work'] }}

    </a>


</div>



<div class="work-summary-grid">


    <div class="admin-card work-summary-card">

        <div class="work-summary-icon blue">
            ▤
        </div>

        <div>

            <div class="work-summary-label">
                {{ $wt['total'] }}
            </div>

            <div class="work-summary-number">
                {{ $totalWorks }}
            </div>

        </div>

    </div>



    <div class="admin-card work-summary-card">

        <div class="work-summary-icon purple">
            ○
        </div>

        <div>

            <div class="work-summary-label">
                {{ $wt['planned'] }}
            </div>

            <div class="work-summary-number">
                {{ $plannedWorks }}
            </div>

        </div>

    </div>



    <div class="admin-card work-summary-card">

        <div class="work-summary-icon orange">
            ▶
        </div>

        <div>

            <div class="work-summary-label">
                {{ $wt['ongoing'] }}
            </div>

            <div class="work-summary-number">
                {{ $ongoingWorks }}
            </div>

        </div>

    </div>



    <div class="admin-card work-summary-card">

        <div class="work-summary-icon green">
            ✓
        </div>

        <div>

            <div class="work-summary-label">
                {{ $wt['completed'] }}
            </div>

            <div class="work-summary-number">
                {{ $completedWorks }}
            </div>

        </div>

    </div>


</div>



<div class="admin-card work-panel">


    <div class="work-panel-header">


        <div class="work-panel-title">

            {{ $wt['list'] }}

        </div>


        <form
            method="GET"
            action="{{ route('admin.works.index') }}"
            class="work-filter-form">


            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="
                    admin-form-control
                    work-search
                "
                placeholder="{{ $wt['search_placeholder'] }}">


            <select
                name="project"
                class="
                    admin-form-control
                    work-project-filter
                ">

                <option value="">

                    {{ $wt['all_projects'] }}

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
                name="status"
                class="
                    admin-form-control
                    work-status-filter
                ">

                <option value="">

                    {{ $wt['all_status'] }}

                </option>

                <option
                    value="planned"
                    @selected($status==='planned' )>
                    {{ $wt['planned_status'] }}
                </option>

                <option
                    value="ongoing"
                    @selected($status==='ongoing' )>
                    {{ $wt['ongoing_status'] }}
                </option>

                <option
                    value="completed"
                    @selected($status==='completed' )>
                    {{ $wt['completed_status'] }}
                </option>

                <option
                    value="cancelled"
                    @selected($status==='cancelled' )>
                    {{ $wt['cancelled_status'] }}
                </option>

            </select>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $wt['search'] }}

            </button>


            <a
                href="{{ route('admin.works.index') }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $wt['reset'] }}

            </a>


        </form>


    </div>



    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $wt['no'] }}</th>

                    <th>{{ $wt['work_name'] }}</th>

                    <th>{{ $wt['project'] }}</th>

                    <th>{{ $wt['client'] }}</th>

                    <th>{{ $wt['method'] }}</th>

                    <th>{{ $wt['volume'] }}</th>

                    <th>{{ $wt['total_cost'] }}</th>

                    <th>{{ $wt['status'] }}</th>

                    <th>{{ $wt['visible'] }}</th>

                    <th>{{ $wt['action'] }}</th>

                </tr>

            </thead>


            <tbody>


                @forelse($works as $work)


                @php

                $statusLabel =
                match ($work->status) {

                'ongoing' =>
                $wt['ongoing_status'],

                'completed' =>
                $wt['completed_status'],

                'cancelled' =>
                $wt['cancelled_status'],

                default =>
                $wt['planned_status'],

                };


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


                <tr>


                    <td>

                        {{
                                $works->firstItem()
                                +
                                $loop->index
                            }}

                    </td>


                    <td>

                        <strong>
                            {{ $work->work_name }}
                        </strong>

                    </td>


                    <td>

                        {{
                                $work->project->project_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                optional(
                                    optional(
                                        $work->project
                                    )->client
                                )->user->name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        {{
                                $work->method_type
                                ===
                                'daily'
                                ?
                                $wt['daily']
                                :
                                $wt['contract']
                            }}

                    </td>


                    <td>

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

                    </td>


                    <td>

                        Rp
                        {{
                                number_format(
                                    $work->total_cost,
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
                                    {{ $statusClass }}
                                ">

                            {{ $statusLabel }}

                        </span>

                    </td>


                    <td>


                        @if($work->is_visible_to_client)

                        <span
                            class="
                                        admin-badge
                                        admin-badge-success
                                    ">

                            {{ $wt['shown'] }}

                        </span>

                        @else

                        <span
                            class="
                                        admin-badge
                                        admin-badge-danger
                                    ">

                            {{ $wt['hidden'] }}

                        </span>

                        @endif


                    </td>


                    <td>

                        <div class="work-actions">

                            <a
                                href="{{ route('admin.works.show', $work) }}"
                                class="work-action view"
                                title="Detail Pekerjaan">
                                ◉
                            </a>

                            <a
                                href="{{ route('admin.works.edit', $work) }}"
                                class="work-action edit"
                                title="Edit Pekerjaan">
                                ✎
                            </a>

                        </div>

                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="10"
                        class="work-empty">

                        {{ $wt['empty'] }}

                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>


    @if($works->hasPages())

    <div class="work-pagination">

        {{ $works->links() }}

    </div>

    @endif


</div>


@endsection