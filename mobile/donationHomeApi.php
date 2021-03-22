<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $requestID = mysqli_real_escape_string($db,$_POST['orgID']);
    $donorname = mysqli_real_escape_string($db,$_POST['donorname']);
    $donationname = mysqli_real_escape_string($db,$_POST['donationname']);
    $donationtype = mysqli_real_escape_string($db,$_POST['donationtype']);

    $donationquantity = mysqli_real_escape_string($db,$_POST['donationquantity']);
    $description = mysqli_real_escape_string($db,$_POST['description']);
    $date = mysqli_real_escape_string($db,$_POST['date']);

   
        ////
    $sqldon = "INSERT INTO donation (donorID,donationName,donationTypeID,donation_quantity,donation_description,date,statusID)
    VALUES((SELECT donorID FROM donor WHERE userID = (SELECT userID FROM user WHERE username = '$donorname')),'$donationname','$donationtype','$donationquantity','$description','$date','1')";
    $resultdon = mysqli_query($db,$sqldon);

    // $sql = "UPDATE donation_request SET donationID = '420'
    // WHERE requestID = '$requestID'";
    // $result = mysqli_query($db,$sql);
    //
    if($resultdon){
        $sqldonationBox = "INSERT INTO donation_box (requestID,donationID,statusID)
        VALUES('$requestID',(SELECT donationID from donation WHERE donationName ='$donationname'),'1')";
    
        $resultdonationBox = mysqli_query($db,$sqldonationBox);
    }
  
    // $sqlcheck = "SELECT * from donation where donorID = '205'"; 
    // $resultcheck = mysqli_query($db, $sqlcheck);
    // $count  = mysqli_num_rows($resultcheck);
    if($resultdon){
        echo json_encode("Success");
    }else {
        echo json_encode("Error");
    }
    // $sql = "UPDATE donation_request SET donationID = (SELECT donationID FROM donation WHERE donorID = (SELECT donorID FROM donor WHERE userID = (SELECT userID FROM user WHERE username = '$donorname'))

?> 