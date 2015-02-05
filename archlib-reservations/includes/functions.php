<?php

include 'db.php';
include 'jsonwrapper/jsonwrapper.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('America/New_York');


function datediffInWeeks($date1, $date2){
    $first = new DateTime($date1);
    $second = new DateTime($date2);
    if($date1 > $date2) return datediffInWeeks($date2, $date1);
    return floor($first->diff($second)->days/7);
}



function generate_recur_dates($startDate, $endDate, $type){
    $recur_dates = array();
    $i = 0;
    $curDate = $startDate;
    if ($type == "every_week"){
        $diff = datediffInWeeks($startDate, $endDate);
        $recur_dates[$i] = $startDate;
        while ($i < $diff){
            $curDate =  date("Y-m-d", strtotime($curDate)+604800);
            $recur_dates[$i+1] = $curDate;

            $i++;
        }

    }
    else if ($type == "every_other_week"){
        $diff = datediffInWeeks($startDate, $endDate);
        $recur_dates[$i] = $startDate;
        while ($i < $diff){
            $curDate =  date("Y-m-d", strtotime($curDate)+604800+604800);
            $recur_dates[$i+1] = $curDate;

            $i++;
        }
    }
    return $recur_dates;

}


function db_get_weekslots($date){
    connect_db();
    $sql = "select eqpcd, eqpdesc from alib_rsv_eqpmst where active='Y' order by eqpdesc";

    $get_day = mysql_query($sql);
    return $get_day;

}

function db_get_eqplist($sort){
    connect_db();
    $sql="select * from alib_rsv_eqpmst order by " . $sort;
    $all_eqp = mysql_query($sql);
    return $all_eqp;
}

function db_get_eqplist_edit($eqpcd){
    connect_db();
    $sql="select * from alib_rsv_eqpmst where eqpcd != " . $eqpcd . " order by eqpdesc ";
    $all_eqp = mysql_query($sql);
    return $all_eqp;
}

function db_get_allslots(){
    connect_db();
    $sql="select * from alib_rsv_slot where active='Y' order by slotcd ";
    $all_eqp = mysql_query($sql);
    return $all_eqp;
}

function db_get_totalslots($date, $eqpcd){
    connect_db();
    $sql = "";
    $sql .= " select ((select count(slotcd) from alib_rsv_slot where active = 'Y')-(select count(slotcd) from alib_rsv_requests";
    $sql .= " where date_format(rsvdate, '%Y-%m-%d') = '" .  $date . "'";
    $sql .= " and eqpcd = " .  $eqpcd . ")) as avlslots";

    $getavlslots = mysql_fetch_assoc(mysql_query($sql));
    return $getavlslots;
}


function db_get_datetimeavail($rsvdate, $eqpcd, $slotcd){
    connect_db();
    $sql = 'select multiple_eqps from alib_rsv_request where rsvdate="' . $rsvdate . '" and slotcd=' . $slotcd;
    $result =
    $sql = 'select count(eqpcd) from alib_rsv_requests where eqpcd like "%' . $eqpcd . '%" and rsvdate="' . $rsvdate . '" and slotcd=' . $slotcd;
    $count = mysql_query($sql);
    return $count;

}

function db_get_slottimes($date, $eqpcd){
    connect_db();
    $query = "select slotcd, slotdesc from alib_rsv_slot";
    $query .= " where slotcd not in ";
    $query .= " (select slotcd from alib_rsv_requests where eqpcd = '". $eqpcd ."' and rsvdate = '". date("Y-m-d", strtotime($date)) ."')";
    $query .= " and active = 'Y' order by sortcd";

    $result = mysql_query($query);
    return $result;

}

function db_get_slotusage($date, $eqpcd, $slotcd){
    connect_db();
    $sql = "Select slotcd from alib_rsv_requests";
    $sql .= " where eqpcd = '". $eqpcd . "'";
    $sql .= " and rsvdate = '". date("Y-m-d", strtotime($date)) . "'";
    $sql .= " and slotcd = '" . $slotcd . "'" ;

    $result = mysql_num_rows(mysql_query($sql));
    if ($result > 0){
        $available = false;
    }
    else{
        $available = true;
    }
    return $available;
}


function db_get_slotcd($slotdesc){
    connect_db();
    $sql = "Select slotcd from alib_rsv_slot where slotdesc = '$slotdesc'";
    $getslotdesc = mysql_query($sql);
    $row = mysql_fetch_row($getslotdesc);
    $localslotdesc = $row[0];

    return $localslotdesc;

}

function db_get_slotdesc($slotcd){
    connect_db();
    $sql = "Select slotdesc from alib_rsv_slot where slotcd = '$slotcd'";
    $getslotdesc = mysql_query($sql);
    $row = mysql_fetch_row($getslotdesc);
    $localslotdesc = $row[0];

    return $localslotdesc;
}

