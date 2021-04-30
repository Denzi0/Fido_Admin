<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $donorname = mysqli_real_escape_string($db,$_POST['donorName']);
  
    $sql = $db->query("SELECT * FROM donor WHERE donorName = '$donorname'");
    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }

    echo json_encode($result);

?>