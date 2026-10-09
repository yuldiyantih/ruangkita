@extends('layouts.client')


@php

$scheduleDetailLang = auth()->user()->language ?? 'id';

$scheduleDetailTranslations = [

'id' => [

'projects' => 'Proyek Saya',
'project_detail' => 'Detail Proyek',
'schedule' => 'Jadwal',

'title' => 'Jadwal Proyek',

'description' =>
'Daftar jadwal dan milestone proyek renovasi Anda',

'project_progress' =>
'Progress Proyek',

'all' =>
'Semua',

'planned' =>
'Akan Datang',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'delayed' =>
'Terlambat',

'sort' =>
'Urutkan:',

'nearest_date' =>
'Tanggal Terdekat',

'default_project_type' =>
'Renovasi Rumah',

'no_description' =>
'Belum ada deskripsi jadwal.',

'empty_title' =>
'Belum ada jadwal proyek.',

'empty_text' =>
'Jadwal akan muncul setelah dibuat oleh tim RuangKita.',

],


'en' => [

'projects' => 'My Projects',
'project_detail' => 'Project Detail',
'schedule' => 'Schedule',

'title' => 'Project Schedule',

'description' =>
'Project renovation schedule and milestone list',

'project_progress' =>
'Project Progress',

'all' =>
'All',

'planned' =>
'Upcoming',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'delayed' =>
'Delayed',

'sort' =>
'Sort:',

'nearest_date' =>
'Nearest Date',

'default_project_type' =>
'Home Renovation',

'no_description' =>
'No schedule description available.',

'empty_title' =>
'No project schedule yet.',

'empty_text' =>
'The schedule will appear after it is created by the RuangKita team.',

],

];


$sdt =
$scheduleDetailTranslations[$scheduleDetailLang]
??
$scheduleDetailTranslations['id'];

@endphp


