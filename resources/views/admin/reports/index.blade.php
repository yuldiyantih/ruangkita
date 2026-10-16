@extends('layouts.admin')

@section('title', 'Laporan - RuangKita')


@push('styles')

<style>
    .report-page-head {
        margin-bottom: 18px;

        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }


    .report-page-head h1 {
        margin: 0 0 5px;

        color: var(--text-heading);

        font-size: 27px;
    }


    .report-page-head p {
        margin: 0;

        color: var(--text-muted);

        font-size: 12px;
    }


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    .report-summary-grid {
        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 14px;
    }


    .report-summary-card {
        min-height: 86px;

        padding: 16px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        display: flex;
        align-items: center;

        gap: 13px;

        background:
            var(--card-bg);
    }


    .report-summary-icon {
        width: 45px;
        height: 45px;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 18px;
    }


    .report-summary-icon.blue {
        background: #e7f3ff;
        color: #0877d2;
    }


    .report-summary-icon.green {
        background: #e3f8ee;
        color: #119463;
    }


    .report-summary-icon.orange {
        background: #fff0e0;
        color: #dd7300;
    }


    .report-summary-icon.purple {
        background: #f0e8ff;
        color: #7650e6;
    }


    .report-summary-label {
        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .report-summary-value {
        color:
            var(--text-heading);

        font-size: 18px;

        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */

    .report-filter-panel {
        margin-bottom: 18px;

        padding: 15px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);
    }


    .report-filter-form {
        display: grid;

        grid-template-columns:
            1fr 1fr auto auto auto;

        gap: 12px;

        align-items: end;
    }


    .filter-group label {
        margin-bottom: 6px;

        display: block;

        color:
            var(--text-muted);

        font-size: 9px;

        font-weight: 600;
    }


    .filter-control {
        width: 100%;

        min-height: 39px;

        padding: 0 11px;

        border:
            1px solid var(--border);

        border-radius: 8px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 10px;
    }


    .btn-filter {
        height: 39px;

        padding:
            0 18px;

        border: 0;

        border-radius: 8px;

        background:
            var(--primary);

        color: #fff;

        cursor: pointer;

        font-size: 10px;

        font-weight: 700;
    }

    .btn-export {
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
            opacity .2s ease,
            background .2s ease;
    }


    /* EXCEL */

    .btn-export.excel {
        background: #dcf7e9;
        color: #087d4b;
    }


    .btn-export.excel:hover {
        background: #c9f1dd;
        color: #087d4b;
        transform: translateY(-1px);
    }


    /* PDF */

    .btn-export.pdf {
        background: #ffe5e5;
        color: #d9363e;
    }


    .btn-export.pdf:hover {
        background: #ffd6d6;
        color: #d9363e;
        transform: translateY(-1px);
    }

    /*
    |--------------------------------------------------------------------------
    | CHART GRID
    |--------------------------------------------------------------------------
    */

    .report-chart-grid {
        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            2fr 1fr;

        gap: 16px;
    }


    .report-panel {
        padding: 16px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);
    }


    .report-panel-title {
        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 13px;

        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | BAR CHART
    |--------------------------------------------------------------------------
    */

    .chart-legend {
        margin-bottom: 12px;

        display: flex;
        justify-content: flex-end;

        gap: 14px;

        color:
            var(--text-muted);

        font-size: 8px;
    }


    .legend-item {
        display: flex;
        align-items: center;

        gap: 5px;
    }


    .legend-dot {
        width: 8px;
        height: 8px;

        border-radius: 50%;
    }


    .legend-dot.budget {
        background: #2294ef;
    }


    .legend-dot.expense {
        background: #41bf8b;
    }


    .bar-chart {
        height: 245px;

        padding-top: 14px;

        display: flex;
        align-items: flex-end;

        gap: 14px;

        border-bottom:
            1px solid var(--border);
    }


    .bar-group {
        height: 100%;

        flex: 1;

        display: flex;
        flex-direction: column;
        justify-content: flex-end;

        min-width: 0;
    }


    .bar-columns {
        height: 190px;

        display: flex;
        align-items: flex-end;
        justify-content: center;

        gap: 5px;
    }


    .bar {
        width: 24px;

        min-height: 2px;

        border-radius:
            4px 4px 0 0;
    }


    .bar.budget {
        background:
            #2294ef;
    }


    .bar.expense {
        background:
            #41bf8b;
    }


    .bar-label {
        min-height: 37px;

        margin-top: 8px;

        color:
            var(--text-muted);

        font-size: 8px;

        line-height: 1.3;

        text-align: center;

        overflow: hidden;
    }


    /*
    |--------------------------------------------------------------------------
    | DONUT
    |--------------------------------------------------------------------------
    */

    .status-content {
        display: grid;

        grid-template-columns:
            160px 1fr;

        gap: 20px;

        align-items: center;
    }


    .status-donut {
        width: 145px;
        height: 145px;

        position: relative;

        border-radius: 50%;

        background:
            conic-gradient(#ffca3a 0 25%,
                #2294ef 25% 75%,
                #41bf8b 75% 100%);
    }


    .status-donut::after {
        content: '';

        width: 82px;
        height: 82px;

        position: absolute;

        top: 50%;
        left: 50%;

        transform:
            translate(-50%, -50%);

        border-radius: 50%;

        background:
            var(--card-bg);
    }


    .status-donut-center {
        position: absolute;

        z-index: 2;

        top: 50%;
        left: 50%;

        transform:
            translate(-50%, -50%);

        color:
            var(--text-heading);

        text-align: center;
    }


    .status-donut-number {
        font-size: 18px;

        font-weight: 700;
    }


    .status-donut-label {
        font-size: 8px;

        color:
            var(--text-muted);
    }


    .status-list {
        display: flex;

        flex-direction: column;

        gap: 11px;
    }


    .status-row {
        display: grid;

        grid-template-columns:
            9px 1fr auto;

        gap: 7px;

        align-items: center;

        color:
            var(--text-main);

        font-size: 9px;
    }


    .status-color {
        width: 8px;
        height: 8px;

        border-radius: 50%;
    }


    .planning {
        background: #ffca3a;
    }


    .ongoing {
        background: #2294ef;
    }


    .completed {
        background: #41bf8b;
    }


    .paused {
        background: #ff8a52;
    }


    /*
    |--------------------------------------------------------------------------
    | LOWER GRID
    |--------------------------------------------------------------------------
    */

    .report-lower-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 2.2fr) minmax(260px, .8fr);

        gap: 16px;
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    .report-table-wrap {
        overflow-x: auto;
    }


    .report-table {
        width: 100%;

        border-collapse: collapse;
    }


    .report-table th {
        padding: 10px 9px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-muted);

        font-size: 8px;

        text-align: left;
    }


    .report-table td {
        padding: 11px 9px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-main);

        font-size: 9px;

        vertical-align: middle;
    }


    .project-name {
        color:
            var(--text-heading);

        font-weight: 700;
    }


    .progress-cell {
        min-width: 110px;
    }


    .progress-row {
        display: flex;

        align-items: center;

        gap: 7px;
    }


    .progress-track {
        width: 68px;
        height: 6px;

        overflow: hidden;

        border-radius: 50px;

        background:
            #dfe8ef;
    }


    .progress-fill {
        width: 0;

        height: 100%;

        border-radius: 50px;

        background:
            var(--primary);
    }


    .progress-number {
        color:
            var(--text-muted);

        font-size: 8px;
    }


    .status-badge {
        padding:
            5px 9px;

        border-radius: 20px;

        display: inline-block;

        font-size: 8px;

        font-weight: 700;
    }


    .status-badge.ongoing {
        background: #dff7eb;

        color: #118557;
    }


    .status-badge.completed {
        background: #dff7eb;

        color: #118557;
    }


    .status-badge.planning {
        background: #fff2cc;

        color: #9b7000;
    }


    .status-badge.paused {
        background: #ffe6da;

        color: #c75922;
    }


    /*
    |--------------------------------------------------------------------------
    | INSIGHT
    |--------------------------------------------------------------------------
    */

    .insight-list {
        display: flex;

        flex-direction: column;
    }


    .insight-item {
        padding:
            14px 0;

        border-bottom:
            1px solid var(--border);

        display: flex;

        gap: 11px;
    }


    .insight-item:last-child {
        border-bottom: 0;
    }


    .insight-icon {
        width: 38px;
        height: 38px;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 17px;
    }


    .insight-icon.red {
        background: #ffe8e8;
    }


    .insight-icon.green {
        background: #e1f8ee;
    }


    .insight-icon.orange {
        background: #fff2d9;
    }


    .insight-title {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 9px;

        font-weight: 700;

        line-height: 1.4;
    }


    .insight-text {
        color:
            var(--text-muted);

        font-size: 8px;

        line-height: 1.45;
    }


    .empty-report {
        padding: 40px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 11px;
    }

    .btn-export {
        text-decoration: none;
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 1100px) {

        .report-summary-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .report-chart-grid {
            grid-template-columns: 1fr;
        }

        .report-lower-grid {
            grid-template-columns: 1fr;
        }

        .report-filter-form {
            grid-template-columns:
                1fr 1fr;
        }

    }


    @media(max-width: 650px) {

        .report-summary-grid {
            grid-template-columns: 1fr;
        }

        .report-filter-form {
            grid-template-columns: 1fr;
        }

        .status-content {
            grid-template-columns: 1fr;
        }

    }
