<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	$donorUname = mysqli_real_escape_string($db,$_POST['donorusername']);
	$donorNewPassword = mysqli_real_escape_string($db,$_POST['donorNewpassword']);
	$donorOldPassword = mysqli_real_escape_string($db,$_POST['donorOldpassword']);

	$hashNewdonorpassword = password_hash($donorNewPassword,PASSWORD_DEFAULT);

	// $sql = "SELECT password from user" ;
	// $resultpass = mysqli_real_escape_string($db,$sql);

    $sqlpassword = "UPDATE user SET password = '$hashNewdonorpassword' WHERE username = '$donorUname'";
	$result = mysqli_query($db, $sqlpassword);
    
    if($result>0){
        echo json_encode("Success");
    }
    
?>