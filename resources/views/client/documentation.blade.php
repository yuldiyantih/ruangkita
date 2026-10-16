@extends('layouts.client')

@php
$docLang = auth()->user()->language ?? 'id';

$docTranslations = [
'id' => [
'title' => 'Dokumentasi Proyek',
'description' => 'Lihat dokumentasi perkembangan proyek renovasi Anda.',
'total_documentation' => 'Total Dokumentasi',
'before' => 'Sebelum',
'during' => 'Proses',
'after' => 'Setelah',
'all' => 'Semua',
'sort_latest' => 'Urutkan: Terbaru',
'sort_oldest' => 'Urutkan: Terlama',
'latest_documentation' => 'Dokumentasi Terbaru',
'no_documentation' => 'Belum ada dokumentasi pada proyek ini.',
'no_latest_documentation' => 'Belum ada dokumentasi terbaru.',
'no_project' => 'Belum ada proyek yang terhubung dengan akun Anda.',
'visible_documentation' => 'Dokumentasi yang ditampilkan adalah dokumentasi yang dibagikan kepada client.',
'untitled' => 'Tanpa Judul',
],

'en' => [
'title' => 'Project Documentation',
'description' => 'View documentation of your renovation project progress.',
'total_documentation' => 'Total Documentation',
'before' => 'Before',
'during' => 'During',
'after' => 'After',
'all' => 'All',
'sort_latest' => 'Sort: Latest',
'sort_oldest' => 'Sort: Oldest',
'latest_documentation' => 'Latest Documentation',
'no_documentation' => 'No documentation is available for this project yet.',
'no_latest_documentation' => 'No latest documentation is available.',
'no_project' => 'There are no projects connected to your account yet.',
'visible_documentation' => 'Only documentation shared with the client is displayed.',
'untitled' => 'Untitled',
],
];

$dt = $docTranslations[$docLang] ?? $docTranslations['id'];
@endphp

@section('title', $dt['title'] . ' - RuangKita')

