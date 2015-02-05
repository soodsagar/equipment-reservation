<?php include 'includes/header.php' ?>

<?php

if(!get_magic_quotes_gpc())
{

    $eqpcd= addslashes ($_POST['eqpcd']);
    $eqpdesc= addslashes ($_POST['chosenEqps']);
    $rsvdate= addslashes ($_POST['date']);

    //$slotdesc= addslashes($_POST['slotdesc']);

    $PickTimeHrs= addslashes($_POST['PickTimeHrs']);
    $PickTimeMin= addslashes($_POST['PickTimeMin']);

    $ReturnTimeHrs= addslashes($_POST['ReturnTimeHrs']);
    $ReturnTimeMin= addslashes($_POST['ReturnTimeMin']);

    $Requestdate= addslashes ($_POST['Requestdate']);
    $Requesttime= addslashes ($_POST['Requesttime']);

    $week= addslashes ($_POST['week']);
    $dates= addslashes ($_POST['dates']);
    $day= addslashes ($_POST['day']);
    $hour= addslashes ($_POST['hour']);

    $endtime= addslashes ($_POST['endtime']);

    $fstname= addslashes ($_POST['fstname']);
    $lstname= addslashes ($_POST['lstname']);
    $slotdesc =  addslashes (db_get_slotdesc($_POST['slotcd']));

    $email= addslashes ($_POST['email']);
    $status= addslashes ($_POST['status']);
    $location= addslashes ($_POST['location']);
    $else= addslashes ($_POST['else']);
    $comments= addslashes ($_POST['comments']);

    $slotcd = addslashes($_POST['slotcd']);


    $allEqps = "";
    $allEqpsDesc = "";
    $single = true;

    if (count($_POST['chosenEqps']) > 1){
        foreach($_POST['chosenEqps'] as $chosen) {
            $allEqps .= addslashes(":{$chosen}");
            $result = db_get_eqpdesc($chosen);
            $allEqpsDesc .= $result . ", ";
            $single = false;
        }
        $allEqpsDesc = rtrim($allEqpsDesc, ", ");

        $allEqps = substr($allEqps, 1);
    }
    else{
        $result = db_get_eqpdesc($_POST['chosenEqps'][0]);
        $allEqpsDesc .= $result;
        $allEqps = $_POST['chosenEqps'][0];
    }


    $recurCheck = addslashes ($_POST['recurCheckbox']);
    $recurType = addslashes ($_POST['recur']);
    $recurStart = addslashes (date("Y-m-d", strtotime($_POST['startDateRecur'])));
    $recurEnd = addslashes (date("Y-m-d", strtotime($_POST['endDateRecur'])));



}
else
{
    $eqpcd= $_POST['eqpcd'] . "";
    $eqpdesc= $_POST['chosenEqps'] . "";
    $rsvdate= $_POST['date'] . "";
    //$slotdesc= $_POST['slotdesc'] . "";

    $PickTimeHrs= $_POST['PickTimeHrs'];
    $PickTimeMin= $_POST['PickTimeMin'];

    $ReturnTimeHrs= $_POST['ReturnTimeHrs'];
    $ReturnTimeMin= $_POST['ReturnTimeMin'];

    $Requestdate= $_POST['Requestdate'] . "";
    $Requesttime= $_POST['Requesttime'] . "";

    $week= $_POST['week'] . "";
    $dates= $_POST['dates'] . "";
    $day= $_POST['day'] . "";
    $hour= $_POST['hour'] . "";

    $endtime= $_POST['endtime'] . "";

    $fstname= $_POST['fstname'] . "";
    $lstname= $_POST['lstname'] . "";
    $slotdesc = db_get_slotdesc($_POST['slotcd']);

    $email= $_POST['email'] . "";
    $status= $_POST['status'] . "";
    $location= $_POST['location'] . "";
    $else= $_POST['else'] . "";
    $comments= $_POST['comments'] . "";


    $slotcd = $_POST['slotcd'];

    $allEqps = "";
    $allEqpsDesc = "";
    $single = true;

    if (count($_POST['chosenEqps']) > 1){
        foreach($_POST['chosenEqps'] as $chosen) {
            $allEqps .= "{$chosen}:";
            $result = db_get_eqpdesc($chosen);
            $allEqpsDesc .= $result . ", ";
            $single = false;

        }

        $allEqpsDesc = rtrim($allEqpsDesc, ", ");
        $allEqps = substr($allEqps, 1);

    }

    else{
        $result = db_get_eqpdesc($_POST['chosenEqps'][0]);
        $allEqpsDesc .= $result;
        $allEqps = $_POST['chosenEqps'][0];

    }



    $recurCheck = $_POST['recurCheckbox'];
    $recurType = $_POST['recur'];
    $recurStart = date("Y-m-d", strtotime($_POST['startDateRec']));
    $recurEnd = date("Y-m-d", strtotime($_POST['endDateRecur']));





}


