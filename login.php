<?php ob_start();session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php 
        require_once "includes/function.php";
        add_versioned_file( 'css/bootstrap.css', 'Style' );
        add_versioned_file( 'css/style1.css', 'Style' );
        //add_versioned_file( 'css/normalize.css', 'Style' );
    ?>
    <script type="text/javascript">
    function check1() {
      var name = document.forms['form1']['username'].value;
      var ok = true;
      if (name == null || name == "") {
          $("#namestr").text("required");
          ok = false;
      } else {
          $("#namestr").text("");
      }
      if (document.forms['form1']['password'].value == null || document.forms['form1']['password'].value == "") {
          $("#passstr").text("required");
          ok = false;
      } else {
          $("#passstr").text("");
      }
      return ok;
    }
    </script>


    <style type="text/css">
    .content2 {
      margin-left: 100px;
      overflow: auto;
      margin-right: 100px;
      margin-top: 100px;
      padding-right: 50px;
      background: rgba(255,255,255, 0.15);
      margin-bottom: 40px;
      padding-top: 30px;
      padding-bottom: 10px;
      z-index: -2;

    }
    .input {
      color:#000000;
      width: 100%;

    }
    span {
      color: #ff0000;
    }
    .white {
      color:#ffffff;
    }
    .cover1 {
      width: 100%;
      height: 100%;
      position: fixed;
      margin: 0px;
      text-align: center;
      color: #ffffff;
      display: block;
      z-index: 100;
    }
    .submitButton {
      display: block;
      border:2px solid #ffffff;
      color: #B075EB;
      background: none;
      border-radius: 5px;
      text-align: center;
      font-size: 17px;
      width: 80%;
      overflow: auto;
      margin: 0 auto;
    }
    input[type="submit"]:hover {
      background: #b075eb;
      color: #ffffff;
    }
    @media only screen and (max-device-width: 640px) {
      .submitButton {
        font-size: 1.2em !important;
      }
      a {
        font-size: 2em !important;
      }
      span a {
        font-size: 2em !important;
      }
      .titles {
        font-size: 2em !important;
      }
      .query1 {
        font-size: 2em !important;
      }
      form {
        font-size: 2em !important;
      }
      input {
        font-size: 1em !important;
      }
      .content2 {
        min-height: 50%;
      }
    }

    .formBox {
        padding: 50px;
        padding-top: 0;
    }
    input {
      margin-top: 10px;
      margin-bottom: 10px;
      padding: 5px;
    }
    h2 {
      text-transform: uppercase;
      font-family: 'Montserrat',"Helvetica Neue",Helvetica,Arial,sans-serif;
      font-size: 40px;
      color: #b075eb;
    }

    </style>
  </head>


  <body>
    

    <?php 
         
    if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ])) {
        if ( $_SESSION[ 'permission' ] == 5 ) {
            include 'includes/navBarAdmin.php';
        }
        else if ( $_SESSION[ 'permission' ] == 1 ) {
            include 'includes/navBar.php';
        }
    } else {
        include 'includes/navBar.php';
    }
    
    ?>

    <div id="header1">
        <h1><img src="images/pandoraCircle.png" alt="logo">Pandora</h1>
    </div>

    <!-- <div class='col-xs-12'><h2 style="text-align:center">- Login -</h2></div> -->
    <div class="content2">
    <h2 style="text-align:center" class="col-xm-12">Login</h2>
    

    <div class="col-xs-0 col-md-1 col-lg-1"></div>
          <div class='col-xs-12 col-md-10 col-lg-10'>

    <!-- <div class='col-xs-0 col-sm-1 col-md-2 col-lg-3'></div> -->
    <!-- <div class='col-xs-12 col-sm-10 col-md-8 col-lg-6'> -->
    <?php
      if ( isset( $_SESSION[ 'logged_user' ] ) ) { //Protected content here
        $logged_user = $_SESSION[ 'logged_user' ]; 
        $permission_old = $_SESSION[ 'permission' ]; 
          print "<p class='titles'>Welcome, $logged_user !</p>";
          print "<p class='titles'>You have permission level $permission_old !</p>";
          print("<form name='form1' class='formBox' action='login.php' method='POST'>");
          print("<input type='submit' class='submitButton' name='submitt3' value='Log out'/>");
          print("</form>");  
      } else {
          print("<form name='form1' class='formBox' action='login.php' method='POST' onsubmit='return check1();'>");
          print("Username: <span id='namestr'></span><input type='text' class='input' name='username'> <br>");
          print("Password: <span id='passstr'></span><input type='password' class='input' name='password'> <br>");
          print("<br><input type='submit' class='submitButton' name='submitt' value='Submit'/>");
          print("</form>");
      } 
    ?>

    <?php
      require_once 'includes/config.php';//password for Admin is newpassword
      //echo "<div class='white'>here</div>";
      if(isset($_POST['submitt'])) {
        //echo "<div class='white'>hi</div>";
        $post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
        //echo $post_username;
        $post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
        $query = $query = "SELECT * FROM User WHERE username = '$post_username'; ";
        $result = $mysqli->query($query);
        if ( $result && $result->num_rows == 1 ) {
          $row = $result->fetch_assoc();
          $db_hash_password = $row[ 'PASSWORD' ];
          if( password_verify( $post_password, $db_hash_password ) ) { 
            $_SESSION['logged_user'] = $_POST['username'];
            //echo $row['permission'];
            $_SESSION['permission'] = $row['permission'];
            // echo "<p class='query1'>Login complete<p>";
            header("Refresh:0");
          } else {
            echo '<p class="query1">You did not login successfully.</p>';
            //echo '<p class="query1">Please <a href="login.php">login</a></p>';
          }
        } else {
          echo '<p class="query1">You did not login successfully.</p>';
          //echo '<p class="query1">Please <a href="login.php">login</a></p>';
        }
        
        //echo $post_password;
        //$posted_password = password_hash( $post_password, PASSWORD_DEFAULT);
        //echo $posted_password;
      } else {
        //echo "<div class='white'>no</div>";
      }
      if (isset($_POST['submitt3'])) {
        session_destroy();
        header("Refresh:0");

      }
      

      //$valid_password = password_verify( $post_password, '$2y$10$tBxzQzpH5eHdYrOOGAc7JeaGqTssn.jNqBr9INN2 gXoYJj7XXkQxi' );
  
    ?>
  </div>
  <div class="col-xs-0 col-md-1 col-lg-1"></div>
</div>
    
  <?php
    include 'includes/footer.php';
  ?>
  </body>

</html>
<?php ob_end_flush(); ?>