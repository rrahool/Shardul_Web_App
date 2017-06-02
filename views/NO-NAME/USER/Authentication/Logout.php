<?php
if(!isset($_SESSION) )session_start();
include_once('../../../../vendor/autoload.php');
use App\User\User;
use App\User\Auth;
use App\Message\Message;
use App\Utility\Utility;
use App\WareHouse\Authentication;


$auth= new Authentication();
$status= $auth->log_out();

session_destroy();
session_start();

Message::message("
                <div class=\"alert alert-success\">
                            <strong>Logout!</strong> You have been logged out successfully.
                </div>");
 Utility::redirect("../../../index.html");
