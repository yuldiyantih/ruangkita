@extends('layouts.admin')


@section(
'title',
'Tambah Proyek - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'projects' =>
'Data Proyek',

'add_project' =>
'Tambah Proyek',

'subtitle' =>
'Tambahkan proyek renovasi baru ke sistem RuangKita.',

'project_information' =>
'Informasi Proyek',

'client' =>
'Client',

'choose_client' =>
'Pilih Client',

'project_name' =>
'Nama Proyek',

'project_type' =>
'Jenis Proyek',

'location' =>
'Lokasi',

'start_date' =>
'Tanggal Mulai',

'target_end_date' =>
'Target Selesai',

'budget' =>
'Anggaran Proyek',

'status' =>
'Status',

'progress' =>
'Progress Awal',

'description' =>
'Deskripsi',

'cover' =>
'Foto Cover Proyek',

'cover_help' =>
'JPG, JPEG, PNG, atau WEBP. Maksimal 3 MB.',

'cancel' =>
'Batal',

'save' =>
'Simpan Proyek',

],


'en' => [

'projects' =>
'Projects',

'add_project' =>
'Add Project',

'subtitle' =>
'Add a new renovation project to RuangKita.',

'project_information' =>
'Project Information',

'client' =>
'Client',

'choose_client' =>
'Select Client',

'project_name' =>
'Project Name',

'project_type' =>
'Project Type',

'location' =>
'Location',

'start_date' =>
'Start Date',

'target_end_date' =>
'Target Completion',

'budget' =>
'Project Budget',

'status' =>
'Status',

'progress' =>
'Initial Progress',

'description' =>
'Description',

'cover' =>
'Project Cover Photo',

'cover_help' =>
'JPG, JPEG, PNG, or WEBP. Maximum 3 MB.',

'cancel' =>
'Cancel',

'save' =>
'Save Project',

],

];


$ct =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    .project-form-page {

        max-width:
            1050px;
    }


    .project-cover-preview {

        width: 100%;
        max-width: 320px;
        height: 180px;

        margin-top: 10px;

        overflow: hidden;

        border:
            1px dashed var(--border);

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .project-cover-preview img {

        width: 100%;
        height: 100%;

        display: none;

        object-fit: cover;
    }


    .project-help {

        margin-top: 5px;

        color:
            var(--text-muted);

        font-size: 12px;
    }
</style>

@endpush



@section('content')


<div class="project-form-page">


    <div class="admin-breadcrumb">


        <a href="{{ route('admin.projects.index') }}">

            {{ $ct['projects'] }}

        </a>


        <span class="admin-breadcrumb-separator">

            /

        </span>


        <span class="admin-breadcrumb-current">

            {{ $ct['add_project'] }}

        </span>


    </div>



    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $ct['add_project'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $ct['subtitle'] }}

        </p>


    </div>



    <form
        method="POST"
        action="{{ route('admin.projects.store') }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf


        <div class="admin-form-title">

            {{ $ct['project_information'] }}

        </div>



        <div class="admin-form-grid">


            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['client'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="client_id"
                    class="admin-form-control"
                    required>

                    <option value="">

                        {{ $ct['choose_client'] }}

                    </option>


                    @foreach($clients as $client)

                    <option
                        value="{{ $client->id }}"
                        @selected(
                        old('client_id')==$client->id
                        )
                        >

                        {{
                                $client->user->name
                                ??
                                '-'
                            }}

                    </option>

                    @endforeach


                </select>


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['project_name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="project_name"
                    value="{{ old('project_name') }}"
                    class="admin-form-control"
                    placeholder="Contoh: Renovasi Rumah Bapak Andi"
                    required>


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['project_type'] }}

                </label>


                <input
                    type="text"
                    name="project_type"
                    value="{{ old('project_type') }}"
                    class="admin-form-control"
                    placeholder="Contoh: Renovasi Rumah">


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['location'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="location"
                    value="{{ old('location') }}"
                    class="admin-form-control"
                    placeholder="Contoh: Jakarta Selatan"
                    required>


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['start_date'] }}

                </label>


                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    class="admin-form-control">


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['target_end_date'] }}

                </label>


                <input
                    type="date"
                    name="target_end_date"
                    value="{{ old('target_end_date') }}"
                    class="admin-form-control">


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['budget'] }}

                </label>


                <input
                    type="number"
                    name="budget_total"
                    value="{{ old('budget_total') }}"
                    class="admin-form-control"
                    min="0"
                    placeholder="Contoh: 150000000">


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['status'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="status"
                    class="admin-form-control"
                    required>

                    <option
                        value="planning"
                        @selected(
                        old( 'status' , 'planning'
                        )==='planning'
                        )>
                        Perencanaan
                    </option>

                    <option
                        value="ongoing"
                        @selected(
                        old('status')==='ongoing'
                        )>
                        Berjalan
                    </option>

                    <option
                        value="completed"
                        @selected(
                        old('status')==='completed'
                        )>
                        Selesai
                    </option>

                    <option
                        value="paused"
                        @selected(
                        old('status')==='paused'
                        )>
                        Ditunda
                    </option>

                </select>


            </div>



            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $ct['progress'] }}

                </label>


                <input
                    type="number"
                    name="progress_percentage"
                    value="{{
                        old(
                            'progress_percentage',
                            0
                        )
                    }}"
                    class="admin-form-control"
                    min="0"
                    max="100">


            </div>



            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $ct['description'] }}

                </label>


                <textarea
                    name="description"
                    class="admin-form-control"
                    placeholder="Masukkan deskripsi proyek">{{ old('description') }}</textarea>


            </div>



            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $ct['cover'] }}

                </label>


                <input
                    type="file"
                    name="cover_image"
                    id="coverImageInput"
                    class="admin-form-control"
                    accept="
                        image/jpeg,
                        image/png,
                        image/webp
                    ">


                <div class="project-help">

                    {{ $ct['cover_help'] }}

                </div>


                <div class="project-cover-preview">

                    <span id="coverPreviewText">

                        Preview Foto Cover

                    </span>


                    <img
                        id="coverPreviewImage"
                        alt="Preview Cover">

                </div>


            </div>


        </div>



        <div class="admin-form-actions">


            <a
                href="{{ route('admin.projects.index') }}"
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



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const input =
                document.getElementById(
                    'coverImageInput'
                );


            const image =
                document.getElementById(
                    'coverPreviewImage'
                );


            const text =
                document.getElementById(
                    'coverPreviewText'
                );


            if (!input) {

                return;

            }


            input.addEventListener(
                'change',
                function() {

                    const file =
                        input.files[0];


                    if (!file) {

                        image.style.display =
                            'none';

                        image.src =
                            '';

                        text.style.display =
                            'block';

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            image.src =
                                event.target.result;

                            image.style.display =
                                'block';

                            text.style.display =
                                'none';

                        };


                    reader.readAsDataURL(
                        file
                    );

                }
            );

        }
    );
</script>

@endpush