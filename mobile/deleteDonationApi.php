<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donationID = mysqli_real_escape_string($db,$_POST['donationID']);
    // header('Content-type: application/json');
    $sql = $db->query("DELETE FROM donation WHERE donationID = '$donationID'");

  

?>