<?php
require_once("../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;
$objFreedomFighter= new MuktipideaStore();
$freedomFightersOperation = $objFreedomFighter->operationStory();
$freedomFightersBrutality = $objFreedomFighter->brutalityStory();
$freedomFightersBio = $objFreedomFighter->bioStory();
$freedomFighters = $objFreedomFighter->freedomfighters();
$questions = $objFreedomFighter->questions();


/*$objFreedomFighter=new MuktipideaStore();
$alldata = $objFreedomFighter->index();*/

//$recordCount = count($alldata);
if(isset($_REQUEST['Page'])){
    $page = $_REQUEST['Page'];
}else if(isset($_SESSION['Page'])){
    $page = $_SESSION['Page'];
}else{
    $page = 1;
}
$_SESSION['Page'] = $page;




if(isset($_REQUEST['DataPerPage'])){
    $DataPerPage = $_REQUEST['DataPerPage'];
}

else if(isset($_SESSION['DataPerPage'])){
    $DataPerPage = $_SESSION['DataPerPage'];
}

else{
    $DataPerPage = 3;
}
$_SESSION['DataPerPage'] = $DataPerPage;



//$pages = ceil($recordCount/$DataPerPage);
$Data2view = $objFreedomFighter->indexPaginator($page, $DataPerPage);
$serial = (($page-1) * $DataPerPage) ;
if($serial<0) $serial=1;

################## search  block 1 of 5 start ##################
if(isset($_REQUEST['cetagory']) )
    $Data2view =  $objFreedomFighter->search($_REQUEST);





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mukttipidea</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/custom.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/btstyle.css">
</head>
<body>
<form action="mukttipideaStory.php" method="get">
    <select name="cetagory" id="donortype">
        <option  value="operation">ঘটনা</option>
        <option  value="brutality"> বর্বরতা</option>
        <option  value="bio">জীবনী </option>
    </select>
    <input type="submit" value="Search">


<div class="operation">

    <h2>ঘটনা </h2>
    <?php

    if(isset($_REQUEST['cetagory'])&& $_REQUEST['cetagory']==="operation")
    {
        foreach($freedomFightersOperation as $oneData){
            echo"Blog Title: <h3>$oneData->blog_title </h3>";
            echo"Blog Post: <h2>$oneData->blog_post</h2> ";
        }

    }

    ?>

</div>

<div class="brutality">
<h2> বর্বরতা</h2>

    <?php
    if(isset($_REQUEST['cetagory'])&& $_REQUEST['cetagory']=="brutality"){
        foreach($freedomFightersBrutality as $oneData){
            echo"Blog Title:<h3>$oneData->blog_title </h3>";
            echo"Blog Post: <h2>$oneData->blog_post</h2> ";
        }
    }


    ?>


</div>

<div class="bio">

    <h2> জীবনী </h2>
    <?php
    if(isset($_REQUEST['cetagory'])&& $_REQUEST['cetagory']=="bio")
    {
        foreach($freedomFightersBio as $oneData){
            echo"Blog Title:<h3>$oneData->blog_title </h3>";
            echo" Blog Post:<h2>$oneData->blog_post</h2> ";
        }    }


    ?>


</div>
    <h2> প্রশ্ন করুন  </h2>
</form>
<form action="mukttipediaQuestionAnswer.php" method="post">
    <input type="text" name="question">
    <select name="Freedom_fighter">
        <?php
        foreach($freedomFighters as $fighter){
            echo"<option value='$fighter->id'>$fighter->name</option>";
        }

        ?>
    </select>
    <input type="hidden" value="<?php      ?>">
    <input type="submit" value="Ask">

</form>

<div class="question_answer">

    <h2> প্রশ্ন-উত্তর </h2>
    <?php

        foreach($questions as $question){
            if($question->status == "Yes" && (!empty($question->answer)))
            {
            echo"Question:$question->question <br>";
            echo" Answer:$question->answer <br>";
            }
        }


    ?>
</div>

</body>
</html>