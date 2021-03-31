<?php 
  $db = mysqli_connect('localhost','root','','fido');

    if(!$db){
      echo "database failed";
    }
    // $donorname = mysqli_real_escape_string($db,$_POST['donorUsername']);
    $orgname = mysqli_real_escape_string($db,$_POST['orgUsername']);
    // $sql = $db->query("SELECT * FROM donation_box_view");
    $sql = $db->query("SELECT * FROM donation_box_view where orgID = (SELECT orgID FROM organization WHERE userID = (SELECT userID FROM user WHERE username = '$orgname'))");

    $result = array();

    while($rowdata = $sql->fetch_assoc()){
        $result[] = $rowdata; 
    }

    
    echo json_encode($result);

?>