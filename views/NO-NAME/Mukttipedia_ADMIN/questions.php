<?php
require_once("../../../vendor/autoload.php");
use App\WareHouse\MuktipideaStore;
$objQuestion= new MuktipideaStore();
$questions = $objQuestion->questions();
use App\Message\Message;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questions</title>
</head>
<body>
<?php

if(!isset($_SESSION))
    session_start();
echo Message::getMessage();
?>


    <table>
        <tr>
        <th>প্রশ্ন নম্বর</th>
        <th>প্রশ্নকর্তার</th>
        <th>প্রশ্ন</th>
        <th>কার নিকট </th>
        <th> গ্রহণযোগ্য  </th>
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
                if($question->status == "No" && (empty($question->answer)))
                {
                    echo "<td> <input type='submit' name='accept' value='Accept'>
                    <input type='submit' name='reject' value='Reject'>
                    </td>";
                }


                ?>

            </tr>
        </form>
        <?php
            }
        ?>
    </table>


</body>
</html>