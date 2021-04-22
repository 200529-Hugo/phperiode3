<?php
    include('core/header.php');
    include('core/checklogin.php');
?>
<h1>Welcome back <?php echo $_SESSION['cust_name']; ?>!</h1>
<br>
<h2>Just for you!</h2>
<?php
    if ( isset($_GET['logout'])  && $_GET['logout'] == '1') {
        unset($_SESSION['cust_id']);
        unset($_SESSION['cust_email']);
        header("location:index.php");
    }
    $liqry = $con->prepare("SELECT product_id, product.name, category.category_id, category.name, price, color, weight FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product.active = true ORDER BY RAND () LIMIT 3");
    if($liqry === false) {
       echo mysqli_error($con);
    } else{
        $liqry->bind_result($product_id, $Name, $category_id, $Category, $Price, $Color, $Weight);
        if($liqry->execute()){
            $liqry->store_result();
            while($liqry->fetch()) {
                $columns = array('Name', 'Category','Price', 'Color', 'Weight');
                echo '<a class="buynow" href="detail.php?pid='.$product_id.'">';
                foreach ($columns as $key) {
                    echo '<article><b class="boldbuy">' . $key .'</b><br>' . $$key . '</article>';
                    if ($key == 'Weight') {
                        echo '';
                    } else {
                        echo '<br>';
                    }
                }
                echo '</a>';
            }
        }
        $liqry->close();
        $liqry2 = $con->prepare("SELECT name, description FROM category");
        if($liqry2 === false) {
            echo mysqli_error($con);
        } else{
            $liqry2->bind_result($cat_name,$cat_desc);
            if($liqry2->execute()){
                $liqry2->store_result();
                while($liqry2->fetch()){
                    echo '<article class="infotext"><h3>' . $cat_name . '</h3>' . $cat_desc . '</article>';
                }
            }
        }
        $liqry2->close();
    }
?>




<?php
    include('core/footer.php');
?>