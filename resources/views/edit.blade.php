<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
  <link rel="icon" type="image/png" href="/logo.png">
    @vite('resources/css/edit.css')
</head>

<body>

    <div class="container py-5">

        <div class="card-box">

            <h3 class="mb-4 fw-bold">
                Edit Transaksi
            </h3>

            <form method="POST" action="{{ route('update', $data->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}">
                </div>


                <!-- METODE ZAKAT -->

                <div class="mb-3">
                    <label class="mb-2">Metode Zakat Fitrah</label>

                    <div class="d-flex gap-3">

                        <label>
                            <input type="radio" name="metode" value="uang"
                                {{ $data->zakat_fitrah_rp > 0 ? 'checked' : '' }} onclick="pilihUang()">
                            Uang
                        </label>

                        <label>
                            <input type="radio" name="metode" value="beras"
                                {{ $data->zakat_fitrah_kg > 0 ? 'checked' : '' }} onclick="pilihBeras()">
                            Beras
                        </label>

                    </div>
                </div>


                <div class="mb-3">
                    <label>Zakat Fitrah (Rp)</label>
                    <input type="number" name="fitrah" id="fitrah" class="form-control"
                        value="{{ $data->zakat_fitrah_rp }}">
                </div>

                <div class="mb-3">
                    <label>Zakat Fitrah Beras (KG)</label>
                    <input type="number" step="0.1" name="kg" id="kg" class="form-control"
                        value="{{ $data->zakat_fitrah_kg }}">
                </div>


                <div class="mb-3">
                    <label>Zakat Mal</label>
                    <input type="number" name="mal" class="form-control" value="{{ $data->zakat_mal }}">
                </div>

                <div class="mb-3">
                    <label>Infaq</label>
                    <input type="number" name="infaq" class="form-control" value="{{ $data->infaq_shodaqoh }}">
                </div>

                <div class="mb-3">
                    <label>Fidya</label>
                    <input type="number" name="fidya" class="form-control" value="{{ $data->fidya }}">
                </div>


                <!-- METODE PEMBAYARAN -->

                <div class="mb-4">
                    <label class="mb-2">Metode Pembayaran</label>

                    <div class="d-flex gap-3">

                        <label>
                            <input type="radio" name="metode_pembayaran" value="cash"
                                {{ $data->metode_pembayaran == 'cash' ? 'checked' : '' }}>
                            Cash
                        </label>

                        <label>
                            <input type="radio" name="metode_pembayaran" value="transfer"
                                {{ $data->metode_pembayaran == 'transfer' ? 'checked' : '' }}>
                            Transfer
                        </label>

                    </div>

                </div>


                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-success">
                        Update Data
                    </button>

                    <a href="{{ route('riwayat') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

    <script>
        function pilihUang() {
            document.getElementById("kg").value = 0;
        }

        function pilihBeras() {
            document.getElementById("fitrah").value = 0;
        }
    </script>

</body>

</html>
