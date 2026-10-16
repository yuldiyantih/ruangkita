@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' => 'Edit Progress',

'dashboard' => 'Dashboard',

'progress' => 'Progress',

'edit' => 'Edit',

'edit_progress' => 'Edit Progress',

'subtitle' =>
'Perbarui data perkembangan proyek.',

'progress_information' =>
'Informasi Progress',

'project' => 'Proyek',

'update_date' => 'Tanggal Update',

'percentage' => 'Progress (%)',

'completed_text' => 'selesai',

'progress_notes' =>
'Catatan Progress',

'current_photo' =>
'Foto Saat Ini',

'progress_photo_alt' =>
'Foto Progress',

'replace_photo' =>
'Ganti Foto',

'replace_photo_help' =>
'Kosongkan jika foto tidak ingin diganti.',

'back' => 'Kembali',

'save' => 'Simpan Perubahan',

],


'en' => [

'page_title' => 'Edit Progress',

'dashboard' => 'Dashboard',

'progress' => 'Progress',

'edit' => 'Edit',

'edit_progress' => 'Edit Progress',

'subtitle' =>
'Update the project progress information.',

'progress_information' =>
'Progress Information',

'project' => 'Project',

'update_date' => 'Update Date',

'percentage' => 'Progress (%)',

'completed_text' => 'completed',

'progress_notes' =>
'Progress Notes',

'current_photo' =>
'Current Photo',

'progress_photo_alt' =>
'Progress Photo',

'replace_photo' =>
'Replace Photo',

'replace_photo_help' =>
'Leave blank if you do not want to replace the photo.',

'back' => 'Back',

'save' => 'Save Changes',

],

];


$pt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@section(
'title',
$pt['page_title'] . ' - RuangKita'
)


@push('styles')

