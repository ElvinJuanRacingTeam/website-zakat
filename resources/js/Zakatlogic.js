
        const harga = 40000;
        const kg = 2.5;

        function pilihJiwa(n) {

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

            let jiwa = parseInt(document.getElementById("jumlahJiwa").value);

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
