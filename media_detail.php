<?php
    if (!isset($_GET["imageid"]) && !isset($_GET["videoid"])){
        header("Location: media.php");
    }
?>