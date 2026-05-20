<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>ZakatHub</title>
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

.form-card{
background:#ffffff;
border-radius:18px;
padding:48px;
box-shadow:0 20px 40px rgba(0,0,0,0.06);
}

.section-title{
font-size:12px;
font-weight:700;
color:#6b7280;
letter-spacing:.7px;
margin-bottom:20px;
}

.form-label{
font-size:14px;
font-weight:600;
margin-bottom:6px;
}

.form-control{
border-radius:12px;
padding:14px;
border:1px solid #e5e7eb;
}

.btn-green{
background:#16a34a;
color:#fff;
border:none;
padding:14px 30px;
font-weight:600;
border-radius:14px;
}

.total-box{
background:#ecfdf5;
padding:18px;
border-radius:14px;
border:1px solid #bbf7d0;
font-weight:700;
font-size:18px;
}

.jiwa-grid{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:10px;
}

.jiwa-box{
border:1px solid #e5e7eb;
border-radius:12px;
padding:12px;
text-align:center;
cursor:pointer;
font-weight:600;
}

.jiwa-box.active{
background:#16a34a;
color:white;
border-color:#16a34a;
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
<a href="/" class="nav-menu active">Input Baru</a>
<a href="{{ route('riwayat') }}" class="nav-menu">Riwayat</a>
<a href="{{ route('laporan') }}" class="nav-menu">Laporan</a>
</div>

</nav>

<div class="container py-5">
<div class="form-card">

<h3 class="fw-bold mb-2">Formulir Pembayaran Zakat</h3>
<p class="text-muted mb-4">Silakan isi data muzakki dan jumlah jiwa yang dizakatkan.</p>

<form method="POST" action="{{ route('simpan') }}">
@csrf

<div class="row g-5">

<div class="col-md-6">

<div class="section-title">INFORMASI PEMBAYAR</div>

<div class="mb-4">
<label class="form-label">Nama Lengkap</label>
<input name="nama" class="form-control" required>
</div>

<div class="mb-4">
<label class="form-label">Alamat</label>
<input name="alamat" class="form-control" required>
</div>

<div class="mb-4">

<label class="form-label">Jumlah Jiwa</label>

<div class="jiwa-grid">

<div class="jiwa-box" onclick="pilihJiwa(1)">1 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(2)">2 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(3)">3 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(4)">4 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(5)">5 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(6)">6 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(7)">7 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(8)">8 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(9)">9 Jiwa</div>
<div class="jiwa-box" onclick="pilihJiwa(10)">10 Jiwa</div>

</div>

<input type="hidden" id="jumlahJiwa" value="0">

</div>

</div>

<div class="col-md-6">

<div class="section-title">RINCIAN PEMBAYARAN</div>

<div class="mb-3">

<label class="form-label">Metode Zakat Fitrah</label>

<div class="d-flex gap-3">
<label><input type="radio" name="metode_fitrah" value="uang" checked onchange="hitungTotal()"> Uang</label>
<label><input type="radio" name="metode_fitrah" value="beras" onchange="hitungTotal()"> Beras</label>
</div>

</div>

<div class="mb-4">

<label class="form-label">Zakat Fitrah</label>

<div class="row">

<div class="col-8">
<input name="fitrah" id="fitrah" class="form-control" readonly>
</div>

<div class="col-4">
<input name="kg" id="kg" class="form-control" readonly placeholder="KG">
</div>

</div>

<small class="text-muted">
Rp 40.000 / jiwa | 2.5 KG beras
</small>

</div>

<div class="mb-3">
<label class="form-label">Infaq / Shodaqoh</label>
<input id="infaq" class="form-control rupiah" placeholder="0">
<input type="hidden" name="infaq">
</div>

<div class="row">

<div class="col-6">
<label class="form-label">Zakat Mal</label>
<input id="mal" class="form-control rupiah" placeholder="0">
<input type="hidden" name="mal">
</div>

<div class="col-6">
<label class="form-label">Fidya</label>
<input id="fidya" class="form-control rupiah" placeholder="0">
<input type="hidden" name="fidya">
</div>

</div>

<div class="col-12 mt-4">
<div class="total-box">
Total Bayar : Rp <span id="totalBayar">0</span>
<input type="hidden" name="total" id="totalInput">
</div>
</div>

<div class="mt-4">

<label class="form-label">Metode Pembayaran</label>

<div class="d-flex gap-3">

<label>
<input type="radio" name="metode_pembayaran" value="cash" checked>
Cash
</label>

<label>
<input type="radio" name="metode_pembayaran" value="transfer">
Transfer
</label>

</div>

</div>

</div>

</div>

<div class="mt-5 text-end">
<button type="submit" class="btn-green">
✔ Simpan & Cetak Kuitansi
</button>
</div>

</form>

</div>
</div>

<script>

const harga = 40000;
const kg = 2.5;

function pilihJiwa(n){

document.querySelectorAll(".jiwa-box").forEach(b=>{
b.classList.remove("active");
});

event.target.classList.add("active");

document.getElementById("jumlahJiwa").value = n;

hitungTotal();

}

function angka(v){
return parseInt(v.replace(/\./g,'')) || 0;
}

function format(v){
return v.toLocaleString("id-ID");
}

function hitungTotal(){

let jiwa = parseInt(document.getElementById("jumlahJiwa").value);

let metode = document.querySelector('input[name="metode_fitrah"]:checked').value;

let fitrah = 0;
let beras = 0;

if(metode==="uang"){
fitrah = jiwa * harga;
}else{
beras = jiwa * kg;
}

document.getElementById("fitrah").value = fitrah ? format(fitrah) : 0;
document.getElementById("kg").value = beras;

let infaq = angka(document.getElementById("infaq").value);
let mal = angka(document.getElementById("mal").value);
let fidya = angka(document.getElementById("fidya").value);

document.querySelector("input[name='infaq']").value = infaq;
document.querySelector("input[name='mal']").value = mal;
document.querySelector("input[name='fidya']").value = fidya;

let total = fitrah + infaq + mal + fidya;

document.getElementById("totalBayar").innerText = format(total);
document.getElementById("totalInput").value = total;

}

document.querySelectorAll(".rupiah").forEach(input=>{

input.addEventListener("input", function(){

let angkaOnly = this.value.replace(/\D/g,'');

this.value = format(parseInt(angkaOnly || 0));

hitungTotal();

});

});

</script>

</body>
</html>