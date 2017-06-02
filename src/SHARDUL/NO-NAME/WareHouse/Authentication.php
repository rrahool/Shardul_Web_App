<?php

namespace App\WareHouse;
use App\User\Auth;
use App\User\User;
use App\Message\Message;
use App\Utility\Utility;
use PDO;


class Authentication extends Auth
{


    public function is_exist()
    {

        $query = "SELECT * FROM user WHERE email  ='$this->email'";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();

        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function is_registered()
    {
        $query = "SELECT * FROM user   WHERE  email ='$this->email' AND password ='$this->password'";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();
        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function is_registered_username()
    {
        $query = "SELECT * FROM user   WHERE  user_name ='$this->userName' AND password ='$this->password'";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();
        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }



    public function logged_in()
    {
        if ((array_key_exists('UserName', $_SESSION)) && (!empty($_SESSION['UserName']))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function log_out()
    {
        $_SESSION['UserName'] = "";
        return TRUE;
    }

    public function is_userName_exist(){
        $query="SELECT * FROM user WHERE user_name ='$this->userName'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();

        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function is_AdminEmail_exist(){

        $query="SELECT * FROM admin WHERE email  ='$this->email'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();

        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }




    public function is_AdminName_exist(){

        $query="SELECT * FROM admin WHERE user_name ='$this->userName'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();

        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function is_AdminNid_exist(){

        $query="SELECT * FROM admin WHERE nid ='$this->nid'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $STH->fetchAll();

        $count = $STH->rowCount();

        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function Admin_logged_in(){
        if (isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function Admin_log_out(){
        session_start();
        if (isset($_SESSION['Admin']) && !empty($_SESSION['Admin'])) {
            unset($_SESSION['Admin']);
            Utility::redirect('AdminLoginForm.php');
        }
    }





    public function is_Admin_registered(){
        $query = "SELECT * FROM admin WHERE  user_name ='$this->userName' AND password ='$this->password' AND softDelete ='No'";
        $STH=$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $count = $STH->rowCount();
        if ($count == 1) {
            return $STH->fetchAll();
        } else {
            return FALSE;
        }
    }







    public function is_availble(){

        if(isset($_POST["Email"]))
        {
            $Email = filter_var($_POST["Email"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

            $STH = $this->dbh->prepare("SELECT Email FROM user WHERE email='$this->email'");
            $STH->bindParam('s', $Email);
            $STH->execute();
            $STH->bindValue('s',$Email);

            if($STH->fetch()){

                die('<span style="color: tomato; float: right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;This Email is already registered</span>');

            }else{

                die('<span style="color: lightseagreen; float: right""><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: lightseagreen"></span>&nbsp;Email is available</span>');

            }






            /*$query= $this->dbh->prepare("SELECT email FROM user_info WHERE email='$this->email'");
            var_dump($query);
            $STH=$this->dbh->query($query);
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $STH->fetch();
            if($STH->fetch()){
                die('<img src="public/images/not-available.png" />');
            }else{
                die('<img src="public/images/available.png" />');
            }*/
        }

    }



    public function is_username_available()
    {

        if (isset($_POST["UserName"])) {
            $Username = filter_var($_POST["UserName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

            $STH = $this->dbh->prepare("SELECT user_name FROM user WHERE user_name='$this->userName'");
            $STH->bindParam('s', $Username);
            $STH->execute();
            $STH->bindValue('s', $Username);

            if($STH->fetch()){

                die('<span style="color: tomato; float: right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;The Username is not available</span>');

            }else{

                die('<span style="color: lightseagreen; float: right""><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: lightseagreen"></span>&nbsp;Available</span>');

            }
        }

    }




    public function is_AdminName_available()
    {

        if (isset($_POST["UserName"])) {
            $Username = filter_var($_POST["UserName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

            $STH = $this->dbh->prepare("SELECT user_name FROM admin WHERE user_name='$this->userName'");
            $STH->bindParam('s', $Username);
            $STH->execute();
            $STH->bindValue('s', $Username);

            if($STH->fetch()){

                die('<span style="color: tomato; float: right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;The Username is not available</span>');

            }else{

                die('<span style="color: lightseagreen; float: right""><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: lightseagreen"></span>&nbsp;Available</span>');

            }
        }

    }

    public function is_AdminEmailavailble(){

        if(isset($_POST["Email"]))
        {
            $Email = filter_var($_POST["Email"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

            $STH = $this->dbh->prepare("SELECT Email FROM admin WHERE email='$this->email'");
            $STH->bindParam('s', $Email);
            $STH->execute();
            $STH->bindValue('s',$Email);

            if($STH->fetch()){

                die('<span style="color: tomato; float: right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;This Email is already registered</span>');

            }else{

                die('<span style="color: lightseagreen; float: right""><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: lightseagreen"></span>&nbsp;Email is available</span>');

            }






            /*$query= $this->dbh->prepare("SELECT email FROM user_info WHERE email='$this->email'");
            var_dump($query);
            $STH=$this->dbh->query($query);
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $STH->fetch();
            if($STH->fetch()){
                die('<img src="public/images/not-available.png" />');
            }else{
                die('<img src="public/images/available.png" />');
            }*/
        }

    }


}