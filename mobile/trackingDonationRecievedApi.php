<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donationID = mysqli_real_escape_string($db,$_POST['donationID']);

    $donationBoxID = mysqli_real_escape_string($db,$_POST['donation_boxID']);
    $trackingNumber = mysqli_real_escape_string($db,$_POST['trackingNumber']);
    $sqlApprove = "UPDATE donation SET statusID = '5' WHERE donationID = '$donationID'";
    
    $sqlqueryApprove = mysqli_query($db,$sqlApprove);
    $sql = "UPDATE donation_box SET statusID = '$trackingNumber' WHERE donation_boxID = '$donationBoxID'";
    $sqlquery = mysqli_query($db,$sql);

    if($sqlquery){
        echo json_encode("Success");
    }



?>