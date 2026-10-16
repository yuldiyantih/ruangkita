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
'Tambah Pekerjaan',

'work_data' =>
'Data Pekerjaan',

'add_work' =>
'Tambah Pekerjaan',

'subtitle' =>
'Tambahkan tahapan pekerjaan baru ke dalam proyek.',

'work_information' =>
'Informasi Pekerjaan',

'project' =>
'Proyek',

'select_project' =>
'Pilih Proyek',

'work_name' =>
'Nama Pekerjaan',

'work_name_placeholder' =>
'Contoh: Pemasangan Keramik',

'method_type' =>
'Metode Pekerjaan',

'select_method' =>
'Pilih Metode',

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

'volume_placeholder' =>
'Contoh: 100',

'unit' =>
'Satuan',

'unit_placeholder' =>
'Contoh: m², meter, unit',

'unit_price' =>
'Harga Satuan',

'duration' =>
'Durasi Pekerjaan',

'duration_placeholder' =>
'Jumlah hari',

'estimated_total' =>
'Estimasi Total Biaya',

'visible_to_client' =>
'Tampilkan pekerjaan ini kepada Client',

'cancel' =>
'Batal',

'save' =>
'Simpan Pekerjaan',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Add Work',

'work_data' =>
'Work Data',

'add_work' =>
'Add Work',

'subtitle' =>
'Add a new work stage to the project.',

'work_information' =>
'Work Information',

'project' =>
'Project',

'select_project' =>
'Select Project',

'work_name' =>
'Work Name',

'work_name_placeholder' =>
'Example: Ceramic Installation',

'method_type' =>
'Work Method',

'select_method' =>
'Select Method',

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

'volume_placeholder' =>
'Example: 100',

'unit' =>
'Unit',

'unit_placeholder' =>
'Example: m², meter, unit',

'unit_price' =>
'Unit Price',

'duration' =>
'Work Duration',

'duration_placeholder' =>
'Number of days',

'estimated_total' =>
'Estimated Total Cost',

'visible_to_client' =>
'Show this work to the Client',

'cancel' =>
'Cancel',

'save' =>
'Save Work',

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


        <span class="admin-breadcrumb-current">

            {{ $wt['add_work'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $wt['add_work'] }}

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
        action="{{ route('admin.works.store') }}"
        class="admin-form-card">

        @csrf



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


                    <option value="">

                        {{ $wt['select_project'] }}

                    </option>


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old('project_id')==$project->id
                        )>

                        {{ $project->project_name }}

                        -

                        {{
                                optional(
                                    optional(
                                        $project->client
                                    )->user
                                )->name
                                ??
                                '-'
                            }}

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
                    value="{{ old('work_name') }}"
                    class="admin-form-control"
                    placeholder="{{ $wt['work_name_placeholder'] }}"
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


                    <option value="">

                        {{ $wt['select_method'] }}

                    </option>


                    <option
                        value="daily"
                        @selected(
                        old('method_type')==='daily'
                        )>

                        {{ $wt['daily'] }}

                    </option>


                    <option
                        value="contract"
                        @selected(
                        old('method_type')==='contract'
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
                        old( 'status' , 'planned'
                        )==='planned'
                        )>

                        {{ $wt['planned'] }}

                    </option>


                    <option
                        value="ongoing"
                        @selected(
                        old('status')==='ongoing'
                        )>

                        {{ $wt['ongoing'] }}

                    </option>


                    <option
                        value="completed"
                        @selected(
                        old('status')==='completed'
                        )>

                        {{ $wt['completed'] }}

                    </option>


                    <option
                        value="cancelled"
                        @selected(
                        old('status')==='cancelled'
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
                    value="{{ old('volume') }}"
                    class="admin-form-control"
                    placeholder="{{ $wt['volume_placeholder'] }}">


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
                    value="{{ old('unit') }}"
                    class="admin-form-control"
                    placeholder="{{ $wt['unit_placeholder'] }}">


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
                    min="0"
                    step="0.01"
                    name="unit_price"
                    id="workUnitPrice"
                    value="{{ old('unit_price', 0) }}"
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
                    value="{{ old('duration_days') }}"
                    class="admin-form-control"
                    placeholder="{{ $wt['duration_placeholder'] }}">


            </div>



            {{-- =================================================
                 TOTAL PREVIEW
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $wt['estimated_total'] }}

                </label>


                <input
                    type="text"
                    id="workTotalPreview"
                    class="admin-form-control"
                    value="Rp 0"
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
                        true
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
                href="{{ route('admin.works.index') }}"
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