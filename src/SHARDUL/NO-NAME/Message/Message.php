<?php
namespace App\Message;

if(isset($_POST['submit'])) {
    if (!isset($_SESSION['message'])) session_start();
}


class Message{
    public static function message($message=NULL)
    {
        if (is_null($message)) {
            $_message = self::getMessage();
            return $_message;
        }
        else {
            self::setMessage($message);
        }
    }

    public static function setMessage($message){
           $_SESSION['message']=$message;
    }
    public static function getMessage(){
           if(isset($_SESSION['message'])) $_message= $_SESSION['message'];
           else $_message='';

         $_SESSION['message']="";
            return $_message;

        }


    public static function message2($message2=NULL)
    {
        if (is_null($message2)) {
            $_message2 = self::getMessage2();
            return $_message2;
        }
        else {
            self::setMessage2($message2);
        }
    }



    public static function setMessage2($message2){
        $_SESSION['message2']=$message2;
    }



    public static function getMessage2(){
        if(isset($_SESSION['message2'])) $_message2= $_SESSION['message2'];
        else $_message2='';

        $_SESSION['message2']="";
        return $_message2;

    }

}