<?php $path = $_SERVER['PHP_SELF'];?>
<div class="col-sm-3 col-md-2 sidebar">
<ul class="nav nav-sidebar">
<li <?php if(stripos($path, 'welcome')){echo "class='active'";}?>><a href="/incarnation/admin/welcome.php">Home</a></li>
<li <?php if(stripos($path, 'photogallery')){echo "class='active'";}?>><a href="/incarnation/admin/photogallery">Photo Gallery</a></li>
<li <?php if(stripos($path, 'announcements')){echo "class='active'";}?>><a href="/incarnation/admin/announcements">Announcements</a></li>
<li <?php if(stripos($path, 'bulletins')){echo "class='active'";}?>><a href="/incarnation/admin/bulletins">Bulletin</a></li>
</ul>
</div>