@extends('layouts.client')


@php

$projectLang = auth()->user()->language ?? 'id';

$projectTranslations = [

'id' => [

'title' => 'Proyek Saya',

'description' =>
'Daftar semua proyek renovasi Anda',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'paused' =>
'Ditunda',

'planning' =>
'Perencanaan',

'view_detail' =>
'Lihat Detail',

'empty_title' =>
'Belum Ada Proyek',

'empty_text' =>
'Belum ada proyek renovasi yang terhubung dengan akun Anda.',

],


'en' => [

'title' =>
'My Projects',

'description' =>
'View all of your renovation projects',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'paused' =>
'Paused',

'planning' =>
'Planning',

'view_detail' =>
'View Details',

'empty_title' =>
'No Projects Yet',

'empty_text' =>
'There are no renovation projects connected to your account yet.',

],

];


$pt =
$projectTranslations[$projectLang]
??
$projectTranslations['id'];

@endphp


@section(
'title',
$pt['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .projects-page-header {

        margin-bottom: 24px;
    }


    .projects-page-header h1 {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .projects-page-header p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       PROJECT GRID
    ===================================================== */

    .project-grid {

        display: grid;

        grid-template-columns:
            repeat(2,
                minmax(0, 1fr));

        gap: 20px;
    }


    .project-card {

        padding: 15px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);

        transition: .2s;
    }


    .project-card:hover {

        transform:
            translateY(-2px);

        box-shadow:
            0 10px 24px rgba(23,
                54,
                80,
                .08);
    }


    body.dark-mode .project-card:hover {

        box-shadow:
            0 10px 24px rgba(0,
                0,
                0,
                .20);
    }


    /* =====================================================
       PROJECT IMAGE
    ===================================================== */

    .project-image {

        width: 100%;
        height: 210px;

        margin-bottom: 15px;

        display: block;

        border-radius: 10px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dcebf8,
                #eef5fa);
    }


    body.dark-mode .project-image {

        background:
            linear-gradient(135deg,
                #263b4b,
                #172735);
    }


    /* =====================================================
       PROJECT TITLE
    ===================================================== */

    .project-title-row {

        margin-bottom: 11px;

        display: flex;

        align-items: flex-start;

        justify-content:
            space-between;

        gap: 10px;
    }


    .project-title {

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;

        line-height: 1.4;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .status {

        flex-shrink: 0;

        padding:
            5px 9px;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 600;
    }


    .status-ongoing {

        color: #11815a;

        background: #ddf8eb;
    }


    .status-completed {

        color: #126bb6;

        background: #e4f1ff;
    }


    .status-planning {

        color: #986500;

        background: #fff3d3;
    }


    .status-paused {

        color: #b35b1e;

        background: #ffeadc;
    }


    body.dark-mode .status-ongoing {

        color: #79ddb0;

        background: #173d31;
    }


    body.dark-mode .status-completed {

        color: #72bdf5;

        background: #19364d;
    }


    body.dark-mode .status-planning {

        color: #f4cf78;

        background: #433a20;
    }


    body.dark-mode .status-paused {

        color: #f2ad78;

        background: #49301f;
    }


    /* =====================================================
       PROJECT META
    ===================================================== */

    .project-meta {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    .progress-area {

        margin-top: 15px;

        display: flex;

        align-items: center;

        gap: 9px;
    }


    .progress-track {

        flex: 1;

        height: 8px;

        overflow: hidden;

        border-radius: 20px;

        background: #e3eaf0;
    }


    body.dark-mode .progress-track {

        background: #304352;
    }


    .progress-fill {

        width: 0;

        height: 100%;

        border-radius: 20px;

        background:
            linear-gradient(90deg,
                #1484df,
                #21a3ec);
    }


    .progress-value {

        min-width: 35px;

        color:
            var(--primary);

        font-size: 12px;

        font-weight: 700;
    }


    /* =====================================================
       FOOTER + BUTTON
    ===================================================== */

    .project-footer {

        margin-top: 16px;

        display: flex;

        justify-content: flex-end;
    }


    .btn-detail {

        min-width: 110px;
        height: 38px;

        padding:
            0 16px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background:
            linear-gradient(90deg,
                #075ca3,
                #087acb);

        color: white;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;
    }


    .btn-detail:hover {

        box-shadow:
            0 7px 15px rgba(8,
                109,
                184,
                .2);
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-state {

        grid-column:
            1 / -1;

        padding:
            55px 20px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        text-align: center;
    }


    .empty-icon {

        margin-bottom: 14px;

        font-size: 38px;
    }


    .empty-title {

        margin-bottom: 6px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .empty-text {

        color:
            var(--text-muted);

        font-size: 12px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 950px) {

        .project-grid {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 600px) {

        .project-image {

            height: 190px;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="projects-page-header">

    <h1>

        {{ $pt['title'] }}

    </h1>

    <p>

        {{ $pt['description'] }}

    </p>

</div>



{{-- =====================================================
         PROJECT LIST
    ====================================================== --}}

<div class="project-grid">


    @forelse($projects as $project)


    <div class="project-card">


        {{-- IMAGE --}}

        @if($project->cover_image)

        <img

            src="{{
                            asset(
                                'storage/' .
                                $project->cover_image
                            )
                        }}"

            alt="{{
                            $project->project_name
                        }}"

            class="project-image">

        @else

        <div
            class="project-image"></div>

        @endif



        {{-- TITLE + STATUS --}}

        <div class="project-title-row">


            <div class="project-title">

                {{
                            $project
                                ->project_name
                        }}

            </div>



            @if($project->status === 'ongoing')

            <span
                class="
                                status
                                status-ongoing
                            ">

                {{ $pt['ongoing'] }}

            </span>

            @elseif($project->status === 'completed')

            <span
                class="
                                status
                                status-completed
                            ">

                {{ $pt['completed'] }}

            </span>

            @elseif($project->status === 'paused')

            <span
                class="
                                status
                                status-paused
                            ">

                {{ $pt['paused'] }}

            </span>

            @else

            <span
                class="
                                status
                                status-planning
                            ">

                {{ $pt['planning'] }}

            </span>

            @endif


        </div>



        {{-- LOCATION --}}

        <div class="project-meta">

            ◉

            {{
                        $project->location
                        ??
                        '-'
                    }}

        </div>



        {{-- DATE --}}

        <div class="project-meta">

            ▦


            @if($project->start_date)

            {{
                            \Carbon\Carbon
                                ::parse(
                                    $project
                                        ->start_date
                                )
                                ->format(
                                    'd M Y'
                                )
                        }}

            @else

            -

            @endif


            &nbsp;–&nbsp;


            @if($project->target_end_date)

            {{
                            \Carbon\Carbon
                                ::parse(
                                    $project
                                        ->target_end_date
                                )
                                ->format(
                                    'd M Y'
                                )
                        }}

            @else

            -

            @endif

        </div>



        {{-- PROGRESS --}}

        <div class="progress-area">


            <div class="progress-track">

                <div

                    class="progress-fill"

                    data-progress="{{
                                $project
                                    ->progress_percentage
                                ??
                                0
                            }}"></div>

            </div>


            <span class="progress-value">

                {{
                            $project
                                ->progress_percentage
                            ??
                            0
                        }}%

            </span>


        </div>



        {{-- BUTTON --}}

        <div class="project-footer">

            <a

                href="{{
                            route(
                                'client.projects.show',
                                $project
                            )
                        }}"

                class="btn-detail">

                {{
                            $pt[
                                'view_detail'
                            ]
                        }}

            </a>

        </div>


    </div>


    @empty


    <div class="empty-state">


        <div class="empty-icon">

            🏠

        </div>


        <div class="empty-title">

            {{
                        $pt[
                            'empty_title'
                        ]
                    }}

        </div>


        <div class="empty-text">

            {{
                        $pt[
                            'empty_text'
                        ]
                    }}

        </div>


    </div>


    @endforelse


</div>


@endsection



@push('scripts')

<script>
    document
        .querySelectorAll(
            '.progress-fill'
        )
        .forEach(
            function(bar) {

                let progress =
                    parseInt(
                        bar.dataset.progress ||
                        '0'
                    );


                progress =
                    Math.max(
                        0,
                        Math.min(
                            100,
                            progress
                        )
                    );


                bar.style.width =
                    progress + '%';

            }
        );
</script>

@endpush