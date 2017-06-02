<!DOCTYPE HTML>
<html lang="en-US">
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
<div class="container-fluid BloodSignUpWrap" id="BloodSignUpWrap">

    <div class="overlay"></div>

    <form action="Blood_Donor-Registration.php" method="post" enctype="multipart/form-data" id="DonorSignup" class="animated slideInDown">
        <h1>- রক্তদাতার নিবন্ধন -</h1>

        <div  id="DonorMsg"></div>
        <label for="Bloodgroup">রক্তের গ্রুপ</label><span class="error" > *</span>
        <select name="Bloodgroup" id="bloodgroup">
            <option  value="">-- Please select your Blood Group--</option>
            <option  value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <label for="Zone">এলাকা</label><span class="error" > *</span>
        <select name="Zone" id="Addresszone">
            <option value="">-- Please select your zone--</option>
            <option  value="panchlaish">panchlaish</option>
            <option value="bayezid">bayezid</option>
            <option value="kotowali">kotowali</option>
            <option value="chandgaon">chandgaon</option>
            <option value="chawkbazar">chawkbazar</option>
            <option value="potenga">potenga</option>
        </select>
        <br>

        <label for="PreferableTime">কোন সময় আপনি রক্তদানে অভ্যস্ত ?</label><span class="error" > *</span>
        <select name="PreferableTime" id="Timezone">
            <option  value="">-- Please select your Preferable Time zone--</option>
            <option  value="TimeZone1">Morning To Noon</option>
            <option value="TimeZone2">Noon To Afternoon</option>
            <option value="TimeZone3">Afternoon To Evening</option>
            <option value="TimeZone4">Evening To Night</option>
            <option value="Anytime">Anytime</option>
        </select>
         <br>
        <label for="gender">লিঙ্গ ?</label><span class="error" > *</span>
        <select name="gender" id="Timezone">
            <option  value="">-- Please select your Gender--</option>
            <option  value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <br>

        <label for="LastDonateDate">শেষ রক্তদানের তারিখ ?</label>
        <input type="text" name="LastDonateDate" placeholder="Last Donate Date" id="LastDonation" autocomplete="off"><br>


        <button type="submit" class="DonatePost pull-right" id="DonatePost">জমা করুন</button>
        <a type="button" href="SignUp-LogIn-Form.php" class="prev" id="volunteerPost"><i class="ti-angle-left"></i><span>পূর্ববর্তী</span></a>
	</form>
</div>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/jquery-ui.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/ajax_form.js"></script>
<script src="../../../../resource/js/wickedpicker.js"></script>
<script>
    $(document).ready(function(){
        $(function() {
            $("#LastDonation").datepicker({
                dateFormat: "dd-MM-yy"
            });
        });
    });
</script>

</body>
</html>