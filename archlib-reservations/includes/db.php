<?php

function connect_db(){
    // Connection's Parameters
    $db_host="*******";
    $db_name="********";
    $username="*********";
    $password="***********";
    $db_con=mysql_connect($db_host,$username,$password);
    $connection_string=mysql_select_db($db_name);

    // Connection
    mysql_connect($db_host,$username,$password);
    mysql_select_db($db_name);
}

function db_test(){
    connect_db();
    $return = mysql_query("SELECT VERSION() as version");
    return $return;
}


/*
    // Testing DB Connection //
    $result = db_test();
    $r = mysql_fetch_array($result);
    echo $r['version'];
*/

?>