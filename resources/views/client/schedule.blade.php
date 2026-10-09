@extends('layouts.client')


@php

$scheduleLang = auth()->user()->language ?? 'id';

$scheduleTranslations = [

'id' => [

'title' => 'Jadwal',

'description' =>
'Semua jadwal pekerjaan proyek renovasi Anda',

'total_schedule' =>
'Total Jadwal',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'delayed' =>
'Terlambat',

'all' =>
'Semua',

'planned' =>
'Akan Datang',

'sort' =>
'Urutkan:',

'nearest_date' =>
'Tanggal Terdekat',

'view_project_schedule' =>
'Lihat Jadwal Proyek',

'no_schedule_description' =>
'Belum ada deskripsi jadwal.',

'no_schedule' =>
'Belum ada jadwal untuk proyek ini.',

'no_project' =>
'Belum ada proyek yang terhubung dengan akun Anda.',

],


'en' => [

'title' =>
'Schedule',

'description' =>
'All work schedules for your renovation projects',

'total_schedule' =>
'Total Schedule',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'delayed' =>
'Delayed',

'all' =>
'All',

'planned' =>
'Upcoming',

'sort' =>
'Sort:',

'nearest_date' =>
'Nearest Date',

'view_project_schedule' =>
'View Project Schedule',

'no_schedule_description' =>
'No schedule description available.',

'no_schedule' =>
'No schedule available for this project.',

'no_project' =>
'There are no projects connected to your account yet.',

],

];


$st =
$scheduleTranslations[$scheduleLang]
??
$scheduleTranslations['id'];


$totalSchedules = 0;
$ongoingSchedules = 0;
$completedSchedules = 0;
$delayedSchedules = 0;


foreach ($projects as $summaryProject) {

foreach ($summaryProject->schedules as $summarySchedule) {

$totalSchedules++;

if ($summarySchedule->status === 'ongoing') {
$ongoingSchedules++;
}

if ($summarySchedule->status === 'completed') {
$completedSchedules++;
}

if ($summarySchedule->status === 'delayed') {
$delayedSchedules++;
}

}

}

@endphp