@section(
'title',
$sdt['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .schedule-detail-header {

        margin-bottom: 22px;
    }


    .schedule-detail-header h1 {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .schedule-detail-header p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       PROJECT SUMMARY
    ===================================================== */

    .project-summary {

        margin-bottom: 20px;

        padding: 16px;

        display: grid;

        grid-template-columns:
            120px 1fr 320px;

        gap: 18px;

        align-items: center;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .project-thumb {

        width: 120px;
        height: 85px;

        border-radius: 9px;

        object-fit: cover;

        background: #e2edf5;
    }


    body.dark-mode .project-thumb {

        background: #263b4b;
    }


    .project-summary h3 {

        margin-bottom: 6px;

        color:
            var(--text-heading);

        font-size: 20px;
    }


    .project-meta {

        color:
            var(--text-muted);

        font-size: 13px;

        line-height: 1.8;
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    .progress-box {

        align-self: center;
    }


    .progress-label {

        margin-bottom: 8px;

        display: flex;

        justify-content:
            space-between;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .progress-label strong {

        color:
            var(--primary);
    }


    .progress-track {

        height: 10px;

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
       TOOLBAR
    ===================================================== */

    .schedule-toolbar {

        margin-bottom: 18px;

        display: flex;

        justify-content:
            space-between;

        align-items: center;

        gap: 14px;

        flex-wrap: wrap;
    }


    .filter-group {

        display: flex;

        gap: 10px;

        flex-wrap: wrap;
    }


    .filter-btn {

        padding:
            10px 18px;

        border: none;

        border-radius: 12px;

        background: #edf3f8;

        color: #486278;

        cursor: pointer;

        font-size: 13px;

        font-weight: 600;
    }


    body.dark-mode .filter-btn {

        background: #273b4b;

        color: #b9c7d2;
    }


    .filter-btn.active {

        background:
            var(--primary);

        color: white;
    }


    .sort-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sort-label {
        color: var(--text-muted);
        font-size: 13px;
    }

    .sort-select {
        padding: 10px 14px;

        border: 1px solid var(--border);
        border-radius: 12px;

        background: var(--card-bg);
        color: var(--text-main);

        font-size: 13px;

        outline: none;
        cursor: pointer;
    }

    .sort-select:focus {
        border-color: var(--primary);
    }

    /* =====================================================
       SCHEDULE PANEL
    ===================================================== */

    .schedule-detail-panel {

        margin-bottom: 20px;

        padding: 22px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    /* =====================================================
       TIMELINE
    ===================================================== */

    .timeline {

        position: relative;

        margin-left: 14px;
    }


    .timeline::before {

        content: "";

        position: absolute;

        top: 8px;
        bottom: 8px;
        left: 12px;

        width: 2px;

        background:
            var(--border);
    }


    .timeline-item {

        position: relative;

        padding-left: 50px;

        padding-bottom: 28px;
    }


    .timeline-item:last-child {

        padding-bottom: 0;
    }


    .timeline-dot {

        position: absolute;

        left: 0;
        top: 2px;

        z-index: 2;

        width: 26px;
        height: 26px;

        border:
            4px solid var(--card-bg);

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        box-shadow:
            0 0 0 1px var(--border);

        font-size: 11px;
    }


    .timeline-dot.planned {

        background: #e8f3ff;

        color: #0877d1;
    }


    .timeline-dot.ongoing {

        background: #dff8eb;

        color: #12835a;
    }


    .timeline-dot.completed {

        background: #e3f1ff;

        color: #126ab3;
    }


    .timeline-dot.delayed {

        background: #fff0e3;

        color: #d76a14;
    }


    body.dark-mode .timeline-dot.planned,
    body.dark-mode .timeline-dot.completed {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .timeline-dot.ongoing {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .timeline-dot.delayed {

        background: #49331e;

        color: #ffc976;
    }


    .timeline-card {

        padding-bottom: 18px;

        display: grid;

        grid-template-columns:
            150px 1fr auto auto;

        gap: 16px;

        align-items: center;

        border-bottom:
            1px solid var(--border);
    }


    .timeline-item:last-child .timeline-card {

        padding-bottom: 0;

        border-bottom: none;
    }


    .timeline-date {

        color: #e26c24;

        font-size: 14px;

        font-weight: 700;
    }


    .timeline-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 15px;

        font-weight: 700;
    }


    .timeline-description {

        color:
            var(--text-muted);

        font-size: 12px;

        line-height: 1.5;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .status-badge {

        padding:
            6px 10px;

        display: inline-flex;

        border-radius: 16px;

        white-space: nowrap;

        font-size: 11px;

        font-weight: 600;
    }


    .status-planned {

        background: #e7f2ff;

        color: #0874c9;
    }


    .status-ongoing {

        background: #ddf8eb;

        color: #14835c;
    }


    .status-completed {

        background: #e3f1ff;

        color: #126ab3;
    }


    .status-delayed {

        background: #fff0e2;

        color: #c95f16;
    }


    body.dark-mode .status-planned,
    body.dark-mode .status-completed {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .status-ongoing {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .status-delayed {

        background: #49331e;

        color: #ffc976;
    }


    /* =====================================================
       SCHEDULE PHOTO
    ===================================================== */

    .schedule-thumb {

        width: 72px;
        height: 52px;

        border-radius: 8px;

        object-fit: cover;

        background: #e8eef4;
    }


    body.dark-mode .schedule-thumb {

        background: #263b4b;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-panel {

        padding:
            35px 20px;

        display: flex;

        align-items: center;
        justify-content: center;

        gap: 16px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .empty-icon {

        width: 70px;
        height: 70px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #edf4fb;

        color:
            var(--primary);

        font-size: 28px;
    }


    body.dark-mode .empty-icon {

        background: #19364d;
    }


    .empty-title {

        margin-bottom: 6px;

        color:
            var(--text-heading);

        font-size: 20px;

        font-weight: 700;
    }


    .empty-text {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1000px) {

        .project-summary {

            grid-template-columns:
                120px 1fr;
        }


        .progress-box {

            grid-column:
                1 / -1;
        }


        .timeline-card {

            grid-template-columns:
                120px 1fr;
        }


        .timeline-card> :nth-child(3),
        .timeline-card> :nth-child(4) {

            margin-top: 10px;
        }

    }


    @media(max-width: 600px) {

        .project-summary {

            grid-template-columns:
                1fr;
        }


        .project-thumb {

            width: 100%;
            height: 180px;
        }


        .timeline-card {

            grid-template-columns:
                1fr;
        }


        .empty-panel {

            flex-direction: column;

            text-align: center;
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

        {{ $sdt['projects'] }}

    </a>

    &nbsp;›&nbsp;

    <a
        href="{{
                route(
                    'client.projects.show',
                    $project
                )
            }}">

        {{ $sdt['project_detail'] }}

    </a>

    &nbsp;›&nbsp;

    {{ $sdt['schedule'] }}

</div>



{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="schedule-detail-header">

    <h1>

        {{ $sdt['title'] }}

    </h1>

    <p>

        {{ $sdt['description'] }}

    </p>

</div>



{{-- =====================================================
         PROJECT SUMMARY
    ====================================================== --}}

<div class="project-summary">


    @if($project->cover_image)

    <img

        src="{{
                    asset(
                        'storage/' .
                        $project->cover_image
                    )
                }}"

        class="project-thumb"

        alt="{{
                    $project->project_name
                }}">

    @else

    <div class="project-thumb"></div>

    @endif



    <div>

        <h3>

            {{ $project->project_name }}

        </h3>


        <div class="project-meta">

            ◉
            {{
                    $project->location
                    ??
                    '-'
                }}

            <br>


            ▦

            @if($project->start_date)

            {{
                        \Carbon\Carbon
                            ::parse(
                                $project->start_date
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


            <br>


            ⌂
            {{
                    $project->project_type
                    ??
                    $sdt[
                        'default_project_type'
                    ]
                }}

        </div>

    </div>



    <div class="progress-box">


        <div class="progress-label">

            <span>

                {{
                        $sdt[
                            'project_progress'
                        ]
                    }}

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



{{-- =====================================================
         FILTER
    ====================================================== --}}

<div class="schedule-toolbar">


    <div class="filter-group">


        <button
            type="button"
            class="filter-btn active"
            data-filter="all">

            {{ $sdt['all'] }}

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="planned">

            {{ $sdt['planned'] }}

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="ongoing">

            {{ $sdt['ongoing'] }}

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="completed">

            {{ $sdt['completed'] }}

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="delayed">

            {{ $sdt['delayed'] }}

        </button>

    </div>

    <div class="sort-wrapper">

        <span class="sort-label">
            {{ $sdt['sort'] }}
        </span>

        <select
            id="scheduleSort"
            class="sort-select">
            <option value="nearest">
                {{ $sdt['nearest_date'] }}
            </option>

            <option value="farthest">
                {{ $scheduleDetailLang === 'en'
                ? 'Farthest Date'
                : 'Tanggal Terjauh'
            }}
            </option>
        </select>

    </div>

</div>



{{-- =====================================================
         SCHEDULE
    ====================================================== --}}

@if($project->schedules->count() > 0)


<div class="schedule-detail-panel">


    <div class="timeline">


        @foreach($project->schedules as $schedule)


        @php

        $status =
        $schedule->status
        ??
        'planned';


        $statusLabel =
        match ($status) {

        'planned'
        =>
        $sdt['planned'],

        'ongoing'
        =>
        $sdt['ongoing'],

        'completed'
        =>
        $sdt['completed'],

        'delayed'
        =>
        $sdt['delayed'],

        default
        =>
        ucfirst(
        $status
        ),
        };

        @endphp



        <div
            class="
        timeline-item
        schedule-item
    "

            data-status="{{ $status }}"

            data-date="{{
        $schedule->start_date
            ? \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d')
            : ''
    }}">

            <div
                class="
                                timeline-dot
                                {{
                                    $status
                                }}
                            ">

                ●

            </div>



            <div class="timeline-card">


                <div class="timeline-date">

                    @if($schedule->start_date)

                    {{
                                        \Carbon\Carbon
                                            ::parse(
                                                $schedule
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



                <div>


                    <div class="timeline-title">

                        {{ $schedule->title }}

                    </div>


                    <div class="timeline-description">

                        {{
                                        $schedule
                                            ->description
                                        ?:
                                        $sdt[
                                            'no_description'
                                        ]
                                    }}

                    </div>


                </div>



                <div>

                    <span
                        class="
                                        status-badge
                                        status-{{
                                            $status
                                        }}
                                    ">

                        {{ $statusLabel }}

                    </span>

                </div>



                <div>


                    @if(!empty($schedule->photo))

                    <img

                        src="{{
                                            asset(
                                                'storage/' .
                                                $schedule
                                                    ->photo
                                            )
                                        }}"

                        alt="{{
                                            $schedule
                                                ->title
                                        }}"

                        class="
                                            schedule-thumb
                                        ">

                    @else

                    <div
                        class="
                                            schedule-thumb
                                        "></div>

                    @endif


                </div>


            </div>


        </div>


        @endforeach


    </div>


</div>


@else


<div class="empty-panel">


    <div class="empty-icon">

        🗓

    </div>


    <div>

        <div class="empty-title">

            {{
                        $sdt[
                            'empty_title'
                        ]
                    }}

        </div>


        <div class="empty-text">

            {{
                        $sdt[
                            'empty_text'
                        ]
                    }}

        </div>

    </div>


</div>


@endif


@endsection



@push('scripts')

<script>
    /*
    |--------------------------------------------------------------------------
    | PROJECT PROGRESS
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | SCHEDULE FILTER
    |--------------------------------------------------------------------------
    */

    const filterButtons =
        document.querySelectorAll(
            '.filter-btn'
        );


    const scheduleItems =
        document.querySelectorAll(
            '.schedule-item'
        );


    filterButtons.forEach(
        function(button) {

            button.addEventListener(
                'click',
                function() {

                    filterButtons.forEach(
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
                        button.dataset.filter;


                    scheduleItems.forEach(
                        function(item) {

                            const status =
                                item.dataset.status;


                            item.style.display =
                                (
                                    filter === 'all' ||
                                    status === filter
                                ) ?
                                'block' :
                                'none';

                        }
                    );

                }
            );

        }
    );
</script>
@endpush

@push('scripts')
<script>
    const scheduleSort = document.getElementById('scheduleSort');

    if (scheduleSort) {
        scheduleSort.addEventListener('change', function() {
            const timeline = document.querySelector('.timeline');

            if (!timeline) {
                return;
            }

            const items = Array.from(
                timeline.querySelectorAll('.schedule-item')
            );

            items.sort(function(a, b) {
                const dateA = a.dataset.date ?
                    new Date(a.dataset.date) :
                    new Date('9999-12-31');

                const dateB = b.dataset.date ?
                    new Date(b.dataset.date) :
                    new Date('9999-12-31');

                if (scheduleSort.value === 'farthest') {
                    return dateB - dateA;
                }

                return dateA - dateB;
            });

            items.forEach(function(item) {
                timeline.appendChild(item);
            });
        });
    }
</script>
@endpush