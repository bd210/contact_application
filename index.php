<?php

include_once "Includes/autoload.php";

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="contact application for intership">
    <meta name="keywords" content="contact, application, intership">
    <meta name="author" content="Boris Dmitrovic">

    <title>Contact application </title>

    <!-- Bootstrap core CSS -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/blog-home.css" rel="stylesheet">

</head>

<body>
<?php

include_once "Includes/components/navigation.php";

?>
<div class="container">

    <div class="row">

        <!-- Sadrzaj -->
        <div class="col-md-8">

        <?php include_once "Includes/router.php" ?>

         </div>
        <?php include_once "Includes/components/right_side.php"; ?>

    </div>

</div>

<?php  include_once "Includes/components/footer.php";  ?>


<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>