?>



<div id="page-wrapper">
        <br />
        <br />

    <?php
    $Requestdate = date("Y-m-d");

    if ($single){
        if ($_POST['recurCheckbox'] == "on"){
            $requestid = db_insert_formdata_recur($Requestdate, $_POST['startDateRec'], $recurEnd, $recurType, "N", $_POST['chosenEqps'][0], $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $slotcd, $email, $status, $location, $else, $comments, "", "");
        }
        else{
            $requestid = db_insert_formdata($Requestdate, $week, $dates, $day, $hour, "N", $_POST['chosenEqps'][0], $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $slotcd, $email, $status, $location, "", "", $else, $comments);
        }

    }
    else{
        if ($_POST['recurCheckbox'] == "on"){
            $requestid = db_insert_formdata_recur($Requestdate, $_POST['startDateRec'], $recurEnd, $recurType,  "Y", $allEqps, $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $slotcd, $email, $status, $location, $else, $comments, "", "");
        }
        else{
            $requestid = db_insert_formdata($Requestdate, $week, $dates, $day, $hour, "Y", $allEqps, $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $slotcd, $email, $status, $location, "", "", $else, $comments);
        }

    }





    ?>

        <div class="row">

            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-4 col-lg-offset-4 text-center" style="color: #16a085">
                            <i class="fa fa-4x fa-check-circle"></i><br>
                            <h4><b>REQUEST SUBMITTED</b></h4>
                            Status: Processing
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="alert alert-success"><i class='fa fa-check'></i> &nbsp; Your request has been submitted. <span style="text-decoration: underline"> It is currently being processed for approval.</span> You will receive a confirmation email once your request has been approved. </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-10 col-lg-offset-1">
                            <table class="table table-striped table-bordered" >
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Request ID </td>  <td>  <label name="requestid"> <? echo $requestid ?> </label> </td></tr>
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Equipment needed </td>  <td>  <label name="eqpdesc"> <? echo $allEqpsDesc ?> </label> </td></tr>
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Date when needed </td>  <td> <label name="date"> <? echo date('M d, Y', strtotime($_POST['date']))?> </label> </td></tr>
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Slot </td>  <td> <label name="slotdesc"> <? echo $slotdesc  . ' Hrs'; ?> </label> </td></tr>
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Pick-Up Time </td>  <td> <label name="PickTime"> <? echo $_POST['PickTimeHrs'] ; echo ':' . $_POST['PickTimeMin'] . ' Hrs' ?> </label> </td></tr>
                                <tr height='40' valign='middle'><td width="50%" style="padding-left:10px"> Return Time </td>  <td> <label name="PickMin"> <? echo $_POST['ReturnTimeHrs'] ; echo ':' . $_POST['ReturnTimeMin'] . ' Hrs' ?> </label> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Name </td>   <td>   <?php echo $_POST['fstname'] . " " .   $_POST['lstname'] ; ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Email address </td>   <td>   <?php echo $_POST['email'] ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Status </td>   <td> <?php echo $_POST['status'] ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Course </td>   <td> <?php echo $_POST['course'] ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Location </td>   <td>  <?php echo $_POST['location'] ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Any other needs </td>   <td> <?php echo $_POST['else'] ?> </td></tr>
                                <tr height="40" valign="middle" ><td width="50%" style="padding-left:10px"> Other comments or notes </td>   <td>  <?php echo $_POST['comments'] ?> </td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php



