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

   
    

    $sqldon = "INSERT INTO donation (donorID,donationName,donationTypeID,donation_quantity,donation_description,date,statusID)
    VALUES((SELECT donorID FROM donor WHERE userID = (SELECT userID FROM user WHERE username = '$donorname')),'$donationname','$donationtype','$donationquantity','$description','$date','1')";
    
    $resultdon = mysqli_query($db,$sqldon);

 
    if($resultdon){
        $sqldonationBox = "INSERT INTO donation_box (requestID,donationID,statusID)
        VALUES('$requestID',(SELECT donationID from donation WHERE donationName = '$donationname' or donation_description ='$description'),'1')";
    
        $resultdonationBox = mysqli_query($db,$sqldonationBox);
    }
  
   
    if($resultdon){
        echo json_encode("Success");
    }else {
        echo json_encode("Error");
    }

?> 