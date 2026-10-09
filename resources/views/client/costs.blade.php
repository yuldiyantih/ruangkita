@extends('layouts.client')


@php

$costLang = auth()->user()->language ?? 'id';

$costTranslations = [

'id' => [

'home' => 'Beranda',
'projects' => 'Proyek Saya',
'title' => 'Informasi Biaya',

'description' =>
'Pantau rincian biaya proyek, pembayaran, dan statusnya secara transparan.',

'total_project' => 'Total Nilai Proyek',
'total_paid' => 'Total Terbayar',
'remaining' => 'Sisa Pembayaran',
'payment_percentage' => 'Persentase Pembayaran',

'payment_stages' => 'Tahapan Pembayaran',
'paid' => 'Sudah Dibayar',
'awaiting' => 'Menunggu Pembayaran',
'pending' => 'Belum Jatuh Tempo',

'no_payment_stages' =>
'Belum ada tahapan pembayaran yang dibagikan oleh Admin.',

'project_cost_details' => 'Rincian Biaya Proyek',

'no' => 'No',
'description_label' => 'Keterangan',
'percentage' => 'Persentase',
'amount' => 'Nominal',
'status' => 'Status',

'waiting_short' => 'Menunggu',

'no_cost_details' =>
'Belum ada rincian biaya.',

'payment_history' =>
'Riwayat Pembayaran',

'view_all' =>
'Lihat Semua →',

'project_payment' =>
'Pembayaran Proyek',

'success' =>
'Berhasil',

'rejected' =>
'Ditolak',

'no_payment_history' =>
'Belum ada riwayat pembayaran.',

'no_project' =>
'Belum ada proyek yang terhubung dengan akun Anda.',

],


'en' => [

'home' => 'Home',
'projects' => 'My Projects',
'title' => 'Cost Information',

'description' =>
'Monitor project costs, payments, and payment status transparently.',

'total_project' => 'Total Project Value',
'total_paid' => 'Total Paid',
'remaining' => 'Remaining Payment',
'payment_percentage' => 'Payment Percentage',

'payment_stages' => 'Payment Stages',
'paid' => 'Paid',
'awaiting' => 'Awaiting Payment',
'pending' => 'Not Due Yet',

'no_payment_stages' =>
'No payment stages have been shared by Admin yet.',

'project_cost_details' =>
'Project Cost Details',

'no' => 'No',
'description_label' => 'Description',
'percentage' => 'Percentage',
'amount' => 'Amount',
'status' => 'Status',

'waiting_short' => 'Waiting',

'no_cost_details' =>
'No cost details available yet.',

'payment_history' =>
'Payment History',

'view_all' =>
'View All →',

'project_payment' =>
'Project Payment',

'success' =>
'Success',

'rejected' =>
'Rejected',

'no_payment_history' =>
'No payment history available yet.',

'no_project' =>
'There are no projects connected to your account yet.',

],

];

$ct =
$costTranslations[$costLang]
??
$costTranslations['id'];

@endphp


