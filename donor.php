<?php 

   session_start();

   if(empty($_SESSION['access'])){
        header("Location: index.php");
        die();
    }


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
 
    <?php 
        include_once('databaseConn.php'); 
        
        $sql = "SELECT * FROM donor";
        $stmt = $pdo->query($sql);

        $sqldonortype = "SELECT * from donor_type";
        $stmtdonortype = $pdo->query($sqldonortype);
    ?>

    <div class="container-fluid">
          <?php 
             
                if(isset($_SESSION['successdonor'])){
                    echo '<label class="alert alert-success">' . $_SESSION['successdonor'] . '</label>';
                    unset($_SESSION['successdonor']);
                }
                if(isset($_SESSION['errordonor'])){
                    echo '<label class="alert alert-danger>' . $_SESSION['errordonor'] . '</label>';
                }
            ?>
    <table id="dataTable" class="table table-striped table-bordered text-center" style="width:100%">
            <h2 id="donor">Donor</h2>
            <thead class="thead-dark">
                <tr>
                    <th>Donor ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>UserID</th>
                    <th>DELETE</th>
                </tr>
                <tbody>

                <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr><td>";
                        echo(htmlentities($row['donorID']));
                        echo ("</td><td>");
                        echo(htmlentities($row['donorName']));
                        echo ("</td><td>");
                        if($row['donorTypeID'] == 1){
                            echo htmlentities("Individual");
                        }else {
                            echo htmlentities("Organization");
                        }
                        
                        
                        
                        echo ("</td><td>");
                        echo(htmlentities($row['donorAddress']));
                        echo ("</td><td>");
                        echo(htmlentities($row['donorEmail']));
                        echo ("</td><td>");
                        echo(htmlentities($row['donorAge']));
                        echo ("</td><td>");
                        echo(htmlentities($row['donorContact']));
                        echo ("</td><td>");
                        echo(htmlentities($row['userID']));
                        echo ("</td><td>");
                        echo ('<a class="btn btn-danger" href="deleteDon.php?donorID='  .$row['donorID'] . '">DELETE</a>');
                        echo ("</td></tr>");

                    }
                  
                ?>
                 </tbody>
           
        </table>
        <table id="datadonortype" class="table table-striped table-bordered" style="width:100%">
            <h2 id="donor">Donor Type</h2>
            <thead class="thead-dark">
                <tr>
                    <th>DonorTypeID</th>
                    <th>DonorTypeName</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $stmtdonortype->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr><td>";
                        echo(htmlentities($row['donorTypeID']));
                        echo ("</td><td>");
                        echo(htmlentities($row['donorTypeName']));
                        echo ("</td></tr>");

                    }
                  
                ?>
            </tbody>
        </table>
     
    </div>

  

    <!-- /#page-content-wrapper -->

  
    <?php include_once('components/myscript.php'); ?>

    <script>  
        //this is table Javascript
        $(document).ready(function () {
            $('#datadonortype').DataTable();
        });
    </script>
   
   
</body>

</html>