@extends('layouts.admin')

@section('title', 'Uang Pribadi - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' => 'Uang Pribadi',

'subtitle' =>
'Kelola penggunaan uang pribadi tim untuk kebutuhan proyek dan status penggantiannya.',

'total' =>
'Total Uang Pribadi',

'unpaid' =>
'Belum Diganti',

'paid' =>
'Sudah Diganti',

'this_month' =>
'Bulan Ini',

'list' =>
'Daftar Uang Pribadi',

'search_placeholder' =>
'Cari nama, proyek, atau keterangan...',

'all_projects' =>
'Semua Proyek',

'all_status' =>
'Semua Status',

'search' =>
'Cari',

'reset' =>
'Reset',

'date' =>
'Tanggal',

'team' =>
'Nama Tim',

'project' =>
'Proyek',

'description' =>
'Keterangan',

'amount' =>
'Jumlah',

'status' =>
'Status',

'reimbursement_date' =>
'Tanggal Ganti',

'action' =>
'Aksi',

'detail' =>
'Detail',

'mark_paid' =>
'Tandai Sudah Diganti',

'mark_unpaid' =>
'Batalkan Penggantian',

'empty' =>
'Belum ada penggunaan uang pribadi.',

],


'en' => [

'title' =>
'Personal Funds',

'subtitle' =>
'Manage personal funds used for project expenses and reimbursement status.',

'total' =>
'Total Personal Funds',

'unpaid' =>
'Not Reimbursed',

'paid' =>
'Reimbursed',

'this_month' =>
'This Month',

'list' =>
'Personal Fund List',

'search_placeholder' =>
'Search name, project, or description...',

'all_projects' =>
'All Projects',

'all_status' =>
'All Status',

'search' =>
'Search',

'reset' =>
'Reset',

'date' =>
'Date',

'team' =>
'Team Member',

'project' =>
'Project',

'description' =>
'Description',

'amount' =>
'Amount',

'status' =>
'Status',

'reimbursement_date' =>
'Reimbursement Date',

'action' =>
'Action',

'detail' =>
'Detail',

'mark_paid' =>
'Mark Reimbursed',

'mark_unpaid' =>
'Cancel Reimbursement',

'empty' =>
'No personal fund records available.',

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

    .personal-page-header {

        margin-bottom: 22px;

        display: flex;

        justify-content:
            space-between;

        align-items:
            flex-end;

        gap: 16px;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .personal-summary-grid {

        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .personal-summary-card {

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .personal-summary-label {

        margin-bottom: 8px;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .personal-summary-value {

        color:
            var(--text-heading);

        font-size: 21px;

        font-weight: 700;
    }


    .personal-summary-value.unpaid {
        color: var(--warning);
    }


    .personal-summary-value.paid {
        color: var(--success);
    }


    .personal-summary-value.month {
        color: var(--primary);
    }


    /* =====================================================
       TABLE CARD
    ===================================================== */

    .personal-list-card {

        overflow: hidden;
    }


    .personal-list-header {

        padding: 17px 18px;

        border-bottom:
            1px solid var(--border);

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 15px;

        flex-wrap: wrap;
    }


    .personal-list-title {

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    /* =====================================================
       FILTER
    ===================================================== */

    .personal-filter {

        display: flex;

        align-items: center;

        justify-content:
            flex-end;

        gap: 7px;

        flex: 1;

        min-width: 0;
    }


    .personal-filter input,
    .personal-filter select {

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


    .personal-filter input {

        width: 220px;
    }


    .personal-filter select {

        width: 145px;
    }


    .personal-filter input:focus,
    .personal-filter select:focus {

        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .personal-filter-btn {

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


    .personal-filter-btn.search {

        background:
            var(--primary);

        color: #fff;
    }


    .personal-filter-btn.reset {

        border:
            1px solid var(--border);

        background:
            var(--input-bg);

        color:
            var(--text-muted);
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .personal-table-wrapper {
        overflow-x: auto;
    }


    .personal-table {

        width: 100%;

        border-collapse:
            collapse;

        font-size: 12px;
    }


    .personal-table th {

        padding:
            12px;

        background:
            rgba(120, 145, 165, .07);

        color:
            var(--text-muted);

        text-align: left;

        white-space: nowrap;

        font-weight: 600;
    }


    .personal-table td {

        padding:
            13px 12px;

        border-top:
            1px solid var(--border);

        color:
            var(--text-main);

        vertical-align: middle;
    }


    .personal-table tbody tr:hover {

        background:
            rgba(8, 119, 212, .025);
    }


    .personal-project {

        color:
            var(--text-heading);

        font-weight: 600;
    }


    .personal-description {

        max-width: 240px;

        overflow: hidden;

        text-overflow:
            ellipsis;

        white-space: nowrap;

        color:
            var(--text-muted);
    }


    .personal-amount {

        color:
            var(--text-heading);

        font-weight: 700;

        white-space: nowrap;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .personal-status {

        padding:
            6px 9px;

        border-radius: 20px;

        display: inline-flex;

        align-items: center;

        white-space: nowrap;

        font-size: 10px;

        font-weight: 700;
    }


    .personal-status.unpaid {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .personal-status.paid {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    /* =====================================================
       ACTIONS
    ===================================================== */

    .personal-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;
    }


    .personal-action {

        min-height: 32px;

        padding:
            0 10px;

        border: none;

        border-radius: 7px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        cursor: pointer;

        font-size: 10px;

        font-weight: 700;
    }


    .personal-action.detail {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .personal-action.paid {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    .personal-action.unpaid {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .personal-action-form {
        display: inline-flex;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .personal-empty {

        padding: 40px;

        color:
            var(--text-muted);

        text-align: center;
    }


    /* =====================================================
       FOOTER SUMMARY
    ===================================================== */

    .personal-status-summary {

        margin-top: 20px;

        padding: 18px;

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 20px;
    }


    .personal-status-box {

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 12px;
    }


    .personal-status-box-label {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .personal-status-box-value {

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }

    .personal-export-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }


    .personal-export-btn {
        min-height: 42px;
        padding: 0 18px;

        border: none;
        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        text-decoration: none;

        cursor: pointer;

        font-size: 11px;
        font-weight: 700;

        transition:
            transform .2s ease,
            background .2s ease;
    }


    /* EXCEL */

    .personal-export-btn.excel {
        background: #dcf7e9;
        color: #087d4b;
    }


    .personal-export-btn.excel:hover {
        background: #c9f1dd;
        color: #087d4b;
        transform: translateY(-1px);
    }


    /* PDF */

    .personal-export-btn.pdf {
        background: #ffe5e5;
        color: #d9363e;
    }


    .personal-export-btn.pdf:hover {
        background: #ffd6d6;
        color: #d9363e;
        transform: translateY(-1px);
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width:1100px) {

        .personal-summary-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }


        .personal-filter {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

    }


    @media(max-width:650px) {

        .personal-summary-grid {
            grid-template-columns:
                1fr;
        }


        .personal-page-header {
            align-items: flex-start;
            flex-direction: column;
        }


        .personal-filter input,
        .personal-filter select {
            width: 100%;
        }


        .personal-filter-btn {
            flex: 1;
        }


        .personal-status-summary {
            grid-template-columns:
                1fr;
        }

        .personal-export-actions {
            width: 100%;
        }


        .personal-export-btn {
            flex: 1;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="personal-page-header">

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


    <div class="personal-export-actions">


        <a
            href="{{
                route(
                    'admin.personal-funds.export.excel',
                    request()->query()
                )
            }}"
            class="personal-export-btn excel">
            ▦ Export Excel
        </a>


        <a
            href="{{
                route(
                    'admin.personal-funds.export.pdf',
                    request()->query()
                )
            }}"
            class="personal-export-btn pdf">
            ▧ Export PDF
        </a>


    </div>

</div>


{{-- =====================================================
     SUMMARY
===================================================== --}}

<div class="personal-summary-grid">


    <div class="personal-summary-card">

        <div class="personal-summary-label">
            {{ $pt['total'] }}
        </div>

        <div class="personal-summary-value">

            Rp {{
                number_format(
                    $totalPersonalFund,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>

    </div>



    <div class="personal-summary-card">

        <div class="personal-summary-label">
            {{ $pt['unpaid'] }}
        </div>

        <div class="personal-summary-value unpaid">

            Rp {{
                number_format(
                    $unpaidPersonalFund,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>

    </div>



    <div class="personal-summary-card">

        <div class="personal-summary-label">
            {{ $pt['paid'] }}
        </div>

        <div class="personal-summary-value paid">

            Rp {{
                number_format(
                    $paidPersonalFund,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>

    </div>



    <div class="personal-summary-card">

        <div class="personal-summary-label">
            {{ $pt['this_month'] }}
        </div>

        <div class="personal-summary-value month">

            Rp {{
                number_format(
                    $thisMonthPersonalFund,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>

    </div>


</div>



{{-- =====================================================
     LIST
===================================================== --}}

<div class="admin-card personal-list-card">


    <div class="personal-list-header">


        <div class="personal-list-title">
            {{ $pt['list'] }}
        </div>



        <form
            method="GET"
            action="{{ route('admin.personal-funds.index') }}"
            class="personal-filter">


            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="{{ $pt['search_placeholder'] }}">


            <select name="project">

                <option value="">
                    {{ $pt['all_projects'] }}
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


            <select name="status">

                <option value="">
                    {{ $pt['all_status'] }}
                </option>

                <option
                    value="unpaid"
                    @selected($status==='unpaid' )>
                    {{ $pt['unpaid'] }}
                </option>

                <option
                    value="paid"
                    @selected($status==='paid' )>
                    {{ $pt['paid'] }}
                </option>

            </select>


            <button
                type="submit"
                class="personal-filter-btn search">
                {{ $pt['search'] }}
            </button>


            <a
                href="{{ route('admin.personal-funds.index') }}"
                class="personal-filter-btn reset">
                {{ $pt['reset'] }}
            </a>


        </form>


    </div>



    {{-- TABLE --}}

    <div class="personal-table-wrapper">

        <table class="personal-table">

            <thead>

                <tr>

                    <th>{{ $pt['date'] }}</th>

                    <th>{{ $pt['team'] }}</th>

                    <th>{{ $pt['project'] }}</th>

                    <th>{{ $pt['description'] }}</th>

                    <th>{{ $pt['amount'] }}</th>

                    <th>{{ $pt['status'] }}</th>

                    <th>
                        {{ $pt['reimbursement_date'] }}
                    </th>

                    <th>{{ $pt['action'] }}</th>

                </tr>

            </thead>


            <tbody>

                @forelse($personalFunds as $personalFund)

                <tr>

                    <td>

                        {{
                                optional(
                                    $personalFund->expense?->expense_date
                                )->format('d M Y')
                            }}

                    </td>


                    <td>

                        {{
                                $personalFund->user?->name
                                ??
                                '-'
                            }}

                    </td>


                    <td class="personal-project">

                        {{
                                $personalFund
                                    ->expense
                                    ?->project
                                    ?->project_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        <div
                            class="personal-description"
                            title="{{
                                    $personalFund->notes
                                    ??
                                    $personalFund->expense?->description
                                    ??
                                    '-'
                                }}">

                            {{
                                    $personalFund->notes
                                    ??
                                    $personalFund->expense?->description
                                    ??
                                    '-'
                                }}

                        </div>

                    </td>


                    <td class="personal-amount">

                        Rp {{
                                number_format(
                                    $personalFund->amount,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                    </td>


                    <td>

                        @if(
                        $personalFund->reimbursement_status
                        ===
                        'paid'
                        )

                        <span class="personal-status paid">
                            {{ $pt['paid'] }}
                        </span>

                        @else

                        <span class="personal-status unpaid">
                            {{ $pt['unpaid'] }}
                        </span>

                        @endif

                    </td>


                    <td>

                        {{
                                $personalFund->reimbursement_date
                                    ? $personalFund
                                        ->reimbursement_date
                                        ->format('d M Y')
                                    : '-'
                            }}

                    </td>


                    <td>

                        <div class="personal-actions">


                            <a
                                href="{{
                                        route(
                                            'admin.personal-funds.show',
                                            $personalFund
                                        )
                                    }}"
                                class="personal-action detail">
                                {{ $pt['detail'] }}
                            </a>



                            @if(
                            $personalFund->reimbursement_status
                            ===
                            'unpaid'
                            )

                            <form
                                method="POST"
                                action="{{
                                            route(
                                                'admin.personal-funds.paid',
                                                $personalFund
                                            )
                                        }}"
                                class="personal-action-form reimbursement-form"
                                data-message="Yakin uang pribadi ini sudah diganti?">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="personal-action paid">
                                    {{ $pt['mark_paid'] }}
                                </button>

                            </form>


                            @else


                            <form
                                method="POST"
                                action="{{
                                            route(
                                                'admin.personal-funds.unpaid',
                                                $personalFund
                                            )
                                        }}"
                                class="personal-action-form reimbursement-form"
                                data-message="Batalkan status sudah diganti?">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="personal-action unpaid">
                                    {{ $pt['mark_unpaid'] }}
                                </button>

                            </form>


                            @endif


                        </div>

                    </td>

                </tr>


                @empty

                <tr>

                    <td
                        colspan="8"
                        class="personal-empty">
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

@if($personalFunds->hasPages())

<div style="margin-top:16px;">

    {{ $personalFunds->links() }}

</div>

@endif



{{-- =====================================================
     STATUS SUMMARY
===================================================== --}}

<div class="admin-card personal-status-summary">


    <div class="personal-status-box">

        <div>

            <div class="personal-status-box-label">
                {{ $pt['unpaid'] }}
            </div>

            <div class="personal-status-box-value">
                {{ $unpaidCount }} transaksi
            </div>

        </div>


        <span class="personal-status unpaid">
            {{ $pt['unpaid'] }}
        </span>

    </div>



    <div class="personal-status-box">

        <div>

            <div class="personal-status-box-label">
                {{ $pt['paid'] }}
            </div>

            <div class="personal-status-box-value">
                {{ $paidCount }} transaksi
            </div>

        </div>


        <span class="personal-status paid">
            {{ $pt['paid'] }}
        </span>

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
                    '.reimbursement-form'
                )
                .forEach(
                    function(form) {

                        form.addEventListener(
                            'submit',
                            function(event) {

                                const message =
                                    form.dataset.message ||
                                    'Yakin melanjutkan?';

                                if (!confirm(message)) {

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