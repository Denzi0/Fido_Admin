

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
        
            $sql = "UPDATE donation_box SET statusID = :statusID WHERE donation_boxID = :donation_boxID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':donation_boxID' => $_POST['donation_boxID'],
            ':statusID' => $_POST['statusID']
            )); 
            header('Location: donation_box.php');

            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM donation_box WHERE donation_boxID= :xyz");
        $stmt->execute(array(':xyz' => $_GET['donation_boxID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $statusDescription = $row['statusID'];
      
        if($row === false) {
            header("Location: donation_box.php");
            return;
        }
        $donationBoxID = htmlentities($row['donation_boxID']);
        // $date = htmlentities($row['date_received']);
        // $status = htmlentities($row['statusID']);
    ?>
    <div class="container-fluid">
        <form id="form" method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;")'>
            <div class="row justify-content-center">
                <div class="card w-50">
                <div class="card-body">
                       
                        <div class="form-group">
                            <select class="form-control mt-3 w-100" name="statusID" id="statusID" aria-label=".form-select-lg example" required>
                                    <option selected value="">(Current STATUS)</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Donation Accepted</option>
                                    <option value="3">Ready to Claim</option>
                                    <option value="4">Claim by Organization</option>
                                    <!-- <option value="5">Approved</option>
                                    <option value="6">Disapproved</option> -->
                                    
                                    <!-- <option value="1">Pending</option>
                                     -->
                            </select>
                            <div class="invalid-feedback">Please input Value</div>
                        </div>
                        <input type="hidden" name="donation_boxID" value="<?= $donationBoxID?>">
                        <input class="btn btn-primary mt-4" type="submit" name="submit" id="update" value="UPDATE">
                </div>
                </div>
        </form>
    </div>
    <?php include_once('components/myscript.php'); ?>

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