<?php 
    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $sql = $db->query("SELECT * FROM donation WHERE donorID = (SELECT donorID FROM donor WHERE donorName = 'Denzel')");

    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }
    echo json_encode($result);



?>