@extends('layouts.admin')


@section(
'title',
'Detail Client - RuangKita'
)


@php

$pageLang =
auth()->user()->language
??
'id';


$translations = [

'id' => [

'data_client' => 'Data Client',
'detail_client' => 'Detail Client',

'subtitle' =>
'Informasi lengkap client dan proyek yang dimiliki.',

'edit_client' =>
'Edit Client',

'active' =>
'Aktif',

'inactive' =>
'Nonaktif',

'total_projects' =>
'Total Proyek',

'ongoing_projects' =>
'Proyek Berjalan',

'completed_projects' =>
'Proyek Selesai',

'client_information' =>
'Informasi Client',

'client_name' =>
'Nama Client',

'email' =>
'Email',

'phone' =>
'No. Telepon',

'address' =>
'Alamat',

'notes' =>
'Catatan',

'client_projects' =>
'Daftar Proyek Client',

'no' =>
'No',

'project_name' =>
'Nama Proyek',

'location' =>
'Lokasi',

'progress' =>
'Progress',

'status' =>
'Status',

'ongoing' =>
'Berjalan',

'completed' =>
'Selesai',

'paused' =>
'Ditunda',

'planning' =>
'Perencanaan',

'empty_projects' =>
'Client ini belum memiliki proyek.',

],


'en' => [

'data_client' => 'Clients',
'detail_client' => 'Client Detail',

'subtitle' =>
'Complete client information and associated projects.',

'edit_client' =>
'Edit Client',

'active' =>
'Active',

'inactive' =>
'Inactive',

'total_projects' =>
'Total Projects',

'ongoing_projects' =>
'Ongoing Projects',

'completed_projects' =>
'Completed Projects',

'client_information' =>
'Client Information',

'client_name' =>
'Client Name',

'email' =>
'Email',

'phone' =>
'Phone Number',

'address' =>
'Address',

'notes' =>
'Notes',

'client_projects' =>
'Client Projects',

'no' =>
'No',

'project_name' =>
'Project Name',

'location' =>
'Location',

'progress' =>
'Progress',

'status' =>
'Status',

'ongoing' =>
'Ongoing',

'completed' =>
'Completed',

'paused' =>
'Paused',

'planning' =>
'Planning',

'empty_projects' =>
'This client does not have any projects yet.',

],

];


$dt =
$translations[$pageLang]
??
$translations['id'];

@endphp


@push('styles')

