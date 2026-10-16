@extends('layouts.admin')

@php

$lang = auth()->user()->language ?? 'id';

$translations = [

'id' => [
'title' => 'Pesan',
'subtitle' => 'Kelola percakapan dengan client berdasarkan proyek.',
'conversations' => 'Percakapan',
'search' => 'Cari client...',
'no_conversation' => 'Belum ada percakapan.',
'select_conversation' => 'Pilih percakapan untuk mulai melihat pesan.',
'project' => 'Proyek',
'today' => 'Pesan Hari Ini',
'unread' => 'Belum Dibaca',
'total_chat' => 'Total Percakapan',
'type_message' => 'Tulis pesan...',
'send' => 'Kirim',
'attachment' => 'Lampiran',
'open_file' => 'Buka file',
'no_message' => 'Belum ada pesan.',
],

'en' => [
'title' => 'Messages',
'subtitle' => 'Manage conversations with clients by project.',
'conversations' => 'Conversations',
'search' => 'Search client...',
'no_conversation' => 'No conversations yet.',
'select_conversation' => 'Select a conversation to view messages.',
'project' => 'Project',
'today' => 'Messages Today',
'unread' => 'Unread',
'total_chat' => 'Total Conversations',
'type_message' => 'Type a message...',
'send' => 'Send',
'attachment' => 'Attachment',
'open_file' => 'Open file',
'no_message' => 'No messages yet.',
],

];

$t = $translations[$lang] ?? $translations['id'];

@endphp

@section('title', $t['title'] . ' - RuangKita')


