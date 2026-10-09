@extends('layouts.client')


@php

/*
|--------------------------------------------------------------------------
| TRANSLATION KHUSUS HALAMAN SETTINGS
|--------------------------------------------------------------------------
*/

$settingsTranslations = [

'id' => [

'title' => 'Pengaturan',

'description' =>
'Kelola profil akun, keamanan, notifikasi, dan preferensi aplikasi Anda.',


'profile' => 'Profil Akun',

'profile_description' =>
'Kelola informasi profil Anda.',

'change_photo' => 'Ubah Foto',

'full_name' => 'Nama Lengkap',

'email' => 'Email',

'phone' => 'Nomor Telepon',

'address' => 'Alamat',

'save_changes' => 'Simpan Perubahan',


'security' => 'Keamanan',

'security_description' =>
'Ubah password akun Anda secara berkala.',

'current_password' => 'Password Lama',

'new_password' => 'Password Baru',

'confirm_password' => 'Konfirmasi Password',

'current_password_placeholder' =>
'Password lama',

'new_password_placeholder' =>
'Minimal 8 karakter',

'confirm_password_placeholder' =>
'Ulangi password',

'change_password' => 'Ubah Password',


'notification_preferences' =>
'Preferensi Notifikasi',

'notification_description' =>
'Tentukan notifikasi yang ingin Anda terima.',


'message_notification' =>
'Notifikasi Pesan',

'message_notification_desc' =>
'Informasi pesan baru dari tim proyek.',


'progress_notification' =>
'Update Progress',

'progress_notification_desc' =>
'Informasi perkembangan proyek terbaru.',


'schedule_notification' =>
'Pengingat Jadwal',

'schedule_notification_desc' =>
'Perubahan dan pengingat jadwal proyek.',


'documentation_notification' =>
'Dokumentasi Baru',

'documentation_notification_desc' =>
'Informasi foto atau dokumen terbaru.',


'cost_notification' =>
'Informasi Biaya',

'cost_notification_desc' =>
'Informasi terbaru terkait pembayaran.',


'app_preferences' =>
'Preferensi Aplikasi',

'app_preferences_description' =>
'Atur bahasa, zona waktu dan tampilan aplikasi.',

'language' => 'Bahasa',

'timezone' => 'Zona Waktu',

'appearance' => 'Tampilan',

'light_mode' => 'Mode Terang',

'dark_mode' => 'Mode Gelap',

'save_preferences' =>
'Simpan Preferensi',


'account_summary' =>
'Ringkasan Akun',

'client' => 'Client',

'active' => 'Aktif',

'inactive' => 'Tidak Aktif',


'account_action' =>
'Aksi Akun',

'account_action_description' =>
'Kelola sesi akun Anda.',

'logout' => 'Keluar',

],


'en' => [

'title' => 'Settings',

'description' =>
'Manage your profile, security, notifications, and application preferences.',


'profile' => 'Account Profile',

'profile_description' =>
'Manage your profile information.',

'change_photo' => 'Change Photo',

'full_name' => 'Full Name',

'email' => 'Email',

'phone' => 'Phone Number',

'address' => 'Address',

'save_changes' => 'Save Changes',


'security' => 'Security',

'security_description' =>
'Change your account password regularly.',

'current_password' =>
'Current Password',

'new_password' =>
'New Password',

'confirm_password' =>
'Confirm Password',

'current_password_placeholder' =>
'Current password',

'new_password_placeholder' =>
'Minimum 8 characters',

'confirm_password_placeholder' =>
'Repeat password',

'change_password' =>
'Change Password',


'notification_preferences' =>
'Notification Preferences',

'notification_description' =>
'Choose which notifications you want to receive.',


'message_notification' =>
'Message Notifications',

'message_notification_desc' =>
'Notifications for new messages from the project team.',


'progress_notification' =>
'Progress Updates',

'progress_notification_desc' =>
'Notifications about the latest project progress.',


'schedule_notification' =>
'Schedule Reminder',

'schedule_notification_desc' =>
'Project schedule changes and reminders.',


'documentation_notification' =>
'New Documentation',

'documentation_notification_desc' =>
'Notifications for new photos or documents.',


'cost_notification' =>
'Cost Information',

'cost_notification_desc' =>
'Latest information related to payments.',


'app_preferences' =>
'Application Preferences',

'app_preferences_description' =>
'Set language, time zone, and application appearance.',

'language' => 'Language',

'timezone' => 'Time Zone',

'appearance' => 'Appearance',

'light_mode' => 'Light Mode',

'dark_mode' => 'Dark Mode',

'save_preferences' =>
'Save Preferences',


'account_summary' =>
'Account Summary',

'client' => 'Client',

'active' => 'Active',

'inactive' => 'Inactive',


'account_action' =>
'Account Actions',

'account_action_description' =>
'Manage your account session.',

'logout' => 'Logout',

],

];


