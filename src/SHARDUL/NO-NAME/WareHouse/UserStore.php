<?php


namespace App\WareHouse;
use App\User\User;
use App\User\Auth;
use App\Message\Message;
use App\Utility\Utility;
use PDO;


class UserStore extends User
{


    public function store(){
        if (!empty($this->firstName) && !empty($this->lastName) && !empty($this->email) && !empty($this->password) && !empty($this->address))
        {
            if($this->role=="Volunteer"){
                Message::message("Vol");
            }
            else if($this->role=="BloodDonor"){
                Message::message("Don");
            }

            else {
                Message::setMessage("<div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>Choose your Role !!!</div>");
            }

        }
    }

    public function view2(){
        $query=" SELECT * FROM user WHERE user_name  ='".$_SESSION['UserName']."'";
        $STH =$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
       // $userData = $STH->fetch();

        //return $STH->fetch();

        $userTableData = $STH->fetch();
        $role = $userTableData->role;
        $userID = $userTableData->id;
        if($role="BloodDonor"){
            $query1=" SELECT * FROM blood_doner WHERE user_id  =".$userID;
        } else if($role="Volunteer"){
            $query1=" SELECT * FROM volunteer WHERE user_id  =".$userID;
        }
        $STH =$this->dbh->query($query1);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        //return $userData;
        return $STH->fetch();

        /*if ($result){

            echo "available";
        }

        else {

            echo "already exist";
        }*/


    }

    public function view()
    {
        $query = " SELECT * FROM user WHERE user_name  ='" . $_SESSION['UserName'] . "'";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }

    public function update(){
        $arrData = array($this->firstName, $this->lastName, $this->email, $this->phone,$this->password, $this->address, $this->birthdate);
        $query = "UPDATE user SET firstname=?,lastname=?,email=?,phone=?,password=?,address=?,dob=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);

        $result = $STH->execute($arrData);
        if($result){

            echo "done";
             Utility::redirect("Blood_Donor_Profile.php");

        }
        else {

            echo "not done";
            return Utility::redirect($_SERVER['HTTP_REFERER']);

        }

    }



    public function UserIDTaking(){
        $query=" SELECT id FROM user WHERE email = '$this->email' ";
        // Utility::dd($query);
        $STH =$this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }


}