<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	$orgname = $_POST['orgname'];
	$orgpassword = $_POST['orgpassword'];
    $sql = "SELECT * FROM user WHERE username = '".$orgname."'  AND password = '".$orgpassword."' AND usertype='Organization'";
	$result = mysqli_query($db, $sql);
    $count  = mysqli_num_rows($result);
    if($count == 1){
        echo json_encode("Success");
    }else {
        echo json_encode("Error");

    }
?>