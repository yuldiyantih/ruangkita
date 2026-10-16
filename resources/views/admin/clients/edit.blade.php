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
'Edit Client',

'data_client' =>
'Data Client',

'detail_client' =>
'Detail Client',

'edit_client' =>
'Edit Client',

'subtitle' =>
'Perbarui informasi client yang terdaftar di RuangKita.',

'client_information' =>
'Informasi Client',

'name' =>
'Nama Client',

'email' =>
'Email',

'phone' =>
'No. Telepon',

'address' =>
'Alamat',

'cancel' =>
'Batal',

'save' =>
'Simpan Perubahan',

'phone_placeholder' =>
'08xxxxxxxxxx',

'address_placeholder' =>
'Masukkan alamat client',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Edit Client',

'data_client' =>
'Clients',

'detail_client' =>
'Client Detail',

'edit_client' =>
'Edit Client',

'subtitle' =>
'Update the client information registered in RuangKita.',

'client_information' =>
'Client Information',

'name' =>
'Client Name',

'email' =>
'Email',

'phone' =>
'Phone Number',

'address' =>
'Address',

'cancel' =>
'Cancel',

'save' =>
'Save Changes',

'phone_placeholder' =>
'08xxxxxxxxxx',

'address_placeholder' =>
'Enter client address',

],

];


$et =
$translations[$pageLang]
??
$translations['id'];

@endphp



@section(
'title',
$et['page_title'] . ' - RuangKita'
)



@push('styles')

<style>
    .client-form-page {
        max-width: 980px;
    }


    .client-edit-header {
        margin-bottom: 22px;
    }


    .client-edit-subtitle {
        max-width: 620px;
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

            {{ $et['data_client'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <a href="{{ route('admin.clients.show', $client) }}">

            {{ $et['detail_client'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $et['edit_client'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header client-edit-header">


        <h1 class="admin-page-title">

            {{ $et['edit_client'] }}

        </h1>


        <p class="admin-page-subtitle client-edit-subtitle">

            {{ $et['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.clients.update', $client) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')



        <div class="admin-form-title">

            {{ $et['client_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- =================================================
                 NAME
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="name"
                    value="{{
                        old(
                            'name',
                            $client->user->name
                            ??
                            ''
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 EMAIL
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['email'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="email"
                    name="email"
                    value="{{
                        old(
                            'email',
                            $client->user->email
                            ??
                            ''
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 PHONE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['phone'] }}

                </label>


                <input
                    type="text"
                    name="phone"
                    value="{{
                        old(
                            'phone',
                            $client->user->phone
                            ??
                            ''
                        )
                    }}"
                    class="admin-form-control"
                    placeholder="{{ $et['phone_placeholder'] }}">


            </div>



            {{-- =================================================
                 ADDRESS
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $et['address'] }}

                </label>


                <textarea
                    name="address"
                    class="admin-form-control"
                    placeholder="{{ $et['address_placeholder'] }}">{{ old('address', $client->address ?? '') }}</textarea>


            </div>


        </div>



        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.clients.show', $client) }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $et['cancel'] }}

            </a>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $et['save'] }}

            </button>


        </div>


    </form>


</div>


@endsection