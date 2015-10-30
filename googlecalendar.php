<?php
 //TO DEBUG UNCOMMENT THESE LINES
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//INCLUDE THE GOOGLE API PHP CLIENT LIBRARY FOUND HERE
//https://github.com/google/google-api-php-client
//DOWNLOAD IT AND PUT IT ON YOUR WEBSERVER IN THE ROOT FOLDER.
include(__DIR__.'/google-api-php-client-master/src/Google/autoload.php'); 

//TELL GOOGLE WHAT WE'RE DOING
$client = new Google_Client();
$client->setApplicationName("My Calendar"); //DON'T THINK THIS MATTERS
$client->setDeveloperKey('AIzaSyDNGWkxedpvcR-_ADJNCsLgsDWoKn020eM'); //GET AT AT DEVELOPERS.GOOGLE.COM
$cal = new Google_Service_Calendar($client);
//THE CALENDAR ID, FOUND IN CALENDAR SETTINGS. IF YOUR CALENDAR IS THROUGH GOOGLE APPS
//YOU MAY NEED TO CHANGE THE CENTRAL SHARING SETTINGS. THE CALENDAR FOR THIS SCRIPT
//MUST HAVE ALL EVENTS VIEWABLE IN SHARING SETTINGS.
$calendarId = 'sajaycv@gmail.com';
//TELL GOOGLE HOW WE WANT THE EVENTS
$params = array(
//CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON,
//IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
 'singleEvents' => true,
 'orderBy' => 'startTime',
 'timeMin' => date(DateTime::ATOM),//ONLY PULL EVENTS STARTING TODAY
 'maxResults' => 1000 //ONLY USE THIS IF YOU WANT TO LIMIT THE NUMBER
 //OF EVENTS DISPLAYED

);
//THIS IS WHERE WE ACTUALLY PUT THE RESULTS INTO A VAR
$events = $cal->events->listEvents($calendarId, $params);
$calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR

//SET THE DEFAULT TIMEZONE SO PHP DOESN'T COMPLAIN. SET TO YOUR LOCAL TIME ZONE.
 date_default_timezone_set($calTimeZone);

 //START THE LOOP TO LIST EVENTS
 foreach ($events->getItems() as $event) {

 //Convert date to month and day

 $eventDateStr = $event->start->dateTime;
 if(empty($eventDateStr))
 {
 // it's an all day event
 $eventDateStr = $event->start->date;
 }

 $temp_timezone = $event->start->timeZone;
 //THIS OVERRIDES THE CALENDAR TIMEZONE IF THE EVENT HAS A SPECIAL TZ
 if (!empty($temp_timezone)) {
 $timezone = new DateTimeZone($temp_timezone); //GET THE TIME ZONE
 //Set your default timezone in case your events don't have one
 } else { $timezone = new DateTimeZone($calTimeZone);
 }

 $eventdate = new DateTime($eventDateStr,$timezone);
 $link = $event->htmlLink;
 $TZlink = $link . "&ctz=" . $calTimeZone; //ADD TZ TO EVENT LINK
 //PREVENTS GOOGLE FROM DISPLAYING EVERYTHING IN GMT
 $newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
 $newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
  $newtime = $eventdate->format("h:i");
 ?>

<div class="event">
  <div class="eventDate"> <span class="month"><?php echo $newmonth;?></span> <span class="day"><?php echo $newday;?></span> <span class="dayTrail"></span> </div>
  <div class="eventBody"> <span class="summary"> <a href="<?php echo $TZlink;
    //ECHO DIRECT LINK TO EVENT
    ?>"> <?php echo $event->summary; //SUMMARY = TITLE
    ?> </a> </span> <span class="description">
    <?php if (!empty($event->description)){
                echo $event->description; //Description = Description
           }?>
    </span> <span class="time"> <?php echo $newtime;?> </span> </div>
</div>
<?php
 }
