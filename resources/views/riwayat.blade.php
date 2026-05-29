<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/riwayat.css') }}">
     <link rel="icon" type="image/png" href="/logo.png">
    @vite('resources/css/riwayat.css')
</head>

<body>

    @include('Pages.Navbar')

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
                    Total Dana: Rp {{ number_format($data->sum('total'), 0, ',', '.') }}
                </div>

            </div>

            <div class="row mb-4">

                <div class="col-md-4">

                    <input type="text" id="searchInput" class="form-control search-box" placeholder="Cari nama...">

                </div>

                <div class="col-md-3">

                    <form method="GET">

                        <select name="tahun" class="form-select" onchange="this.form.submit()">

                            <option value="">Semua Tahun</option>

                            @foreach ($tahunList as $th)
                                <option value="{{ $th }}" {{ $tahun == $th ? 'selected' : '' }}>
                                    {{ $th }}
                                </option>
                            @endforeach

                        </select>

                    </form>

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

                        @foreach ($data as $index => $item)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
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

                                    @if ($item->zakat_fitrah_kg > 0)
                                        <span class="badge-beras">
                                            {{ number_format($item->zakat_fitrah_kg, 2) }} Kg Beras
                                        </span>
                                    @else
                                        <span class="badge-total">
                                            Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </span>
                                    @endif

                                </td>


                                <td>

                                    @if (($item->metode_pembayaran ?? 'cash') === 'transfer')
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

                                        <a href="{{ route('cetak', $item->id) }}"
                                            class="btn btn-sm btn-outline-success">
                                            Cetak
                                        </a>

                                        <a href="{{ route('edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                        <form action="{{ route('hapus', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger">
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

        searchInput.addEventListener('keyup', function() {

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
