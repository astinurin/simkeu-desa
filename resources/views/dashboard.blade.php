@extends('layouts.app')

@section('content')

    <style>
        /* ============================================================
       SIMKEU DESA — Dashboard Admin (konsisten dengan landing page)
       Font: Plus Jakarta Sans | Mobile-first responsive
    ============================================================ */

        :root {
            --blue: #1a56db;
            --blue-soft: #eff4ff;
            --blue-mid: #1e3a8a;
            --green: #0e9f6e;
            --green-soft: #f0fdf4;
            --red: #e02424;
            --red-soft: #fff5f5;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --radius: 14px;
            --shadow: 0 4px 20px rgba(0, 0, 0, .07), 0 1px 4px rgba(0, 0, 0, .04);
            --shadow-lg: 0 8px 28px rgba(0, 0, 0, .10), 0 2px 6px rgba(0, 0, 0, .05);
        }

        /* ── OVERRIDE SB ADMIN BODY ── */
        body {
            background: #f1f5f9 !important;
        }

        #content {
            padding-bottom: 32px;
        }

        .container-fluid {
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        @media (min-width: 768px) {
            .container-fluid {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        }

        /* ── HEADER CARD ── */
        .db-header {
            background: linear-gradient(140deg, #1e3a8a 0%, #1a56db 55%, #2563eb 100%);
            border-radius: var(--radius);
            padding: 22px 22px 22px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(26, 86, 219, .22);
            margin-bottom: 20px;
        }

        .db-header::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            top: -70px;
            right: -50px;
        }

        .db-header::after {
            content: '';
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            bottom: -40px;
            left: 42%;
        }

        .db-header .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            color: rgba(255, 255, 255, .92);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 3px 11px;
            border-radius: 100px;
            margin-bottom: 8px;
        }

        .db-header h1 {
            color: #fff;
            font-size: clamp(1.2rem, 3.5vw, 1.65rem);
            font-weight: 800;
            letter-spacing: -.02em;
            line-height: 1.25;
            margin-bottom: 4px;
        }

        .db-header .sub {
            color: rgba(255, 255, 255, .68);
            font-size: .8rem;
            font-weight: 500;
        }

        .db-header .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .db-header .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: none;
            cursor: pointer;
            font-size: .78rem;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 9px;
            transition: transform .15s, opacity .15s;
            text-decoration: none;
        }

        .db-header .btn-action:hover {
            transform: translateY(-1px);
            opacity: .9;
        }

        .db-header .btn-income {
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .3);
            color: #fff;
        }

        .db-header .btn-expense {
            background: #fff;
            color: var(--blue);
        }

        /* ── KPI CARDS ── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        @media (min-width: 576px) {
            .kpi-grid {
                gap: 12px;
            }
        }

        @media (min-width: 992px) {
            .kpi-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 16px;
            }
        }

        .kpi-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, .8);
            transition: transform .2s, box-shadow .2s;
            position: relative;
            overflow: hidden;
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 12px 0 0 12px;
        }

        .kpi-card.blue::after {
            background: var(--blue);
        }

        .kpi-card.green::after {
            background: var(--green);
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(0, 0, 0, .12);
        }

        .kpi-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
        }

        .kpi-icon.blue {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .kpi-icon.green {
            background: var(--green-soft);
            color: var(--green);
        }

        .kpi-label {
            font-size: .58rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--gray-400);
            margin-bottom: 2px;
        }

        .kpi-val {
            font-size: .8rem;
            font-weight: 800;
            color: var(--gray-800);
            line-height: 1.2;
        }

        .kpi-note {
            font-size: .62rem;
            color: var(--gray-400);
            margin-top: 1px;
        }

        /* ── SECTION CARD ── */
        .s-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            margin-bottom: 20px;
        }

        .s-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 16px 18px 14px;
            border-bottom: 1px solid var(--gray-100);
            flex-wrap: wrap;
        }

        .s-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
        }

        .s-icon.blue {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .s-icon.green {
            background: var(--green-soft);
            color: var(--green);
        }

        .s-title {
            font-size: .9rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        .s-sub {
            font-size: .68rem;
            color: var(--gray-400);
            margin: 0;
        }

        /* ── PROGRESS SECTION ── */
        .prog-section {
            padding: 16px 18px;
        }

        .prog-item {
            margin-bottom: 14px;
        }

        .prog-item:last-child {
            margin-bottom: 0;
        }

        .prog-lbl {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .75rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 6px;
        }

        .prog-lbl .pct-badge {
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .pct-hi {
            background: #dcfce7;
            color: #15803d;
        }

        .pct-mid {
            background: #fef9c3;
            color: #854d0e;
        }

        .pct-lo {
            background: #fee2e2;
            color: #b91c1c;
        }

        .progress {
            height: 8px;
            border-radius: 100px;
            background: var(--gray-200);
        }

        .progress-bar {
            border-radius: 100px;
        }

        /* ── SUMMARY CARDS (Pendapatan / Belanja ringkasan) ── */
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (min-width: 768px) {
            .summary-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .sum-card {
            border-radius: var(--radius);
            padding: 18px;
            border: 1px solid var(--gray-200);
        }

        .sum-card.blue {
            background: var(--blue-soft);
            border-color: #bfdbfe;
        }

        .sum-card.green {
            background: var(--green-soft);
            border-color: #a7f3d0;
        }

        .sum-pill-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 10px 0 12px;
        }

        .sum-pill {
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, .65);
            border-radius: 8px;
            padding: 6px 10px;
            flex: 1;
            min-width: 80px;
        }

        .sum-pill-lbl {
            font-size: .58rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .sum-pill.blue .sum-pill-lbl {
            color: var(--blue);
        }

        .sum-pill.green .sum-pill-lbl {
            color: var(--green);
        }

        .sum-pill-val {
            font-size: .74rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-top: 2px;
            white-space: nowrap;
        }

        /* ── CHARTS ── */
        .chart-card {
            padding: 16px 18px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr 2fr;
            }
        }

        /* ── ACCORDION TABLE ── */
        .acc-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            cursor: pointer;
            user-select: none;
            border-bottom: 1px solid transparent;
            transition: background .15s;
            border-radius: var(--radius);
        }

        .acc-head:hover {
            background: var(--gray-50);
        }

        .acc-head.open {
            border-radius: var(--radius) var(--radius) 0 0;
            border-bottom-color: var(--gray-100);
        }

        .acc-toggle {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            flex-shrink: 0;
            background: var(--gray-100);
            color: var(--gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            transition: transform .25s, background .2s;
        }

        .acc-head.open .acc-toggle {
            transform: rotate(180deg);
            background: var(--blue-soft);
            color: var(--blue);
        }

        .acc-body {
            display: none;
        }

        .acc-body.show {
            display: block;
        }

        /* ── TABLE ── */
        .tbl-wrap {
            padding: 0 18px 18px;
        }

        .dt {
            width: 100%;
            border-collapse: collapse;
            font-size: .78rem;
        }

        .dt thead tr {
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            border-bottom: 2px solid var(--gray-200);
        }

        .dt thead th {
            padding: 9px 10px;
            font-size: .64rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--gray-400);
            white-space: nowrap;
        }

        .dt tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background .12s;
        }

        .dt tbody tr:hover {
            background: var(--gray-50);
        }

        .dt tbody td {
            padding: 9px 10px;
            color: var(--gray-800);
            vertical-align: middle;
        }

        .dt tbody tr:last-child {
            border-bottom: none;
        }

        .rn {
            width: 22px;
            height: 22px;
            border-radius: 5px;
            background: var(--gray-100);
            color: var(--gray-600);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .64rem;
            font-weight: 700;
        }

        .tag {
            display: inline-block;
            font-size: .62rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .tag.blue {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .tag.green {
            background: var(--green-soft);
            color: var(--green);
        }

        .cell-sub {
            display: block;
            font-size: .7rem;
            color: var(--gray-600);
        }

        .num {
            font-weight: 700;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .num.pagu {
            color: var(--blue);
        }

        .num.real {
            color: var(--green);
        }

        .num.sisa {
            color: var(--red);
        }

        .pct-badge {
            display: inline-block;
            font-size: .66rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            white-space: nowrap;
        }

        .btn-doc {
            background: var(--green);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: .66rem;
            font-weight: 700;
            padding: 4px 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: opacity .2s;
        }

        .btn-doc:hover {
            opacity: .82;
            color: #fff;
        }

        .no-doc {
            background: var(--gray-200);
            color: var(--gray-600);
            font-size: .64rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            display: inline-block;
        }

        @media (max-width: 575px) {
            .col-hide-xs {
                display: none !important;
            }

            .dt {
                font-size: .74rem;
            }

            .dt thead th,
            .dt tbody td {
                padding: 8px 7px;
            }
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .a1 {
            animation: fadeUp .35s ease both;
        }

        .a2 {
            animation: fadeUp .35s .06s ease both;
        }

        .a3 {
            animation: fadeUp .35s .12s ease both;
        }

        .a4 {
            animation: fadeUp .35s .18s ease both;
        }

        .a5 {
            animation: fadeUp .35s .24s ease both;
        }

        .a6 {
            animation: fadeUp .35s .30s ease both;
        }

        .a7 {
            animation: fadeUp .35s .36s ease both;
        }

        /* ── TABLET/DESKTOP ADJUSTMENTS ── */
        @media (min-width: 576px) {
            .kpi-card {
                padding: 16px;
                gap: 12px;
            }

            .kpi-icon {
                width: 42px;
                height: 42px;
                font-size: 1rem;
            }

            .kpi-val {
                font-size: .88rem;
            }
        }

        @media (min-width: 992px) {
            .kpi-val {
                font-size: .95rem;
            }

            .kpi-icon {
                width: 44px;
                height: 44px;
                font-size: 1.05rem;
            }

            .kpi-label {
                font-size: .62rem;
            }
        }

   .folder-tabs{
    display:flex;
    gap:10px;
    padding:20px;
    flex-wrap:wrap;
}

.folder-tab{
    border:none;
    padding:10px 18px;
    border-radius:999px;
    background:#eef2ff;
    color:#1a56db;
    font-weight:600;
}

.folder-tab.active{
    background:#1a56db;
    color:white;
}

.progress-item{
    padding:15px 20px;
    border-top:1px solid #f3f4f6;
}

.progress-head{
    display:flex;
    justify-content:space-between;
    margin-bottom:8px;
}

.progress{
    height:10px;
    border-radius:999px;
    overflow:hidden;
    background:#e5e7eb;
}

.progress-bar{
    background:#1a56db;
    height:100%;
}

.empty-data{
    padding:25px;
    text-align:center;
    color:#9ca3af;
}
    </style>

    {{-- ======================================================= --}}
    {{-- HEADER --}}
    {{-- ======================================================= --}}
    <div class="db-header searchable-card a1">
        <div style="position:relative;z-index:1;">
            <div class="badge-pill">
                <i class="fas fa-tachometer-alt"></i> Dashboard Admin
            </div>
            <h1>Selamat datang,<br>{{ Auth::user()->name ?? 'Admin' }} 👋</h1>
            <p class="sub">
                <i class="far fa-calendar-alt" style="margin-right:4px;"></i>
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                &nbsp;•&nbsp;
                <i class="far fa-clock" style="margin-right:3px;"></i>
                {{ \Carbon\Carbon::now()->format('H:i') }} WIB
            </p>
            <div class="actions">
                <a href="{{ route('pendapatan.create') }}" class="btn-action btn-income">
                    <i class="fas fa-plus-circle"></i> Pendapatan
                </a>
                <a href="{{ route('belanja.create') }}" class="btn-action btn-expense">
                    <i class="fas fa-plus-circle"></i> Belanja
                </a>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- KPI CARDS --}}
    {{-- ======================================================= --}}
    <div class="kpi-grid searchable-card a2">
        <div class="kpi-card blue">
            <div class="kpi-icon blue"><i class="fas fa-wallet"></i></div>
            <div>
                <div class="kpi-label">Total Realisasi Pendapatan</div>
                <div class="kpi-val">Rp {{ number_format($totalRealisasiPendapatan) }}</div>
                {{-- <div class="kpi-note">Pendapatan + Belanja</div> --}}
            </div>
        </div>
        <div class="kpi-card green">
            <div class="kpi-icon green"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="kpi-label">Total Realisasi Belanja</div>
                <div class="kpi-val">Rp {{ number_format($totalRealisasiBelanja) }}</div>
                {{-- <div class="kpi-note">Pendapatan + Belanja</div> --}}
            </div>
        </div>
        <div class="kpi-card blue">
            <div class="kpi-icon blue"><i class="fas fa-hand-holding-usd"></i></div>
            <div>
                <div class="kpi-label">Sisa Anggaran</div>
                {{-- <div class="kpi-val">{{ number_format($persenPendapatan, 1) }}%</div> --}}
                <div class="kpi-note">Rp {{ number_format($totalSisaAnggaran = $totalRealisasiPendapatan - $totalRealisasiBelanja) }}</div>
            </div>
        </div>
        <div class="kpi-card green">
            <div class="kpi-icon green"><i class="fas fa-shopping-cart"></i></div>
            <div>
                <div class="kpi-label">Realisasi Belanja</div>
                <div class="kpi-val">{{ number_format($persenBelanja, 1) }}%</div>
                <div class="kpi-note">Rp {{ number_format($totalRealisasiBelanja) }}</div>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- CHARTS --}}
    {{-- ======================================================= --}}
   <div class="charts-grid searchable-card a3">

    {{-- Doughnut --}}
    <div class="s-card searchable-card" style="display:flex;flex-direction:column;">
        <div class="s-head">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="s-icon blue">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <p class="s-title">Persentase Realisasi</p>
                    <p class="s-sub">Pendapatan vs Belanja</p>
                </div>
            </div>
        </div>

        <div class="chart-card"
            style="display:flex;flex-direction:column;align-items:center;flex:1;justify-content:center;">

            <div style="position:relative;width:170px;height:170px;margin:8px auto 12px;">
                <canvas id="chartDoughnut"></canvas>

                <div
                    style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">

                    <div
                        style="font-size:.58rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em;">
                        Avg
                    </div>

                    <div style="font-size:1rem;font-weight:800;color:#1f2937;">
                        {{ number_format(($persenPendapatan + $persenBelanja) / 2, 0) }}%
                    </div>

                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:6px;width:100%;">

                <div style="display:flex;align-items:center;justify-content:space-between;font-size:.75rem;">
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span
                            style="width:9px;height:9px;border-radius:3px;background:#1a56db;display:inline-block;">
                        </span>
                        <span style="color:#4b5563;font-weight:600;">
                            Pendapatan
                        </span>
                    </span>

                    <strong>{{ number_format($persenPendapatan, 1) }}%</strong>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;font-size:.75rem;">
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span
                            style="width:9px;height:9px;border-radius:3px;background:#0e9f6e;display:inline-block;">
                        </span>
                        <span style="color:#4b5563;font-weight:600;">
                            Belanja
                        </span>
                    </span>

                    <strong>{{ number_format($persenBelanja, 1) }}%</strong>
                </div>

            </div>

        </div>
    </div>

    {{-- Bar Chart --}}
    <div class="s-card searchable-card">
        <div class="s-head">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="s-icon green">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <p class="s-title">Belanja per Bidang</p>
                    {{-- <p class="s-sub">Total Realisasi Belanja</p> --}}
                </div>
            </div>
        </div>

        <div class="chart-card">
            <canvas id="chartBar" style="max-height:185px;"></canvas>
        </div>
    </div>