<style>
    /* =====================================================
       HEADER
    ===================================================== */

    .client-detail-header {

        margin-bottom: 22px;

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 16px;
    }


    /* =====================================================
       PROFILE
    ===================================================== */

    .client-profile-card {

        margin-bottom: 18px;

        padding: 22px;

        display: grid;

        grid-template-columns:
            100px minmax(0, 1fr) auto;

        align-items: center;

        gap: 20px;
    }


    .client-profile-avatar {

        width: 90px;
        height: 90px;

        overflow: hidden;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            var(--primary-soft);

        color:
            var(--primary);

        font-size: 30px;

        font-weight: 700;
    }


    .client-profile-avatar img {

        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;

        object-position:
            center top;
    }


    .client-profile-name {

        margin-bottom: 7px;

        color:
            var(--text-heading);

        font-size: 23px;

        font-weight: 700;
    }


    .client-profile-meta {

        margin-bottom: 5px;

        color:
            var(--text-muted);

        font-size: 14px;
    }


    /* =====================================================
       INFO SUMMARY
    ===================================================== */

    .client-info-grid {

        margin-bottom: 18px;

        display: grid;

        grid-template-columns:
            repeat(3,
                minmax(0, 1fr));

        gap: 14px;
    }


    .client-info-card {

        padding: 19px;
    }


    .info-label {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 13px;
    }


    .info-value {

        color:
            var(--text-heading);

        font-size: 23px;

        font-weight: 700;
    }


    /* =====================================================
       DETAIL PANEL
    ===================================================== */

    .detail-panel {

        margin-bottom: 18px;

        padding: 20px;
    }


    .detail-panel-title {

        margin-bottom: 16px;

        color:
            var(--text-heading);

        font-size: 17px;

        font-weight: 700;
    }


    .detail-row {

        padding:
            12px 0;

        display: grid;

        grid-template-columns:
            180px minmax(0, 1fr);

        gap: 15px;

        border-bottom:
            1px solid var(--border);

        font-size: 14px;
    }


    .detail-row:last-child {

        border-bottom:
            none;
    }


    .detail-label {

        color:
            var(--text-muted);
    }


    .detail-value {

        color:
            var(--text-main);

        font-weight: 500;
    }


    /* =====================================================
       PROJECT
    ===================================================== */

    .project-name {

        color:
            var(--text-heading);

        font-weight: 700;
    }


    .empty-project {

        padding:
            32px 15px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 14px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 950px) {

        .client-info-grid {

            grid-template-columns:
                1fr 1fr;
        }


        .client-profile-card {

            grid-template-columns:
                90px 1fr;
        }


        .client-profile-status {

            grid-column:
                1 / -1;
        }

    }


    @media(max-width: 650px) {

        .client-detail-header {

            align-items:
                flex-start;

            flex-direction:
                column;
        }


        .client-profile-card {

            grid-template-columns:
                1fr;

            text-align:
                center;
        }


        .client-profile-avatar {

            margin:
                0 auto;
        }


        .client-profile-status {

            grid-column:
                auto;
        }


        .client-info-grid {

            grid-template-columns:
                1fr;
        }


        .detail-row {

            grid-template-columns:
                1fr;

            gap: 5px;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="admin-breadcrumb">


    <a href="{{ route('admin.clients.index') }}">

        {{ $dt['data_client'] }}

    </a>


    <span class="admin-breadcrumb-separator">

        /

    </span>


    <span class="admin-breadcrumb-current">

        {{ $dt['detail_client'] }}

    </span>


</div>



{{-- =====================================================
         HEADER
    ====================================================== --}}

<div class="client-detail-header">


    <div>


        <h1 class="admin-page-title">

            {{ $dt['detail_client'] }}

        </h1>


        <p class="admin-page-subtitle">

            {{ $dt['subtitle'] }}

        </p>


    </div>



    <a
        href="{{ route('admin.clients.edit', $client) }}"
        class="
                admin-btn
                admin-btn-warning
            ">

        ✎ {{ $dt['edit_client'] }}

    </a>


</div>



{{-- =====================================================
         PROFILE
    ====================================================== --}}

<div class="admin-card client-profile-card">


    <div class="client-profile-avatar">


        @if($client->user && $client->user->profile_photo)

        <img
            src="{{
                        asset(
                            'storage/' .
                            $client->user->profile_photo
                        )
                    }}"
            alt="{{
                        $client->user->name
                    }}">

        @else

        {{
                    strtoupper(
                        substr(
                            $client->user->name
                            ??
                            'C',
                            0,
                            1
                        )
                    )
                }}

        @endif


    </div>



    <div>


        <div class="client-profile-name">

            {{
                    $client->user->name
                    ??
                    '-'
                }}

        </div>


        <div class="client-profile-meta">

            ✉
            {{
                    $client->user->email
                    ??
                    '-'
                }}

        </div>


        <div class="client-profile-meta">

            ☎
            {{
                    $client->user->phone
                    ??
                    '-'
                }}

        </div>


    </div>



    <div class="client-profile-status">


        @if($client->user && $client->user->is_active)

        <span
            class="
                        admin-badge
                        admin-badge-success
                    ">

            ● {{ $dt['active'] }}

        </span>

        @else

        <span
            class="
                        admin-badge
                        admin-badge-danger
                    ">

            ● {{ $dt['inactive'] }}

        </span>

        @endif


    </div>


</div>



{{-- =====================================================
         SUMMARY
    ====================================================== --}}

