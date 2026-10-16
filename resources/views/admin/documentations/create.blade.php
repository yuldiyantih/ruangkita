@extends('layouts.admin')

@section('title', 'Tambah Dokumentasi - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Tambah Dokumentasi',

'subtitle' =>
'Tambahkan foto dokumentasi proyek sebelum, saat proses, atau setelah pengerjaan.',

'project' =>
'Proyek',

'choose_project' =>
'Pilih Proyek',

'category' =>
'Kategori',

'choose_category' =>
'Pilih Kategori',

'before' =>
'Sebelum',

'during' =>
'Proses',

'after' =>
'Setelah',

'title_label' =>
'Judul Dokumentasi',

'title_placeholder' =>
'Contoh: Kondisi ruang tamu sebelum renovasi',

'description' =>
'Deskripsi',

'description_placeholder' =>
'Tuliskan keterangan dokumentasi...',

'photo_date' =>
'Tanggal Foto',

'file' =>
'Foto Dokumentasi',

'file_help' =>
'Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.',

'visibility' =>
'Tampilkan ke Client',

'visibility_help' =>
'Jika dicentang, dokumentasi dapat dilihat oleh client.',

'preview' =>
'Preview Foto',

'save' =>
'Simpan Dokumentasi',

'cancel' =>
'Kembali',

],


'en' => [

'title' =>
'Add Documentation',

'subtitle' =>
'Add project documentation photos before, during, or after the work.',

'project' =>
'Project',

'choose_project' =>
'Choose Project',

'category' =>
'Category',

'choose_category' =>
'Choose Category',

'before' =>
'Before',

'during' =>
'During',

'after' =>
'After',

'title_label' =>
'Documentation Title',

'title_placeholder' =>
'Example: Living room condition before renovation',

'description' =>
'Description',

'description_placeholder' =>
'Write documentation notes...',

'photo_date' =>
'Photo Date',

'file' =>
'Documentation Photo',

'file_help' =>
'JPG, JPEG, PNG, or WEBP. Maximum 5 MB.',

'visibility' =>
'Visible to Client',

'visibility_help' =>
'If checked, the documentation can be viewed by the client.',

'preview' =>
'Photo Preview',

'save' =>
'Save Documentation',

'cancel' =>
'Back',

],

];


$ct =
$translations[$pageLang]
??
$translations['id'];

@endphp



@push('styles')

