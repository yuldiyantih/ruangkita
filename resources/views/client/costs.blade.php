<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Informasi Biaya - RuangKita
    </title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        body {
            background: #f4f8fc;
            color: #17334c;
        }


        .app {
            display: flex;
            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width: 230px;

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            z-index: 1000;

            padding: 20px 14px;

            background:
                linear-gradient(180deg,
                    #0d3458,
                    #092843);

            color: white;
        }


        .brand {

            padding:
                5px 9px 24px;

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .brand-name {

            font-size: 18px;
            font-weight: 700;
        }


        .ruangkita-logo {

            width: 31px;
            height: 31px;

            position: relative;

            flex-shrink: 0;
        }


        .ruangkita-logo .roof {

            width: 20px;
            height: 20px;

            position: absolute;

            left: 5px;
            top: 2px;

            border-left:
                4px solid white;

            border-top:
                4px solid white;

            transform:
                rotate(45deg);
        }


        .ruangkita-logo .house {

            width: 19px;
            height: 17px;

            position: absolute;

            left: 6px;
            bottom: 2px;

            border-left:
                4px solid white;

            border-right:
                4px solid white;

            border-bottom:
                4px solid white;
        }


        .ruangkita-logo .door {

            width: 6px;
            height: 9px;

            position: absolute;

            left: 50%;
            bottom: -1px;

            transform:
                translateX(-50%);

            border:
                2px solid white;

            border-bottom: none;
        }


        .menu-item {

            min-height: 42px;

            padding:
                0 13px;

            margin-bottom:
                3px;

            border-radius:
                8px;

            display: flex;

            align-items: center;

            gap: 11px;

            text-decoration: none;

            color:
                #d6e6f5;

            font-size:
                13px;
        }


        .menu-item:hover {

            background:
                rgba(255,
                    255,
                    255,
                    .08);
        }


        .menu-item.active {

            color: white;

            background:
                linear-gradient(90deg,
                    #0665ac,
                    #087acb);
        }


        .menu-icon {

            width: 19px;

            text-align: center;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            position: relative;

            z-index: 1;

            width:
                calc(100% - 230px);

            margin-left:
                230px;
        }


        .topbar {

            height: 66px;

            padding:
                0 28px;

            display: flex;

            align-items: center;

            justify-content:
                space-between;

            background:
                white;

            border-bottom:
                1px solid #e7edf3;
        }


        .hamburger {

            color:
                #526f87;

            font-size:
                20px;
        }


        .user-area {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size:
                13px;

            font-weight:
                600;
        }


        .avatar {

            width: 33px;
            height: 33px;

            border-radius:
                50%;

            display: flex;

            align-items: center;

            justify-content:
                center;

            background:
                #e4eef7;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            padding:
                28px 30px 40px;
        }


        .breadcrumb {

            margin-bottom:
                17px;

            color:
                #7c8fa1;

            font-size:
                11px;
        }


        .breadcrumb a {

            color:
                #58748c;

            text-decoration:
                none;
        }


        .page-head {

            display: flex;

            align-items:
                flex-start;

            justify-content:
                space-between;

            gap:
                20px;

            margin-bottom:
                23px;
        }


        .page-title h1 {

            color:
                #14304a;

            font-size:
                27px;

            margin-bottom:
                7px;
        }


        .page-title p {

            color:
                #768b9f;

            font-size:
                13px;
        }


        /* =====================================================
           PROJECT SELECT
        ===================================================== */

        .project-selector {

            width:
                290px;

            min-height:
                60px;

            padding:
                10px 13px;

            display: flex;

            align-items:
                center;

            gap:
                10px;

            background:
                white;

            border:
                1px solid #e4ebf1;

            border-radius:
                12px;
        }


        .selector-icon {

            width:
                35px;

            height:
                35px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                8px;

            background:
                #e9f3fc;

            color:
                #0874ca;
        }


        .selector-text {

            min-width: 0;

            flex:
                1;
        }


        .selector-project {

            color:
                #17364f;

            font-size:
                12px;

            font-weight:
                700;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }


        .project-select {

            width:
                24px;

            border:
                none;

            color:
                #527089;

            background:
                transparent;

            outline:
                none;

            cursor:
                pointer;
        }


        /* =====================================================
           SUMMARY
        ===================================================== */

        .summary-grid {

            display:
                grid;

            grid-template-columns:
                repeat(4,
                    minmax(0,
                        1fr));

            gap:
                14px;

            margin-bottom:
                18px;
        }


        .summary-card {

            min-height:
                125px;

            padding:
                20px;

            display: flex;

            align-items:
                center;

            gap:
                15px;

            background:
                white;

            border:
                1px solid #e5edf3;

            border-radius:
                13px;
        }


        .summary-icon {

            width:
                49px;

            height:
                49px;

            flex-shrink:
                0;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            font-size:
                20px;
        }


        .summary-icon.blue {

            color:
                #0877d4;

            background:
                #e7f2ff;
        }


        .summary-icon.green {

            color:
                #11905f;

            background:
                #dff8ec;
        }


        .summary-icon.orange {

            color:
                #d97706;

            background:
                #fff3dc;
        }


        .summary-icon.purple {

            color:
                #6f42d9;

            background:
                #eee8ff;
        }


        .summary-label {

            margin-bottom:
                6px;

            color:
                #75899c;

            font-size:
                11px;
        }


        .summary-number {

            color:
                #102a43;

            font-size:
                20px;

            font-weight:
                700;
        }


        .summary-progress {

            margin-top:
                12px;

            height:
                9px;

            overflow:
                hidden;

            border-radius:
                30px;

            background:
                #e6edf3;
        }


        .summary-progress-fill {

            height:
                100%;

            border-radius:
                30px;

            background:
                linear-gradient(90deg,
                    #0877d4,
                    #1598e8);
        }


        /* =====================================================
           PAYMENT STAGES
        ===================================================== */

        .stage-panel {

            padding:
                18px 20px 22px;

            margin-bottom:
                18px;

            background:
                white;

            border:
                1px solid #e5edf3;

            border-radius:
                13px;
        }


        .section-title {

            color:
                #18354f;

            font-size:
                15px;

            font-weight:
                700;
        }


        .stages {

            position:
                relative;

            display:
                grid;

            grid-template-columns:
                repeat(4,
                    1fr);

            gap:
                15px;

            margin-top:
                24px;
        }


        .stages::before {

            content:
                "";

            position:
                absolute;

            top:
                17px;

            left:
                12%;

            right:
                12%;

            height:
                3px;

            background:
                #dfe7ee;
        }


        .stage {

            position:
                relative;

            z-index:
                2;

            text-align:
                center;
        }


        .stage-circle {

            width:
                37px;

            height:
                37px;

            margin:
                0 auto 10px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            color:
                #718496;

            background:
                #dfe8f0;

            font-size:
                12px;

            font-weight:
                700;
        }


        .stage-circle.paid {

            background:
                #087bd7;

            color:
                white;
        }


        .stage-circle.waiting {

            border:
                3px solid #087bd7;

            background:
                #e4f2ff;

            color:
                #0875ce;
        }


        .stage-name {

            min-height:
                34px;

            color:
                #17334c;

            font-size:
                12px;

            font-weight:
                700;
        }


        .stage-percentage {

            margin-top:
                4px;

            color:
                #17334c;

            font-size:
                11px;

            font-weight:
                700;
        }


        .stage-amount {

            margin-top:
                6px;

            color:
                #435f75;

            font-size:
                10px;
        }


        .status-badge {

            display:
                inline-block;

            margin-top:
                9px;

            padding:
                5px 9px;

            border-radius:
                15px;

            font-size:
                9px;

            font-weight:
                600;
        }


        .badge-paid {

            color:
                #13805b;

            background:
                #daf7e9;
        }


        .badge-waiting {

            color:
                #a65b00;

            background:
                #fff0d2;
        }


        .badge-pending {

            color:
                #52687b;

            background:
                #e8edf2;
        }


        /* =====================================================
           LOWER GRID
        ===================================================== */

        .lower-grid {

            display:
                grid;

            grid-template-columns:
                minmax(0,
                    1.4fr) minmax(300px,
                    .9fr);

            gap:
                17px;
        }


        .panel {

            background:
                white;

            border:
                1px solid #e5edf3;

            border-radius:
                13px;

            padding:
                18px;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrap {

            margin-top:
                15px;

            overflow-x:
                auto;
        }


        table {

            width:
                100%;

            border-collapse:
                collapse;

            font-size:
                11px;
        }


        th {

            padding:
                12px 10px;

            color:
                #536b80;

            background:
                #f4f7fa;

            text-align:
                left;

            font-weight:
                600;
        }


        td {

            padding:
                12px 10px;

            color:
                #29455c;

            border-bottom:
                1px solid #edf1f4;
        }


        /* =====================================================
           PAYMENT HISTORY
        ===================================================== */

        .history-header {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

            gap:
                10px;
        }


        .see-all {

            color:
                #0874ca;

            text-decoration:
                none;

            font-size:
                10px;

            font-weight:
                600;
        }


        .history {

            position:
                relative;

            margin-top:
                17px;

            padding-left:
                14px;
        }


        .history::before {

            content:
                "";

            position:
                absolute;

            top:
                10px;

            bottom:
                10px;

            left:
                6px;

            width:
                2px;

            background:
                #dde7ee;
        }


        .history-item {

            position:
                relative;

            padding:
                0 0 19px 21px;
        }


        .history-item:last-child {

            padding-bottom:
                0;
        }


        .history-dot {

            position:
                absolute;

            left:
                -13px;

            top:
                7px;

            width:
                12px;

            height:
                12px;

            border-radius:
                50%;

            background:
                #a8b8c6;

            border:
                3px solid white;

            box-shadow:
                0 0 0 1px #a8b8c6;
        }


        .history-dot.success {

            background:
                #12a36e;

            box-shadow:
                0 0 0 1px #12a36e;
        }


        .history-row {

            display:
                grid;

            grid-template-columns:
                80px 1fr auto;

            gap:
                10px;

            align-items:
                center;
        }


        .history-date {

            color:
                #75899c;

            font-size:
                9px;
        }


        .history-title {

            color:
                #203b52;

            font-size:
                10px;

            font-weight:
                700;

            margin-bottom:
                3px;
        }


        .history-amount {

            color:
                #496277;

            font-size:
                9px;
        }


        .empty-state {

            margin-top:
                15px;

            padding:
                30px 15px;

            text-align:
                center;

            color:
                #8394a4;

            font-size:
                11px;

            background:
                #f8fafc;

            border-radius:
                10px;
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


        @media(max-width: 850px) {

            .sidebar {

                display:
                    none;
            }


            .main {

                width:
                    100%;

                margin-left:
                    0;
            }
        }


        @media(max-width: 650px) {

            .content {

                padding:
                    20px 14px;
            }


            .page-head {

                flex-direction:
                    column;
            }


            .project-selector {

                width:
                    100%;
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

                display:
                    none;
            }


            .history-row {

                grid-template-columns:
                    65px 1fr;
            }
        }
    </style>

</head>


<body>


    <div class="app">


        <!-- SIDEBAR -->

        <aside class="sidebar">


            <div class="brand">

                <div class="ruangkita-logo">

                    <div class="roof"></div>

                    <div class="house">

                        <div class="door"></div>

                    </div>

                </div>


                <span class="brand-name">

                    RuangKita

                </span>

            </div>



            <a
                href="{{ route('client.dashboard') }}"
                class="menu-item">

                <span class="menu-icon">⌂</span>

                Dashboard

            </a>


            <a
                href="{{ route('client.projects.index') }}"
                class="menu-item">

                <span class="menu-icon">▣</span>

                Proyek Saya

            </a>


            <a
                href="{{ route('client.schedule') }}"
                class="menu-item">

                <span class="menu-icon">▦</span>

                Jadwal

            </a>


            <a
                href="{{ route('client.progress') }}"
                class="menu-item">

                <span class="menu-icon">↗</span>

                Progress

            </a>


            <a
                href="{{ route('client.documentation') }}"
                class="menu-item">

                <span class="menu-icon">▧</span>

                Dokumentasi

            </a>


            <a
                href="{{ route('client.costs') }}"
                class="menu-item active">

                <span class="menu-icon">▤</span>

                Informasi Biaya

            </a>


            <a href="{{ route('client.messages') }}" class="menu-item">

                <span class="menu-icon">✉</span>

                Pesan

            </a>


            <a
                href="{{ route('client.ar') }}"
                class="menu-item">

                <span class="menu-icon">
                    ◇
                </span>

                Augmented Reality

            </a>


            <a
                href="{{ route('client.settings') }}"
                class="menu-item">

                <span class="menu-icon">⚙</span>

                Pengaturan
            </a>


        </aside>



        <!-- MAIN -->

        <main class="main">


            <header class="topbar">


                <div class="hamburger">

                    ☰

                </div>


                <div class="user-area">

                    <span>♧</span>

                    <div class="avatar">

                        👤

                    </div>

                    <span>

                        {{ auth()->user()->name }}

                    </span>

                    <span>▾</span>

                </div>


            </header>



            <section class="content">


                <div class="breadcrumb">

                    <a href="{{ route('client.dashboard') }}">

                        Beranda

                    </a>

                    &nbsp;›&nbsp;

                    <a href="{{ route('client.projects.index') }}">

                        Proyek Saya

                    </a>

                    &nbsp;›&nbsp;

                    Informasi Biaya

                </div>



                <div class="page-head">


                    <div class="page-title">

                        <h1>

                            Informasi Biaya

                        </h1>

                        <p>

                            Pantau rincian biaya proyek, pembayaran,
                            dan statusnya secara transparan.

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

                                {{ $selectedProject->project_name }}

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
                                )>

                                {{ $project->project_name }}

                            </option>

                            @endforeach


                        </select>


                    </form>


                    @endif


                </div>



                @if($selectedProject)


                <!-- SUMMARY -->


                <div class="summary-grid">


                    <div class="summary-card">

                        <div class="summary-icon blue">

                            ▤

                        </div>

                        <div>

                            <div class="summary-label">

                                Total Nilai Proyek

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

                                Total Terbayar

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

                                Sisa Pembayaran

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

                                Persentase Pembayaran

                            </div>

                            <div class="summary-number">

                                {{ $paymentPercentage }}%

                            </div>


                            <div class="summary-progress">

                                <div
                                    class="summary-progress-fill"
                                    data-progress="{{ $paymentPercentage }}">

                                </div>

                            </div>

                        </div>

                    </div>


                </div>



                <!-- PAYMENT STAGES -->


                <div class="stage-panel">


                    <div class="section-title">

                        Tahapan Pembayaran

                    </div>


                    @if($selectedProject->paymentStages->count())


                    <div class="stages">


                        @foreach(
                        $selectedProject->paymentStages
                        as $stage
                        )


                        <div class="stage">


                            @if($stage->status === 'paid')


                            <div class="stage-circle paid">

                                ✓

                            </div>


                            @elseif(
                            $stage->status
                            ===
                            'awaiting_payment'
                            )


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


                            <div class="status-badge badge-paid">

                                Sudah Dibayar

                            </div>


                            @elseif(
                            $stage->status
                            ===
                            'awaiting_payment'
                            )


                            <div class="status-badge badge-waiting">

                                Menunggu Pembayaran

                            </div>


                            @else


                            <div class="status-badge badge-pending">

                                Belum Jatuh Tempo

                            </div>


                            @endif


                        </div>


                        @endforeach


                    </div>


                    @else


                    <div class="empty-state">

                        Belum ada tahapan pembayaran
                        yang dibagikan oleh Admin.

                    </div>


                    @endif


                </div>



                <!-- LOWER CONTENT -->


                <div class="lower-grid">


                    <!-- RINCIAN BIAYA -->


                    <div class="panel">


                        <div class="section-title">

                            Rincian Biaya Proyek

                        </div>


                        @if($selectedProject->paymentStages->count())


                        <div class="table-wrap">


                            <table>


                                <thead>

                                    <tr>

                                        <th>No</th>

                                        <th>Keterangan</th>

                                        <th>Persentase</th>

                                        <th>Nominal</th>

                                        <th>Status</th>

                                    </tr>

                                </thead>


                                <tbody>


                                    @foreach(
                                    $selectedProject->paymentStages
                                    as $stage
                                    )


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


                                            @if(
                                            $stage->status
                                            ===
                                            'paid'
                                            )

                                            <span class="status-badge badge-paid">

                                                Sudah Dibayar

                                            </span>


                                            @elseif(
                                            $stage->status
                                            ===
                                            'awaiting_payment'
                                            )

                                            <span class="status-badge badge-waiting">

                                                Menunggu

                                            </span>


                                            @else

                                            <span class="status-badge badge-pending">

                                                Belum Jatuh Tempo

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

                            Belum ada rincian biaya.

                        </div>


                        @endif


                    </div>



                    <!-- RIWAYAT PEMBAYARAN -->


                    <div class="panel">


                        <div class="history-header">


                            <div class="section-title">

                                Riwayat Pembayaran

                            </div>


                            <a
                                href="#"
                                class="see-all">

                                Lihat Semua →

                            </a>


                        </div>



                        @if($selectedProject->payments->count())


                        <div class="history">


                            @foreach(
                            $selectedProject->payments->take(6)
                            as $payment
                            )


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
                                            ">
                                </div>


                                <div class="history-row">


                                    <div class="history-date">


                                        @if($payment->payment_date)

                                        {{
                                                        \Carbon\Carbon::parse(
                                                            $payment->payment_date
                                                        )->format(
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
                                                            $payment->paymentStage
                                                        )->title
                                                        ??
                                                        'Pembayaran Proyek'
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


                                        @if(
                                        $payment->status
                                        ===
                                        'verified'
                                        )


                                        <span class="status-badge badge-paid">

                                            Berhasil

                                        </span>


                                        @elseif(
                                        $payment->status
                                        ===
                                        'pending'
                                        )


                                        <span class="status-badge badge-waiting">

                                            Menunggu

                                        </span>


                                        @else


                                        <span class="status-badge badge-pending">

                                            Ditolak

                                        </span>


                                        @endif


                                    </div>


                                </div>


                            </div>


                            @endforeach


                        </div>


                        @else


                        <div class="empty-state">

                            Belum ada riwayat pembayaran.

                        </div>


                        @endif


                    </div>


                </div>


                @else


                <div class="empty-state">

                    Belum ada proyek
                    yang terhubung dengan akun Anda.

                </div>


                @endif


            </section>


        </main>


    </div>



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


</body>

</html>