<?php
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
   
    $image = $_FILES['image']['name'];
    $imagePath = 'uploadOrg/'.$image;
    $tmp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_name,$imagePath);
    $db->query("INSERT INTO donation_request(images) VALUES('".$image."') WHERE orgID ='332'");


?>