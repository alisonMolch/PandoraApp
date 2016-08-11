<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
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
    }

    form {
      margin-bottom: 50px;
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
    
    <div class='col-xs-12'><h2 style="text-align:center"> Sign Up </h2></div>
    
    <!--<h2 style="text-align:center" class="col-sm-12">Sign Up</h2>-->
    <div class='col-xs-0 col-sm-1 col-md-2 col-lg-3'></div>
    <div class='col-xs-12 col-sm-10 col-md-8 col-lg-6'>
    

    <?php
        
      if ( isset( $_SESSION[ 'logged_user' ] )  ) { 
        //Protected content here
        $logged_user = $_SESSION[ 'logged_user' ]; 
        print "<p class='titles'>Welcome, $logged_user !</p>";
       
      } else {
        print("<form name='form1' class='formBox' action='signup.php' method='POST' onsubmit='return check1();'>");
        print("Username: <span id='namestr'></span><input type='text' class='input' name='username'> <br>");
        print("Password: <span id='passstr'></span><input type='password' class='input' name='password'> <br>");
        print("<br><input class='submitButton' type='submit' name='submitt' value='Sign up'/>");
        print("</form>");          
      } 
    ?>

    <?php
      require_once 'includes/config.php';
      //echo "<div class='white'>here</div>";
      if(isset($_POST['submitt'])) {
        //echo "<div class='white'>hi</div>";
        $post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
        
        //echo $post_username;
        $post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        $posted_password = password_hash( $post_password, PASSWORD_DEFAULT);
        
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
        $query = "SELECT * FROM User WHERE username='$post_username'; ";
        $result = $mysqli->query($query);
        if ($result && $result->num_rows >= 1) {
          
          echo '<p class="query1">Username already exist, choose another one.</p>';
        } else {
          $query = "INSERT INTO User (username, PASSWORD, permission) VALUES ('$post_username', '$posted_password', 1); ";
          $result = $mysqli->query($query);
          if ( $result ) {
            echo '<p class="query1">New user is added successfully.</p>';
          } else {
            echo '<p class="query1">You did not sign up successfully.</p>';
          }          
        }

        //echo $post_password;
        //$posted_password = password_hash( $post_password, PASSWORD_DEFAULT);
        //echo $posted_password;
      } else {
        //echo "<div class='white'>no</div>";
      }
      

      //$valid_password = password_verify( $post_password, '$2y$10$tBxzQzpH5eHdYrOOGAc7JeaGqTssn.jNqBr9INN2 gXoYJj7XXkQxi' );
  
    ?>


  
  
  </div>
  <div class='col-xs-0 col-sm-1 col-md-2 col-lg-3'></div>
    <div id="footer1">
      <div id="social1">
        <a href='https://www.facebook.com/pandoradancetroupe/?fref=ts'><img src='images/facebook1.png' class='social-img' alt='fb'></a>
        <a href='https://www.instagram.com/pandoradance/'><img src='images/insta1.png' class='social-img' alt='insta'></a>
        <a href='https://www.youtube.com/channel/UCalKIq3k96nj81II0izSCMg'><img src='images/youtube1.png' class='social-img' alt='youtube'></a>
      </div>
      <div id="copywrite1">
        <h6>&copy; Alison Molchadsky, Albert Caldarelli, Prajjalita Dey, Sophia Zhu 2016</h6>
      </div>
    </div>
  </body>
</html>