<style>
    .documentation-form-page {
        max-width: 900px;

        margin:
            0 auto;
    }


    .documentation-form-header {
        margin-bottom: 22px;
    }


    .documentation-form-card {
        padding: 24px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-form-grid {
        display: grid;

        grid-template-columns:
            repeat(2,
                minmax(0, 1fr));

        gap: 18px;
    }


    .documentation-form-group {
        display: flex;

        flex-direction: column;

        gap: 7px;
    }


    .documentation-form-group.full {
        grid-column:
            1 / -1;
    }


    .documentation-label {
        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-required {
        color:
            var(--danger);
    }


    .documentation-input,
    .documentation-select,
    .documentation-textarea {
        width: 100%;

        border:
            1px solid var(--border);

        border-radius: 9px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 12px;
    }


    .documentation-input,
    .documentation-select {
        height: 42px;

        padding:
            0 12px;
    }


    .documentation-textarea {
        min-height: 120px;

        padding: 12px;

        resize: vertical;
    }


    .documentation-input:focus,
    .documentation-select:focus,
    .documentation-textarea:focus {
        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .documentation-help {
        color:
            var(--text-muted);

        font-size: 10px;

        line-height: 1.5;
    }


    .documentation-error {
        color:
            var(--danger);

        font-size: 10px;

        font-weight: 600;
    }



    /* UPLOAD */

    .documentation-upload-box {
        padding: 18px;

        border:
            1px dashed var(--border);

        border-radius: 10px;

        background:
            rgba(120, 145, 165, .04);
    }


    .documentation-file-input {
        width: 100%;

        color:
            var(--text-main);

        font-size: 12px;
    }



    /* PREVIEW */

    .documentation-preview-section {
        margin-top: 14px;

        display: none;
    }


    .documentation-preview-title {
        margin-bottom: 8px;

        color:
            var(--text-heading);

        font-size: 11px;

        font-weight: 700;
    }


    .documentation-preview-image {
        width: 100%;
        max-width: 420px;
        height: 260px;

        object-fit: cover;

        border:
            1px solid var(--border);

        border-radius: 10px;

        display: block;
    }



    /* CHECKBOX */

    .documentation-checkbox-box {
        padding: 14px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        display: flex;

        align-items: flex-start;

        gap: 10px;
    }


    .documentation-checkbox {
        margin-top: 2px;

        width: 17px;
        height: 17px;

        accent-color:
            var(--primary);
    }


    .documentation-checkbox-content {
        flex: 1;
    }


    .documentation-checkbox-title {
        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-checkbox-help {
        margin-top: 3px;

        color:
            var(--text-muted);

        font-size: 10px;
    }



    /* ACTION */

    .documentation-form-actions {
        margin-top: 24px;

        padding-top: 18px;

        border-top:
            1px solid var(--border);

        display: flex;

        align-items: center;

        justify-content:
            flex-end;

        gap: 9px;
    }


    .documentation-btn {
        min-height: 40px;

        padding:
            0 16px;

        border: none;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-btn.back {
        border:
            1px solid var(--border);

        background:
            var(--card-bg);

        color:
            var(--text-muted);
    }


    .documentation-btn.save {
        background:
            var(--primary);

        color: #fff;

        box-shadow:
            0 6px 16px rgba(8, 119, 212, .16);
    }



    @media(max-width: 700px) {

        .documentation-form-grid {
            grid-template-columns:
                1fr;
        }


        .documentation-form-group.full {
            grid-column:
                auto;
        }


        .documentation-form-actions {
            flex-direction:
                column-reverse;
        }


        .documentation-btn {
            width: 100%;
        }

    }
</style>

@endpush



@section('content')

<div class="documentation-form-page">


    <div class="documentation-form-header">

        <div class="admin-breadcrumb">

            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <a href="{{ route('admin.documentations.index') }}">
                Dokumentasi
            </a>

            <span class="admin-breadcrumb-separator">
                /
            </span>

            <span class="admin-breadcrumb-current">
                {{ $ct['title'] }}
            </span>

        </div>


        <h1 class="admin-page-title">
            {{ $ct['title'] }}
        </h1>


        <p class="admin-page-subtitle">
            {{ $ct['subtitle'] }}
        </p>

    </div>



    <form
        method="POST"
        action="{{ route('admin.documentations.store') }}"
        enctype="multipart/form-data">

        @csrf


        <div class="documentation-form-card">


            <div class="documentation-form-grid">


                {{-- PROJECT --}}

                <div class="documentation-form-group">

                    <label
                        for="project_id"
                        class="documentation-label">
                        {{ $ct['project'] }}

                        <span class="documentation-required">
                            *
                        </span>
                    </label>


                    <select
                        id="project_id"
                        name="project_id"
                        class="documentation-select"
                        required>

                        <option value="">
                            {{ $ct['choose_project'] }}
                        </option>


                        @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            @selected(
                            (string) old('project_id')===(string) $project->id
                            )
                            >
                            {{ $project->project_name }}
                        </option>

                        @endforeach

                    </select>


                    @error('project_id')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- CATEGORY --}}

                <div class="documentation-form-group">

                    <label
                        for="category"
                        class="documentation-label">
                        {{ $ct['category'] }}

                        <span class="documentation-required">
                            *
                        </span>
                    </label>


                    <select
                        id="category"
                        name="category"
                        class="documentation-select"
                        required>

                        <option value="">
                            {{ $ct['choose_category'] }}
                        </option>


                        <option
                            value="before"
                            @selected(
                            old('category')==='before'
                            )>
                            {{ $ct['before'] }}
                        </option>


                        <option
                            value="during"
                            @selected(
                            old('category')==='during'
                            )>
                            {{ $ct['during'] }}
                        </option>


                        <option
                            value="after"
                            @selected(
                            old('category')==='after'
                            )>
                            {{ $ct['after'] }}
                        </option>

                    </select>


                    @error('category')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- TITLE --}}

                <div class="documentation-form-group full">

                    <label
                        for="title"
                        class="documentation-label">
                        {{ $ct['title_label'] }}
                    </label>


                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="documentation-input"
                        maxlength="150"
                        value="{{ old('title') }}"
                        placeholder="{{ $ct['title_placeholder'] }}">


                    @error('title')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- PHOTO DATE --}}

                <div class="documentation-form-group">

                    <label
                        for="photo_date"
                        class="documentation-label">
                        {{ $ct['photo_date'] }}
                    </label>


                    <input
                        type="date"
                        id="photo_date"
                        name="photo_date"
                        class="documentation-input"
                        value="{{ old('photo_date', now()->format('Y-m-d')) }}">


                    @error('photo_date')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- VISIBILITY --}}

                <div class="documentation-form-group">

                    <label class="documentation-label">
                        {{ $ct['visibility'] }}
                    </label>


                    <div class="documentation-checkbox-box">

                        <input
                            type="checkbox"
                            id="is_visible_to_client"
                            name="is_visible_to_client"
                            value="1"
                            class="documentation-checkbox"
                            @checked(
                            old( 'is_visible_to_client' ,
                            true
                            )
                            )>


                        <div class="documentation-checkbox-content">

                            <label
                                for="is_visible_to_client"
                                class="documentation-checkbox-title">
                                {{ $ct['visibility'] }}
                            </label>


                            <div class="documentation-checkbox-help">
                                {{ $ct['visibility_help'] }}
                            </div>

                        </div>

                    </div>


                    @error('is_visible_to_client')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- DESCRIPTION --}}

                <div class="documentation-form-group full">

                    <label
                        for="description"
                        class="documentation-label">
                        {{ $ct['description'] }}
                    </label>


                    <textarea
                        id="description"
                        name="description"
                        class="documentation-textarea"
                        placeholder="{{ $ct['description_placeholder'] }}">{{ old('description') }}</textarea>


                    @error('description')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- FILE --}}

                <div class="documentation-form-group full">

                    <label
                        for="file"
                        class="documentation-label">
                        {{ $ct['file'] }}

                        <span class="documentation-required">
                            *
                        </span>
                    </label>


                    <div class="documentation-upload-box">

                        <input
                            type="file"
                            id="file"
                            name="file"
                            class="documentation-file-input"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            required>


                        <div class="documentation-help">
                            {{ $ct['file_help'] }}
                        </div>


                        <div
                            id="previewSection"
                            class="documentation-preview-section">

                            <div class="documentation-preview-title">
                                {{ $ct['preview'] }}
                            </div>


                            <img
                                id="previewImage"
                                class="documentation-preview-image"
                                alt="Preview Dokumentasi">

                        </div>

                    </div>


                    @error('file')

                    <div class="documentation-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>


            </div>



            {{-- ACTION --}}

            <div class="documentation-form-actions">


                <a
                    href="{{ route('admin.documentations.index') }}"
                    class="documentation-btn back">
                    {{ $ct['cancel'] }}
                </a>


                <button
                    type="submit"
                    class="documentation-btn save">
                    {{ $ct['save'] }}
                </button>


            </div>


        </div>

    </form>


</div>

@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const fileInput =
                document.getElementById(
                    'file'
                );

            const previewSection =
                document.getElementById(
                    'previewSection'
                );

            const previewImage =
                document.getElementById(
                    'previewImage'
                );


            if (
                !fileInput ||
                !previewSection ||
                !previewImage
            ) {

                return;

            }


            fileInput.addEventListener(
                'change',
                function(event) {

                    const file =
                        event.target.files[0];


                    if (!file) {

                        previewSection.style.display =
                            'none';

                        previewImage.removeAttribute(
                            'src'
                        );

                        return;

                    }


                    if (
                        !file.type.startsWith(
                            'image/'
                        )
                    ) {

                        previewSection.style.display =
                            'none';

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(loadEvent) {

                            previewImage.src =
                                loadEvent.target.result;

                            previewSection.style.display =
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