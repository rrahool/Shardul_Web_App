$(document).ready(function () {
    $('#signUp_body form #message').hide();
    $('#signUp_body form').on('submit',function (e) {
        e.preventDefault();
        var firstName = $('#signUp_body form #FirstName').val();
        var lastName = $('#signUp_body form #LastName').val();
        var Email = $('#signUp_body form #Email').val();
        var userName = $('#signUp_body form #UserName').val();
        var Password = $('#signUp_body form #Password').val();
        var BirthDate = $('#signUp_body form #BirthDate').val();
        var PhoneNumber = $('#signUp_body form #phone').val();
        var ADDRSS = $('#signUp_body form #ADDRSS').val();
        var donortype = $('#signUp_body form #donortype').val();
        var formData = $('#GeneralSignUP').serializeArray();

        submitForm(formData);
    });

    function submitForm(formData) {
        $.ajax({
            type: 'POST',
            url: 'Ragistration.php',
            data: formData,
            cache: false,
            success: function (data) {
                console.log(data);
                if (data == 'Don') {
                    window.location = 'Blood_Donor-SignUp.php';
                } else if (data == 'Vol') {
                    window.location = 'volunteer-SignUp.php';
                } else {
                    $('#signUp_body form').removeClass("animated shake slideInDown");
                    $('#signUp_body form #message').removeClass().html(data).fadeIn('fast');
                    $('#signUp_body form').addClass("animated shake")
                }
            }
        });
    }
});

$(document).ready(function () {
        $('#BloodSignUpWrap form #DonorMsg').hide();
        $('#BloodSignUpWrap form').on('submit',function(e) {
            e.preventDefault();
            var bloodgroup = $('#BloodSignUpWrap form #bloodgroup').val();
            var Addresszone = $('#BloodSignUpWrap form #Addresszone').val();
            var Timezone = $('#BloodSignUpWrap form #Timezone').val();
            var LastDonation = $('#BloodSignUpWrap form #LastDonation').val();

            var DonorData = $('#DonorSignup').serializeArray();
            submitForm(DonorData);
        });

        function submitForm(DonorData) {

            $.ajax({
                type: 'POST',
                url: 'Blood_Donor-Registration.php',
                data: DonorData,
                cache: false,
                success: function(data) {
                    if (data =='ok') {
                        $('#BloodSignUpWrap form #DonorMsg').removeClass().html('<div class="alert alert-success animated bounceInDown">Congrats! Registration has been completed as Blood-Donor</div>').fadeIn('fast');
                    }else {
                        $('#BloodSignUpWrap form').removeClass("animated shake slideInDown");
                        $('#BloodSignUpWrap form #DonorMsg').removeClass().html(data).fadeIn('fast');
                        $('#BloodSignUpWrap form').addClass("animated shake")
                    }
                }
            });
        }
});


$(document).ready(function () {
    $('#volSignUpWrap form #volunteerMsg').hide();
    $('#volSignUpWrap form').on('submit',function(e) {
        e.preventDefault();
        var highestEducation = $('#volSignUpWrap form #highestEducation').val();
        var passingYear = $('#volSignUpWrap form #passingYear').val();
        var roll = $('#volSignUpWrap form #roll').val();

        var VolData = $('#VolSignUp').serializeArray();
        submitForm(VolData);

    });

    function submitForm(VolData) {

        $.ajax({
            type: 'POST',
            url: 'Volunteer-Registration.php',
            data: VolData,
            cache: false,
            success: function(data) {
                console.log(data);
                if (data =='ok') {
                    $('#volSignUpWrap form #volunteerMsg').removeClass().html('<div class="alert alert-success animated bounceInDown">Congrats! Registration has been completed as Volunteer</div>').fadeIn('fast');
                }else {
                    $('#volSignUpWrap form').removeClass("animated shake slideInDown");
                    $('#volSignUpWrap form #volunteerMsg').removeClass().html(data).fadeIn('fast');
                    $('#volSignUpWrap form').addClass("animated shake")
                }
            }
        });
    }
});


