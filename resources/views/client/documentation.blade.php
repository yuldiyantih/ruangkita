@extends('layouts.client')


@php

$docLang = auth()->user()->language ?? 'id';

$docTranslations = [

'id' => [

'title' => 'Dokumentasi Proyek',

'description' =>
'Lihat galeri foto dan video perkembangan proyek renovasi Anda',

'total_documentation' => 'Total Dokumentasi',
'all_files' => 'Semua File',

'progress_photos' => 'Foto Progress',
'photo' => 'Foto',

'documents' => 'Dokumen',
'file' => 'File',

'video' => 'Video',

'all' => 'Semua',

'all_rooms' => 'Semua Ruangan',

'sort_latest' => 'Urutkan: Terbaru',
'sort_oldest' => 'Urutkan: Terlama',

'documentation_files' => 'file dokumentasi',

'view_all' => 'Lihat Semua →',

'before_after' => 'Perbandingan Before & After',

'latest_documentation' => 'Dokumentasi Terbaru',

'no_documentation_room' =>
'Belum ada dokumentasi untuk',

'no_area' =>
'Belum ada area atau ruangan pada proyek ini.',

'no_latest_documentation' =>
'Belum ada dokumentasi terbaru.',

'no_project' =>
'Belum ada proyek yang terhubung dengan akun Anda.',

],


'en' => [

'title' => 'Project Documentation',

'description' =>
'View photos and videos of your renovation project progress',

'total_documentation' => 'Total Documentation',
'all_files' => 'All Files',

'progress_photos' => 'Progress Photos',
'photo' => 'Photo',

'documents' => 'Documents',
'file' => 'File',

'video' => 'Video',

'all' => 'All',

'all_rooms' => 'All Rooms',

'sort_latest' => 'Sort: Latest',
'sort_oldest' => 'Sort: Oldest',

'documentation_files' => 'documentation files',

'view_all' => 'View All →',

'before_after' => 'Before & After Comparison',

'latest_documentation' => 'Latest Documentation',

'no_documentation_room' =>
'No documentation available for',

'no_area' =>
'No areas or rooms are available for this project.',

'no_latest_documentation' =>
'No latest documentation available.',

'no_project' =>
'There are no projects connected to your account yet.',

],

];

$dt =
$docTranslations[$docLang]
??
$docTranslations['id'];

@endphp


