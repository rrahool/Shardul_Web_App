<?php
session_start();
require_once ('../../../vendor/autoload.php');
use App\WareHouse;
if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])){
include_once "dashboard.php";
$objCount = new WareHouse\counter();
$userCounts = $objCount->userCount();
$NewuserCounts = $objCount->NewuserCount();
$donorCounts = $objCount->donorCount();
$volunteerCounts = $objCount->volunteerCount();
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
    <div class="ticker col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="block col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="count-wrap">
                <i class="ti-user"></i>
                <div class="count">
                    <h4>Total Users</h4>
                    <h3><?php echo $userCounts ?></h3>
                </div>
            </div>
        </div>
        <div class="block col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="count-wrap">
                <i class="ti-plus"></i>
                <div class="count">
                    <h4>New Users</h4>
                    <h3><?php echo $NewuserCounts ?></h3>
                </div>
            </div>
        </div>
        <div class="block col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="count-wrap">
                <i class="ti-heart"></i>
                <div class="count">
                    <h4>Blood Donors</h4>
                    <h3><?php echo $donorCounts ?></h3>
                </div>
            </div>
        </div>
        <div class="block col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="count-wrap">
                <i class="ti-stats-up"></i>
                <div class="count">
                    <h4>Volunteers</h4>
                    <h3><?php echo $volunteerCounts ?></h3>
                </div>
            </div>
        </div>
    </div>

    <?php
    $objAdminlist = new WareHouse\AdminStore();
    $AdminList = $objAdminlist->GetAdmin();
    $i=0;
    ?>
    <?php foreach ($AdminList as $adminData){?>

        <div class="adminhold block col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="count-wrap">
                <img src="../../../resource/img/admin/pro-pic/admin.png" alt="" style=" width:30%; " class="img-responsive img-circle">
                <div class="admin_detail">
                    <h5><?php echo $adminData->name ?></h5>
                    <?php if($adminData->catagory == "Volunteer Admin") {
                            echo " <label style='color: #ffff;background-color:#f0ad4e;'>Volunteer's Admin</label>";
                        }else if($adminData->catagory == "Donor Admin"){
                            echo " <label style='color: #ffff;background-color:red;'>Donor's Admin</label>";
                        }else if($adminData->catagory == "Muktipedia Admin"){
                        echo " <label style='color: #ffff;background-color:seagreen;'>Muktipedia's Admin</label>";
                        }else{
                        echo " <label style='color: #ffff;background-color:dodgerblue;'>Account's Admin</label>";
                        }
                        ?>
                    <ul>
                        <li>Username : <span><?php echo $adminData->user_name ?></span></li>
                        <li>Email : <span><?php echo $adminData->email ?></span></li>
                        <li>Phone : <span><?php echo $adminData->phone ?></span></li>
                        <li>Address : <span><?php echo $adminData->address ?></span></li>
                        <li>Status :<?php if($adminData->softDelete =='Yes'){echo " <span style='color: tomato;'>Inactive</span>";}
                            else{
                                echo " <span style='color:lightseagreen;'>Active</span>";
                            }

                            ?></li>
                    </ul>

                    <?php if($AdminInfo->catagory == 'Super Admin') {?>
                        <div class="adminActivation">
                            <?php if($adminData->softDelete =='Yes') {
                                echo "<a href='Activateadmin.php?id=$adminData->id' class='btn btn-block btn-success'>Activate</a>";
                            }else{
                                echo "<a href='Deactivateadmin.php?id=$adminData->id' class='btn btn-block btn-warning'>Deactivate</a>";
                            }?>
                            <a href="" data-toggle="modal" data-target="#pop<?php echo $i?>" class="btn btn-block btn-danger">Delete</a>

                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <div class="modal fade" id="pop<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <button type="button" class="close closer" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span></button>
                    <p style="font-size: 1em; padding: 10px; margin: 0 auto; text-align: center">Delete <?php echo "<span style='color: tomato'>$adminData->name</span>" ?> Permanently?</p>
                    <a href='DeleteAdmin.php?id=<?php echo $adminData->id ?>' class="btn btn-default btn-block">Yes</a>
                </div>
            </div>
            </div>

   <?php
        $i++;
     }
    ?>



</div>
<?php
}else{
    include_once "AdminLoginForm.php";
}
?>
</body>
</html>