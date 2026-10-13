@extends('layouts.admin')

@section('title', 'Tambah Pengeluaran - RuangKita')


@section('content')

<div style="max-width: 1050px;">

    <div class="admin-breadcrumb">
        <a href="{{ route('admin.expenses.index') }}">
            Data Pengeluaran
        </a>

        <span class="admin-breadcrumb-separator">/</span>

        <span class="admin-breadcrumb-current">
            Tambah Pengeluaran
        </span>
    </div>


    <div class="admin-page-header">
        <h1 class="admin-page-title">
            Tambah Pengeluaran
        </h1>

        <p class="admin-page-subtitle">
            Tambahkan transaksi pengeluaran baru untuk proyek RuangKita.
        </p>
    </div>


    @if($errors->any())
    <div class="admin-alert-error" style="margin-bottom:18px;">
        <strong>Data belum dapat disimpan.</strong>

        <ul style="margin:8px 0 0 18px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form
        method="POST"
        action="{{ route('admin.expenses.store') }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf


        <div class="admin-form-title">
            Informasi Pengeluaran
        </div>


        <div class="admin-form-grid">

            {{-- PROJECT --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Proyek
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="project_id"
                    id="expenseProject"
                    class="admin-form-control"
                    required>
                    <option value="">
                        Pilih Proyek
                    </option>

                    @foreach($projects as $project)
                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old('project_id')==$project->id
                        )
                        >
                        {{ $project->project_name }}
                        -
                        {{ optional($project->client)->user->name ?? '-' }}
                    </option>
                    @endforeach
                </select>
            </div>


            {{-- MATERIAL --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Material Terkait
                </label>

                <select
                    name="material_id"
                    id="expenseMaterial"
                    class="admin-form-control">
                    <option value="">
                        Tanpa Material Terkait
                    </option>

                    @foreach($materials as $material)
                    <option
                        value="{{ $material->id }}"
                        data-project="{{ $material->project_id }}"
                        @selected(
                        old('material_id')==$material->id
                        )
                        >
                        {{ $material->material_name }}
                    </option>
                    @endforeach
                </select>
            </div>


            {{-- DATE --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Tanggal Pengeluaran
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="date"
                    name="expense_date"
                    value="{{ old('expense_date') }}"
                    class="admin-form-control"
                    required>
            </div>


            {{-- STORE --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Toko / Supplier
                </label>

                <input
                    type="text"
                    name="store_name"
                    value="{{ old('store_name') }}"
                    class="admin-form-control"
                    placeholder="Contoh: Toko Bangunan Jaya">
            </div>


            {{-- CATEGORY --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Kategori
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="category"
                    id="expenseCategory"
                    class="admin-form-control"
                    required>
                    <option value="">
                        Pilih Kategori
                    </option>

                    <option value="material"
                        @selected(old('category')==='material' )}>
                        Material
                    </option>

                    <option value="labor"
                        @selected(old('category')==='labor' )}>
                        Upah
                    </option>

                    <option value="transport"
                        @selected(old('category')==='transport' )}>
                        Transportasi
                    </option>

                    <option value="equipment"
                        @selected(old('category')==='equipment' )}>
                        Peralatan
                    </option>

                    <option value="other"
                        @selected(old('category')==='other' )}>
                        Lain-lain
                    </option>
                </select>
            </div>


            {{-- FUNDING SOURCE --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Sumber Dana
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="funding_source"
                    id="expenseFundingSource"
                    class="admin-form-control"
                    required>
                    <option value="project"
                        @selected(
                        old('funding_source', 'project' )==='project'
                        )>
                        Dana Proyek
                    </option>

                    <option value="personal"
                        @selected(
                        old('funding_source')==='personal'
                        )>
                        Uang Pribadi
                    </option>
                </select>
            </div>


            {{-- AMOUNT --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Jumlah Pengeluaran
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="number"
                    name="amount"
                    value="{{ old('amount', 0) }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>
            </div>


            {{-- RECEIPT --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    Bukti Pengeluaran
                </label>

                <input
                    type="file"
                    name="receipt"
                    id="expenseReceipt"
                    class="admin-form-control"
                    accept=".jpg,.jpeg,.png,.pdf">

                <small style="color:var(--text-muted);">
                    JPG, JPEG, PNG, atau PDF. Maksimal 5 MB.
                </small>
            </div>


            {{-- DESCRIPTION --}}
            <div class="admin-form-group full">
                <label class="admin-form-label">
                    Keterangan
                </label>

                <textarea
                    name="description"
                    class="admin-form-control"
                    rows="4"
                    placeholder="Contoh: Pembelian semen Portland 50 zak">{{ old('description') }}</textarea>
            </div>


            {{-- VISIBILITY --}}
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
                        old('is_visible_to_client', false)
                        )>

                    <span class="admin-form-label" style="margin:0;">
                        Tampilkan pengeluaran ini kepada Client
                    </span>
                </label>
            </div>

        </div>


        <div class="admin-form-actions">

            <a
                href="{{ route('admin.expenses.index') }}"
                class="admin-btn admin-btn-secondary">
                Batal
            </a>

            <button
                type="submit"
                class="admin-btn admin-btn-primary">
                Simpan Pengeluaran
            </button>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const projectSelect =
            document.getElementById('expenseProject');

        const materialSelect =
            document.getElementById('expenseMaterial');

        const categorySelect =
            document.getElementById('expenseCategory');


        function filterMaterials() {

            const projectId =
                projectSelect.value;


            Array.from(materialSelect.options)
                .forEach(function(option) {

                    if (!option.value) {
                        option.hidden = false;
                        return;
                    }

                    option.hidden =
                        option.dataset.project !== projectId;
                });


            const selected =
                materialSelect.selectedOptions[0];


            if (
                selected &&
                selected.value &&
                selected.hidden
            ) {
                materialSelect.value = '';
            }
        }


        function handleCategory() {

            const category =
                categorySelect.value;


            if (category !== 'material') {
                materialSelect.value = '';
            }


            materialSelect.disabled =
                category !== 'material';


            if (category === 'material') {
                materialSelect.disabled = false;
                filterMaterials();
            }
        }


        projectSelect.addEventListener(
            'change',
            filterMaterials
        );


        categorySelect.addEventListener(
            'change',
            handleCategory
        );


        filterMaterials();
        handleCategory();

    });
</script>

@endpush