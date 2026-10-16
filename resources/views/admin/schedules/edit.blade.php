@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

/*
|--------------------------------------------------------------------------
| BAHASA INDONESIA
|--------------------------------------------------------------------------
*/

'id' => [

'page_title' =>
'Edit Jadwal',

'schedule_data' =>
'Data Jadwal',

'schedule_detail' =>
'Detail Jadwal',

'edit_schedule' =>
'Edit Jadwal',

'subtitle' =>
'Perbarui informasi jadwal proyek.',

'schedule_information' =>
'Informasi Jadwal',

'project' =>
'Proyek',

'work' =>
'Pekerjaan',

'without_work' =>
'Tanpa Pekerjaan Terkait',

'schedule_title' =>
'Judul Jadwal',

'start_date' =>
'Tanggal Mulai',

'end_date' =>
'Tanggal Selesai',

'status' =>
'Status',

'planned' =>
'Akan Datang',

'ongoing' =>
'Sedang Berjalan',

'completed' =>
'Selesai',

'delayed' =>
'Terlambat',

'cancelled' =>
'Dibatalkan',

'description' =>
'Deskripsi',

'cancel' =>
'Batal',

'save' =>
'Simpan Perubahan',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Edit Schedule',

'schedule_data' =>
'Schedule Data',

'schedule_detail' =>
'Schedule Detail',

'edit_schedule' =>
'Edit Schedule',

'subtitle' =>
'Update the project schedule information.',

'schedule_information' =>
'Schedule Information',

'project' =>
'Project',

'work' =>
'Work',

'without_work' =>
'No Related Work',

'schedule_title' =>
'Schedule Title',

'start_date' =>
'Start Date',

'end_date' =>
'End Date',

'status' =>
'Status',

'planned' =>
'Upcoming',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'delayed' =>
'Delayed',

'cancelled' =>
'Cancelled',

'description' =>
'Description',

'cancel' =>
'Cancel',

'save' =>
'Save Changes',

],

];


$st =
$translations[$pageLang]
??
$translations['id'];


/*
|--------------------------------------------------------------------------
| STATUS OPTIONS
|--------------------------------------------------------------------------
*/

$statusOptions = [

'planned' =>
$st['planned'],

'ongoing' =>
$st['ongoing'],

'completed' =>
$st['completed'],

'delayed' =>
$st['delayed'],

'cancelled' =>
$st['cancelled'],

];

@endphp



@section(
'title',
$st['page_title'] . ' - RuangKita'
)



@section('content')


<div style="max-width:1050px;">


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="admin-breadcrumb">


        <a href="{{ route('admin.schedules.index') }}">

            {{ $st['schedule_data'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <a href="{{ route('admin.schedules.show', $schedule) }}">

            {{ $st['schedule_detail'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $st['edit_schedule'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $st['edit_schedule'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $st['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.schedules.update', $schedule) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')



        <div class="admin-form-title">

            {{ $st['schedule_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- =================================================
                 PROJECT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $st['project'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="project_id"
                    id="scheduleProject"
                    class="admin-form-control"
                    required>


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old( 'project_id' ,
                        $schedule->project_id
                        ) == $project->id
                        )>

                        {{ $project->project_name }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- =================================================
                 WORK
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $st['work'] }}

                </label>


                <select
                    name="work_id"
                    id="scheduleWork"
                    class="admin-form-control">


                    <option value="">

                        {{ $st['without_work'] }}

                    </option>


                    @foreach($works as $work)

                    <option
                        value="{{ $work->id }}"
                        data-project="{{ $work->project_id }}"
                        @selected(
                        old( 'work_id' ,
                        $schedule->work_id
                        ) == $work->id
                        )>

                        {{ $work->work_name }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- =================================================
                 TITLE
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $st['schedule_title'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="title"
                    value="{{
                        old(
                            'title',
                            $schedule->title
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 START DATE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $st['start_date'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="date"
                    name="start_date"
                    value="{{
                        old(
                            'start_date',
                            $schedule->start_date
                                ? $schedule->start_date->format('Y-m-d')
                                : ''
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 END DATE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $st['end_date'] }}

                </label>


                <input
                    type="date"
                    name="end_date"
                    value="{{
                        old(
                            'end_date',
                            $schedule->end_date
                                ? $schedule->end_date->format('Y-m-d')
                                : ''
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- =================================================
                 STATUS
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $st['status'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="status"
                    class="admin-form-control"
                    required>


                    @foreach($statusOptions as $value => $label)

                    <option
                        value="{{ $value }}"
                        @selected(
                        old( 'status' ,
                        $schedule->status
                        ) === $value
                        )>

                        {{ $label }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $st['description'] }}

                </label>


                <textarea
                    name="description"
                    class="admin-form-control">{{ old('description', $schedule->description ?? '') }}</textarea>


            </div>


        </div>



        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.schedules.show', $schedule) }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $st['cancel'] }}

            </a>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $st['save'] }}

            </button>


        </div>


    </form>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {


            const projectSelect =
                document.getElementById(
                    'scheduleProject'
                );


            const workSelect =
                document.getElementById(
                    'scheduleWork'
                );



            function filterWorks() {


                const projectId =
                    projectSelect.value;


                Array.from(
                        workSelect.options
                    )
                    .forEach(
                        function(option) {


                            if (!option.value) {

                                option.hidden =
                                    false;

                                return;

                            }


                            option.hidden =
                                option.dataset.project !==
                                projectId;

                        }
                    );


                const selected =
                    workSelect
                    .selectedOptions[0];


                if (
                    selected &&
                    selected.value &&
                    selected.hidden
                ) {

                    workSelect.value =
                        '';

                }

            }



            projectSelect.addEventListener(
                'change',
                filterWorks
            );


            filterWorks();


        }
    );
</script>

@endpush