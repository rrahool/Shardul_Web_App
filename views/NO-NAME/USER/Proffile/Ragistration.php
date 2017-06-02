<?php
require_once ('../../../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\Authentication;
use App\WareHouse\UserStore;

if(!isset($_SESSION) )session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(
        isset($_POST["FirstName"]) &&
        isset($_POST["LastName"]) &&
        isset($_POST["Email"]) &&
        isset($_POST["UserName"]) &&
        isset($_POST["Password"]) &&
        isset($_POST["confirm_Password"]) &&
        isset($_POST["PhoneNumber"]) &&
        isset($_POST["BirthDate"]) &&
        isset($_POST["ADDRSS"]) &&
        isset($_POST["role"])) {

            $fname = $_POST["FirstName"];
            $lname = $_POST["LastName"];
            $mail = $_POST["Email"];
            $phn = $_POST["PhoneNumber"];
            $uname = $_POST["UserName"];
            $pass = $_POST["Password"];
            $ConPass = $_POST["confirm_Password"];
            $ADDRSS = $_POST["ADDRSS"];
            $newdate = date('Y-m-d',strtotime($_POST["BirthDate"]));
            $dob = $newdate;
            $role = $_POST["role"];


        $Data = array(
            'fname' => $fname,
            'lname' => $lname,
            'mail' => $mail,
            'phn' => $phn,
            'uname' => $uname,
            'pass' => $pass,
            'ADDRSS' => $ADDRSS,
            'dob' => $dob,
            'role' => $role
        );
        $_SESSION['Data'] = $Data;
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
            empty($role)
        ) {
            Message::setMessage2
            ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red'>All * fields are required !!</div>");
        } else {

            if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]).{6,}$/', $_POST['Password'])) {
                Message::setMessage2
                ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red'>please input atleast 1 char,1digit,1 specialchar and length should be minimum of 6 digit </div>");
            } else {
                if ($_POST["Password"] !== $_POST["confirm_Password"]) {
                    Message::setMessage2
                    ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red'>Passwords don't match</div>");
                }else {
                if (!preg_match("/^(?:\+88|01)?(?:\d{11}|\d{13})$/", $_POST['PhoneNumber'])) {
                    Message::setMessage2
                    ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red'>Invalid Phone Number !!!</div>");
                }else{

                $auth = new Authentication();
                $auth->setData($_POST);
                $status = $auth->is_exist();

                if ($status) {
                    Message::setMessage2
                    ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red''>The Email is Already in use !!</div>");
                } else {
                    $auth = new Authentication();
                    $auth->setData($_POST);
                    $status = $auth->is_userName_exist();
                    if($status){
                        Message::setMessage2
                        ("<div class='alert' style='color:#fff;  text-transform:Uppercase; background-color:red''>The User sName is Already in use !!</div>");
                    }else {

                        $obj = new UserStore();
                        $obj->setData($_POST);
                        $obj->store();
                    }
                    }
                }
            }
            }
        }
        if(!empty($_SESSION['message2'])){
            echo $_SESSION['message2'];
            unset($_SESSION['message2']);
        }else{
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }
}
