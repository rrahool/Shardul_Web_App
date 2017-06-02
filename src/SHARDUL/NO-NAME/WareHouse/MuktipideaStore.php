<?php
namespace App\WareHouse;
use App\Muktipidea\Muktipidea;
use App\Message\Message;
use App\Utility\Utility;
use PDO;
use PDOException;

class MuktipideaStore extends Muktipidea{

    public function store(){
        if(!empty($this->blog_title) && !empty($this->blog_post) && !empty($this->cetagory) && !empty($this->freedom_fighter)){
            $this->blog_date = $date = date('Y-m-d');
            $arrayData = array($this->blog_title, $this->blog_post, $this->blog_date, $this->cetagory, $this->freedom_fighter);
            $query = "INSERT INTO mukttipedia(blog_title,blog_post,blog_date,cetagory,freedom_fighter_id) VALUES(?,?,?,?,?)";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>Successfully Inserted In To Database</div>");
                Utility::redirect("muktipidea.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to insert into database</div>");
                Utility::redirect("muktipidea.php");
            }
        }
        else {
            Message::setMessage("<div class='error'>All Fields are required !!</div>");
        }
        Utility::redirect("muktipidea.php");
    }
    public function freedomfighters(){
        $query = "SELECT * from freedom_fighter";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }
    public function operationStory(){
        $query = "SELECT blog_title,blog_post,blog_date from mukttipedia WHERE cetagory='operation' ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();
    }
    public function brutalityStory(){
        $query = "SELECT blog_title,blog_post,blog_date from mukttipedia WHERE cetagory='brutality' ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();
    }
    public function bioStory(){
        $query = "SELECT blog_title,blog_post,blog_date from mukttipedia WHERE cetagory='bio' ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();
    }
    public function index(){
        $query = "SELECT blog_title,blog_post,blog_date from mukttipedia ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();
    }


    public function indexPaginator($page=1, $DataPerPage=3){

        $start = (($page-1) * $DataPerPage);
        if($start<0) $start=0;
        $sql = "SELECT * from mukttipedia  WHERE softDelete = 'No' LIMIT $start,$DataPerPage";

        $STH = $this->dbh->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }



    /*public function search($requestArray){
        $sql = "";

        if( isset($requestArray['search']) )
            $sql = "SELECT * FROM mukttipedia WHERE softDelete ='No' AND (cetagory  LIKE '%".$requestArray['search']."%')";

        if(!isset($requestArray['cetagory']) )
        {
            Message::message("<div class='no'>Incomplete Search</div>");
            Utility::redirect('MukttiPediaOld');

        }


        $STH  = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $Data2view = $STH->fetchAll();

        return $Data2view;

    }// end of search()*/
    public function search($requestArray){
        $sql = "";
        if(isset($requestArray['search']))
            $sql = "SELECT * FROM `mukttipedia` WHERE `softDelete` ='No' AND `cetagory` LIKE '%".$requestArray['search']."%'";

        if(!isset($requestArray['search']))
        {
            Message::message("<div class='no'>Incomplete Search</div>");
            Utility::redirect('MukttiPediaOld.php');
        }


        $STH  = $this->dbh->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $Data2view = $STH->fetchAll();

        return $Data2view;

    }//

    public function questionAnswer(){
        $query= "select id from user WHERE user_name ='$this->user_name'";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $userID =   $STH->fetchAll();
        foreach($userID as $id){
            $u_id = $id->id;
        }
        $this->user_id = $u_id;
        if(!empty($this->question) && !empty($this->freedom_fighter) && !empty($this->user_id)){
            $arrayData = array($this->question, $this->freedom_fighter, $this->user_id);
            $query = "INSERT INTO question_answer(question,freedom_fighter_id,user_id) VALUES(?,?,?)";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>The question is submitted</div>");
                Utility::redirect("MukttiPediaOld.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to submit question</div>");
                Utility::redirect("MukttiPediaOld.php");
            }
        }
        else {
            Message::setMessage("<div class='error'>All Fields are required !!</div>");
        }
        Utility::redirect("MukttiPediaOld.php");

    }

    public function questions(){
        $query = "SELECT  question_answer.reply_date,question_answer.status,question_answer.question,question_answer.answer,question_answer.id,
                  user.user_name,freedom_fighter.name,question_answer.question
                  from question_answer,freedom_fighter,volunteer,user
                  WHERE question_answer.freedom_fighter_id=freedom_fighter.id and question_answer.user_id= volunteer.id
                  and  volunteer.user_id=user.id";

        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }
    public function filter_questions(){
        if(!empty($this->question_id) && !empty($this->reject)){
            $arrayData = array($this->question_id, $this->reject);

            $query = "delete from question_answer where question_answer.id=".$this->question_id;
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>The question is deleted</div>");
                Utility::redirect("questions.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to delete question</div>");
                Utility::redirect("questions.php");
            }
        }
        if(!empty($this->question_id) && !empty($this->accept)){
            $arrayData = array($this->question_id, $this->accept);

            $query = "Update question_answer set status= 'Yes' where question_answer.id=".$this->question_id;
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>The question is accepted</div>");
                Utility::redirect("questions.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to accepted question</div>");
                Utility::redirect("questions.php");
            }
        }

        else {
            Message::setMessage("<div class='error'>All Fields are required !!</div>");
        }
        Utility::redirect("questions.php");

    }
    public function set_answer(){
        if(!empty($this->question_id) ){
            $arrayData = array($this->answer);
            $date = date('Y-m-d');

            $query = "Update question_answer set answer='$this->answer' , reply_date ='$date' where question_answer.id=".$this->question_id;


            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>The question is deleted</div>");
                Utility::redirect("questions.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to delete question</div>");
                Utility::redirect("questions.php");
            }
        }

    }
    public function cetagory(){
        $query = "SELECT cetagory from mukttipedia ";
        $STH = $this->dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        return $STH->fetchAll();

    }
    public function getAllKeywords()
    {
        $_allKeywords = array();
        $WordsArr = array();

        $allData = $this->cetagory();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->cetagory);
        }

        $allData = $this->cetagory();


        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->cetagory);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end



/*
        // for each search field block start
        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->blog_post);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->blog_post);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

*/
        return array_unique($_allKeywords);


    }



}