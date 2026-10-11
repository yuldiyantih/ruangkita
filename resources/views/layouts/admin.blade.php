@php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| CURRENT ADMIN
|--------------------------------------------------------------------------
*/

$adminUser = Auth::user();


/*
|--------------------------------------------------------------------------
| LANGUAGE
|--------------------------------------------------------------------------
*/

$adminLang =
$adminUser->language
??
'id';


/*
|--------------------------------------------------------------------------
| THEME
|--------------------------------------------------------------------------
*/

$adminTheme =
$adminUser->theme
??
'light';


/*
|--------------------------------------------------------------------------
| GLOBAL TRANSLATION
|--------------------------------------------------------------------------
*/

$adminTranslations = [

'id' => [

'dashboard' =>
'Dashboard',

'client' =>
'Client',

'projects' =>
'Proyek',

'works' =>
'Pekerjaan',

'schedule' =>
'Jadwal',

'materials' =>
'Material',

'expenses' =>
'Pengeluaran',

'personal_funds' =>
'Uang Pribadi',

'progress' =>
'Progress',

'documentation' =>
'Dokumentasi',

'reports' =>
'Laporan',

'settings' =>
'Pengaturan',

'logout' =>
'Keluar',

'profile' =>
'Profil',

'admin' =>
'Admin',

],


'en' => [

'dashboard' =>
'Dashboard',

'client' =>
'Clients',

'projects' =>
'Projects',

'works' =>
'Works',

'schedule' =>
'Schedule',

'materials' =>
'Materials',

'expenses' =>
'Expenses',

'personal_funds' =>
'Personal Funds',

'progress' =>
'Progress',

'documentation' =>
'Documentation',

'reports' =>
'Reports',

'settings' =>
'Settings',

'logout' =>
'Logout',

'profile' =>
'Profile',

'admin' =>
'Admin',

],

];


$at =
$adminTranslations[$adminLang]
??
$adminTranslations['id'];

@endphp


<!DOCTYPE html>

<html lang="{{ $adminLang }}">


