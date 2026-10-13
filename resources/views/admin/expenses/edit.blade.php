@extends('layouts.admin')

@section('title', 'Edit Pengeluaran - RuangKita')


@section('content')

<div style="max-width: 1050px;">

    <div class="admin-breadcrumb">
        <a href="{{ route('admin.expenses.index') }}">
            Data Pengeluaran
        </a>

        <span class="admin-breadcrumb-separator">/</span>

        <a href="{{ route('admin.expenses.show', $expense) }}">
            Detail Pengeluaran
        </a>

        <span class="admin-breadcrumb-separator">/</span>

        <span class="admin-breadcrumb-current">
            Edit Pengeluaran
        </span>
    </div>


    <div class="admin-page-header">
        <h1 class="admin-page-title">
            Edit Pengeluaran
        </h1>

        <p class="admin-page-subtitle">
            Perbarui informasi transaksi pengeluaran proyek.
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
        action="{{ route('admin.expenses.update', $expense) }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf
        @method('PUT')


        <div class="admin-form-title">
            Informasi Pengeluaran
        </div>


        <div class="admin-form-grid">

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
                    @foreach($projects as $project)
                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old( 'project_id' ,
                        $expense->project_id
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
                        old( 'material_id' ,
                        $expense->material_id
                        ) == $material->id
                        )
                        >
                        {{ $material->material_name }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Tanggal Pengeluaran
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="date"
                    name="expense_date"
                    value="{{
                        old(
                            'expense_date',
                            $expense->expense_date
                                ? $expense->expense_date->format('Y-m-d')
                                : ''
                        )
                    }}"
                    class="admin-form-control"
                    required>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Toko / Supplier
                </label>

                <input
                    type="text"
                    name="store_name"
                    value="{{
                        old(
                            'store_name',
                            $expense->store_name
                        )
                    }}"
                    class="admin-form-control">
            </div>


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
                    <option value="material"
                        @selected(
                        old('category', $expense->category)
                        === 'material'
                        )>
                        Material
                    </option>

                    <option value="labor"
                        @selected(
                        old('category', $expense->category)
                        === 'labor'
                        )>
                        Upah
                    </option>

                    <option value="transport"
                        @selected(
                        old('category', $expense->category)
                        === 'transport'
                        )>
                        Transportasi
                    </option>

                    <option value="equipment"
                        @selected(
                        old('category', $expense->category)
                        === 'equipment'
                        )>
                        Peralatan
                    </option>

                    <option value="other"
                        @selected(
                        old('category', $expense->category)
                        === 'other'
                        )>
                        Lain-lain
                    </option>
                </select>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Sumber Dana
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="funding_source"
                    class="admin-form-control"
                    required>
                    <option value="project"
                        @selected(
                        old( 'funding_source' ,
                        $expense->funding_source
                        ) === 'project'
                        )>
                        Dana Proyek
                    </option>

                    <option value="personal"
                        @selected(
                        old( 'funding_source' ,
                        $expense->funding_source
                        ) === 'personal'
                        )>
                        Uang Pribadi
                    </option>
                </select>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Jumlah Pengeluaran
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="number"
                    name="amount"
                    value="{{
                        old(
                            'amount',
                            $expense->amount
                        )
                    }}"
                    class="admin-form-control"
                    min="0"
                    step="0.01"
                    required>
            </div>


            <div class="admin-form-group">
                <label class="admin-form-label">
                    Ganti Bukti Pengeluaran
                </label>

                <input
                    type="file"
                    name="receipt"
                    class="admin-form-control"
                    accept=".jpg,.jpeg,.png,.pdf">

                @if($expense->receipt_path)
                <small style="color:var(--text-muted);">
                    Bukti lama tetap digunakan jika tidak memilih file baru.
                </small>
                @endif
            </div>


            <div class="admin-form-group full">
                <label class="admin-form-label">
                    Keterangan
                </label>

                <textarea
                    name="description"
                    class="admin-form-control"
                    rows="4">{{ old('description', $expense->description ?? '') }}</textarea>
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
                        $expense->is_visible_to_client
                    )
                    )
                    >

                    <span class="admin-form-label" style="margin:0;">
                        Tampilkan pengeluaran ini kepada Client
                    </span>
                </label>
            </div>

        </div>


        <div class="admin-form-actions">
            <a
                href="{{ route('admin.expenses.show', $expense) }}"
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