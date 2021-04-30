
<?php 


	// $fname = $_POST['fullname'];
	// $address = $_POST['address'];

	// $username = $_POST['username'];
	// $email = $_POST['email'];
	// $age = $_POST['age'];
	// $contact = $_POST['contact'];
	// $password = $_POST['password'];

	

	$db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

	$fname = mysqli_real_escape_string($db,$_POST['fullname']);
	$address = mysqli_real_escape_string($db,$_POST['address']);
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$age = mysqli_real_escape_string($db,$_POST['age']);
	$contact = mysqli_real_escape_string($db,$_POST['contact']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$donortype = mysqli_real_escape_string($db,$_POST['donortype']);
	$hashpasswordDonor = password_hash($password,PASSWORD_DEFAULT);

	
	
	

	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = mysqli_query($db, $sql);
	$count  = mysqli_num_rows($result);
	
	if ($count == 1) {
		echo json_encode("Error");
	}else{
			$sqlReg = "INSERT INTO user(username,password,usertype)
			VALUES('$username','$hashpasswordDonor','Donor')";
			$resultReg = mysqli_query($db,$sqlReg);
			
			$insert = "INSERT INTO donor(donorName,donorTypeID,donorAddress,donorEmail,donorAge
			,donorContact,userID)
			VALUES('$fname','$donortype','$address','$email','$age','$contact',(SELECT userID FROM user WHERE username = '$username'))";
			$query = mysqli_query($db,$insert);
	
			
			if ($query) {
				echo json_encode("Success");
			} 
			
			
	}
?>