$(document).ready(function () {
    $('#AdminRegForm #message').removeClass().hide();
    $('#AdminRegForm').on('submit',function(e) {
        e.preventDefault();
        var Fullname = $('#AdminRegForm #Fullname').val();
        var nid = $('#AdminRegForm #nid').val();
        var Email = $('#AdminRegForm #Email').val();
        var UserName = $('#AdminRegForm #UserName').val();
        var Password = $('#AdminRegForm #Password').val();
        var BirthDate = $('#AdminRegForm #BirthDate').val();
        var phone = $('#AdminRegForm #phone').val();
        var address = $('#AdminRegForm #address').val();
        var Admintype = $('#AdminRegForm #Admintype').val();

        var AdminRegData = $('#AdminRegForm').serializeArray();
        submitForm(AdminRegData);

    });

    function submitForm(AdminRegData) {

        $.ajax({
            type: 'POST',
            url: 'Registration.php',
            data: AdminRegData,
            cache: false,
            success: function(data) {
                console.log(AdminRegData);
                if (data =='ok') {
                    $('#AdminRegForm').removeClass("animated shake");
                    location.reload();
                }else {
                    $('#AdminRegForm').removeClass("animated shake slideInDown");
                    $('#AdminRegForm #message').removeClass().html(data).fadeIn('fast');
                    $('#AdminRegForm').addClass("animated shake");
                }
            }
        });
    }
});


$(document).ready(function () {
    $('#AdminLogin #Login_message').removeClass().hide();
    $('#AdminLogin').on('submit',function(e) {
        e.preventDefault();
        var Fullname = $('#AdminLogin #UserName').val();
        var nid = $('#AdminLogin #Password').val();

        var AdminLogData = $('#AdminLogin').serializeArray();
        submitForm(AdminLogData);

    });

    function submitForm(AdminLogData) {

        $.ajax({
            type: 'POST',
            url: 'loginprocess.php',
            data: AdminLogData,
            cache: false,
            success: function(data) {
                console.log(AdminLogData);
                console.log(data);
                if (data =='Adminok') {
                    $('#AdminLogin').removeClass("animated shake");
                    window.location = 'index.php';
                }else {
                    $('#AdminLogin').removeClass("animated shake slideInDown");
                    $('#AdminLogin #Login_message').removeClass().html(data).fadeIn('fast');
                    $('#AdminLogin').addClass("animated shake");
                }
            }
        });
    }
});


$(document).ready(function () {
    $('#UserLoginForm #UserLoginMsg').removeClass().hide();
    $('#UserLoginForm').on('submit',function(e) {
        e.preventDefault();
        var UserName = $('#UserLoginForm #UserName').val();
        var Password = $('#UserLoginForm #Password').val();

        var UserLogData = $('#UserLoginForm').serializeArray();
        submitForm(UserLogData);

    });

    function submitForm(UserLogData) {

        $.ajax({
            type: 'POST',
            url: '../views/NO-NAME/USER/Authentication/Login.php',
            data: UserLogData,
            cache: false,
            success: function(data) {
                console.log(UserLogData);
                console.log(data);
                if (data =='VolUser') {
                    $('#UserLoginForm').removeClass("animated shake");
                    window.location = '../views/NO-NAME/USER/Proffile/VolunteerProfile.php';
                }else if(data =='DonUser'){
                    $('#UserLoginForm').removeClass("animated shake");
                    window.location = '../views/NO-NAME/USER/Proffile/Blood_Donor_Profile.php';
                } else {
                    $('#UserLoginForm').removeClass("animated shake slideInDown");
                    $('#UserLoginForm #UserLoginMsg').removeClass().html(data).fadeIn('fast');
                    $('#UserLoginForm').addClass("animated shake");
                }
            }
        });
    }
});