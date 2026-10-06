<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Detail Proyek - RuangKita
    </title>

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
            margin-left: 230px;
            width: calc(100% - 230px);
        }

        .topbar {
            height: 66px;

            background: white;

            border-bottom:
                1px solid #e7edf3;

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
            color: #8092a3;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .breadcrumb a {
            color: #0874c9;
            text-decoration: none;
        }

        .page-title {
            font-size: 27px;
            color: #14304a;
            margin-bottom: 20px;
        }

        /* =========================
           PROJECT SUMMARY
        ========================= */

        .project-card {
            background: white;

            border: 1px solid #e6edf3;
            border-radius: 13px;

            padding: 18px;

            display: grid;

            grid-template-columns:
                300px 1fr;

            gap: 22px;

            margin-bottom: 20px;
        }

        .project-image {
            width: 100%;
            height: 205px;

            border-radius: 11px;

            object-fit: cover;

            background: #e2edf5;
        }

        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 10px;

            margin-bottom: 15px;
        }

        .project-name {
            font-size: 20px;
            font-weight: 700;
            color: #18344e;
        }

        .status {
            padding: 5px 10px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;

            background: #ddf8eb;
            color: #158158;
        }

        .detail-grid {
            display: grid;

            grid-template-columns:
                135px 1fr;

            row-gap: 8px;

            font-size: 12px;
        }

        .detail-label {
            color: #7b8d9f;
        }

        .detail-value {
            color: #2b455d;
            font-weight: 500;
        }

        .progress-area {
            margin-top: 18px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;

            margin-bottom: 7px;

            font-size: 12px;

            color: #62788c;
        }

        .progress-track {
            height: 8px;

            background: #e3eaf0;

            border-radius: 30px;

            overflow: hidden;
        }

        .progress-fill {
            height: 100%;

            background:
                linear-gradient(90deg,
                    #1484df,
                    #21a3ec);

            border-radius: 30px;
        }

        /* =========================
           TABS
        ========================= */

        .tabs {
            background: white;

            border: 1px solid #e6edf3;

            border-radius: 13px;

            overflow: hidden;
        }

        .tab-menu {
            display: flex;

            border-bottom:
                1px solid #e8eef4;

            overflow-x: auto;
        }

        .tab-link {
            min-width: 120px;

            padding: 15px 18px;

            text-align: center;

            text-decoration: none;

            color: #77899b;

            font-size: 12px;

            font-weight: 600;

            border-bottom:
                3px solid transparent;
        }

        .tab-link.active {
            color: #0874ca;

            border-bottom-color:
                #0874ca;
        }

        .tab-content {
            padding: 20px;
        }

        .tab-content h3 {
            font-size: 15px;

            margin-bottom: 10px;
        }

        .tab-content p {
            color: #718497;

            font-size: 13px;

            line-height: 1.7;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width: 900px) {

            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .project-card {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 600px) {

            .content {
                padding: 20px 14px;
            }

            .topbar {
                padding: 0 17px;
            }

            .project-image {
                height: 190px;
            }

            .detail-grid {
                grid-template-columns:
                    110px 1fr;
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
                class="menu-item active">

                <span class="menu-icon">▣</span>

                Proyek Saya
            </a>

            <a href="{{ route('client.schedule') }}"
                class="menu-item">
                <span class="menu-icon">▦</span>
                Jadwal
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">↗</span>
                Progress
            </a>

            <a href="#" class="menu-item">
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

        <!-- MAIN -->
        <main class="main">

            <header class="topbar">

                <div>
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

                    <a href="{{ route('client.projects.index') }}">
                        Proyek Saya
                    </a>

                    &nbsp;›&nbsp;

                    Detail Proyek

                </div>

                <h1 class="page-title">
                    Detail Proyek
                </h1>

                <div class="project-card">

                    <div>

                        @if($project->cover_image)

                        <img
                            src="{{ asset('storage/' . $project->cover_image) }}"
                            alt="{{ $project->project_name }}"
                            class="project-image">

                        @else

                        <div class="project-image"></div>

                        @endif

                    </div>

                    <div>

                        <div class="project-header">

                            <div class="project-name">
                                {{ $project->project_name }}
                            </div>

                            @if($project->status === 'ongoing')

                            <span class="status">
                                Berjalan
                            </span>

                            @endif

                        </div>

                        <div class="detail-grid">

                            <div class="detail-label">
                                Client
                            </div>

                            <div class="detail-value">
                                {{ optional(optional($project->client)->user)->name ?? '-' }}
                            </div>

                            <div class="detail-label">
                                Lokasi
                            </div>

                            <div class="detail-value">
                                {{ $project->location }}
                            </div>

                            <div class="detail-label">
                                Tanggal Mulai
                            </div>

                            <div class="detail-value">

                                @if($project->start_date)

                                {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}

                                @else

                                -

                                @endif

                            </div>

                            <div class="detail-label">
                                Target Selesai
                            </div>

                            <div class="detail-value">

                                @if($project->target_end_date)

                                {{ \Carbon\Carbon::parse($project->target_end_date)->format('d M Y') }}

                                @else

                                -

                                @endif

                            </div>

                            <div class="detail-label">
                                Status
                            </div>

                            <div class="detail-value">
                                {{ ucfirst($project->status) }}
                            </div>

                        </div>

                        <div class="progress-area">

                            <div class="progress-label">

                                <span>
                                    Progress
                                </span>

                                <strong>
                                    {{ $project->progress_percentage }}%
                                </strong>

                            </div>

                            <div class="progress-track">

                                <div
                                    class="progress-fill"
                                    data-progress="{{ $project->progress_percentage }}">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- TABS -->
                <div class="tabs">

                    <div class="tab-menu">

                        <a
                            href="#"
                            class="tab-link active">
                            Ringkasan
                        </a>

                        <a
                            href="{{ route('client.projects.schedule', ['project' => $project->id]) }}"
                            class="tab-link">
                            Jadwal
                        </a>

                        <a
                            href="#"
                            class="tab-link">
                            Progress
                        </a>

                        <a
                            href="#"
                            class="tab-link">
                            Dokumentasi
                        </a>

                        <a
                            href="#"
                            class="tab-link">
                            Informasi Biaya
                        </a>

                    </div>

                    <div class="tab-content">

                        <h3>
                            Deskripsi Proyek
                        </h3>

                        <p>
                            {{ $project->description ?: 'Belum ada deskripsi proyek.' }}
                        </p>

                    </div>

                </div>

            </section>

        </main>

    </div>

    <script>
        document
            .querySelectorAll('.progress-fill')
            .forEach(function(bar) {

                let value =
                    parseInt(
                        bar.dataset.progress || '0'
                    );

                value =
                    Math.max(
                        0,
                        Math.min(
                            100,
                            value
                        )
                    );

                bar.style.width =
                    value + '%';

            });
    </script>

</body>

</html>