@extends('layouts.admin')

@section('title', 'Data Material - RuangKita')

@php
$pageLang = auth()->user()->language ?? 'id';

$translations = [
'id' => [
'title' => 'Data Material',
'subtitle' => 'Kelola seluruh data material proyek RuangKita.',
'add_material' => 'Tambah Material',
'total_material' => 'Total Material',
'total_value' => 'Total Nilai Material',
'visible' => 'Ditampilkan ke Client',
'hidden' => 'Disembunyikan',
'list' => 'Daftar Material',
'search_placeholder' => 'Cari nama material...',
'all_projects' => 'Semua Proyek',
'all_suppliers' => 'Semua Supplier',
'all_visibility' => 'Semua Status',
'visible_option' => 'Ditampilkan',
'hidden_option' => 'Disembunyikan',
'search' => 'Cari',
'reset' => 'Reset',
'no' => 'No',
'material_name' => 'Nama Material',
'project' => 'Proyek',
'supplier' => 'Supplier',
'purchase_date' => 'Tanggal Beli',
'quantity' => 'Jumlah',
'unit_price' => 'Harga Satuan',
'total_price' => 'Total Harga',
'status' => 'Status',
'action' => 'Aksi',
'empty' => 'Belum ada data material.',
],

'en' => [
'title' => 'Materials',
'subtitle' => 'Manage all RuangKita project materials.',
'add_material' => 'Add Material',
'total_material' => 'Total Materials',
'total_value' => 'Total Material Value',
'visible' => 'Visible to Client',
'hidden' => 'Hidden',
'list' => 'Material List',
'search_placeholder' => 'Search material name...',
'all_projects' => 'All Projects',
'all_suppliers' => 'All Suppliers',
'all_visibility' => 'All Status',
'visible_option' => 'Visible',
'hidden_option' => 'Hidden',
'search' => 'Search',
'reset' => 'Reset',
'no' => 'No',
'material_name' => 'Material Name',
'project' => 'Project',
'supplier' => 'Supplier',
'purchase_date' => 'Purchase Date',
'quantity' => 'Quantity',
'unit_price' => 'Unit Price',
'total_price' => 'Total Price',
'status' => 'Status',
'action' => 'Action',
'empty' => 'No material data available.',
],
];

$mt = $translations[$pageLang] ?? $translations['id'];
@endphp


