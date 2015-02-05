<?php
include "../../includes/functions.php";
$requestid = $_POST['id'];
$multiple = $_POST['multiple'];


connect_db();

if ($_POST['action'] == "approve"){
    if ($multiple == "N"){
        $sql = "update alib_rsv_requests set reviewed='Y', verno='1' where requestid='$requestid'";
    }
    else if($multiple == "Y"){
        $sql = "update alib_rsv_requests set reviewed='Y', verno='1' where requestid='$requestid'";
    }


    // send confirm email
    $message = "<h4>Your request to reserve an equipment from the Architecture Library has been <i>approved</i>.</h4>";
    $message = "Your request is now available on the <a href=''>calendar</a>";

    $subject = "Request #$requestid for equipment reservation from ArchLib has been APPROVED";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .='From: do-not-reply'. "\r\n";

    mail($email, $subject, $message, $headers);


}

if ($_POST['action'] == "reject"){
    $staffcomments = $_POST['comments'];
    $email = $_POST['email'];

    $message = "<h4>Your request to reserve an equipment from the Architecture Library has been <i>rejected</i>.</h4>";
    $message .= "<p>The admin has provided the following reason for not approving your request: </p><br>";
    $message .= "<span style='padding-left: 20px; padding-right: 20px; text-decoration: underline'>" . '"' . $staffcomments . '"' . "</span> <br><br>";

    $subject = "Request #$requestid for equipment reservation from ArchLib has been REJECTED";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .='From: do-not-reply'. "\r\n";

    mail($email, $subject, $message, $headers);


    $sql = "delete from alib_rsv_requests where requestid='$requestid'";

}

$result = mysql_query($sql);

echo $multiple;
?>