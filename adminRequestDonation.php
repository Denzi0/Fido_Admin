<?php
    
    require_once("databaseConn.php");
    session_start();

    if(isset($_POST['submit'])){
        $date = date('Y-m-d');

        $sql = "INSERT INTO donation_request(EmpID ,name,quantity,description,Urgent,requestDate,statusID)
        VALUES('15', :name,:quantity,:description,'1','$date','1')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name' =>  $_POST['requestname'],
            ':quantity' =>  $_POST['requestquantity'],
            ':description' =>  $_POST['requestdesc'],

        ));
        $_SESSION['donation_requestAdmin'] = "Donation Request Added";
        header("Location: adminRequestDonation.php");
        return;
    }

    if(isset($_SESSION['donation_requestAdmin'])){
        $messages = '<label class="alert alert-success w-100 text-center">' .$_SESSION['donation_requestAdmin'] . '</label>';;
        unset($_SESSION['donation_requestAdmin']);
    }
     

?>

<html lang="en">
<head>
    <?php 
        include_once("components/header.php");
    ?>
    <title>Admin Request for donation</title>
</head>
<body>
    <?php include_once('components/navigation.php')?>
    <?php include_once('components/navbar.php')?>

    <div class="container">
    
      <form id="form" method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;">
            <div class="row justify-content-center">
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="text-center">Request Donation</h2>
                        </div>
                       <div class="card-body">
                       <?php
                            if(isset($messages)){ 
                                echo $messages;
                            }else {
                                echo "<label class='alert alert-success w-100 text-center'>Input Donation Request</label>";
                            }
                       ?>
                        <div class="form-group mt-3">
                            <!--input Organization name --->
                                <label for="requestname" class="form-label">Request Name</label>
                                <input pattern=".{3,}" type="text" name="requestname" id="requestname"
                                        class="form-control" required>
                                <div class="invalid-feedback">Please input value</div>
                            </div>
                            <div class="form-group">
                            <!--input Organization name --->
                                <label for="requestquantity" class="form-label">Quantity</label>
                                <input type="text" name="requestquantity" id="requestquantity"
                                        class="form-control" required>
                                <div class="invalid-feedback">Please input value</div>
                            </div>
                            <div class="form-group">
                                <label for="requestdesc" class="form-label">Description</label>
                                <textarea id="requestdesc" name="requestdesc" class="form-control w-100" required></textarea>
                                <div class="invalid-feedback">Please input value</div>
                            </div>
                            <input type="hidden" value=""/>
                            <button class="btn btn-primary" id="requestButton" type="submit" id="submit" name="submit">Submit</button>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
    <?php include_once('components/myscript.php'); ?>
    <script>
    
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
</html>