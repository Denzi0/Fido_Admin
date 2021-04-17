<?php
    require_once('databaseConn.php');
    session_start();
    if(empty($_SESSION['access'])){
        header("Location: index.php");
        die();
    }
    $sql = "SELECT * FROM user";

    $stmt = $pdo->query($sql);


?>


<!DOCTYPE html>
<html>
<head>    
    <?php 
        include_once("components/header.php");
    ?>
    <title>Donor</title>
</head>

<body>
    <?php include_once('components/navigation.php')?>
    <?php include_once('components/navbar.php')?>
    <div class="container-fluid">
        <div class="mt-5">
            <h2>Users</h2>
            <table id="dataTableUsers" class="table table-striped table-bordered text-center" >
                <thead class="thead-dark">
            
                    <tr>
                        <th>UserID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Usertype</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "<tr><td>";
                            echo (htmlentities($row['userID']));
                            echo "</td><td>";
                            echo (htmlentities($row['username']));
                            echo "</td><td>";
                            echo (htmlentities($row['password']));
                            echo "</td><td>";
                            echo (htmlentities($row['usertype']));
                            echo "</td><td>";
                            echo ('<a class="btn btn-danger" href="userDelete.php?userID='  .$row['userID'] . '">DELETE</a> ');
                            // echo ('<a class="btn btn-primary" href="userUpdate.php?userID='  .$row['userID'] . '">UPDATE</a> ');
                            echo "</td></tr>";
                        }
    
                    
                    ?>
                    
                </tbody>
            </table>
        
        
        </div>
    </div>
    <?php include_once('components/myscript.php'); ?>
    <script>  
        //this is table Javascript
        $(document).ready(function () {
            $('#dataTableUsers').DataTable();
        });
    </script>
  
   
</body>

</html>