@section(
'title',
$st['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .schedule-page-header {

        margin-bottom: 22px;
    }


    .schedule-page-header h1 {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 27px;
    }


    .schedule-page-header p {

        color:
            var(--text-muted);

        font-size: 13px;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .summary-grid {

        margin-bottom: 22px;

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 14px;
    }


    .summary-card {

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    .summary-label {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .summary-value {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    .summary-value.blue {

        color: #0874ca;
    }


    .summary-value.green {

        color: #14835c;
    }


    .summary-value.orange {

        color: #d76a14;
    }


    /* =====================================================
       TOOLBAR
    ===================================================== */

    .toolbar {

        margin-bottom: 18px;

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 14px;

        flex-wrap: wrap;
    }


    .filter-group {

        display: flex;

        gap: 9px;

        flex-wrap: wrap;
    }


    .filter-btn {

        padding:
            9px 15px;

        border: none;

        border-radius: 10px;

        background: #eaf1f7;

        color: #526a7e;

        font-size: 12px;

        font-weight: 600;

        cursor: pointer;
    }


    body.dark-mode .filter-btn {

        background: #273b4b;

        color: #b8c6d1;
    }


    .filter-btn.active {

        color: white;

        background:
            linear-gradient(90deg,
                #0767ae,
                #087dce);
    }


    .sort-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sort-label {
        color: var(--text-muted);
        font-size: 12px;
    }

    .sort-select {
        padding: 9px 13px;

        border: 1px solid var(--border);
        border-radius: 10px;

        background: var(--card-bg);
        color: var(--text-main);

        font-size: 12px;

        outline: none;
        cursor: pointer;
    }

    .sort-select:focus {
        border-color: var(--primary);
    }

    /* =====================================================
       PROJECT
    ===================================================== */

    .project-block {

        margin-bottom: 20px;
    }


    .project-header-card {

        padding:
            16px 18px;

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        gap: 15px;

        border:
            1px solid var(--border);

        border-radius:
            13px 13px 0 0;

        background:
            var(--card-bg);
    }


    .project-info {

        display: flex;

        align-items: center;

        gap: 13px;
    }


    .project-thumb {

        width: 68px;
        height: 52px;

        border-radius: 8px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dbeaf7,
                #edf5fa);
    }


    body.dark-mode .project-thumb {

        background:
            linear-gradient(135deg,
                #24394a,
                #172735);
    }


    .project-name {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .project-location {

        color:
            var(--text-muted);

        font-size: 11px;
    }


    .btn-project {

        padding:
            8px 12px;

        border-radius: 8px;

        background: #eaf4fd;

        color: #0873c7;

        text-decoration: none;

        font-size: 11px;

        font-weight: 600;
    }


    body.dark-mode .btn-project {

        background: #19364d;

        color: #72bdf5;
    }


    /* =====================================================
       SCHEDULE PANEL
    ===================================================== */

    .schedule-panel {

        padding: 20px;

        border-left:
            1px solid var(--border);

        border-right:
            1px solid var(--border);

        border-bottom:
            1px solid var(--border);

        border-radius:
            0 0 13px 13px;

        background:
            var(--card-bg);
    }


    /* =====================================================
       TIMELINE
    ===================================================== */

    .timeline {

        position: relative;

        margin-left: 13px;
    }


    .timeline::before {

        content: "";

        position: absolute;

        left: 12px;
        top: 6px;
        bottom: 6px;

        width: 2px;

        background:
            var(--border);
    }


    .timeline-item {

        position: relative;

        padding-left: 48px;

        padding-bottom: 25px;
    }


    .timeline-item:last-child {

        padding-bottom: 0;
    }


    .timeline-dot {

        position: absolute;

        left: 0;
        top: 1px;

        width: 26px;
        height: 26px;

        z-index: 2;

        border-radius: 50%;

        border:
            4px solid var(--card-bg);

        box-shadow:
            0 0 0 1px var(--border);

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 10px;
    }


    .timeline-dot.planned {

        background: #e7f2ff;

        color: #0874ca;
    }


    .timeline-dot.ongoing {

        background: #ddf8eb;

        color: #14835c;
    }


    .timeline-dot.completed {

        background: #e3f1ff;

        color: #126ab3;
    }


    .timeline-dot.delayed {

        background: #fff0e2;

        color: #c95f16;
    }


    body.dark-mode .timeline-dot.planned {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .timeline-dot.ongoing {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .timeline-dot.completed {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .timeline-dot.delayed {

        background: #49331e;

        color: #ffc976;
    }


    .timeline-card {

        padding-bottom: 16px;

        display: grid;

        grid-template-columns:
            125px 1fr auto;

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

        color: #d96a1e;

        font-size: 12px;

        font-weight: 700;
    }


    .timeline-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .timeline-description {

        color:
            var(--text-muted);

        font-size: 11px;

        line-height: 1.5;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .status-badge {

        display: inline-flex;

        padding:
            5px 9px;

        border-radius: 14px;

        white-space: nowrap;

        font-size: 10px;

        font-weight: 600;
    }


    .status-planned {

        background: #e7f2ff;

        color: #0874ca;
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


    body.dark-mode .status-planned {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .status-ongoing {

        background: #173d31;

        color: #79ddb0;
    }


    body.dark-mode .status-completed {

        background: #19364d;

        color: #72bdf5;
    }


    body.dark-mode .status-delayed {

        background: #49331e;

        color: #ffc976;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-project {

        padding: 26px;

        border:
            1px solid var(--border);

        border-radius: 12px;

        background:
            var(--card-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 13px;
    }


    .empty-schedule {

        padding: 25px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 12px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1000px) {

        .summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }


        .timeline-card {

            grid-template-columns:
                110px 1fr;
        }

    }


    @media(max-width: 600px) {

        .summary-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .project-header-card {

            align-items:
                flex-start;
        }


        .timeline-card {

            grid-template-columns:
                1fr;
        }


        .toolbar {

            align-items:
                stretch;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="schedule-page-header">

    <h1>

        {{ $st['title'] }}

    </h1>

    <p>

        {{ $st['description'] }}

    </p>

</div>



{{-- =====================================================
         SUMMARY
    ====================================================== --}}

<div class="summary-grid">


    <div class="summary-card">

        <div class="summary-label">

            {{ $st['total_schedule'] }}

        </div>

        <div class="summary-value blue">

            {{ $totalSchedules }}

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-label">

            {{ $st['ongoing'] }}

        </div>

        <div class="summary-value green">

            {{ $ongoingSchedules }}

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-label">

            {{ $st['completed'] }}

        </div>

        <div class="summary-value">

            {{ $completedSchedules }}

        </div>

    </div>



    <div class="summary-card">

        <div class="summary-label">

            {{ $st['delayed'] }}

        </div>

        <div class="summary-value orange">

            {{ $delayedSchedules }}

        </div>

    </div>


</div>



{{-- =====================================================
         FILTER
    ====================================================== --}}

<div class="toolbar">


    <div class="filter-group">


        <button

            type="button"

            class="filter-btn active"

            data-filter="all">

            {{ $st['all'] }}

        </button>



        <button

            type="button"

            class="filter-btn"

            data-filter="planned">

            {{ $st['planned'] }}

        </button>



        <button

            type="button"

            class="filter-btn"

            data-filter="ongoing">

            {{ $st['ongoing'] }}

        </button>



        <button

            type="button"

            class="filter-btn"

            data-filter="completed">

            {{ $st['completed'] }}

        </button>



        <button

            type="button"

            class="filter-btn"

            data-filter="delayed">

            {{ $st['delayed'] }}

        </button>


    </div>



    <div class="sort-wrapper">

        <span class="sort-label">
            {{ $st['sort'] }}
        </span>

        <select
            id="scheduleSort"
            class="sort-select">

            <option value="nearest">
                {{ $st['nearest_date'] }}
            </option>

            <option value="farthest">
                {{ $scheduleLang === 'en'
                ? 'Farthest Date'
                : 'Tanggal Terjauh'
            }}
            </option>

        </select>

    </div>


</div>



{{-- =====================================================
         PROJECTS + SCHEDULE
    ====================================================== --}}

@forelse($projects as $project)


<div class="project-block">


    <div class="project-header-card">


        <div class="project-info">


            @if($project->cover_image)

            <img

                src="{{
                                asset(
                                    'storage/' .
                                    $project
                                        ->cover_image
                                )
                            }}"

                class="project-thumb"

                alt="{{
                                $project
                                    ->project_name
                            }}">

            @else

            <div
                class="project-thumb"></div>

            @endif



            <div>


                <div class="project-name">

                    {{
                                $project
                                    ->project_name
                            }}

                </div>


                <div class="project-location">

                    ◉

                    {{
                                $project->location
                                ??
                                '-'
                            }}

                </div>


            </div>


        </div>



        <a

            href="{{
                        route(
                            'client.projects.schedule',
                            $project
                        )
                    }}"

            class="btn-project">

            {{
                        $st[
                            'view_project_schedule'
                        ]
                    }}

        </a>


    </div>



    <div class="schedule-panel">


        @if($project->schedules->count() > 0)


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
            $st['planned'],

            'ongoing'
            =>
            $st['ongoing'],

            'completed'
            =>
            $st['completed'],

            'delayed'
            =>
            $st['delayed'],

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

                            {{
                                                $schedule
                                                    ->title
                                            }}

                        </div>


                        <div
                            class="
                                                timeline-description
                                            ">

                            {{
                                                $schedule
                                                    ->description
                                                ?:
                                                $st[
                                                    'no_schedule_description'
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

                            {{
                                                $statusLabel
                                            }}

                        </span>

                    </div>


                </div>


            </div>


            @endforeach


        </div>


        @else


        <div class="empty-schedule">

            {{ $st['no_schedule'] }}

        </div>


        @endif


    </div>


</div>


@empty


<div class="empty-project">

    {{ $st['no_project'] }}

</div>


@endforelse


@endsection



@push('scripts')

```blade
@push('scripts')
<script>
    /*
    |--------------------------------------------------------------------------
    | FILTER SCHEDULE
    |--------------------------------------------------------------------------
    */

    const filterButtons = document.querySelectorAll('.filter-btn');
    const scheduleItems = document.querySelectorAll('.schedule-item');

    filterButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            filterButtons.forEach(function(btn) {
                btn.classList.remove('active');
            });

            button.classList.add('active');

            const filter = button.dataset.filter;

            scheduleItems.forEach(function(item) {
                const status = item.dataset.status;

                if (filter === 'all' || status === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });


    /*
    |--------------------------------------------------------------------------
    | SORT SCHEDULE
    |--------------------------------------------------------------------------
    */

    const scheduleSort = document.getElementById('scheduleSort');

    if (scheduleSort) {
        scheduleSort.addEventListener('change', function() {
            document.querySelectorAll('.timeline').forEach(function(timeline) {
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
        });
    }
</script>
@endpush