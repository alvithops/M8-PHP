<?php
session_start();

// Data pengguna sederhana (biasanya ini disimpan di database)
$users = [
    'admin' => 'password123',
    'user' => 'userpass456'
];

// Variabel pesan error
$error = '';
$username = '';

// Cek jika form login disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi!';
    } else {
        // Cek apakah username ada dan password cocok
        if (array_key_exists($username, $users) && $users[$username] === $password) {
            // Login sukses
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            // Redirect ke halaman selamat datang
            header('Location: ' . $_SERVER['PHP_SELF'] . '?page=welcome');
            exit();
        } else {
            $error = 'Username atau password salah!';
        }
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Cek apakah sudah login
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Login Sederhana</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(to right, #4776E6, #8E54E9);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #8E54E9;
            box-shadow: 0 0 0 2px rgba(142, 84, 233, 0.2);
            outline: none;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, #4776E6, #8E54E9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(142, 84, 233, 0.3);
        }

        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #c62828;
        }

        .success-message {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #2e7d32;
        }

        .login-info {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .login-info strong {
            color: #333;
        }

        .welcome-container {
            text-align: center;
            padding: 40px 20px;
        }

        .welcome-container h2 {
            color: #4776E6;
            margin-bottom: 15px;
            font-size: 32px;
        }

        .welcome-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.5;
        }

        .user-info {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .logout-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(to right, #4776E6, #8E54E9);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(142, 84, 233, 0.3);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #4776E6;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                border-radius: 10px;
            }

            .header,
            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sistem Login Sederhana</h1>
            <p>PHP, HTML, CSS dalam satu file</p>
        </div>

        <div class="content">
            <?php if (!$logged_in): ?>
                <!-- Form Login -->
                <?php if (isset($_GET['page']) && $_GET['page'] === 'welcome'): ?>
                    <div class="error-message">
                        Anda harus login terlebih dahulu untuk mengakses halaman tersebut.
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control"
                            value="<?php echo htmlspecialchars($username); ?>" placeholder="Masukkan username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" class="btn">Login</button>
                </form>

                <div class="login-info">
                    <p><strong>Demo Account:</strong></p>
                    <p>Username: <strong>admin</strong> | Password: <strong>password123</strong></p>
                    <p>Username: <strong>user</strong> | Password: <strong>userpass456</strong></p>
                </div>

            <?php else: ?>
                <!-- Halaman Selamat Datang -->
                <div class="welcome-container">
                    <h2>Selamat Datang!</h2>

                    <div class="user-info">
                        <p>Anda login sebagai: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                        <p>Waktu login: <?php echo date('d-m-Y H:i:s'); ?></p>
                    </div>

                    <p>Anda telah berhasil login ke sistem kami. Ini adalah contoh sederhana dari sistem login yang dibuat
                        dengan PHP, HTML, dan CSS dalam satu file.</p>

                    <a href="?logout=true" class="logout-btn">Logout</a>

                    <div style="margin-top: 30px;">
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="back-link">Kembali ke Form Login</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>