@section(
'title',
$dt['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .documentation-page-head {

        margin-bottom: 16px;

        display: flex;

        justify-content:
            space-between;

        align-items:
            flex-start;

        gap: 20px;
    }


    .documentation-page-title h1 {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .documentation-page-title p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       PROJECT SELECTOR
    ===================================================== */

    .project-selector {

        min-width: 310px;

        padding: 10px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        display: flex;

        align-items: center;

        gap: 10px;

        background:
            var(--card-bg);
    }


    .selector-thumb {

        width: 48px;
        height: 42px;

        border-radius: 7px;

        object-fit: cover;

        background: #e6eef5;
    }


    body.dark-mode .selector-thumb {

        background: #263b4b;
    }


    .selector-content {

        flex: 1;

        min-width: 0;
    }


    .selector-title {

        margin-bottom: 3px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .selector-location {

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .project-select {

        width: 30px;

        border: none;

        background: transparent;

        color:
            var(--text-muted);

        cursor: pointer;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .summary-grid {

        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 14px;
    }


    .summary-card {

        padding: 17px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        display: flex;

        align-items: center;

        gap: 14px;

        background:
            var(--card-bg);
    }


    .summary-icon {

        width: 50px;
        height: 50px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 21px;
    }


    .summary-icon.blue {

        color: #0877d2;

        background: #e7f3ff;
    }


    .summary-icon.green {

        color: #139261;

        background: #e0f9ed;
    }


    .summary-icon.purple {

        color: #7154d7;

        background: #eee9ff;
    }


    .summary-icon.red {

        color: #ef554f;

        background: #ffe7e7;
    }


    body.dark-mode .summary-icon.blue {

        background: #19364d;
    }


    body.dark-mode .summary-icon.green {

        background: #173d31;
    }


    body.dark-mode .summary-icon.purple {

        background: #302a4d;
    }


    body.dark-mode .summary-icon.red {

        background: #4b2729;
    }


    .summary-label {

        margin-bottom: 3px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .summary-number {

        color:
            var(--text-heading);

        font-size: 23px;

        font-weight: 700;
    }


    .summary-type {

        margin-top: 2px;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    /* =====================================================
       TOOLBAR
    ===================================================== */

    .toolbar {

        margin-bottom: 18px;

        display: flex;

        justify-content:
            space-between;

        align-items: center;

        gap: 12px;

        flex-wrap: wrap;
    }


    .filter-group {

        display: flex;

        gap: 8px;

        flex-wrap: wrap;
    }


    .filter-btn {

        padding:
            9px 13px;

        border:
            1px solid var(--border);

        border-radius: 9px;

        background:
            var(--card-bg);

        color:
            var(--text-muted);

        cursor: pointer;

        font-size: 11px;

        font-weight: 600;
    }


    .filter-btn.active {

        border-color:
            var(--primary);

        background:
            var(--primary);

        color: white;
    }


    .toolbar-right {

        display: flex;

        gap: 9px;
    }


    .toolbar-select {

        min-width: 155px;

        padding:
            9px 12px;

        border:
            1px solid var(--border);

        border-radius: 9px;

        outline: none;

        background:
            var(--card-bg);

        color:
            var(--text-main);

        font-size: 11px;
    }


    /* =====================================================
       CONTENT LAYOUT
    ===================================================== */

    .documentation-layout {

        display: grid;

        grid-template-columns:
            minmax(0, 1fr) 300px;

        gap: 17px;

        align-items: start;
    }


    .rooms-column {

        min-width: 0;
    }


    /* =====================================================
       ROOM SECTION
    ===================================================== */

    .room-section {

        margin-bottom: 17px;

        padding: 17px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .room-heading {

        margin-bottom: 13px;

        display: flex;

        justify-content:
            space-between;

        align-items: center;

        gap: 12px;
    }


    .room-title-wrapper {

        display: flex;

        align-items: center;

        gap: 10px;
    }


    .room-icon {

        width: 36px;
        height: 36px;

        border-radius: 9px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e9f4ff;

        color: #0875ce;
    }


    body.dark-mode .room-icon {

        background: #19364d;
    }


    .room-name {

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .room-count {

        margin-top: 2px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .room-see-all {

        color:
            var(--primary);

        text-decoration: none;

        font-size: 10px;

        font-weight: 600;
    }


    /* =====================================================
       GALLERY
    ===================================================== */

    .gallery-grid {

        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 11px;
    }


    .gallery-card {

        min-width: 0;
    }


    .gallery-image-wrap {

        position: relative;

        margin-bottom: 7px;
    }


    .gallery-image {

        width: 100%;
        height: 125px;

        display: block;

        border-radius: 9px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dae7f2,
                #edf4f9);
    }


    body.dark-mode .gallery-image {

        background:
            linear-gradient(135deg,
                #263b4b,
                #172735);
    }


    .media-placeholder {

        width: 100%;
        height: 125px;

        border-radius: 9px;

        display: flex;

        align-items: center;
        justify-content: center;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        font-size: 25px;
    }


    .phase-badge {

        position: absolute;

        left: 7px;
        bottom: 7px;

        padding:
            4px 7px;

        border-radius: 5px;

        color: white;

        font-size: 8px;

        font-weight: 700;

        background:
            rgba(14,
                39,
                58,
                .85);
    }


    .phase-before {

        background:
            rgba(45,
                65,
                80,
                .9);
    }


    .phase-during {

        background:
            rgba(8,
                117,
                205,
                .92);
    }


    .phase-after {

        background:
            rgba(20,
                139,
                91,
                .92);
    }


    .gallery-title {

        margin-bottom: 3px;

        color:
            var(--text-heading);

        font-size: 11px;

        line-height: 1.35;

        font-weight: 700;
    }


    .gallery-description {

        color:
            var(--text-muted);

        font-size: 9px;

        line-height: 1.45;
    }


    /* =====================================================
       BEFORE AFTER
    ===================================================== */

    .before-after {

        margin-top: 16px;

        padding-top: 15px;

        border-top:
            1px solid var(--border);
    }


    .before-after-title {

        margin-bottom: 10px;

        color:
            var(--text-heading);

        font-size: 11px;

        font-weight: 700;
    }


    .before-after-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 10px;
    }


    .comparison-box {

        position: relative;
    }


    .comparison-box img {

        width: 100%;
        height: 150px;

        display: block;

        object-fit: cover;

        border-radius: 9px;
    }


    .comparison-label {

        position: absolute;

        top: 8px;
        left: 8px;

        padding:
            5px 9px;

        border-radius: 20px;

        background:
            rgba(13,
                41,
                62,
                .85);

        color: white;

        font-size: 9px;

        font-weight: 700;
    }


    .comparison-label.after {

        background:
            rgba(19,
                139,
                91,
                .9);
    }


    /* =====================================================
       LATEST DOCUMENTATION
    ===================================================== */

    .latest-panel {

        padding: 17px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .latest-title {

        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .latest-timeline {

        position: relative;
    }


    .latest-timeline::before {

        content: "";

        position: absolute;

        left: 7px;

        top: 12px;
        bottom: 20px;

        width: 2px;

        background:
            var(--border);
    }


    .latest-item {

        position: relative;

        padding-left: 27px;

        padding-bottom: 17px;
    }


    .latest-dot {

        width: 13px;
        height: 13px;

        position: absolute;

        left: 1px;
        top: 11px;

        z-index: 2;

        border-radius: 50%;

        border:
            4px solid var(--card-bg);

        background:
            var(--primary);

        box-shadow:
            0 0 0 1px var(--primary);
    }


    .latest-card {

        display: grid;

        grid-template-columns:
            72px minmax(0, 1fr);

        gap: 10px;
    }


    .latest-thumb {

        width: 72px;
        height: 60px;

        border-radius: 7px;

        object-fit: cover;

        background:
            var(--input-bg);
    }


    .latest-item-title {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 10px;

        font-weight: 700;

        line-height: 1.35;
    }


    .latest-room {

        display: inline-block;

        margin-bottom: 4px;

        padding:
            3px 7px;

        border-radius: 10px;

        background: #e6f2ff;

        color: #0872c6;

        font-size: 8px;
    }


    body.dark-mode .latest-room {

        background: #19364d;

        color: #72bdf5;
    }


    .latest-date {

        color:
            var(--text-muted);

        font-size: 8px;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-state {

        padding:
            35px 20px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 12px;
    }


    .room-empty {

        padding: 20px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 10px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1150px) {

        .gallery-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }


        .documentation-layout {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 900px) {

        .summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

    }


    @media(max-width: 650px) {

        .documentation-page-head {

            flex-direction: column;
        }


        .project-selector {

            width: 100%;

            min-width: 0;
        }


        .summary-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .gallery-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .before-after-grid {

            grid-template-columns:
                1fr;
        }


        .toolbar-right {

            width: 100%;
        }


        .toolbar-select {

            flex: 1;

            min-width: 0;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="documentation-page-head">


    <div class="documentation-page-title">

        <h1>

            {{ $dt['title'] }}

        </h1>

        <p>

            {{ $dt['description'] }}

        </p>

    </div>



    @if($selectedProject)

    <form

        method="GET"

        action="{{ route('client.documentation') }}"

        class="project-selector">


        @if($selectedProject->cover_image)

        <img

            src="{{
                            asset(
                                'storage/' .
                                $selectedProject
                                    ->cover_image
                            )
                        }}"

            alt="{{
                            $selectedProject
                                ->project_name
                        }}"

            class="selector-thumb">

        @else

        <div
            class="selector-thumb"></div>

        @endif



        <div class="selector-content">


            <div class="selector-title">

                {{
                            $selectedProject
                                ->project_name
                        }}

            </div>


            <div class="selector-location">

                {{
                            $selectedProject
                                ->location
                        }}

            </div>


        </div>



        <select

            name="project"

            class="project-select"

            onchange="this.form.submit()">

            @foreach($projects as $project)

            <option

                value="{{ $project->id }}"

                @selected(
                $selectedProject->id
                ===
                $project->id
                )

                >

                {{
                                $project
                                    ->project_name
                            }}

            </option>

            @endforeach

        </select>


    </form>

    @endif


</div>



@if($selectedProject)


{{-- =================================================
             SUMMARY
        ================================================== --}}

<div class="summary-grid">


    <div class="summary-card">

        <div class="summary-icon blue">

            ▧

        </div>

        <div>

            <div class="summary-label">

                {{
                            $dt[
                                'total_documentation'
                            ]
                        }}

            </div>

            <div class="summary-number">

                {{
                            $documentationStats[
                                'total'
                            ]
                        }}

            </div>

            <div class="summary-type">

                {{
                            $dt[
                                'all_files'
                            ]
                        }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon green">

            ▣

        </div>

        <div>

            <div class="summary-label">

                {{
                            $dt[
                                'progress_photos'
                            ]
                        }}

            </div>

            <div class="summary-number">

                {{
                            $documentationStats[
                                'photo'
                            ]
                        }}

            </div>

            <div class="summary-type">

                {{ $dt['photo'] }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon purple">

            ▤

        </div>

        <div>

            <div class="summary-label">

                {{ $dt['documents'] }}

            </div>

            <div class="summary-number">

                {{
                            $documentationStats[
                                'document'
                            ]
                        }}

            </div>

            <div class="summary-type">

                {{ $dt['file'] }}

            </div>

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-icon red">

            ▶

        </div>

        <div>

            <div class="summary-label">

                {{ $dt['video'] }}

            </div>

            <div class="summary-number">

                {{
                            $documentationStats[
                                'video'
                            ]
                        }}

            </div>

            <div class="summary-type">

                {{ $dt['video'] }}

            </div>

        </div>

    </div>


</div>



{{-- =================================================
             FILTER
        ================================================== --}}

<div class="toolbar">


    <div class="filter-group">


        <button

            type="button"

            class="filter-btn active"

            data-media="all">

            {{ $dt['all'] }}

            ({{
                        $documentationStats[
                            'total'
                        ]
                    }})

        </button>



        <button

            type="button"

            class="filter-btn"

            data-media="photo">

            {{ $dt['photo'] }}

            ({{
                        $documentationStats[
                            'photo'
                        ]
                    }})

        </button>



        <button

            type="button"

            class="filter-btn"

            data-media="video">

            {{ $dt['video'] }}

            ({{
                        $documentationStats[
                            'video'
                        ]
                    }})

        </button>



        <button

            type="button"

            class="filter-btn"

            data-media="document">

            {{ $dt['documents'] }}

            ({{
                        $documentationStats[
                            'document'
                        ]
                    }})

        </button>


    </div>



    <div class="toolbar-right">


        <select

            id="roomFilter"

            class="toolbar-select">

            <option value="all">

                {{ $dt['all_rooms'] }}

            </option>


            @foreach($selectedProject->areas as $area)

            <option
                value="{{ $area->id }}">

                {{ $area->area_name }}

            </option>

            @endforeach

        </select>



        <select

            id="sortFilter"

            class="toolbar-select">

            <option value="latest">

                {{
                            $dt[
                                'sort_latest'
                            ]
                        }}

            </option>

            <option value="oldest">

                {{
                            $dt[
                                'sort_oldest'
                            ]
                        }}

            </option>

        </select>


    </div>


</div>



{{-- =================================================
             MAIN CONTENT
        ================================================== --}}

<div class="documentation-layout">


    <div class="rooms-column">


        @forelse($selectedProject->areas as $area)


        @php

        $areaDocs =
        $area
        ->documentations;


        $beforePhoto =
        $areaDocs
        ->where(
        'media_type',
        'photo'
        )
        ->where(
        'category',
        'before'
        )
        ->first();


        $afterPhoto =
        $areaDocs
        ->where(
        'media_type',
        'photo'
        )
        ->where(
        'category',
        'after'
        )
        ->last();

        @endphp



        <div

            class="room-section"

            data-room="{{ $area->id }}">


            <div class="room-heading">


                <div class="room-title-wrapper">


                    <div class="room-icon">

                        ▧

                    </div>


                    <div>

                        <div class="room-name">

                            {{
                                            $area
                                                ->area_name
                                        }}

                        </div>

                        <div class="room-count">

                            {{
                                            $areaDocs
                                                ->count()
                                        }}

                            {{
                                            $dt[
                                                'documentation_files'
                                            ]
                                        }}

                        </div>

                    </div>


                </div>



                <a

                    href="#"

                    class="room-see-all">

                    {{
                                    $dt[
                                        'view_all'
                                    ]
                                }}

                </a>


            </div>



            @if($areaDocs->count() > 0)


            <div class="gallery-grid">


                @foreach($areaDocs->take(4) as $doc)


                <div

                    class="
                                            gallery-card
                                            documentation-item
                                        "

                    data-media="{{
                                            $doc->media_type
                                        }}"

                    data-date="{{
                                            optional(
                                                $doc->photo_date
                                            )
                                            ->format(
                                                'Y-m-d'
                                            )
                                        }}">


                    <div class="gallery-image-wrap">


                        @if($doc->media_type === 'photo')

                        <img

                            src="{{
                                                        asset(
                                                            'storage/' .
                                                            $doc
                                                                ->file_path
                                                        )
                                                    }}"

                            alt="{{
                                                        $doc
                                                            ->title
                                                    }}"

                            class="
                                                        gallery-image
                                                    ">

                        @elseif($doc->media_type === 'video')

                        <div
                            class="
                                                        media-placeholder
                                                    ">

                            ▶

                        </div>

                        @else

                        <div
                            class="
                                                        media-placeholder
                                                    ">

                            ▤

                        </div>

                        @endif



                        @if($doc->category === 'before')

                        <span
                            class="
                                                        phase-badge
                                                        phase-before
                                                    ">

                            BEFORE

                        </span>

                        @elseif($doc->category === 'during')

                        <span
                            class="
                                                        phase-badge
                                                        phase-during
                                                    ">

                            PROGRESS

                        </span>

                        @elseif($doc->category === 'after')

                        <span
                            class="
                                                        phase-badge
                                                        phase-after
                                                    ">

                            AFTER

                        </span>

                        @endif


                    </div>



                    <div class="gallery-title">

                        {{ $doc->title }}

                    </div>


                    <div class="gallery-description">

                        {{
                                                $doc->description
                                                ?:
                                                optional(
                                                    $doc->photo_date
                                                )
                                                ->format(
                                                    'd M Y'
                                                )
                                            }}

                    </div>


                </div>


                @endforeach


            </div>



            @if($beforePhoto && $afterPhoto)


            <div class="before-after">


                <div class="before-after-title">

                    {{
                                            $dt[
                                                'before_after'
                                            ]
                                        }}

                    —
                    {{ $area->area_name }}

                </div>



                <div class="before-after-grid">


                    <div class="comparison-box">

                        <img

                            src="{{
                                                    asset(
                                                        'storage/' .
                                                        $beforePhoto
                                                            ->file_path
                                                    )
                                                }}"

                            alt="Before {{
                                                    $area
                                                        ->area_name
                                                }}">

                        <span
                            class="
                                                    comparison-label
                                                ">

                            BEFORE

                        </span>

                    </div>



                    <div class="comparison-box">

                        <img

                            src="{{
                                                    asset(
                                                        'storage/' .
                                                        $afterPhoto
                                                            ->file_path
                                                    )
                                                }}"

                            alt="After {{
                                                    $area
                                                        ->area_name
                                                }}">

                        <span
                            class="
                                                    comparison-label
                                                    after
                                                ">

                            AFTER

                        </span>

                    </div>


                </div>


            </div>


            @endif


            @else


            <div class="room-empty">

                {{
                                    $dt[
                                        'no_documentation_room'
                                    ]
                                }}

                {{ $area->area_name }}.

            </div>


            @endif


        </div>


        @empty


        <div class="empty-state">

            {{ $dt['no_area'] }}

        </div>


        @endforelse


    </div>



    {{-- =================================================
                 LATEST DOCUMENTATION
            ================================================== --}}

    <aside class="latest-panel">


        <div class="latest-title">

            {{
                        $dt[
                            'latest_documentation'
                        ]
                    }}

        </div>



        <div class="latest-timeline">


            @forelse($selectedProject->documentations->take(6) as $latest)


            <div class="latest-item">


                <div class="latest-dot"></div>


                <div class="latest-card">


                    @if($latest->media_type === 'photo')

                    <img

                        src="{{
                                            asset(
                                                'storage/' .
                                                $latest
                                                    ->file_path
                                            )
                                        }}"

                        alt="{{
                                            $latest
                                                ->title
                                        }}"

                        class="latest-thumb">

                    @else

                    <div
                        class="latest-thumb"></div>

                    @endif



                    <div>


                        <div class="latest-item-title">

                            {{
                                            $latest
                                                ->title
                                        }}

                        </div>


                        @if($latest->projectArea)

                        <div class="latest-room">

                            {{
                                                $latest
                                                    ->projectArea
                                                    ->area_name
                                            }}

                        </div>

                        @endif



                        <div class="latest-date">

                            @if($latest->photo_date)

                            {{
                                                \Carbon\Carbon
                                                    ::parse(
                                                        $latest
                                                            ->photo_date
                                                    )
                                                    ->format(
                                                        'd M Y'
                                                    )
                                            }}

                            @else

                            {{
                                                $latest
                                                    ->created_at
                                                    ->format(
                                                        'd M Y'
                                                    )
                                            }}

                            @endif

                        </div>


                    </div>


                </div>


            </div>


            @empty


            <div class="room-empty">

                {{
                                $dt[
                                    'no_latest_documentation'
                                ]
                            }}

            </div>


            @endforelse


        </div>


    </aside>


