<?php 
include("admin/config.php");
include("includes/header.php");?>
<div id="mainwrapperInner" class="col-md-12 announcements">
 <figure class="banner">
    <img src="resources/images/banner/bannerAnnouncements.png" alt="Announcements" title="Announcements"/>
 </figure>
<aside class="sidebar col-md-2"></aside>
    <article class="mainContent col-md-8"> 
        <h2>Announcements</h2>
        <table class="table">
      <tbody>
        <?php 
            $sql = "SELECT id, headline, timestamp FROM announcement ORDER BY timestamp DESC";
            $result = mysqli_query($bd,$sql);
            if(!$result){
                echo('Error selecting bulletins: ' . $mysql_error());
                exit();
            }
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_object($result)){?>
                <tr>
                    <td><?php echo $row->headline ?></td>
                    <td><?php echo $row->timestamp ?></td>
                    <td><a href="#" data-toggle='modal' data-target='#viewAnnouncement' data-whatever='<?php echo $row->id?>'>View</a></td>
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
   </article>
<aside class="sidebar col-md-2"></aside>

    <!--View Annoucement-->
    <div class="modal fade modal-wide" id="viewAnnouncement" tabindex="-1" role="dialog" aria-labelledby="viewAnnoucements">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Annoucements</h4>
    </div>
    <div class="modal-body">

    </div>
    </form>
    </div>
    </div>
    </div>
</div>
<style>
    img{max-width:100%;}
</style>
 <script type="text/javascript">
        $('#viewAnnouncement').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever');// Extract info from data-* attributes
                 $.ajax({
                    type:"GET",
                    url:"views/viewannouncement.php",
                    data:"id="+recipient,
                    success:function(msg){
                        $("#viewAnnouncement .modal-body").html(msg);
                    },
                    error:function(){
                        $("#viewAnnouncement .modal-body").html(msg);
                    }
                 });
              //  return false;
        });
  </script>
<?php include("includes/footer.php");?>
