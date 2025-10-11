//daftar kartu
const colors = ["red", "green", "blue", "yellow"];
const values = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Skip", "Reverse", "+2"];
const wilds = ["Wild", "Wild+4"];

let deck = [],
    player = [],
    bot = [],
    discard = [];
let saldo = 5000,
    taruhan = 0,
    ronde = 0;
let playerTurn = true;
let unoPressed = false; // status UNO

//dom elements
const saldoEl = document.getElementById("saldo");
const taruhanEl = document.getElementById("taruhan");
const rondeEl = document.getElementById("ronde");
const playerEl = document.getElementById("playerHand");
const botEl = document.getElementById("botHand");
const discardImg = document.getElementById("discardImg");
const messageEl = document.getElementById("message");
const logEl = document.getElementById("log");

//  Dapatkan gambar kartu
function getImage(card) {
    let { color, value } = card;
    if (value === "Wild") return "asets/wild.png";
    if (value === "Wild+4") return "asets/plus_4.png";
    if (value === "+2") value = "plus2";
    if (value === "Skip") value = "skip";
    if (value === "Reverse") value = "reverse";
    return `asets/${color}_${value}.png`;
}

//  Buat deck baru
function createDeck() {
    deck = [];
    for (let c of colors)
        for (let v of values) deck.push({ color: c, value: v });
    for (let w of wilds) deck.push({ color: "black", value: w });
    deck.sort(() => Math.random() - 0.5); // acak deck
}

function drawCard() {
    if (deck.length === 0) createDeck();
    return deck.pop();
}

//  ️Mulai Game
document.getElementById("startBtn").addEventListener("click", () => {
    const bet = parseInt(document.getElementById("betInput").value);
    if (isNaN(bet) || bet < 100 || bet > saldo) {
        alert("Taruhan tidak valid!");
        return;

    }

    taruhan = bet;
    ronde++;
    createDeck();
    player = [];
    bot = [];

    for (let i = 0; i < 7; i++) { // 7 kartu awal
        player.push(drawCard());
        bot.push(drawCard());
    }

    discard = [drawCard()]; // kartu awal di tumpukan buang
    playerTurn = true;
    unoPressed = false;
    updateUI();
    log(`🎮 Ronde ${ronde} dimulai!`);
});

function updateUI() {
    saldoEl.textContent = saldo;
    taruhanEl.textContent = taruhan;
    rondeEl.textContent = ronde;

    playerEl.innerHTML = player
        .map((c, i) => `<img src="${getImage(c)}" onclick="playCard(${i})" class="card">`) // Kartu pemain
        .join("");

    botEl.innerHTML = bot.map(() => `<img src="asets/card_back.png" class="card">`).join("");
    discardImg.src = getImage(discard[discard.length - 1]); // Kartu teratas di tumpukan buang
}

// Pemain memainkan kartu
function playCard(i) {
    if (!playerTurn) return; // Bukan giliran pemain

    const card = player[i];
    const top = discard[discard.length - 1];

    if (card.color !== top.color && card.value !== top.value && card.color !== "black") {
        message("❌ Kartu tidak cocok!");
        return;
    }

    discard.push(card);
    player.splice(i, 1);
    handleAction(card, "player");
    checkUNO("player");
    checkWinner();

    playerTurn = false;
    updateUI();

    setTimeout(botTurn, 1000);
}

//  Efek kartu aksi
function handleAction(card, who) {
    if (card.value === "+2") {
        drawFor(who === "player" ? bot : player, 2);
        log(`${who} memainkan ${card.color} +2`);
    } else if (card.value === "Wild+4") {
        drawFor(who === "player" ? bot : player, 4);
        log(`${who} memainkan Wild+4`);
    } else if (card.value === "Wild") {
        card.color =
            who === "player" ?
            prompt("Pilih warna: red, green, blue, yellow") || "red" :
            colors[Math.floor(Math.random() * 4)];
        log(`${who} memilih warna ${card.color}`);
    } else if (card.value === "Skip" || card.value === "Reverse") {
        log(`${who} memainkan ${card.value}, giliran lawan dilewati!`);

        // Skip: lawan dilewati
        if (who === "player") {
            setTimeout(() => {
                message("Bot dilewati! Giliran kamu lagi 😎");
                playerTurn = true;
            }, 500); // delay sedikit untuk efek
        } else {
            setTimeout(() => {
                message("Giliran kamu dilewati oleh Bot 😭");
                playerTurn = false;
                botTurn();
            }, 800); // 
        }
    } else {
        log(`${who} memainkan ${card.color} ${card.value}`);
    }
}

function drawFor(hand, n) {
    for (let i = 0; i < n; i++) hand.push(drawCard()); // Tambah kartu ke tangan
}

//  Giliran bot
function botTurn() {
    const top = discard[discard.length - 1];
    const playable = bot.find(
        (c) => c.color === top.color || c.value === top.value || c.color === "black"
    );

    if (playable) {
        bot.splice(bot.indexOf(playable), 1);
        discard.push(playable);
        handleAction(playable, "bot");
        checkUNO("bot");
        checkWinner();
    } else {
        bot.push(drawCard());
        log("🤖 Bot mengambil 1 kartu");
    }

    playerTurn = true;
    updateUI();
}

// Tombol ambil kartu
document.getElementById("drawBtn").addEventListener("click", () => {
    if (!playerTurn) return;

    const card = drawCard();
    player.push(card);
    log("🃏 Kamu mengambil 1 kartu dari deck");
    updateUI();

    const top = discard[discard.length - 1];
    if (card.color === top.color || card.value === top.value || card.color === "black") {
        message("Kartu yang kamu ambil bisa dimainkan!");
    } else {
        message("Kartu tidak cocok, giliran bot...");
        playerTurn = false;
        setTimeout(botTurn, 1000);
    }
});

// Fitur UNO!
document.getElementById("unoBtn").addEventListener("click", () => {
    if (player.length === 1 && playerTurn) {
        unoPressed = true;
        message("UNO! 🔔");
        log("🟨 Kamu menekan tombol UNO!");
    } else {
        message("Belum bisa tekan UNO!");
    }
});

function checkUNO(who) {
    if (who === "player" && player.length === 1) {
        unoPressed = false;
        message("Tekan tombol UNO dalam 5 detik!");
        setTimeout(() => {
            if (!unoPressed) {
                drawFor(player, 2);
                log("⚠️ Kamu lupa tekan UNO, dapat +2 kartu!");
                updateUI();
            }
        }, 5000);
    }
}

// 🏆 Cek pemenang
function checkWinner() {
    if (player.length === 0) {
        saldo += taruhan;
        log("🎉 Kamu menang!");
        message("Kamu menang! 🥳");
    } else if (bot.length === 0) {
        saldo -= taruhan;
        log("💀 Bot menang!");
        message("Bot menang! 😭");
        if (saldo <= 0) alert("GAME OVER!");
    }
}

// 🧾 Log & pesan
function log(msg) {
    logEl.innerHTML = `<div>${msg}</div>` + logEl.innerHTML;
}

function message(txt) {
    messageEl.textContent = txt;
    setTimeout(() => (messageEl.textContent = ""), 2000);
}

//  Reset saldo
document.getElementById("resetBtn").addEventListener("click", () => {
    saldo = 5000;
    taruhan = 0;
    ronde = 0;
    updateUI();
    log("💰 Saldo direset!");
});