<?php 
    echo $_SESSION['logged_in'];

    if(isset($_SESSION['logged_in'])){
        header("location:../../home.php");
    }
?>