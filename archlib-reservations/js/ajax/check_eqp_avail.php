<?php
    include "../../includes/functions.php";

    $slotcd = $_POST['slotcd'];
    $date = strtotime($_POST['date']);
    $date = date("Y-m-d", $date);

    connect_db();
    $sql = "select * from alib_rsv_eqpmst";
    $alleqp = mysql_query($sql);

    $eqp_array = array();
    while ($each_eqp = mysql_fetch_array($alleqp)){
            $count = db_get_datetimeavail($date, $each_eqp['eqpcd'], $slotcd);
            $row = mysql_fetch_row($count);
            

            $eqp_array["cd~" . $each_eqp['eqpcd']] = $row[0];

    }


echo json_encode($eqp_array);




?>  