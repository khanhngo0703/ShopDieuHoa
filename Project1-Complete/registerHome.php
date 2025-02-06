<?php
session_start();
require_once './admin/connect.php';

$error = "";

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
                header('Location: loginHome.php');
                exit();
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Register</title>
</head>

<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>