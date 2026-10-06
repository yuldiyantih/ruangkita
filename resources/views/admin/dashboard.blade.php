<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - RuangKita</title>

    <style>
        /* =====================================================
           RESET
        ===================================================== */

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
            color: #18334d;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {
            min-height: 100vh;
            display: flex;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 230px;

            min-height: 100vh;

            position: fixed;

            top: 0;
            left: 0;

            padding: 20px 14px;

            background:
                linear-gradient(180deg,
                    #0d3458 0%,
                    #092843 100%);

            color: white;

            overflow-y: auto;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            display: flex;
            align-items: center;

            gap: 10px;

            padding:
                5px 9px 24px;
        }


        .brand-name {
            font-size: 18px;
            font-weight: 700;
        }


        /* =====================================================
           LOGO RUANGKITA
        ===================================================== */

        .ruangkita-logo {
            position: relative;

            width: 31px;
            height: 31px;

            flex-shrink: 0;
        }


        .ruangkita-logo .roof {
            position: absolute;

            width: 20px;
            height: 20px;

            left: 5px;
            top: 2px;

            border-left: 4px solid white;
            border-top: 4px solid white;

            transform: rotate(45deg);

            border-radius: 2px;
        }


        .ruangkita-logo .house {
            position: absolute;

            width: 19px;
            height: 17px;

            left: 6px;
            bottom: 2px;

            border-left: 4px solid white;
            border-right: 4px solid white;
            border-bottom: 4px solid white;
        }


        .ruangkita-logo .door {
            position: absolute;

            width: 6px;
            height: 9px;

            left: 50%;
            bottom: -1px;

            transform: translateX(-50%);

            border:
                2px solid white;

            border-bottom: none;
        }


        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .menu-item {
            width: 100%;

            height: 42px;

            padding:
                0 13px;

            margin-bottom: 3px;

            border-radius: 8px;

            display: flex;
            align-items: center;

            gap: 11px;

            color: #d6e6f5;

            font-size: 13px;

            text-decoration: none;

            transition: .2s;
        }


        .menu-item:hover {
            background:
                rgba(255, 255, 255, .08);

            color: white;
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

            font-size: 15px;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            width:
                calc(100% - 230px);

            margin-left: 230px;

            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 66px;

            background: white;

            border-bottom:
                1px solid #e8eef4;

            display: flex;
            align-items: center;

            justify-content: space-between;

            padding:
                0 28px;
        }


        .hamburger {
            color: #506c84;
            font-size: 21px;
        }


        .top-right {
            display: flex;
            align-items: center;

            gap: 15px;
        }


        .notification {
            position: relative;

            font-size: 18px;
        }


        .notification-dot {
            width: 7px;
            height: 7px;

            position: absolute;

            right: 0;
            top: 0;

            background: #ef4444;

            border:
                2px solid white;

            border-radius: 50%;
        }


        .profile {
            display: flex;
            align-items: center;

            gap: 8px;

            font-size: 13px;
            font-weight: 600;
        }


        .avatar {
            width: 34px;
            height: 34px;

            border-radius: 50%;

            background: #deebf5;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding:
                27px 30px 40px;
        }


        .page-header {
            margin-bottom: 22px;
        }


        .page-header h1 {
            color: #102d49;

            font-size: 27px;

            margin-bottom: 4px;
        }


        .page-header p {
            color: #8496a7;

            font-size: 13px;
        }


        /* =====================================================
           STAT CARDS
        ===================================================== */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            margin-bottom: 21px;
        }


        .stat-card {
            background: white;

            min-height: 82px;

            padding: 15px;

            border-radius: 12px;

            border:
                1px solid #e7edf3;

            display: flex;
            align-items: center;

            gap: 12px;
        }


        .stat-icon {
            width: 43px;
            height: 43px;

            flex-shrink: 0;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }


        .stat-icon.blue {
            color: #0b73d1;
            background: #e7f2ff;
        }


        .stat-icon.green {
            color: #119568;
            background: #e1f9ef;
        }


        .stat-icon.purple {
            color: #7834d4;
            background: #f0e8ff;
        }


        .stat-icon.orange {
            color: #e66a13;
            background: #fff0df;
        }


        .stat-label {
            font-size: 11px;

            color: #8294a5;
        }


        .stat-value {
            margin-top: 4px;

            color: #15324c;

            font-size: 18px;
            font-weight: 700;
        }


        /* =====================================================
           PANEL
        ===================================================== */

        .panel {
            background: white;

            border:
                1px solid #e7edf3;

            border-radius: 12px;

            overflow: hidden;

            margin-bottom: 20px;
        }


        .panel-header {
            min-height: 52px;

            padding:
                0 18px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom:
                1px solid #edf2f6;
        }


        .panel-header h3 {
            font-size: 15px;

            color: #18344e;
        }


        .panel-header a {
            text-decoration: none;

            color: #0571c5;

            font-size: 12px;
            font-weight: 600;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {
            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;
        }


        thead {
            background: #f7fafc;
        }


        th {
            text-align: left;

            padding:
                10px 16px;

            color: #758899;

            font-size: 11px;

            font-weight: 600;
        }


        td {
            padding:
                12px 16px;

            border-top:
                1px solid #edf2f6;

            color: #2f485e;

            font-size: 12px;
        }


        .progress-row {
            display: flex;
            align-items: center;

            gap: 7px;
        }


        .progress-track {
            width: 85px;
            height: 7px;

            overflow: hidden;

            border-radius: 30px;

            background: #e4eaf0;
        }


        .progress-fill {
            height: 100%;

            border-radius: 30px;

            background:
                linear-gradient(90deg,
                    #1384dc,
                    #22a3ed);
        }


        .progress-number {
            color: #546b80;

            font-size: 11px;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge {
            display: inline-flex;

            padding:
                5px 9px;

            border-radius: 18px;

            font-size: 10px;

            font-weight: 600;
        }


        .badge-ongoing {
            color: #117653;
            background: #dff8ec;
        }


        .badge-completed {
            color: #0967b2;
            background: #e3f1ff;
        }


        .badge-planning {
            color: #986300;
            background: #fff2ce;
        }


        .badge-paused {
            color: #b55318;
            background: #ffeadc;
        }


        /* =====================================================
           BOTTOM GRID
        ===================================================== */

        .dashboard-bottom {
            display: grid;

            grid-template-columns:
                1.2fr .8fr;

            gap: 18px;
        }


        /* =====================================================
           SCHEDULE
        ===================================================== */

        .schedule-row {
            display: grid;

            grid-template-columns:
                92px 1fr 1fr;

            gap: 12px;

            padding:
                13px 18px;

            border-bottom:
                1px solid #edf2f6;

            font-size: 12px;
        }


        .schedule-row:last-child {
            border-bottom: none;
        }


        .schedule-date {
            color: #eb9415;

            font-weight: 600;
        }


        .schedule-project {
            color: #8293a3;
        }


        /* =====================================================
           WARNING
        ===================================================== */

        .warning {
            padding:
                14px 17px;

            display: flex;

            gap: 11px;

            border-bottom:
                1px solid #edf2f6;
        }


        .warning:last-child {
            border-bottom: none;
        }


        .warning-icon {
            width: 36px;
            height: 36px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            color: #e85a27;

            background: #fff0e7;
        }


        .warning-icon.yellow {
            color: #d58b07;

            background: #fff7db;
        }


        .warning-title {
            color: #263e53;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 4px;
        }


        .warning-text {
            color: #8393a1;

            font-size: 11px;

            line-height: 1.5;
        }


        .empty-data {
            padding: 23px;

            color: #8393a1;

            font-size: 12px;

            text-align: center;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 1100px) {

            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media(max-width: 850px) {

            .sidebar {
                display: none;
            }


            .main {
                width: 100%;
                margin-left: 0;
            }


            .dashboard-bottom {
                grid-template-columns:
                    1fr;
            }

        }


        @media(max-width: 600px) {

            .content {
                padding:
                    20px 14px;
            }


            .stats {
                grid-template-columns:
                    1fr;
            }


            .topbar {
                padding:
                    0 17px;
            }


            .profile-name {
                display: none;
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
                href="{{ route('admin.dashboard') }}"
                class="menu-item active">

                <span class="menu-icon">⌂</span>

                Dashboard

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">♙</span>

                Client

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▣</span>

                Proyek

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▤</span>

                Pekerjaan

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▦</span>

                Jadwal

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">◆</span>

                Material

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▰</span>

                Pengeluaran

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">◉</span>

                Uang Pribadi

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">↗</span>

                Progress

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▧</span>

                Dokumentasi

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">▥</span>

                Laporan

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">⚙</span>

                Pengaturan

            </a>


        </aside>



        <!-- =====================================================
         MAIN
    ====================================================== -->

        <main class="main">


            <!-- TOPBAR -->

            <header class="topbar">


                <div class="hamburger">
                    ☰
                </div>


                <div class="top-right">


                    <div class="notification">

                        ♧

                        <span class="notification-dot"></span>

                    </div>


                    <div class="profile">

                        <div class="avatar">
                            👤
                        </div>

                        <span class="profile-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span>
                            ▾
                        </span>

                    </div>


                </div>


            </header>



            <!-- =====================================================
             CONTENT
        ====================================================== -->

            <section class="content">


                <div class="page-header">


                    <h1>
                        Dashboard
                    </h1>


                    <p>
                        Selamat datang,
                        {{ auth()->user()->name }}!
                    </p>


                </div>



                <!-- =================================================
                 STATISTICS
            ================================================== -->

                <div class="stats">


                    <div class="stat-card">

                        <div class="stat-icon blue">
                            ▣
                        </div>

                        <div>

                            <div class="stat-label">
                                Total Proyek
                            </div>

                            <div class="stat-value">
                                {{ $totalProjects }}
                            </div>

                        </div>

                    </div>



                    <div class="stat-card">

                        <div class="stat-icon green">
                            ▰
                        </div>

                        <div>

                            <div class="stat-label">
                                Proyek Berjalan
                            </div>

                            <div class="stat-value">
                                {{ $ongoingProjects }}
                            </div>

                        </div>

                    </div>



                    <div class="stat-card">

                        <div class="stat-icon purple">
                            ✓
                        </div>

                        <div>

                            <div class="stat-label">
                                Proyek Selesai
                            </div>

                            <div class="stat-value">
                                {{ $completedProjects }}
                            </div>

                        </div>

                    </div>



                    <div class="stat-card">

                        <div class="stat-icon orange">
                            Rp
                        </div>

                        <div>

                            <div class="stat-label">
                                Total Pengeluaran
                            </div>

                            <div class="stat-value">

                                Rp {{ number_format(
                                $totalExpenses,
                                0,
                                ',',
                                '.'
                            ) }}

                            </div>

                        </div>

                    </div>


                </div>



                <!-- =================================================
                 PROJECT TERBARU
            ================================================== -->

                <div class="panel">


                    <div class="panel-header">

                        <h3>
                            Proyek Terbaru
                        </h3>

                        <a href="#">
                            Lihat Semua
                        </a>

                    </div>


                    <div class="table-wrapper">


                        <table>


                            <thead>

                                <tr>

                                    <th>Nama Proyek</th>

                                    <th>Client</th>

                                    <th>Lokasi</th>

                                    <th>Progress</th>

                                    <th>Status</th>

                                </tr>

                            </thead>


                            <tbody>


                                @forelse($latestProjects as $project)


                                <tr>


                                    <td>

                                        {{ $project->project_name }}

                                    </td>


                                    <td>

                                        {{
                                        optional(
                                            optional(
                                                $project->client
                                            )->user
                                        )->name
                                        ?? '-'
                                    }}

                                    </td>


                                    <td>

                                        {{ $project->location }}

                                    </td>


                                    <td>
                                        <div class="progress-row">
                                            <div class="progress-track">
                                                <div
                                                    class="progress-fill"
                                                    data-progress="{{ $project->progress_percentage }}">
                                                </div>
                                            </div>

                                            <span class="progress-number">
                                                {{ $project->progress_percentage }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td>


                                        @if(
                                        $project->status
                                        ===
                                        'ongoing'
                                        )

                                        <span class="badge badge-ongoing">

                                            Berjalan

                                        </span>


                                        @elseif(
                                        $project->status
                                        ===
                                        'completed'
                                        )

                                        <span class="badge badge-completed">

                                            Selesai

                                        </span>


                                        @elseif(
                                        $project->status
                                        ===
                                        'paused'
                                        )

                                        <span class="badge badge-paused">

                                            Ditunda

                                        </span>


                                        @else

                                        <span class="badge badge-planning">

                                            Perencanaan

                                        </span>

                                        @endif


                                    </td>


                                </tr>


                                @empty


                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty-data">

                                        Belum ada data proyek.

                                    </td>

                                </tr>


                                @endforelse


                            </tbody>


                        </table>


                    </div>


                </div>



                <!-- =================================================
                 BOTTOM
            ================================================== -->

                <div class="dashboard-bottom">


                    <!-- JADWAL -->

                    <div class="panel">


                        <div class="panel-header">

                            <h3>
                                Jadwal Mendatang
                            </h3>

                        </div>


                        @forelse($upcomingSchedules as $schedule)

                        <div class="schedule-row">


                            <div class="schedule-date">

                                {{
                                    \Carbon\Carbon::parse(
                                        $schedule->start_date
                                    )->format('d M Y')
                                }}

                            </div>


                            <div>

                                {{ $schedule->title }}

                            </div>


                            <div class="schedule-project">

                                {{
                                    optional(
                                        $schedule->project
                                    )->project_name
                                    ?? '-'
                                }}

                            </div>


                        </div>


                        @empty


                        <div class="empty-data">

                            Belum ada jadwal mendatang.

                        </div>


                        @endforelse


                    </div>



                    <!-- PERINGATAN -->

                    <div class="panel">


                        <div class="panel-header">

                            <h3>
                                Peringatan
                            </h3>

                        </div>


                        <div class="warning">


                            <div class="warning-icon">

                                ⚠

                            </div>


                            <div>

                                <div class="warning-title">

                                    Jadwal proyek bertabrakan

                                </div>

                                <div class="warning-text">

                                    Periksa kembali jadwal
                                    proyek yang berlangsung
                                    pada tanggal yang sama.

                                </div>

                            </div>


                        </div>



                        <div class="warning">


                            <div class="warning-icon yellow">

                                !

                            </div>


                            <div>

                                <div class="warning-title">

                                    Nota belum diunggah

                                </div>

                                <div class="warning-text">

                                    Periksa pengeluaran
                                    proyek yang belum
                                    memiliki bukti nota.

                                </div>

                            </div>


                        </div>


                    </div>


                </div>


            </section>


        </main>


    </div>

    <script>
        document.querySelectorAll('.progress-fill').forEach(function(bar) {
            const value = bar.dataset.progress ?? 0;
            bar.style.width = value + '%';
        });
    </script>
</body>

</html>