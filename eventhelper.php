    <?php
      require_once 'includes/config.php';//password for Admin is newpassword

      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
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

      // $pe = isset($_POST['eventid']);
      // $pr = isset($_POST['reviewid']);
      // if ($pe) {
      //   echo "<p class='query1'>Delete not successful.  2  $pe $pr</p>";
      // } else {
      //   echo "<p class='query1'>Delete not successful.  111</p>";
      // }
      
        
    //   } else
      if (isset($_POST['eventid']) && isset($_POST['reviewid'])) {
        
        $eventid = filter_input( INPUT_POST, 'eventid', FILTER_SANITIZE_NUMBER_INT );
        $reviewid = filter_input( INPUT_POST, 'reviewid', FILTER_SANITIZE_NUMBER_INT );
        $query1 = "DELETE FROM Review WHERE id = $reviewid ;";
        $result1 = $mysqli->query($query1);
        if (!$result1) {
          echo '<p class="query1">Delete not successful.</p>';
        }
        $query2 = "SELECT Review.id, User.username, Review.text, Review.forevent FROM Review INNER JOIN User on Review.fromuser = User.id WHERE Review.forevent = $eventid;";
        $result2 = $mysqli->query($query2);
        
        if (!$result2) {
          echo '<p class="query1">Delete not successful  1.</p>';
        } else {
          
          $all_rows = $result2->fetch_all( MYSQLI_ASSOC );
          
          $response = array('comments' => $all_rows );
          
          print(json_encode($response));
          
          //die();
        }

      }




    ?>