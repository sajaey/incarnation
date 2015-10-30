<?php
include('../lock.php');
include('../config.php'); 
include('../includes/header.php');
?>
 <div class="container-fluid">
    <div class="row">
            <?php include('../includes/leftnav.php');?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php
if(isset($_GET['action'])){$action = $_GET["action"];}
if(isset($_GET['id'])){$id = $_GET["id"];}
if(isset($_GET['update'])){$update = $_GET["update"];}
if(isset($_GET['delete'])){$update = $_GET["delete"];}
if(isset($_POST['announcementHeading'])){$heading = $_POST["announcementHeading"];}
if(isset($_POST['announcementContent'])){$content = $_POST["announcementContent"];}
if($action == 'edit'){
    if(!isset($update)){
        $sql = "SELECT id, headline, content, timestamp FROM announcement WHERE id = '$id'";
        $result=  mysqli_query($bd,$sql);
        if(!$result){
            echo('Error selecting news item: ' . $mysql_error());
            exit();
        }
        $row  = mysqli_fetch_object($result);?>  
        <form method="post" action="actions.php?action=edit&id=<?php echo($id) ?>&update=1">
        <div class="form-group">
            <label for="announcementHeading">Announcement Heading:</label>
            <input name="announcementHeading" type="text" id="announcementHeading" class="form-control" value="<?php echo($row->headline)?>"/>   
        </div>
        <div class="form-group">
            <label for="announcementContent">Announcement Content:</label>
            <textarea class="form-control" rows="10" id="announcementContent" name="announcementContent"><?php echo($row->content)?></textarea>
        </div>
            <input type="submit" class="btn btn-info" value="Submit"/>
        </form>
    <?php
     }
        else if(isset($update)){	
            $sql = "UPDATE announcement SET headline = '$heading', content = '$content', timestamp = NOW() WHERE id = '$id'";
            $result = mysqli_query($bd,$sql);
        if(!$result){
            echo('Error updating news item:'.mysqli_error());
            exit();
        }else{
            mysqli_close($bd);
            echo('Update successful!');
        }
    }
   }
else if($action == 'view'){
        $sql = "SELECT content FROM announcement WHERE id = '$id'";
        $result=  mysqli_query($bd,$sql);
        if(!$result){
            echo('Error selecting news item: ' . $mysqli_error());
            exit();
        }else{
          $row  = mysqli_fetch_object($result); 
          echo $row->content;
          mysqli_close($bd);
        }
    }
 else if($action == 'delete'){
       $sql = "DELETE FROM announcement WHERE id = '$id'";
       $result=  mysqli_query($bd,$sql);
        if(!$result){
            echo('Error selecting news item: ' . $mysqli_error());
            exit();
        }else{
          echo "Successfully deleted selected announcement";
           mysqli_close($bd);
        }
 }
 ?>
</div>
</div>
</div>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "textarea",
theme: "modern",
plugins: [
  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
  "searchreplace wordcount visualblocks visualchars code fullscreen",
  "insertdatetime media nonbreaking save table contextmenu directionality",
  "emoticons template paste textcolor colorpicker textpattern imagetools"
],
toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
toolbar2: "print preview media | forecolor backcolor emoticons",
image_advtab: true,
templates: [
  {title: 'Test template 1', content: 'Test 1'},
  {title: 'Test template 2', content: 'Test 2'}
]
});
</script>
<?php
include('../includes/footer.php');
?>