function db_get_eqpdesc($eqpcd){
    connect_db();
    $sql = "Select eqpdesc from alib_rsv_eqpmst where eqpcd = '$eqpcd'";
    $geteqpdesc = mysql_query($sql);
    $row = mysql_fetch_row($geteqpdesc);
    $localeqpdesc = $row[0];

    return $localeqpdesc;
}



function db_checklogin($user, $pass){
    connect_db();
    $result = mysql_query("select pwd from alib_rsv_usrmst where usrid='$user'");
    $row = mysql_fetch_row($result);
    if ($row[0] == $pass){
        return true;
    }
    else{
        return false;
    }

}


function db_get_allrequests(){
    connect_db();
    $result = mysql_query("select * from alib_rsv_requests where verno = '0' order by rsvdate asc");
    return $result;
}


function db_get_allrequests_accepted($startdate, $enddate){
    connect_db();
    $result = mysql_query("select * from alib_rsv_requests where verno = '1' and rsvdate between '$startdate' and '$enddate' order by rsvdate asc");
    return $result;
}


function db_get_allrecrequests(){
    connect_db();
    $result = mysql_query("select * from alib_rsv_recreq where verno = '0' order by rsvdate asc");
    return $result;
}


function db_get_requestbyid($id){
    connect_db();
    $result = mysql_query("select * from alib_rsv_requests where requestid = '$id'");
    return $result;
}

function db_generate_rec_requests($requestid, $recurtype){
    connect_db();
    $q = "select * from alib_rsv_recreq where requestid=" . $requestid;
    $result = mysql_query($q);
    $row = mysql_fetch_assoc($result);
    if (isset($row)){
        $recur_dates_array = generate_recur_dates($row['startdate'], $row['enddate'], $row['recurtype']);
        foreach($recur_dates_array as $DATE){
            $sql=  "INSERT INTO alib_rsv_requests( ";

            $sql= $sql . "Requestdate, ";
            $sql= $sql . "Requesttime, ";
            $sql= $sql . "multiple_eqps, ";
            $sql= $sql . "eqpcd, ";
            $sql= $sql . "rsvdate, ";
            $sql= $sql . "PickTime, ";
            $sql= $sql . "endtime, ";
            $sql= $sql . "fstname, ";
            $sql= $sql . "lstname, ";
            $sql= $sql . "slotcd, ";
            $sql= $sql . "email, ";
            $sql= $sql . "status, ";
            $sql= $sql . "location, ";
            $sql= $sql . "`else`, ";
            $sql= $sql . "comments, ";
            $sql= $sql . "reviewed, ";
            $sql= $sql . "verno ) ";

            $sql= $sql . "VALUES ";

            $sql= $sql . "(";
            $sql= $sql . "'" . $row['requestdate'] . "', ";
            $sql= $sql . "" . "date_format(now(),'%H:%i:%s')" . ", ";
            $sql= $sql . "'" . $row['multiple_eqps'] . "', ";
            $sql= $sql . "'" . $row['eqpcd'] . "', ";
            $sql= $sql . "'" . $DATE . "', ";
            $sql= $sql . "'" . $row['picktime'] . "', ";
            $sql= $sql . "'" . $row['endtime'] . "', ";
            $sql= $sql . "'" . $row['fstname'] . "', ";
            $sql= $sql . "'" . $row['lstname'] . "', ";
            $sql= $sql . "'" . $row['slotcd'] . "', ";
            $sql= $sql . "'" . $row['email'] . "', ";
            $sql= $sql . "'" . $row['status'] . "', ";
            $sql= $sql . "'" . $row['location'] . "', ";
            $sql= $sql . "'" . $row['else'] . "', ";
            $sql= $sql . "'" . $row['comments'] . "', ";
            $sql= $sql . "'" . "Y" . "', ";
            $sql= $sql . "'1'";

            $sql= $sql . ")";

            mysql_query($sql);
        }
        $q = "delete from alib_rsv_recreq where requestid='$requestid'";
        mysql_query($q);
    }
    echo $sql;



}

