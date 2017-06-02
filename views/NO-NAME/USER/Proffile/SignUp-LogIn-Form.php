<?php
require_once ('../../../../vendor/autoload.php');
session_start();
if(isset($_SESSION['Data'])){
    $Data = $_SESSION['Data'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>শার্দূল</title>
    <link rel="stylesheet" href="../../../../resource/css/forms.css">
    <link rel="stylesheet" href="../../../../resource/css/bootstrap.min.css">
    <link href="../../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../../resource/css/animate.css" rel="stylesheet">
    <link href="../../../../resource/css/jquery-ui.css" rel="stylesheet">
    <link href="../../../../resource/css/wickedpicker.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>

<div class="container-fluid signUp_form" id="signUp_body">
    <div class="overlay"></div>
    <form action="Ragistration.php" method="post" class="animated slideInDown" id="GeneralSignUP">
        <h1>- শার্দূল নিবন্ধন -</h1>
        <div  id="message"></div>
        <label for="FirstName">নামের প্রথম অংশ</label><span class="error" id="require"> *</span>
        <input type="text" name="FirstName" placeholder="firstname" id="FirstName" value="<?php if(isset($Data['fname']))echo $Data['fname'];?>">

        <label for="LastName">নামের শেষ অংশ</label><span class="error" id="require"> *</span>
        <input type ="text" name="LastName" placeholder="lastname" id="LastName" value="<?php if(isset($Data['lname']))echo $Data['lname'];?>">

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
        <input type="text" name="BirthDate" placeholder="Date Of Birthday" id="BirthDate" value="<?php if(isset($Data['dob']))echo $Data['dob'];?>">

        <label for="PhoneNumber">ফোন নম্বর</label><span class="error" > *</span>
        <span id="pmassage"style="float: right"></span>
        <input type="tel" name="PhoneNumber" placeholder="phonenumber" id="phone" value="<?php if(isset($Data['phn']))echo $Data['phn'];?>">

        <label for="ADDRSS">ঠিকানা</label><span class="error" > *</span>
        <input type="text" name="ADDRSS" placeholder="address" id="ADDRSS" value="<?php if(isset($Data['ADDRSS']))echo $Data['ADDRSS'];?>">

        <label for="">কি হতে চান?</label><span class="error" > *</span>
        <select name="role" id="donortype">
            <option  name="noselect">-- Please select your Role--</option>
            <option  value="Volunteer" <?php if(isset($Data['role']) && $Data['role'] == "Volunteer")echo "selected";?>>A Volunteer</option>
            <option value="BloodDonor" <?php if(isset($Data['role']) && $Data['role'] == "BloodDonor")echo "selected";?>>A Blood Donor</option>
        </select>

        <button type="submit" name="Next" class="next" id="signup2next"><span>পরবর্তী</span><i class="ti-angle-right"></i></button>
</form>
</div>


<!--- <div class="col-xs-12 col-sm-12- col-md-6 col-lg-6">


        <form action="../Authentication/Login.php" method="post">



            <h6>LOG-IN</h6>
            <div id="disp"></div><br />
            <input type="email" name="Email" placeholder="email" id="frm">

            <br>
            <input type="password" name="Password" placeholder="password" id="frm">
            <br>

            <input type="submit" name="submit" id="frm" >

        </form>

 </div> ---->



<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/ajax_form.js"></script>
<script src="../../../../resource/js/jquery-ui.js"></script>
<script src="../../../../resource/js/wickedpicker.js"></script>

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
            $('#msg').html('Password matched').css('color', 'green');
        } else $('#msg').html('Password not matched').css('color', 'red');
    });
    //for password matching end


    //phone number authentication
    $(document).ready(function() {
        $('#phone').keyup(function(e) {
            if (validatePhone('phone')) {
                $('#pmassage').html('Valid');
                $('#pmassage').css('color', 'green');
            }
            else {
                $('#pmassage').html('Invalid');
                $('#pmassage').css('color', 'red');
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

    })

    $(document).ready(function(){
        $(function() {
            $("#BirthDate").datepicker({
                dateFormat: "dd-MM-yy"
            });
        });
    });
</script>
</body>
</html>
