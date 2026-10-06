<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Proyek - RuangKita</title>

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
            background: linear-gradient(180deg, #0d3458, #092843);
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
            position: relative;
            width: 31px;
            height: 31px;
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
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, .08);
        }

        .menu-item.active {
            background: linear-gradient(90deg, #0665ac, #087acb);
            color: white;
        }

        .menu-icon {
            width: 19px;
            text-align: center;
        }

        /* =========================
           MAIN
        ========================= */
        .main {
            margin-left: 230px;
            width: calc(100% - 230px);
        }

        .topbar {
            height: 66px;
            background: white;
            border-bottom: 1px solid #e7edf3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
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

        .breadcrumb {
            margin-bottom: 8px;
            color: #8092a3;
            font-size: 12px;
        }

        .breadcrumb a {
            color: #0874ca;
            text-decoration: none;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-header h1 {
            font-size: 27px;
            color: #14304a;
            margin-bottom: 5px;
        }

        .page-header p {
            color: #8495a6;
            font-size: 13px;
        }

        /* =========================
           PROJECT SUMMARY
        ========================= */
        .project-summary {
            background: white;
            border: 1px solid #e6edf3;
            border-radius: 13px;
            padding: 16px;
            display: grid;
            grid-template-columns: 120px 1fr 320px;
            gap: 18px;
            align-items: center;
            margin-bottom: 20px;
        }

        .project-thumb {
            width: 120px;
            height: 85px;
            object-fit: cover;
            border-radius: 9px;
            background: #e2edf5;
        }

        .project-summary h3 {
            font-size: 20px;
            margin-bottom: 6px;
            color: #18344e;
        }

        .project-meta {
            font-size: 13px;
            color: #75899c;
            line-height: 1.8;
        }

        .progress-box {
            align-self: center;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 8px;
            color: #5f7689;
        }

        .progress-track {
            height: 10px;
            background: #e3eaf0;
            border-radius: 30px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 30px;
            background: linear-gradient(90deg, #1484df, #21a3ec);
        }

        /* =========================
           FILTERS
        ========================= */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 18px;
            border-radius: 12px;
            border: none;
            background: #edf3f8;
            color: #486278;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .filter-btn.active {
            background: #0b78d1;
            color: white;
        }

        .sort-box {
            background: white;
            border: 1px solid #e6edf3;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 13px;
            color: #486278;
        }

        /* =========================
           TIMELINE PANEL
        ========================= */
        .schedule-panel {
            background: white;
            border: 1px solid #e6edf3;
            border-radius: 13px;
            padding: 22px;
            margin-bottom: 20px;
        }

        .timeline {
            position: relative;
            margin-left: 14px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 8px;
            bottom: 8px;
            left: 12px;
            width: 2px;
            background: #dce6ee;
        }

        .timeline-item {
            position: relative;
            padding-left: 50px;
            padding-bottom: 28px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 2px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            font-size: 11px;
            border: 4px solid white;
            box-shadow: 0 0 0 1px #d9e5ef;
        }

        .timeline-dot.planned {
            background: #e8f3ff;
            color: #0877d1;
        }

        .timeline-dot.ongoing {
            background: #dff8eb;
            color: #12835a;
        }

        .timeline-dot.completed {
            background: #e3f1ff;
            color: #126ab3;
        }

        .timeline-dot.delayed {
            background: #fff0e3;
            color: #d76a14;
        }

        .timeline-card {
            display: grid;
            grid-template-columns: 150px 1fr auto auto;
            gap: 16px;
            align-items: center;
            border-bottom: 1px solid #eef2f6;
            padding-bottom: 18px;
        }

        .timeline-item:last-child .timeline-card {
            border-bottom: none;
            padding-bottom: 0;
        }

        .timeline-date {
            color: #e26c24;
            font-size: 14px;
            font-weight: 700;
        }

        .timeline-title {
            color: #263f56;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .timeline-description {
            color: #8192a2;
            font-size: 12px;
            line-height: 1.5;
        }

        .status-badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-planned {
            background: #e7f2ff;
            color: #0874c9;
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

        .schedule-thumb {
            width: 72px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            background: #e8eef4;
        }

        /* =========================
           EMPTY STATE
        ========================= */
        .empty-panel {
            background: white;
            border: 1px solid #e6edf3;
            border-radius: 13px;
            padding: 35px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #edf4fb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #0c77cf;
        }

        .empty-title {
            font-size: 20px;
            color: #284358;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .empty-text {
            color: #8293a3;
            font-size: 13px;
        }

        @media (max-width: 1000px) {
            .project-summary {
                grid-template-columns: 120px 1fr;
            }

            .progress-box {
                grid-column: 1 / -1;
            }

            .timeline-card {
                grid-template-columns: 120px 1fr;
            }

            .timeline-card> :nth-child(3),
            .timeline-card> :nth-child(4) {
                margin-top: 10px;
            }
        }

        @media (max-width: 850px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 14px;
            }

            .topbar {
                padding: 0 17px;
            }

            .project-summary {
                grid-template-columns: 1fr;
            }

            .project-thumb {
                width: 100%;
                height: 180px;
            }

            .timeline-card {
                grid-template-columns: 1fr;
            }

            .empty-panel {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="app">

        <aside class="sidebar">
            <div class="brand">
                <div class="ruangkita-logo">
                    <div class="roof"></div>
                    <div class="house">
                        <div class="door"></div>
                    </div>
                </div>

                <span class="brand-name">RuangKita</span>
            </div>

            <a href="{{ route('client.dashboard') }}" class="menu-item">
                <span class="menu-icon">⌂</span>
                Dashboard
            </a>

            <a href="{{ route('client.projects.index') }}" class="menu-item">
                <span class="menu-icon">▣</span>
                Proyek Saya
            </a>

            <a href="{{ route('client.projects.schedule', $project) }}" class="menu-item active">
                <span class="menu-icon">▦</span>
                Jadwal
            </a>

            <a
                href="{{ route('client.projects.progress', $project) }}"
                class="menu-item">
                <span class="menu-icon">
                    ↗
                </span>

                Progress

            </a>

            <a
                href="{{ route('client.documentation', ['project' => $project->id]) }}"
                class="menu-item">
                <span class="menu-icon">▧</span>
                Dokumentasi
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">◉</span>
                Informasi Biaya
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">✉</span>
                Pesan
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">◇</span>
                Augmented Reality
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">⚙</span>
                Pengaturan
            </a>
        </aside>

        <main class="main">

            <header class="topbar">
                <div>☰</div>

                <div class="user-area">
                    <span>♧</span>
                    <div class="avatar">👤</div>
                    <span>{{ auth()->user()->name }}</span>
                    <span>▾</span>
                </div>
            </header>

            <section class="content">

                <div class="breadcrumb">
                    <a href="{{ route('client.projects.index') }}">Proyek Saya</a>
                    &nbsp;›&nbsp;
                    <a href="{{ route('client.projects.show', $project) }}">Detail Proyek</a>
                    &nbsp;›&nbsp;
                    Jadwal
                </div>

                <div class="page-header">
                    <h1>Jadwal Proyek</h1>
                    <p>Daftar jadwal dan milestone proyek renovasi Anda</p>
                </div>

                <div class="project-summary">
                    @if($project->cover_image)
                    <img
                        src="{{ asset('storage/' . $project->cover_image) }}"
                        class="project-thumb"
                        alt="{{ $project->project_name }}">
                    @else
                    <div class="project-thumb"></div>
                    @endif

                    <div>
                        <h3>{{ $project->project_name }}</h3>
                        <div class="project-meta">
                            ◉ {{ $project->location }}<br>
                            ▦
                            @if($project->start_date)
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                            @else
                            -
                            @endif
                            -
                            @if($project->target_end_date)
                            {{ \Carbon\Carbon::parse($project->target_end_date)->format('d M Y') }}
                            @else
                            -
                            @endif
                            <br>
                            ⌂ {{ $project->project_type ?? 'Renovasi Rumah' }}
                        </div>
                    </div>

                    <div class="progress-box">
                        <div class="progress-label">
                            <span>Progress Proyek</span>
                            <strong>{{ $project->progress_percentage }}%</strong>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill" data-progress="{{ $project->progress_percentage }}"></div>
                        </div>
                    </div>
                </div>

                <div class="toolbar">
                    <div class="filter-group">
                        <button class="filter-btn active">Semua</button>
                        <button class="filter-btn">Akan Datang</button>
                        <button class="filter-btn">Sedang Berjalan</button>
                        <button class="filter-btn">Selesai</button>
                        <button class="filter-btn">Terlambat</button>
                    </div>

                    <div class="sort-box">
                        Urutkan: Tanggal Terdekat
                    </div>
                </div>

                @if($project->schedules->count() > 0)
                <div class="schedule-panel">
                    <div class="timeline">

                        @forelse($project->schedules as $schedule)
                        <div class="timeline-item">

                            <div class="timeline-dot {{ $schedule->status ?? 'planned' }}">
                                ●
                            </div>

                            <div class="timeline-card">

                                <div class="timeline-date">
                                    @if($schedule->start_date)
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}
                                    @else
                                    -
                                    @endif
                                </div>

                                <div>
                                    <div class="timeline-title">
                                        {{ $schedule->title }}
                                    </div>

                                    <div class="timeline-description">
                                        {{ $schedule->description ?: 'Belum ada deskripsi jadwal.' }}
                                    </div>
                                </div>

                                <div>
                                    @php
                                    $status = $schedule->status ?? 'planned';
                                    $statusLabel = match($status) {
                                    'planned' => 'Akan Datang',
                                    'ongoing' => 'Sedang Berjalan',
                                    'completed' => 'Selesai',
                                    'delayed' => 'Terlambat',
                                    default => ucfirst($status),
                                    };
                                    @endphp

                                    <span class="status-badge status-{{ $status }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <div>
                                    @if(!empty($schedule->photo))
                                    <img
                                        src="{{ asset('storage/' . $schedule->photo) }}"
                                        alt="{{ $schedule->title }}"
                                        class="schedule-thumb">
                                    @else
                                    <div class="schedule-thumb"></div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        @empty
                        @endforelse

                    </div>
                </div>
                @else
                <div class="empty-panel">
                    <div class="empty-icon">🗓</div>

                    <div>
                        <div class="empty-title">Belum ada jadwal proyek.</div>
                        <div class="empty-text">
                            Jadwal akan muncul setelah dibuat oleh tim RuangKita.
                        </div>
                    </div>
                </div>
                @endif

            </section>
        </main>

    </div>

    <script>
        document.querySelectorAll('.progress-fill').forEach(function(bar) {
            let progress = parseInt(bar.dataset.progress || '0');
            progress = Math.max(0, Math.min(100, progress));
            bar.style.width = progress + '%';
        });
    </script>

</body>

</html>