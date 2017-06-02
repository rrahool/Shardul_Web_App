<?php
require_once ('../../../vendor/autoload.php');
use App\Message\Message;
use App\WareHouse\Authentication;

if(!isset($_SESSION) )session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(
        isset($_POST["Fullname"]) &&
        isset($_POST["nid"]) &&
        isset($_POST["Email"]) &&
        isset($_POST["UserName"]) &&
        isset($_POST["Password"]) &&
        isset($_POST["confirm_Password"]) &&
        isset($_POST["PhoneNumber"]) &&
        isset($_POST["BirthDate"]) &&
        isset($_POST["address"]) &&
        isset($_POST["catagory"])) {

        $fname = $_POST["Fullname"];
        $lname = $_POST["nid"];
        $mail = $_POST["Email"];
        $phn = $_POST["PhoneNumber"];
        $uname = $_POST["UserName"];
        $pass = $_POST["Password"];
        $ConPass = $_POST["confirm_Password"];
        $newdate = date('Y-m-d',strtotime($_POST["BirthDate"]));
        $ADDRSS = $_POST["address"];
        $dob = $newdate;
        $catagory = $_POST["catagory"];

        if (
            empty($fname) ||
            empty($lname) ||
            empty($mail) ||
            empty($uname) ||
            empty($dob) ||
            empty($pass) ||
            empty($ConPass) ||
            empty($phn) ||
            empty($ADDRSS) ||
            empty($catagory)
        ) {
            Message::setMessage2
            ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>All * fields are required !!</div>");
        } else {

            if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]).{6,}$/', $_POST['Password'])) {
                Message::setMessage2
                ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>please input atleast 1 char,1 digit,1 special-char and length should be minimum of 6</div>");
            } else {
                if ($_POST["Password"] !== $_POST["confirm_Password"]) {
                    Message::setMessage2
                    ("<div class='alert' style='color:#fff; font-weight: 300; text-transform:Uppercase; background-color:tomato'>Passwords don't match</div>");
                }else {
                    if (!preg_match("/^(?:\+88|01)?(?:\d{11}|\d{13})$/", $_POST['PhoneNumber'])) {
                        Message::setMessage2
                        ("<div class='alert' style='color:#fff; font-weight: 300; text-transform:Uppercase; background-color:tomato'>Invalid Phone Number !!!</div>");
                    }else{

                        $auth = new Authentication();
                        $auth->setData($_POST);
                        $status = $auth->is_AdminEmail_exist();

                        if ($status) {
                            Message::setMessage2
                            ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>The Email is Already in use !!</div>");
                        } else {

                            $auth = new Authentication();
                            $auth->setData($_POST);
                            $status = $auth->is_AdminNid_exist();
                            if($status){
                                Message::setMessage2
                                ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>The NID is Already Registered!!</div>");
                            }else {


                            $auth = new Authentication();
                            $auth->setData($_POST);
                            $status = $auth->is_AdminName_exist();
                            if($status){
                                Message::setMessage2
                                ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>The User Name is Already in use !!</div>");
                            }else {

                                $obj = new \App\WareHouse\AdminStore();
                                $obj->setData($_POST);
                                $obj->store();
                            }
                        }
                        }
                    }
                }
            }
        }
    }else{
        Message::setMessage("Something Went Wrong! try agin later");
    }
    if(!empty($_SESSION['message2'])){
        echo $_SESSION['message2'];
        unset($_SESSION['message2']);
    }else{
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
