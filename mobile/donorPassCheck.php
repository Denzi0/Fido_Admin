<?php

    $db = mysqli_connect('localhost','root','','fido');

	if(!$db){
		echo "database failed";
	}
    $email = $_POST['donoremail'];
    $select = $db->query("SELECT * FROM donor WHERE donorEmail = '".$email."'");
    $count = mysqli_num_rows($select);
    $data = mysqli_fetch_assoc($select);
    // $idData = $data['donorID'];
    // $userData = ;

    if($count == 1){
        $url = 'http://'.$_SERVER['SERVER_NAME'].'/phpPractice/mobile/donorPassChange.php?id='.$data['donorID'].'&email='.$data['donorEmail'];
        echo json_encode($url);
    }else {
        echo json_encode('Invalid');
    }


?>