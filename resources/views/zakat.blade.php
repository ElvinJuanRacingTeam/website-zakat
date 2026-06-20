<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SADAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="/log0.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/zakat.css')
    @vite('resources/js/Zakatlogic.js')
</head>

<body>

    @include('Pages.Navbar')

    <div class="container py-5">
        <div class="form-card">

            <h3 class="fw-bold mb-2">
                Zakat Payment Form
            </h3>

            <p class="text-muted mb-4">
                Please fill in the muzakki information and the number of family members covered by the zakat payment.
            </p>

            <form method="POST" action="{{ route('simpan') }}">
                @csrf

                @include('Layouts.Input')
                @include('Layouts.RincianPembayaran')

                <div class="mt-4 text-end">
                    <button type="submit" class="btn-green">
                        ✔ Save & Print Receipt
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>

    </script>

</body>

</html>