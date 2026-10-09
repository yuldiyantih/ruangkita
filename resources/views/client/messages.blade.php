@extends('layouts.client')


@php

$messageLang = auth()->user()->language ?? 'id';

$messageTranslations = [

'id' => [

'home' => 'Beranda',
'title' => 'Pesan',

'description' =>
'Komunikasi langsung dengan tim proyek untuk update dan informasi terbaru.',

'conversations' => 'Percakapan',

'search_placeholder' =>
'Cari pesan atau nama...',

'no_message' =>
'Belum ada pesan',

'no_team_member' =>
'Belum ada anggota Tim Proyek.',

'project_team' =>
'Tim Proyek',

'online' =>
'Online',

'attachment' =>
'Lampiran Pesan',

'open_attachment' =>
'Klik untuk membuka',

'no_chat' =>
'Belum ada pesan.',

'start_chat' =>
'Mulai percakapan dengan Tim Proyek.',

'message_placeholder' =>
'Tulis pesan...',

'no_project_team' =>
'Belum ada Tim Proyek yang tersedia.',

],


'en' => [

'home' => 'Home',
'title' => 'Messages',

'description' =>
'Communicate directly with the project team for the latest updates and information.',

'conversations' =>
'Conversations',

'search_placeholder' =>
'Search messages or names...',

'no_message' =>
'No messages yet',

'no_team_member' =>
'No project team members available.',

'project_team' =>
'Project Team',

'online' =>
'Online',

'attachment' =>
'Message Attachment',

'open_attachment' =>
'Click to open',

'no_chat' =>
'No messages yet.',

'start_chat' =>
'Start a conversation with the Project Team.',

'message_placeholder' =>
'Type a message...',

'no_project_team' =>
'No Project Team is currently available.',

],

];


$mt =
$messageTranslations[$messageLang]
??
$messageTranslations['id'];

@endphp


@section(
'title',
$mt['title'] . ' - RuangKita'
)


@push('styles')

