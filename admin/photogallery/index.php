<?php
include("../config.php");
include('../lock.php');
include('../includes/header.php'); ?>
<div class="container-fluid">
<div class="row">
<?php include('../includes/leftnav.php');?>             
    <div class="col-sm-8 col-sm-offset-3 col-md-offset-2 main">
	<?php
        $images_dir = "photos";
        $thumbnail_link = $number_of_photos_in_row = $cid = $pid = $result_final = "";
        $result_array = array();
        $counter = 0;
        if(isset($_GET['cid'])){$cid = (int)($_GET['cid']);}
        if(isset($_GET['pid'])){$pid = (int)($_GET['pid']);}
        
        if(empty($cid) && empty($pid)){
			$number_of_categories_in_row = 4;
			$result = mysqli_query($bd,"SELECT c.category_id,c.category_name,COUNT(photo_id)
							FROM gallery_category as c
							LEFT JOIN gallery_photos as p ON p.photo_category = c.category_id
							GROUP BY c.category_id" );
			while( $row = mysqli_fetch_array($result)){
                            $result_array[] = "<div class='album col-md-3'><a href='index.php?cid=".$row[0]."'>".$row[1]."</a> "."(".$row[2].")</div>";
			}
			mysqli_free_result($result);	
			$result_final = "";
			foreach($result_array as $category_link){
                                $result_final .= $category_link;
                            }
		}
                
        else if($cid && empty($pid)){
            $number_of_thumbs_in_row = 5;
            $result = mysqli_query($bd,"SELECT photo_id,photo_caption,photo_filename FROM gallery_photos WHERE photo_category='".addslashes($cid)."'" );
            $nr = mysqli_num_rows($result);
            if(empty($nr)){
                    $result_final = "<h4>No Category found</h4>";
		}
		else{
                    while($row = mysqli_fetch_array($result)){
                            $result_array[] = "<div class='col-md-2 thumb'>"
                                    . "<a href='index.php?cid=$cid&pid=".$row[0]."'>"
                                    . "<img src='".$images_dir."/tb_".$row[2]."' border='0' alt='".$row[1]."' />"
                                    . "</a><br/>".$row[1]."<br/>"
                                    . "<a href='#' data-toggle='modal' data-target='#deletePhotos' data-whatever='".$row[0]."'>Delete Image</a></div>";
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
                                            <a href='index.php'>Categories</a> &gt; 
                                            <a href='index.php?cid=$cid'>$category_name</a>";

                    $result_final .= "<img src='".$images_dir."/".$photo_filename."' width='100%' border='0' alt='".$photo_caption."' />
                   
                    .$photo_caption.
                   ";
        }
        }   
        ?>
<?php echo $result_final;?>
        <ul class="gallery-menu">
            <li><a href="index.php">Gallery Home</a></li>
            <li><a href="#" data-toggle="modal" data-target="#createNewAlbum">Create New Album</a></li>
            <li><a href="#" data-toggle="modal" data-target="#uploadPhotos">Upload Photos (ajax)</a></li>
            <li> <a href="uploadform.php">Upload Photos</a></li>
        </ul>   
    </div>
            <!--New Album Modal -->
            <div class="modal fade" id="createNewAlbum" tabindex="-1" role="dialog" aria-labelledby="createNewAlbum">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Create New Album</h4>
            </div>
            <form name="createcategory" class="createcategory" method="post">
            <div class="modal-body">
               <div class="status_msg"></div>
                  <label for="category_name">Album Name</label>
                  <input name="category_name" type="text" id="category_name">
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="btnCreateCategory">Create Album</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            <style type="text/css">
                .thumb{
                    text-align: center;
                    padding: 1em 0;
                    border-right: 1px solid #ccc;
                    max-height:100px;
                }
            </style>
            
            <!--Delete Photos-->
            <div class="modal fade" id="deletePhotos" tabindex="-1" role="dialog" aria-labelledby="deletePhotos">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Upload Photos</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this photo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-delte-photo">Delete</button>
            </div>
            </form>
            </div>
            </div>
            </div>
             
            <!--Upload Photos-->
            <div class="modal fade" id="uploadPhotos" tabindex="-1" role="dialog" aria-labelledby="uploadPhotos">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Upload Photos</h4>
            </div>
            <div class="modal-body">
                 <div class="status_msg_upload_photos"></div>
               <?php
		// initialization
		$photo_upload_fields = "";
		$photo_category_list = "";
		$counter = 1;
		$number_of_fields = 5; 
                // If you want more fields, then the call to this page should be like, 
		if(isset($_GET['number_of_fields'])){
                    $number_of_fields = (int)($_GET['number_of_fields']);
		}
        
		$sql = "SELECT category_id,category_name FROM gallery_category";
		$result = mysqli_query($bd,$sql);
                    while($row = mysqli_fetch_object($result)){  
                        $photo_category_list .= '<option value="'.$row->category_id.'">'.$row->category_name.'</option>\n';
                    }
                ?>

                 <form enctype="multipart/form-data" name="frmUploadPhotos" id="frmUploadPhotos" method="post">
                    <div class="form-group">
                    <select name="photo_category" class="form-control"><?php echo $photo_category_list ?></select>
                  </div>
                     <?php while($counter <= $number_of_fields){
                  echo "<div class='form-group' style='float:left;width:40%;'>
                       <label for='photo_filename[]'>Photo".$counter."</label>	    
                      <input name='photo_filename[]' class='photo-filename' type='file' />
                  </div>
                   <div class='form-group' style='float:left;width:50%;'>
                       <label for='photo_caption[]'>Photo Captions</label>	
                       <input name='photo_caption[]' class='form-control'/>
                   </div>";
                  $counter++;
                     }?>
                     <div class="form-group">
                          <input type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-primary" id="btnUploadPhotos">Upload Photos</button>
                     </div>
                 </form>
            </div>
            </form>
            </div>
            </div>
            </div>
      
        <?php   include('../includes/footer.php');  ?>
        <script type="text/javascript">
            $('#deletePhotos').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever');// Extract info from data-* attributes
                    $('.btn-delte-photo').bind('click',function(e){
                        e.preventDefault();
                        //var data = getUrlParameter('pid',$(this).attr('href'));
                         $.ajax({
                            type:"GET",
                            url:"deletefile.php",
                            data:"pid="+recipient,
                            success:function(msg){
                                $("#deletePhotos .modal-body").html(msg);
                            },
                            error:function(){
                                $("#deletePhotos .modal-body").html(msg);
                            }
                         });
                     });
            });

            var getUrlParameter = function getUrlParameter(sParam,url) {
            var sPageURL = decodeURIComponent(url),
            sURLVariables = sPageURL.split('?'),
            sParameterName,
            i;
            for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
            }
            }
            };

            $(function() {
                $("#btnCreateCategory").click(function(){
                  $.ajax({
                          type: "POST",
                          url: "createalbum.php",
                          data: $('form.createcategory').serialize(),
                          success: function(msg){
                                  $(".status_msg").html(msg);
                          },
                          error: function(){
                                  $(".status_msg").html(msg)
                          }
                  });
                  return false;
                });
         
         
         
	$("#uploadPhotos").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "upload.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                enctype: 'multipart/form-data',
                success:function(data){
                  $(".status_msg_upload_photos").html(data);
                },
                error:function(){
                  $(".status_msg_upload_photos").html(data);
                }
            });
        }));
    });
</script>
            
