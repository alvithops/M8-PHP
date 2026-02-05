<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Login Berhasil</h1>
    <p>Selamat datang, <?php echo $_SESSION['username']; ?></p>
</body>

</html>