?>
<script type="text/javascript">
(function(jQuery) {
	var app = window.LENOVO = window.LENOVO || {},
	navAnimationDuration = 1000,
	self = app.MAIN = {
		$window: $(window),
		start: function(options){
		var breakPointName, moduleName, module;
		if (!self.initialized) {
			self.initialized = true;
			//start any required modules for the page
			for (moduleName in app) {
				if (app.hasOwnProperty(moduleName)) {
					module = app[moduleName];
					//determine if the module should be initialized
					if (module.init && (!module.shouldRun || module.shouldRun())) {
						if (options[moduleName.toLowerCase() + "_options"]) {
							module.init(options[moduleName.toLowerCase() + "_options"]);
						} else {
							module.init();
					}
					}
				}
			}
			//self.$window.on("resize", self.triggerDebouncedResize);
			}
			},

	init:function(){
			$(".tabbedBrowse-productListings-controls").on("click.tabbedBrowse-productListings-scrollerHeader", ".js-previous, .js-next", this.productNavigationHandler);
			//reset state on a resize
			app.MAIN.$window.on(app.MAIN.resizeEventName, self.onResize);
	},

	//determine the maximum number of products that can currently be shown at current size
	getMaxProductsToShow: function($container) {
		var productWidth = $container.find(".event").width(),
		containerWidth = $container.find(".event-scroll").width();
                //alert(productWidth);
        //alert(containerWidth);
		return Math.floor(containerWidth / productWidth);
	},

	//clicking on next/previous in product listing
	productNavigationHandler: function(e) {
		var $el = $(this),
		isLeft = $el.hasClass("js-previous"),
		container = $el.closest(".event-wrapper");
		self.updateProductListing(container, true, isLeft ? "left" : "right");
		e.preventDefault();
	},

	//scroll the product listing
	updateProductListing: function($container, shouldAnimate, direction) {
	var maxProductsCanShow, totalProducts, maxStartingIndex, moveCount, newIndex,
	$items = $container.find(".event"),
	currentIndex = ($items.parent().data("currentIndex")) || 0;
	if (currentIndex < 0) currentIndex = 0; //FIX: If it is negative value then it should be
	if (!$items.length) return;

	//get max products we can show and the maximum starting index
	maxProductsCanShow = self.getMaxProductsToShow($container);
	totalProducts = $container.find(".event").length;
	maxStartingIndex = totalProducts - maxProductsCanShow + (totalProducts > 1 ? 0 : 1); //if we can only fit 1, then still allow movement
	if (maxStartingIndex < 0) maxStartingIndex = 0; //FIX: If it is negative value then it should be

	//can be called with no direction to update on resize
	moveCount = direction ? (maxProductsCanShow - 1 || 1) : 0;

	newIndex = currentIndex + (direction === "right" ? moveCount : -moveCount);
	//index needs to be between 0 and the max starting index
	newIndex = Math.min(Math.max(0, newIndex), maxStartingIndex);
	//move to the appropriate index
	self.focusProductListing($items, newIndex, shouldAnimate);

	//update the previous/next buttons
	$container.find(".js-previous").attr("disabled", newIndex === 0 ? "disabled" : null);
	$container.find(".js-next").attr("disabled", newIndex >= maxStartingIndex ? "disabled" : null);
	},

	//focus (show first in container) a specific product listing within a group of products
	focusProductListing: function($items, index, shouldAnimate) {
	var newPosition, $parent,
	$productToFocus = $items.eq(index || 0);
	if ($productToFocus.length) {
	newPosition = $productToFocus.length && $productToFocus.position().left;
	$parent = $items.parent();
	
	//store new index
	$parent.data("currentIndex", index).css("position", "relative");
	$parent[shouldAnimate ? "animate" : "css"]({ left: -newPosition }, navAnimationDuration);
	}
	},

	onResize: function() {
		self.productNavigationHandler;
	}
	};
})(jQuery);
$(function(){var o=((typeof LNV_options=="undefined")?{}:LNV_options);LENOVO.MAIN.start(o);});
</script>