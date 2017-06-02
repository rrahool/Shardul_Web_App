<?php
session_start();
require_once ('../../../vendor/autoload.php');
use App\WareHouse;
use App\Message\Message;
use App\Utility\Utility;

if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
include_once "dashboard.php";
$objVolCount = new WareHouse\VolunteerStore();
$VolunteerList = $objVolCount->index();



if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

$recordCount = count($VolunteerList);
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
$Data2view = $objVolCount->indexPaginator($page, $DataPerPage);
$serial = (($page-1) * $DataPerPage) +1;
if($serial<0) $serial=1;

################## searchForAdmin  block 1 of 5 start ##################

if(isset($_REQUEST['Bloodgroup']) )
    $Data2view =  $objVolCount->searchForAdmin($_REQUEST);



if(isset($_REQUEST['Zone']) ) {
    $Data2view = $objVolCount->searchForAdmin($_REQUEST);

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="main-content container-fluid">
    <div class="table-hold animated">




        <?php
        if(!empty($msg)) {
            echo $msg;
        }
        ?>

        <h1 class="vol-header">Volunteer List</h1>
        <div class="table-match-width">
            <a href="volemail.php?list=1" class="btn btn-primary match-Sibling" role="button">Email This List</a>
        </div>
        <form action="trashMultiple.php" method="post" id="multiple">
            <div class="table-match-width-absolute">
                <div class="MultiactionButton">
                    <button type="button" class="btn btn-danger animated flipInX" data-toggle="modal" data-target="#multi">Delete  Selected</button>
                    <button type="submit" class="btn btn-warning animated flipInX" style="animation-delay: .3s">Deactivate Selected</button>
                </div>

                <div class="modal fade" id="multi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content ">
                            <button type="button" class="close closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                            <p style="padding: 10px; text-align: center">Delete Selected Datas permanently?</p>
                            <a id="delete" class="btn btn-danger btn-block">Yes</a>
                        </div>
                    </div>
                </div>

                <!--- Download --->
                <div class="dropdown dropdown-override">
                    <button id="dLabel" type="button" class="btn btn-info btnPosition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-download"></i>
                        Download
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu menu-override pull-right animated swing" style="top: 20px;" aria-labelledby="dLabel">
                        <li><i class="ti-"></i><a href="pdf.php" class="btn" role="button">As PDF</a></li>
                        <li><a href="xl.php" class="btn" role="button">As XL</a></li>
                    </ul>
                </div>
                <!---- End Download----->
            </div>

            <table cellpadding="0" cellspacing="0">
                <tr class="titleHead">
                    <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Volunteer Admin"){?>

                        <th>Mark All <label><input id="select_all" type="checkbox" value="select all"> <span class="chk_lbl"></span></label></th>

                    <?php } ?>
                    <th>Serial</th>
                    <th>Username</th>
                    <th>Board Exam</th>
                    <th>Roll</th>
                    <th>Birth Date</th>
                    <th>Phone</th>

                    <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Volunteer Admin"){?>

                        <th>Action</th>

                    <?php } ?>

                </tr>
                <?php
                foreach ($Data2view as $Volunteer){
                    ?>
                    <tr>
                        <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Volunteer Admin"){?>

                            <td><label><input type='checkbox' class='checkbox' name='mark[]' value='<?php echo $Volunteer->id ?>'><span class="chk_lbl"></span></label></label></td>

                        <?php } ?>
                        <td><?php echo $serial ?></td>
                        <td><?php echo $Volunteer->user_name ?></td>
                        <td><?php echo $Volunteer->highest_education ?></td>
                        <td><?php echo $Volunteer->roll ?></td>
                        <td><?php echo date('d-M-y',strtotime($Volunteer->dob));?></td>
                        <td><?php echo $Volunteer->phone;?></td>

                        <?php if($AdminInfo->catagory =="Super Admin" || $AdminInfo->catagory =="Volunteer Admin"){?>

                        <td class="act">
                            <a href='volview.php?id=<?php echo $Volunteer->id ?>' class="btn btn-default" title="View"><i class="ti-target"></i></a>
                            <a href='Voledit.php?id=<?php echo $Volunteer->id ?>' class='btn btn-primary' title="Edit"><i class="ti-pencil"></i></a>
                            <?php if($Volunteer->softDelete=="Yes") {
                                echo "<a href = 'volRecover.php?id=$Volunteer->id' class='btn btn-info' title = 'Activate'><i class='ti-unlock'></i ></a>";
                            }else{
                                echo "<a href = 'voltrash.php?id=$Volunteer->id' class='btn btn-warning' title = 'Deactivate'><i class='ti-lock'></i></a>";
                            } ?>
                            <a href='' type="button" data-toggle="modal" data-target="#pop<?php echo $serial?>" title="Delete" class="btn btn-danger"><i class="ti-close"></i></a>
                            <a href='volemail.php?id=<?php echo $Volunteer->id ?>' class='btn btn-success' title="Mail"><i class="ti-email"></i></a>
                        </td>

                        <?php } ?>

                    </tr>
                    <div class="modal fade" id="pop<?php echo $serial?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <button type="button" class="close closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                                <p style="padding: 20px; margin: 0 auto">Delete <?php echo "<span style='color: tomato'>$Volunteer->user_name</span>"?> Permanently?</p>
                                <a href='volDelete.php?id=<?php echo $Volunteer->user_id ?>' class="btn btn-default btn-block">Yes</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $serial++;
                }  ?>
            </table>

        </form>
        <div class="table-match-width">
            <ul class="pagination pagination-override">

                <?php
                $pageMinusOne  = $page-1;
                $pagePlusOne  = $page+1;

                if($page>$pages)
                    Utility::redirect("Donors.php?Page=$pages");
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
            <select  class="form-control DataPerPage"  name="DataPerPage" id="DataPerPage" onchange="javascript:location.href = this.value;" >
                <?php
                if($DataPerPage==3 ) echo '<option value="?DataPerPage=3" selected >Showing 3 Datas </option>';
                else echo '<option  value="?DataPerPage=3">3 Datas </option>';

                if($DataPerPage==4 )  echo '<option  value="?DataPerPage=4" selected >Showing 4 Datas </option>';
                else  echo '<option  value="?DataPerPage=4">4 Datas </option>';

                if($DataPerPage==5 )  echo '<option  value="?DataPerPage=5" selected >Showing 5 Datas </option>';
                else echo '<option  value="?DataPerPage=5">5 Datas </option>';

                if($DataPerPage==6 )  echo '<option  value="?DataPerPage=6" selected >Showing 6 Datas </option>';
                else echo '<option  value="?DataPerPage=6">6 Datas </option>';

                if($DataPerPage==7 )   echo '<option  value="?DataPerPage=7" selected >Showing 7 Datas </option>';
                else echo '<option  value="?DataPerPage=7">7 Datas </option>';

                if($DataPerPage==8 )  echo '<option  value="?DataPerPage=8" selected >Showing 8 Datas </option>';
                else    echo '<option  value="?DataPerPage=8">8 Datas </option>';
                ?>
            </select>
        </div>
    </div>











    <?php
    }else{
        include_once "AdminLoginForm.php";
    }
    ?>

</body>
<script>

    $('#delete').on('click',function(){
        document.forms[3].action="bloodDeleteMultiple.php";
        $('#multiple').submit();
    });
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
    });

    //select all checkboxes
    $("#select_all").change(function(){  //"select all" change
        $('.MultiactionButton').css({
            'display':'none'
        });
        var status = this.checked; // "select all" checked status
        if(status == true){
            $('.MultiactionButton').css({
                'display':'inline-block'
            });
        }
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function(){ //".checkbox" change
//uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
            $('.MultiactionButton').css({
                'display': 'hidden'
            });
        }

//check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
        var atLeastOneIsChecked = $('input[name="mark[]"]:checked').length > 0;
        if(($(atLeastOneIsChecked).length > 0)){
            $('.MultiactionButton').css({
                'display':'inline-block'
            });
        }else if($(atLeastOneIsChecked).length == 0){
            $('.MultiactionButton').css({
                'display':'none'
            });
        }
    });
</script>
</html>