$st =
$settingsTranslations[$user->language ?? 'id']
??
$settingsTranslations['id'];
@endphp


@section(
'title',
$st['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       SETTINGS LAYOUT
    ===================================================== */

    .settings-grid {

        display: grid;

        grid-template-columns:
            minmax(0, 1fr) 330px;

        gap: 17px;
    }


    .settings-column .card {

        margin-bottom: 17px;
    }


    /* =====================================================
       PROFILE
    ===================================================== */

    .profile-layout {

        display: grid;

        grid-template-columns:
            150px 1fr;

        gap: 22px;
    }


    .profile-photo-box {

        text-align: center;
    }


    .profile-photo {

        width: 105px;
        height: 105px;

        margin:
            0 auto 10px;

        border-radius: 50%;

        overflow: hidden;

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

        object-position:
            center top;

        display: block;
    }


    .photo-label {

        display: inline-block;

        margin-top: 8px;

        color:
            var(--primary);

        font-size: 10px;

        font-weight: 600;

        cursor: pointer;
    }


    .photo-label input {

        display: none;
    }


    /* =====================================================
       FORM
    ===================================================== */

    .form-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 15px;
    }


    .field {

        display: flex;

        flex-direction: column;

        gap: 6px;
    }


    .field.full {

        grid-column:
            1 / -1;
    }


    .field label {

        color:
            var(--text-main);

        font-size: 11px;

        font-weight: 700;
    }


    .field input,
    .field textarea,
    .field select {

        width: 100%;

        padding:
            11px 12px;

        border:
            1px solid var(--border);

        border-radius: 8px;

        outline: none;

        color:
            var(--text-main);

        background:
            var(--input-bg);

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


    /* =====================================================
       PASSWORD
    ===================================================== */

    .password-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr 1fr;

        gap: 12px;
    }


    /* =====================================================
       NOTIFICATION
    ===================================================== */

    .notification-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 12px;
    }


    .notification-item {

        padding: 13px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        background:
            var(--card-bg);

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 10px;
    }


    .notification-name {

        color:
            var(--text-main);

        font-size: 11px;

        font-weight: 700;
    }


    .notification-text {

        margin-top: 3px;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    /* =====================================================
       SWITCH
    ===================================================== */

    .switch {

        position: relative;

        width: 41px;
        height: 23px;

        flex-shrink: 0;
    }


    .switch input {

        width: 0;
        height: 0;

        opacity: 0;
    }


    .slider {

        position: absolute;

        inset: 0;

        border-radius: 20px;

        background: #ccd7e0;

        cursor: pointer;

        transition: .2s;
    }


    .slider::before {

        content: "";

        position: absolute;

        width: 17px;
        height: 17px;

        top: 3px;
        left: 3px;

        border-radius: 50%;

        background: white;

        transition: .2s;
    }


    .switch input:checked+.slider {

        background:
            var(--primary);
    }


    .switch input:checked+.slider::before {

        transform:
            translateX(18px);
    }


    /* =====================================================
       ACCOUNT SUMMARY
    ===================================================== */

    .account-header {

        margin-bottom: 18px;

        display: flex;

        align-items: center;

        gap: 12px;
    }


    .account-header .profile-photo {

        width: 65px;
        height: 65px;

        margin: 0;

        flex-shrink: 0;
    }


    .account-info {

        flex: 1;
    }


    .account-name {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    .account-role {

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .status {

        display: inline-block;

        padding:
            5px 9px;

        border-radius: 15px;

        background: #e1f8eb;

        color: #168456;

        font-size: 9px;

        font-weight: 700;
    }


    .status.inactive {

        background: #fff0f0;

        color: #c0392b;
    }


    .info-row {

        padding:
            10px 0;

        display: grid;

        grid-template-columns:
            100px 1fr;

        gap: 10px;

        border-bottom:
            1px solid var(--border);

        font-size: 10px;
    }


    .info-row:last-child {

        border-bottom: none;
    }


    .info-label {

        color:
            var(--text-muted);
    }


    .info-value {

        color:
            var(--text-main);

        font-weight: 600;

        word-break:
            break-word;
    }


    /* =====================================================
       LOGOUT
    ===================================================== */

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


    .btn-logout:hover {

        opacity: .9;
    }


    /* =====================================================
       DARK MODE KHUSUS SETTINGS
    ===================================================== */

    body.dark-mode .profile-photo {

        background: #233747;
    }


    body.dark-mode .slider {

        background: #425767;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1050px) {

        .settings-grid {

            grid-template-columns:
                1fr;
        }


        .password-grid {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 650px) {

        .profile-layout {

            grid-template-columns:
                1fr;
        }


        .form-grid,
        .notification-grid {

            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="breadcrumb">

    <a href="{{ route('client.dashboard') }}">

        {{ ($user->language ?? 'id') === 'en' ? 'Home' : 'Beranda' }}

    </a>

    &nbsp;›&nbsp;

    {{ $st['title'] }}

</div>


{{-- =====================================================
         PAGE TITLE
    ====================================================== --}}

<div class="page-title">

    <h1>

        {{ $st['title'] }}

    </h1>

    <p>

        {{ $st['description'] }}

    </p>

</div>



<div class="settings-grid">


    {{-- =================================================
             LEFT COLUMN
        ================================================== --}}

    <div class="settings-column">


        {{-- =================================================
                 PROFILE
            ================================================== --}}

        <div class="card">


            <div class="card-title">

                👤 {{ $st['profile'] }}

            </div>


            <div
                class="card-subtitle"
                style="margin-top:5px; margin-bottom:18px;">

                {{ $st['profile_description'] }}

            </div>



            <form

                action="{{
                        route(
                            'client.settings.profile'
                        )
                    }}"

                method="POST"

                enctype="multipart/form-data">

                @csrf

                @method('PUT')



                <div class="profile-layout">


                    {{-- PHOTO --}}

                    <div class="profile-photo-box">


                        <div class="profile-photo">

                            @if($user->profile_photo)

                            <img

                                src="{{
                                            asset(
                                                'storage/' .
                                                $user->profile_photo
                                            )
                                        }}"

                                alt="{{ $user->name }}">

                            @else

                            👤

                            @endif

                        </div>



                        <label class="photo-label">

                            {{ $st['change_photo'] }}


                            <input

                                type="file"

                                name="profile_photo"

                                accept="
                                        .jpg,
                                        .jpeg,
                                        .png,
                                        .webp
                                    ">

                        </label>


                    </div>



                    {{-- PROFILE FORM --}}

                    <div>


                        <div class="form-grid">


                            <div class="field">

                                <label>

                                    {{
                                            $st[
                                                'full_name'
                                            ]
                                        }}

                                </label>


                                <input

                                    type="text"

                                    name="name"

                                    value="{{
                                            old(
                                                'name',
                                                $user->name
                                            )
                                        }}"

                                    required>

                            </div>



                            <div class="field">

                                <label>

                                    {{
                                            $st[
                                                'email'
                                            ]
                                        }}

                                </label>


                                <input

                                    type="email"

                                    name="email"

                                    value="{{
                                            old(
                                                'email',
                                                $user->email
                                            )
                                        }}"

                                    required>

                            </div>



                            <div class="field">

                                <label>

                                    {{
                                            $st[
                                                'phone'
                                            ]
                                        }}

                                </label>


                                <input

                                    type="text"

                                    name="phone"

                                    value="{{
                                            old(
                                                'phone',
                                                $user->phone
                                            )
                                        }}">

                            </div>



                            <div class="field">

                                <label>

                                    {{
                                            $st[
                                                'address'
                                            ]
                                        }}

                                </label>


                                <textarea
                                    name="address">{{
                                        old(
                                            'address',
                                            $client->address
                                        )
                                    }}</textarea>

                            </div>


                        </div>



                        <div class="button-row">

                            <button

                                type="submit"

                                class="btn-primary">

                                {{
                                        $st[
                                            'save_changes'
                                        ]
                                    }}

                            </button>

                        </div>


                    </div>


                </div>


            </form>


        </div>



        {{-- =================================================
                 SECURITY
            ================================================== --}}

        <div class="card">


            <div class="card-title">

                🔒 {{ $st['security'] }}

            </div>


            <div
                class="card-subtitle"
                style="margin-top:5px; margin-bottom:18px;">

                {{
                        $st[
                            'security_description'
                        ]
                    }}

            </div>



            <form

                action="{{
                        route(
                            'client.settings.password'
                        )
                    }}"

                method="POST">

                @csrf

                @method('PUT')



                <div class="password-grid">


                    <div class="field">

                        <label>

                            {{
                                    $st[
                                        'current_password'
                                    ]
                                }}

                        </label>


                        <input

                            type="password"

                            name="current_password"

                            placeholder="{{
                                    $st[
                                        'current_password_placeholder'
                                    ]
                                }}"

                            required>

                    </div>



                    <div class="field">

                        <label>

                            {{
                                    $st[
                                        'new_password'
                                    ]
                                }}

                        </label>


                        <input

                            type="password"

                            name="password"

                            placeholder="{{
                                    $st[
                                        'new_password_placeholder'
                                    ]
                                }}"

                            required>

                    </div>



                    <div class="field">

                        <label>

                            {{
                                    $st[
                                        'confirm_password'
                                    ]
                                }}

                        </label>


                        <input

                            type="password"

                            name="password_confirmation"

                            placeholder="{{
                                    $st[
                                        'confirm_password_placeholder'
                                    ]
                                }}"

                            required>

                    </div>


                </div>



                <div class="button-row">

                    <button

                        type="submit"

                        class="btn-primary">

                        {{
                                $st[
                                    'change_password'
                                ]
                            }}

                    </button>

                </div>


            </form>


        </div>



        {{-- =================================================
                 PREFERENCES FORM
            ================================================== --}}

        <form

            action="{{
                    route(
                        'client.settings.preferences'
                    )
                }}"

            method="POST">

            @csrf

            @method('PUT')



            {{-- =============================================
                     NOTIFICATIONS
                ============================================== --}}

            <div class="card">


                <div class="card-title">

                    🔔
                    {{
                            $st[
                                'notification_preferences'
                            ]
                        }}

                </div>


                <div
                    class="card-subtitle"
                    style="margin-top:5px; margin-bottom:18px;">

                    {{
                            $st[
                                'notification_description'
                            ]
                        }}

                </div>



                <div class="notification-grid">


                    {{-- MESSAGE --}}

                    <div class="notification-item">

                        <div>

                            <div class="notification-name">

                                {{
                                        $st[
                                            'message_notification'
                                        ]
                                    }}

                            </div>

                            <div class="notification-text">

                                {{
                                        $st[
                                            'message_notification_desc'
                                        ]
                                    }}

                            </div>

                        </div>


                        <label class="switch">

                            <input

                                type="checkbox"

                                name="notify_messages"

                                value="1"

                                @checked(
                                $user
                                ->notify_messages
                            )

                            >

                            <span
                                class="slider"></span>

                        </label>

                    </div>



                    {{-- PROGRESS --}}

                    <div class="notification-item">

                        <div>

                            <div class="notification-name">

                                {{
                                        $st[
                                            'progress_notification'
                                        ]
                                    }}

                            </div>

                            <div class="notification-text">

                                {{
                                        $st[
                                            'progress_notification_desc'
                                        ]
                                    }}

                            </div>

                        </div>


                        <label class="switch">

                            <input

                                type="checkbox"

                                name="notify_progress"

                                value="1"

                                @checked(
                                $user
                                ->notify_progress
                            )

                            >

                            <span
                                class="slider"></span>

                        </label>

                    </div>



                    {{-- SCHEDULE --}}

                    <div class="notification-item">

                        <div>

                            <div class="notification-name">

                                {{
                                        $st[
                                            'schedule_notification'
                                        ]
                                    }}

                            </div>

                            <div class="notification-text">

                                {{
                                        $st[
                                            'schedule_notification_desc'
                                        ]
                                    }}

                            </div>

                        </div>


                        <label class="switch">

                            <input

                                type="checkbox"

                                name="notify_schedule"

                                value="1"

                                @checked(
                                $user
                                ->notify_schedule
                            )

                            >

                            <span
                                class="slider"></span>

                        </label>

                    </div>



                    {{-- DOCUMENTATION --}}

                    <div class="notification-item">

                        <div>

                            <div class="notification-name">

                                {{
                                        $st[
                                            'documentation_notification'
                                        ]
                                    }}

                            </div>

                            <div class="notification-text">

                                {{
                                        $st[
                                            'documentation_notification_desc'
                                        ]
                                    }}

                            </div>

                        </div>


                        <label class="switch">

                            <input

                                type="checkbox"

                                name="notify_documentation"

                                value="1"

                                @checked(
                                $user
                                ->notify_documentation
                            )

                            >

                            <span
                                class="slider"></span>

                        </label>

                    </div>



                    {{-- COST --}}

                    <div class="notification-item">

                        <div>

                            <div class="notification-name">

                                {{
                                        $st[
                                            'cost_notification'
                                        ]
                                    }}

                            </div>

                            <div class="notification-text">

                                {{
                                        $st[
                                            'cost_notification_desc'
                                        ]
                                    }}

                            </div>

                        </div>


                        <label class="switch">

                            <input

                                type="checkbox"

                                name="notify_cost"

                                value="1"

                                @checked(
                                $user
                                ->notify_cost
                            )

                            >

                            <span
                                class="slider"></span>

                        </label>

                    </div>


                </div>


            </div>



            {{-- =============================================
                     APPLICATION PREFERENCES
                ============================================== --}}

            <div class="card">


                <div class="card-title">

                    ⚙
                    {{
                            $st[
                                'app_preferences'
                            ]
                        }}

                </div>


                <div
                    class="card-subtitle"
                    style="margin-top:5px; margin-bottom:18px;">

                    {{
                            $st[
                                'app_preferences_description'
                            ]
                        }}

                </div>



                <div class="form-grid">


                    {{-- LANGUAGE --}}

                    <div class="field">

                        <label>

                            {{
                                    $st[
                                        'language'
                                    ]
                                }}

                        </label>


                        <select
                            name="language">

                            <option

                                value="id"

                                @selected(
                                $user->language
                                ===
                                'id'
                                )

                                >

                                Bahasa Indonesia

                            </option>


                            <option

                                value="en"

                                @selected(
                                $user->language
                                ===
                                'en'
                                )

                                >

                                English

                            </option>

                        </select>

                    </div>



                    {{-- TIMEZONE --}}

                    <div class="field">

                        <label>

                            {{
                                    $st[
                                        'timezone'
                                    ]
                                }}

                        </label>


                        <select
                            name="timezone">

                            <option

                                value="Asia/Jakarta"

                                @selected(
                                $user->timezone
                                ===
                                'Asia/Jakarta'
                                )

                                >

                                WIB (GMT+7)

                            </option>


                            <option

                                value="Asia/Makassar"

                                @selected(
                                $user->timezone
                                ===
                                'Asia/Makassar'
                                )

                                >

                                WITA (GMT+8)

                            </option>


                            <option

                                value="Asia/Jayapura"

                                @selected(
                                $user->timezone
                                ===
                                'Asia/Jayapura'
                                )

                                >

                                WIT (GMT+9)

                            </option>

                        </select>

                    </div>



                    {{-- THEME --}}

                    <div class="field full">

                        <label>

                            {{
                                    $st[
                                        'appearance'
                                    ]
                                }}

                        </label>


                        <select
                            name="theme">

                            <option

                                value="light"

                                @selected(
                                $user->theme
                                ===
                                'light'
                                )

                                >

                                {{
                                        $st[
                                            'light_mode'
                                        ]
                                    }}

                            </option>


                            <option

                                value="dark"

                                @selected(
                                $user->theme
                                ===
                                'dark'
                                )

                                >

                                {{
                                        $st[
                                            'dark_mode'
                                        ]
                                    }}

                            </option>

                        </select>

                    </div>


                </div>



                <div class="button-row">

                    <button

                        type="submit"

                        class="btn-primary">

                        {{
                                $st[
                                    'save_preferences'
                                ]
                            }}

                    </button>

                </div>


            </div>


        </form>


    </div>



    {{-- =================================================
             RIGHT COLUMN
        ================================================== --}}

    <div class="settings-column">


        {{-- =================================================
                 ACCOUNT SUMMARY
            ================================================== --}}

        <div class="card">


            <div
                class="card-title"
                style="margin-bottom:18px;">

                {{
                        $st[
                            'account_summary'
                        ]
                    }}

            </div>



            <div class="account-header">


                <div class="profile-photo">

                    @if($user->profile_photo)

                    <img

                        src="{{
                                    asset(
                                        'storage/' .
                                        $user->profile_photo
                                    )
                                }}"

                        alt="{{ $user->name }}">

                    @else

                    👤

                    @endif

                </div>



                <div class="account-info">

                    <div class="account-name">

                        {{ $user->name }}

                    </div>


                    <div class="account-role">

                        {{
                                $st[
                                    'client'
                                ]
                            }}

                    </div>

                </div>



                @if($user->is_active)

                <span class="status">

                    {{
                                $st[
                                    'active'
                                ]
                            }}

                </span>

                @else

                <span
                    class="
                                status
                                inactive
                            ">

                    {{
                                $st[
                                    'inactive'
                                ]
                            }}

                </span>

                @endif


            </div>



            {{-- EMAIL --}}

            <div class="info-row">

                <div class="info-label">

                    {{
                            $st[
                                'email'
                            ]
                        }}

                </div>


                <div class="info-value">

                    {{ $user->email }}

                </div>

            </div>



            {{-- PHONE --}}

            <div class="info-row">

                <div class="info-label">

                    {{
                            $st[
                                'phone'
                            ]
                        }}

                </div>


                <div class="info-value">

                    {{
                            $user->phone
                            ??
                            '-'
                        }}

                </div>

            </div>



            {{-- ADDRESS --}}

            <div class="info-row">

                <div class="info-label">

                    {{
                            $st[
                                'address'
                            ]
                        }}

                </div>


                <div class="info-value">

                    {{
                            $client->address
                            ??
                            '-'
                        }}

                </div>

            </div>


        </div>



        {{-- =================================================
                 ACCOUNT ACTION
            ================================================== --}}

        <div class="card">


            <div class="card-title">

                {{
                        $st[
                            'account_action'
                        ]
                    }}

            </div>


            <div
                class="card-subtitle"
                style="margin-top:5px;">

                {{
                        $st[
                            'account_action_description'
                        ]
                    }}

            </div>



            <form

                action="{{ route('logout') }}"

                method="POST"

                class="logout-form">

                @csrf


                <button

                    type="submit"

                    class="btn-logout">

                    {{
                            $st[
                                'logout'
                            ]
                        }}

                </button>


            </form>


        </div>


    </div>


</div>


@endsection