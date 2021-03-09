

<!DOCTYPE html>
<html>

<head>
    <?php 
        include_once("components/header.php");
    ?>
    <title>User Update</title>
  
</head>

<body>
    <?php include_once('components/navigation.php');?>
    <?php include_once('components/navbar.php');?>

    <?php 
    
        require_once('databaseConn.php');
        // session_start();
        if(isset($_POST['submit'])){
        
            $sql = "UPDATE donation SET date_received = :date, statusID = :statusID WHERE donationID = :donationID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':donationID' => $_POST['donationID'],
            ':date' => $_POST['date_received'],
            ':statusID' => $_POST['statusID']
            )); 
            header('Location: donations.php');

            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM donation WHERE donationID = :xyz");
        $stmt->execute(array(':xyz' => $_GET['donationID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
            header("Location: donations.php");
            return;
        }
        $donationID = htmlentities($row['donationID']);
        // $date = htmlentities($row['date_received']);
        // $status = htmlentities($row['statusID']);
    ?>
    <div class="container-fluid">
        <form id="form" method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;")'>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class='input-group' id='datetimepicker'>
                        <input type='date' name="date_received" class="form-control" id='datetimepicker' required />
                        <div class="invalid-feedback">Please input Value</div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="statusID">StatusID</label>
                        <input type="text" required name="statusID" id="statusID" class="form-control">
                        <div class="invalid-feedback">Please input Value</div>
                    </div> -->
                    <div class="form-group">
                        <select class="form-control mt-3 w-100" name="statusID" id="statusID" aria-label=".form-select-lg example" required>
                                <option selected>Open this select menu</option>
                                <option value="1">Pending</option>
                                <option value="2">Donation Accepted</option>
                                <option value="3">Ready to Claim</option>
                                <option value="4">Claim by Organization</option>
                        </select>
                        <div class="invalid-feedback">Please input Value</div>
                    </div>
                    <input type="hidden" name="donationID" value="<?= $donationID?>">
                    <input class="btn btn-primary mt-4" type="submit" name="submit" id="update" value="UPDATE">
                </div>
        </form>
    </div>
    <?php include_once('components/myscript.php'); ?>
    <script>
         $(function () {
             $('#datetimepicker').datetimepicker();
         });
    </script>
    <script>
    
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault(); 
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
  
</body>

</html>