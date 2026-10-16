@extends('layouts.admin')

@section('title', 'Edit Dokumentasi - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Edit Dokumentasi',

'subtitle' =>
'Perbarui informasi dokumentasi proyek.',

'project' =>
'Proyek',

'choose_project' =>
'Pilih Proyek',

'category' =>
'Kategori',

'before' =>
'Sebelum',

'during' =>
'Proses',

'after' =>
'Setelah',

'title_label' =>
'Judul Dokumentasi',

'description' =>
'Deskripsi',

'photo_date' =>
'Tanggal Foto',

'visibility' =>
'Tampilkan ke Client',

'visibility_help' =>
'Jika dicentang, dokumentasi dapat dilihat oleh client.',

'current_photo' =>
'Foto Saat Ini',

'new_photo' =>
'Ganti Foto',

'new_photo_help' =>
'Kosongkan jika tidak ingin mengganti foto. Maksimal 5 MB.',

'preview' =>
'Preview Foto Baru',

'save' =>
'Simpan Perubahan',

'cancel' =>
'Kembali',

],


'en' => [

'title' =>
'Edit Documentation',

'subtitle' =>
'Update project documentation information.',

'project' =>
'Project',

'choose_project' =>
'Choose Project',

'category' =>
'Category',

'before' =>
'Before',

'during' =>
'During',

'after' =>
'After',

'title_label' =>
'Documentation Title',

'description' =>
'Description',

'photo_date' =>
'Photo Date',

'visibility' =>
'Visible to Client',

'visibility_help' =>
'If checked, documentation can be viewed by the client.',

'current_photo' =>
'Current Photo',

'new_photo' =>
'Replace Photo',

'new_photo_help' =>
'Leave empty if you do not want to replace the photo. Maximum 5 MB.',

'preview' =>
'New Photo Preview',

'save' =>
'Save Changes',

'cancel' =>
'Back',

],

];


$et =
$translations[$pageLang]
??
$translations['id'];

@endphp



@push('styles')

