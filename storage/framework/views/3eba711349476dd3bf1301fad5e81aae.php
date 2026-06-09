

<?php $__env->startSection('styles'); ?>
    <style>
        /* ============================================================
           SIMKEU DESA — Dashboard Public  (mobile-first)
        ============================================================ */

        :root {
            --blue: #1a56db;
            --blue-soft: #eff4ff;
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
        }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(140deg, #1e3a8a 0%, #1a56db 50%, #2563eb 100%);
            border-radius: 18px;
            padding: 28px 24px 72px;
            /* mobile-first */
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(26, 86, 219, .22);
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            top: -60px;
            right: -60px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            bottom: -40px;
            left: 38%;
        }

        .hero-icon-bg {
            position: absolute;
            right: 28px;
            top: 50%;
            transform: translateY(-55%);
            font-size: 5rem;
            color: rgba(255, 255, 255, .07);
            pointer-events: none;
            display: none;
            /* hidden on mobile */
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            color: rgba(255, 255, 255, .95);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 100px;
            margin-bottom: 14px;
        }

        .hero-title {
            color: #fff;
            font-size: clamp(1.45rem, 5vw, 2.3rem);
            font-weight: 800;
            letter-spacing: -.02em;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .hero-sub {
            color: rgba(255, 255, 255, .72);
            font-size: .88rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .hero-date {
            color: rgba(255, 255, 255, .45);
            font-size: .74rem;
        }

        /* ── KPI OVERLAP ── */
        .kpi-row {
            position: relative;
            z-index: 10;
            margin-top: -44px;
            padding-bottom: 4px;
        }

        .kpi-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .10), 0 2px 6px rgba(0, 0, 0, .05);
            padding: 14px 14px;
            display: flex;
            align-items: center;
            gap: 11px;
            border: 1px solid rgba(255, 255, 255, .8);
            transition: transform .2s, box-shadow .2s;
            height: 100%;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(0, 0, 0, .12);
        }

        .kpi-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
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
            font-size: .6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--gray-400);
            margin-bottom: 2px;
        }

        .kpi-val {
            font-size: .82rem;
            font-weight: 800;
            color: var(--gray-800);
            line-height: 1.2;
        }

        .kpi-note {
            font-size: .63rem;
            color: var(--gray-400);
            margin-top: 1px;
        }

        /* ── SECTION CARD ── */
        .s-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            /* overflow: hidden; */
        }

        /* header dengan layout stack di mobile */
        .s-head {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding: 18px 18px 14px;
            border-bottom: 1px solid var(--gray-100);
        }

        .s-head-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .s-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
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
            font-size: .95rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        .s-sub {
            font-size: .7rem;
            color: var(--gray-400);
            margin: 0;
        }

        /* pill stats — scroll horizontal kalau tidak muat */
        .pill-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 2px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .pill-row::-webkit-scrollbar {
            display: none;
        }

        .pill {
            flex-shrink: 0;
            padding: 7px 12px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }

        .pill.p-blue {
            background: var(--blue-soft);
        }

        .pill.p-green {
            background: var(--green-soft);
        }

        .pill.p-red {
            background: var(--red-soft);
        }

        .pill-lbl {
            font-size: .6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 2px;
        }

        .pill.p-blue .pill-lbl {
            color: var(--blue);
        }

        .pill.p-green .pill-lbl {
            color: var(--green);
        }

        .pill.p-red .pill-lbl {
            color: var(--red);
        }

        .pill-val {
            font-size: .76rem;
            font-weight: 700;
            color: var(--gray-800);
            white-space: nowrap;
        }

        /* progress */
        .prog-wrap {
            padding: 12px 18px;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-100);
        }

        .prog-lbl {
            display: flex;
            justify-content: space-between;
            font-size: .74rem;
            color: var(--gray-600);
            font-weight: 600;
            margin-bottom: 6px;
        }

        .progress {
            height: 7px;
            border-radius: 100px;
            background: var(--gray-200);
        }

        .progress-bar {
            border-radius: 100px;
        }

        /* table section */
        .tbl-body {
            padding: 0 18px 20px;
        }

        .tbl-heading {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--gray-400);
            padding: 14px 0 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ── TABLE — full responsive ── */
        /*
           Strategi: di mobile (<576px) kita sembunyikan kolom Pagu & Sisa,
           tampilkan hanya: No | Kategori/Bidang | Realisasi | %
           Kolom yang disembunyikan punya class .col-hide-sm
        */
        .dt {
            width: 100%;
            border-collapse: collapse;
            font-size: .79rem;
        }

        .dt thead tr {
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            border-bottom: 2px solid var(--gray-200);
        }

        .dt thead th {
            padding: 9px 10px;
            font-size: .66rem;
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
            padding: 10px 10px;
            color: var(--gray-800);
            vertical-align: middle;
        }

        .dt tbody tr:last-child {
            border-bottom: none;
        }

        .rn {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: var(--gray-100);
            color: var(--gray-600);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .67rem;
            font-weight: 700;
        }

        .tag {
            display: inline-block;
            font-size: .64rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 5px;
            margin-bottom: 3px;
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
            font-size: .72rem;
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

        .pct {
            display: inline-block;
            font-size: .69rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            white-space: nowrap;
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

        .btn-doc {
            background: var(--green);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: .68rem;
            font-weight: 700;
            padding: 5px 10px;
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
            font-size: .66rem;
            font-weight: 700;
            padding: 4px 9px;
            border-radius: 6px;
            display: inline-block;
        }

        /* kolom yang disembunyikan di HP */
        @media (max-width: 575px) {
            .col-hide-sm {
                display: none !important;
            }

            /* di HP tampilkan angka lebih compact */
            .dt {
                font-size: .75rem;
            }

            .dt thead th {
                padding: 8px 8px;
            }

            .dt tbody td {
                padding: 9px 8px;
            }
        }

        /* empty & footer */
        .empty {
            text-align: center;
            padding: 36px 16px;
            color: var(--gray-400);
        }

        .empty i {
            font-size: 1.8rem;
            display: block;
            margin-bottom: 8px;
        }

        .empty p {
            font-size: .82rem;
            margin: 0;
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: var(--blue);
            color: #fff;
            border: none;
            padding: 16px 20px;
        }

        .modal-header .close {
            color: rgba(255, 255, 255, .8);
            opacity: 1;
        }

        .modal-title {
            font-weight: 700;
            font-size: .95rem;
        }

        .page-footer {
            text-align: center;
            font-size: .7rem;
            color: var(--gray-400);
            padding: 24px 0 4px;
        }

        /* charts */
        .chart-card {
            padding: 16px 18px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .a1 {
            animation: fadeUp .4s ease both;
        }

        .a2 {
            animation: fadeUp .4s .07s ease both;
        }

        .a3 {
            animation: fadeUp .4s .14s ease both;
        }

        .a4 {
            animation: fadeUp .4s .21s ease both;
        }

        .a5 {
            animation: fadeUp .4s .28s ease both;
        }

        .a6 {
            animation: fadeUp .4s .35s ease both;
        }

        /* ── TABLET & DESKTOP OVERRIDES ── */
        @media (min-width: 576px) {
            .hero {
                padding: 36px 36px 76px;
            }

            .kpi-card {
                padding: 16px 18px;
                gap: 13px;
            }

            .kpi-val {
                font-size: .9rem;
            }

            .kpi-icon {
                width: 44px;
                height: 44px;
                font-size: 1.05rem;
            }

            .s-head {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                padding: 18px 22px 14px;
            }

            .tbl-body {
                padding: 0 22px 22px;
            }

            .prog-wrap {
                padding: 14px 22px;
            }
        }

        @media (min-width: 768px) {
            .hero {
                padding: 44px 48px 82px;
                border-radius: 20px;
            }

            .hero-icon-bg {
                display: block;
            }

            .kpi-card {
                padding: 18px 20px;
                gap: 14px;
            }

            .kpi-val {
                font-size: .95rem;
            }

            .kpi-icon {
                width: 48px;
                height: 48px;
                font-size: 1.15rem;
            }

            .s-head {
                padding: 20px 24px 16px;
            }

            .tbl-body {
                padding: 0 24px 24px;
            }

            .prog-wrap {
                padding: 14px 24px;
            }

            .dt {
                font-size: .81rem;
            }
        }

        @media (min-width: 992px) {
            .kpi-val {
                font-size: 1rem;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="hero a1">
        <div class="hero-icon-bg"><i class="fas fa-university"></i></div>
        <div class="hero-badge"><i class="fas fa-landmark"></i> APBDes <?php echo e($tahun); ?></div>
        <h1 class="hero-title">Anggaran Pendapatan<br>dan Belanja Desa</h1>
        <p class="hero-sub">Desa Pandanlandung Tahun Anggaran <?php echo e($tahun); ?></p>
        <p class="hero-date">
            <i class="far fa-calendar-alt" style="margin-right:4px;"></i>
            <?php echo e(\Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y')); ?>

        </p>
    </div>

    
    <div class="kpi-row a2">
        <div class="row g-2 g-sm-3">
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-icon blue"><i class="fas fa-wallet"></i></div>
                    <div>
                        <div class="kpi-label">Total Pagu</div>
                        <div class="kpi-val">Rp <?php echo e(number_format($totalPaguPendapatan + $totalPaguBelanja)); ?></div>
                        <div class="kpi-note">Pendapatan + Belanja</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-icon green"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="kpi-label">Total Realisasi</div>
                        <div class="kpi-val">Rp <?php echo e(number_format($totalRealisasiPendapatan + $totalRealisasiBelanja)); ?>

                        </div>
                        <div class="kpi-note">Pendapatan + Belanja</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-icon blue"><i class="fas fa-hand-holding-usd"></i></div>
                    <div>
                        <div class="kpi-label">Realisasi Pendapatan</div>
                        <div class="kpi-val"><?php echo e(number_format($persenPendapatan, 1)); ?>%</div>
                        <div class="kpi-note">Rp <?php echo e(number_format($totalRealisasiPendapatan)); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-icon green"><i class="fas fa-shopping-cart"></i></div>
                    <div>
                        <div class="kpi-label">Realisasi Belanja</div>
                        <div class="kpi-val"><?php echo e(number_format($persenBelanja, 1)); ?>%</div>
                        <div class="kpi-note">Rp <?php echo e(number_format($totalRealisasiBelanja)); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="row g-3 g-md-4 a3" style="margin-top: 24px;">

        
        <div class="col-12 col-md-4">
            <div class="s-card h-100">
                <div class="s-head" style="flex-direction:row;align-items:center;padding-bottom:0;border-bottom:none;">
                    <div class="s-head-top">
                        <div class="s-icon blue"><i class="fas fa-chart-pie"></i></div>
                        <div>
                            <p class="s-title">Komposisi</p>
                            <p class="s-sub">Pagu vs Realisasi</p>
                        </div>
                    </div>
                </div>
                <div class="chart-card" style="display:flex;flex-direction:column;align-items:center;">
                    <div style="position:relative;width:160px;height:160px;margin:10px auto;">
                        <canvas id="chartDoughnut"></canvas>
                        <div
                            style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                            <div
                                style="font-size:.6rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em;">
                                Avg</div>
                            <div style="font-size:1.05rem;font-weight:800;color:#1f2937;">
                                <?php echo e(number_format(($persenPendapatan + $persenBelanja) / 2, 0)); ?>%
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px;width:100%;">
                        <div style="display:flex;align-items:center;justify-content:space-between;font-size:.76rem;">
                            <span style="display:flex;align-items:center;gap:7px;">
                                <span
                                    style="width:10px;height:10px;border-radius:3px;background:#1a56db;display:inline-block;flex-shrink:0;"></span>
                                <span style="color:#4b5563;font-weight:600;">Pendapatan</span>
                            </span>
                            <strong><?php echo e(number_format($persenPendapatan, 1)); ?>%</strong>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;font-size:.76rem;">
                            <span style="display:flex;align-items:center;gap:7px;">
                                <span
                                    style="width:10px;height:10px;border-radius:3px;background:#0e9f6e;display:inline-block;flex-shrink:0;"></span>
                                <span style="color:#4b5563;font-weight:600;">Belanja</span>
                            </span>
                            <strong><?php echo e(number_format($persenBelanja, 1)); ?>%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-md-8">
            <div class="s-card h-100">
                <div class="s-head" style="flex-direction:row;align-items:center;padding-bottom:0;border-bottom:none;">
                    <div class="s-head-top">
                        <div class="s-icon green"><i class="fas fa-chart-bar"></i></div>
                        <div>
                            <p class="s-title">Pagu vs Realisasi</p>
                            <p class="s-sub">Perbandingan anggaran <?php echo e($tahun); ?></p>
                        </div>
                    </div>
                </div>
                <div class="chart-card">
                    <canvas id="chartBar" style="max-height:180px;"></canvas>
                </div>
            </div>
        </div>

    </div>


    
    
    
    <div class="s-card mb-3 a4" style="margin-top:24px;">

        <div class="s-head">
            <div class="s-head-top">
                <div class="s-icon blue"><i class="fas fa-coins"></i></div>
                <div>
                    <p class="s-title">Pendapatan Desa</p>
                    <p class="s-sub">Realisasi <?php echo e(number_format($persenPendapatan, 2)); ?>% dari total pagu</p>
                </div>
            </div>
            <div class="pill-row">
                <div class="pill p-blue">
                    <span class="pill-lbl">Total Pagu</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalPaguPendapatan)); ?></span>
                </div>
                <div class="pill p-green">
                    <span class="pill-lbl">Realisasi</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalRealisasiPendapatan)); ?></span>
                </div>
                <div class="pill p-red">
                    <span class="pill-lbl">Sisa</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalSisaPendapatan)); ?></span>
                </div>
            </div>
        </div>

        <div class="prog-wrap">
            <div class="prog-lbl">
                <span>Progres Realisasi Pendapatan</span>
                <span><?php echo e(number_format($persenPendapatan, 2)); ?>%</span>
            </div>
            <div class="progress">
                <div class="progress-bar" style="width:<?php echo e(min($persenPendapatan, 100)); ?>%;background:var(--blue);"></div>
            </div>
        </div>

        <div class="tbl-body">
            <div class="tbl-heading"><i class="fas fa-table"></i> Rincian Transaksi Pendapatan</div>

            
            <p class="d-block d-sm-none" style="font-size:.68rem;color:#9ca3af;margin-bottom:8px;">
                <i class="fas fa-info-circle"></i> Di HP: kolom Pagu &amp; Sisa disembunyikan. Putar layar untuk tampilan
                lengkap.
            </p>

            <div class="table-responsive">
                <table class="dt">
                    <thead>
                        <tr>
                            <th style="width:32px;">No</th>
                            <th>Tanggal</th>
                            <th>Kategori &amp; Jenis</th>
                            <th class="col-hide-sm">Pagu</th>
                            <th>Realisasi</th>
                            <th class="col-hide-sm">Sisa</th>
                            <th style="text-align:center;">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $real = optional($item->realisasi)->realisasi ?? 0;
                                $sisa = $item->pagu - $real;
                                $pct = $item->pagu > 0 ? ($real / $item->pagu) * 100 : 0;
                                $pctCls = $pct >= 75 ? 'pct-hi' : ($pct >= 40 ? 'pct-mid' : 'pct-lo');
                            ?>
                            <tr>
                                <td><span class="rn"><?php echo e($i + 1); ?></span></td>
                                <td style="white-space:nowrap;color:#6b7280;font-size:.72rem;">
                                    <?php echo e($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-'); ?>

                                </td>
                                <td>
                                    <span class="tag blue"><?php echo e($item->kategori_pendapatan); ?></span>
                                    <span class="cell-sub"><?php echo e($item->jenis_pendapatan); ?></span>
                                </td>
                                <td class="col-hide-sm"><span class="num pagu">Rp <?php echo e(number_format($item->pagu)); ?></span></td>
                                <td><span class="num real">Rp <?php echo e(number_format($real)); ?></span></td>
                                <td class="col-hide-sm"><span class="num sisa">Rp <?php echo e(number_format($sisa)); ?></span></td>
                                <td style="text-align:center;">
                                    <span class="pct <?php echo e($pctCls); ?>"><?php echo e(number_format($pct, 2)); ?>%</span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty"><i class="fas fa-inbox"></i>
                                        <p>Belum ada data pendapatan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    
    
    
    <div class="s-card mb-3 a5">

        <div class="s-head">
            <div class="s-head-top">
                <div class="s-icon green"><i class="fas fa-receipt"></i></div>
                <div>
                    <p class="s-title">Belanja Desa</p>
                    <p class="s-sub">Realisasi <?php echo e(number_format($persenBelanja, 2)); ?>% dari total pagu</p>
                </div>
            </div>
            <div class="pill-row">
                <div class="pill p-blue">
                    <span class="pill-lbl">Total Pagu</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalPaguBelanja)); ?></span>
                </div>
                <div class="pill p-green">
                    <span class="pill-lbl">Realisasi</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalRealisasiBelanja)); ?></span>
                </div>
                <div class="pill p-red">
                    <span class="pill-lbl">Sisa</span>
                    <span class="pill-val">Rp <?php echo e(number_format($totalSisaBelanja)); ?></span>
                </div>
            </div>
        </div>

        <div class="prog-wrap">
            <div class="prog-lbl">
                <span>Progres Realisasi Belanja</span>
                <span><?php echo e(number_format($persenBelanja, 2)); ?>%</span>
            </div>
            <div class="progress">
                <div class="progress-bar" style="width:<?php echo e(min($persenBelanja, 100)); ?>%;background:var(--green);"></div>
            </div>
        </div>

        <div class="tbl-body">
            <div class="tbl-heading"><i class="fas fa-table"></i> Rincian Kegiatan Belanja</div>

            <p class="d-block d-sm-none" style="font-size:.68rem;color:#9ca3af;margin-bottom:8px;">
                <i class="fas fa-info-circle"></i> Di HP: kolom Pagu &amp; Sisa disembunyikan. Putar layar untuk tampilan
                lengkap.
            </p>

            <div class="table-responsive">
                <table class="dt">
                    <thead>
                        <tr>
                            <th style="width:32px;">No</th>
                            <th>Tanggal</th>
                            <th>Bidang &amp; Kegiatan</th>
                            <th class="col-hide-sm">Pagu</th>
                            <th>Realisasi</th>
                            <th class="col-hide-sm">Sisa</th>
                            <th style="text-align:center;">%</th>
                            <th style="text-align:center;">Dok.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $belanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $real = optional($item->realisasi)->realisasi ?? 0;
                                $sisa = $item->pagu - $real;
                                $pct = $item->pagu > 0 ? ($real / $item->pagu) * 100 : 0;
                                $pctCls = $pct >= 75 ? 'pct-hi' : ($pct >= 40 ? 'pct-mid' : 'pct-lo');
                            ?>
                            <tr>
                                <td><span class="rn"><?php echo e($i + 1); ?></span></td>
                                <td style="white-space:nowrap;color:#6b7280;font-size:.72rem;">
                                    <?php echo e($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-'); ?>

                                </td>
                                <td>
                                    <span class="tag green"><?php echo e($item->bidang); ?></span>
                                    <span class="cell-sub"><?php echo e($item->jenis_kegiatan); ?></span>
                                </td>
                                <td class="col-hide-sm"><span class="num pagu">Rp <?php echo e(number_format($item->pagu)); ?></span></td>
                                <td><span class="num real">Rp <?php echo e(number_format($real)); ?></span></td>
                                <td class="col-hide-sm"><span class="num sisa">Rp <?php echo e(number_format($sisa)); ?></span></td>
                                <td style="text-align:center;">
                                    <span class="pct <?php echo e($pctCls); ?>"><?php echo e(number_format($pct, 2)); ?>%</span>
                                </td>
                                <td style="text-align:center;">
                                    <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>
                                        <button class="btn-doc" data-toggle="modal" data-target="#modalDok<?php echo e($item->id); ?>">
                                            <i class="fas fa-image"></i>
                                            <span class="d-none d-sm-inline">Lihat</span>
                                        </button>
                                    <?php else: ?>
                                        <span class="no-doc d-none d-sm-inline">Tidak Ada</span>
                                        <span class="d-inline d-sm-none" style="font-size:.8rem;">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8">
                                    <div class="empty"><i class="fas fa-inbox"></i>
                                        <p>Belum ada data belanja.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $belanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($item->dokumentasi && $item->dokumentasi->isNotEmpty()): ?>
    <div class="modal fade" id="modalDok<?php echo e($item->id); ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-images" style="margin-right:7px;"></i>
                        Dokumentasi — <?php echo e($item->jenis_kegiatan); ?>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center p-3">
                    <?php $__currentLoopData = $item->dokumentasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset('storage/' . $doc->file)); ?>"
                            class="img-fluid rounded mb-3 shadow-sm"
                            style="max-height:380px;object-fit:contain;">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="page-footer a6">
        <i class="fas fa-shield-alt" style="margin-right:4px;"></i>
        Data ditampilkan secara transparan oleh Pemerintah Desa Pandanlandung &mdash; <?php echo e($tahun); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const paguPend = <?php echo e($totalPaguPendapatan); ?>;
            const realPend = <?php echo e($totalRealisasiPendapatan); ?>;
            const sisaPend = <?php echo e($totalSisaPendapatan); ?>;
            const paguBel = <?php echo e($totalPaguBelanja); ?>;
            const realBel = <?php echo e($totalRealisasiBelanja); ?>;
            const sisaBel = <?php echo e($totalSisaBelanja); ?>;

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
                /* Format angka adaptif */
                const fmt = v => {
                    if (v >= 1e9) return 'Rp ' + (v / 1e9).toFixed(1) + ' M';
                    if (v >= 1e6) return 'Rp ' + (v / 1e6).toFixed(0) + ' jt';
                    return 'Rp ' + (v / 1e3).toFixed(0) + ' rb';
                };

                new Chart(ctxB, {
                    type: 'bar',
                    data: {
                        labels: ['Pendapatan', 'Belanja'],
                        datasets: [
                            {
                                label: 'Pagu',
                                data: [paguPend, paguBel],
                                backgroundColor: ['#bfdbfe', '#a7f3d0'],
                                borderRadius: 7, borderSkipped: false, barPercentage: 0.6
                            },
                            {
                                label: 'Realisasi',
                                data: [realPend, realBel],
                                backgroundColor: ['#1a56db', '#0e9f6e'],
                                borderRadius: 7, borderSkipped: false, barPercentage: 0.6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top', align: 'end',
                                labels: { font: { size: 11, weight: '600' }, usePointStyle: true, pointStyleWidth: 8, padding: 14 }
                            },
                            tooltip: { callbacks: { label: c => '  ' + c.dataset.label + ': Rp ' + c.parsed.y.toLocaleString('id-ID') } }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { size: 11, weight: '700' }, color: '#4b5563' } },
                            y: {
                                grid: { color: '#f3f4f6' }, border: { display: false },
                                ticks: { font: { size: 10 }, color: '#9ca3af', callback: fmt }
                            }
                        }
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ── DATA DARI BLADE ── */
            const paguPend = <?php echo e($totalPaguPendapatan); ?>;
            const realPend = <?php echo e($totalRealisasiPendapatan); ?>;
            const sisaPend = <?php echo e($totalSisaPendapatan); ?>;

            const paguBel = <?php echo e($totalPaguBelanja); ?>;
            const realBel = <?php echo e($totalRealisasiBelanja); ?>;
            const sisaBel = <?php echo e($totalSisaBelanja); ?>;

            /* ── CHART 1: DOUGHNUT ── */
            const ctxD = document.getElementById('chartDoughnut');
            if (ctxD) {
                new Chart(ctxD, {
                    type: 'doughnut',
                    data: {
                        labels: ['Realisasi Pendapatan', 'Sisa Pendapatan', 'Realisasi Belanja', 'Sisa Belanja'],
                        datasets: [{
                            data: [realPend, sisaPend, realBel, sisaBel],
                            backgroundColor: ['#1a56db', '#bfdbfe', '#0e9f6e', '#a7f3d0'],
                            borderWidth: 0,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        cutout: '72%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: ctx => '  Rp ' + ctx.parsed.toLocaleString('id-ID')
                                }
                            }
                        }
                    }
                });
            }

            /* ── CHART 2: BAR — skala terpisah agar kedua kategori terlihat ── */
            const ctxB = document.getElementById('chartBar');
            if (ctxB) {
                new Chart(ctxB, {
                    type: 'bar',
                    data: {
                        labels: ['Pendapatan', 'Belanja'],
                        datasets: [
                            {
                                label: 'Pagu',
                                data: [paguPend, paguBel],
                                backgroundColor: ['#bfdbfe', '#a7f3d0'],
                                borderRadius: 7,
                                borderSkipped: false,
                                barPercentage: 0.55
                            },
                            {
                                label: 'Realisasi',
                                data: [realPend, realBel],
                                backgroundColor: ['#1a56db', '#0e9f6e'],
                                borderRadius: 7,
                                borderSkipped: false,
                                barPercentage: 0.55
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end',
                                labels: {
                                    font: { size: 11, weight: '600' },
                                    usePointStyle: true,
                                    pointStyleWidth: 8,
                                    padding: 16
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: ctx => '  ' + ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 12, weight: '700' }, color: '#4b5563' }
                            },
                            y: {
                                grid: { color: '#f3f4f6', drawBorder: false },
                                border: { display: false },
                                ticks: {
                                    font: { size: 10 },
                                    color: '#9ca3af',
                                    callback: v => {
                                        if (v >= 1e9) return 'Rp ' + (v / 1e9).toFixed(1) + ' M';
                                        if (v >= 1e6) return 'Rp ' + (v / 1e6).toFixed(0) + ' jt';
                                        return 'Rp ' + (v / 1e3).toFixed(0) + ' rb';
                                    }
                                }
                            }
                        }
                    }
                });
            }

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Asti\Kuliah\SMT 8\skripsi\simkeu-desa\resources\views/public/index.blade.php ENDPATH**/ ?>