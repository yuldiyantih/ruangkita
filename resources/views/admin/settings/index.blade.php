@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

/*
|--------------------------------------------------------------------------
| BAHASA INDONESIA
|--------------------------------------------------------------------------
*/

'id' => [

'page_title' =>
'Pengaturan',

'title' =>
'Pengaturan',

'subtitle' =>
'Kelola profil admin, preferensi tampilan, bahasa, dan keamanan akun.',


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

'admin_profile' =>
'Profil Admin',

'admin_profile_subtitle' =>
'Perbarui informasi dasar akun administrator RuangKita.',

'name' =>
'Nama',

'email' =>
'Email',

'phone' =>
'Nomor Telepon',

'phone_placeholder' =>
'Contoh: 08123456789',

'profile_photo' =>
'Foto Profil',

'save_profile' =>
'Simpan Profil',


/*
|--------------------------------------------------------------------------
| PREFERENCES
|--------------------------------------------------------------------------
*/

'app_preferences' =>
'Preferensi Aplikasi',

'app_preferences_subtitle' =>
'Atur bahasa dan tampilan dashboard admin sesuai kebutuhan.',

'language' =>
'Bahasa',

'theme' =>
'Tema',

'indonesian' =>
'Bahasa Indonesia',

'english' =>
'English',

'light_mode' =>
'Mode Terang',

'dark_mode' =>
'Mode Gelap',

'active_language' =>
'Bahasa Aktif',

'active_theme' =>
'Tema Aktif',

'save_preferences' =>
'Simpan Preferensi',


/*
|--------------------------------------------------------------------------
| SECURITY
|--------------------------------------------------------------------------
*/

'account_security' =>
'Keamanan Akun',

'account_security_subtitle' =>
'Ubah password untuk menjaga keamanan akun administrator.',

'current_password' =>
'Password Saat Ini',

'new_password' =>
'Password Baru',

'confirm_new_password' =>
'Konfirmasi Password Baru',

'password_note' =>
'Gunakan minimal 8 karakter. Disarankan menggunakan kombinasi huruf, angka, dan karakter khusus.',

'change_password' =>
'Ubah Password',


/*
|--------------------------------------------------------------------------
| ACCOUNT SUMMARY
|--------------------------------------------------------------------------
*/

'administrator' =>
'Administrator RuangKita',

'active' =>
'Aktif',

'inactive' =>
'Nonaktif',

'telephone' =>
'Telepon',

'role' =>
'Role',

'admin' =>
'Admin',

'registered_since' =>
'Terdaftar Sejak',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Settings',

'title' =>
'Settings',

'subtitle' =>
'Manage the admin profile, display preferences, language, and account security.',


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

'admin_profile' =>
'Admin Profile',

'admin_profile_subtitle' =>
'Update the basic information for the RuangKita administrator account.',

'name' =>
'Name',

'email' =>
'Email',

'phone' =>
'Phone Number',

'phone_placeholder' =>
'Example: 08123456789',

'profile_photo' =>
'Profile Photo',

'save_profile' =>
'Save Profile',


/*
|--------------------------------------------------------------------------
| PREFERENCES
|--------------------------------------------------------------------------
*/

'app_preferences' =>
'Application Preferences',

'app_preferences_subtitle' =>
'Set the language and admin dashboard appearance according to your preferences.',

'language' =>
'Language',

'theme' =>
'Theme',

'indonesian' =>
'Bahasa Indonesia',

'english' =>
'English',

'light_mode' =>
'Light Mode',

'dark_mode' =>
'Dark Mode',

'active_language' =>
'Active Language',

'active_theme' =>
'Active Theme',

'save_preferences' =>
'Save Preferences',


/*
|--------------------------------------------------------------------------
| SECURITY
|--------------------------------------------------------------------------
*/

'account_security' =>
'Account Security',

'account_security_subtitle' =>
'Change your password to keep the administrator account secure.',

'current_password' =>
'Current Password',

'new_password' =>
'New Password',

'confirm_new_password' =>
'Confirm New Password',

'password_note' =>
'Use at least 8 characters. A combination of letters, numbers, and special characters is recommended.',

'change_password' =>
'Change Password',


/*
|--------------------------------------------------------------------------
| ACCOUNT SUMMARY
|--------------------------------------------------------------------------
*/

'administrator' =>
'RuangKita Administrator',

'active' =>
'Active',

'inactive' =>
'Inactive',

'telephone' =>
'Phone',

'role' =>
'Role',

'admin' =>
'Admin',

'registered_since' =>
'Registered Since',

],

];


