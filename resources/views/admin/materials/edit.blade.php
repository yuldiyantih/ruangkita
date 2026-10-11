@extends('layouts.admin')

@section('title', 'Edit Material - RuangKita')


@section('content')

<div style="max-width: 1050px;">

    <div class="admin-breadcrumb">
        <a href="{{ route('admin.materials.index') }}">
            Data Material
        </a>

        <span class="admin-breadcrumb-separator">/</span>

        <a href="{{ route('admin.materials.show', $material) }}">
            Detail Material
        </a>

        <span class="admin-breadcrumb-separator">/</span>

        <span class="admin-breadcrumb-current">
            Edit Material
        </span>
    </div>


    <div class="admin-page-header">
        <h1 class="admin-page-title">
            Edit Material
        </h1>

        <p class="admin-page-subtitle">
            Perbarui informasi material proyek.
        </p>
    </div>


    @if($errors->any())
    <div class="admin-alert-error" style="margin-bottom: 18px;">
        <strong>Data belum dapat disimpan.</strong>

        <ul style="margin: 8px 0 0 18px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form
        method="POST"
        action="{{ route('admin.materials.update', $material) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')


        <div class="admin-form-title">
            Informasi Material
        </div>


        <div class="admin-form-grid">

            <div class="admin-form-group">
                <label class="admin-form-label">
                    Proyek
                    <span class="admin-required">*</span>
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
                        $material->project_id
                        ) == $project->id
                        )
                        >
                        {{ $project->project_name }}
                        -
                        {{ optional($project->client)->user->name ?? '-' }}
                    </option>

                    @endforeach
                </select>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Nama Material
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="text"
                    name="material_name"
                    value="{{ old('material_name', $material->material_name) }}"
                    class="admin-form-control"
                    required>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Jumlah
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="number"
                    name="quantity"
                    id="materialQuantity"
                    value="{{ old('quantity', $material->quantity) }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Satuan
                </label>

                <input
                    type="text"
                    name="unit"
                    value="{{ old('unit', $material->unit) }}"
                    class="admin-form-control"
                    placeholder="Contoh: sak, m², batang, unit">
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Harga Satuan
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="number"
                    name="unit_price"
                    id="materialUnitPrice"
                    value="{{ old('unit_price', $material->unit_price) }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Total Harga
                </label>

                <input
                    type="text"
                    id="materialTotalPreview"
                    class="admin-form-control"
                    readonly>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Supplier
                </label>

                <input
                    type="text"
                    name="supplier"
                    value="{{ old('supplier', $material->supplier) }}"
                    class="admin-form-control"
                    placeholder="Nama supplier / toko">
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Tanggal Pembelian
                </label>

                <input
                    type="date"
                    name="purchase_date"
                    value="{{
                        old(
                            'purchase_date',
                            $material->purchase_date
                                ? $material->purchase_date->format('Y-m-d')
                                : ''
                        )
                    }}"
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
                        $material->is_visible_to_client
                    )
                    )
                    >

                    <span class="admin-form-label" style="margin:0;">
                        Tampilkan material ini kepada Client
                    </span>
                </label>
            </div>

        </div>


        <div class="admin-form-actions">

            <a href="{{ route('admin.materials.show', $material) }}"
                class="admin-btn admin-btn-secondary">
                Batal
            </a>

            <button
                type="submit"
                class="admin-btn admin-btn-primary">
                Simpan Perubahan
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