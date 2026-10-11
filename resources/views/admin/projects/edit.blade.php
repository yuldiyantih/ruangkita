@extends('layouts.admin')


@section(
'title',
'Edit Proyek - RuangKita'
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

'detail_project' =>
'Detail Proyek',

'edit_project' =>
'Edit Proyek',

'subtitle' =>
'Perbarui informasi proyek yang terdaftar di RuangKita.',

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
'Progress',

'description' =>
'Deskripsi',

'cover' =>
'Foto Cover Proyek',

'current_cover' =>
'Foto Cover Saat Ini',

'change_cover' =>
'Pilih foto baru jika ingin mengganti cover.',

'cover_help' =>
'JPG, JPEG, PNG, atau WEBP. Maksimal 3 MB.',

'cancel' =>
'Batal',

'save' =>
'Simpan Perubahan',

'planning' =>
'Perencanaan',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'paused' =>
'Ditunda',

],


'en' => [

'projects' =>
'Projects',

'detail_project' =>
'Project Detail',

'edit_project' =>
'Edit Project',

'subtitle' =>
'Update project information registered in RuangKita.',

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
'Progress',

'description' =>
'Description',

'cover' =>
'Project Cover Photo',

'current_cover' =>
'Current Cover Photo',

'change_cover' =>
'Choose a new photo only if you want to replace the current cover.',

'cover_help' =>
'JPG, JPEG, PNG, or WEBP. Maximum 3 MB.',

'cancel' =>
'Cancel',

'save' =>
'Save Changes',

'planning' =>
'Planning',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'paused' =>
'Paused',

],

];


$et =
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


    .project-cover-current {

        width: 100%;
        max-width: 320px;
        height: 180px;

        margin-top: 10px;

        overflow: hidden;

        border:
            1px solid var(--border);

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


    .project-cover-current img {

        width: 100%;
        height: 100%;

        object-fit: cover;
    }


    .project-help {

        margin-top: 5px;

        color:
            var(--text-muted);

        font-size: 12px;
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

        display: none;

        background:
            var(--input-bg);
    }


    .project-cover-preview img {

        width: 100%;
        height: 100%;

        object-fit: cover;
    }
</style>

@endpush



@section('content')


<div class="project-form-page">


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="admin-breadcrumb">


        <a href="{{ route('admin.projects.index') }}">

            {{ $et['projects'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <a
            href="{{
                route(
                    'admin.projects.show',
                    $project
                )
            }}">

            {{ $et['detail_project'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $et['edit_project'] }}

        </span>


    </div>



    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $et['edit_project'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $et['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{
            route(
                'admin.projects.update',
                $project
            )
        }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf
        @method('PUT')


        <div class="admin-form-title">

            {{ $et['project_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- CLIENT --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['client'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="client_id"
                    class="admin-form-control"
                    required>

                    <option value="">

                        {{ $et['choose_client'] }}

                    </option>


                    @foreach($clients as $client)

                    <option
                        value="{{ $client->id }}"
                        @selected(
                        old( 'client_id' ,
                        $project->client_id
                        )
                        ==
                        $client->id
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



            {{-- PROJECT NAME --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['project_name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="project_name"
                    value="{{
                        old(
                            'project_name',
                            $project->project_name
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- PROJECT TYPE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['project_type'] }}

                </label>


                <input
                    type="text"
                    name="project_type"
                    value="{{
                        old(
                            'project_type',
                            $project->project_type
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- LOCATION --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['location'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="location"
                    value="{{
                        old(
                            'location',
                            $project->location
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- START DATE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['start_date'] }}

                </label>


                <input
                    type="date"
                    name="start_date"
                    value="{{
                        old(
                            'start_date',
                            $project->start_date
                                ? \Carbon\Carbon::parse(
                                    $project->start_date
                                )->format('Y-m-d')
                                : ''
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- TARGET END DATE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['target_end_date'] }}

                </label>


                <input
                    type="date"
                    name="target_end_date"
                    value="{{
                        old(
                            'target_end_date',
                            $project->target_end_date
                                ? \Carbon\Carbon::parse(
                                    $project->target_end_date
                                )->format('Y-m-d')
                                : ''
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- BUDGET --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['budget'] }}

                </label>


                <input
                    type="number"
                    name="budget_total"
                    value="{{
                        old(
                            'budget_total',
                            $project->budget_total
                            ??
                            0
                        )
                    }}"
                    class="admin-form-control"
                    min="0">


            </div>



            {{-- STATUS --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['status'] }}

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
                        old( 'status' ,
                        $project->status
                        )
                        ===
                        'planning'
                        )
                        >
                        {{ $et['planning'] }}
                    </option>

                    <option
                        value="ongoing"
                        @selected(
                        old( 'status' ,
                        $project->status
                        )
                        ===
                        'ongoing'
                        )
                        >
                        {{ $et['ongoing'] }}
                    </option>

                    <option
                        value="completed"
                        @selected(
                        old( 'status' ,
                        $project->status
                        )
                        ===
                        'completed'
                        )
                        >
                        {{ $et['completed'] }}
                    </option>

                    <option
                        value="paused"
                        @selected(
                        old( 'status' ,
                        $project->status
                        )
                        ===
                        'paused'
                        )
                        >
                        {{ $et['paused'] }}
                    </option>

                </select>


            </div>



            {{-- PROGRESS --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['progress'] }}

                </label>


                <input
                    type="number"
                    name="progress_percentage"
                    value="{{
                        old(
                            'progress_percentage',
                            $project->progress_percentage
                            ??
                            0
                        )
                    }}"
                    class="admin-form-control"
                    min="0"
                    max="100">


            </div>



            {{-- DESCRIPTION --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $et['description'] }}

                </label>


                <textarea
                    name="description"
                    class="admin-form-control">{{ old('description', $project->description ?? '') }}</textarea>


            </div>



            {{-- COVER IMAGE --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $et['cover'] }}

                </label>



                @if($project->cover_image)

                <div class="project-help">

                    {{ $et['current_cover'] }}

                </div>


                <div class="project-cover-current">

                    <img
                        src="{{
                                asset(
                                    'storage/' .
                                    $project->cover_image
                                )
                            }}"
                        alt="{{
                                $project->project_name
                            }}">

                </div>

                @endif



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

                    {{ $et['change_cover'] }}

                    <br>

                    {{ $et['cover_help'] }}

                </div>



                <div
                    class="project-cover-preview"
                    id="coverPreviewBox">

                    <img
                        id="coverPreviewImage"
                        alt="Preview Cover">

                </div>


            </div>


        </div>



        {{-- =================================================
             ACTIONS
        ================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{
                    route(
                        'admin.projects.show',
                        $project
                    )
                }}"
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



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const input =
                document.getElementById(
                    'coverImageInput'
                );


            const previewBox =
                document.getElementById(
                    'coverPreviewBox'
                );


            const previewImage =
                document.getElementById(
                    'coverPreviewImage'
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

                        previewBox.style.display =
                            'none';

                        previewImage.src =
                            '';

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            previewImage.src =
                                event.target.result;

                            previewBox.style.display =
                                'block';

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