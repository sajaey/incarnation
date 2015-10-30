<?php include("includes/header.php");?>
<div id="mainwrapperHome" class="col-md-12">
<div class="cycle-slideshow" data-cycle-fx=scrollHorz data-cycle-timeout=5000>
    <!-- empty element for pager links -->
    <div class="cycle-pager"></div>
    <img src="resources/images/banner/bannerIncarnation.png" />
    <img src="resources/images/banner/bannerAdoration.png" />
    <img src="resources/images/banner/bannerBaptism.png" />
    <img src="resources/images/banner/bannerEucharist.png" />
    <img src="resources/images/banner/bannerMatrimony.png" />
    <img src="resources/images/banner/bannerPrayerGroups.png" />
    <img src="resources/images/banner/bannerYouthMinistry.png" />
</div>

<!--Events from Google Calendar-->
<div class="event-wrapper">
<h1>UPCOMING EVENTS</h1>
<div class="event-scroll">
<div class="event-listing">
<?php include 'googlecalendar.php'?>
</div>
</div>

<div class="tabbedBrowse-productListings-scrollerHeader">
<div class="tabbedBrowse-productListings-controls">
<button class="js-previous button-called-out-alt tabbedBrowse-productListings-controls-previous" disabled="disabled"></button>
<button class="js-next button-called-out-alt tabbedBrowse-productListings-controls-next"></button>
</div>
</div>
<a href="calendar.php" class="detailedCalendar"><span data-icon="&#xe802;"></span>Detailed Calendar</a>
</div>
<!--Events from Google Calendar-->

<div class="blocks">
 <div class="col-md-4">
<div class="confessions"> 
    <h2>Confessions</h2>
    <h4>Saturdays 4:30 - 5:10 p.m</h4>
    <a href="requestforms.php?type=confessions">Create Appointment</a>  
</div>
</div>
<div class="col-md-4">
    <div class="stjames">
        <h2>St. James Church</h2>
        <h4>Saturdays 4:30 - 5:10 p.m</h4>
        <a href="masstimings.php">Mass Timings</a>  
    </div>
</div>
<div class="col-md-4">
<div class="incarnation">
    <h2>Incarnation Church</h2>
    <h4>Saturdays 4:30 - 5:10 p.m</h4>
    <a href="masstimings.php">Mass Timings</a>  
</div>
</div>
</div>

<!--Separator Component-->
<div class="separator col-md-12">
    <div class="quote">
        <p>"Son, you are always with me, and all that is mine is yours."</p>
        <span>-Luke 15:31</span>
    </div>
</div> 
<!--Separator Component-->
</div>

<?php include("includes/footer.php");?>