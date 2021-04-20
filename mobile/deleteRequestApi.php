<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $requestID = mysqli_real_escape_string($db,$_POST['requestID']);
    // header('Content-type: application/json');
    $sql = $db->query("DELETE FROM donation_request WHERE requestID = '$requestID'");

  

?>