@extends('layouts.admin')

@section('title', 'Detail Pengeluaran - RuangKita')


@php
$categoryLabel = match ($expense->category) {
'material' => 'Material',
'labor' => 'Upah',
'transport' => 'Transportasi',
'equipment' => 'Peralatan',
default => 'Lain-lain',
};

$fundingLabel =
$expense->funding_source === 'personal'
? 'Uang Pribadi'
: 'Dana Proyek';
@endphp


@push('styles')
<style>
    .expense-detail-header {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }

    .expense-detail-grid {
        margin-bottom: 18px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .expense-detail-card {
        padding: 18px;
    }

    .expense-detail-label {
        margin-bottom: 7px;
        color: var(--text-muted);
        font-size: 13px;
    }

    .expense-detail-value {
        color: var(--text-heading);
        font-size: 18px;
        font-weight: 700;
    }

    .expense-info-panel {
        padding: 20px;
    }

    .expense-info-title {
        margin-bottom: 16px;
        color: var(--text-heading);
        font-size: 17px;
        font-weight: 700;
    }

    .expense-info-row {
        padding: 12px 0;
        display: grid;
        grid-template-columns: 190px minmax(0, 1fr);
        gap: 15px;
        border-bottom: 1px solid var(--border);
    }

    .expense-info-row:last-child {
        border-bottom: none;
    }

    .expense-info-label {
        color: var(--text-muted);
    }

    .expense-info-value {
        color: var(--text-main);
        font-weight: 500;
    }

    .expense-receipt-preview {
        margin-top: 14px;
        max-width: 520px;
    }

    .expense-receipt-image {
        width: 100%;
        max-height: 420px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid var(--border);
    }

    @media(max-width: 750px) {
        .expense-detail-grid {
            grid-template-columns: 1fr;
        }

        .expense-detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .expense-info-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }
    }
</style>
@endpush


@section('content')

<div class="admin-breadcrumb">
    <a href="{{ route('admin.expenses.index') }}">
        Data Pengeluaran
    </a>

    <span class="admin-breadcrumb-separator">/</span>

    <span class="admin-breadcrumb-current">
        Detail Pengeluaran
    </span>
</div>


<div class="expense-detail-header">

    <div>
        <h1 class="admin-page-title">
            {{ $expense->description ?: $categoryLabel }}
        </h1>

        <p class="admin-page-subtitle">
            Informasi lengkap transaksi pengeluaran proyek.
        </p>
    </div>


    <a href="{{ route('admin.expenses.edit', $expense) }}"
        class="admin-btn admin-btn-warning">
        ✎ Edit Pengeluaran
    </a>

</div>


<div class="expense-detail-grid">

    <div class="admin-card expense-detail-card">
        <div class="expense-detail-label">
            Proyek
        </div>

        <div class="expense-detail-value">
            {{ $expense->project->project_name ?? '-' }}
        </div>
    </div>


    <div class="admin-card expense-detail-card">
        <div class="expense-detail-label">
            Jumlah
        </div>

        <div class="expense-detail-value">
            Rp {{ number_format($expense->amount, 0, ',', '.') }}
        </div>
    </div>


    <div class="admin-card expense-detail-card">
        <div class="expense-detail-label">
            Sumber Dana
        </div>

        <div class="expense-detail-value">
            {{ $fundingLabel }}
        </div>
    </div>

</div>


<div class="admin-card expense-info-panel">

    <div class="expense-info-title">
        Detail Pengeluaran
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Tanggal Pengeluaran
        </div>

        <div class="expense-info-value">
            {{
                $expense->expense_date
                    ? $expense->expense_date->format('d M Y')
                    : '-'
            }}
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Toko / Supplier
        </div>

        <div class="expense-info-value">
            {{ $expense->store_name ?? '-' }}
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Kategori
        </div>

        <div class="expense-info-value">
            <span class="admin-badge admin-badge-primary">
                {{ $categoryLabel }}
            </span>
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Material Terkait
        </div>

        <div class="expense-info-value">
            {{ $expense->material->material_name ?? '-' }}
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Dibuat Oleh
        </div>

        <div class="expense-info-value">
            {{ $expense->creator->name ?? '-' }}
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Keterangan
        </div>

        <div class="expense-info-value">
            {{ $expense->description ?? '-' }}
        </div>
    </div>


    <div class="expense-info-row">
        <div class="expense-info-label">
            Visibilitas Client
        </div>

        <div class="expense-info-value">

            @if($expense->is_visible_to_client)

            <span class="admin-badge admin-badge-success">
                Ditampilkan ke Client
            </span>

            @else

            <span class="admin-badge admin-badge-danger">
                Disembunyikan dari Client
            </span>

            @endif

        </div>
    </div>


    @if($expense->funding_source === 'personal')

    <div class="expense-info-row">
        <div class="expense-info-label">
            Status Penggantian
        </div>

        <div class="expense-info-value">

            @if(
            optional($expense->personalFund)->status
            ===
            'sudah_diganti'
            )

            <span class="admin-badge admin-badge-success">
                Sudah Diganti
            </span>

            @else

            <span class="admin-badge admin-badge-warning">
                Belum Diganti
            </span>

            @endif

        </div>
    </div>

    @endif


    <div class="expense-info-row">
        <div class="expense-info-label">
            Bukti Pengeluaran
        </div>

        <div class="expense-info-value">

            @if($expense->receipt_path)

            <a href="{{ asset('storage/' . $expense->receipt_path) }}"
                target="_blank"
                class="admin-btn admin-btn-primary">
                Lihat Bukti
            </a>

            @php
            $receiptExtension =
            strtolower(
            pathinfo(
            $expense->receipt_path,
            PATHINFO_EXTENSION
            )
            );
            @endphp

            @if(
            in_array(
            $receiptExtension,
            ['jpg', 'jpeg', 'png']
            )
            )

            <div class="expense-receipt-preview">
                <img
                    src="{{ asset('storage/' . $expense->receipt_path) }}"
                    alt="Bukti Pengeluaran"
                    class="expense-receipt-image">
            </div>

            @endif

            @else

            Tidak ada bukti pengeluaran.

            @endif

        </div>
    </div>

</div>

@endsection