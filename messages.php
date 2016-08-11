<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>control panel</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php 
        require_once "includes/function.php";
        add_versioned_file( 'css/bootstrap.css', 'Style' );
        add_versioned_file( 'css/style.css', 'Style' );
        add_versioned_file( 'css/normalize.css', 'Style' );
    ?>
</head>
<body>
	<?php
	include 'includes/header.php';
	?>
	<script src="js/index.js"></script>
    <h1 style="text-align:center" class="col-sm-12">Messages</h1>
    <!--We are debating whether or not to use this messaging functionality, so this page is not populated-->
</body>
</html>