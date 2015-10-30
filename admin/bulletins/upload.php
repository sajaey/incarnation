<?php
	include("../config.php");
        $bulletin_dir = "pdf";
	$bulletin_filename = "";
        $bulletin_caption = "";
        $bulletin_date = "";
        $result = "";
        $result_final = "";
        $counter = 0;

		// List of our known photo types
		$known_file_types = array( 
			'application/pdf' => 'pdf',
		);
            foreach($_FILES['bulletin_filename']['name'] as $key => $val){
              /* echo  $_FILES ['bulletin_filename'] ['name'] [$key] . "<br/>";
               echo  $_FILES ['bulletin_filename'] ['size'] [$key] . "<br/>";
               echo  $_FILES ['bulletin_filename'] ['tmp_name'] [$key]. "<br/>";
               echo  $_POST ['bulletin_filename']  [$key]. "<br/>";
               echo  $_FILES ['bulletin_filename'] ['type'] [$key]. "<br/>";*/
                
                if(!array_key_exists($_FILES ['bulletin_filename']['type'][$key], $known_file_types)){
                    $result_final .= "File ".($counter+1)." is not a valid document<br />";
                }
                else{
                    $bulletin_filename = $_FILES ['bulletin_filename']['name'][$key];
                    $bulletin_caption = $_POST['bulletin_caption'][$key];
                    $bulletin_date = $_POST['bulletin_date'][$key];
                    if (file_exists($bulletin_filename)) {
                        echo "File name already exists in the database..!";
                    }
                    else{
                    $result = mysqli_query($bd, "INSERT INTO `bulletin`(`bulletin_id`, `bulletin_filename`, `bulletin_caption`,`timestamp`) VALUES ('0','$bulletin_filename','$bulletin_caption','$bulletin_date')");                                
                    copy($_FILES['bulletin_filename']['tmp_name'][$key],$bulletin_dir."/".$bulletin_filename);
					$result_final .= "<a href='".$bulletin_dir. "/".$bulletin_filename."' target='_blank'/> File ".($key+1)." Added<br />";
                    }
                }
            }
			
include('../includes/header.php'); ?>
<div class="container-fluid">
<div class="row">
<?php include('../includes/leftnav.php');?>	
<div class="col-sm-8 col-sm-offset-3 col-md-offset-2 main">
        <?php   echo $result_final;?>
</div>	
</div>
</div>	
?>
<?php  
include('../includes/footer.php');  
?>