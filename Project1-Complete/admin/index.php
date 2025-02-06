<?php
session_start();
require_once 'connect.php';

$sql = "SELECT * FROM admincp";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_ad = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_ad = [];
}

if (!isset($_SESSION['loginad'])) {
    header('Location: login.php');
    exit(); // Dừng script ngay lập tức
}

if (isset($_GET['logout'])) {
    session_destroy();

    header('Location: login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3>ADMIN PANEL</h3>
        <a href="#">Dashboard</a>
        <a href="#">Quản lý tài khoản</a>
        <a href="addprd.php">Thêm sản phẩm</a>
        <a href="login.php?logout=true">Đăng xuất</a>
    </div>
    <div class="content">
        <h1 class="mb-4">Quản lý tài khoản</h1>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lst_ad as $i => $ad): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($ad['admin_username']) ?></td>
                                <td>******</td>
                                <td>
                                    <a href="updateadmin.php?id=<?= $ad['id'] ?>" class="btn btn-warning">Cập nhật</a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="deleteadmin.php?id=<?= $ad['id'] ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('#btn-xoa').forEach(function(elm, index) {
            elm.addEventListener('click', function(e) {
                console.log(e);
                e.preventDefault();
                let url = e.target.href;
                let isDelete = confirm('Ban co muon xoa khong');
                if (isDelete === true) {
                    window.location.href = url;
                }
            });
        })
    </script>
</body>

</html>