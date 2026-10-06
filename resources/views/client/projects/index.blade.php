<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Proyek Saya - RuangKita
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

            padding: 20px 14px;

            background:
                linear-gradient(180deg,
                    #0d3458,
                    #092843);

            color: white;
        }


        /* =====================================================
           BRAND
        ===================================================== */

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


        /* =====================================================
           MENU
        ===================================================== */

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
           TOPBAR
        ===================================================== */

        .topbar {
            height: 66px;

            padding: 0 28px;

            display: flex;

            align-items: center;

            justify-content: space-between;

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

            background: #e4eef7;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 28px 30px 40px;
        }


        .page-header {
            margin-bottom: 24px;
        }


        .page-header h1 {
            color: #14304a;

            font-size: 27px;

            margin-bottom: 5px;
        }


        .page-header p {
            color: #8495a6;

            font-size: 13px;
        }


        /* =====================================================
           PROJECT GRID
        ===================================================== */

        .project-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 20px;
        }


        .project-card {
            background: white;

            border:
                1px solid #e5edf4;

            border-radius: 13px;

            padding: 15px;

            transition: .2s;
        }


        .project-card:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 10px 24px rgba(23, 54, 80, .08);
        }


        /* =====================================================
           PROJECT IMAGE
        ===================================================== */

        .project-image {
            width: 100%;

            height: 210px;

            object-fit: cover;

            border-radius: 10px;

            display: block;

            margin-bottom: 15px;

            background:
                linear-gradient(135deg,
                    #dcebf8,
                    #eef5fa);
        }


        /* =====================================================
           PROJECT INFO
        ===================================================== */

        .project-title-row {
            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 11px;
        }


        .project-title {
            color: #18354f;

            font-size: 15px;

            font-weight: 700;

            line-height: 1.4;
        }


        .status {
            flex-shrink: 0;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 10px;

            font-weight: 600;
        }


        .status-ongoing {
            color: #11815a;

            background: #ddf8eb;
        }


        .status-completed {
            color: #126bb6;

            background: #e4f1ff;
        }


        .status-planning {
            color: #986500;

            background: #fff3d3;
        }


        .status-paused {
            color: #b35b1e;

            background: #ffeadc;
        }


        .project-meta {
            margin-bottom: 7px;

            color: #75899c;

            font-size: 12px;
        }


        /* =====================================================
           PROGRESS
        ===================================================== */

        .progress-area {
            margin-top: 15px;

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .progress-track {
            flex: 1;

            height: 8px;

            overflow: hidden;

            border-radius: 20px;

            background: #e3eaf0;
        }


        .progress-fill {
            height: 100%;

            border-radius: 20px;

            background:
                linear-gradient(90deg,
                    #1484df,
                    #21a3ec);
        }


        .progress-value {
            min-width: 35px;

            color: #0778d2;

            font-size: 12px;

            font-weight: 700;
        }


        /* =====================================================
           DETAIL BUTTON
        ===================================================== */

        .project-footer {
            margin-top: 16px;

            display: flex;

            justify-content: flex-end;
        }


        .btn-detail {
            min-width: 110px;

            height: 38px;

            padding: 0 16px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            border-radius: 8px;

            background:
                linear-gradient(90deg,
                    #075ca3,
                    #087acb);

            color: white;

            font-size: 12px;

            font-weight: 600;
        }


        .btn-detail:hover {
            box-shadow:
                0 7px 15px rgba(8, 109, 184, .2);
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-state {
            grid-column: 1 / -1;

            padding: 55px 20px;

            border-radius: 13px;

            border:
                1px solid #e5edf4;

            background: white;

            text-align: center;
        }


        .empty-icon {
            margin-bottom: 14px;

            font-size: 38px;
        }


        .empty-title {
            margin-bottom: 6px;

            color: #264258;

            font-size: 15px;

            font-weight: 700;
        }


        .empty-text {
            color: #8394a4;

            font-size: 12px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 950px) {

            .project-grid {
                grid-template-columns: 1fr;
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

        }


        @media(max-width: 600px) {

            .content {
                padding:
                    20px 14px;
            }


            .topbar {
                padding:
                    0 17px;
            }


            .project-image {
                height: 190px;
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


            <!-- DASHBOARD -->

            <a
                href="{{ route('client.dashboard') }}"
                class="menu-item">

                <span class="menu-icon">
                    ⌂
                </span>

                Dashboard

            </a>


            <!-- PROYEK -->

            <a
                href="{{ route('client.projects.index') }}"
                class="menu-item active">

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

            <a href="{{ route('client.documentation') }}" class="menu-item">
                <span class="menu-icon">▧</span>
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

                        Proyek Saya

                    </h1>


                    <p>

                        Daftar semua proyek renovasi Anda

                    </p>


                </div>



                <!-- =================================================
                 PROJECT LIST
            ================================================== -->

                <div class="project-grid">


                    @forelse($projects as $project)


                    <div class="project-card">


                        <!-- IMAGE -->

                        @if($project->cover_image)


                        <img
                            src="{{
                                    asset(
                                        'storage/'
                                        .
                                        $project->cover_image
                                    )
                                }}"

                            alt="{{
                                    $project->project_name
                                }}"

                            class="project-image">


                        @else


                        <div class="project-image"></div>


                        @endif



                        <!-- TITLE -->

                        <div class="project-title-row">


                            <div class="project-title">

                                {{
                                    $project->project_name
                                }}

                            </div>



                            @if(
                            $project->status
                            ===
                            'ongoing'
                            )


                            <span
                                class="
                                    status
                                    status-ongoing
                                    ">

                                Berjalan

                            </span>


                            @elseif(
                            $project->status
                            ===
                            'completed'
                            )


                            <span
                                class="
                                    status
                                    status-completed
                                    ">

                                Selesai

                            </span>


                            @elseif(
                            $project->status
                            ===
                            'paused'
                            )


                            <span
                                class="
                                    status
                                    status-paused
                                    ">

                                Ditunda

                            </span>


                            @else


                            <span
                                class="
                                    status
                                    status-planning
                                    ">

                                Perencanaan

                            </span>


                            @endif


                        </div>



                        <!-- LOCATION -->

                        <div class="project-meta">

                            ◉
                            {{
                                $project->location
                            }}

                        </div>



                        <!-- DATE -->

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



                        <!-- PROGRESS -->

                        <div class="progress-area">


                            <div class="progress-track">


                                <div
                                    class="progress-fill"

                                    data-progress="{{
                                        $project->progress_percentage
                                    }}">
                                </div>


                            </div>


                            <span class="progress-value">

                                {{
                                    $project->progress_percentage
                                }}%

                            </span>


                        </div>



                        <!-- BUTTON -->

                        <div class="project-footer">


                            <a
                                href="{{
                                    route(
                                        'client.projects.show',
                                        $project
                                    )
                                }}"

                                class="btn-detail">

                                Lihat Detail

                            </a>


                        </div>


                    </div>


                    @empty


                    <div class="empty-state">


                        <div class="empty-icon">

                            🏠

                        </div>


                        <div class="empty-title">

                            Belum Ada Proyek

                        </div>


                        <div class="empty-text">

                            Belum ada proyek renovasi
                            yang terhubung dengan
                            akun Anda.

                        </div>


                    </div>


                    @endforelse


                </div>


            </section>


        </main>


    </div>


    <script>
        /*
    |--------------------------------------------------------------------------
    | PROGRESS BAR
    |--------------------------------------------------------------------------
    | Menghindari warning CSS VS Code karena Blade di inline style.
    */

        document
            .querySelectorAll('.progress-fill')
            .forEach(function(bar) {

                let progress =
                    parseInt(
                        bar.dataset.progress || '0'
                    );

                /*
                 * Batasi nilai antara
                 * 0 sampai 100.
                 */

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

            });
    </script>


</body>

</html>