@push('styles')
<style>
    .documentation-page-head {
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .documentation-page-title h1 {
        margin-bottom: 5px;
        color: var(--text-heading);
        font-size: 27px;
    }

    .documentation-page-title p {
        color: var(--text-muted);
        font-size: 13px;
    }

    .project-selector {
        min-width: 310px;
        padding: 10px;
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--card-bg);
    }

    .selector-thumb {
        width: 48px;
        height: 42px;
        border-radius: 7px;
        object-fit: cover;
        background: #e6eef5;
    }

    body.dark-mode .selector-thumb {
        background: #263b4b;
    }

    .selector-content {
        flex: 1;
        min-width: 0;
    }

    .selector-title {
        margin-bottom: 3px;
        color: var(--text-heading);
        font-size: 12px;
        font-weight: 700;
    }

    .selector-location {
        color: var(--text-muted);
        font-size: 10px;
    }

    .project-select {
        width: 30px;
        border: none;
        outline: none;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
    }

    .summary-grid {
        margin-bottom: 18px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .summary-card {
        padding: 17px;
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--card-bg);
    }

    .summary-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 21px;
    }

    .summary-icon.blue {
        color: #0877d2;
        background: #e7f3ff;
    }

    .summary-icon.gray {
        color: #536574;
        background: #edf2f6;
    }

    .summary-icon.orange {
        color: #c77900;
        background: #fff1d7;
    }

    .summary-icon.green {
        color: #139261;
        background: #e0f9ed;
    }

    body.dark-mode .summary-icon.blue {
        background: #19364d;
    }

    body.dark-mode .summary-icon.gray {
        background: #263b4b;
    }

    body.dark-mode .summary-icon.orange {
        background: #4a3720;
    }

    body.dark-mode .summary-icon.green {
        background: #173d31;
    }

    .summary-label {
        margin-bottom: 3px;
        color: var(--text-muted);
        font-size: 11px;
    }

    .summary-number {
        color: var(--text-heading);
        font-size: 23px;
        font-weight: 700;
    }

    .summary-type {
        margin-top: 2px;
        color: var(--text-muted);
        font-size: 9px;
    }

    .documentation-note {
        margin-bottom: 18px;
        padding: 11px 13px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--card-bg);
        color: var(--text-muted);
        font-size: 10px;
    }

    .toolbar {
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 9px 13px;
        border: 1px solid var(--border);
        border-radius: 9px;
        background: var(--card-bg);
        color: var(--text-muted);
        cursor: pointer;
        font-size: 11px;
        font-weight: 600;
    }

    .filter-btn.active {
        border-color: var(--primary);
        background: var(--primary);
        color: white;
    }

    .toolbar-select {
        min-width: 155px;
        padding: 9px 12px;
        border: 1px solid var(--border);
        border-radius: 9px;
        outline: none;
        background: var(--card-bg);
        color: var(--text-main);
        font-size: 11px;
    }

    .documentation-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 17px;
        align-items: start;
    }

    .gallery-panel,
    .latest-panel {
        padding: 17px;
        border: 1px solid var(--border);
        border-radius: 13px;
        background: var(--card-bg);
    }

    .gallery-panel-title,
    .latest-title {
        margin-bottom: 16px;
        color: var(--text-heading);
        font-size: 15px;
        font-weight: 700;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 13px;
    }

    .gallery-card {
        min-width: 0;
    }

    .gallery-image-wrap {
        position: relative;
        margin-bottom: 8px;
    }

    .gallery-image {
        width: 100%;
        height: 165px;
        display: block;
        border-radius: 9px;
        object-fit: cover;
        background: linear-gradient(135deg, #dae7f2, #edf4f9);
    }

    body.dark-mode .gallery-image {
        background: linear-gradient(135deg, #263b4b, #172735);
    }

    .phase-badge {
        position: absolute;
        left: 7px;
        bottom: 7px;
        padding: 4px 7px;
        border-radius: 5px;
        color: white;
        font-size: 8px;
        font-weight: 700;
        background: rgba(14, 39, 58, .85);
    }

    .phase-before {
        background: rgba(45, 65, 80, .9);
    }

    .phase-during {
        background: rgba(8, 117, 205, .92);
    }

    .phase-after {
        background: rgba(20, 139, 91, .92);
    }

    .gallery-title {
        margin-bottom: 3px;
        color: var(--text-heading);
        font-size: 11px;
        line-height: 1.35;
        font-weight: 700;
    }

    .gallery-description {
        min-height: 29px;
        color: var(--text-muted);
        font-size: 9px;
        line-height: 1.45;
    }

    .gallery-date {
        margin-top: 6px;
        color: var(--text-muted);
        font-size: 8px;
    }

    .latest-timeline {
        position: relative;
    }

    .latest-timeline::before {
        content: "";
        position: absolute;
        left: 7px;
        top: 12px;
        bottom: 20px;
        width: 2px;
        background: var(--border);
    }

    .latest-item {
        position: relative;
        padding-left: 27px;
        padding-bottom: 17px;
    }

    .latest-dot {
        width: 13px;
        height: 13px;
        position: absolute;
        left: 1px;
        top: 11px;
        z-index: 2;
        border-radius: 50%;
        border: 4px solid var(--card-bg);
        background: var(--primary);
        box-shadow: 0 0 0 1px var(--primary);
    }

    .latest-card {
        display: grid;
        grid-template-columns: 72px minmax(0, 1fr);
        gap: 10px;
    }

    .latest-thumb {
        width: 72px;
        height: 60px;
        border-radius: 7px;
        object-fit: cover;
        background: var(--input-bg);
    }

    .latest-item-title {
        margin-bottom: 5px;
        color: var(--text-heading);
        font-size: 10px;
        font-weight: 700;
        line-height: 1.35;
    }

    .latest-category {
        display: inline-block;
        margin-bottom: 4px;
        padding: 3px 7px;
        border-radius: 10px;
        background: #e6f2ff;
        color: #0872c6;
        font-size: 8px;
    }

    body.dark-mode .latest-category {
        background: #19364d;
        color: #72bdf5;
    }

    .latest-date {
        color: var(--text-muted);
        font-size: 8px;
    }

    .empty-state {
        padding: 35px 20px;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: var(--card-bg);
        color: var(--text-muted);
        text-align: center;
        font-size: 12px;
    }

    @media (max-width: 1150px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .documentation-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {
        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 650px) {
        .documentation-page-head {
            flex-direction: column;
        }

        .project-selector {
            width: 100%;
            min-width: 0;
        }

        .summary-grid {
            grid-template-columns: 1fr 1fr;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
        }

        .toolbar {
            align-items: stretch;
        }

        .toolbar-select {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="documentation-page-head">
    <div class="documentation-page-title">
        <h1>
            {{ $dt['title'] }}
        </h1>

        <p>
            {{ $dt['description'] }}
        </p>
    </div>

    @if ($selectedProject)
    <form
        method="GET"
        action="{{ route('client.documentation') }}"
        class="project-selector">
        @if ($selectedProject->cover_image)
        <img
            src="{{ asset('storage/' . $selectedProject->cover_image) }}"
            alt="{{ $selectedProject->project_name }}"
            class="selector-thumb">
        @else
        <div class="selector-thumb"></div>
        @endif

        <div class="selector-content">
            <div class="selector-title">
                {{ $selectedProject->project_name }}
            </div>

            <div class="selector-location">
                {{ $selectedProject->location ?? '-' }}
            </div>
        </div>

        <select
            name="project"
            class="project-select"
            onchange="this.form.submit()">
            @foreach ($projects as $project)
            <option
                value="{{ $project->id }}"
                @selected(
                (int) $selectedProject->id ===
                (int) $project->id
                )
                >
                {{ $project->project_name }}
            </option>
            @endforeach
        </select>
    </form>
    @endif
</div>

@if ($selectedProject)
<div class="summary-grid">
    <div class="summary-card">
        <div class="summary-icon blue">
            ▧
        </div>

        <div>
            <div class="summary-label">
                {{ $dt['total_documentation'] }}
            </div>

            <div class="summary-number">
                {{ $documentationStats['total'] ?? 0 }}
            </div>

            <div class="summary-type">
                {{ $dt['all'] }}
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon gray">
            ◫
        </div>

        <div>
            <div class="summary-label">
                {{ $dt['before'] }}
            </div>

            <div class="summary-number">
                {{ $documentationStats['before'] ?? 0 }}
            </div>

            <div class="summary-type">
                BEFORE
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon orange">
            ↗
        </div>

        <div>
            <div class="summary-label">
                {{ $dt['during'] }}
            </div>

            <div class="summary-number">
                {{ $documentationStats['during'] ?? 0 }}
            </div>

            <div class="summary-type">
                PROGRESS
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="summary-icon green">
            ✓
        </div>

        <div>
            <div class="summary-label">
                {{ $dt['after'] }}
            </div>

            <div class="summary-number">
                {{ $documentationStats['after'] ?? 0 }}
            </div>

            <div class="summary-type">
                AFTER
            </div>
        </div>
    </div>
</div>

<div class="documentation-note">
    {{ $dt['visible_documentation'] }}
</div>

<div class="toolbar">
    <div class="filter-group">
        <button
            type="button"
            class="filter-btn active"
            data-category="all">
            {{ $dt['all'] }}
            ({{ $documentationStats['total'] ?? 0 }})
        </button>

        <button
            type="button"
            class="filter-btn"
            data-category="before">
            {{ $dt['before'] }}
            ({{ $documentationStats['before'] ?? 0 }})
        </button>

        <button
            type="button"
            class="filter-btn"
            data-category="during">
            {{ $dt['during'] }}
            ({{ $documentationStats['during'] ?? 0 }})
        </button>

        <button
            type="button"
            class="filter-btn"
            data-category="after">
            {{ $dt['after'] }}
            ({{ $documentationStats['after'] ?? 0 }})
        </button>
    </div>

    <select id="sortFilter" class="toolbar-select">
        <option value="latest">
            {{ $dt['sort_latest'] }}
        </option>

        <option value="oldest">
            {{ $dt['sort_oldest'] }}
        </option>
    </select>
</div>

<div class="documentation-layout">
    <div class="gallery-panel">
        <div class="gallery-panel-title">
            {{ $dt['title'] }}
        </div>

        @if ($selectedProject->documentations->count() > 0)
        <div
            id="documentationGallery"
            class="gallery-grid">
            @foreach ($selectedProject->documentations as $doc)
            @php
            $categoryLabel = match ($doc->category) {
            'before' => $dt['before'],
            'during' => $dt['during'],
            'after' => $dt['after'],
            default => '-',
            };

            $categoryClass = match ($doc->category) {
            'before' => 'phase-before',
            'during' => 'phase-during',
            'after' => 'phase-after',
            default => '',
            };

            $docDate = $doc->photo_date ?? $doc->created_at;
            @endphp

            <div
                class="gallery-card documentation-item"
                data-category="{{ $doc->category }}"
                data-date="{{ optional($docDate)->format('Y-m-d') }}">
                <div class="gallery-image-wrap">
                    <img
                        src="{{ asset('storage/' . $doc->file_path) }}"
                        alt="{{ $doc->title ?? $dt['untitled'] }}"
                        class="gallery-image">

                    <span class="phase-badge {{ $categoryClass }}">
                        {{ strtoupper($categoryLabel) }}
                    </span>
                </div>

                <div class="gallery-title">
                    {{ $doc->title ?? $dt['untitled'] }}
                </div>

                <div class="gallery-description">
                    {{
                                        \Illuminate\Support\Str::limit(
                                            $doc->description ?? '-',
                                            100
                                        )
                                    }}
                </div>

                <div class="gallery-date">
                    {{
                                        optional($docDate)->format('d M Y')
                                        ?? '-'
                                    }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            {{ $dt['no_documentation'] }}
        </div>
        @endif
    </div>

    <aside class="latest-panel">
        <div class="latest-title">
            {{ $dt['latest_documentation'] }}
        </div>

        <div class="latest-timeline">
            @php
            $latestDocumentations = $selectedProject->documentations->take(6);
            @endphp

            @forelse ($latestDocumentations as $latest)
            @php
            $latestCategoryLabel = match ($latest->category) {
            'before' => $dt['before'],
            'during' => $dt['during'],
            'after' => $dt['after'],
            default => '-',
            };

            $latestDate = $latest->photo_date ?? $latest->created_at;
            @endphp

            <div class="latest-item">
                <div class="latest-dot"></div>

                <div class="latest-card">
                    <img
                        src="{{ asset('storage/' . $latest->file_path) }}"
                        alt="{{ $latest->title ?? $dt['untitled'] }}"
                        class="latest-thumb">

                    <div>
                        <div class="latest-item-title">
                            {{ $latest->title ?? $dt['untitled'] }}
                        </div>

                        <div class="latest-category">
                            {{ $latestCategoryLabel }}
                        </div>

                        <div class="latest-date">
                            {{
                                            optional($latestDate)->format('d M Y')
                                            ?? '-'
                                        }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                {{ $dt['no_latest_documentation'] }}
            </div>
            @endforelse
        </div>
    </aside>
</div>
@else
<div class="empty-state">
    {{ $dt['no_project'] }}
</div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const gallery = document.getElementById('documentationGallery');
        const sortFilter = document.getElementById('sortFilter');

        function getItems() {
            if (!gallery) {
                return [];
            }

            return Array.from(
                gallery.querySelectorAll('.documentation-item')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY FILTER
        |--------------------------------------------------------------------------
        */

        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                filterButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });

                button.classList.add('active');

                const category = button.dataset.category;

                getItems().forEach(function(item) {
                    const match =
                        category === 'all' ||
                        item.dataset.category === category;

                    item.style.display = match ? 'block' : 'none';
                });
            });
        });

        /*
        |--------------------------------------------------------------------------
        | SORT
        |--------------------------------------------------------------------------
        */

        if (sortFilter && gallery) {
            sortFilter.addEventListener('change', function() {
                const items = getItems();

                items.sort(function(a, b) {
                    const dateA = new Date(
                        a.dataset.date || '1970-01-01'
                    );

                    const dateB = new Date(
                        b.dataset.date || '1970-01-01'
                    );

                    if (sortFilter.value === 'oldest') {
                        return dateA - dateB;
                    }

                    return dateB - dateA;
                });

                items.forEach(function(item) {
                    gallery.appendChild(item);
                });
            });
        }
    });
</script>
@endpush