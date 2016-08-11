<?php ob_start();session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Category</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php 
        require_once "function.php";
        add_versioned_file( '../css/bootstrap.css', 'Style' );
        add_versioned_file( '../css/style1.css', 'Style' );
        
    ?>
    <script type="text/javascript">
    function check1() {
      var name = document.forms['form9']['name'].value;
      var ok = true;
      if (name == null || name == "") {
          $("#namestr").text("required, please enter a name");
          ok = false;
      } else {
          $("#namestr").text("");
      }
      return ok;
    }
    function check2() {
      
      if (confirm("Are you sure you want to delete?") == true) {
          return true;
      } else {
          return false;
      }
      
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

    <div class='col-xs-12'><h2 style="text-align:center">- Edit Catgories -</h2></div>
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
      $arr3 = array('<p class="query1">Data is successfully updated.</p>', '<p class="query1">New entry is successfully added.</p>','<p class="query1">Entry is successfully deleted.</p>');
      if (isset($_GET['mssg'])) {
        $mssg = filter_input(INPUT_GET, 'mssg', FILTER_SANITIZE_NUMBER_INT);
        echo $arr3[$mssg -1];
        echo '<hr>';
      }
    ?>
    <?php
      require_once 'config.php';//password for Admin is newpassword

      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

      if(isset($_POST['submit3'])) {
        
        //echo "<div class='white'>hi</div>";
        $post_name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );
        
         
        $query = $query = "INSERT INTO Category (name) VALUES ('$post_name'); ";
        $result = $mysqli->query($query);
        if ( $result ) {
          header("Location: category.php?mssg=2");
        } else {
          echo '<p class="query1">You did not add this data entry successfully.</p>';
        }

      } elseif(isset($_POST['submit1'])) {
        $newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
        //echo "<div class='white'>hi</div>";
        $post_name = filter_input( INPUT_POST, 'name', FILTER_SANITIZE_STRING );
        $posted_name = "name = '$post_name'";
        if ($post_name == null || $post_name == "") {
          $posted_name = "";
        } else {
          $query = "UPDATE Category SET $posted_name WHERE id = $newid; ";
          $result = $mysqli->query($query);
          if ( !$result ) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        $d_a = 0;
        $d_i = filter_input( INPUT_POST, 'DeleteImage', FILTER_SANITIZE_NUMBER_INT );
        if ($d_i > 0) {
          $d_a = $d_a + 1;
          $query = "DELETE FROM ImageCategory WHERE category = $newid AND imageid = $d_i; ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        
        $d_v = filter_input( INPUT_POST, 'DeleteVideo', FILTER_SANITIZE_NUMBER_INT );
        if ($d_v > 0) {
          $d_a = $d_a + 1;
          $query = "DELETE FROM VideoCategory WHERE category = $newid AND videoid = $d_v; ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        $d_e = filter_input( INPUT_POST, 'DeleteEvent', FILTER_SANITIZE_NUMBER_INT );
        if ($d_e > 0) {
          $d_a = $d_a + 1;
          $query = "DELETE FROM EventCategory WHERE category = $newid AND eventid = $d_e; ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        
        $a_i = filter_input( INPUT_POST, 'AddImage', FILTER_SANITIZE_NUMBER_INT );
        if ($a_i > 0) {
          $d_a = $d_a + 1;
          $query = "INSERT INTO ImageCategory (category,imageid) VALUES ($newid , $a_i); ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        $a_v = filter_input( INPUT_POST, 'AddVideo', FILTER_SANITIZE_NUMBER_INT );
        if ($a_v > 0) {
          $d_a = $d_a + 1;
          $query = "INSERT INTO VideoCategory (category,videoid) VALUES ($newid , $a_v); ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        $a_e = filter_input( INPUT_POST, 'AddEvent', FILTER_SANITIZE_NUMBER_INT );
        if ($a_e > 0) {
          $d_a = $d_a + 1;
          $query = "INSERT INTO EventCategory (category,eventid) VALUES ($newid , $a_e); ";
          $result = $mysqli->query($query);
          if (!$result) {
            echo '<p class="query1">You did not update this data entry successfully.</p>';
            exit();
          }
        }
        header("Location: category.php?mssg=1");

        
        
      } elseif(isset($_POST['submit5'])) {
        $newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
        $query = "DELETE FROM ImageCategory WHERE category = $newid; ";
        $result = $mysqli->query($query);
        if ( $result ) {
          $query = "DELETE FROM VideoCategory WHERE category = $newid; ";
          $result = $mysqli->query($query);
          if ( $result ) {
            $query = "DELETE FROM EventCategory WHERE category = $newid; ";
            $result = $mysqli->query($query);
            if ( $result ) {
              $query = "DELETE FROM Category WHERE id = $newid; ";
              $result = $mysqli->query($query);
              if ($result) {
                header("Location: category.php?mssg=3");
              } else {
                echo '<p class="query1">You did not delete this data entry successfully.</p>';
              }
            } else {
              echo '<p class="query1">You did not delete this data entry successfully.</p>';
            }
          } else {
            echo '<p class="query1">You did not delete this data entry successfully.</p>';
          }
        } else {
          echo '<p class="query1">You did not delete this data entry successfully.</p>';
        }
      }

      if (isset($_GET['id'])) {
      	$newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
      	$query2 = "SELECT * FROM Category WHERE id = $newid;";
      	$result2 = $mysqli->query($query2);
      	if ($result2 && $result2->num_rows >= 1) {
      		$row = $result2->fetch_assoc();
          echo "<p class='query1'>ID: {$row['id']}</p>";
      		echo "<p class='query1'>Name: {$row['name']}</p>";
          $query1 = "SELECT imageid FROM ImageCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            echo "<p class='query1'>Images: ";
            while ( $row = $result->fetch_assoc()) {
              print "{$row['imageid']}, ";
            }       
            echo "</p>";    
          } else {
            echo "<p class='query1'>No image in this category</p>";
          }
          $query1 = "SELECT videoid FROM VideoCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            echo "<p class='query1'>Videos: ";
            while ( $row = $result->fetch_assoc()) {
              print "{$row['videoid']}, ";
            }       
            echo "</p>";    
          } else {
            echo "<p class='query1'>No video in this category</p>";
          }
          $query1 = "SELECT eventid FROM EventCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            echo "<p class='query1'>Events: ";
            while ( $row = $result->fetch_assoc()) {
              print "{$row['eventid']}, ";
            }       
            echo "</p>";    
          } else {
            echo "<p class='query1'>No event in this category</p>";
          }
      		echo "<hr>";
          print("<form name='form5' class='formBox' action='category.php?id=$newid' method='POST' onsubmit='return check2();'>"); 
          print("<input type='submit' class='submitButton' name='submit5' value='Delete this Entry'/>"); 
          print "</form>";
          echo "<hr>";
	        print("<form name='form1' class='formBox' action='category.php?id=$newid' method='POST'>"); 
	        print("New Name: <span>Put no value if not changing this field</span><input type='text' class='input' name='name'> <br>");
          print("Delete image from this category(none for not deleting any image):<select name='DeleteImage'><option value='0'>none</option>");
          $query1 = "SELECT imageid FROM ImageCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['imageid']}\">{$row['imageid']}</option>";
            }           
          }
          print("</select><br>");
          print("Delete video from this category(none for not deleting any video):<select name='DeleteVideo'><option value='0'>none</option>");
          $query1 = "SELECT videoid FROM VideoCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['videoid']}\">{$row['videoid']}</option>";
            }           
          }
          print("</select><br>");
          print("Delete event from this category(none for not deleting any event):<select name='DeleteEvent'><option value='0'>none</option>");
          $query1 = "SELECT eventid FROM EventCategory WHERE category = $newid;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['eventid']}\">{$row['eventid']}</option>";
            }           
          }
          print("</select><br>");
          print("Add image to this category(none for not adding any image):<select name='AddImage'><option value='0'>none</option>");
          $query1 = "SELECT id FROM Image WHERE NOT EXISTS (SELECT * FROM ImageCategory WHERE ImageCategory.category = $newid AND ImageCategory.imageid = Image.id);";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['id']}\">{$row['id']}</option>";
            }           
          }
          print("</select><br>");
          print("Add video to this category(none for not adding any video):<select name='AddVideo'><option value='0'>none</option>");
          $query1 = "SELECT id FROM Video WHERE NOT EXISTS (SELECT * FROM VideoCategory WHERE VideoCategory.category = $newid AND VideoCategory.videoid = Video.id);";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['id']}\">{$row['id']}</option>";
            }           
          }
          print("</select><br>");
          print("Add event to this category(none for not adding any event):<select name='AddEvent'><option value='0'>none</option>");
          $query1 = "SELECT id FROM Event WHERE NOT EXISTS (SELECT * FROM EventCategory WHERE EventCategory.category = $newid AND EventCategory.eventid = Event.id);";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
              print "<option value=\"{$row['id']}\">{$row['id']}</option>";
            }           
          }
          print("</select><br>");
          print("<br><input type='submit' class='submitButton' name='submit1' value='Edit this Entry'/>"); 
	        print "</form>";  
      	} else {
      		echo '<p class="query1">The id is invalid</p>';
      	}
      } else {
	      $query1 = "SELECT id FROM Category;";
	      $result = $mysqli->query($query1);
	      if ($result && $result->num_rows >= 1) {
	      	print("<h2 style='text-align:center'>Edit Existing Category</h2>");
	        print("<form name='form2' class='formBox' action='category.php' method='GET'>"); 
	        print "<div class='middle'>Select Category: <select name='id'>";
	        while ( $row = $result->fetch_assoc()) {
	        	print "<option value=\"{$row['id']}\">{$row['id']}</option>";
	        }   
	        print "</select></div>";
	        print("<br><input type='submit' class='submitButton' name='submit2' value='Edit this Entry'/>"); 
	        print "</form>";
          echo "<hr>";
	      }
	      print("<h2 style='text-align:center'>Add new Category entry</h2>");   
	        print("<form name='form9' class='formBox' action='category.php' method='POST' onsubmit='return check1();'>"); 
	        print("Name: <span id='namestr'></span><input type='text' class='input' name='name'> <br>");
	        print("<br><input type='submit' class='submitButton' name='submit3' value='Add New Entry'/>"); 
	        print "</form>";  	
      }
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
<?php ob_end_flush(); ?>