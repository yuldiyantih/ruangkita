<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Pesan - RuangKita
    </title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        body {
            background: #f4f8fc;
            color: #17334c;
        }


        .app {
            display: flex;
            min-height: 100vh;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {

            width: 230px;

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            z-index: 1000;

            padding:
                20px 14px;

            color: white;

            background:
                linear-gradient(180deg,
                    #0d3458,
                    #092843);
        }


        .brand {

            padding:
                5px 9px 24px;

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .brand-name {

            font-size: 18px;

            font-weight: 700;
        }


        .ruangkita-logo {

            width: 31px;
            height: 31px;

            position: relative;
        }


        .ruangkita-logo .roof {

            width: 20px;
            height: 20px;

            position: absolute;

            left: 5px;
            top: 2px;

            border-left:
                4px solid white;

            border-top:
                4px solid white;

            transform:
                rotate(45deg);
        }


        .ruangkita-logo .house {

            width: 19px;
            height: 17px;

            position: absolute;

            left: 6px;
            bottom: 2px;

            border-left:
                4px solid white;

            border-right:
                4px solid white;

            border-bottom:
                4px solid white;
        }


        .ruangkita-logo .door {

            width: 6px;
            height: 9px;

            position: absolute;

            left: 50%;
            bottom: -1px;

            transform:
                translateX(-50%);

            border:
                2px solid white;

            border-bottom: none;
        }


        .menu-item {

            min-height:
                42px;

            padding:
                0 13px;

            margin-bottom:
                3px;

            border-radius:
                8px;

            display:
                flex;

            align-items:
                center;

            gap:
                11px;

            text-decoration:
                none;

            color:
                #d6e6f5;

            font-size:
                13px;
        }


        .menu-item:hover {

            background:
                rgba(255,
                    255,
                    255,
                    .08);
        }


        .menu-item.active {

            color:
                white;

            background:
                linear-gradient(90deg,
                    #0665ac,
                    #087acb);
        }


        .menu-icon {

            width:
                19px;

            text-align:
                center;
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {

            position:
                relative;

            z-index:
                1;

            width:
                calc(100% - 230px);

            margin-left:
                230px;
        }


        .topbar {

            height:
                66px;

            padding:
                0 28px;

            background:
                white;

            border-bottom:
                1px solid #e5edf3;

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;
        }


        .hamburger {

            color:
                #41627e;

            font-size:
                20px;
        }


        .user-area {

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            font-size:
                13px;

            font-weight:
                600;
        }


        .avatar {

            width:
                34px;

            height:
                34px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                50%;

            background:
                #e3edf5;
        }


        /* =========================================
           CONTENT
        ========================================= */

        .content {

            padding:
                27px 30px 38px;
        }


        .breadcrumb {

            color:
                #71869a;

            font-size:
                11px;

            margin-bottom:
                15px;
        }


        .breadcrumb a {

            text-decoration:
                none;

            color:
                #56728b;
        }


        .page-title {

            margin-bottom:
                23px;
        }


        .page-title h1 {

            color:
                #102e49;

            font-size:
                28px;

            margin-bottom:
                5px;
        }


        .page-title p {

            color:
                #6f8498;

            font-size:
                13px;
        }


        /* =========================================
           MESSAGING BOX
        ========================================= */

        .messaging {

            height:
                680px;

            display:
                grid;

            grid-template-columns:
                340px minmax(0,
                    1fr);

            background:
                white;

            border:
                1px solid #dfe8ef;

            border-radius:
                13px;

            overflow:
                hidden;
        }


        /* =========================================
           CONVERSATIONS
        ========================================= */

        .conversation-panel {

            border-right:
                1px solid #dfe8ef;

            min-width: 0;
        }


        .conversation-title {

            padding:
                20px 20px 13px;

            font-size:
                16px;

            font-weight:
                700;

            color:
                #17354e;
        }


        .search-box {

            margin:
                0 20px 14px;

            height:
                43px;

            padding:
                0 13px;

            border:
                1px solid #dce6ee;

            border-radius:
                10px;

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            background:
                #f9fbfd;
        }


        .search-box input {

            flex:
                1;

            border:
                none;

            outline:
                none;

            background:
                transparent;

            color:
                #37536a;

            font-size:
                12px;
        }


        .conversation-list {

            overflow-y:
                auto;

            height:
                calc(100% - 108px);
        }


        .conversation-item {

            min-height:
                85px;

            padding:
                15px 20px;

            display:
                grid;

            grid-template-columns:
                48px minmax(0,
                    1fr) auto;

            gap:
                12px;

            align-items:
                center;

            text-decoration:
                none;

            border-bottom:
                1px solid #edf2f6;

            color:
                inherit;

            position:
                relative;
        }


        .conversation-item:hover {

            background:
                #f5f9fd;
        }


        .conversation-item.active {

            background:
                #e7f3ff;
        }


        .conversation-item.active::before {

            content:
                "";

            position:
                absolute;

            top: 0;
            bottom: 0;
            left: 0;

            width:
                4px;

            background:
                #087bdd;
        }


        .conversation-avatar {

            width:
                44px;

            height:
                44px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            font-size:
                15px;

            font-weight:
                700;

            background:
                #e8f1f8;

            color:
                #1669ab;
        }


        .conversation-name {

            margin-bottom:
                5px;

            color:
                #15344e;

            font-size:
                12px;

            font-weight:
                700;
        }


        .conversation-preview {

            color:
                #72869a;

            font-size:
                10px;

            overflow:
                hidden;

            white-space:
                nowrap;

            text-overflow:
                ellipsis;
        }


        .conversation-meta {

            text-align:
                right;

            align-self:
                stretch;

            padding-top:
                2px;
        }


        .conversation-time {

            color:
                #607a91;

            font-size:
                9px;

            white-space:
                nowrap;
        }


        .unread {

            width:
                20px;

            height:
                20px;

            margin:
                9px 0 0 auto;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            color:
                white;

            background:
                #087add;

            font-size:
                9px;

            font-weight:
                700;
        }


        /* =========================================
           CHAT PANEL
        ========================================= */

        .chat-panel {

            min-width:
                0;

            display:
                grid;

            grid-template-rows:
                78px minmax(0,
                    1fr) 76px;
        }


        .chat-header {

            padding:
                0 24px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            border-bottom:
                1px solid #dfe8ef;
        }


        .chat-user {

            display:
                flex;

            align-items:
                center;

            gap:
                12px;
        }


        .chat-avatar {

            width:
                47px;

            height:
                47px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #dceaf5;

            color:
                #126ab1;

            font-weight:
                700;
        }


        .chat-name {

            color:
                #18354e;

            font-size:
                16px;

            font-weight:
                700;

            margin-bottom:
                4px;
        }


        .chat-status {

            color:
                #73879a;

            font-size:
                10px;
        }


        .online {

            color:
                #15965f;

            font-weight:
                600;
        }


        .chat-menu {

            color:
                #385b78;

            font-size:
                23px;
        }


        /* =========================================
           CHAT BODY
        ========================================= */

        .chat-body {

            padding:
                23px 28px;

            overflow-y:
                auto;

            background:
                #fbfdff;
        }


        .message-row {

            display:
                flex;

            margin-bottom:
                16px;
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

            max-width:
                64%;
        }


        .bubble {

            padding:
                12px 15px;

            border-radius:
                14px;

            font-size:
                12px;

            line-height:
                1.55;
        }


        .them .bubble {

            color:
                #233f56;

            background:
                #eaf1f7;

            border-top-left-radius:
                4px;
        }


        .me .bubble {

            color:
                white;

            background:
                linear-gradient(135deg,
                    #0677da,
                    #078ae3);

            border-top-right-radius:
                4px;
        }


        .message-meta {

            margin-top:
                5px;

            color:
                #71869a;

            font-size:
                9px;
        }


        .me .message-meta {

            text-align:
                right;
        }


        .read-check {

            color:
                #087ce0;

            font-weight:
                700;

            margin-right:
                4px;
        }


        /* =========================================
           ATTACHMENT
        ========================================= */

        .attachment-card {

            margin-top:
                8px;

            padding:
                10px 12px;

            border-radius:
                10px;

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            text-decoration:
                none;

            border:
                1px solid #dce6ee;

            background:
                white;

            color:
                #29465e;
        }


        .attachment-icon {

            width:
                35px;

            height:
                35px;

            border-radius:
                8px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                #e7f3ff;

            color:
                #0875d0;
        }


        .attachment-name {

            font-size:
                10px;

            font-weight:
                700;
        }


        /* =========================================
           CHAT FORM
        ========================================= */

        .chat-form {

            padding:
                13px 20px;

            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            border-top:
                1px solid #dfe8ef;

            background:
                white;
        }


        .attachment-label {

            width:
                42px;

            height:
                42px;

            border:
                1px solid #dce6ee;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            cursor:
                pointer;

            color:
                #436b8b;

            font-size:
                18px;
        }


        .attachment-label input {

            display:
                none;
        }


        .message-input {

            flex:
                1;

            height:
                44px;

            padding:
                0 16px;

            border:
                1px solid #dce6ee;

            border-radius:
                22px;

            outline:
                none;

            color:
                #2a475e;

            font-size:
                12px;
        }


        .send-button {

            width:
                45px;

            height:
                45px;

            border:
                none;

            border-radius:
                12px;

            cursor:
                pointer;

            color:
                white;

            background:
                linear-gradient(135deg,
                    #087bd8,
                    #078eea);

            font-size:
                18px;
        }


        /* =========================================
           EMPTY
        ========================================= */

        .empty-chat {

            height:
                100%;

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            justify-content:
                center;

            color:
                #7e92a4;

            text-align:
                center;
        }


        .empty-chat-icon {

            font-size:
                40px;

            margin-bottom:
                12px;
        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width: 950px) {

            .messaging {

                grid-template-columns:
                    280px 1fr;
            }
        }


        @media(max-width: 850px) {

            .sidebar {

                display:
                    none;
            }


            .main {

                width:
                    100%;

                margin-left:
                    0;
            }
        }


        @media(max-width: 650px) {

            .content {

                padding:
                    20px 12px;
            }


            .messaging {

                height:
                    auto;

                grid-template-columns:
                    1fr;
            }


            .conversation-panel {

                border-right:
                    none;

                border-bottom:
                    1px solid #dfe8ef;
            }


            .conversation-list {

                max-height:
                    280px;
            }


            .chat-panel {

                min-height:
                    570px;
            }


            .bubble-wrapper {

                max-width:
                    83%;
            }
        }
    </style>

</head>


<body>


    <div class="app">


        <!-- =========================================
         SIDEBAR
    ========================================== -->

        <aside class="sidebar">


            <div class="brand">


                <div class="ruangkita-logo">

                    <div class="roof"></div>

                    <div class="house">

                        <div class="door"></div>

                    </div>

                </div>


                <span class="brand-name">

                    RuangKita

                </span>


            </div>



            <a
                href="{{ route('client.dashboard') }}"
                class="menu-item">

                <span class="menu-icon">⌂</span>

                Dashboard

            </a>


            <a
                href="{{ route('client.projects.index') }}"
                class="menu-item">

                <span class="menu-icon">▣</span>

                Proyek Saya

            </a>


            <a
                href="{{ route('client.schedule') }}"
                class="menu-item">

                <span class="menu-icon">▦</span>

                Jadwal

            </a>


            <a
                href="{{ route('client.progress') }}"
                class="menu-item">

                <span class="menu-icon">↗</span>

                Progress

            </a>


            <a
                href="{{ route('client.documentation') }}"
                class="menu-item">

                <span class="menu-icon">▧</span>

                Dokumentasi

            </a>


            <a
                href="{{ route('client.costs') }}"
                class="menu-item">

                <span class="menu-icon">▤</span>

                Informasi Biaya

            </a>


            <a
                href="{{ route('client.messages') }}"
                class="menu-item active">

                <span class="menu-icon">✉</span>

                Pesan

            </a>


            <a
                href="{{ route('client.ar') }}"
                class="menu-item">

                <span class="menu-icon">◇</span>

                Augmented Reality

            </a>


            <a
                href="{{ route('client.settings') }}"
                class="menu-item">

                <span class="menu-icon">⚙</span>

                Pengaturan
            </a>


        </aside>



        <!-- =========================================
         MAIN
    ========================================== -->

        <main class="main">


            <header class="topbar">


                <div class="hamburger">

                    ☰

                </div>


                <div class="user-area">

                    <span>♧</span>

                    <div class="avatar">

                        👤

                    </div>

                    <span>

                        {{ auth()->user()->name }}

                    </span>

                    <span>▾</span>

                </div>


            </header>



            <section class="content">


                <div class="breadcrumb">

                    <a href="{{ route('client.dashboard') }}">

                        Beranda

                    </a>

                    &nbsp;›&nbsp;

                    Pesan

                </div>



                <div class="page-title">


                    <h1>

                        Pesan

                    </h1>


                    <p>

                        Komunikasi langsung dengan tim proyek
                        untuk update dan informasi terbaru.

                    </p>


                </div>



                <div class="messaging">


                    <!-- =========================================
                     CONVERSATION LIST
                ========================================== -->

                    <aside class="conversation-panel">


                        <div class="conversation-title">

                            Percakapan

                        </div>


                        <div class="search-box">

                            <span>⌕</span>

                            <input
                                type="text"
                                id="conversationSearch"
                                placeholder="Cari pesan atau nama...">

                        </div>



                        <div class="conversation-list">


                            @forelse(
                            $conversations
                            as $conversation
                            )


                            @php

                            $member =
                            $conversation['user'];

                            $last =
                            $conversation['last_message'];

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


                                        {{ $last->message_text ?? 'Lampiran file' }}


                                        @else

                                        Belum ada pesan

                                        @endif


                                    </div>


                                </div>



                                <div class="conversation-meta">


                                    @if($last)

                                    <div class="conversation-time">

                                        @if($last->sent_at)

                                        {{ $last->sent_at->format('H:i') }}

                                        @endif

                                    </div>

                                    @endif



                                    @if(
                                    $conversation['unread']
                                    >
                                    0
                                    )

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


                            <div
                                style="
                                    padding:30px;
                                    text-align:center;
                                    color:#8395a6;
                                    font-size:12px;
                                ">

                                Belum ada anggota
                                Tim Proyek.

                            </div>


                            @endforelse


                        </div>


                    </aside>



                    <!-- =========================================
                     CHAT
                ========================================== -->

                    <section class="chat-panel">


                        @if($selectedUser)


                        <!-- HEADER -->


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

                                        Tim Proyek

                                        <span class="online">

                                            • Online

                                        </span>

                                    </div>


                                </div>


                            </div>


                            <div class="chat-menu">

                                ⋮

                            </div>


                        </div>



                        <!-- CHAT BODY -->


                        <div
                            class="chat-body"
                            id="chatBody">


                            @forelse(
                            $chatMessages
                            as $message
                            )


                            @php

                            $mine =
                            $message
                            ->sender_id
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

                                    {{-- PESAN TEKS --}}
                                    @if($message->message_text)

                                    <div class="bubble">

                                        {{ $message->message_text }}

                                    </div>

                                    @endif


                                    {{-- LAMPIRAN --}}
                                    @if($message->attachment_path)

                                    <a
                                        href="{{ asset('storage/' . $message->attachment_path) }}"
                                        target="_blank"
                                        class="attachment-card">

                                        <div class="attachment-icon">
                                            📎
                                        </div>

                                        <div>

                                            <div class="attachment-name">
                                                Lampiran Pesan
                                            </div>

                                            <div style="
                                             font-size: 9px;
                                                color: #7a8ea0;
                                                margin-top: 3px;
                                            ">
                                                Klik untuk membuka
                                            </div>

                                        </div>

                                    </a>

                                    @endif


                                    {{-- META PESAN --}}
                                    <div class="message-meta">

                                        @if($mine)

                                        <span class="read-check">

                                            {{
                                                $message->is_read
                                                ? '✓✓'
                                                : '✓'
                                            }}

                                        </span>

                                        @endif


                                        @if($message->sent_at)

                                        {{ $message->sent_at->format('H:i') }}

                                        @else

                                        -

                                        @endif

                                    </div>

                                </div>


                                {{-- PESAN KOSONG --}}
                                @empty

                                <div class="empty-chat">

                                    <div class="empty-chat-icon">
                                        💬
                                    </div>

                                    <div>
                                        Belum ada pesan.
                                    </div>

                                    <div style="
            font-size: 11px;
            margin-top: 5px;
        ">
                                        Mulai percakapan
                                        dengan Tim Proyek.
                                    </div>

                                </div>

                                @endforelse

                            </div>

                            {{-- INPUT CHAT --}}
                            <form
                                action="{{ route('client.messages.send') }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="chat-form">

                                @csrf


                                {{-- RECEIVER --}}
                                <input
                                    type="hidden"
                                    name="receiver_id"
                                    value="{{ $selectedUser->id }}">


                                {{-- PROJECT --}}
                                @if($projects->count() > 0)

                                <input
                                    type="hidden"
                                    name="project_id"
                                    value="{{ $projects->first()->id }}">

                                @endif


                                {{-- ATTACHMENT --}}
                                <label class="attachment-label">

                                    📎

                                    <input
                                        type="file"
                                        name="attachment">

                                </label>


                                {{-- MESSAGE --}}
                                <input
                                    type="text"
                                    name="message_text"
                                    class="message-input"
                                    placeholder="Tulis pesan..."
                                    autocomplete="off">


                                {{-- SEND --}}
                                <button
                                    type="submit"
                                    class="send-button">

                                    ➤

                                </button>

                            </form>


                            @else

                            {{-- TIDAK ADA TIM PROYEK --}}
                            <div class="empty-chat">

                                <div class="empty-chat-icon">
                                    💬
                                </div>

                                <div>
                                    Belum ada Tim Proyek
                                    yang tersedia.
                                </div>

                            </div>

                            @endif


                    </section>


                </div>


            </section>


        </main>


    </div>


    <script>
        /*
|--------------------------------------------------------------------------
| AUTO SCROLL CHAT KE PESAN TERBARU
|--------------------------------------------------------------------------
*/

        const chatBody =
            document.getElementById('chatBody');


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
                        this.value
                        .toLowerCase()
                        .trim();


                    document
                        .querySelectorAll(
                            '.conversation-item'
                        )
                        .forEach(
                            function(item) {

                                const name =
                                    item.dataset.name || '';


                                item.style.display =
                                    name.includes(keyword) ?
                                    'grid' :
                                    'none';

                            }
                        );

                }
            );

        }
    </script>


</body>

</html>
```