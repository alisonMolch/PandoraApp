<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>


    <title>Pandora</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"><!-- Adds a large set of icons, see https://fortawesome.github.io/Font-Awesome/icons/ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.js"></script>
    <?php 
        require_once "includes/function.php";
        // add_versioned_file( 'css/square_menu.css', 'Style' );
        add_versioned_file( 'css/style.css', 'Style' );
        // add_versioned_file( 'js/jquery.square_menu.js', 'JavaScript' );
        add_versioned_file( 'js/jquery.easing.min.js', 'JavaScript' );
        add_versioned_file( 'css/bootstrap.css', 'Style' );
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

    }
    </style>
    <script type="text/javascript">
    function function1() {
		//$("#announcements").show();
      // $(".sidemenu").square_menu({
      //   flyDirection: "bottom", // The direction where the menu will fly from. Available options are "top", "bottom", "left", "right", "top-left", "top-right", "bottom-left" and "bottom-right". The default value is "bottom".
      //   button: "Menu", // You can define text inside the auto-generated button here. If you want to prevent the plugin from generating a menu button, change this to false. The default value is "Menu".
      //   animationStyle: "vertical", // The type of animation style you will see after it flew in. Available options are "vertical" which expands vertically and "horizontal" which expands horizontally. Vertical works best with "top" or "bottom" flyDirection whereas Horizontal works best with "left" or "right" flyDirection. The default value is "vertical".
      //   closeButton: "X" // You can define the content of the close button appears after animates are completed here. Change this to false to hide the close button. The default value is X.
      // });
    }
    // function open1() {
    //     //alert("here");
    //     $(".sidemenu").openMenu();
    // }
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });
    </script>

</head>
<body onload="function1()">
    
    <!-- <section id="topsection" class="container content-section text-center"></section> -->

<?php
		include("includes/announceHeader.php");
    if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ])) {
        if ( $_SESSION[ 'permission' ] == 5 ) {
            include 'includes/navBarIndexAdmin.php';
        } 
        else if ( $_SESSION[ 'permission' ] == 1 ) {
            include 'includes/navBarHome.php';
        }
    } else {
        include 'includes/navBarHome.php';
    }
?>

    <!-- Intro Header -->
    <header class="intro">
        
        <div class="intro-body">

            <div class="container">
                
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- <h1 class="brand-heading">Pandora</h1> -->
                        <img src="images/pandoraRect1.png" alt="Pandora" class="banner">
                        <ul class="rslides">
                            <li><img src="images/banner.jpg" alt="0"></li>
                            <li><img src="images/banner1.jpg" alt="1"></li>
                            <li><img src="images/banner2.jpg" alt="2"></li>
                            <li><img src="images/banner3.jpg" alt="3"></li>
                            <!-- <li><img src="images/banner4.jpg" alt="4"></li> -->
                        </ul>
                        <script>                                    
                        $(function() {
                            $(".rslides").responsiveSlides();
                        });

                        </script>



                        <!-- <p>some text for the introduction</p> -->
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </header>



    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About this group</h2>
                <p>Pandora is a student-led, student-choreographed dance troupe that was founded in 2003. We specialize in lyrical, ballet, jazz, and hip hop. Our troupe puts together a showcase - Pandora's (BOOM) Box - every fall and participates in a number of guest performances throughout the year. In the spring, Pandora hosts "Spring into Motion," which will benefit a charity of the dancers' choice. Our mascot is Abe Lincoln.</p>
            </div>
        </div>
    </section>




    <hr>




    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Us</h2>

                <?php 
                    if( isset($_POST['send'])) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $from = "From: " . $email;
                        $msg = $_POST['comments'];

                        //will add form validation

                        mail("prajjalitadey@gmail.com", "Pandora's Message", $msg . "\n\nFrom, \n" . $name, $from);
                        print("<p>Thank you for your feedback!</p>");
                    }?>

                <p>Feel free to email us to provide some feedback on our events, give us suggestions for new events, or to just say hello!</p>
                
                <form method="post" action="index.php" id="contactform">
                    <p>Name:</p>
                    <input type="text" name="name" maxlength="30" required>

                    <p>Email:</p>
                    <input type="text" name="email" maxlength="30" required>

                    <p>Comments:</p>
                    <input type="text" name="comments" maxlength="30" required>

                    <input type="submit" name="send" value="Send"> 
                </form>


<!--                 <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Facebook</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Instagram</span></a>
                    </li>
                </ul> -->
            </div>
        </div>
    </section>
    <?php
        require 'includes/footer.php';
    ?>
</body>
</html>