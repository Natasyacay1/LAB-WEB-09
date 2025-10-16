<?php
session_start();
require 'data.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$isAdmin = ($user['username'] === 'adminkece');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title> Dashboard </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="dashboard-body">

<?php if ($isAdmin): ?>
    <h1><i class="fa-solid fa-user-shield"></i> Selamat Datang, Admin!</h1>
    <table class="data-table">
        <tr>
            <th><i class="fa-solid fa-envelope"></i> Email</th>
            <th><i class="fa-solid fa-user"></i> Username</th>
            <th><i class="fa-solid fa-id-badge"></i> Nama</th>
            <th><i class="fa-solid fa-venus-mars"></i> Gender</th>
            <th><i class="fa-solid fa-building-columns"></i> Fakultas</th>
            <th><i class="fa-solid fa-graduation-cap"></i> Angkatan</th>
        </tr>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['email'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['name'] ?></td>
                <td><?= $u['gender'] ?? '-' ?></td>
                <td><?= $u['faculty'] ?? '-' ?></td>
                <td><?= $u['batch'] ?? '-' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <h1><i class="fa-solid fa-user"></i> Selamat Datang, <?= htmlspecialchars($user['name']) ?>!</h1>
    <table class="data-table">
        <tr><th>Email</th><td><?= $user['email'] ?></td></tr>
        <tr><th>Username</th><td><?= $user['username'] ?></td></tr>
        <tr><th>Nama</th><td><?= $user['name'] ?></td></tr>
        <tr><th>Gender</th><td><?= $user['gender'] ?? '-' ?></td></tr>
        <tr><th>Fakultas</th><td><?= $user['faculty'] ?? '-' ?></td></tr>
        <tr><th>Angkatan</th><td><?= $user['batch'] ?? '-' ?></td></tr>
    </table>
<?php endif; ?>

<a href="logout.php" class="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
</body>
</html>
