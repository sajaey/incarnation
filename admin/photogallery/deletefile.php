<?php
    include("../config.php");
    if(isset($_GET['pid'])){$pid = $_GET["pid"];}
    $result = mysqli_query($bd, "DELETE FROM gallery_photos WHERE photo_id = '$pid'");  
    if(!$result){
      echo "Not able to delete this photo at the moment. Please try again" ;
    }
    else{
       echo "This photo is deleted";
    }          
?>
