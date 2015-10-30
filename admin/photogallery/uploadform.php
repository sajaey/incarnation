<?php
include('../lock.php');
include('../config.php');  
include('../includes/header.php');  
?>
 <div class="container-fluid">
    <div class="row">
    <?php include('../includes/leftnav.php');?>
    <div class="col-sm-6 col-sm-offset-3 col-md-offset-2 main">
        <!-- Button trigger modal -->
        <?php
		// initialization
		$photo_upload_fields = "";
		$photo_category_list = "";
		$counter = 1;
		$number_of_fields = 8; 

        // If you want more fields, then the call to this page should be like, 
		if(isset($_GET['number_of_fields'])){
			$number_of_fields = (int)($_GET['number_of_fields']);
		}
        
		$sql = "SELECT category_id,category_name FROM gallery_category";
		$result = mysqli_query($bd,$sql);
		while($row = mysqli_fetch_object($result)){  
$photo_category_list .=<<<__HTML_END
<option value="$row->category_id">$row->category_name</option>\n
__HTML_END;
}
	
	mysqli_free_result($result);
	while($counter <= $number_of_fields){
	$photo_upload_fields .=<<<__HTML_END
	<div class="form-group frm-gallery-upload">
            <label for="photo_filename[]">Photo{$counter}</label>	    
            <input name="photo_filename[]" type="file" />
	</div>
<div class="form-group frm-gallery-upload">
 <label for="photo_caption[]">Photo Caption</label>	
 <input name="photo_caption[]" class="form-control" size="45"/>
</div>
__HTML_END;
	$counter++;
	}  
        
// Final Output
echo <<<__HTML_END
<form enctype='multipart/form-data' action='upload.php' method='post' name='upload_form'>
  <div class="form-group">
    <label for="photo_category">Select Album</label>
    <select name="photo_category" class="form-control">$photo_category_list</select>
    </div>
    <br/>
    $photo_upload_fields
        <div class="form-group" style="clear:both;">
    <input type="submit" class="btn btn-info" value="Add Photos"/>
        </div>
</form>
__HTML_END;
?>
    </div> <!-- /container -->
 <?php
 include('../includes/footer.php');  
 ?>