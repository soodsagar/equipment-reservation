<?php

include '../../includes/functions.php';

connect_db();

$duplicate = false;
$action = $_POST['action'];
$status = $_POST['status'];

if (isset($_POST['name'])){
    $eqpname = $_POST['name'];
}
if (isset($_POST['id'])){
    $id = $_POST['id'];
}

if ($action == "add"){
    $results = db_get_eqplist("eqpdesc");
    while ($row = mysql_fetch_array($results)){
        if ($eqpname == $row['eqpdesc']){
            $duplicate = true;
        }
    }
    if (!$duplicate){
        $sql = "insert into alib_rsv_eqpmst values ('', '" . $eqpname . "', '" . $status . "', '0')";
        mysql_query($sql);
    }
    else $response = "duplicate";
}

if ($action == "edit"){
    $results = db_get_eqplist_edit($id);
    while ($row = mysql_fetch_array($results)){
        if ($eqpname == $row['eqpdesc']){
            $duplicate = true;
        }
    }
    if (!$duplicate){
        $sql = "update alib_rsv_eqpmst set eqpdesc='" . $eqpname . "', active = '" . $status . "' where eqpcd=" . $id;
        mysql_query($sql);
        $response = $sql;
    }
    else $response = "duplicate";
}

if ($action == "delete"){
    $sql = "delete from alib_rsv_eqpmst where eqpcd=" . $id;
    mysql_query($sql);

}




echo $response;


?>