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
'Tambah Pengeluaran',

'expense_data' =>
'Data Pengeluaran',

'add_expense' =>
'Tambah Pengeluaran',

'subtitle' =>
'Tambahkan transaksi pengeluaran baru untuk proyek RuangKita.',

'error_title' =>
'Data belum dapat disimpan.',

'expense_information' =>
'Informasi Pengeluaran',

'project' =>
'Proyek',

'select_project' =>
'Pilih Proyek',

'related_material' =>
'Material Terkait',

'without_material' =>
'Tanpa Material Terkait',

'expense_date' =>
'Tanggal Pengeluaran',

'store_supplier' =>
'Toko / Supplier',

'store_placeholder' =>
'Contoh: Toko Bangunan Jaya',

'category' =>
'Kategori',

'select_category' =>
'Pilih Kategori',

'category_material' =>
'Material',

'category_labor' =>
'Upah',

'category_transport' =>
'Transportasi',

'category_equipment' =>
'Peralatan',

'category_other' =>
'Lain-lain',

'funding_source' =>
'Sumber Dana',

'project_fund' =>
'Dana Proyek',

'personal_fund' =>
'Uang Pribadi',

'amount' =>
'Jumlah Pengeluaran',

'receipt' =>
'Bukti Pengeluaran',

'receipt_help' =>
'JPG, JPEG, PNG, atau PDF. Maksimal 5 MB.',

'description' =>
'Keterangan',

'description_placeholder' =>
'Contoh: Pembelian semen Portland 50 zak',

'visible_to_client' =>
'Tampilkan pengeluaran ini kepada Client',

'cancel' =>
'Batal',

'save' =>
'Simpan Pengeluaran',

],


/*
|--------------------------------------------------------------------------
| ENGLISH
|--------------------------------------------------------------------------
*/

'en' => [

'page_title' =>
'Add Expense',

'expense_data' =>
'Expense Data',

'add_expense' =>
'Add Expense',

'subtitle' =>
'Add a new expense transaction for a RuangKita project.',

'error_title' =>
'The data could not be saved.',

'expense_information' =>
'Expense Information',

'project' =>
'Project',

'select_project' =>
'Select Project',

'related_material' =>
'Related Material',

'without_material' =>
'No Related Material',

'expense_date' =>
'Expense Date',

'store_supplier' =>
'Store / Supplier',

'store_placeholder' =>
'Example: Jaya Building Store',

'category' =>
'Category',

'select_category' =>
'Select Category',

'category_material' =>
'Material',

'category_labor' =>
'Labor',

'category_transport' =>
'Transportation',

'category_equipment' =>
'Equipment',

'category_other' =>
'Other',

'funding_source' =>
'Funding Source',

'project_fund' =>
'Project Fund',

'personal_fund' =>
'Personal Fund',

'amount' =>
'Expense Amount',

'receipt' =>
'Expense Receipt',

'receipt_help' =>
'JPG, JPEG, PNG, or PDF. Maximum 5 MB.',

'description' =>
'Description',

'description_placeholder' =>
'Example: Purchase of 50 bags of Portland cement',

'visible_to_client' =>
'Show this expense to the Client',

'cancel' =>
'Cancel',

'save' =>
'Save Expense',

],

];


$et =
$translations[$pageLang]
??
$translations['id'];

@endphp



@section(
'title',
$et['page_title'] . ' - RuangKita'
)



@section('content')


