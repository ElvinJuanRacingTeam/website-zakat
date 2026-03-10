<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Transaksi</title>
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

.summary-card{
background:#16a34a;
color:white;
border-radius:16px;
padding:20px 30px;
display:flex;
justify-content:space-between;
align-items:center;
font-weight:600;
margin-bottom:30px;
}

.search-box{
border-radius:12px;
padding:12px 16px;
border:1px solid #e5e7eb;
}

.table thead{
background:#f9fafb;
}

.table th{
font-size:13px;
color:#6b7280;
text-transform:uppercase;
letter-spacing:.5px;
}

.table td{
vertical-align:middle;
}

.badge-total{
background:#e0f2fe;
color:#0369a1;
font-weight:600;
padding:8px 12px;
border-radius:10px;
}

.badge-beras{
background:#dcfce7;
color:#166534;
font-weight:600;
padding:8px 12px;
border-radius:10px;
}

.badge-cash{
background:#fef3c7;
color:#92400e;
font-weight:600;
padding:8px 12px;
border-radius:10px;
}

.badge-transfer{
background:#e0e7ff;
color:#3730a3;
font-weight:600;
padding:8px 12px;
border-radius:10px;
}

.action-buttons{
display:flex;
gap:6px;
}

.btn-sm{
font-size:12px;
padding:4px 10px;
border-radius:8px;
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

<a href="/" class="nav-menu {{ request()->is('/') ? 'active' : '' }}">
Input Baru
</a>

<a href="{{ route('riwayat') }}" class="nav-menu {{ request()->routeIs('riwayat') ? 'active' : '' }}">
Riwayat
</a>

<a href="{{ route('laporan') }}" class="nav-menu {{ request()->routeIs('laporan') ? 'active' : '' }}">
Laporan
</a>

</div>

</nav>


<div class="container py-5">

<div class="page-card">

<h3 class="fw-bold mb-4">
Riwayat Transaksi
</h3>


<div class="summary-card">

<div>
Total Transaksi: {{ $data->count() }}
</div>

<div>
Total Dana: Rp {{ number_format($data->sum('total'),0,',','.') }}
</div>

</div>


<div class="row mb-4">

<div class="col-md-4">

<input
type="text"
id="searchInput"
class="form-control search-box"
placeholder="Cari nama..."
>

</div>

</div>


<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>
<th>#</th>
<th>Nama</th>
<th>Alamat</th>
<th>Tanggal</th>
<th>Pembayaran</th>
<th>Metode</th>
<th>Aksi</th>
</tr>

</thead>

<tbody id="tableBody">

@foreach($data as $index => $item)

<tr>

<td>
{{ $index+1 }}
</td>

<td class="nama-cell">
{{ $item->nama }}
</td>

<td>
{{ $item->alamat }}
</td>

<td>
{{ $item->created_at->format('d M Y') }}
</td>

<td>

@if($item->zakat_fitrah_kg > 0)

<span class="badge-beras">
{{ number_format($item->zakat_fitrah_kg,2) }} Kg Beras
</span>

@else

<span class="badge-total">
Rp {{ number_format($item->total,0,',','.') }}
</span>

@endif

</td>


<td>

@if(($item->metode_pembayaran ?? 'cash') === 'transfer')

<span class="badge-transfer">
Transfer
</span>

@else

<span class="badge-cash">
Cash
</span>

@endif

</td>


<td>

<div class="action-buttons">

<a
href="{{ route('cetak',$item->id) }}"
class="btn btn-sm btn-outline-success"
>
Cetak
</a>

<a
href="{{ route('edit',$item->id) }}"
class="btn btn-sm btn-outline-primary"
>
Edit
</a>

<form
action="{{ route('hapus',$item->id) }}"
method="POST"
onsubmit="return confirm('Yakin ingin menghapus data ini?')"
>

@csrf
@method('DELETE')

<button
type="submit"
class="btn btn-sm btn-outline-danger"
>
Hapus
</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>


<script>

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function(){

const filter = this.value.toLowerCase();
const rows = document.querySelectorAll('#tableBody tr');

rows.forEach(row => {

const nama = row.querySelector('.nama-cell').innerText.toLowerCase();

row.style.display = nama.includes(filter) ? '' : 'none';

});

});

</script>

</body>
</html>