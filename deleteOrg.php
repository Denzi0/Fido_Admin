<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once('components\header.php');
    ?>
    <title>Delete Organization</title>
</head>
<body>
    <?php include_once('components\navigation.php');?>
    <?php include_once('components\navbar.php');?>
    <?php 
    require_once('databaseConn.php');
    session_start();
   
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM organization WHERE orgID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['orgID'],
        ));
        $_SESSION['success'] = "Record Deleted";
        header("Location: organization.php");
        return;
    }
    $stmt = $pdo->prepare("SELECT * FROM organization WHERE orgID = :xyz");
    $stmt->execute(array(
        ':xyz' => $_GET['orgID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value';
        header("Location: organization.php");
        return;
    }

   

    ?>

   <div class="d-flex flex-row justify-content-center">
        <div class="card w-10">
           <div class="card-header">
                <p class="card-title">Confirm to Delete ? <span class="font-italic"><?= htmlentities($row['orgName'])?></span> </p>
           </div>
            <div class="card-body">
            
                <form action="" method="post">
                    <input type="hidden" name='orgID' value="<?= $row['orgID'] ?>" ><br>

                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                        <a href="organization.php" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

   </div>

    <!-- Button trigger modal -->
    
    <?php include_once('components\myscript.php'); ?>

</body>
</html>



