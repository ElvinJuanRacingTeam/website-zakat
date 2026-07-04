<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zakat Payment Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/log0.png">

    <style>
        body{
    font-family: Arial, sans-serif;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#eceff3;
    font-family:Arial, Helvetica, sans-serif;
    padding:20px;
    color:#000;
}

.wrapper{
    display:flex;
    justify-content:center;
    align-items:flex-start;
    gap:30px;
    flex-wrap:wrap;
}

/* ================= RECEIPT ================= */

.receipt{
    width:58mm;
    min-width:58mm;
    max-width:58mm;
    background:#fff;
    padding:3mm;
    color:#000;
    border-radius:16px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.logo{
    width:32px;
    display:block;
    margin:0 auto 6px;
}

.title{
    text-align:center;
    font-size:16px;
    font-weight:900;
    line-height:1.2;
}

.subtitle{
    text-align:center;
    font-size:10px;
    font-weight:700;
    line-height:1.4;
    margin-top:5px;
}

.divider{
    border-top:1px dashed #000;
    margin:10px 0;
}

.section-title{
    font-size:12px;
    font-weight:900;
    margin-bottom:8px;
}

.row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:4px;
    margin-bottom:6px;
}

.label{
    width:72px;
    font-size:10px;
    font-weight:900;
    color:#000;
}

.value{
    flex:1;
    text-align:right;
    font-size:10px;
    font-weight:900;
    color:#000;
    word-break:break-word;
    overflow-wrap:anywhere;
}

.total-box{
    border-top:2px solid #000;
    border-bottom:2px solid #000;
    padding:6px 0;
    margin-top:8px;
}

.total{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:12px;
    font-weight:900;
}

.date{
    text-align:center;
    font-size:10px;
    font-weight:900;
    margin-top:16px;
}

.signature{
    margin-top:32px;
    text-align:center;
}

.signature-line{
    width:90px;
    border-top:1px solid #000;
    margin:0 auto 5px;
}

.signature span{
    font-size:10px;
    font-weight:900;
}

/* ================= DOA ================= */

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

/* ================= BUTTON ================= */

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

/* ================= PRINT ================= */

@page{
    size:58mm auto;
    margin:0;
}

@media print{

    html,
    body{
        width:58mm;
        margin:0;
        padding:0;
        background:#fff;
        color:#000;
    }

    .wrapper{
        display:block;
    }

    .doa-card,
    .btn-wrap{
        display:none !important;
    }

    .receipt{
        width:58mm;
        min-width:58mm;
        max-width:58mm;
        margin:0;
        padding:3mm;
        border-radius:0;
        box-shadow:none;
    }

    *{
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
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

        <div>

            <div class="receipt">

                <img src="{{ asset('log0.png') }}" class="logo">

                <div class="title">
                    MASJID NURUL HIKMAH
                </div>

                <div class="subtitle">
                    Jl. Raya Gading Tutuka No.17<br>
                    Soreang - Bandung
                </div>

                <div class="divider"></div>

                <div class="row">
                    <div class="label">Full Name</div>
                    <div class="value">{{ $nama }}</div>
                </div>

                <div class="row">
                    <div class="label">Address</div>
                    <div class="value">{{ $alamat ?: '-' }}</div>
                </div>

                <div class="row">
                    <div class="label">No. of Persons</div>
                    <div class="value">{{ $jumlahJiwa }} Person(s)</div>
                </div>

                <div class="divider"></div>

                <div class="section-title">
                    Payment Details
                </div>

                @if ($fitrah > 0)
                    <div class="row">
                        <div class="label">Zakat Fitrah</div>
                        <div class="value">
                            Rp {{ number_format($fitrah, 0, ',', '.') }}
                        </div>
                    </div>
                @endif

                @if ($kg > 0)
                    <div class="row">
                        <div class="label">Rice (Commodity)</div>
                        <div class="value">
                            {{ $kg }} KG
                        </div>
                    </div>
                @endif

                @if ($infaq > 0)
                    <div class="row">
                        <div class="label">Infaq</div>
                        <div class="value">
                            Rp {{ number_format($infaq, 0, ',', '.') }}
                        </div>
                    </div>
                @endif

                @if ($mal > 0)
                    <div class="row">
                        <div class="label">Zakat Mal</div>
                        <div class="value">
                            Rp {{ number_format($mal, 0, ',', '.') }}
                        </div>
                    </div>
                @endif

                @if ($fidya > 0)
                    <div class="row">
                        <div class="label">Fidyah</div>
                        <div class="value">
                            Rp {{ number_format($fidya, 0, ',', '.') }}
                        </div>
                    </div>
                @endif

                <div class="total-box">
                    <div class="total">
                        <span>GRAND TOTAL</span>
                        <span>
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="date">
                    Bandung,
                    {{ now()->timezone('Asia/Jakarta')->format('d F Y') }}
                </div>

                <div class="signature">
                    <div class="signature-line"></div>
                    <span>Authorized Officer</span>
                </div>

            </div>

        </div>

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
                    Nawaitu an ukhrija zakaatal fitri
                    'an nafsi fardhan lillaahi ta'aalaa
                </div>

                <div class="arti">
                    "I intend to pay Zakat Fitrah for myself,
                    as an obligatory act for the sake of Allah the Almighty."
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