</style>

@endpush



@section('content')


<div class="report-page-head">

    <div>

        <h1>
            Laporan
        </h1>

        <p>
            Kelola ringkasan laporan proyek,
            keuangan, dan progress RuangKita.
        </p>

    </div>

</div>



{{-- =========================================================
     SUMMARY
========================================================= --}}

<div class="report-summary-grid">

    <div class="report-summary-card">

        <div class="report-summary-icon blue">
            ▣
        </div>

        <div>

            <div class="report-summary-label">
                Total Proyek
            </div>

            <div class="report-summary-value">
                {{ $totalProjects }}
            </div>

        </div>

    </div>


    <div class="report-summary-card">

        <div class="report-summary-icon green">
            Rp
        </div>

        <div>

            <div class="report-summary-label">
                Total Anggaran
            </div>

            <div class="report-summary-value">

                Rp {{
                    number_format(
                        $totalBudget,
                        0,
                        ',',
                        '.'
                    )
                }}

            </div>

        </div>

    </div>


    <div class="report-summary-card">

        <div class="report-summary-icon orange">
            ▤
        </div>

        <div>

            <div class="report-summary-label">
                Total Pengeluaran
            </div>

            <div class="report-summary-value">

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


    <div class="report-summary-card">

        <div class="report-summary-icon purple">
            ↗
        </div>

        <div>

            <div class="report-summary-label">
                Rata-rata Progress
            </div>

            <div class="report-summary-value">
                {{ $averageProgress }}%
            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     FILTER