@section(
'title',
$ct['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .cost-page-head {

        margin-bottom: 23px;

        display: flex;

        align-items: flex-start;

        justify-content:
            space-between;

        gap: 20px;
    }


    .cost-page-title h1 {

        margin-bottom: 7px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .cost-page-title p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       PROJECT SELECTOR
    ===================================================== */

    .project-selector {

        width: 290px;

        min-height: 60px;

        padding:
            10px 13px;

        display: flex;

        align-items: center;

        gap: 10px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);
    }


    .selector-icon {

        width: 35px;
        height: 35px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #e9f3fc;

        color: #0874ca;
    }


    body.dark-mode .selector-icon {

        background: #19364d;

        color: #72bdf5;
    }


    .selector-text {

        min-width: 0;

        flex: 1;
    }


    .selector-project {

        overflow: hidden;

        white-space: nowrap;

        text-overflow: ellipsis;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .project-select {

        width: 24px;

        border: none;

        outline: none;

        background: transparent;

        color:
            var(--text-muted);

        cursor: pointer;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .summary-grid {

        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .summary-card {

        min-height: 125px;

        padding: 20px;

        display: flex;

        align-items: center;

        gap: 15px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .summary-icon {

        width: 49px;
        height: 49px;

        flex-shrink: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        font-size: 20px;
    }


    .summary-icon.blue {

        color: #0877d4;

        background: #e7f2ff;
    }


    .summary-icon.green {

        color: #11905f;

        background: #dff8ec;
    }


    .summary-icon.orange {

        color: #d97706;

        background: #fff3dc;
    }


    .summary-icon.purple {

        color: #6f42d9;

        background: #eee8ff;
    }


    body.dark-mode .summary-icon.blue {

        background: #19364d;
    }


    body.dark-mode .summary-icon.green {

        background: #173d31;
    }


    body.dark-mode .summary-icon.orange {

        background: #49331e;
    }


    body.dark-mode .summary-icon.purple {

        background: #302a4d;
    }


    .summary-label {

        margin-bottom: 6px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .summary-number {

        color:
            var(--text-heading);

        font-size: 20px;

        font-weight: 700;
    }


    .summary-progress {

        margin-top: 12px;

        height: 9px;

        overflow: hidden;

        border-radius: 30px;

        background: #e6edf3;
    }


    body.dark-mode .summary-progress {

        background: #304352;
    }


    .summary-progress-fill {

        width: 0;

        height: 100%;

        border-radius: 30px;

        background:
            linear-gradient(90deg,
                #0877d4,
                #1598e8);
    }


    /* =====================================================
       PAYMENT STAGES
    ===================================================== */

    .stage-panel {

        margin-bottom: 18px;

        padding:
            18px 20px 22px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .section-title {

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .stages {

        position: relative;

        margin-top: 24px;

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 15px;
    }


    .stages::before {

        content: "";

        position: absolute;

        top: 17px;

        left: 12%;
        right: 12%;

        height: 3px;

        background:
            var(--border);
    }


    .stage {

        position: relative;

        z-index: 2;

        text-align: center;
    }


    .stage-circle {

        width: 37px;
        height: 37px;

        margin:
            0 auto 10px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #dfe8f0;

        color: #718496;

        font-size: 12px;

        font-weight: 700;
    }


    body.dark-mode .stage-circle {

        background: #304352;

        color: #b9c7d1;
    }


    .stage-circle.paid {

        background: #087bd7;

        color: white;
    }


    .stage-circle.waiting {

        border:
            3px solid #087bd7;

        background: #e4f2ff;

        color: #0875ce;
    }


    body.dark-mode .stage-circle.waiting {

        background: #19364d;

        color: #72bdf5;
    }


    .stage-name {

        min-height: 34px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .stage-percentage {

        margin-top: 4px;

        color:
            var(--text-heading);

        font-size: 11px;

        font-weight: 700;
    }


    .stage-amount {

        margin-top: 6px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    /* =====================================================
       STATUS BADGE
    ===================================================== */

    .status-badge {

        display: inline-block;

        margin-top: 9px;

        padding:
            5px 9px;

        border-radius: 15px;

        font-size: 9px;

        font-weight: 600;
    }


    .badge-paid {

        color: #13805b;

        background: #daf7e9;
    }


    .badge-waiting {

        color: #a65b00;

        background: #fff0d2;
    }


    .badge-pending {

        color: #52687b;

        background: #e8edf2;
    }


    body.dark-mode .badge-paid {

        color: #79ddb0;

        background: #173d31;
    }


    body.dark-mode .badge-waiting {

        color: #ffc976;

        background: #49331e;
    }


    body.dark-mode .badge-pending {

        color: #b8c5cf;

        background: #2a3945;
    }


    /* =====================================================
       LOWER GRID
    ===================================================== */

    .lower-grid {

        display: grid;

        grid-template-columns:
            minmax(0, 1.4fr) minmax(300px, .9fr);

        gap: 17px;
    }


    .cost-panel {

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .table-wrap {

        margin-top: 15px;

        overflow-x: auto;
    }


    .cost-table {

        width: 100%;

        border-collapse: collapse;

        font-size: 11px;
    }


    .cost-table th {

        padding:
            12px 10px;

        color:
            var(--text-muted);

        background:
            var(--input-bg);

        text-align: left;

        font-weight: 600;
    }


    .cost-table td {

        padding:
            12px 10px;

        color:
            var(--text-main);

        border-bottom:
            1px solid var(--border);
    }


    /* =====================================================
       PAYMENT HISTORY
    ===================================================== */

    .history-header {

        display: flex;

        justify-content:
            space-between;

        align-items: center;

        gap: 10px;
    }


    .see-all {

        color:
            var(--primary);

        text-decoration: none;

        font-size: 10px;

        font-weight: 600;
    }


    .history {

        position: relative;

        margin-top: 17px;

        padding-left: 14px;
    }


    .history::before {

        content: "";

        position: absolute;

        top: 10px;
        bottom: 10px;
        left: 6px;

        width: 2px;

        background:
            var(--border);
    }


    .history-item {

        position: relative;

        padding:
            0 0 19px 21px;
    }


    .history-item:last-child {

        padding-bottom: 0;
    }


    .history-dot {

        position: absolute;

        left: -13px;
        top: 7px;

        width: 12px;
        height: 12px;

        border-radius: 50%;

        background: #a8b8c6;

        border:
            3px solid var(--card-bg);

        box-shadow:
            0 0 0 1px #a8b8c6;
    }


    .history-dot.success {

        background: #12a36e;

        box-shadow:
            0 0 0 1px #12a36e;
    }


    .history-row {

        display: grid;

        grid-template-columns:
            80px 1fr auto;

        gap: 10px;

        align-items: center;
    }


    .history-date {

        color:
            var(--text-muted);

        font-size: 9px;
    }


    .history-title {

        margin-bottom: 3px;

        color:
            var(--text-heading);

        font-size: 10px;

        font-weight: 700;
    }


    .history-amount {

        color:
            var(--text-muted);

        font-size: 9px;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-state {

        margin-top: 15px;

        padding:
            30px 15px;

        border-radius: 10px;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 11px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1100px) {

        .summary-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .lower-grid {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 650px) {

        .cost-page-head {

            flex-direction: column;
        }


        .project-selector {

            width: 100%;
        }


        .summary-grid {

            grid-template-columns:
                1fr;
        }


        .stages {

            grid-template-columns:
                1fr;
        }


        .stages::before {

            display: none;
        }


        .history-row {

            grid-template-columns:
                65px 1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="breadcrumb">

    <a href="{{ route('client.dashboard') }}">

        {{ $ct['home'] }}

    </a>

    &nbsp;›&nbsp;

    <a href="{{ route('client.projects.index') }}">

        {{ $ct['projects'] }}

    </a>

    &nbsp;›&nbsp;

    {{ $ct['title'] }}

</div>



{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="cost-page-head">


    <div class="cost-page-title">

        <h1>

            {{ $ct['title'] }}

        </h1>

        <p>

            {{ $ct['description'] }}

        </p>

    </div>



    @if($selectedProject)

    <form

        method="GET"

        action="{{ route('client.costs') }}"

        class="project-selector">


        <div class="selector-icon">

            ▤

        </div>


        <div class="selector-text">

            <div class="selector-project">

                {{
                            $selectedProject
                                ->project_name
                        }}

            </div>

        </div>


        <select

            name="project"

            class="project-select"

            onchange="this.form.submit()">

            @foreach($projects as $project)

            <option

                value="{{ $project->id }}"

                @selected(
                $project->id
                ===
                $selectedProject->id
                )

                >

                {{ $project->project_name }}

            </option>

            @endforeach

        </select>


    </form>

    @endif


</div>



@if($selectedProject)


{{-- =================================================
             SUMMARY
        ================================================== --}}

<div class="summary-grid">


    <div class="summary-card">

        <div class="summary-icon blue">
            ▤
        </div>

        <div>

            <div class="summary-label">

                {{ $ct['total_project'] }}

            </div>

            <div class="summary-number">

                Rp
                {{
                            number_format(
                                $totalProject,
                                0,
                                ',',
                                '.'
                            )
                        }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon green">
            ✓
        </div>

        <div>

            <div class="summary-label">

                {{ $ct['total_paid'] }}

            </div>

            <div class="summary-number">

                Rp
                {{
                            number_format(
                                $totalPaid,
                                0,
                                ',',
                                '.'
                            )
                        }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon orange">
            ◷
        </div>

        <div>

            <div class="summary-label">

                {{ $ct['remaining'] }}

            </div>

            <div class="summary-number">

                Rp
                {{
                            number_format(
                                $remaining,
                                0,
                                ',',
                                '.'
                            )
                        }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon purple">
            %
        </div>

        <div style="flex:1">

            <div class="summary-label">

                {{
                            $ct[
                                'payment_percentage'
                            ]
                        }}

            </div>

            <div class="summary-number">

                {{ $paymentPercentage }}%

            </div>


            <div class="summary-progress">

                <div

                    class="
                                summary-progress-fill
                            "

                    data-progress="{{
                                $paymentPercentage
                            }}"></div>

            </div>

        </div>

    </div>


</div>



{{-- =================================================
             PAYMENT STAGES
        ================================================== --}}

<div class="stage-panel">


    <div class="section-title">

        {{ $ct['payment_stages'] }}

    </div>


    @if($selectedProject->paymentStages->count())


    <div class="stages">


        @foreach($selectedProject->paymentStages as $stage)


        <div class="stage">


            @if($stage->status === 'paid')

            <div class="stage-circle paid">

                ✓

            </div>

            @elseif($stage->status === 'awaiting_payment')

            <div class="stage-circle waiting">

                {{ $loop->iteration }}

            </div>

            @else

            <div class="stage-circle">

                {{ $loop->iteration }}

            </div>

            @endif



            <div class="stage-name">

                {{ $stage->title }}

            </div>


            <div class="stage-percentage">

                {{
                                    number_format(
                                        $stage->percentage,
                                        0
                                    )
                                }}%

            </div>


            <div class="stage-amount">

                Rp
                {{
                                    number_format(
                                        $stage->amount,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

            </div>



            @if($stage->status === 'paid')

            <div
                class="
                                        status-badge
                                        badge-paid
                                    ">

                {{ $ct['paid'] }}

            </div>

            @elseif($stage->status === 'awaiting_payment')

            <div
                class="
                                        status-badge
                                        badge-waiting
                                    ">

                {{ $ct['awaiting'] }}

            </div>

            @else

            <div
                class="
                                        status-badge
                                        badge-pending
                                    ">

                {{ $ct['pending'] }}

            </div>

            @endif


        </div>


        @endforeach


    </div>


    @else


    <div class="empty-state">

        {{
                        $ct[
                            'no_payment_stages'
                        ]
                    }}

    </div>


    @endif


</div>



{{-- =================================================
             LOWER CONTENT
        ================================================== --}}

<div class="lower-grid">


    {{-- COST DETAILS --}}

    <div class="cost-panel">


        <div class="section-title">

            {{
                        $ct[
                            'project_cost_details'
                        ]
                    }}

        </div>


        @if($selectedProject->paymentStages->count())


        <div class="table-wrap">


            <table class="cost-table">


                <thead>

                    <tr>

                        <th>
                            {{ $ct['no'] }}
                        </th>

                        <th>
                            {{
                                            $ct[
                                                'description_label'
                                            ]
                                        }}
                        </th>

                        <th>
                            {{
                                            $ct[
                                                'percentage'
                                            ]
                                        }}
                        </th>

                        <th>
                            {{ $ct['amount'] }}
                        </th>

                        <th>
                            {{ $ct['status'] }}
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @foreach($selectedProject->paymentStages as $stage)


                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $stage->title }}

                        </td>

                        <td>

                            {{
                                                number_format(
                                                    $stage->percentage,
                                                    0
                                                )
                                            }}%

                        </td>

                        <td>

                            Rp
                            {{
                                                number_format(
                                                    $stage->amount,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }}

                        </td>

                        <td>


                            @if($stage->status === 'paid')

                            <span
                                class="
                                                        status-badge
                                                        badge-paid
                                                    ">

                                {{ $ct['paid'] }}

                            </span>

                            @elseif($stage->status === 'awaiting_payment')

                            <span
                                class="
                                                        status-badge
                                                        badge-waiting
                                                    ">

                                {{
                                                        $ct[
                                                            'waiting_short'
                                                        ]
                                                    }}

                            </span>

                            @else

                            <span
                                class="
                                                        status-badge
                                                        badge-pending
                                                    ">

                                {{ $ct['pending'] }}

                            </span>

                            @endif


                        </td>

                    </tr>


                    @endforeach


                </tbody>


            </table>


        </div>


        @else


        <div class="empty-state">

            {{
                            $ct[
                                'no_cost_details'
                            ]
                        }}

        </div>


        @endif


    </div>



    {{-- PAYMENT HISTORY --}}

    <div class="cost-panel">


        <div class="history-header">


            <div class="section-title">

                {{
                            $ct[
                                'payment_history'
                            ]
                        }}

            </div>


            <a

                href="#"

                class="see-all">

                {{ $ct['view_all'] }}

            </a>


        </div>



        @if($selectedProject->payments->count())


        <div class="history">


            @foreach($selectedProject->payments->take(6) as $payment)


            <div class="history-item">


                <div
                    class="
                                        history-dot
                                        {{
                                            $payment->status
                                            ===
                                            'verified'
                                            ?
                                            'success'
                                            :
                                            ''
                                        }}
                                    "></div>



                <div class="history-row">


                    <div class="history-date">


                        @if($payment->payment_date)

                        {{
                                                \Carbon\Carbon
                                                    ::parse(
                                                        $payment
                                                            ->payment_date
                                                    )
                                                    ->format(
                                                        'd M Y'
                                                    )
                                            }}

                        @else

                        -

                        @endif


                    </div>



                    <div>


                        <div class="history-title">

                            {{
                                                optional(
                                                    $payment
                                                        ->paymentStage
                                                )->title
                                                ??
                                                $ct[
                                                    'project_payment'
                                                ]
                                            }}

                        </div>


                        <div class="history-amount">

                            Rp
                            {{
                                                number_format(
                                                    $payment->amount,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }}

                        </div>


                    </div>



                    <div>


                        @if($payment->status === 'verified')

                        <span
                            class="
                                                    status-badge
                                                    badge-paid
                                                ">

                            {{
                                                    $ct[
                                                        'success'
                                                    ]
                                                }}

                        </span>

                        @elseif($payment->status === 'pending')

                        <span
                            class="
                                                    status-badge
                                                    badge-waiting
                                                ">

                            {{
                                                    $ct[
                                                        'waiting_short'
                                                    ]
                                                }}

                        </span>

                        @else

                        <span
                            class="
                                                    status-badge
                                                    badge-pending
                                                ">

                            {{
                                                    $ct[
                                                        'rejected'
                                                    ]
                                                }}

                        </span>

                        @endif


                    </div>


                </div>


            </div>


            @endforeach


        </div>


        @else


        <div class="empty-state">

            {{
                            $ct[
                                'no_payment_history'
                            ]
                        }}

        </div>


        @endif


    </div>


</div>


@else


<div class="empty-state">

    {{ $ct['no_project'] }}

</div>


@endif


@endsection



@push('scripts')

<script>
    document
        .querySelectorAll(
            '.summary-progress-fill'
        )
        .forEach(
            function(bar) {

                let progress =
                    parseInt(
                        bar.dataset.progress ||
                        '0'
                    );


                progress =
                    Math.max(
                        0,
                        Math.min(
                            100,
                            progress
                        )
                    );


                bar.style.width =
                    progress + '%';

            }
        );
</script>

@endpush