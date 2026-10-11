@extends('layouts.admin')


@section(
'title',
'Tambah Pekerjaan - RuangKita'
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

        <span class="admin-breadcrumb-current">
            Tambah Pekerjaan
        </span>

    </div>


    <div class="admin-page-header">

        <h1 class="admin-page-title">
            Tambah Pekerjaan
        </h1>

        <p class="admin-page-subtitle">
            Tambahkan tahapan pekerjaan baru ke dalam proyek.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('admin.works.store') }}"
        class="admin-form-card">

        @csrf


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

                    <option value="">
                        Pilih Proyek
                    </option>

                    @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        @selected(
                        old('project_id')==$project->id
                        )
                        >

                        {{ $project->project_name }}

                        -
                        {{
                                optional(
                                    $project->client
                                )->user->name
                                ??
                                '-'
                            }}

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
                    value="{{ old('work_name') }}"
                    class="admin-form-control"
                    placeholder="Contoh: Pemasangan Keramik"
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

                    <option value="">
                        Pilih Metode
                    </option>

                    <option
                        value="daily"
                        @selected(
                        old('method_type')==='daily'
                        )>
                        Harian
                    </option>

                    <option
                        value="contract"
                        @selected(
                        old('method_type')==='contract'
                        )>
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
                        old( 'status' , 'planned'
                        )==='planned'
                        )>
                        Belum Dimulai
                    </option>

                    <option
                        value="ongoing"
                        @selected(
                        old('status')==='ongoing'
                        )>
                        Berjalan
                    </option>

                    <option
                        value="completed"
                        @selected(
                        old('status')==='completed'
                        )>
                        Selesai
                    </option>

                    <option
                        value="cancelled"
                        @selected(
                        old('status')==='cancelled'
                        )>
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
                    value="{{ old('volume') }}"
                    class="admin-form-control"
                    placeholder="Contoh: 100">

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Satuan
                </label>

                <input
                    type="text"
                    name="unit"
                    value="{{ old('unit') }}"
                    class="admin-form-control"
                    placeholder="Contoh: m², meter, unit">

            </div>


            <div class="admin-form-group">

                <label class="admin-form-label">
                    Harga Satuan
                </label>

                <input
                    type="number"
                    min="0"
                    step="0.01"
                    name="unit_price"
                    id="workUnitPrice"
                    value="{{ old('unit_price', 0) }}"
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
                    value="{{ old('duration_days') }}"
                    class="admin-form-control"
                    placeholder="Jumlah hari">

            </div>


            <div class="admin-form-group full">

                <label class="admin-form-label">
                    Estimasi Total Biaya
                </label>

                <input
                    type="text"
                    id="workTotalPreview"
                    class="admin-form-control"
                    value="Rp 0"
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
                        true
                        )
                        )>

                    <span class="admin-form-label">
                        Tampilkan pekerjaan ini kepada Client
                    </span>

                </label>

            </div>


        </div>


        <div class="admin-form-actions">

            <a
                href="{{ route('admin.works.index') }}"
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
                Simpan Pekerjaan
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