</div>

    {{-- ======================================================= --}}
    {{-- PROGRESS REALISASI --}}
    {{-- ======================================================= --}}
    <div class="s-card searchable-card a4">
        <div class="s-head">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="s-icon blue"><i class="fas fa-tasks"></i></div>
                <div>
                    <p class="s-title">Progress Realisasi Anggaran</p>
                    <p class="s-sub">Tahun {{ date('Y') }}</p>
                </div>
            </div>
        </div>
        <div class="prog-section">
            <div class="prog-item">
                <div class="prog-lbl">
                    <span>
                        <i class="fas fa-coins" style="color:var(--blue);margin-right:5px;"></i>
                        Pendapatan Desa
                    </span>
                    @php $pctP = $persenPendapatan;
                    $clsP = $pctP >= 75 ? 'pct-hi' : ($pctP >= 40 ? 'pct-mid' : 'pct-lo'); @endphp
                    <span class="pct-badge {{ $clsP }}">{{ number_format($pctP, 2) }}%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width:{{ min($pctP, 100) }}%;background:var(--blue);"></div>
                </div>
                <div
                    style="display:flex;justify-content:space-between;font-size:.67rem;color:var(--gray-400);margin-top:4px;">
                    <span>Rp {{ number_format($totalRealisasiPendapatan) }} terealisasi</span>
                    <span>Pagu: Rp {{ number_format($totalPaguPendapatan) }}</span>
                </div>
            </div>
            <div class="prog-item">
                <div class="prog-lbl">
                    <span>
                        <i class="fas fa-receipt" style="color:var(--green);margin-right:5px;"></i>
                        Belanja Desa
                    </span>
                    @php $pctB = $persenBelanja;
                    $clsB = $pctB >= 75 ? 'pct-hi' : ($pctB >= 40 ? 'pct-mid' : 'pct-lo'); @endphp
                    <span class="pct-badge {{ $clsB }}">{{ number_format($pctB, 2) }}%</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width:{{ min($pctB, 100) }}%;background:var(--green);"></div>
                </div>
                <div
                    style="display:flex;justify-content:space-between;font-size:.67rem;color:var(--gray-400);margin-top:4px;">
                    <span>Rp {{ number_format($totalRealisasiBelanja) }} terealisasi</span>
                    <span>Pagu: Rp {{ number_format($totalPaguBelanja) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- REALISASI PERJENIS PENDAPATAN --}}
    {{-- ======================================================= --}}
    
