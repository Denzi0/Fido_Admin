<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    ///
    date_default_timezone_set('Asia/Manila');
    $todays_date = date("y-m-d h:i:sa");
 
    //
    $donationBoxID = mysqli_real_escape_string($db,$_POST['donation_boxID']);
    $trackingNumber = mysqli_real_escape_string($db,$_POST['trackingNumber']);
    // $donationID = mysqli_real_escape_string($db,$_POST['donationID']);
    ///date given is date recieved
    $sql = "UPDATE donation_box SET statusID = '$trackingNumber',date_given = 
    '$todays_date' WHERE donation_boxID = '$donationBoxID'";
    $sqlquery = mysqli_query($db,$sql);

    // $sqlUpdateReceived = "UPDATE donation SET date_received = '$todays_date' WHERE donationID='$donationID' ";
    // $sqlqueryReceived = mysqli_query($db,$sqlUpdateReceived);

    if($sqlquery){
        echo json_encode("Success");
    }



?>