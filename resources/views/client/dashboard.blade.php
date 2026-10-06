<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Dashboard Client - RuangKita
    </title>


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
            color: #17334c;

            background: #f4f8fc;
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

            padding:
                20px 14px;

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
            background:
                rgba(255, 255, 255, .08);
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
            width:
                calc(100% - 230px);

            margin-left: 230px;
        }


        /* =====================================================
           TOP BAR
        ===================================================== */

        .topbar {
            height: 66px;

            background: white;

            border-bottom:
                1px solid #e7edf3;

            padding:
                0 28px;

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


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding:
                28px 30px 40px;
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


        /* =====================================================
           PROJECT CARD
        ===================================================== */

        .section-title {
            margin-bottom: 13px;

            font-size: 15px;

            font-weight: 700;
        }


        .project-card {
            background: white;

            border:
                1px solid #e7edf3;

            border-radius: 13px;

            padding: 18px;

            margin-bottom: 22px;
        }


        .project-content {
            display: grid;

            grid-template-columns:
                180px 1fr auto;

            align-items: center;

            gap: 18px;
        }


        .project-image {
            width: 180px;
            height: 120px;

            border-radius: 10px;

            object-fit: cover;

            background:
                linear-gradient(135deg,
                    #dbeaf7,
                    #edf5fa);
        }


        .project-info h3 {
            font-size: 16px;

            margin-bottom: 10px;
        }


        .project-meta {
            margin-bottom: 6px;

            color: #73879a;

            font-size: 12px;
        }


        .project-status {
            display: inline-flex;

            margin-left: 5px;

            padding:
                4px 8px;

            border-radius: 15px;

            background: #ddf8eb;

            color: #158158;

            font-size: 10px;

            font-weight: 600;
        }


        /* PROGRESS */

        .project-progress {
            margin-top: 12px;

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .progress-track {
            width: 190px;
            height: 8px;

            overflow: hidden;

            background: #e1e8ee;

            border-radius: 20px;
        }


        .progress-fill {
            height: 100%;

            background:
                linear-gradient(90deg,
                    #1584df,
                    #1da3eb);

            border-radius: 20px;
        }


        .progress-number {
            color: #0778d2;

            font-size: 12px;

            font-weight: 700;
        }


        .btn-detail {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            height: 38px;

            padding:
                0 17px;

            border-radius: 8px;

            background:
                linear-gradient(90deg,
                    #075ba0,
                    #087ac9);

            text-decoration: none;

            color: white;

            font-size: 12px;

            font-weight: 600;
        }


        /* =====================================================
           QUICK FEATURE
        ===================================================== */

        .quick-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;
        }


        .quick-card {
            min-height: 105px;

            background: white;

            border:
                1px solid #e7edf3;

            border-radius: 12px;

            padding: 17px;

            display: flex;

            gap: 12px;

            text-decoration: none;

            color: #19344d;

            transition: .2s;
        }


        .quick-card:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 9px 20px rgba(23, 54, 80, .07);
        }


        .quick-icon {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 19px;
        }


        .quick-icon.blue {
            color: #0679d5;
            background: #e8f3ff;
        }


        .quick-icon.green {
            color: #169260;
            background: #e1faee;
        }


        .quick-icon.orange {
            color: #e86b10;
            background: #fff0e1;
        }


        .quick-icon.ar {
            color: #1468c0;
            background: #e5f1ff;
        }


        .quick-title {
            margin:
                4px 0 5px;

            font-size: 13px;

            font-weight: 700;
        }


        .quick-description {
            color: #8293a3;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-project {
            padding: 30px;

            border:
                1px solid #e7edf3;

            border-radius: 12px;

            background: white;

            color: #8393a2;

            text-align: center;

            font-size: 13px;

            margin-bottom: 20px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 1000px) {

            .quick-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }


            .project-content {
                grid-template-columns:
                    150px 1fr;
            }


            .project-content .btn-detail {
                grid-column:
                    2;
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
                padding:
                    20px 14px;
            }


            .project-content {
                display: block;
            }


            .project-image {
                width: 100%;

                height: 190px;

                margin-bottom: 15px;
            }


            .btn-detail {
                margin-top: 15px;
            }


            .quick-grid {
                grid-template-columns:
                    1fr 1fr;
            }


            .topbar {
                padding:
                    0 17px;
            }

        }


        @media(max-width: 420px) {

            .quick-grid {
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
                class="menu-item active">

                <span class="menu-icon">
                    ⌂
                </span>

                Dashboard

            </a>


            <a href="{{ route('client.projects.index') }}"
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

            <a href="#"
                class="menu-item">

                <span class="menu-icon">
                    ◉
                </span>

                Informasi Biaya

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">
                    ✉
                </span>

                Pesan

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">
                    ◇
                </span>

                Augmented Reality

            </a>


            <a href="#"
                class="menu-item">

                <span class="menu-icon">
                    ⚙
                </span>

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



                <div class="section-title">

                    Proyek Saya

                </div>



                <!-- =================================================
                 PROJECT
            ================================================== -->

                @forelse($projects as $project)


                <div class="project-card">


                    <div class="project-content">


                        @if($project->cover_image)


                        <img
                            class="project-image"

                            src="{{
                                    asset(
                                        'storage/'
                                        .
                                        $project->cover_image
                                    )
                                }}"

                            alt="{{
                                    $project->project_name
                                }}">


                        @else


                        <div class="project-image"></div>


                        @endif



                        <div class="project-info">


                            <h3>

                                {{ $project->project_name }}

                                @if(
                                $project->status
                                ===
                                'ongoing'
                                )

                                <span class="project-status">

                                    Berjalan

                                </span>

                                @endif

                            </h3>


                            <div class="project-meta">

                                ◉
                                {{ $project->location }}

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


                                @if(
                                $project->target_end_date
                                )

                                {{
                                        \Carbon\Carbon::parse(
                                            $project->target_end_date
                                        )->format('d M Y')
                                    }}

                                @else

                                -

                                @endif


                            </div>


                            <div class="project-progress">


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


                        </div>



                        <a
                            href="{{ route('client.projects.show', $project) }}"
                            class="btn-detail">

                            Lihat Detail

                        </a>


                    </div>


                </div>


                @empty


                <div class="empty-project">

                    Belum ada proyek
                    yang terhubung
                    dengan akun Anda.

                </div>


                @endforelse


                <!-- =================================================
     QUICK FEATURES
