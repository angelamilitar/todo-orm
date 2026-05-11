<!DOCTYPE html>
<html lang="en" data-theme="pink">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 TodoORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        .modal-backdrop { display: none !important; }
.modal        { z-index: 1055 !important; }
.modal-dialog {
    animation: modalPop 0.3s cubic-bezier(0.34,1.56,0.64,1) forwards;
}
.modal-content {
    opacity: 1 !important;
    background: #fff9fc !important;
    border-radius: 28px !important;
    border: 2.5px solid rgba(244,63,122,0.35) !important;
    box-shadow:
        0 0 0 6px rgba(244,63,122,0.10),
        0 40px 80px rgba(0,0,0,0.3),
        0 12px 32px rgba(244,63,122,0.25) !important;
}
.modal-header-custom {
    background: linear-gradient(135deg, #f43f7a 0%, #ff6b9d 100%) !important;
    border-radius: 25px 25px 0 0 !important;
    padding: 20px 24px !important;
}
body.modal-open .app-wrapper { filter: none !important; }

@keyframes modalPop {
    from { transform: scale(0.92) translateY(20px); opacity: 0; }
    to   { transform: scale(1) translateY(0);       opacity: 1; }
}
/* ✅ ADD inside your existing <style> block */
.pill-filter {
    padding: 7px 16px;
    border-radius: 50px;
    border: 1.5px solid rgba(var(--primary-rgb), 0.3);
    background: rgba(var(--primary-rgb), 0.06);
    color: var(--primary);
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.18s ease;
}
.pill-filter:hover {
    background: rgba(var(--primary-rgb), 0.15);
    transform: translateY(-1px);
}
.pill-filter.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.35);
}
#taskSearch:focus {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.12);
}

        /* ====================================================
           DESIGN TOKENS — CENTRALIZED COLOR SYSTEM
           ==================================================== */

        /* ── PINK (default) ── */
        [data-theme="pink"] {
            --primary:          #f43f7a;
            --primary-2:        #ff6b9d;
            --primary-3:        #ffb3d1;
            --primary-rgb:      244,63,122;

            --bg-main:          linear-gradient(145deg, #fff0f6 0%, #fdf5fa 50%, #ffe8f2 100%);
            --bg-surface:       rgba(255,255,255,0.92);
            --bg-elevated:      rgba(255,255,255,0.98);
            --sidebar-bg:       linear-gradient(170deg, #f43f7a 0%, #ff6b9d 45%, #ff9bbf 100%);
            --sidebar-glass:    rgba(255,255,255,0.10);
            --sidebar-border:   rgba(255,255,255,0.18);

            --text-primary:     #1a0a12;
            --text-secondary:   #6b3a50;
            --text-muted:       #b08090;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.92);

            --border:           #fad0e0;
            --border-strong:    #f9a8c4;
            --hover-bg:         #fff0f5;
            --active-bg:        rgba(244,63,122,0.08);
            --glass:            rgba(255,255,255,0.62);

            --color-success:    #10b981;
            --color-warning:    #f59e0b;
            --color-danger:     #ef4444;
            --color-info:       #3b82f6;
            --color-purple:     #a855f7;

            --shadow-sm:        0 2px 8px rgba(244,63,122,0.10);
            --shadow-md:        0 6px 24px rgba(244,63,122,0.16);
            --shadow-lg:        0 16px 48px rgba(244,63,122,0.22);

            /* backward-compat aliases */
            --primary-light:    #fff0f5;
            --primary2:         #ff6b9d;
            --bg-gradient:      linear-gradient(145deg, #fff0f6 0%, #fdf5fa 50%, #ffe8f2 100%);
            --card-bg:          rgba(255,255,255,0.92);
            --text:             #1a0a12;
            --text-light:       #b08090;
            --hover:            #fff0f5;
        }

        /* ── DARK ── */
        [data-theme="dark"] {
            --primary:          #c084fc;
            --primary-2:        #a855f7;
            --primary-3:        #7c3aed;
            --primary-rgb:      192,132,252;

            --bg-main:          linear-gradient(145deg, #0d0d18 0%, #13101f 50%, #0f0d1a 100%);
            --bg-surface:       rgba(20,17,35,0.94);
            --bg-elevated:      rgba(28,24,46,0.98);
            --sidebar-bg:       linear-gradient(170deg, #18123a 0%, #251848 45%, #1e1240 100%);
            --sidebar-glass:    rgba(255,255,255,0.06);
            --sidebar-border:   rgba(255,255,255,0.10);

            --text-primary:     #ede9ff;
            --text-secondary:   #b8aed4;
            --text-muted:       #6b5f85;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.88);

            --border:           #2a2040;
            --border-strong:    #3d2e60;
            --hover-bg:         #1e1838;
            --active-bg:        rgba(192,132,252,0.12);
            --glass:            rgba(20,17,35,0.72);

            --color-success:    #34d399;
            --color-warning:    #fbbf24;
            --color-danger:     #f87171;
            --color-info:       #60a5fa;
            --color-purple:     #c084fc;

            --shadow-sm:        0 2px 8px rgba(0,0,0,0.35);
            --shadow-md:        0 6px 24px rgba(0,0,0,0.45);
            --shadow-lg:        0 16px 48px rgba(0,0,0,0.55);

            --primary-light:    rgba(192,132,252,0.12);
            --primary2:         #a855f7;
            --bg-gradient:      linear-gradient(145deg, #0d0d18 0%, #13101f 50%, #0f0d1a 100%);
            --card-bg:          rgba(20,17,35,0.94);
            --text:             #ede9ff;
            --text-light:       #6b5f85;
            --hover:            #1e1838;
        }

        /* ── LIGHT (Indigo) ── */
        [data-theme="light"] {
            --primary:          #6366f1;
            --primary-2:        #818cf8;
            --primary-3:        #a5b4fc;
            --primary-rgb:      99,102,241;

            --bg-main:          linear-gradient(145deg, #f8faff 0%, #eef2ff 50%, #f3f4ff 100%);
            --bg-surface:       rgba(255,255,255,0.95);
            --bg-elevated:      #ffffff;
            --sidebar-bg:       linear-gradient(170deg, #4f46e5 0%, #6366f1 45%, #818cf8 100%);
            --sidebar-glass:    rgba(255,255,255,0.12);
            --sidebar-border:   rgba(255,255,255,0.20);

            --text-primary:     #0f0f2e;
            --text-secondary:   #3730a3;
            --text-muted:       #8b8fbb;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.93);

            --border:           #dde2ff;
            --border-strong:    #c7d2fe;
            --hover-bg:         #eef2ff;
            --active-bg:        rgba(99,102,241,0.08);
            --glass:            rgba(255,255,255,0.68);

            --color-success:    #10b981;
            --color-warning:    #f59e0b;
            --color-danger:     #ef4444;
            --color-info:       #3b82f6;
            --color-purple:     #a855f7;

            --shadow-sm:        0 2px 8px rgba(99,102,241,0.10);
            --shadow-md:        0 6px 24px rgba(99,102,241,0.14);
            --shadow-lg:        0 16px 48px rgba(99,102,241,0.18);

            --primary-light:    #eef2ff;
            --primary2:         #818cf8;
            --bg-gradient:      linear-gradient(145deg, #f8faff 0%, #eef2ff 50%, #f3f4ff 100%);
            --card-bg:          rgba(255,255,255,0.95);
            --text:             #0f0f2e;
            --text-light:       #8b8fbb;
            --hover:            #eef2ff;
        }

        /* ── BLUE (Ocean) ── */
        [data-theme="blue"] {
            --primary:          #2563eb;
            --primary-2:        #3b82f6;
            --primary-3:        #93c5fd;
            --primary-rgb:      37,99,235;

            --bg-main:          linear-gradient(145deg, #eff6ff 0%, #dbeafe 50%, #e0efff 100%);
            --bg-surface:       rgba(255,255,255,0.93);
            --bg-elevated:      #ffffff;
            --sidebar-bg:       linear-gradient(170deg, #1d40b0 0%, #2563eb 45%, #3b82f6 100%);
            --sidebar-glass:    rgba(255,255,255,0.10);
            --sidebar-border:   rgba(255,255,255,0.18);

            --text-primary:     #0a1628;
            --text-secondary:   #1e3a6e;
            --text-muted:       #6b88b5;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.93);

            --border:           #bfdbfe;
            --border-strong:    #93c5fd;
            --hover-bg:         #eff6ff;
            --active-bg:        rgba(37,99,235,0.08);
            --glass:            rgba(255,255,255,0.65);

            --color-success:    #10b981;
            --color-warning:    #f59e0b;
            --color-danger:     #ef4444;
            --color-info:       #06b6d4;
            --color-purple:     #7c3aed;

            --shadow-sm:        0 2px 8px rgba(37,99,235,0.10);
            --shadow-md:        0 6px 24px rgba(37,99,235,0.16);
            --shadow-lg:        0 16px 48px rgba(37,99,235,0.22);

            --primary-light:    #eff6ff;
            --primary2:         #3b82f6;
            --bg-gradient:      linear-gradient(145deg, #eff6ff 0%, #dbeafe 50%, #e0efff 100%);
            --card-bg:          rgba(255,255,255,0.93);
            --text:             #0a1628;
            --text-light:       #6b88b5;
            --hover:            #eff6ff;
        }

        /* ── FOREST ── */
        [data-theme="forest"] {
            --primary:          #16a34a;
            --primary-2:        #22c55e;
            --primary-3:        #86efac;
            --primary-rgb:      22,163,74;

            --bg-main:          linear-gradient(145deg, #f0fdf4 0%, #dcfce7 50%, #f0fdf4 100%);
            --bg-surface:       rgba(255,255,255,0.93);
            --bg-elevated:      #ffffff;
            --sidebar-bg:       linear-gradient(170deg, #14532d 0%, #166534 45%, #16a34a 100%);
            --sidebar-glass:    rgba(255,255,255,0.10);
            --sidebar-border:   rgba(255,255,255,0.18);

            --text-primary:     #052e16;
            --text-secondary:   #14532d;
            --text-muted:       #6b9e7a;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.93);

            --border:           #bbf7d0;
            --border-strong:    #86efac;
            --hover-bg:         #f0fdf4;
            --active-bg:        rgba(22,163,74,0.08);
            --glass:            rgba(255,255,255,0.65);

            --color-success:    #16a34a;
            --color-warning:    #f59e0b;
            --color-danger:     #ef4444;
            --color-info:       #3b82f6;
            --color-purple:     #a855f7;

            --shadow-sm:        0 2px 8px rgba(22,163,74,0.10);
            --shadow-md:        0 6px 24px rgba(22,163,74,0.16);
            --shadow-lg:        0 16px 48px rgba(22,163,74,0.22);

            --primary-light:    #f0fdf4;
            --primary2:         #22c55e;
            --bg-gradient:      linear-gradient(145deg, #f0fdf4 0%, #dcfce7 50%, #f0fdf4 100%);
            --card-bg:          rgba(255,255,255,0.93);
            --text:             #052e16;
            --text-light:       #6b9e7a;
            --hover:            #f0fdf4;
        }

        /* ── ROSE GOLD ── */
        [data-theme="rosegold"] {
            --primary:          #b5536e;
            --primary-2:        #d4748a;
            --primary-3:        #e8a8b5;
            --primary-rgb:      181,83,110;

            --bg-main:          linear-gradient(145deg, #fff5f7 0%, #fde8ec 50%, #fff0f3 100%);
            --bg-surface:       rgba(255,255,255,0.93);
            --bg-elevated:      #ffffff;
            --sidebar-bg:       linear-gradient(170deg, #8b3a4e 0%, #b5536e 45%, #d4748a 100%);
            --sidebar-glass:    rgba(255,255,255,0.10);
            --sidebar-border:   rgba(255,255,255,0.18);

            --text-primary:     #2a0d14;
            --text-secondary:   #7a2d40;
            --text-muted:       #b08090;
            --text-on-primary:  #ffffff;
            --text-on-sidebar:  rgba(255,255,255,0.93);

            --border:           #f5ccd5;
            --border-strong:    #eba8b8;
            --hover-bg:         #fff5f7;
            --active-bg:        rgba(181,83,110,0.08);
            --glass:            rgba(255,255,255,0.65);

            --color-success:    #10b981;
            --color-warning:    #f59e0b;
            --color-danger:     #ef4444;
            --color-info:       #3b82f6;
            --color-purple:     #a855f7;

            --shadow-sm:        0 2px 8px rgba(181,83,110,0.10);
            --shadow-md:        0 6px 24px rgba(181,83,110,0.16);
            --shadow-lg:        0 16px 48px rgba(181,83,110,0.22);

            --primary-light:    #fff5f7;
            --primary2:         #d4748a;
            --bg-gradient:      linear-gradient(145deg, #fff5f7 0%, #fde8ec 50%, #fff0f3 100%);
            --card-bg:          rgba(255,255,255,0.93);
            --text:             #2a0d14;
            --text-light:       #b08090;
            --hover:            #fff5f7;
        }

        /* ====================================================
           BASE
           ==================================================== */
        body {
    min-height: 100vh;
    background: var(--bg-gradient);
    transition: background 0.6s ease;
}
        .bg-layer {
            position: fixed; inset: 0; z-index: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: opacity 0.8s ease, filter 0.6s ease;
        }
        .bg-overlay {
            position: fixed; inset: 0; z-index: 1;
            background: rgba(0,0,0,0);
            transition: background 0.6s ease;
        }
        .app-wrapper { position: relative; z-index: 2; display: flex; min-height: 100vh; }

        /* ====================================================
           SIDEBAR
           ==================================================== */
        .sidebar {
            width: 270px; height: 100vh;
            background: var(--sidebar-bg);
            padding: 16px 13px;
            display: flex; flex-direction: column; gap: 8px;
            position: fixed; left: 0; top: 0; z-index: 100;
            box-shadow: 4px 0 30px rgba(0,0,0,0.2);
            overflow-y: auto; overflow-x: hidden;
            transition: background 0.5s ease;
        }
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 10px; }

        /* ── Sidebar Brand ── */
        .sidebar-brand {
            color: var(--text-on-sidebar);
            font-weight: 900; font-size: 1.25rem;
            display: flex; align-items: center; gap: 8px;
            flex-shrink: 0; padding: 4px 0;
        }
        .sidebar-brand i { animation: heartbeat 1.5s infinite; }

        /* ── Clock ── */
        .sidebar-clock {
            display: none;
            background: var(--sidebar-glass);
            border: 1px solid var(--sidebar-border);
            border-radius: 13px; padding: 10px 13px;
            color: var(--text-on-sidebar);
            flex-shrink: 0; backdrop-filter: blur(10px);
        }
        .sidebar-clock .s-time {
            font-size: 1.55rem; font-weight: 900;
            letter-spacing: 2px; line-height: 1.1;
            font-variant-numeric: tabular-nums;
            color: var(--text-on-sidebar);
        }
        .sidebar-clock .s-date {
            font-size: 0.7rem; opacity: 0.85; font-weight: 600; margin-top: 2px;
            color: var(--text-on-sidebar);
        }

        /* ── Date Strip ── */
        .date-strip {
            display: flex; gap: 5px; overflow-x: auto;
            padding-bottom: 3px; flex-shrink: 0;
        }
        .date-strip::-webkit-scrollbar { height: 2px; }
        .date-strip::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 4px; }
        .date-item {
            min-width: 38px; height: 52px; border-radius: 10px;
            background: var(--sidebar-glass);
            border: 1px solid var(--sidebar-border);
            color: var(--text-on-sidebar);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.3s; flex-shrink: 0;
            position: relative; gap: 1px;
        }
        .date-item:hover { background: rgba(255,255,255,0.25); transform: translateY(-2px); }
        .date-item.active { background: white; color: var(--primary); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        .date-item .di-num { font-size: 0.9rem; font-weight: 900; line-height: 1; }
        .date-item .di-day { font-size: 0.56rem; opacity: 0.8; text-transform: uppercase; font-weight: 700; }
        .date-item .di-dots { display: flex; gap: 2px; position: absolute; bottom: 3px; }
        .date-item .di-dot { width: 4px; height: 4px; border-radius: 50%; }

        /* ── Mini Calendar ── */
        .mini-calendar {
            background: var(--sidebar-glass);
            border: 1px solid var(--sidebar-border);
            border-radius: 13px; padding: 10px;
            color: var(--text-on-sidebar); flex-shrink: 0;
        }
        .cal-header {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 8px;
            font-weight: 800; font-size: 0.8rem;
            color: var(--text-on-sidebar);
        }
        .cal-nav {
            background: rgba(255,255,255,0.18);
            border: none; color: var(--text-on-sidebar);
            border-radius: 7px; width: 22px; height: 22px;
            cursor: pointer; font-size: 0.65rem; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .cal-nav:hover { background: rgba(255,255,255,0.35); }
        .cal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 1px; text-align: center; }
        .cal-day-header {
            font-size: 0.58rem; opacity: 0.65; font-weight: 700; padding: 2px 0;
            color: var(--text-on-sidebar);
        }
        .cal-day {
            font-size: 0.66rem; font-weight: 600; padding: 3px 1px;
            border-radius: 5px; cursor: pointer; transition: all 0.2s;
            position: relative; color: var(--text-on-sidebar);
        }
        .cal-day:hover { background: rgba(255,255,255,0.2); }
        .cal-day.today { background: white; color: var(--primary); font-weight: 900; }
        .cal-day.other-month { opacity: 0.28; }
        .cal-day.selected { outline: 2px solid rgba(255,255,255,0.7); }
        .cal-day.overdue-day::after   { content:''; position:absolute; bottom:1px; left:50%; transform:translateX(-50%); width:4px; height:4px; border-radius:50%; background:#ef4444; }
        .cal-day.upcoming-day::after  { content:''; position:absolute; bottom:1px; left:50%; transform:translateX(-50%); width:4px; height:4px; border-radius:50%; background:#f59e0b; }
        .cal-day.done-day::after      { content:''; position:absolute; bottom:1px; left:50%; transform:translateX(-50%); width:4px; height:4px; border-radius:50%; background:#10b981; }
        .cal-day.today.overdue-day::after,
        .cal-day.today.upcoming-day::after,
        .cal-day.today.done-day::after { background: var(--primary); }

        /* ── Theme Switcher ── */
        .theme-switcher { display: flex; gap: 5px; flex-shrink: 0; flex-wrap: wrap; align-items: center; }
        .theme-label { color: var(--text-on-sidebar); opacity: 0.75; font-size: 0.65rem; font-weight: 700; width: 100%; }
        .theme-btn {
            width: 22px; height: 22px; border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.35);
            cursor: pointer; transition: all 0.3s;
        }
        .theme-btn:hover { transform: scale(1.25); border-color: white; }
        .theme-btn.active { border-color: white; box-shadow: 0 0 0 2px rgba(255,255,255,0.5); }
        .theme-btn[data-theme="pink"]     { background: linear-gradient(135deg,#ff6b9d,#ffb3d1); }
        .theme-btn[data-theme="dark"]     { background: linear-gradient(135deg,#1a1a2e,#a855f7); }
        .theme-btn[data-theme="light"]    { background: linear-gradient(135deg,#f8f9fa,#6366f1); }
        .theme-btn[data-theme="blue"]     { background: linear-gradient(135deg,#2563eb,#60a5fa); }
        .theme-btn[data-theme="forest"]   { background: linear-gradient(135deg,#14532d,#22c55e); }
        .theme-btn[data-theme="rosegold"] { background: linear-gradient(135deg,#8b3a4e,#e8a8b5); }

        .bg-upload-btn {
            background: rgba(255,255,255,0.18);
            border: 1px dashed rgba(255,255,255,0.5);
            border-radius: 8px; color: var(--text-on-sidebar);
            font-size: 0.65rem; font-weight: 700; padding: 4px 8px;
            cursor: pointer; transition: all 0.3s; white-space: nowrap;
        }
        .bg-upload-btn:hover { background: rgba(255,255,255,0.3); }

        /* ── Sidebar Nav ── */
        .sidebar-nav { display: flex; flex-direction: column; gap: 3px; flex-shrink: 0; }
        .sidebar-nav-item {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 12px; border-radius: 11px;
            color: var(--text-on-sidebar);
            font-weight: 700; cursor: pointer; transition: all 0.3s;
            border: none; background: transparent;
            text-decoration: none; font-size: 0.83rem;
            width: 100%; text-align: left;
        }
        .sidebar-nav-item:hover {
            background: rgba(255,255,255,0.18);
            color: white; transform: translateX(3px);
        }
        .sidebar-nav-item.active {
            background: white;
            color: var(--primary);
            box-shadow: var(--shadow-sm);
        }
        [data-theme="dark"] .sidebar-nav-item.active {
            background: rgba(255,255,255,0.12);
            color: white;
        }
        .nav-count {
            background: rgba(255,255,255,0.22);
            border-radius: 8px; padding: 1px 7px;
            font-size: 0.68rem; margin-left: auto;
            min-width: 20px; text-align: center; font-weight: 800;
            color: var(--text-on-sidebar);
        }
        .sidebar-nav-item.active .nav-count {
            background: var(--primary-light);
            color: var(--primary);
        }
        [data-theme="dark"] .sidebar-nav-item.active .nav-count {
            background: rgba(192,132,252,0.2);
            color: #c084fc;
        }

        /* ── Sidebar Footer ── */
        .sidebar-footer {
            margin-top: auto; padding-top: 10px;
            border-top: 1px solid var(--sidebar-border);
            flex-shrink: 0;
        }
        .user-info { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 0.85rem;
            border: 2px solid rgba(255,255,255,0.4);
            color: var(--text-on-sidebar); flex-shrink: 0;
        }
        .user-name  { font-weight: 700; font-size: 0.78rem; color: var(--text-on-sidebar); }
        .user-email { font-size: 0.62rem; opacity: 0.7; color: var(--text-on-sidebar); }
        .btn-logout {
            background: rgba(255,255,255,0.14);
            color: var(--text-on-sidebar);
            border: 1px solid var(--sidebar-border);
            border-radius: 10px; padding: 6px 12px;
            font-weight: 700; font-size: 0.78rem;
            width: 100%; transition: all 0.3s;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.28); color: white; }

        /* ====================================================
           MAIN CONTENT
           ==================================================== */
        .main-content { margin-left: 270px; padding: 22px; flex: 1; min-height: 100vh; min-width: 0; overflow-x: auto; }

        /* ── Topbar ── */
        .topbar {
            display: flex; justify-content: space-between;
            align-items: flex-start; margin-bottom: 18px;
            gap: 10px; flex-wrap: wrap;
        }
        .topbar-title {
            font-size: 1.5rem; font-weight: 900;
            color: var(--text-primary);
            transition: color 0.3s;
        }
        .topbar-title span { color: var(--primary); }
        .topbar-sub {
            color: var(--text-muted); font-size: 0.82rem;
            font-weight: 600; margin-top: 2px;
        }
        .btn-add-task {
            background: var(--primary); color: white;
            border: none; border-radius: 13px; padding: 10px 20px;
            font-weight: 800; font-size: 0.88rem; transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(var(--primary-rgb),0.35);
            white-space: nowrap;
        }
        .btn-add-task:hover {
            transform: translateY(-3px) scale(1.04); color: white;
            box-shadow: 0 8px 25px rgba(var(--primary-rgb),0.45);
        }
        .btn-add-task:active { transform: scale(0.96); }

        /* ── Deadline Cards ── */
        .deadline-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px,1fr)); gap: 12px; margin-bottom: 18px; }
        .dl-card {
            border-radius: 16px; padding: 15px; color: white;
            cursor: pointer; transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            position: relative; overflow: hidden; border: none; text-align: left;
        }
        .dl-card::before {
            content:''; position:absolute; right:-15px; top:-15px;
            width:70px; height:70px; border-radius:50%;
            background:rgba(255,255,255,0.12); transition: all 0.4s;
        }
        .dl-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 16px 40px rgba(0,0,0,0.2); }
        .dl-card:hover::before { width:100px; height:100px; }
        .dl-card.active-filter { transform: translateY(-6px) scale(1.05); box-shadow: 0 16px 40px rgba(0,0,0,0.25); outline: 3px solid rgba(255,255,255,0.6); }
        .dl-card .dl-icon  { font-size: 1.2rem; margin-bottom: 6px; opacity: 0.9; }
        .dl-card .dl-num   { font-size: 1.9rem; font-weight: 900; line-height: 1; }
        .dl-card .dl-label { font-size: 0.72rem; opacity: 0.9; font-weight: 700; margin-top: 3px; }
        .dl-overdue   { background: linear-gradient(135deg,#ef4444,#dc2626); box-shadow: 0 8px 20px rgba(239,68,68,0.3); }
        .dl-today     { background: linear-gradient(135deg,#f59e0b,#d97706); box-shadow: 0 8px 20px rgba(245,158,11,0.3); }
        .dl-tomorrow  { background: linear-gradient(135deg,#f97316,#ea580c); box-shadow: 0 8px 20px rgba(249,115,22,0.3); }
        .dl-upcoming  { background: linear-gradient(135deg,#3b82f6,#2563eb); box-shadow: 0 8px 20px rgba(59,130,246,0.3); }
        .dl-completed { background: linear-gradient(135deg,#10b981,#059669); box-shadow: 0 8px 20px rgba(16,185,129,0.3); }
        .dl-total     { background: linear-gradient(135deg,var(--primary),var(--primary2)); box-shadow: 0 8px 20px rgba(var(--primary-rgb),0.3); }

        /* ── Task Card ── */
        .tab-content .card { overflow-x: auto; }
        .task-card {
            background: var(--bg-surface);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow: var(--shadow-sm);
            padding: 18px;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }
        .task-card-title {
            font-size: 0.95rem; font-weight: 800;
            color: var(--text-primary); margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ── Table ── */
        .table { margin: 0; }
        .table thead th {
            background: var(--active-bg);
            color: var(--primary);
            border: none; padding: 10px 13px;
            font-weight: 800; font-size: 0.76rem;
            text-transform: uppercase; letter-spacing: 0.5px;
            transition: background 0.3s, color 0.3s;
        }
        .table thead th:first-child { border-radius: 10px 0 0 10px; }
        .table thead th:last-child  { border-radius: 0 10px 10px 0; }
        .table tbody tr { transition: all 0.25s ease; animation: rowFadeIn 0.4s ease forwards; }
        .table tbody tr:hover { background: var(--hover-bg); transform: translateX(3px); }
        .table tbody td {
            padding: 11px 13px; vertical-align: middle;
            border: none; border-bottom: 1px solid var(--border);
            color: var(--text-primary); font-size: 0.85rem;
            transition: color 0.3s, border-color 0.3s;
        }

        /* ── Badges — semantic, not theme-tied ── */
        .badge-high   { background: rgba(239,68,68,0.12);  color: var(--color-danger);  border-radius: 18px; padding: 3px 10px; font-size: 0.7rem; font-weight: 800; white-space: nowrap; }
        .badge-medium { background: rgba(245,158,11,0.12); color: var(--color-warning); border-radius: 18px; padding: 3px 10px; font-size: 0.7rem; font-weight: 800; white-space: nowrap; }
        .badge-low    { background: rgba(16,185,129,0.12); color: var(--color-success); border-radius: 18px; padding: 3px 10px; font-size: 0.7rem; font-weight: 800; white-space: nowrap; }

        /* ── Action Buttons ── */
        .btn-edit    { background: rgba(var(--primary-rgb),0.10); color: var(--primary);       border: none; border-radius: 8px; padding: 4px 10px; font-size: 0.72rem; font-weight: 800; transition: all 0.2s; }
        .btn-edit:hover    { background: var(--primary); color: white; transform: scale(1.05); }
        .btn-remove  { background: rgba(239,68,68,0.10);  color: var(--color-danger);  border: none; border-radius: 8px; padding: 4px 10px; font-size: 0.72rem; font-weight: 800; transition: all 0.2s; }
        .btn-remove:hover  { background: var(--color-danger);  color: white; transform: scale(1.05); }
        .btn-restore { background: rgba(16,185,129,0.10); color: var(--color-success); border: none; border-radius: 8px; padding: 4px 10px; font-size: 0.72rem; font-weight: 800; transition: all 0.2s; }
        .btn-restore:hover { background: var(--color-success); color: white; }
        .btn-force   { background: rgba(107,114,128,0.10); color: #6b7280; border: none; border-radius: 8px; padding: 4px 10px; font-size: 0.72rem; font-weight: 800; transition: all 0.2s; }
        .btn-force:hover   { background: #374151; color: white; }

        /* ── Status Select ── */
        .status-select {
            border: 1.5px solid var(--border);
            border-radius: 9px; padding: 3px 7px;
            font-size: 0.72rem; font-weight: 700;
            background: var(--bg-surface);
            color: var(--text-primary); cursor: pointer; transition: all 0.2s;
        }
        .status-select:focus { outline: none; border-color: var(--primary); }

        /* ── Modals ── */
        .modal-content {
            border: none; border-radius: 22px; overflow: hidden;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
        }
        .modal-header-custom { background: var(--primary); padding: 18px 22px; }
        .modal-header-custom h5 { color: white; font-weight: 800; margin: 0; font-size: 0.95rem; }
        .modal-header-custom .btn-close { filter: brightness(0) invert(1); }
        .form-control, .form-select {
            border-radius: 11px;
            border: 2px solid var(--border-strong);
            padding: 9px 12px;
            background: var(--bg-elevated);
            color: var(--text-primary);
            font-weight: 600; font-size: 0.86rem; transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb),0.14);
            background: var(--bg-elevated);
            color: var(--text-primary);
        }
        .form-label { font-weight: 800; color: var(--primary); font-size: 0.8rem; margin-bottom: 5px; }
        .btn-submit {
            background: var(--primary); color: white;
            border: none; border-radius: 12px; padding: 11px 26px;
            font-weight: 800; font-size: 0.88rem; transition: all 0.3s;
        }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-2px); color: white; }

        /* ── Alert ── */
        .alert-custom {
            background: var(--glass); backdrop-filter: blur(10px);
            border: none; border-left: 4px solid var(--primary);
            border-radius: 12px; color: var(--text-primary);
            font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            font-size: 0.86rem;
        }

        /* ── Notification Popup ── */
        .notif-popup {
            position: fixed; top: 20px; right: 20px; z-index: 9999;
            display: flex; flex-direction: column; gap: 10px; pointer-events: none;
        }
        .notif-item {
            background: var(--bg-elevated);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 16px; padding: 14px 18px;
            box-shadow: var(--shadow-md);
            pointer-events: all; min-width: 280px; max-width: 340px;
            animation: slideInRight 0.4s cubic-bezier(0.34,1.56,0.64,1);
            border-left: 4px solid var(--primary);
        }
        .notif-item.removing { animation: slideOutRight 0.3s ease forwards; }
        .notif-title  { font-weight: 800; font-size: 0.85rem; color: var(--text-primary); display: flex; align-items: center; gap: 8px; }
        .notif-body   { font-size: 0.78rem; color: var(--text-muted); margin-top: 4px; font-weight: 600; }
        .notif-close  { background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 0.9rem; margin-left: auto; flex-shrink: 0; }

        /* ── Date Popup ── */
        .date-popup {
            position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%);
            background: var(--bg-elevated);
            backdrop-filter: blur(16px); border-radius: 20px; padding: 20px;
            box-shadow: var(--shadow-lg); z-index: 9999;
            min-width: 290px; max-width: 380px;
            border: 1px solid var(--border); display: none;
            animation: popIn 0.35s cubic-bezier(0.34,1.56,0.64,1);
        }
        .date-popup.show { display: block; }
        .date-popup-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.35);
            z-index: 9998; display: none; backdrop-filter: blur(2px);
        }
        .date-popup-overlay.show { display: block; }
        .date-popup-title { font-weight: 900; color: var(--primary); font-size: 0.95rem; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; }
        .date-popup-close { background: none; border: none; color: var(--text-muted); font-size: 1rem; cursor: pointer; }
        .date-task-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px; border-radius: 12px;
            background: var(--hover-bg); margin-bottom: 7px;
            cursor: pointer; transition: all 0.2s;
        }
        .date-task-item:hover { transform: translateX(4px); box-shadow: var(--shadow-sm); }
        .date-task-dot  { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
        .date-task-name { font-weight: 700; font-size: 0.83rem; color: var(--text-primary); }
        .date-task-meta { font-size: 0.7rem; color: var(--text-muted); font-weight: 600; }

        /* ── BG Settings Panel ── */
        .bg-panel {
            position: fixed; right: -320px; top: 50%; transform: translateY(-50%);
            width: 300px; background: var(--bg-elevated);
            backdrop-filter: blur(20px); border-radius: 20px 0 0 20px;
            padding: 20px; box-shadow: var(--shadow-lg);
            z-index: 500; border: 1px solid var(--border);
            border-right: none; transition: right 0.4s cubic-bezier(0.34,1.56,0.64,1);
        }
        .bg-panel.open { right: 0; }
        .bg-panel-toggle {
            position: fixed; right: 0; top: 50%; transform: translateY(-50%);
            background: var(--primary); color: white; border: none;
            border-radius: 10px 0 0 10px; padding: 12px 8px; cursor: pointer;
            z-index: 501; font-size: 0.9rem; transition: all 0.3s;
            box-shadow: -4px 0 12px rgba(var(--primary-rgb),0.35);
        }
        .bg-panel-toggle:hover { padding-right: 12px; }
        .bg-panel-title { font-weight: 900; color: var(--text-primary); font-size: 0.95rem; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; }
        .bg-panel-close { background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1rem; }
        .preset-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 8px; margin-bottom: 12px; }
        .preset-item { height: 50px; border-radius: 10px; cursor: pointer; border: 3px solid transparent; transition: all 0.3s; }
        .preset-item:hover { transform: scale(1.05); }
        .preset-item.active { border-color: var(--primary); }
        .slider-label { font-size: 0.78rem; font-weight: 700; color: var(--text-primary); margin-bottom: 5px; display: flex; justify-content: space-between; }
        .opacity-slider { width: 100%; accent-color: var(--primary); }

        /* ── Empty State ── */
        .empty-state { text-align: center; padding: 35px 20px; }
        .empty-state i { font-size: 2.8rem; color: var(--border-strong); margin-bottom: 10px; animation: float 3s ease-in-out infinite; display: block; }
        .empty-state p { color: var(--text-muted); font-weight: 700; font-size: 0.88rem; margin: 0; }

        /* ====================================================
           FULL CALENDAR
           ==================================================== */
        @keyframes fadeSlideIn { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        .fullcal-day {
            min-height: 72px; border-radius: 10px; padding: 6px;
            cursor: pointer; border: 2px solid transparent;
            transition: all 0.18s ease;
            background: var(--hover-bg); position: relative;
        }
        .fullcal-day:hover { background: var(--primary-light); border-color: var(--primary); }
        [data-theme="dark"] .fullcal-day { background: var(--hover-bg); }
        [data-theme="dark"] .fullcal-day:hover { background: var(--active-bg); border-color: var(--primary); }
        .fullcal-day.today { background: var(--primary); color: white; font-weight: 800; }
        .fullcal-day.selected { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(var(--primary-rgb),0.2); }
        .fullcal-day.other-month { opacity: 0.3; }
        .fullcal-task-chip {
            font-size: 10px; background: rgba(var(--primary-rgb),0.12); color: var(--primary);
            border-radius: 4px; padding: 1px 4px; margin-top: 2px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;
        }
        .fullcal-day.today .fullcal-task-chip { background: rgba(255,255,255,0.25); color: white; }

        /* ====================================================
           ANIMATIONS
           ==================================================== */
        @keyframes heartbeat   { 0%,100%{transform:scale(1)} 50%{transform:scale(1.2)} }
        @keyframes float       { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        @keyframes fadeInUp    { from{opacity:0;transform:translateY(15px)} to{opacity:1;transform:translateY(0)} }
        @keyframes rowFadeIn   { from{opacity:0;transform:translateX(-10px)} to{opacity:1;transform:translateX(0)} }
        @keyframes slideInRight{ from{opacity:0;transform:translateX(60px)} to{opacity:1;transform:translateX(0)} }
        @keyframes slideOutRight{ from{opacity:1;transform:translateX(0)} to{opacity:0;transform:translateX(60px)} }
        @keyframes popIn       { from{opacity:0;transform:translate(-50%,-50%) scale(0.8)} to{opacity:1;transform:translate(-50%,-50%) scale(1)} }
        @keyframes fall        { to{transform:translateY(100vh) rotate(360deg);opacity:0} }
        @keyframes pulse       { 0%,100%{box-shadow:0 0 0 0 rgba(var(--primary-rgb),0.4)} 50%{box-shadow:0 0 0 8px rgba(var(--primary-rgb),0)} }
        .fade-in { animation: fadeInUp 0.4s ease forwards; }

        .confetti-container { position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:9999; }

        /* ====================================================
           RESPONSIVE
           ==================================================== */
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; padding: 14px; }
            .deadline-cards { grid-template-columns: repeat(3,1fr); }
            .bg-panel { width: 260px; }
        }

        /* ====================================================
           EXPANDED CALENDAR OVERLAY
           ==================================================== */
        #fullcal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 270px; right: 0; bottom: 0;
            background: var(--bg-main);
            z-index: 200;
            overflow-y: auto;
            padding: 28px 28px 40px;
        }
        #fullcal-overlay.open {
            display: block;
            animation: fcalSlideIn 0.38s cubic-bezier(0.34,1.30,0.64,1) both;
        }
        @keyframes fcalSlideIn {
            from { opacity: 0; transform: translateY(22px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .fcal-header-bar {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 22px; flex-wrap: wrap; gap: 12px;
        }
        .fcal-title { font-size: 1.5rem; font-weight: 900; color: var(--text-primary); }
        .fcal-title span { color: var(--primary); }
        .fcal-nav-row { display: flex; align-items: center; gap: 14px; }
        .fcal-nav-btn {
            background: var(--bg-surface); border: 2px solid var(--border);
            border-radius: 12px; width: 40px; height: 40px; cursor: pointer;
            font-size: 0.88rem; color: var(--primary); transition: all 0.2s;
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm);
        }
        .fcal-nav-btn:hover { background: var(--primary); color: white; border-color: var(--primary); transform: scale(1.08); }
        .fcal-month-label { font-size: 1.15rem; font-weight: 900; color: var(--text-primary); min-width: 200px; text-align: center; }
        .fcal-exit-btn {
            background: var(--bg-surface); border: 2px solid var(--border);
            border-radius: 12px; padding: 9px 18px; font-size: 0.82rem;
            font-weight: 800; color: var(--text-secondary); cursor: pointer; transition: all 0.2s;
        }
        .fcal-exit-btn:hover { background: var(--color-danger); color: white; border-color: var(--color-danger); }
        .fcal-body { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }
        @media (max-width: 900px) { #fullcal-overlay { left: 0; } .fcal-body { grid-template-columns: 1fr; } }
        .fcal-grid-wrap {
            background: var(--bg-surface); border-radius: 20px; padding: 20px;
            border: 1px solid var(--border); box-shadow: var(--shadow-sm);
        }
        .fcal-day-headers { display: grid; grid-template-columns: repeat(7,1fr); gap: 6px; margin-bottom: 8px; }
        .fcal-day-hdr {
            text-align: center; font-size: 0.72rem; font-weight: 800; color: var(--primary);
            text-transform: uppercase; letter-spacing: 0.5px; padding: 6px 0;
        }
        #fullcal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 6px; }
        .fullcal-day {
            min-height: 80px; border-radius: 12px; padding: 8px 7px;
            cursor: pointer; border: 2px solid transparent; transition: all 0.18s ease;
            background: var(--hover-bg); position: relative; overflow: hidden;
        }
        .fullcal-day:hover { background: var(--primary-light); border-color: var(--primary); transform: translateY(-2px); box-shadow: var(--shadow-sm); }
        .fullcal-day.today { background: var(--primary); color: white; font-weight: 800; box-shadow: 0 6px 20px rgba(var(--primary-rgb),0.4); }
        .fullcal-day.selected { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(var(--primary-rgb),0.22); }
        .fullcal-day.other-month { opacity: 0.28; pointer-events: none; }
        .fullcal-day-num { font-size: 0.82rem; font-weight: 800; margin-bottom: 4px; color: inherit; }
        .fullcal-task-chip {
            font-size: 0.63rem; background: rgba(var(--primary-rgb),0.13); color: var(--primary);
            border-radius: 5px; padding: 2px 5px; margin-top: 2px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            display: block; font-weight: 700;
        }
        .fullcal-day.today .fullcal-task-chip { background: rgba(255,255,255,0.25); color: white; }
        .fcal-side-panel { position: sticky; top: 20px; }
        .fcal-tasks-box {
            background: var(--bg-surface); border-radius: 20px; padding: 20px;
            border: 1px solid var(--border); box-shadow: var(--shadow-sm); margin-bottom: 16px;
        }
        .fcal-tasks-label { font-size: 0.88rem; font-weight: 900; color: var(--text-primary); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .fcal-task-row {
            display: flex; align-items: center; gap: 10px; padding: 10px 12px;
            margin-bottom: 7px; background: var(--hover-bg); border-radius: 12px;
            border-left: 4px solid #888; transition: all 0.18s;
            animation: rowFadeIn 0.3s ease forwards;
        }
        .fcal-task-row:hover { transform: translateX(3px); box-shadow: var(--shadow-sm); }
        .fcal-task-name { font-size: 0.83rem; font-weight: 700; color: var(--text-primary); flex: 1; }
        .fcal-task-badge { font-size: 0.68rem; font-weight: 800; padding: 2px 9px; border-radius: 20px; white-space: nowrap; }
        .fcal-stat-chips { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .fcal-stat-chip { background: var(--bg-surface); border-radius: 14px; padding: 14px; text-align: center; border: 1px solid var(--border); box-shadow: var(--shadow-sm); }
        .fcal-stat-num { font-size: 1.6rem; font-weight: 900; color: var(--primary); }
        .fcal-stat-lbl { font-size: 0.68rem; font-weight: 700; color: var(--text-muted); margin-top: 2px; }

    </style>
</head>
<body>
<div class="bg-layer" id="bgLayer"></div>
<div class="bg-overlay" id="bgOverlay"></div>

<div class="app-wrapper">
    {{-- ===== SIDEBAR ===== --}}
    <div class="sidebar">
        <div class="sidebar-brand"><i class="fas fa-heart"></i> TodoORM 🌸</div>

        <div class="sidebar-clock">
            <div class="s-time" id="clock-time">00:00:00</div>
            <div class="s-date" id="clock-date"></div>
        </div>

        <div class="date-strip" id="date-strip"></div>
        
        <div class="mini-calendar">
            <div class="cal-header">
                <button class="cal-nav" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                <span id="cal-month-year"></span>
                <button class="cal-nav" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="cal-grid" id="cal-grid"></div>
        </div>

        <div style="text-align:center; margin-top: 8px;">
            <button id="expand-cal-btn" onclick="toggleExpandedCalendar()"
                style="background: rgba(255,255,255,0.3); border: none; border-radius: 20px; padding: 5px 14px; color: white; font-size: 12px; cursor: pointer; font-weight: 600; transition: background 0.2s;">
                📅 View Full Calendar
            </button>
        </div>

        <div class="theme-switcher">
            <div class="theme-label">🎨 Theme</div>
            <button class="theme-btn" data-theme="pink"     title="Pink Blossom" onclick="setTheme('pink')"></button>
            <button class="theme-btn" data-theme="blue"     title="Ocean"        onclick="setTheme('blue')"></button>
            <button class="theme-btn" data-theme="forest"   title="Forest"       onclick="setTheme('forest')"></button>
            <button class="theme-btn" data-theme="rosegold" title="Rose Gold"    onclick="setTheme('rosegold')"></button>
        </div>

        <div class="sidebar-nav" id="sidebar-nav">
            <button class="sidebar-nav-item active" onclick="switchTab('home',this)">
                <i class="fas fa-home"></i> Dashboard
                <span class="nav-count" id="cnt-all">{{ $tasks->count() }}</span>
            </button>
            <button class="sidebar-nav-item" onclick="switchTab('todo',this)">
                <i class="fas fa-list"></i> To Do
                <span class="nav-count" id="cnt-todo">{{ $tasks->where('status','To Do')->count() }}</span>
            </button>
            <button class="sidebar-nav-item" onclick="switchTab('inprogress',this)">
                <i class="fas fa-spinner"></i> In Progress
                <span class="nav-count" id="cnt-prog">{{ $tasks->where('status','In Progress')->count() }}</span>
            </button>
            <button class="sidebar-nav-item" onclick="switchTab('completed',this)">
                <i class="fas fa-check-circle"></i> Completed
                <span class="nav-count" id="cnt-comp">{{ $tasks->where('status','Completed')->count() }}</span>
            </button>
            <button class="sidebar-nav-item" onclick="switchTab('manage',this)">
                <i class="fas fa-cogs"></i> Manage Lists
            </button>
            <button class="sidebar-nav-item" onclick="switchTab('trash',this)">
                <i class="fas fa-archive"></i> Archive
                <span class="nav-count" id="cnt-trash">{{ $trashedTasks->count() }}</span>
            </button>
        </div>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout btn"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
            </form>
        </div>
    </div>

    {{-- ===== MAIN ===== --}}
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-custom alert-dismissible fade show fade-in mb-3">
                <i class="fas fa-check-circle me-2" style="color:var(--primary)"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

        {{-- ===== EXPANDED FULL CALENDAR OVERLAY ===== --}}
<div id="fullcal-overlay">
    <div class="fcal-header-bar">
        <div>
            <div class="fcal-title">📅 Full <span>Calendar</span></div>
            <div style="font-size:0.78rem;color:var(--text-muted);font-weight:600;margin-top:2px;">Click any date to see tasks due</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <div class="fcal-nav-row">
                <button class="fcal-nav-btn" onclick="fullCalPrev()"><i class="fas fa-chevron-left"></i></button>
                <div class="fcal-month-label" id="fullcal-month-label">Loading…</div>
                <button class="fcal-nav-btn" onclick="fullCalNext()"><i class="fas fa-chevron-right"></i></button>
            </div>
            <button class="fcal-exit-btn" onclick="collapseExpandedCalendar()">
                <i class="fas fa-compress-alt me-1"></i> Exit Calendar
            </button>
        </div>
    </div>
    <div class="fcal-body">
        <div class="fcal-grid-wrap">
            <div class="fcal-day-headers">
                <div class="fcal-day-hdr">Mon</div><div class="fcal-day-hdr">Tue</div>
                <div class="fcal-day-hdr">Wed</div><div class="fcal-day-hdr">Thu</div>
                <div class="fcal-day-hdr">Fri</div><div class="fcal-day-hdr">Sat</div>
                <div class="fcal-day-hdr">Sun</div>
            </div>
            <div id="fullcal-grid"></div>
        </div>
        <div class="fcal-side-panel">
            <div class="fcal-tasks-box" id="fullcal-tasks-section" style="display:none;">
                <div class="fcal-tasks-label" id="fullcal-tasks-label">
                    <i class="fas fa-calendar-day" style="color:var(--primary)"></i> Select a date
                </div>
                <div id="fullcal-tasks-list">
                    <p style="color:var(--text-muted);font-size:0.83rem;font-weight:600;">Click a date on the calendar.</p>
                </div>
            </div>
            <div class="fcal-stat-chips">
                <div class="fcal-stat-chip">
                    <div class="fcal-stat-num" style="color:#ef4444;">{{ $stats['overdue'] ?? 0 }}</div>
                    <div class="fcal-stat-lbl">Overdue</div>
                </div>
                <div class="fcal-stat-chip">
                    <div class="fcal-stat-num" style="color:#f59e0b;">{{ $stats['dueToday'] ?? 0 }}</div>
                    <div class="fcal-stat-lbl">Due Today</div>
                </div>
                <div class="fcal-stat-chip">
                    <div class="fcal-stat-num" style="color:#10b981;">{{ $stats['completed'] ?? 0 }}</div>
                    <div class="fcal-stat-lbl">Completed</div>
                </div>
                <div class="fcal-stat-chip">
                    <div class="fcal-stat-num">{{ $stats['all'] ?? 0 }}</div>
                    <div class="fcal-stat-lbl">All Tasks</div>
                </div>
            </div>
            <div style="background:var(--bg-surface);border-radius:16px;padding:16px;border:1px solid var(--border);margin-top:14px;">
                <div style="font-size:0.78rem;font-weight:800;color:var(--text-primary);margin-bottom:10px;">Legend</div>
                <div style="display:flex;flex-direction:column;gap:7px;">
                    <div style="display:flex;align-items:center;gap:8px;"><div style="width:10px;height:10px;border-radius:50%;background:#ef4444;flex-shrink:0;"></div><span style="font-size:0.75rem;font-weight:700;color:var(--text-secondary);">Overdue tasks</span></div>
                    <div style="display:flex;align-items:center;gap:8px;"><div style="width:10px;height:10px;border-radius:50%;background:#f59e0b;flex-shrink:0;"></div><span style="font-size:0.75rem;font-weight:700;color:var(--text-secondary);">Upcoming / due soon</span></div>
                    <div style="display:flex;align-items:center;gap:8px;"><div style="width:10px;height:10px;border-radius:50%;background:#10b981;flex-shrink:0;"></div><span style="font-size:0.75rem;font-weight:700;color:var(--text-secondary);">All tasks completed</span></div>
                    <div style="display:flex;align-items:center;gap:8px;"><div style="width:10px;height:10px;border-radius:2px;background:var(--primary);flex-shrink:0;"></div><span style="font-size:0.75rem;font-weight:700;color:var(--text-secondary);">Today</span></div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- BG SETTINGS TOGGLE --}}
<button class="bg-panel-toggle" onclick="toggleBgPanel()" title="Background Settings">
    <i class="fas fa-image"></i>
</button>

{{-- BG SETTINGS PANEL --}}
<div class="bg-panel" id="bgPanel">
    <div class="bg-panel-title">
        🖼️ Background
        <button class="bg-panel-close" onclick="toggleBgPanel()"><i class="fas fa-times"></i></button>
    </div>

    <div style="font-size:0.75rem;font-weight:800;color:var(--text-primary);margin-bottom:8px;">Preset Wallpapers</div>
    <div class="preset-grid" id="presetGrid">
        <div class="preset-item" style="background:linear-gradient(135deg,#ffe4f0,#fdf0f8)" data-preset="default"   onclick="setPreset('default',this)"   title="Default"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#667eea,#764ba2)"  data-preset="purple"   onclick="setPreset('purple',this)"    title="Purple"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#f093fb,#f5576c)"  data-preset="sunset"   onclick="setPreset('sunset',this)"    title="Sunset"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"  data-preset="ocean"    onclick="setPreset('ocean',this)"     title="Ocean"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#43e97b,#38f9d7)"  data-preset="nature"   onclick="setPreset('nature',this)"    title="Nature"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#fa709a,#fee140)"  data-preset="candy"    onclick="setPreset('candy',this)"     title="Candy"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#0f0c29,#302b63,#24243e)" data-preset="midnight" onclick="setPreset('midnight',this)" title="Midnight"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#ff9a9e,#fecfef)"  data-preset="blossom"  onclick="setPreset('blossom',this)"   title="Blossom"></div>
        <div class="preset-item" style="background:linear-gradient(135deg,#a18cd1,#fbc2eb)"  data-preset="lavender" onclick="setPreset('lavender',this)"  title="Lavender"></div>
    </div>

    <div style="font-size:0.75rem;font-weight:800;color:var(--text-primary);margin-bottom:8px;">Upload Custom Image</div>
    <input type="file" id="bgUpload" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="handleBgUpload(event)">
    <div style="display:flex;gap:6px;margin-bottom:12px;">
        <button onclick="document.getElementById('bgUpload').click()" style="background:var(--primary);color:white;border:none;border-radius:9px;padding:7px 12px;font-size:0.75rem;font-weight:800;cursor:pointer;flex:1;transition:all 0.3s;">
            <i class="fas fa-upload me-1"></i>Upload
        </button>
        <button onclick="resetBackground()" style="background:var(--border);color:var(--text-primary);border:none;border-radius:9px;padding:7px 12px;font-size:0.75rem;font-weight:800;cursor:pointer;transition:all 0.3s;">
            <i class="fas fa-undo"></i>
        </button>
    </div>

    <div>
        <div class="slider-label"><span>Overlay Opacity</span><span id="opacityVal">30%</span></div>
        <input type="range" class="opacity-slider" id="opacitySlider" min="0" max="70" value="30" oninput="updateOverlay(this.value)">
    </div>

    <div style="margin-top:10px;">
        <div class="slider-label"><span>Blur Effect</span></div>
        <div style="display:flex;gap:6px;margin-top:4px;">
            <button onclick="setBlur(0)"  style="background:var(--primary-light);color:var(--primary);border:none;border-radius:7px;padding:5px 10px;font-size:0.72rem;font-weight:800;cursor:pointer;flex:1;">None</button>
            <button onclick="setBlur(4)"  style="background:var(--primary-light);color:var(--primary);border:none;border-radius:7px;padding:5px 10px;font-size:0.72rem;font-weight:800;cursor:pointer;flex:1;">Light</button>
            <button onclick="setBlur(10)" style="background:var(--primary-light);color:var(--primary);border:none;border-radius:7px;padding:5px 10px;font-size:0.72rem;font-weight:800;cursor:pointer;flex:1;">Blur</button>
        </div>
    </div>
</div>

{{-- DATE POPUP --}}
<div class="date-popup-overlay" id="datePopupOverlay" onclick="closeDatePopup()"></div>
<div class="date-popup" id="datePopup">
    <div class="date-popup-title">
        <span id="datePopupTitle"></span>
        <button class="date-popup-close" onclick="closeDatePopup()"><i class="fas fa-times"></i></button>
    </div>
    <div id="datePopupContent"></div>
</div>

{{-- NOTIFICATION CONTAINER --}}
<div class="notif-popup" id="notifContainer"></div>

<div class="confetti-container" id="confetti-container"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ====== DATA ======
    const calendarTasksData = @json(isset($calendarTasks) ? $calendarTasks : []);
    const allTasksData      = @json(isset($tasks) ? $tasks->values() : []);
    const today = new Date();
    today.setHours(0,0,0,0);

    // ====== CLOCK ======
    function updateClock() {
        const now = new Date();
        const pad = n => String(n).padStart(2,'0');
        document.getElementById('clock-time').textContent =
            `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
        const days   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        document.getElementById('clock-date').textContent =
            `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()} ${now.getFullYear()}`;
    }
    updateClock(); setInterval(updateClock, 1000);

    // ====== MINI CALENDAR ======
    let calDate = new Date();
    function buildCalendar() {
        const months     = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        const dayHeaders = ['Mo','Tu','We','Th','Fr','Sa','Su'];
        document.getElementById('cal-month-year').textContent = `${months[calDate.getMonth()]} ${calDate.getFullYear()}`;
        const grid = document.getElementById('cal-grid');
        grid.innerHTML = '';
        dayHeaders.forEach(d => {
            const el = document.createElement('div');
            el.className = 'cal-day-header'; el.textContent = d; grid.appendChild(el);
        });
        let startDay = new Date(calDate.getFullYear(), calDate.getMonth(), 1).getDay() - 1;
        if (startDay < 0) startDay = 6;
        const daysInMonth = new Date(calDate.getFullYear(), calDate.getMonth() + 1, 0).getDate();
        const prevDays    = new Date(calDate.getFullYear(), calDate.getMonth(), 0).getDate();

        for (let i = startDay - 1; i >= 0; i--) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month'; el.textContent = prevDays - i; grid.appendChild(el);
        }
        for (let i = 1; i <= daysInMonth; i++) {
            const el    = document.createElement('div');
            const month = String(calDate.getMonth() + 1).padStart(2,'0');
            const day   = String(i).padStart(2,'0');
            const dateStr    = `${calDate.getFullYear()}-${month}-${day}`;
            const tasksOnDay = calendarTasksData[dateStr] || [];
            const d = new Date(calDate.getFullYear(), calDate.getMonth(), i);
            d.setHours(0,0,0,0);
            const isToday = d.getTime() === today.getTime();
            let cls = 'cal-day';
            if (isToday) cls += ' today';
            if (tasksOnDay.length > 0) {
                const allDone   = tasksOnDay.every(t => t.status === 'Completed');
                const anyOverdue = tasksOnDay.some(t => t.status !== 'Completed') && d < today;
                if (allDone) cls += ' done-day';
                else if (anyOverdue) cls += ' overdue-day';
                else cls += ' upcoming-day';
                el.title = `${tasksOnDay.length} task(s): ${tasksOnDay.map(t => t.task_name).join(', ')}`;
            }
            el.className = cls; el.textContent = i; el.style.position = 'relative';
            el.onclick = function() {
                document.querySelectorAll('.cal-day').forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
                if (tasksOnDay.length > 0) showDatePopup(dateStr, tasksOnDay);
            };
            grid.appendChild(el);
        }
        const total = startDay + daysInMonth;
        const rem   = total % 7 === 0 ? 0 : 7 - (total % 7);
        for (let i = 1; i <= rem; i++) {
            const el = document.createElement('div');
            el.className = 'cal-day other-month'; el.textContent = i; grid.appendChild(el);
        }
    }
    function changeMonth(dir) { calDate.setMonth(calDate.getMonth() + dir); buildCalendar(); }
    buildCalendar();

    // ====== DATE POPUP ======
    const pColors = { High:'#ef4444', Medium:'#f59e0b', Low:'#10b981' };
    const sColors = { 'To Do':'#f59e0b', 'In Progress':'#a855f7', 'Completed':'#10b981' };
    function showDatePopup(dateStr, tasks) {
        const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const d = new Date(dateStr + 'T00:00:00');
        document.getElementById('datePopupTitle').textContent =
            `📅 ${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()} — ${tasks.length} task(s)`;
        const content = document.getElementById('datePopupContent');
        content.innerHTML = '';
        tasks.forEach(task => {
            const item = document.createElement('div');
            item.className = 'date-task-item';
            item.innerHTML = `
                <div class="date-task-dot" style="background:${pColors[task.priority]||'#888'}"></div>
                <div style="flex:1">
                    <div class="date-task-name">${task.task_name}</div>
                    <div class="date-task-meta">${task.priority} • ${task.status}</div>
                </div>
                <span style="font-size:0.68rem;font-weight:800;color:${sColors[task.status]||'#888'};background:${sColors[task.status]||'#888'}20;padding:2px 8px;border-radius:9px;">${task.status}</span>`;
            content.appendChild(item);
        });
        document.getElementById('datePopup').classList.add('show');
        document.getElementById('datePopupOverlay').classList.add('show');
    }
    function closeDatePopup() {
        document.getElementById('datePopup').classList.remove('show');
        document.getElementById('datePopupOverlay').classList.remove('show');
    }

    // ====== TAB SWITCHING ======
    function switchTab(tabId, btn) {
        collapseExpandedCalendar();
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show','active'));
        const target = document.getElementById(tabId);
        if (target) target.classList.add('show','active');
        document.querySelectorAll('.sidebar-nav-item').forEach(i => i.classList.remove('active'));
        if (btn) btn.classList.add('active');
        document.querySelectorAll('.dl-card').forEach(c => c.classList.remove('active-filter'));
    }

    // ====== EXPANDED CALENDAR ======
let lastActiveTab = 'home'; // track last active tab
let lastActiveBtn = null;

function toggleExpandedCalendar() {
    const overlay = document.getElementById('fullcal-overlay');
    if (!overlay) return;
    const isOpen = overlay.classList.contains('open');
    if (isOpen) {
        collapseExpandedCalendar();
    } else {
        // Save current active tab before opening calendar
        const activeBtn = document.querySelector('.sidebar-nav-item.active');
        if (activeBtn) lastActiveBtn = activeBtn;
        const activePane = document.querySelector('.tab-pane.show.active');
        if (activePane) lastActiveTab = activePane.id;

        document.querySelectorAll('.sidebar-nav-item').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show','active'));
        overlay.classList.add('open');
        const btn = document.getElementById('expand-cal-btn');
        if (btn) btn.textContent = '✕ Exit Calendar';
        initFullCalendar();
    }
}

function collapseExpandedCalendar() {
    const overlay = document.getElementById('fullcal-overlay');
    if (overlay) overlay.classList.remove('open');
    const btn = document.getElementById('expand-cal-btn');
    if (btn) btn.textContent = '📅 View Full Calendar';

    // Restore last active tab
    const target = document.getElementById(lastActiveTab);
    if (target) target.classList.add('show', 'active');
    if (lastActiveBtn) lastActiveBtn.classList.add('active');
    else {
        // fallback to Home
        const homeBtn = document.querySelector('.sidebar-nav-item');
        if (homeBtn) homeBtn.classList.add('active');
        const homePane = document.getElementById('home');
        if (homePane) homePane.classList.add('show', 'active');
    }
}

    // ====== DEADLINE FILTER ======
    function filterByDeadline(type, cardEl) {
        document.querySelectorAll('.dl-card').forEach(c => c.classList.remove('active-filter'));
        cardEl.classList.add('active-filter');
        document.querySelectorAll('.sidebar-nav-item').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show','active'));
        const target = document.getElementById('home');
        if (target) target.classList.add('show','active');
        const tbody = document.querySelector('#home .table tbody');
        if (!tbody) return;
        tbody.querySelectorAll('tr[data-deadline]').forEach(row => {
            const dl     = new Date(row.getAttribute('data-deadline') + 'T00:00:00');
            const status = row.getAttribute('data-status');
            const diff   = Math.ceil((dl - today) / 86400000);
            let show = false;
            if      (type === 'all')       show = true;
            else if (type === 'overdue')   show = dl < today && status !== 'Completed';
            else if (type === 'today')     show = diff === 0 && status !== 'Completed';
            else if (type === 'tomorrow')  show = diff === 1 && status !== 'Completed';
            else if (type === 'upcoming')  show = diff > 1 && diff <= 5 && status !== 'Completed';
            else if (type === 'completed') show = status === 'Completed';
            row.style.display = show ? '' : 'none';
        });
    }

    // ====== THEME ======
    function setTheme(theme) {
        const root = document.documentElement;
        root.style.transition = 'background 0.5s ease, color 0.4s ease';
        root.setAttribute('data-theme', theme);
        localStorage.setItem('todo-theme', theme);
        document.querySelectorAll('.theme-btn').forEach(b =>
            b.classList.toggle('active', b.getAttribute('data-theme') === theme)
        );
        const customBg = localStorage.getItem('todo-custom-bg');
        if (!customBg) {
            const bgLayer = document.getElementById('bgLayer');
            bgLayer.style.backgroundImage = '';
            bgLayer.style.background = '';
        }
        setTimeout(() => root.style.transition = '', 600);
    }

    // ====== BACKGROUND ======
    const presets = {
        default:  null,
        purple:   'linear-gradient(135deg,#667eea 0%,#764ba2 100%)',
        sunset:   'linear-gradient(135deg,#f093fb 0%,#f5576c 100%)',
        ocean:    'linear-gradient(135deg,#4facfe 0%,#00f2fe 100%)',
        nature:   'linear-gradient(135deg,#43e97b 0%,#38f9d7 100%)',
        candy:    'linear-gradient(135deg,#fa709a 0%,#fee140 100%)',
        midnight: 'linear-gradient(135deg,#0f0c29 0%,#302b63 50%,#24243e 100%)',
        blossom:  'linear-gradient(135deg,#ff9a9e 0%,#fecfef 100%)',
        lavender: 'linear-gradient(135deg,#a18cd1 0%,#fbc2eb 100%)',
    };

    function setPreset(name, el) {
        document.querySelectorAll('.preset-item').forEach(p => p.classList.remove('active'));
        el.classList.add('active');
        localStorage.setItem('todo-preset', name);
        localStorage.removeItem('todo-custom-bg');
        const bgLayer = document.getElementById('bgLayer');
        if (presets[name]) {
            bgLayer.style.cssText = `background:${presets[name]};opacity:1;transition:opacity 0.6s ease;`;
        } else {
            bgLayer.style.cssText = '';
        }
    }

    function handleBgUpload(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                const MAX = 1920;
                let w = img.width, h = img.height;
                if (w > MAX) { h = h * (MAX / w); w = MAX; }
                canvas.width = w; canvas.height = h;
                canvas.getContext('2d').drawImage(img, 0, 0, w, h);
                const compressed = canvas.toDataURL('image/jpeg', 0.75);
                try {
                    localStorage.setItem('todo-custom-bg', compressed);
                    applyCustomBg(compressed);
                    showNotif('✅ Background applied!', 'Your custom wallpaper is now set.', 'success');
                } catch(err) {
                    showNotif('⚠️ Image too large', 'Try a smaller image file.', 'warning');
                }
            };
            img.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    }

    function applyCustomBg(dataUrl) {
        const bgLayer = document.getElementById('bgLayer');
        bgLayer.style.cssText = `background-image:url(${dataUrl});background-size:cover;background-position:center;opacity:0;transition:opacity 0.6s ease;`;
        setTimeout(() => bgLayer.style.opacity = '1', 50);
        localStorage.removeItem('todo-preset');
        document.querySelectorAll('.preset-item').forEach(p => p.classList.remove('active'));
    }

    function resetBackground() {
        localStorage.removeItem('todo-custom-bg');
        localStorage.removeItem('todo-preset');
        document.getElementById('bgLayer').style.cssText = '';
        document.querySelectorAll('.preset-item').forEach(p => p.classList.remove('active'));
        document.querySelector('.preset-item[data-preset="default"]').classList.add('active');
    }

    function updateOverlay(val) {
        document.getElementById('opacityVal').textContent = val + '%';
        document.getElementById('bgOverlay').style.background = `rgba(0,0,0,${val / 100})`;
        localStorage.setItem('todo-overlay', val);
    }

    function setBlur(px) {
        document.getElementById('bgLayer').style.filter = px > 0 ? `blur(${px}px)` : '';
        localStorage.setItem('todo-blur', px);
    }

    function toggleBgPanel() { document.getElementById('bgPanel').classList.toggle('open'); }

    // ====== NOTIFICATIONS ======
    function showNotif(title, body, type = 'info') {
        const container = document.getElementById('notifContainer');
        const item = document.createElement('div');
        item.className = 'notif-item';
        const iconMap  = { info:'🔔', success:'✅', warning:'⚠️', deadline:'⏰' };
        const colorMap = { info:'var(--primary)', success:'#10b981', warning:'#f59e0b', deadline:'#ef4444' };
        item.style.borderLeftColor = colorMap[type] || 'var(--primary)';
        item.innerHTML = `
            <div class="notif-title">
                <span>${iconMap[type]||'🔔'} ${title}</span>
                <button class="notif-close" onclick="removeNotif(this.parentElement.parentElement)"><i class="fas fa-times"></i></button>
            </div>
            <div class="notif-body">${body}</div>`;
        container.appendChild(item);
        setTimeout(() => removeNotif(item), 6000);
    }

    function removeNotif(el) {
        el.classList.add('removing');
        setTimeout(() => el.remove(), 300);
    }

    function checkDeadlineReminders() {
        const tomorrow    = new Date(today); tomorrow.setDate(today.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];
        const todayStr    = today.toISOString().split('T')[0];
        const notified    = JSON.parse(localStorage.getItem('todo-notified') || '{}');

        allTasksData.forEach(task => {
            if (task.status === 'Completed') return;
            const key = `${task.id}-${task.deadline}`;
            if (notified[key]) return;
            if      (task.deadline === tomorrowStr) { showNotif('⏰ Due Tomorrow!', `"${task.task_name}" is due tomorrow (${task.deadline})`, 'deadline'); notified[key] = true; }
            else if (task.deadline === todayStr)    { showNotif('🔥 Due Today!',    `"${task.task_name}" is due today!`,                      'deadline'); notified[key] = true; }
            else if (task.deadline < todayStr)      { showNotif('🚨 Overdue!',      `"${task.task_name}" was due on ${task.deadline}`,          'warning');  notified[key] = true; }
        });
        localStorage.setItem('todo-notified', JSON.stringify(notified));

        if ('Notification' in window && Notification.permission === 'granted') {
            allTasksData.forEach(task => {
                if (task.status === 'Completed') return;
                const key = `browser-${task.id}-${task.deadline}`;
                if (notified[key] || task.deadline !== tomorrowStr) return;
                new Notification('TodoORM ⏰', { body: `"${task.task_name}" is due tomorrow!`, icon: '/favicon.ico' });
                notified[key] = true;
            });
            localStorage.setItem('todo-notified', JSON.stringify(notified));
        }
    }

    function requestNotifPermission() {
        if ('Notification' in window && Notification.permission === 'default') Notification.requestPermission();
    }

    // ====== QUICK STATUS ======
    function quickStatus(taskId, newStatus) {
    fetch(`{{ url('/tasks') }}/${taskId}/status`, {
            method: 'PATCH',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
            body: JSON.stringify({ status: newStatus })
        }).then(() => window.location.reload());
    }

    // ====== CONFETTI ======
    function launchConfetti() {
        const container = document.getElementById('confetti-container');
        const colors = ['#ff6b9d','#a855f7','#3b82f6','#34d399','#fbbf24','#f43f5e'];
        for (let i = 0; i < 100; i++) {
            const el = document.createElement('div');
            el.style.cssText = `position:absolute;width:${6+Math.random()*8}px;height:${6+Math.random()*8}px;border-radius:${Math.random()>.5?'50%':'3px'};background:${colors[Math.floor(Math.random()*colors.length)]};left:${Math.random()*100}%;top:-10px;animation:fall ${2+Math.random()*3}s linear forwards;`;
            container.appendChild(el);
            setTimeout(() => el.remove(), 5000);
        }
    }

    // ====== INIT ======
    (function init() {
        setTheme(localStorage.getItem('todo-theme') || 'pink');

        const customBg = localStorage.getItem('todo-custom-bg');
        if (customBg) {
            applyCustomBg(customBg);
        } else {
            const preset = localStorage.getItem('todo-preset');
            if (preset && presets[preset]) {
                document.getElementById('bgLayer').style.background = presets[preset];
                const el = document.querySelector(`.preset-item[data-preset="${preset}"]`);
                if (el) el.classList.add('active');
            } else {
                document.querySelector('.preset-item[data-preset="default"]').classList.add('active');
            }
        }

        const savedOpacity = localStorage.getItem('todo-overlay') || '30';
        document.getElementById('opacitySlider').value = savedOpacity;
        updateOverlay(savedOpacity);

        const savedBlur = localStorage.getItem('todo-blur') || '0';
        if (parseInt(savedBlur) > 0) setBlur(parseInt(savedBlur));

        requestNotifPermission();
        setTimeout(checkDeadlineReminders, 1500);

        const lastReset = localStorage.getItem('todo-notif-reset');
        const todayStr  = today.toISOString().split('T')[0];
        if (lastReset !== todayStr) {
            localStorage.removeItem('todo-notified');
            localStorage.setItem('todo-notif-reset', todayStr);
        }
    })();

    // ====== FULL CALENDAR ======
    let fullCalDate         = new Date();
    let fullCalSelectedDate = null;

    function initFullCalendar() { renderFullCalendar(fullCalDate); }
    function fullCalPrev() { fullCalDate.setMonth(fullCalDate.getMonth() - 1); renderFullCalendar(fullCalDate); }
    function fullCalNext() { fullCalDate.setMonth(fullCalDate.getMonth() + 1); renderFullCalendar(fullCalDate); }

    function renderFullCalendar(date) {
        const grid  = document.getElementById('fullcal-grid');
        const label = document.getElementById('fullcal-month-label');
        if (!grid || !label) return;
        const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        const year = date.getFullYear(), month = date.getMonth();
        label.textContent = `${months[month]} ${year}`;
        let firstDay = new Date(year, month, 1).getDay() - 1;
        if (firstDay < 0) firstDay = 6;
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevDays    = new Date(year, month, 0).getDate();
        grid.innerHTML = '';

        for (let i = firstDay - 1; i >= 0; i--) {
            const cell = document.createElement('div');
            cell.className = 'fullcal-day other-month';
            cell.innerHTML = `<div style="font-size:12px;font-weight:600;">${prevDays - i}</div>`;
            grid.appendChild(cell);
        }
        for (let i = 1; i <= daysInMonth; i++) {
            const m = String(month + 1).padStart(2,'0'), d = String(i).padStart(2,'0');
            const dateStr  = `${year}-${m}-${d}`;
            const cellDate = new Date(year, month, i);
            cellDate.setHours(0,0,0,0);
            const isToday    = cellDate.getTime() === today.getTime();
            const isSelected = fullCalSelectedDate && cellDate.toDateString() === fullCalSelectedDate.toDateString();
            const dayTasks   = calendarTasksData[dateStr] || [];
            const cell = document.createElement('div');
            let cls = 'fullcal-day';
            if (isToday)    cls += ' today';
            if (isSelected) cls += ' selected';
            cell.className = cls;
            let html = `<div style="font-size:12px;font-weight:700;margin-bottom:3px;">${i}</div>`;
            dayTasks.slice(0,3).forEach(t => { html += `<span class="fullcal-task-chip">${t.task_name}</span>`; });
            if (dayTasks.length > 3) html += `<span class="fullcal-task-chip">+${dayTasks.length - 3} more</span>`;
            cell.innerHTML = html;
            cell.onclick = () => selectFullCalDate(cellDate, dateStr, dayTasks);
            grid.appendChild(cell);
        }
        const filled = firstDay + daysInMonth;
        const rem    = filled % 7 === 0 ? 0 : 7 - (filled % 7);
        for (let i = 1; i <= rem; i++) {
            const cell = document.createElement('div');
            cell.className = 'fullcal-day other-month';
            cell.innerHTML = `<div style="font-size:12px;font-weight:600;">${i}</div>`;
            grid.appendChild(cell);
        }
    }

    function selectFullCalDate(cellDate, dateStr, tasks) {
        fullCalSelectedDate = cellDate;
        renderFullCalendar(fullCalDate);
        const section = document.getElementById('fullcal-tasks-section');
        const listEl  = document.getElementById('fullcal-tasks-list');
        const labelEl = document.getElementById('fullcal-tasks-label');
        const months  = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        labelEl.innerHTML = `<i class="fas fa-calendar-day" style="color:var(--primary)"></i> ${months[cellDate.getMonth()]} ${cellDate.getDate()}, ${cellDate.getFullYear()} <span style="font-size:0.72rem;color:var(--text-muted);font-weight:600;">(${tasks.length} task${tasks.length !== 1 ? 's' : ''})</span>`;
        if (tasks.length === 0) {
            listEl.innerHTML = `<div style="text-align:center;padding:24px 10px;"><div style="font-size:2rem;margin-bottom:8px;">🎉</div><div style="font-size:0.82rem;font-weight:700;color:var(--text-muted);">No tasks due on this date.</div></div>`;
        } else {
            listEl.innerHTML = tasks.map(t => `
                <div class="fcal-task-row" style="border-left-color:${pColors[t.priority]||'#888'}">
                    <div class="fcal-task-name">${t.task_name}</div>
                    <span class="fcal-task-badge" style="background:${pColors[t.priority]||'#888'}20;color:${pColors[t.priority]||'#888'}">${t.priority}</span>
                    <span class="fcal-task-badge" style="background:${sColors[t.status]||'#888'}20;color:${sColors[t.status]||'#888'}">${t.status}</span>
                </div>`).join('');
        }
        section.style.display = 'block';
    }
</script>
@stack('scripts')
</body>
</html>