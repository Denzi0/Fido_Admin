<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $orgname = mysqli_real_escape_string($db,$_POST['orgname']);
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $quantity = mysqli_real_escape_string($db,$_POST['quantity']);
    // $itemname = mysqli_real_escape_string($db,$_POST['itemname']);
    // $itemtype = mysqli_real_escape_string($db,$_POST['itemtype']);
    // $itemquantity = mysqli_real_escape_string($db,$_POST['itemquantity']);
    $description = mysqli_real_escape_string($db,$_POST['description']);
    $isUrgent = mysqli_real_escape_string($db,$_POST['isUrgent']);
    $currentdate = mysqli_real_escape_string($db,$_POST['daterequest']);

    $sql = "INSERT INTO donation_request (orgID,name,quantity,description,Urgent,requestDate)
    VALUES((SELECT orgID FROM organization WHERE orgname = '$orgname'),'$name','$quantity','$description','$isUrgent' ,'$currentdate')";

    $result = mysqli_query($db,$sql);
    
    if($result>0){
        echo json_encode("Success");;
    }
?>