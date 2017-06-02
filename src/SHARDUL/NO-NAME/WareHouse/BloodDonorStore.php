<?php


namespace App\WareHouse;
use  App\BloodDonor\Blood_Donor;
use App\Utility\Utility;
use App\Message\Message;
use PDO;
use PDOException;

class BloodDonorStore extends Blood_Donor
{

    public function Blood_Donor_store()
    {
        if (!empty($this->bloodGroup) && !empty($this->zone) && !empty($this->prefarebleTime)) {

            session_start();
            if (isset($_SESSION['Data']) && !empty($_SESSION['Data'])) {

                /*  'fname' => $fname,
                    'lname' => $lname,
                    'mail' => $mail,
                    'phn' => $phn,
                    'uname' => $uname,
                    'pass' => $pass,
                    'ADDRSS' => $ADDRSS,
                    'dob' => $dob,
                    'role' => $role
                 */
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

                        if($this->lastDonateDate==""){
                            $this->lastDonateDate ="";
                        }else{
                            $this->lastDonateDate = date('Y-m-d',strtotime($this->lastDonateDate));
                        }
                        // var_dump($this->lastDonateDate);
                        // die();
                        $arrayData = array($userID->id, $this->bloodGroup, $this->zone, $this->prefarebleTime, $this->gender, $this->lastDonateDate);

                        $query = "INSERT INTO blood_doner(user_id,blood_group,area_zone,prfrbl_time,gender,last_donate_date) VALUES(?,?,?,?,?,?)";
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
                        Message::message("
                <div class=\"alert alert-danger\"><strong>oops!</strong> Something Went Wrong</div>");
                    }

                } else {
                    Message::message("
                        <div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>Please complete previous Step</div>");
                }


            } else {
                Message::message("
                <div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>Please complete previous Step</div>");
            }

        }else {
            Message::message("
                <div class='alert' style='color:#fff; font-weight: 700; text-transform:Uppercase; background-color:red'>All * fields are required !!</div>");
        }
        if(!empty($_SESSION['message'])){
            echo $_SESSION['message'];
        }else{
            echo $_SESSION['message2'];
        }
    }



    public function index()
    {
        try {
            $sql = "SELECT user.*,blood_doner.* FROM user,blood_doner WHERE user.id=blood_doner.user_id ORDER BY blood_doner.id DESC";
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
        $sql = "SELECT user.*,blood_doner.* FROM user,blood_doner  WHERE user.id=blood_doner.user_id LIMIT $start,$DataPerPage";

        $STH = $this->dbh->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }



    public function search($requestArray){
        $sql = "";

        if( isset($requestArray['Bloodgroup']) && isset($requestArray['Zone']) )
            $sql = "SELECT user.phone,blood_doner.* FROM user,blood_doner WHERE blood_doner.softDelete ='No' AND user.id=blood_doner.user_id AND  (blood_group  LIKE '%".$requestArray['Bloodgroup']."%'
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
            $sql = "SELECT user.*,blood_doner.* FROM user,blood_doner WHERE blood_doner.softDelete ='No' AND user.id=blood_doner.user_id AND  (blood_group  LIKE '%".$requestArray['Bloodgroup']."%'
        AND area_zone  LIKE '%".$requestArray['Zone']."%')";
        if(!isset($requestArray['Bloodgroup']) && !isset($requestArray['Zone']))
        {
            Message::message("<div class='no'>Incomplete Search</div>");
            Utility::redirect('Donors.php');
        }
        $STH  = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $Data2view = $STH->fetchAll();

        return $Data2view;

    }// end of search()







    public function BloodDonorProfileInfo(){
        $sql = "SELECT * from  blood_doner where user_id=" .$this->BlooduserID;
        $STH = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }



    public function Blood_Donor_pp_upload(){

        $arrayData=array($this->bloodDonorpp);
        $query="UPDATE blood_doner SET profile_picture= ?  WHERE user_id=".$this->BlooduserID ;
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
        $sql = "Select user.*,blood_doner.* from user,blood_doner where blood_doner.user_id = user.id AND blood_doner.id=".$this->id;
        $STH = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }
    public function update(){
        if(!empty($this->userName) && !empty($this->bloodGroup) && !empty($this->prefarebleTime) && !empty($this->phone)){
            $arrayData = array($this->userName, $this->bloodGroup, $this->prefarebleTime, $this->phone);
            /*$query = "UPDATE user, blood_doner
					  SET user.user_name=?,
					  blood_doner.blood_group=?,
					  blood_doner.prfrbl_time=?,
					  user.phone=?
					  WHERE blood_doner.id =".$this->id ." AND user.id = blood_doner.user_id";*/
            $query = "UPDATE user, blood_doner
					  SET user.user_name=?,
					  blood_doner.blood_group=?,
					  blood_doner.prfrbl_time=?,
					  user.phone=?
					  WHERE blood_doner.id =".$this->id ." AND user.id = blood_doner.user_id";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='yes'>Successfully Updated</div>");
            } else {
                Message::setMessage("<div class='no'>Failed to Update</div>");
            }
        }else {
            Message::setMessage("<div class='no'>User Name Or Blood Group Or Preferable Location Can not be Empty !!</div>");
        }
        Utility::redirect("Donors.php");
    }

    public function approve(){
        $arrayData = array('Approved');
        $query = "UPDATE blood_doner SET approval_status=?  WHERE id=".$this->id;
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
        $query = "UPDATE blood_doner SET softDelete=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Message::setMessage("Deactivated");
        } else {
            Message::setMessage("Activate");
        }
        Utility::redirect("Donors.php");
    }

    public function recover(){
        $arrayData = array('No');
        $query = "UPDATE blood_doner SET softDelete=?  WHERE id=".$this->id;
        $STH = $this->dbh->prepare($query);
        $result = $STH->execute($arrayData);
        if ($result) {
            Message::setMessage("<div class='yes'>Trashed</div>");
        } else {
            Message::setMessage("<div class='no'>Failed to Trash</div>");
        }
        Utility::redirect("Donors.php");
    }

    public function Delete(){
        //$query = "DELETE FROM user where  blood_doner.id=".$this->id." AND blood_doner.user_id = user.id";
        $query = "DELETE FROM user where  id=".$this->id;

        $result = $this->dbh->exec($query);
        if ($result) {
            Message::setMessage("<div class='yes'>Removed Permanently</div>");
        } else {

            Message::setMessage("<div class='no'>Failed to Remove</div>");
        }
        Utility::redirect("Donors.php");
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

            $sql = "Select * from blood_doner  WHERE id=".$id;


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


            $sql = "UPDATE  blood_doner SET softDelete='Yes' WHERE id=".$id;

            $result = $this->dbh->exec($sql);

            if(!$result) break;

        }



        if($result)
            Message::message("<div class='yes'>Selected datas trashed successfully</div>");
        else
            Message::message("<div class='no'>Failed! couldn't trash datas</div>");


        Utility::redirect('donors.php');
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





            $sql = "delete user, blood_doner from user join blood_doner on user.id = blood_doner.user_id where blood_doner.id=".$id;
            $result = $this->dbh->exec($sql);

            if(!$result) break;

        }



        if($result)
            Message::message("Selected Datas Deleted Successfully");
        else
            Message::message("Selected Datas are not deleted");


        Utility::redirect('Donors.php');

    }

    public function Last_Donate_Date_Update(){

        if(isset($_POST['update-donate-date']));
        $arrayData=array($this->UpdatedLastDonateDate);

        $query="UPDATE blood_doner SET  last_donate_date= ?  WHERE user_id=".$this->BlooduserID;
        $STH = $this->dbh->prepare($query);

        $result = $STH->execute($arrayData);
        if ($result){

            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Profile picture uploaded successfully.
                 </div>");
            Utility::redirect("Blood_Donor_Profile.php");

        }
    }


}