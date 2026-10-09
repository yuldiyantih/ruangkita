@extends('layouts.client')


@php

$projectDetailLang = auth()->user()->language ?? 'id';

$projectDetailTranslations = [

'id' => [

'projects' => 'Proyek Saya',
'title' => 'Detail Proyek',

'client' => 'Client',
'location' => 'Lokasi',
'start_date' => 'Tanggal Mulai',
'target_end' => 'Target Selesai',
'status' => 'Status',

'ongoing' => 'Berjalan',
'completed' => 'Selesai',
'paused' => 'Ditunda',
'planning' => 'Perencanaan',

'progress' => 'Progress',

'summary' => 'Ringkasan',
'schedule' => 'Jadwal',
'documentation' => 'Dokumentasi',
'costs' => 'Informasi Biaya',

'project_description' => 'Deskripsi Proyek',

'no_description' =>
'Belum ada deskripsi proyek.',

],


'en' => [

'projects' => 'My Projects',
'title' => 'Project Detail',

'client' => 'Client',
'location' => 'Location',
'start_date' => 'Start Date',
'target_end' => 'Target Completion',
'status' => 'Status',

'ongoing' => 'Ongoing',
'completed' => 'Completed',
'paused' => 'Paused',
'planning' => 'Planning',

'progress' => 'Progress',

'summary' => 'Summary',
'schedule' => 'Schedule',
'documentation' => 'Documentation',
'costs' => 'Cost Information',

'project_description' => 'Project Description',

'no_description' =>
'No project description available.',

],

];


$pdt =
$projectDetailTranslations[$projectDetailLang]
??
$projectDetailTranslations['id'];


$projectStatus =
$project->status
??
'planning';


$projectStatusLabel =
match ($projectStatus) {

'ongoing' =>
$pdt['ongoing'],

'completed' =>
$pdt['completed'],

'paused' =>
$pdt['paused'],

default =>
$pdt['planning'],

};

@endphp


