<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Special PC — قريباً</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0d1b2a;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(0, 200, 200, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .header {
            width: 100%;
            max-width: 1100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 32px;
            position: relative;
            z-index: 10;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(0, 200, 200, 0.6));
        }

        .logo-text {
            font-size: 22px;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            line-height: 1.2;
        }

        .logo-text span {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: rgba(0, 200, 200, 0.8);
            letter-spacing: 4px;
        }

        .header-badge {
            background: rgba(0, 188, 188, 0.12);
            border: 1px solid rgba(0, 188, 188, 0.4);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 13px;
            color: rgba(0, 220, 220, 0.9);
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hb-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #00cccc;
            box-shadow: 0 0 8px #00cccc;
            animation: blink 1s ease-in-out infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.2;
            }
        }

        .hero {
            width: 100%;
            max-width: 1100px;
            margin: 20px 0 0;
            position: relative;
            z-index: 10;
            padding: 0 32px;
        }

        .hero-banner {
            width: 100%;
            background: linear-gradient(135deg, #0a3a3a 0%, #0d4f4f 40%, #0a5555 70%, #073030 100%);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            min-height: 340px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(0, 188, 188, 0.3);
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 55%;
            background: repeating-linear-gradient(-55deg, transparent, transparent 18px, rgba(0, 180, 180, 0.06) 18px, rgba(0, 180, 180, 0.06) 20px);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 48px;
            flex: 1;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 200, 200, 0.15);
            border: 1px solid rgba(0, 200, 200, 0.5);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            color: #00dddd;
            letter-spacing: 3px;
            margin-bottom: 24px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 16px;
            color: #fff;
        }

        .hero-title .teal {
            color: #00e5e5;
            display: block;
            text-shadow: 0 0 30px rgba(0, 220, 220, 0.5);
        }

        .hero-sub {
            font-size: 16px;
            color: rgba(200, 240, 240, 0.65);
            line-height: 1.8;
            margin-bottom: 36px;
            max-width: 420px;
        }

        .cat-strip {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cat-chip {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 188, 188, 0.35);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 12px;
            color: rgba(0, 220, 220, 0.8);
        }

        .hero-visual {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 42%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .pc-graphic {
            font-size: 140px;
            opacity: 0.09;
            filter: blur(2px);
            transform: rotate(-10deg);
            color: #00cccc;
            animation: floatPC 4s ease-in-out infinite;
        }

        @keyframes floatPC {

            0%,
            100% {
                transform: rotate(-10deg) translateY(0);
            }

            50% {
                transform: rotate(-10deg) translateY(-15px);
            }
        }

        .section {
            width: 100%;
            max-width: 1100px;
            padding: 0 32px;
            margin-top: 40px;
            position: relative;
            z-index: 10;
        }

        .section-title {
            text-align: center;
            font-size: 14px;
            letter-spacing: 3px;
            color: rgba(0, 200, 200, 0.6);
            margin-bottom: 24px;
        }

        .countdown {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .time-card {
            background: rgba(0, 60, 60, 0.5);
            border: 1px solid rgba(0, 188, 188, 0.35);
            border-radius: 12px;
            width: 100px;
            padding: 20px 12px 14px;
            text-align: center;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
        }

        .time-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00cccc, transparent);
        }

        .time-num {
            font-size: 40px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
            text-shadow: 0 0 20px rgba(0, 200, 200, 0.5);
        }

        .time-sep {
            font-size: 32px;
            color: rgba(0, 200, 200, 0.4);
            align-self: center;
            padding-bottom: 18px;
            font-weight: 900;
        }

        .time-lbl {
            font-size: 11px;
            color: rgba(0, 200, 200, 0.6);
            margin-top: 6px;
            letter-spacing: 2px;
        }

        .notify-section {
            width: 100%;
            max-width: 1100px;
            padding: 0 32px;
            margin-top: 40px;
            position: relative;
            z-index: 10;
            text-align: center;
        }

        .notify-title {
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 8px;
        }

        .notify-title span {
            color: #00e5e5;
        }

        .notify-desc {
            font-size: 14px;
            color: rgba(200, 240, 240, 0.5);
            margin-bottom: 28px;
        }

        .notify-row {
            display: flex;
            gap: 12px;
            max-width: 480px;
            margin: 0 auto;
            justify-content: center;
            flex-wrap: wrap;
        }

        .notify-input {
            flex: 1;
            min-width: 240px;
            padding: 14px 20px;
            background: rgba(0, 40, 40, 0.6);
            border: 1px solid rgba(0, 188, 188, 0.4);
            border-radius: 30px;
            color: #fff;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
            outline: none;
            text-align: right;
            transition: border-color .3s;
        }

        .notify-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .notify-input:focus {
            border-color: #00cccc;
        }

        .notify-btn {
            padding: 14px 30px;
            background: #00aaaa;
            border: none;
            border-radius: 30px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: background .2s, transform .1s;
            white-space: nowrap;
        }

        .notify-btn:hover {
            background: #00cccc;
            transform: translateY(-1px);
        }

        .notify-btn:active {
            transform: scale(0.97);
        }

        .toast {
            display: none;
            margin-top: 14px;
            font-size: 14px;
            color: #00ddaa;
        }

        .grid-section {
            width: 100%;
            max-width: 1100px;
            padding: 0 32px;
            margin-top: 48px;
            position: relative;
            z-index: 10;
        }

        .grid-label {
            font-size: 13px;
            color: rgba(0, 200, 200, 0.5);
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 20px;
        }

        .cat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .cat-card {
            background: linear-gradient(135deg, rgba(0, 60, 60, 0.7), rgba(0, 40, 50, 0.7));
            border: 1px solid rgba(0, 188, 188, 0.25);
            border-radius: 12px;
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            cursor: default;
            transition: border-color .3s, transform .2s;
            position: relative;
            overflow: hidden;
        }

        .cat-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 188, 188, 0.5), transparent);
        }

        .cat-card:hover {
            border-color: rgba(0, 188, 188, 0.6);
            transform: translateY(-2px);
        }

        .cat-icon {
            font-size: 28px;
            width: 52px;
            height: 52px;
            background: rgba(0, 180, 180, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cat-name {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
        }

        .cat-sub {
            font-size: 12px;
            color: rgba(0, 200, 200, 0.6);
            margin-top: 2px;
        }

        .cat-arrow {
            margin-right: auto;
            color: rgba(0, 188, 188, 0.5);
            font-size: 18px;
        }

        .footer {
            width: 100%;
            max-width: 1100px;
            padding: 32px 32px 40px;
            margin-top: 48px;
            position: relative;
            z-index: 10;
            text-align: center;
            border-top: 1px solid rgba(0, 188, 188, 0.15);
        }

        .footer-links {
            display: flex;
            gap: 24px;
            justify-content: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .footer-links a {
            font-size: 13px;
            color: rgba(200, 240, 240, 0.45);
            text-decoration: none;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: #00cccc;
        }

        .footer-copy {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.2);
        }

        @media(max-width:700px) {
            .cat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .hero-title {
                font-size: 34px;
            }

            .header {
                flex-direction: column;
                gap: 14px;
            }
        }

        @media(max-width:480px) {
            .cat-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-badge">
            <div class="hb-dot"></div>
            قريباً • COMING SOON
        </div>
        <div class="logo-area">
            <!-- ضع مسار اللوقو هنا -->
            <img class="logo-img" src="logo.svg" alt="Special PC" onerror="this.style.display='none'">
            <div class="logo-text">
                SPECIAL PC
                <span>GAMING STORE</span>
            </div>
        </div>
    </div>

    <div class="hero">
        <div class="hero-banner">
            <div class="hero-visual">
                <div class="pc-graphic">🖥</div>
            </div>
            <div class="hero-content">
                <div class="hero-tag">
                    <div class="hb-dot"></div>
                    متجر الجيمر الأول
                </div>
                <div class="hero-title">
                    <span class="teal">المتجر قادم</span>
                    قريباً! 🎮
                </div>
                <div class="hero-sub">
                    نبني لك أفضل تجربة تسوق للجيمرز —<br>
                    أجهزة، إكسسوارات، تجميعات مخصصة، وأكثر
                </div>
                <div class="cat-strip">
                    <div class="cat-chip">🖥 شاشات</div>
                    <div class="cat-chip">⌨️ إكسسوارات</div>
                    <div class="cat-chip">🔧 قطع كمبيوتر</div>
                    <div class="cat-chip">🛠 تجميعات</div>
                    <div class="cat-chip">🔧 مركز صيانة</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">العد التنازلي للإطلاق</div>
        <div class="countdown">
            <div class="time-card">
                <div class="time-num" id="cd">00</div>
                <div class="time-lbl">يوم</div>
            </div>
            <div class="time-sep">:</div>
            <div class="time-card">
                <div class="time-num" id="ch">00</div>
                <div class="time-lbl">ساعة</div>
            </div>
            <div class="time-sep">:</div>
            <div class="time-card">
                <div class="time-num" id="cm">00</div>
                <div class="time-lbl">دقيقة</div>
            </div>
            <div class="time-sep">:</div>
            <div class="time-card">
                <div class="time-num" id="cs">00</div>
                <div class="time-lbl">ثانية</div>
            </div>
        </div>
    </div>




    <div class="footer">
        <div class="footer-links">
            <a href="#">الرئيسية</a>
            <a href="#">من نحن</a>
            <a href="#">تواصل معنا</a>
            <a href="#">سياسة الخصوصية</a>
        </div>
        <div class="footer-copy">© 2025 Special PC — جميع الحقوق محفوظة</div>
    </div>

    <script>
        // غير التاريخ هنا — مثال: new Date('2025-09-01')
        const target = new Date();
        target.setDate(target.getDate() + 30);

        function tick() {
            const now = new Date();
            const diff = target - now;
            if (diff <= 0) return;
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            document.getElementById('cd').textContent = String(d).padStart(2, '0');
            document.getElementById('ch').textContent = String(h).padStart(2, '0');
            document.getElementById('cm').textContent = String(m).padStart(2, '0');
            document.getElementById('cs').textContent = String(s).padStart(2, '0');
        }
        tick();
        setInterval(tick, 1000);

        function doNotify() {
            const v = document.getElementById('emailIn').value.trim();
            if (!v || !v.includes('@')) {
                document.getElementById('emailIn').style.borderColor = 'rgba(255,80,80,0.8)';
                setTimeout(() => document.getElementById('emailIn').style.borderColor = '', 1500);
                return;
            }
            document.getElementById('toast').style.display = 'block';
            document.getElementById('emailIn').value = '';
        }
    </script>
</body>

</html>
