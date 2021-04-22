<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Add customer</h1>

<?php
    if (isset($_POST['gender']) && isset($_POST['firstname']) && isset($_POST['midname']) && isset($_POST['lastname']) && isset($_POST['street']) && isset($_POST['housenum']) && isset($_POST['housenumadd']) && isset($_POST['zip']) && isset($_POST['city']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['news'])){
        $gender = $con->real_escape_string($_POST['gender']);
        $firstname = $con->real_escape_string($_POST['firstname']);
        $midname = $con->real_escape_string($_POST['midname']);
        $lastname = $con->real_escape_string($_POST['lastname']);
        $street = $con->real_escape_string($_POST['street']);
        $housenum = $con->real_escape_string($_POST['housenum']);
        $housenumadd = $con->real_escape_string($_POST['housenumadd']);
        $zip = $con->real_escape_string($_POST['zip']);
        $city = $con->real_escape_string($_POST['city']);
        $phone = $con->real_escape_string($_POST['phone']);
        $email = $con->real_escape_string($_POST['email']);
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $news = $con->real_escape_string($_POST['news']);

        $liqry = $con->prepare("INSERT INTO customer (gender, first_name, middle_name, last_name, street, house_number, house_number_addon, zip_code, city, phone, emailadres, password, newsletter_subscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('sssssssssssss',$gender,$firstname,$midname,$lastname,$street,$housenum,$housenumadd,$zip,$city,$phone,$email,$passwordHash,$news);
            if($liqry->execute()){
                echo "Customer with email " . $email . " added.";
                header('Location: index.php');
            }
        }
        $liqry->close();
    }
?>

<form action="" method="POST">
    Gender: <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
    First name: <input type="text" name="firstname"><br>
    Middle name:<input type="text" name="midname"><br>
    Last name:<input type="text" name="lastname"><br>
    Street:<input type="text" name="street"><br>
    House number:<input type="text" name="housenum"><br>
    House number addon:<input type="text" name="housenumadd"><br>
    Zip code:<input type="text" name="zip"><br>
    City:<input type="text" name="city"><br>
    Phone:<input type="text" name="phone"><br>
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    Newsletter subscription:
    <select name="news">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br>
    <br>
    <input type="submit" name="submit" value="Add">
    <a href="index.php">Go Back</a>
</form>



<?php
    include('../core/footer.php');
?>