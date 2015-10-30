<?php
    include("../config.php");
    if(isset($_POST['category_name'])){$category_name = $_POST["category_name"];}
	$query = mysqli_query($bd,"SELECT * FROM gallery_category WHERE category_name='$category_name'");
        $resultcount = mysql_num_rows($query);
        echo "Result" .$resultcount;
	if (mysqli_num_rows($query) != 0){
		echo "Album name already exists. Use a different name";
	}
	else{
		$result = mysqli_query($bd, "INSERT INTO `gallery_category`(`category_id`, `category_name`) VALUES ('','$category_name')");                                
		if(!$result){
			echo "Not able to create new album at the moment. Please try again" ;
		}
		else{
			echo "New album ".$category_name." is created";
		} 
	}	
?>