================================================== -->

                <div class="quick-grid">


                    <!-- JADWAL -->
                    <a
                        href="{{ route('client.schedule') }}"
                        class="quick-card">

                        <div class="quick-icon blue">
                            ▦
                        </div>

                        <div>

                            <div class="quick-title">
                                Jadwal
                            </div>

                            <div class="quick-description">
                                Lihat jadwal
                                pekerjaan proyek
                            </div>

                        </div>

                    </a>


                    <!-- PROGRESS -->
                    <a
                        href="{{ route('client.progress') }}"
                        class="quick-card">

                        <div class="quick-icon green">
                            ↗
                        </div>

                        <div>

                            <div class="quick-title">
                                Progress
                            </div>

                            <div class="quick-description">
                                Pantau perkembangan proyek
                            </div>

                        </div>

                    </a>


                    <!-- DOKUMENTASI -->
                    <a
                        href="{{ route('client.documentation') }}"
                        class="quick-card">

                        <div class="quick-icon orange">
                            ▧
                        </div>

                        <div>

                            <div class="quick-title">
                                Dokumentasi
                            </div>

                            <div class="quick-description">
                                Lihat foto perkembangan proyek
                            </div>

                        </div>

                    </a>


                    <!-- AUGMENTED REALITY -->
                    <a
                        href="#"
                        class="quick-card">

                        <div class="quick-icon ar">
                            ◇
                        </div>

                        <div>

                            <div class="quick-title">
                                Augmented Reality
                            </div>

                            <div class="quick-description">
                                Coba visualisasi
                                renovasi rumah Anda
                            </div>

                        </div>

                    </a>


                </div>




    </div>


    </section>


    </main>

    <script>
        document.querySelectorAll('.progress-fill').forEach(function(bar) {
            const value = bar.dataset.progress ?? 0;
            bar.style.width = value + '%';
        });
    </script>

</body>

</html>