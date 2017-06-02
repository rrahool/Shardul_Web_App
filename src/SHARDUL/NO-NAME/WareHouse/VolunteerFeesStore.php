<?php


namespace App\WareHouse;
use App\Volunteer\VolunteerFees;
use App\Utility\Utility;
use App\Message\Message;
use PDO;

class VolunteerFeesStore extends VolunteerFees
{

    public function VolunteerFeesStore(){
            $arrayData = array($this->VolunteerID,$this->paymentdate,$this->Amount);
            $query = "INSERT INTO accounts(volunteer_id,Paymentdate,ammount) VALUES(?,?,?)";
            $STH = $this->dbh->prepare($query);
            $result = $STH->execute($arrayData);
            if ($result) {
                Message::setMessage("<div class='success'>Successfully Inserted In To Database</div>");
                Utility::redirect("VolunteerProfile.php");
            }

            else {
                Message::setMessage("<div class='error'>Failed to insert into database</div>");
                Utility::redirect("VolunteerProfile.php");
            }
        }

     public function VolunteerPaymentInformation(){
         $sql = "SELECT * from  accounts where volunteer_id=" .$this->VolunteerID;
         $STH = $this->dbh->query($sql);
         $STH->setFetchMode(PDO::FETCH_OBJ);
         return $STH->fetchAll();
     }

}

