<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/incarnation/resources/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/incarnation/resources/js/bootstrap.min.js"></script>
<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/incarnation/resources/js/offcanvas.js"></script>   
<?php if(stripos($path, 'bulletins/uploadform')){?>
<link rel="stylesheet" type="text/css" href="../../resources/css/datepicker.css"/>
<script type="text/javascript" src="../../resources/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$('.bulletinDate').datepicker({
    format: 'yyyy-mm-dd'
});
</script>
<?php }?>
</body>
</html>