<style>
    .documentation-edit-page {
        max-width: 900px;

        margin:
            0 auto;
    }


    .documentation-edit-header {
        margin-bottom: 22px;
    }


    .documentation-edit-card {
        padding: 24px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .documentation-edit-grid {
        display: grid;

        grid-template-columns:
            repeat(2,
                minmax(0, 1fr));

        gap: 18px;
    }


    .documentation-edit-group {
        display: flex;

        flex-direction: column;

        gap: 7px;
    }


    .documentation-edit-group.full {
        grid-column:
            1 / -1;
    }


    .documentation-edit-label {
        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-edit-required {
        color:
            var(--danger);
    }


    .documentation-edit-input,
    .documentation-edit-select,
    .documentation-edit-textarea {
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


    .documentation-edit-input,
    .documentation-edit-select {
        height: 42px;

        padding:
            0 12px;
    }


    .documentation-edit-textarea {
        min-height: 120px;

        padding: 12px;

        resize: vertical;
    }


    .documentation-edit-input:focus,
    .documentation-edit-select:focus,
    .documentation-edit-textarea:focus {
        border-color:
            var(--primary);

        box-shadow:
            0 0 0 3px rgba(8, 119, 212, .08);
    }


    .documentation-edit-error {
        color:
            var(--danger);

        font-size: 10px;

        font-weight: 600;
    }


    .documentation-edit-help {
        color:
            var(--text-muted);

        font-size: 10px;

        line-height: 1.5;
    }



    /* CURRENT PHOTO */

    .documentation-current-photo {
        width: 100%;
        max-width: 420px;
        height: 260px;

        object-fit: cover;

        border:
            1px solid var(--border);

        border-radius: 10px;
    }



    /* CHECKBOX */

    .documentation-edit-checkbox-box {
        padding: 14px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        display: flex;

        align-items: flex-start;

        gap: 10px;
    }


    .documentation-edit-checkbox {
        width: 17px;
        height: 17px;

        margin-top: 2px;

        accent-color:
            var(--primary);
    }


    .documentation-edit-checkbox-title {
        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .documentation-edit-checkbox-help {
        margin-top: 3px;

        color:
            var(--text-muted);

        font-size: 10px;
    }



    /* NEW PHOTO */

    .documentation-edit-upload-box {
        padding: 18px;

        border:
            1px dashed var(--border);

        border-radius: 10px;

        background:
            rgba(120, 145, 165, .04);
    }


    .documentation-edit-file {
        width: 100%;

        font-size: 12px;

        color:
            var(--text-main);
    }


    .documentation-new-preview {
        margin-top: 14px;

        display: none;
    }


    .documentation-new-preview-title {
        margin-bottom: 8px;

        color:
            var(--text-heading);

        font-size: 11px;

        font-weight: 700;
    }


    .documentation-new-preview-image {
        width: 100%;
        max-width: 420px;
        height: 260px;

        object-fit: cover;

        border-radius: 10px;

        border:
            1px solid var(--border);
    }



    /* ACTION */

    .documentation-edit-actions {
        margin-top: 24px;

        padding-top: 18px;

        border-top:
            1px solid var(--border);

        display: flex;

        justify-content:
            flex-end;

        gap: 9px;
    }


    .documentation-edit-btn {
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


    .documentation-edit-btn.back {
        border:
            1px solid var(--border);

        background:
            var(--card-bg);

        color:
            var(--text-muted);
    }


    .documentation-edit-btn.save {
        background:
            var(--primary);

        color: #fff;
    }



    @media(max-width: 700px) {

        .documentation-edit-grid {
            grid-template-columns:
                1fr;
        }


        .documentation-edit-group.full {
            grid-column:
                auto;
        }


        .documentation-edit-actions {
            flex-direction:
                column-reverse;
        }


        .documentation-edit-btn {
            width: 100%;
        }

    }
</style>

@endpush



@section('content')

<div class="documentation-edit-page">


    <div class="documentation-edit-header">

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
                {{ $et['title'] }}
            </span>

        </div>


        <h1 class="admin-page-title">
            {{ $et['title'] }}
        </h1>


        <p class="admin-page-subtitle">
            {{ $et['subtitle'] }}
        </p>

    </div>



    <form
        method="POST"
        action="{{ route('admin.documentations.update', $documentation) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="documentation-edit-card">


            <div class="documentation-edit-grid">


                {{-- PROJECT --}}

                <div class="documentation-edit-group">

                    <label
                        for="project_id"
                        class="documentation-edit-label">
                        {{ $et['project'] }}

                        <span class="documentation-edit-required">
                            *
                        </span>
                    </label>


                    <select
                        id="project_id"
                        name="project_id"
                        class="documentation-edit-select"
                        required>

                        <option value="">
                            {{ $et['choose_project'] }}
                        </option>


                        @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            @selected(
                            (string) old( 'project_id' ,
                            $documentation->project_id
                            )
                            ===
                            (string) $project->id
                            )
                            >
                            {{ $project->project_name }}
                        </option>

                        @endforeach

                    </select>


                    @error('project_id')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- CATEGORY --}}

                <div class="documentation-edit-group">

                    <label
                        for="category"
                        class="documentation-edit-label">
                        {{ $et['category'] }}

                        <span class="documentation-edit-required">
                            *
                        </span>
                    </label>


                    <select
                        id="category"
                        name="category"
                        class="documentation-edit-select"
                        required>

                        <option
                            value="before"
                            @selected(
                            old( 'category' ,
                            $documentation->category
                            )
                            ===
                            'before'
                            )
                            >
                            {{ $et['before'] }}
                        </option>


                        <option
                            value="during"
                            @selected(
                            old( 'category' ,
                            $documentation->category
                            )
                            ===
                            'during'
                            )
                            >
                            {{ $et['during'] }}
                        </option>


                        <option
                            value="after"
                            @selected(
                            old( 'category' ,
                            $documentation->category
                            )
                            ===
                            'after'
                            )
                            >
                            {{ $et['after'] }}
                        </option>

                    </select>


                    @error('category')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- TITLE --}}

                <div class="documentation-edit-group full">

                    <label
                        for="title"
                        class="documentation-edit-label">
                        {{ $et['title_label'] }}
                    </label>


                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="documentation-edit-input"
                        maxlength="150"
                        value="{{ old('title', $documentation->title) }}">


                    @error('title')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- PHOTO DATE --}}

                <div class="documentation-edit-group">

                    <label
                        for="photo_date"
                        class="documentation-edit-label">
                        {{ $et['photo_date'] }}
                    </label>


                    <input
                        type="date"
                        id="photo_date"
                        name="photo_date"
                        class="documentation-edit-input"
                        value="{{ old(
                            'photo_date',
                            optional($documentation->photo_date)
                                ->format('Y-m-d')
                        ) }}">


                    @error('photo_date')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- VISIBILITY --}}

                <div class="documentation-edit-group">

                    <label class="documentation-edit-label">
                        {{ $et['visibility'] }}
                    </label>


                    <div class="documentation-edit-checkbox-box">

                        <input
                            type="checkbox"
                            id="is_visible_to_client"
                            name="is_visible_to_client"
                            value="1"
                            class="documentation-edit-checkbox"
                            @checked(
                            old( 'is_visible_to_client' ,
                            $documentation->is_visible_to_client
                        )
                        )
                        >


                        <div>

                            <label
                                for="is_visible_to_client"
                                class="documentation-edit-checkbox-title">
                                {{ $et['visibility'] }}
                            </label>


                            <div class="documentation-edit-checkbox-help">
                                {{ $et['visibility_help'] }}
                            </div>

                        </div>

                    </div>

                </div>



                {{-- DESCRIPTION --}}

                <div class="documentation-edit-group full">

                    <label
                        for="description"
                        class="documentation-edit-label">
                        {{ $et['description'] }}
                    </label>


                    <textarea
                        id="description"
                        name="description"
                        class="documentation-edit-textarea">{{ old(
                        'description',
                        $documentation->description
                    ) }}</textarea>


                    @error('description')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- CURRENT PHOTO --}}

                <div class="documentation-edit-group full">

                    <label class="documentation-edit-label">
                        {{ $et['current_photo'] }}
                    </label>


                    <img
                        src="{{ asset('storage/' . $documentation->file_path) }}"
                        alt="Foto Dokumentasi"
                        class="documentation-current-photo">

                </div>



                {{-- NEW PHOTO --}}

                <div class="documentation-edit-group full">

                    <label
                        for="file"
                        class="documentation-edit-label">
                        {{ $et['new_photo'] }}
                    </label>


                    <div class="documentation-edit-upload-box">

                        <input
                            type="file"
                            id="file"
                            name="file"
                            class="documentation-edit-file"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">


                        <div class="documentation-edit-help">
                            {{ $et['new_photo_help'] }}
                        </div>


                        <div
                            id="previewSection"
                            class="documentation-new-preview">

                            <div class="documentation-new-preview-title">
                                {{ $et['preview'] }}
                            </div>


                            <img
                                id="previewImage"
                                class="documentation-new-preview-image"
                                alt="Preview Foto Baru">

                        </div>

                    </div>


                    @error('file')

                    <div class="documentation-edit-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>


            </div>



            <div class="documentation-edit-actions">

                <a
                    href="{{ route('admin.documentations.show', $documentation) }}"
                    class="documentation-edit-btn back">
                    {{ $et['cancel'] }}
                </a>


                <button
                    type="submit"
                    class="documentation-edit-btn save">
                    {{ $et['save'] }}
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

            const input =
                document.getElementById('file');

            const section =
                document.getElementById(
                    'previewSection'
                );

            const image =
                document.getElementById(
                    'previewImage'
                );


            if (
                !input ||
                !section ||
                !image
            ) {

                return;

            }


            input.addEventListener(
                'change',
                function(event) {

                    const file =
                        event.target.files[0];


                    if (!file) {

                        section.style.display =
                            'none';

                        image.removeAttribute(
                            'src'
                        );

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(loadEvent) {

                            image.src =
                                loadEvent.target.result;

                            section.style.display =
                                'block';

                        };


                    reader.readAsDataURL(file);

                }
            );

        }
    );
</script>

@endpush