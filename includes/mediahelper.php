<?php
//Includes functions that are used to generate media content
include_once("config.php");
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pageSizes=15;

function fetchData($link,$tbl=0,$category=null){//Set table value to 0 for Image, 1 for Video
    $table = array("Image","Video")[$tbl];
    $categoryAppend = "";
    if (isset($category)){
        $categoryAppend ="INNER JOIN ".$table."Category
                    ON '".$category."' = ".$table."Category.category
                    AND ".$table."Category.".strtolower($table)."id = ".$table.".id";
    }
    $sql = "SELECT * FROM ".$table." ".$categoryAppend."
    GROUP BY ".$table.".id
    ORDER BY dateTaken DESC";
    $result = $link->query($sql);
    $returnArray = array();
    if ($result){
        while ($row = $result->fetch_assoc()){
            $returnArray[] = $row;
            $datetime = new DateTime($row["dateTaken"]);
            $returnArray[count($returnArray)-1]["dateDesc"]=$datetime->format("M d, Y");
        }
    }
    return $returnArray;
}

function fetchCategories($link,$tbl,$id){
    $table = array("Image","Video","Event")[$tbl];
    $sql = "SELECT * FROM ".$table."Category
    INNER JOIN Category ON Category.id = ".$table."Category.category
    WHERE ".$table."Category.".strtolower($table)."id=".$id."
    GROUP BY Category.id";
    $result = $link->query($sql);
    $returnArray = array();
    if ($result){
        while ($row = $result->fetch_assoc()){
            $returnArray[] = $row;
        }
    }
    return $returnArray;
}

function fetchAlbums($link,$tbl){
    $table = array("Image","Video","Event")[$tbl];
    $sql = "SELECT ".$table.".url, Category.id AS catid, Category.name FROM ".$table."Category
    INNER JOIN Category ON Category.id = ".$table."Category.category
    INNER JOIN ".$table." ON ".$table."Category.".strtolower($table)."id=".$table.".id
    GROUP BY Category.id";
    $result = $link->query($sql);
    $returnArray = array();
    if ($result){
        while ($row = $result->fetch_assoc()){
            $returnArray[] = $row;
        }
    }
    return $returnArray;
}

function generateEntries($link,$tbl=0,$category=null){
    $table = array("Image","Video")[$tbl];
    $entries = fetchData($link,$tbl,$category);
    $i=0;
    print("<table id='".$table."'>");
    foreach($entries as $row){
        if(($i % 3) == 0){  // will return true when count is divisible by 3
            print("<tr>");
        }
        $i++;
        $catsforentry = fetchCategories($link, $tbl, $row["id"]);
        print("<td>");
        if ($table=="Video"){
            $vid = explode('v=', $row['url']);
            print("<a href='#video-view' class='popup' data-link='https://www.youtube.com/embed/".$vid[1]."'>");
            print("<img src='https://img.youtube.com/vi/".$vid[1]."/0.jpg' class='opaque' alt='".$row["url"]."'>");
        }else{
            print("<a href='{$row['url']}' data-lightbox='{$row['id']}'>");
            print("<img src='".$row["url"]."' class='opaque' alt='".$row["url"]."'>");
        }
        print("</a>");
        $categories = "";
        foreach($catsforentry as $cat){
            if ($categories!=""){
                $categories.=",";
            }
            $categories.="<a href='media.php?category=".$cat["id"]."'>".$cat["name"]."</a>";
        }
        $datetime = new DateTime($row["dateTaken"]);
        if ($categories!=""){print("<p><i>".$categories."</i><br>
        ".$datetime->format("M d, Y")."<br>
        ".$row["text"]."
        </p>");}
        print("</td>");
        if (($i%3)==0){
            print("</tr>");
        }
    }
    print("</table>");
}
function generateAlbums($link,$tbl=0){
    $table = array("Image","Video")[$tbl];
    $entries = fetchAlbums($link,$tbl);
    $i=0;
    print("<table id='".$table."'>");
    foreach($entries as $row){
        if(($i % 3) == 0){  // will return true when count is divisible by 3
            print("<tr>");
        }
        $i++;
        print("<td>");
        print("<a href='media.php?category=".$row["catid"]."'>");
        if ($table=="Video"){
            $vid = explode('v=', $row['url']);
            print("<img src='https://img.youtube.com/vi/".$vid[1]."/0.jpg' class='opaque' alt='".$row["url"]."'>");
        }else{
            print("<img src='".$row["url"]."' class='opaque' alt='".$row["url"]."'>");
        }
        print("<p><i>".$row["name"]."</i><br></p>");
        print("</a>");
        print("</td>");
        if (($i%3)==0){
            print("</tr>");
        }
    }
    print("</table>");
}
?>