<head>

    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">


    <title>
        @yield('title', 'RuangKita Admin')
    </title>



    <style>
        /* =====================================================
           RESET
        ===================================================== */

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



        /* =====================================================
           ROOT COLORS - LIGHT MODE
        ===================================================== */

        :root {

            --sidebar-width:
                230px;

            --sidebar-collapsed:
                78px;


            --sidebar-bg-1:
                #0d3458;

            --sidebar-bg-2:
                #092843;


            --primary:
                #0877d4;

            --primary-light:
                #078ee5;

            --primary-soft:
                #e7f3ff;


            --body-bg:
                #f4f8fc;

            --card-bg:
                #ffffff;

            --topbar-bg:
                #ffffff;

            --input-bg:
                #fbfdff;


            --text-main:
                #17334c;

            --text-heading:
                #102e49;

            --text-muted:
                #71869a;


            --border:
                #e1e9ef;


            --success:
                #14835c;

            --success-bg:
                #ddf8eb;


            --danger:
                #dc4c4c;

            --danger-bg:
                #ffe7e7;


            --warning:
                #d97706;

            --warning-bg:
                #fff0cf;


            --shadow:
                0 4px 16px rgba(30,
                    72,
                    105,
                    .05);


            --shadow-md:
                0 10px 28px rgba(20,
                    55,
                    85,
                    .10);

        }



        /* =====================================================
           DARK MODE
        ===================================================== */

        body.dark-mode {

            --body-bg:
                #101923;

            --card-bg:
                #172735;

            --topbar-bg:
                #152331;

            --input-bg:
                #1b2d3c;


            --text-main:
                #dce8f2;

            --text-heading:
                #f2f7fb;

            --text-muted:
                #94a9bb;


            --border:
                #294052;


            --primary-soft:
                #173a56;


            --success-bg:
                #183c31;

            --danger-bg:
                #47282d;

            --warning-bg:
                #49391e;


            --shadow:
                0 4px 18px rgba(0,
                    0,
                    0,
                    .16);


            --shadow-md:
                0 12px 30px rgba(0,
                    0,
                    0,
                    .26);

        }



        /* =====================================================
           BODY
        ===================================================== */

        html {

            scroll-behavior:
                smooth;
        }


        body {

            min-height:
                100vh;

            background:
                var(--body-bg);

            color:
                var(--text-main);

            font-size:
                15px;

            line-height:
                1.5;

            transition:
                background .25s ease,
                color .25s ease;
        }



        /* =====================================================
           APP
        ===================================================== */

        .admin-app {

            min-height:
                100vh;
        }



        /* =====================================================
           SIDEBAR
        ===================================================== */

        .admin-sidebar {

            width:
                var(--sidebar-width);

            position:
                fixed;

            top: 0;

            left: 0;

            bottom: 0;

            z-index:
                1000;


            padding:
                20px 14px;


            overflow-x:
                hidden;

            overflow-y:
                auto;


            background:
                linear-gradient(180deg,
                    var(--sidebar-bg-1),
                    var(--sidebar-bg-2));


            color:
                white;


            transition:
                width .25s ease,
                padding .25s ease;
        }



        /* =====================================================
           BRAND
        ===================================================== */

        .admin-brand {

            min-height:
                48px;

            padding:
                4px 8px 23px;


            display:
                flex;

            align-items:
                center;

            gap:
                11px;
        }


        .admin-brand-name {

            white-space:
                nowrap;

            font-size:
                19px;

            font-weight:
                700;
        }



        /* =====================================================
           RUANGKITA LOGO
        ===================================================== */

        .ruangkita-logo {

            position:
                relative;

            width:
                35px;

            height:
                35px;

            flex-shrink:
                0;
        }


        .ruangkita-logo .roof {

            position:
                absolute;

            width:
                23px;

            height:
                23px;

            left:
                6px;

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
                22px;

            height:
                19px;

            left:
                7px;

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
                7px;

            height:
                10px;

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



        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .admin-menu-item {

            min-height:
                44px;

            padding:
                0 13px;

            margin-bottom:
                4px;


            border-radius:
                8px;


            display:
                flex;

            align-items:
                center;

            gap:
                11px;


            color:
                #d6e6f5;


            text-decoration:
                none;


            font-size:
                14px;


            transition:
                background .2s ease,
                color .2s ease;
        }


        .admin-menu-item:hover {

            background:
                rgba(255,
                    255,
                    255,
                    .08);

            color:
                white;
        }


        .admin-menu-item.active {

            color:
                white;

            background:
                linear-gradient(90deg,
                    #0665ac,
                    #087acb);

            box-shadow:
                0 4px 10px rgba(0,
                    0,
                    0,
                    .10);
        }


        .admin-menu-icon {

            width:
                21px;

            flex-shrink:
                0;

            text-align:
                center;

            font-size:
                16px;
        }


        .admin-menu-text {

            white-space:
                nowrap;
        }



        /* =====================================================
           MAIN AREA
        ===================================================== */

        .admin-main {

            width:
                calc(100% - var(--sidebar-width));


            min-height:
                100vh;


            margin-left:
                var(--sidebar-width);


            transition:
                margin-left .25s ease,
                width .25s ease;
        }



        /* =====================================================
           TOPBAR
        ===================================================== */

        .admin-topbar {

            height:
                66px;


            padding:
                0 28px;


            position:
                sticky;

            top: 0;

            z-index:
                900;


            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;


            background:
                var(--topbar-bg);


            border-bottom:
                1px solid var(--border);


            transition:
                background .25s ease,
                border-color .25s ease;
        }



        /* =====================================================
           HAMBURGER
        ===================================================== */

        .admin-hamburger {

            width:
                40px;

            height:
                40px;


            border:
                none;

            border-radius:
                9px;


            display:
                flex;

            align-items:
                center;

            justify-content:
                center;


            background:
                transparent;


            color:
                var(--text-muted);


            cursor:
                pointer;


            font-size:
                22px;


            transition:
                .2s ease;
        }


        .admin-hamburger:hover {

            background:
                var(--input-bg);

            color:
                var(--primary);
        }



        /* =====================================================
           PROFILE
        ===================================================== */

        .admin-profile {

            position:
                relative;
        }


        .admin-profile-button {

            padding:
                5px 8px;


            border:
                none;

            border-radius:
                9px;


            display:
                flex;

            align-items:
                center;

            gap:
                9px;


            background:
                transparent;


            color:
                var(--text-main);


            cursor:
                pointer;


            font-size:
                14px;

            font-weight:
                700;


            transition:
                .2s ease;
        }


        .admin-profile-button:hover {

            background:
                var(--input-bg);
        }



        /* =====================================================
           AVATAR
        ===================================================== */

        .admin-avatar {

            width:
                36px;

            height:
                36px;


            overflow:
                hidden;


            border-radius:
                50%;


            display:
                flex;

            align-items:
                center;

            justify-content:
                center;


            background:
                var(--primary-soft);


            color:
                var(--primary);


            font-size:
                14px;

            font-weight:
                700;
        }


        .admin-avatar img {

            width:
                100%;

            height:
                100%;


            display:
                block;


            object-fit:
                cover;

            object-position:
                center top;
        }



        /* =====================================================
           PROFILE ARROW
        ===================================================== */

        .admin-profile-arrow {

            font-size:
                10px;

            transition:
                transform .2s ease;
        }


        .admin-profile-arrow.open {

            transform:
                rotate(180deg);
        }



        /* =====================================================
           PROFILE DROPDOWN
        ===================================================== */

        .admin-profile-menu {

            width:
                230px;


            position:
                absolute;


            top:
                calc(100% + 10px);

            right: 0;


            z-index:
                2000;


            display:
                none;


            overflow:
                hidden;


            border:
                1px solid var(--border);


            border-radius:
                12px;


            background:
                var(--card-bg);


            box-shadow:
                var(--shadow-md);
        }


        .admin-profile-menu.show {

            display:
                block;
        }


        .admin-profile-header {

            padding:
                15px 16px;


            border-bottom:
                1px solid var(--border);
        }


        .admin-profile-header strong {

            display:
                block;


            color:
                var(--text-heading);


            font-size:
                14px;
        }


        .admin-profile-header span {

            display:
                block;


            margin-top:
                4px;


            overflow:
                hidden;


            color:
                var(--text-muted);


            font-size:
                12px;


            white-space:
                nowrap;

            text-overflow:
                ellipsis;
        }


        .admin-profile-item {

            width:
                100%;


            min-height:
                44px;


            padding:
                0 15px;


            border:
                none;


            display:
                flex;

            align-items:
                center;

            gap:
                10px;


            background:
                transparent;


            color:
                var(--text-main);


            text-decoration:
                none;

            text-align:
                left;


            cursor:
                pointer;


            font-size:
                13px;
        }


        .admin-profile-item:hover {

            background:
                var(--input-bg);

            color:
                var(--primary);
        }


        .admin-profile-item.logout {

            color:
                var(--danger);
        }


        .admin-profile-divider {

            height:
                1px;

            background:
                var(--border);
        }



        /* =====================================================
           CONTENT
        ===================================================== */

        .admin-content {

            padding:
                28px 30px 40px;
        }



        /* =====================================================
           GLOBAL PAGE HEADER
        ===================================================== */

        .admin-page-header {

            margin-bottom:
                24px;
        }


        .admin-page-title {

            margin:
                0 0 6px 0;


            color:
                var(--text-heading);


            font-size:
                28px;

            font-weight:
                700;

            line-height:
                1.25;
        }


        .admin-page-subtitle {

            margin: 0;


            color:
                var(--text-muted);


            font-size:
                14px;

            line-height:
                1.6;
        }



        /* =====================================================
           GLOBAL BREADCRUMB
        ===================================================== */

        .admin-breadcrumb {

            width:
                fit-content;


            margin-bottom:
                14px;


            padding:
                8px 12px;


            display:
                flex;

            align-items:
                center;

            gap:
                8px;

            flex-wrap:
                wrap;


            border:
                1px solid var(--border);


            border-radius:
                10px;


            background:
                var(--card-bg);


            box-shadow:
                0 2px 6px rgba(0,
                    0,
                    0,
                    .03);


            color:
                var(--text-muted);


            font-size:
                13px;
        }


        .admin-breadcrumb a {

            color:
                var(--primary);

            text-decoration:
                none;

            font-weight:
                600;
        }


        .admin-breadcrumb a:hover {

            text-decoration:
                underline;
        }


        .admin-breadcrumb-separator {

            color:
                var(--text-muted);

            opacity:
                .65;
        }


        .admin-breadcrumb-current {

            color:
                var(--text-muted);

            font-weight:
                500;
        }



        /* =====================================================
           GLOBAL CARD
        ===================================================== */

        .admin-card {

            border:
                1px solid var(--border);


            border-radius:
                14px;


            background:
                var(--card-bg);


            box-shadow:
                var(--shadow);


            transition:
                background .25s ease,
                border-color .25s ease;
        }


        .admin-card-title {

            color:
                var(--text-heading);


            font-size:
                18px;

            font-weight:
                700;
        }



        /* =====================================================
           GLOBAL FORM CARD
        ===================================================== */

        .admin-form-card {

            padding:
                24px;


            border:
                1px solid var(--border);


            border-radius:
                14px;


            background:
                var(--card-bg);


            box-shadow:
                var(--shadow);
        }


        .admin-form-title {

            margin-bottom:
                18px;


            color:
                var(--text-heading);


            font-size:
                18px;

            font-weight:
                700;
        }



        /* =====================================================
           FORM GROUP
        ===================================================== */

        .admin-form-group {

            display:
                flex;

            flex-direction:
                column;

            gap:
                7px;
        }


        .admin-form-grid {

            display:
                grid;


            grid-template-columns:
                repeat(2,
                    minmax(0,
                        1fr));


            gap:
                18px;
        }


        .admin-form-group.full {

            grid-column:
                1 / -1;
        }



        /* =====================================================
           FORM LABEL
        ===================================================== */

        .admin-form-label {

            color:
                var(--text-heading);


            font-size:
                14px;

            font-weight:
                600;
        }


        .admin-required {

            color:
                var(--danger);
        }



        /* =====================================================
           FORM CONTROL
        ===================================================== */

        .admin-form-control {

            width:
                100%;


            min-height:
                46px;


            padding:
                11px 13px;


            border:
                1px solid var(--border);


            border-radius:
                10px;


            outline:
                none;


            background:
                var(--input-bg);


            color:
                var(--text-main);


            font-size:
                14px;


            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .25s ease;
        }


        .admin-form-control::placeholder {

            color:
                var(--text-muted);

            opacity:
                .72;
        }


        .admin-form-control:focus {

            border-color:
                var(--primary);


            box-shadow:
                0 0 0 3px rgba(8,
                    119,
                    212,
                    .12);
        }


        textarea.admin-form-control {

            min-height:
                110px;

            resize:
                vertical;
        }



        /* =====================================================
           GLOBAL BUTTON
        ===================================================== */

        .admin-btn {

            min-height:
                42px;


            padding:
                0 16px;


            border:
                none;


            border-radius:
                9px;


            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                7px;


            text-decoration:
                none;


            cursor:
                pointer;


            font-size:
                14px;

            font-weight:
                700;


            transition:
                transform .2s ease,
                filter .2s ease,
                background .2s ease;
        }


        .admin-btn:hover {

            transform:
                translateY(-1px);
        }



        /* PRIMARY */

        .admin-btn-primary {

            background:
                linear-gradient(90deg,
                    var(--primary),
                    var(--primary-light));

            color:
                white;
        }


        .admin-btn-primary:hover {

            filter:
                brightness(.96);
        }



        /* SECONDARY / BATAL */

        .admin-btn-secondary {

            border:
                1px solid var(--border);


            background:
                #eaf1f7;


            color:
                #35546f;
        }


        .admin-btn-secondary:hover {

            background:
                #dfe9f2;
        }



        body.dark-mode .admin-btn-secondary {

            background:
                #263b4d;

            color:
                #d9e6f0;
        }


        body.dark-mode .admin-btn-secondary:hover {

            background:
                #30495d;
        }



        /* WARNING */

        .admin-btn-warning {

            background:
                var(--warning-bg);

            color:
                var(--warning);
        }



        /* DANGER */

        .admin-btn-danger {

            background:
                var(--danger-bg);

            color:
                var(--danger);
        }



        /* SUCCESS */

        .admin-btn-success {

            background:
                var(--success-bg);

            color:
                var(--success);
        }



        /* =====================================================
           FORM ACTIONS
        ===================================================== */

        .admin-form-actions {

            margin-top:
                22px;


            display:
                flex;

            align-items:
                center;

            justify-content:
                flex-end;

            gap:
                10px;

            flex-wrap:
                wrap;
        }



        /* =====================================================
           GLOBAL TABLE
        ===================================================== */

        .admin-table-wrapper {

            overflow-x:
                auto;
        }


        .admin-table {

            width:
                100%;


            border-collapse:
                collapse;


            font-size:
                14px;
        }


        .admin-table th {

            padding:
                13px 14px;


            background:
                rgba(120,
                    145,
                    165,
                    .08);


            color:
                var(--text-muted);


            text-align:
                left;


            white-space:
                nowrap;


            font-weight:
                600;
        }


        .admin-table td {

            padding:
                14px;


            border-bottom:
                1px solid var(--border);


            color:
                var(--text-main);


            vertical-align:
                middle;
        }


        .admin-table tbody tr:hover {

            background:
                rgba(8,
                    119,
                    212,
                    .025);
        }



        /* =====================================================
           GLOBAL STATUS BADGE
        ===================================================== */

        .admin-badge {

            padding:
                6px 10px;


            border-radius:
                20px;


            display:
                inline-flex;

            align-items:
                center;

            gap:
                5px;


            white-space:
                nowrap;


            font-size:
                11px;

            font-weight:
                700;
        }


        .admin-badge-success {

            background:
                var(--success-bg);

            color:
                var(--success);
        }


        .admin-badge-danger {

            background:
                var(--danger-bg);

            color:
                var(--danger);
        }


        .admin-badge-warning {

            background:
                var(--warning-bg);

            color:
                var(--warning);
        }


        .admin-badge-primary {

            background:
                var(--primary-soft);

            color:
                var(--primary);
        }



        /* =====================================================
           GLOBAL ALERT
        ===================================================== */

        .admin-alert-success {

            margin-bottom:
                18px;


            padding:
                13px 15px;


            border:
                1px solid rgba(20,
                    131,
                    92,
                    .25);


            border-radius:
                10px;


            background:
                var(--success-bg);


            color:
                var(--success);


            font-size:
                14px;

            font-weight:
                500;
        }


        .admin-alert-error {

            margin-bottom:
                18px;


            padding:
                13px 15px;


            border:
                1px solid rgba(220,
                    76,
                    76,
                    .25);


            border-radius:
                10px;


            background:
                var(--danger-bg);


            color:
                var(--danger);


            font-size:
                14px;

            font-weight:
                500;
        }



        /* =====================================================
           COLLAPSED SIDEBAR
        ===================================================== */

        body.admin-sidebar-collapsed .admin-sidebar {

            width:
                var(--sidebar-collapsed);
        }


        body.admin-sidebar-collapsed .admin-main {

            width:
                calc(100% - var(--sidebar-collapsed));


            margin-left:
                var(--sidebar-collapsed);
        }


        body.admin-sidebar-collapsed .admin-brand {

            justify-content:
                center;


            padding-left:
                0;

            padding-right:
                0;
        }


        body.admin-sidebar-collapsed .admin-brand-name {

            display:
                none;
        }


        body.admin-sidebar-collapsed .admin-menu-item {

            padding-left:
                0;

            padding-right:
                0;


            justify-content:
                center;


            gap:
                0;
        }


        body.admin-sidebar-collapsed .admin-menu-text {

            display:
                none;
        }


        body.admin-sidebar-collapsed .admin-menu-icon {

            width:
                24px;

            margin:
                0;


            text-align:
                center;
        }



        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 850px) {

            .admin-sidebar {

                display:
                    none;
            }


            .admin-main {

                width:
                    100%;

                margin-left:
                    0;
            }


            body.admin-sidebar-collapsed .admin-main {

                width:
                    100%;

                margin-left:
                    0;
            }

        }


        @media(max-width: 700px) {

            .admin-form-grid {

                grid-template-columns:
                    1fr;
            }


            .admin-form-group.full {

                grid-column:
                    auto;
            }

        }


        @media(max-width: 600px) {

            .admin-content {

                padding:
                    20px 14px 30px;
            }


            .admin-topbar {

                padding:
                    0 15px;
            }


            .admin-profile-name {

                display:
                    none;
            }


            .admin-page-title {

                font-size:
                    24px;
            }


            .admin-form-actions {

                flex-direction:
                    column-reverse;
            }


            .admin-form-actions .admin-btn {

                width:
                    100%;
            }

        }
    </style>



    {{-- =====================================================
         PAGE SPECIFIC CSS
    ====================================================== --}}

    @stack('styles')


</head>



<body
    class="{{
        $adminTheme === 'dark'
        ?
        'dark-mode'
        :
        ''
    }}">


    <div class="admin-app">


        {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

        <aside class="admin-sidebar">


            {{-- BRAND --}}

            <div class="admin-brand">


                <div class="ruangkita-logo">

                    <div class="roof"></div>

                    <div class="house">

                        <div class="door"></div>

                    </div>

                </div>


                <span class="admin-brand-name">

                    RuangKita

                </span>


            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="admin-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="admin-menu-icon">⌂</span>
                <span class="admin-menu-text">{{ $at['dashboard'] }}</span>
            </a>

            <a href="{{ route('admin.clients.index') }}"
                class="admin-menu-item {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <span class="admin-menu-icon">♙</span>
                <span class="admin-menu-text">{{ $at['client'] }}</span>
            </a>

            <a href="{{ route('admin.projects.index') }}"
                class="admin-menu-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <span class="admin-menu-icon">▣</span>
                <span class="admin-menu-text">{{ $at['projects'] }}</span>
            </a>

            <a href="{{ route('admin.works.index') }}"
                class="admin-menu-item {{ request()->routeIs('admin.works.*') ? 'active' : '' }}">
                <span class="admin-menu-icon">▤</span>
                <span class="admin-menu-text">{{ $at['works'] }}</span>
            </a>

            <a href="{{ route('admin.schedules.index') }}"
                class="admin-menu-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                <span class="admin-menu-icon">▦</span>
                <span class="admin-menu-text">{{ $at['schedule'] }}</span>
            </a>


            {{-- =================================================
             MATERIAL
        ================================================== --}}

            <a href="{{ route('admin.materials.index') }}"
                class="admin-menu-item {{ request()->routeIs('admin.materials.*') ? 'active' : '' }}">
                <span class="admin-menu-icon">◆</span>
                <span class="admin-menu-text">{{ $at['materials'] }}</span>
            </a>


            {{-- =================================================
             PENGELUARAN
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ▰
                </span>

                <span class="admin-menu-text">

                    {{ $at['expenses'] }}

                </span>

            </a>



            {{-- =================================================
             UANG PRIBADI
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ◎
                </span>

                <span class="admin-menu-text">

                    {{ $at['personal_funds'] }}

                </span>

            </a>



            {{-- =================================================
             PROGRESS
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ↗
                </span>

                <span class="admin-menu-text">

                    {{ $at['progress'] }}

                </span>

            </a>



            {{-- =================================================
             DOKUMENTASI
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ▧
                </span>

                <span class="admin-menu-text">

                    {{ $at['documentation'] }}

                </span>

            </a>



            {{-- =================================================
             LAPORAN
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ▥
                </span>

                <span class="admin-menu-text">

                    {{ $at['reports'] }}

                </span>

            </a>



            {{-- =================================================
             PENGATURAN
             Route nanti kita aktifkan saat modul settings Admin dibuat
        ================================================== --}}

            <a
                href="#"
                class="admin-menu-item">

                <span class="admin-menu-icon">
                    ⚙
                </span>

                <span class="admin-menu-text">

                    {{ $at['settings'] }}

                </span>

            </a>


        </aside>



        {{-- =====================================================
         MAIN
    ====================================================== --}}

        <main class="admin-main">


            {{-- =================================================
             TOPBAR
        ================================================== --}}

            <header class="admin-topbar">


                {{-- HAMBURGER --}}

                <button
                    type="button"
                    class="admin-hamburger"
                    id="adminSidebarToggle"
                    aria-label="Toggle sidebar">

                    ☰

                </button>



                {{-- PROFILE --}}

                <div class="admin-profile">


                    <button
                        type="button"
                        class="admin-profile-button"
                        id="adminProfileButton">


                        {{-- AVATAR --}}

                        <div class="admin-avatar">


                            @if(
                            $adminUser
                            &&
                            $adminUser->profile_photo
                            )

                            <img
                                src="{{
                                    asset(
                                        'storage/' .
                                        $adminUser->profile_photo
                                    )
                                }}"
                                alt="{{
                                    $adminUser->name
                                }}">

                            @else

                            {{
                                strtoupper(
                                    substr(
                                        $adminUser->name
                                        ??
                                        'A',
                                        0,
                                        1
                                    )
                                )
                            }}

                            @endif


                        </div>



                        {{-- NAME --}}

                        <span class="admin-profile-name">

                            {{
                            $adminUser->name
                            ??
                            'Admin RuangKita'
                        }}

                        </span>



                        {{-- ARROW --}}

                        <span
                            class="admin-profile-arrow"
                            id="adminProfileArrow">

                            ▾

                        </span>


                    </button>



                    {{-- =================================================
                     PROFILE DROPDOWN
                ================================================== --}}

                    <div
                        class="admin-profile-menu"
                        id="adminProfileMenu">


                        <div class="admin-profile-header">


                            <strong>

                                {{
                                $adminUser->name
                                ??
                                'Admin RuangKita'
                            }}

                            </strong>


                            <span>

                                {{
                                $adminUser->email
                                ??
                                ''
                            }}

                            </span>


                        </div>



                        <div class="admin-profile-divider"></div>



                        {{-- SETTINGS
                         Nanti diaktifkan setelah route settings admin dibuat

                    <a
                        href="{{-- route('admin.settings') --}}"
                        class="admin-profile-item"
                        >

                        ⚙

                        <span>
                            {{ $at['settings'] }}
                        </span>

                        </a>

                        <div class="admin-profile-divider"></div>

                        --}}



                        {{-- LOGOUT --}}

                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf


                            <button
                                type="submit"
                                class="
                                admin-profile-item
                                logout
                            ">

                                ↪

                                <span>

                                    {{ $at['logout'] }}

                                </span>

                            </button>


                        </form>


                    </div>


                </div>


            </header>



            {{-- =================================================
             CONTENT
        ================================================== --}}

            <section class="admin-content">


                {{-- SUCCESS MESSAGE --}}

                @if(session('success'))

                <div class="admin-alert-success">

                    {{ session('success') }}

                </div>

                @endif



                {{-- ERROR MESSAGE --}}

                @if($errors->any())

                <div class="admin-alert-error">


                    @foreach($errors->all() as $error)

                    <div>

                        {{ $error }}

                    </div>

                    @endforeach


                </div>

                @endif



                {{-- PAGE CONTENT --}}

                @yield('content')


            </section>


        </main>


    </div>



    {{-- =========================================================
     GLOBAL SCRIPT
========================================================= --}}

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {


                /*
                |--------------------------------------------------------------------------
                | SIDEBAR COLLAPSE
                |--------------------------------------------------------------------------
                */

                const sidebarToggle =
                    document.getElementById(
                        'adminSidebarToggle'
                    );


                const sidebarState =
                    localStorage.getItem(
                        'ruangkitaAdminSidebarCollapsed'
                    );


                if (sidebarState === '1') {

                    document.body
                        .classList
                        .add(
                            'admin-sidebar-collapsed'
                        );

                }


                if (sidebarToggle) {

                    sidebarToggle
                        .addEventListener(
                            'click',
                            function() {


                                document.body
                                    .classList
                                    .toggle(
                                        'admin-sidebar-collapsed'
                                    );


                                const collapsed =
                                    document.body
                                    .classList
                                    .contains(
                                        'admin-sidebar-collapsed'
                                    );


                                localStorage
                                    .setItem(
                                        'ruangkitaAdminSidebarCollapsed',
                                        collapsed ?
                                        '1' :
                                        '0'
                                    );

                            }
                        );

                }



                /*
                |--------------------------------------------------------------------------
                | PROFILE DROPDOWN
                |--------------------------------------------------------------------------
                */

                const profileButton =
                    document.getElementById(
                        'adminProfileButton'
                    );


                const profileMenu =
                    document.getElementById(
                        'adminProfileMenu'
                    );


                const profileArrow =
                    document.getElementById(
                        'adminProfileArrow'
                    );


                if (
                    profileButton &&
                    profileMenu
                ) {


                    profileButton
                        .addEventListener(
                            'click',
                            function(event) {


                                event
                                    .stopPropagation();


                                profileMenu
                                    .classList
                                    .toggle(
                                        'show'
                                    );


                                if (profileArrow) {

                                    profileArrow
                                        .classList
                                        .toggle(
                                            'open'
                                        );

                                }

                            }
                        );



                    profileMenu
                        .addEventListener(
                            'click',
                            function(event) {

                                event
                                    .stopPropagation();

                            }
                        );



                    document
                        .addEventListener(
                            'click',
                            function() {


                                profileMenu
                                    .classList
                                    .remove(
                                        'show'
                                    );


                                if (profileArrow) {

                                    profileArrow
                                        .classList
                                        .remove(
                                            'open'
                                        );

                                }

                            }
                        );

                }

            }
        );
    </script>



    {{-- =========================================================
     PAGE SPECIFIC SCRIPT
========================================================= --}}

    @stack('scripts')


</body>

</html>