========================================================= --}}

<div class="report-filter-panel">

    <form
        method="GET"
        action="{{ route('admin.reports.index') }}"
        class="report-filter-form">

        <div class="filter-group">

            <label>
                Pilih Proyek
            </label>

            <select
                name="project"
                class="filter-control">

                <option value="">
                    Semua Proyek
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

        </div>


        <div class="filter-group">

            <label>
                Pilih Periode
            </label>

            <select
                name="period"
                class="filter-control">

                <option
                    value="all"
                    @selected($period==='all' )>
                    Semua Periode
                </option>

                <option
                    value="this_month"
                    @selected(
                    $period==='this_month'
                    )>
                    Bulan Ini
                </option>

                <option
                    value="this_year"
                    @selected(
                    $period==='this_year'
                    )>
                    Tahun Ini
                </option>

            </select>

        </div>


        <button
            type="submit"
            class="btn-filter">
            Terapkan
        </button>


        <a
            href="{{ route('admin.reports.export.pdf', [
        'project' => $projectId,
        'period' => $period
    ]) }}"
            class="btn-export pdf">
            ▣ Export PDF
        </a>


        <a
            href="{{ route('admin.reports.export.excel', [
        'project' => $projectId,
        'period' => $period
    ]) }}"
            class="btn-export excel">
            ▦ Export Excel
        </a>
    </form>

</div>



{{-- =========================================================
     CHART
========================================================= --}}

