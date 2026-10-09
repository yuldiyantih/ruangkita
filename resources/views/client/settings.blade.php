<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pengaturan - RuangKita</title>

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

        /* ================================
           SIDEBAR
        ================================= */

        .sidebar {
            width: 230px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            padding: 20px 14px;
            color: white;
            background: linear-gradient(180deg,
                    #0d3458,
                    #092843);
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
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, .08);
        }

        .menu-item.active {
            color: white;
            background: linear-gradient(90deg,
                    #0665ac,
                    #087acb);
        }

        .menu-icon {
            width: 19px;
            text-align: center;
        }

        /* ================================
           MAIN
        ================================= */

        .main {
            position: relative;
            z-index: 1;
            width: calc(100% - 230px);
            margin-left: 230px;
        }

        .topbar {
            height: 66px;
            padding: 0 28px;
            background: white;
            border-bottom: 1px solid #e5edf3;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hamburger {
            color: #41627e;
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
            width: 34px;
            height: 34px;
            border-radius: 50%;
            overflow: hidden;
            background: #e3edf5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        /* ================================
           CONTENT
        ================================= */

        .content {
            padding: 27px 30px 40px;
        }

        .breadcrumb {
            color: #71869a;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #56728b;
        }

        .page-title {
            margin-bottom: 23px;
        }

        .page-title h1 {
            color: #102e49;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .page-title p {
            color: #6f8498;
            font-size: 13px;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 17px;
        }

        .card {
            background: white;
            border: 1px solid #e1e9ef;
            border-radius: 13px;
            padding: 20px;
            margin-bottom: 17px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: #17354e;
            margin-bottom: 5px;
        }

        .card-subtitle {
            color: #798da0;
            font-size: 10px;
            margin-bottom: 18px;
        }

        /* ================================
           PROFILE
        ================================= */

        .profile-layout {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 22px;
        }

        .profile-photo-box {
            text-align: center;
        }

        .profile-photo {
            width: 105px;
            height: 105px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
            background: #eef4f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;

        }

        .photo-label {
            display: inline-block;
            margin-top: 8px;
            font-size: 10px;
            color: #0877d4;
            cursor: pointer;
        }

        .photo-label input {
            display: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            color: #29465e;
            font-size: 11px;
            font-weight: 700;
        }

        .field input,
        .field textarea,
        .field select {
            width: 100%;
            border: 1px solid #dce6ee;
            border-radius: 8px;
            padding: 11px 12px;
            outline: none;
            color: #29465e;
            background: #fbfdff;
            font-size: 12px;
        }

        .field textarea {
            min-height: 85px;
            resize: vertical;
        }

        .button-row {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            border: none;
            border-radius: 8px;
            padding: 11px 18px;
            background: linear-gradient(90deg,
                    #0877d4,
                    #078ee5);
            color: white;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        /* ================================
           PASSWORD
        ================================= */

        .password-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        /* ================================
           NOTIFICATION
        ================================= */

        .notification-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .notification-item {
            border: 1px solid #e4ebf1;
            border-radius: 10px;
            padding: 13px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .notification-name {
            font-size: 11px;
            font-weight: 700;
            color: #27455d;
        }

        .notification-text {
            font-size: 9px;
            color: #8495a5;
            margin-top: 3px;
        }

        .switch {
            position: relative;
            width: 41px;
            height: 23px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            inset: 0;
            cursor: pointer;
            background: #ccd7e0;
            border-radius: 20px;
            transition: .2s;
        }

        .slider::before {
            content: "";
            position: absolute;
            width: 17px;
            height: 17px;
            left: 3px;
            top: 3px;
            background: white;
            border-radius: 50%;
            transition: .2s;
        }

        .switch input:checked+.slider {
            background: #0782df;
        }

        .switch input:checked+.slider::before {
            transform: translateX(18px);
        }

        /* ================================
           RIGHT SIDE
        ================================= */

        .account-name {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .account-role {
            color: #70879a;
            font-size: 10px;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 15px;
            background: #e1f8eb;
            color: #168456;
            font-size: 9px;
            font-weight: 700;
        }

        .info-row {
            display: grid;
            grid-template-columns: 100px 1fr;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #edf2f6;
            font-size: 10px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #71879a;
        }

        .info-value {
            color: #28465d;
            font-weight: 600;
        }

        .logout-form {
            margin-top: 10px;
        }

        .btn-logout {
            width: 100%;
            min-height: 42px;
            border: none;
            border-radius: 8px;
            background: #e53935;
            color: white;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        /* ================================
           ALERT
        ================================= */

        .alert-success {
            padding: 12px 14px;
            margin-bottom: 17px;
            border-radius: 9px;
            background: #e8f7ef;
            color: #167047;
            font-size: 11px;
        }

        .alert-error {
            padding: 12px 14px;
            margin-bottom: 17px;
            border-radius: 9px;
            background: #fff0f0;
            color: #b42318;
            font-size: 11px;
        }

        /* ================================
           RESPONSIVE
        ================================= */

        @media(max-width: 1050px) {

            .settings-grid {
                grid-template-columns: 1fr;
            }

            .password-grid {
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

        @media(max-width: 650px) {

            .content {
                padding: 20px 12px;
            }

            .profile-layout {
                grid-template-columns: 1fr;
            }

            .form-grid,
            .notification-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ================================
   DARK MODE
================================= */

        body.dark-mode {
            background: #101923;
            color: #dce7f1;
        }

        body.dark-mode .main {
            background: #101923;
        }

        body.dark-mode .topbar {
            background: #152331;
            border-bottom-color: #26394a;
        }

        body.dark-mode .card {
            background: #172735;
            border-color: #294052;
        }

        body.dark-mode .page-title h1,
        body.dark-mode .card-title,
        body.dark-mode .account-name {
            color: #f4f8fc;
        }

        body.dark-mode .page-title p,
        body.dark-mode .card-subtitle,
        body.dark-mode .account-role,
        body.dark-mode .breadcrumb {
            color: #91a7ba;
        }

        body.dark-mode .field label,
        body.dark-mode .notification-name,
        body.dark-mode .info-value {
            color: #d8e5ef;
        }

        body.dark-mode .field input,
        body.dark-mode .field textarea,
        body.dark-mode .field select {
            background: #10202d;
            border-color: #30485b;
            color: #e8f0f6;
        }

        body.dark-mode .notification-item {
            background: #132330;
            border-color: #294052;
        }

        body.dark-mode .info-row {
            border-bottom-color: #294052;
        }
    </style>

</head>

<body>

    <body class="{{ $user->theme === 'dark' ? 'dark-mode' : '' }}">
        <div class="app">

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


                <a href="{{ route('client.dashboard') }}" class="menu-item">
                    <span class="menu-icon">⌂</span>
                    Dashboard
                </a>

                <a href="{{ route('client.projects.index') }}" class="menu-item">
                    <span class="menu-icon">▣</span>
                    Proyek Saya
                </a>

                <a href="{{ route('client.schedule') }}" class="menu-item">
                    <span class="menu-icon">▦</span>
                    Jadwal
                </a>

                <a href="{{ route('client.progress') }}" class="menu-item">
                    <span class="menu-icon">↗</span>
                    Progress
                </a>

                <a href="{{ route('client.documentation') }}" class="menu-item">
                    <span class="menu-icon">▧</span>
                    Dokumentasi
                </a>

                <a href="{{ route('client.costs') }}" class="menu-item">
                    <span class="menu-icon">▤</span>
                    Informasi Biaya
                </a>

                <a href="{{ route('client.messages') }}" class="menu-item">
                    <span class="menu-icon">✉</span>
                    Pesan
                </a>

                <a href="{{ route('client.ar') }}" class="menu-item">
                    <span class="menu-icon">◇</span>
                    Augmented Reality
                </a>

                <a
                    href="{{ route('client.settings') }}"
                    class="menu-item active">

                    <span class="menu-icon">⚙</span>

                    Pengaturan
                </a>

            </aside>


            <main class="main">

                <header class="topbar">

                    <div class="hamburger">
                        ☰
                    </div>

                    <div class="user-area">

                        <div class="avatar">

                            @if($user->profile_photo)

                            <img
                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="{{ $user->name }}">

                            @else

                            👤

                            @endif

                        </div>

                        <span>
                            {{ $user->name }}
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

                        Pengaturan

                    </div>


                    <div class="page-title">

                        <h1>
                            Pengaturan
                        </h1>

                        <p>
                            Kelola profil akun, keamanan, notifikasi,
                            dan preferensi aplikasi Anda.
                        </p>

                    </div>


                    @if(session('success'))

                    <div class="alert-success">
                        {{ session('success') }}
                    </div>

                    @endif


                    @if($errors->any())

                    <div class="alert-error">

                        <strong>
                            Periksa kembali data berikut:
                        </strong>

                        <ul style="margin:8px 0 0 18px;">

                            @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                            @endforeach

                        </ul>

                    </div>

                    @endif


                    <div class="settings-grid">


                        <div>


                            <!-- PROFIL -->

                            <div class="card">

                                <div class="card-title">
                                    👤 Profil Akun
                                </div>

                                <div class="card-subtitle">
                                    Kelola informasi profil Anda.
                                </div>


                                <form
                                    action="{{ route('client.settings.profile') }}"
                                    method="POST"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')


                                    <div class="profile-layout">

                                        <div class="profile-photo-box">

                                            <div class="profile-photo">

                                                @if($user->profile_photo)

                                                <img
                                                    src="{{ asset('storage/' . $user->profile_photo) }}"
                                                    alt="{{ $user->name }}">

                                                @else

                                                👤

                                                @endif

                                            </div>

                                            <label class="photo-label">

                                                Ubah Foto

                                                <input
                                                    type="file"
                                                    name="profile_photo"
                                                    accept=".jpg,.jpeg,.png,.webp">

                                            </label>

                                        </div>


                                        <div>

                                            <div class="form-grid">

                                                <div class="field">

                                                    <label>
                                                        Nama Lengkap
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="name"
                                                        value="{{ old('name', $user->name) }}"
                                                        required>

                                                </div>


                                                <div class="field">

                                                    <label>
                                                        Email
                                                    </label>

                                                    <input
                                                        type="email"
                                                        name="email"
                                                        value="{{ old('email', $user->email) }}"
                                                        required>

                                                </div>


                                                <div class="field">

                                                    <label>
                                                        Nomor Telepon
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="phone"
                                                        value="{{ old('phone', $user->phone) }}">

                                                </div>


                                                <div class="field">

                                                    <label>
                                                        Alamat
                                                    </label>

                                                    <textarea
                                                        name="address">{{ old('address', $client->address) }}</textarea>

                                                </div>

                                            </div>


                                            <div class="button-row">

                                                <button
                                                    type="submit"
                                                    class="btn-primary">

                                                    Simpan Perubahan

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>


                            <!-- PASSWORD -->

                            <div class="card">

                                <div class="card-title">
                                    🔒 Keamanan
                                </div>

                                <div class="card-subtitle">
                                    Ubah password akun Anda secara berkala.
                                </div>


                                <form
                                    action="{{ route('client.settings.password') }}"
                                    method="POST">

                                    @csrf
                                    @method('PUT')


                                    <div class="password-grid">

                                        <div class="field">

                                            <label>
                                                Password Lama
                                            </label>

                                            <input
                                                type="password"
                                                name="current_password"
                                                placeholder="Password lama"
                                                required>

                                        </div>


                                        <div class="field">

                                            <label>
                                                Password Baru
                                            </label>

                                            <input
                                                type="password"
                                                name="password"
                                                placeholder="Minimal 8 karakter"
                                                required>

                                        </div>


                                        <div class="field">

                                            <label>
                                                Konfirmasi Password
                                            </label>

                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                placeholder="Ulangi password"
                                                required>

                                        </div>

                                    </div>


                                    <div class="button-row">

                                        <button
                                            type="submit"
                                            class="btn-primary">

                                            Ubah Password

                                        </button>

                                    </div>

                                </form>

                            </div>


                            <!-- PREFERENCES -->

                            <form
                                action="{{ route('client.settings.preferences') }}"
                                method="POST">

                                @csrf
                                @method('PUT')


                                <div class="card">

                                    <div class="card-title">
                                        🔔 Preferensi Notifikasi
                                    </div>

                                    <div class="card-subtitle">
                                        Tentukan notifikasi yang ingin Anda terima.
                                    </div>


                                    <div class="notification-grid">


                                        <div class="notification-item">

                                            <div>

                                                <div class="notification-name">
                                                    Notifikasi Pesan
                                                </div>

                                                <div class="notification-text">
                                                    Informasi pesan baru dari tim proyek.
                                                </div>

                                            </div>

                                            <label class="switch">

                                                <input
                                                    type="checkbox"
                                                    name="notify_messages"
                                                    value="1"
                                                    @checked($user->notify_messages)>

                                                <span class="slider"></span>

                                            </label>

                                        </div>


                                        <div class="notification-item">

                                            <div>

                                                <div class="notification-name">
                                                    Update Progress
                                                </div>

                                                <div class="notification-text">
                                                    Informasi perkembangan proyek terbaru.
                                                </div>

                                            </div>

                                            <label class="switch">

                                                <input
                                                    type="checkbox"
                                                    name="notify_progress"
                                                    value="1"
                                                    @checked($user->notify_progress)>

                                                <span class="slider"></span>

                                            </label>

                                        </div>


                                        <div class="notification-item">

                                            <div>

                                                <div class="notification-name">
                                                    Pengingat Jadwal
                                                </div>

                                                <div class="notification-text">
                                                    Perubahan dan pengingat jadwal proyek.
                                                </div>

                                            </div>

                                            <label class="switch">

                                                <input
                                                    type="checkbox"
                                                    name="notify_schedule"
                                                    value="1"
                                                    @checked($user->notify_schedule)>

                                                <span class="slider"></span>

                                            </label>

                                        </div>


                                        <div class="notification-item">

                                            <div>

                                                <div class="notification-name">
                                                    Dokumentasi Baru
                                                </div>

                                                <div class="notification-text">
                                                    Informasi foto atau dokumen terbaru.
                                                </div>

                                            </div>

                                            <label class="switch">

                                                <input
                                                    type="checkbox"
                                                    name="notify_documentation"
                                                    value="1"
                                                    @checked($user->notify_documentation)>

                                                <span class="slider"></span>

                                            </label>

                                        </div>


                                        <div class="notification-item">

                                            <div>

                                                <div class="notification-name">
                                                    Informasi Biaya
                                                </div>

                                                <div class="notification-text">
                                                    Informasi terbaru terkait pembayaran.
                                                </div>

                                            </div>

                                            <label class="switch">

                                                <input
                                                    type="checkbox"
                                                    name="notify_cost"
                                                    value="1"
                                                    @checked($user->notify_cost)>

                                                <span class="slider"></span>

                                            </label>

                                        </div>

                                    </div>

                                </div>


                                <div class="card">

                                    <div class="card-title">
                                        ⚙ Preferensi Aplikasi
                                    </div>

                                    <div class="card-subtitle">
                                        Atur bahasa, zona waktu dan tampilan aplikasi.
                                    </div>


                                    <div class="form-grid">

                                        <div class="field">

                                            <label>
                                                Bahasa
                                            </label>

                                            <select name="language">

                                                <option
                                                    value="id"
                                                    @selected($user->language === 'id')>

                                                    Bahasa Indonesia

                                                </option>

                                                <option
                                                    value="en"
                                                    @selected($user->language === 'en')>

                                                    English

                                                </option>

                                            </select>

                                        </div>


                                        <div class="field">

                                            <label>
                                                Zona Waktu
                                            </label>

                                            <select name="timezone">

                                                <option
                                                    value="Asia/Jakarta"
                                                    @selected($user->timezone === 'Asia/Jakarta')>

                                                    WIB (GMT+7)

                                                </option>

                                                <option
                                                    value="Asia/Makassar"
                                                    @selected($user->timezone === 'Asia/Makassar')>

                                                    WITA (GMT+8)

                                                </option>

                                                <option
                                                    value="Asia/Jayapura"
                                                    @selected($user->timezone === 'Asia/Jayapura')>

                                                    WIT (GMT+9)

                                                </option>

                                            </select>

                                        </div>


                                        <div class="field full">

                                            <label>
                                                Tampilan
                                            </label>

                                            <select name="theme">

                                                <option
                                                    value="light"
                                                    @selected($user->theme === 'light')>

                                                    Mode Terang

                                                </option>

                                                <option
                                                    value="dark"
                                                    @selected($user->theme === 'dark')>

                                                    Mode Gelap

                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <div class="button-row">

                                        <button
                                            type="submit"
                                            class="btn-primary">

                                            Simpan Preferensi

                                        </button>

                                    </div>

                                </div>

                            </form>


                        </div>


                        <!-- RIGHT SIDE -->

                        <div>


                            <div class="card">

                                <div class="card-title">
                                    Ringkasan Akun
                                </div>

                                <div style="
                            display:flex;
                            align-items:center;
                            gap:12px;
                            margin-bottom:18px;
                        ">

                                    <div class="profile-photo" style="
                                width:65px;
                                height:65px;
                                margin:0;
                            ">

                                        @if($user->profile_photo)

                                        <img
                                            src="{{ asset('storage/' . $user->profile_photo) }}"
                                            alt="{{ $user->name }}">

                                        @else

                                        👤

                                        @endif

                                    </div>

                                    <div style="flex:1;">

                                        <div class="account-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="account-role">
                                            Client
                                        </div>

                                    </div>

                                    @if($user->is_active)

                                    <span class="status">
                                        Aktif
                                    </span>

                                    @endif

                                </div>


                                <div class="info-row">

                                    <div class="info-label">
                                        Email
                                    </div>

                                    <div class="info-value">
                                        {{ $user->email }}
                                    </div>

                                </div>


                                <div class="info-row">

                                    <div class="info-label">
                                        Telepon
                                    </div>

                                    <div class="info-value">
                                        {{ $user->phone ?? '-' }}
                                    </div>

                                </div>


                                <div class="info-row">

                                    <div class="info-label">
                                        Alamat
                                    </div>

                                    <div class="info-value">
                                        {{ $client->address ?? '-' }}
                                    </div>

                                </div>

                            </div>


                            <div class="card">

                                <div class="card-title">
                                    Aksi Akun
                                </div>

                                <div class="card-subtitle">
                                    Kelola sesi akun Anda.
                                </div>


                                <form
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    class="logout-form">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn-logout">

                                        Keluar

                                    </button>

                                </form>

                            </div>


                        </div>

                    </div>

                </section>

            </main>

        </div>

    </body>

</html>