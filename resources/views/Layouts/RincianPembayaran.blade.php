<!-- PAYMENT DETAILS -->
<div class="col-md-6">

    <div class="section-title">
        PAYMENT DETAILS
    </div>

    <!-- FITRAH PRICE -->
    <div class="mb-3">

        <label class="form-label">
            Fitrah Price per Person
        </label>

        <input
            type="text"
            id="hargaFitrah"
            class="form-control rupiah"
            value="40.000"
            oninput="hitungTotal()">

        <small class="text-muted">
            Adjust according to the local rice price
        </small>

    </div>

    <!-- METHOD -->
    <div class="mb-3">

        <label class="form-label">
            Zakat Fitrah Method
        </label>

        <div class="d-flex gap-3">

            <label>
                <input
                    type="radio"
                    name="metode_fitrah"
                    value="uang"
                    checked
                    onchange="hitungTotal()">
                Money
            </label>

            <label>
                <input
                    type="radio"
                    name="metode_fitrah"
                    value="beras"
                    onchange="hitungTotal()">
                Rice
            </label>

        </div>

    </div>

    <!-- FITRAH -->
    <div class="mb-4">

        <label class="form-label">
            Zakat Fitrah
        </label>

        <div class="row">

            <div class="col-8">

                <input
                    name="fitrah"
                    id="fitrah"
                    class="form-control rupiah"
                    placeholder="0"
                    readonly>

            </div>

            <div class="col-4">

                <input
                    name="kg"
                    id="kg"
                    class="form-control"
                    placeholder="KG"
                    readonly>

            </div>

        </div>

        <small class="text-muted">
            Automatically calculated based on the number of people
        </small>

    </div>

    <!-- INFAQ -->
    <div class="mb-3">

        <label class="form-label">
            Infaq / Sadaqah
        </label>

        <input
            id="infaq"
            class="form-control rupiah"
            placeholder="0">

        <input
            type="hidden"
            name="infaq">

    </div>

    <!-- MAL & FIDYA -->
    <div class="row">

        <div class="col-6">

            <label class="form-label">
                Zakat Mal
            </label>

            <input
                id="mal"
                class="form-control rupiah"
                placeholder="0">

            <input
                type="hidden"
                name="mal">

        </div>

        <div class="col-6">

            <label class="form-label">
                Fidya
            </label>

            <input
                id="fidya"
                class="form-control rupiah"
                placeholder="0">

            <input
                type="hidden"
                name="fidya">

        </div>

    </div>

    <!-- TOTAL -->
    <div class="col-12 mt-4">

        <div class="total-box">

            Total Payment :
            IDR <span id="totalBayar">0</span>

            <input
                type="hidden"
                name="total"
                id="totalInput">

        </div>

    </div>

    <!-- PAYMENT METHOD -->
    <div class="mt-4">

        <label class="form-label">
            Payment Method
        </label>

        <div class="d-flex gap-3">

            <label>
                <input
                    type="radio"
                    name="metode_pembayaran"
                    value="cash"
                    checked>
                Cash
            </label>

            <label>
                <input
                    type="radio"
                    name="metode_pembayaran"
                    value="transfer">
                Bank Transfer
            </label>

        </div>

    </div>

</div>

</div>