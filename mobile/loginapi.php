<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	// $fname = $_POST['fullname'];
	// $address = $_POST['address'];
	$username = $_POST['username'];
	// $email = $_POST['email'];
	// $age = $_POST['age'];
	// $contact = $_POST['contact'];
	$password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '".$username."'  AND password = '".$password."' ";

	$result = mysqli_query($db, $sql);

    $count  = mysqli_num_rows($result);
    
    if($count == 1){
        echo json_encode("Success");
    }else {
        echo json_encode("Error");

    }
?>