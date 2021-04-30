
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
  	$file = $_FILES['files']['name'];

	$orgname = mysqli_real_escape_string($db,$_POST['orgname']);
	$personincharge = mysqli_real_escape_string($db,$_POST['personInCharge']);
	$contact = mysqli_real_escape_string($db,$_POST['contact']);
	$address = mysqli_real_escape_string($db,$_POST['address']);
	$website = mysqli_real_escape_string($db,$_POST['website']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$tinNumber = mysqli_real_escape_string($db,$_POST['tinNumber']);
	////
  	$filePath ="../filesUploads/".$file;

    ///	
    $passwordRandom = mysqli_real_escape_string($db,$_POST['randompassword']);
	$hashpasswordDonor = password_hash($passwordRandom,PASSWORD_DEFAULT);

	$sqluserOrgReg = "INSERT INTO user(username,password,usertype)
	VALUES('$orgname','$hashpasswordDonor','Organization')";
	$resultorgReg = mysqli_query($db,$sqluserOrgReg);
	move_uploaded_file($_FILES['files']['tmp_name'],$filePath);
    if($resultorgReg){
	    $sqlReg = "INSERT INTO organization(orgName,orgPersonInCharge,orgContact,orgAddress,orgEmail,orgWebsite,orgTinNumber, orgfiles,userID)
	    VALUES('$orgname','$personincharge','$contact','$address' ,'$email','$website','$tinNumber','$file',(SELECT userID FROM user WHERE username ='$orgname' ))";
	    $resultReg = mysqli_query($db,$sqlReg);
    }
	if ($resultReg) {
		echo json_encode("Success");
	} 
			
			
	
?>



