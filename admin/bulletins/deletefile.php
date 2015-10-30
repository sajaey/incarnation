<?php
    include("../config.php");
    $bulletin_id = "";
    if(isset($_GET['bulletin_id'])){$bulletin_id = $_GET["bulletin_id"];}
    $result = mysqli_query($bd, "DELETE FROM bulletin WHERE bulletin_id = '$bulletin_id'");  
    if(!$result){
      echo "Not able to delete this photo at the moment. Please try again" ;
    }
    else{
       echo "This file is deleted";
    }          
?>
