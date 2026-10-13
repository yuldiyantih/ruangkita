@extends('layouts.admin')

@section('title', 'Data Pengeluaran - RuangKita')


@php

$pageLang = auth()->user()->language ?? 'id';

$translations = [

'id' => [

'title' => 'Data Pengeluaran',

'subtitle' =>
'Kelola seluruh pengeluaran proyek dan catatan pembayaran di RuangKita.',

'add_expense' => 'Tambah Pengeluaran',

'total_expense' => 'Total Pengeluaran',

'this_month' => 'Bulan Ini',

'project_fund' => 'Dana Proyek',

'personal_fund' => 'Uang Pribadi',

'list' => 'Daftar Pengeluaran',

'search_placeholder' =>
'Cari keterangan, proyek, atau toko...',

'all_projects' => 'Semua Proyek',

'all_categories' => 'Semua Kategori',

'all_sources' => 'Semua Sumber',

'all_client' => 'Semua Client',

'search' => 'Cari',

'reset' => 'Reset',

'no' => 'No',

'date' => 'Tanggal',

'description' => 'Keterangan',

'project' => 'Proyek',

'category' => 'Kategori',

'funding_source' => 'Sumber Dana',

'amount' => 'Jumlah',

'receipt' => 'Bukti',

'client' => 'Client',

'action' => 'Aksi',

'material' => 'Material',

'labor' => 'Upah',

'transport' => 'Transportasi',

'equipment' => 'Peralatan',

'other' => 'Lain-lain',

'visible' => 'Tampil',

'hidden' => 'Sembunyi',

'has_receipt' => 'Ada Bukti',

'no_receipt' => 'Tidak Ada',

'category_summary' => 'Ringkasan Kategori',

'fund_summary' => 'Rekap Sumber Dana',

'total' => 'Total',

'empty' => 'Belum ada data pengeluaran.',

],


'en' => [

'title' => 'Expenses',

'subtitle' =>
'Manage all project expenses and payment records in RuangKita.',

'add_expense' => 'Add Expense',

'total_expense' => 'Total Expenses',

'this_month' => 'This Month',

'project_fund' => 'Project Fund',

'personal_fund' => 'Personal Fund',

'list' => 'Expense List',

'search_placeholder' =>
'Search description, project, or store...',

'all_projects' => 'All Projects',

'all_categories' => 'All Categories',

'all_sources' => 'All Sources',

'all_client' => 'All Client Visibility',

'search' => 'Search',

'reset' => 'Reset',

'no' => 'No',

'date' => 'Date',

'description' => 'Description',

'project' => 'Project',

'category' => 'Category',

'funding_source' => 'Funding Source',

'amount' => 'Amount',

'receipt' => 'Receipt',

'client' => 'Client',

'action' => 'Action',

'material' => 'Material',

'labor' => 'Labor',

'transport' => 'Transport',

'equipment' => 'Equipment',

'other' => 'Other',

'visible' => 'Visible',

'hidden' => 'Hidden',

'has_receipt' => 'Available',

'no_receipt' => 'None',

'category_summary' => 'Category Summary',

'fund_summary' => 'Funding Summary',

'total' => 'Total',

'empty' => 'No expense data available.',

],

];


$et =
$translations[$pageLang]
??
$translations['id'];

@endphp



