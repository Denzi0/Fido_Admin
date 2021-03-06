<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once('components\header.php');
    ?>
    <title>Delete Users</title>
</head>
<body>
    <?php include_once('components\navigation.php');?>
    <?php include_once('components\navbar.php');?>
    <?php 
    require_once('databaseConn.php');
    
    session_start();
    
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM user WHERE userID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['userID'],
        ));
        $_SESSION['successUser'] = "Record Deleted";
        header("Location: users.php");
        return;
    }
    $stmt = $pdo->prepare("SELECT * FROM user WHERE userID = :xyz");
    $stmt->execute(array(
        ':xyz' => $_GET['userID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['errorUser'] = 'Bad value';
        header("Location: users.php");
        return;
    }

   

    ?>

   <div class="d-flex flex-row justify-content-center">
        <div class="card w-10">
           <div class="card-header">
                <p class="card-title">Confirm to Delete ? <span class="font-italic"><?= htmlentities($row['userID'])?></span> </p>
           </div>
            <div class="card-body">
            
                <form action="" method="post">
                    <input type="hidden" name='userID' value="<?= $row['userID'] ?>" ><br>

                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                        <a href="users.php" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

   </div>

    <!-- Button trigger modal -->
    
    <?php include_once('components\myscript.php'); ?>

</body>
</html>
