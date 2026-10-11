@extends('layouts.admin')


@section(
'title',
'Edit Jadwal - RuangKita'
)


@section('content')


<div style="max-width:1050px;">


    <div class="admin-breadcrumb">

        <a href="{{ route('admin.schedules.index') }}">
            Data Jadwal
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <a href="{{ route('admin.schedules.show', $schedule) }}">
            Detail Jadwal
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <span class="admin-breadcrumb-current">
            Edit Jadwal
        </span>

    </div>



    <div class="admin-page-header">

        <h1 class="admin-page-title">
            Edit Jadwal
        </h1>

        <p class="admin-page-subtitle">
            Perbarui informasi jadwal proyek.
        </p>

    </div>



    <form
        method="POST"
        action="{{ route('admin.schedules.update', $schedule) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')


        <div class="admin-form-title">
            Informasi Jadwal
        </div>


        <div class="admin-form-grid">


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Proyek
                    <span class="admin-required">*</span>
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
                        )
                        ==
                        $project->id
                        )
                        >

                        {{ $project->project_name }}

                    </option>

                    @endforeach

                </select>

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Pekerjaan
                </label>

                <select
                    name="work_id"
                    id="scheduleWork"
                    class="admin-form-control">

                    <option value="">
                        Tanpa Pekerjaan Terkait
                    </option>


                    @foreach($works as $work)

                    <option
                        value="{{ $work->id }}"
                        data-project="{{ $work->project_id }}"
                        @selected(
                        old( 'work_id' ,
                        $schedule->work_id
                        )
                        ==
                        $work->id
                        )
                        >

                        {{ $work->work_name }}

                    </option>

                    @endforeach

                </select>

            </div>


            <div class="admin-form-group full">

                <label class="admin-form-label">
                    Judul Jadwal
                    <span class="admin-required">*</span>
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


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Tanggal Mulai
                    <span class="admin-required">*</span>
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


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Tanggal Selesai
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


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Status
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="status"
                    class="admin-form-control"
                    required>

                    @foreach([
                    'planned' => 'Akan Datang',
                    'ongoing' => 'Sedang Berjalan',
                    'completed' => 'Selesai',
                    'delayed' => 'Terlambat',
                    'cancelled' => 'Dibatalkan'
                    ] as $value => $label)

                    <option
                        value="{{ $value }}"
                        @selected(
                        old( 'status' ,
                        $schedule->status
                        )
                        ===
                        $value
                        )
                        >
                        {{ $label }}
                    </option>

                    @endforeach

                </select>

            </div>


            <div class="admin-form-group full">

                <label class="admin-form-label">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    class="admin-form-control">{{ old('description', $schedule->description ?? '') }}</textarea>

            </div>


        </div>


        <div class="admin-form-actions">

            <a
                href="{{ route('admin.schedules.show', $schedule) }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">
                Batal
            </a>

            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">
                Simpan Perubahan
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