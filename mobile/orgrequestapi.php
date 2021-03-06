<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $orgname = mysqli_real_escape_string($db,$_POST['orgname']);
    $foodname = mysqli_real_escape_string($db,$_POST['foodname']);
    $foodtype = mysqli_real_escape_string($db,$_POST['foodtype']);
    $foodquantity = mysqli_real_escape_string($db,$_POST['foodquantity']);
    $itemname = mysqli_real_escape_string($db,$_POST['itemname']);
    $itemtype = mysqli_real_escape_string($db,$_POST['itemtype']);
    $itemquantity = mysqli_real_escape_string($db,$_POST['itemquantity']);
    $description = mysqli_real_escape_string($db,$_POST['description']);
    $isUrgent = mysqli_real_escape_string($db,$_POST['isUrgent']);
    $currentdate = mysqli_real_escape_string($db,$_POST['daterequest']);

    $sql = "INSERT INTO orgrequest (orgID,foodname,foodtype,foodquantity,itemname,itemtype,itemquantity,description,isUrgent,daterequest)
    VALUES((SELECT orgID FROM organization WHERE orgname = '$orgname'),'$foodname','$foodtype','$foodquantity','$itemname','$itemtype',
    '$itemquantity','$description','$isUrgent' ,'$currentdate')";

    $result = mysqli_query($db,$sql);
    
    if($result>0){
        echo json_encode("Success");;
    }
?>