<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Zakat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f2f4f7;
font-family:system-ui;
}

.navbar-custom{
background:#ffffff;
border-bottom:1px solid #e5e7eb;
padding:16px 32px;
}

.brand-wrapper{
display:flex;
align-items:center;
gap:14px;
}

.brand-logo{
width:56px;
height:56px;
object-fit:contain;
padding:6px;
background:white;
border-radius:14px;
box-shadow:0 6px 16px rgba(0,0,0,0.08);
}

.brand-title{
font-weight:700;
color:#16a34a;
font-size:20px;
}

.brand-sub{
font-size:12px;
color:#16a34a;
font-weight:600;
}

.nav-menu{
text-decoration:none;
color:#374151;
font-weight:600;
padding:8px 16px;
border-radius:999px;
}

.nav-menu.active{
background:#16a34a;
color:white;
}

.page-card{
background:white;
border-radius:18px;
padding:40px;
box-shadow:0 20px 40px rgba(0,0,0,0.06);
}

.summary-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
}

.summary-card{
background:white;
padding:20px;
border-radius:14px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
border-left:5px solid #16a34a;
}

.summary-title{
font-size:13px;
color:#6b7280;
}

.summary-value{
font-size:20px;
font-weight:700;
}

.total-bar{
background:#16a34a;
color:white;
padding:22px;
border-radius:14px;
font-size:18px;
font-weight:700;
display:flex;
justify-content:space-between;
}

