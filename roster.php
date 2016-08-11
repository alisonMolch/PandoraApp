<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Roster</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php 
        require_once "includes/function.php";
        add_versioned_file( 'css/bootstrap.css', 'Style' );
        add_versioned_file( 'css/style2.css', 'Style' );
        add_versioned_file( 'css/normalize.css', 'Style' );
    ?>
    <style type="text/css">
    @media only screen and (max-device-width: 640px) {

      a {
        font-size: 2em !important;
      }
      span a {
        font-size: 2em !important;
      }
      p {
        font-size: 2em !important;
      }

      .lb-caption {
        font-size: 2em !important;
      }
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
    <script src="js/index.js"></script>
    <div id="header1">
        <h1><img src="images/pandoraCircle.png" alt="logo">Pandora</h1>
    </div>
    
    
    <div class="content">
        <h2 style="text-align:center" class="col-sm-12">Roster</h2>
        <table id="pics">
        <?php
            require_once 'includes/config.php';
            $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            $pictures=$mysqli->query("SELECT Image.Id, Image.text, 
                url, dateTaken, credit, name, intro 
                FROM Roster INNER JOIN Image ON Roster.id=forroster");
            $count=0;
            while ( $row = $pictures->fetch_assoc()) {
                        //echo '<pre>' .print_r($row, true) .'</pre>';
                        // echo $row['File_path'];
                if(($count % 3) == 0){  // will return true when count is divisible by 3
                    print("<tr>");
                }

                $count++;
                //print("<td><a href=''><img src='{$row['url']}' alt='{$row['name']}' class='opaque'></a><figcaption>{$row['name']}</figcaption></td>");
                print("<td><a href='{$row['url']}' data-lightbox='{$row['name']}' data-title='{$row['name']}<br>{$row['intro']}'><img src='{$row['url']}' alt='{$row['name']}' class='opaque'></a><p>{$row['name']}</p></td>");
                if (($count%3)==0){
                    print("</tr>");
                }
                        
                    
            }

        ?>
    </table>

    </div>
    <script src="js/lightbox.js"></script>
    <?php
        require 'includes/footer.php'
    ?>
</body>

</html>