@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' =>
'Edit Pengeluaran',

'expense_data' =>
'Data Pengeluaran',

'expense_detail' =>
'Detail Pengeluaran',

'edit_expense' =>
'Edit Pengeluaran',

'subtitle' =>
'Perbarui informasi transaksi pengeluaran proyek.',

'error_title' =>
'Data belum dapat disimpan.',

'expense_information' =>
'Informasi Pengeluaran',

'project' =>
'Proyek',

'related_material' =>
'Material Terkait',

'without_material' =>
'Tanpa Material Terkait',

'expense_date' =>
'Tanggal Pengeluaran',

'store_supplier' =>
'Toko / Supplier',

'category' =>
'Kategori',

'material' =>
'Material',

'labor' =>
'Upah',

'transport' =>
'Transportasi',

'equipment' =>
'Peralatan',

'other' =>
'Lain-lain',

'funding_source' =>
'Sumber Dana',

'project_fund' =>
'Dana Proyek',

'personal_fund' =>
'Uang Pribadi',

'amount' =>
'Jumlah Pengeluaran',

'change_receipt' =>
'Ganti Bukti Pengeluaran',

'receipt_help' =>
'Bukti lama tetap digunakan jika tidak memilih file baru.',

'description' =>
'Keterangan',

'visible_to_client' =>
'Tampilkan pengeluaran ini kepada Client',

'cancel' =>
'Batal',

'save' =>
'Simpan Perubahan',

],


'en' => [

'page_title' =>
'Edit Expense',

'expense_data' =>
'Expense Data',

'expense_detail' =>
'Expense Detail',

'edit_expense' =>
'Edit Expense',

'subtitle' =>
'Update the project expense transaction information.',

'error_title' =>
'The data could not be saved.',

'expense_information' =>
'Expense Information',

'project' =>
'Project',

'related_material' =>
'Related Material',

'without_material' =>
'No Related Material',

'expense_date' =>
'Expense Date',

'store_supplier' =>
'Store / Supplier',

'category' =>
'Category',

'material' =>
'Material',

'labor' =>
'Labor',

'transport' =>
'Transportation',

'equipment' =>
'Equipment',

'other' =>
'Other',

'funding_source' =>
'Funding Source',

'project_fund' =>
'Project Fund',

'personal_fund' =>
'Personal Fund',

'amount' =>
'Expense Amount',

'change_receipt' =>
'Replace Expense Receipt',

'receipt_help' =>
'The existing receipt will remain in use if no new file is selected.',

'description' =>
'Description',

'visible_to_client' =>
'Show this expense to the Client',

'cancel' =>
'Cancel',

'save' =>
'Save Changes',

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


        <a href="{{ route('admin.expenses.show', $expense) }}">

            {{ $et['expense_detail'] }}

        </a>


        <span class="admin-breadcrumb-separator">
            /
        </span>


        <span class="admin-breadcrumb-current">

            {{ $et['edit_expense'] }}

        </span>


    </div>



    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="admin-page-header">


        <h1 class="admin-page-title">

            {{ $et['edit_expense'] }}

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
        action="{{ route('admin.expenses.update', $expense) }}"
        enctype="multipart/form-data"
        class="admin-form-card">

        @csrf
        @method('PUT')



        <div class="admin-form-title">

            {{ $et['expense_information'] }}

        </div>



        <div class="admin-form-grid">


            {{-- PROJECT --}}

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


                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old( 'project_id' ,
                        $expense->project_id
                        ) == $project->id
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



            {{-- MATERIAL --}}

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
                        old( 'material_id' ,
                        $expense->material_id
                        ) == $material->id
                        )>

                        {{ $material->material_name }}

                    </option>

                    @endforeach


                </select>


            </div>



            {{-- DATE --}}

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



            {{-- STORE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['store_supplier'] }}

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



            {{-- CATEGORY --}}

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


                    <option
                        value="material"
                        @selected(
                        old( 'category' ,
                        $expense->category
                        ) === 'material'
                        )>

                        {{ $et['material'] }}

                    </option>


                    <option
                        value="labor"
                        @selected(
                        old( 'category' ,
                        $expense->category
                        ) === 'labor'
                        )>

                        {{ $et['labor'] }}

                    </option>


                    <option
                        value="transport"
                        @selected(
                        old( 'category' ,
                        $expense->category
                        ) === 'transport'
                        )>

                        {{ $et['transport'] }}

                    </option>


                    <option
                        value="equipment"
                        @selected(
                        old( 'category' ,
                        $expense->category
                        ) === 'equipment'
                        )>

                        {{ $et['equipment'] }}

                    </option>


                    <option
                        value="other"
                        @selected(
                        old( 'category' ,
                        $expense->category
                        ) === 'other'
                        )>

                        {{ $et['other'] }}

                    </option>


                </select>


            </div>



            {{-- FUNDING SOURCE --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['funding_source'] }}

                    <span class="admin-required">
                        *
                    </span>

                </label>


                <select
                    name="funding_source"
                    class="admin-form-control"
                    required>


                    <option
                        value="project"
                        @selected(
                        old( 'funding_source' ,
                        $expense->funding_source
                        ) === 'project'
                        )>

                        {{ $et['project_fund'] }}

                    </option>


                    <option
                        value="personal"
                        @selected(
                        old( 'funding_source' ,
                        $expense->funding_source
                        ) === 'personal'
                        )>

                        {{ $et['personal_fund'] }}

                    </option>


                </select>


            </div>



            {{-- AMOUNT --}}

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



            {{-- RECEIPT --}}

            <div class="admin-form-group">


                <label class="admin-form-label">

                    {{ $et['change_receipt'] }}

                </label>


                <input
                    type="file"
                    name="receipt"
                    class="admin-form-control"
                    accept=".jpg,.jpeg,.png,.pdf">


                @if($expense->receipt_path)

                <small
                    style="
                            color:
                                var(--text-muted);
                        ">

                    {{ $et['receipt_help'] }}

                </small>

                @endif


            </div>



            {{-- DESCRIPTION --}}

            <div class="admin-form-group full">


                <label class="admin-form-label">

                    {{ $et['description'] }}

                </label>


                <textarea
                    name="description"
                    class="admin-form-control"
                    rows="4">{{ old('description', $expense->description ?? '') }}</textarea>


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
                        old( 'is_visible_to_client' ,
                        $expense->is_visible_to_client
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
                href="{{ route('admin.expenses.show', $expense) }}"
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


        }
    );
</script>

@endpush