@extends('layouts.admin')

@section('title', 'Detail Uang Pribadi - RuangKita')


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' =>
'Detail Uang Pribadi',

'subtitle' =>
'Informasi lengkap penggunaan uang pribadi dan status penggantiannya.',

'back' =>
'Kembali',

'transaction_info' =>
'Informasi Transaksi',

'reimbursement_info' =>
'Informasi Penggantian',

'project' =>
'Proyek',

'client' =>
'Client',

'date' =>
'Tanggal Pengeluaran',

'team' =>
'Pengguna Uang Pribadi',

'description' =>
'Keterangan',

'category' =>
'Kategori',

'store' =>
'Toko / Supplier',

'amount' =>
'Jumlah',

'status' =>
'Status Penggantian',

'reimbursement_date' =>
'Tanggal Penggantian',

'notes' =>
'Catatan',

'created_by' =>
'Dicatat Oleh',

'receipt' =>
'Bukti Pengeluaran',

'view_receipt' =>
'Lihat Bukti',

'no_receipt' =>
'Tidak ada bukti pengeluaran',

'unpaid' =>
'Belum Diganti',

'paid' =>
'Sudah Diganti',

'mark_paid' =>
'Tandai Sudah Diganti',

'mark_unpaid' =>
'Batalkan Penggantian',

'funding_source' =>
'Sumber Dana',

'personal_fund' =>
'Uang Pribadi',

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

],


'en' => [

'title' =>
'Personal Fund Detail',

'subtitle' =>
'Complete information about personal fund usage and reimbursement status.',

'back' =>
'Back',

'transaction_info' =>
'Transaction Information',

'reimbursement_info' =>
'Reimbursement Information',

'project' =>
'Project',

'client' =>
'Client',

'date' =>
'Expense Date',

'team' =>
'Personal Fund Owner',

'description' =>
'Description',

'category' =>
'Category',

'store' =>
'Store / Supplier',

'amount' =>
'Amount',

'status' =>
'Reimbursement Status',

'reimbursement_date' =>
'Reimbursement Date',

'notes' =>
'Notes',

'created_by' =>
'Recorded By',

'receipt' =>
'Receipt',

'view_receipt' =>
'View Receipt',

'no_receipt' =>
'No receipt available',

'unpaid' =>
'Not Reimbursed',

'paid' =>
'Reimbursed',

'mark_paid' =>
'Mark Reimbursed',

'mark_unpaid' =>
'Cancel Reimbursement',

'funding_source' =>
'Funding Source',

'personal_fund' =>
'Personal Fund',

'material' =>
'Material',

'labor' =>
'Labor',

'transport' =>
'Transport',

'equipment' =>
'Equipment',

'other' =>
'Other',

],

];


$pt =
$translations[$pageLang]
??
$translations['id'];


$categoryLabel = match(
$personalFund->expense?->category
) {

'material' =>
$pt['material'],

'labor' =>
$pt['labor'],

'transport' =>
$pt['transport'],

'equipment' =>
$pt['equipment'],

default =>
$pt['other'],

};

@endphp



@push('styles')

