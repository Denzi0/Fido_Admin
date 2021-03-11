<?php 

    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donorname = mysqli_real_escape_string($db,$_POST['donorname']);
    $donationname = mysqli_real_escape_string($db,$_POST['donationname']);
    $donationtype = mysqli_real_escape_string($db,$_POST['donationtype']);
    $donationquantity = mysqli_real_escape_string($db,$_POST['donationquantity']);
    $description = mysqli_real_escape_string($db,$_POST['description']);
    $date = mysqli_real_escape_string($db,$_POST['date']);
    $sql = "INSERT INTO donation (donorID,donationName,donationTypeID,donation_quantity,donation_description,date,statusID)
    VALUES((SELECT donorID FROM donor WHERE userID = (SELECT userID FROM user WHERE username = '$donorname')),'$donationname','$donationtype','$donationquantity','$description','$date','1')";

    $result = mysqli_query($db ,$sql);
    

    if($result > 0){
        echo json_encode("Success");
    }
?>