$st =
$translations[$pageLang]
??
$translations['id'];

@endphp



@section(
'title',
$st['page_title'] . ' - RuangKita'
)



@push('styles')

<style>
    .settings-page-head {
        margin-bottom: 18px;
    }


    .settings-page-head h1 {
        margin: 0 0 5px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .settings-page-head p {
        margin: 0;

        color:
            var(--text-muted);

        font-size: 12px;
    }



    /* =====================================================
       GRID
    ===================================================== */

    .settings-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.7fr) minmax(280px, .8fr);

        gap: 18px;
    }


    .settings-left {
        display: flex;

        flex-direction: column;

        gap: 18px;
    }



    /* =====================================================
       CARD
    ===================================================== */

    .settings-card {
        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);
    }


    .settings-card-title {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .settings-card-subtitle {
        margin-bottom: 18px;

        color:
            var(--text-muted);

        font-size: 10px;

        line-height: 1.5;
    }



    /* =====================================================
       FORM
    ===================================================== */

    .settings-form-grid {
        display: grid;

        grid-template-columns:
            repeat(2,
                minmax(0, 1fr));

        gap: 14px;
    }


    .settings-field {
        display: flex;

        flex-direction: column;

        gap: 6px;
    }


    .settings-field.full {
        grid-column:
            1 / -1;
    }


    .settings-field label {
        color:
            var(--text-main);

        font-size: 10px;

        font-weight: 600;
    }


    .settings-input,
    .settings-select {
        width: 100%;

        min-height: 40px;

        padding:
            0 12px;

        border:
            1px solid var(--border);

        border-radius: 9px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 10px;
    }


    .settings-input:focus,
    .settings-select:focus {
        border-color:
            var(--primary);
    }


    .settings-file {
        width: 100%;

        padding:
            9px 10px;

        border:
            1px solid var(--border);

        border-radius: 9px;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 9px;
    }


    .settings-actions {
        margin-top: 17px;

        display: flex;

        justify-content:
            flex-end;
    }


    .settings-btn {
        min-height: 38px;

        padding:
            0 17px;

        border: none;

        border-radius: 9px;

        background:
            var(--primary);

        color: #fff;

        cursor: pointer;

        font-size: 10px;

        font-weight: 700;
    }


    .settings-btn:hover {
        opacity: .92;
    }



    /* =====================================================
       PROFILE SUMMARY
    ===================================================== */

    .profile-summary {
        text-align: center;
    }


    .profile-avatar {
        width: 88px;

        height: 88px;

        margin:
            0 auto 12px;

        border-radius: 50%;

        overflow: hidden;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            #e2f0ff;

        color:
            #0a75cf;

        font-size: 30px;

        font-weight: 700;
    }


    .profile-avatar img {
        width: 100%;

        height: 100%;

        object-fit: cover;
    }


    .profile-name {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .profile-role {
        margin-bottom: 15px;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    .profile-status {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding:
            5px 10px;

        border-radius: 20px;

        background:
            #def7e9;

        color:
            #13865a;

        font-size: 8px;

        font-weight: 700;
    }


    .profile-info {
        margin-top: 20px;

        text-align: left;
    }


    .profile-info-row {
        padding:
            11px 0;

        border-bottom:
            1px solid var(--border);
    }


    .profile-info-row:last-child {
        border-bottom: 0;
    }


    .profile-info-label {
        margin-bottom: 3px;

        color:
            var(--text-muted);

        font-size: 8px;
    }


    .profile-info-value {
        color:
            var(--text-main);

        font-size: 10px;

        word-break:
            break-word;
    }



    /* =====================================================
       PREFERENCE OPTIONS
    ===================================================== */

    .preference-preview {
        margin-top: 15px;

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 10px;
    }


    .preference-box {
        padding: 13px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        background:
            var(--input-bg);
    }


    .preference-title {
        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 10px;

        font-weight: 700;
    }


    .preference-text {
        color:
            var(--text-muted);

        font-size: 8px;

        line-height: 1.5;
    }



    /* =====================================================
       PASSWORD
    ===================================================== */

    .password-note {
        margin-top: 12px;

        padding:
            10px 12px;

        border-radius: 9px;

        background:
            #fff6df;

        color:
            #876300;

        font-size: 8px;

        line-height: 1.5;
    }


    body.dark-mode .password-note {
        background:
            #3e3320;

        color:
            #f3ce70;
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1000px) {

        .settings-grid {
            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 650px) {

        .settings-form-grid {
            grid-template-columns:
                1fr;
        }


        .preference-preview {
            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     PAGE HEADER
===================================================== --}}

<div class="settings-page-head">


    <h1>

        {{ $st['title'] }}

    </h1>


    <p>

        {{ $st['subtitle'] }}

    </p>


</div>



<div class="settings-grid">


    {{-- =====================================================
         LEFT SIDE
    ====================================================== --}}

    <div class="settings-left">


        {{-- =================================================
             PROFIL ADMIN
        ================================================== --}}

        <div class="settings-card">


            <div class="settings-card-title">

                {{ $st['admin_profile'] }}

            </div>


            <div class="settings-card-subtitle">

                {{ $st['admin_profile_subtitle'] }}

            </div>



            <form
                method="POST"
                action="{{ route('admin.settings.profile') }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')



                <div class="settings-form-grid">


                    {{-- NAME --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['name'] }}

                        </label>


                        <input
                            type="text"
                            name="name"
                            class="settings-input"
                            value="{{ old('name', $user->name) }}"
                            required>


                    </div>



                    {{-- EMAIL --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['email'] }}

                        </label>


                        <input
                            type="email"
                            name="email"
                            class="settings-input"
                            value="{{ old('email', $user->email) }}"
                            required>


                    </div>



                    {{-- PHONE --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['phone'] }}

                        </label>


                        <input
                            type="text"
                            name="phone"
                            class="settings-input"
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="{{ $st['phone_placeholder'] }}">


                    </div>



                    {{-- PHOTO --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['profile_photo'] }}

                        </label>


                        <input
                            type="file"
                            name="profile_photo"
                            class="settings-file"
                            accept=".jpg,.jpeg,.png,.webp">


                    </div>


                </div>



                <div class="settings-actions">


                    <button
                        type="submit"
                        class="settings-btn">

                        {{ $st['save_profile'] }}

                    </button>


                </div>


            </form>


        </div>



        {{-- =================================================
             PREFERENSI APLIKASI
        ================================================== --}}

        <div class="settings-card">


            <div class="settings-card-title">

                {{ $st['app_preferences'] }}

            </div>


            <div class="settings-card-subtitle">

                {{ $st['app_preferences_subtitle'] }}

            </div>



            <form
                method="POST"
                action="{{ route('admin.settings.preferences') }}">

                @csrf
                @method('PUT')



                <div class="settings-form-grid">


                    {{-- LANGUAGE --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['language'] }}

                        </label>


                        <select
                            name="language"
                            class="settings-select">


                            <option
                                value="id"
                                @selected(
                                ($user->language ?? 'id')
                                ===
                                'id'
                                )>

                                {{ $st['indonesian'] }}

                            </option>


                            <option
                                value="en"
                                @selected(
                                ($user->language ?? 'id')
                                ===
                                'en'
                                )>

                                {{ $st['english'] }}

                            </option>


                        </select>


                    </div>



                    {{-- THEME --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['theme'] }}

                        </label>


                        <select
                            name="theme"
                            class="settings-select">


                            <option
                                value="light"
                                @selected(
                                ($user->theme ?? 'light')
                                ===
                                'light'
                                )>

                                {{ $st['light_mode'] }}

                            </option>


                            <option
                                value="dark"
                                @selected(
                                ($user->theme ?? 'light')
                                ===
                                'dark'
                                )>

                                {{ $st['dark_mode'] }}

                            </option>


                        </select>


                    </div>


                </div>



                {{-- CURRENT PREFERENCES --}}

                <div class="preference-preview">


                    <div class="preference-box">


                        <div class="preference-title">

                            {{ $st['active_language'] }}

                        </div>


                        <div class="preference-text">

                            {{
                                ($user->language ?? 'id')
                                ===
                                'en'
                                    ? $st['english']
                                    : $st['indonesian']
                            }}

                        </div>


                    </div>



                    <div class="preference-box">


                        <div class="preference-title">

                            {{ $st['active_theme'] }}

                        </div>


                        <div class="preference-text">

                            {{
                                ($user->theme ?? 'light')
                                ===
                                'dark'
                                    ? $st['dark_mode']
                                    : $st['light_mode']
                            }}

                        </div>


                    </div>


                </div>



                <div class="settings-actions">


                    <button
                        type="submit"
                        class="settings-btn">

                        {{ $st['save_preferences'] }}

                    </button>


                </div>


            </form>


        </div>



        {{-- =================================================
             ACCOUNT SECURITY
        ================================================== --}}

        <div class="settings-card">


            <div class="settings-card-title">

                {{ $st['account_security'] }}

            </div>


            <div class="settings-card-subtitle">

                {{ $st['account_security_subtitle'] }}

            </div>



            <form
                method="POST"
                action="{{ route('admin.settings.password') }}">

                @csrf
                @method('PUT')



                <div class="settings-form-grid">


                    {{-- CURRENT PASSWORD --}}

                    <div class="settings-field full">


                        <label>

                            {{ $st['current_password'] }}

                        </label>


                        <input
                            type="password"
                            name="current_password"
                            class="settings-input"
                            autocomplete="current-password">


                    </div>



                    {{-- NEW PASSWORD --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['new_password'] }}

                        </label>


                        <input
                            type="password"
                            name="password"
                            class="settings-input"
                            autocomplete="new-password">


                    </div>



                    {{-- CONFIRM PASSWORD --}}

                    <div class="settings-field">


                        <label>

                            {{ $st['confirm_new_password'] }}

                        </label>


                        <input
                            type="password"
                            name="password_confirmation"
                            class="settings-input"
                            autocomplete="new-password">


                    </div>


                </div>



                <div class="password-note">

                    {{ $st['password_note'] }}

                </div>



                <div class="settings-actions">


                    <button
                        type="submit"
                        class="settings-btn">

                        {{ $st['change_password'] }}

                    </button>


                </div>


            </form>


        </div>


    </div>



    {{-- =====================================================
         RIGHT SIDE - ACCOUNT SUMMARY
    ====================================================== --}}

    <aside>


        <div class="settings-card profile-summary">


            {{-- AVATAR --}}

            <div class="profile-avatar">


                @if($user->profile_photo)

                <img
                    src="{{ asset('storage/' . $user->profile_photo) }}"
                    alt="{{ $user->name }}">

                @else

                {{
                        strtoupper(
                            mb_substr(
                                $user->name ?? 'A',
                                0,
                                1
                            )
                        )
                    }}

                @endif


            </div>



            {{-- NAME --}}

            <div class="profile-name">

                {{ $user->name }}

            </div>



            {{-- ROLE --}}

            <div class="profile-role">

                {{ $st['administrator'] }}

            </div>



            {{-- STATUS --}}

            @if($user->is_active)

            <span class="profile-status">

                ● {{ $st['active'] }}

            </span>

            @else

            <span
                class="profile-status"
                style="
                        background:#ffe9e9;
                        color:#bd3e3e;
                    ">

                ● {{ $st['inactive'] }}

            </span>

            @endif



            {{-- =================================================
                 PROFILE INFO
            ================================================== --}}

            <div class="profile-info">


                {{-- EMAIL --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['email'] }}

                    </div>


                    <div class="profile-info-value">

                        {{ $user->email }}

                    </div>


                </div>



                {{-- PHONE --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['telephone'] }}

                    </div>


                    <div class="profile-info-value">

                        {{ $user->phone ?? '-' }}

                    </div>


                </div>



                {{-- ROLE --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['role'] }}

                    </div>


                    <div class="profile-info-value">

                        {{ $st['admin'] }}

                    </div>


                </div>



                {{-- LANGUAGE --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['language'] }}

                    </div>


                    <div class="profile-info-value">

                        {{
                            ($user->language ?? 'id')
                            ===
                            'en'
                                ? $st['english']
                                : $st['indonesian']
                        }}

                    </div>


                </div>



                {{-- THEME --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['theme'] }}

                    </div>


                    <div class="profile-info-value">

                        {{
                            ($user->theme ?? 'light')
                            ===
                            'dark'
                                ? $st['dark_mode']
                                : $st['light_mode']
                        }}

                    </div>


                </div>



                {{-- REGISTERED SINCE --}}

                <div class="profile-info-row">


                    <div class="profile-info-label">

                        {{ $st['registered_since'] }}

                    </div>


                    <div class="profile-info-value">

                        {{
                            optional(
                                $user->created_at
                            )->format('d M Y')
                            ??
                            '-'
                        }}

                    </div>


                </div>


            </div>


        </div>


    </aside>


</div>


@endsection