@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .expense-page-header {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }


    /* =====================================================
       SUMMARY CARDS
    ===================================================== */

    .expense-summary-grid {
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }


    .expense-summary-card {
        min-height: 105px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }


    .expense-summary-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }


    .expense-summary-icon.orange {
        background: var(--warning-bg);
        color: var(--warning);
    }


    .expense-summary-icon.blue {
        background: var(--primary-soft);
        color: var(--primary);
    }


    .expense-summary-icon.green {
        background: var(--success-bg);
        color: var(--success);
    }


    .expense-summary-icon.purple {
        background: rgba(111, 66, 217, .12);
        color: #7551d7;
    }


    .expense-summary-label {
        margin-bottom: 5px;
        color: var(--text-muted);
        font-size: 13px;
    }


    .expense-summary-number {
        color: var(--text-heading);
        font-size: 21px;
        font-weight: 700;
    }


    /* =====================================================
       DAFTAR PENGELUARAN
    ===================================================== */

    .expense-panel {
        overflow: hidden;
    }


    .expense-panel-header {
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        border-bottom: 1px solid var(--border);
    }


    .expense-panel-title {
        flex: 0 0 auto;
        margin-right: auto;
        color: var(--text-heading);
        font-size: 17px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* SEARCH + FILTER SATU BARIS */

    .expense-filter-form {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: nowrap;
    }


    .expense-filter-form .admin-form-control {
        height: 42px;
        min-height: 42px;
        min-width: 0;
    }


    .expense-search {
        width: 225px;
    }


    .expense-project-filter {
        width: 155px;
    }


    .expense-category-filter {
        width: 145px;
    }


    .expense-source-filter {
        width: 150px;
    }


    .expense-client-filter {
        width: 135px;
    }


    .expense-filter-form .admin-btn {
        height: 42px;
        min-height: 42px;
        padding-left: 15px;
        padding-right: 15px;
        white-space: nowrap;
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .expense-description-title {
        color: var(--text-heading);
        font-weight: 600;
    }


    .expense-description-store {
        margin-top: 3px;
        color: var(--text-muted);
        font-size: 12px;
    }


    .expense-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }


    .expense-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }


    .expense-action.view {
        background: var(--primary-soft);
        color: var(--primary);
    }


    .expense-action.edit {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .expense-action.delete {
        background: var(--danger-bg);
        color: var(--danger);
    }

    .expense-action.delete:hover {
        background: var(--danger);
        color: #fff;
    }

    .expense-delete-form {
        margin: 0;
        padding: 0;
        display: inline-flex;
    }

    .expense-receipt {
        font-size: 13px;
        white-space: nowrap;
    }


    .expense-receipt-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }


    .expense-receipt-link:hover {
        text-decoration: underline;
    }


    .expense-empty {
        padding: 40px 20px !important;
        text-align: center;
        color: var(--text-muted) !important;
    }


    .expense-pagination {
        padding: 16px 18px;
    }


    /* =====================================================
       BOTTOM SUMMARY
    ===================================================== */

    .expense-bottom-grid {
        margin-top: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }


    .expense-bottom-card {
        min-height: 235px;
        padding: 20px;
    }


    .expense-bottom-title {
        margin-bottom: 20px;
        color: var(--text-heading);
        font-size: 17px;
        font-weight: 700;
    }


    /* =====================================================
       CATEGORY SUMMARY
    ===================================================== */

    .expense-category-visual-row {
        display: grid;
        grid-template-columns: 135px 1fr 125px 45px;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }


    .expense-category-visual-row:last-child {
        margin-bottom: 0;
    }


    .expense-category-info {
        display: flex;
        align-items: center;
        gap: 9px;
    }


    .expense-category-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 13px;
    }


    .expense-category-icon.material {
        background: rgba(14, 165, 233, .12);
        color: #0ea5e9;
    }


    .expense-category-icon.labor {
        background: rgba(139, 92, 246, .12);
        color: #8b5cf6;
    }


    .expense-category-icon.transport {
        background: rgba(249, 115, 22, .12);
        color: #f97316;
    }


    .expense-category-icon.equipment {
        background: rgba(16, 185, 129, .12);
        color: #10b981;
    }


    .expense-category-icon.other {
        background: rgba(100, 116, 139, .12);
        color: #64748b;
    }


    .expense-category-name {
        color: var(--text-main);
        font-size: 13px;
        font-weight: 500;
    }


    .expense-progress {
        width: 100%;
        height: 8px;
        overflow: hidden;
        border-radius: 999px;
        background: rgba(148, 163, 184, .18);
    }


    .expense-progress-bar {
        width: 0;
        height: 100%;
        border-radius: 999px;
        transition: width .4s ease;
    }


    .expense-progress-bar.material {
        background: #38aaf8;
    }


    .expense-progress-bar.labor {
        background: #8b5cf6;
    }


    .expense-progress-bar.transport {
        background: #fb923c;
    }


    .expense-progress-bar.equipment {
        background: #10b981;
    }


    .expense-progress-bar.other {
        background: #94a3b8;
    }


    .expense-category-amount {
        color: var(--text-heading);
        font-size: 13px;
        font-weight: 600;
        text-align: right;
        white-space: nowrap;
    }


    .expense-category-percent {
        color: var(--text-muted);
        font-size: 13px;
        text-align: right;
    }


    /* =====================================================
       FUNDING SUMMARY
    ===================================================== */

    .expense-fund-wrapper {
        min-height: 155px;
        display: flex;
        align-items: center;
        gap: 28px;
    }


    .expense-fund-left {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-shrink: 0;
    }


    /* DONUT */

    .expense-donut {
        width: 105px;
        height: 105px;
        position: relative;
        flex-shrink: 0;
        border-radius: 50%;
        background: #e5e7eb;
    }


    .expense-donut::after {
        content: "";
        position: absolute;
        inset: 20px;
        border-radius: 50%;
        background: var(--card-bg, #fff);
    }


    /* TOTAL DI SAMPING DONUT */

    .expense-fund-total-box {
        min-width: 135px;
    }


    .expense-fund-total-value {
        margin-bottom: 4px;
        color: var(--text-heading);
        font-size: 16px;
        font-weight: 700;
        white-space: nowrap;
    }


    .expense-fund-total-label {
        color: var(--text-muted);
        font-size: 12px;
    }


    /* DETAIL SUMBER DANA */

    .expense-fund-details {
        flex: 1;
        min-width: 0;
        padding-left: 22px;
        border-left: 1px solid var(--border);
    }


    .expense-fund-row {
        padding: 11px 0;
        display: grid;
        grid-template-columns: 16px minmax(90px, 1fr) auto 45px;
        align-items: center;
        gap: 8px;
    }


    .expense-fund-row+.expense-fund-row {
        border-top: 1px solid var(--border);
    }


    .expense-fund-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }


    .expense-fund-dot.project {
        background: #2fbd78;
    }


    .expense-fund-dot.personal {
        background: #8b5cf6;
    }


    .expense-fund-name {
        color: var(--text-main);
        font-size: 13px;
    }


    .expense-fund-amount {
        color: var(--text-heading);
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }


    .expense-fund-percent {
        color: var(--text-muted);
        font-size: 13px;
        text-align: right;
        white-space: nowrap;
    }

    .expense-header-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1380px) {

        .expense-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }


        .expense-panel-title {
            margin-right: 0;
        }


        .expense-filter-form {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

    }


    @media(max-width: 1050px) {

        .expense-fund-wrapper {
            align-items: flex-start;
            flex-direction: column;
        }


        .expense-fund-details {
            width: 100%;
            padding-left: 0;
            padding-top: 10px;
            border-left: none;
            border-top: 1px solid var(--border);
        }

    }


    @media(max-width: 900px) {

        .expense-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }


        .expense-bottom-grid {
            grid-template-columns: 1fr;
        }

    }


    @media(max-width: 650px) {

        .expense-page-header {
            align-items: flex-start;
            flex-direction: column;
        }


        .expense-summary-grid {
            grid-template-columns: 1fr;
        }


        .expense-filter-form {
            flex-direction: column;
            align-items: stretch;
        }


        .expense-search,
        .expense-project-filter,
        .expense-category-filter,
        .expense-source-filter,
        .expense-client-filter {
            width: 100%;
        }


        .expense-filter-form .admin-btn {
            width: 100%;
        }


        .expense-category-visual-row {
            grid-template-columns: 120px 1fr;
        }


        .expense-category-amount,
        .expense-category-percent {
            text-align: left;
        }


        .expense-fund-left {
            width: 100%;
        }


        .expense-fund-row {
            grid-template-columns: 16px 1fr;
        }


        .expense-fund-amount,
        .expense-fund-percent {
            text-align: left;
        }

        @media(max-width:650px) {

            .expense-header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .expense-header-actions .admin-btn {
                flex: 1;
            }

        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     PAGE HEADER
===================================================== --}}

