@extends('layouts.admin')


@section(
'title',
'Data Client - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'title' => 'Data Client',
'subtitle' => 'Kelola data client dan informasi proyek pelanggan.',
'add_client' => 'Tambah Client',

'total_client' => 'Total Client',
'active_client' => 'Client Aktif',
'inactive_client' => 'Client Nonaktif',
'total_projects' => 'Total Proyek Client',

'client_list' => 'Daftar Client',

'search_placeholder' => 'Cari nama, email, atau nomor telepon...',
'all_status' => 'Semua Status',
'active' => 'Aktif',
'inactive' => 'Nonaktif',
'search' => 'Cari',
'reset' => 'Reset',

'no' => 'No',
'client_name' => 'Nama Client',
'email' => 'Email',
'phone' => 'No. Telepon',
'address' => 'Alamat',
'project_count' => 'Jumlah Proyek',
'status' => 'Status',
'action' => 'Aksi',

'detail' => 'Detail Client',
'edit' => 'Edit Client',
'activate' => 'Aktifkan Client',
'deactivate' => 'Nonaktifkan Client',

'confirm_status' => 'Yakin ingin mengubah status client ini?',
'empty' => 'Belum ada data client.',

],


'en' => [

'title' => 'Clients',
'subtitle' => 'Manage client data and customer project information.',
'add_client' => 'Add Client',

'total_client' => 'Total Clients',
'active_client' => 'Active Clients',
'inactive_client' => 'Inactive Clients',
'total_projects' => 'Total Client Projects',

'client_list' => 'Client List',

'search_placeholder' => 'Search name, email, or phone number...',
'all_status' => 'All Status',
'active' => 'Active',
'inactive' => 'Inactive',
'search' => 'Search',
'reset' => 'Reset',

'no' => 'No',
'client_name' => 'Client Name',
'email' => 'Email',
'phone' => 'Phone Number',
'address' => 'Address',
'project_count' => 'Projects',
'status' => 'Status',
'action' => 'Action',

'detail' => 'Client Detail',
'edit' => 'Edit Client',
'activate' => 'Activate Client',
'deactivate' => 'Deactivate Client',

'confirm_status' => 'Are you sure you want to change this client status?',
'empty' => 'No client data available.',

],

];


