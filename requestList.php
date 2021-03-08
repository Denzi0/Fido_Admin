<?php
    require_once('databaseConn.php');
    $stmt = $pdo->query("SELECT * FROM donation_request");


?>

<html lang="en">
<head>
    <?php 
        include_once("components/header.php");
    ?>
    <title>Request Donations List</title>
</head>
<body>
    <?php include_once('components/navigation.php')?>
    <?php include_once('components/navbar.php')?>

    <div class="container-fluid">
     <table id="dataTableReq" class="table table-striped table-bordered mt-3" style="width:100%">
        <h2 id="donorDonation">Donation Requests</h2>
        <thead>
            <tr>
                <th>RequestID</th>
                <th>Org ID</th>
                <th>Donation ID</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Urgent</th>
                <th>Request Date</th>
                <th>Images</th>
                <th>Status ID</th>

            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr><td>";
                    echo(htmlentities($row['requestID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['donationID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['EmpID']));
                    echo ("</td><td>");
                    echo (htmlentities($row['name']));
                    echo ("</td><td>");
                    echo (htmlentities($row['quantity']));
                    echo ("</td><td>");
                    echo (htmlentities($row['description']));
                    echo ("</td><td>");
                    echo (htmlentities($row['Urgent']));
                    echo ("</td><td>");
                    echo (htmlentities($row['requestDate']));
                    echo ("</td><td>");
                    echo (htmlentities($row['images']));
                     echo ("</td><td>");
                    echo (htmlentities($row['statusID']));
                    echo ("</td></tr>");
                }

            ?>
        
        </tbody>
    </table>    
    </div>
    <?php include_once('components/myscript.php'); ?>
    <script>  
        //this is table Javascript
        $(document).ready(function () {
            $('#dataTableReq').DataTable();
        });
    </script>
</body>
    

</html>