<?php
ob_start();
require_once "../../../../vendor/autoload.php";
$objMukttiPedia= new \App\WareHouse\MuktipideaStore();
$MukttiPedia = $objMukttiPedia-> index();
$questions= $objMukttiPedia->questions();
$freedomFighters = $objMukttiPedia->freedomfighters();
$questions= $objMukttiPedia->questions();

use App\Message\Message;
use App\Utility\Utility;

if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

$recordCount = count($MukttiPedia);
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
}else if(isset($_SESSION['DataPerPage'])){
    $DataPerPage = $_SESSION['DataPerPage'];
}else{
    $DataPerPage = 3;
}
$_SESSION['DataPerPage'] = $DataPerPage;



$pages = ceil($recordCount/$DataPerPage);
$Data2view = $objMukttiPedia->indexPaginator($page, $DataPerPage);
$serial = (($page-1) * $DataPerPage) +1;
if($serial<0) $serial=1;
################## search  block 1 of 5 start ##################
if(isset($_REQUEST['search']) )$Data2view =  $objMukttiPedia->search($_REQUEST);
$availableKeywords=$objMukttiPedia->getAllKeywords();
$comma_separated_keywords= '"'.implode('","',$availableKeywords).'"';
?>
<!doctype html>
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
    <link href="../../../../resource/css/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>

    <?php if(isset($msg) && !empty($msg)){ echo "<div id='message' style='color: #fff; background-color:dodgerblue; padding:20px; border-radius: 20px; position: absolute; top: 25vh; left: 40vw;'>$msg </div>";} ?>


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


<form id="searchForm" style="text-align: center;" action="MukttiPediaOld.php" class="searchForm muktiSearch"  method="get">
    <input type="text" value="" id="searchID" style="margin: 20px auto; border: none; border-radius: 20px; background-color: #eee; text-align: center" name="search" placeholder="Search" width="60" >
    <input hidden type="submit" " class="btn-primary" value="search">
</form>


<!-- required for search, block 4 of 5 end -->

    <div class="container">

        <div class="Wikinfo">
            <?php
            if(!empty($_REQUEST['search']) ) {
                $Data2view = $objMukttiPedia->search($_REQUEST);
                $serial = 1;
                ?>
                <?php foreach($Data2view as $Story){ ?>
                    <h1 style="background-color: dodgerblue; color: #fff; text-align: center; padding: 20px;"><i class="ti-flag-alt-2"></i><?php echo $Story->blog_title;?></h1>
                    <p style="padding:40px 20px"><?php echo $Story->blog_post;?></p>
                <?php } ?>
            <?php } ?>
        </div>
<div class="question_answer">

    <h2 style="background-color: lightseagreen; color: #fff; text-align: center; padding: 20px;"> প্রশ্ন-উত্তর </h2>
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
</div>
</body>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/jquery-ui.js"></script>
<script>
    jQuery(function($) {
        $('.success').fadeOut (700);
        $('.success').fadeIn (700);
        $('.success').fadeOut (700);
        $('.success').fadeIn (700);
        $('.success').fadeOut (700);

        $('.error').fadeOut (700);
        $('.error').fadeIn (700);
        $('.error').fadeOut (700);
        $('.error').fadeIn (700);
        $('.error').fadeOut (700);

        $('.yes').fadeOut (700);
        $('.yes').fadeIn (700);
        $('.yes').fadeOut (700);
        $('.yes').fadeIn (700);
        $('.yes').fadeOut (700);

        $('.no').fadeOut (700);
        $('.no').fadeIn (700);
        $('.no').fadeOut (700);
        $('.no').fadeIn (700);
        $('.no').fadeOut (700);
    })
    $('#delete').on('click',function(){
        document.forms[1].action="deletemultiple.php";
        $('#multiple').submit();
    });



    //select all checkboxes
    $("#select_all").change(function(){  //"select all" change
        var status = this.checked; // "select all" checked status
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function(){ //".checkbox" change
//uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }

//check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });

    $(function() {
        var availableTags = [

            <?php
            echo $comma_separated_keywords;
            ?>
        ];
        // Filter function to search only from the beginning of the string
        $( "#searchID" ).autocomplete({
            source: function(request, response) {

                var results = $.ui.autocomplete.filter(availableTags, request.term);

                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });

                response(results.slice(0, 15));

            }
        });


        $( "#searchID" ).autocomplete({
            select: function(event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });


    });
    $(document).ready(function () {
        $('#popQues').click(function (){
            $('.questionForm').toggleClass("displayQues");
        });
    });
    jQuery(function($) {
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
    })

</script>
</html>