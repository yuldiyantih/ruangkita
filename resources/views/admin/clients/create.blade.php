@extends('layouts.admin')


@section(
'title',
'Tambah Client - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'data_client' =>
'Data Client',

'add_client' =>
'Tambah Client',

'subtitle' =>
'Tambahkan akun client baru ke sistem RuangKita.',

'client_information' =>
'Informasi Client',

'name' =>
'Nama Client',

'email' =>
'Email',

'phone' =>
'No. Telepon',

'password' =>
'Password',

'password_confirmation' =>
'Konfirmasi Password',

'address' =>
'Alamat',

'cancel' =>
'Batal',

'save' =>
'Simpan Client',

'name_placeholder' =>
'Contoh: Bapak Andi',

'email_placeholder' =>
'client@email.com',

'phone_placeholder' =>
'08xxxxxxxxxx',

'password_placeholder' =>
'Minimal 8 karakter',

'password_confirmation_placeholder' =>
'Ulangi password',

'address_placeholder' =>
'Masukkan alamat client',

],


'en' => [

'data_client' =>
'Clients',

'add_client' =>
'Add Client',

'subtitle' =>
'Add a new client account to the RuangKita system.',

'client_information' =>
'Client Information',

'name' =>
'Client Name',

'email' =>
'Email',

'phone' =>
'Phone Number',

'password' =>
'Password',

'password_confirmation' =>
'Confirm Password',

'address' =>
'Address',

'cancel' =>
'Cancel',

'save' =>
'Save Client',

'name_placeholder' =>
'Example: Mr. Andi',

'email_placeholder' =>
'client@email.com',

'phone_placeholder' =>
'08xxxxxxxxxx',

'password_placeholder' =>
'Minimum 8 characters',

'password_confirmation_placeholder' =>
'Repeat password',

'address_placeholder' =>
'Enter client address',

],

];


$ct =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    .client-form-page {

        max-width:
            980px;
    }


    .client-create-header {

        margin-bottom:
            22px;
    }


    .client-create-subtitle {

        max-width:
            620px;
    }
</style>

@endpush



@section('content')


<div class="client-form-page">


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="admin-breadcrumb">


        <a href="{{ route('admin.clients.index') }}">

            {{ $ct['data_client'] }}

        </a>


        <span class="admin-breadcrumb-separator">

            /

        </span>


        <span class="admin-breadcrumb-current">

            {{ $ct['add_client'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header client-create-header">


        <h1 class="admin-page-title">

            {{ $ct['add_client'] }}

        </h1>


        <p class="admin-page-subtitle client-create-subtitle">

            {{ $ct['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.clients.store') }}"
        class="admin-form-card">

        @csrf



        <div class="admin-form-title">

            {{ $ct['client_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- NAME --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="admin-form-control"
                    placeholder="{{ $ct['name_placeholder'] }}"
                    required>


            </div>



            {{-- EMAIL --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['email'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="admin-form-control"
                    placeholder="{{ $ct['email_placeholder'] }}"
                    required>


            </div>



            {{-- PHONE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['phone'] }}

                </label>


                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="admin-form-control"
                    placeholder="{{ $ct['phone_placeholder'] }}">


            </div>



            {{-- PASSWORD --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['password'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="password"
                    name="password"
                    class="admin-form-control"
                    placeholder="{{ $ct['password_placeholder'] }}"
                    required>


            </div>



            {{-- PASSWORD CONFIRMATION --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['password_confirmation'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="password"
                    name="password_confirmation"
                    class="admin-form-control"
                    placeholder="{{ $ct['password_confirmation_placeholder'] }}"
                    required>


            </div>



            {{-- ADDRESS --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $ct['address'] }}

                </label>


                <textarea
                    name="address"
                    class="admin-form-control"
                    placeholder="{{ $ct['address_placeholder'] }}">{{ old('address') }}</textarea>


            </div>


        </div>



        {{-- =================================================
             ACTIONS
        ================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.clients.index') }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $ct['cancel'] }}

            </a>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $ct['save'] }}

            </button>


        </div>


    </form>


</div>


@endsection