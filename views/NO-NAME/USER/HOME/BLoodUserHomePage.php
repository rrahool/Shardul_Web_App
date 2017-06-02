<?php
require_once "../../../../vendor/autoload.php";
if(!isset($_SESSION) )session_start();
use App\Utility\Utility;
use App\Message\Message;
use App\WareHouse\BloodDonorStore;
if(isset($_REQUEST) ){
    $objblooddonor = new BloodDonorStore();
    $alldata = $objblooddonor->index();
}
$recordCount = count($alldata);
if(isset($_REQUEST['Page'])){
    $page = $_REQUEST['Page'];
}else if(isset($_SESSION['Page'])){
    $page = $_SESSION['Page'];
}else{
    $page = 1;
}
$_SESSION['Page'] = $page;




$DataPerPage = 10;
$_SESSION['DataPerPage'] = $DataPerPage;



$pages = ceil($recordCount/$DataPerPage);
$Data2view = $objblooddonor->indexPaginator($page, $DataPerPage);
$serial = (($page-1) * $DataPerPage) ;
if($serial<0) $serial=1;

################## search  block 1 of 5 start ##################
if(isset($_REQUEST['Bloodgroup']) )
    $Data2view =  $objblooddonor->search($_REQUEST);



if(isset($_REQUEST['Zone']) ) {
    $Data2view = $objblooddonor->search($_REQUEST);

}



?>

<!DOCTYPE HTML>
<html lang="en-US">
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

<div class="container-fluid BloodMainHolder">
<h1 style="color:#fff; font-weight: 400;">
    <?php echo date('d-M-Y');
    echo "<br>";
    ?>
</h1>

<div class="table-hold" id="table-hold">
    <div class="table-match-width-absolute">
        <form action="BLoodUserHomePage.php" class="searchForm" method="get">

        <select name="Bloodgroup" id="bloodgroupsearch">
            <option  name="noselect">-- Please choose your Blood Group--</option>
            <option  value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <select name="Zone" id="Addresszonesearch">
            <option  name="noselect">-- Please choose your zone--</option>
            <option  value="panchlaish">panchlaish</option>
            <option value="bayezid">bayezid</option>
            <option value="kotowali">kotowali</option>
            <option value="chandgaon">chandgaon</option>
            <option value="chawkbazar">chawkbazar</option>
            <option value="potenga">potenga</option>
        </select>

            <button type="submit" name="search"><img src="../../../../resource/img/BloodDrop.png" width="30px" alt=""></button>

        </form>
    </div>


    <h1 id="DataHead" style="display: none; text-align: center; margin-top: 60px;">Data</h1>
    <table  class="table" id="DonorData">
        <?php

        if(isset($_REQUEST['Bloodgroup']) && isset($_REQUEST['Zone'])){
        ?>
        <tr class="titleHead">

            <th class="thead">SERIAL NO</th>
            <th class="thead">DONOR ID </th>
            <th class="thead">BLOOD GROUP</th>
            <th class="thead">AREA</th>
            <th class="thead">PHONE</th>
            <th class="thead">STATUS</th>
        </tr>

        <?php


        foreach($Data2view as $oneData)
        {
            $serial++;

            ?>
            <tr>


                <td><?php echo $serial; ?></td>
                <td><?php echo $oneData->id; ?></td>
                <td><?php echo $oneData->blood_group ; ?></td>
                <td><?php echo $oneData->area_zone; ?></td>
                <td><?php  $oneData->gender;

                       if ($oneData->gender=="female"){
                           echo "admin number";
                       }

                       else{
                           echo $oneData->phone;
                       }


                    ?>
                </td>

                <td><?php
                    $nextdate = date("Y-m-d", strtotime("$oneData->last_donate_date +4 month"));
                    $today = date("Y-m-d");

                    if ($nextdate > $today) {

                        $status = "not available";
                    } else {

                        $status = "available";
                    }

                    echo $status ?></td>
            </tr>


        <?php }?>
    </table>
    <?php }?>
    <div class="table-match-width">
    <ul class="pagination pagination-override" id="Donorpaginator">

            <?php
            $pageMinusOne  = $page-1;
            $pagePlusOne  = $page+1;

            if($page>$pages)
                Utility::redirect("SelectedDataLIst.php?page=$pages");
            if($pages == 0 || $page == 0)$page=1;
            if($page>1)  echo "<li><a href='?Page=$pageMinusOne'>" . "<span class='glyphicon glyphicon-chevron-left'></span>" . "</a></li>";
            for($i=1;$i<=$pages;$i++)
            {
                if($i==$page) echo '<li class="active"><a href="">'. $i . '</a></li>';
                else  echo "<li><a href='?Page=$i'>". $i . '</a></li>';

            }
            if($page<$pages) echo "<li><a href='?Page=$pagePlusOne'>" . "<span class='glyphicon glyphicon-chevron-right'></span>" . "</a></li>";

            ?>
    </ul>
    </div>
    </div>