@section(
'title',
$pdt['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE TITLE
    ===================================================== */

    .project-detail-title {

        margin-bottom: 20px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    /* =====================================================
       PROJECT CARD
    ===================================================== */

    .project-detail-card {

        margin-bottom: 20px;

        padding: 18px;

        display: grid;

        grid-template-columns:
            300px 1fr;

        gap: 22px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .project-detail-image {

        width: 100%;
        height: 205px;

        border-radius: 11px;

        object-fit: cover;

        background: #e2edf5;
    }


    body.dark-mode .project-detail-image {

        background: #263b4b;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .project-detail-header {

        margin-bottom: 15px;

        display: flex;

        justify-content:
            space-between;

        align-items:
            flex-start;

        gap: 10px;
    }


    .project-detail-name {

        color:
            var(--text-heading);

        font-size: 20px;

        font-weight: 700;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .project-status {

        padding:
            5px 10px;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 600;
    }


    .project-status.ongoing {

        background: #ddf8eb;

        color: #158158;
    }


    .project-status.completed {

        background: #e4f1ff;

        color: #126bb6;
    }


    .project-status.paused {

        background: #ffeadc;

        color: #b35b1e;
    }


    .project-status.planning {

        background: #fff3d3;

        color: #986500;
    }


    body.dark-mode .project-status.ongoing {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .project-status.completed {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .project-status.paused {

        background: #49301f;

        color: #f2ad78;
    }


    body.dark-mode .project-status.planning {

        background: #433a20;

        color: #f4cf78;
    }


    /* =====================================================
       DETAIL GRID
    ===================================================== */

    .detail-grid {

        display: grid;

        grid-template-columns:
            135px 1fr;

        row-gap: 8px;

        font-size: 12px;
    }


    .detail-label {

        color:
            var(--text-muted);
    }


    .detail-value {

        color:
            var(--text-main);

        font-weight: 500;
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    .progress-area {

        margin-top: 18px;
    }


    .progress-label {

        margin-bottom: 7px;

        display: flex;

        justify-content:
            space-between;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .progress-label strong {

        color:
            var(--primary);
    }


    .progress-track {

        height: 8px;

        overflow: hidden;

        border-radius: 30px;

        background: #e3eaf0;
    }


    body.dark-mode .progress-track {

        background: #304352;
    }


    .progress-fill {

        width: 0;

        height: 100%;

        border-radius: 30px;

        background:
            linear-gradient(90deg,
                #1484df,
                #21a3ec);
    }


    /* =====================================================
       TABS
    ===================================================== */

    .tabs {

        overflow: hidden;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .tab-menu {

        display: flex;

        overflow-x: auto;

        border-bottom:
            1px solid var(--border);
    }


    .tab-link {

        min-width: 120px;

        padding:
            15px 18px;

        border-bottom:
            3px solid transparent;

        color:
            var(--text-muted);

        text-align: center;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

        transition: .2s;
    }


    .tab-link:hover {

        color:
            var(--primary);
    }


    .tab-link.active {

        color:
            var(--primary);

        border-bottom-color:
            var(--primary);
    }


    .tab-content {

        padding: 20px;
    }


    .tab-content h3 {

        margin-bottom: 10px;

        color:
            var(--text-heading);

        font-size: 15px;
    }


    .tab-content p {

        color:
            var(--text-muted);

        font-size: 13px;

        line-height: 1.7;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 900px) {

        .project-detail-card {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 600px) {

        .project-detail-image {

            height: 190px;
        }


        .detail-grid {

            grid-template-columns:
                110px 1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="breadcrumb">

    <a
        href="{{ route('client.projects.index') }}">

        {{ $pdt['projects'] }}

    </a>

    &nbsp;›&nbsp;

    {{ $pdt['title'] }}

</div>



{{-- =====================================================
         TITLE
    ====================================================== --}}

<h1 class="project-detail-title">

    {{ $pdt['title'] }}

</h1>



{{-- =====================================================
         PROJECT DETAIL
    ====================================================== --}}

<div class="project-detail-card">


    <div>


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

            class="
                        project-detail-image
                    ">

        @else

        <div
            class="
                        project-detail-image
                    "></div>

        @endif


    </div>



    <div>


        <div class="project-detail-header">


            <div class="project-detail-name">

                {{
                        $project
                            ->project_name
                    }}

            </div>


            <span
                class="
                        project-status
                        {{
                            $projectStatus
                        }}
                    ">

                {{
                        $projectStatusLabel
                    }}

            </span>


        </div>



        {{-- =============================================
                 DETAIL
            ============================================== --}}

        <div class="detail-grid">


            <div class="detail-label">

                {{ $pdt['client'] }}

            </div>


            <div class="detail-value">

                {{
                        optional(
                            optional(
                                $project->client
                            )->user
                        )->name
                        ??
                        '-'
                    }}

            </div>



            <div class="detail-label">

                {{ $pdt['location'] }}

            </div>


            <div class="detail-value">

                {{
                        $project->location
                        ??
                        '-'
                    }}

            </div>



            <div class="detail-label">

                {{ $pdt['start_date'] }}

            </div>


            <div class="detail-value">

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

            </div>



            <div class="detail-label">

                {{ $pdt['target_end'] }}

            </div>


            <div class="detail-value">

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



            <div class="detail-label">

                {{ $pdt['status'] }}

            </div>


            <div class="detail-value">

                {{
                        $projectStatusLabel
                    }}

            </div>


        </div>



        {{-- =============================================
                 PROGRESS
            ============================================== --}}

        <div class="progress-area">


            <div class="progress-label">

                <span>

                    {{ $pdt['progress'] }}

                </span>


                <strong>

                    {{
                            $project
                                ->progress_percentage
                            ??
                            0
                        }}%

                </strong>

            </div>



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


        </div>


    </div>


</div>



{{-- =====================================================
         TABS
    ====================================================== --}}

<div class="tabs">


    <div class="tab-menu">


        <a

            href="{{
                    route(
                        'client.projects.show',
                        $project
                    )
                }}"

            class="tab-link active">

            {{ $pdt['summary'] }}

        </a>



        <a

            href="{{
                    route(
                        'client.projects.schedule',
                        $project
                    )
                }}"

            class="tab-link">

            {{ $pdt['schedule'] }}

        </a>



        <a

            href="{{
                    route(
                        'client.projects.progress',
                        $project
                    )
                }}"

            class="tab-link">

            {{ $pdt['progress'] }}

        </a>



        <a

            href="{{
                    route(
                        'client.documentation',
                        [
                            'project'
                            =>
                            $project->id
                        ]
                    )
                }}"

            class="tab-link">

            {{ $pdt['documentation'] }}

        </a>



        <a

            href="{{
                    route(
                        'client.costs',
                        [
                            'project'
                            =>
                            $project->id
                        ]
                    )
                }}"

            class="tab-link">

            {{ $pdt['costs'] }}

        </a>


    </div>



    <div class="tab-content">


        <h3>

            {{
                    $pdt[
                        'project_description'
                    ]
                }}

        </h3>


        <p>

            {{
                    $project->description
                    ?:
                    $pdt[
                        'no_description'
                    ]
                }}

        </p>


    </div>


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