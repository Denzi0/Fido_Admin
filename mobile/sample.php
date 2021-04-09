<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    // $donorname = mysqli_real_escape_string($db,$_POST['donorUsername']);
  
    $sql = $db->query("SELECT * FROM donation_box_view");

    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }

    echo json_encode($result);

?>