@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' =>
'Tambah Material',

'material_data' =>
'Data Material',

'add_material' =>
'Tambah Material',

'subtitle' =>
'Tambahkan material baru ke dalam proyek RuangKita.',

'error_title' =>
'Data belum dapat disimpan.',

'material_information' =>
'Informasi Material',

'project' =>
'Proyek',

'select_project' =>
'Pilih Proyek',

'material_name' =>
'Nama Material',

'material_name_placeholder' =>
'Contoh: Keramik 60x60',

'quantity' =>
'Jumlah',

'unit' =>
'Satuan',

'unit_placeholder' =>
'Contoh: sak, m², batang, unit',

'unit_price' =>
'Harga Satuan',

'total_price' =>
'Total Harga',

'supplier' =>
'Supplier',

'supplier_placeholder' =>
'Nama supplier / toko',

'purchase_date' =>
'Tanggal Pembelian',

'visible_to_client' =>
'Tampilkan material ini kepada Client',

'cancel' =>
'Batal',

'save' =>
'Simpan Material',

],


'en' => [

'page_title' =>
'Add Material',

'material_data' =>
'Material Data',

'add_material' =>
'Add Material',

'subtitle' =>
'Add a new material to the RuangKita project.',

'error_title' =>
'The data could not be saved.',

'material_information' =>
'Material Information',

'project' =>
'Project',

'select_project' =>
'Select Project',

'material_name' =>
'Material Name',

'material_name_placeholder' =>
'Example: 60x60 Ceramic Tile',

'quantity' =>
'Quantity',

'unit' =>
'Unit',

'unit_placeholder' =>
'Example: bag, m², rod, unit',

'unit_price' =>
'Unit Price',

'total_price' =>
'Total Price',

'supplier' =>
'Supplier',

'supplier_placeholder' =>
'Supplier / store name',

'purchase_date' =>
'Purchase Date',

'visible_to_client' =>
'Show this material to the Client',

'cancel' =>
'Cancel',

'save' =>
'Save Material',

],

];


$mt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@section(
'title',
$mt['page_title'] . ' - RuangKita'
)


@section('content')

<div style="max-width: 1050px;">


    <div class="admin-breadcrumb">

        <a href="{{ route('admin.materials.index') }}">

            {{ $mt['material_data'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $mt['add_material'] }}

        </span>

    </div>



    <div class="admin-page-header">

        <h1 class="admin-page-title">

            {{ $mt['add_material'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $mt['subtitle'] }}

        </p>

    </div>



    @if($errors->any())

    <div
        class="admin-alert-error"
        style="margin-bottom: 18px;">

        <strong>

            {{ $mt['error_title'] }}

        </strong>


        <ul style="margin: 8px 0 0 18px;">

            @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

            @endforeach

        </ul>

    </div>

    @endif



    <form
        method="POST"
        action="{{ route('admin.materials.store') }}"
        class="admin-form-card">

        @csrf



        <div class="admin-form-title">

            {{ $mt['material_information'] }}

        </div>



        <div class="admin-form-grid">


            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['project'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="project_id"
                    class="admin-form-control"
                    required>

                    <option value="">

                        {{ $mt['select_project'] }}

                    </option>


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old('project_id')==$project->id
                        )>

                        {{ $project->project_name }}
                        -
                        {{ optional($project->client)->user->name ?? '-' }}

                    </option>

                    @endforeach

                </select>

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['material_name'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="text"
                    name="material_name"
                    value="{{ old('material_name') }}"
                    class="admin-form-control"
                    placeholder="{{ $mt['material_name_placeholder'] }}"
                    required>

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['quantity'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="number"
                    name="quantity"
                    id="materialQuantity"
                    value="{{ old('quantity', 0) }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['unit'] }}

                </label>


                <input
                    type="text"
                    name="unit"
                    value="{{ old('unit') }}"
                    class="admin-form-control"
                    placeholder="{{ $mt['unit_placeholder'] }}">

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['unit_price'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="number"
                    name="unit_price"
                    id="materialUnitPrice"
                    value="{{ old('unit_price', 0) }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['total_price'] }}

                </label>


                <input
                    type="text"
                    id="materialTotalPreview"
                    class="admin-form-control"
                    value="Rp 0"
                    readonly>

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['supplier'] }}

                </label>


                <input
                    type="text"
                    name="supplier"
                    value="{{ old('supplier') }}"
                    class="admin-form-control"
                    placeholder="{{ $mt['supplier_placeholder'] }}">

            </div>



            <div class="admin-form-group">

                <label class="admin-form-label">

                    {{ $mt['purchase_date'] }}

                </label>


                <input
                    type="date"
                    name="purchase_date"
                    value="{{ old('purchase_date') }}"
                    class="admin-form-control">

            </div>



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
                        false
                        )
                        )>


                    <span
                        class="admin-form-label"
                        style="margin:0;">

                        {{ $mt['visible_to_client'] }}

                    </span>

                </label>

            </div>


        </div>



        <div class="admin-form-actions">

            <a
                href="{{ route('admin.materials.index') }}"
                class="admin-btn admin-btn-secondary">

                {{ $mt['cancel'] }}

            </a>


            <button
                type="submit"
                class="admin-btn admin-btn-primary">

                {{ $mt['save'] }}

            </button>

        </div>


    </form>


</div>

@endsection



@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const quantity =
            document.getElementById('materialQuantity');

        const unitPrice =
            document.getElementById('materialUnitPrice');

        const totalPreview =
            document.getElementById('materialTotalPreview');


        function calculateTotal() {

            const qty =
                parseFloat(quantity.value || 0);

            const price =
                parseFloat(unitPrice.value || 0);

            const total =
                qty * price;


            totalPreview.value =
                new Intl.NumberFormat(
                    'id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }
                ).format(total);
        }


        quantity.addEventListener(
            'input',
            calculateTotal
        );

        unitPrice.addEventListener(
            'input',
            calculateTotal
        );


        calculateTotal();
    });
</script>

@endpush