function db_insert_formdata($Requestdate, $week, $dates, $day, $hour, $multiple, $eqpcd, $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $localslotcd, $email, $status, $location, $laptop, $xga, $else, $comments){
    connect_db();



    $sql="";
    $sql= $sql . "INSERT INTO alib_rsv_requests( ";

    $sql= $sql . "Requestdate, ";
    $sql= $sql . "Requesttime, ";
    $sql= $sql . "week, ";
    $sql= $sql . "dates, ";
    $sql= $sql . "day, ";
    $sql= $sql . "`hour`, ";
    $sql= $sql . "multiple_eqps, ";
    $sql= $sql . "eqpcd, ";
    $sql= $sql . "rsvdate, ";
    $sql= $sql . "PickTime, ";
    $sql= $sql . "endtime, ";
    $sql= $sql . "fstname, ";
    $sql= $sql . "lstname, ";
    $sql= $sql . "slotcd, ";
    $sql= $sql . "email, ";
    $sql= $sql . "status, ";
    $sql= $sql . "location, ";
    $sql= $sql . "laptop, ";
    $sql= $sql . "xga, ";
    $sql= $sql . "`else`, ";
    $sql= $sql . "comments, ";
    $sql= $sql . "reviewed, ";
    $sql= $sql . "staffcomments ) ";

    $sql= $sql . "VALUES ";

    $sql= $sql . "(";
    $sql= $sql . "'" . date('Y-m-d', strtotime($Requestdate)) . "', ";
    $sql= $sql . "" . "date_format(now(),'%H:%i:%s')" . ", ";
    /*	$sql= $sql . "'" . $Requesttime . "', "; */
    $sql= $sql . "'" . $week . "', ";
    $sql= $sql . "'" . $dates . "', ";
    $sql= $sql . "'" . $day . "', ";
    $sql= $sql . "'" . $hour . "', ";
    $sql= $sql . "'" . $multiple . "', ";
    $sql= $sql . "'" . $eqpcd . "', ";
    $sql= $sql . "'" . date('Y-m-d', strtotime($rsvdate)) . "', ";
    $sql= $sql . "'" . $PickTimeHrs . ":" . $PickTimeMin . ":00', ";
    $sql= $sql . "'" . $ReturnTimeHrs . ":" . $ReturnTimeMin . ":00', ";
    $sql= $sql . "'" . $fstname . "', ";
    $sql= $sql . "'" . $lstname . "', ";
    $sql= $sql . "'" . $localslotcd . "', ";
    $sql= $sql . "'" . $email . "', ";
    $sql= $sql . "'" . $status . "', ";
    $sql= $sql . "'" . $location . "', ";
    $sql= $sql . "'" . $laptop . "', ";
    $sql= $sql . "'" . $xga . "', ";
    $sql= $sql . "'" . $else . "', ";
    $sql= $sql . "'" . $comments . "', ";
    $sql= $sql . "'" . "N" . "', ";
    $sql= $sql . "'" . "". "'";

    $sql= $sql . ")";

    mysql_query($sql);

    $insertID = mysql_insert_id();

    return $insertID;




}

function db_insert_formdata_recur($Requestdate, $recurStart, $recurEnd, $recurType, $multiple, $allEqps, $rsvdate, $PickTimeHrs, $PickTimeMin, $ReturnTimeHrs, $ReturnTimeMin, $fstname, $lstname, $slotcd, $email, $status, $location, $else, $comments, $rev, $verno){

    connect_db();
    $sql="";
    $sql= $sql . "INSERT INTO alib_rsv_recreq( ";

    $sql= $sql . "requestdate, ";
    $sql= $sql . "startdate, ";
    $sql= $sql . "enddate, ";
    $sql= $sql . "recurtype, ";
    $sql= $sql . "multiple_eqps, ";
    $sql= $sql . "eqpcd, ";
    $sql= $sql . "rsvdate, ";
    $sql= $sql . "picktime, ";
    $sql= $sql . "endtime, ";
    $sql= $sql . "fstname, ";
    $sql= $sql . "lstname, ";
    $sql= $sql . "slotcd, ";
    $sql= $sql . "email, ";
    $sql= $sql . "status, ";
    $sql= $sql . "location, ";
    $sql= $sql . "`else`, ";
    $sql= $sql . "comments, ";
    $sql= $sql . "reviewed, ";
    $sql= $sql . "verno ) ";

    $sql= $sql . "VALUES ";

    $sql= $sql . "(";
    $sql= $sql . "'" . date('Y-m-d', strtotime($Requestdate)) . "', ";
    $sql= $sql . "'" . date('Y-m-d', strtotime($recurStart)) . "', ";
    $sql= $sql . "'" . date('Y-m-d', strtotime($recurEnd)) . "', ";
    $sql= $sql . "'" . $recurType . "', ";
    $sql= $sql . "'" . $multiple . "', ";
    $sql= $sql . "'" . $allEqps . "', ";
    $sql= $sql . "'" . date('Y-m-d', strtotime($rsvdate)) . "', ";
    $sql= $sql . "'" . $PickTimeHrs . ":" . $PickTimeMin . ":00', ";
    $sql= $sql . "'" . $ReturnTimeHrs . ":" . $ReturnTimeMin . ":00', ";
    $sql= $sql . "'" . $fstname . "', ";
    $sql= $sql . "'" . $lstname . "', ";
    $sql= $sql . "'" . $slotcd . "', ";
    $sql= $sql . "'" . $email . "', ";
    $sql= $sql . "'" . $status . "', ";
    $sql= $sql . "'" . $location . "', ";
    $sql= $sql . "'" . $else . "', ";
    $sql= $sql . "'" . $comments . "', ";
    $sql= $sql . "'" . "N" . "', ";
    $sql= $sql . "'" . "". "'";

    $sql= $sql . ")";

    mysql_query($sql);

    $insertID = mysql_insert_id();

    return $insertID;

}




?>