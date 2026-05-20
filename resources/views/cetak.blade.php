<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kuitansi Zakat</title>

<style>

@page{
size:58mm auto;
margin:0;
}

body{
margin:0;
padding:0;
background:#f4f4f4;
font-family:"Courier New", monospace;
font-size:12px;
display:flex;
flex-direction:column;
align-items:center;
}

.paper{
width:56mm;
background:#fff;
padding:4mm 3mm;
box-sizing:border-box;
margin-top:20px;
box-shadow:0 0 8px rgba(0,0,0,0.15);
}

.center{
text-align:center;
}

.bold{
font-weight:bold;
}

.logo{
width:34px;
display:block;
margin:0 auto 4px auto;
}

.title{
font-size:13px;
font-weight:bold;
text-align:center;
}

.subtitle{
font-size:10px;
text-align:center;
line-height:1.3;
}

.line{
border-top:1px dashed #000;
margin:6px 0;
}

.row{
display:flex;
justify-content:space-between;
margin:2px 0;
}

.label{
width:60%;
}

.value{
width:40%;
text-align:right;
}

.total{
border-top:1px solid #000;
border-bottom:1px solid #000;
margin-top:6px;
padding:3px 0;
font-weight:bold;
}

.signature{
margin-top:22px;
text-align:center;
font-size:10px;
}

.control-box{
margin-top:20px;
display:flex;
gap:10px;
}

button{
padding:10px 18px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:14px;
font-weight:bold;
}

.btn-print{
background:#16a34a;
color:white;
}

.btn-back{
background:#e5e7eb;
}

@media print{

body{
background:white;
}

.paper{
margin:0;
box-shadow:none;
}

.control-box{
display:none;
}

}

</style>
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