<?php
ob_start();
session_start();
require_once 'connect.php';

$sql = "SELECT * FROM users";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_us = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_us = [];
}

if (!isset($_SESSION['loginad']) || $_SESSION['loginad'] !== true) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
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
        <a href="#">Quản lý sản phẩm</a>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Created_At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lst_us as $i => $us): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($us['username']) ?></td>
                                <td><?= htmlspecialchars($us['email']) ?></td>
                                <td><?= htmlspecialchars($us['password']) ?></td>
                                <td><?= htmlspecialchars($us['created_at']) ?></td>
                                <td>
                                    <a href="updateUserAccount.php?id=<?= $us['id'] ?>" class="btn btn-warning">Update</a>
                                    <button class="btn btn-danger btn-delete" data-url="deleteUserAccount.php?id=<?= $us['id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa tài khoản này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Xóa</a>
                </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let deleteUrl = this.getAttribute("data-url");
                    confirmDeleteBtn.setAttribute("href", deleteUrl);
                });
            });
        });
    </script>

</body>

</html>