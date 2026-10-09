@extends('layouts.client')


@php

$dashboardLang =
auth()->user()->language
?? 'id';

$dashboardTranslations = [

'id' => [

'dashboard' =>
'Dashboard',

'welcome' =>
'Selamat datang',

'my_projects' =>
'Proyek Saya',

'ongoing' =>
'Berjalan',

'view_detail' =>
'Lihat Detail',

'empty_project' =>
'Belum ada proyek yang terhubung dengan akun Anda.',

'schedule' =>
'Jadwal',

'schedule_desc' =>
'Lihat jadwal pekerjaan proyek',

'progress' =>
'Progress',

'progress_desc' =>
'Pantau perkembangan proyek',

'documentation' =>
'Dokumentasi',

'documentation_desc' =>
'Lihat foto perkembangan proyek',

'ar' =>
'Augmented Reality',

'ar_desc' =>
'Coba visualisasi renovasi rumah Anda',

],


'en' => [

'dashboard' =>
'Dashboard',

'welcome' =>
'Welcome',

'my_projects' =>
'My Projects',

'ongoing' =>
'Ongoing',

'view_detail' =>
'View Details',

'empty_project' =>
'There are no projects connected to your account yet.',

'schedule' =>
'Schedule',

'schedule_desc' =>
'View your project work schedule',

'progress' =>
'Progress',

'progress_desc' =>
'Monitor project progress',

'documentation' =>
'Documentation',

'documentation_desc' =>
'View project progress photos',

'ar' =>
'Augmented Reality',

'ar_desc' =>
'Try visualizing your home renovation',

],

];


$dt =
$dashboardTranslations[$dashboardLang]
??
$dashboardTranslations['id'];

@endphp


