<?php
session_start();
require_once './admin/connect.php';

$error = "";
$success = false; // Biến kiểm tra trạng thái đăng ký thành công

if (isset($_POST['registeruser'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        $checkUser = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $res = $conn->query($checkUser);

        if ($res->num_rows > 0) {
            $error = "Tên người dùng hoặc email đã tồn tại!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['loginus'] = $username;
                $success = true; // Đăng ký thành công
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Register</title>
    <style>
        /* CSS cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }

        .modal button {
            margin-top: 10px;
            padding: 8px 16px;
            border: none;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="form-box register">
            <h2>REGISTER</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon> Username</span>
                    <input type="text" name="username" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon> Email</span>
                    <input type="email" name="email" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
                    <input type="password" name="password" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Confirm Password</span>
                    <input type="password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn" name="registeruser">Register</button>

                <?php if (!empty($error)): ?>
                    <p class="error-message" style="color: red; text-align: center; margin-top: 10px;">
                        <?php echo $error; ?>
                    </p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content">
            <h3>Đăng ký thành công!</h3>
            <p>Bạn sẽ được chuyển hướng đến trang đăng nhập.</p>
            <button onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <script>
        function redirectToLogin() {
            window.location.href = "loginHome.php";
        }

        <?php if ($success): ?>
            document.getElementById("successModal").style.display = "flex";
        <?php endif; ?>
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