<div class="report-chart-grid">


    <div class="report-panel">

        <div class="report-panel-title">
            Anggaran vs Pengeluaran per Proyek
        </div>


        <div class="chart-legend">

            <div class="legend-item">

                <span class="legend-dot budget"></span>

                Anggaran

            </div>

            <div class="legend-item">

                <span class="legend-dot expense"></span>

                Pengeluaran

            </div>

        </div>


        @if($chartLabels->count() > 0)

        <div
            class="bar-chart"
            id="budgetExpenseChart">

            @foreach($chartLabels as $index => $label)

            <div
                class="bar-group"
                data-budget="{{ $chartBudgets[$index] }}"
                data-expense="{{ $chartExpenses[$index] }}">

                <div class="bar-columns">

                    <div
                        class="bar budget"
                        title="Anggaran"></div>

                    <div
                        class="bar expense"
                        title="Pengeluaran"></div>

                </div>


                <div class="bar-label">

                    {{
                                \Illuminate\Support\Str::limit(
                                    $label,
                                    22
                                )
                            }}

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="empty-report">
            Belum ada data proyek.
        </div>

        @endif

    </div>



    {{-- STATUS --}}

    <div class="report-panel">

        <div class="report-panel-title">
            Distribusi Status Proyek
        </div>


        <div class="status-content">

            <div
                class="status-donut"
                id="statusDonut"
                data-planning="{{ $statusSummary['planning'] }}"
                data-ongoing="{{ $statusSummary['ongoing'] }}"
                data-completed="{{ $statusSummary['completed'] }}"
                data-paused="{{ $statusSummary['paused'] }}">

                <div class="status-donut-center">

                    <div class="status-donut-number">
                        {{ $totalProjects }}
                    </div>

                    <div class="status-donut-label">
                        Total Proyek
                    </div>

                </div>

            </div>


            <div class="status-list">

                <div class="status-row">

                    <span class="status-color planning"></span>

                    <span>
                        Perencanaan
                    </span>

                    <strong>
                        {{ $statusSummary['planning'] }}
                    </strong>

                </div>


                <div class="status-row">

                    <span class="status-color ongoing"></span>

                    <span>
                        Berjalan
                    </span>

                    <strong>
                        {{ $statusSummary['ongoing'] }}
                    </strong>

                </div>


                <div class="status-row">

                    <span class="status-color completed"></span>

                    <span>
                        Selesai
                    </span>

                    <strong>
                        {{ $statusSummary['completed'] }}
                    </strong>

                </div>


                <div class="status-row">

                    <span class="status-color paused"></span>

                    <span>
                        Ditunda
                    </span>

                    <strong>
                        {{ $statusSummary['paused'] }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     TABLE + INSIGHT
========================================================= --}}

