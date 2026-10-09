@extends('layouts.client')


@php

$arLang = auth()->user()->language ?? 'id';

$arTranslations = [

'id' => [

'home' => 'Beranda',
'title' => 'Augmented Reality',

'description' =>
'Lihat preview renovasi atau desain interior proyek Anda sebelum divisualisasikan menggunakan Augmented Reality.',

'active_project' => 'Proyek Aktif',
'select_area' => 'Pilih Area Ruangan',

'hero_title' =>
'Rasakan Desain Anda Secara Langsung di Ruangan',

'hero_description' =>
'Pilih area dan elemen desain. Nantinya model 3D akan ditampilkan menggunakan kamera perangkat mobile.',

'mobile_title' =>
'📱 Lihat AR di Mobile',

'mobile_description' =>
'Gunakan aplikasi RuangKita Mobile untuk membuka desain ini dalam mode Augmented Reality.',

'mobile_button' =>
'Scan QR / Buka di Mobile',

'qr_placeholder' =>
'QR Code tersedia pada Tahap Mobile',

'usage_flow' =>
'Alur Penggunaan AR',

'step_project' =>
'Pilih Proyek',

'step_project_desc' =>
'Tentukan proyek renovasi.',

'step_room' =>
'Pilih Ruangan',

'step_room_desc' =>
'Pilih area yang ingin divisualisasikan.',

'step_element' =>
'Pilih Elemen',

'step_element_desc' =>
'Pilih furniture, warna atau material.',

'step_ar' =>
'Buka AR',

'step_ar_desc' =>
'Visualisasikan melalui kamera mobile.',

'area_title' =>
'Pilih Area Ruangan',

'area_description' =>
'Pilih ruangan proyek yang ingin ditampilkan dalam AR.',

'default_area' =>
'Area proyek',

'no_area' =>
'Belum ada area / ruangan pada proyek ini.',

'design_elements' =>
'Elemen Desain',

'design_elements_desc' =>
'Pilih furniture, material atau warna yang nantinya dapat digunakan pada AR.',

'no_asset' =>
'Belum ada AR Asset. Asset akan ditambahkan oleh Admin.',

],


'en' => [

'home' => 'Home',
'title' => 'Augmented Reality',

'description' =>
'Preview your renovation or interior design before visualizing it using Augmented Reality.',

'active_project' =>
'Active Project',

'select_area' =>
'Select Room Area',

'hero_title' =>
'Experience Your Design Directly in Your Room',

'hero_description' =>
'Choose an area and design elements. The 3D model will later be displayed through your mobile device camera.',

'mobile_title' =>
'📱 View AR on Mobile',

'mobile_description' =>
'Use the RuangKita Mobile application to open this design in Augmented Reality mode.',

'mobile_button' =>
'Scan QR / Open on Mobile',

'qr_placeholder' =>
'QR Code will be available in the Mobile stage',

'usage_flow' =>
'How to Use AR',

'step_project' =>
'Select Project',

'step_project_desc' =>
'Choose your renovation project.',

'step_room' =>
'Select Room',

'step_room_desc' =>
'Choose the area you want to visualize.',

'step_element' =>
'Select Element',

'step_element_desc' =>
'Choose furniture, colors, or materials.',

'step_ar' =>
'Open AR',

'step_ar_desc' =>
'Visualize it using your mobile camera.',

'area_title' =>
'Select Room Area',

'area_description' =>
'Choose the project room you want to display in AR.',

'default_area' =>
'Project area',

'no_area' =>
'No areas or rooms are available for this project.',

'design_elements' =>
'Design Elements',

'design_elements_desc' =>
'Choose furniture, materials, or colors that can later be used in AR.',

'no_asset' =>
'No AR assets are available yet. Assets will be added by Admin.',

],

];

$at =
$arTranslations[$arLang]
??
$arTranslations['id'];

@endphp


