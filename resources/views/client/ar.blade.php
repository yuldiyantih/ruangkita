<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Augmented Reality - RuangKita
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

            top:
                0;

            left:
                0;

            bottom:
                0;

            z-index:
                1000;

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


        .ruangkita-logo {

            width:
                31px;

            height:
                31px;

            position:
                relative;
        }


        .ruangkita-logo .roof {

            width:
                20px;

            height:
                20px;

            position:
                absolute;

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

            width:
                19px;

            height:
                17px;

            position:
                absolute;

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

            width:
                6px;

            height:
                9px;

            position:
                absolute;

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

            position:
                relative;

            z-index:
                1;

            width:
                calc(100% - 230px);

            margin-left:
                230px;
        }


        .topbar {

            height:
                66px;

            padding:
                0 28px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            background:
                white;

            border-bottom:
                1px solid #e5edf3;
        }


        .hamburger {

            color:
                #43627d;

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
                34px;

            height:
                34px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            background:
                #e3edf5;
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
                15px;

            color:
                #72879b;

            font-size:
                11px;
        }


        .breadcrumb a {

            text-decoration:
                none;

            color:
                #56728b;
        }


        .page-title {

            margin-bottom:
                22px;
        }


        .page-title h1 {

            color:
                #102e49;

            font-size:
                28px;

            margin-bottom:
                6px;
        }


        .page-title p {

            color:
                #73889c;

            font-size:
                13px;

            line-height:
                1.5;
        }


        /* =====================================================
           TOP GRID
        ===================================================== */

        .top-grid {

            display:
                grid;

            grid-template-columns:
                minmax(0,
                    1.8fr) minmax(300px,
                    .8fr);

            gap:
                17px;

            margin-bottom:
                17px;
        }


        /* =====================================================
           AR HERO
        ===================================================== */

        .ar-preview {

            min-height:
                340px;

            position:
                relative;

            overflow:
                hidden;

            border-radius:
                14px;

            background:
                linear-gradient(135deg,
                    #294962,
                    #8fa2ae);
        }


        .ar-preview::after {

            content:
                "";

            position:
                absolute;

            inset:
                0;

            background:
                linear-gradient(90deg,
                    rgba(8,
                        32,
                        50,
                        .68),
                    rgba(8,
                        32,
                        50,
                        .08));
        }


        .ar-preview-image {

            position:
                absolute;

            inset:
                0;

            width:
                100%;

            height:
                100%;

            object-fit:
                cover;
        }


        .project-box {

            position:
                absolute;

            z-index:
                4;

            top:
                22px;

            left:
                22px;

            width:
                280px;

            padding:
                16px;

            background:
                rgba(255,
                    255,
                    255,
                    .96);

            border-radius:
                12px;
        }


        .box-label {

            margin-bottom:
                7px;

            color:
                #72879a;

            font-size:
                10px;
        }


        .select-box {

            width:
                100%;

            height:
                43px;

            padding:
                0 11px;

            border:
                1px solid #dce6ee;

            border-radius:
                9px;

            outline:
                none;

            background:
                #f8fbfd;

            color:
                #29485f;

            font-size:
                11px;
        }


        .project-box-space {

            height:
                12px;
        }


        .hero-text {

            position:
                absolute;

            z-index:
                4;

            left:
                22px;

            bottom:
                22px;

            max-width:
                460px;

            color:
                white;
        }


        .hero-text h2 {

            font-size:
                24px;

            margin-bottom:
                8px;
        }


        .hero-text p {

            font-size:
                12px;

            line-height:
                1.6;

            color:
                #e2edf5;
        }


        /* =====================================================
           MOBILE AR CARD
        ===================================================== */

        .side-card {

            padding:
                18px;

            border:
                1px solid #e3ebf1;

            border-radius:
                13px;

            background:
                white;
        }


        .side-card+.side-card {

            margin-top:
                15px;
        }


        .side-title {

            color:
                #17344d;

            font-size:
                14px;

            font-weight:
                700;

            margin-bottom:
                7px;
        }


        .side-text {

            color:
                #758a9d;

            font-size:
                10px;

            line-height:
                1.6;
        }


        .mobile-button {

            margin-top:
                14px;

            width:
                100%;

            min-height:
                42px;

            border:
                none;

            border-radius:
                9px;

            color:
                white;

            background:
                linear-gradient(90deg,
                    #0877d4,
                    #078ee5);

            font-size:
                11px;

            font-weight:
                700;

            cursor:
                pointer;
        }


        .qr-placeholder {

            width:
                120px;

            height:
                120px;

            margin:
                15px auto 0;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border:
                1px dashed #adc0cf;

            border-radius:
                10px;

            color:
                #8396a7;

            font-size:
                10px;

            text-align:
                center;

            background:
                #f9fbfd;
        }


        /* =====================================================
           STEPS
        ===================================================== */

        .steps {

            margin-top:
                14px;
        }


        .step {

            display:
                grid;

            grid-template-columns:
                30px 1fr;

            gap:
                10px;

            margin-bottom:
                13px;
        }


        .step-number {

            width:
                27px;

            height:
                27px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            color:
                #0874ca;

            background:
                #e7f2ff;

            font-size:
                10px;

            font-weight:
                700;
        }


        .step-title {

            color:
                #27465d;

            font-size:
                10px;

            font-weight:
                700;

            margin-bottom:
                3px;
        }


        .step-text {

            color:
                #7b8fa1;

            font-size:
                9px;

            line-height:
                1.4;
        }


        /* =====================================================
           PANEL
        ===================================================== */

        .panel {

            padding:
                18px;

            margin-bottom:
                17px;

            border:
                1px solid #e3ebf1;

            border-radius:
                13px;

            background:
                white;
        }


        .panel-title {

            color:
                #17344d;

            font-size:
                14px;

            font-weight:
                700;

            margin-bottom:
                4px;
        }


        .panel-subtitle {

            color:
                #8395a5;

            font-size:
                10px;

            margin-bottom:
                15px;
        }


        /* =====================================================
           AREAS
        ===================================================== */

        .area-grid {

            display:
                grid;

            grid-template-columns:
                repeat(4,
                    minmax(0,
                        1fr));

            gap:
                13px;
        }


        .area-card {

            overflow:
                hidden;

            border:
                1px solid #dfe8ef;

            border-radius:
                10px;

            text-decoration:
                none;

            color:
                inherit;

            background:
                white;

            transition:
                .2s;
        }


        .area-card:hover {

            transform:
                translateY(-2px);
        }


        .area-card.active {

            border:
                2px solid #087be0;

            background:
                #f6fbff;
        }


        .area-image {

            width:
                100%;

            height:
                95px;

            object-fit:
                cover;

            background:
                linear-gradient(135deg,
                    #dcebf8,
                    #eef5fa);
        }


        .area-body {

            padding:
                10px;
        }


        .area-name {

            color:
                #244258;

            font-size:
                11px;

            font-weight:
                700;

            margin-bottom:
                4px;
        }


        .area-description {

            color:
                #8394a3;

            font-size:
                9px;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }


        /* =====================================================
           ASSETS
        ===================================================== */

        .asset-grid {

            display:
                grid;

            grid-template-columns:
                repeat(6,
                    minmax(0,
                        1fr));

            gap:
                12px;
        }


        .asset-card {

            padding:
                13px 9px;

            border:
                1px solid #dfe8ef;

            border-radius:
                10px;

            background:
                white;

            text-align:
                center;

            cursor:
                pointer;

            transition:
                .2s;
        }


        .asset-card:hover {

            transform:
                translateY(-2px);
        }


        .asset-card.active {

            border:
                2px solid #087be0;

            background:
                #f5fbff;
        }


        .asset-icon {

            width:
                47px;

            height:
                47px;

            margin:
                0 auto 8px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                10px;

            background:
                #eaf3fb;

            font-size:
                23px;
        }


        .asset-name {

            color:
                #244258;

            font-size:
                10px;

            font-weight:
                700;

            line-height:
                1.35;
        }


        .asset-type {

            color:
                #8697a6;

            font-size:
                8px;

            margin-top:
                4px;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {

            padding:
                30px 15px;

            border-radius:
                10px;

            background:
                #f8fafc;

            text-align:
                center;

            color:
                #8294a4;

            font-size:
                11px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 1150px) {

            .asset-grid {

                grid-template-columns:
                    repeat(3,
                        1fr);
            }


            .area-grid {

                grid-template-columns:
                    1fr 1fr;
            }
        }


        @media(max-width: 900px) {

            .top-grid {

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


        @media(max-width: 600px) {

            .content {

                padding:
                    20px 14px;
            }


            .project-box {

                position:
                    relative;

                top:
                    auto;

                left:
                    auto;

                width:
                    auto;

                margin:
                    15px;
            }


            .hero-text {

                left:
                    17px;

                right:
                    17px;
            }


            .area-grid,
            .asset-grid {

                grid-template-columns:
                    1fr 1fr;
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
                class="menu-item">

                <span class="menu-icon">▤</span>

                Informasi Biaya

            </a>


            <a
                href="{{ route('client.messages') }}"
                class="menu-item">

                <span class="menu-icon">✉</span>

                Pesan

            </a>


            <a
                href="{{ route('client.ar') }}"
                class="menu-item active">

                <span class="menu-icon">◇</span>

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

                    Augmented Reality

                </div>



                <div class="page-title">


                    <h1>

                        Augmented Reality

                    </h1>


                    <p>

                        Lihat preview renovasi atau desain interior
                        proyek Anda sebelum divisualisasikan
                        menggunakan Augmented Reality.

                    </p>


                </div>



                <!-- =====================================================
                 TOP
            ====================================================== -->


                <div class="top-grid">


                    <!-- AR PREVIEW -->


                    <div class="ar-preview">


                        @if(
                        $selectedArea
                        &&
                        $selectedArea->photo
                        )

                        <img
                            src="{{
                                asset(
                                    'storage/'
                                    .
                                    $selectedArea->photo
                                )
                            }}"
                            class="ar-preview-image"
                            alt="{{ $selectedArea->area_name }}">

                        @endif



                        @if($selectedProject)


                        <div class="project-box">


                            <div class="box-label">

                                Proyek Aktif

                            </div>


                            <form
                                method="GET"
                                action="{{ route('client.ar') }}">


                                <select
                                    name="project"
                                    class="select-box"
                                    onchange="this.form.submit()">


                                    @foreach(
                                    $projects
                                    as $project
                                    )


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


                            <div class="project-box-space"></div>


                            <div class="box-label">

                                Pilih Area Ruangan

                            </div>


                            <form
                                method="GET"
                                action="{{ route('client.ar') }}">


                                <input
                                    type="hidden"
                                    name="project"
                                    value="{{ $selectedProject->id }}">


                                <select
                                    name="area"
                                    class="select-box"
                                    onchange="this.form.submit()">


                                    @foreach(
                                    $areas
                                    as $area
                                    )

                                    <option
                                        value="{{ $area->id }}"
                                        @selected(
                                        $selectedArea
                                        &&
                                        $area->id
                                        ===
                                        $selectedArea->id
                                        )>

                                        {{ $area->area_name }}

                                    </option>

                                    @endforeach


                                </select>


                            </form>


                        </div>


                        @endif



                        <div class="hero-text">


                            <h2>

                                Rasakan Desain Anda
                                Secara Langsung di Ruangan

                            </h2>


                            <p>

                                Pilih area dan elemen desain.
                                Nantinya model 3D akan ditampilkan
                                menggunakan kamera perangkat mobile.

                            </p>


                        </div>


                    </div>



                    <!-- RIGHT SIDE -->


                    <div>


                        <div class="side-card">


                            <div class="side-title">

                                📱 Lihat AR di Mobile

                            </div>


                            <div class="side-text">

                                Gunakan aplikasi RuangKita Mobile
                                untuk membuka desain ini dalam
                                mode Augmented Reality.

                            </div>


                            <button
                                type="button"
                                class="mobile-button">

                                Scan QR / Buka di Mobile

                            </button>


                            <div class="qr-placeholder">

                                QR Code
                                <br>
                                tersedia pada
                                Tahap Mobile

                            </div>


                        </div>



                        <div class="side-card">


                            <div class="side-title">

                                Alur Penggunaan AR

                            </div>


                            <div class="steps">


                                <div class="step">

                                    <div class="step-number">
                                        1
                                    </div>

                                    <div>

                                        <div class="step-title">
                                            Pilih Proyek
                                        </div>

                                        <div class="step-text">
                                            Tentukan proyek renovasi.
                                        </div>

                                    </div>

                                </div>


                                <div class="step">

                                    <div class="step-number">
                                        2
                                    </div>

                                    <div>

                                        <div class="step-title">
                                            Pilih Ruangan
                                        </div>

                                        <div class="step-text">
                                            Pilih area yang ingin divisualisasikan.
                                        </div>

                                    </div>

                                </div>


                                <div class="step">

                                    <div class="step-number">
                                        3
                                    </div>

                                    <div>

                                        <div class="step-title">
                                            Pilih Elemen
                                        </div>

                                        <div class="step-text">
                                            Pilih furniture, warna atau material.
                                        </div>

                                    </div>

                                </div>


                                <div class="step">

                                    <div class="step-number">
                                        4
                                    </div>

                                    <div>

                                        <div class="step-title">
                                            Buka AR
                                        </div>

                                        <div class="step-text">
                                            Visualisasikan melalui kamera mobile.
                                        </div>

                                    </div>

                                </div>


                            </div>


                        </div>


                    </div>


                </div>



                <!-- =====================================================
                 AREA
            ====================================================== -->


                <div class="panel">


                    <div class="panel-title">

                        Pilih Area Ruangan

                    </div>


                    <div class="panel-subtitle">

                        Pilih ruangan proyek yang ingin
                        ditampilkan dalam AR.

                    </div>



                    @if($areas->count() > 0)


                    <div class="area-grid">


                        @foreach($areas as $area)


                        <a
                            href="{{
                                    route(
                                        'client.ar',
                                        [
                                            'project'
                                            =>
                                            $selectedProject->id,

                                            'area'
                                            =>
                                            $area->id
                                        ]
                                    )
                                }}"
                            class="
                                    area-card
                                    {{
                                        $selectedArea
                                        &&
                                        $selectedArea->id
                                        ===
                                        $area->id
                                        ?
                                        'active'
                                        :
                                        ''
                                    }}
                                ">


                            @if($area->photo)


                            <img
                                src="{{
                                            asset(
                                                'storage/'
                                                .
                                                $area->photo
                                            )
                                        }}"
                                class="area-image"
                                alt="{{ $area->area_name }}">


                            @else


                            <div class="area-image"></div>


                            @endif



                            <div class="area-body">


                                <div class="area-name">

                                    {{ $area->area_name }}

                                </div>


                                <div class="area-description">

                                    {{
                                            $area->description
                                            ??
                                            'Area proyek'
                                        }}

                                </div>


                            </div>


                        </a>


                        @endforeach


                    </div>


                    @else


                    <div class="empty">

                        Belum ada area / ruangan
                        pada proyek ini.

                    </div>


                    @endif


                </div>



                <!-- =====================================================
                 AR ASSET
            ====================================================== -->


                <div class="panel">


                    <div class="panel-title">

                        Elemen Desain

                    </div>


                    <div class="panel-subtitle">

                        Pilih furniture, material atau warna
                        yang nantinya dapat digunakan pada AR.

                    </div>



                    @if($arAssets->count() > 0)


                    <div class="asset-grid">


                        @foreach(
                        $arAssets
                        as $asset
                        )


                        <div
                            class="asset-card"
                            data-asset-id="{{ $asset->id }}">


                            <div class="asset-icon">

                                @if($asset->asset_type === 'color')

                                🎨

                                @elseif(
                                ($asset->asset_type ?? '')
                                ===
                                'material'
                                )

                                ▦

                                @else

                                ◇

                                @endif

                            </div>


                            <div class="asset-name">

                                {{
                                        $asset->name
                                        ??
                                        $asset->asset_name
                                        ??
                                        'AR Asset'
                                    }}

                            </div>


                            <div class="asset-type">

                                {{ ucfirst($asset->asset_type) }}

                            </div>


                        </div>


                        @endforeach


                    </div>


                    @else


                    <div class="empty">

                        Belum ada AR Asset.
                        Asset akan ditambahkan oleh Admin.

                    </div>


                    @endif


                </div>


            </section>


        </main>


    </div>



    <script>
        /*
    |--------------------------------------------------------------------------
    | PILIH ASSET
    |--------------------------------------------------------------------------
    |
    | Untuk Tahap 2 hanya memberikan visual pilihan.
    | Penyimpanan ke ar_design_items dilakukan
    | pada tahap berikutnya.
    |
    */

        document
            .querySelectorAll(
                '.asset-card'
            )
            .forEach(
                function(card) {

                    card.addEventListener(
                        'click',
                        function() {


                            document
                                .querySelectorAll(
                                    '.asset-card'
                                )
                                .forEach(
                                    function(item) {

                                        item.classList
                                            .remove(
                                                'active'
                                            );

                                    }
                                );


                            this.classList
                                .add(
                                    'active'
                                );

                        }
                    );

                }
            );
    </script>


</body>

</html>