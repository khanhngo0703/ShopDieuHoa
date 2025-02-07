<?php
require_once 'connect.php';
require_once 'utils.php';

$errors = [];

if (isset($_POST['updateuser'])) {
    $username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitize($_POST['password']) : '';

    if (count($errors) === 0) {
        $id = sanitize($_GET['id']);

        try {
            $conn->begin_transaction();
            
            if (!empty($password)) {
                $password = password_hash($password, PASSWORD_DEFAULT); 
                $sql = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = $id";
            } else {
                $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $id";
            }

            $res = $conn->query($sql);
            $conn->commit();

            header('Location: index.php');
            exit; 

        } catch (Exception $e) {
            echo $e->getMessage();
            $conn->rollback();
        }
    }
}

if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = $id";
    $res = $conn->query($sql);

    if ($res) {
        $current_user = $res->fetch_assoc();

        if ($current_user === null) {
            header('Location: index.php');
        }
    }
} else {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card" style="margin-top: 60px;">
            <div class="card-header">
                <h5 class="mb-0">Update User Account</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form">
                        <label for="username">Username: </label>
                        <input type="text" name="username" placeholder="Enter username" class="form-control mb-2" value="<?php echo $current_user['username']; ?>">
                    </div>
                    <div class="form">
                        <label for="email">Email: </label>
                        <input type="email" name="email" placeholder="Enter email" class="form-control mb-2" value="<?php echo $current_user['email']; ?>">
                    </div>
                    <div class="form">
                        <label for="password">Password: </label>
                        <input type="password" name="password" placeholder="Enter new password" class="form-control mb-2">
                    </div>
                    <div class="form">
                        <input type="submit" name="updateuser" value="Update User" class="form-control mb-2 btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
