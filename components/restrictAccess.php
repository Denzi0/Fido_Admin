<?php
 if(empty($_SESSION['usernamePHP'])){
    header("Location: index.php");
    die();
 }
?>