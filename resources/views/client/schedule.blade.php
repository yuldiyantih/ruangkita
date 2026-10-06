<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal - RuangKita</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f8fc;
            color: #17334c;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 230px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;

            padding: 20px 14px;

            background:
                linear-gradient(180deg,
                    #0d3458,
                    #092843);

            color: white;
        }

        .brand {
            padding: 5px 9px 24px;

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
        }

        .ruangkita-logo .roof {
            width: 20px;
            height: 20px;

            position: absolute;

            left: 5px;
            top: 2px;

            border-left: 4px solid white;
            border-top: 4px solid white;

            transform: rotate(45deg);
        }

        .ruangkita-logo .house {
            width: 19px;
            height: 17px;

            position: absolute;

            left: 6px;
            bottom: 2px;

            border-left: 4px solid white;
            border-right: 4px solid white;
            border-bottom: 4px solid white;
        }

        .ruangkita-logo .door {
            width: 6px;
            height: 9px;

            position: absolute;

            left: 50%;
            bottom: -1px;

            transform: translateX(-50%);

            border: 2px solid white;
            border-bottom: none;
        }

        .menu-item {
            min-height: 42px;

            padding: 0 13px;
            margin-bottom: 3px;

            border-radius: 8px;

            display: flex;
            align-items: center;
            gap: 11px;

            text-decoration: none;

            color: #d6e6f5;

            font-size: 13px;

            transition: .2s;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, .08);
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

        /* =========================
           MAIN
        ========================= */

        .main {
            width: calc(100% - 230px);
            margin-left: 230px;
        }

        .topbar {
            height: 66px;

            background: white;

            border-bottom:
                1px solid #e7edf3;

            padding: 0 28px;

            display: flex;
            align-items: center;
            justify-content: space-between;
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

            background: #e4eef7;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 28px 30px 40px;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-header h1 {
            color: #14304a;

            font-size: 27px;

            margin-bottom: 4px;
        }

        .page-header p {
            color: #8395a7;

            font-size: 13px;
        }

        /* =========================
           SUMMARY CARDS
        ========================= */

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            margin-bottom: 22px;
        }

        .summary-card {
            background: white;

            border:
                1px solid #e7edf3;

            border-radius: 12px;

            padding: 18px;
        }

        .summary-label {
            color: #8293a3;

            font-size: 11px;

            margin-bottom: 7px;
        }

        .summary-value {
            color: #17334c;

            font-size: 24px;

            font-weight: 700;
        }

        .summary-value.blue {
            color: #0874ca;
        }

        .summary-value.green {
            color: #14835c;
        }

        .summary-value.orange {
            color: #d76a14;
        }

        /* =========================
           FILTERS
        ========================= */

        .toolbar {
            margin-bottom: 18px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 14px;

            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;

            gap: 9px;

            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 9px 15px;

            border: none;
            border-radius: 10px;

            background: #eaf1f7;

            color: #526a7e;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;
        }

        .filter-btn.active {
            color: white;

            background:
                linear-gradient(90deg,
                    #0767ae,
                    #087dce);
        }

        .sort-box {
            padding: 9px 13px;

            background: white;

            border:
                1px solid #e5ecf2;

            border-radius: 10px;

            color: #5f7588;

            font-size: 12px;
        }

        /* =========================
           PROJECT SECTION
        ========================= */

        .project-block {
            margin-bottom: 20px;
        }

        .project-header-card {
            background: white;

            border:
                1px solid #e6edf3;

            border-radius:
                13px 13px 0 0;

            padding: 16px 18px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;
        }

        .project-info {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .project-thumb {
            width: 68px;
            height: 52px;

            border-radius: 8px;

            object-fit: cover;

            background:
                linear-gradient(135deg,
                    #dbeaf7,
                    #edf5fa);
        }

        .project-name {
            font-size: 14px;
            font-weight: 700;

            margin-bottom: 4px;
        }

        .project-location {
            color: #8092a3;

            font-size: 11px;
        }

        .btn-project {
            padding: 8px 12px;

            border-radius: 8px;

            text-decoration: none;

            background: #eaf4fd;

            color: #0873c7;

            font-size: 11px;
            font-weight: 600;
        }

        /* =========================
           TIMELINE
        ========================= */

        .schedule-panel {
            background: white;

            border-left:
                1px solid #e6edf3;

            border-right:
                1px solid #e6edf3;

            border-bottom:
                1px solid #e6edf3;

            border-radius:
                0 0 13px 13px;

            padding: 20px;
        }

        .timeline {
            position: relative;

            margin-left: 13px;
        }

        .timeline::before {
            content: "";

            position: absolute;

            left: 12px;
            top: 6px;
            bottom: 6px;

            width: 2px;

            background: #dce6ee;
        }

        .timeline-item {
            position: relative;

            padding-left: 48px;

            padding-bottom: 25px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-dot {
            position: absolute;

            left: 0;
            top: 1px;

            width: 26px;
            height: 26px;

            border-radius: 50%;

            border: 4px solid white;

            box-shadow:
                0 0 0 1px #d9e5ef;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 10px;

            z-index: 2;
        }

        .timeline-dot.planned {
            background: #e7f2ff;
            color: #0874ca;
        }

        .timeline-dot.ongoing {
            background: #ddf8eb;
            color: #14835c;
        }

        .timeline-dot.completed {
            background: #e3f1ff;
            color: #126ab3;
        }

        .timeline-dot.delayed {
            background: #fff0e2;
            color: #c95f16;
        }

        .timeline-card {
            display: grid;

            grid-template-columns:
                125px 1fr auto;

            gap: 16px;

            align-items: center;

            padding-bottom: 16px;

            border-bottom:
                1px solid #edf2f6;
        }

        .timeline-item:last-child .timeline-card {
            padding-bottom: 0;

            border-bottom: none;
        }

        .timeline-date {
            color: #d96a1e;

            font-size: 12px;

            font-weight: 700;
        }

        .timeline-title {
            color: #263f56;

            font-size: 14px;

            font-weight: 700;

            margin-bottom: 4px;
        }

        .timeline-description {
            color: #8192a2;

            font-size: 11px;

            line-height: 1.5;
        }

        .status-badge {
            display: inline-flex;

            padding:
                5px 9px;

            border-radius: 14px;

            white-space: nowrap;

            font-size: 10px;

            font-weight: 600;
        }

        .status-planned {
            background: #e7f2ff;
            color: #0874ca;
        }

        .status-ongoing {
            background: #ddf8eb;
            color: #14835c;
        }

        .status-completed {
            background: #e3f1ff;
            color: #126ab3;
        }

        .status-delayed {
            background: #fff0e2;
            color: #c95f16;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-project {
            padding: 26px;

            background: white;

            border:
                1px solid #e7edf3;

            border-radius: 12px;

            text-align: center;

            color: #8393a2;

            font-size: 13px;
        }

        .empty-schedule {
            padding: 25px;

            text-align: center;

            color: #8999a8;

            font-size: 12px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width: 1000px) {

            .summary-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .timeline-card {
                grid-template-columns:
                    110px 1fr;
            }
        }

        @media(max-width: 850px) {

            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }
        }

        @media(max-width: 600px) {

            .content {
                padding: 20px 14px;
            }

            .topbar {
                padding:
                    0 17px;
            }

            .summary-grid {
                grid-template-columns:
                    1fr 1fr;
            }

            .project-header-card {
                align-items:
                    flex-start;
            }

            .timeline-card {
                grid-template-columns:
                    1fr;
            }

            .toolbar {
                align-items:
                    stretch;
            }
        }
    </style>
</head>

<body>

    <div class="app">

        <!-- ============================================
         SIDEBAR
    ============================================= -->

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
                class="menu-item active">

                <span class="menu-icon">
                    ▦
                </span>

                Jadwal

            </a>


            <a
                href="{{ route('client.progress') }}"
                class="menu-item">

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

            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◉
                </span>

                Informasi Biaya

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ✉
                </span>

                Pesan

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◇
                </span>

                Augmented Reality

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ⚙
                </span>

                Pengaturan

            </a>

        </aside>


        <!-- ============================================
         MAIN
    ============================================= -->

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

                <!-- PAGE HEADER -->

                <div class="page-header">

                    <h1>
                        Jadwal
                    </h1>

                    <p>
                        Semua jadwal pekerjaan proyek renovasi Anda
                    </p>

                </div>


                <!-- ========================================
                 SUMMARY
            ========================================= -->

                @php

                $totalSchedules = 0;
                $ongoingSchedules = 0;
                $completedSchedules = 0;
                $delayedSchedules = 0;

                foreach ($projects as $summaryProject) {

                foreach ($summaryProject->schedules as $summarySchedule) {

                $totalSchedules++;

                if ($summarySchedule->status === 'ongoing') {
                $ongoingSchedules++;
                }

                if ($summarySchedule->status === 'completed') {
                $completedSchedules++;
                }

                if ($summarySchedule->status === 'delayed') {
                $delayedSchedules++;
                }

                }

                }

                @endphp


                <div class="summary-grid">


                    <div class="summary-card">

                        <div class="summary-label">
                            Total Jadwal
                        </div>

                        <div class="summary-value blue">
                            {{ $totalSchedules }}
                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-label">
                            Sedang Berjalan
                        </div>

                        <div class="summary-value green">
                            {{ $ongoingSchedules }}
                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-label">
                            Selesai
                        </div>

                        <div class="summary-value">
                            {{ $completedSchedules }}
                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-label">
                            Terlambat
                        </div>

                        <div class="summary-value orange">
                            {{ $delayedSchedules }}
                        </div>

                    </div>


                </div>


                <!-- ========================================
                 FILTER
            ========================================= -->

                <div class="toolbar">

                    <div class="filter-group">

                        <button
                            type="button"
                            class="filter-btn active"
                            data-filter="all">

                            Semua

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-filter="planned">

                            Akan Datang

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-filter="ongoing">

                            Sedang Berjalan

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-filter="completed">

                            Selesai

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-filter="delayed">

                            Terlambat

                        </button>

                    </div>


                    <div class="sort-box">

                        Urutkan:
                        Tanggal Terdekat

                    </div>

                </div>


                <!-- ========================================
                 PROJECTS + SCHEDULE
            ========================================= -->

                @forelse($projects as $project)


                <div class="project-block">


                    <!-- PROJECT HEADER -->

                    <div class="project-header-card">


                        <div class="project-info">


                            @if($project->cover_image)

                            <img
                                src="{{ asset('storage/' . $project->cover_image) }}"
                                class="project-thumb"
                                alt="{{ $project->project_name }}">

                            @else

                            <div class="project-thumb"></div>

                            @endif


                            <div>

                                <div class="project-name">

                                    {{ $project->project_name }}

                                </div>


                                <div class="project-location">

                                    ◉ {{ $project->location }}

                                </div>

                            </div>


                        </div>


                        <a
                            href="{{ route('client.projects.schedule', $project) }}"
                            class="btn-project">

                            Lihat Jadwal Proyek

                        </a>


                    </div>


                    <!-- SCHEDULE LIST -->

                    <div class="schedule-panel">


                        @if($project->schedules->count() > 0)


                        <div class="timeline">


                            @foreach($project->schedules as $schedule)


                            @php

                            $status =
                            $schedule->status
                            ?? 'planned';

                            $statusLabel =
                            match($status) {

                            'planned'
                            => 'Akan Datang',

                            'ongoing'
                            => 'Sedang Berjalan',

                            'completed'
                            => 'Selesai',

                            'delayed'
                            => 'Terlambat',

                            default
                            => ucfirst($status),
                            };

                            @endphp


                            <div
                                class="timeline-item schedule-item"
                                data-status="{{ $status }}">


                                <div
                                    class="timeline-dot {{ $status }}">

                                    ●

                                </div>


                                <div class="timeline-card">


                                    <div class="timeline-date">

                                        @if($schedule->start_date)

                                        {{ \Carbon\Carbon::parse(
                                                        $schedule->start_date
                                                    )->format('d M Y') }}

                                        @else

                                        -

                                        @endif

                                    </div>


                                    <div>


                                        <div class="timeline-title">

                                            {{ $schedule->title }}

                                        </div>


                                        <div class="timeline-description">

                                            {{ $schedule->description
                                                        ?: 'Belum ada deskripsi jadwal.' }}

                                        </div>


                                    </div>


                                    <div>

                                        <span
                                            class="
                                                        status-badge
                                                        status-{{ $status }}
                                                    ">

                                            {{ $statusLabel }}

                                        </span>

                                    </div>


                                </div>


                            </div>


                            @endforeach


                        </div>


                        @else


                        <div class="empty-schedule">

                            Belum ada jadwal
                            untuk proyek ini.

                        </div>


                        @endif


                    </div>


                </div>


                @empty


                <div class="empty-project">

                    Belum ada proyek
                    yang terhubung dengan akun Anda.

                </div>


                @endforelse


            </section>

        </main>

    </div>


    <script>
        const filterButtons =
            document.querySelectorAll(
                '.filter-btn'
            );

        const scheduleItems =
            document.querySelectorAll(
                '.schedule-item'
            );


        filterButtons.forEach(
            function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        filterButtons.forEach(
                            function(btn) {

                                btn.classList.remove(
                                    'active'
                                );

                            }
                        );


                        button.classList.add(
                            'active'
                        );


                        const filter =
                            button.dataset.filter;


                        scheduleItems.forEach(
                            function(item) {

                                const status =
                                    item.dataset.status;


                                if (
                                    filter === 'all' ||
                                    status === filter
                                ) {

                                    item.style.display =
                                        'block';

                                } else {

                                    item.style.display =
                                        'none';

                                }

                            }
                        );

                    }
                );

            }
        );
    </script>

</body>

</html>