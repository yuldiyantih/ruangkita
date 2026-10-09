@extends('layouts.client')


@php

$progressLang =
auth()->user()->language
?? 'id';

$progressTranslations = [

'id' => [

'title' =>
'Progress Proyek',

'description' =>
'Pantau perkembangan proyek renovasi Anda secara terperinci',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'paused' =>
'Ditunda',

'planning' =>
'Perencanaan',

'no_project_description' =>
'Belum ada deskripsi proyek.',

'total_progress' =>
'Total Progress',

'completed_stage' =>
'Tahap Selesai',

'ongoing_stage' =>
'Tahap Berjalan',

'next_stage' =>
'Tahap Berikutnya',

'work_stages' =>
'Daftar Tahap Pekerjaan',

'work_stages_desc' =>
'Pantau status setiap tahap pekerjaan renovasi',

'default_work_desc' =>
'Tahap pekerjaan proyek',

'work_completed' =>
'Selesai',

'work_ongoing' =>
'Sedang berjalan',

'work_pending' =>
'Belum dimulai',

'no_work' =>
'Belum ada tahap pekerjaan.',

'latest_progress' =>
'Update Progress Terbaru',

'latest_progress_desc' =>
'Riwayat perkembangan proyek terbaru',

'progress_label' =>
'Progress',

'default_progress_desc' =>
'Update perkembangan proyek.',

'no_progress' =>
'Belum ada update progress.',

'room_progress' =>
'Progress per Area/Ruangan',

'room_progress_desc' =>
'Persentase penyelesaian dan gambar setiap ruangan',

'default_room_desc' =>
'Belum ada keterangan progress ruangan.',

'no_room' =>
'Belum ada data area atau ruangan.',

'view_detail' =>
'Lihat Detail Progress',

'no_project' =>
'Belum ada proyek yang terhubung dengan akun Anda.',

],


'en' => [

'title' =>
'Project Progress',

'description' =>
'Monitor your renovation project progress in detail',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'paused' =>
'Paused',

'planning' =>
'Planning',

'no_project_description' =>
'No project description available.',

'total_progress' =>
'Total Progress',

'completed_stage' =>
'Completed Stages',

'ongoing_stage' =>
'Ongoing Stages',

'next_stage' =>
'Next Stages',

'work_stages' =>
'Work Stages',

'work_stages_desc' =>
'Monitor the status of each renovation work stage',

'default_work_desc' =>
'Project work stage',

'work_completed' =>
'Completed',

'work_ongoing' =>
'In Progress',

'work_pending' =>
'Not Started',

'no_work' =>
'No work stages available yet.',

'latest_progress' =>
'Latest Progress Updates',

'latest_progress_desc' =>
'Latest project progress history',

'progress_label' =>
'Progress',

'default_progress_desc' =>
'Project progress update.',

'no_progress' =>
'No progress updates available yet.',

'room_progress' =>
'Progress by Area / Room',

'room_progress_desc' =>
'Completion percentage and images for each room',

'default_room_desc' =>
'No room progress description available.',

'no_room' =>
'No area or room data available yet.',

'view_detail' =>
'View Progress Details',

'no_project' =>
'There are no projects connected to your account yet.',

],

];


