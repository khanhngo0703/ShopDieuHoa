<?php
require_once 'admin/connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM collections, products WHERE products.collection_id = collections.id AND products.collection_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_product = $result->fetch_all(MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="css/stylemen.css">
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
                            <li><a href="women's_clothes.php">Men</a></li>
                            <li><a href="#">Women</a></li>
                            <li><a href="#">Shop</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header_right">
                        <div class="header_right_auth">
                            <a href="#"><button class="btn btn-warning">Register</button></a>
                            <a href="#"><button class="btn btn-warning">LogIn</button></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header_logo">
                        <a href="index.html">Men's Fashion</a>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="section-title">
                                <h4>T-shirt</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row property_gallery">

                        <?php
                        foreach ($lst_product as $product) :
                        ?>

                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="product_item">
                                    <div class="product_item_pic">

                                        <img src="admin/uploads/<?php echo $product['thumbnail']; ?>" alt="">

                                        <div class="label new">New</div>
                                        <ul class="product_hover">
                                            <li><a href="productdetails.php?id=<?php echo $product['id']; ?>"><i class="fa fa-eye" title="Xem chi tiết"></i></a></li>
                                            <li><a href="#"><i class="fa fa-arrows-alt"></i></a></li>
                                            <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                        </ul>


                                    </div>
                                    <div class="product_item_text">

                                        <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                                        <div class="product_price"><?php echo $product['price'] . 'đ'; ?></div>
                                        <div class="rating">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>


                                    </div>
                                </div>

                            </div>


                        <?php
                        endforeach;
                        ?>

                    </div>


                </div>
            </div>
        </div>
<?php
include "shared/_footer.php";
?>