<div id="nav">
	
	<a class="page-scroll" href="../index.php#top">Intro</a>
    <a class="page-scroll" href="../index.php#about">About</a>
    <a class="page-scroll" href="../index.php#contact">Contact</a>
   	<?php
		$navBar = array(
			"Media"=>"../media.php",
			"Team Roster"=>"../roster.php",
			"Events"=>"../events.php", 
			"Login"=>"../login.php",
			"Sign up"=>"../signup.php",
			"Control Panel"=>"../control.php"
			// if (isset( $_SESSION[ 'logged_user' ]) && isset( $_SESSION[ 'permission' ])) {
			// 	, "Control Panel"=>"control.php"
			//}
		);

		
		foreach ($navBar as $name => $link) {
		
				printnav($name,$link);
		

		}

		function printnav($name, $link){
			print "<span><a href=\"{$link}\">{$name}</a></span>";
		}
	?>
	<br>
	<script>
		$(function(){
  			$('a').each(function() {
    			if ($(this).prop('href') == window.location.href) {
      				$(this).addClass('current');
    			}
  			});
		});
	</script>

	<br>
	<!-- <hr> -->
	<!-- <hr> -->
</div>