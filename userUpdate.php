

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
        if(isset($_POST['submit'])){
            $sql = "UPDATE user SET username = :username, password= :password WHERE userID = :userID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':userID' => $_POST['userID'],
            ':username' => $_POST['username'],
            ':password' => $_POST['password']
           
            )); 
            header('Location: users.php');
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM user WHERE userID = :xyz");
        $stmt->execute(array(':xyz' => $_GET['userID']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false) {
            header("Location: user.php");
            return;
        }
        $userID = htmlentities($row['userID']);
        $username = htmlentities($row['username']);
        $password = htmlentities($row['password']);
        $usertype = htmlentities($row['usertype']);
        $userID = $row['userID'];
    ?>
    <div class="container-fluid">
        <form id="form"  method="POST" class="form-group needs-validation" novalidate style="margin-top:50px;")'>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control" value="<?= $username?>" required>
                        <div class="invalid-feedback">Please input value</div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input required type="text" name="password" id="password" class="form-control"
                            value = <?= $password?> required>
                        <div class="invalid-feedback">Please input Value</div>
                    </div>
      
                    <div class="form-group">
                        <label for="usertype">Usertype</label>
                        <input type="text" name="usertype"  id="usertype"
                            class="form-control" value = <?= $usertype?> required>
                        <div class="invalid-feedback">Please input Value</div>
                    </div>
                    <input type="hidden" name="userID" value="<?= $userID?>">
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