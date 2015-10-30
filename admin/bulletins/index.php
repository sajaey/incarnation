<?php
include('../lock.php');
include('../config.php');  
include('../includes/header.php');  
?>
 <div class="container-fluid">
    <div class="row">
    <?php include('../includes/leftnav.php');?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="table-responsive">          
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Headline</th>
          <th>Bulletin for</th>
           <th>Month</th>
           <th>Year</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
           $sql = "SELECT bulletin_id, bulletin_caption, bulletin_filename, timestamp,  WEEK(timestamp,5) - 
WEEK(DATE_SUB(timestamp, INTERVAL DAYOFMONTH(timestamp)-1 DAY),5)+1 as w_week, MONTHNAME(timestamp) as m_month, YEAR(timestamp) as y_year FROM bulletin ORDER BY m_month, y_year DESC";
            $result = mysqli_query($bd,$sql);
            if(!$result){
                echo('Error selecting bulletins: ' . $mysqli_error());
                exit();
            }
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_object($result)){?>
                <tr class="<?php echo $row->m_month;?>">
                    <td><?php echo $row->bulletin_id; ?></td>
                    <td><?php echo $row->bulletin_caption; ?></td>
                    <td><?php echo  $row->w_week;
                    if($row->w_week == 1){echo "st week";}
                    else if($row->w_week == 2){echo "nd week";}
                    else if($row->w_week == 3){echo "rd week";}
                    else {echo "th week";}
                    echo "of";
                    ?></td>
                    <td><?php echo  $row->m_month;?></td>
                    <td><?php echo  $row->y_year;?></td>
                    <td><a href="pdf/<?php echo $row->bulletin_filename;?>" target="_blank">View</a>&nbsp;|&nbsp;<a href='#' data-toggle='modal' data-target='#deleteBulletin' data-whatever='<?php echo $row->bulletin_id;?>'>Delete</a></td>
                </tr>
               <?php 
                }
            }
            else{
               echo "No bulletin in the database";
            }
            mysqli_close($bd);
        ?>   
    </tbody>
  </table>
<a href="uploadform.php" class="btn btn-info" role="button">Upload New Bulletin</a>
</div>
</div>
</div>
</div>

<!--Delete file-->
<div class="modal fade" id="deleteBulletin" tabindex="-1" role="dialog" aria-labelledby="deleteBulletin">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Delete File</h4>
</div>
<div class="modal-body">Are you sure you want to delete this file?</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary btn-delte-bulletin">Delete</button>
</div>
</form>
</div>
</div>
</div>
<?php include('../includes/footer.php'); ?>
<script type="text/javascript">
$('#deleteBulletin').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget) // Button that triggered the modal
               var recipient = button.data('whatever');// Extract info from data-* attributes
                   $('.btn-delte-bulletin').bind('click',function(e){
                       alert(recipient);
                       e.preventDefault();
                       //var data = getUrlParameter('pid',$(this).attr('href'));
                        $.ajax({
                           type:"GET",
                           url:"deletefile.php",
                           data:"bulletin_id="+recipient,
                           success:function(msg){
                               $("#deleteBulletin .modal-body").html(msg);
                           },
                           error:function(){
                               $("#deleteBulletin .modal-body").html(msg);
                           }
                        });
                    });
});
</script>
            