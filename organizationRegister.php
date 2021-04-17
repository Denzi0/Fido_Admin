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
        // use PHPMailer\src\PHPMailer;
        // use PHPMailer\scr\Exception;
        

       


        require_once('databaseConn.php');
        session_start();
        require_once("PHPMailer/src/PHPMailer.php");
        require_once("PHPMailer/src/Exception.php");
        require_once("PHPMailer/src/SMTP.php");

        $randomPassword = substr(str_shuffle('abcdefghjkmnopqrstuvwxyz0123456778990-123ABCDEFGHJKMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
        if(empty($_SESSION['access'])){
            header("Location: index.php");
            die();
        }
       
        if(isset($_POST['orgname']) && isset($_POST['orgincharge']) && isset($_POST['orgcontact']) && isset($_POST['orgaddress'])
        && isset($_POST['orgemail']) && isset($_POST['orgtinNo']) && isset($_POST['orgpassword'])){
        // require 'PHPMailer/src/PHPMailer.php';

            ///php Mailer
            
            //Mailer
            //file uploading
            $filename = $_FILES['myfile']['name'];
            $destination = 'filesUploads/'.$filename;
            $file = $_FILES['myfile']['tmp_name'];
            $data = $_FILES['myfile']['tmp_name'];
            ///file uploading
            $passwordOrg = $_POST['orgpassword']; 
            $hashpasswordOrganization = password_hash($passwordOrg,PASSWORD_DEFAULT);

            $sqlUser = "INSERT INTO user(username,password,usertype)
            VALUES(:username ,:password ,'Organization')";
            $stmtUser = $pdo->prepare($sqlUser);
            $stmtUser->execute(array(
                ':username' => $_POST['orgname'],
                ':password' => $hashpasswordOrganization
            ));
            $count = $stmtUser->rowCount();
            $orgname = $_POST['orgname'];
            if($count > 0){
                if(move_uploaded_file($file,$destination)){
                $sql = "INSERT INTO organization (orgName, orgPersonInCharge,orgContact,orgAddress,orgEmail,orgTinNumber ,orgfiles,userID)
                VALUES(:orgname , :orgincharge , :orgcontact, :orgaddress,:orgemail ,:orgtinNo,:files ,(SELECT userID FROM user WHERE username = '$orgname'))";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':orgname' => $_POST['orgname'],
                ':orgincharge' => $_POST['orgincharge'],
                ':orgcontact' => $_POST['orgcontact'],
                ':orgaddress' => $_POST['orgaddress'],
                ':orgemail' => $_POST['orgemail'],
                ':orgtinNo' => $_POST['orgtinNo'],
                ':files' => $filename,
                ));
                
                ////////

                $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                $mail->SMTPDebug = 2;                           
                $mail->isSMTP();      
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;                    
                $mail->isHTML();
                     
                $mail->Username = 'denzellanzaderas@gmail.com';    
                $mail->Password = 'denziolanzx44';    

                $mail->SetFrom("test@gmail.com");
                $mail->Subject = "Fido(Food and Item Donation Tracking System)";
                $mail->AddAddress($_POST['orgemail'], "Organization Name");
                $mail->Body = "Hello Thank you for registering. Below is your login credentials <br> Username : " .$_POST['orgname'] ."<br>Password : ".$_POST['orgpassword']."";
                $_SESSION['success'] = 'Record Added';
                header("Location: organization.php");
                // return;
                if(!$mail->send()){
                    echo "<label >Mailer Error: " . $mail->ErrorInfo. "</label>";

                }
                else{
                   echo "<label >Mailer Success</label>";
                }

                
                }
            }


           
        }
    ?>
    <div class="container-fluid">
        
        <form enctype="multipart/form-data" id="form" autocomplete="off" method="POST" class="form-group needs-validation mt-3" novalidate
        oninput='orgconfirmpass.setCustomValidity(orgconfirmpass.value != orgpassword.value ? "Passwords do not match." : "")'>
            <div class="row justify-content-center">
                <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center text-white shadow">
                        <h3>Register Organization</h3>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <!--input Organization name --->
                        <div>
                            <label for="orgname" class="form-label">Organization Name</label>
                            <input pattern=".{3,}" type="text" name="orgname" id="orgname"
                                class="form-control" required>
                            <div class="invalid-feedback">Please input value. Name must be 3 letters and above</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="orgincharge">Person In-charge</label>
                        <input placeholder="Example John Doe"
                            title="Person in charge" type="text" name="orgincharge" id="orgincharge" class="form-control"
                            required>
                        <div class="invalid-feedback">Please input Value. Name must be firstname and lastname, John Doe etc.
                        </div>
                    </div>
      
                    <div class="form-group">
                        <label for="orgcontact">Contact</label>
                        <input type="text" name="orgcontact" pattern="^(09|\+639)\d{9}$" id="orgcontact"
                            class="form-control" required>
                        <div class="invalid-feedback">Please input Value. Contact must be starts with +63 or 09</div>
                    </div>
                    <div class="form-group">
                        <label for="orgaddress">Address</label>
                        <input type="text" name="orgaddress" id="orgaddress" class="form-control" required>
                        <div class="invalid-feedback">Please input Value</div>
                    </div> 
                    <div class="form-group">
                        <label for="orgemail">Email</label>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="orgemail" id="orgemail" class="form-control" required>
                        <div class="invalid-feedback">Please input value. Example email@gmail.com</div>
                    </div>

                    <div class="form-group">
                        <label for="orgtinNo">TIN No.</label>
                        <input pattern="[0-9]+" placeholder="XXX-XXX-XXX-XXX" type="text"
                            id="orgtinNo" class="form-control" name="orgtinNo" required>
                        <div class="invalid-feedback">Invalid TIN No. Must have 9 numbers</div>
                    </div>
                    <div class="form-group">
                        <label for="orgpassword">Password</label>
                        <input value='<?= $randomPassword?>' type="password"  minlength="5"
                            id="orgpassword" class="form-control" name="orgpassword" required>
                    <!-- <button class="btn btn-danger text-white mt-2" id="generate">Generate Password</button> -->
                    <div class="invalid-feedback">Please input field</div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="orgconfirmpass">Confirm Password</label>
                        <input type="password" id="orgconfirmpass" class="form-control" name="orgconfirmpass" required>
                        <div class="invalid-feedback">Password doesn't match</div>
                    </div> -->
              
                    <!-- blob -->
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="myfile" required>
                        <label class="custom-file-label" for="customFile">Securities and Exchange Commission Form </label>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleFormControlFile1">Upload File</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" required>
                    </div> -->
                    <button class="btn btn-primary mt-2" type="submit" name="submit" id="subm">Register</button>

                    </div>
                </div>
                </div>
        </form>
        
    </div>
    
    <?php include_once('components/myscript.php'); ?>
    <script>
            $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
    
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