<div class="expense-page-header">

    <div>

        <h1 class="admin-page-title">
            {{ $et['title'] }}
        </h1>

        <p class="admin-page-subtitle">
            {{ $et['subtitle'] }}
        </p>

    </div>


    <div class="expense-header-actions">


        {{-- EXCEL --}}
        <a
            href="{{
            route(
                'admin.expenses.export.excel',
                request()->query()
            )
        }}"
            class="admin-btn admin-btn-success">
            ▦ Export Excel
        </a>


        {{-- PDF --}}
        <a
            href="{{
            route(
                'admin.expenses.export.pdf',
                request()->query()
            )
        }}"
            class="admin-btn admin-btn-danger">
            ▧ Export PDF
        </a>


        {{-- ADD --}}
        <a
            href="{{ route('admin.expenses.create') }}"
            class="admin-btn admin-btn-primary">
            ＋ {{ $et['add_expense'] }}
        </a>


    </div>

</div>



{{-- =====================================================
     SUMMARY CARDS
===================================================== --}}

<div class="expense-summary-grid">


    <div class="admin-card expense-summary-card">

        <div class="expense-summary-icon orange">
            Rp
        </div>

        <div>

            <div class="expense-summary-label">
                {{ $et['total_expense'] }}
            </div>

            <div class="expense-summary-number">

                Rp {{
                    number_format(
                        $totalExpense,
                        0,
                        ',',
                        '.'
                    )
                }}

            </div>

        </div>

    </div>



    <div class="admin-card expense-summary-card">

        <div class="expense-summary-icon blue">
            ▣
        </div>

        <div>

            <div class="expense-summary-label">
                {{ $et['this_month'] }}
            </div>

            <div class="expense-summary-number">

                Rp {{
                    number_format(
                        $thisMonthExpense,
                        0,
                        ',',
                        '.'
                    )
                }}

            </div>

        </div>

    </div>



    <div class="admin-card expense-summary-card">

        <div class="expense-summary-icon green">
            ◔
        </div>

        <div>

            <div class="expense-summary-label">
                {{ $et['project_fund'] }}
            </div>

            <div class="expense-summary-number">

                Rp {{
                    number_format(
                        $projectFundExpense,
                        0,
                        ',',
                        '.'
                    )
                }}

            </div>

        </div>

    </div>



    <div class="admin-card expense-summary-card">

        <div class="expense-summary-icon purple">
            ◎
        </div>

        <div>

            <div class="expense-summary-label">
                {{ $et['personal_fund'] }}
            </div>

            <div class="expense-summary-number">

                Rp {{
                    number_format(
                        $personalFundExpense,
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
     DAFTAR PENGELUARAN
===================================================== --}}

<div class="admin-card expense-panel">


    <div class="expense-panel-header">


        <div class="expense-panel-title">
            {{ $et['list'] }}
        </div>


        <form
            method="GET"
            action="{{ route('admin.expenses.index') }}"
            class="expense-filter-form">


            {{-- SEARCH --}}

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="admin-form-control expense-search"
                placeholder="{{ $et['search_placeholder'] }}">


            {{-- PROJECT --}}

            <select
                name="project"
                class="admin-form-control expense-project-filter">

                <option value="">
                    {{ $et['all_projects'] }}
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


            {{-- CATEGORY --}}

            <select
                name="category"
                class="admin-form-control expense-category-filter">

                <option value="">
                    {{ $et['all_categories'] }}
                </option>


                <option
                    value="material"
                    @selected($category==='material' )>
                    {{ $et['material'] }}
                </option>


                <option
                    value="labor"
                    @selected($category==='labor' )>
                    {{ $et['labor'] }}
                </option>


                <option
                    value="transport"
                    @selected($category==='transport' )>
                    {{ $et['transport'] }}
                </option>


                <option
                    value="equipment"
                    @selected($category==='equipment' )>
                    {{ $et['equipment'] }}
                </option>


                <option
                    value="other"
                    @selected($category==='other' )>
                    {{ $et['other'] }}
                </option>

            </select>


            {{-- FUNDING SOURCE --}}

            <select
                name="funding_source"
                class="admin-form-control expense-source-filter">

                <option value="">
                    {{ $et['all_sources'] }}
                </option>


                <option
                    value="project"
                    @selected($fundingSource==='project' )>
                    {{ $et['project_fund'] }}
                </option>


                <option
                    value="personal"
                    @selected($fundingSource==='personal' )>
                    {{ $et['personal_fund'] }}
                </option>

            </select>


            {{-- CLIENT VISIBILITY --}}

            <select
                name="visibility"
                class="admin-form-control expense-client-filter">

                <option value="">
                    {{ $et['all_client'] }}
                </option>


                <option
                    value="1"
                    @selected((string) $visibility==='1' )>
                    {{ $et['visible'] }}
                </option>


                <option
                    value="0"
                    @selected((string) $visibility==='0' )>
                    {{ $et['hidden'] }}
                </option>

            </select>


            <button
                type="submit"
                class="admin-btn admin-btn-primary">
                {{ $et['search'] }}
            </button>


            <a
                href="{{ route('admin.expenses.index') }}"
                class="admin-btn admin-btn-secondary">
                {{ $et['reset'] }}
            </a>


        </form>


    </div>



    {{-- =================================================
         TABLE
    ================================================== --}}

    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $et['no'] }}</th>

                    <th>{{ $et['date'] }}</th>

                    <th>{{ $et['description'] }}</th>

                    <th>{{ $et['project'] }}</th>

                    <th>{{ $et['category'] }}</th>

                    <th>{{ $et['funding_source'] }}</th>

                    <th>{{ $et['amount'] }}</th>

                    <th>{{ $et['receipt'] }}</th>

                    <th>{{ $et['client'] }}</th>

                    <th>{{ $et['action'] }}</th>

                </tr>

            </thead>


            <tbody>


                @forelse($expenses as $expense)


                @php

                $categoryLabel =
                match ($expense->category) {

                'material' =>
                $et['material'],

                'labor' =>
                $et['labor'],

                'transport' =>
                $et['transport'],

                'equipment' =>
                $et['equipment'],

                default =>
                $et['other'],

                };


                $categoryClass =
                match ($expense->category) {

                'material' =>
                'admin-badge-primary',

                'labor' =>
                'admin-badge-warning',

                'transport' =>
                'admin-badge-warning',

                'equipment' =>
                'admin-badge-primary',

                default =>
                '',

                };

                @endphp


                <tr>


                    <td>

                        {{
                                $expenses->firstItem()
                                +
                                $loop->index
                            }}

                    </td>


                    <td>

                        {{
                                $expense->expense_date
                                    ? $expense->expense_date->format('d M Y')
                                    : '-'
                            }}

                    </td>


                    <td>

                        <div class="expense-description-title">

                            {{
                                    $expense->description
                                    ?: $categoryLabel
                                }}

                        </div>


                        @if($expense->store_name)

                        <div class="expense-description-store">

                            {{ $expense->store_name }}

                        </div>

                        @endif

                    </td>


                    <td>

                        {{
                                $expense->project->project_name
                                ??
                                '-'
                            }}

                    </td>


                    <td>

                        <span
                            class="admin-badge {{ $categoryClass }}">
                            {{ $categoryLabel }}
                        </span>

                    </td>


                    <td>

                        @if(
                        $expense->funding_source
                        ===
                        'personal'
                        )

                        <span
                            class="
                                        admin-badge
                                        admin-badge-warning
                                    ">
                            {{ $et['personal_fund'] }}
                        </span>

                        @else

                        <span
                            class="
                                        admin-badge
                                        admin-badge-success
                                    ">
                            {{ $et['project_fund'] }}
                        </span>

                        @endif

                    </td>


                    <td>

                        <strong>

                            Rp {{
                                    number_format(
                                        $expense->amount,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                        </strong>

                    </td>


                    <td class="expense-receipt">

                        @if($expense->receipt_path)

                        <a
                            href="{{ asset('storage/' . $expense->receipt_path) }}"
                            target="_blank"
                            class="expense-receipt-link">
                            📄 {{ $et['has_receipt'] }}
                        </a>

                        @else

                        <span style="color:var(--text-muted);">

                            {{ $et['no_receipt'] }}

                        </span>

                        @endif

                    </td>


                    <td>

                        @if($expense->is_visible_to_client)

                        <span
                            class="
                                        admin-badge
                                        admin-badge-success
                                    ">
                            {{ $et['visible'] }}
                        </span>

                        @else

                        <span
                            class="
                                        admin-badge
                                        admin-badge-danger
                                    ">
                            {{ $et['hidden'] }}
                        </span>

                        @endif

                    </td>


                    <td>

                        <div class="expense-actions">


                            <a
                                href="{{ route('admin.expenses.show', $expense) }}"
                                class="expense-action view"
                                title="Detail">
                                ◉
                            </a>


                            <a
                                href="{{ route('admin.expenses.edit', $expense) }}"
                                class="expense-action edit"
                                title="Edit">
                                ✎
                            </a>

                            {{-- DELETE --}}
                            <form
                                method="POST"
                                action="{{ route('admin.expenses.destroy', $expense) }}"
                                class="expense-delete-form">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="expense-action delete"
                                    title="Hapus">
                                    🗑
                                </button>

                            </form>


                        </div>

                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="10"
                        class="expense-empty">

                        {{ $et['empty'] }}

                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>



    @if($expenses->hasPages())

    <div class="expense-pagination">

        {{ $expenses->links() }}

    </div>

    @endif


</div>



{{-- =====================================================
     HITUNG PERSENTASE
===================================================== --}}

@php

$projectPercent =
$totalExpense > 0
? round(
($projectFundExpense / $totalExpense) * 100
)
: 0;


$personalPercent =
$totalExpense > 0
? round(
($personalFundExpense / $totalExpense) * 100
)
: 0;

@endphp



{{-- =====================================================
     BOTTOM SUMMARY
===================================================== --}}

<div class="expense-bottom-grid">


    {{-- =================================================
         RINGKASAN KATEGORI
    ================================================== --}}

    <div class="admin-card expense-bottom-card">

        <div class="expense-bottom-title">
            {{ $et['category_summary'] }}
        </div>


        @forelse($categorySummary as $item)


        @php

        $summaryLabel =
        match ($item->category) {

        'material' =>
        $et['material'],

        'labor' =>
        $et['labor'],

        'transport' =>
        $et['transport'],

        'equipment' =>
        $et['equipment'],

        default =>
        $et['other'],

        };


        $summaryIcon =
        match ($item->category) {

        'material' => '◆',

        'labor' => '♟',

        'transport' => '▰',

        'equipment' => '⚙',

        default => '•••',

        };


        $categoryPercent =
        $totalExpense > 0
        ? round(
        ($item->total / $totalExpense) * 100
        )
        : 0;

        @endphp


        <div class="expense-category-visual-row">


            <div class="expense-category-info">

                <div
                    class="
                            expense-category-icon
                            {{ $item->category }}
                        ">
                    {{ $summaryIcon }}
                </div>


                <span class="expense-category-name">
                    {{ $summaryLabel }}
                </span>

            </div>



            <div class="expense-progress">

                <div
                    class="
                            expense-progress-bar
                            {{ $item->category }}
                        "
                    data-width="{{ $categoryPercent }}"></div>

            </div>



            <div class="expense-category-amount">

                Rp {{
                        number_format(
                            $item->total,
                            0,
                            ',',
                            '.'
                        )
                    }}

            </div>



            <div class="expense-category-percent">
                {{ $categoryPercent }}%
            </div>


        </div>


        @empty


        <div style="color:var(--text-muted);">

            {{ $et['empty'] }}

        </div>


        @endforelse


    </div>



    {{-- =================================================
         REKAP SUMBER DANA
    ================================================== --}}

    <div class="admin-card expense-bottom-card">

        <div class="expense-bottom-title">
            {{ $et['fund_summary'] }}
        </div>


        <div class="expense-fund-wrapper">


            {{-- DONUT + TOTAL --}}
            <div class="expense-fund-left">


                <div
                    class="expense-donut"
                    id="expenseFundDonut"
                    data-project="{{ $projectPercent }}"
                    data-personal="{{ $personalPercent }}"></div>


                <div class="expense-fund-total-box">

                    <div class="expense-fund-total-value">

                        Rp {{
                            number_format(
                                $totalExpense,
                                0,
                                ',',
                                '.'
                            )
                        }}

                    </div>


                    <div class="expense-fund-total-label">
                        {{ $et['total_expense'] }}
                    </div>

                </div>


            </div>



            {{-- DETAIL --}}
            <div class="expense-fund-details">


                {{-- DANA PROYEK --}}
                <div class="expense-fund-row">

                    <span
                        class="expense-fund-dot project"></span>


                    <span class="expense-fund-name">
                        {{ $et['project_fund'] }}
                    </span>


                    <span class="expense-fund-amount">

                        Rp {{
                            number_format(
                                $projectFundExpense,
                                0,
                                ',',
                                '.'
                            )
                        }}

                    </span>


                    <span class="expense-fund-percent">
                        {{ $projectPercent }}%
                    </span>

                </div>



                {{-- UANG PRIBADI --}}
                <div class="expense-fund-row">

                    <span
                        class="expense-fund-dot personal"></span>


                    <span class="expense-fund-name">
                        {{ $et['personal_fund'] }}
                    </span>


                    <span class="expense-fund-amount">

                        Rp {{
                            number_format(
                                $personalFundExpense,
                                0,
                                ',',
                                '.'
                            )
                        }}

                    </span>


                    <span class="expense-fund-percent">
                        {{ $personalPercent }}%
                    </span>

                </div>


            </div>


        </div>


    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | PROGRESS BAR KATEGORI
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.expense-progress-bar')
            .forEach(function(bar) {

                const percentage =
                    parseFloat(
                        bar.dataset.width || 0
                    );


                bar.style.width =
                    Math.min(
                        Math.max(
                            percentage,
                            0
                        ),
                        100
                    ) + '%';

            });



        /*
        |--------------------------------------------------------------------------
        | DONUT SUMBER DANA
        |--------------------------------------------------------------------------
        */

        const donut =
            document.getElementById(
                'expenseFundDonut'
            );


        if (!donut) {
            return;
        }


        const projectPercent =
            parseFloat(
                donut.dataset.project || 0
            );


        const personalPercent =
            parseFloat(
                donut.dataset.personal || 0
            );


        if (
            projectPercent === 0 &&
            personalPercent === 0
        ) {

            donut.style.background =
                '#e5e7eb';

            return;
        }


        donut.style.background =
            'conic-gradient(' +
            '#2fbd78 0% ' +
            projectPercent + '%,' +
            '#8b5cf6 ' +
            projectPercent + '% 100%' +
            ')';

        /*
|--------------------------------------------------------------------------
| KONFIRMASI HAPUS PENGELUARAN
|--------------------------------------------------------------------------
*/

        document
            .querySelectorAll('.expense-delete-form')
            .forEach(function(form) {

                form.addEventListener(
                    'submit',
                    function(event) {

                        const confirmed =
                            confirm(
                                'Yakin ingin menghapus transaksi pengeluaran ini?\n\n' +
                                'Data yang sudah dihapus tidak dapat dikembalikan.'
                            );

                        if (!confirmed) {
                            event.preventDefault();
                        }

                    }
                );

            });


    });
</script>

@endpush