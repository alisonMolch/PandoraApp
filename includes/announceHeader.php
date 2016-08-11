<style>
    .vcenter {
        position: relative;
        top: 50%;
        transform: translateY(50%);
		vertical-align: middle;
    }
    #announcements p{
        color: rgb(49,49,49);
        font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif !important;
        font-size: 1.0em;
        text-align: center;
        

    }
</style>

<div id="announcements">
	<div id="row">
        <div class="col-md-2 col-md-offset-1 vcenter">
            <p><i id="announcechevLeft" class="fa fa-chevron-left pull-right" aria-hidden="true" onclick='clickChevron("left");'></i></p>
        </div>
        <div class="col-md-6">
            <p id="announceText"></p>
        </div>
			<div class="col-md-3 vcenter">
                    <p><i id="announcechevRight" class="fa fa-chevron-right pull-left" aria-hidden="true" onclick='clickChevron("right");'></i>
					<i class="fa fa-close pull-right" aria-hidden="true" onclick="hideAnnouncements();"></i></p>
			</div>
	</div>
</div>
<?php
    $sql = "SELECT * FROM Announcements WHERE current='1' ORDER BY post_date";
    require_once 'config.php';//password for Admin is newpassword

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result=$mysqli->query($sql);
    $announcearray=array();
    while($row = $result->fetch_assoc()){
        $announcearray[]=$row;
    }
?>
<script>
    $("#announcements").hide();
    $("#announcechevLeft").hide();
    $("#announcechevRight").hide();
    function hideAnnouncements() {
        sessionStorage.setItem("hasClosedAnnouncements",true);
        $("#announcements").hide();
    }
    
    function clickChevron(side) {
        if (side=="left") {
            if (curAnnounce==0) {
                curAnnounce=announcements.length-1;
            }else{
                curAnnounce--;
            }
        }else{
            if (curAnnounce==announcements.length-1) {
                curAnnounce=0;
            }else{
                curAnnounce++;
            }
        }
        $("#announceText").html("<b>"+announcements[curAnnounce].title+"</b> - "+announcements[curAnnounce].text);
    }
    
    var curAnnounce=0;
    var announcements = <?php echo json_encode($announcearray);?>;
    
    if (announcements.length>0 && sessionStorage.getItem("hasClosedAnnouncements")==null) {
        $("#announcements").show();
        $("#announceText").html("<b>"+announcements[curAnnounce].title+"</b> - "+announcements[curAnnounce].text);
        if (announcements.length>1) {
            $("#announcechevLeft").show();
            $("#announcechevRight").show();
        }
    }
</script>