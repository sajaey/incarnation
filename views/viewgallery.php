<?php
include("../admin/config.php");
  $images_dir = "photos";
  $thumbnail_link = $number_of_photos_in_row = $cid = $pid = $result_final = "";
  $result_array = array();
  $counter = 0;
  if(isset($_GET['cid'])){$cid = (int)($_GET['cid']);}
  if(isset($_GET['pid'])){$pid = (int)($_GET['pid']);}

      if($cid && empty($pid)){
            $result = mysqli_query($bd,"SELECT photo_id,photo_caption,photo_filename FROM gallery_photos WHERE photo_category='".addslashes($cid)."'" );
            $nr = mysqli_num_rows($result);
            if(empty($nr)){
                    $result_final = "<h4>No Category found</h4>";
		}
		else{
                    while($row = mysqli_fetch_array($result)){
                            $result_array[] = "<a class='fancybox' href='admin/photogallery/".$images_dir."/".$row[2]."' data-caption='".$row[1]."' rel='gallery1'>"
                                    . "<img src='admin/photogallery/".$images_dir."/tb_".$row[2]."' border='0' alt='".$row[1]."' />"
                                    . "</a>";
                        }
			mysqli_free_result($result);
			foreach($result_array as $thumbnail_link){
				$result_final .= $thumbnail_link;
			}
                    }
                }
                else if($pid){
                    $result_final = '';
                $result = mysqli_query($bd,"SELECT photo_caption,photo_filename FROM gallery_photos WHERE photo_id='".addslashes($pid)."'" );
		list($photo_caption, $photo_filename) = mysqli_fetch_array($result);
		$nr = mysqli_num_rows($result);
		mysqli_free_result($result);	

		if(empty($nr)){
			$result_final = "No Photo found";
		}
		else{
                    $result = mysqli_query($bd,"SELECT category_name FROM gallery_category WHERE category_id='".addslashes($cid)."'" );
                    list($category_name) = mysqli_fetch_array( $result );
                    mysqli_free_result($result);	
                    $result_final .= "
                                            <a href='photogallery.php'>Categories</a> &gt; 
                                            <a href='photogallery.php?cid=$cid'>$category_name</a>";

                    $result_final .= "<img src='admin/photogallery/".$images_dir."/".$photo_filename."' width='100%' border='0' alt='".$photo_caption."' />
                   
                    .$photo_caption.
                   ";
        }
        }   
        ?>
<?php echo $result_final;?>
