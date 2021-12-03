<?php
include('../Login/login.php');
error_reporting(0);

if(isset($_SESSION['perm'])){
    if($_SESSION['perm'] == true){
        $_SESSION['perm'] = true;
    }
    else{
        $_SESSION['perm'] = false;
    }
}



