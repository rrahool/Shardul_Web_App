<?php


namespace App\Model;
use PDO,PDOException;


class Database
{
    public $dbh;


public function  __construct()
{
        try{

            $this->dbh = new PDO("mysql:host = localhost;dbname=shardul_db","root","");
             $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }

        catch(PDOException $error){

            echo "Database Error:".$error->getMessage()."<br>";
            echo "Databse Connection Failed";
        }

}

}