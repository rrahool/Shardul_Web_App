<?php
session_start();
require_once ('../../../vendor/autoload.php');
use App\WareHouse;
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\MuktipideaStore;
$objQuestion= new MuktipideaStore();
$questions = $objQuestion->questions();

if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
include_once "dashboard.php";

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
<div class="main-content container-fluid">
    <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Muktipedia Admin"){ ?>
    <a href="#MuktipediaForm" class="btn btn-success"><i class="ti-pencil-alt2"></i>&nbsp; মুক্তির-কলম</a>
    <?php } ?>
    <div class="table-hold">
    <h1 class="mukti-header">মুক্তিযুদ্ধের প্রশ্নোত্তর</h1>
    <table>
        <tr class="titleHead">
            <th>প্রশ্ন নম্বর</th>
            <th>প্রশ্নকর্তার</th>
            <th>প্রশ্ন</th>
            <th>কার নিকট </th>
            <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Muktipedia Admin") { ?>
            <th> গ্রহণযোগ্যতা</th>
            <?php } ?>
        </tr>

        <?php
        foreach($questions as $question){
            ?>
            <form action="questionsProcess.php" method="post">
                <tr>
                    <td> <?php echo $question->id;?> </td>
                    <td> <?php echo $question->user_name;?> </td>
                    <td> <?php echo $question->question;?> </td>
                    <td> <?php echo $question->name;?> </td>

                    <input type="hidden" name="question_id" value="<?php echo $question->id;?>">
                    <?php
                    if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Muktipedia Admin") {
                    if($question->status == "Yes" && (empty($question->answer)))
                    {
                        echo "
                            <td>
                                waiting for the ans;
                                <a href='answer.php?question_id=$question->id'>Reply</a>

                            </td>
                        ";
                    }
                    elseif(!empty($question->answer)){
                        echo "
                            <td>
                                answered!

                            </td>
                        ";
                    }
                    else
                    {

                        echo "<td> <input type='submit' name='accept' value='Accept'>
                                   <input type='submit' name='reject' value='Reject'>
                    </td>";
                    }
                    }

                    ?>

                </tr>
            </form>
            <?php
        }
        ?>
    </table>
    </div>



<?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory == "Muktipedia Admin"){?>

    <form action="muktipideaProcess.php" method="post" class="MuktipediaForm" id="MuktipediaForm">
        <h1><i class="ti-flag-alt-2"></i>&nbsp; মুক্তির-কলম</h1>
        শিরনাম
        <input type="text" name="blog_title" placeholder="Headline">
        বিষয়
        <input name="cetagory" placeholder="Subject">
        বিস্তারিত লিখুন
        <textarea name="blog_post" rows="10" placeholder="Write in Detail"></textarea>
        লিখকের নাম
        <select name="Freedom_fighter">
            <?php
                foreach($freedomFighters as $fighter){
              echo"<option value='$fighter->id'>$fighter->name</option>";
            }

            ?>
        </select>
        <input type="submit" value="সংযোজন">

    </form>

<?php } ?>

</div>
<?php
}else{
    include_once "AdminLoginForm.php";
}
?>
</body>
<script>
    $(document).ready(function(){
        $(function() {
            $("#blog_date").datepicker({
                dateFormat: "dd-MM-yy"
            });
        });
    });
</script>
</html>