<style>
    /* =====================================================
       MESSAGING BOX
    ===================================================== */

    .messaging {

        height: 680px;

        display: grid;

        grid-template-columns:
            340px minmax(0, 1fr);

        overflow: hidden;

        border:
            1px solid var(--border);

        border-radius: 13px;

        background:
            var(--card-bg);

        box-shadow:
            var(--shadow);
    }


    /* =====================================================
       CONVERSATION PANEL
    ===================================================== */

    .conversation-panel {

        min-width: 0;

        border-right:
            1px solid var(--border);

        background:
            var(--card-bg);
    }


    .conversation-title {

        padding:
            20px 20px 13px;

        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    /* =====================================================
       SEARCH
    ===================================================== */

    .search-box {

        height: 43px;

        margin:
            0 20px 14px;

        padding:
            0 13px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        display: flex;

        align-items: center;

        gap: 10px;

        background:
            var(--input-bg);
    }


    .search-box span {

        color:
            var(--text-muted);
    }


    .search-box input {

        flex: 1;

        border: none;

        outline: none;

        background: transparent;

        color:
            var(--text-main);

        font-size: 12px;
    }


    /* =====================================================
       CONVERSATION LIST
    ===================================================== */

    .conversation-list {

        height:
            calc(100% - 108px);

        overflow-y: auto;
    }


    .conversation-item {

        min-height: 85px;

        padding:
            15px 20px;

        position: relative;

        display: grid;

        grid-template-columns:
            48px minmax(0, 1fr) auto;

        gap: 12px;

        align-items: center;

        border-bottom:
            1px solid var(--border);

        color: inherit;

        text-decoration: none;

        transition: .2s;
    }


    .conversation-item:hover {

        background:
            rgba(8,
                123,
                221,
                .05);
    }


    .conversation-item.active {

        background: #e7f3ff;
    }


    body.dark-mode .conversation-item.active {

        background: #19364d;
    }


    .conversation-item.active::before {

        content: "";

        position: absolute;

        top: 0;
        bottom: 0;
        left: 0;

        width: 4px;

        background:
            var(--primary);
    }


    /* =====================================================
       CONVERSATION AVATAR
    ===================================================== */

    .conversation-avatar {

        width: 44px;
        height: 44px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e8f1f8;

        color: #1669ab;

        font-size: 15px;

        font-weight: 700;
    }


    body.dark-mode .conversation-avatar {

        background: #21394c;

        color: #72bdf5;
    }


    .conversation-name {

        margin-bottom: 5px;

        color:
            var(--text-heading);

        font-size: 12px;

        font-weight: 700;
    }


    .conversation-preview {

        overflow: hidden;

        white-space: nowrap;

        text-overflow: ellipsis;

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .conversation-meta {

        align-self: stretch;

        padding-top: 2px;

        text-align: right;
    }


    .conversation-time {

        color:
            var(--text-muted);

        font-size: 9px;

        white-space: nowrap;
    }


    .unread {

        width: 20px;
        height: 20px;

        margin:
            9px 0 0 auto;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        color: white;

        background:
            var(--primary);

        font-size: 9px;

        font-weight: 700;
    }


    /* =====================================================
       CHAT PANEL
    ===================================================== */

    .chat-panel {

        min-width: 0;

        display: grid;

        grid-template-rows:
            78px minmax(0, 1fr) 76px;

        background:
            var(--card-bg);
    }


    /* =====================================================
       CHAT HEADER
    ===================================================== */

    .chat-header {

        padding:
            0 24px;

        display: flex;

        align-items: center;

        justify-content:
            space-between;

        border-bottom:
            1px solid var(--border);

        background:
            var(--card-bg);
    }


    .chat-user {

        display: flex;

        align-items: center;

        gap: 12px;
    }


    .chat-avatar {

        width: 47px;
        height: 47px;

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #dceaf5;

        color: #126ab1;

        font-weight: 700;
    }


    body.dark-mode .chat-avatar {

        background: #21394c;

        color: #72bdf5;
    }


    .chat-name {

        margin-bottom: 4px;

        color:
            var(--text-heading);

        font-size: 16px;

        font-weight: 700;
    }


    .chat-status {

        color:
            var(--text-muted);

        font-size: 10px;
    }


    .online {

        color: #15965f;

        font-weight: 600;
    }


    .chat-menu {

        color:
            var(--text-muted);

        font-size: 23px;
    }


    /* =====================================================
       CHAT BODY
    ===================================================== */

    .chat-body {

        padding:
            23px 28px;

        overflow-y: auto;

        background:
            var(--input-bg);
    }


    .message-row {

        display: flex;

        margin-bottom: 16px;
    }


    .message-row.me {

        justify-content:
            flex-end;
    }


    .message-row.them {

        justify-content:
            flex-start;
    }


    .bubble-wrapper {

        max-width: 64%;
    }


    .bubble {

        padding:
            12px 15px;

        border-radius: 14px;

        font-size: 12px;

        line-height: 1.55;
    }


    .them .bubble {

        color:
            var(--text-main);

        background: #eaf1f7;

        border-top-left-radius: 4px;
    }


    body.dark-mode .them .bubble {

        background: #24394a;
    }


    .me .bubble {

        color: white;

        background:
            linear-gradient(135deg,
                #0677da,
                #078ae3);

        border-top-right-radius: 4px;
    }


    .message-meta {

        margin-top: 5px;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    .me .message-meta {

        text-align: right;
    }


    .read-check {

        margin-right: 4px;

        color:
            var(--primary);

        font-weight: 700;
    }


    /* =====================================================
       ATTACHMENT
    ===================================================== */

    .attachment-card {

        margin-top: 8px;

        padding:
            10px 12px;

        border:
            1px solid var(--border);

        border-radius: 10px;

        display: flex;

        align-items: center;

        gap: 10px;

        background:
            var(--card-bg);

        color:
            var(--text-main);

        text-decoration: none;
    }


    .attachment-icon {

        width: 35px;
        height: 35px;

        border-radius: 8px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e7f3ff;

        color:
            var(--primary);
    }


    body.dark-mode .attachment-icon {

        background: #19364d;
    }


    .attachment-name {

        font-size: 10px;

        font-weight: 700;
    }


    .attachment-description {

        margin-top: 3px;

        color:
            var(--text-muted);

        font-size: 9px;
    }


    /* =====================================================
       CHAT FORM
    ===================================================== */

    .chat-form {

        padding:
            13px 20px;

        display: flex;

        align-items: center;

        gap: 10px;

        border-top:
            1px solid var(--border);

        background:
            var(--card-bg);
    }


    .attachment-label {

        width: 42px;
        height: 42px;

        flex-shrink: 0;

        border:
            1px solid var(--border);

        border-radius: 50%;

        display: flex;

        align-items: center;
        justify-content: center;

        color:
            var(--text-muted);

        cursor: pointer;

        font-size: 18px;
    }


    .attachment-label input {

        display: none;
    }


    .message-input {

        flex: 1;

        height: 44px;

        padding:
            0 16px;

        border:
            1px solid var(--border);

        border-radius: 22px;

        outline: none;

        background:
            var(--input-bg);

        color:
            var(--text-main);

        font-size: 12px;
    }


    .send-button {

        width: 45px;
        height: 45px;

        flex-shrink: 0;

        border: none;

        border-radius: 12px;

        color: white;

        background:
            linear-gradient(135deg,
                #087bd8,
                #078eea);

        cursor: pointer;

        font-size: 18px;
    }


    /* =====================================================
       EMPTY
    ===================================================== */

    .empty-chat {

        height: 100%;

        display: flex;

        flex-direction: column;

        align-items: center;
        justify-content: center;

        color:
            var(--text-muted);

        text-align: center;
    }


    .empty-chat-icon {

        margin-bottom: 12px;

        font-size: 40px;
    }


    .empty-conversation {

        padding: 30px;

        color:
            var(--text-muted);

        text-align: center;

        font-size: 12px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media(max-width: 950px) {

        .messaging {

            grid-template-columns:
                280px 1fr;
        }

    }


    @media(max-width: 650px) {

        .messaging {

            height: auto;

            grid-template-columns:
                1fr;
        }


        .conversation-panel {

            border-right: none;

            border-bottom:
                1px solid var(--border);
        }


        .conversation-list {

            height: auto;

            max-height: 280px;
        }


        .chat-panel {

            min-height: 570px;
        }


        .bubble-wrapper {

            max-width: 83%;
        }

    }
</style>

@endpush



@section('content')


{{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

<div class="breadcrumb">

    <a
        href="{{ route('client.dashboard') }}">

        {{ $mt['home'] }}

    </a>

    &nbsp;›&nbsp;

    {{ $mt['title'] }}

</div>



{{-- =====================================================
         PAGE TITLE
    ====================================================== --}}

<div class="page-title">

    <h1>

        {{ $mt['title'] }}

    </h1>

    <p>

        {{ $mt['description'] }}

    </p>

</div>



{{-- =====================================================
         MESSAGING
    ====================================================== --}}

<div class="messaging">


    {{-- =================================================
             CONVERSATION LIST
        ================================================== --}}

    <aside class="conversation-panel">


        <div class="conversation-title">

            {{ $mt['conversations'] }}

        </div>



        <div class="search-box">

            <span>
                ⌕
            </span>

            <input

                type="text"

                id="conversationSearch"

                placeholder="{{
                        $mt[
                            'search_placeholder'
                        ]
                    }}">

        </div>



        <div class="conversation-list">


            @forelse($conversations as $conversation)


            @php

            $member =
            $conversation[
            'user'
            ];

            $last =
            $conversation[
            'last_message'
            ];

            @endphp



            <a

                href="{{
                            route(
                                'client.messages',
                                [
                                    'user'
                                    =>
                                    $member->id
                                ]
                            )
                        }}"

                class="
                            conversation-item
                            {{
                                $selectedUser
                                &&
                                $selectedUser->id
                                ===
                                $member->id
                                ?
                                'active'
                                :
                                ''
                            }}
                        "

                data-name="{{
                            strtolower(
                                $member->name
                            )
                        }}">


                <div class="conversation-avatar">

                    {{
                                strtoupper(
                                    substr(
                                        $member->name,
                                        0,
                                        2
                                    )
                                )
                            }}

                </div>



                <div>


                    <div class="conversation-name">

                        {{ $member->name }}

                    </div>


                    <div class="conversation-preview">

                        @if($last)

                        {{
                                        $last->message_text
                                        ??
                                        $mt['attachment']
                                    }}

                        @else

                        {{ $mt['no_message'] }}

                        @endif

                    </div>


                </div>



                <div class="conversation-meta">


                    @if($last)

                    <div class="conversation-time">

                        @if($last->sent_at)

                        {{
                                            $last
                                                ->sent_at
                                                ->format('H:i')
                                        }}

                        @endif

                    </div>

                    @endif



                    @if($conversation['unread'] > 0)

                    <div class="unread">

                        {{
                                        $conversation[
                                            'unread'
                                        ]
                                    }}

                    </div>

                    @endif


                </div>


            </a>


            @empty


            <div class="empty-conversation">

                {{
                            $mt[
                                'no_team_member'
                            ]
                        }}

            </div>


            @endforelse


        </div>


    </aside>



    {{-- =================================================
             CHAT
        ================================================== --}}

    <section class="chat-panel">


        @if($selectedUser)


        {{-- =========================================
                     CHAT HEADER
                ========================================== --}}

        <div class="chat-header">


            <div class="chat-user">


                <div class="chat-avatar">

                    {{
                                strtoupper(
                                    substr(
                                        $selectedUser->name,
                                        0,
                                        2
                                    )
                                )
                            }}

                </div>



                <div>


                    <div class="chat-name">

                        {{
                                    $selectedUser->name
                                }}

                    </div>


                    <div class="chat-status">

                        {{
                                    $mt[
                                        'project_team'
                                    ]
                                }}

                        <span class="online">

                            •
                            {{
                                        $mt[
                                            'online'
                                        ]
                                    }}

                        </span>

                    </div>


                </div>


            </div>



            <div class="chat-menu">

                ⋮

            </div>


        </div>



        {{-- =========================================
                     CHAT BODY
                ========================================== --}}

        <div
            class="chat-body"
            id="chatBody">


            @forelse($chatMessages as $message)


            @php

            $mine =
            $message->sender_id
            ===
            auth()->id();

            @endphp



            <div
                class="
                                message-row
                                {{
                                    $mine
                                    ?
                                    'me'
                                    :
                                    'them'
                                }}
                            ">


                <div class="bubble-wrapper">


                    {{-- MESSAGE TEXT --}}

                    @if($message->message_text)

                    <div class="bubble">

                        {{
                                            $message
                                                ->message_text
                                        }}

                    </div>

                    @endif



                    {{-- ATTACHMENT --}}

                    @if($message->attachment_path)

                    <a

                        href="{{
                                            asset(
                                                'storage/' .
                                                $message
                                                    ->attachment_path
                                            )
                                        }}"

                        target="_blank"

                        class="attachment-card">


                        <div class="attachment-icon">

                            📎

                        </div>


                        <div>


                            <div class="attachment-name">

                                {{
                                                    $mt[
                                                        'attachment'
                                                    ]
                                                }}

                            </div>


                            <div
                                class="
                                                    attachment-description
                                                ">

                                {{
                                                    $mt[
                                                        'open_attachment'
                                                    ]
                                                }}

                            </div>


                        </div>


                    </a>

                    @endif



                    {{-- META --}}

                    <div class="message-meta">


                        @if($mine)

                        <span class="read-check">

                            {{
                                                $message
                                                    ->is_read
                                                ?
                                                '✓✓'
                                                :
                                                '✓'
                                            }}

                        </span>

                        @endif



                        @if($message->sent_at)

                        {{
                                            $message
                                                ->sent_at
                                                ->format('H:i')
                                        }}

                        @else

                        -

                        @endif


                    </div>


                </div>


            </div>


            @empty


            <div class="empty-chat">


                <div class="empty-chat-icon">

                    💬

                </div>


                <div>

                    {{
                                    $mt[
                                        'no_chat'
                                    ]
                                }}

                </div>


                <div
                    style="
                                    font-size:11px;
                                    margin-top:5px;
                                ">

                    {{
                                    $mt[
                                        'start_chat'
                                    ]
                                }}

                </div>


            </div>


            @endforelse


        </div>



        {{-- =========================================
                     CHAT FORM
                ========================================== --}}

        <form

            action="{{
                        route(
                            'client.messages.send'
                        )
                    }}"

            method="POST"

            enctype="multipart/form-data"

            class="chat-form">

            @csrf



            <input

                type="hidden"

                name="receiver_id"

                value="{{
                            $selectedUser->id
                        }}">



            @if($projects->count() > 0)

            <input

                type="hidden"

                name="project_id"

                value="{{
                                $projects
                                    ->first()
                                    ->id
                            }}">

            @endif



            <label class="attachment-label">

                📎

                <input

                    type="file"

                    name="attachment">

            </label>



            <input

                type="text"

                name="message_text"

                class="message-input"

                placeholder="{{
                            $mt[
                                'message_placeholder'
                            ]
                        }}"

                autocomplete="off">



            <button

                type="submit"

                class="send-button">

                ➤

            </button>


        </form>


        @else


        <div class="empty-chat">


            <div class="empty-chat-icon">

                💬

            </div>


            <div>

                {{
                            $mt[
                                'no_project_team'
                            ]
                        }}

            </div>


        </div>


        @endif


    </section>


</div>


@endsection



@push('scripts')

<script>
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
    | SEARCH CONVERSATION
    |--------------------------------------------------------------------------
    */

    const search =
        document.getElementById(
            'conversationSearch'
        );


    if (search) {

        search.addEventListener(
            'input',
            function() {

                const keyword =
                    this
                    .value
                    .toLowerCase()
                    .trim();


                document
                    .querySelectorAll(
                        '.conversation-item'
                    )
                    .forEach(
                        function(item) {

                            const name =
                                item
                                .dataset
                                .name ||
                                '';


                            item.style.display =
                                name.includes(
                                    keyword
                                ) ?
                                'grid' :
                                'none';

                        }
                    );

            }
        );

    }
</script>

@endpush