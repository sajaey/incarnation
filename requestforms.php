<?php 
include("includes/header.php");
if (isset($_POST["submit"])) {
$name = isset($_POST['name']) ? $_POST['name'] : '';
$request = isset($_POST['request']) ? $_POST['request'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$human = intval($_POST['human']);
$from = 'Incarnation Request Form';
$to = 'sajaycv@gmail.com'; 
$subject = 'Message from '.$name;
$errName = $errRequest = $errDate = $errTime =  $errEmail = $errPhone = $errMessage = $errHuman = $result = '';
$body ="From: $name\n Request: $request\n Date: $date\n Time: $time\n E-Mail: $email\n Mobile Number: $phone \n Message:\n $message";
if (!$name) {
$errName = 'Please enter your name';
}
if (!$request) {
$errRequest = 'Please select a valid reason of request';
}
if (!$date) {
$errDate = 'Please select a valid date';
}
if (!$time) {
$errTime = 'Please select a valid time';
}
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errEmail = 'Please enter a valid email address';
}
if (!$phone || !filter_var($phone, FILTER_VALIDATE_INT)) {
$errPhone = 'Please enter a valid phone number';
}
if (!$message) {
$errMessage = 'Please enter a valid message';
}
if ($human !== 17) {
$errHuman = 'Your anti-spam is incorrect';
}
if (!$errName && !$errRequest && !$errDate && !$errTime && !$errEmail && !$errPhone && !$errMessage && !$errHuman) {
    if (mail ($to, $subject, $body, $from)) {
        $result = '<div class="alert alert-success">Thank You! We will be in touch</div>';
    }
    else{
         $result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
    }
}
}
else{
    $errName = $errRequest = $errDate = $errTime =  $errEmail = $errPhone = $errMessage = $errHuman = $result = $name = $date = $time = $email = $phone = $message = $human = '';
}
?>
<link rel="stylesheet" type="text/css" href="resources/css/datepicker.css"/>
<script type="text/javascript" src="resources/js/bootstrap-datepicker.js"></script>
<div id="mainwrapperInner" class="col-md-12 requestforms">
 <figure class="banner">
    <img src="resources/images/banner/bannerRequestForms.png" alt="Donate" title="Donate"/>
 </figure>
    <aside class="col-md-3">
    </aside>
       <article class="col-md-6">
         <h2>Request Form</h2>
            <form role="form" method="post" action="requestforms.php">
            <div class="form-group">
            <label for="name">Name of the parishioner</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name?>">
            </div>
            <div class="form-group">
            <label for="address">Reason of request</label>      
            <select class="form-control" name="request" id="request">
            <option value="">Select request</option>
            <option value="Confession" <?php if(isset($_GET['type'])){$reqType = $_GET["type"];}
if($reqType == 'confessions'){echo "selected='selected'";}?>>Confession</option>
            <option value="Baptism">Baptism</option>
            <option value="Funerals">Funerals</option>
             <option value="Mass Request">Mass Request</option>
             <option value="Prayer Request">Prayer Request</option>
              <option value="Wedding">Wedding</option>
               <option value="Sick Visit">Sick Visit</option>
                <option value="Counseling">Counseling</option>
                 <option value="Pastoral Help">Pastoral Help</option>
                  <option value="To become a member">To become a member</option>
                   <option value="CCD Program">CCD Program</option>
                    <option value="To user parish facility">To use parish facility</option>
            </select>
               <?php echo "<p class='text-danger'>$errRequest</p>";?>

            </div>
            <div class="form-group">
            <label for="datepicker">Date preferred</label>
           <input type="text" data-date-format="mm/dd/yy" value="mm/dd/yy" class="form-control" id="date" value="<?php echo $date?>" name="date">
            <?php echo "<p class='text-danger'>$errDate</p>";?>
            </div>
                
            <div class="form-group">
            <label for="time">Time preferred</label>
            <input type="time" class="form-control" id="time" name="time" value="<?php echo $time?>" required>
             <?php echo "<p class='text-danger'>$errTime</p>";?>
            </div>
                
            <div class="form-group">
            <label for="phone">Email id</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" required>
             <?php echo "<p class='text-danger'>$errEmail</p>";?>
            </div>
                
            <div class="form-group">
            <label for="address">Phone number</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone?>" required>
            <?php echo "<p class='text-danger'>$errPhone</p>";?>
            </div>
           
            <div class="form-group">
            <label for="address">Other comments, if any</label>
            <textarea class="form-control" rows="3" name="message" id="message" value="<?php echo $message?>"></textarea>
            <?php echo "<p class='text-danger'>$errMessage</p>";?>
            </div>
            <div class="form-group">
            <label for="human">9 + 8 = ?</label>
            <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
            <?php echo "<p class='text-danger'>$errHuman</p>";?>
            </div>
            <div class="form-group">
             <?php echo $result; ?>	
            </div>
                <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary"/>
                <input type="reset" class="btn btn-default" value="Reset"/>
            </form>
       </article>
</div>
<script>
    $('#date').datepicker({
    format: 'mm-dd-yyyy'
});
</script>
<?php include("includes/footer.php");?>