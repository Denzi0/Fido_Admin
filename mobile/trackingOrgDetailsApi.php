<?php 
  $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $orgusername = mysqli_real_escape_string($db,$_POST['orgusername']);
  
    $sql = $db->query("SELECT * FROM organization WHERE orgName = '$orgusername'");
    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }

    echo json_encode($result);

?>