<div class="client-info-grid">


    <div class="admin-card client-info-card">


        <div class="info-label">

            {{ $dt['total_projects'] }}

        </div>


        <div class="info-value">

            {{
                    $client
                        ->projects
                        ->count()
                }}

        </div>


    </div>



    <div class="admin-card client-info-card">


        <div class="info-label">

            {{ $dt['ongoing_projects'] }}

        </div>


        <div class="info-value">

            {{
                    $client
                        ->projects
                        ->where(
                            'status',
                            'ongoing'
                        )
                        ->count()
                }}

        </div>


    </div>



    <div class="admin-card client-info-card">


        <div class="info-label">

            {{ $dt['completed_projects'] }}

        </div>


        <div class="info-value">

            {{
                    $client
                        ->projects
                        ->where(
                            'status',
                            'completed'
                        )
                        ->count()
                }}

        </div>


    </div>


</div>



{{-- =====================================================
         CLIENT INFORMATION
    ====================================================== --}}

<div class="admin-card detail-panel">


    <div class="detail-panel-title">

        {{ $dt['client_information'] }}

    </div>



    <div class="detail-row">

        <div class="detail-label">

            {{ $dt['client_name'] }}

        </div>

        <div class="detail-value">

            {{
                    $client->user->name
                    ??
                    '-'
                }}

        </div>

    </div>



    <div class="detail-row">

        <div class="detail-label">

            {{ $dt['email'] }}

        </div>

        <div class="detail-value">

            {{
                    $client->user->email
                    ??
                    '-'
                }}

        </div>

    </div>



    <div class="detail-row">

        <div class="detail-label">

            {{ $dt['phone'] }}

        </div>

        <div class="detail-value">

            {{
                    $client->user->phone
                    ??
                    '-'
                }}

        </div>

    </div>



    <div class="detail-row">

        <div class="detail-label">

            {{ $dt['address'] }}

        </div>

        <div class="detail-value">

            {{
                    $client->address
                    ??
                    '-'
                }}

        </div>

    </div>



    <div class="detail-row">

        <div class="detail-label">

            {{ $dt['notes'] }}

        </div>

        <div class="detail-value">

            {{
                    $client->notes
                    ??
                    '-'
                }}

        </div>

    </div>


</div>



{{-- =====================================================
         PROJECT LIST
    ====================================================== --}}

<div class="admin-card detail-panel">


    <div class="detail-panel-title">

        {{ $dt['client_projects'] }}

    </div>



    @if($client->projects->count() > 0)


    <div class="admin-table-wrapper">


        <table class="admin-table">


            <thead>

                <tr>

                    <th>{{ $dt['no'] }}</th>

                    <th>{{ $dt['project_name'] }}</th>

                    <th>{{ $dt['location'] }}</th>

                    <th>{{ $dt['progress'] }}</th>

                    <th>{{ $dt['status'] }}</th>

                </tr>

            </thead>


            <tbody>


                @foreach($client->projects as $project)


                @php

                $projectStatus =
                $project->status
                ??
                'planning';


                $projectStatusLabel =
                match ($projectStatus) {

                'ongoing'
                =>
                $dt['ongoing'],

                'completed'
                =>
                $dt['completed'],

                'paused'
                =>
                $dt['paused'],

                default
                =>
                $dt['planning'],

                };


                $projectStatusClass =
                match ($projectStatus) {

                'ongoing'
                =>
                'admin-badge-success',

                'completed'
                =>
                'admin-badge-primary',

                'paused'
                =>
                'admin-badge-warning',

                default
                =>
                'admin-badge-warning',

                };

                @endphp


                <tr>


                    <td>

                        {{ $loop->iteration }}

                    </td>



                    <td class="project-name">

                        {{
                                        $project->project_name
                                        ??
                                        '-'
                                    }}

                    </td>



                    <td>

                        {{
                                        $project->location
                                        ??
                                        '-'
                                    }}

                    </td>



                    <td>

                        {{
                                        $project->progress_percentage
                                        ??
                                        0
                                    }}%

                    </td>



                    <td>

                        <span
                            class="
                                            admin-badge
                                            {{ $projectStatusClass }}
                                        ">

                            {{ $projectStatusLabel }}

                        </span>

                    </td>


                </tr>


                @endforeach


            </tbody>


        </table>


    </div>


    @else


    <div class="empty-project">

        {{ $dt['empty_projects'] }}

    </div>


    @endif


</div>


@endsection