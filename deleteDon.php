<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once('components\header.php');
    ?>
    <title>Delete Donor</title>
</head>
<body>
    <?php include_once('components\navigation.php');?>
    <?php include_once('components\navbar.php');?>
    <?php 
    require_once('databaseConn.php');
    session_start();
  
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM donor WHERE donorID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['donorID'],
        ));
        $_SESSION['successdonor'] = "Record Deleted";
        header("Location: donor.php");
        return;
    }
    $stmt = $pdo->prepare("SELECT * FROM donor WHERE donorID = :xyz");
    $stmt->execute(array(
        ':xyz' => $_GET['donorID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['errordonor'] = 'Bad value';
        header("Location: donor.php");
        return;
    }

   

    ?>

   <div class="d-flex flex-row justify-content-center">
        <div class="card w-10">
           <div class="card-header">
                <p class="card-title">Confirm to Delete Donor ? <span class="font-bold"><?= htmlentities($row['donorName'])?></span> </p>
           </div>
            <div class="card-body">
        
                <form action="" method="post">
                    <input type="hidden" name='donorID' value="<?= $row['donorID'] ?>" ><br>

                    <div class="d-flex justify-content-between">
                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                        <a href="donor.php" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

   </div>

    <!-- Button trigger modal -->
    
    <?php include_once('components\myscript.php'); ?>

</body>
</html>



