<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Zakat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@vite('resources/css/laporan.css')
</head>

<body>

@include('Pages.Navbar')



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