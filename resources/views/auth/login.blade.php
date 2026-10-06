<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - RuangKita</title>

    <style>
        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {
            min-height: 100vh;

            background: #eef4f9;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;
        }


        /* =====================================================
           LOGIN CARD
        ===================================================== */

        .login-card {
            width: 100%;
            max-width: 980px;
            min-height: 580px;

            background: #ffffff;

            border-radius: 22px;

            overflow: hidden;

            display: grid;

            grid-template-columns: 43% 57%;

            box-shadow:
                0 20px 50px rgba(12, 46, 77, 0.14);
        }


        /* =====================================================
           LEFT PANEL - FOTO RUMAH
        ===================================================== */

        .left-panel {
            position: relative;

            /*
             * Foto rumah images 1.jpg
             *
             * Gradasi:
             * atas   = sangat transparan
             * tengah = mulai gelap
             * bawah  = gelap untuk teks putih
             */

            background-image:
                linear-gradient(to bottom,
                    rgba(7, 30, 54, 0.03) 0%,
                    rgba(7, 30, 54, 0.08) 28%,
                    rgba(7, 30, 54, 0.20) 50%,
                    rgba(7, 30, 54, 0.52) 72%,
                    rgba(5, 25, 45, 0.86) 90%,
                    rgba(5, 25, 45, 0.94) 100%),
                url('/images/images 1.jpg');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            color: white;

            padding: 42px 38px;

            display: flex;

            align-items: center;
            justify-content: center;
        }


        /* =====================================================
           BRAND AREA
        ===================================================== */

        .brand-box {
            position: relative;
            z-index: 2;

            width: 100%;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            text-align: center;
        }

        /* =====================================================
           LOGO
        ===================================================== */

        .logo-symbol {
            position: relative;

            width: 72px;
            height: 72px;

            margin: 0 auto 14px auto;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        /* ATAP */
        .logo-symbol .roof {
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
        .logo-symbol .house-body {
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
        .logo-symbol .door {
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


        /* =====================================================
           BRAND NAME
        ===================================================== */

        .brand-name {
            font-size: 35px;

            line-height: 1.1;

            font-weight: 700;

            letter-spacing: -0.5px;

            margin-bottom: 9px;

            color: #ffffff;
        }


        /* =====================================================
           BRAND TAGLINE
        ===================================================== */

        .brand-tagline {
            font-size: 15px;

            line-height: 1.55;

            color: #edf6ff;

            text-shadow:
                0 1px 5px rgba(0, 0, 0, 0.25);
        }


        /* =====================================================
           RIGHT PANEL
        ===================================================== */

        .right-panel {
            padding: 55px 65px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;
        }


        /* =====================================================
           FORM WRAPPER
        ===================================================== */

        .form-wrapper {
            width: 100%;

            max-width: 390px;
        }


        /* =====================================================
           TITLE
        ===================================================== */

        .form-wrapper h1 {
            color: #102a43;

            font-size: 32px;

            line-height: 1.16;

            font-weight: 700;

            letter-spacing: -0.5px;

            margin-bottom: 8px;
        }


        /* =====================================================
           SUBTITLE
        ===================================================== */

        .subtitle {
            color: #7b8fa5;

            font-size: 14px;

            line-height: 1.5;

            margin-bottom: 30px;
        }


        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .success-message {
            background: #ecfdf3;

            color: #027a48;

            border: 1px solid #abefc6;

            border-radius: 9px;

            padding: 12px 13px;

            margin-bottom: 18px;

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

            padding: 12px 13px;

            margin-bottom: 18px;

            font-size: 13px;

            line-height: 1.4;
        }


        /* =====================================================
           FORM GROUP
        ===================================================== */

        .form-group {
            margin-bottom: 18px;
        }


        /* =====================================================
           LABEL
        ===================================================== */

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #334e68;

            font-size: 13px;

            font-weight: 600;
        }


        /* =====================================================
           INPUT
        ===================================================== */

        .form-group input {
            width: 100%;

            height: 47px;

            padding: 0 14px;

            border: 1px solid #d7e2eb;

            border-radius: 9px;

            outline: none;

            background: #ffffff;

            color: #253b50;

            font-size: 14px;

            transition: all 0.2s ease;
        }


        .form-group input::placeholder {
            color: #a2b1bf;
        }


        .form-group input:hover {
            border-color: #c2d3e0;
        }


        .form-group input:focus {
            border-color: #0b63a9;

            box-shadow:
                0 0 0 3px rgba(11, 99, 169, 0.08);
        }


        /* =====================================================
           FORGOT PASSWORD
        ===================================================== */

        .forgot {
            text-align: right;

            margin-top: -7px;

            margin-bottom: 18px;
        }


        .forgot a {
            color: #1573bd;

            font-size: 12px;

            text-decoration: none;
        }


        .forgot a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           LOGIN BUTTON
        ===================================================== */

        .btn-login {
            width: 100%;

            height: 47px;

            border: none;

            border-radius: 9px;

            background:
                linear-gradient(90deg,
                    #0b5798,
                    #0777c9);

            color: #ffffff;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow:
                0 9px 20px rgba(11, 87, 152, 0.22);
        }


        .btn-login:active {
            transform: translateY(0);
        }


        /* =====================================================
           SEPARATOR
        ===================================================== */

        .separator {
            display: flex;

            align-items: center;

            gap: 12px;

            margin: 22px 0;

            color: #9aabba;

            font-size: 12px;
        }


        .separator::before,
        .separator::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #e1e9f0;
        }


        /* =====================================================
           REGISTER BUTTON
        ===================================================== */

        .btn-register {
            width: 100%;

            height: 47px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #c7d8e6;

            border-radius: 9px;

            background: #ffffff;

            color: #0e568f;

            font-size: 14px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .btn-register:hover {
            background: #f5faff;

            border-color: #a9c5da;
        }


        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (max-width: 800px) {

            body {
                padding: 20px;
            }

            .login-card {
                grid-template-columns: 1fr;

                max-width: 500px;
            }

            .left-panel {
                min-height: 330px;

                padding: 35px 30px;
            }

            .right-panel {
                padding: 40px 30px;
            }
        }


        /* =====================================================
           RESPONSIVE MOBILE
        ===================================================== */

        @media (max-width: 500px) {

            body {
                padding: 12px;
            }

            .login-card {
                border-radius: 16px;
            }

            .left-panel {
                min-height: 280px;

                padding: 28px 25px;
            }

            .right-panel {
                padding: 35px 23px;
            }

            .logo-symbol {
                width: 56px;
                height: 56px;

                font-size: 27px;

                border-radius: 15px;
            }

            .brand-name {
                font-size: 30px;
            }

            .brand-tagline {
                font-size: 14px;
            }

            .form-wrapper h1 {
                font-size: 28px;
            }
        }
    </style>
</head>


<body>

    <!-- =====================================================
         LOGIN CARD
    ====================================================== -->

    <div class="login-card">


        <!-- =================================================
             LEFT PANEL
        ================================================== -->

        <div class="left-panel">

            <div class="brand-box">

                <div class="logo-symbol">
                    <div class="roof"></div>

                    <div class="house-body">
                        <div class="door"></div>
                    </div>
                </div>

                <div class="brand-name">
                    RuangKita
                </div>

                <div class="brand-tagline">
                    Kelola Proyek Renovasi<br>
                    dengan Lebih Mudah
                </div>

            </div>
        </div>


        <!-- =================================================
             RIGHT PANEL
        ================================================== -->

        <div class="right-panel">

            <div class="form-wrapper">


                <!-- =============================================
                     TITLE
                ============================================== -->

                <h1>
                    Selamat Datang<br>
                    di RuangKita
                </h1>

                <div class="subtitle">
                    Masuk untuk melanjutkan
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
                    {{ $errors->first() }}
                </div>

                @endif


                <!-- =============================================
                     LOGIN FORM
                ============================================== -->

                <form
                    action="{{ route('login.store') }}"
                    method="POST">

                    @csrf


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


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required>

                    </div>


                    <!-- FORGOT PASSWORD -->

                    <div class="forgot">

                        <a href="#">
                            Lupa password?
                        </a>

                    </div>


                    <!-- LOGIN -->

                    <button
                        type="submit"
                        class="btn-login">

                        Masuk

                    </button>

                </form>


                <!-- =============================================
                     SEPARATOR
                ============================================== -->

                <div class="separator">
                    atau
                </div>


                <!-- =============================================
                     REGISTER
                ============================================== -->

                <a
                    href="{{ url('/register') }}"
                    class="btn-register">

                    Daftar Akun Baru

                </a>


            </div>

        </div>

    </div>

</body>

</html>