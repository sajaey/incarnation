<?php
	include("../config.php");
        $images_dir = "photos";
        $photo_caption = "";
        $photo_category = "";
        $photos_uploaded = "";
        $new_id = "";
        $filetype = "";
        $result = "";
        $result_final = "";
        $counter = 0;
        $photo_name = "";
        $size = "";
        $thumbnail_width = "";
        $thumbnail_height = "";
        $function_suffix = "";
        $function_to_read = "";
        $function_to_write = "";
        $source_handle = "";
        $destination_handle = "";
        $extention = "";

	// List of our known photo types
	$known_photo_types = array( 
                            'image/pjpeg' => 'jpg',
                            'image/jpeg' => 'jpg',
                            'image/gif' => 'gif',
                            'image/bmp' => 'bmp',
                            'image/x-png' => 'png',
                            'image/png' => 'png'
						);
	
	// GD Function List
	$gd_function_suffix = array( 
                            'image/pjpeg' => 'JPEG',
                            'image/jpeg' => 'JPEG',
                            'image/gif' => 'GIF',
                            'image/bmp' => 'WBMP',
                            'image/x-png' => 'PNG',
                             'image/png' => 'PNG'
			);

	
            foreach($_FILES['photo_filename']['name'] as $key => $val){
                
              /* echo  $_FILES ['photo_filename'] ['name'] [$key] . "<br/>";
               echo  $_FILES ['photo_filename'] ['size'] [$key] . "<br/>";
               echo  $_FILES ['photo_filename'] ['tmp_name'] [$key]. "<br/>";
               echo  $_POST ['photo_caption']  [$key]. "<br/>";*/
                
                if(!array_key_exists($_FILES ['photo_filename']['type'][$key], $known_photo_types)){
                    $result_final .= "File ".($counter+1)." is not a photo<br />";
                }
                else{
                    $photo_category = $_POST['photo_category'];
                    $photo_name = $_FILES ['photo_filename']['name'][$key];
                    $filetype = $_FILES ['photo_filename']['type'][$key];
                    $filesize = $_FILES ['photo_filename']['size'][$key];
                    $photo_caption = $_POST['photo_caption'][$key];
                    $result = mysqli_query($bd, "INSERT INTO `gallery_photos`(`photo_id`, `photo_filename`, `photo_caption`, `photo_category`) VALUES ('0','$photo_name','$photo_caption','$photo_category')");                                
                    $new_id = mysqli_insert_id($bd);
                    copy($_FILES ['photo_filename'] ['tmp_name'] [$key], $images_dir."/".$photo_name);
                    $size = GetImageSize($images_dir."/".$photo_name );
                    
                    if($size[0] > $size[1]){
                        $thumbnail_width = 200;
                        $thumbnail_height = (int)(200 * $size[1] / $size[0]);
                    }
                    else{
                        $thumbnail_width = (int)(200 * $size[0] / $size[1]);
                        $thumbnail_height = 200;
                    }
                                
                    // Build Thumbnail with GD 1.x.x, you can use the other described methods too
                    $function_suffix = $gd_function_suffix[$filetype];
                    $function_to_read = "ImageCreateFrom".$function_suffix;
                    $function_to_write = "Image".$function_suffix;
                     
                    // Read the source file
                    $source_handle = $function_to_read($images_dir."/".$photo_name); 

                    if($source_handle){
                        // Let's create an blank image for the thumbnail
                        $destination_handle = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
                        // Now we resize it
                        ImageCopyResized( $destination_handle, $source_handle, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $size[0], $size[1] );
                    }
                    
                    // Let's save the thumbnail
                    $function_to_write( $destination_handle, $images_dir."/tb_".$photo_name );
                    ImageDestroy($destination_handle );

                  $result_final .= "<img src='".$images_dir. "/tb_".$photo_name."' /> File ".($key+1)." Added<br />";
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