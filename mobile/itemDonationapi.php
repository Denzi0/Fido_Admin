<?php


    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donorname = mysqli_real_escape_string($db,$_POST['donorname']);
    $itemtitle = mysqli_real_escape_string($db,$_POST['itemtitle']);
    $itemname = mysqli_real_escape_string($db,$_POST['itemname']);
    $itemtype = mysqli_real_escape_string($db,$_POST['itemtype']);
    $itemquantity = mysqli_real_escape_string($db,$_POST['itemquantity']);
    $itemDescription = mysqli_real_escape_string($db,$_POST['itemdescription']);

    $sql = "INSERT INTO donoritem(donorID,itemtitle,itemname,itemquantity,itemtype,description)
    VALUES((SELECT donorID FROM donor WHERE donorUname = '$donorname'),'$itemtitle',
    '$itemname','$itemquantity','$itemtype','$itemDescription')";

    $result = mysqli_query($db,$sql);
    if($result > 0 ){
        echo json_encode("Success");
    }
?>