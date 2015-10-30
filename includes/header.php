<?php $path = strtolower($_SERVER['PHP_SELF']);?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js gt-ie9" lang="en"> <!--<![endif]-->
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8" />
<title>Incarnation - St.James</title>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/incarnation/resources/css/incarnation.css" type="text/css" media="all"/>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/incarnation/resources/css/bootstrap.min.css" type="text/css" media="all"/>
<script src="resources/js/jquery.min.js"></script>
<script type="text/javascript" src="resources/js/jquery.cycle2.js"></script>
<script type="text/javascript" src="resources/js/common.js"></script>
<!-- Latest compiled and minified JavaScript -->
</head>
<body>
<div id="container">
<div id="header">
<div id="logo">
    <h1><a href="index.php"><img src="resources/images/incarnation.png" width="70" height="70" alt="Incarnation St.James" /><span>Incarnation St.James</span></a></h1></div>
<!-- end of #logo -->
<div class="header_right">
<a href="#" class="open-panel"><span data-icon="&#xe60c;"></span></i></a>
<ul class="top_nav">
<li><a href="#locate_us"><span data-icon="&#xe801;" aria-hidden="true" class="icon"></span><span class="text">Locate Us</span></a></li>
<li><a href="#locate_us"><span data-icon="&#xe803;" aria-hidden="true" class="icon"></span><span class="text">Contact Us</span></a></li>
</ul>
<div class="quickDonate">
   <a href="donate.php" class="btnDonate"><span data-icon="&#xe805;"></span>&nbsp;Donate</a>
</div>
</div>
<nav class="main_nav">
<a href="#" class="close-panel"><span data-icon="&#xe60d;"></span>Close</a> 
<ul class="menu">
<li <?php if(stripos($path, 'index')){echo "class='active'";}?>><a href="index.php">Home</a></li>
<li <?php if(stripos($path, 'involved') || stripos($path, 'adultfaith') || stripos($path, 'liturgical') || stripos($path, 'outreach') || stripos($path, 'organization')){echo "class='active'";}?>><a href="getinvolved.php">Get Involved</a></li>
<li <?php if(stripos($path, 'requestforms')){echo "class='active'";}?>><a href="requestforms.php">Request/Forms</a></li>
<li <?php if(stripos($path, 'sacraments')){echo "class='active'";}?>><a href="sacraments.php">Sacraments</a></li>
<li <?php if(stripos($path, 'bulletins')){echo "class='active'";}?>><a href="bulletins.php">Bulletins</a></li>
<li <?php if(stripos($path, 'photogallery')){echo "class='active'";}?>><a href="photogallery.php">Gallery</a></li>
<li <?php if(stripos($path, 'announcements')){echo "class='active'";}?>><a href="announcements.php">Announcements</a></li>
<li <?php if(stripos($path, 'pastorsdesk')){echo "class='active'";}?>><a href="pastorsdesk.php">Pastor's Desk</a></li>
<li <?php if(stripos($path, 'youthministry')){echo "class='active'";}?>><a href="youthministry.php">Youth Ministry</a></li>
</ul>

<?php
$searchContent = "<div class='input-group'>
      <input type='text' class='form-control' placeholder='Search for...'>
      <span class='input-group-btn'>
        <button class='btn btn-default' type='button'>Go!</button>
      </span>
      </div>";

$socialShare = "<ul>
        <li><a href='https://www.facebook.com/incarnation.stjames'><span data-icon='&#xe807;'></span><span class='visually-hidden'>Facebook</span></a></li>
        <li><a href='https://twitter.com/isjparish'><span data-icon='&#xe807;'></span><span class='visually-hidden'>Facebook</span></a></li>
        <li><a href='https://www.youtube.com/incarnation.stjames'><span data-icon='&#xe80b;'></span><span class='visually-hidden'>Facebook</span></a></li>
        <li><a href='http://incarnationstjames.com/comments/feed/'><span data-icon='&#xe80a;'></span><span class='visually-hidden'>Facebook</span></a></li>
        <li><a href='https://www.googleplus.com/incarnation.stjames'><span data-icon='&#xe806;'></span><span class='visually-hidden'>Facebook</span></a></li>
        <li><a href='https://www.instagram.com/incarnation.stjames'><span data-icon='&#xe808;'></span><span class='visually-hidden'>Facebook</span></a></li>
        
</ul>";
?>
<ul class="secondaryMenu">
<li title="Search"><a data-toggle="popover" title="" data-html="true" data-placement="left" data-content="<?php echo $searchContent;?>"><span data-icon="&#xe80d;"></span><span class="visually-hidden">Search</span></a></li>
<li title="Share"><a data-toggle="popover" title="" data-html="true" data-placement="left" data-content="<?php echo $socialShare;?>"><span data-icon="&#xe80c;"></span><span class="visually-hidden">Social Share</span></a></li>
<li title="Other"><a href="calendar.php" title="Detailed Calendar"><span data-icon="&#xe802;"></span><span class="visually-hidden">Search</span></a></li>
</ul>
</nav>
</div>
<!-- end of #header -->
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
