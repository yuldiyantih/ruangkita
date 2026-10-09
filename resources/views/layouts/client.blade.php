@php
use Illuminate\Support\Facades\Auth;

$currentUser = Auth::user();

$lang = $currentUser->language ?? 'id';
$theme = $currentUser->theme ?? 'light';

$translations = [

'id' => [
'dashboard' => 'Dashboard',
'projects' => 'Proyek Saya',
'schedule' => 'Jadwal',
'progress' => 'Progress',
'documentation' => 'Dokumentasi',
'costs' => 'Informasi Biaya',
'messages' => 'Pesan',
'ar' => 'Augmented Reality',
'settings' => 'Pengaturan',
'logout' => 'Keluar',
'client' => 'Client',
'home' => 'Beranda',
],

'en' => [
'dashboard' => 'Dashboard',
'projects' => 'My Projects',
'schedule' => 'Schedule',
'progress' => 'Progress',
'documentation' => 'Documentation',
'costs' => 'Cost Information',
'messages' => 'Messages',
'ar' => 'Augmented Reality',
'settings' => 'Settings',
'logout' => 'Logout',
'client' => 'Client',
'home' => 'Home',
],

];

$tr = $translations[$lang] ?? $translations['id'];
@endphp


<!DOCTYPE html>

<html lang="{{ $lang }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'RuangKita')
    </title>


    <style>
        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {

            --sidebar-bg-1: #0d3458;
            --sidebar-bg-2: #092843;

            --primary: #0877d4;
            --primary-light: #078ee5;

            --body-bg: #f4f8fc;
            --card-bg: #ffffff;
            --topbar-bg: #ffffff;

            --text-main: #17334c;
            --text-heading: #102e49;
            --text-muted: #71869a;

            --border: #e1e9ef;
            --input-bg: #fbfdff;

            --success-bg: #e8f7ef;
            --success-text: #167047;

            --error-bg: #fff0f0;
            --error-text: #b42318;

            --shadow:
                0 2px 8px rgba(20, 55, 80, 0.04);
        }


        body {
            min-height: 100vh;
            background: var(--body-bg);
            color: var(--text-main);
            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =====================================================
           DARK MODE GLOBAL
        ===================================================== */

        body.dark-mode {

            --body-bg: #101923;
            --card-bg: #172735;
            --topbar-bg: #152331;

            --text-main: #dce7f1;
            --text-heading: #f4f8fc;
            --text-muted: #91a7ba;

            --border: #294052;
            --input-bg: #10202d;

            --shadow: none;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {
            display: flex;
            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: 230px;

            z-index: 1000;

            padding: 20px 14px;

            overflow-y: auto;

            color: white;

            background:
                linear-gradient(180deg,
                    var(--sidebar-bg-1),
                    var(--sidebar-bg-2));
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

            color: white;

            font-size: 18px;
            font-weight: 700;
        }


        /* =====================================================
           RUANGKITA LOGO
        ===================================================== */

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


        /* =====================================================
           SIDEBAR MENU
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
                rgba(255,
                    255,
                    255,
                    .08);

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

            flex-shrink: 0;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            position: relative;

            z-index: 1;

            width:
                calc(100% - 230px);

            margin-left: 230px;

            min-height: 100vh;

            background:
                var(--body-bg);

            transition:
                background .2s;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 66px;

            padding:
                0 28px;

            position: sticky;

            top: 0;

            z-index: 900;

            background:
                var(--topbar-bg);

            border-bottom:
                1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            transition:
                background .2s;
        }


        .hamburger {

            color:
                var(--text-muted);

            font-size: 20px;
        }


        /* =====================================================
           USER AREA
        ===================================================== */

        .user-area {

            display: flex;
            align-items: center;

            gap: 10px;

            color:
                var(--text-main);

            font-size: 13px;
            font-weight: 600;
        }


        .avatar {

            width: 36px;
            height: 36px;

            border-radius: 50%;

            overflow: hidden;

            background: #e3edf5;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;
        }


        .avatar img {

            width: 100%;
            height: 100%;

            object-fit: cover;

            object-position:
                center top;

            display: block;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            padding:
                27px 30px 40px;
        }


        .breadcrumb {

            color:
                var(--text-muted);

            font-size: 11px;

            margin-bottom: 15px;
        }


        .breadcrumb a {

            color:
                var(--text-muted);

            text-decoration: none;
        }


        .breadcrumb a:hover {

            color:
                var(--primary);
        }


        /* =====================================================
           PAGE TITLE
        ===================================================== */

        .page-title {

            margin-bottom: 23px;
        }


        .page-title h1 {

            color:
                var(--text-heading);

            font-size: 28px;

            margin-bottom: 5px;
        }


        .page-title p {

            color:
                var(--text-muted);

            font-size: 13px;
        }


        /* =====================================================
           CARD GLOBAL
        ===================================================== */

        .card {

            background:
                var(--card-bg);

            border:
                1px solid var(--border);

            border-radius: 13px;

            padding: 20px;

            box-shadow:
                var(--shadow);

            color:
                var(--text-main);
        }


        .card-title {

            color:
                var(--text-heading);

            font-size: 15px;
            font-weight: 700;
        }


        .card-subtitle {

            color:
                var(--text-muted);

            font-size: 11px;
        }


        /* =====================================================
           GLOBAL FORMS
        ===================================================== */

        input,
        textarea,
        select {

            color:
                var(--text-main);

            background:
                var(--input-bg);

            border:
                1px solid var(--border);
        }


        input::placeholder,
        textarea::placeholder {

            color:
                var(--text-muted);
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-primary {

            border: none;

            border-radius: 8px;

            padding:
                11px 18px;

            color: white;

            background:
                linear-gradient(90deg,
                    var(--primary),
                    var(--primary-light));

            font-size: 11px;
            font-weight: 700;

            cursor: pointer;
        }


        .btn-primary:hover {

            opacity: .92;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert-success {

            padding:
                12px 14px;

            margin-bottom: 17px;

            border-radius: 9px;

            background:
                var(--success-bg);

            color:
                var(--success-text);

            font-size: 11px;
        }


        .alert-error {

            padding:
                12px 14px;

            margin-bottom: 17px;

            border-radius: 9px;

            background:
                var(--error-bg);

            color:
                var(--error-text);

            font-size: 11px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 850px) {

            .sidebar {
                display: none;
            }

            .main {

                width: 100%;

                margin-left: 0;
            }

        }


        @media(max-width: 650px) {

            .content {

                padding:
                    20px 12px;
            }

            .topbar {

                padding:
                    0 15px;
            }

            .user-name {
                display: none;
            }

        }
    </style>


    {{-- CSS khusus halaman --}}
    @stack('styles')

</head>


<body
    class="{{ $theme === 'dark' ? 'dark-mode' : '' }}">


    <div class="app">


        {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

        <aside class="sidebar">


            {{-- BRAND --}}

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



            {{-- DASHBOARD --}}

            <a
                href="{{ route('client.dashboard') }}"
                class="
                menu-item
                {{ request()->routeIs('client.dashboard') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ⌂
                </span>

                {{ $tr['dashboard'] }}

            </a>



            {{-- PROJECT --}}

            <a
                href="{{ route('client.projects.index') }}"
                class="
                menu-item
                {{ request()->routeIs('client.projects.*') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ▣
                </span>

                {{ $tr['projects'] }}

            </a>



            {{-- SCHEDULE --}}

            <a
                href="{{ route('client.schedule') }}"
                class="
                menu-item
                {{ request()->routeIs('client.schedule') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ▦
                </span>

                {{ $tr['schedule'] }}

            </a>



            {{-- PROGRESS --}}

            <a
                href="{{ route('client.progress') }}"
                class="
                menu-item
                {{ request()->routeIs('client.progress') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ↗
                </span>

                {{ $tr['progress'] }}

            </a>



            {{-- DOCUMENTATION --}}

            <a
                href="{{ route('client.documentation') }}"
                class="
                menu-item
                {{ request()->routeIs('client.documentation') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ▧
                </span>

                {{ $tr['documentation'] }}

            </a>



            {{-- COST --}}

            <a
                href="{{ route('client.costs') }}"
                class="
                menu-item
                {{ request()->routeIs('client.costs') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ▤
                </span>

                {{ $tr['costs'] }}

            </a>



            {{-- MESSAGE --}}

            <a
                href="{{ route('client.messages') }}"
                class="
                menu-item
                {{ request()->routeIs('client.messages*') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ✉
                </span>

                {{ $tr['messages'] }}

            </a>



            {{-- AR --}}

            <a
                href="{{ route('client.ar') }}"
                class="
                menu-item
                {{ request()->routeIs('client.ar') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ◇
                </span>

                {{ $tr['ar'] }}

            </a>



            {{-- SETTINGS --}}

            <a
                href="{{ route('client.settings') }}"
                class="
                menu-item
                {{ request()->routeIs('client.settings*') ? 'active' : '' }}
            ">

                <span class="menu-icon">
                    ⚙
                </span>

                {{ $tr['settings'] }}

            </a>


        </aside>



        {{-- =====================================================
         MAIN
    ====================================================== --}}

        <main class="main">


            {{-- TOPBAR --}}

            <header class="topbar">


                <div class="hamburger">
                    ☰
                </div>


                <div class="user-area">


                    {{-- FOTO PROFILE --}}

                    <div class="avatar">

                        @if($currentUser && $currentUser->profile_photo)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $currentUser->profile_photo
                            ) }}"
                            alt="{{ $currentUser->name }}">

                        @else

                        👤

                        @endif

                    </div>



                    {{-- USER NAME --}}

                    <span class="user-name">

                        {{ $currentUser->name ?? 'Client' }}

                    </span>


                    <span>
                        ▾
                    </span>


                </div>


            </header>



            {{-- =================================================
             PAGE CONTENT
        ================================================== --}}

            <section class="content">


                {{-- SUCCESS MESSAGE --}}

                @if(session('success'))

                <div class="alert-success">

                    {{ session('success') }}

                </div>

                @endif



                {{-- ERROR MESSAGE --}}

                @if($errors->any())

                <div class="alert-error">

                    <strong>

                        @if($lang === 'en')

                        Please check the following:

                        @else

                        Periksa kembali data berikut:

                        @endif

                    </strong>


                    <ul
                        style="
                            margin:
                            8px
                            0
                            0
                            18px;
                        ">

                        @foreach($errors->all() as $error)

                        <li>

                            {{ $error }}

                        </li>

                        @endforeach

                    </ul>

                </div>

                @endif



                {{-- ISI HALAMAN --}}

                @yield('content')


            </section>


        </main>


    </div>


    {{-- JS khusus halaman --}}

    @stack('scripts')


</body>

</html>