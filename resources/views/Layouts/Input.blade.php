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

                            <div class="mt-3">

    <label class="form-label">
        Atau Input Manual
    </label>

    <input 
        type="number"
        id="jumlahJiwa"
        name="jumlah_jiwa"
        class="form-control"
        min="1"
        value="0"
        placeholder="Masukkan jumlah jiwa"
        oninput="hitungTotal()"
    >

</div>

                        </div>

                    </div>