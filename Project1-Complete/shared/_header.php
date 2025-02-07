<?php
session_start();

require_once 'admin/connect.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_ct = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_ct = [];
}

if (isset($_GET['action'])) {
    $tam = $_GET['action'];
} else {
    $tam = '';
}

if ($tam == 'quanlysp') {
    require_once 'shop.php';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylecontact.css">
</head>

<body>
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header_logo">
                        <a href="index.html">Fashion Shop</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header_menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <?php
                            foreach ($lst_ct as $ct) :
                            ?>
                                <li><a href="shop.php?action=quanlysp&id=<?php echo $ct['id']; ?>"><?php echo $ct['category_name'];  ?></a></li>

                            <?php
                            endforeach
                            ?>
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><a href="contact.php">Contact</a></li>


                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header_right">
                        <div class="header_right_auth" style="display: flex; align-items: center;">
                            <?php if (isset($_SESSION['loginus'])) : ?>
                                <h2 style="margin-right: 10px;">Hi, <?php echo htmlspecialchars($_SESSION['loginus']); ?>!</h2>
                                <button id="logoutBtn" class="btn btn-danger">Logout</button>
                            <?php else : ?>
                                <a href="registerHome.php"><button class="btn btn-warning">Register</button></a>
                                <a href="loginHome.php"><button class="btn btn-warning">LogIn</button></a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <script>
        document.getElementById("logoutBtn")?.addEventListener("click", function() {
            fetch("logout.php")
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        location.reload(); // Làm mới trang để cập nhật giao diện
                    }
                });
        });
    </script>