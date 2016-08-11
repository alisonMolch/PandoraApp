<?php ob_start();session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Events</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    
    <?php 
        require_once "includes/function.php";
        add_versioned_file( 'css/bootstrap.css', 'Style' );
        add_versioned_file( 'css/style1.css', 'Style' );
        
        //add_versioned_file( 'css/camera.min.js', 'JavaScript' );
        //
        //add_versioned_file( 'css/normalize.css', 'Style' );
    ?>
    <script type="text/javascript">
    var request;
    $(document).ready( function () { //Initialize the request variable to null 
      request = null;
      //$("#netid").keyup(findNetIDInfo); 
    });
    function check1() {
      var text = document.forms['form1']['text'].value;
      var ok = true;
      if (text == null || text == "") {
          $("#textstr").text("required, please enter some text");
          ok = false;
      } else {
          $("#textstr").text("");
      }
      return ok;
    }
    function displayComment(response) {
      //alert('here');
      //alert(response);
      var preparedT = "";
      $.each(response.comments, function(){
        if ($('#commentDiv').hasClass("active3")) {
          var element = "<p class='query1'><em>"+this.username+"</em>: <span class='comment'>";
          var element = element + this.text +"</span>&nbsp;&nbsp;<a class='DC' onclick='proc(event,"+this.forevent;
          var element = element +", "+this.id + ")'>Delete this comment</a><p>";    
          preparedT+=element;      
          //alert(preparedT);
        } else {
          var element = "<p class='query1'><em>"+this.username+"</em>: <span class='comment'>";
          var element = element + this.text +"</span><p>"; 
          preparedT+=element;
        }

      });
      if (preparedT == "") {
        preparedT = "<p class='queryheader'>No comments yet, leave a comment :)</p>"+preparedT;
      } else {
        preparedT = "<p class='queryheader'>Comments:</p>"+preparedT;
      }
      //alert(preparedT);
      //alert($("#commentDiv").html());
      $("#commentDiv").html(preparedT);
      //alert('end');
      //alert(document.getElementByID("commentDiv").preparedT);

    }
    function proc(event,eventid, reviewid) {
      //alert(""+eventid+reviewid);
      event.preventDefault();
      if (request) {
        request.abort();
      }
      var dataToSend = {eventid:eventid,reviewid:reviewid};
      request = $.ajax({
        url:"eventhelper.php",
        type:"post",
        data:dataToSend,
        dataType: "json"
      });
      //alert('here');
      request.done(displayComment);
      //alert('finish');
    }
    </script>
    <style type="text/css">
    .DC {
      text-decoration: underline;
    }
    span {
      color: #ff0000;
    }
    .input {
      color:#000000;
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
      background-color: #000000;
    }
    .input {
      color:#000000;
      width: 100%;

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
    hr {
      display: block;
      height: 1px;
      border: 0;
      border-top: 1px solid #777;
      margin: 1em 0;
      padding: 0;
    }
    .comment {
      color: #ddd;
      font-size: 18px;
    
    }
    .blocks {
      display: block;
      width: 100%;
      border-radius: 5px;
      border: 1px solid #b075eb;
      background-color: rgba(200,200,200,0.4);

    }
    .blocks .query1 {
      color: #ffffff !important;
      
    }

    .blocks .querytitle {
      color: white;
      padding: 10px;
      padding-left: 100px;
      padding-top: 40px;
      font-size: 30px;
    }

    .queryheader {
      color: #b06bc7;
    }

    @media only screen and (max-device-width: 480px) {
      .blocks .query1 {
        font-size: 2em;
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
      .submitButton {
        font-size: 1.2em !important;
      }
      #nav {
        font-size: 2.5em !important;
      }

    }

    #content3 {
      margin-left: 30px;
      overflow:auto;
      margin-right: 30px;
      margin-top: 100px;
      padding-right: 0px;
      background: rgba(255,255,255, 0.15);
      margin-bottom: 40px;
      padding-top: 30px;
      padding-bottom: 30px;
      z-index: -2;
    }

    a {
      color: #b06bc7;
    }

    a:hover,
    a:focus {
      text-decoration: none;
      /*color: #1d9b6c;*/
      color: #7d3894;
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
  <div id="content3">
  <!-- <h2 style="text-align:center" class="col-sm-12">Events</h2> -->
    <div class="col-xs-0 col-md-1 col-lg-1"></div>
    <div class='col-xs-12 col-md-10 col-lg-10'>
    <?php
      require_once 'includes/config.php';//password for Admin is newpassword

      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
      if(isset($_POST['submit1'])) {
        $newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
        $logged_user = $_SESSION[ 'logged_user' ]; 
        $query = "SELECT id FROM User WHERE username = '$logged_user';";
        $result = $mysqli->query($query);
        if ( $result ) {
            $row = $result->fetch_assoc();
            $userid = $row['id'];
            $post_text = filter_input( INPUT_POST, 'text', FILTER_SANITIZE_STRING );
             
            $query = "INSERT INTO Review (fromuser,forevent,text) VALUES ($userid, $newid, '$post_text'); ";
            //echo $query;
            $result = $mysqli->query($query);
            if ( $result ) {
              echo '<p class="query1">Comment is successfully added.</p>';
              header("Location: events.php?id=$newid");
              ob_end_flush();
            } else {
              echo '<p class="query1">You did not add a comment successfully.</p>';
            }          
        } else {
          echo '<p class="query1">Login not successful.</p>';
        }


        
      }
      if (isset($_GET['id'])) {
        $newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
        $query2 = "SELECT * FROM Event WHERE id = $newid;";
        $result2 = $mysqli->query($query2);
        if ($result2 && $result2->num_rows >= 1) {
            $row = $result2->fetch_assoc();
            echo "<p class='queryheader' style = 'text-align: center; font-size: 40px;'>{$row['title']}</p>";
            echo "<p class='query1'>Description: {$row['text']}</p>";
            echo "<p class='query1'>Location: {$row['location']}</p>";
            echo "<p class='query1'>Date and Time: {$row['time']}</p>";
            echo "<hr>"; 
            $query2 = "SELECT Review.id, User.username, Review.text FROM Review INNER JOIN User on Review.fromuser = User.id WHERE Review.forevent = $newid;";
            $result2 = $mysqli->query($query2);
            if ($result2 && $result2->num_rows >= 1) {
              if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ]) && $_SESSION[ 'permission' ] == 5) {
                print("<div id='commentDiv' class='active3'>");
              } else {
                print("<div id='commentDiv'>");
              }
                
              print "<p class='queryheader'>COMMENTS</p>";
            } else {
              if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ]) && $_SESSION[ 'permission' ] == 5) {
                print("<div id='commentDiv' class='active3'>");
              } else {
                print("<div id='commentDiv'>");
              }
              print "<p class='queryheader'>No comments yet, leave a comment :)</p>";
            }

            if ($result2 && $result2->num_rows >= 1) {
                while ( $row = $result2->fetch_assoc()) {
                    if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ]) && $_SESSION[ 'permission' ] == 5) {
                      $reviewid = $row['id'];
                      print "<p class='query1'><em>{$row['username']}</em>: <span class='comment'>{$row['text']}</span>&nbsp;&nbsp;<a class='DC' onclick='proc(event,$newid, $reviewid)'>Delete this comment</a><p>";
                    } else {
                      print "<p class='query1'><em>{$row['username']}</em>: <span class='comment'>{$row['text']}</span><p>";
                    }
                    
                }
            }
            print("</div>");
              if ( isset( $_SESSION[ 'logged_user' ] )) { 
              //Protected content here
                $logged_user = $_SESSION[ 'logged_user' ]; 
                $permission_old = $_SESSION[ 'permission' ]; 

                print "<hr><p class='titles'>Welcome, $logged_user !</p>";
                print "<p class='titles'>You can post comments here</p>";
                print("<form name='form1' class='formBox' action='events.php?id=$newid' method='POST' onsubmit='return check1();'>"); 
                print("New Comment: <span id='textstr'></span><input type='text' class='input' name='text'><br><br>");
                print("<input type='submit' class='submitButton' name='submit1' value='Post Comment'/>"); 
                print "</form><br>"; 
                //session_destroy();
              } else {
                
                print("<div><p class='titles'>You need to <a href='login.php'>Login</a> to post comments</p></div>");


              } 
        }
      } else {

        ?>

        <h2 style="text-align:center" class="col-sm-12">Events</h2>
          <div class="col-xs-0 col-md-1 col-lg-1"></div>
          <div class='col-xs-12 col-md-10 col-lg-10'>

        <?php
          $query1 = "SELECT id, title FROM Event;";
          $result = $mysqli->query($query1);
          if ($result && $result->num_rows >= 1) {
            while ( $row = $result->fetch_assoc()) {
                print "<a class='blocks' href=\"events.php?id={$row['id']}\"><p class='querytitle'>{$row['title']}</p></a><hr>"; //<p class='query1'>ID: {$row['id']}</p>
            }   

          }
      }
    ?>
    <?php
    
    // if(isset($_POST['submit1'])) {
    //     $newid = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT );
    //     $logged_user = $_SESSION[ 'logged_user' ]; 
    //     $query = "SELECT id FROM User WHERE username = '$logged_user';";
    //     $result = $mysqli->query($query);
    //     if ( $result ) {
    //         $row = $result->fetch_assoc();
    //         $userid = $row['id'];
    //         $post_text = filter_input( INPUT_POST, 'text', FILTER_SANITIZE_STRING );
             
    //         $query = "INSERT INTO Review (fromuser,forevent,text) VALUES ($userid, $newid, '$post_text'); ";
    //         //echo $query;
    //         $result = $mysqli->query($query);
    //         if ( $result ) {
    //           echo '<p class="query1">Comment is successfully added.</p>';
    //           header("Location: events.php?id=$newid");
    //         } else {
    //           echo '<p class="query1">You did not add a comment successfully.</p>';
    //         }          
    //     } else {
    //       echo '<p class="query1">Login not successful.</p>';
    //     }

    //   $pe = isset($_POST['eventid']);
    //   $pr = isset($_POST['reviewid']);
    //   if ($pe) {
    //     echo "<p class='query1'>Delete not successful.  2  $pe $pr</p>";
    //   } else {
    //     echo "<p class='query1'>Delete not successful.  111</p>";
    //   }
      
        
    // //   } else
    //   if (isset($_POST['eventid']) && isset($_POST['reviewid'])) {
        
    //     $eventid = filter_input( INPUT_POST, 'eventid', FILTER_SANITIZE_NUMBER_INT );
    //     $reviewid = filter_input( INPUT_POST, 'reviewid', FILTER_SANITIZE_NUMBER_INT );
    //     $query1 = "DELETE FROM Review WHERE id = $reviewid ;";
    //     $result1 = $mysqli->query($query1);
    //     if (!$result1) {
    //       echo '<p class="query1">Delete not successful.</p>';
    //     }
    //     $query2 = "SELECT Review.id, User.username, Review.text, Review.forevent FROM Review INNER JOIN User on Review.fromuser = User.id WHERE Review.forevent = $eventid;";
    //     $result2 = $mysqli->query($query2);
        
    //     if (!$result2) {
    //       echo '<p class="query1">Delete not successful  1.</p>';
    //     } else {
          
    //       $all_rows = $result2->fetch_all( MYSQLI_ASSOC );
          
    //       $response = array('comments' => $all_rows );
          
    //       print(json_encode($response));
          
    //       //die();
    //     }

    //   }




    ?>
    </div>
    <div class="col-xs-0 col-md-1 col-lg-1"></div>
  </div>
    

    
    
    </div>
    <?php
      include 'includes/footer.php';
    ?>

    
    <?php
      // if (isset($_POST["eventid"]) && isset($_POST["reviewid"])) {
      //   echo '<p class="query1">Delete not successful.</p>';
      //   $eventid = filter_input( INPUT_POST, 'eventid', FILTER_SANITIZE_NUMBER_INT );
      //   $reviewid = filter_input( INPUT_POST, 'reviewid', FILTER_SANITIZE_NUMBER_INT );
      //   $query1 = "DELETE FROM Review WHERE id = $reviewid ;";
      //   $result1 = $mysqli->query($query1);
      //   if (!$result1) {
      //     echo '<p class="query1">Delete not successful.</p>';
      //   }
      //   $query2 = "SELECT Review.id, User.username, Review.text, Review.forevent FROM Review INNER JOIN User on Review.fromuser = User.id WHERE Review.forevent = $eventid;";
      //   $result2 = $mysqli->query($query2);
        
      //   if (!$result2) {
      //     echo '<p class="query1">Delete not successful  1.</p>';
      //   } else {
          
      //     $all_rows = $result2->fetch_all( MYSQLI_ASSOC );
          
      //     $response = array('comments' => $all_rows );
          
      //     print(json_encode($response));
          
      //     //die();
      //   }

      // }

    ?>


</body>
</html>
<?php  ?>