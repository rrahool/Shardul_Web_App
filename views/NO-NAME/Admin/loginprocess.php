<?php
require_once ('../../../vendor/autoload.php');
use App\WareHouse\Authentication;
use App\Utility\Utility;
use App\Message\Message;
use App\WareHouse\AdminStore;


if(!isset($_SESSION) )session_start();

if(empty($_POST['UserName']) && empty($_POST['Password'])){
    Message::setMessage
    ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>Fields Can not be Empty</div>");
}elseif (!empty($_POST['UserName']) && empty($_POST['Password'])){
    Message::setMessage
    ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>Password Can not be Empty</div>");
}elseif (empty($_POST['UserName']) && !empty($_POST['Password'])){
    Message::setMessage
    ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>Username Can not be Empty</div>");
}else {
    $objNewAuth = new Authentication();
    $objNewAuth->setData($_POST);
    $AdminInfo = $objNewAuth->is_Admin_registered();
    if ($AdminInfo) {
        foreach ($AdminInfo as $info) {
            $Admin = $info->id;
            if (!empty($Admin)) {
                $_SESSION['Admin'] = $Admin;
                Message::setMessage("Adminok");
            }
        }
    } else {
        Message::setMessage
        ("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>No Admin Found By this name</div>");
    }
}
if(!empty($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}