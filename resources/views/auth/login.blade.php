<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoORM – Log In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink-light:  #fce4ec;
            --pink-mid:    #f48fb1;
            --pink-main:   #e91e8c;
            --pink-deep:   #c2185b;
            --rose:        #ff4081;
            --card-bg:     #ffffff;
            --text-dark:   #2d1b2e;
            --text-muted:  #9e7090;
            --input-bg:    #fdf4f8;
            --input-border:#f0c4d8;
            --shadow:      0 20px 60px rgba(233,30,140,0.12), 0 4px 16px rgba(0,0,0,0.06);
            --radius:      18px;
        }

        body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'DM Sans', sans-serif;
    background: linear-gradient(135deg, #fce4ec 0%, #fdf4f8 40%, #f8e8f5 70%, #fce4ec 100%);
    background-size: 400% 400%;
    animation: gradShift 12s ease infinite;
    position: relative;
    overflow-x: hidden;
    overflow-y: auto;
    padding: 40px 16px;
}

        @keyframes gradShift {
            0%,100% { background-position: 0% 50%; }
            50%      { background-position: 100% 50%; }
        }

        /* decorative blobs */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: .35;
            pointer-events: none;
        }
        body::before {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #f48fb1, transparent);
            top: -120px; left: -120px;
            animation: blobMove1 18s ease-in-out infinite;
        }
        body::after {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #ce93d8, transparent);
            bottom: -100px; right: -100px;
            animation: blobMove2 22s ease-in-out infinite;
        }
        @keyframes blobMove1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(40px,30px)} }
        @keyframes blobMove2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-30px,-40px)} }

        /* ── CARD ── */
        .card {
            width: 100%;
            max-width: 440px;
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 48px 44px 40px;
            position: relative;
            animation: cardIn .6s cubic-bezier(.22,1,.36,1) both;
            border: 1px solid rgba(240,196,216,.4);
        }
        @keyframes cardIn {
            from { opacity:0; transform: translateY(32px) scale(.97); }
            to   { opacity:1; transform: translateY(0) scale(1); }
        }

        /* top accent strip */
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 3px;
            background: linear-gradient(90deg, var(--pink-mid), var(--rose), var(--pink-deep));
            border-radius: 0 0 6px 6px;
        }

        /* ── LOGO ── */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--rose), var(--pink-deep));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(233,30,140,.3);
        }
        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--text-dark);
            letter-spacing: -.3px;
        }
        .logo-text span { color: var(--rose); }

        /* ── HEADING ── */
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            color: var(--text-dark);
            margin-bottom: 4px;
        }
        .sub {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 32px;
        }

        /* ── FORM GROUP ── */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 7px;
            letter-spacing: .2px;
        }

        .input-wrap {
            position: relative;
        }
        .input-wrap .icon {
            position: absolute;
            left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--pink-mid);
            pointer-events: none;
            transition: color .2s;
            display: flex;
        }
        .input-wrap input {
            width: 100%;
            padding: 13px 42px 13px 42px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: var(--text-dark);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }
        .input-wrap input::placeholder { color: #c9a8be; }
        .input-wrap input:focus {
            border-color: var(--rose);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(255,64,129,.1);
        }
        .input-wrap input:focus ~ .icon,
        .input-wrap:focus-within .icon { color: var(--rose); }

        /* password toggle */
        .toggle-pw {
            position: absolute;
            right: 13px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--pink-mid); display: flex;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--rose); }

        /* validation errors */
        .error-msg {
            font-size: 12px;
            color: #e53935;
            margin-top: 5px;
            display: flex; gap: 4px; align-items: center;
        }

        /* ── ROW: remember + forgot ── */
        .row-extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .remember {
            display: flex; align-items: center; gap: 7px;
            font-size: 13px; color: var(--text-muted); cursor: pointer;
            user-select: none;
        }
        .remember input[type=checkbox] {
            accent-color: var(--rose);
            width: 15px; height: 15px;
            cursor: pointer;
        }
        .forgot {
            font-size: 13px;
            color: var(--rose);
            text-decoration: none;
            transition: opacity .2s;
        }
        .forgot:hover { opacity: .7; }

        /* ── BUTTONS ── */
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--rose) 0%, var(--pink-deep) 100%);
            color: #fff;
            border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px; font-weight: 600;
            cursor: pointer; letter-spacing: .3px;
            box-shadow: 0 6px 20px rgba(233,30,140,.35);
            transition: transform .15s, box-shadow .15s, opacity .15s;
            position: relative; overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.15), transparent);
            opacity: 0; transition: opacity .2s;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 10px 28px rgba(233,30,140,.4); }
        .btn-primary:hover::after { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }

        /* ── DIVIDER ── */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 24px 0 20px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: var(--input-border);
        }
        .divider span {
            font-size: 12px; color: var(--text-muted); white-space: nowrap;
        }

        /* ── REGISTER LINK ── */
        .register-prompt {
            text-align: center;
            font-size: 14px;
            color: var(--text-muted);
        }
        .register-prompt a {
            color: var(--rose);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: border-color .2s;
        }
        .register-prompt a:hover { border-color: var(--rose); }

        /* ── ALERT (session errors) ── */
        .alert-error {
            background: #fce4ec; border: 1px solid #f48fb1;
            border-radius: 10px; padding: 12px 14px;
            font-size: 13px; color: #c62828;
            margin-bottom: 20px;
            display: flex; gap: 8px; align-items: flex-start;
        }
    </style>
</head>
<body>

<div class="card">

    {{-- Logo --}}
    <div class="logo">
        <div class="logo-icon">🌸</div>
        <div class="logo-text">Todo<span>ORM</span></div>
    </div>

    <h1>Welcome back 👋</h1>
    <p class="sub">Log in to manage your tasks beautifully.</p>

    {{-- Session / Auth Errors --}}
    @if ($errors->any())
        <div class="alert-error">
            <span>⚠️</span>
            <div>{{ $errors->first() }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </span>
                <input
                    id="email" type="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    autocomplete="email" autofocus
                    required
                >
            </div>
            @error('email')
                <div class="error-msg">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </span>
                <input id="password" type="password" name="password"
                    placeholder="••••••••"
                    autocomplete="current-password" required>
                <button type="button" class="toggle-pw" onclick="togglePw('password', this)" aria-label="Show/hide password">
                    <svg id="eye-password" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            @error('password')
                <div class="error-msg">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="row-extras">
            <label class="remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary">Log In</button>

    </form>

    <div class="divider"><span>or</span></div>

    <p class="register-prompt">
        Don't have an account? <a href="{{ route('register') }}">Create one →</a>
    </p>

</div>

<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const showing = input.type === 'text';
    input.type = showing ? 'password' : 'text';
    btn.innerHTML = showing
        ? `<svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`
        : `<svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
}
</script>
</body>
</html>