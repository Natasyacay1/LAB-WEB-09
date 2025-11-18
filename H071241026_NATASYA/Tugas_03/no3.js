const readline = require('readline');
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const hari = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];

rl.question("Masukkan hari sekarang: ", (h) => {
    if (!hari.includes(h.toLowerCase())) { //huruf kecil
        console.log("Nama hari tidak valid. Gunakan: Minggu, Senin, Selasa, Rabu, Kamis, Jumat, Sabtu.");
        rl.close();
        return;
    }

    rl.question("Masukkan jumlah hari ke depan: ", (n) => {
        let jumlah = parseInt(n);
        if (isNaN(jumlah) || jumlah < 0) { //kalau user masukkan sesuatu yang bukan angka positif, langsung dianggap salah
            console.log("Jumlah hari harus berupa angka positif");
        } else {
            let idx = hari.indexOf(h.toLowerCase()); //posisi hari sekarang
            let hasil = hari[(idx + jumlah) % 7]; //hasil hari setelah ditambah jumlah hari
            console.log(`${jumlah} hari setelah ${h} adalah ${hasil}`);
        }
        rl.close();
    });
});