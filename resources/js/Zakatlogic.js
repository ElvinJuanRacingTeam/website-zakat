function angka(v) {
    return parseInt((v || "").replace(/\./g, "")) || 0;
}

function format(v) {
    return Number(v).toLocaleString("id-ID");
}

window.pilihJiwa = function (n) {

    document.querySelectorAll(".jiwa-box")
        .forEach(el => el.classList.remove("active"));

    document
        .querySelector(`.jiwa-box[data-jiwa="${n}"]`)
        ?.classList.add("active");

    document.getElementById("jumlahJiwa").value = n;

    hitungTotal();
};

window.hitungTotal = function () {

    let jiwa =
        parseInt(document.getElementById("jumlahJiwa")?.value) || 0;

    let harga =
        angka(document.getElementById("hargaFitrah")?.value);

    let metode =
        document.querySelector(
            'input[name="metode_fitrah"]:checked'
        )?.value;

    let fitrah = 0;
    let kg = 0;

    if (metode === "uang") {

        fitrah = jiwa * harga;

        document.getElementById("fitrah").value =
            fitrah ? format(fitrah) : "";

        document.getElementById("kg").value = "";

    } else {

        kg = jiwa * 2.5;

        document.getElementById("kg").value = kg;

        document.getElementById("fitrah").value = "";
    }

    let infaq =
        angka(document.getElementById("infaq")?.value);

    let mal =
        angka(document.getElementById("mal")?.value);

    let fidya =
        angka(document.getElementById("fidya")?.value);

    document.querySelector("input[name='infaq']").value = infaq;
    document.querySelector("input[name='mal']").value = mal;
    document.querySelector("input[name='fidya']").value = fidya;

    let total =
        fitrah + infaq + mal + fidya;

    document.getElementById("totalBayar").innerText =
        format(total);

    document.getElementById("totalInput").value =
        total;
};

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".rupiah")
        .forEach(input => {

            input.addEventListener("input", function () {

                let angkaOnly =
                    this.value.replace(/\D/g, "");

                this.value =
                    angkaOnly
                        ? format(parseInt(angkaOnly))
                        : "";

                hitungTotal();
            });

        });

    hitungTotal();
});