
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kuitansi Zakat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/logo.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600;700;800&display=swap');

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#eceff3;
            font-family:'Inter',sans-serif;
            padding:20px;
        }

        .wrapper{
            display:flex;
            justify-content:center;
            align-items:flex-start;
            gap:30px;
            flex-wrap:wrap;
        }

        /* RP58 WIDTH */
        .receipt{
            width:220px;
            background:#fff;
            padding:14px;
            border-radius:18px;
            box-shadow:0 8px 20px rgba(0,0,0,.08);
            color:#111827;
        }

        .logo{
            width:44px;
            display:block;
            margin:0 auto 8px;
        }

        .title{
            text-align:center;
            font-size:16px;
            font-weight:800;
            line-height:1.2;
        }

        .subtitle{
            text-align:center;
            font-size:10px;
            font-weight:700;
            line-height:1.5;
            color:#4b5563;
            margin-top:6px;
        }

        .divider{
            border-top:1px dashed #bdbdbd;
            margin:12px 0;
        }

        .section-title{
            font-size:12px;
            font-weight:800;
            margin-bottom:10px;
        }

        .row{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:8px;
            margin-bottom:8px;
        }

        .label{
            width:82px;
            font-size:10px;
            font-weight:800;
            color:#374151;
        }

        .value{
            flex:1;
            text-align:right;
            font-size:10px;
            font-weight:800;
            word-break:break-word;
        }

        .total-box{
            border-top:2px solid #d1d5db;
            border-bottom:2px solid #d1d5db;
            padding:8px 0;
            margin-top:10px;
        }

        .total{
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:13px;
            font-weight:800;
        }

        .date{
            text-align:center;
            font-size:10px;
            font-weight:800;
            margin-top:18px;
        }

        .signature{
            margin-top:42px;
            text-align:center;
        }

        .signature-line{
            width:110px;
            border-top:1px solid #000;
            margin:0 auto 6px;
        }

        .signature span{
            font-size:10px;
            font-weight:800;
        }

        .doa-card{
            width:580px;
            background:#fff;
            border-radius:22px;
            padding:28px;
            box-shadow:0 8px 20px rgba(0,0,0,.08);
        }

        .doa-title{
            text-align:center;
            font-size:26px;
            font-weight:800;
            margin-bottom:24px;
        }

        .doa-section{
            margin-bottom:28px;
        }

        .doa-section h4{
            font-size:18px;
            font-weight:800;
            margin-bottom:12px;
        }

        .arab{
            font-size:30px;
            line-height:2;
            text-align:right;
            font-weight:700;
            margin-bottom:10px;
        }

        .latin{
            font-style:italic;
            font-weight:700;
            color:#4b5563;
            margin-bottom:10px;
        }

        .arti{
            font-weight:700;
            line-height:1.7;
        }

        .btn-wrap{
            margin-top:24px;
            display:flex;
            justify-content:center;
            gap:12px;
        }

        button{
            border:none;
            border-radius:14px;
            padding:12px 22px;
            cursor:pointer;
            font-weight:800;
        }

        .btn-print{
            background:#16a34a;
            color:#fff;
        }

        .btn-back{
            background:#e5e7eb;
        }

        @page{
            size:58mm auto;
            margin:0;
        }

        @media print{

            body{
                background:#fff;
                padding:0;
            }

            .doa-card,
            .btn-wrap{
                display:none !important;
            }

            .receipt{
                width:58mm;
                border-radius:0;
                box-shadow:none;
                padding:6px;
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

    $jumlahJiwa = $jumlahJiwa ?? 1;

    $total =
        $fitrah +
        $infaq +
        $mal +
        $fidya;
@endphp

<div class="wrapper">

    <div>

        <div class="receipt">

            <img src="{{ asset('logo.png') }}" class="logo">

            <div class="title">
                MASJID NURUL HIKMAH
            </div>

            <div class="subtitle">
                Jl. Raya Gading Tutuka No.17<br>
                Soreang - Bandung
            </div>

            <div class="divider"></div>

            <div class="row">
                <div class="label">Nama</div>
                <div class="value">{{ $nama }}</div>
            </div>

            <div class="row">
                <div class="label">Alamat</div>
                <div class="value">{{ $alamat ?: '-' }}</div>
            </div>

            <div class="row">
                <div class="label">Jumlah Jiwa</div>
                <div class="value">{{ $jumlahJiwa }} Jiwa</div>
            </div>

            <div class="divider"></div>

            <div class="section-title">
                Rincian Pembayaran
            </div>

            @if($fitrah > 0)
            <div class="row">
                <div class="label">Zakat Fitrah</div>
                <div class="value">
                    Rp {{ number_format($fitrah,0,',','.') }}
                </div>
            </div>
            @endif

            @if($kg > 0)
            <div class="row">
                <div class="label">Beras</div>
                <div class="value">
                    {{ $kg }} KG
                </div>
            </div>
            @endif

            @if($infaq > 0)
            <div class="row">
                <div class="label">Infaq</div>
                <div class="value">
                    Rp {{ number_format($infaq,0,',','.') }}
                </div>
            </div>
            @endif

            @if($mal > 0)
            <div class="row">
                <div class="label">Zakat Mal</div>
                <div class="value">
                    Rp {{ number_format($mal,0,',','.') }}
                </div>
            </div>
            @endif

            @if($fidya > 0)
            <div class="row">
                <div class="label">Fidya</div>
                <div class="value">
                    Rp {{ number_format($fidya,0,',','.') }}
                </div>
            </div>
            @endif

            <div class="total-box">
                <div class="total">
                    <span>TOTAL</span>
                    <span>
                        Rp {{ number_format($total,0,',','.') }}
                    </span>
                </div>
            </div>

            <div class="date">
                Bandung,
                {{ now()->timezone('Asia/Jakarta')->format('d F Y') }}
            </div>

            <div class="signature">
                <div class="signature-line"></div>
                <span>Petugas</span>
            </div>

        </div>

    </div>

    <div class="doa-card">

        <div class="doa-title">
            Doa Zakat
        </div>

        <div class="doa-section">
            <h4>Doa Membayar Zakat Fitrah</h4>

            <div class="arab">
                نَوَيْتُ أَنْ أُخْرِجَ زَكَاةَ الْفِطْرِ عَنْ نَفْسِي فَرْضًا لِلَّهِ تَعَالَى
            </div>

            <div class="latin">
                Nawaitu an ukhrija zakaatal fitri
                'an nafsi fardhan lillaahi ta'aalaa
            </div>

            <div class="arti">
                “Saya niat mengeluarkan zakat fitrah untuk diri sendiri,
                fardu karena Allah Ta'ala.”
            </div>
        </div>

        <hr>

        <div class="doa-section">
            <h4>Doa Penerimaan Zakat (Amil)</h4>

            <div class="arab">
                اللَّهُمَّ صَلِّ عَلَيْهِمْ
            </div>

            <div class="latin">
                Allahumma shalli 'alaihim
            </div>

            <div class="arti">
                “Ya Allah, limpahkanlah rahmat kepada mereka.”
            </div>
        </div>

    </div>

</div>

<div class="btn-wrap">
    <button class="btn-print" onclick="window.print()">
        Cetak
    </button>

    <button
        class="btn-back"
        onclick="window.location.href='{{ route('riwayat') }}'">
        Kembali
    </button>
</div>

</body>
</html>