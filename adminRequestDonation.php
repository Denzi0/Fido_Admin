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
      <form id="form" action="" class="form-group needs-validation" novalidate style="margin-top:50px;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="text-center">Request Donation</h2>
                        </div>
                        <div class="card-body">
                            <textarea name="request" class="w-100"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
    <?php include_once('components/myscript.php'); ?>

</html>