<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SADAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" type="image/png" href="/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/zakat.css')
</head>

<body>

    @include('Pages.navbar')

    <div class="container py-5">
        <div class="form-card">

            <h3 class="fw-bold mb-2">Formulir Pembayaran Zakat</h3>
            <p class="text-muted mb-4">Silakan isi data muzakki dan jumlah jiwa yang dizakatkan.</p>

            <form method="POST" action="{{ route('simpan') }}">
                @csrf

                @include('Layouts.input')

                @include('Layouts.RincianPembayaran')
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

        window.pilihJiwa = function(n) {

            document.querySelectorAll(".jiwa-box").forEach(b => {
                b.classList.remove("active");
            });

            event.target.classList.add("active");

            document.getElementById("jumlahJiwa").value = n;

            hitungTotal();

        }

        function angka(v) {
            return parseInt(v.replace(/\./g, '')) || 0;
        }

        function format(v) {
            return v.toLocaleString("id-ID");
        }

        function hitungTotal() {

            let jiwa = parseInt(document.getElementById("jumlahJiwa").value) || 0;

            let metode = document.querySelector('input[name="metode_fitrah"]:checked').value;

            let fitrah = 0;
            let beras = 0;

            if (metode === "uang") {
                fitrah = jiwa * harga;
            } else {
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

        document.querySelectorAll(".rupiah").forEach(input => {

            input.addEventListener("input", function() {

                let angkaOnly = this.value.replace(/\D/g, '');

                this.value = format(parseInt(angkaOnly || 0));

                hitungTotal();

            });

        });
    </script>

</body>

</html>
