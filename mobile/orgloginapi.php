<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	$orgname = $_POST['orgname'];
	$orgpassword = $_POST['orgpassword'];
    $sql = "SELECT * FROM user WHERE username = '".$orgname."' AND usertype='Organization'";
    //  AND password = '".$orgpassword."'
	$result = mysqli_query($db, $sql);
    $count  = mysqli_num_rows($result);

    
    if($count == 1){
        $row = mysqli_fetch_array($result);
        if(password_verify($orgpassword,$row['password'])){
            echo json_encode("Success");
        }else {
            echo json_encode("Error");
        }
    }else {
        echo json_encode("Error");

    }
?>