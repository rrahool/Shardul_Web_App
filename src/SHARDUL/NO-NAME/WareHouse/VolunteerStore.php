<?php

namespace App\WareHouse;
use App\Volunteer\Volunteer;
use App\Message\Message;
use App\Utility\Utility;
use PDO;

class VolunteerStore extends Volunteer
{
    public function store(){
        if(!empty($this->highestEducation) && !empty($this->passingYear) && !empty($this->roll)){

            session_start();
            if (isset($_SESSION['Data']) && !empty($_SESSION['Data'])) {

                $Data = $_SESSION['Data'];

                if(
                    !empty($Data['fname'] && !empty($Data['lname'])) && !empty($Data['mail']) &&
                    !empty($Data['phn'] && !empty($Data['uname'])) && !empty($Data['pass']) &&
                    !empty($Data['ADDRSS'] && !empty($Data['dob'])) && !empty($Data['role'])

                ){


                    $Data = $_SESSION['Data'];
                    $arrayData = implode("','",$Data);
                    $query = "INSERT INTO  user (firstname,lastname,email,phone,user_name,password,address,dob,role) VALUES ('$arrayData')";
                    $STH = $this->dbh->prepare($query);
                    $result = $STH->execute($Data);
                    if ($result) {

                        $obj = new UserStore();
                        $obj->setEmail($Data['mail']);
                        $userID = $obj->UserIDTaking();


                        $arrayData = array($userID->id,$this->highestEducation, $this->passingYear, $this->roll);

                        $query = "INSERT INTO volunteer(user_id,highest_education,passing_year,roll) VALUES(?,?,?,?)";
                        $STH = $this->dbh->prepare($query);
                        $result = $STH->execute($arrayData);
                        if ($result) {
                            unset($_SESSION['Data']);
                            unset($_SESSION['message']);
                            unset($_SESSION['message2']);
                            Message::message("ok");

                        } else {
                            Message::message("<div class=\"alert alert-danger\"><strong>Sorry!</strong>Can not be stored at the moment</div>");
                        }


                    } else {
                        Message::message("<div class=\"alert alert-danger\"><strong>oops!</strong> Something Went Wrong</div>");
                    }

                } else {
                    Message::message("<div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>Please complete preceding Step</div>");
                }


            } else {
                Message::message("<div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>Please complete previous Step</div>");
            }

        }else {
            Message::message("<div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>All * fields are required !!</div>");
        }
        if(!empty($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            echo $_SESSION['message2'];
            unset($_SESSION['message2']);
        }
    }

    public function VolunteerProfileInfo(){
        $sql = "SELECT * from  volunteer where user_id=" .$this->userID;
        $STH = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }

    public function index()
    {
        try {
            $sql = "SELECT user.*,volunteer.* FROM user,volunteer WHERE user.id=volunteer.user_id ORDER BY volunteer.id DESC";
            $STH = $this->dbh->query($sql);
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $arrAllData = $STH->fetchAll();
            return $arrAllData;
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    }


    public function indexPaginator($page=1, $DataPerPage=3){

        $start = (($page-1) * $DataPerPage);
        if($start<0) $start=0;
        $sql = "SELECT user.*,volunteer.* FROM user,volunteer  WHERE user.id=volunteer.user_id LIMIT $start,$DataPerPage";

        $STH = $this->dbh->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }



    public function search($requestArray){
        $sql = "";

        if( isset($requestArray['Bloodgroup']) && isset($requestArray['Zone']) )
            $sql = "SELECT user.phone,volunteer.* FROM user,volunteer WHERE volunteer.softDelete ='No' AND user.id=volunteer.user_id AND  (blood_group  LIKE '%".$requestArray['Bloodgroup']."%'
        AND area_zone  LIKE '%".$requestArray['Zone']."%')";
        if(!isset($requestArray['Bloodgroup']) && !isset($requestArray['Zone']))
        {
            Message::message("<div class='no'>Incomplete Search</div>");
            Utility::redirect('BLoodUserHomePage.php');
        }


        $STH  = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $Data2view = $STH->fetchAll();

        return $Data2view;

    }// end of search()



    public function searchForAdmin($requestArray){

        $sql = "";

        if( isset($requestArray['Bloodgroup']) && isset($requestArray['Zone']) )
            $sql = "SELECT user.*,volunteer.* FROM user,volunteer WHERE volunteer.softDelete ='No' AND user.id=volunteer.user_id AND  (blood_group  LIKE '%".$requestArray['Bloodgroup']."%'
        AND area_zone  LIKE '%".$requestArray['Zone']."%')";
        if(!isset($requestArray['Bloodgroup']) && !isset($requestArray['Zone']))
        {
            Message::message("<div class='no'>Incomplete Search</div>");
            Utility::redirect('volunteers.php');
        }
        $STH  = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $Data2view = $STH->fetchAll();

        return $Data2view;

    }// end of search()