<div class="s-card searchable-card mt-4">

    <div class="s-head">
        <div style="display:flex;align-items:center;gap:10px;">
            <div class="s-icon blue">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <p class="s-title">
                    Pemanfaatan Sumber Dana
                </p>
                <p class="s-sub">
                    Persentase dana yang telah digunakan untuk kegiatan belanja
                </p>
            </div>
        </div>
    </div>

    @forelse($dashboardSumberDana as $item)

        <div class="progress-item">

            <div class="progress-head">

                <span>
                    {{ $item['nama'] }}
                </span>

                <strong>
                    {{ number_format($item['persentase'],2) }}%
                </strong>

            </div>

            <div class="progress">
                <div class="progress-bar"
                    style="width:{{ min($item['persentase'],100) }}%">
                </div>
            </div>

            <small>

                Rp {{ number_format($item['terpakai']) }}

                digunakan dari

                Rp {{ number_format($item['diterima']) }}

            </small>

        </div>

    @empty

        <div class="empty-data">
            Belum ada data sumber dana
        </div>

    @endforelse

</div>
  
    {{-- ======================================================= --}}
    {{-- TABEL DETAIL — ACCORDION (secondary info) --}}
    {{-- ======================================================= --}}

    {{-- Pendapatan Detail --}}
    <div class="s-card searchable-card a6">
        <div class="acc-head" id="accPendHead" onclick="toggleAcc('pendapatan')">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="s-icon blue"><i class="fas fa-table"></i></div>
                <div>
                    <p class="s-title">Detail Transaksi Pendapatan</p>
                    <p class="s-sub">{{ count($pendapatan) }} data &nbsp;•&nbsp; Klik untuk expand</p>
                </div>
            </div>
            <div class="acc-toggle"><i class="fas fa-chevron-down"></i></div>
        </div>
        <div class="acc-body" id="accPendBody">
            <p class="d-block d-sm-none" style="font-size:.68rem;color:#9ca3af;margin:10px 18px 4px;">
                <i class="fas fa-info-circle"></i> Kolom Pagu &amp; Sisa tersembunyi di HP. Putar layar untuk tampilan
                lengkap.
            </p>
            <div class="tbl-wrap">
                <div class="table-responsive">
                    <table class="dt">
                        <thead>
                           <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Kategori & Jenis</th>
    <th class="col-hide-xs">Pagu</th>
    <th>Realisasi</th>
    <th>%</th>
