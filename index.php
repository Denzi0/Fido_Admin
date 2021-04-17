  <?php 
        // require_once("databaseConn.php");
        session_start();
        if(isset($_SESSION['logIn'])){
            header('Location: dashboard.php');
            exit();
        }
        if(isset($_POST['login'])){
            require_once("databaseConn.php");
            $username = $_POST['usernamePHP'];
            $password = $_POST['passwordPHP'];
            if(empty($username)|| empty($password)){
                exit("<label>empty</label>");
            }
            $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                'username' => $_POST['usernamePHP'],
                'password' => $_POST['passwordPHP'])
            );
            $count = $stmt->rowCount();
            
            if($count > 0){
                $_SESSION['access'] = true;
                $_SESSION['logIn'] = '1';
                $_SESSION['username'] = $username;
            }else {
                exit('<label class="alert alert-danger w-100">Invalid Credentials</label>');
            }
            echo "HELlo";
        }
     

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("components/header.php");?>
    <link rel="stylesheet" href="style/css/bootstrap.css">
    <title>Admin Login Page</title>
</head>

<body style="background-color:#f6f5f5">

  
    <div class="container vh-100">
        <div class="d-flex justify-content-center align-items-md-center h-100">
            <div class="card my-auto shadow row">
                <div class="card-header text-center">
                    <img src="assets/images/appname.svg" style="height:60px;width:60px"><br>
                </div>
                <div class="card-body m-4">
                    <?php 
                        // if(isset($message)){
                        //     echo '<label class="text-danger">'.$message. '</label>';
                        // }
                    ?>
                    <p id="response"></p>
                    <form action="" method="POST" id="form" >
                        <div class="form-group">
                            <label for="username" class="text-dark">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text "><i class="fa fa-user"></i></span>
                                </div>                           
                                 <input type="text" name="username" id="username" class="form-control">      
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text "><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <p class="text-right" style="font-size: 14px">Forgot Password <a href="">Click Here</a></p>

                        <input type="submit" id='login' class="btn btn-primary w-100 text-white" value="Login" name="submit">
                    </form>
                </div>
                <div class="card-footer text-right">
                    <small class="text-dark">&copy; FIDO</small>
                </div>
            </div>
        </div>

    </div>
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script>
    $(document).ready(function() {
        $('#login').click(function(e){
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            
            if(username == "" || password == ""){
                alert("Please Input Value")
                console.log("hellow");
            }else {
                $.ajax({
                    url : 'index.php',
                    method : 'POST',
                    data : {
                        login : 1,
                        usernamePHP : username,
                        passwordPHP : password,
                    },
                    success : function (response){
                        $("#response").html(response);

                        if(response.indexOf("success") >= 0){
                            $('body').load("dashboard.php").hide().fadeIn(1500);
                            // window.location = 'dashboard.php';
                        }

                    },
                    dataType : "text"
                });

            }
        })

    })
   
   </script>




        


</body>

</html>