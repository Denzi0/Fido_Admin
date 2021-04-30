<?php

    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $id =  mysqli_real_escape_string($db,$_GET['id']);
    $email =  mysqli_real_escape_string($db,$_GET['email']);
    $select = $db->query("SELECT * FROM donor WHERE donorID = '$id' AND donorEmail = '$email'");
    $count = mysqli_num_rows($select);

    $newPass = rand(11111,9999);
    $newPassHash = password_hash($newPass,PASSWORD_DEFAULT);
    if($count == 1){
        //problem is id
        $update = $db->query("UPDATE user SET password ='$newPassHash' WHERE userID = (SELECT userID FROM donor WHERE donorID='$id')");
        if($update){
            echo json_decode($newPass);
        }
    }

?>