     <?php 
        
        require_once("databaseConn.php");
        session_start();
        if(isset($_SESSION['username'])){
            $message = '<label class="alert alert-success w-100">Login Success , Welcome - ' .$_SESSION['username'] . '</label>'; 
        }else { 
            header('Location: index.php');
        }
        // Dashboard count the Registered Organization
        $stmtDonor = $pdo->query("SELECT * FROM donor");
        $stmtOrg = $pdo->query("SELECT * FROM organization");
        $stmtDonation = $pdo->query("SELECT * FROM donation");
        $stmtUsers = $pdo->query("SELECT * FROM user");
        $stmtRequest = $pdo->query("SELECT * FROM donation_request");
        $stmtDonationBox = $pdo->query("SELECT * FROM donation_box_view");

        ///
        $food = 0;
        $item = 0;
        $clothes = 0;
        $foodanditem = 0;
        $other = 0;
        while($row = $stmtDonation->fetch(PDO::FETCH_ASSOC)){
            if($row['donationTypeID'] == 0){
                $food = $food + 1;
            }
            if($row['donationTypeID'] == 1){
                $item = $item + 1;
            }
            if($row['donationTypeID'] == 2){
                $clothes = $clothes + 1;
            }
            if($row['donationTypeID'] == 3){
                $foodanditem = $foodanditem + 1;
            }
            if($row['donationTypeID'] == 4){
                $other = $other + 1;
            }
            

        }
        $foodRequest = 0;
        $itemRequest = 0;
        $clothesRequest = 0;
        $foodanditemRequest = 0;
        $otherRequest = 0;
        while($row = $stmtRequest->fetch(PDO::FETCH_ASSOC)){
            if($row['type'] == 'Food'){
                $foodRequest = $foodRequest + 1;
            }
            if($row['type'] == 'Item'){
                $itemRequest = $itemRequest + 1;
            }
            if($row['type'] == 'Clothes'){
                $clothesRequest = $clothesRequest + 1;
            }
            if($row['type'] == 'Both Food and Item'){
                $foodanditemRequest = $foodanditemRequest + 1;
            }
            if($row['type'] == 'Others'){
                $otherRequest = $otherRequest + 1;
            }
            

        }
        // var_dump($donationFetch['donationID'] );
        // $foodcount = $donationFetch['donationTypeID'];
        $donorCount = $stmtDonor->rowCount();
        $orgCount = $stmtOrg->rowCount();
        $donationCount = $stmtDonation->rowCount();
        $userCount = $stmtUsers->rowCount();
        $requestCount = $stmtRequest->rowCount();
        $donationBoxCount = $stmtDonationBox->rowCount();

        //
      ?>
<!DOCTYPE html>
<html>
<head>
    <?php 
        include_once("components/header.php");
    ?>
    <title>Dashboard</title>
</head>
<body >
      <?php include_once('components/navigation.php')?>
      <?php include_once('components/navbar.php')?>
    
    <!-- Login STATE -->
 
      
    <div class="container-fluid">
        <?php echo $message ?>
        <a class="btn btn-primary" href="adminReg.php"><i class="fas fa-user"></i> Add Admin</a>
        <div class="cards" style="margin-top:20px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-secondary text-white">
                            <h2>Donor</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $donorCount?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header bg-warning text-white">
                            <h2>Organization</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $orgCount ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="card text-center">
                        <div class="card-header bg-primary text-white">
                            <h2>Current Users</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $userCount?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card text-center">
                        <div class="card-header bg-success text-white">
                            <h2>Donor Donations</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $donationCount?></h3>
                        </div>
                        <ul class="list-group list-group-flush text-left">
                            <li class="list-group-item bg-light">Food Donations : <?= $food ?></li>
                            <li class="list-group-item">Item Donations : <?= $item?></li>
                            <li class="list-group-item bg-light">Clothes : <?= $clothes?></li>
                            <li class="list-group-item">Both Food and Item : <?= $foodanditem?></li>
                            <li class="list-group-item bg-light">Others : <?= $other?></li>

                        </ul>
                    </div>
                </div>
                 <div class="col-md-4 mt-4">
                    <div class="card text-center">
                        <div class="card-header bg-success text-white">
                            <h2>Donation Requests</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $requestCount?></h3>
                        </div>
                          <ul class="list-group list-group-flush text-left">
                            <li class="list-group-item bg-light">Food Donation Request : <?= $foodRequest ?></li>
                            <li class="list-group-item">Item Donation Request : <?= $itemRequest?></li>
                            <li class="list-group-item bg-light">Clothes Request : <?= $clothesRequest?></li>
                            <li class="list-group-item">Both Food and Item Request : <?= $foodanditemRequest?></li>
                            <li class="list-group-item bg-light">Others: <?= $otherRequest?></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card text-center">
                        <div class="card-header bg-success text-white">
                            <h2>Donation Box</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $donationBoxCount?></h3>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <canvas class="mt-5" id="myChart" width="400" height="150"></canvas>

    <!-- /#page-content-wrapper -->
    <?php include_once('components/myscript.php'); ?>
    <script>
    
      $(document).ready(function () {
            $('#dataTableDonor').DataTable();
        });
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Donor', 'Organization', 'Total Users', 'Donations', 'Request',],
        datasets: [{
            label: 'Fido',
            data: [<?= $donorCount ?>, <?= $orgCount ?>, <?=$userCount?>, <?= $donationCount ?>, <?= $requestCount ?>],
            backgroundColor: [
                '#6c757d',
                '#ffc107',
                '#007bff',
                '#28a745',
                '#28a745',
            ],
            
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    </script>
</body>

</html>