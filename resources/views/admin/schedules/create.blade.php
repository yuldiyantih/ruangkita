@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' =>
'Tambah Jadwal',

'schedule_data' =>
'Data Jadwal',

'add_schedule' =>
'Tambah Jadwal',

'subtitle' =>
'Tambahkan jadwal baru ke proyek RuangKita.',

'schedule_information' =>
'Informasi Jadwal',

'project' =>
'Proyek',

'select_project' =>
'Pilih Proyek',

'work' =>
'Pekerjaan',

'without_work' =>
'Tanpa Pekerjaan Terkait',

'schedule_title' =>
'Judul Jadwal',

'schedule_title_placeholder' =>
'Contoh: Pemasangan Keramik Lantai',

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

'description_placeholder' =>
'Masukkan keterangan jadwal',

'cancel' =>
'Batal',

'save' =>
'Simpan Jadwal',

],


'en' => [

'page_title' =>
'Add Schedule',

'schedule_data' =>
'Schedule Data',

'add_schedule' =>
'Add Schedule',

'subtitle' =>
'Add a new schedule to a RuangKita project.',

'schedule_information' =>
'Schedule Information',

'project' =>
'Project',

'select_project' =>
'Select Project',

'work' =>
'Work',

'without_work' =>
'No Related Work',

'schedule_title' =>
'Schedule Title',

'schedule_title_placeholder' =>
'Example: Floor Tile Installation',

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

'description_placeholder' =>
'Enter schedule description',

'cancel' =>
'Cancel',

'save' =>
'Save Schedule',

],

];


$st =
$translations[$pageLang]
??
$translations['id'];

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


        <span class="admin-breadcrumb-current">

            {{ $st['add_schedule'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $st['add_schedule'] }}

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
        action="{{ route('admin.schedules.store') }}"
        class="admin-form-card">

        @csrf



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


                    <option value="">

                        {{ $st['select_project'] }}

                    </option>


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old('project_id')==$project->id
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
                        old('work_id')==$work->id
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
                    value="{{ old('title') }}"
                    class="admin-form-control"
                    placeholder="{{ $st['schedule_title_placeholder'] }}"
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
                    value="{{ old('start_date') }}"
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
                    value="{{ old('end_date') }}"
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


                    <option
                        value="planned"
                        @selected(
                        old( 'status' , 'planned'
                        )==='planned'
                        )>

                        {{ $st['planned'] }}

                    </option>


                    <option
                        value="ongoing"
                        @selected(
                        old('status')==='ongoing'
                        )>

                        {{ $st['ongoing'] }}

                    </option>


                    <option
                        value="completed"
                        @selected(
                        old('status')==='completed'
                        )>

                        {{ $st['completed'] }}

                    </option>


                    <option
                        value="delayed"
                        @selected(
                        old('status')==='delayed'
                        )>

                        {{ $st['delayed'] }}

                    </option>


                    <option
                        value="cancelled"
                        @selected(
                        old('status')==='cancelled'
                        )>

                        {{ $st['cancelled'] }}

                    </option>


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
                    class="admin-form-control"
                    placeholder="{{ $st['description_placeholder'] }}">{{ old('description') }}</textarea>


            </div>


        </div>



        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.schedules.index') }}"
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