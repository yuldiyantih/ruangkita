<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Progress Proyek - RuangKita
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


        /* LOGO */

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

            color: #d6e6f5;

            font-size: 13px;

            transition: .2s;

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

            background: white;

            border-bottom:
                1px solid #e7edf3;

        }


        .hamburger {

            color: #526f87;

            font-size: 20px;

        }


        .user-area {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 13px;

            font-weight: 600;

        }


        .avatar {

            width: 33px;
            height: 33px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

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


        .page-header {

            margin-bottom:
                22px;

        }


        .page-header h1 {

            color: #14304a;

            font-size: 27px;

            margin-bottom:
                5px;

        }


        .page-header p {

            color: #8495a6;

            font-size: 13px;

        }


        /* =====================================================
           PROJECT OVERVIEW
        ===================================================== */

        .project-card {

            background: white;

            border:
                1px solid #e5edf4;

            border-radius:
                14px;

            padding: 18px;

            margin-bottom:
                22px;

        }


        .project-overview {

            display: grid;

            grid-template-columns:
                200px 1fr 180px;

            gap: 22px;

            align-items:
                center;

        }


        .project-image {

            width: 200px;

            height: 135px;

            border-radius:
                11px;

            object-fit:
                cover;

            background:
                linear-gradient(135deg,
                    #dcebf8,
                    #eef5fa);

        }


        .project-title {

            color: #18354f;

            font-size: 20px;

            font-weight: 700;

            margin-bottom:
                8px;

        }


        .project-meta {

            color: #75899c;

            font-size: 12px;

            line-height: 1.8;

        }


        .project-description {

            margin-top:
                9px;

            color: #687f93;

            font-size: 12px;

            line-height: 1.6;

        }


        .status {

            display:
                inline-flex;

            padding:
                5px 10px;

            margin-top:
                8px;

            border-radius:
                20px;

            background:
                #ddf8eb;

            color:
                #11815a;

            font-size:
                10px;

            font-weight:
                700;

        }


        /* =====================================================
           CIRCULAR PROGRESS
        ===================================================== */

        .progress-circle {

            --progress: 0deg;

            width: 125px;

            height: 125px;

            margin:
                0 auto;

            border-radius:
                50%;

            display: flex;

            align-items: center;

            justify-content:
                center;

            background:
                conic-gradient(#087ce0 var(--progress),

                    #e1ecf5 0deg);

            position:
                relative;

        }


        .progress-circle::before {

            content: "";

            position:
                absolute;

            width: 92px;

            height: 92px;

            border-radius:
                50%;

            background:
                white;

        }


        .progress-circle-value {

            position:
                relative;

            z-index: 2;

            font-size:
                25px;

            font-weight:
                700;

            color:
                #14304a;

        }


        .progress-circle-label {

            margin-top:
                8px;

            text-align:
                center;

            color:
                #73879a;

            font-size:
                11px;

        }


        /* =====================================================
           STATISTIC CARDS
        ===================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(4,
                    1fr);

            gap:
                13px;

            margin:
                18px 0;

        }


        .stat-card {

            padding:
                15px;

            border:
                1px solid #e7edf3;

            border-radius:
                11px;

            background:
                #fbfdff;

        }


        .stat-title {

            color:
                #778b9e;

            font-size:
                11px;

            margin-bottom:
                7px;

        }


        .stat-number {

            color:
                #17364f;

            font-size:
                22px;

            font-weight:
                700;

        }


        .stat-blue {

            color:
                #087ae0;

        }


        .stat-green {

            color:
                #169260;

        }


        .stat-orange {

            color:
                #e47a20;

        }


        /* =====================================================
           LOWER GRID
        ===================================================== */

        .progress-content-grid {

            display: grid;

            grid-template-columns:
                1fr 1fr 1fr;

            gap:
                15px;

        }


        .panel {

            border:
                1px solid #e5edf4;

            border-radius:
                12px;

            background:
                white;

            padding:
                17px;

        }


        .panel-title {

            color:
                #17354f;

            font-size:
                14px;

            font-weight:
                700;

            margin-bottom:
                4px;

        }


        .panel-subtitle {

            color:
                #8596a6;

            font-size:
                10px;

            margin-bottom:
                17px;

        }


        /* =====================================================
           WORK STEPS
        ===================================================== */

        .work-step {

            display: flex;

            gap: 11px;

            padding:
                12px 0;

            border-bottom:
                1px solid #eef2f6;

        }


        .work-step:last-child {

            border-bottom:
                none;

        }


        .step-number {

            width: 25px;
            height: 25px;

            flex-shrink:
                0;

            border-radius:
                50%;

            display: flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #e7f2ff;

            color:
                #0874ca;

            font-size:
                10px;

            font-weight:
                700;

        }


        .step-number.completed {

            background:
                #ddf8eb;

            color:
                #14835c;

        }


        .step-info {

            flex:
                1;

        }


        .step-title {

            color:
                #29445b;

            font-size:
                12px;

            font-weight:
                700;

            margin-bottom:
                4px;

        }


        .step-description {

            color:
                #8696a5;

            font-size:
                10px;

        }


        .step-status {

            font-size:
                9px;

            padding:
                4px 7px;

            border-radius:
                10px;

            white-space:
                nowrap;

        }


        .step-status.completed {

            color:
                #16825d;

            background:
                #dcf8ea;

        }


        .step-status.ongoing {

            color:
                #0874ca;

            background:
                #e4f1ff;

        }


        .step-status.pending {

            color:
                #7a8996;

            background:
                #edf1f5;

        }


        /* =====================================================
           PROGRESS UPDATE
        ===================================================== */

        .update-item {

            display:
                grid;

            grid-template-columns:
                1fr 80px;

            gap:
                10px;

            padding:
                11px 0;

            border-bottom:
                1px solid #eef2f6;

        }


        .update-item:last-child {

            border-bottom:
                none;

        }


        .update-date {

            color:
                #0876d0;

            font-size:
                10px;

            font-weight:
                700;

            margin-bottom:
                5px;

        }


        .update-title {

            color:
                #29445b;

            font-size:
                12px;

            font-weight:
                700;

            margin-bottom:
                4px;

        }


        .update-description {

            color:
                #8596a5;

            font-size:
                10px;

            line-height:
                1.5;

        }


        .update-image {

            width:
                80px;

            height:
                65px;

            border-radius:
                8px;

            object-fit:
                cover;

            background:
                #e5edf4;

        }


        /* =====================================================
           ROOM PROGRESS
        ===================================================== */

        .room-card {

            padding:
                10px 0 15px;

            border-bottom:
                1px solid #eef2f6;

        }


        .room-card:last-child {

            border-bottom:
                none;

        }


        .room-image {

            width:
                100%;

            height:
                120px;

            border-radius:
                9px;

            object-fit:
                cover;

            margin-bottom:
                9px;

            background:
                linear-gradient(135deg,
                    #dcebf8,
                    #eef5fa);

        }


        .room-header {

            display:
                flex;

            justify-content:
                space-between;

            gap:
                10px;

            margin-bottom:
                7px;

        }


        .room-name {

            color:
                #29445b;

            font-size:
                12px;

            font-weight:
                700;

        }


        .room-percent {

            color:
                #0875cf;

            font-size:
                12px;

            font-weight:
                700;

        }


        .room-progress-track {

            height:
                7px;

            background:
                #e3eaf0;

            border-radius:
                20px;

            overflow:
                hidden;

        }


        .room-progress-fill {

            height:
                100%;

            border-radius:
                20px;

            background:
                linear-gradient(90deg,
                    #1484df,
                    #21a3ec);

        }


        .room-description {

            margin-top:
                7px;

            color:
                #8596a5;

            font-size:
                9px;

            line-height:
                1.5;

        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .project-button-area {

            margin-top:
                17px;

            display: flex;

            justify-content:
                flex-end;

        }


        .btn-detail {

            padding:
                10px 16px;

            border-radius:
                8px;

            background:
                linear-gradient(90deg,
                    #075ca3,
                    #087acb);

            color:
                white;

            text-decoration:
                none;

            font-size:
                11px;

            font-weight:
                700;

        }


        /* EMPTY */

        .empty-state {

            padding:
                45px 20px;

            border:
                1px solid #e5edf4;

            background:
                white;

            border-radius:
                13px;

            text-align:
                center;

            color:
                #8394a4;

            font-size:
                13px;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 1100px) {

            .progress-content-grid {

                grid-template-columns:
                    1fr 1fr;

            }

            .project-overview {

                grid-template-columns:
                    170px 1fr;

            }

            .progress-circle-box {

                grid-column:
                    1 / -1;

            }

        }


        @media(max-width: 850px) {

            .sidebar {

                display: none;

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

            .topbar {

                padding:
                    0 17px;

            }

            .project-overview {

                grid-template-columns:
                    1fr;

            }

            .project-image {

                width:
                    100%;

                height:
                    210px;

            }

            .stats-grid {

                grid-template-columns:
                    1fr 1fr;

            }

            .progress-content-grid {

                grid-template-columns:
                    1fr;

            }

        }
    </style>

</head>


<body>


    <div class="app">


        <!-- =====================================================
         SIDEBAR
    ====================================================== -->

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

                <span class="menu-icon">
                    ⌂
                </span>

                Dashboard

            </a>



            <a
                href="{{ route('client.projects.index') }}"
                class="menu-item">

                <span class="menu-icon">
                    ▣
                </span>

                Proyek Saya

            </a>



            <a
                href="{{ route('client.schedule') }}"
                class="menu-item">

                <span class="menu-icon">
                    ▦
                </span>

                Jadwal

            </a>



            <a
                href="{{ route('client.progress') }}"
                class="menu-item active">

                <span class="menu-icon">
                    ↗
                </span>

                Progress

            </a>



            <a
                href="{{ route('client.documentation') }}"
                class="menu-item">

                <span class="menu-icon">
                    ▧
                </span>

                Dokumentasi

            </a>



            <a
                href="{{ route('client.costs') }}"
                class="menu-item">

                <span class="menu-icon">
                    ▤
                </span>

                Informasi Biaya

            </a>



            <a
                href="{{ route('client.messages') }}"
                class="menu-item">

                <span class="menu-icon">
                    ✉
                </span>

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



        <!-- =====================================================
         MAIN
    ====================================================== -->

        <main class="main">


            <header class="topbar">


                <div class="hamburger">

                    ☰

                </div>


                <div class="user-area">

                    <span>
                        ♧
                    </span>

                    <div class="avatar">
                        👤
                    </div>

                    <span>

                        {{ auth()->user()->name }}

                    </span>

                    <span>
                        ▾
                    </span>

                </div>


            </header>



            <section class="content">


                <div class="page-header">

                    <h1>
                        Progress Proyek
                    </h1>

                    <p>
                        Pantau perkembangan proyek renovasi Anda secara terperinci
                    </p>

                </div>



                @forelse($projects as $project)


                @php

                $totalWorks =
                $project->works->count();

                $completedWorks =
                $project->works
                ->where(
                'status',
                'completed'
                )
                ->count();

                $ongoingWorks =
                $project->works
                ->where(
                'status',
                'ongoing'
                )
                ->count();

                $remainingWorks =
                max(
                0,
                $totalWorks
                -
                $completedWorks
                -
                $ongoingWorks
                );

                @endphp



                <div class="project-card">


                    <!-- PROJECT OVERVIEW -->

                    <div class="project-overview">


                        @if($project->cover_image)

                        <img
                            src="{{ asset('storage/' . $project->cover_image) }}"
                            alt="{{ $project->project_name }}"
                            class="project-image">

                        @else

                        <div class="project-image"></div>

                        @endif



                        <div>


                            <div class="project-title">

                                {{ $project->project_name }}

                            </div>


                            <div class="project-meta">

                                ◉ {{ $project->location }}

                            </div>


                            <div class="project-meta">

                                ▦

                                @if($project->start_date)

                                {{
                                        \Carbon\Carbon::parse(
                                            $project->start_date
                                        )->format('d M Y')
                                    }}

                                @else

                                -

                                @endif


                                &nbsp;–&nbsp;


                                @if($project->target_end_date)

                                {{
                                        \Carbon\Carbon::parse(
                                            $project->target_end_date
                                        )->format('d M Y')
                                    }}

                                @else

                                -

                                @endif

                            </div>


                            <div class="status">

                                @if($project->status === 'ongoing')

                                Berjalan

                                @elseif($project->status === 'completed')

                                Selesai

                                @elseif($project->status === 'paused')

                                Ditunda

                                @else

                                Perencanaan

                                @endif

                            </div>


                            <div class="project-description">

                                {{
                                    $project->description
                                    ?: 'Belum ada deskripsi proyek.'
                                }}

                            </div>


                        </div>



                        <div class="progress-circle-box">


                            <div
                                class="progress-circle"
                                data-progress="{{ $project->progress_percentage }}">

                                <span class="progress-circle-value">

                                    {{ $project->progress_percentage }}%

                                </span>

                            </div>


                            <div class="progress-circle-label">

                                Total Progress

                            </div>


                        </div>


                    </div>



                    <!-- STATISTICS -->

                    <div class="stats-grid">


                        <div class="stat-card">

                            <div class="stat-title">

                                Total Progress

                            </div>

                            <div class="stat-number stat-blue">

                                {{ $project->progress_percentage }}%

                            </div>

                        </div>



                        <div class="stat-card">

                            <div class="stat-title">

                                Tahap Selesai

                            </div>

                            <div class="stat-number stat-green">

                                {{ $completedWorks }}

                            </div>

                        </div>



                        <div class="stat-card">

                            <div class="stat-title">

                                Tahap Berjalan

                            </div>

                            <div class="stat-number stat-orange">

                                {{ $ongoingWorks }}

                            </div>

                        </div>



                        <div class="stat-card">

                            <div class="stat-title">

                                Tahap Berikutnya

                            </div>

                            <div class="stat-number">

                                {{ $remainingWorks }}

                            </div>

                        </div>


                    </div>



                    <!-- LOWER SECTION -->

                    <div class="progress-content-grid">


                        <!-- ================================
                             DAFTAR TAHAP PEKERJAAN
                        ================================= -->

                        <div class="panel">


                            <div class="panel-title">

                                Daftar Tahap Pekerjaan

                            </div>


                            <div class="panel-subtitle">

                                Pantau status setiap tahap pekerjaan renovasi

                            </div>



                            @forelse(
                            $project->works->take(5)
                            as $work
                            )


                            <div class="work-step">


                                <div
                                    class="
                                            step-number
                                            {{ $work->status === 'completed' ? 'completed' : '' }}
                                        ">

                                    {{
                                            $loop->iteration
                                        }}

                                </div>


                                <div class="step-info">


                                    <div class="step-title">

                                        {{ $work->work_name }}

                                    </div>


                                    <div class="step-description">

                                        {{
                                                $work->description
                                                ?? 'Tahap pekerjaan proyek'
                                            }}

                                    </div>


                                </div>


                                @php

                                $workStatus =
                                $work->status
                                ?? 'planned';

                                @endphp


                                @if($workStatus === 'completed')

                                <span
                                    class="step-status completed">

                                    Selesai

                                </span>


                                @elseif($workStatus === 'ongoing')

                                <span
                                    class="step-status ongoing">

                                    Sedang berjalan

                                </span>


                                @else

                                <span
                                    class="step-status pending">

                                    Belum dimulai

                                </span>

                                @endif


                            </div>


                            @empty


                            <div class="empty-state">

                                Belum ada tahap pekerjaan.

                            </div>


                            @endforelse


                        </div>



                        <!-- ================================
                             UPDATE PROGRESS TERBARU
                        ================================= -->

                        <div class="panel">


                            <div class="panel-title">

                                Update Progress Terbaru

                            </div>


                            <div class="panel-subtitle">

                                Riwayat perkembangan proyek terbaru

                            </div>



                            @forelse(
                            $project->progressUpdates
                            ->take(4)
                            as $update
                            )


                            <div class="update-item">


                                <div>


                                    <div class="update-date">

                                        @if($update->update_date)

                                        {{
                                                    \Carbon\Carbon::parse(
                                                        $update->update_date
                                                    )->format('d M Y')
                                                }}

                                        @endif

                                    </div>


                                    <div class="update-title">

                                        Progress
                                        {{ $update->percentage }}%

                                    </div>


                                    <div class="update-description">

                                        {{
                                                $update->description
                                                ?: 'Update perkembangan proyek.'
                                            }}

                                    </div>


                                </div>



                                @if($update->photo_path)

                                <img
                                    src="{{ asset('storage/' . $update->photo_path) }}"
                                    alt="Progress"
                                    class="update-image">

                                @else

                                <div class="update-image"></div>

                                @endif


                            </div>


                            @empty


                            <div class="empty-state">

                                Belum ada update progress.

                            </div>


                            @endforelse


                        </div>



                        <!-- ================================
                             PROGRESS PER AREA / RUANG
                        ================================= -->

                        <div class="panel">


                            <div class="panel-title">

                                Progress per Area/Ruangan

                            </div>


                            <div class="panel-subtitle">

                                Persentase penyelesaian dan gambar setiap ruangan

                            </div>



                            @forelse(
                            $project->areas->take(4)
                            as $area
                            )


                            @php

                            $areaProgress =
                            $area->progress_percentage
                            ?? 0;

                            @endphp


                            <div class="room-card">


                                @if($area->photo)

                                <img
                                    src="{{ asset('storage/' . $area->photo) }}"
                                    alt="{{ $area->area_name }}"
                                    class="room-image">

                                @else

                                <div class="room-image"></div>

                                @endif



                                <div class="room-header">


                                    <div class="room-name">

                                        {{ $area->area_name }}

                                    </div>


                                    <div class="room-percent">

                                        {{ $areaProgress }}%

                                    </div>


                                </div>



                                <div class="room-progress-track">


                                    <div
                                        class="room-progress-fill"
                                        data-progress="{{ $areaProgress }}">

                                    </div>


                                </div>



                                <div class="room-description">

                                    {{
                                            $area->description
                                            ?: 'Belum ada keterangan progress ruangan.'
                                        }}

                                </div>


                            </div>


                            @empty


                            <div class="empty-state">

                                Belum ada data area atau ruangan.

                            </div>


                            @endforelse


                        </div>


                    </div>



                    <div class="project-button-area">


                        <a
                            href="{{ route('client.projects.progress', $project) }}"
                            class="btn-detail">

                            Lihat Detail Progress

                        </a>


                    </div>


                </div>


                @empty


                <div class="empty-state">

                    Belum ada proyek yang terhubung dengan akun Anda.

                </div>


                @endforelse


            </section>


        </main>


    </div>



    <script>
        /*
    |--------------------------------------------------------------------------
    | CIRCULAR PROJECT PROGRESS
    |--------------------------------------------------------------------------
    */

        document
            .querySelectorAll(
                '.progress-circle'
            )
            .forEach(
                function(circle) {

                    let progress =
                        parseInt(
                            circle.dataset.progress ||
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


                    const degree =
                        progress * 3.6;


                    circle.style
                        .setProperty(
                            '--progress',
                            degree + 'deg'
                        );

                }
            );



        /*
        |--------------------------------------------------------------------------
        | ROOM PROGRESS BAR
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.room-progress-fill'
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