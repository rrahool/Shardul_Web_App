<?php
namespace App\WareHouse;
use App\Admin\Admin;
use App\Message\Message;
use App\Utility\Utility;
use PDO;


class AdminStore extends Admin
{

    public function store()
    {
        if (!empty($this->fullname) && !empty($this->nid) && !empty($this->email) && !empty($this->username) && !empty($this->password) && !empty($this->birthdate) && !empty($this->phone) && !empty($this->address) && !empty($this->catagory)) {
            $arrayData = array($this->fullname, $this->nid, $this->email, $this->birthdate, $this->address, $this->username, $this->password, $this->catagory, $this->phone);
            $query = "INSERT INTO admin(name,nid,email,dob,address,user_name,password,catagory,phone) VALUES(?,?,?,?,?,?,?,?,?)";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);

            if ($result) {
                unset($_SESSION['Data']);
                unset($_SESSION['message']);
                unset($_SESSION['message2']);
                Message::message("ok");
            } else {
                Message::message("
                        <div class=\"alert alert-danger\"><strong>Sorry!</strong>Can not be stored at the moment</div>");
            }

        } else {
            Message::setMessage("<div class='alert' style='color:#fff; text-transform:Uppercase; background-color:tomato'>All * field Are required</div>");
        }

    }


    public function view()
    {
        $query = " SELECT * FROM user WHERE email = '$this->email' ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();

        $result = $STH->fetch();

        if ($result) {

            echo "available";
        } else {

            echo "already exist";
        }


    }

    public function UserIDTaking()
    {
        $query = " SELECT id FROM user WHERE email = '$this->email' ";
        // Utility::dd($query);
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }


    public function AdminIndex()
    {
        $AdminID = $_SESSION['Admin'];
        $query = " SELECT * FROM admin WHERE id = '$AdminID'";
        // Utility::dd($query);
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }

    public function GetAdmin()
    {
        $query = " SELECT * FROM admin WHERE catagory = 'Volunteer Admin' || catagory = 'Donor Admin' || catagory = 'Account Admin' || catagory = 'Muktipedia Admin'";
        // Utility::dd($query);
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetchAll();
    }

    public function Activateadmin()
    {
        $arrayData = array('No');
        $query = "UPDATE `admin` SET `softDelete`=?  WHERE id=" . $this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Utility::redirect('index.php');
        } else {
            var_dump($query);
        }
    }


    public function Deactivateadmin()
    {
        $arrayData = array('Yes');
        $query = "UPDATE `admin` SET `softDelete`=?  WHERE id=" . $this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Utility::redirect('index.php');
        } else {
            var_dump($query);
        }
    }

    public function DeleteAdmin()
    {
        $query = "DELETE FROM `admin` WHERE id=" . $this->id;
        $result = $this->dbh->exec($query);
        if ($result) {
            Utility::redirect("index.php");
        } else {
            var_dump($query);
        }
    }

    public function UpdateAdmin(){
        $arrayData = array($this->fullname,$this->email,$this->username,$this->password,$this->phone);
        $query = "UPDATE admin SET name=?,email=?,user_name=?,password=?,phone=?  WHERE id=" .$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Utility::redirect('index.php');
        } else {
            var_dump($query);
        }
    }

}