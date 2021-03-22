

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
        session_start();

         if(empty($_SESSION['access'])){
                    header("Location: index.php");
                    die();
        }
        if(isset($_POST['submit'])){
        
            $sql = "UPDATE donation_request SET statusID = :statusID WHERE requestID = :requestID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':requestID' => $_POST['requestID'],
            ':statusID' => $_POST['statusID']
            )); 
            header('Location: requestList.php');

            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM donation_request_view WHERE requestID = :xyz");
        $stmt->execute(array(':xyz' => $_GET['requestID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //
        
        //
        if($row === false) {
            header("Location: requestList.php");
            return;
        }

        $requestID = htmlentities($row['requestID']);
        $currentStatus = htmlentities($row['statusDescription']);

        // $date = htmlentities($row['date_received']);
        // $status = htmlentities($row['statusID']);
    ?>
    <div class="container-fluid">
        <form id="form" method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;")'>
            <div class="row justify-content-center">
                <div class="card w-50">
                <div class="card-body">
                        <!-- <div class='input-group' id='datetimepicker'>
                            <input type='date' name="date_received" class="form-control" id='datetimepicker' required />
                            <div class="invalid-feedback">Please input Value</div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="statusID">StatusID</label>
                            <input type="text" required name="statusID" id="statusID" class="form-control">
                            <div class="invalid-feedback">Please input Value</div>
                        </div> -->
                        <div class="form-group">
                            <select class="form-control mt-3 w-100" name="statusID" id="statusID" aria-label=".form-select-lg example" required>
                                    <option selected><?= $currentStatus?></option>
                                    <option value="1">Pending</option>
                                    <option value="5">Approved</option>
                                    <option value="6">Disapproved</option>
                            
                                    <!-- <option value="1">Pending</option>
                                    <option value="2">Donation Accepted</option>
                                    <option value="3">Ready to Claim</option>
                                    <option value="4">Claim by Organization</option> -->
                            </select>
                            <div class="invalid-feedback">Please input Value</div>
                        </div>
                        <input type="hidden" name="requestID" value="<?= $requestID?>">
                        <input class="btn btn-primary mt-4" type="submit" name="submit" id="update" value="UPDATE">
                </div>
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