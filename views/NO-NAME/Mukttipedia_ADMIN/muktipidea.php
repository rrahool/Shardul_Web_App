<?php
require_once("../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;
$objFreedomFighter= new MuktipideaStore();
$freedomFighters = $objFreedomFighter->freedomfighters();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MuktiPidea</title>
</head>
<body>


<form action="muktipideaProcess.php" method="post">
    Blog Title:
    <input type="text" name="blog_title">
    <br>
    Blog Post:
    <textarea name="blog_post"></textarea>
    <br>
    Blog Date:
    <input type="date" name="blog_date">
    <br>
    Catagory:
    <select name="cetagory">
        <option  value="operation">ঘটনা</option>
        <option  value="brutality "> বর্বরতা</option>
        <option  value="bio">জীবনী </option>
    </select>
    <br>
    Freedom Fighter:
    <select name="Freedom_fighter">
        <?php
            foreach($freedomFighters as $fighter){
          echo"<option value='$fighter->id'>$fighter->name</option>";
        }

        ?>
    </select>
    <input type="submit" value="Post">

</form>

</body>
</html>