.table-modern{
border-radius:14px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.btn-print{
border-radius:12px;
padding:10px 24px;
}

.print-wrapper{
display:none;
}

@media print{

.navbar-custom,
.summary-grid,
.total-bar,
.page-card,
.btn-print{
display:none !important;
}

body{
background:white;
font-family:"Times New Roman", serif;
}

.print-wrapper{
display:block;
}

.print-header{
display:flex;
align-items:center;
gap:20px;
}

.print-logo{
width:100px;
}

.print-title{
font-size:36px;
font-weight:bold;
}

.print-sub{
font-size:16px;
}

.print-line{
border-top:4px double #000;
margin:10px 0 20px;
}

.print-table{
width:100%;
border-collapse:collapse;
}

.print-table th,
.print-table td{
border:1px solid #000;
padding:6px;
font-size:14px;
}

.print-table th{
background:#eee;
}

@page{
size:A4 portrait;
margin:12mm;
}

}

</style>
</head>

<body>

<nav class="navbar-custom d-flex align-items-center">

<div class="brand-wrapper">
<img src="{{ asset('logo.png') }}" class="brand-logo">

<div>
<div class="brand-title">ZakatHub</div>
<div class="brand-sub">MASJID NURUL HIKMAH</div>
</div>
</div>

<div class="ms-auto d-flex gap-3">
<a href="/" class="nav-menu">Input Baru</a>
<a href="{{ route('riwayat') }}" class="nav-menu">Riwayat</a>
<a href="{{ route('laporan') }}" class="nav-menu active">Laporan</a>
</div>

</nav>


<div class="container py-5">

<div class="page-card">

@php
$totalFitrah = $data->sum('zakat_fitrah_rp');
$totalBeras = $data->sum('zakat_fitrah_kg');
$totalMal = $data->sum('zakat_mal');
$totalFidya = $data->sum('fidya');
$totalInfaq = $data->sum('infaq_shodaqoh');
$totalSemua = $data->sum('total');

$totalCash = $data->where('metode_pembayaran','cash')->sum('total');
$totalTransfer = $data->where('metode_pembayaran','transfer')->sum('total');
@endphp


<h3 class="fw-bold mb-4">
Dashboard Laporan Zakat
</h3>


<div class="summary-grid mb-4">

<div class="summary-card">
<div class="summary-title">Total Transaksi</div>
<div class="summary-value">{{ $data->count() }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Zakat Fitrah (Uang)</div>
<div class="summary-value">Rp {{ number_format($totalFitrah,0,',','.') }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Zakat Fitrah (Beras)</div>
<div class="summary-value">{{ number_format($totalBeras,2) }} Kg</div>
</div>

<div class="summary-card">
<div class="summary-title">Infaq</div>
<div class="summary-value">Rp {{ number_format($totalInfaq,0,',','.') }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Zakat Mal</div>
<div class="summary-value">Rp {{ number_format($totalMal,0,',','.') }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Fidya</div>
<div class="summary-value">Rp {{ number_format($totalFidya,0,',','.') }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Pembayaran Cash</div>
<div class="summary-value">Rp {{ number_format($totalCash,0,',','.') }}</div>
</div>

<div class="summary-card">
<div class="summary-title">Pembayaran Transfer</div>
<div class="summary-value">Rp {{ number_format($totalTransfer,0,',','.') }}</div>
</div>

</div>


<div class="total-bar mb-4">
<div>Total Keseluruhan Dana</div>
<div>Rp {{ number_format($totalSemua,0,',','.') }}</div>
</div>


<div class="table-responsive table-modern mb-4">

<table class="table table-bordered">

<thead class="table-light">
<tr>
<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>Fitrah</th>
<th>Zakat Mal</th>
<th>Infaq</th>
<th>Fidya</th>
<th>Total</th>
<th>Metode</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>

@foreach($data as $index=>$item)

<tr>

<td>{{ $index+1 }}</td>
<td>{{ $item->nama }}</td>
<td>{{ $item->alamat }}</td>

<td>
@if($item->zakat_fitrah_kg > 0)
{{ number_format($item->zakat_fitrah_kg,2) }} Kg
@else
Rp {{ number_format($item->zakat_fitrah_rp,0,',','.') }}
@endif
</td>

<td>{{ number_format($item->zakat_mal,0,',','.') }}</td>
<td>{{ number_format($item->infaq_shodaqoh,0,',','.') }}</td>
<td>{{ number_format($item->fidya,0,',','.') }}</td>

<td><strong>{{ number_format($item->total,0,',','.') }}</strong></td>

<td>
@if($item->metode_pembayaran == 'transfer')
<span class="badge bg-primary">Transfer</span>
@else
<span class="badge bg-warning text-dark">Cash</span>
@endif
</td>

<td>{{ $item->created_at->format('d M Y') }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>


<div class="text-end">
<button onclick="window.print()" class="btn btn-success btn-print">
Print Laporan
</button>
</div>

</div>
</div>



<div class="print-wrapper">

<div class="print-header">

<img src="{{ asset('logo.png') }}" class="print-logo">

<div>

<div class="print-title">
MASJID NURUL HIKMAH
</div>

<div class="print-sub">
Komplek Gading Tutuka 1
</div>

<div class="print-sub">
Rekap Daftar Penerima Zakat Fitrah, Zakat Mal, Infaq, Shodaqoh dan Fidya
</div>

</div>

</div>

<div class="print-line"></div>

<p><strong>Detail Transaksi :</strong></p>


<table class="print-table">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>Fitrah</th>
<th>Zakat Mal</th>
<th>Infaq</th>
<th>Fidya</th>
<th>Total</th>
<th>Metode</th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>

@foreach($data as $index=>$item)

<tr>

<td>{{ $index+1 }}</td>
<td>{{ $item->nama }}</td>
<td>{{ $item->alamat }}</td>

<td>
@if($item->zakat_fitrah_kg > 0)
{{ number_format($item->zakat_fitrah_kg,2) }} Kg
@else
{{ number_format($item->zakat_fitrah_rp,0,',','.') }}
@endif
</td>

<td>{{ number_format($item->zakat_mal,0,',','.') }}</td>
<td>{{ number_format($item->infaq_shodaqoh,0,',','.') }}</td>
<td>{{ number_format($item->fidya,0,',','.') }}</td>
<td>{{ number_format($item->total,0,',','.') }}</td>
<td>{{ ucfirst($item->metode_pembayaran) }}</td>
<td>{{ $item->created_at->format('d M Y') }}</td>

</tr>

@endforeach

</tbody>

<tfoot>

<tr>
<th colspan="8" style="text-align:right;">TOTAL UANG</th>
<th colspan="2">Rp {{ number_format($totalSemua,0,',','.') }}</th>
</tr>

<tr>
<th colspan="8" style="text-align:right;">TOTAL BERAS</th>
<th colspan="2">{{ number_format($totalBeras,2) }} Kg</th>
</tr>

</tfoot>

</table>


<p style="margin-top:20px;">
Laporan ini ditarik pada tanggal:
{{ now()->timezone('Asia/Jakarta')->format('d F Y, H:i') }}
</p>

</div>

</body>
</html>