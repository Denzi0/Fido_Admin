<!DOCTYPE html>
<html>
<head>
    <?php 
        include_once("components/header.php");
        require_once("databaseConn.php");
        session_start();
        if(empty($_SESSION['access'])){
             header("Location: index.php");
                    die();
        }
        $stmtdonation_box = $pdo->query("SELECT * FROM donation_box");
        $stmtdonation_box_view = $pdo->query("SELECT * FROM donation_box_view");
    ?>
    <title>Donations</title>

</head>
<body>
    <?php include_once('components/navigation.php')?>
    <?php include_once('components/navbar.php')?>
    <div class="container-fluid">
   
        
   
    <table id="dataTableDonationBoxView" class="text-center table table-striped table-bordered " style="width:100%">
        <!-- <h2 id="donorDonation">Donations</h2> -->
        <thead class="thead-dark">
            <tr>
                <th>Donation Box ID</th>
                <th>Request ID</th>
                <!-- <th>orgID</th> -->
                <th>orgName</th>
                <th>donationID</th>
                <!-- <th>donorID</th> -->
                <th>donorName</th>
                <th>date_given</th>
                <th>orgFeedback</th>
                <th>statusDescription</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmtdonation_box_view->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr><td>";
                    echo(htmlentities($row['donation_boxID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['requestID']));
                    // echo ("</td><td>");
                    // echo(htmlentities($row['orgID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgName']));
                    echo ("</td><td>");
                    echo(htmlentities($row['donationID']));
                    // echo ("</td><td>");
                    // echo(htmlentities($row['donorID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['donorName']));
                    echo ("</td><td>");
                    echo(htmlentities($row['date_given']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgFeedback']));
                    echo ("</td><td class='text-white bg-success'>");
                   
                    echo(htmlentities($row['statusDescription']));
                    echo ("</td><td>");
                    echo ('<a class="btn btn-primary" href="donation_boxUpdate.php?donation_boxID=' .$row['donation_boxID'] . '">Notify</a>');
                    echo ("</td></tr>");
                }

            ?>
        
        </tbody>
    </table>    
    <button class="btn btn-primary" id="showDatabase">Show Database</button>

   <table id="dataTableDonationBox" class="text-center table table-striped table-bordered " style="width:100%">
        <!-- <h2 id="donorDonation">Donations</h2> -->
        <thead class="thead-dark">
            <tr>
                <th>Donation Box ID</th>
                <th>Request ID</th>
                <th>Donation ID</th>
                <th>Date Given</th>
                <th>Org feedback</th>

                <th>Status</th>
                <th>Action</th>
                

            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmtdonation_box->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr><td>";
                    echo(htmlentities($row['donation_boxID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['requestID']));
                    echo ("</td><td>");
                    echo(htmlentities($row['donationID']));
                    echo ("</td><td>");
                     echo(htmlentities($row['date_given']));
                    echo ("</td><td>");
                    echo(htmlentities($row['orgFeedback']));
                    echo ("</td><td>");
                    echo(htmlentities($row['statusID']));
                    echo ("</td><td>");
                    echo ('<a class="btn btn-primary" href="donation_boxUpdate.php?donation_boxID=' .$row['donation_boxID'] . '">Notify</a>');
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
            $('#dataTableDonationBox').DataTable();
            $('#showDatabase').click(function(){
                
                $('#dataTableDonationBox').parents('div.dataTables_wrapper').first().toggle();
            });
        });
    </script>
    <script>  
        //this is table Javascript
        $(document).ready(function () {
            $('#dataTableDonationBoxView').DataTable();
           
        });
    </script>
</body>

</html>