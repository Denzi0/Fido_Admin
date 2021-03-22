<?php
    require_once('databaseConn.php');
    session_start();
       if(empty($_SESSION['access'])){
                    header("Location: index.php");
                    die();
        }
    $stmt = $pdo->query("SELECT * FROM donation_request");
    $stmtView = $pdo->query("SELECT * FROM donation_request_view");

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
    <table id="dataTableView" class="table table-striped table-bordered mt-3 text-center" style="width:100%">
        <h2 id="donorDonation">Donation Requests</h2>
        <thead>
            <tr>
                <th>RequestID</th>
                <th>Organization Name</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Urgent</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmtView->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr><td>";
                    echo(htmlentities($row['requestID']));
                    // echo ("</td><td>");
                    // echo(htmlentities($row['donationID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgName']));
                   
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
                    // echo ("</td><td>");
                    // echo (htmlentities($row['images']));
                    echo ("</td><td class='bg-white text-success'>");
                    echo (htmlentities($row['statusDescription']));
                    echo ("</td><td>");
                    echo ('<a class="btn btn-primary" href="requestListUpdate.php?requestID=' .$row['requestID'] .  '">Update</a>');
                    echo ("</td></tr>");
                }

            ?>
        
        </tbody>
    </table>    
    <button class="btn btn-primary" id="showDatabase">Show Database</button>
     <table id="dataTableReq" class="table table-striped table-bordered mt-3 text-center" style="width:100%">
        <!-- <h2 id="donorDonation">Donation Requests</h2> -->
        <thead>
            <tr>
                <th>RequestID</th>
                <!-- <th>DonationID</th> -->

                <th>Org ID</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Urgent</th>
                <th>Request Date</th>
                <!-- <th>Images</th> -->
                <th>Status ID</th>
                <th>Update</th>

            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr><td>";
                    echo(htmlentities($row['requestID']));
                    // echo ("</td><td>");
                    // echo(htmlentities($row['donationID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgID']));
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
                    // echo ("</td><td>");
                    // echo (htmlentities($row['images']));
                    echo ("</td><td>");
                    echo (htmlentities($row['statusID']));
                    echo ("</td><td>");
                    echo ('<a class="btn btn-primary" href="requestListUpdate.php?requestID=' .$row['requestID'] . '">Update</a>');
                    echo ("</td></tr>");
                }

            ?>
        
        </tbody>
    </table>    
    
    </div>
    <?php include_once('components/myscript.php'); ?>
    <script>  
        // $(document).ready(function() {
        //     $('#showDatabase').click(function(){
        //         $('#dataTableReq').toggle();
        //     });
        // }
        //this is table Javascript
        $(document).ready(function () {
            $('#dataTableView').DataTable();
            
            //toggle show and hide Database on click of #showDatabase ID 
             $('#showDatabase').click(function(){
                
             $('#dataTableReq').parents('div.dataTables_wrapper').first().toggle();
            });
        });
        $(document).ready(function () {
            $('#dataTableReq').DataTable();
        });
    </script>
</body>
    

</html>