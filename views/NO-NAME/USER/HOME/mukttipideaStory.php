<?php
require_once("../../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;
$objFreedomFighter= new MuktipideaStore();
$freedomFightersOperation = $objFreedomFighter->operationStory();
$freedomFightersBrutality = $objFreedomFighter->brutalityStory();
$freedomFightersBio = $objFreedomFighter->bioStory();
$freedomFighters = $objFreedomFighter->freedomfighters();
$questions= $objFreedomFighter->questions();


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
if(isset($_REQUEST['search']) )
    $Data2view =  $objFreedomFighter->search($_REQUEST);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শার্দূল</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../../../resource/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link href="../../../../resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../resource/css/style.css" rel="stylesheet">
    <link href="../../../../resource/css/owl.carousel.min.css" rel="stylesheet">
    <link href="../../../../resource/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="../../../../resource/css/owl.theme.green.min.css" rel="stylesheet">
    <link href="../../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../../resource/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>
<form action="mukttipediaQuestionAnswer.php" method="post" class="questionForm" >
    <h2 id="popQues">যুদ্ধ জিজ্ঞাসা</h2>

    <label for="">ব্যবহার-কারির নাম</label>
    <input type="text" name="userName" placeholder="User Name">

    <label for="">জিজ্ঞাসা লিখুন</label>
    <input type="text" name="question" placeholder="Your Askings">

    <label for="">কার নিকট প্রশ্ন রাখা হবে ?</label>
    <select name="Freedom_fighter">
        <?php
        foreach($freedomFighters as $fighter){
            echo"<option value='$fighter->id'>$fighter->name</option>";
        }

        ?>
    </select>
    <p style="color: tomato; font-size:.8em; margin-top: 20px">* প্রশ্নকর্তা অবশ্যই শার্দূল হওয়া বাঞ্ছনীয়</p>
    <input type="submit" value="জমা দিন">
</form>




<!-- required for search, block 4 of 5 start -->


<form id="searchForm" action="" class="searchForm"  method="get">
    <input type="text" value="" id="searchID" name="search" placeholder="Search" width="60" >
    <input hidden type="submit" class="btn-primary" value="search">
</form>

<!-- required for search, block 4 of 5 end -->
<div class="">

    <?php  foreach($Data2view as $view){
        echo $view->blog_post;
    }
    ?>
</div>


<div class="question_answer">
    <?php

    foreach($questions as $question){
        if($question->status == "Yes" && (!empty($question->answer)))
        {
            echo "User Name:$question->user_name <br>";
            echo"Question:$question->question <br>";
            echo" Answer:$question->answer <br>";
            $AnsweredOn = date('d-M-y',strtotime($question->reply_date));
            echo "Answered On: $AnsweredOn <hr>";
        }
    }
    ?>
</div>


</body>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('#popQues').click(function (){
       $('.questionForm').toggleClass("displayQues");
    });
});
</script>
</html>