</div>




<div class="bloodInfo">
    <img src="../../../../resource/img/douknow.png" style=" width: 170px; display:block; margin:0 auto; padding: 20px" alt="">
    <h2 style="color: tomato; text-align: center">আপনি জানেন কি?</h2>
<p style="line-height: 1.5em; max-width: 1200px; display: block ; margin: 20px auto">
    রক্ত কৃত্তিমভাবে তৈরী করা যায় না, শুধুমাত্র একজন মানুষই পারে আরেকজন মানুষকে বাঁচাতে। কিন্তু দুঃখের ব্যাপার, প্রতিবছর বহুসংখ্যক মানুষ মারা যাচ্ছে জরুরি মুহুর্তে প্রয়োজনীয় রক্তের অভাবে। বর্তমানে বাংলাদেশে প্রতি বছর রক্তের প্রয়োজন মাত্র ৯ লাখ ব্যাগ। অথচ জনবহুল এই দেশে এখনো মানুষ মারা যাচ্ছে রক্তের অভাবে। রক্তের এই চাহিদা খুব সহজেই পূরণ করা সম্ভব হবে যদি আমাদের দেশের সকল প্রান্তের পূর্ণবয়স্ক মানুষদের রক্তদানের প্রয়োজনীয়তা এবং সুফলতা বুঝিয়ে সচেতন করা যায়।

    একজন মুমূর্ষু রোগীকে তার প্রিয়জনের মাঝে সুস্থভাবে ফিরিয়ে আনা থেকে আনন্দের আর কিছু হতে পারে না। জরুরি রক্তের প্রয়োজনে মুমূর্ষু রোগীদের পাশে থাকুন। যারা রক্তদানে ইচ্ছুক, দয়া করে এই ওয়েবসাইটটিতে রক্তদাতা হিসাবে রেজিস্ট্রেশন করুন। জরুরি রক্তের প্রয়োজনে রোগীরাই আপনাকে খুঁজে নিবে। হ্যাপি ব্লাড ডোনেটিং।</p>
</div>


<div class="content-hold">
    <div class="locker container-fluid">
        <div class="ticker col-md-4 col-sm-12">
            <h4 style="color: tomato; margin-top: 0">রক্তদান জরুরী</h4>
            <p>
                ১. প্রথম এবং প্রধান কারণ, আপনার দানকৃত রক্ত একজন মানুষের জীবন বাঁচাবে। রক্তদানের জন্য এর থেকে বড় কারণ আর কি হতে পারে !

                ২. নিয়মিত রক্তদানে হৃদরোগ ও হার্ট অ্যাটাকের ঝুঁকি অনেক কম।

                ৩. নিয়মিত স্বেচ্ছায় রক্তদানের মাধ্যমে বিনা খরচে জানা যায় নিজের শরীরে বড় কোনো রোগ আছে কিনা। যেমন : হেপাটাইটিস-বি, হেপাটাইটিস-সি, সিফিলিস, এইচআইভি (এইডস) ইত্যাদি।

                ৪. দেহের রোগ প্রতিরোধ ক্ষমতা অনেকগুন বেড়ে যায়।
            </p>
        </div>
        <div class="video col-md-8 col-xs-12">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/FXmkVg8a2Mo" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>
<div class="container-fluid myths">
    <h1><i class="ti-heart-broken"></i></h1>
    <h2 style="color: tomato; text-align: center">কিছু ভুল ধারনা</h2>
    <ul>
        <li>১. রক্ত দান করার সময় মোটেও ব্যথা লাগে না। শুধূমাত্র সূচ ফোটানোর সময় অল্প একটু অস্বস্তি লাগে।</li>
        <li>২. রক্তদানের পর স্বাস্থ্য খারাপ হয়ে যাবে - এটি ভুল ধারণা। আসলে রক্তদান করলে হৃদরোগের ঝুঁকি কমে এবং দেহে মাত্রাতিরিক্ত আয়রন বা লৌহ সঞ্চয় প্রতিরোধ করে।</li>
        <li>৩. ডায়াবেটিসে আক্রান্ত ব্যক্তি রক্ত দিতে পারবে না - এটিও ভুল ধারণা। স্বাস্থ্য পরীক্ষায় যোগ্য বিবেচিত হলে, ডায়াবেটিসে আক্রান্ত ব্যক্তি ততক্ষণ রক্ত দান করতে পারবেন, যতক্ষণ ওই ব্যক্তির রক্তের গ্লুকোজ লেভেল স্বীকৃত সীমার মধ্যে থাকবে।</li>
        <li>৪. উচ্চরক্তচাপের কারণে রক্তদান করা যায় না - এটিও ভুল ধারণা। রক্তদানের সময় ব্লাডপ্রেসার ১৮০সিষ্টোলিক ও ১০০ডায়াষ্টোলিকের মাঝে থাকলে রক্ত দেওয়া যায়।</li>
        <li>৫. রক্তদানের পর আপনি কোনো প্রকার অসস্থি বোধ করবেন না কিংবা অজ্ঞান হয়ে যাবেন না। এই ব্যাপারে অনেকের ভুল ধারণা রয়েছে।</li>
    </ul>
