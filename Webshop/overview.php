<?php
    include('core/header.php');
    include('core/checklogin.php');
    $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.category_id, category.name, price, color, weight, product.active FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product.active = true");
    if($liqry === false) {
       echo mysqli_error($con);
    } else{
        $liqry->bind_result($product_id, $Name, $Description, $category_id, $Category, $Price, $Color, $Weight, $active);
        if($liqry->execute()){
            $liqry->store_result();
            while($liqry->fetch()) {
                $columns = array('Name', 'Description', 'Weight', 'Color', 'Price', 'Category');
                echo '<a href="detail.php?pid='.$product_id.'" class="products">';
                foreach ($columns as $key) {
                    if ($key == 'Name' || $key == 'Description') {
                        $class = '';
                    } else {
                        $class = 'buy';
                    }
                    echo '<article class="overview ' . $class . '"><b>' . $key .'</b><br>' . $$key . '</article>';
                    if ($key == 'Name' || $key == 'Description') {
                        echo '<br>';
                    } else {
                        echo '';
                    }
                }
                echo '</a><br> <br>';
            }
        }
        $liqry->close();
    }
    include('core/footer.php');
?>