$pt =
$progressTranslations[
$progressLang
]
??
$progressTranslations['id'];

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

    .progress-page-header {

        margin-bottom: 22px;
    }


    .progress-page-header h1 {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .progress-page-header p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       PROJECT CARD
    ===================================================== */

    .progress-project-card {

        margin-bottom: 22px;

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 14px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .project-overview {

        display: grid;

        grid-template-columns:
            200px 1fr 180px;

        gap: 22px;

        align-items: center;
    }


    .project-image {

        width: 200px;
        height: 135px;

        border-radius: 11px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dcebf8,
                #eef5fa);
    }


    body.dark-mode .project-image {

        background:
            linear-gradient(135deg,
                #24394a,
                #172735);
    }


    .project-title {

        margin-bottom: 8px;

        color:
            var(--text-heading);

        font-size: 20px;

        font-weight: 700;
    }


    .project-meta {

        color:
            var(--text-muted);

        font-size: 12px;

        line-height: 1.8;
    }


    .project-description {

        margin-top: 9px;

        color:
            var(--text-muted);

        font-size: 12px;

        line-height: 1.6;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .project-status {

        display: inline-flex;

        margin-top: 8px;

        padding:
            5px 10px;

        border-radius: 20px;

        background: #ddf8eb;

        color: #11815a;

        font-size: 10px;

        font-weight: 700;
    }


    body.dark-mode .project-status {

        background: #173c31;

        color: #79ddb0;
    }


    /* =====================================================
       CIRCULAR PROGRESS
    ===================================================== */

    .progress-circle {

        --progress: 0deg;

        width: 125px;
        height: 125px;

        margin: 0 auto;

        position: relative;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background:
            conic-gradient(#087ce0 var(--progress),
                #e1ecf5 0deg);
    }


    body.dark-mode .progress-circle {

        background:
            conic-gradient(#1594ef var(--progress),
                #304352 0deg);
    }


    .progress-circle::before {

        content: "";

        position: absolute;

        width: 92px;
        height: 92px;

        border-radius: 50%;

        background:
            var(--card-bg);
    }


    .progress-circle-value {

        position: relative;

        z-index: 2;

        color:
            var(--text-heading);

        font-size: 25px;

        font-weight: 700;
    }


    .progress-circle-label {

        margin-top: 8px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 11px;
    }


    /* =====================================================
       STATISTICS
    ===================================================== */

    .stats-grid {

        margin:
            18px 0;

        display: grid;

        grid-template-columns:
            repeat(4,
                1fr);

        gap: 13px;
    }


    .stat-card {

        padding: 15px;

        border:
            1px solid var(--border);

        border-radius: 11px;

        background:
            var(--input-bg);
    }


    .stat-title {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .stat-number {

        color:
            var(--text-heading);

        font-size: 22px;

        font-weight: 700;
    }


    .stat-blue {

        color: #087ae0;
    }


    .stat-green {

        color: #169260;
    }


    .stat-orange {

        color: #e47a20;
    }


    /* =====================================================
       LOWER GRID
    ===================================================== */

    .progress-content-grid {

        display: grid;

        grid-template-columns:
            1fr 1fr 1fr;

        gap: 15px;
    }


    .progress-panel {

        padding: 17px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);
    }


    .panel-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .panel-subtitle {

        margin-bottom: 17px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    /* =====================================================
       WORK STEPS
    ===================================================== */

    .work-step {

        padding:
            12px 0;

        display: flex;

        gap: 11px;

        border-bottom:
            1px solid var(--border);
    }


    .work-step:last-child {

        border-bottom: none;
    }


    .step-number {

        width: 25px;
        height: 25px;

        flex-shrink: 0;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e7f2ff;

        color: #0874ca;

        font-size: 10px;

        font-weight: 700;
    }


    .step-number.completed {

        background: #ddf8eb;

        color: #14835c;
    }


    body.dark-mode .step-number {

        background: #19364d;

        color: #68baff;
    }


    body.dark-mode .step-number.completed {

        background: #173d31;

        color: #7addb1;
    }


    .step-info {

        flex: 1;
    }


    .step-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .step-description {

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .step-status {

        padding:
            4px 7px;

        border-radius: 10px;

        white-space: nowrap;

        font-size: 9px;
    }


    .step-status.completed {

        color: #16825d;

        background: #dcf8ea;
    }


    .step-status.ongoing {

        color: #0874ca;

        background: #e4f1ff;
    }


    .step-status.pending {

        color: #7a8996;

        background: #edf1f5;
    }


    body.dark-mode .step-status.completed {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .step-status.ongoing {

        background: #19364d;

        color: #67baff;
    }


    body.dark-mode .step-status.pending {

        background: #2a3945;

        color: #b1c0cc;
    }


    /* =====================================================
       UPDATE PROGRESS
    ===================================================== */

    .update-item {

        padding:
            11px 0;

        display: grid;

        grid-template-columns:
            1fr 80px;

        gap: 10px;

        border-bottom:
            1px solid var(--border);
    }


    .update-item:last-child {

        border-bottom: none;
    }


    .update-date {

        margin-bottom: 5px;

        color:
            var(--primary);

        font-size: 10px;

        font-weight: 700;
    }


    .update-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .update-description {

        color:
            var(--text-muted);

        font-size: 10px;

        line-height: 1.5;
    }


    .update-image {

        width: 80px;
        height: 65px;

        border-radius: 8px;

        object-fit: cover;

        background: #e5edf4;
    }


    body.dark-mode .update-image {

        background: #2b4050;
    }


    /* =====================================================
       ROOM PROGRESS
    ===================================================== */

    .room-card {

        padding:
            10px 0 15px;

        border-bottom:
            1px solid var(--border);
    }


    .room-card:last-child {

        border-bottom: none;
    }


    .room-image {

        width: 100%;
        height: 120px;

        margin-bottom: 9px;

        border-radius: 9px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dcebf8,
                #eef5fa);
    }


    body.dark-mode .room-image {

        background:
            linear-gradient(135deg,
                #24394a,
                #172735);
    }


    .room-header {

        margin-bottom: 7px;

        display: flex;

        justify-content:
            space-between;

        gap: 10px;
    }


    .room-name {

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .room-percent {

        color:
            var(--primary);

        font-size: 12px;

        font-weight: 700;
    }


    .room-progress-track {

        height: 7px;

        overflow: hidden;

        border-radius: 20px;

        background: #e3eaf0;
    }


    body.dark-mode .room-progress-track {

        background: #304352;
    }


    .room-progress-fill {

        width: 0;

        height: 100%;

        border-radius: 20px;

        background:
            linear-gradient(90deg,
                #1484df,
                #21a3ec);
    }


    .room-description {

        margin-top: 7px;

        color:
            var(--text-muted);

        font-size: 9px;

        line-height: 1.5;
    }


    /* =====================================================
       BUTTON
    ===================================================== */

    .project-button-area {

        margin-top: 17px;

        display: flex;

        justify-content:
            flex-end;
    }


    .progress-detail-button {

        padding:
            10px 16px;

        border-radius: 8px;

        color: white;

        background:
            linear-gradient(90deg,
                #075ca3,
                #087acb);

        text-decoration: none;

        font-size: 11px;

        font-weight: 700;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-state {

        padding:
            35px 20px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 13px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1100px) {

        .progress-content-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .project-overview {

            grid-template-columns:
                170px 1fr;
        }


        .progress-circle-box {

            grid-column:
                1 / -1;
        }

    }


    @media(max-width: 650px) {

        .project-overview {

            grid-template-columns:
                1fr;
        }


        .project-image {

            width: 100%;
            height: 210px;
        }


        .stats-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .progress-content-grid {

            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


<div class="progress-page-header">

    <h1>

        {{ $pt['title'] }}

    </h1>

    <p>

        {{ $pt['description'] }}

    </p>

</div>



@forelse($projects as $project)


@php

$totalWorks =
$project
->works
->count();


$completedWorks =
$project
->works
->where(
'status',
'completed'
)
->count();


$ongoingWorks =
$project
->works
->where(
'status',
'ongoing'
)
->count();


$remainingWorks =
max(
0,
$totalWorks
-
$completedWorks
-
$ongoingWorks
);

@endphp



<div class="progress-project-card">


    {{-- PROJECT OVERVIEW --}}

    <div class="project-overview">


        @if(
        $project->cover_image
        )

        <img

            src="{{
                            asset(
                                'storage/' .
                                $project
                                    ->cover_image
                            )
                        }}"

            alt="{{
                            $project
                                ->project_name
                        }}"

            class="project-image">

        @else

        <div
            class="project-image"></div>

        @endif



        <div>


            <div class="project-title">

                {{
                            $project
                                ->project_name
                        }}

            </div>


            <div class="project-meta">

                ◉

                {{
                            $project->location
                            ??
                            '-'
                        }}

            </div>


            <div class="project-meta">

                ▦


                @if(
                $project->start_date
                )

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


                @if(
                $project
                ->target_end_date
                )

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



            <div class="project-status">

                @if(
                $project->status
                ===
                'ongoing'
                )

                {{
                                $pt[
                                    'ongoing'
                                ]
                            }}

                @elseif(
                $project->status
                ===
                'completed'
                )

                {{
                                $pt[
                                    'completed'
                                ]
                            }}

                @elseif(
                $project->status
                ===
                'paused'
                )

                {{
                                $pt[
                                    'paused'
                                ]
                            }}

                @else

                {{
                                $pt[
                                    'planning'
                                ]
                            }}

                @endif

            </div>



            <div
                class="project-description">

                {{
                            $project
                                ->description
                            ?:
                            $pt[
                                'no_project_description'
                            ]
                        }}

            </div>


        </div>



        <div
            class="progress-circle-box">


            <div

                class="progress-circle"

                data-progress="{{
                            $project
                                ->progress_percentage
                            ??
                            0
                        }}">

                <span
                    class="
                                progress-circle-value
                            ">

                    {{
                                $project
                                    ->progress_percentage
                                ??
                                0
                            }}%

                </span>

            </div>


            <div
                class="
                            progress-circle-label
                        ">

                {{
                            $pt[
                                'total_progress'
                            ]
                        }}

            </div>


        </div>


    </div>



    {{-- STATISTICS --}}

    <div class="stats-grid">


        <div class="stat-card">

            <div class="stat-title">

                {{
                            $pt[
                                'total_progress'
                            ]
                        }}

            </div>

            <div
                class="
                            stat-number
                            stat-blue
                        ">

                {{
                            $project
                                ->progress_percentage
                            ??
                            0
                        }}%

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">

                {{
                            $pt[
                                'completed_stage'
                            ]
                        }}

            </div>

            <div
                class="
                            stat-number
                            stat-green
                        ">

                {{ $completedWorks }}

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">

                {{
                            $pt[
                                'ongoing_stage'
                            ]
                        }}

            </div>

            <div
                class="
                            stat-number
                            stat-orange
                        ">

                {{ $ongoingWorks }}

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-title">

                {{
                            $pt[
                                'next_stage'
                            ]
                        }}

            </div>

            <div class="stat-number">

                {{ $remainingWorks }}

            </div>

        </div>


    </div>



    {{-- LOWER CONTENT --}}

    <div
        class="
                    progress-content-grid
                ">


        {{-- WORK STAGES --}}

        <div class="progress-panel">


            <div class="panel-title">

                {{
                            $pt[
                                'work_stages'
                            ]
                        }}

            </div>


            <div class="panel-subtitle">

                {{
                            $pt[
                                'work_stages_desc'
                            ]
                        }}

            </div>

            @forelse($project->works->take(5) as $work)

            <div class="work-step">


                <div
                    class="
                                    step-number
                                    {{
                                        $work->status
                                        ===
                                        'completed'
                                        ?
                                        'completed'
                                        :
                                        ''
                                    }}
                                ">

                    {{
                                    $loop
                                        ->iteration
                                }}

                </div>



                <div class="step-info">


                    <div class="step-title">

                        {{
                                        $work
                                            ->work_name
                                    }}

                    </div>


                    <div
                        class="
                                        step-description
                                    ">

                        {{
                                        $work
                                            ->description
                                        ??
                                        $pt[
                                            'default_work_desc'
                                        ]
                                    }}

                    </div>


                </div>



                @php

                $workStatus =
                $work->status
                ??
                'planned';

                @endphp



                @if(
                $workStatus
                ===
                'completed'
                )

                <span
                    class="
                                        step-status
                                        completed
                                    ">

                    {{
                                        $pt[
                                            'work_completed'
                                        ]
                                    }}

                </span>


                @elseif(
                $workStatus
                ===
                'ongoing'
                )

                <span
                    class="
                                        step-status
                                        ongoing
                                    ">

                    {{
                                        $pt[
                                            'work_ongoing'
                                        ]
                                    }}

                </span>


                @else

                <span
                    class="
                                        step-status
                                        pending
                                    ">

                    {{
                                        $pt[
                                            'work_pending'
                                        ]
                                    }}

                </span>

                @endif


            </div>


            @empty


            <div class="empty-state">

                {{
                                $pt[
                                    'no_work'
                                ]
                            }}

            </div>


            @endforelse


        </div>



        {{-- LATEST PROGRESS --}}

        <div class="progress-panel">


            <div class="panel-title">

                {{
                            $pt[
                                'latest_progress'
                            ]
                        }}

            </div>


            <div class="panel-subtitle">

                {{
                            $pt[
                                'latest_progress_desc'
                            ]
                        }}

            </div>

            @forelse($project->progressUpdates->take(4) as $update)

            <div class="update-item">


                <div>


                    <div class="update-date">

                        @if(
                        $update
                        ->update_date
                        )

                        {{
                                            \Carbon\Carbon
                                                ::parse(
                                                    $update
                                                        ->update_date
                                                )
                                                ->format(
                                                    'd M Y'
                                                )
                                        }}

                        @endif

                    </div>


                    <div
                        class="update-title">

                        {{
                                        $pt[
                                            'progress_label'
                                        ]
                                    }}

                        {{
                                        $update
                                            ->percentage
                                    }}%

                    </div>


                    <div
                        class="
                                        update-description
                                    ">

                        {{
                                        $update
                                            ->description
                                        ?:
                                        $pt[
                                            'default_progress_desc'
                                        ]
                                    }}

                    </div>


                </div>



                @if(
                $update
                ->photo_path
                )

                <img

                    src="{{
                                        asset(
                                            'storage/' .
                                            $update
                                                ->photo_path
                                        )
                                    }}"

                    alt="Progress"

                    class="
                                        update-image
                                    ">

                @else

                <div
                    class="
                                        update-image
                                    "></div>

                @endif


            </div>


            @empty


            <div class="empty-state">

                {{
                                $pt[
                                    'no_progress'
                                ]
                            }}

            </div>


            @endforelse


        </div>



        {{-- AREA PROGRESS --}}

        <div class="progress-panel">


            <div class="panel-title">

                {{
                            $pt[
                                'room_progress'
                            ]
                        }}

            </div>


            <div class="panel-subtitle">

                {{
                            $pt[
                                'room_progress_desc'
                            ]
                        }}

            </div>

            @forelse($project->areas->take(4) as $area)

            @php

            $areaProgress =
            $area
            ->progress_percentage
            ??
            0;

            @endphp



            <div class="room-card">


                @if(
                $area->photo
                )

                <img

                    src="{{
                                        asset(
                                            'storage/' .
                                            $area->photo
                                        )
                                    }}"

                    alt="{{
                                        $area
                                            ->area_name
                                    }}"

                    class="
                                        room-image
                                    ">

                @else

                <div
                    class="
                                        room-image
                                    "></div>

                @endif



                <div class="room-header">


                    <div class="room-name">

                        {{
                                        $area
                                            ->area_name
                                    }}

                    </div>


                    <div
                        class="
                                        room-percent
                                    ">

                        {{
                                        $areaProgress
                                    }}%

                    </div>


                </div>



                <div
                    class="
                                    room-progress-track
                                ">

                    <div

                        class="
                                        room-progress-fill
                                    "

                        data-progress="{{
                                        $areaProgress
                                    }}"></div>

                </div>



                <div
                    class="
                                    room-description
                                ">

                    {{
                                    $area
                                        ->description
                                    ?:
                                    $pt[
                                        'default_room_desc'
                                    ]
                                }}

                </div>


            </div>


            @empty


            <div class="empty-state">

                {{
                                $pt[
                                    'no_room'
                                ]
                            }}

            </div>


            @endforelse


        </div>


    </div>



    <div
        class="
                    project-button-area
                ">

        <a

            href="{{
                        route(
                            'client.projects.progress',
                            $project
                        )
                    }}"

            class="
                        progress-detail-button
                    ">

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

    {{
                $pt[
                    'no_project'
                ]
            }}

</div>


@endforelse


@endsection



@push('scripts')

<script>
    /*
    |--------------------------------------------------------------------------
    | CIRCULAR PROJECT PROGRESS
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.progress-circle'
        )
        .forEach(
            function(circle) {

                let progress =
                    parseInt(
                        circle
                        .dataset
                        .progress ||
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


                const degree =
                    progress * 3.6;


                circle
                    .style
                    .setProperty(
                        '--progress',
                        degree + 'deg'
                    );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | ROOM PROGRESS
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.room-progress-fill'
        )
        .forEach(
            function(bar) {

                let progress =
                    parseInt(
                        bar
                        .dataset
                        .progress ||
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