</tr>
                        </thead>
                        <tbody>
                            @forelse($pendapatan as $i => $item)
                                @php
                                    $real = optional($item->realisasi)->realisasi ?? 0;
                                    // $sisa = $item->pagu - $real;
                                    $pct = $item->pagu > 0 ? ($real / $item->pagu) * 100 : 0;
                                    $cls = $pct >= 75 ? 'pct-hi' : ($pct >= 40 ? 'pct-mid' : 'pct-lo');
                                @endphp
                                <tr>
                                    <td><span class="rn">{{ $i + 1 }}</span></td>
                                    <td style="white-space:nowrap;color:#6b7280;font-size:.7rem;">
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>
                                        <span class="tag blue">{{ $item->kategori_pendapatan }}</span>
                                        <span class="cell-sub">{{ $item->jenis_pendapatan }}</span>
                                    </td>
                                    <td class="col-hide-xs"><span class="num pagu">Rp {{ number_format($item->pagu) }}</span>
                                    </td>
                                    <td><span class="num real">Rp {{ number_format($real) }}</span></td>
                                    {{-- <td class="col-hide-xs"><span class="num sisa">Rp {{ number_format($sisa) }}</span></td> --}}
                                    <td style="text-align:center;"><span
                                            class="pct-badge {{ $cls }}">{{ number_format($pct, 1) }}%</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center" style="padding:28px;color:var(--gray-400);">
                                        <i class="fas fa-inbox"
                                            style="display:block;font-size:1.5rem;margin-bottom:6px;"></i>Belum ada data
                                        pendapatan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Belanja Detail --}}
    <div class="s-card searchable-card a7">
        <div class="acc-head" id="accBelHead" onclick="toggleAcc('belanja')">
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="s-icon green"><i class="fas fa-table"></i></div>
                <div>
                    <p class="s-title">Detail Kegiatan Belanja</p>
                    <p class="s-sub">{{ count($belanja) }} data &nbsp;•&nbsp; Klik untuk expand</p>
                </div>
            </div>
            <div class="acc-toggle"><i class="fas fa-chevron-down"></i></div>
        </div>
        <div class="acc-body" id="accBelBody">
            <p class="d-block d-sm-none" style="font-size:.68rem;color:#9ca3af;margin:10px 18px 4px;">
                <i class="fas fa-info-circle"></i> Kolom Pagu &amp; Sisa tersembunyi di HP. Putar layar untuk tampilan
                lengkap.
            </p>
            <div class="tbl-wrap">
                <div class="table-responsive">
                    <table class="dt">
                        <thead>
                            <tr>
                                <th style="width:30px;">No</th>
                                <th>Tanggal</th>
                                <th>Bidang &amp; Kegiatan</th>
                                <th class="col-hide-xs">Pagu</th>
                                <th>Realisasi</th>
                                <th class="col-hide-xs">Sisa</th>
                                <th style="text-align:center;">%</th>
                                <th style="text-align:center;">Dok.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($belanja as $i => $item)
                                @php
                                    $real = optional($item->realisasi)->realisasi ?? 0;
                                    $sisa = $item->pagu - $real;
                                    $pct = $item->pagu > 0 ? ($real / $item->pagu) * 100 : 0;
                                    $cls = $pct >= 75 ? 'pct-hi' : ($pct >= 40 ? 'pct-mid' : 'pct-lo');
                                @endphp
                                <tr>
                                    <td><span class="rn">{{ $i + 1 }}</span></td>
                                    <td style="white-space:nowrap;color:#6b7280;font-size:.7rem;">
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>
                                        <span class="tag green">{{ $item->bidang }}</span>
                                        <span class="cell-sub">{{ $item->jenis_kegiatan }}</span>
                                    </td>
                                    <td class="col-hide-xs"><span class="num pagu">Rp {{ number_format($item->pagu) }}</span>
                                    </td>
                                    <td><span class="num real">Rp {{ number_format($real) }}</span></td>
                                    <td class="col-hide-xs"><span class="num sisa">Rp {{ number_format($sisa) }}</span></td>
                                    <td style="text-align:center;"><span
                                            class="pct-badge {{ $cls }}">{{ number_format($pct, 1) }}%</span></td>
                                    <td style="text-align:center;">
                                        @if($item->dokumentasi && $item->dokumentasi->isNotEmpty())
                                            <button class="btn-doc" data-toggle="modal" data-target="#modalDok{{ $item->id }}">
                                                <i class="fas fa-image"></i>
                                                <span class="d-none d-md-inline">Lihat</span>
                                            </button>
                                        @else
                                            <span class="no-doc d-none d-sm-inline">Tidak Ada</span>
                                            <span class="d-inline d-sm-none" style="font-size:.8rem;color:var(--gray-400);">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding:28px;color:var(--gray-400);">
                                        <i class="fas fa-inbox"
                                            style="display:block;font-size:1.5rem;margin-bottom:6px;"></i>Belum ada data
                                        belanja.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals Dokumentasi --}}
    @foreach($belanja as $item)
        @if($item->dokumentasi && $item->dokumentasi->isNotEmpty())
            <div class="modal fade" id="modalDok{{ $item->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="border-radius:16px;border:none;overflow:hidden;">
                        <div class="modal-header"
                            style="background:var(--blue-mid,#1e3a8a);color:#fff;border:none;padding:14px 18px;">
                            <h5 class="modal-title" style="font-weight:700;font-size:.9rem;">
                                <i class="fas fa-images" style="margin-right:7px;"></i>
                                Dokumentasi — {{ $item->jenis_kegiatan }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                style="color:rgba(255,255,255,.8);opacity:1;">&times;</button>
                        </div>
                        <div class="modal-body text-center p-3">
                            @foreach($item->dokumentasi as $doc)
                                <img src="{{ asset('storage/' . $doc->file) }}" class="img-fluid rounded mb-3 shadow-sm"
                                    style="max-height:380px;object-fit:contain;">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ── DATA ── */
            const paguPend = {{ $totalPaguPendapatan }};
            const realPend = {{ $totalRealisasiPendapatan }};
            const sisaPend = {{ $totalSisaPendapatan }};
            const paguBel = {{ $totalPaguBelanja }};
            const realBel = {{ $totalRealisasiBelanja }};
            const sisaBel = {{ $totalSisaBelanja }};

            /* ── DOUGHNUT ── */
            const ctxD = document.getElementById('chartDoughnut');
            if (ctxD) {
                new Chart(ctxD, {
                    type: 'doughnut',
                    data: {
                        labels: ['Realisasi Pendapatan', 'Sisa Pendapatan', 'Realisasi Belanja', 'Sisa Belanja'],
                        datasets: [{
                            data: [realPend, sisaPend, realBel, sisaBel],
                            backgroundColor: ['#1a56db', '#bfdbfe', '#0e9f6e', '#a7f3d0'],
                            borderWidth: 0, hoverOffset: 6
                        }]
                    },
                    options: {
                        cutout: '72%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { callbacks: { label: c => '  Rp ' + c.parsed.toLocaleString('id-ID') } }
                        }
                    }
                });
            }

            /* ── BAR ── */
            const ctxB = document.getElementById('chartBar');

