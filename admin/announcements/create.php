<?php
include('../lock.php');
include('../config.php');
include('../includes/header.php');

if(isset($_POST['announcementHeading'])){$heading = $_POST["announcementHeading"];}
if(isset($_POST['announcementContent'])){$content = $_POST["announcementContent"];}
if(isset($_POST['add_n'])){    
    if($bd){echo "Success 1";}
    $sql = "INSERT INTO announcement(headline, content, timestamp)VALUES('$heading', '$content', NOW())"; 
    $result=  mysqli_query($bd,$sql);
    if(!$result){
        echo('Error adding news:'. mysqli_error ($bd));
        exit();
    }else{
        mysqli_close($bd);
        echo('Success!');
    }
    }    
?>

 <div class="container-fluid">
    <div class="row">
            <?php include('../includes/leftnav.php');?>


    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="announcementHeading">Bulletin Heading:</label>
            <input name="announcementHeading" type="text" id="announcementHeading" class="form-control"/>   
        </div>
        <div class="form-group">
            <label for="announcementContent">Bulletin Content:</label>
            <textarea class="form-control" rows="10" id="announcementContent" name="announcementContent"></textarea>
        </div>
             <input type="hidden" name="add_n" value="add_n">
            <input type="submit" class="btn btn-info" value="Submit">
        </form>
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