@section(
'title',
$dt['dashboard'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .dashboard-header {

        margin-bottom: 22px;
    }


    .dashboard-header h1 {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .dashboard-header p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       SECTION
    ===================================================== */

    .section-title {

        margin-bottom: 13px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    /* =====================================================
       PROJECT CARD
    ===================================================== */

    .project-card {

        margin-bottom: 22px;

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .project-content {

        display: grid;

        grid-template-columns:
            180px 1fr auto;

        align-items: center;

        gap: 18px;
    }


    .project-image {

        width: 180px;
        height: 120px;

        border-radius: 10px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dbeaf7,
                #edf5fa);
    }


    body.dark-mode .project-image {

        background:
            linear-gradient(135deg,
                #223746,
                #172735);
    }


    .project-info h3 {

        margin-bottom: 10px;

        color:
            var(--text-heading);

        font-size: 16px;
    }


    .project-meta {

        margin-bottom: 6px;

        color:
            var(--text-muted);

        font-size: 12px;
    }


    /* =====================================================
       PROJECT STATUS
    ===================================================== */

    .project-status {

        display: inline-flex;

        margin-left: 5px;

        padding:
            4px 8px;

        border-radius: 15px;

        background: #ddf8eb;

        color: #158158;

        font-size: 10px;

        font-weight: 600;
    }


    body.dark-mode .project-status {

        background: #163d31;

        color: #77ddb0;
    }


    /* =====================================================
       PROJECT PROGRESS
    ===================================================== */

    .project-progress {

        margin-top: 12px;

        display: flex;

        align-items: center;

        gap: 9px;
    }


    .progress-track {

        width: 190px;
        height: 8px;

        overflow: hidden;

        border-radius: 20px;

        background: #e1e8ee;
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
                #1584df,
                #1da3eb);

        transition:
            width .4s ease;
    }


    .progress-number {

        color:
            var(--primary);

        font-size: 12px;

        font-weight: 700;
    }


    /* =====================================================
       DETAIL BUTTON
    ===================================================== */

    .btn-detail {

        height: 38px;

        padding:
            0 17px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        color: white;

        background:
            linear-gradient(90deg,
                #075ba0,
                #087ac9);

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;

        transition: .2s;
    }


    .btn-detail:hover {

        opacity: .9;

        transform:
            translateY(-1px);
    }


    /* =====================================================
       QUICK FEATURES
    ===================================================== */

    .quick-grid {

        display: grid;

        grid-template-columns:
            repeat(4,
                1fr);

        gap: 14px;
    }


    .quick-card {

        min-height: 105px;

        padding: 17px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        display: flex;

        gap: 12px;

        color:
            var(--text-main);

        text-decoration: none;

        box-shadow:
            var(--shadow);

        transition: .2s;
    }


    .quick-card:hover {

        transform:
            translateY(-2px);

        box-shadow:
            0 9px 20px rgba(23,
                54,
                80,
                .07);
    }


    body.dark-mode .quick-card:hover {

        border-color: #3a566b;

        box-shadow:
            0 8px 20px rgba(0,
                0,
                0,
                .18);
    }


    /* =====================================================
       QUICK ICON
    ===================================================== */

    .quick-icon {

        width: 42px;
        height: 42px;

        flex-shrink: 0;

        border-radius: 10px;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 19px;
    }


    .quick-icon.blue {

        color: #0679d5;

        background: #e8f3ff;
    }


    .quick-icon.green {

        color: #169260;

        background: #e1faee;
    }


    .quick-icon.orange {

        color: #e86b10;

        background: #fff0e1;
    }


    .quick-icon.ar {

        color: #1468c0;

        background: #e5f1ff;
    }


    body.dark-mode .quick-icon.blue {

        background: #18364e;
    }


    body.dark-mode .quick-icon.green {

        background: #173d31;
    }


    body.dark-mode .quick-icon.orange {

        background: #4a3020;
    }


    body.dark-mode .quick-icon.ar {

        background: #18364e;
    }


    /* =====================================================
       QUICK TEXT
    ===================================================== */

    .quick-title {

        margin:
            4px 0 5px;

        color:
            var(--text-heading);

        font-size: 13px;

        font-weight: 700;
    }


    .quick-description {

        color:
            var(--text-muted);

        font-size: 11px;

        line-height: 1.5;
    }


    /* =====================================================
       EMPTY PROJECT
    ===================================================== */

    .empty-project {

        margin-bottom: 20px;

        padding: 30px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 13px;

        box-shadow:
            var(--shadow);
    }


    /* =====================================================
       RESPONSIVE DASHBOARD
    ===================================================== */

    @media(max-width: 1000px) {

        .quick-grid {

            grid-template-columns:
                repeat(2,
                    1fr);
        }


        .project-content {

            grid-template-columns:
                150px 1fr;
        }


        .project-image {

            width: 150px;
        }


        .project-content .btn-detail {

            grid-column: 2;

            justify-self: start;
        }

    }


    @media(max-width: 600px) {

        .project-content {

            display: block;
        }


        .project-image {

            width: 100%;
            height: 190px;

            margin-bottom: 15px;
        }


        .btn-detail {

            margin-top: 15px;
        }


        .quick-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .progress-track {

            width: 100%;

            flex: 1;
        }

    }


    @media(max-width: 420px) {

        .quick-grid {

            grid-template-columns:
                1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         HEADER
    ====================================================== --}}

<div class="dashboard-header">

    <h1>

        {{ $dt['dashboard'] }}

    </h1>


    <p>

        {{ $dt['welcome'] }},

        {{ auth()->user()->name }}!

    </p>

</div>



{{-- =====================================================
         PROJECTS
    ====================================================== --}}

<div class="section-title">

    {{ $dt['my_projects'] }}

</div>



@forelse($projects as $project)


<div class="project-card">


    <div class="project-content">


        {{-- PROJECT IMAGE --}}

        @if($project->cover_image)

        <img

            class="project-image"

            src="{{
                            asset(
                                'storage/' .
                                $project->cover_image
                            )
                        }}"

            alt="{{
                            $project->project_name
                        }}">

        @else

        <div
            class="project-image"></div>

        @endif



        {{-- PROJECT INFO --}}

        <div class="project-info">


            <h3>

                {{
                            $project
                                ->project_name
                        }}


                @if(
                $project->status
                ===
                'ongoing'
                )

                <span
                    class="project-status">

                    {{
                                    $dt[
                                        'ongoing'
                                    ]
                                }}

                </span>

                @endif

            </h3>



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


                @if(
                $project
                ->start_date
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



            {{-- PROGRESS --}}

            <div class="project-progress">


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


                <span
                    class="progress-number">

                    {{
                                $project
                                    ->progress_percentage
                                ??
                                0
                            }}%

                </span>


            </div>


        </div>



        {{-- DETAIL --}}

        <a

            href="{{
                        route(
                            'client.projects.show',
                            $project
                        )
                    }}"

            class="btn-detail">

            {{
                        $dt[
                            'view_detail'
                        ]
                    }}

        </a>


    </div>


</div>


@empty


<div class="empty-project">

    {{
                $dt[
                    'empty_project'
                ]
            }}

</div>


@endforelse



{{-- =====================================================
         QUICK FEATURES
    ====================================================== --}}

<div class="quick-grid">


    {{-- SCHEDULE --}}

    <a

        href="{{
                route(
                    'client.schedule'
                )
            }}"

        class="quick-card">

        <div
            class="
                    quick-icon
                    blue
                ">

            ▦

        </div>


        <div>

            <div class="quick-title">

                {{
                        $dt[
                            'schedule'
                        ]
                    }}

            </div>


            <div class="quick-description">

                {{
                        $dt[
                            'schedule_desc'
                        ]
                    }}

            </div>

        </div>

    </a>



    {{-- PROGRESS --}}

    <a

        href="{{
                route(
                    'client.progress'
                )
            }}"

        class="quick-card">

        <div
            class="
                    quick-icon
                    green
                ">

            ↗

        </div>


        <div>

            <div class="quick-title">

                {{
                        $dt[
                            'progress'
                        ]
                    }}

            </div>


            <div class="quick-description">

                {{
                        $dt[
                            'progress_desc'
                        ]
                    }}

            </div>

        </div>

    </a>



    {{-- DOCUMENTATION --}}

    <a

        href="{{
                route(
                    'client.documentation'
                )
            }}"

        class="quick-card">

        <div
            class="
                    quick-icon
                    orange
                ">

            ▧

        </div>


        <div>

            <div class="quick-title">

                {{
                        $dt[
                            'documentation'
                        ]
                    }}

            </div>


            <div class="quick-description">

                {{
                        $dt[
                            'documentation_desc'
                        ]
                    }}

            </div>

        </div>

    </a>



    {{-- AUGMENTED REALITY --}}

    <a

        href="{{
                route(
                    'client.ar'
                )
            }}"

        class="quick-card">

        <div
            class="
                    quick-icon
                    ar
                ">

            ◇

        </div>


        <div>

            <div class="quick-title">

                {{
                        $dt[
                            'ar'
                        ]
                    }}

            </div>


            <div class="quick-description">

                {{
                        $dt[
                            'ar_desc'
                        ]
                    }}

            </div>

        </div>

    </a>


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

                let value =
                    parseFloat(
                        bar.dataset.progress ??
                        0
                    );


                if (
                    Number.isNaN(
                        value
                    )
                ) {

                    value = 0;

                }


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

            }
        );
</script>

@endpush