if (ctxB) {

    const fmt = v => {
        if (v >= 1e9) return 'Rp ' + (v / 1e9).toFixed(1) + ' M';
        if (v >= 1e6) return 'Rp ' + (v / 1e6).toFixed(0) + ' jt';
        return 'Rp ' + (v / 1e3).toFixed(0) + ' rb';
    };

    new Chart(ctxB, {
        type: 'bar',

        data: {
            labels: @json($chartBelanjaLabels),

            datasets: [{
                label: 'Realisasi Belanja',
                data: @json($chartBelanjaData),

                backgroundColor: '#0e9f6e',
                borderRadius: 7,
                borderSkipped: false,
                barPercentage: 0.6
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    callbacks: {
                        label: c =>
                            'Rp ' + c.parsed.y.toLocaleString('id-ID')
                    }
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },

                    ticks: {
                        font: {
                            size: 11,
                            weight: '700'
                        },
                        color: '#4b5563'
                    }
                },

                y: {
                    beginAtZero: true,

                    grid: {
                        color: '#f3f4f6'
                    },

                    border: {
                        display: false
                    },

                    ticks: {
                        font: {
                            size: 10
                        },
                        color: '#9ca3af',
                        callback: fmt
                    }
                }
            }
        }
    });
}

            /* ── ACCORDION ── */
            window.toggleAcc = function (key) {
                const head = document.getElementById('acc' + (key === 'pendapatan' ? 'Pend' : 'Bel') + 'Head');
                const body = document.getElementById('acc' + (key === 'pendapatan' ? 'Pend' : 'Bel') + 'Body');
                if (!head || !body) return;
                const open = body.classList.toggle('show');
                head.classList.toggle('open', open);
            };

        });

function showKategori(event,id){

    document
        .querySelectorAll('.kategori-content')
        .forEach(el => el.classList.add('d-none'));

    document
        .getElementById(id)
        .classList.remove('d-none');

    document
        .querySelectorAll('.folder-tab')
        .forEach(el => el.classList.remove('active'));

    event.target.classList.add('active');
}

// search 
$('#globalSearch').on('input', function () {

    let keyword =
        $(this).val().toLowerCase().trim();

    if (keyword === '') {

        $('.searchable-card').show();
        return;
    }

    $('.searchable-card').each(function () {

        let text =
            $(this).text().toLowerCase();

        $(this).toggle(
            text.includes(keyword)
        );

    });

});
    </script>
@endsection