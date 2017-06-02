<?php
require_once("../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;
$objQuestion= new MuktipideaStore();
$questions = $objQuestion->questions();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Answer</title>
</head>
<body>

<form action="answerProcess.php" method="post">
    <?php
        $question_id=$_GET['question_id'];
    ?>

    <textarea name="answer"></textarea>
    <input type="hidden" name="question_id" value="<?php echo $question_id;?>">
    <input type="submit">
</form>

</body>
</html>
