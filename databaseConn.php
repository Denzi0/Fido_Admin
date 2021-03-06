<?php 
$servername = "localhost";
$username = "root";
$dbname = "fido";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo 'connected';
        
    }catch(PDOException $e){
        echo "Connection failed" . $e->getMessage();
    }
?>