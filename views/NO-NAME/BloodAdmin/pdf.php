<?php
include_once ('../../../vendor/autoload.php');
use App\WareHouse\BloodStore;

$obj= new BloodStore();
$recordSet=$obj->index();
$trs="";
$sl=0;

    foreach($recordSet as $row) {
        $userName =  $row->user_name;
        $bloodGroup = $row->blood_group;
        $preferableLocation =$row->prfrbl_location;

        $sl++;
        $trs .= "<tr>";
        $trs .= "<td width='50'> $sl</td>";
        $trs .= "<td width='50'> $userName </td>";
        $trs .= "<td width='250'> $bloodGroup </td>";
        $trs .= "<td width='250'> $preferableLocation </td>";

        $trs .= "</tr>";
    }

$html= <<<BITM
<div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th align='left'>Serial Number</th>
                    <th align='left'>User Name</th>
                    <th align='left'>Blood Group</th>
                    <th align='left'>Preferable Location</th>

              </tr>
                </thead>
                <tbody>

                  $trs

                </tbody>
            </table>


BITM;


// Require composer autoload
require_once ('../../../vendor/mpdf/mpdf/mpdf.php');
//Create an instance of the class:

$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('Blood Donor List.pdf', 'D');