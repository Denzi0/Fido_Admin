<!DOCTYPE html>
<html>

<head>
    <?php 
        include_once("components/header.php");
    ?>
    <title>Organization Register</title>
</head>

<body>
    <?php include_once('components/navigation.php');?>
    <?php include_once('components/navbar.php');?>

    <?php 
        require_once('databaseConn.php');
        session_start();
   
        if(isset($_POST['submit'])){
            $sql = "UPDATE organization SET orgPersonInCharge= :orgincharge,
            orgContact = :orgcontact,orgAddress= :orgaddress,
            orgEmail= :orgemail,orgTinNumber = :orgtinNo
            WHERE orgID = :orgID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':orgID' => $_POST['orgID'],
            // ':orgname' => $_POST['orgname'],
            ':orgincharge' => $_POST['orgincharge'],
            ':orgcontact' => $_POST['orgcontact'],
            ':orgaddress' => $_POST['orgaddress'],
            ':orgemail' => $_POST['orgemail'],
            ':orgtinNo' => $_POST['orgtinNo'],
            )); 
            $_SESSION['success'] = 'Record Updated';
            header('Location:organization.php');
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM organization WHERE orgID = :xyz");
        $stmt->execute(array(':xyz' => $_GET['orgID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
            $_SESSION['error'] = "Bad Value for orgID";
            header("Location:organization.php");
            return;
        }
        $orgID = htmlentities($row['orgID']);
        // $orgName = htmlentities($row['orgName']);
        $orgPerson = htmlentities($row['orgPersonInCharge']);
        $orgContact = htmlentities($row['orgContact']);
        $orgAddress = htmlentities($row['orgAddress']);
        $orgEmail = htmlentities($row['orgEmail']);
        $orgTinNumber = htmlentities($row['orgTinNumber']); 
        $orgID = $row['orgID'];
    ?>
    <div class="container-fluid">
        <form id="form"  method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;" 
        oninput='orgconfirmpass.setCustomValidity(orgconfirmpass.value != orgpassword.value ? "Passwords do not match." : "")'>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label for="orgname" class="form-label">Organization Name</label>
                        <input pattern=".{3,}" required title="3 characters minimum" type="text" name="orgname" id="orgname"
                            class="form-control" value="" required>
                        <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                    </div> -->

                    <div class="form-group">
                        <label for="orgincharge">Person In-charge</label>
                        <input required
                            title="Person in charge" type="text" name="orgincharge" id="orgincharge" class="form-control"
                            value = <?= $orgPerson?> required>
                        <div class="invalid-feedback">Please input Value. Name must be firstname and lastname, John Doe etc.
                        </div>
                    </div>
      
                    <div class="form-group">
                        <label for="orgcontact">Contact</label>
                        <input type="text" name="orgcontact" pattern="^(09|\+639)\d{9}$" id="orgcontact"
                            class="form-control" value = <?= $orgContact?> required>
                        <div class="invalid-feedback">Please input Value. Contact must be starts with +63 or 09</div>
                    </div>
                    <div class="form-group">
                        <label for="orgaddress">Address</label>
                        <input type="text" name="orgaddress" id="orgaddress" class="form-control" 
                         value = "<?= $orgAddress?>" required>
                        <div class="invalid-feedback">Please input Value</div>
                    </div> 
        
                    <div class="form-group">
                        <label for="orgemail">Email</label>
                        <input type="email" name="orgemail" id="orgemail" class="form-control"
                        value="<?= $orgEmail?>"required>
                        <div class="invalid-feedback">Please input value. Example email@gmail.com</div>
                    </div>

                    <div class="form-group">
                        <label for="orgtinNo">TIN No.</label>
                        <input placeholder="XXX-XXX-XXX-XXX" type="text" pattern="^[0-9]*$" minlength="9"
                            id="orgtinNo" class="form-control" name="orgtinNo" 
                            value = <?= $orgTinNumber?> required>
                        <div class="invalid-feedback">Invalid TIN No. Must have 9 numbers</div>
                    </div>
                   
                    <input type="hidden" name="orgID" value="<?= $orgID?>">
                    <input class="btn btn-primary" type="submit" name="submit" id="update" value="UPDATE">
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