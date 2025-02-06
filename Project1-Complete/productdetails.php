<?php
require_once 'admin/connect.php';
require_once 'admin/utils.php';
$id = $_GET['id'];

$sql = "SELECT thumbnail ,product_name FROM `products` p INNER JOIN collections c on p.collection_id = c.id INNER JOIN stylists s on p.collection_id = s.id WHERE p.id = $id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_productdetails = $result->fetch_all(MYSQLI_ASSOC);
    dd($lst_productdetails);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach($lst_productdetails as $productdetails) :
    ?>
    <div class="image-product">
        <img src="admin/uploads/<?php echo $productdetails['thumbnail']; ?>">
    </div>
    <div class="detail">
        <h3><?php echo $productdetails['product_name'];?></h3>
    </div>
    <?php
    endforeach;
    ?>
</body>

</html>