<?php
include("../admin/config.php");
$id = '';
if(isset($_GET['id'])){$id = $_GET["id"];}
if($id != ''){
        $sql = "SELECT headline, content FROM announcement WHERE id = '$id'";
        $result=  mysqli_query($bd,$sql);
        if(!$result){
            echo('Error selecting news item: ' . $mysqli_error());
            exit();
        }else{
          $row  = mysqli_fetch_object($result); 
            echo "<h4>". $row->headline ."</h4>";
           echo "<p>" . $row->content ."</p>";
          mysqli_close($bd);
        }
    }
 ?>