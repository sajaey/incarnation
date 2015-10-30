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
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
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
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->headline ?></td>
                    <td><?php echo $row->timestamp ?></td>
                    <td><a href="actions.php?action=view&id=<?php echo $row->id ?>">View</a>&nbsp;|&nbsp;<a href="actions.php?action=edit&id=<?php echo $row->id ?>">Edit</a>&nbsp;|&nbsp;<a href="actions.php?action=delete&id=<?php echo $row->id ?>">Delete</a></td>
                </tr>
               <?php 
                }
            }
            else{
               echo "No announcements in the database";
            }
            mysqli_close($bd);
        ?>   
    </tbody>
  </table>
<a href="create.php" class="btn btn-info" role="button">Create New Annoucement</a>
</div>
</div>
</div>
</div>
<?php include('../includes/footer.php');  
