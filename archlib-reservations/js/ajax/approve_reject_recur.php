<?php
include "../../includes/functions.php";
$requestid = $_POST['id'];
$multiple = $_POST['multiple'];
$staffcomments =  $_POST['staffcomments'];


connect_db();

if ($_POST['action'] == "approve"){

    db_generate_rec_requests($requestid, $recurtype);


    // send confirm email
    $message = "<h4>Your recursive request to reserve equipment from the Architecture Library has been <i>approved</i>.</h4>";
    $message = "Your request is now available on the <a href=''>calendar</a>";

    $subject = "Request #$requestid for equipment reservation from ArchLib has been APPROVED";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .='From: do-not-reply'. "\r\n";

    mail($email, $subject, $message, $headers);


}

if ($_POST['action'] == "reject"){

    $sql = "delete from alib_rsv_recreq where requestid='$requestid'";

    $message = "<h4>Your request to reserve an equipment from the Architecture Library has been <i>rejected</i>.</h4>";
    $message .= "<p>The admin has provided the following reason for not approving your request: </p><br>";
    $message .= "<span style='padding-left: 20px; padding-right: 20px; text-decoration: underline'>" . '"' . $staffcomments . '"' . "</span> <br><br>";

    $subject = "Request #$requestid for equipment reservation from ArchLib has been REJECTED";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .='From: do-not-reply'. "\r\n";

    mail($email, $subject, $message, $headers);




}

$result = mysql_query($sql);

echo $result;
?>