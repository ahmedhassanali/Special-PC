<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'مركز صيانة Special PC' }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap');

        :root {
            --bg: #0d1b2a;
            --panel-bg: rgba(0, 45, 50, 0.55);
            --panel-border: rgba(0, 188, 188, 0.28);
            --teal: #00cccc;
            --teal-bright: #00e5e5;
            --teal-btn: #00aaaa;
            --teal-soft: rgba(0, 200, 200, 0.65);
            --ink: #ffffff;
            --muted: rgba(200, 240, 240, 0.55);
            --line: rgba(0, 188, 188, 0.2);
            --ok: #00ddaa;
            --danger: #ff6b6b;
            --warn: #ffcf5c;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.8;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(0, 188, 188, 0.18) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(0, 160, 160, 0.12) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(0, 200, 200, 0.07) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        a { color: inherit; }

        header {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            padding: 20px max(18px, 5vw);
            border-bottom: 1px solid var(--line);
        }

        .brand-lockup { display: flex; align-items: center; gap: 14px; }

        .brand-logo {
            width: 54px; height: 54px; object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(0, 200, 200, 0.6));
        }

        .brand-lockup strong { font-size: 22px; font-weight: 900; letter-spacing: 1px; }
        .brand-lockup span { color: var(--teal-soft); font-size: 12px; letter-spacing: 2px; }

        .header-badge {
            display: flex; align-items: center; gap: 8px;
            background: rgba(0, 188, 188, 0.12);
            border: 1px solid rgba(0, 188, 188, 0.4);
            padding: 8px 18px; border-radius: 30px;
            font-size: 13px; color: rgba(0, 220, 220, 0.9); letter-spacing: 1px;
        }

        .hb-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #00cccc; box-shadow: 0 0 8px #00cccc;
            animation: blink 1s ease-in-out infinite;
        }

        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.2; } }

        main {
            position: relative; z-index: 10;
            width: min(1160px, 92vw); margin: 26px auto; display: grid; gap: 18px;
        }

        h1 { font-size: 30px; font-weight: 900; }
        h2 { font-size: 20px; margin-bottom: 14px; font-weight: 700; }
        h3 { font-size: 16px; font-weight: 700; }
        .muted, p { color: var(--muted); }

        .hero-title .teal { color: var(--teal-bright); text-shadow: 0 0 30px rgba(0, 220, 220, 0.5); }

        .grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 16px; }
        .span-3 { grid-column: span 3; } .span-4 { grid-column: span 4; }
        .span-5 { grid-column: span 5; } .span-6 { grid-column: span 6; }
        .span-7 { grid-column: span 7; } .span-8 { grid-column: span 8; }
        .span-9 { grid-column: span 9; } .span-12 { grid-column: span 12; }

        .panel {
            background: var(--panel-bg);
            border: 1px solid var(--panel-border);
            border-radius: 14px; padding: 22px;
            backdrop-filter: blur(6px);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.35);
            position: relative; overflow: hidden;
        }

        .panel::after {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--teal), transparent);
        }

        label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: #eafcff; }

        input, select, textarea {
            width: 100%; min-height: 44px; padding: 10px 14px;
            background: rgba(0, 30, 35, 0.6);
            border: 1px solid rgba(0, 188, 188, 0.35);
            border-radius: 10px; color: #fff; font: inherit; outline: none;
            transition: border-color .25s;
        }

        input::placeholder, textarea::placeholder { color: rgba(255, 255, 255, 0.28); }
        input:focus, select:focus, textarea:focus { border-color: var(--teal); }
        select option { background: #0d1b2a; color: #fff; }
        textarea { min-height: 96px; resize: vertical; }
        .field { margin-bottom: 14px; }
        .error { color: var(--danger); font-size: 12px; margin-top: 4px; }

        .check-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 10px; }
        .check-card, .switch-card {
            border: 1px solid var(--panel-border); border-radius: 10px; padding: 12px;
            background: rgba(0, 0, 0, 0.25); display: flex; gap: 10px; align-items: flex-start;
            cursor: pointer; transition: border-color .25s, box-shadow .25s;
        }
        .check-card input, .switch-card input { width: auto; min-height: auto; margin-top: 6px; accent-color: var(--teal); }
        .check-card strong, .switch-card strong { display: block; color: #fff; }
        .check-card small, .switch-card small { color: var(--teal-soft); }
        .check-card:has(input:checked), .switch-card:has(input:checked) {
            border-color: var(--teal);
            box-shadow: inset 0 0 0 2px rgba(0, 200, 200, 0.18);
        }

        .request-switch { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .hidden-block { display: none !important; }

        .actions { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .btn {
            border: 0; border-radius: 30px; min-height: 44px; padding: 11px 26px; cursor: pointer;
            font-weight: 700; font-family: 'Cairo', sans-serif; background: var(--teal-btn); color: #fff;
            text-decoration: none; display: inline-flex; align-items: center; justify-content: center;
            transition: background .2s, transform .1s;
        }
        .btn:hover { background: var(--teal); transform: translateY(-1px); }
        .btn:active { transform: scale(.98); }
        .btn.secondary { background: rgba(0, 60, 60, 0.5); color: #eafcff; border: 1px solid var(--panel-border); }
        .btn.ok { background: #0a9d7d; } .btn.ok:hover { background: #00c497; }
        .btn.danger { background: #c0392b; } .btn.danger:hover { background: #e04b3a; }

        .badge {
            display: inline-flex; border-radius: 999px; min-height: 28px; padding: 3px 12px;
            align-items: center; font-size: 12px; font-weight: 700;
            background: rgba(0, 188, 188, 0.12); color: var(--teal-bright);
        }
        .badge.waiting { background: rgba(255, 207, 92, 0.15); color: var(--warn); }
        .badge.working { background: rgba(0, 200, 220, 0.15); color: #4fe3ff; }
        .badge.done, .badge.approved { background: rgba(0, 221, 170, 0.15); color: var(--ok); }
        .badge.delivered { background: rgba(120, 110, 255, 0.18); color: #b3aaff; }
        .badge.rejected { background: rgba(255, 107, 107, 0.15); color: var(--danger); }

        .empty {
            border: 1px dashed var(--panel-border); background: rgba(0, 0, 0, 0.2);
            border-radius: 10px; padding: 18px; text-align: center; color: var(--muted);
        }
        .line-item {
            display: grid; grid-template-columns: 1fr auto auto; gap: 10px; align-items: center;
            border: 1px solid var(--panel-border); border-radius: 10px; padding: 12px; margin-top: 10px;
            background: rgba(0, 0, 0, 0.2);
        }
        .line-item strong { color: #fff; }

        .timeline { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin: 16px 0; }
        .step {
            border: 1px solid var(--panel-border); border-radius: 10px; padding: 12px; min-height: 72px;
            background: rgba(0, 0, 0, 0.2);
        }
        .step.active { border-color: var(--teal); box-shadow: inset 0 0 0 2px rgba(0, 200, 200, 0.2); }
        .step strong { color: #fff; }

        .image-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 10px; }
        .image-grid img {
            width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 10px;
            border: 1px solid var(--panel-border);
        }

        .qr-box {
            display: grid; place-items: center; gap: 10px; text-align: center;
            background: rgba(0, 0, 0, 0.25); border: 1px dashed var(--panel-border);
            border-radius: 10px; padding: 14px; overflow: hidden;
        }
        .qr-img { width: 220px; height: 220px; max-width: 100%; background: #fff; border-radius: 10px; padding: 8px; }
        .qr-box a { word-break: break-all; text-decoration: none; font-size: 12px; }

        .pc-hero {
            background: linear-gradient(135deg, #0a3a3a 0%, #0d4f4f 50%, #073030 100%);
            border: 1px solid rgba(0, 188, 188, 0.3);
            padding: 18px; border-radius: 12px; margin: 16px 0;
        }
        .pc-hero p { color: rgba(200, 240, 240, 0.7); }

        hr { border: 0; border-top: 1px solid var(--line); margin: 18px 0; }

        @media(max-width:920px) {
            .span-3, .span-4, .span-5, .span-6, .span-7, .span-8, .span-9, .span-12 { grid-column: span 12; }
            .timeline { grid-template-columns: 1fr 1fr; }
        }
        @media(max-width:560px) {
            .timeline, .request-switch { grid-template-columns: 1fr; }
            .actions .btn { flex: 1 1 auto; }
            header { flex-direction: column; }
        }
    </style>
</head>

<body>
    <header>
        <div class="brand-lockup">
            <img class="brand-logo" src="{{ asset('logo.svg') }}" alt="Special PC" onerror="this.style.display='none'">
            <div>
                <strong>SPECIAL PC</strong><br>
                <span>{{ $subtitle ?? 'مركز الصيانة وتركيب الأجهزة' }}</span>
            </div>
        </div>
        <div class="header-badge">
            <div class="hb-dot"></div>
            مركز الصيانة
        </div>
    </header>

    @yield('body')
</body>

</html>
