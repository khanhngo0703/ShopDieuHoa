<?php
session_start();
require_once './admin/connect.php';

$error = "";
$success = false; 


if (isset($_POST['loginuser'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loginus'] = $user['username'];
            $success = true; 
        } else {
            $error = "Tài khoản hoặc mật khẩu không đúng!";
        }
    } else {
        $error = "Tài khoản hoặc mật khẩu không đúng!";
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
    <title>Login</title>
    <style>
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
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login">
            <h2>LOGIN</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon> Username</span>
                    <input type="text" name="username" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn" name="loginuser">Login</button>

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
            <h3>Đăng nhập thành công!</h3>
            <p>Bạn sẽ được chuyển hướng đến trang chủ.</p>
            <button onclick="redirectToIndex()">OK</button>
        </div>
    </div>

    <script>
        function redirectToIndex() {
            window.location.href = "index.php";
        }

        <?php if ($success): ?>
            document.getElementById("successModal").style.display = "flex";
        <?php endif; ?>
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>