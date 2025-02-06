<?php
session_start();

require_once 'connect.php';

$error = ""; 

if (isset($_POST['loginadmin'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $stmt = $conn->prepare("SELECT * FROM admincp WHERE admin_username = ? AND admin_password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        
        $_SESSION['admin_username'] = $admin['admin_username'];
        $_SESSION['loginad'] = true;

        header('Location: index.php');
        exit();
    } else {
        $error = 'Tên tài khoản hoặc mật khẩu không đúng';
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
</head>

<body>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login">
            <h2>Login ADMIN</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon> Username</span>
                    <input type="text" name="username" required>
                    <label for="Username"></label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
                    <input type="password" name="password" required>
                    <label for="Password"></label>
                </div>
                <button type="submit" class="btn" name="loginadmin">Login</button>

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

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>

<?php if(isset($_SESSION['error'])): ?>
    <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>