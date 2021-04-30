<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	$orgUname = mysqli_real_escape_string($db,$_POST['orgusername']);
	$orgNewPassword = mysqli_real_escape_string($db,$_POST['orgNewpassword']);
	$orgOldPassword = mysqli_real_escape_string($db,$_POST['orgOldpassword']);

	$hashNewpassword = password_hash($orgNewPassword,PASSWORD_DEFAULT);


    $sqlpassword = "UPDATE user SET password = '$hashNewpassword' WHERE username = '$orgUname'";
	$result = mysqli_query($db, $sqlpassword);
    
    if($result>0){
        echo json_encode("Success");;
    }
    
?>