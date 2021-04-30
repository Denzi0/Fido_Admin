<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}


	$username = $_POST['username'];
	

	$password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '".$username."'  AND usertype ='Donor' ";
	$result = mysqli_query($db, $sql);

    $count  = mysqli_num_rows($result);
    
    if($count == 1){
		$row = mysqli_fetch_array($result);

		if(password_verify($password,$row['password'])){
			echo json_encode("Success");
		}
		else {
        	echo json_encode("Error");
    	}
	}
    else {
        echo json_encode("Error");
    }

?>