<div class="report-lower-grid">


    <div class="report-panel">

        <div class="report-panel-title">
            Rekap Laporan Proyek
        </div>


        <div class="report-table-wrap">

            <table class="report-table">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Proyek</th>

                        <th>Client</th>

                        <th>Anggaran</th>

                        <th>Pengeluaran</th>

                        <th>Sisa</th>

                        <th>Progress</th>

                        <th>Status</th>

                        <th>Updated</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($reportProjects as $project)

                    @php

                    $statusLabel =
                    match(
                    $project->status
                    ) {

                    'ongoing'
                    => 'Berjalan',

                    'completed'
                    => 'Selesai',

                    'paused'
                    => 'Ditunda',

                    default
                    => 'Perencanaan',

                    };

                    $statusClass =
                    match(
                    $project->status
                    ) {

                    'ongoing'
                    => 'ongoing',

                    'completed'
                    => 'completed',

                    'paused'
                    => 'paused',

                    default
                    => 'planning',

                    };


                    $progress =
                    max(
                    0,
                    min(
                    100,
                    (float) (
                    $project
                    ->progress_percentage
                    ?? 0
                    )
                    )
                    );

                    @endphp


                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td class="project-name">

                            {{
                                    $project
                                        ->project_name
                                }}

                        </td>


                        <td>

                            {{
                                    optional(
                                        optional(
                                            $project
                                                ->client
                                        )->user
                                    )->name
                                    ??
                                    '-'
                                }}

                        </td>


                        <td>

                            Rp {{
                                    number_format(
                                        $project
                                            ->budget_total
                                        ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                        </td>


                        <td>

                            Rp {{
                                    number_format(
                                        $project
                                            ->report_expense,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                        </td>


                        <td>

                            Rp {{
                                    number_format(
                                        $project
                                            ->report_remaining,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                        </td>


                        <td class="progress-cell">

                            <div class="progress-row">

                                <div class="progress-track">

                                    <div
                                        class="progress-fill"
                                        data-progress="{{ $progress }}"></div>

                                </div>

                                <span class="progress-number">

                                    {{ $progress }}%

                                </span>

                            </div>

                        </td>


                        <td>

                            <span
                                class="status-badge {{ $statusClass }}">

                                {{ $statusLabel }}

                            </span>

                        </td>


                        <td>

                            {{
                                    optional(
                                        $project
                                            ->updated_at
                                    )->format(
                                        'd M Y'
                                    )
                                    ??
                                    '-'
                                }}

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td
                            colspan="9"
                            class="empty-report">

                            Belum ada data
                            laporan.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>



    {{-- INSIGHT --}}

    <div class="report-panel">

        <div class="report-panel-title">
            ◎ Insight Ringkas
        </div>


        <div class="insight-list">

            <div class="insight-item">

                <div class="insight-icon red">
                    ↗
                </div>

                <div>

                    <div class="insight-title">

                        Pengeluaran tertinggi

                    </div>

                    <div class="insight-text">

                        @if($highestExpenseProject)

                        {{
                                $highestExpenseProject
                                    ->project_name
                            }}

                        memiliki pengeluaran

                        Rp {{
                                number_format(
                                    $highestExpenseProject
                                        ->report_expense,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}.

                        @else

                        Belum ada data.

                        @endif

                    </div>

                </div>

            </div>


            <div class="insight-item">

                <div class="insight-icon green">
                    ✓
                </div>

                <div>

                    <div class="insight-title">

                        Proyek mendekati selesai

                    </div>

                    <div class="insight-text">

                        {{
                            $almostFinishedCount
                        }}

                        proyek mempunyai
                        progress minimal 70%.

                    </div>

                </div>

            </div>


            <div class="insight-item">

                <div class="insight-icon orange">
                    !
                </div>

                <div>

                    <div class="insight-title">

                        Evaluasi anggaran

                    </div>

                    <div class="insight-text">

                        {{
                            $overBudgetCount
                        }}

                        proyek memiliki
                        pengeluaran melebihi
                        anggaran.

                    </div>

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


            /*
            |--------------------------------------------------------------------------
            | PROGRESS BAR TABLE
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    '.progress-fill'
                )
                .forEach(
                    function(element) {

                        let value =
                            parseFloat(
                                element.dataset.progress ||
                                0
                            );

                        value =
                            Math.max(
                                0,
                                Math.min(
                                    100,
                                    value
                                )
                            );

                        element.style.width =
                            value + '%';

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | BAR CHART
            |--------------------------------------------------------------------------
            */

            const groups =
                document.querySelectorAll(
                    '#budgetExpenseChart .bar-group'
                );


            let maximum = 0;


            groups.forEach(
                function(group) {

                    const budget =
                        parseFloat(
                            group.dataset.budget ||
                            0
                        );

                    const expense =
                        parseFloat(
                            group.dataset.expense ||
                            0
                        );

                    maximum =
                        Math.max(
                            maximum,
                            budget,
                            expense
                        );

                }
            );


            if (maximum <= 0) {
                maximum = 1;
            }


            groups.forEach(
                function(group) {

                    const budget =
                        parseFloat(
                            group.dataset.budget ||
                            0
                        );

                    const expense =
                        parseFloat(
                            group.dataset.expense ||
                            0
                        );


                    const budgetHeight =
                        (
                            budget /
                            maximum
                        ) *
                        100;


                    const expenseHeight =
                        (
                            expense /
                            maximum
                        ) *
                        100;


                    const budgetBar =
                        group.querySelector(
                            '.bar.budget'
                        );

                    const expenseBar =
                        group.querySelector(
                            '.bar.expense'
                        );


                    if (budgetBar) {

                        budgetBar.style.height =
                            Math.max(
                                2,
                                budgetHeight
                            ) +
                            '%';

                    }


                    if (expenseBar) {

                        expenseBar.style.height =
                            Math.max(
                                2,
                                expenseHeight
                            ) +
                            '%';

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | DONUT STATUS
            |--------------------------------------------------------------------------
            */

            const donut =
                document.getElementById(
                    'statusDonut'
                );


            if (donut) {

                const planning =
                    parseFloat(
                        donut.dataset.planning ||
                        0
                    );

                const ongoing =
                    parseFloat(
                        donut.dataset.ongoing ||
                        0
                    );

                const completed =
                    parseFloat(
                        donut.dataset.completed ||
                        0
                    );

                const paused =
                    parseFloat(
                        donut.dataset.paused ||
                        0
                    );


                const total =
                    planning +
                    ongoing +
                    completed +
                    paused;


                if (total > 0) {

                    const planningEnd =
                        planning /
                        total *
                        100;


                    const ongoingEnd =
                        planningEnd +
                        (
                            ongoing /
                            total *
                            100
                        );


                    const completedEnd =
                        ongoingEnd +
                        (
                            completed /
                            total *
                            100
                        );


                    donut.style.background =
                        `
                    conic-gradient(
                        #ffca3a 0 ${planningEnd}%,
                        #2294ef ${planningEnd}% ${ongoingEnd}%,
                        #41bf8b ${ongoingEnd}% ${completedEnd}%,
                        #ff8a52 ${completedEnd}% 100%
                    )
                    `;

                } else {

                    donut.style.background =
                        '#dfe8ef';

                }

            }

        }
    );
</script>

@endpush