<style>
    /* =====================================================
       HEADER
    ===================================================== */

    .personal-detail-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content:
            space-between;

        gap: 16px;
    }


    .personal-detail-actions {

        display: flex;

        gap: 8px;

        flex-wrap: wrap;
    }


    /* =====================================================
       GRID
    ===================================================== */

    .personal-detail-grid {

        display: grid;

        grid-template-columns:
            minmax(0, 1.7fr) minmax(280px, .8fr);

        gap: 18px;

        align-items: start;
    }


    /* =====================================================
       CARD
    ===================================================== */

    .personal-detail-card {

        overflow: hidden;
    }


    .personal-detail-card-header {

        padding: 16px 18px;

        border-bottom:
            1px solid var(--border);

        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    .personal-detail-card-body {

        padding: 18px;
    }


    /* =====================================================
       INFO ROW
    ===================================================== */

    .personal-detail-row {

        padding:
            12px 0;

        border-bottom:
            1px solid var(--border);

        display: grid;

        grid-template-columns:
            180px minmax(0, 1fr);

        gap: 16px;
    }


    .personal-detail-row:last-child {

        border-bottom: none;
    }


    .personal-detail-label {

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .personal-detail-value {

        color:
            var(--text-heading);

        font-size: 13px;

        font-weight: 600;

        word-break:
            break-word;
    }


    .personal-detail-value.amount {

        color:
            var(--primary);

        font-size: 20px;

        font-weight: 700;
    }


    /* =====================================================
       STATUS
    ===================================================== */

    .personal-detail-status {

        padding:
            7px 11px;

        border-radius: 20px;

        display: inline-flex;

        align-items: center;

        font-size: 11px;

        font-weight: 700;
    }


    .personal-detail-status.unpaid {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .personal-detail-status.paid {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    /* =====================================================
   BUTTON BASE
===================================================== */

    .personal-detail-btn {
        min-height: 42px;
        padding: 0 16px;
        border: none;
        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        text-decoration: none;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;

        transition:
            transform .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }


    /* =====================================================
   KEMBALI
===================================================== */

    .personal-detail-btn.back {
        background: #2f80ed;
        color: #ffffff;

        box-shadow:
            0 6px 16px rgba(47, 128, 237, 0.20);
    }

    .personal-detail-btn.back:hover {
        background: #256fd1;
        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 8px 20px rgba(47, 128, 237, 0.26);
    }

    .personal-detail-btn.back:active {
        transform: translateY(0);
    }


    /* =====================================================
   TANDAI SUDAH DIGANTI
===================================================== */

    .personal-detail-btn.paid {
        width: 100%;

        min-height: 46px;

        background: #15966a;
        color: #ffffff;

        border-radius: 10px;

        box-shadow:
            0 6px 14px rgba(21, 150, 106, 0.16);
    }

    .personal-detail-btn.paid:hover {
        background: #12845e;
        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 8px 18px rgba(21, 150, 106, 0.22);
    }

    .personal-detail-btn.paid:active {
        transform: translateY(0);
    }


    /* =====================================================
   BATALKAN PENGGANTIAN
===================================================== */

    .personal-detail-btn.unpaid {
        width: 100%;

        min-height: 46px;

        background: #f59e0b;
        color: #ffffff;

        border-radius: 10px;

        box-shadow:
            0 6px 14px rgba(245, 158, 11, 0.16);
    }

    .personal-detail-btn.unpaid:hover {
        background: #d98c08;
        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 8px 18px rgba(245, 158, 11, 0.22);
    }

    .personal-detail-btn.unpaid:active {
        transform: translateY(0);
    }


    /* =====================================================
   BUKTI PENGELUARAN
===================================================== */

    .personal-detail-btn.receipt {
        background: #eaf3ff;
        color: #2563eb;

        border: 1px solid #cfe0ff;
    }

    .personal-detail-btn.receipt:hover {
        background: #dcecff;
        color: #1d4ed8;
    }

    /* =====================================================
       SUMMARY
    ===================================================== */

    .personal-reimbursement-box {

        padding: 18px;

        border-radius: 12px;

        background:
            rgba(8, 119, 212, .05);

        border:
            1px solid rgba(8, 119, 212, .10);
    }


    .personal-reimbursement-amount {

        margin:
            8px 0 14px;

        color:
            var(--primary);

        font-size: 25px;

        font-weight: 700;
    }


    .personal-reimbursement-label {

        color:
            var(--text-muted);

        font-size: 12px;
    }


    .personal-reimbursement-action {

        margin-top: 16px;
    }


    .personal-reimbursement-action form {

        width: 100%;
    }


    .personal-reimbursement-action button {

        width: 100%;
    }


    /* =====================================================
       RECEIPT
    ===================================================== */

    .personal-no-receipt {

        color:
            var(--text-muted);

        font-size: 12px;

        font-style: italic;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width:900px) {

        .personal-detail-grid {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width:650px) {

        .personal-detail-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .personal-detail-row {

            grid-template-columns:
                1fr;

            gap: 5px;
        }


        .personal-detail-actions {

            width: 100%;
        }


        .personal-detail-btn.back {

            width: 100%;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="personal-detail-header">


    <div>

        <div class="admin-breadcrumb">

            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>


            <span class="admin-breadcrumb-separator">
                /
            </span>


            <a href="{{ route('admin.personal-funds.index') }}">
                {{ $pageLang === 'en' ? 'Personal Funds' : 'Uang Pribadi' }}
            </a>


            <span class="admin-breadcrumb-separator">
                /
            </span>


            <span class="admin-breadcrumb-current">
                {{ $pt['title'] }}
            </span>

        </div>


        <h1 class="admin-page-title">

            {{ $pt['title'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $pt['subtitle'] }}

        </p>

    </div>


    <div class="personal-detail-actions">

        <a
            href="{{ route('admin.personal-funds.index') }}"
            class="personal-detail-btn back">
            ← {{ $pt['back'] }}
        </a>
    </div>


</div>



{{-- =====================================================
     GRID
===================================================== --}}

<div class="personal-detail-grid">


    {{-- =================================================
         LEFT
    ================================================== --}}

    <div class="admin-card personal-detail-card">


        <div class="personal-detail-card-header">

            {{ $pt['transaction_info'] }}

        </div>


        <div class="personal-detail-card-body">


            {{-- DATE --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['date'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        optional(
                            $personalFund->expense?->expense_date
                        )->format('d M Y')
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- PROJECT --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['project'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->expense
                            ?->project
                            ?->project_name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- CLIENT --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['client'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->expense
                            ?->project
                            ?->client
                            ?->user
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- TEAM --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['team'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->user
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- DESCRIPTION --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['description'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->expense
                            ?->description
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- CATEGORY --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['category'] }}
                </div>

                <div class="personal-detail-value">

                    {{ $categoryLabel }}

                </div>

            </div>



            {{-- STORE --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['store'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->expense
                            ?->store_name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- SOURCE --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['funding_source'] }}
                </div>

                <div class="personal-detail-value">

                    {{ $pt['personal_fund'] }}

                </div>

            </div>



            {{-- CREATED BY --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['created_by'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund
                            ->expense
                            ?->creator
                            ?->name
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- NOTES --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['notes'] }}
                </div>

                <div class="personal-detail-value">

                    {{
                        $personalFund->notes
                        ??
                        '-'
                    }}

                </div>

            </div>



            {{-- RECEIPT --}}

            <div class="personal-detail-row">

                <div class="personal-detail-label">
                    {{ $pt['receipt'] }}
                </div>

                <div class="personal-detail-value">


                    @if(
                    $personalFund
                    ->expense
                    ?->receipt_path
                    )

                    <a
                        href="{{
                                asset(
                                    'storage/' .
                                    $personalFund
                                        ->expense
                                        ->receipt_path
                                )
                            }}"
                        target="_blank"
                        class="personal-detail-btn receipt">
                        📎 {{ $pt['view_receipt'] }}
                    </a>


                    @else


                    <span class="personal-no-receipt">

                        {{ $pt['no_receipt'] }}

                    </span>


                    @endif


                </div>

            </div>


        </div>


    </div>



    {{-- =================================================
         RIGHT
    ================================================== --}}

    <div class="admin-card personal-detail-card">


        <div class="personal-detail-card-header">

            {{ $pt['reimbursement_info'] }}

        </div>


        <div class="personal-detail-card-body">


            <div class="personal-reimbursement-box">


                <div class="personal-reimbursement-label">

                    {{ $pt['amount'] }}

                </div>


                <div class="personal-reimbursement-amount">

                    Rp {{
                        number_format(
                            $personalFund->amount,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </div>



                <div class="personal-detail-row">

                    <div class="personal-detail-label">

                        {{ $pt['status'] }}

                    </div>


                    <div class="personal-detail-value">


                        @if(
                        $personalFund->reimbursement_status
                        ===
                        'paid'
                        )

                        <span class="personal-detail-status paid">

                            {{ $pt['paid'] }}

                        </span>


                        @else


                        <span class="personal-detail-status unpaid">

                            {{ $pt['unpaid'] }}

                        </span>


                        @endif


                    </div>

                </div>



                <div class="personal-detail-row">

                    <div class="personal-detail-label">

                        {{ $pt['reimbursement_date'] }}

                    </div>


                    <div class="personal-detail-value">

                        {{
                            $personalFund->reimbursement_date
                                ? $personalFund
                                    ->reimbursement_date
                                    ->format('d M Y')
                                : '-'
                        }}

                    </div>

                </div>



                {{-- ACTION --}}

                <div class="personal-reimbursement-action">


                    @if(
                    $personalFund->reimbursement_status
                    ===
                    'unpaid'
                    )


                    <form
                        method="POST"
                        action="{{
                                route(
                                    'admin.personal-funds.paid',
                                    $personalFund
                                )
                            }}"
                        class="reimbursement-form"
                        data-message="Yakin uang pribadi ini sudah diganti?">

                        @csrf
                        @method('PATCH')


                        <button
                            type="submit"
                            class="personal-detail-btn paid">

                            ✓ {{ $pt['mark_paid'] }}

                        </button>

                    </form>


                    @else


                    <form
                        method="POST"
                        action="{{
                                route(
                                    'admin.personal-funds.unpaid',
                                    $personalFund
                                )
                            }}"
                        class="reimbursement-form"
                        data-message="Yakin ingin membatalkan status penggantian?">

                        @csrf
                        @method('PATCH')


                        <button
                            type="submit"
                            class="personal-detail-btn unpaid">

                            ↶ {{ $pt['mark_unpaid'] }}

                        </button>

                    </form>


                    @endif


                </div>


            </div>


        </div>


    </div>


</div>


@endsection



@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            document
                .querySelectorAll(
                    '.reimbursement-form'
                )
                .forEach(
                    function(form) {

                        form.addEventListener(
                            'submit',
                            function(event) {

                                const message =
                                    form.dataset.message ||
                                    'Yakin melanjutkan?';

                                if (!confirm(message)) {

                                    event.preventDefault();

                                }

                            }
                        );

                    }
                );

        }
    );
</script>

@endpush