<?php
session_start();  
if (isset($_SESSION['user'])) { //jika sudah login, langsung ke dashboard
    header("Location: dashboard.php"); 
    exit();
}
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';  //pesan eror
unset($_SESSION['error']); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Selamat Datang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="login-body">

    <form method="POST" action="proses_login.php" class="login-form">
        <h2><i class="fa-solid fa-door-open"></i> Selamat Datang!</h2>

        <?php if ($error): ?>
            <div class="error"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <label><i class="fa-solid fa-user"></i> Username:</label>
        <input type="text" name="username" placeholder="Masukkan username..." required>

        <label><i class="fa-solid fa-lock"></i> Password:</label>
        <input type="password" name="password" placeholder="Masukkan password..." required>

        <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Masuk</button>
    </form>

</body>
</html>
