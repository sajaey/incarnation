<?php
include('../lock.php');
include('../config.php');  
include('../includes/header.php');  
?>

 <div class="container-fluid bulletin">
    <div class="row">
    <?php include('../includes/leftnav.php');?>
    <div class="col-sm-8 col-sm-offset-3 col-md-offset-2 main">
        <!-- Button trigger modal -->
        <?php
		// initialization
		$bulletin_upload_fields = "";
		$counter = 1;
		$number_of_fields = 5; 

        // If you want more fields, then the call to this page should be like, 
		if(isset($_GET['number_of_fields'])){
			$number_of_fields = (int)($_GET['number_of_fields']);
		}
	
	while($counter <= $number_of_fields){
	$bulletin_upload_fields .=<<<__HTML_END
         <div class="form-bulletin-wrapper">
	<div class="form-group">
            <label for="bulletin_filename[]">Bulletin{$counter}</label>	    
            <input name="bulletin_filename[]" type="file" />
	</div>
<div class="form-group bulletin-caption">
 <label for="bulletin_caption[]">Bulletin Caption</label>	
 <input name="bulletin_caption[]" class="form-control" size="30"/>
</div>
<div class="form-group frm-bulletin-upload">
 <label for="bulletin_date[]">Bulletin Date</label>	
 <input name="bulletin_date[]" class="form-control bulletinDate"/>
</div>
            </div>
__HTML_END;
	$counter++;
	}  
        
// Final Output
 ?>
<form enctype='multipart/form-data' action='upload.php' method='post' name='upload_form'>
   <?php echo $bulletin_upload_fields;?>
	<div class="form-group" style="clear:both;">
	<input type="submit" class="btn btn-info" value="Upload Files"/>
	</div>
</form>
  
    </div> <!-- /container -->
 <?php include('../includes/footer.php'); ?>
