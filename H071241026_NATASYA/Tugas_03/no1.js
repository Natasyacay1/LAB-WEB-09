function countEvenNumbers(start, end) {
    if (isNaN(start) || isNaN(end)) {
        console.log("Error: Input harus berupa angka!");
        return;
    }

    if (start > end) {        //besar dr
        console.log("Error: Angka mulai tidak boleh lebih besar dari angka akhir!");
        return;
    }

    let genap = [];

    for (let i = start; i <= end; i++) { //loop dari start ke end
        if (i % 2 === 0) {           //sisa pembagian i dengan 2
            genap.push(i); 
        }
    }

    if (genap.length === 0) {
        console.log("Tidak ada bilangan genap pada rentang ini");
        return;
    }

    console.log("Jumlah bilangan genap:", genap.length);
    console.log("Daftar bilangan genap:", genap.join(", "));
}

countEvenNumbers(2, 10);