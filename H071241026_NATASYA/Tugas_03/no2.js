const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin, //ambil input dari keyboard
    output: process.stdout //tampilan hasil
});

function hitungDiskon(harga, jenis) {
    let diskon = 0;

    switch (jenis.toLowerCase()) {
        case "elektronik":
            diskon = 0.10;
            break;
        case "pakaian":
            diskon = 0.20;
            break;
        case "makanan":
            diskon = 0.05;
            break;
        case "lainnya":
            diskon = 0;
            break;
        default:
            console.log("Jenis barang tidak dikenali, tidak ada diskon");
            diskon = 0;
    }

    let potongan = harga * diskon;
    let total = harga - potongan;
    return { diskon: diskon * 100, total };
}

rl.question("Masukkan harga barang: ", (hargaInput) => {
    let harga = parseFloat(hargaInput);

    if (isNaN(harga) || harga <= 0) { //angka, harus lebih dari 0
        console.log("Input harga tidak valid. Harus berupa angka positif");
        rl.close();
        return;
    }

    rl.question("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ", (jenis) => {
        if (!jenis) {
            console.log("Jenis barang tidak boleh kosong");
            rl.close();
            return;
        }

        let hasil = hitungDiskon(harga, jenis);

        console.log("\n--- Hasil Perhitungan ---");
        console.log("Harga awal: Rp " + harga);
        console.log("Diskon: " + hasil.diskon + "%");
        console.log("Harga setelah diskon: Rp " + hasil.total);

        rl.close();
    });
});