</div>


@else


<div class="empty-state">

    {{ $dt['no_project'] }}

</div>


@endif


@endsection



@push('scripts')

<script>
    const mediaButtons =
        document.querySelectorAll(
            '.filter-btn'
        );


    const documentationItems =
        document.querySelectorAll(
            '.documentation-item'
        );


    const roomSections =
        document.querySelectorAll(
            '.room-section'
        );


    const roomFilter =
        document.getElementById(
            'roomFilter'
        );


    /*
    |--------------------------------------------------------------------------
    | MEDIA FILTER
    |--------------------------------------------------------------------------
    */

    mediaButtons.forEach(
        function(button) {

            button.addEventListener(
                'click',
                function() {

                    mediaButtons.forEach(
                        function(btn) {

                            btn.classList.remove(
                                'active'
                            );

                        }
                    );


                    button.classList.add(
                        'active'
                    );


                    const filter =
                        button.dataset.media;


                    documentationItems.forEach(
                        function(item) {

                            const media =
                                item.dataset.media;


                            if (
                                filter === 'all' ||
                                media === filter
                            ) {

                                item.style.display =
                                    'block';

                            } else {

                                item.style.display =
                                    'none';

                            }

                        }
                    );

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ROOM FILTER
    |--------------------------------------------------------------------------
    */

    if (roomFilter) {

        roomFilter.addEventListener(
            'change',
            function() {

                const selected =
                    roomFilter.value;


                roomSections.forEach(
                    function(section) {

                        if (
                            selected === 'all' ||
                            section.dataset.room ===
                            selected
                        ) {

                            section.style.display =
                                'block';

                        } else {

                            section.style.display =
                                'none';

                        }

                    }
                );

            }
        );

    }
</script>

@endpush