@push('styles')
<style>
    .material-page-header {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }

    .material-summary-grid {
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .material-summary-card {
        min-height: 105px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .material-summary-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
    }

    .material-summary-icon.blue {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .material-summary-icon.orange {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .material-summary-icon.green {
        background: var(--success-bg);
        color: var(--success);
    }

    .material-summary-icon.red {
        background: rgba(239, 68, 68, .12);
        color: #ef4444;
    }

    .material-summary-label {
        margin-bottom: 5px;
        color: var(--text-muted);
        font-size: 13px;
    }

    .material-summary-number {
        color: var(--text-heading);
        font-size: 23px;
        font-weight: 700;
    }

    .material-panel {
        overflow: hidden;
    }

    .material-panel-header {
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        border-bottom: 1px solid var(--border);
    }

    .material-panel-title {
        flex-shrink: 0;
        color: var(--text-heading);
        font-size: 17px;
        font-weight: 700;
    }

    .material-filter-form {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        flex-wrap: nowrap;
    }

    .material-search {
        width: 220px;
    }

    .material-project-filter {
        width: 190px;
    }

    .material-supplier-filter {
        width: 190px;
    }

    .material-visibility-filter {
        width: 165px;
    }

    .material-filter-form .admin-form-control {
        height: 44px;
        min-height: 44px;
    }

    .material-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .material-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 14px;
    }

    .material-action.view {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .material-action.edit {
        background: var(--warning-bg);
        color: var(--warning);
    }

    .material-empty {
        padding: 40px 20px !important;
        text-align: center;
        color: var(--text-muted) !important;
    }

    .material-pagination {
        padding: 16px 18px;
    }

    @media(max-width: 1250px) {
        .material-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .material-filter-form {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }

    @media(max-width: 900px) {
        .material-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 650px) {
        .material-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .material-summary-grid {
            grid-template-columns: 1fr;
        }

        .material-filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .material-search,
        .material-project-filter,
        .material-supplier-filter,
        .material-visibility-filter {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="material-page-header">
    <div>
        <h1 class="admin-page-title">
            {{ $mt['title'] }}
        </h1>

        <p class="admin-page-subtitle">
            {{ $mt['subtitle'] }}
        </p>
    </div>

    <a href="{{ route('admin.materials.create') }}"
        class="admin-btn admin-btn-primary">
        ＋ {{ $mt['add_material'] }}
    </a>
</div>


<div class="material-summary-grid">

    <div class="admin-card material-summary-card">
        <div class="material-summary-icon blue">
            ◆
        </div>

        <div>
            <div class="material-summary-label">
                {{ $mt['total_material'] }}
            </div>

            <div class="material-summary-number">
                {{ $totalMaterials }}
            </div>
        </div>
    </div>


    <div class="admin-card material-summary-card">
        <div class="material-summary-icon orange">
            Rp
        </div>

        <div>
            <div class="material-summary-label">
                {{ $mt['total_value'] }}
            </div>

            <div class="material-summary-number">
                Rp {{ number_format($totalMaterialValue, 0, ',', '.') }}
            </div>
        </div>
    </div>


    <div class="admin-card material-summary-card">
        <div class="material-summary-icon green">
            ◉
        </div>

        <div>
            <div class="material-summary-label">
                {{ $mt['visible'] }}
            </div>

            <div class="material-summary-number">
                {{ $visibleMaterials }}
            </div>
        </div>
    </div>


    <div class="admin-card material-summary-card">
        <div class="material-summary-icon red">
            ⊘
        </div>

        <div>
            <div class="material-summary-label">
                {{ $mt['hidden'] }}
            </div>

            <div class="material-summary-number">
                {{ $hiddenMaterials }}
            </div>
        </div>
    </div>

</div>


<div class="admin-card material-panel">

    <div class="material-panel-header">

        <div class="material-panel-title">
            {{ $mt['list'] }}
        </div>


        <form method="GET"
            action="{{ route('admin.materials.index') }}"
            class="material-filter-form">

            <input type="text"
                name="search"
                value="{{ $search }}"
                class="admin-form-control material-search"
                placeholder="{{ $mt['search_placeholder'] }}">


            <select name="project"
                class="admin-form-control material-project-filter">

                <option value="">
                    {{ $mt['all_projects'] }}
                </option>

                @foreach($projects as $project)

                <option value="{{ $project->id }}"
                    @selected(
                    (string) $projectId===(string) $project->id
                    )>
                    {{ $project->project_name }}
                </option>

                @endforeach

            </select>


            <select name="supplier"
                class="admin-form-control material-supplier-filter">

                <option value="">
                    {{ $mt['all_suppliers'] }}
                </option>

                @foreach($suppliers as $supplierItem)

                <option value="{{ $supplierItem }}"
                    @selected($supplier===$supplierItem)>
                    {{ $supplierItem }}
                </option>

                @endforeach

            </select>


            <select name="visibility"
                class="admin-form-control material-visibility-filter">

                <option value="">
                    {{ $mt['all_visibility'] }}
                </option>

                <option value="1"
                    @selected((string) $visibility==='1' )>
                    {{ $mt['visible_option'] }}
                </option>

                <option value="0"
                    @selected((string) $visibility==='0' )>
                    {{ $mt['hidden_option'] }}
                </option>

            </select>


            <button type="submit"
                class="admin-btn admin-btn-primary">
                {{ $mt['search'] }}
            </button>


            <a href="{{ route('admin.materials.index') }}"
                class="admin-btn admin-btn-secondary">
                {{ $mt['reset'] }}
            </a>

        </form>

    </div>


    <div class="admin-table-wrapper">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>{{ $mt['no'] }}</th>
                    <th>{{ $mt['material_name'] }}</th>
                    <th>{{ $mt['project'] }}</th>
                    <th>{{ $mt['supplier'] }}</th>
                    <th>{{ $mt['purchase_date'] }}</th>
                    <th>{{ $mt['quantity'] }}</th>
                    <th>{{ $mt['unit_price'] }}</th>
                    <th>{{ $mt['total_price'] }}</th>
                    <th>{{ $mt['status'] }}</th>
                    <th>{{ $mt['action'] }}</th>
                </tr>
            </thead>


            <tbody>

                @forelse($materials as $material)

                <tr>

                    <td>
                        {{ $materials->firstItem() + $loop->index }}
                    </td>


                    <td>
                        <strong>
                            {{ $material->material_name }}
                        </strong>
                    </td>


                    <td>
                        {{ $material->project->project_name ?? '-' }}
                    </td>


                    <td>
                        {{ $material->supplier ?? '-' }}
                    </td>


                    <td>
                        {{
                                $material->purchase_date
                                    ? $material->purchase_date->format('d M Y')
                                    : '-'
                            }}
                    </td>


                    <td>
                        {{ $material->quantity ?? 0 }}
                        {{ $material->unit ?? '' }}
                    </td>


                    <td>
                        Rp
                        {{
                                number_format(
                                    $material->unit_price,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}
                    </td>


                    <td>
                        <strong>
                            Rp
                            {{
                                    number_format(
                                        $material->total_price,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}
                        </strong>
                    </td>


                    <td>
                        @if($material->is_visible_to_client)

                        <span class="admin-badge admin-badge-success">
                            {{ $mt['visible_option'] }}
                        </span>

                        @else

                        <span class="admin-badge admin-badge-danger">
                            {{ $mt['hidden_option'] }}
                        </span>

                        @endif
                    </td>


                    <td>

                        <div class="material-actions">

                            <a href="{{ route('admin.materials.show', $material) }}"
                                class="material-action view"
                                title="Detail Material">
                                ◉
                            </a>

                            <a href="{{ route('admin.materials.edit', $material) }}"
                                class="material-action edit"
                                title="Edit Material">
                                ✎
                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="10"
                        class="material-empty">
                        {{ $mt['empty'] }}
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    @if($materials->hasPages())

    <div class="material-pagination">
        {{ $materials->links() }}
    </div>

    @endif

</div>

@endsection