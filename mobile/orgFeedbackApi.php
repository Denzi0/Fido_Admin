<?php

   $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $orgFeedback = mysqli_real_escape_string($db,$_POST['orgfeedback']);
    $orgDonationID = mysqli_real_escape_string($db,$_POST['orgdonation_boxID']);

    $sql = "UPDATE donation_box SET orgFeedback = '$orgFeedback' WHERE donation_boxID = '$orgDonationID'";

    $result = mysqli_query($db ,$sql);
    if($result > 0){
        echo json_encode("Success");
    }
?>