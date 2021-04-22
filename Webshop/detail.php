<?php 
    include('core/header.php');
    include('core/checklogin.php');

    if (isset($_GET['pid']) && $_GET['pid'] != '') {
        $pid = $con->real_escape_string($_GET['pid']);

        $liqry = $con->prepare("SELECT product_id, product.name, product.description, category.category_id, category.name, price, color, weight FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$pid);
            $liqry->bind_result($product_id, $Name, $Description, $category_id, $Category, $Price, $Color, $Weight);
            if($liqry->execute()){
                $liqry->store_result();
                while($liqry->fetch()) {
                    $columns = array('Name', 'Description', 'Weight', 'Color', 'Price', 'Category');
                    foreach ($columns as $key) {
                        if ($key == 'Name' || $key == 'Description') {
                            $class = 'detailinfo';
                        } else {
                            $class = 'buy';
                        }
                        echo '<div class="'.$class.'"><b>' . $key .'</b>: ' . $$key . '</div>';
                        if ($key == 'Name' || $key == 'Description') {
                            echo '<br>';
                        } else {
                            echo '';
                        }
                    }
                    echo '<br> <br>';
                }
            }
        }
    }
?>
<a href="form.php?pid=<?php echo $product_id; ?>">
    <div class="buyButn">
        BUY
    </div>
</a>
<?php
    include('core/footer.php');
?>