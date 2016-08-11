<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add Users</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php 
        require_once "function.php";
        add_versioned_file( '../css/bootstrap.css', 'Style' );
        add_versioned_file( '../css/style1.css', 'Style' );
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
    .linkNew:hover {
      color: #E066FF !important;
    }
    .currentPage {
      color: #ffffff !important;
      text-decoration: underline;
    }
    span {
      color: #ff0000;
    }
    nav {
      z-index: 50 !important;
    }
    #sideMenu {
      z-index: 5 !important;
    }
    .input {
      color:#000000;
      width: 100%;

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
      z-index: 10;
      background-image: url('../images/background.jpg');
      background-size: cover;
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
    .middle {
      display: block !important;
      margin: 0 auto !important;
      width: 100%;
      text-align: center;
    }
    hr {
      display: block;
      height: 1px;
      border: 0;
      border-top: 1px solid #777;
      margin: 1em 0;
      padding: 0;
    }
    .loginButton {
      color: #b075eb;
    }
    .loginButton:hover {
      color: #7F00FF;
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
    h2 {
      color: #b075eb !important;
      font-size: 23px !important;
      font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif !important;
    }
    .burger3:visited {
      color: #ffffff;
      text-decoration: underline !important;
    }
    .burger3 {
      display: block;
      overflow: auto;
      /*border:1px solid #ffffff;*/
      text-align: center;
      text-decoration: underline !important;
      color: #ffffff;
      font-size: 2em !important;
      background-color: rgba(0,0,0,0.8);

    }
    .nav2 {
      z-index: 50 !important;
      display: block;
      position: fixed;
      width: 10em;
      top: 10em;
      left: 1em;
    }
    .nav__list2 {
      display: none;
    }
    .linkNew2 {
      text-align: center;
      display: block;
      background-color: rgba(100,100,100,0.7);
      min-height: 4em;
      border:1px solid #000000 !important;
      overflow: auto;
      
      text-decoration: none;
      font-size: 2em !important;
      color: #b075eb;
    }
    .nav__item2 {
      
      display: block;
      overflow: auto;
    }

    </style>
  </head>


  <body>
    <?php
      if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ])) {
          if ( $_SESSION[ 'permission' ] == 5 ) {
            include 'AdminNav.php';
          } else {
            include 'Nav.php';
          }
      } else {
          include 'Nav.php';
      }
    ?>

    <div class='col-xs-12'><h2 style="text-align:center">- Add User -</h2></div>
    <?php
        
  
      if ( isset( $_SESSION[ 'logged_user' ] ) ) { 
      //Protected content here
        $logged_user = $_SESSION[ 'logged_user' ]; 
        $permission_old = $_SESSION[ 'permission' ]; 
        print "<p class='titles'>Welcome, $logged_user ! You have permission level $permission_old !</p>";
        echo "<hr>";
        //session_destroy();
      } else {
        print("<div class='col-xs-12 cover1'><p class='titles'>You need to <a class='loginButton' href='../login.php'>Login</a> and have permission level 5</p></div>");


      } 
    ?>  
    <div class='col-xs-0 col-sm-1 col-md-2 col-lg-3'></div>
    <div class='col-xs-12 col-sm-10 col-md-8 col-lg-6'>
    <?php
        
      if ( isset( $_SESSION[ 'logged_user' ] ) &&  isset( $_SESSION[ 'permission' ] ) && $_SESSION[ 'permission' ] == 5 ) { 
        //Protected content here
        $logged_user = $_SESSION[ 'logged_user' ]; 
        //print "<p class='titles'>Welcome, $logged_user !</p>";
        //echo "<hr>";
        print("<form name='form1' class='formBox' action='add_user.php' method='POST' onsubmit='return check1();'>");
        print("Username: <span id='namestr'></span><input type='text' class='input' name='username'> <br>");
        print("Password: <span id='passstr'></span><input type='password' class='input' name='password'> <br>");
        print("Permission: <select name='permission'><option value='1'>General User</option><option value='3'>Team Member</option></select> <br>");
        print("<br><input class='submitButton' type='submit' name='submitt' value='Add User'/>");
        print("</form>");         
      } else {
        //print "<p class='titles'>You need to <a href='../login.php'>Login</a> and have permission level 5</p>";
      } 
    ?>
    <?php
      require_once 'config.php';
      //echo "<div class='white'>here</div>";
      if(isset($_POST['submitt'])) {
        //echo "<div class='white'>hi</div>";
        $post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
        $permission = filter_input( INPUT_POST, 'permission', FILTER_SANITIZE_NUMBER_INT );
        //echo $post_username;
        $post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        $posted_password = password_hash( $post_password, PASSWORD_DEFAULT);
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
        $query1 = "SELECT * FROM User WHERE username='$post_username';";
        $result1 = $mysqli->query($query1);
        if ($result1 && $result1->num_rows >= 1) {
          echo '<p class="query1">Username already exist, choose another username.</p>';
          
        } else {
          
          $query = "INSERT INTO User (username, PASSWORD, permission) VALUES ('$post_username', '$posted_password', $permission); ";
          $result = $mysqli->query($query);
          if ( $result ) {
            echo '<p class="query1">New user is added successfully.</p>';
          } else {
            echo '<p class="query1">You did not add a new user successfully.</p>';
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
    <?php 
      $useragent=$_SERVER['HTTP_USER_AGENT'];
      
      if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
        require_once "headerincludes.php";
        add_versioned_file( '../js/index.js', 'JavaScript' );        
      } else {
        
        require_once "loginmenu.php";
        add_versioned_file( '../js/sidemenu.js', 'JavaScript' );        
      }
    ?> 
  </body>
</html>