<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}

    $donation_boxID = mysqli_real_escape_string($db,$_POST['donation_boxID']);
    $sql = "UPDATE donation_box_view SET donationStatus = '5' WHERE donation_boxID = '$donation_boxID'";
    $sqlquery = mysqli_query($db,$sql);

    if($sqlquery){
        echo json_encode("Success");
    }



?>