    public function BloodDonorProfileInfo(){
        $sql = "SELECT * from  volunteer where user_id=" .$this->userID;
        $STH = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }



    public function Blood_Donor_pp_upload(){

        $arrayData=array($this->bloodDonorpp);

        $query="UPDATE volunteer SET profile_picture= ?  WHERE user_id=".$this->userID;

        $STH = $this->dbh->prepare($query);

        $result = $STH->execute($arrayData);


        if ($result){

            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Proffile picture uploaded successfully.
                 </div>");
            Utility::redirect("Blood_Donor_Profile.php");

        }

    }

    public function view(){
        $sql = "Select user.*,volunteer.* from user,volunteer where volunteer.user_id = user.id AND volunteer.id=".$this->id;
        $STH = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }
    public function update(){
        if(!empty($this->userName) && !empty($this->highestEducation) && !empty($this->passingYear) && !empty($this->roll) && !empty($this->phone)){
            $arrayData = array($this->userName, $this->highestEducation, $this->passingYear, $this->roll, $this->phone);
            /*$query = "UPDATE user, volunteer
					  SET user.user_name=?,
					  volunteer.blood_group=?,
					  volunteer.prfrbl_time=?,
					  user.phone=?
					  WHERE volunteer.id =".$this->id ." AND user.id = volunteer.user_id";*/
            $query = "UPDATE user, volunteer
					  SET user.user_name=?,
					  volunteer.highest_education=?,
					  volunteer.passing_year=?,
					  volunteer.roll=?,
					  user.phone=?
					  WHERE volunteer.id =".$this->id ." AND user.id = volunteer.user_id";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='yes'>Successfully Updated</div>");
            } else {
                Message::setMessage("<div class='no'>Failed to Update</div>");
            }
        }else {
            Message::setMessage("<div class='no'>Fields Can not be empty</div>");
        }
        Utility::redirect("volunteers.php");
    }

    public function approve(){
        $arrayData = array('Approved');
        $query = "UPDATE volunteer SET approval_status=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Message::setMessage("<div class='yes'>Approved</div>");
        } else {
            Message::setMessage("<div class='no'>Failed to Approve</div>");
        }
        Utility::redirect("index.php");
    }

    public function trash(){
        $arrayData = array('Yes');
        $query = "UPDATE volunteer SET softDelete=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Message::setMessage("<div class='yes'>Trashed</div>");
        } else {
            Message::setMessage("<div class='no'>Failed to Trash</div>");
        }
        Utility::redirect("volunteers.php");
    }

    public function recover(){
        $arrayData = array('No');
        $query = "UPDATE volunteer SET softDelete=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Message::setMessage("<div class='yes'>Trashed</div>");
        } else {
            Message::setMessage("<div class='no'>Failed to Trash</div>");
        }
        Utility::redirect("volunteers.php");
    }


    public function Delete(){
        //$query = "DELETE FROM user where  volunteer.id=".$this->id." AND volunteer.user_id = user.id";
        $query = "DELETE FROM user where  id=".$this->id;

        $result = $this->dbh->exec($query);
        if ($result) {
            Message::setMessage("<div class='yes'>Removed Permanently</div>");
        } else {

            Message::setMessage("<div class='no'>Failed to Remove</div>");
        }
        Utility::redirect("volunteers.php");
    }

    public function trashPaginator($page=1, $DataPerPage=3){

        $start = (($page-1) * $DataPerPage);
        if($start<0) $start=0;
        $sql = "SELECT * from book_title  WHERE softDelete = 'Yes' LIMIT $start,$DataPerPage";

        $STH = $this->dbh->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }

    public function listSelectedData($selectedIDs){

        foreach($selectedIDs as $id){

            $sql = "Select * from volunteer  WHERE id=".$id;


            $STH = $this->dbh->query($sql);

            $STH->setFetchMode(PDO::FETCH_OBJ);

            $someData[]  = $STH->fetch();


        }


        return $someData;


    }



    public function getAllKeywords()
    {
        $_allKeywords = array();
        $WordsArr = array();

        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->blood_group);
        }

        $allData = $this->index();


        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->blood_group);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end




        // for each search field block start
        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->prfrbl_time);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->prfrbl_time);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end


        return array_unique($_allKeywords);


    }// get all keywords

    public function bloodMultipleTrash($selectedIDsArray){


        foreach($selectedIDsArray as $id){


            $sql = "UPDATE  volunteer SET softDelete='Yes' WHERE id=".$id;

            $result = $this->dbh->exec($sql);

            if(!$result) break;

        }



        if($result)
            Message::message("<div class='yes'>Selected datas trashed successfully</div>");
        else
            Message::message("<div class='no'>Failed! couldn't trash datas</div>");


        Utility::redirect('volunteers.php');
    }


    public function recoverMultiple($markArray){


        foreach($markArray as $id){

            $sql = "UPDATE  book_title SET softDelete='No' WHERE id=".$id;

            $result = $this->dbh->exec($sql);

            if(!$result) break;

        }



        if($result)
            Message::message("<div class='yes'>Seleted has been Datas Recovered </div>");
        else
            Message::message("<div class='no'>Failed! Datas couldn't recover</div>");


        Utility::redirect('trashList.php');


    }



    public function bloodDeleteMultiple($selectedIDsArray){


        foreach($selectedIDsArray as $id){

            $sql = "Delete from user where volunteer.user_id=user.id and volunteer.id=".$id;

            $result = $this->dbh->exec($sql);

            if(!$result) break;

        }



        if($result)
            Message::message("<div class='yes'>Selected Datas Deleted Successfully </div>");
        else
            Message::message("<div class='no'>Selected Datas are not deleted</div>");


        Utility::redirect('BookList.php');

    }

    public function updateVolunteer(){
        if(!empty($this->userID) && !empty($this->email) && !empty($this->phone) && !empty($this->password) && !!empty($this->highestEducation) && !empty ($this->passingYear) && !empty($this->roll)) {
            $arrData = array($this->email, $this->phone, $this->password, $this->highestEducation, $this->passingYear, $this->roll);
            $query = "UPDATE user,volunteer SET  user.email = ?, user.phone = ?, user.password = ?, volunteer.highest_education = ?,volunteer.passing_year = ?, volunteer.roll= ?  WHERE user.id=" . $this->userID . " AND user.id = volunteer.user_id";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrData);
            if ($result) {

                Message::setMessage("Updated Profile Successfully");
                Utility::redirect("../../USER/Proffile/VolunteerProfile.php");

            } else {

                Message::setMessage("Something Went Wrong");
                Utility::redirect($_SERVER['HTTP_REFERER']);

            }
        }else{
                Message::setMessage("All Fields Required");
        }
    }

    public function Volunteer_pp_upload(){

        $arrayData=array($this->volunteer_pp);
        $query="UPDATE volunteer SET profile_picture= ?  WHERE id=".$this->Volunteer_ID ;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);

        if ($result){

            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Proffile picture uploaded successfully.
                 </div>");
            Utility::redirect("VolunteerProfile.php");

        }

    }


}