//=========================
//   SEND EMAIL TO ADMIN
//=========================



// multiple recipients
$to  = 'ss925@njit.edu';                // littmanlibrary@njit.edu

// subject
$subject_a = "ArchLib Laptop / Projector requested ";
$admin_subject = $subject_a; 



// message

$message = "";

$message .= "<span style='font-size: 16px'>This is a request to reserve an equipment from the Architecture Library. <br><b>This request needs <span style='text-decoration: underline'>to be processed</span></b></h4></span>";



$message .= "<table>" ;

$message .= "<table border='0' align='left'  cellspacing='0' bgcolor='#FFFFFF' style='padding-left:5px;'>";
$message .= "<tr style='background:#dfe9ff; color:#030334' height='30'>";
$message .= "</tr>";
$message .= "\n";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='40' valign='middle'> <td width='25%' style='padding-left:10px'> Request Id </td> <td>:</td> <td>  <label name='requestid'>" . $requestid . "</label> </td></tr>";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Equipment needed </td> <td>:</td> <td> <label name='eqpdesc'>" . $_POST['eqpdesc']  . "</label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Date when the equipment is needed </td> <td>:</td> <td> <label name='date'>" . $_POST['date']  . "</label></td></tr>"; #hour#.";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Slot </td> <td>:</td> <td> <label name='slotdesc'>" . $slotdesc . ' Hrs' . "</label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Time to pick up the equipment </td> <td>:</td> <td> <label name='PickTime'>" . $_POST['PickTimeHrs'] . ":" . $_POST['PickTimeMin'] . " Hrs" . "</label></td></tr>";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Time to return the equipment </td> <td>:</td> <td> <label name='ReturnTime'>" . $_POST['ReturnTimeHrs'] . ":" . $_POST['ReturnTimeMin'] . " Hrs" . "</label></td></tr>";


$message .= "\n";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'><td  style='padding-left:10px'>  Name </td> <td>:</td>  <td>
	<label name='fstname'> " . $_POST['fstname'] . " </label>
	<label name='lstname'> " . $_POST['lstname'] . " </label>
</td></tr>";



$message .= "<tr height='30' valign='middle'><td  style='padding-left:10px'>  Email </td> <td>:</td>  <td>  <label name='email'> " .  $_POST['email'] . "</label> </td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'><td  style='padding-left:10px'>  Status </td> <td>:</td>  <td align= 'left'>  <label name='status'> " .  $_POST['status'] . "</label></td></tr>";

$message .= "\n";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Course </td> <td>:</td>  <td> <label name='course'>" . $_POST['course']   . "   </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  Location </td> <td>:</td>  <td> <label name='location'>" .  $_POST['location']   . "  </label></td></tr>";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Laptops </td> <td>:</td>  <td>  <label name='laptop'> " .  $_POST['laptop']   . "    </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  XGA </td> <td>:</td>  <td> <label name='xga'>  " .  $_POST['xga']   . "  </label></td></tr>";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Any other needs </td> <td>: </td>  <td> <label name='else'> " .  $_POST['else']   . "   </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  Other comments or notes </td> <td>: </td>  <td> <label name='comments'>  " .  $_POST['comments']   . "   </label></td></tr>";

$message .= "\n";




$path = urlencode($_SERVER['SERVER_NAME']). $_SERVER['PHP_SELF'];


$path=explode("/",$path);

array_pop($path);

$path = implode("/",$path);


$url = 'http' . '://' . $path . '/login.php';

$message .= "<br><br><a href='$url'><button style='display: inline-block;
                                  margin-bottom: 0;
                                  font-weight: normal;
                                  text-align: center;
                                  vertical-align: middle;
                                  cursor: pointer;
                                  background-image: none;
                                  border: 1px solid transparent;
                                  white-space: nowrap;
                                  padding: 6px 12px;
                                  font-size: 14px;
                                  line-height: 1.42857;
                                  -webkit-user-select: none;
                                  -moz-user-select: none;
                                  -ms-user-select: none;
                                  -o-user-select: none;
                                  user-select: none;
                                  color: white;
                                  background-color: #3aa4d5;
                                  border-color: #2d83d5;
                                  '>
                     Click here to process this request</button></a>";


