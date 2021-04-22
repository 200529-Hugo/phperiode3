<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Add product</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $name = $con->real_escape_string($_POST['name']);
        $description = $con->real_escape_string($_POST['description']);
        $category = $con->real_escape_string($_POST['category']);
        $price = $con->real_escape_string($_POST['price']);
        $color = $con->real_escape_string($_POST['color']);
        $weight = $con->real_escape_string($_POST['weight']);
        $total = count($_FILES['image']['name']);
        if ($total >= 4) {
            echo "ERROR with adding product.";
            } else{
            $liqry = $con->prepare("INSERT INTO product (name, description, category_id, price, color, weight, active) VALUES (?, ?, ?, ?, ?, ?, 1)");
            if($liqry === false) {
                echo mysqli_error($con);
            } else{
                $liqry->bind_param('ssssss',$name,$description,$category,$price,$color,$weight);
                if($liqry->execute()){
                    $productId = $con->insert_id;
                    for( $i=0 ; $i < $total ; $i++ ) {
                        $image = $con->real_escape_string($_FILES['image']['name'][$i]);
                        $image_tmp = ($_FILES['image']['tmp_name'][$i]);
                        $imageqry = $con->prepare("INSERT INTO product_image (product_id,image,active) VALUES (?,?,1)");
                        if($imageqry !== false) {
                            $imageqry->bind_param('ss',$productId,$image);
                            if($imageqry->execute()){
                                move_uploaded_file($image_tmp,$_SERVER['DOCUMENT_ROOT']."/school/webshop/assets/upload/".$image);
                                echo "Product with image ".$image." added.<br>";
                            }
                        }
                    }
                    echo "Product with name " . $name . " added.";
                    header('Refresh: 2; index.php');
                }
            }
            $imageqry->close();
            $liqry->close();
        }
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" value=""><br>
    Description: <textarea type="text" name="description" value=""></textarea><br>
    Category:   
    <select name="category">
        <option value="1">Tafellamp</option>
        <option value="2">Buitenlamp</option>
        <option value="3">Designlamp</option>
        <option value="4">Bureaulamp</option>
    </select> <br>
    Price: <input type="number" name="price" value=""><br>
    Color: <input type="text" name="color" value=""><br>
    Weight: <input type="number" name="weight" value=""><br>
    Photo's (MAX = 3):<input type="file" name="image[]" multiple><br><br>

    <input type="submit" name="submit" value="Add">
    <a href="index.php">Go Back</a>
</form>

<?php
    include('../core/footer.php');
?>