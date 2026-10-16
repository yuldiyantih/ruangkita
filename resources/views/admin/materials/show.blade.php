@extends('layouts.admin')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'page_title' =>
'Detail Material',

'materials' =>
'Data Material',

'detail' =>
'Detail Material',

'subtitle' =>
'Informasi lengkap material proyek RuangKita.',

'edit' =>
'Edit Material',

'project' =>
'Proyek',

'client' =>
'Client',

'supplier' =>
'Supplier',

'purchase_date' =>
'Tanggal Pembelian',

'quantity' =>
'Jumlah',

'unit_price' =>
'Harga Satuan',

'total_price' =>
'Total Harga',

'visibility' =>
'Tampilan Client',

'visible' =>
'Ditampilkan ke Client',

'hidden' =>
'Disembunyikan dari Client',

],


'en' => [

'page_title' =>
'Material Detail',

'materials' =>
'Materials',

'detail' =>
'Material Detail',

'subtitle' =>
'Complete information about the RuangKita project material.',

'edit' =>
'Edit Material',

'project' =>
'Project',

'client' =>
'Client',

'supplier' =>
'Supplier',

'purchase_date' =>
'Purchase Date',

'quantity' =>
'Quantity',

'unit_price' =>
'Unit Price',

'total_price' =>
'Total Price',

'visibility' =>
'Client Visibility',

'visible' =>
'Visible to Client',

'hidden' =>
'Hidden from Client',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@section(
'title',
$dt['page_title'] . ' - RuangKita'
)


@push('styles')

<style>
    .material-detail-header {
        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }


    .material-detail-grid {
        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(3,
                minmax(0, 1fr));

        gap: 14px;
    }


    .material-detail-card {
        padding: 18px;
    }


    .material-detail-label {
        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .material-detail-value {
        color:
            var(--text-heading);

        font-size: 18px;

        font-weight: 700;
    }


    .material-info-panel {
        padding: 20px;
    }


    .material-info-title {
        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .material-info-row {
        padding: 12px 0;

        display: grid;

        grid-template-columns:
            190px minmax(0, 1fr);

        gap: 15px;

        border-bottom:
            1px solid var(--border);
    }


    .material-info-row:last-child {
        border-bottom: none;
    }


    .material-info-label {
        color:
            var(--text-muted);
    }


    .material-info-value {
        color:
            var(--text-main);

        font-weight: 500;
    }


    @media(max-width: 750px) {

        .material-detail-grid {
            grid-template-columns:
                1fr;
        }


        .material-detail-header {
            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .material-info-row {
            grid-template-columns:
                1fr;

            gap: 5px;
        }

    }
</style>

@endpush



@section('content')


<div class="admin-breadcrumb">


    <a href="{{ route('admin.materials.index') }}">

        {{ $dt['materials'] }}

    </a>


    <span class="admin-breadcrumb-separator">
        /
    </span>


    <span class="admin-breadcrumb-current">

        {{ $dt['detail'] }}

    </span>


</div>



<div class="material-detail-header">


    <div>


        <h1 class="admin-page-title">

            {{ $material->material_name }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>


    </div>


    <a
        href="{{ route('admin.materials.edit', $material) }}"
        class="admin-btn admin-btn-warning">

        ✎ {{ $dt['edit'] }}

    </a>


</div>



<div class="material-detail-grid">


    <div class="admin-card material-detail-card">


        <div class="material-detail-label">

            {{ $dt['project'] }}

        </div>


        <div class="material-detail-value">

            {{
                optional($material->project)->project_name
                ??
                '-'
            }}

        </div>


    </div>



    <div class="admin-card material-detail-card">


        <div class="material-detail-label">

            {{ $dt['client'] }}

        </div>


        <div class="material-detail-value">

            {{
                optional(
                    optional(
                        $material->project
                    )->client
                )->user->name
                ??
                '-'
            }}

        </div>


    </div>



    <div class="admin-card material-detail-card">


        <div class="material-detail-label">

            {{ $dt['total_price'] }}

        </div>


        <div class="material-detail-value">

            Rp
            {{
                number_format(
                    $material->total_price ?? 0,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>


    </div>


</div>



<div class="admin-card material-info-panel">


    <div class="material-info-title">

        {{ $dt['detail'] }}

    </div>



    <div class="material-info-row">


        <div class="material-info-label">

            {{ $dt['quantity'] }}

        </div>


        <div class="material-info-value">

            {{
                $material->quantity
                ??
                '-'
            }}

            {{
                $material->unit
                ??
                ''
            }}

        </div>


    </div>



    <div class="material-info-row">


        <div class="material-info-label">

            {{ $dt['unit_price'] }}

        </div>


        <div class="material-info-value">

            Rp
            {{
                number_format(
                    $material->unit_price ?? 0,
                    0,
                    ',',
                    '.'
                )
            }}

        </div>


    </div>



    <div class="material-info-row">


        <div class="material-info-label">

            {{ $dt['supplier'] }}

        </div>


        <div class="material-info-value">

            {{
                $material->supplier
                ??
                '-'
            }}

        </div>


    </div>



    <div class="material-info-row">


        <div class="material-info-label">

            {{ $dt['purchase_date'] }}

        </div>


        <div class="material-info-value">

            @if($material->purchase_date)

            {{
                    $material->purchase_date
                        ->locale($pageLang)
                        ->translatedFormat('d M Y')
                }}

            @else

            -

            @endif

        </div>


    </div>



    <div class="material-info-row">


        <div class="material-info-label">

            {{ $dt['visibility'] }}

        </div>


        <div class="material-info-value">


            @if($material->is_visible_to_client)

            <span class="admin-badge admin-badge-success">

                {{ $dt['visible'] }}

            </span>

            @else

            <span class="admin-badge admin-badge-danger">

                {{ $dt['hidden'] }}

            </span>

            @endif


        </div>


    </div>


</div>


@endsection