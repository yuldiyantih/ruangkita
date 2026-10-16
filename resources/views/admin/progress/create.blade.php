@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' => 'Tambah Progress',

'dashboard' => 'Dashboard',

'progress' => 'Progress',

'add' => 'Tambah',

'add_progress' => 'Tambah Progress',

'subtitle' => 'Tambahkan perkembangan terbaru dari proyek.',

'progress_information' => 'Informasi Progress',

'project' => 'Proyek',

'select_project' => 'Pilih Proyek',

'update_date' => 'Tanggal Update',

'percentage' => 'Progress (%)',

'completed_text' => 'selesai',

'progress_notes' => 'Catatan Progress',

'notes_placeholder' =>
'Contoh: Pengecatan dinding lantai 1 telah selesai...',

'progress_photo' => 'Foto Progress',

'photo_help' =>
'JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.',

'back' => 'Kembali',

'save' => 'Simpan Progress',

],


'en' => [

'page_title' => 'Add Progress',

'dashboard' => 'Dashboard',

'progress' => 'Progress',

'add' => 'Add',

'add_progress' => 'Add Progress',

'subtitle' =>
'Add the latest project progress update.',

'progress_information' =>
'Progress Information',

'project' => 'Project',

'select_project' => 'Select Project',

'update_date' => 'Update Date',

'percentage' => 'Progress (%)',

'completed_text' => 'completed',

'progress_notes' => 'Progress Notes',

'notes_placeholder' =>
'Example: Painting on the first-floor walls has been completed...',

'progress_photo' => 'Progress Photo',

'photo_help' =>
'JPG, JPEG, PNG, or WEBP. Maximum 5 MB.',

'back' => 'Back',

'save' => 'Save Progress',

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
    .progress-form-wrapper {

        max-width: 900px;
    }


    .progress-form-card {

        overflow: hidden;
    }


    .progress-form-header {

        padding: 18px 20px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .progress-form-body {

        padding: 20px;
    }


    .progress-form-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 18px;
    }


    .progress-form-group {

        display: flex;

        flex-direction: column;

        gap: 7px;
    }


    .progress-form-group.full {

        grid-column:
            1 / -1;
    }


    .progress-form-group label {

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .progress-form-group input,
    .progress-form-group select,
    .progress-form-group textarea {

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


    .progress-form-group textarea {

        min-height: 120px;

        resize: vertical;
    }


    .progress-form-group input:focus,
    .progress-form-group select:focus,
    .progress-form-group textarea:focus {

        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .progress-percentage-preview {

        margin-top: 5px;
    }


    .progress-preview-track {

        height: 10px;

        overflow: hidden;

        border-radius: 10px;

        background:
            #e7edf3;
    }


    .progress-preview-fill {

        width: 0;

        height: 100%;

        border-radius: 10px;

        background:
            var(--primary);

        transition:
            width .2s ease;
    }


    .progress-preview-text {

        margin-top: 5px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .progress-form-footer {

        margin-top: 22px;

        display: flex;

        justify-content: flex-end;

        gap: 8px;
    }


    .progress-btn {

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


    .progress-btn.back {

        background:
            #eef3f7;

        color:
            var(--text-main);
    }


    .progress-btn.save {

        background:
            var(--primary);

        color: #fff;
    }


    .progress-error {

        color:
            var(--danger);

        font-size: 11px;
    }


    @media(max-width:700px) {

        .progress-form-grid {

            grid-template-columns:
                1fr;
        }


        .progress-form-group.full {

            grid-column:
                auto;
        }


        .progress-form-footer {

            flex-direction:
                column;
        }


        .progress-btn {

            width: 100%;
        }

    }
</style>

@endpush



@section('content')


<div class="progress-form-wrapper">


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
            {{ $pt['add'] }}
        </span>

    </div>


    <h1 class="admin-page-title">

        {{ $pt['add_progress'] }}

    </h1>


    <p class="admin-page-subtitle">

        {{ $pt['subtitle'] }}

    </p>


    <div
        class="admin-card progress-form-card"
        style="margin-top:20px;">


        <div class="progress-form-header">

            {{ $pt['progress_information'] }}

        </div>


        <div class="progress-form-body">


            <form
                method="POST"
                action="{{ route('admin.progress.store') }}"
                enctype="multipart/form-data">

                @csrf


                <div class="progress-form-grid">


                    {{-- PROJECT --}}

                    <div class="progress-form-group">

                        <label>

                            {{ $pt['project'] }} *

                        </label>


                        <select
                            name="project_id"
                            required>

                            <option value="">

                                {{ $pt['select_project'] }}

                            </option>


                            @foreach($projects as $project)

                            <option
                                value="{{ $project->id }}"
                                @selected(
                                old('project_id')==$project->id
                                )>

                                {{ $project->project_name }}

                            </option>

                            @endforeach

                        </select>


                        @error('project_id')

                        <div class="progress-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- DATE --}}

                    <div class="progress-form-group">

                        <label>

                            {{ $pt['update_date'] }} *

                        </label>


                        <input
                            type="date"
                            name="update_date"
                            value="{{ old('update_date', now()->format('Y-m-d')) }}"
                            required>


                        @error('update_date')

                        <div class="progress-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- PERCENTAGE --}}

                    <div class="progress-form-group full">

                        <label>

                            {{ $pt['percentage'] }} *

                        </label>


                        <input
                            id="percentageInput"
                            type="number"
                            name="percentage"
                            min="0"
                            max="100"
                            value="{{ old('percentage', 0) }}"
                            required>


                        <div class="progress-percentage-preview">

                            <div class="progress-preview-track">

                                <div
                                    id="percentageBar"
                                    class="progress-preview-fill">
                                </div>

                            </div>


                            <div
                                id="percentageText"
                                class="progress-preview-text"
                                data-completed-text="{{ $pt['completed_text'] }}">

                                0% {{ $pt['completed_text'] }}

                            </div>

                        </div>


                        @error('percentage')

                        <div class="progress-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- DESCRIPTION --}}

                    <div class="progress-form-group full">

                        <label>

                            {{ $pt['progress_notes'] }}

                        </label>


                        <textarea
                            name="description"
                            placeholder="{{ $pt['notes_placeholder'] }}">{{ old('description') }}</textarea>


                        @error('description')

                        <div class="progress-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>



                    {{-- PHOTO --}}

                    <div class="progress-form-group full">

                        <label>

                            {{ $pt['progress_photo'] }}

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

                            {{ $pt['photo_help'] }}

                        </div>


                        @error('photo')

                        <div class="progress-error">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                </div>


                <div class="progress-form-footer">

                    <a
                        href="{{ route('admin.progress.index') }}"
                        class="progress-btn back">

                        ← {{ $pt['back'] }}

                    </a>


                    <button
                        type="submit"
                        class="progress-btn save">

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