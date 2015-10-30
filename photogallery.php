<?php 
include("admin/config.php");
include("includes/header.php");?>
<div id="mainwrapperInner" class="col-md-12 photogallery">
<figure class="banner">
    <img src="resources/images/banner/bannerGallery.png" alt="Incarnation Photo Gallery" title="Incarnation Photo Gallery"/>
 </figure>
    <aside class="sidebar col-md-2"></aside>
    <article class="mainContent col-md-8">
    <ul class="albums">
      <?php
        $images_dir = "photos";
        $thumbnail_link = $number_of_photos_in_row = $cid = $pid = $result_final = "";
        $result_array = array();
        $counter = 0;
        if(isset($_GET['cid'])){$cid = (int)($_GET['cid']);}
        if(isset($_GET['pid'])){$pid = (int)($_GET['pid']);}
        
        if(empty($cid) && empty($pid)){
			//$number_of_categories_in_row = 4;
			$result = mysqli_query($bd,"SELECT c.category_id,c.category_name,COUNT(photo_id)
							FROM gallery_category as c
							LEFT JOIN gallery_photos as p ON p.photo_category = c.category_id
							GROUP BY c.category_id" );
                    while($row = mysqli_fetch_array($result)){
                        $result_array[] = "<li class='album'><a class='showGallery' data-category='$row[0]' href='#'>".$row[1]."</a> "."(".$row[2].")</li>";
                    }
                    mysqli_free_result($result);	
                    foreach($result_array as $category_link){
                        $result_final .= $category_link;
                    }
		}   
        ?>
<?php echo $result_final;?>
        </ul>
        <div class="gallery-wrapper col-md-12" style="display:none;">
            <div class="ajaxLoader">Loading photos...please wait..!</div>
            <div class="gallery col-md-12"></div>
        </div>
</article>
<aside class="sidebar col-md-2"></aside>
<script type="text/javascript" src="resources/js/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="resources/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){$('.showGallery').eq(0).trigger("click"); }, 500);
        $('.showGallery').bind('click',function(){
           // event.preventDefault(e)
           $(this).addClass('active').parent('li').siblings('li').find('a').removeClass('active');
           $('.gallery-wrapper').show();
            $('.gallery').html('');
            $('.ajaxLoader').show();

            var cid = $(this).attr('data-category');
            $.ajax({
                    type:"GET",
                    url:"views/viewgallery.php",
                    data:"cid="+cid,
                    success:function(msg){
                        $('.ajaxLoader').hide();
                        $('.gallery').html(msg);
                    },
                    error:function(){
                          alert(msg);
                    }
                 });
                 return false;
            
        });
    $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none',
        beforeShow : function(){
        this.title =  this.title + " - " + $(this.element).data("caption");
        }
    });
});
</script>
</div>
<?php include("includes/footer.php");?>