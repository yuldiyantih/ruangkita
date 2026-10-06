<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Dokumentasi Proyek - RuangKita
    </title>


    <style>
        * {
            margin: 0;
            padding: 0;

            box-sizing:
                border-box;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        body {

            background:
                #f4f8fc;

            color:
                #17334c;

        }


        .app {

            display:
                flex;

            min-height:
                100vh;

        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width:
                230px;

            position:
                fixed;

            top: 0;
            left: 0;
            bottom: 0;

            padding:
                20px 14px;

            background:
                linear-gradient(180deg,
                    #0d3458,
                    #092843);

            color:
                white;

        }


        .brand {

            padding:
                5px 9px 24px;

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

        }


        .brand-name {

            font-size:
                18px;

            font-weight:
                700;

        }


        /* LOGO */

        .ruangkita-logo {

            position:
                relative;

            width:
                31px;

            height:
                31px;

            flex-shrink:
                0;

        }


        .ruangkita-logo .roof {

            position:
                absolute;

            width:
                20px;

            height:
                20px;

            left:
                5px;

            top:
                2px;

            border-left:
                4px solid white;

            border-top:
                4px solid white;

            transform:
                rotate(45deg);

        }


        .ruangkita-logo .house {

            position:
                absolute;

            width:
                19px;

            height:
                17px;

            left:
                6px;

            bottom:
                2px;

            border-left:
                4px solid white;

            border-right:
                4px solid white;

            border-bottom:
                4px solid white;

        }


        .ruangkita-logo .door {

            position:
                absolute;

            width:
                6px;

            height:
                9px;

            left:
                50%;

            bottom:
                -1px;

            transform:
                translateX(-50%);

            border:
                2px solid white;

            border-bottom:
                none;

        }


        .menu-item {

            min-height:
                42px;

            padding:
                0 13px;

            margin-bottom:
                3px;

            border-radius:
                8px;

            display:
                flex;

            align-items:
                center;

            gap:
                11px;

            text-decoration:
                none;

            color:
                #d6e6f5;

            font-size:
                13px;

            transition:
                .2s;

        }


        .menu-item:hover {

            background:
                rgba(255,
                    255,
                    255,
                    .08);

        }


        .menu-item.active {

            color:
                white;

            background:
                linear-gradient(90deg,
                    #0665ac,
                    #087acb);

        }


        .menu-icon {

            width:
                19px;

            text-align:
                center;

        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            width:
                calc(100% - 230px);

            margin-left:
                230px;

        }


        .topbar {

            height:
                66px;

            background:
                white;

            border-bottom:
                1px solid #e7edf3;

            padding:
                0 28px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

        }


        .hamburger {

            color:
                #526f87;

            font-size:
                20px;

        }


        .user-area {

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            font-size:
                13px;

            font-weight:
                600;

        }


        .avatar {

            width:
                33px;

            height:
                33px;

            border-radius:
                50%;

            background:
                #e4eef7;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            padding:
                28px 30px 40px;

        }


        .page-head {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                flex-start;

            gap:
                20px;

            margin-bottom:
                16px;

        }


        .page-title h1 {

            color:
                #14304a;

            font-size:
                27px;

            margin-bottom:
                5px;

        }


        .page-title p {

            color:
                #8395a7;

            font-size:
                13px;

        }


        /* =====================================================
           PROJECT SELECT
        ===================================================== */

        .project-selector {

            min-width:
                310px;

            background:
                white;

            border:
                1px solid #dfe8ef;

            border-radius:
                12px;

            padding:
                10px;

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

        }


        .selector-thumb {

            width:
                48px;

            height:
                42px;

            border-radius:
                7px;

            object-fit:
                cover;

            background:
                #e6eef5;

        }


        .selector-content {

            flex:
                1;

            min-width:
                0;

        }


        .selector-title {

            color:
                #17354e;

            font-size:
                12px;

            font-weight:
                700;

            margin-bottom:
                3px;

        }


        .selector-location {

            color:
                #8496a6;

            font-size:
                10px;

        }


        .project-select {

            width:
                30px;

            border:
                none;

            background:
                transparent;

            color:
                #526f87;

            cursor:
                pointer;

        }


        /* =====================================================
           STATISTIC
        ===================================================== */

        .summary-grid {

            display:
                grid;

            grid-template-columns:
                repeat(4,
                    1fr);

            gap:
                14px;

            margin-bottom:
                18px;

        }


        .summary-card {

            background:
                white;

            border:
                1px solid #e6edf3;

            border-radius:
                12px;

            padding:
                17px;

            display:
                flex;

            align-items:
                center;

            gap:
                14px;

        }


        .summary-icon {

            width:
                50px;

            height:
                50px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            flex-shrink:
                0;

            font-size:
                21px;

        }


        .summary-icon.blue {

            color:
                #0877d2;

            background:
                #e7f3ff;

        }


        .summary-icon.green {

            color:
                #139261;

            background:
                #e0f9ed;

        }


        .summary-icon.purple {

            color:
                #7154d7;

            background:
                #eee9ff;

        }


        .summary-icon.red {

            color:
                #ef554f;

            background:
                #ffe7e7;

        }


        .summary-label {

            color:
                #8193a3;

            font-size:
                11px;

            margin-bottom:
                3px;

        }


        .summary-number {

            color:
                #17344c;

            font-size:
                23px;

            font-weight:
                700;

        }


        .summary-type {

            margin-top:
                2px;

            color:
                #8899a8;

            font-size:
                9px;

        }


        /* =====================================================
           TOOLBAR
        ===================================================== */

        .toolbar {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

            gap:
                12px;

            margin-bottom:
                18px;

            flex-wrap:
                wrap;

        }


        .filter-group {

            display:
                flex;

            gap:
                8px;

            flex-wrap:
                wrap;

        }


        .filter-btn {

            border:
                1px solid #e0e9f0;

            background:
                white;

            color:
                #586f83;

            border-radius:
                9px;

            padding:
                9px 13px;

            cursor:
                pointer;

            font-size:
                11px;

            font-weight:
                600;

        }


        .filter-btn.active {

            border-color:
                #0878d0;

            background:
                #0878d0;

            color:
                white;

        }


        .toolbar-right {

            display:
                flex;

            gap:
                9px;

        }


        .toolbar-select {

            min-width:
                155px;

            border:
                1px solid #e0e9f0;

            background:
                white;

            color:
                #536b80;

            border-radius:
                9px;

            padding:
                9px 12px;

            outline:
                none;

            font-size:
                11px;

        }


        /* =====================================================
           CONTENT LAYOUT
        ===================================================== */

        .documentation-layout {

            display:
                grid;

            grid-template-columns:
                minmax(0,
                    1fr) 300px;

            gap:
                17px;

            align-items:
                start;

        }


        .rooms-column {

            min-width:
                0;

        }


        /* =====================================================
           ROOM
        ===================================================== */

        .room-section {

            margin-bottom:
                17px;

            background:
                white;

            border:
                1px solid #e6edf3;

            border-radius:
                13px;

            padding:
                17px;

        }


        .room-heading {

            margin-bottom:
                13px;

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

            gap:
                12px;

        }


        .room-title-wrapper {

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

        }


        .room-icon {

            width:
                36px;

            height:
                36px;

            border-radius:
                9px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #e9f4ff;

            color:
                #0875ce;

        }


        .room-name {

            color:
                #17354e;

            font-size:
                14px;

            font-weight:
                700;

        }


        .room-count {

            color:
                #8294a4;

            font-size:
                10px;

            margin-top:
                2px;

        }


        .room-see-all {

            text-decoration:
                none;

            color:
                #0873c8;

            font-size:
                10px;

            font-weight:
                600;

        }


        /* =====================================================
           GALLERY
        ===================================================== */

        .gallery-grid {

            display:
                grid;

            grid-template-columns:
                repeat(4,
                    minmax(0,
                        1fr));

            gap:
                11px;

        }


        .gallery-card {

            min-width:
                0;

        }


        .gallery-image-wrap {

            position:
                relative;

            margin-bottom:
                7px;

        }


        .gallery-image {

            width:
                100%;

            height:
                125px;

            border-radius:
                9px;

            object-fit:
                cover;

            display:
                block;

            background:
                linear-gradient(135deg,
                    #dae7f2,
                    #edf4f9);

        }


        .media-placeholder {

            width:
                100%;

            height:
                125px;

            border-radius:
                9px;

            background:
                #edf3f8;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            color:
                #6c8194;

            font-size:
                25px;

        }


        .phase-badge {

            position:
                absolute;

            left:
                7px;

            bottom:
                7px;

            padding:
                4px 7px;

            border-radius:
                5px;

            color:
                white;

            font-size:
                8px;

            font-weight:
                700;

            background:
                rgba(14,
                    39,
                    58,
                    .85);

        }


        .phase-before {

            background:
                rgba(45,
                    65,
                    80,
                    .9);

        }


        .phase-during {

            background:
                rgba(8,
                    117,
                    205,
                    .92);

        }


        .phase-after {

            background:
                rgba(20,
                    139,
                    91,
                    .92);

        }


        .gallery-title {

            color:
                #234158;

            font-size:
                11px;

            line-height:
                1.35;

            font-weight:
                700;

            margin-bottom:
                3px;

        }


        .gallery-description {

            color:
                #8495a4;

            font-size:
                9px;

            line-height:
                1.45;

        }


        /* =====================================================
           BEFORE / AFTER
        ===================================================== */

        .before-after {

            margin-top:
                16px;

            border-top:
                1px solid #edf2f6;

            padding-top:
                15px;

        }


        .before-after-title {

            font-size:
                11px;

            font-weight:
                700;

            color:
                #26445b;

            margin-bottom:
                10px;

        }


        .before-after-grid {

            display:
                grid;

            grid-template-columns:
                1fr 1fr;

            gap:
                10px;

        }


        .comparison-box {

            position:
                relative;

        }


        .comparison-box img {

            width:
                100%;

            height:
                150px;

            display:
                block;

            object-fit:
                cover;

            border-radius:
                9px;

        }


        .comparison-label {

            position:
                absolute;

            top:
                8px;

            left:
                8px;

            padding:
                5px 9px;

            border-radius:
                20px;

            background:
                rgba(13,
                    41,
                    62,
                    .85);

            color:
                white;

            font-size:
                9px;

            font-weight:
                700;

        }


        .comparison-label.after {

            background:
                rgba(19,
                    139,
                    91,
                    .9);

        }


        /* =====================================================
           LATEST DOCUMENTATION
        ===================================================== */

        .latest-panel {

            background:
                white;

            border:
                1px solid #e6edf3;

            border-radius:
                13px;

            padding:
                17px;

        }


        .latest-title {

            color:
                #17354e;

            font-size:
                15px;

            font-weight:
                700;

            margin-bottom:
                16px;

        }


        .latest-timeline {

            position:
                relative;

        }


        .latest-timeline::before {

            content:
                "";

            position:
                absolute;

            left:
                7px;

            top:
                12px;

            bottom:
                20px;

            width:
                2px;

            background:
                #dce7ef;

        }


        .latest-item {

            position:
                relative;

            padding-left:
                27px;

            padding-bottom:
                17px;

        }


        .latest-dot {

            width:
                13px;

            height:
                13px;

            position:
                absolute;

            left:
                1px;

            top:
                11px;

            border-radius:
                50%;

            background:
                #0a79d2;

            border:
                4px solid white;

            box-shadow:
                0 0 0 1px #0a79d2;

            z-index:
                2;

        }


        .latest-card {

            display:
                grid;

            grid-template-columns:
                72px minmax(0,
                    1fr);

            gap:
                10px;

        }


        .latest-thumb {

            width:
                72px;

            height:
                60px;

            border-radius:
                7px;

            object-fit:
                cover;

            background:
                #e8eff5;

        }


        .latest-item-title {

            color:
                #233e55;

            font-size:
                10px;

            font-weight:
                700;

            line-height:
                1.35;

            margin-bottom:
                5px;

        }


        .latest-room {

            display:
                inline-block;

            background:
                #e6f2ff;

            color:
                #0872c6;

            border-radius:
                10px;

            padding:
                3px 7px;

            font-size:
                8px;

            margin-bottom:
                4px;

        }


        .latest-date {

            color:
                #8395a5;

            font-size:
                8px;

        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-state {

            padding:
                35px 20px;

            border:
                1px solid #e5edf4;

            border-radius:
                12px;

            background:
                white;

            color:
                #8293a3;

            font-size:
                12px;

            text-align:
                center;

        }


        .room-empty {

            padding:
                20px;

            text-align:
                center;

            color:
                #8a9aa8;

            font-size:
                10px;

        }


        /* RESPONSIVE */

        @media(max-width: 1150px) {

            .gallery-grid {

                grid-template-columns:
                    repeat(2,
                        1fr);

            }

            .documentation-layout {

                grid-template-columns:
                    1fr;

            }

        }


        @media(max-width: 900px) {

            .summary-grid {

                grid-template-columns:
                    repeat(2,
                        1fr);

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

                min-width:
                    0;

            }

            .summary-grid {

                grid-template-columns:
                    1fr 1fr;

            }

            .gallery-grid {

                grid-template-columns:
                    1fr 1fr;

            }

            .before-after-grid {

                grid-template-columns:
                    1fr;

            }

            .toolbar-right {

                width:
                    100%;

            }

            .toolbar-select {

                flex:
                    1;

                min-width:
                    0;

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
                class="menu-item active">

                <span class="menu-icon">▧</span>

                Dokumentasi

            </a>


            <a
                href="#"
                class="menu-item">

                <span class="menu-icon">◉</span>

                Informasi Biaya

            </a>


            <a
                href="#"
                class="menu-item">

                <span class="menu-icon">✉</span>

                Pesan

            </a>


            <a
                href="#"
                class="menu-item">

                <span class="menu-icon">◇</span>

                Augmented Reality

            </a>


            <a
                href="#"
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


                <!-- ========================================
                 PAGE HEADER
            ========================================= -->

                <div class="page-head">


                    <div class="page-title">

                        <h1>
                            Dokumentasi Proyek
                        </h1>

                        <p>
                            Lihat galeri foto dan video perkembangan proyek renovasi Anda
                        </p>

                    </div>


                    @if($selectedProject)


                    <form
                        method="GET"
                        action="{{ route('client.documentation') }}"
                        class="project-selector">


                        @if($selectedProject->cover_image)

                        <img
                            src="{{ asset('storage/' . $selectedProject->cover_image) }}"
                            alt="{{ $selectedProject->project_name }}"
                            class="selector-thumb">

                        @else

                        <div class="selector-thumb"></div>

                        @endif


                        <div class="selector-content">

                            <div class="selector-title">

                                {{ $selectedProject->project_name }}

                            </div>

                            <div class="selector-location">

                                {{ $selectedProject->location }}

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
                                $selectedProject->id
                                ===
                                $project->id
                                )>

                                {{ $project->project_name }}

                            </option>

                            @endforeach


                        </select>


                    </form>


                    @endif


                </div>



                @if($selectedProject)


                <!-- ========================================
                     SUMMARY
                ========================================= -->

                <div class="summary-grid">


                    <div class="summary-card">

                        <div class="summary-icon blue">
                            ▧
                        </div>

                        <div>

                            <div class="summary-label">
                                Total Dokumentasi
                            </div>

                            <div class="summary-number">

                                {{ $documentationStats['total'] }}

                            </div>

                            <div class="summary-type">
                                Semua File
                            </div>

                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-icon green">
                            ▣
                        </div>

                        <div>

                            <div class="summary-label">
                                Foto Progress
                            </div>

                            <div class="summary-number">

                                {{ $documentationStats['photo'] }}

                            </div>

                            <div class="summary-type">
                                Foto
                            </div>

                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-icon purple">
                            ▤
                        </div>

                        <div>

                            <div class="summary-label">
                                Dokumen
                            </div>

                            <div class="summary-number">

                                {{ $documentationStats['document'] }}

                            </div>

                            <div class="summary-type">
                                File
                            </div>

                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="summary-icon red">
                            ▶
                        </div>

                        <div>

                            <div class="summary-label">
                                Video
                            </div>

                            <div class="summary-number">

                                {{ $documentationStats['video'] }}

                            </div>

                            <div class="summary-type">
                                Video
                            </div>

                        </div>

                    </div>


                </div>



                <!-- ========================================
                     FILTERS
                ========================================= -->

                <div class="toolbar">


                    <div class="filter-group">


                        <button
                            type="button"
                            class="filter-btn active"
                            data-media="all">

                            Semua
                            ({{ $documentationStats['total'] }})

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-media="photo">

                            Foto
                            ({{ $documentationStats['photo'] }})

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-media="video">

                            Video
                            ({{ $documentationStats['video'] }})

                        </button>


                        <button
                            type="button"
                            class="filter-btn"
                            data-media="document">

                            Dokumen
                            ({{ $documentationStats['document'] }})

                        </button>


                    </div>


                    <div class="toolbar-right">


                        <select
                            id="roomFilter"
                            class="toolbar-select">

                            <option value="all">
                                Semua Ruangan
                            </option>


                            @foreach($selectedProject->areas as $area)

                            <option
                                value="{{ $area->id }}">

                                {{ $area->area_name }}

                            </option>

                            @endforeach


                        </select>


                        <select
                            id="sortFilter"
                            class="toolbar-select">

                            <option value="latest">
                                Urutkan: Terbaru
                            </option>

                            <option value="oldest">
                                Urutkan: Terlama
                            </option>

                        </select>


                    </div>


                </div>



                <!-- ========================================
                     MAIN CONTENT
                ========================================= -->

                <div class="documentation-layout">


                    <!-- ROOM GALLERIES -->

                    <div class="rooms-column">


                        @forelse(
                        $selectedProject->areas
                        as $area
                        )


                        @php

                        $areaDocs =
                        $area
                        ->documentations;


                        $beforePhoto =
                        $areaDocs
                        ->where(
                        'media_type',
                        'photo'
                        )
                        ->where(
                        'category',
                        'before'
                        )
                        ->first();


                        $afterPhoto =
                        $areaDocs
                        ->where(
                        'media_type',
                        'photo'
                        )
                        ->where(
                        'category',
                        'after'
                        )
                        ->last();

                        @endphp


                        <div
                            class="room-section"
                            data-room="{{ $area->id }}">


                            <div class="room-heading">


                                <div class="room-title-wrapper">

                                    <div class="room-icon">
                                        ▧
                                    </div>

                                    <div>

                                        <div class="room-name">

                                            {{ $area->area_name }}

                                        </div>

                                        <div class="room-count">

                                            {{ $areaDocs->count() }}
                                            file dokumentasi

                                        </div>

                                    </div>

                                </div>


                                <a
                                    href="#"
                                    class="room-see-all">

                                    Lihat Semua →

                                </a>


                            </div>



                            @if($areaDocs->count() > 0)


                            <div class="gallery-grid">


                                @foreach(
                                $areaDocs->take(4)
                                as $doc
                                )


                                <div
                                    class="gallery-card documentation-item"
                                    data-media="{{ $doc->media_type }}"
                                    data-date="{{ optional($doc->photo_date)->format('Y-m-d') }}">


                                    <div class="gallery-image-wrap">


                                        @if(
                                        $doc->media_type
                                        ===
                                        'photo'
                                        )


                                        <img
                                            src="{{ asset('storage/' . $doc->file_path) }}"
                                            alt="{{ $doc->title }}"
                                            class="gallery-image">


                                        @elseif(
                                        $doc->media_type
                                        ===
                                        'video'
                                        )


                                        <div class="media-placeholder">
                                            ▶
                                        </div>


                                        @else


                                        <div class="media-placeholder">
                                            ▤
                                        </div>


                                        @endif



                                        @if($doc->category === 'before')

                                        <span class="phase-badge phase-before">
                                            BEFORE
                                        </span>


                                        @elseif($doc->category === 'during')

                                        <span class="phase-badge phase-during">
                                            PROGRESS
                                        </span>


                                        @elseif($doc->category === 'after')

                                        <span class="phase-badge phase-after">
                                            AFTER
                                        </span>

                                        @endif


                                    </div>



                                    <div class="gallery-title">

                                        {{ $doc->title }}

                                    </div>


                                    <div class="gallery-description">

                                        {{
                                                        $doc->description
                                                        ?: optional(
                                                            $doc->photo_date
                                                        )->format(
                                                            'd M Y'
                                                        )
                                                    }}

                                    </div>


                                </div>


                                @endforeach


                            </div>



                            <!-- BEFORE AFTER -->

                            @if(
                            $beforePhoto
                            &&
                            $afterPhoto
                            )


                            <div class="before-after">


                                <div class="before-after-title">

                                    Perbandingan Before & After
                                    — {{ $area->area_name }}

                                </div>


                                <div class="before-after-grid">


                                    <div class="comparison-box">

                                        <img
                                            src="{{ asset('storage/' . $beforePhoto->file_path) }}"
                                            alt="Before {{ $area->area_name }}">

                                        <span class="comparison-label">

                                            BEFORE

                                        </span>

                                    </div>


                                    <div class="comparison-box">

                                        <img
                                            src="{{ asset('storage/' . $afterPhoto->file_path) }}"
                                            alt="After {{ $area->area_name }}">

                                        <span class="comparison-label after">

                                            AFTER

                                        </span>

                                    </div>


                                </div>


                            </div>


                            @endif


                            @else


                            <div class="room-empty">

                                Belum ada dokumentasi
                                untuk {{ $area->area_name }}.

                            </div>


                            @endif


                        </div>


                        @empty


                        <div class="empty-state">

                            Belum ada area atau ruangan
                            pada proyek ini.

                        </div>


                        @endforelse


                    </div>



                    <!-- ========================================
                         DOKUMENTASI TERBARU
                    ========================================= -->

                    <aside class="latest-panel">


                        <div class="latest-title">

                            Dokumentasi Terbaru

                        </div>


                        <div class="latest-timeline">


                            @forelse(
                            $selectedProject
                            ->documentations
                            ->take(6)
                            as $latest
                            )


                            <div class="latest-item">


                                <div class="latest-dot"></div>


                                <div class="latest-card">


                                    @if(
                                    $latest->media_type
                                    ===
                                    'photo'
                                    )


                                    <img
                                        src="{{ asset('storage/' . $latest->file_path) }}"
                                        alt="{{ $latest->title }}"
                                        class="latest-thumb">


                                    @else


                                    <div class="latest-thumb"></div>


                                    @endif


                                    <div>


                                        <div class="latest-item-title">

                                            {{ $latest->title }}

                                        </div>


                                        @if($latest->projectArea)


                                        <div class="latest-room">

                                            {{
                                                        $latest
                                                            ->projectArea
                                                            ->area_name
                                                    }}

                                        </div>


                                        @endif


                                        <div class="latest-date">

                                            @if($latest->photo_date)

                                            {{
                                                        \Carbon\Carbon::parse(
                                                            $latest->photo_date
                                                        )->format(
                                                            'd M Y'
                                                        )
                                                    }}

                                            @else

                                            {{
                                                        $latest
                                                            ->created_at
                                                            ->format(
                                                                'd M Y'
                                                            )
                                                    }}

                                            @endif


                                        </div>


                                    </div>


                                </div>


                            </div>


                            @empty


                            <div class="room-empty">

                                Belum ada dokumentasi terbaru.

                            </div>


                            @endforelse


                        </div>


                    </aside>


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
        const mediaButtons =
            document.querySelectorAll(
                '.filter-btn'
            );


        const documentationItems =
            document.querySelectorAll(
                '.documentation-item'
            );


        const roomSections =
            document.querySelectorAll(
                '.room-section'
            );


        const roomFilter =
            document.getElementById(
                'roomFilter'
            );


        /*
        |--------------------------------------------------------------------------
        | MEDIA FILTER
        |--------------------------------------------------------------------------
        */

        mediaButtons.forEach(
            function(button) {

                button.addEventListener(
                    'click',
                    function() {


                        mediaButtons.forEach(
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
                            button.dataset.media;


                        documentationItems.forEach(
                            function(item) {


                                const media =
                                    item.dataset.media;


                                if (
                                    filter === 'all' ||
                                    media === filter
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



        /*
        |--------------------------------------------------------------------------
        | ROOM FILTER
        |--------------------------------------------------------------------------
        */

        if (roomFilter) {

            roomFilter.addEventListener(
                'change',
                function() {


                    const selected =
                        roomFilter.value;


                    roomSections.forEach(
                        function(section) {


                            if (
                                selected === 'all' ||
                                section.dataset.room ===
                                selected
                            ) {

                                section.style.display =
                                    'block';

                            } else {

                                section.style.display =
                                    'none';

                            }


                        }
                    );


                }
            );

        }
    </script>


</body>

</html>