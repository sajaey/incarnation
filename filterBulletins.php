<?php
include("admin/config.php");
            $filterMonth = $filterYear = $action = '';
            if(isset($_GET['filterYear'])){$filterYear = $_GET["filterYear"];}
            if(isset($_GET['filterMonth'])){$filterMonth = $_GET["filterMonth"];}
            if(isset($_GET['action'])){$action = $_GET["action"];}
            if($filterMonth != '' && $filterYear != ''){
            $sql = "SELECT bulletin_id, bulletin_caption, bulletin_filename, timestamp, DAYOFMONTH(timestamp) as day, MONTHNAME(timestamp) as month, YEAR(timestamp) as year FROM bulletin WHERE YEAR(timestamp) = '$filterYear' and MONTHNAME(timestamp) = '$filterMonth'";
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
                        <h4><a href="pdf/<?php echo $row->bulletin_filename;?>" target="_blank"><?php echo $row->bulletin_caption; ?></a></h4>
                    <h5><?php echo  $row->day.' '.$row->month.' '.$row->year;?></h5>
                </div>
                </div>
               <?php 
                }
            }
            else{
               echo "No bulletin in the database for the given month/year";
            }
            mysqli_close($bd);
            }
            else if($action != ''){
                $sql = "SELECT bulletin_id, bulletin_caption, bulletin_filename, timestamp, DAYOFMONTH(timestamp) as day, MONTHNAME(timestamp) as month, YEAR(timestamp) as year FROM bulletin ORDER BY month, year";
                $result = mysqli_query($bd,$sql);
            if(!$result){
                echo('Error selecting bulletins:' . $mysqli_error());
                exit();
            }
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_object($result)){?>
                <div class="list-bulletins">
                    <div class="bulletin_id" style="position: relative;">
                        <div class="ribbon">
                            <div>
                             <?php echo $row->bulletin_id; ?>
                            </div>
                        </div>
                    </div>
                    <div class="bulletin_heading">
                        <h4><a href="pdf/<?php echo $row->bulletin_filename;?>" target="_blank"><?php echo $row->bulletin_caption; ?></a></h4>
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
            }
            else{
                echo "No results";
            }
        ?>  