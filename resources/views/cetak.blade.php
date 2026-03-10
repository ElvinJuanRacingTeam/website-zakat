<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kuitansi Zakat</title>

<style>

@page{
size:80mm auto;
margin:0;
}

body{
font-family:"Courier New", monospace;
font-size:12px;
margin:0;
background:#f3f4f6;
}

.paper{
width:78mm;
margin:auto;
background:white;
padding:8px;
}

.center{text-align:center;}
.right{text-align:right;}
.bold{font-weight:bold;}

.logo{
width:55px;
margin-bottom:4px;
}

.title{
font-weight:bold;
font-size:14px;
}

.subtitle{
font-size:11px;
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

.total{
border-top:1px solid #000;
border-bottom:1px solid #000;
padding:4px 0;
margin-top:6px;
}

.signature{
margin-top:20px;
text-align:center;
font-size:11px;
}

.control-box{
text-align:center;
margin:20px 0;
}

.btn{
padding:8px 16px;
border-radius:6px;
border:none;
cursor:pointer;
font-size:13px;
}

.btn-print{
background:#16a34a;
color:white;
}

.btn-back{
background:#e5e7eb;
margin-left:6px;
}

@media print{
body{background:white;}
.control-box{display:none;}
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

/* TOTAL UANG */
$total_uang = $fitrah + $infaq + $shodaqoh + $mal + $fidya;

/* TOTAL BERAS */
$total_beras = $kg;

@endphp


<div class="paper">

<div class="center">

<img src="{{ asset('logo.png') }}" class="logo">

<div class="title">MASJID NURUL HIKMAH</div>

<div class="subtitle">
Jl. Raya Gading Tutuka No.17<br>
Soreang - Bandung
</div>

</div>

<div class="line"></div>

<div class="row">
<div>Sudah Terima Dari</div>
<div>{{ $nama }}</div>
</div>

<div class="row">
<div>Alamat</div>
<div>{{ $alamat }}</div>
</div>

@if(!empty($atas_nama) && count($atas_nama) > 0)

<div class="line"></div>

<div class="bold">Atas Nama</div>

@foreach($atas_nama as $item)
@if(!empty($item))
<div>- {{ $item }}</div>
@endif
@endforeach

@endif


<div class="line"></div>

<div class="bold">Rincian Pembayaran</div>


@if($kg > 0)

<div class="row">
<div>Zakat Fitrah</div>
<div class="right">{{ number_format($kg,2) }} Kg</div>
</div>

@endif

<div class="row">
<div>Infaq</div>
<div class="right">Rp {{ number_format($infaq,0,',','.') }}</div>
</div>

<div class="row">
<div>Shodaqoh</div>
<div class="right">Rp {{ number_format($shodaqoh,0,',','.') }}</div>
</div>

<div class="row">
<div>Zakat Mal</div>
<div class="right">Rp {{ number_format($mal,0,',','.') }}</div>
</div>

<div class="row">
<div>Fidya</div>
<div class="right">Rp {{ number_format($fidya,0,',','.') }}</div>
</div>


<div class="total bold">

@if($total_beras > 0)

<div class="row">
<div>TOTAL BERAS</div>
<div class="right">{{ number_format($total_beras,2) }} Kg</div>
</div>

@endif

<div class="row">
<div>TOTAL UANG</div>
<div class="right">Rp {{ number_format($total_uang,0,',','.') }}</div>
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

<button class="btn btn-print" onclick="window.print()">
Cetak
</button>

<button class="btn btn-back" onclick="window.location.href='{{ route('riwayat') }}'">
Kembali
</button>

</div>

</body>
</html>