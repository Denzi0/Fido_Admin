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
                       <div class="form-group mt-3">
                        <!--input Organization name --->
                            <div class="col-md-12">
                                <label for="requestname" class="form-label">Request Name</label>
                                <input pattern=".{3,}" type="text" name="requestname" id="requestname"
                                    class="form-control" required>
                                <div class="invalid-feedback">Please input value</div>
                            </div>
                        </div>
                        <div class="form-group">
                        <!--input Organization name --->
                            <div class="col-md-12">
                                <label for="requestquantity" class="form-label">Quantity</label>
                                <input pattern=".{3,}" type="text" name="requestquantity" id="requestquantity"
                                    class="form-control" required>
                                <div class="invalid-feedback">Please input value</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <label for="requestquantity" class="form-label">Description</label>
                            <textarea id="requestquantity" name="request" class="w-100"></textarea>
                        </div>
                         <div class="card-body">
                            
                             <button class="btn btn-primary" id="requestButton" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
    <?php include_once('components/myscript.php'); ?>

</html>