<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>শার্দূল</title>
    <link rel="stylesheet" href="../../../../resource/css/forms.css">
    <link rel="stylesheet" href="../../../../resource/css/bootstrap.min.css">
    <link href="../../../../resource/css/themify-icons.css" rel="stylesheet">
    <link href="../../../../resource/css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,700" rel="stylesheet">
</head>
<body>
<div class="container-fluid volSignUpWrap" id="volSignUpWrap">

    <div class="overlay"></div>

	<form action="Volunteer-Registration.php" method="post" enctype="multipart/form-data" id="VolSignUp" class="animated slideInDown">
        <h1>- স্বেচ্ছাসেবী নিবন্ধন -</h1>
        <div id="volunteerMsg"></div>
        <label for="highestEducation">মাধ্যমিক অথবা উচ্চ-মাধ্যমিক পরীক্ষা বাছাই করুণ</label><span class="error" > *</span>
        <select name="highestEducation" id="highestEducation">
            <option value="">Select Secondary or Higher secondary Exam</option>
            <option value="ssc">S.S.C</option>
            <option value="hsc">H.S.C</option>
        </select>
        <label for="passingYear">পাশের সাল দিন</label><span class="error" > *</span>
        <input type="number" min="0" max="9999" name="passingYear" placeholder="Passing Year." id="passingYear">

        <label for="roll">রোল নম্বর</label><span class="error" > *</span>
        <input type="text" name="roll"  placeholder="Roll No." id="roll">

        <button type="submit" class="volunteerPost pull-right" id="volunteerPost">জমা করুন</button>
        <a type="button" href="SignUp-LogIn-Form.php" class="prev" id="volunteerPost"><i class="ti-angle-left"></i><span>পূর্ববর্তী</span></a>
	</form>
</div>

<script src="../../../../resource/js/jquery.min.js"></script>
<script src="../../../../resource/js/bootstrap.min.js"></script>
<script src="../../../../resource/js/ajax_form.js"></script>
</body>
</html>