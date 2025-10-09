const readline = require("readline");

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const target = Math.floor(Math.random() * 100) + 1; 
let attempts = 0; // jumlah percobaan

function tanya() {
    rl.question(`Tebak angka (1-100), percobaan ke-${attempts + 1}: `, (jawaban) => {
        let tebakan = parseInt(jawaban);

        if (isNaN(tebakan)) {
            console.log("Harus angka ya!");
            return tanya();
        }

        attempts++; // tambah jumlah percobaan

        if (tebakan === target) {
            console.log(`Selamat! Angkanya ${target}, ketemu dalam ${attempts} percobaan`);
            rl.close();
        } else if (tebakan < target) {
            console.log("Terlalu rendah! Coba lagi.");
            tanya();
        } else {
            console.log("Terlalu tinggi! Coba lagi.");
            tanya();
        }
    });
}

tanya();
