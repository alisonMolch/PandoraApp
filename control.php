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
        add_versioned_file( 'css/style1.css', 'Style' );
        add_versioned_file( 'css/normalize.css', 'Style' );
    ?>
    <script type="text/javascript">
    function showHide(event) {
      event.preventDefault();
      $('.faqcontent').toggle('slow');
    }
    </script>
    <style type="text/css">
/*    #control_links a {
        color: #b075ef !important;
    }
    #control_links a:hover {
        color: #E066FF !important;
    }*/
    .Button2 {
      display: block;
      border:2px solid #ffffff;
      color: #B075EB;
      background: none !important;
      border-radius: 5px;
      text-align: center;
      font-size: 17px;
      
      overflow: auto;
      margin: 0 auto;
    }
    .Button2:hover {
      background: #b075eb !important;
      color: #ffffff !important;
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
      .answer1 {
        font-size: 2em !important;
      }
      form {
        font-size: 2em !important;
      }
      input {
        font-size: 1em !important;
      }
      .control_links a {
        font-size: 3em !important;
      }

    }
    .answer1 {
      color: #b075eb;
    }
    hr {
      display: block;
      height: 1px;
      border: 0;
      border-top: 1px solid #777;
      margin: 1em 0;
      padding: 0;
    }
    .faq {
      display: block;
      overflow: auto;
      width: fit-content;
      background-color: none;
      color: #ffffff !important;
      border-radius: 3px;
      text-decoration: underline;
      
    }
    .faq:visited {
      text-decoration: underline;
    }
    .faq:hover {
      color: #b075eb !important;
      text-decoration: underline;
    }
    .faqcontent {
      display: none;
    }
    h2 {
      text-transform: uppercase;
      font-family: 'Montserrat',"Helvetica Neue",Helvetica,Arial,sans-serif;
      font-size: 40px;
      color: #b075eb;
    }
    h3 {
      font-size: 30px;
    }
    </style>
</head>
<body>
	<?php
    if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ])) {
        if ( $_SESSION[ 'permission' ] == 5 ) {
            include 'includes/navBarAdmin.php';
        } 
    } else {
        include 'includes/navBar.php';
    }
    ?>
	<script src="js/index.js"></script>
	<div class="col-xs-12 col-lg-12"><h2 style="text-align:center" >Control Panel</h2></div>
	
	<div class="col-xs-12" id='control_links'>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/announce.php">Announcements</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/events.php">Events</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/image.php">Images</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/video.php">Videos</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/roster.php">Roster</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/category.php">Category</a>
		<a class="Button2 col-xs-12 col-sm-6 col-md-4 col-lg-3" href="includes/add_user.php">Users</a>
	</div>
  <br>
  <br>
  <div class="col-xs-12 col-lg-12">&nbsp;</div>
  <hr>
  <br>
  <br>
  <a onclick='showHide(event)' class="col-xs-12 col-lg-12 faq"><h3 style="text-align:center; margin-top: 50px;" >Control Panel FAQ</h3></a>
  <div class="col-xs-12 faqcontent">
    <p class='query1'>How to add new entries?</p>
    <p class='answer1'>According to which entry you want to add, go to the corresponding page(e.g. add image -> go to edit image page) and put input values in all of the input fields under 'Add new Entry' and click 'Add'</p>
    <hr>
    <p class='query1'>How to input date/datetime values?</p>
    <p class='answer1'>All date/datetime values are selection inputs, you can select the time(year,month,day,hour,minute) from a list of options</p>
    <hr>
    <p class='query1'>How to delete an entry?</p>
    <p class='answer1'>According to which entry you want to delete, go to the corresponding page(e.g. delete image -> go to edit image page) and select the id of that entry on under 'edit existing ..'. Click the 'delete' button the detail page. A popup window appear for you to confirm the deleting</p>
    <hr>
    <p class='query1'>How to edit existing entries?</p>
    <p class='answer1'>According to which entry you want to add, go to the corresponding page(e.g. edit image -> go to edit image page) and select the id of the entry you want to edit and click 'Edit this Entry', it will take you to the detailed page of that entry where you can see all of its fields and you can input new data for some or all of the fields in this entry</p>
    <hr>
    <p class='query1'>I only want to change one field inside an entry, what should I do?</p>
    <p class='answer1'>When you click 'Edit this Entry' button, you can see the edit section. To change one or some of the fields of this entry, simply put no value in the input you do not want to change. For date/datetime fields, the current date/datetime in the time input is the old data/time, for example, if you only want to change the month of the date/datetime input then only select a new value for month. </p> 
    <hr>
    <p class='query1'>How to manage the contents inside categories?</p>
    <p class='answer1'>Go to edit category page and select one category under 'Edit Catagory'. When adding any event, photo, video to this category and deleting any event, photo, video from this category, simply select the id of that event, photo, or video and click 'edit'.</p>
    <hr>
    <p class='query1'>How to add image, video to events?</p>
    <p class='answer1'>To add image, video to event, select the event id from the selection options next to 'Event' in the image page or video depending on whether you want to add image or video. If you don't want to add an image to any event, select '0'. To change the event for a image or video, go to the image/video page, select the id of the image/video to go to the detailed page and change the 'For Event' selection. Note that the current event is the default value in the selection box, if the image/video is not for any event, then it shows 'none'.</p>
    <hr>
    <p class='query1'>How to add image to roster?</p>
    <p class='answer1'>To add image to event, select the event id from the selection options next to 'Event' in the image page. If you don't want to add an image to any event, select '0'. Because one roster can have at most one image, the rosters to select from are rosters with no image. To change the roster for a image, go to image page, select the id of the image to go to the detailed page and change the 'For Roster' selection. Note that the current roster is the default value in the selection box, if the image is not for any roster, then it shows 'none'.</p>
    <hr>
    <p class='query1'>How to change the image for a roster?</p>
    <p class='answer1'>First delete the roster from the old image using the methods in the previous question/answer. Then add the new image by setting its 'For Roster' field to this roster using the method discribed above</p>
  </div>
</body>
</html>