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
'Edit Pekerjaan',

'work_data' =>
'Data Pekerjaan',

'work_detail' =>
'Detail Pekerjaan',

'edit_work' =>
'Edit Pekerjaan',

'subtitle' =>
'Perbarui informasi pekerjaan proyek.',

'work_information' =>
'Informasi Pekerjaan',

'project' =>
'Proyek',

'work_name' =>
'Nama Pekerjaan',

'method_type' =>
'Metode Pekerjaan',

'daily' =>
'Harian',

'contract' =>
'Borongan',

'status' =>
'Status',

'planned' =>
'Belum Dimulai',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'cancelled' =>
'Dibatalkan',

'volume' =>
'Volume',

'unit' =>
'Satuan',

'unit_price' =>
'Harga Satuan',

'duration' =>
'Durasi Pekerjaan',

'total_cost' =>
'Total Biaya',

'visible_to_client' =>
'Tampilkan pekerjaan ini kepada Client',

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
'Edit Work',

'work_data' =>
'Work Data',

'work_detail' =>
'Work Detail',

'edit_work' =>
'Edit Work',

'subtitle' =>
'Update the project work information.',

'work_information' =>
'Work Information',

'project' =>
'Project',

'work_name' =>
'Work Name',

'method_type' =>
'Work Method',

'daily' =>
'Daily',

'contract' =>
'Contract',

'status' =>
'Status',

'planned' =>
'Not Started',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'cancelled' =>
'Cancelled',

'volume' =>
'Volume',

'unit' =>
'Unit',

'unit_price' =>
'Unit Price',

'duration' =>
'Work Duration',

'total_cost' =>
'Total Cost',

'visible_to_client' =>
'Show this work to the Client',

'cancel' =>
'Cancel',

'save' =>
'Save Changes',

],

];


$wt =
$translations[$pageLang]
??
$translations['id'];

@endphp



@section(
'title',
$wt['page_title'] . ' - RuangKita'
)



@section('content')


<div style="max-width: 1050px;">


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="admin-breadcrumb">


        <a href="{{ route('admin.works.index') }}">

            {{ $wt['work_data'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <a href="{{ route('admin.works.show', $work) }}">

            {{ $wt['work_detail'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $wt['edit_work'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $wt['edit_work'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $wt['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.works.update', $work) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')



        <div class="admin-form-title">

            {{ $wt['work_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- =================================================
                 PROJECT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['project'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="project_id"
                    class="admin-form-control"
                    required>


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old( 'project_id' ,
                        $work->project_id
                        ) == $project->id
                        )>

                        {{ $project->project_name }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- =================================================
                 WORK NAME
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['work_name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="work_name"
                    value="{{
                        old(
                            'work_name',
                            $work->work_name
                        )
                    }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 METHOD
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['method_type'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="method_type"
                    class="admin-form-control"
                    required>


                    <option
                        value="daily"
                        @selected(
                        old( 'method_type' ,
                        $work->method_type
                        ) === 'daily'
                        )>

                        {{ $wt['daily'] }}

                    </option>


                    <option
                        value="contract"
                        @selected(
                        old( 'method_type' ,
                        $work->method_type
                        ) === 'contract'
                        )>

                        {{ $wt['contract'] }}

                    </option>


                </select>


            </div>



            {{-- =================================================
                 STATUS
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['status'] }}

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
                        old( 'status' ,
                        $work->status
                        ) === 'planned'
                        )>

                        {{ $wt['planned'] }}

                    </option>


                    <option
                        value="ongoing"
                        @selected(
                        old( 'status' ,
                        $work->status
                        ) === 'ongoing'
                        )>

                        {{ $wt['ongoing'] }}

                    </option>


                    <option
                        value="completed"
                        @selected(
                        old( 'status' ,
                        $work->status
                        ) === 'completed'
                        )>

                        {{ $wt['completed'] }}

                    </option>


                    <option
                        value="cancelled"
                        @selected(
                        old( 'status' ,
                        $work->status
                        ) === 'cancelled'
                        )>

                        {{ $wt['cancelled'] }}

                    </option>


                </select>


            </div>



            {{-- =================================================
                 VOLUME
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['volume'] }}

                </label>


                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="volume"
                    id="workVolume"
                    value="{{
                        old(
                            'volume',
                            $work->volume
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- =================================================
                 UNIT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['unit'] }}

                </label>


                <input
                    type="text"
                    name="unit"
                    value="{{
                        old(
                            'unit',
                            $work->unit
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- =================================================
                 UNIT PRICE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['unit_price'] }}

                </label>


                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="unit_price"
                    id="workUnitPrice"
                    value="{{
                        old(
                            'unit_price',
                            $work->unit_price
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- =================================================
                 DURATION
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $wt['duration'] }}

                </label>


                <input
                    type="number"
                    min="1"
                    name="duration_days"
                    value="{{
                        old(
                            'duration_days',
                            $work->duration_days
                        )
                    }}"
                    class="admin-form-control">


            </div>



            {{-- =================================================
                 TOTAL COST
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $wt['total_cost'] }}

                </label>


                <input
                    type="text"
                    id="workTotalPreview"
                    class="admin-form-control"
                    readonly>


            </div>



            {{-- =================================================
                 VISIBILITY
            ================================================== --}}

            <div class="admin-form-group full">


                <label
                    style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                        cursor:pointer;
                    ">


                    <input
                        type="checkbox"
                        name="is_visible_to_client"
                        value="1"
                        @checked(
                        old( 'is_visible_to_client' ,
                        $work->is_visible_to_client
                    )
                    )>


                    <span
                        class="admin-form-label"
                        style="margin:0;">

                        {{ $wt['visible_to_client'] }}

                    </span>


                </label>


            </div>


        </div>



        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.works.show', $work) }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $wt['cancel'] }}

            </a>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $wt['save'] }}

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


            const volume =
                document.getElementById(
                    'workVolume'
                );


            const unitPrice =
                document.getElementById(
                    'workUnitPrice'
                );


            const preview =
                document.getElementById(
                    'workTotalPreview'
                );



            function calculateTotal() {


                const volumeValue =
                    parseFloat(
                        volume.value ||
                        0
                    );


                const priceValue =
                    parseFloat(
                        unitPrice.value ||
                        0
                    );


                const total =
                    volumeValue *
                    priceValue;


                preview.value =
                    new Intl.NumberFormat(
                        'id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        }
                    )
                    .format(total);


            }



            volume.addEventListener(
                'input',
                calculateTotal
            );


            unitPrice.addEventListener(
                'input',
                calculateTotal
            );


            calculateTotal();


        }
    );
</script>

@endpush