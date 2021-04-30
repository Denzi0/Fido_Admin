<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    date_default_timezone_set('Asia/Manila');
    $todays_date = date("y-m-d h:i:sa");

    // $donationID = mysqli_real_escape_string($db,$_POST['donationID']);
    $donationBoxID = mysqli_real_escape_string($db,$_POST['donation_boxID']);
    $trackingNumber = mysqli_real_escape_string($db,$_POST['trackingNumber']);
    $requestID = mysqli_real_escape_string($db,$_POST['requestID']);
    $donationQuantity= mysqli_real_escape_string($db,$_POST['donationQuantity']);

    $sqlquantity = "UPDATE donation_request SET quantity = quantity - '$donationQuantity' WHERE requestID = '$requestID'";
    $sqlqueryQuantity = mysqli_query($db,$sqlquantity);


    $sql = "UPDATE donation_box SET statusID = '$trackingNumber',date_given = '$todays_date' WHERE donation_boxID = '$donationBoxID'";
    $sqlquery = mysqli_query($db,$sql);

    // $sqlDon = "UPDATE donation SET date_received = '$todays_date' WHERE donation_boxID = '$donationBoxID'";
    // $sqlqueryDon = mysqli_query($db,$sqlDon);
    

    if($sqlquery){
        echo json_encode("Success");
    }



?>