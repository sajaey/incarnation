<?php include('lock.php');
include('includes/header.php');?>      
     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Incarnation St.James Admin Panel</a>
        </div>
        </div>
    </nav>
      
 <div class="container-fluid">
      <div class="row">
           <?php include('includes/leftnav.php');?>
         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
            <h5 class="welcome">Welcome <?php echo $login_session; ?> | <a href="logout.php">Sign Out</a></h5> 
            <div class="col-xs-4">
              <h4>Manage Gallery</h4>
              <p>Create, Edit, Delete Gallery</p>
              <p><a class="btn btn-default" href="<?php echo dirname($_SERVER['PHP_SELF'])?>/photogallery" role="button">Create Gallery &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-4">
              <h4>Manage Bulletins</h4>
              <p>Create, Edit, Delete Bulletins</p>
              <p><a class="btn btn-default" href="<?php echo dirname($_SERVER['PHP_SELF'])?>/bulletins" role="button">Create Bulletins &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-4">
              <h4>Manage Announcements</h4>
              <p>Create, Edit, Delete Announcements</p>
              <p><a class="btn btn-default" href="<?php echo dirname($_SERVER['PHP_SELF'])?>/announcements" role="button">Create Announcements &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->         
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
      </div><!--/row-->
    </div><!--/.container-->
<?php include('includes/footer.php');?>
