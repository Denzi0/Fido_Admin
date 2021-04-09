<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donationMatch = mysqli_real_escape_string($db,$_POST['donationMatch']);
    $sql = $db->query("SELECT * FROM donation_request_view  WHERE name LIKE '%$donationMatch%' ");

    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }
    echo json_encode($result);


?>