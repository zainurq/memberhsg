<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["logged_in"])){
    if($_SESSION["logged_in"] == true) {
        $login = 'true';
    }else{
        $login = 'false';
    }
}else{
    $login = 'false';
}

?>