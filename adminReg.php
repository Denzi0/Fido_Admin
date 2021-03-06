<?php 
     
    require_once('databaseConn.php');
    session_start();
   
    if(isset($_POST['submit'])){
        $sqluser = "INSERT INTO user(username,password,usertype)
        VALUES(:adminusername,:adminpassword ,'admin')";
        $stmtuser = $pdo->prepare($sqluser);
        $stmtuser->execute(array(
            'adminusername' => $_POST['adminusername'],
            'adminpassword' => $_POST['adminpass']
            
        ));
        $count = $stmtuser->rowCount();
        if($count > 0){
            $adminuser = $_POST['adminusername'];
            $sql = "INSERT INTO admin(emLname,emFname,EmEmail,EmContact,userID)
            VALUES(:adminLname ,:adminFname , :adminEmail, :adminContact ,(SELECT userID FROM user WHERE username = '$adminuser'))";
            $stmt = $pdo->prepare($sql);
            $stmt = $stmt->execute(array(
                'adminLname' => $_POST["adminlname"],
                'adminFname' => $_POST["adminfname"],
                'adminEmail' => $_POST["adminemail"],
                'adminContact' => $_POST["admincontact"]
            ));
            header("Location: dashboard.php");
            return;
        }
       
    }
   
  

?>

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

    <div class="container-fluid">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Admin</h4>
            </div>
            <div class="card-body">
                <form id="form" autocomplete="off" method="POST" class="form-group needs-validation mt-3" novalidate
                oninput='adminpassc.setCustomValidity(adminpassc.value != adminpass.value ? "Passwords do not match." : "")'>
                    <div class="row justify-content-center col-md-12">
                                <!-- <div class="card-header bg-primary text-center text-white shadow">
                                    <h3>Admin</h3>
                                </div> -->
                                
                                <div class="form-group col-md-6">
                                    <label for="adminfname" class="form-label">First name</label>
                                    <input pattern=".{3,}" type="text" name="adminfname" id="adminfname"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminlname" class="form-label">Last name</label>
                                    <input pattern=".{3,}" type="text" name="adminlname" id="adminlname"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminusername" class="form-label">Username</label>
                                    <input pattern=".{3,}" type="text" name="adminusername" id="adminusername"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="admincontact" class="form-label">Contact</label>
                                    <input pattern=".{3,}" type="text" name="admincontact" id="admincontact"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminemail" class="form-label">Email</label>
                                    <input pattern=".{3,}" type="text" name="adminemail" id="adminemail"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminaddress" class="form-label">Address</label>
                                    <input pattern=".{3,}" type="text" name="adminaddress" id="adminaddress"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminpass" class="form-label">Password</label>
                                    <input pattern=".{3,}" type="text" name="adminpass" id="adminpass"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Password</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adminpassc" class="form-label">Confirm Password</label>
                                    <input pattern=".{3,}" type="text" name="adminpassc" id="adminpassc"
                                            class="form-control" required>
                                    <div class="invalid-feedback">Password must match</div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">Add Admin</button>
                        </div>
                </form>
        </div>
    </div>
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
                        if(form.checkValidity() === true){
                            swal({
                                title: "Organization Added!",
                                text: "Congratulations",
                                icon: "success",
                                });
                        }

                        form.classList.add('was-validated');
                    }, false);
                });

            }, false);
        })();
    </script>

</body>

</html>