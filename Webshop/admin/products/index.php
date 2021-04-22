<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Product overview</h1>

<?php
    $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.category_id, category.name, price, color, weight, product.active FROM product INNER JOIN category ON product.category_id = category.category_id");
    if($liqry === false) {
       echo mysqli_error($con);
    } else{
        $liqry->bind_result($product_id, $name, $description, $category_id, $category_name, $price, $color, $weight, $active);
        if($liqry->execute()){
            $liqry->store_result();
            while($liqry->fetch()) {
                $columns = array('product_id', 'name', 'description', 'category_id', 'category_name','price', 'color', 'weight', 'active');
                foreach ($columns as $key) {
                    echo '<b>' . $key .'</b> :' . $$key;
                    echo '<br>';
                }
                echo '<a href="edit_product.php?pid='.$product_id.'">edit</a><br>';
                echo '<a href=delete_product.php?pid='.$product_id.'>delete</a><br>';
                echo '<br> <br>';
            }
        }
        $liqry->close();
    }

?>

<?php
    include('../core/footer.php');
?>
