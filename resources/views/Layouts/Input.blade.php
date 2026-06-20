    <div class="row g-5">

        <!-- PAYER INFORMATION -->
        <div class="col-md-6">

            <div class="section-title">PAYER INFORMATION</div>

            <div class="mb-4">
                <label class="form-label">Full Name</label>
                <input name="nama" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Address</label>
                <input name="alamat" class="form-control" required>
            </div>

            <div class="mb-4">

                <label class="form-label">Number of Family Members</label>

                <div class="jiwa-grid">

                    <div class="jiwa-box" data-jiwa="1" onclick="pilihJiwa(1)">1 Person</div>
                    <div class="jiwa-box" data-jiwa="2" onclick="pilihJiwa(2)">2 People</div>
                    <div class="jiwa-box" data-jiwa="3" onclick="pilihJiwa(3)">3 People</div>
                    <div class="jiwa-box" data-jiwa="4" onclick="pilihJiwa(4)">4 People</div>
                    <div class="jiwa-box" data-jiwa="5" onclick="pilihJiwa(5)">5 People</div>
                    <div class="jiwa-box" data-jiwa="6" onclick="pilihJiwa(6)">6 People</div>
                    <div class="jiwa-box" data-jiwa="7" onclick="pilihJiwa(7)">7 People</div>
                    <div class="jiwa-box" data-jiwa="8" onclick="pilihJiwa(8)">8 People</div>
                    <div class="jiwa-box" data-jiwa="9" onclick="pilihJiwa(9)">9 People</div>
                    <div class="jiwa-box" data-jiwa="10" onclick="pilihJiwa(10)">10 People</div>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Or Enter Manually
                    </label>

                    <input
                        type="number"
                        id="jumlahJiwa"
                        class="form-control"
                        min="1"
                        value="0"
                        name="jumlah_jiwa"
                        oninput="hitungTotal()">

                </div>

            </div>

        </div>