$it =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    /* =====================================================
       PAGE HEADER
    ===================================================== */

    .client-page-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }


    /* =====================================================
       SUMMARY
    ===================================================== */

    .client-summary-grid {

        margin-bottom: 20px;

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 14px;
    }


    .client-summary-card {

        min-height: 105px;

        padding: 18px;

        display: flex;

        align-items: center;

        gap: 14px;
    }


    .client-summary-icon {

        width: 50px;
        height: 50px;

        flex-shrink: 0;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;
    }


    .client-summary-icon.blue {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .client-summary-icon.green {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    .client-summary-icon.red {

        background:
            var(--danger-bg);

        color:
            var(--danger);
    }


    .client-summary-icon.purple {

        background:
            rgba(111, 66, 217, .12);

        color:
            #7551d7;
    }


    body.dark-mode .client-summary-icon.purple {

        background:
            rgba(151, 121, 225, .18);

        color:
            #b9a1ee;
    }


    .client-summary-label {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .client-summary-number {

        color:
            var(--text-heading);

        font-size: 24px;

        font-weight: 700;
    }


    /* =====================================================
       CLIENT PANEL
    ===================================================== */

    .client-panel {

        overflow: hidden;
    }


    .client-panel-header {

        padding:
            16px 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 14px;

        border-bottom:
            1px solid var(--border);
    }


    .client-panel-title {

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    /* =====================================================
       FILTER
    ===================================================== */

    .client-filter-form {

        display: flex;

        align-items: center;

        gap: 9px;
    }


    .client-search {

        width: 320px;
    }


    .client-filter-form .admin-form-control {

        min-height: 42px;
    }


    /* =====================================================
       CLIENT NAME
    ===================================================== */

    .client-name {

        color:
            var(--text-heading);

        font-weight: 700;
    }


    /* =====================================================
       ACTION
    ===================================================== */

    .client-actions {

        display: flex;

        align-items: center;

        gap: 7px;
    }


    .client-action {

        width: 34px;
        height: 34px;

        padding: 0;

        border: none;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        cursor: pointer;

        font-size: 14px;

        transition:
            transform .2s ease,
            filter .2s ease;
    }


    .client-action:hover {

        transform:
            translateY(-1px);
    }


    .client-action.view {

        background:
            var(--primary-soft);

        color:
            var(--primary);
    }


    .client-action.edit {

        background:
            var(--warning-bg);

        color:
            var(--warning);
    }


    .client-action.deactivate {

        background:
            var(--danger-bg);

        color:
            var(--danger);
    }


    .client-action.activate {

        background:
            var(--success-bg);

        color:
            var(--success);
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .client-empty {

        padding:
            40px 20px !important;

        color:
            var(--text-muted) !important;

        text-align:
            center;
    }


    /* =====================================================
       PAGINATION
    ===================================================== */

    .client-pagination {

        padding:
            16px 18px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1100px) {

        .client-summary-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }


        .client-panel-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .client-filter-form {

            width:
                100%;

            flex-wrap:
                wrap;
        }

    }


    @media(max-width: 650px) {

        .client-page-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .client-summary-grid {

            grid-template-columns:
                1fr;
        }


        .client-search {

            width:
                100%;
        }


        .client-filter-form .admin-btn {

            flex:
                1;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

<div class="client-page-header">


    <div>


        <h1 class="admin-page-title">

            {{ $it['title'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $it['subtitle'] }}

        </p>


    </div>



    <a
        href="{{ route('admin.clients.create') }}"
        class="
                admin-btn
                admin-btn-primary
            ">

        ＋ {{ $it['add_client'] }}

    </a>


</div>



{{-- =====================================================
         SUMMARY
    ====================================================== --}}

<div class="client-summary-grid">


    <div class="admin-card client-summary-card">


        <div class="client-summary-icon blue">

            ♙

        </div>


        <div>

            <div class="client-summary-label">

                {{ $it['total_client'] }}

            </div>

            <div class="client-summary-number">

                {{ $totalClients }}

            </div>

        </div>


    </div>



    <div class="admin-card client-summary-card">


        <div class="client-summary-icon green">

            ●

        </div>


        <div>

            <div class="client-summary-label">

                {{ $it['active_client'] }}

            </div>

            <div class="client-summary-number">

                {{ $activeClients }}

            </div>

        </div>


    </div>



    <div class="admin-card client-summary-card">


        <div class="client-summary-icon red">

            ○

        </div>


        <div>

            <div class="client-summary-label">

                {{ $it['inactive_client'] }}

            </div>

            <div class="client-summary-number">

                {{ $inactiveClients }}

            </div>

        </div>


    </div>



    <div class="admin-card client-summary-card">


        <div class="client-summary-icon purple">

            ▣

        </div>


        <div>

            <div class="client-summary-label">

                {{ $it['total_projects'] }}

            </div>

            <div class="client-summary-number">

                {{ $totalProjects }}

            </div>

        </div>


    </div>


</div>



{{-- =====================================================
         CLIENT PANEL
    ====================================================== --}}

<div class="admin-card client-panel">


    <div class="client-panel-header">


        <div class="client-panel-title">

            {{ $it['client_list'] }}

        </div>



        <form
            method="GET"
            action="{{ route('admin.clients.index') }}"
            class="client-filter-form">


            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="
                        admin-form-control
                        client-search
                    "
                placeholder="{{ $it['search_placeholder'] }}">



            <select
                name="status"
                class="admin-form-control">

                <option value="">

                    {{ $it['all_status'] }}

                </option>


                <option
                    value="active"
                    @selected($status==='active' )>

                    {{ $it['active'] }}

                </option>


                <option
                    value="inactive"
                    @selected($status==='inactive' )>

                    {{ $it['inactive'] }}

                </option>

            </select>



            <button
                type="submit"
                class="
                        admin-btn
                        admin-btn-primary
                    ">

                {{ $it['search'] }}

            </button>



            @if($search || $status)

            <a
                href="{{ route('admin.clients.index') }}"
                class="
                            admin-btn
                            admin-btn-secondary
                        ">

                {{ $it['reset'] }}

            </a>

            @endif


        </form>


    </div>



    {{-- =================================================
             TABLE
        ================================================== --}}

    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $it['no'] }}</th>

                    <th>{{ $it['client_name'] }}</th>

                    <th>{{ $it['email'] }}</th>

                    <th>{{ $it['phone'] }}</th>

                    <th>{{ $it['address'] }}</th>

                    <th>{{ $it['project_count'] }}</th>

                    <th>{{ $it['status'] }}</th>

                    <th>{{ $it['action'] }}</th>

                </tr>

            </thead>


            <tbody>


                @forelse($clients as $client)


                <tr>


                    <td>

                        {{
                                    $clients->firstItem()
                                    +
                                    $loop->index
                                }}

                    </td>



                    <td class="client-name">

                        {{
                                    $client->user->name
                                    ??
                                    '-'
                                }}

                    </td>



                    <td>

                        {{
                                    $client->user->email
                                    ??
                                    '-'
                                }}

                    </td>



                    <td>

                        {{
                                    $client->user->phone
                                    ??
                                    '-'
                                }}

                    </td>



                    <td>

                        {{
                                    $client->address
                                    ??
                                    '-'
                                }}

                    </td>



                    <td>

                        {{
                                    $client
                                        ->projects
                                        ->count()
                                }}

                    </td>



                    <td>


                        @if($client->user && $client->user->is_active)

                        <span
                            class="
                                            admin-badge
                                            admin-badge-success
                                        ">

                            ● {{ $it['active'] }}

                        </span>

                        @else

                        <span
                            class="
                                            admin-badge
                                            admin-badge-danger
                                        ">

                            ● {{ $it['inactive'] }}

                        </span>

                        @endif


                    </td>



                    <td>


                        <div class="client-actions">


                            {{-- DETAIL --}}

                            <a
                                href="{{
                                            route(
                                                'admin.clients.show',
                                                $client
                                            )
                                        }}"
                                class="
                                            client-action
                                            view
                                        "
                                title="{{ $it['detail'] }}">

                                ◉

                            </a>



                            {{-- EDIT --}}

                            <a
                                href="{{
                                            route(
                                                'admin.clients.edit',
                                                $client
                                            )
                                        }}"
                                class="
                                            client-action
                                            edit
                                        "
                                title="{{ $it['edit'] }}">

                                ✎

                            </a>



                            {{-- STATUS --}}

                            <form
                                method="POST"
                                action="{{
                                            route(
                                                'admin.clients.toggle-status',
                                                $client
                                            )
                                        }}">

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="
                                    client-action
                                     {{
                                        $client->user
                                        &&
                                        $client->user->is_active
                                        ?
                                        'deactivate'
                                        :
                                        'activate'
                                    }}
    "
                                    title="{{
                                        $client->user
                                        &&
                                        $client->user->is_active
                                        ?
                                        $it['deactivate']
                                            :
                                            $it['activate']
                                        }}"
                                    data-confirm="{{ $it['confirm_status'] }}"
                                    onclick="return confirm(this.dataset.confirm);">
                                    {{
                                    $client->user
                                    &&
                                    $client->user->is_active
                                    ?
                                    '×'
                                    :
                                    '✓'
                                    }}
                                </button>

                            </form>


                        </div>


                    </td>


                </tr>


                @empty


                <tr>

                    <td
                        colspan="8"
                        class="client-empty">

                        {{ $it['empty'] }}

                    </td>

                </tr>


                @endforelse


            </tbody>


        </table>


    </div>



    @if($clients->hasPages())

    <div class="client-pagination">

        {{ $clients->links() }}

    </div>

    @endif


</div>


@endsection