<style>
    .progress-edit-wrapper {

        max-width: 900px;
    }


    .progress-edit-card {

        overflow: hidden;
    }


    .progress-edit-header {

        padding: 18px 20px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .progress-edit-body {

        padding: 20px;
    }


    .progress-edit-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 18px;
    }


    .progress-edit-group {

        display: flex;

        flex-direction: column;

        gap: 7px;
    }


    .progress-edit-group.full {

        grid-column:
            1 / -1;
    }


    .progress-edit-group label {

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .progress-edit-group input,
    .progress-edit-group select,
    .progress-edit-group textarea {

        width: 100%;

        padding: 11px 12px;

        border:
            1px solid var(--border);

        border-radius: 8px;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        outline: none;
    }


    .progress-edit-group textarea {

        min-height: 120px;

        resize: vertical;
    }


    .progress-edit-group input:focus,
    .progress-edit-group select:focus,
    .progress-edit-group textarea:focus {

        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .progress-edit-preview {

        margin-top: 5px;
    }


    .progress-edit-track {

        height: 10px;

        border-radius: 10px;

        overflow: hidden;

        background:
            #e7edf3;
    }


    .progress-edit-fill {

        height: 100%;

        border-radius: 10px;

        background:
            var(--primary);

        transition:
            width .2s ease;
    }


    .progress-edit-text {

        margin-top: 5px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .progress-current-photo {

        width: 180px;

        height: 120px;

        object-fit: cover;

        border-radius: 10px;

        border:
            1px solid var(--border);
    }


    .progress-edit-footer {

        margin-top: 22px;

        display: flex;

        justify-content:
            flex-end;

        gap: 8px;
    }


    .progress-edit-btn {

        min-height: 42px;

        padding:
            0 16px;

        border: none;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        cursor: pointer;

        font-size: 12px;

        font-weight: 700;
    }


    .progress-edit-btn.back {

        background:
            #eef3f7;

        color:
            var(--text-main);
    }


    .progress-edit-btn.save {

        background:
            var(--primary);

        color: #fff;
    }


    .progress-edit-error {

        color:
            var(--danger);

        font-size: 11px;
    }


    @media(max-width:700px) {

        .progress-edit-grid {

            grid-template-columns:
                1fr;
        }


        .progress-edit-group.full {

            grid-column:
                auto;
        }


        .progress-edit-footer {

            flex-direction:
                column;
        }


        .progress-edit-btn {

            width: 100%;
        }

    }
</style>

@endpush



@section('content')


<div class="progress-edit-wrapper">


    <div class="admin-breadcrumb">

        <a href="{{ route('admin.dashboard') }}">
            {{ $pt['dashboard'] }}
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <a href="{{ route('admin.progress.index') }}">
            {{ $pt['progress'] }}
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <span class="admin-breadcrumb-current">
            {{ $pt['edit'] }}
        </span>

    </div>


    <h1 class="admin-page-title">

        {{ $pt['edit_progress'] }}

    </h1>


    <p class="admin-page-subtitle">

        {{ $pt['subtitle'] }}

    </p>


    <div
        class="admin-card progress-edit-card"
        style="margin-top:20px;">


        <div class="progress-edit-header">

            {{ $pt['progress_information'] }}

        </div>


        <div class="progress-edit-body">


            <form
                method="POST"
                action="{{ route('admin.progress.update', $progressUpdate) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <div class="progress-edit-grid">


                    {{-- PROJECT --}}

                    <div class="progress-edit-group">

                        <label>

                            {{ $pt['project'] }} *

                        </label>


                        <select
                            name="project_id"
                            required>

                            @foreach($projects as $project)

                            <option
                                value="{{ $project->id }}"
                                @selected(
                                old( 'project_id' ,
                                $progressUpdate->project_id
                                ) == $project->id
                                )>

                                {{ $project->project_name }}

                            </option>

                            @endforeach

                        </select>


                        @error('project_id')

                        <div class="progress-edit-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- DATE --}}

                    <div class="progress-edit-group">

                        <label>

                            {{ $pt['update_date'] }} *

                        </label>


                        <input
                            type="date"
                            name="update_date"
                            value="{{
                                old(
                                    'update_date',
                                    optional(
                                        $progressUpdate->update_date
                                    )->format('Y-m-d')
                                )
                            }}"
                            required>


                        @error('update_date')

                        <div class="progress-edit-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- PERCENTAGE --}}

                    <div class="progress-edit-group full">

                        <label>

                            {{ $pt['percentage'] }} *

                        </label>


                        <input
                            id="percentageInput"
                            type="number"
                            name="percentage"
                            min="0"
                            max="100"
                            value="{{
                                old(
                                    'percentage',
                                    $progressUpdate->percentage
                                )
                            }}"
                            required>


                        <div class="progress-edit-preview">

                            <div class="progress-edit-track">

                                <div
                                    id="percentageBar"
                                    class="progress-edit-fill">
                                </div>

                            </div>


                            <div
                                id="percentageText"
                                class="progress-edit-text"
                                data-completed-text="{{ $pt['completed_text'] }}">
                            </div>

                        </div>


                        @error('percentage')

                        <div class="progress-edit-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- DESCRIPTION --}}

                    <div class="progress-edit-group full">

                        <label>

                            {{ $pt['progress_notes'] }}

                        </label>


                        <textarea
                            name="description">{{ old('description', $progressUpdate->description) }}</textarea>


                        @error('description')

                        <div class="progress-edit-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- CURRENT PHOTO --}}

                    @if($progressUpdate->photo_path)

                    <div class="progress-edit-group full">

                        <label>

                            {{ $pt['current_photo'] }}

                        </label>


                        <a
                            href="{{ asset('storage/' . $progressUpdate->photo_path) }}"
                            target="_blank">

                            <img
                                src="{{ asset('storage/' . $progressUpdate->photo_path) }}"
                                class="progress-current-photo"
                                alt="{{ $pt['progress_photo_alt'] }}">

                        </a>

                    </div>

                    @endif



                    {{-- PHOTO --}}

                    <div class="progress-edit-group full">

                        <label>

                            {{ $pt['replace_photo'] }}

                        </label>


                        <input
                            type="file"
                            name="photo"
                            accept="image/jpeg,image/png,image/webp">


                        <div
                            style="
                                color:var(--text-muted);
                                font-size:11px;
                            ">

                            {{ $pt['replace_photo_help'] }}

                        </div>


                        @error('photo')

                        <div class="progress-edit-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                </div>


                <div class="progress-edit-footer">

                    <a
                        href="{{ route('admin.progress.show', $progressUpdate) }}"
                        class="progress-edit-btn back">

                        ← {{ $pt['back'] }}

                    </a>


                    <button
                        type="submit"
                        class="progress-edit-btn save">

                        {{ $pt['save'] }}

                    </button>

                </div>


            </form>


        </div>


    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const input =
                document.getElementById(
                    'percentageInput'
                );

            const bar =
                document.getElementById(
                    'percentageBar'
                );

            const text =
                document.getElementById(
                    'percentageText'
                );

            const completedText =
                text.dataset.completedText;


            function updatePreview() {

                let value =
                    parseInt(input.value) ||
                    0;


                value =
                    Math.max(
                        0,
                        Math.min(
                            100,
                            value
                        )
                    );


                bar.style.width =
                    value + '%';


                text.textContent =
                    value +
                    '% ' +
                    completedText;

            }


            input.addEventListener(
                'input',
                updatePreview
            );


            updatePreview();

        }
    );
</script>

@endpush