@extends('layouts.admin')


@section(
'title',
'Edit Pekerjaan - RuangKita'
)


@section('content')


<div style="max-width: 1050px;">


    <div class="admin-breadcrumb">

        <a href="{{ route('admin.works.index') }}">
            Data Pekerjaan
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <a href="{{ route('admin.works.show', $work) }}">
            Detail Pekerjaan
        </a>

        <span class="admin-breadcrumb-separator">
            /
        </span>

        <span class="admin-breadcrumb-current">
            Edit Pekerjaan
        </span>

    </div>



    <div class="admin-page-header">

        <h1 class="admin-page-title">
            Edit Pekerjaan
        </h1>

        <p class="admin-page-subtitle">
            Perbarui informasi pekerjaan proyek.
        </p>

    </div>



    <form
        method="POST"
        action="{{ route('admin.works.update', $work) }}"
        class="admin-form-card">

        @csrf
        @method('PUT')


        <div class="admin-form-title">
            Informasi Pekerjaan
        </div>


        <div class="admin-form-grid">


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Proyek
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="project_id"
                    class="admin-form-control"
                    required>

                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old( 'project_id' ,
                        $work->project_id
                        )
                        ==
                        $project->id
                        )
                        >

                        {{ $project->project_name }}

                    </option>

                    @endforeach

                </select>

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Nama Pekerjaan
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="text"
                    name="work_name"
                    value="{{
                        old(
                            'work_name',
                            $work->work_name
                        )
                    }}"
                    class="admin-form-control"
                    required>

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Metode Pekerjaan
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="method_type"
                    class="admin-form-control"
                    required>

                    <option
                        value="daily"
                        @selected(
                        old( 'method_type' ,
                        $work->method_type
                        )
                        ===
                        'daily'
                        )
                        >
                        Harian
                    </option>

                    <option
                        value="contract"
                        @selected(
                        old( 'method_type' ,
                        $work->method_type
                        )
                        ===
                        'contract'
                        )
                        >
                        Borongan
                    </option>

                </select>

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Status
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="status"
                    class="admin-form-control"
                    required>

                    <option
                        value="planned"
                        @selected(
                        old( 'status' ,
                        $work->status
                        )
                        ===
                        'planned'
                        )
                        >
                        Belum Dimulai
                    </option>

                    <option
                        value="ongoing"
                        @selected(
                        old( 'status' ,
                        $work->status
                        )
                        ===
                        'ongoing'
                        )
                        >
                        Berjalan
                    </option>

                    <option
                        value="completed"
                        @selected(
                        old( 'status' ,
                        $work->status
                        )
                        ===
                        'completed'
                        )
                        >
                        Selesai
                    </option>

                    <option
                        value="cancelled"
                        @selected(
                        old( 'status' ,
                        $work->status
                        )
                        ===
                        'cancelled'
                        )
                        >
                        Dibatalkan
                    </option>

                </select>

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Volume
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="volume"
                    id="workVolume"
                    value="{{
                        old(
                            'volume',
                            $work->volume
                        )
                    }}"
                    class="admin-form-control">

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Satuan
                </label>

                <input
                    type="text"
                    name="unit"
                    value="{{
                        old(
                            'unit',
                            $work->unit
                        )
                    }}"
                    class="admin-form-control">

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Harga Satuan
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="unit_price"
                    id="workUnitPrice"
                    value="{{
                        old(
                            'unit_price',
                            $work->unit_price
                        )
                    }}"
                    class="admin-form-control">

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Durasi Pekerjaan
                </label>

                <input
                    type="number"
                    min="1"
                    name="duration_days"
                    value="{{
                        old(
                            'duration_days',
                            $work->duration_days
                        )
                    }}"
                    class="admin-form-control">

            </div>


            <div class="admin-form-group full">

                <label class="admin-form-label">
                    Total Biaya
                </label>

                <input
                    type="text"
                    id="workTotalPreview"
                    class="admin-form-control"
                    readonly>

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
                        $work->is_visible_to_client
                    )
                    )
                    >

                    <span class="admin-form-label">
                        Tampilkan pekerjaan ini kepada Client
                    </span>

                </label>

            </div>


        </div>



        <div class="admin-form-actions">

            <a
                href="{{ route('admin.works.show', $work) }}"
                class="
                    admin-btn
                    admin-btn-secondary
                ">
                Batal
            </a>

            <button
                type="submit"
                class="
                    admin-btn
                    admin-btn-primary
                ">
                Simpan Perubahan
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

            const volume =
                document.getElementById(
                    'workVolume'
                );

            const unitPrice =
                document.getElementById(
                    'workUnitPrice'
                );

            const preview =
                document.getElementById(
                    'workTotalPreview'
                );


            function calculateTotal() {

                const volumeValue =
                    parseFloat(
                        volume.value ||
                        0
                    );

                const priceValue =
                    parseFloat(
                        unitPrice.value ||
                        0
                    );


                const total =
                    volumeValue *
                    priceValue;


                preview.value =
                    new Intl.NumberFormat(
                        'id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        }
                    )
                    .format(total);

            }


            volume.addEventListener(
                'input',
                calculateTotal
            );


            unitPrice.addEventListener(
                'input',
                calculateTotal
            );


            calculateTotal();

        }
    );
</script>

@endpush