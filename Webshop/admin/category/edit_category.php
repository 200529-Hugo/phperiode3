<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Edit category</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $id = $con->real_escape_string($_POST['id']);
        $name = $con->real_escape_string($_POST['name']);
        $description = $con->real_escape_string($_POST['description']);
        $active = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE category SET name = ?, description = ?, active = ? WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('sssi',$name,$description,$active,$id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red; width: fit-content;">Category edited</div>';
            header('Refresh: 2; index.php');
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT category_id,name,description,active FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($id,$name,$description,$active);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo 'ID: <input type="text" name="id" value="' . $id . '" readonly><br>';
                    echo 'Name: <input type="text" name="name" value="' . $name . '"><br>';
                    echo 'Description: <textarea type="text" name="description">'.$description.'</textarea><br>';
                    echo 'Active: <select name="active"><option value="1">Yes</option><option value="0">No</option></select><br>';
                }
            }
        }
        $liqry->close();

    }
?>
<br>
<input type="submit" name="submit" value="Save">
<a href="index.php">Go Back</a>
</form>

<?php
    include('../core/footer.php');
?>