<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;

if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

$objBloodEdit= new \App\WareHouse\BloodStore();
$objBloodEdit-> setdata($_REQUEST);
$BloodEdit= $objBloodEdit->view();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blood Donor Edit</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../../../resource/CSS/style.css">
</head>
<body>
<form action="update.php" method="post">
    <h2>EDIT</h2>
    <?php
    if(!empty($msg)) {
        echo "<div id='message'> $msg </div>";
    }
    ?>
    <label>User Name</label><br>
    <input type="text" placeholder="User Name" name="userName" value="<?php echo $BloodEdit->user_name; ?>"><br>
    <label>Blood Group</label><br>
    <input type="text" placeholder="bloodGroup" name="bloodGroup" value="<?php echo $BloodEdit->blood_group ?>"><br>
	<label>Preferable Time</label><br>
    <input type="text" placeholder="preferableLocation" name="preferableLocation" value="<?php echo $BloodEdit->prfrbl_time ?>"><br>
    <input type="hidden" name="id" value="<?php echo $BloodEdit->id ?>">
    <input type="submit" value="submit">
</form>
</body>
<script src="../../../resource/bootstrap/js/jquery-1.11.1.min.js"></script>
<script>
    jQuery(function($) {
        $('#message').fadeOut (700);
        $('#message').fadeIn (700);
        $('#message').fadeOut (700);
        $('#message').fadeIn (700);
        $('#message').fadeOut (700);
    })
</script>
</html>