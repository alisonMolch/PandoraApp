<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Media</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href="css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
    
	include 'includes/mediahelper.php';
	?>
	<script src="js/index.js"></script>
	<div id="header1">
        <h1><img src="images/pandoraCircle.png" alt="logo">Pandora</h1>
    </div>
    <!-- <h2 style="text-align:center" class="col-sm-12">Media</h2> -->
	<?php
		if (isset($_GET["category"])){
			$sql = "SELECT name FROM Category WHERE Category.id = ".$_GET["category"];
			$result = $conn->query($sql);
			if ($result && $result->num_rows>0){
				while($row = $result->fetch_assoc())
					// print("<p><i>Showing results in category <u>".$row["name"]."</u><a href='media.php'>[x]</a></i></p>");
					print("<p id='atitle'>".$row["name"]." <a href='media.php'>[x]</a></p>");
			}
		}
	?>
	<div id="video-view"></div>
	<h1 class="col-sm-12" id="videostitle"><a onclick="showVideos();">Videos</a></h1>
	<div class="col-sm-12" id="videosdiv" style="display:none;">
		<div class="content">
			<p class="pager videosPageText videospager">Page</p>
			<p class="pager videospager">
				<i class="fa fa-step-backward" aria-hidden="true" onclick='doPage("Video","leftLast");'></i>
				<i class="fa fa-play fa-rotate-180" aria-hidden="true" onclick='doPage("Video","left");'></i>
				<i class="fa fa-play" aria-hidden="true" onclick='doPage("Video","right");'></i>
				<i class="fa fa-step-forward" aria-hidden="true" onclick='doPage("Video","rightLast");'></i>
			</p>
			<div class="contenttable">
		<?php
			if (isset($_GET["category"])){
				//generateEntries($conn,1,isset($_GET["category"])?$_GET["category"]:null);
			}else{
				generateAlbums($conn, 1);
			}
		?>
		<script>

		function showVideos() {
			if ($("#videosdiv").is(":visible")) {
				$("#videosdiv").slideUp();
				return;
			}
			$("#videosdiv").slideDown();
		}
		</script>
		</div>
			<p class="pager videosPageText videospager">Page</p>
			<p class="pager videospager">
				<i class="fa fa-step-backward" aria-hidden="true" onclick='doPage("Video","leftLast");'></i>
				<i class="fa fa-play fa-rotate-180" aria-hidden="true" onclick='doPage("Video","left");'></i>
				<i class="fa fa-play" aria-hidden="true" onclick='doPage("Video","right");'></i>
				<i class="fa fa-step-forward" aria-hidden="true" onclick='doPage("Video","rightLast");'></i>
			</p>
		</div>
	</div>
	<h1 class="col-sm-12" id="photostitle"><a onclick="showPhotos();">Photos</a></h1>
	<div class="col-sm-12" id="photosdiv" style="display:none;">
		<div class="content">
			<p class="photosPageText pager photospager">Page</p>
			<p class="pager photospager">
				<i class="fa fa-step-backward" aria-hidden="true" onclick='doPage("Image","leftLast");'></i>
				<i class="fa fa-play fa-rotate-180" aria-hidden="true" onclick='doPage("Image","left");'></i>
				<i class="fa fa-play" aria-hidden="true" onclick='doPage("Image","right");'></i>
				<i class="fa fa-step-forward" aria-hidden="true" onclick='doPage("Image","rightLast");'></i>
			</p>
			<div class="contenttable">
		<?php
			if (isset($_GET["category"])){
				//generateEntries($conn,0,isset($_GET["category"])?$_GET["category"]:null);
			}else{
				generateAlbums($conn, 0);
			}
		?>
		<script>
		function showPhotos() {
			if ($("#photosdiv").is(":visible")) {
				$("#photosdiv").slideUp();
				return;
			}
			$("#photosdiv").slideDown();
		}
		</script>
		</div>
			<p class="photosPageText pager photospager">Page</p>
			<p class="pager photospager">
				<i class="fa fa-step-backward" aria-hidden="true" onclick='doPage("Image","leftLast");'></i>
				<i class="fa fa-play fa-rotate-180" aria-hidden="true" onclick='doPage("Image","left");'></i>
				<i class="fa fa-play" aria-hidden="true" onclick='doPage("Image","right");'></i>
				<i class="fa fa-step-forward" aria-hidden="true" onclick='doPage("Image","rightLast");'></i>
			</p>
		</div>
	</div>
	<script src="js/lightbox.js"></script>
	<script>
		//var deviceWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		var deviceWidth = screen.width;
		var photosEntries = <?php echo json_encode(fetchData($conn,0,isset($_GET["category"])?$_GET["category"]:null)); ?>;
		var videosEntries = <?php echo json_encode(fetchData($conn,1,isset($_GET["category"])?$_GET["category"]:null)); ?>;
		if (videosEntries.length==0) {
            $("#videosdiv").hide();
			$("#videostitle").hide();
        }
		if (photosEntries.length==0) {
            $("#photosdiv").hide();
			$("#photostitle").hide();
        }
		var currentPhotoPage=1;
		var currentVideoPage=1;
		var maxPhotoPage=1;
		var maxVideoPage=1;
		var maxPerPage=21;
		
		if (photosEntries.length%maxPerPage>0) {
			maxPhotoPage = (Math.floor(photosEntries.length/maxPerPage)) + 1
		}else{
			maxPhotoPage = photosEntries.length/maxPerPage;
		}
		
		if (videosEntries.length%maxPerPage>0) {
			maxVideoPage = (Math.floor(videosEntries.length/maxPerPage)) + 1
		}else{
			maxVideoPage = videosEntries.length/maxPerPage;
		}

		function doPage(section, direction) {
			console.log(direction);
			switch(direction){
				case "left":
					if (section=="Image") {
						if (currentPhotoPage>1) {currentPhotoPage--;}
					}else{
						if (currentVideoPage>1) {currentVideoPage--;}
					}
					break;
				case "right":
					if (section=="Image") {
						if (currentPhotoPage<maxPhotoPage) {currentPhotoPage++;}
					}else{
						if (currentVideoPage<maxVideoPage) {currentVideoPage++;}
					}
					break;
				case "leftLast":
					if (section=="Image") {
						currentPhotoPage=1;
					}else{
						currentVideoPage=1;
					}
					break;
				case "rightLast":
					if (section=="Image") {
						currentPhotoPage=maxPhotoPage;
					}else{
						currentVideoPage=maxVideoPage;
					}
					break;
			}
			generateEntries(section);
			var pageText = (section=="Image")?".photosPageText":".videosPageText";
			$(pageText).html("Page "+((section=="Image")?currentPhotoPage:currentVideoPage)+"/"+((section=="Image")?maxPhotoPage:maxVideoPage));
		}
		
		function generateEntries(table) {
			var container = (table=="Image")?"#photosdiv":"#videosdiv";
			var tableEntries = (table=="Image")?photosEntries:videosEntries;
			var pageReference = (table=="Image")?currentPhotoPage:currentVideoPage;
			$($(container).find(".contenttable")).empty();
			var totalAppend = "<table id='"+table+"'>";
			
			for(var i=(pageReference-1)*maxPerPage;i<tableEntries.length;i++){
				if (table=="Image") {
					if((i % 3) == 0){  // will return true when count is divisible by 3
						totalAppend+="<tr>";
						//alert('here');
					}
				} else {
					if (deviceWidth > 640) {
						if((i % 3) == 0){  // will return true when count is divisible by 3
							totalAppend+="<tr>";
							//alert(i);
						}
					} else {
						if((i % 2) == 0){  // will return true when count is divisible by 3
							totalAppend+="<tr>";
							//alert(i);
						}						
					}
					
				}

				var entryAppend = '<td>';
				if (table=="Video"){
					var vid = tableEntries[i].url.split('v=');
					entryAppend+=("<a href='#video-view' class='popup' data-link='https://www.youtube.com/embed/"+vid[1]+"'>");
					entryAppend+=("<img src='https://img.youtube.com/vi/"+vid[1]+"/0.jpg' class='opaque' alt='"+tableEntries[i].url+"'>");
				}else{
					entryAppend+=("<a href='"+tableEntries[i].url+"' data-lightbox='"+tableEntries[i].id+"'>");
					entryAppend+=("<img src='"+tableEntries[i].url+"' class='opaque' alt='"+tableEntries[i].url+"'>");
				}
				entryAppend+=("</a>");
				/*$categories = "";
				foreach($catsforentry as $cat){
					if ($categories!=""){
						$categories.=",";
					}
					$categories.="<a href='media.php?category=".$cat["id"]."'>".$cat["name"]."</a>";
				}*/
				//if ($categories!=""){print("<p><i>".$categories."</i><br>
				entryAppend+="<p>";//+tableEntries[i].dateDesc+"<br>";
				if (tableEntries[i].text!=null) entryAppend+=tableEntries[i].text
				entryAppend+="</p>";
				totalAppend+=entryAppend;
				if (table=="Image") {
					if(((i+1) % 3) == 0){  // will return true when count is divisible by 3
						totalAppend+="</tr>";
					}					
				} else {
					if (deviceWidth > 640) {
						if(((i+1) % 3) == 0){  // will return true when count is divisible by 3
							totalAppend+="</tr>";
							//alert(i);
						}
					} else {
						if(((i+1) % 2) == 0){  // will return true when count is divisible by 3
							totalAppend+="</tr>";
							//alert(i);
						}
					}

				}

				if (i>(pageReference-1)*maxPerPage + maxPerPage-2) {
                    break;

                }
			}
			if (table=="Image") {
				totalAppend+="</table>";
				$($(container).find(".contenttable")).append(totalAppend);				
			} else {
				//alert(totalAppend.slice(-5,-1));
				if (totalAppend.slice(-5,-1)!="</tr") {
					totalAppend+="</tr>";
					//alert(totalAppend.slice(-5,-1));
				}
				totalAppend+="</table>";
				$($(container).find(".contenttable")).append(totalAppend);					
			}


        }
		if (<?php
			if (isset($_GET["category"])){
				echo 1;
			}else{
				echo 0;
			}
		?>==true) {
            generateEntries("Image");
			generateEntries("Video");
			$(".videosPageText").html("Page 1/"+maxVideoPage);
			$(".photosPageText").html("Page 1/"+maxPhotoPage);
			if (maxPhotoPage<=1) {
				$(".photospager").hide()
			}
			if (maxVideoPage<=1) {
				$(".videospager").hide()
			}
        }else{
			$(".pager").hide();
		}
		
		$(".popup").click(function () {
			var $this = $(this);
			var $iframe = $("<iframe>").attr("src", $this.data("link")).css({"width": 560, "height": 315,"margin-left":"auto","margin-right":"auto", "display":"block"});
			var $title = $("<h1>").text($this.data("title"));
			$("#video-view").html($title).append($iframe);
			$iframe.wrap("<div class='class-video'>");
		});
	</script>
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

    <script>

  		$(document).ready(function() {

   			var docHeight = $(window).height();
   			var footerHeight = $('#footer').height();
   			var footerTop = $('#footer').position().top + footerHeight;

   			if (footerTop < docHeight) {
    			$('#footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
    			$('#social').css('margin-top', (docHeight - footerTop) + 'px');
  			}
  		});
 </script>
</body>

</html>