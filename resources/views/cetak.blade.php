<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kuitansi Zakat</title>

@vite('resources/css/cetak.css')
</head>

<body>

@php
$fitrah = $fitrah ?? 0;
$kg = $kg ?? 0;
$infaq = $infaq ?? 0;
$shodaqoh = $shodaqoh ?? 0;
$mal = $mal ?? 0;
$fidya = $fidya ?? 0;

$total_uang = $fitrah + $infaq + $shodaqoh + $mal + $fidya;
@endphp

<div class="paper">

<img src="{{ asset('logo.png') }}" class="logo">

<div class="title">MASJID NURUL HIKMAH</div>

<div class="subtitle">
Jl. Raya Gading Tutuka No.17<br>
Soreang - Bandung
</div>

<div class="line"></div>

<div class="row">
<div class="label">Sudah Terima Dari</div>
<div class="value">{{ $nama }}</div>
</div>

<div class="row">
<div class="label">Alamat</div>
<div class="value">{{ $alamat }}</div>
</div>

<div class="line"></div>

<div class="bold">Rincian Pembayaran</div>

<div class="row">
<div class="label">Infaq</div>
<div class="value">Rp {{ number_format($infaq,0,',','.') }}</div>
</div>

<div class="row">
<div class="label">Shodaqoh</div>
<div class="value">Rp {{ number_format($shodaqoh,0,',','.') }}</div>
</div>

<div class="row">
<div class="label">Zakat Mal</div>
<div class="value">Rp {{ number_format($mal,0,',','.') }}</div>
</div>

<div class="row">
<div class="label">Fidya</div>
<div class="value">Rp {{ number_format($fidya,0,',','.') }}</div>
</div>

<div class="total">

<div class="row">
<div class="label">TOTAL UANG</div>
<div class="value">Rp {{ number_format($total_uang,0,',','.') }}</div>
</div>

</div>

<br>

<div class="center">
Bandung, {{ now()->timezone('Asia/Jakarta')->format('d F Y') }}
</div>

<div class="signature">

<br><br>

_________________<br>
Petugas

</div>

</div>

<div class="control-box">

<button class="btn-print" onclick="window.print()">Cetak</button>

<button class="btn-back" onclick="window.location.href='{{ route('riwayat') }}'">
Kembali
</button>

</div>

</body>
</html>