<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Inventaris Perumda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        /* ============================
           RESET
           ============================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0a1628;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ============================
           BACKGROUND — Bauhaus shapes
           ============================ */
        .geo {
            position: fixed;
            z-index: 0;
        }

        .geo-c1 {
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: #1C7791;
            top: -80px;
            right: -60px;
        }

        .geo-c2 {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: #004500;
            bottom: -140px;
            left: -100px;
        }

        .geo-c3 {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: #B4D400;
            bottom: 60px;
            right: 120px;
        }

        .geo-c4 {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #32C5D2;
            top: 200px;
            left: 80px;
        }

        .geo-t1 {
            width: 0;
            height: 0;
            border-left: 80px solid transparent;
            border-right: 80px solid transparent;
            border-bottom: 140px solid #1C7791;
            top: 50px;
            left: 220px;
            transform: rotate(-15deg);
        }

        .geo-t2 {
            width: 0;
            height: 0;
            border-left: 60px solid transparent;
            border-right: 60px solid transparent;
            border-bottom: 100px solid #004500;
            bottom: 180px;
            right: 40px;
            transform: rotate(25deg);
        }

        .geo-t3 {
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-bottom: 52px solid #B4D400;
            top: 45%;
            left: 15%;
            transform: rotate(45deg);
            opacity: 0.7;
        }

        .geo-r1 {
            width: 60px;
            height: 60px;
            background: #32C5D2;
            top: 35%;
            right: 50px;
            transform: rotate(15deg);
            border-radius: 4px;
            opacity: 0.6;
        }

        /* ============================
           CARD
           ============================ */
        .card {
            position: relative;
            z-index: 10;
            width: 92%;
            max-width: 960px;
            min-height: 560px;
            background: #fff;
            border-radius: 24px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
        }

        /* ============================
           LEFT — Login Form
           ============================ */
        .card-form {
            flex: 1;
            padding: 50px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .brand img {
            height: 80px;
            width: 80px;
            object-fit: contain;
        }

        .brand span {
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .welcome {
            font-size: 2.2rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1.15;
            margin-bottom: 36px;
        }

        .field {
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .field input {
            width: 100%;
            padding: 13px 0;
            border: none;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9rem;
            font-family: inherit;
            color: #1e293b;
            background: transparent;
            outline: none;
            transition: border-color 0.25s;
        }

        .field input::placeholder {
            color: #cbd5e1;
        }

        .field input:focus {
            border-bottom-color: #1C7791;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
            margin-top: 4px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #004500;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 0.8rem;
            color: #64748b;
            cursor: pointer;
        }

        .btn-login {
            display: block;
            width: 100%;
            max-width: 280px;
            padding: 15px 32px;
            background: linear-gradient(135deg, #004500, #1C7791);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0, 69, 0, 0.3);
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 69, 0, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px 16px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.82rem;
            color: #dc2626;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* ============================
           RIGHT — Visual Panel
           ============================ */
        .card-visual {
            width: 42%;
            flex-shrink: 0;
            background: linear-gradient(160deg, #004500 0%, #0a5e2a 40%, #1C7791 100%);
            position: relative;
            overflow: hidden;
            display: none;
        }

        @media (min-width:769px) {
            .card-visual {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .card-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 30% 70%, rgba(180, 212, 0, 0.25) 0%, transparent 50%),
                radial-gradient(circle at 70% 20%, rgba(50, 197, 210, 0.2) 0%, transparent 40%);
        }

        /* Decorative shapes inside panel */
        .vs {
            position: absolute;
        }

        .vs-c1 {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(180, 212, 0, 0.25);
            bottom: -30px;
            left: -40px;
        }

        .vs-c2 {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.15);
            top: 40px;
            right: -20px;
        }

        .vs-c3 {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(50, 197, 210, 0.3);
            top: 50%;
            left: 20px;
        }

        .vs-t {
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid rgba(255, 255, 255, 0.08);
            top: 30%;
            right: 30px;
            transform: rotate(10deg);
        }

        .vs-r {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(180, 212, 0, 0.3);
            bottom: 30%;
            right: 20%;
            transform: rotate(20deg);
            border-radius: 4px;
        }

        /* ============================
           3D ANIMATED SCENE
           ============================ */
        .scene-wrap {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .scene {
            position: relative;
            width: 240px;
            height: 240px;
        }

        /* Main floating clipboard */
        .clipboard {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: clipFloat 4s ease-in-out infinite;
        }

        .clipboard svg {
            filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.25));
        }

        @keyframes clipFloat {

            0%,
            100% {
                transform: translateY(0) rotateY(0deg);
            }

            50% {
                transform: translateY(-14px) rotateY(6deg);
            }
        }

        /* Glow rings */
        .ring {
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            animation: ringPulse 3s ease-in-out infinite;
        }

        .ring-1 {
            width: 170px;
            height: 170px;
            margin: -85px 0 0 -85px;
            border: 2px solid rgba(180, 212, 0, 0.25);
        }

        .ring-2 {
            width: 210px;
            height: 210px;
            margin: -105px 0 0 -105px;
            border: 1px solid rgba(50, 197, 210, 0.12);
            animation-delay: 0.5s;
        }

        @keyframes ringPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.12);
                opacity: 0.7;
            }
        }

        /* Orbit mini-icons */
        .orb {
            position: absolute;
        }

        .orb:nth-child(1) {
            top: 8px;
            left: 50%;
            margin-left: -22px;
        }

        .orb:nth-child(2) {
            top: 50%;
            right: 8px;
            margin-top: -22px;
        }

        .orb:nth-child(3) {
            bottom: 8px;
            left: 50%;
            margin-left: -22px;
        }

        .orb-box {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            animation: bobUp 2.5s ease-in-out infinite;
        }

        .orb:nth-child(2) .orb-box {
            animation-delay: 0.5s;
        }

        .orb:nth-child(3) .orb-box {
            animation-delay: 1s;
        }

        @keyframes bobUp {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-8px) scale(1.08);
            }
        }

        /* Floating dots */
        .dot {
            position: absolute;
            border-radius: 50%;
            animation: dotDrift 5s ease-in-out infinite;
        }

        .dot-1 {
            width: 8px;
            height: 8px;
            background: #B4D400;
            top: 18%;
            left: 8%;
        }

        .dot-2 {
            width: 6px;
            height: 6px;
            background: #32C5D2;
            top: 72%;
            right: 12%;
            animation-delay: 1.2s;
        }

        .dot-3 {
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.15);
            bottom: 22%;
            left: 18%;
            animation-delay: 2.4s;
        }

        .dot-4 {
            width: 5px;
            height: 5px;
            background: #B4D400;
            top: 38%;
            right: 8%;
            animation-delay: 0.6s;
            opacity: 0.5;
        }

        @keyframes dotDrift {

            0%,
            100% {
                transform: translateY(0);
                opacity: 0.4;
            }

            50% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <!-- ═══ Background Bauhaus ═══ -->
    <div class="geo geo-c1"></div>
    <div class="geo geo-c2"></div>
    <div class="geo geo-c3"></div>
    <div class="geo geo-c4"></div>
    <div class="geo geo-t1"></div>
    <div class="geo geo-t2"></div>
    <div class="geo geo-t3"></div>
    <div class="geo geo-r1"></div>

    <!-- ═══ Card ═══ -->
    <div class="card">

        <!-- LEFT: Form -->
        <div class="card-form">
            <div class="brand">
                <img src="{{ asset('perumda.png') }}" alt="Logo">
            </div>

            <h1 class="welcome">Selamat Datang<br>di Inventaris</h1>

            @if($errors->any())
                <div class="alert">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        placeholder="nama@perumda.com">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Masukkan password">
                </div>
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
        <!-- end .card-form -->

        <!-- RIGHT: Visual Panel -->
        <div class="card-visual">
            <div class="vs vs-c1"></div>
            <div class="vs vs-c2"></div>
            <div class="vs vs-c3"></div>
            <div class="vs vs-t"></div>
            <div class="vs vs-r"></div>

            <div class="scene-wrap">
                <div class="scene">
                    <!-- Glow rings -->
                    <div class="ring ring-1"></div>
                    <div class="ring ring-2"></div>

                    <!-- Floating clipboard -->
                    <div class="clipboard">
                        <svg width="120" height="140" viewBox="0 0 120 140" fill="none">
                            <rect x="18" y="24" width="84" height="108" rx="10" fill="rgba(0,0,0,0.15)" />
                            <rect x="14" y="18" width="84" height="108" rx="10" fill="#0a7a5a" />
                            <rect x="10" y="14" width="84" height="108" rx="10" fill="white" />
                            <rect x="36" y="8" width="32" height="16" rx="4" fill="#1C7791" />
                            <circle cx="52" cy="14" r="3" fill="white" />
                            <rect x="26" y="40" width="52" height="4" rx="2" fill="#e2e8f0" />
                            <rect x="26" y="52" width="40" height="4" rx="2" fill="#e2e8f0" />
                            <rect x="26" y="64" width="48" height="4" rx="2" fill="#e2e8f0" />
                            <circle cx="33" cy="82" r="6" fill="#B4D400" />
                            <path d="M30 82l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <rect x="44" y="80" width="32" height="4" rx="2" fill="#e2e8f0" />
                            <circle cx="33" cy="96" r="6" fill="#32C5D2" />
                            <path d="M30 96l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <rect x="44" y="94" width="28" height="4" rx="2" fill="#e2e8f0" />
                        </svg>
                    </div>

                    <!-- Orbit icons -->
                    <div class="orb">
                        <div class="orb-box">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                                <rect x="4" y="14" width="4" height="6" rx="1" fill="#B4D400" />
                                <rect x="10" y="10" width="4" height="10" rx="1" fill="#32C5D2" />
                                <rect x="16" y="6" width="4" height="14" rx="1" fill="white" />
                            </svg>
                        </div>
                    </div>
                    <div class="orb">
                        <div class="orb-box">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4" stroke="#B4D400" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.5" opacity="0.6" />
                            </svg>
                        </div>
                    </div>
                    <div class="orb">
                        <div class="orb-box">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                                <path
                                    d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                                    stroke="white" stroke-width="1.5" opacity="0.7" />
                                <path d="M3.27 6.96L12 12.01l8.73-5.05" stroke="#32C5D2" stroke-width="1.5" />
                            </svg>
                        </div>
                    </div>

                    <!-- Floating dots -->
                    <div class="dot dot-1"></div>
                    <div class="dot dot-2"></div>
                    <div class="dot dot-3"></div>
                    <div class="dot dot-4"></div>
                </div>
            </div>
        </div>
        <!-- end .card-visual -->

    </div>
    <!-- end .card -->

</body>

</html>