@push('styles')
<style>
    .messages-page-header {
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }

    .messages-page-header h1 {
        margin: 0 0 5px;
        color: var(--text-heading);
        font-size: 27px;
    }

    .messages-page-header p {
        margin: 0;
        color: var(--text-muted);
        font-size: 13px;
    }


    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    .message-summary-grid {
        margin-bottom: 18px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .message-summary-card {
        padding: 16px;
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 13px;
        background: var(--card-bg);
    }

    .message-summary-icon {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 19px;
        background: #e7f3ff;
        color: #0877d2;
    }

    .message-summary-icon.orange {
        background: #fff0d9;
        color: #c57900;
    }

    .message-summary-icon.green {
        background: #e0f9ed;
        color: #139261;
    }

    body.dark-mode .message-summary-icon {
        background: #19364d;
    }

    body.dark-mode .message-summary-icon.orange {
        background: #4a3720;
    }

    body.dark-mode .message-summary-icon.green {
        background: #173d31;
    }

    .message-summary-label {
        margin-bottom: 2px;
        color: var(--text-muted);
        font-size: 10px;
    }

    .message-summary-number {
        color: var(--text-heading);
        font-size: 22px;
        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN LAYOUT
    |--------------------------------------------------------------------------
    */

    .messages-layout {
        min-height: 620px;
        display: grid;
        grid-template-columns: 330px minmax(0, 1fr);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        background: var(--card-bg);
    }


    /*
    |--------------------------------------------------------------------------
    | SIDEBAR CHAT
    |--------------------------------------------------------------------------
    */

    .conversation-panel {
        border-right: 1px solid var(--border);
        background: var(--card-bg);
    }

    .conversation-header {
        padding: 16px;
        border-bottom: 1px solid var(--border);
    }

    .conversation-title {
        margin-bottom: 11px;
        color: var(--text-heading);
        font-size: 14px;
        font-weight: 700;
    }

    .conversation-search {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 9px;
        outline: none;
        background: var(--input-bg);
        color: var(--text-main);
        font-size: 11px;
    }

    .conversation-list {
        max-height: 555px;
        overflow-y: auto;
    }

    .conversation-item {
        padding: 13px 14px;
        border-bottom: 1px solid var(--border);
        display: flex;
        gap: 10px;
        text-decoration: none;
        transition: .2s;
    }

    .conversation-item:hover {
        background: var(--input-bg);
    }

    .conversation-item.active {
        background: #edf6ff;
        border-left: 3px solid var(--primary);
    }

    body.dark-mode .conversation-item.active {
        background: #19364d;
    }

    .conversation-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #dcecff;
        color: #0877d2;
        font-size: 14px;
        font-weight: 700;
    }

    .conversation-content {
        flex: 1;
        min-width: 0;
    }

    .conversation-top {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        align-items: center;
    }

    .conversation-name {
        color: var(--text-heading);
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .conversation-time {
        flex-shrink: 0;
        color: var(--text-muted);
        font-size: 8px;
    }

    .conversation-project {
        margin-top: 2px;
        color: var(--primary);
        font-size: 9px;
    }

    .conversation-bottom {
        margin-top: 4px;
        display: flex;
        justify-content: space-between;
        gap: 8px;
        align-items: center;
    }

    .conversation-preview {
        color: var(--text-muted);
        font-size: 9px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .unread-badge {
        min-width: 19px;
        height: 19px;
        padding: 0 6px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: var(--primary);
        color: #fff;
        font-size: 8px;
        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | CHAT AREA
    |--------------------------------------------------------------------------
    */

    .chat-panel {
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        min-height: 73px;
        padding: 14px 17px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .chat-client {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .chat-avatar {
        width: 43px;
        height: 43px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dcecff;
        color: #0877d2;
        font-size: 15px;
        font-weight: 700;
    }

    .chat-client-name {
        color: var(--text-heading);
        font-size: 13px;
        font-weight: 700;
    }

    .chat-client-project {
        margin-top: 3px;
        color: var(--text-muted);
        font-size: 9px;
    }

    .chat-project-badge {
        padding: 7px 10px;
        border-radius: 8px;
        background: #eef6ff;
        color: #0877d2;
        font-size: 9px;
        font-weight: 600;
    }

    body.dark-mode .chat-project-badge {
        background: #19364d;
        color: #72bdf5;
    }


    /*
    |--------------------------------------------------------------------------
    | CHAT BODY
    |--------------------------------------------------------------------------
    */

    .chat-body {
        height: 440px;
        padding: 20px;
        overflow-y: auto;
        background:
            linear-gradient(180deg,
                rgba(246, 249, 252, .65),
                rgba(246, 249, 252, .28));
    }

    body.dark-mode .chat-body {
        background: #12212c;
    }

    .message-row {
        margin-bottom: 13px;
        display: flex;
    }

    .message-row.mine {
        justify-content: flex-end;
    }

    .message-row.them {
        justify-content: flex-start;
    }

    .message-wrapper {
        max-width: 72%;
    }

    .message-bubble {
        padding: 10px 12px;
        border-radius: 12px;
        color: var(--text-main);
        background: var(--card-bg);
        border: 1px solid var(--border);
        font-size: 11px;
        line-height: 1.5;
        word-break: break-word;
    }

    .message-row.mine .message-bubble {
        border-color: var(--primary);
        background: var(--primary);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .message-row.them .message-bubble {
        border-bottom-left-radius: 4px;
    }

    .message-meta {
        margin-top: 4px;
        color: var(--text-muted);
        font-size: 8px;
    }

    .message-row.mine .message-meta {
        text-align: right;
    }

    .read-status {
        margin-right: 4px;
        color: var(--primary);
        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | ATTACHMENT
    |--------------------------------------------------------------------------
    */

    .attachment-preview {
        margin-top: 7px;
    }

    .attachment-image {
        max-width: 260px;
        max-height: 220px;
        border-radius: 9px;
        display: block;
        object-fit: cover;
    }

    .attachment-video {
        width: 300px;
        max-width: 100%;
        border-radius: 9px;
    }

    .attachment-file {
        padding: 9px 10px;
        border: 1px solid var(--border);
        border-radius: 9px;
        display: flex;
        align-items: center;
        gap: 9px;
        background: var(--card-bg);
        color: var(--text-main);
        text-decoration: none;
    }

    .attachment-file-icon {
        font-size: 21px;
    }

    .attachment-file-name {
        font-size: 9px;
        font-weight: 600;
        word-break: break-all;
    }

    .attachment-file-open {
        margin-top: 2px;
        color: var(--text-muted);
        font-size: 8px;
    }


    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    .chat-form {
        padding: 13px 15px;
        border-top: 1px solid var(--border);
        background: var(--card-bg);
    }

    .selected-file {
        margin-bottom: 8px;
        padding: 8px 10px;
        border-radius: 8px;
        display: none;
        background: var(--input-bg);
        color: var(--text-muted);
        font-size: 9px;
    }

    .chat-input-row {
        display: flex;
        align-items: flex-end;
        gap: 8px;
    }

    .attachment-label {
        width: 38px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: var(--input-bg);
        color: var(--text-muted);
        cursor: pointer;
        font-size: 17px;
    }

    .attachment-input {
        display: none;
    }

    .message-input {
        min-height: 38px;
        max-height: 100px;
        flex: 1;
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 9px;
        outline: none;
        resize: vertical;
        background: var(--input-bg);
        color: var(--text-main);
        font-family: inherit;
        font-size: 11px;
    }

    .send-button {
        min-height: 38px;
        padding: 0 17px;
        border: none;
        border-radius: 9px;
        background: var(--primary);
        color: white;
        cursor: pointer;
        font-size: 10px;
        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

    .chat-empty {
        height: 100%;
        padding: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-align: center;
        font-size: 11px;
    }

    .chat-empty-icon {
        margin-bottom: 10px;
        font-size: 37px;
    }

    .conversation-empty {
        padding: 30px 18px;
        color: var(--text-muted);
        text-align: center;
        font-size: 10px;
    }

    .error-box {
        margin-bottom: 14px;
        padding: 10px 12px;
        border: 1px solid #ffc7c7;
        border-radius: 9px;
        background: #fff0f0;
        color: #bf3030;
        font-size: 10px;
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media(max-width: 1000px) {

        .messages-layout {
            grid-template-columns: 280px minmax(0, 1fr);
        }

        .message-summary-grid {
            grid-template-columns: repeat(3, 1fr);
        }

    }

    @media(max-width: 760px) {

        .message-summary-grid {
            grid-template-columns: 1fr;
        }

        .messages-layout {
            grid-template-columns: 1fr;
        }

        .conversation-panel {
            border-right: 0;
            border-bottom: 1px solid var(--border);
        }

        .conversation-list {
            max-height: 270px;
        }

        .message-wrapper {
            max-width: 88%;
        }

    }
</style>
@endpush


@section('content')


<div class="messages-page-header">

    <div>

        <h1>
            {{ $t['title'] }}
        </h1>

        <p>
            {{ $t['subtitle'] }}
        </p>

    </div>

</div>


@if($errors->any())

<div class="error-box">

    @foreach($errors->all() as $error)

    <div>
        {{ $error }}
    </div>

    @endforeach

</div>

@endif


<div class="message-summary-grid">

    <div class="message-summary-card">

        <div class="message-summary-icon">
            💬
        </div>

        <div>

            <div class="message-summary-label">
                {{ $t['total_chat'] }}
            </div>

            <div class="message-summary-number">
                {{ $totalConversations ?? 0 }}
            </div>

        </div>

    </div>


    <div class="message-summary-card">

        <div class="message-summary-icon orange">
            ●
        </div>

        <div>

            <div class="message-summary-label">
                {{ $t['unread'] }}
            </div>

            <div class="message-summary-number">
                {{ $totalUnread ?? 0 }}
            </div>

        </div>

    </div>


    <div class="message-summary-card">

        <div class="message-summary-icon green">
            ↗
        </div>

        <div>

            <div class="message-summary-label">
                {{ $t['today'] }}
            </div>

            <div class="message-summary-number">
                {{ $todayMessages ?? 0 }}
            </div>

        </div>

    </div>

</div>



<div class="messages-layout">

    {{-- =========================================================
         DAFTAR PERCAKAPAN
    ========================================================== --}}

    <aside class="conversation-panel">

        <div class="conversation-header">

            <div class="conversation-title">
                {{ $t['conversations'] }}
            </div>

            <input
                type="text"
                id="conversationSearch"
                class="conversation-search"
                placeholder="{{ $t['search'] }}">

        </div>


        <div
            id="conversationList"
            class="conversation-list">

            @forelse($conversations as $conversation)

            @php

            $clientUser =
            $conversation['user'];

            $project =
            $conversation['project'];

            $lastMessage =
            $conversation['last_message'];

            $unread =
            $conversation['unread'];

            $initial =
            strtoupper(
            mb_substr(
            $clientUser->name ?? 'C',
            0,
            1
            )
            );

            $isActive =
            $selectedProject
            &&
            (int) $selectedProject->id
            ===
            (int) $project->id;

            @endphp


            <a
                href="{{ route('admin.messages.index', ['project' => $project->id]) }}"
                class="conversation-item {{ $isActive ? 'active' : '' }}"
                data-name="{{ strtolower($clientUser->name ?? '') }}">

                <div class="conversation-avatar">
                    {{ $initial }}
                </div>


                <div class="conversation-content">

                    <div class="conversation-top">

                        <div class="conversation-name">
                            {{ $clientUser->name }}
                        </div>

                        <div class="conversation-time">

                            @if($lastMessage && $lastMessage->sent_at)

                            {{ $lastMessage->sent_at->format('H:i') }}

                            @endif

                        </div>

                    </div>


                    <div class="conversation-project">

                        {{
                                $project
                                    ? $project->project_name
                                    : '-'
                            }}

                    </div>


                    <div class="conversation-bottom">

                        <div class="conversation-preview">

                            @if($lastMessage)

                            @if($lastMessage->message_text)

                            {{
                                            \Illuminate\Support\Str::limit(
                                                $lastMessage->message_text,
                                                34
                                            )
                                        }}

                            @elseif($lastMessage->attachment_path)

                            📎 {{ $t['attachment'] }}

                            @endif

                            @else

                            {{ $t['no_message'] }}

                            @endif

                        </div>


                        @if($unread > 0)

                        <div class="unread-badge">
                            {{ $unread }}
                        </div>

                        @endif

                    </div>

                </div>

            </a>

            @empty

            <div class="conversation-empty">
                {{ $t['no_conversation'] }}
            </div>

            @endforelse

        </div>

    </aside>



    {{-- =========================================================
         CHAT
    ========================================================== --}}

    <section class="chat-panel">

        @if($selectedUser)

        <div class="chat-header">

            <div class="chat-client">

                <div class="chat-avatar">

                    {{
                            strtoupper(
                                mb_substr(
                                    $selectedUser->name ?? 'C',
                                    0,
                                    1
                                )
                            )
                        }}

                </div>


                <div>

                    <div class="chat-client-name">
                        {{ $selectedUser->name }}
                    </div>

                    <div class="chat-client-project">

                        {{ $t['project'] }}:

                        {{
                                $selectedProject
                                    ? $selectedProject->project_name
                                    : '-'
                            }}

                    </div>

                </div>

            </div>


            @if($selectedProject)

            <div class="chat-project-badge">
                {{ $selectedProject->project_name }}
            </div>

            @endif

        </div>


        <div
            id="chatBody"
            class="chat-body">

            @forelse($chatMessages as $message)

            @php

            $mine =
            (int) $message->sender_id
            ===
            (int) auth()->id();

            @endphp


            <div
                class="message-row {{ $mine ? 'mine' : 'them' }}">

                <div class="message-wrapper">

                    @if($message->message_text)

                    <div class="message-bubble">
                        {{ $message->message_text }}
                    </div>

                    @endif


                    @if($message->attachment_path)

                    <div class="attachment-preview">

                        @if(
                        $message->attachment_type
                        &&
                        str_starts_with(
                        $message->attachment_type,
                        'image/'
                        )
                        )

                        <a
                            href="{{ asset('storage/' . $message->attachment_path) }}"
                            target="_blank">

                            <img
                                src="{{ asset('storage/' . $message->attachment_path) }}"
                                alt="{{ $message->attachment_name ?? 'Attachment' }}"
                                class="attachment-image">

                        </a>


                        @elseif(
                        $message->attachment_type
                        &&
                        str_starts_with(
                        $message->attachment_type,
                        'video/'
                        )
                        )

                        <video
                            class="attachment-video"
                            controls>

                            <source
                                src="{{ asset('storage/' . $message->attachment_path) }}"
                                type="{{ $message->attachment_type }}">

                        </video>


                        @else

                        <a
                            href="{{ asset('storage/' . $message->attachment_path) }}"
                            target="_blank"
                            class="attachment-file">

                            <div class="attachment-file-icon">
                                📎
                            </div>

                            <div>

                                <div class="attachment-file-name">

                                    {{
                                                        $message->attachment_name
                                                        ??
                                                        basename(
                                                            $message->attachment_path
                                                        )
                                                    }}

                                </div>

                                <div class="attachment-file-open">
                                    {{ $t['open_file'] }}
                                </div>

                            </div>

                        </a>

                        @endif

                    </div>

                    @endif


                    <div class="message-meta">

                        @if($mine)

                        <span class="read-status">

                            {{
                                            $message->is_read
                                                ? '✓✓'
                                                : '✓'
                                        }}

                        </span>

                        @endif


                        {{
                                    $message->sent_at
                                        ? $message->sent_at->format('H:i')
                                        : '-'
                                }}

                    </div>

                </div>

            </div>

            @empty

            <div class="chat-empty">

                <div class="chat-empty-icon">
                    💬
                </div>

                <div>
                    {{ $t['no_message'] }}
                </div>

            </div>

            @endforelse

        </div>


        @if($selectedProject)

        <form
            method="POST"
            action="{{ route('admin.messages.send') }}"
            enctype="multipart/form-data"
            class="chat-form">

            @csrf


            <input
                type="hidden"
                name="receiver_id"
                value="{{ $selectedUser->id }}">

            <input
                type="hidden"
                name="project_id"
                value="{{ $selectedProject->id }}">


            <div
                id="selectedFile"
                class="selected-file"></div>


            <div class="chat-input-row">

                <label
                    for="attachment"
                    class="attachment-label"
                    title="{{ $t['attachment'] }}">
                    📎
                </label>


                <input
                    type="file"
                    id="attachment"
                    name="attachment"
                    class="attachment-input"
                    accept=".jpg,.jpeg,.png,.webp,.mp4,.mov,.webm,.pdf,.doc,.docx,.xls,.xlsx,.zip">


                <textarea
                    name="message_text"
                    class="message-input"
                    placeholder="{{ $t['type_message'] }}">{{ old('message_text') }}</textarea>


                <button
                    type="submit"
                    class="send-button">
                    {{ $t['send'] }}
                </button>

            </div>

        </form>

        @endif


        @else

        <div class="chat-empty">

            <div class="chat-empty-icon">
                💬
            </div>

            <div>
                {{ $t['select_conversation'] }}
            </div>

        </div>

        @endif

    </section>

</div>

@endsection



@push('scripts')
<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            /*
            |--------------------------------------------------------------------------
            | AUTO SCROLL CHAT
            |--------------------------------------------------------------------------
            */

            const chatBody =
                document.getElementById(
                    'chatBody'
                );

            if (chatBody) {

                chatBody.scrollTop =
                    chatBody.scrollHeight;

            }


            /*
            |--------------------------------------------------------------------------
            | SEARCH CLIENT
            |--------------------------------------------------------------------------
            */

            const searchInput =
                document.getElementById(
                    'conversationSearch'
                );

            const conversationItems =
                document.querySelectorAll(
                    '.conversation-item'
                );


            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    function() {

                        const keyword =
                            searchInput
                            .value
                            .toLowerCase()
                            .trim();


                        conversationItems.forEach(
                            function(item) {

                                const name =
                                    item.dataset.name ||
                                    '';


                                item.style.display =
                                    name.includes(keyword) ?
                                    'flex' :
                                    'none';

                            }
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | FILE NAME
            |--------------------------------------------------------------------------
            */

            const attachment =
                document.getElementById(
                    'attachment'
                );

            const selectedFile =
                document.getElementById(
                    'selectedFile'
                );


            if (
                attachment &&
                selectedFile
            ) {

                attachment.addEventListener(
                    'change',
                    function() {

                        if (
                            attachment.files &&
                            attachment.files.length > 0
                        ) {

                            selectedFile.textContent =
                                '📎 ' +
                                attachment.files[0].name;

                            selectedFile.style.display =
                                'block';

                        } else {

                            selectedFile.textContent =
                                '';

                            selectedFile.style.display =
                                'none';

                        }

                    }
                );

            }

        }
    );
</script>
@endpush