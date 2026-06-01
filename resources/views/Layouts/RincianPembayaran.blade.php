         <div class="col-md-6">

                    <div class="section-title">RINCIAN PEMBAYARAN</div>

                    <div class="mb-3">

                        <label class="form-label">Metode Zakat Fitrah</label>

                        <div class="d-flex gap-3">
                            <label><input type="radio" name="metode_fitrah" value="uang" checked
                                    onchange="hitungTotal()"> Uang</label>
                            <label><input type="radio" name="metode_fitrah" value="beras" onchange="hitungTotal()">
                                Beras</label>
                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">Zakat Fitrah</label>

                        <div class="row">

                            <div class="col-8">
                                <input 
                                    name="fitrah"
                                    id="fitrah"
                                    class="form-control rupiah"
                                    placeholder="0"
                                    oninput="manualFitrah = true; hitungTotal()">
                            </div>

                            <div class="col-4">
                                <input
                                    name="kg"
                                    id="kg"
                                    class="form-control"
                                    placeholder="KG"
                                    oninput="manualKg = true; hitungTotal()">
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
