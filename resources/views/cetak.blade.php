<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zakat Payment Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/log0.png">

    <style>
        /* ================= RESET & GLOBALS ================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #eceff3;
            /* Menggunakan Courier New sebagai standar struk yang rapi dan seragam */
            font-family: 'Courier New', Courier, monospace; 
            padding: 20px;
            color: #000;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* ================= RECEIPT ================= */
        .receipt {
            width: 58mm;
            min-width: 58mm;
            max-width: 58mm;
            background: #fff;
            padding: 4mm;
            color: #000;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .1);
        }

        .logo {
            width: 40px;
            display: block;
            margin: 0 auto 8px;
            /* Opsional: filter grayscale agar lebih realistis untuk print thermal */
            filter: grayscale(100%); 
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.3;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        /* -- Bagian Info Biodata -- */
        .info-row {
            display: flex;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .info-label {
            width: 60px; /* Lebar tetap agar titik dua sejajar */
            flex-shrink: 0;
        }

        .info-value {
            flex-grow: 1;
            word-break: break-word;
        }

        .section-title {
            font-size: 11px;
            font-weight: 900;
            margin-bottom: 8px;
            text-transform: uppercase;
            text-align: center;
        }

        /* -- Bagian Detail Pembayaran -- */
        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .payment-label {
            flex: 1;
            padding-right: 5px;
        }

        .payment-value {
            text-align: right;
            white-space: nowrap;
        }

        .total-box {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 6px 0;
            margin-top: 8px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 900;
        }

        .date {
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            margin-top: 12px;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
        }

        .signature-line {
            width: 100px;
            border-top: 1px solid #000;
            margin: 0 auto 4px;
        }

        .signature span {
            font-size: 10px;
            font-weight: 700;
        }

        /* ================= DOA CARD ================= */
        .doa-card {
            width: 580px;
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            font-family: Arial, sans-serif; /* Kembalikan ke Arial untuk kartu doa */
        }

        .doa-title {
            text-align: center;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .doa-section {
            margin-bottom: 24px;
        }

        .doa-section h4 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 14px;
            color: #1f2937;
        }

        .arab {
            font-size: 28px;
            line-height: 1.8;
            text-align: right;
            font-weight: 700;
            margin-bottom: 12px;
            font-family: "Traditional Arabic", serif;
        }

        .latin {
            font-style: italic;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .arti {
            font-weight: 500;
            line-height: 1.6;
            color: #111827;
        }

        hr {
            border: 0;
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }

        /* ================= BUTTONS ================= */
        .btn-wrap {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            gap: 12px;
            width: 100%;
        }

        button {
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            cursor: pointer;
            font-weight: 700;
            font-family: Arial, sans-serif;
            transition: 0.2s;
        }

        .btn-print {
            background: #16a34a;
            color: #fff;
        }

        .btn-print:hover { background: #15803d; }

        .btn-back {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-back:hover { background: #d1d5db; }

        /* ================= PRINT SETTINGS ================= */
        @media print {
            @page {
                size: 58mm auto;
                margin: 0;
            }

            body {
                background: #fff;
                padding: 0;
                margin: 0;
            }

            .wrapper {
                display: block;
            }

            /* Sembunyikan elemen yang tidak perlu di-print */
            .doa-card,
            .btn-wrap {
                display: none !important;
            }

            /* Penyesuaian struk agar pas di area cetak 58mm (area cetak asli ~48mm) */
            .receipt {
                width: 100%;
                max-width: 100%;
                min-width: 100%;
                margin: 0;
                padding: 2mm; /* Kurangi padding agar lebih lega untuk konten */
                border-radius: 0;
                box-shadow: none;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    @php
        $fitrah = $fitrah ?? 0;
        $kg = $kg ?? 0;
        $infaq = $infaq ?? 0;
        $mal = $mal ?? 0;
        $fidya = $fidya ?? 0;
        $jumlahJiwa = $jumlahJiwa ?? 0;

        $total = $fitrah + $infaq + $mal + $fidya;
    @endphp

    <div class="wrapper">
        <!-- STRUK THERMAL -->
        <div>
            <div class="receipt">
                <img src="{{ asset('log0.png') }}" class="logo" alt="Logo">

                <div class="title">
                    MASJID NURUL HIKMAH
                </div>

                <div class="subtitle">
                    Jl. Raya Gading Tutuka No.17<br>
                    Soreang - Bandung
                </div>

                <div class="divider"></div>

                <!-- Bagian Info Biodata -->
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">: {{ $nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Address</span>
                    <span class="info-value">: {{ $alamat ?: '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Persons</span>
                    <span class="info-value">: {{ $jumlahJiwa }}</span>
                </div>

                <div class="divider"></div>

                <div class="section-title">
                    -- Payment Details --
                </div>

                <!-- Bagian Nominal Zakat -->
                @if ($kg > 0)
                    <div class="payment-row">
                        <div class="payment-label">Rice (Cmdty)</div>
                        <div class="payment-value">{{ $kg }} KG</div>
                    </div>
                @endif

                @if ($infaq > 0)
                    <div class="payment-row">
                        <div class="payment-label">Infaq</div>
                        <div class="payment-value">Rp {{ number_format($infaq, 0, ',', '.') }}</div>
                    </div>
                @endif

                @if ($mal > 0)
                    <div class="payment-row">
                        <div class="payment-label">Zakat Mal</div>
                        <div class="payment-value">Rp {{ number_format($mal, 0, ',', '.') }}</div>
                    </div>
                @endif

                @if ($fidya > 0)
                    <div class="payment-row">
                        <div class="payment-label">Fidyah</div>
                        <div class="payment-value">Rp {{ number_format($fidya, 0, ',', '.') }}</div>
                    </div>
                @endif

                <div class="total-box">
                    <div class="total">
                        <span>TOTAL</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="date">
                    Bandung, {{ now()->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                </div>

                <div class="signature">
                    <div class="signature-line"></div>
                    <span>Authorized Officer</span>
                </div>
            </div>
        </div>

        <!-- KARTU DOA -->
        <div class="doa-card">
            <div class="doa-title">
                Zakat Supplication (Du'a)
            </div>

            <div class="doa-section">
                <h4>Du'a for Paying Zakat Fitrah</h4>
                <div class="arab">
                    نَوَيْتُ أَنْ أُخْرِجَ زَكَاةَ الْفِطْرِ عَنْ نَفْسِي فَرْضًا لِلَّهِ تَعَالَى
                </div>
                <div class="latin">
                    Nawaitu an ukhrija zakaatal fitri 'an nafsi fardhan lillaahi ta'aalaa
                </div>
                <div class="arti">
                    "I intend to pay Zakat Fitrah for myself, as an obligatory act for the sake of Allah the Almighty."
                </div>
            </div>

            <hr>

            <div class="doa-section">
                <h4>Du'a for Receiving Zakat (Amil)</h4>
                <div class="arab">
                    اللَّهُمَّ صَلِّ عَلَيْهِمْ
                </div>
                <div class="latin">
                    Allahumma shalli 'alaihim
                </div>
                <div class="arti">
                    "O Allah, bestow Your blessings and mercy upon them."
                </div>
            </div>
        </div>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="btn-wrap">
        <button class="btn-print" onclick="window.print()">
            Print Receipt
        </button>
        <button class="btn-back" onclick="window.location.href='{{ route('riwayat') }}'">
            Back
        </button>
    </div>

</body>
</html>