@section(
'title',
$at['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       PAGE TITLE
    ===================================================== */

    .ar-page-title {

        margin-bottom: 22px;
    }


    .ar-page-title h1 {

        margin-bottom: 6px;

        color:
            var(--text-heading);

        font-size: 28px;
    }


    .ar-page-title p {

        color:
            var(--text-muted);

        font-size: 13px;

        line-height: 1.5;
    }


    /* =====================================================
       TOP GRID
    ===================================================== */

    .top-grid {

        margin-bottom: 17px;

        display: grid;

        grid-template-columns:
            minmax(0, 1.8fr) minmax(300px, .8fr);

        gap: 17px;
    }


    /* =====================================================
       AR PREVIEW
    ===================================================== */

    .ar-preview {

        min-height: 340px;

        position: relative;

        overflow: hidden;

        border-radius: 14px;

        background:
            linear-gradient(135deg,
                #294962,
                #8fa2ae);
    }


    .ar-preview::after {

        content: "";

        position: absolute;

        inset: 0;

        background:
            linear-gradient(90deg,
                rgba(8,
                    32,
                    50,
                    .68),
                rgba(8,
                    32,
                    50,
                    .08));
    }


    .ar-preview-image {

        position: absolute;

        inset: 0;

        width: 100%;
        height: 100%;

        object-fit: cover;
    }


    /* =====================================================
       PROJECT BOX
    ===================================================== */

    .project-box {

        position: absolute;

        z-index: 4;

        top: 22px;
        left: 22px;

        width: 280px;

        padding: 16px;

        border-radius: 12px;

        background:
            rgba(255,
                255,
                255,
                .96);
    }


    body.dark-mode .project-box {

        background:
            rgba(23,
                39,
                53,
                .96);
    }


    .box-label {

        margin-bottom: 7px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .select-box {

        width: 100%;
        height: 43px;

        padding:
            0 11px;

        border:
            1px solid var(--border);

        border-radius: 9px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 11px;
    }


    .project-box-space {

        height: 12px;
    }


    /* =====================================================
       HERO TEXT
    ===================================================== */

    .hero-text {

        position: absolute;

        z-index: 4;

        left: 22px;
        bottom: 22px;

        max-width: 460px;

        color: white;
    }


    .hero-text h2 {

        margin-bottom: 8px;

        font-size: 24px;
    }


    .hero-text p {

        color: #e2edf5;

        font-size: 12px;

        line-height: 1.6;
    }


    /* =====================================================
       SIDE CARD
    ===================================================== */

    .side-card {

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .side-card+.side-card {

        margin-top: 15px;
    }


    .side-title {

        margin-bottom: 7px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .side-text {

        color:
            var(--text-muted);

        font-size: 10px;

        line-height: 1.6;
    }


    .mobile-button {

        width: 100%;

        min-height: 42px;

        margin-top: 14px;

        border: none;

        border-radius: 9px;

        color: white;

        background:
            linear-gradient(90deg,
                #0877d4,
                #078ee5);

        font-size: 11px;

        font-weight: 700;

        cursor: pointer;
    }


    .qr-placeholder {

        width: 120px;
        height: 120px;

        margin:
            15px auto 0;

        display: flex;

        align-items: center;
        justify-content: center;

        border:
            1px dashed var(--border);

        border-radius: 10px;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        font-size: 10px;

        text-align: center;
    }


    /* =====================================================
       STEPS
    ===================================================== */

    .steps {

        margin-top: 14px;
    }


    .step {

        margin-bottom: 13px;

        display: grid;

        grid-template-columns:
            30px 1fr;

        gap: 10px;
    }


    .step-number {

        width: 27px;
        height: 27px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #e7f2ff;

        color: #0874ca;

        font-size: 10px;

        font-weight: 700;
    }


    body.dark-mode .step-number {

        background: #19364d;

        color: #72bdf5;
    }


    .step-title {

        margin-bottom: 3px;

        color:
            var(--text-heading);

        font-size: 10px;

        font-weight: 700;
    }


    .step-text {

        color:
            var(--text-muted);

        font-size: 9px;

        line-height: 1.4;
    }


    /* =====================================================
       PANEL
    ===================================================== */

    .ar-panel {

        margin-bottom: 17px;

        padding: 18px;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);
    }


    .panel-title {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 14px;

        font-weight: 700;
    }


    .panel-subtitle {

        margin-bottom: 15px;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    /* =====================================================
       AREA
    ===================================================== */

    .area-grid {

        display: grid;

        grid-template-columns:
            repeat(4,
                minmax(0, 1fr));

        gap: 13px;
    }


    .area-card {

        overflow: hidden;

        border:
            1px solid var(--border);

        border-radius: 10px;

        background:
            var(--card-bg);

        color: inherit;

        text-decoration: none;

        transition: .2s;
    }


    .area-card:hover {

        transform:
            translateY(-2px);
    }


    .area-card.active {

        border:
            2px solid var(--primary);

        background: #f6fbff;
    }


    body.dark-mode .area-card.active {

        background: #19364d;
    }


    .area-image {

        width: 100%;
        height: 95px;

        object-fit: cover;

        background:
            linear-gradient(135deg,
                #dcebf8,
                #eef5fa);
    }


    body.dark-mode .area-image {

        background:
            linear-gradient(135deg,
                #263b4b,
                #172735);
    }


    .area-body {

        padding: 10px;
    }


    .area-name {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 11px;

        font-weight: 700;
    }


    .area-description {

        overflow: hidden;

        white-space: nowrap;

        text-overflow: ellipsis;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    /* =====================================================
       AR ASSET
    ===================================================== */

    .asset-grid {

        display: grid;

        grid-template-columns:
            repeat(6,
                minmax(0, 1fr));

        gap: 12px;
    }


    .asset-card {

        padding:
            13px 9px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        background:
            var(--card-bg);

        text-align: center;

        cursor: pointer;

        transition: .2s;
    }


    .asset-card:hover {

        transform:
            translateY(-2px);
    }


    .asset-card.active {

        border:
            2px solid var(--primary);

        background: #f5fbff;
    }


    body.dark-mode .asset-card.active {

        background: #19364d;
    }


    .asset-icon {

        width: 47px;
        height: 47px;

        margin:
            0 auto 8px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #eaf3fb;

        font-size: 23px;
    }


    body.dark-mode .asset-icon {

        background: #21394c;
    }


    .asset-name {

        color:
            var(--text-heading);

        font-size: 10px;

        font-weight: 700;

        line-height: 1.35;
    }


    .asset-type {

        margin-top: 4px;

        color:
            var(--text-muted);

        font-size: 8px;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty {

        padding:
            30px 15px;

        border-radius: 10px;

        background:
            var(--input-bg);

        color:
            var(--text-muted);

        text-align: center;

        font-size: 11px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 1150px) {

        .asset-grid {

            grid-template-columns:
                repeat(3, 1fr);
        }


        .area-grid {

            grid-template-columns:
                1fr 1fr;
        }

    }


    @media(max-width: 900px) {

        .top-grid {

            grid-template-columns:
                1fr;
        }

    }


    @media(max-width: 600px) {

        .project-box {

            position: relative;

            top: auto;
            left: auto;

            width: auto;

            margin: 15px;
        }


        .hero-text {

            left: 17px;
            right: 17px;
        }


        .area-grid,
        .asset-grid {

            grid-template-columns:
                1fr 1fr;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="breadcrumb">

    <a href="{{ route('client.dashboard') }}">

        {{ $at['home'] }}

    </a>

    &nbsp;›&nbsp;

    {{ $at['title'] }}

</div>



{{-- =====================================================
         PAGE TITLE
    ====================================================== --}}

<div class="ar-page-title">

    <h1>

        {{ $at['title'] }}

    </h1>

    <p>

        {{ $at['description'] }}

    </p>

</div>



{{-- =====================================================
         TOP GRID
    ====================================================== --}}

<div class="top-grid">


    {{-- AR PREVIEW --}}

    <div class="ar-preview">


        @if($selectedArea && $selectedArea->photo)

        <img

            src="{{
                        asset(
                            'storage/' .
                            $selectedArea->photo
                        )
                    }}"

            class="ar-preview-image"

            alt="{{
                        $selectedArea
                            ->area_name
                    }}">

        @endif



        @if($selectedProject)


        <div class="project-box">


            <div class="box-label">

                {{ $at['active_project'] }}

            </div>


            <form

                method="GET"

                action="{{ route('client.ar') }}">

                <select

                    name="project"

                    class="select-box"

                    onchange="this.form.submit()">

                    @foreach($projects as $project)

                    <option

                        value="{{ $project->id }}"

                        @selected(
                        $project->id
                        ===
                        $selectedProject->id
                        )

                        >

                        {{
                                        $project
                                            ->project_name
                                    }}

                    </option>

                    @endforeach

                </select>

            </form>



            <div class="project-box-space"></div>



            <div class="box-label">

                {{ $at['select_area'] }}

            </div>


            <form

                method="GET"

                action="{{ route('client.ar') }}">

                <input

                    type="hidden"

                    name="project"

                    value="{{
                                $selectedProject
                                    ->id
                            }}">


                <select

                    name="area"

                    class="select-box"

                    onchange="this.form.submit()">

                    @foreach($areas as $area)

                    <option

                        value="{{ $area->id }}"

                        @selected(
                        $selectedArea
                        &&
                        $area->id
                        ===
                        $selectedArea->id
                        )

                        >

                        {{ $area->area_name }}

                    </option>

                    @endforeach

                </select>

            </form>


        </div>


        @endif



        <div class="hero-text">

            <h2>

                {{ $at['hero_title'] }}

            </h2>

            <p>

                {{ $at['hero_description'] }}

            </p>

        </div>


    </div>



    {{-- RIGHT SIDE --}}

    <div>


        <div class="side-card">


            <div class="side-title">

                {{ $at['mobile_title'] }}

            </div>


            <div class="side-text">

                {{
                        $at[
                            'mobile_description'
                        ]
                    }}

            </div>


            <button

                type="button"

                class="mobile-button">

                {{
                        $at[
                            'mobile_button'
                        ]
                    }}

            </button>


            <div class="qr-placeholder">

                {{
                        $at[
                            'qr_placeholder'
                        ]
                    }}

            </div>


        </div>



        <div class="side-card">


            <div class="side-title">

                {{ $at['usage_flow'] }}

            </div>


            <div class="steps">


                <div class="step">

                    <div class="step-number">
                        1
                    </div>

                    <div>

                        <div class="step-title">

                            {{
                                    $at[
                                        'step_project'
                                    ]
                                }}

                        </div>

                        <div class="step-text">

                            {{
                                    $at[
                                        'step_project_desc'
                                    ]
                                }}

                        </div>

                    </div>

                </div>



                <div class="step">

                    <div class="step-number">
                        2
                    </div>

                    <div>

                        <div class="step-title">

                            {{
                                    $at[
                                        'step_room'
                                    ]
                                }}

                        </div>

                        <div class="step-text">

                            {{
                                    $at[
                                        'step_room_desc'
                                    ]
                                }}

                        </div>

                    </div>

                </div>



                <div class="step">

                    <div class="step-number">
                        3
                    </div>

                    <div>

                        <div class="step-title">

                            {{
                                    $at[
                                        'step_element'
                                    ]
                                }}

                        </div>

                        <div class="step-text">

                            {{
                                    $at[
                                        'step_element_desc'
                                    ]
                                }}

                        </div>

                    </div>

                </div>



                <div class="step">

                    <div class="step-number">
                        4
                    </div>

                    <div>

                        <div class="step-title">

                            {{
                                    $at[
                                        'step_ar'
                                    ]
                                }}

                        </div>

                        <div class="step-text">

                            {{
                                    $at[
                                        'step_ar_desc'
                                    ]
                                }}

                        </div>

                    </div>

                </div>


            </div>


        </div>


    </div>


</div>



{{-- =====================================================
         AREA
    ====================================================== --}}

<div class="ar-panel">


    <div class="panel-title">

        {{ $at['area_title'] }}

    </div>


    <div class="panel-subtitle">

        {{ $at['area_description'] }}

    </div>



    @if($areas->count() > 0)


    <div class="area-grid">


        @foreach($areas as $area)


        <a

            href="{{
                            route(
                                'client.ar',
                                [
                                    'project'
                                    =>
                                    $selectedProject->id,

                                    'area'
                                    =>
                                    $area->id
                                ]
                            )
                        }}"

            class="
                            area-card
                            {{
                                $selectedArea
                                &&
                                $selectedArea->id
                                ===
                                $area->id
                                ?
                                'active'
                                :
                                ''
                            }}
                        ">


            @if($area->photo)

            <img

                src="{{
                                    asset(
                                        'storage/' .
                                        $area->photo
                                    )
                                }}"

                class="area-image"

                alt="{{
                                    $area->area_name
                                }}">

            @else

            <div
                class="area-image"></div>

            @endif



            <div class="area-body">


                <div class="area-name">

                    {{ $area->area_name }}

                </div>


                <div class="area-description">

                    {{
                                    $area->description
                                    ??
                                    $at[
                                        'default_area'
                                    ]
                                }}

                </div>


            </div>


        </a>


        @endforeach


    </div>


    @else


    <div class="empty">

        {{ $at['no_area'] }}

    </div>


    @endif


</div>



{{-- =====================================================
         AR ASSETS
    ====================================================== --}}

<div class="ar-panel">


    <div class="panel-title">

        {{ $at['design_elements'] }}

    </div>


    <div class="panel-subtitle">

        {{
                $at[
                    'design_elements_desc'
                ]
            }}

    </div>



    @if($arAssets->count() > 0)


    <div class="asset-grid">


        @foreach($arAssets as $asset)


        <div

            class="asset-card"

            data-asset-id="{{
                            $asset->id
                        }}">


            <div class="asset-icon">


                @if($asset->asset_type === 'color')

                🎨

                @elseif(($asset->asset_type ?? '') === 'material')

                ▦

                @else

                ◇

                @endif


            </div>



            <div class="asset-name">

                {{
                                $asset->name
                                ??
                                $asset->asset_name
                                ??
                                'AR Asset'
                            }}

            </div>


            <div class="asset-type">

                {{
                                ucfirst(
                                    $asset->asset_type
                                )
                            }}

            </div>


        </div>


        @endforeach


    </div>


    @else


    <div class="empty">

        {{ $at['no_asset'] }}

    </div>


    @endif


</div>


@endsection



@push('scripts')

<script>
    /*
    |--------------------------------------------------------------------------
    | SELECT AR ASSET
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.asset-card'
        )
        .forEach(
            function(card) {

                card.addEventListener(
                    'click',
                    function() {

                        document
                            .querySelectorAll(
                                '.asset-card'
                            )
                            .forEach(
                                function(item) {

                                    item
                                        .classList
                                        .remove(
                                            'active'
                                        );

                                }
                            );


                        this
                            .classList
                            .add(
                                'active'
                            );

                    }
                );

            }
        );
</script>

@endpush