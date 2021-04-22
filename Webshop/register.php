<?php
    include('core/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>LightSend</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Welcome by <b>LightSend</b></h1>
    </header>
    <main>

<h1>Register here!</h1>

<?php
    if (isset($_POST['submit']) && $_POST['submit'] != ''){
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
                header('Location: index.php');
            }
        }
        $liqry->close();
    }
?>

<form action="" method="POST">
    <span class="regInput">Gender:</span>
    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br><br>
    <span class="regInput">First name:</span> <input type="text" name="firstname"><br><br>
    <span class="regInput">Middle name:</span><input type="text" name="midname"><br><br>
    <span class="regInput">Last name:</span><input type="text" name="lastname"><br><br>
    <span class="regInput">Street:</span><input type="text" name="street"><br><br>
    <span class="regInput">House number:</span><input type="number" name="housenum"><br><br>
    <span class="regInput">House number addon:</span><input type="text" name="housenumadd"><br><br>
    <span class="regInput">Zip code:</span><input type="text" name="zip"><br><br>
    <span class="regInput">City:</span><input type="text" name="city"><br><br>
    <span class="regInput">Phone:</span><input type="tele" name="phone"><br><br>
    <span class="regInput">Email: </span><input type="email" name="email"><br><br>
    <span class="regInput">Password: </span><input type="password" name="password"><br><br>
    <span class="regInput">Newsletter subscription:</span>
    <select name="news">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br><br>
    <br>
    <input type="submit" name="submit" value="Add">
    <p>Already have an account? <a href="index.php" class="link">Login here!</a></p>
</form>



<?php
    include('core/footer.php');
?>