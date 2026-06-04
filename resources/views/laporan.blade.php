<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zakat Financial Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <link rel="icon" type="image/png" href="/logo.png">

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

                $totalCash = $data->where('metode_pembayaran', 'cash')->sum('total');
                $totalTransfer = $data->where('metode_pembayaran', 'transfer')->sum('total');
            @endphp

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div>
                    <h2 class="dashboard-title mb-1">
                        Zakat Report Dashboard
                    </h2>

                    <p class="dashboard-subtitle mb-0">
                        Monitoring of Zakat, Infaq, Fidyah, and Payment Transactions
                    </p>
                </div>

                <div class="d-flex align-items-center gap-3">

                    <button
                        type="button"
                        onclick="window.print()"
                        class="btn btn-success btn-print">
                        Print All Records
                    </button>

                    <div class="dashboard-date">
                        {{ now()->timezone('Asia/Jakarta')->format('d F Y') }}
                    </div>

                </div>

            </div>

            <form method="GET" class="filter-card mb-5">

                <div class="row g-3 align-items-end">

                    <div class="col-lg-2 col-md-6">

                        <label class="filter-label">
                            Fiscal Year
                        </label>

                        <select name="tahun" class="form-select">
                            <option value="">
                                All Years
                            </option>

                            @foreach ($tahunList as $th)
                                <option value="{{ $th }}"
                                    {{ $tahun == $th ? 'selected' : '' }}>
                                    {{ $th }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <label class="filter-label">
                            Payment Method
                        </label>

                        <select name="metode" class="form-select">

                            <option value="">
                                All Methods
                            </option>

                            <option value="cash"
                                {{ $metode == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="transfer"
                                {{ $metode == 'transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <label class="filter-label">
                            Transaction Date
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ $tanggal }}"
                            class="form-control">

                    </div>

                    <div class="col-lg-2 col-md-4">

                        <label class="filter-label">
                            Sort Order
                        </label>

                        <select name="sort" class="form-select">

                            <option value="desc"
                                {{ $sort == 'desc' ? 'selected' : '' }}>
                                Most Recent
                            </option>

                            <option value="asc"
                                {{ $sort == 'asc' ? 'selected' : '' }}>
                                Oldest
                            </option>

                        </select>

                    </div>

                    <!-- RANGE PRINT -->
                    <div class="col-lg-1 col-md-3">

                        <label class="filter-label">
                            From (Entry No.)
                        </label>

                        <input
                            type="number"
                            name="no_dari"
                            value="{{ $no_dari ?? '' }}"
                            min="1"
                            class="form-control"
                            placeholder="0">

                    </div>

                    <div class="col-lg-1 col-md-3">

                        <label class="filter-label">
                            To (Entry No.)
                        </label>

                        <input
                            type="number"
                            name="no_sampai"
                            value="{{ $no_sampai ?? '' }}"
                            min="1"
                            class="form-control"
                            placeholder="0">

                    </div>

                    <div class="col-lg-1 col-md-3">

                        <button
                            type="submit"
                            class="btn filter-btn w-100">
                            Apply Filter
                        </button>

                    </div>

                    <div class="col-lg-1 col-md-3">

                        <button
                            type="button"
                            onclick="window.print()"
                            class="btn btn-success btn-print w-100">
                            Print
                        </button>

                    </div>

                </div>

            </form>

            <div class="summary-grid mb-4">

                <div class="summary-card">
                    <div class="summary-title">
                        Total Transactions
                    </div>

                    <div class="summary-value">
                        {{ $data->count() }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Zakat Fitrah (Monetary)
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalFitrah, 0, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Zakat Fitrah (Rice Commodity)
                    </div>

                    <div class="summary-value">
                        {{ number_format($totalBeras, 2) }} Kg
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Infaq (Voluntary Donation)
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalInfaq, 0, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Zakat Mal (Wealth Tax)
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalMal, 0, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Fidyah (Fasting Redemption)
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalFidya, 0, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Cash Payment
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalCash, 0, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-title">
                        Bank Transfer Payment
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalTransfer, 0, ',', '.') }}
                    </div>
                </div>

            </div>

            <div class="total-bar mb-4">

                <div>
                    Total Accumulated Funds
                </div>

                <div>
                    Rp {{ number_format($totalSemua, 0, ',', '.') }}
                </div>

            </div>

            <div class="table-wrapper mb-4">

                <table class="table-modern">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Muzakki Name</th>
                            <th>Residential Address</th>
                            <th>Zakat Fitrah</th>
                            <th>Zakat Mal</th>
                            <th>Infaq</th>
                            <th>Fidyah</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($data as $index => $item)

                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $item->nama }}
                                    </div>
                                </td>

                                <td>
                                    {{ $item->alamat }}
                                </td>

                                <td>

                                    @if ($item->zakat_fitrah_kg > 0)

                                        <span class="text-success fw-semibold">
                                            {{ number_format($item->zakat_fitrah_kg, 2) }}
                                            Kg
                                        </span>

                                    @else

                                        Rp {{ number_format($item->zakat_fitrah_rp, 0, ',', '.') }}

                                    @endif

                                </td>

                                <td>
                                    Rp {{ number_format($item->zakat_mal, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->infaq_shodaqoh, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->fidya, 0, ',', '.') }}
                                </td>

                                <td class="total-text">
                                    Rp {{ number_format($item->total, 0, ',', '.') }}
                                </td>

                                <td>

                                    @if ($item->metode_pembayaran == 'transfer')

                                        <span class="badge-transfer">
                                            Bank Transfer
                                        </span>

                                    @else

                                        <span class="badge-cash">
                                            Cash
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- PRINT -->
    <div class="print-wrapper">

        <div class="print-header">

            <img src="{{ asset('logo.png') }}"
                class="print-logo">

            <div>

                <div class="print-title">
                    MASJID NURUL HIKMAH
                </div>

                <div class="print-sub">
                    Gading Tutuka 1 Residential Complex
                </div>

                <div class="print-sub">
                    Summary Report of Zakat Fitrah, Zakat Mal,
                    Infaq, Shodaqoh, and Fidyah Recipients
                </div>

                @if (!empty($no_dari) && !empty($no_sampai))

                    <div class="print-sub mt-2">

                        Print Range:
                        <strong>
                            Entry No. {{ $no_dari }}
                            &ndash;
                            {{ $no_sampai }}
                        </strong>

                    </div>

                @endif

            </div>

        </div>

        <div class="print-line"></div>

        <p>
            <strong>Transaction Details:</strong>
        </p>

        <table class="print-table">

            <thead>

                <tr>
                    <th>No.</th>
                    <th>Muzakki Name</th>
                    <th>Residential Address</th>
                    <th>Zakat Fitrah</th>
                    <th>Zakat Mal</th>
                    <th>Infaq</th>
                    <th>Fidyah</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Transaction Date</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($data as $index => $item)

                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->nama }}
                        </td>

                        <td>
                            {{ $item->alamat }}
                        </td>

                        <td>

                            @if ($item->zakat_fitrah_kg > 0)

                                {{ number_format($item->zakat_fitrah_kg, 2) }}
                                Kg

                            @else

                                Rp {{ number_format($item->zakat_fitrah_rp, 0, ',', '.') }}

                            @endif

                        </td>

                        <td>
                            Rp {{ number_format($item->zakat_mal, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($item->infaq_shodaqoh, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($item->fidya, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ ucfirst($item->metode_pembayaran ?? 'cash') }}
                        </td>

                        <td>
                            {{ $item->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <table class="print-total-table">

            <tbody>

                <tr>
                    <td>TOTAL ZAKAT FITRAH (MONETARY)</td>
                    <td>
                        Rp {{ number_format($totalFitrah, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>TOTAL ZAKAT FITRAH (RICE COMMODITY)</td>
                    <td>
                        {{ number_format($totalBeras, 2) }} Kg
                    </td>
                </tr>

                <tr>
                    <td>TOTAL ZAKAT MAL</td>
                    <td>
                        Rp {{ number_format($totalMal, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>TOTAL INFAQ</td>
                    <td>
                        Rp {{ number_format($totalInfaq, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>TOTAL FIDYAH</td>
                    <td>
                        Rp {{ number_format($totalFidya, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>TOTAL CASH PAYMENTS</td>
                    <td>
                        Rp {{ number_format($totalCash, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>TOTAL BANK TRANSFER PAYMENTS</td>
                    <td>
                        Rp {{ number_format($totalTransfer, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td>
                        GRAND TOTAL
                    </td>

                    <td>
                        Rp {{ number_format($totalSemua, 0, ',', '.') }}
                    </td>
                </tr>

            </tbody>

        </table>

        <p class="print-date">

            This report was generated on

            {{ now()->timezone('Asia/Jakarta')->format('d F Y H:i') }}

        </p>

    </div>

</body>

</html>