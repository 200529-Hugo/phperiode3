<?php 
    include('core/header.php');
    include('core/checklogin.php');
    $pid = $con->real_escape_string($_GET['pid']);
?>

<h1 class="middle">UNDER CONSTRUCTION!</h1>

<div class="lol">
    <img src="assets/img/underConstruction.gif" alt="">
</div>


<a href="detail.php?pid=<?php echo $pid?>">
    <div class="buyButn">
        Go Back
    </div>
</a>

<?php
    include('core/footer.php');
?>