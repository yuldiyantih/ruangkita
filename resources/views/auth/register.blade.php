```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Daftar Client - RuangKita</title>

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


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                linear-gradient(rgba(5, 28, 50, 0.28),
                    rgba(5, 28, 50, 0.72)),

                url('/images/images 1.jpg');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            background-attachment: fixed;


            display: flex;

            align-items: center;

            justify-content: center;


            padding: 30px 20px;

        }


        /* =====================================================
           BACKGROUND OVERLAY
        ===================================================== */

        body::before {

            content: "";

            position: fixed;

            inset: 0;

            background:

                linear-gradient(135deg,
                    rgba(7, 40, 70, 0.20),
                    rgba(4, 27, 48, 0.45));

            z-index: 0;

            pointer-events: none;

        }


        /* =====================================================
           REGISTER CONTAINER
        ===================================================== */

        .register-container {

            position: relative;

            z-index: 1;


            width: 100%;

            max-width: 440px;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .brand {

            text-align: center;

            color: white;

            margin-bottom: 16px;

        }


        .logo {

            position: relative;

            width: 72px;
            height: 72px;

            margin: 0 auto 14px;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        /* ATAP */

        .logo .roof {

            position: absolute;

            width: 42px;
            height: 42px;

            border-left: 7px solid #ffffff;
            border-top: 7px solid #ffffff;

            transform: rotate(45deg);

            top: 10px;

            border-radius: 3px;

        }


        /* BADAN RUMAH */

        .logo .house-body {

            position: absolute;

            width: 38px;
            height: 35px;

            border-left: 7px solid #ffffff;
            border-right: 7px solid #ffffff;
            border-bottom: 7px solid #ffffff;

            bottom: 8px;

            border-radius: 0 0 3px 3px;

        }


        /* PINTU */

        .logo .door {

            position: absolute;

            width: 12px;
            height: 18px;

            border: 4px solid #ffffff;
            border-bottom: none;

            left: 50%;
            bottom: 0;

            transform: translateX(-50%);

            border-radius: 2px 2px 0 0;

        }


        .brand-name {

            font-size: 28px;

            font-weight: 700;

            letter-spacing: -0.4px;

            margin-bottom: 3px;

        }


        .brand-subtitle {

            font-size: 12px;

            color: #e9f3fa;

        }


        /* =====================================================
           REGISTER CARD
        ===================================================== */

        .register-card {

            width: 100%;


            background:
                rgba(255, 255, 255, 0.97);


            border-radius: 20px;


            padding: 28px 34px 25px;


            box-shadow:

                0 25px 60px rgba(0, 0, 0, 0.28);


            backdrop-filter: blur(5px);

        }


        /* =====================================================
           TITLE
        ===================================================== */

        .register-title {

            text-align: center;

            color: #102a43;


            font-size: 25px;

            font-weight: 700;


            margin-bottom: 5px;

        }


        .register-description {

            text-align: center;

            color: #7b8fa5;


            font-size: 13px;

            line-height: 1.5;


            margin-bottom: 22px;

        }


        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .success-message {

            background: #ecfdf3;

            color: #027a48;

            border: 1px solid #abefc6;


            border-radius: 9px;


            padding: 11px 12px;


            margin-bottom: 16px;


            font-size: 13px;

            line-height: 1.4;

        }


        /* =====================================================
           ERROR MESSAGE
        ===================================================== */

        .error-message {

            background: #fff1f1;

            color: #b42318;

            border: 1px solid #ffc9c9;


            border-radius: 9px;


            padding: 11px 12px;


            margin-bottom: 16px;


            font-size: 13px;

            line-height: 1.5;

        }


        .error-message ul {

            margin: 0;

            padding-left: 18px;

        }


        .error-message li {

            margin-bottom: 3px;

        }


        .error-message li:last-child {

            margin-bottom: 0;

        }


        /* =====================================================
           FORM GROUP
        ===================================================== */

        .form-group {

            margin-bottom: 14px;

        }


        /* =====================================================
           LABEL
        ===================================================== */

        .form-group label {

            display: block;


            margin-bottom: 6px;


            color: #334e68;


            font-size: 13px;

            font-weight: 600;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .form-group input {

            width: 100%;


            height: 43px;


            padding: 0 13px;


            border:

                1px solid #d7e2eb;


            border-radius: 8px;


            background: #ffffff;


            color: #253b50;


            outline: none;


            font-size: 13px;


            transition: all 0.2s ease;

        }


        .form-group input::placeholder {

            color: #a2b1bf;

        }


        .form-group input:hover {

            border-color: #bfd1df;

        }


        .form-group input:focus {

            border-color: #0b63a9;


            box-shadow:

                0 0 0 3px rgba(11, 99, 169, 0.08);

        }


        /* =====================================================
           REGISTER BUTTON
        ===================================================== */

        .btn-register {

            width: 100%;


            height: 45px;


            margin-top: 4px;


            border: none;


            border-radius: 8px;


            background:

                linear-gradient(90deg,
                    #0b5798,
                    #0777c9);


            color: white;


            font-size: 14px;

            font-weight: 600;


            cursor: pointer;


            transition: all 0.2s ease;

        }


        .btn-register:hover {

            transform: translateY(-1px);


            box-shadow:

                0 9px 20px rgba(11, 87, 152, 0.22);

        }


        .btn-register:active {

            transform: translateY(0);

        }


        /* =====================================================
           LOGIN LINK
        ===================================================== */

        .login-link {

            text-align: center;


            margin-top: 17px;


            color: #7b8fa5;


            font-size: 12px;

        }


        .login-link a {

            color: #1573bd;


            font-weight: 600;


            text-decoration: none;

        }


        .login-link a:hover {

            text-decoration: underline;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 500px) {

            body {

                padding: 20px 14px;

                background-position: center;

            }


            .register-container {

                max-width: 400px;

            }


            .logo {

                width: 56px;
                height: 56px;

            }


            .logo .roof {

                width: 34px;
                height: 34px;

                border-left-width: 6px;
                border-top-width: 6px;

                top: 8px;

            }


            .logo .house-body {

                width: 32px;
                height: 29px;

                border-left-width: 6px;
                border-right-width: 6px;
                border-bottom-width: 6px;

                bottom: 6px;

            }


            .logo .door {

                width: 10px;
                height: 15px;

                border-width: 3px;
                border-bottom: none;

            }


            .brand-name {

                font-size: 25px;

            }


            .register-card {

                padding:

                    24px 22px 22px;

                border-radius: 17px;

            }


            .register-title {

                font-size: 23px;

            }


            .form-group input {

                height: 44px;

            }

        }
    </style>

</head>


<body>


    <!-- =====================================================
         REGISTER CONTAINER
    ====================================================== -->

    <div class="register-container">


        <!-- =================================================
             BRAND / LOGO
        ================================================== -->

        <div class="brand">

            <div class="logo">

                <div class="roof"></div>

                <div class="house-body">

                    <div class="door"></div>

                </div>

            </div>


            <div class="brand-name">

                RuangKita

            </div>


            <div class="brand-subtitle">

                Kelola Proyek Renovasi dengan Lebih Mudah

            </div>

        </div>


        <!-- =================================================
             REGISTER CARD
        ================================================== -->

        <div class="register-card">


            <div class="register-title">

                Buat Akun Client

            </div>


            <div class="register-description">

                Daftar untuk mulai mengelola proyek

                renovasi Anda bersama RuangKita

            </div>


            <!-- =============================================
                 SUCCESS MESSAGE
            ============================================== -->

            @if (session('success'))

            <div class="success-message">

                {{ session('success') }}

            </div>

            @endif


            <!-- =============================================
                 ERROR MESSAGE
            ============================================== -->

            @if ($errors->any())

            <div class="error-message">

                <ul>

                    @foreach ($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                    @endforeach

                </ul>

            </div>

            @endif


            <!-- =============================================
                 REGISTER FORM
            ============================================== -->

            <form
                action="{{ route('register.store') }}"
                method="POST">

                @csrf


                <!-- NAMA LENGKAP -->

                <div class="form-group">

                    <label for="name">

                        Nama Lengkap

                    </label>


                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required>

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">

                        Email

                    </label>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="email"
                        required>

                </div>


                <!-- NO TELEPON -->

                <div class="form-group">

                    <label for="phone">

                        No. Telepon

                    </label>


                    <input
                        id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        autocomplete="tel"
                        required>

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">

                        Password

                    </label>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        required>

                </div>


                <!-- KONFIRMASI PASSWORD -->

                <div class="form-group">

                    <label for="password_confirmation">

                        Konfirmasi Password

                    </label>


                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required>

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="btn-register">

                    Daftar

                </button>

            </form>


            <!-- =================================================
                 LOGIN LINK
            ================================================== -->

            <div class="login-link">

                Sudah punya akun?

                <a href="{{ url('/login') }}">

                    Masuk

                </a>

            </div>


        </div>

    </div>


</body>

</html>
```