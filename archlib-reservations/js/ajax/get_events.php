<?php


include "../../includes/functions.php";

connect_db();

$query = "SELECT * FROM alib_rsv_requests WHERE verno='1'";
$result = mysql_query($query);

$all_events = array();

while ($row = mysql_fetch_array($result)){
    $requestid = $row['requestid'];
    $slotdesc = db_get_slotdesc($row["slotcd"]);

    $location = $row['location'];
    $rsvdate = $row['rsvdate'];

    $slotTimes = explode(" - ", $slotdesc);
    $slotStartTime = "T" . $slotTimes[0] . ":00Z";
    $slotEndTime = "T" . $slotTimes[1] . ":00Z";

    $reserveStart = $rsvdate . $slotStartTime;
    $reserveEnd = $rsvdate . $slotEndTime;

    $event = array();

    // if multiple eqps
    if ($row['multiple_eqps'] == "Y"){
        $mult_eqpcd = explode(":", $row['eqpcd']);
        //$eqpdesc_array = array();
        foreach($mult_eqpcd as $cd ){
            $desc = db_get_eqpdesc($cd);
            //array_push($eqpdesc_array, $desc);

            $event["id"] = $requestid;
            $event["title"] = $desc . " - " . $location;
            $event["start"] = $reserveStart;
            $event["end"] = $reserveEnd;
            $event["allDay"] = false;

            array_push($all_events, $event);
        }



    }
    // else only one eqp
    else{
        $eqpdesc = db_get_eqpdesc($row['eqpcd']);

        $event["id"] = $requestid;
        $event["title"] = $eqpdesc . " - " . $location;
        $event["start"] = $reserveStart;
        $event["end"] = $reserveEnd;
        $event["allDay"] = false;
    }



    array_push($all_events, $event);



}

echo json_encode($all_events);



?>