<?php
    include "../../includes/functions.php";
    connect_db();
    $sql = "Select alib_rsv_slotcd from requests";
    $sql .= " where eqpcd = '". $_POST['eqpcd'] . "'";
    $sql .= " and rsvdate = '". date("Y-m-d", strtotime($_POST['date'])) . "'";
    $sql .= " and slotcd = '" . $_POST['slotcd'] . "'" ;

    $result = mysql_num_rows(mysql_query($sql));
    if ($result > 0){
        $available = "TRUE";
    }
    else{
        $available = "FALSE";
    }
    echo $available;
?>