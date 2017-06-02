<?php
require_once "../../../vendor/autoload.php";
$objBloodView= new\App\WareHouse\BloodStore();
$objBloodView->setdata($_GET);
$BloodView = $objBloodView-> view();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="../../../resource/CSS/style.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Blood Donor View</title>
</head>
<body>
<div class="container view">
    <h1><?php echo $BloodView->user_name ?></h1>
    <table cellpadding="0" cellspacing="0">
        <tr class="titleHead">
            <th>Blood Group</th>
            <th>Preferable Location</th>
            <th>Edit</th>
        </tr>
        <tr>
            <td><?php echo $BloodView->blood_group ?></td>
            <td><?php echo $BloodView->prfrbl_location ?></td>
            <td class="act"><a href='edit.php?id=<?php echo $BloodView->id ?>' class='btn btn-primary btn-block'><span class="glyphicon glyphicon-pencil"></span></a></td>
        </tr>
    </table>
</div>
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