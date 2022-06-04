<?php 
    session_start(); 
    
    if(!(isset($_SESSION['token']))){
        echo "<script> window.location='login.php?session=null' </script>";
    }
?>