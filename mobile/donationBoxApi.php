<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donorname = mysqli_real_escape_string($db,$_POST['donorUsername']);
    // header('Content-type: application/json');
    $sql = $db->query("SELECT * FROM donation_box_view WHERE donorID = (SELECT donorID FROM donor WHERE userID = (SELECT userID FROM user WHERE username='$donorname'))");

    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }

    echo json_encode($result);

?>