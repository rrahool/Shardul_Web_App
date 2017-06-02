<?php
require_once ('../../../vendor/autoload.php');
use App\WareHouse;
ob_start();
if(isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])) {
    $objAdminInfo = new WareHouse\AdminStore();
    $AdminInfo = $objAdminInfo->AdminIndex();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শার্দূল</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../../resource/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link href="../../../resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../resource/css/animate.css" rel="stylesheet">
    <link href="../../../resource/css/adminpanel.css" rel="stylesheet">
    <link href="../../../resource/css/forms.css" rel="stylesheet">
    <link href="../../../resource/css/jquery-ui.css" rel="stylesheet">
    <link href="../../../resource/css/wickedpicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>

<body>
<div class="main-wrap ">
    <div class="panel-wrap">
        <div class="brand">
            <img src="../../../resource/img/logo.png" alt="" class="logo" style="width:100px;">
        </div>
        <div class="user-hold">
            <img src="../../../resource/img/admin/pro-pic/admin.png" style=" width:80px; height:80px;" class="img-circle" alt="">
        </div>
        <div class="option-wrap">
                <ul>
                    <li class="dashTab active"><a href="index.php"><i class="ti-home"></i>Home</a></li>
                    <li class="dashTab"><a href="Donors.php"><i class="ti-heart"></i>Donors</a></li>
                    <li class="dashTab"><a href="volunteers.php"><i class="ti-hand-open"></i>Volunteers</a></li>
                    <li class="dashTab"><a href="muktipidea.php"><i class="ti-flag-alt-2"></i>Muktipedia</a></li>
                    <li class="dashTab"><a href=""><i class="ti-money"></i>Accounts</a></li>
                    <li class="dashTab"><a href=""><i class="ti-bell"></i>Notification</a></li>
                    <li class="dashTab"><a href=""><i class="ti-announcement"></i>Events</a></li>
                </ul>
        </div>
    </div>
    <div class="content-wrap">
        <header>
            <a href="#" class="menu pull-left">
                <span id="span"></span>
            </a>

            <div class="just_info">
                <ul>
                    <li><i class="ti-email"></i>&nbsp;<?php echo $AdminInfo->email ?></li>
                    <li><i class="ti-mobile"></i>&nbsp;<?php echo $AdminInfo->phone ?></li>
                </ul>
            </div>

            <div class="dropdown pull-right settings">
                <img src="../../../resource/img/admin/pro-pic/admin.png" style="height: 40px; display: inline-block" class="img-responsive img-circle" alt="">
                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Settings">
                    <p class="hidden-xs"><?php echo $AdminInfo->user_name ?>&nbsp;<span class="fa fa-caret-down fa-s15"></span></p>
                </button>
                <ul class="dropdown-menu animated swing" aria-labelledby="dLabel">
                    <li><a href="#editForm" data-toggle="modal">Update Profile</a></li>
                    <?php if($AdminInfo->catagory =="Super Admin"){?>
                    <li>
                        <a href="#AddForm"  data-toggle="modal">Add Admin</a>
                    </li>
                    <?php } ?>
                    <hr>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Button trigger modal
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="AddForm" tabindex="-1" catagory="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" catagory="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <form action="Registration.php" method="post" class="AdminRegForm" id="AdminRegForm">
                            <h1>- এডমিন নিয়োগ -</h1>
                            <div  id="message"></div>
                            <label for="Fullname">পুর্ন নাম</label><span class="error" id="require"> *</span>
                            <input type="text" name="Fullname" placeholder="Fullname" id="Fullname" value="<?php if(isset($Data['fname']))echo $Data['fname'];?>">

                            <label for="nid">জাতীয় পরিচয়পত্র নম্বর</label><span class="error" id="require"> *</span>
                            <input type ="number" min="0"  name="nid" placeholder="National ID No." id="nid" value="<?php if(isset($Data['lname']))echo $Data['lname'];?>">

                            <label for="Email">ই-মেইল</label><span class="error" id="require"> *</span><span id="email-result" class="error1"></span>
                            <input type="email" name="Email" placeholder="email" id="Email" value="<?php if(isset($Data['mail']))echo $Data['mail'];?>" autocomplete="off">

                            <label for="UserName">একাউন্ট এর নাম</label><span class="error" id="require"> *</span><span id="username-result" class="error1"></span>
                            <input type ="text" name="UserName" placeholder="username" id="UserName" value="<?php if(isset($Data['uname']))echo $Data['uname'];?>" autocomplete="off">

                            <label for="Password">পাসওয়ার্ড</label><span class="error" id="require"> *</span><span class="error1" id="req" style="float: right"></span>
                            <input type="password" name="Password" placeholder="password" id="Password" value="<?php if(isset($Data['pass']))echo $Data['pass'];?>">

                            <label for="confirm_Password">পাসওয়ার্ড পূনঃ প্রদান</label><span class="error" > *</span>
                            <span id="msg" style="float: right;"></span>
                            <input type="password" name="confirm_Password" placeholder="confirm password" id="confirm" value="<?php if(isset($Data['pass']))echo $Data['pass'];?>">

                            <label for="BirthDate">জন্ম তারিখ</label><span class="error" > *</span>
                            <input type="text" name="BirthDate" placeholder="Date Of Birth" id="BirthDate" value="<?php if(isset($Data['dob']))echo $Data['dob'];?>">

                            <label for="PhoneNumber">ফোন নম্বর</label><span class="error" > *</span>
                            <span id="pmassage" style="float: right"></span>
                            <input type="tel" name="PhoneNumber" placeholder="phonenumber" id="phone" value="<?php if(isset($Data['phn']))echo $Data['phn'];?>">

                            <label for="address">ঠিকানা</label><span class="error" > *</span>
                            <input type="text" name="address" placeholder="address" id="address" value="<?php if(isset($Data['address']))echo $Data['address'];?>">

                            <label for="catagory">পদ বাছাই করুন</label><span class="error" > *</span>
                            <select name="catagory" id="Admintype">
                                <option value="">-- Please select a catagory--</option>
                                <option value="Super Admin">Super Admin</option>
                                <option  value="Volunteer Admin" <?php if(isset($Data['catagory']) && $Data['catagory'] == "Volunteer")echo "selected";?>>Admin for Volunteers</option>
                                <option value="Donor Admin" <?php if(isset($Data['catagory']) && $Data['catagory'] == "BloodDonor")echo "selected";?>>Admin for Blood Donors</option>
                                <option value="Muktipedia Admin" <?php if(isset($Data['catagory']) && $Data['catagory'] == "BloodDonor")echo "selected";?>>Admin for Muktipedia</option>
                                <option value="Account Admin" <?php if(isset($Data['catagory']) && $Data['catagory'] == "BloodDonor")echo "selected";?>>Admin for Accounts</option>
                            </select>

                            <button type="submit" class="AdminSignUp" id="AdminSignUp"><span>নিয়োগ</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="editForm" tabindex="-1" catagory="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" catagory="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <form action="Blood_Admin_profile-update.php" method="post" class="AdminRegForm" id="AdminRegForm">
                            <div  id="message"></div>
                            <label for="Fullname"> নাম</label><span class="error" id="require"> *</span>
                            <input type="text" name="Fullname" placeholder="Fullname" id="Fullname" value="<?php echo $AdminInfo->name;?>">

                            <label for="Email">ই-মেইল</label><span class="error" id="require"> *</span><span id="email-result" class="error1"></span>
                            <input type="email" name="Email" placeholder="email" id="Email" value="<?php echo $AdminInfo->email;?>" autocomplete="off">

                            <label for="UserName">ইউজার নাম</label><span class="error" id="require"> *</span><span id="username-result" class="error1"></span>
                            <input type ="text" name="UserName" placeholder="username" id="UserName" value="<?php echo $AdminInfo->user_name;?>" autocomplete="off">

                            <label for="Password">পাসওয়ার্ড</label><span class="error" id="require"> *</span><span class="error1" id="req" style="float: right"></span>
                            <input type="text" name="Password" placeholder="password" id="Password" value="<?php echo $AdminInfo->password;?>">

                            <label for="PhoneNumber">ফোন নম্বর</label><span class="error" > *</span>
                            <span id="pmassage" style="float: right"></span>
                            <input type="tel" name="PhoneNumber" placeholder="phonenumber" id="phone" value="<?php echo $AdminInfo->phone;?>">

                            <input type="hidden" name="id" value="<?php echo $AdminInfo->id;?>">

                            <button type="submit" class="AdminSignUp" id="AdminSignUp"><span>সংশোধন</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>






        <script src="../../../resource/js/jquery.min.js"></script>
        <script src="../../../resource/js/bootstrap.min.js"></script>
        <script src="../../../resource/js/ajax_form.js"></script>
        <script src="../../../resource/js/jquery-ui.js"></script>
        <script src="../../../resource/js/wickedpicker.js"></script>

        <script type="text/javascript">
            $(document).ready(function() { //email start
                var x_timer;
                $("#Email").bind('click keyup',(function (e){
                    clearTimeout(x_timer);
                    var Email = $(this).val();
                    x_timer = setTimeout(function(){
                        check_Email_ajax(Email);
                    }, 1500);
                }));

                function check_Email_ajax(Email){
                    $.post('validation.php', {'Email':Email}, function(data) {
                        $("#email-result").html(data);
                    });
                }
            });

            $(document).ready(function() {
                var x_timer;
                $("#UserName").bind('click keyup',(function (e){
                    clearTimeout(x_timer);
                    var UserName = $(this).val();
                    x_timer = setTimeout(function(){
                        check_UserName_ajax(UserName);
                    }, 1500);
                }));

                function check_UserName_ajax(UserName){
                    $("#username-result").html('<img src="../icons/ajax-loader.gif" />');
                    $.post('validation.php', {'UserName':UserName}, function(data) {
                        $("#username-result").html(data);
                    });
                }
            });




            $(function() {  // password character/digit/letter requirement start
                $('#Password').keyup(function () {
                    $(this)($("#req").html( this.value.match(/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{6,}$/) ?
                        "Meets the criteria" : "Atleast one character, special Character & 6 Digits"));
                })
            }); // password password character/digit/letter requirement end


            //for password matching start
            $('#confirm').on('keyup', function () {
                if ($(this).val() == $('#Password').val()) {
                    $('#msg').html('Password matched').css('color', 'lightseagreen');
                } else $('#msg').html('Password not matched').css('color', 'tomato');
            });
            //for password matching end


            //phone number authentication
            $(document).ready(function() {
                $('#phone').keyup(function(e) {
                    if (validatePhone('phone')) {
                        $('#pmassage').html('Valid');
                        $('#pmassage').css('color', 'lightseagreen');
                    }
                    else {
                        $('#pmassage').html('Invalid');
                        $('#pmassage').css('color', 'tomato');
                    }
                });
            });

            function validatePhone(phone) {
                var a = document.getElementById(phone).value;
                var filter = /^(?:\+88|01)?(?:\d{11}|\d{13})$/;
                if (filter.test(a)) {
                    return true;
                }
                else {
                    return false;
                }
            }     //phone number authentication end

            jQuery(function($) {
                $('#message').fadeOut (550);
                $('#message').fadeIn (550);
                $('#message').fadeOut (550);
                $('#message').fadeIn (550);
                $('#message').fadeOut (550);

            });

            $(document).ready(function(){
                $(function() {
                    $("#BirthDate").datepicker({
                        dateFormat: "dd-MM-yy"
                    });
                });
            });

            $(function() {
                $(".menu").click(function(e) {
                    e.preventDefault();
                    $(".panel-wrap").toggleClass("display");
                    $("#span").toggleClass("display")
                });
            });

            $(function() {
                $(".more-opts").click(function(e) {
                    e.preventDefault();
                    $(".mini-pan").toggleClass("display")
                });
            });

            $(document).ready(function(){
                $(".dashTab a").click(function() {
                    $(this).parent().addClass('active').siblings().removeClass('active');
                });
            });


        </script>


</body>
</html>