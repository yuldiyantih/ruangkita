@extends('layouts.admin')

@php
$pageLang = auth()->user()->language ?? 'id';

$translations = [
'id' => [
'page_title' => 'Tambah Jadwal',
'schedule_data' => 'Data Jadwal',
'add_schedule' => 'Tambah Jadwal',
'subtitle' => 'Tambahkan jadwal berdasarkan pekerjaan proyek.',
'schedule_information' => 'Informasi Jadwal',
'work' => 'Pekerjaan',
'select_work' => 'Pilih Pekerjaan',
'project' => 'Proyek',
'start_date' => 'Tanggal Mulai',
'end_date' => 'Tanggal Selesai',
'description' => 'Deskripsi',
'description_placeholder' => 'Masukkan keterangan jadwal (opsional)',
'cancel' => 'Batal',
'save' => 'Simpan Jadwal',
],
'en' => [
'page_title' => 'Add Schedule',
'schedule_data' => 'Schedule Data',
'add_schedule' => 'Add Schedule',
'subtitle' => 'Add a schedule based on project work.',
'schedule_information' => 'Schedule Information',
'work' => 'Work',
'select_work' => 'Select Work',
'project' => 'Project',
'start_date' => 'Start Date',
'end_date' => 'End Date',
'description' => 'Description',
'description_placeholder' => 'Enter schedule description (optional)',
'cancel' => 'Cancel',
'save' => 'Save Schedule',
],
];

$st = $translations[$pageLang] ?? $translations['id'];
@endphp

@section('title', $st['page_title'] . ' - RuangKita')

@section('content')
<div style="max-width:1050px;">

    {{-- BREADCRUMB --}}
    <div class="admin-breadcrumb">
        <a href="{{ route('admin.schedules.index') }}">
            {{ $st['schedule_data'] }}
        </a>
        <span class="admin-breadcrumb-separator">/</span>
        <span class="admin-breadcrumb-current">
            {{ $st['add_schedule'] }}
        </span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="admin-page-header">
        <h1 class="admin-page-title">{{ $st['add_schedule'] }}</h1>
        <p class="admin-page-subtitle">{{ $st['subtitle'] }}</p>
    </div>

    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('admin.schedules.store') }}"
        class="admin-form-card">
        @csrf

        <div class="admin-form-title">
            {{ $st['schedule_information'] }}
        </div>

        <div class="admin-form-grid">

            {{-- WORK --}}
            <div class="admin-form-group full">
                <label class="admin-form-label">
                    {{ $st['work'] }}
                    <span class="admin-required">*</span>
                </label>

                <select
                    name="work_id"
                    class="admin-form-control"
                    required>
                    <option value="">
                        {{ $st['select_work'] }}
                    </option>

                    @foreach($works as $work)
                    <option
                        value="{{ $work->work_id }}"
                        @selected(old('work_id')==$work->work_id)>
                        {{ $work->work_name }}
                        —
                        {{ optional($work->project)->project_name ?? '-' }}
                    </option>
                    @endforeach
                </select>

                @error('work_id')
                <div style="margin-top:6px;color:var(--danger);font-size:13px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- START DATE --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    {{ $st['start_date'] }}
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    class="admin-form-control"
                    required>

                @error('start_date')
                <div style="margin-top:6px;color:var(--danger);font-size:13px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- END DATE --}}
            <div class="admin-form-group">
                <label class="admin-form-label">
                    {{ $st['end_date'] }}
                    <span class="admin-required">*</span>
                </label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ old('end_date') }}"
                    class="admin-form-control"
                    required>

                @error('end_date')
                <div style="margin-top:6px;color:var(--danger);font-size:13px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="admin-form-group full">
                <label class="admin-form-label">
                    {{ $st['description'] }}
                </label>

                <textarea
                    name="description"
                    class="admin-form-control"
                    placeholder="{{ $st['description_placeholder'] }}">{{ old('description') }}</textarea>

                @error('description')
                <div style="margin-top:6px;color:var(--danger);font-size:13px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="admin-form-actions">
            <a
                href="{{ route('admin.schedules.index') }}"
                class="admin-btn admin-btn-secondary">
                {{ $st['cancel'] }}
            </a>

            <button
                type="submit"
                class="admin-btn admin-btn-primary">
                {{ $st['save'] }}
            </button>
        </div>
    </form>

</div>
@endsection