<div style="max-width: 1050px;">


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="admin-breadcrumb">


        <a href="{{ route('admin.expenses.index') }}">

            {{ $et['expense_data'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $et['add_expense'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $et['add_expense'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $et['subtitle'] }}

        </p>


    </div>



    {{-- =====================================================
         VALIDATION ERROR
    ====================================================== --}}

    @if($errors->any())

    <div
        class="admin-alert-error"
        style="margin-bottom:18px;">

        <strong>

            {{ $et['error_title'] }}

        </strong>


        <ul style="margin:8px 0 0 18px;">

            @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

            @endforeach

        </ul>


    </div>

    @endif



    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.expenses.store') }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf



        <div class="admin-form-title">

            {{ $et['expense_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- =================================================
                 PROJECT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['project'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="project_id"
                    id="expenseProject"
                    class="admin-form-control"
                    required>


                    <option value="">

                        {{ $et['select_project'] }}

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
                 MATERIAL
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['related_material'] }}

                </label>


                <select
                    name="material_id"
                    id="expenseMaterial"
                    class="admin-form-control">


                    <option value="">

                        {{ $et['without_material'] }}

                    </option>


                    @foreach($materials as $material)

                    <option
                        value="{{ $material->id }}"
                        data-project="{{ $material->project_id }}"
                        @selected(
                        old('material_id')==$material->id
                        )>

                        {{ $material->material_name }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- =================================================
                 DATE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['expense_date'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <input
                    type="date"
                    name="expense_date"
                    value="{{ old('expense_date') }}"
                    class="admin-form-control"
                    required>


            </div>



            {{-- =================================================
                 STORE / SUPPLIER
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['store_supplier'] }}

                </label>


                <input
                    type="text"
                    name="store_name"
                    value="{{ old('store_name') }}"
                    class="admin-form-control"
                    placeholder="{{ $et['store_placeholder'] }}">


            </div>



            {{-- =================================================
                 CATEGORY
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['category'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="category"
                    id="expenseCategory"
                    class="admin-form-control"
                    required>


                    <option value="">

                        {{ $et['select_category'] }}

                    </option>


                    <option
                        value="material"
                        @selected(
                        old('category')==='material'
                        )>

                        {{ $et['category_material'] }}

                    </option>


                    <option
                        value="labor"
                        @selected(
                        old('category')==='labor'
                        )>

                        {{ $et['category_labor'] }}

                    </option>


                    <option
                        value="transport"
                        @selected(
                        old('category')==='transport'
                        )>

                        {{ $et['category_transport'] }}

                    </option>


                    <option
                        value="equipment"
                        @selected(
                        old('category')==='equipment'
                        )>

                        {{ $et['category_equipment'] }}

                    </option>


                    <option
                        value="other"
                        @selected(
                        old('category')==='other'
                        )>

                        {{ $et['category_other'] }}

                    </option>


                </select>


            </div>



            {{-- =================================================
                 FUNDING SOURCE
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['funding_source'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="funding_source"
                    id="expenseFundingSource"
                    class="admin-form-control"
                    required>


                    <option
                        value="project"
                        @selected(
                        old( 'funding_source' , 'project'
                        )==='project'
                        )>

                        {{ $et['project_fund'] }}

                    </option>


                    <option
                        value="personal"
                        @selected(
                        old('funding_source')==='personal'
                        )>

                        {{ $et['personal_fund'] }}

                    </option>


                </select>


            </div>



            {{-- =================================================
                 AMOUNT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['amount'] }}

                    <span class="admin-required">
                        *
                    </span>

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



            {{-- =================================================
                 RECEIPT
            ================================================== --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['receipt'] }}

                </label>


                <input
                    type="file"
                    name="receipt"
                    id="expenseReceipt"
                    class="admin-form-control"
                    accept=".jpg,.jpeg,.png,.pdf">


                <small
                    style="
                        color:
                            var(--text-muted);
                    ">

                    {{ $et['receipt_help'] }}

                </small>


            </div>



            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $et['description'] }}

                </label>


                <textarea
                    name="description"
                    class="admin-form-control"
                    rows="4"
                    placeholder="{{ $et['description_placeholder'] }}">{{ old('description') }}</textarea>


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
                        false
                        )
                        )>


                    <span
                        class="admin-form-label"
                        style="margin:0;">

                        {{ $et['visible_to_client'] }}

                    </span>


                </label>


            </div>


        </div>



        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="admin-form-actions">


            <a
                href="{{ route('admin.expenses.index') }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">

                {{ $et['cancel'] }}

            </a>


            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">

                {{ $et['save'] }}

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
                    'expenseProject'
                );


            const materialSelect =
                document.getElementById(
                    'expenseMaterial'
                );


            const categorySelect =
                document.getElementById(
                    'expenseCategory'
                );



            /*
            |--------------------------------------------------------------------------
            | FILTER MATERIAL BY PROJECT
            |--------------------------------------------------------------------------
            */

            function filterMaterials() {


                const projectId =
                    projectSelect.value;


                Array.from(
                        materialSelect.options
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
                    materialSelect
                    .selectedOptions[0];


                if (
                    selected &&
                    selected.value &&
                    selected.hidden
                ) {

                    materialSelect.value =
                        '';

                }

            }



            /*
            |--------------------------------------------------------------------------
            | HANDLE CATEGORY
            |--------------------------------------------------------------------------
            */

            function handleCategory() {


                const category =
                    categorySelect.value;


                if (
                    category !==
                    'material'
                ) {

                    materialSelect.value =
                        '';

                }


                materialSelect.disabled =
                    category !==
                    'material';


                if (
                    category ===
                    'material'
                ) {

                    materialSelect.disabled =
                        false;

                    filterMaterials();

                }

            }



            /*
            |--------------------------------------------------------------------------
            | EVENTS
            |--------------------------------------------------------------------------
            */

            projectSelect.addEventListener(
                'change',
                filterMaterials
            );


            categorySelect.addEventListener(
                'change',
                handleCategory
            );



            /*
            |--------------------------------------------------------------------------
            | INITIAL STATE
            |--------------------------------------------------------------------------
            */

            filterMaterials();

            handleCategory();


        }
    );
</script>

@endpush