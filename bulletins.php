<?php
include("admin/config.php");
include("includes/header.php");?>
<div id="mainwrapperInner" class="col-md-12 bulletins">
 <figure class="banner">
    <img src="resources/images/banner/bannerBulletin.png" alt="Bulletin" title="Bulletin"/>
 </figure>
    <div class="col-md-12" style="padding:0;">
         <form name="filterBulletins" class="filterBulletins" method="GET" action="filterBulletins.php">
        <legend>Filter bulletins by month/year</legend>
		<select class="form-control" name="filterMonth" id="filterMonth">
			<option value="">Select Month</option>
			<option value="January">January</option>
			<option value="February">February</option>
			<option value="March">March</option>
			<option value="April">April</option>
			<option value="May">May</option>
			<option value="June">June</option>
			<option value="July">July</option>
			<option value="August">August</option>
			<option value="September">September</option>
			<option value="October">October</option>
			<option value="November">November</option>
			<option value="December">December</option>
		</select>
		<select class="form-control" name="filterYear" id="filterYear">
			<option value="">Select Year</option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
		</select>
		<a href="#" id="clearFilters">Clear all filters</a>
	</form>
    </div>
<aside class="col-md-3"></aside>
    <article class="mainContent col-md-6">
	 <div class="bulletin-list-wrapper">
        <?php 
           $sql = "SELECT bulletin_id, bulletin_caption, bulletin_filename, timestamp, DAYOFMONTH(timestamp) as day, MONTH(timestamp) as monthint, MONTHNAME(timestamp) as month, YEAR(timestamp) as year,DATE(timestamp) as date FROM bulletin ORDER BY date DESC";
            $result = mysqli_query($bd,$sql);
            if(!$result){
                echo('Error selecting bulletins:' . $mysqli_error());
                exit();
            }
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_object($result)){?>
                <div class="list-bulletins">
                    <div class="bulletin_id">
                        <div class="ribbon">
                            <div><?php echo $row->bulletin_id; ?></div>
                        </div>
                    </div>
                    <div class="bulletin_heading">
                        <?php /*echo $row->date;*/?>
                        <h4><a href="admin/bulletins/pdf/<?php echo $row->bulletin_filename;?>" target="_blank"><?php echo $row->bulletin_caption; ?></a></h4>
                    <h5><?php echo  $row->day.' '.$row->month.' '.$row->year;?></h5>
                </div>
                </div>
               <?php 
                }
            }
            else{
               echo "No bulletin in the database";
            }
            mysqli_close($bd);
        ?> 
	</div>
   </article>
<aside class="col-md-3"></aside>
</div>
<style type="text/css">
.bulletins{font-family:'DroidSerif';}
.bulletins .filterBulletins{background: #eee;padding:1em 25% 1em 27%;border-bottom:1px solid #ccc;overflow:hidden;}
.bulletins .list-bulletins{border-bottom:1px dashed #999;overflow: hidden;display:block;padding:.5em 0;}
.bulletins .bulletin_id{width:13%;float:left;height:40px;position:relative;}
.bulletins .bulletin_heading{float:left;}
.bulletins .bulletin_heading h4{font-size:1.2em;}
.bulletins #filterMonth,.bulletins #filterYear{width:33%;float:left;margin:0 .5em 0 0;}
.filterBulletins legend{font-size:1.1em;margin:0 0 .5em 0;border:none;}
.bulletins #clearFilters{float:left;margin:.5em 0 0 1em;}
.bulletins .ribbon {padding: 0 0 10px 0;position: absolute;left:1.5em;top: 1em;width: 40px;}
.bulletins .ribbon div{background: #bb3a34;background: linear-gradient(#cc7607 0%, #cc7607 100%);color: #fff;padding: 0.5em 0;text-align: center;text-shadow: -1px -1px 0 rgba(0, 0, 0, 0.5);}
.bulletins .ribbon div:after{border-left: 20px solid #cc7607;border-right: 20px solid #cc7607;border-bottom: 10px solid transparent;bottom: 0;content: '';height: 0;left: 0;position: absolute;width: 0;}   
</style>
<script type="text/javascript">
	$(function(){
            function filterBulletins(){
                var filterYear = $("#filterYear").val();
                var filterMonth = $("#filterMonth").val();
                 if(filterMonth !== "" && filterYear !== ""){
                    $.ajax({
                        type:"GET",
                        url:"filterBulletins.php",
                        data:{ 'filterMonth': filterMonth , 'filterYear': filterYear},
                        success:function(msg){
                                $(".bulletin-list-wrapper").html(msg);
                        },
                        error:function(){
                                $(".bulletin-list-wrapper").html(msg);
                        }
                    });
                    return false;
                }
            }
            
            $('#filterYear').change(filterBulletins);
            $('#filterMonth').change(filterBulletins);
            
            $('#clearFilters').bind('click',function(){
                event.preventDefault();
                $('#filterYear,#filterMonth').val('');
                $.ajax({
                    type:"GET",
                    url:"filterBulletins.php",
                    data:"action=reset",
                    success:function(msg){
                        $(".bulletin-list-wrapper").html(msg);
                    },
                    error:function(){
                        $(".bulletin-list-wrapper").html(msg);
                    }
                 });
              return false;
            });
	});
</script>
<?php include("includes/footer.php");?>