$message .= "\n";

$message .= "</table>";



// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .='From: do-not-reply'. "\r\n";

// Additional headers

// Mail it
mail($to, $admin_subject, $message, $headers);




//=========================
//   SEND EMAIL TO USER
//=========================

$njituser = $email;
$user_subject = "[Request #" . $requestid  .  "] Your equipment reservation request has been submitted. ";
$message = "<span style='font-size: 16px'>Your request to reserve an equipment has been submitted. <span style='text-decoration: underline'><b>It is currently being processed.</b></span> <br>We will send you a confirmation email shortly once your request has been approved.  </span>";

$message .= "<table>" ;

$message .= "<table border='0' align='left'  cellspacing='0' bgcolor='#FFFFFF' style='padding-left:5px;'>";
$message .= "<tr style='background:#dfe9ff; color:#030334' height='30'>";
$message .= "</tr>";
$message .= "\n";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='40' valign='middle'> <td width='25%' style='padding-left:10px'> Request Id </td> <td>:</td> <td>  <label name='requestid'>" . $requestid . "</label> </td></tr>";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Equipment needed </td> <td>:</td> <td> <label name='eqpdesc'>" . $_POST['eqpdesc']  . "</label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Date when the equipment is needed </td> <td>:</td> <td> <label name='date'>" . $_POST['date']  . "</label></td></tr>"; #hour#.";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Slot </td> <td>:</td> <td> <label name='slotdesc'>" . $slotdesc . ' Hrs' . "</label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Time to pick up the equipment </td> <td>:</td> <td> <label name='PickTime'>" . $_POST['PickTimeHrs'] . ":" . $_POST['PickTimeMin'] . " Hrs" . "</label></td></tr>";

$message .= "<tr  height='30' valign='middle'> <td width='50%' style='padding-left:10px'> Time to return the equipment </td> <td>:</td> <td> <label name='ReturnTime'>" . $_POST['ReturnTimeHrs'] . ":" . $_POST['ReturnTimeMin'] . " Hrs" . "</label></td></tr>";


$message .= "\n";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'><td  style='padding-left:10px'>  Name </td> <td>:</td>  <td>
	<label name='fstname'> " . $_POST['fstname'] . " </label>
	<label name='lstname'> " . $_POST['lstname'] . " </label>
</td></tr>";



$message .= "<tr height='30' valign='middle'><td  style='padding-left:10px'>  Email </td> <td>:</td>  <td>  <label name='email'> " .  $_POST['email'] . "</label> </td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'><td  style='padding-left:10px'>  Status </td> <td>:</td>  <td align= 'left'>  <label name='status'> " .  $_POST['status'] . "</label></td></tr>";

$message .= "\n";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Course </td> <td>:</td>  <td> <label name='course'>" . $_POST['course']   . "   </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  Location </td> <td>:</td>  <td> <label name='location'>" .  $_POST['location']   . "  </label></td></tr>";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Laptops </td> <td>:</td>  <td>  <label name='laptop'> " .  $_POST['laptop']   . "    </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  XGA </td> <td>:</td>  <td> <label name='xga'>  " .  $_POST['xga']   . "  </label></td></tr>";

$message .= "<tr height='30' valign='middle'> <td  style='padding-left:10px'>  Any other needs </td> <td>: </td>  <td> <label name='else'> " .  $_POST['else']   . "   </label></td></tr>";

$message .= "<tr style='background:#dfe9ff; color:#030334' height='30' valign='middle'> <td  style='padding-left:10px'>  Other comments or notes </td> <td>: </td>  <td> <label name='comments'>  " .  $_POST['comments']   . "   </label></td></tr>";

$message .= "\n";

mail($njituser, $user_subject, $message, $headers);

?>




<?php include 'includes/footer.php' ?>