</div>

<div class="container-fluid canbedonor">
    <h1><i class="ti-face-smile"></i></h1>
    <h2 style="color: tomato; text-align: center">কারা রক্তদান করতে পারবেন?</h2>

    <ul>

        <li>১) ১৮ বছর থেকে ৬০ বছরের যেকোনো সুস্থদেহের মানুষ রক্ত দান করতে পারবেন।</li>
        <li>২) শারীরিক এবং মানসিক ভাবে সুস্থ নিরোগ ব্যক্তি রক্ত দিতে পারবেন।</li>
        <li>৩)  আপনার ওজন অবশ্যই ৫০ কিলোগ্রাম কিংবা তার বেশি হতে হবে।</li>
        <li>৪) মহিলাদের ক্ষেত্রে ৪ মাস অন্তর-অন্তর, পুরুষদের ক্ষেত্রে ৩ মাস অন্তর অন্তর রক্ত-দান করা যায়।</li>
        <li>৫) রক্তে হিমোগ্লোবিনের পরিমাণ, রক্তচাপ ও শরীরের তাপমাত্রা স্বাভাবিক থাকতে হবে।</li>
        <li>৬) শ্বাস-প্রশ্বাসজনিত রোগ এ্যাজমা, হাপানি যাদের আছে তারা রক্ত দিতে পারবেন না।</li>
        <li>৭) রক্তবাহিত জটিল রোগ যেমন-ম্যালেরিয়া, সিফিলিস , গনোরিয়া, হেপাটাইটিস , এইডস, চর্মরোগ , হৃদরোগ , ডায়াবেটিস , টাইফয়েড এবং বাতজ্বর না থাকলে।</li>
        <li>৮)  আপনাকে চর্মরোগ মুক্ত হতে হবে।</li>
        <li>৯) মহিলাদের মধ্যে যারা গর্ভবতী নন এবং যাদের মাসিক চলছে না।</li>
        <li>১০)  আপনাকে অবশ্যই হেপাটাইটিস-বি, হেপাটাইটিস-সি, এইডস, ক্যান্সার, যক্ষা, সিজোফ্রেনিয়া এবং ম্যালেরিয়া রোগমুক্ত হতে হবে। তবে কিছু রোগ আগে যেগুলোতে আক্রান্ত রোগীরা নির্দিষ্ট সময় পর রক্ত দিতে পারেন। যেমন, টাইফয়েডে আক্রান্ত রোগী-১২ মাস, ম্যালেরিয়ার রোগী-তিন মাস পর রক্ত দিতে পারবেন।</li>
        <li>১১) কোন বিশেষ ধরনের ঔষধ ব্যবহার না করলে। যেমন- এ্যান্টিবায়োটিক।</li>
    </ul>
</div>


</body>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/scrolling-nav.js"></script>
<script>
    $(document).ready(function () {
        var tbody = $("#DonorData tbody");

        if (tbody.children().length <= 1) {
            $("#DonorData").hide();
            $("#Donorpaginator").hide();
            $("#DataPerPage").hide();
            $('#table-hold').removeClass("table-hold");
            <?php  if(isset($_REQUEST['Bloodgroup']) && isset($_REQUEST['Zone'])){ ?>
            $("#DataHead").show().html("<span><i class='fa fa-close' style='color: tomato'></i>&nbsp;No Data Found</span>")
            <?php } ?>
        }else{
            $('#table-hold').addClass("table-hold");
            $("#DonorData").show();
            $("#Donorpaginator").show();
            $("#DataPerPage").show();
            $("#DataHead").show().html("<span><i class='fa fa-check' style='color: lightseagreen'></i>&nbsp;<?php echo count($Data2view); ?> Data Found</span>")
        }
    });
</script>
</html>





