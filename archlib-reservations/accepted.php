<?php session_start(); ?>
<?php include 'includes/header.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <br>
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Accepted Requests</h4>
                    </div>
                    <div class="panel-body">


                        <?php
                        $start = $_GET['start'];
                        $end = $_GET['end'];
                        $result = db_get_allrequests_accepted($start, $end);
                        $total = mysql_num_rows($result);
                        ?>

                        <form action="" method="get">

                            <div class="well text-center">
                                Start Date: <input class="form-control" name="start" type="date" placeholder="yyyy-mm-dd" style="width: 180px; display: inline !important; "> &nbsp;&nbsp;
                                End Date: <input class="form-control" name="end" type="date" placeholder="yyyy-mm-dd" style="width: 180px;display: inline !important;">
                                &nbsp; &nbsp; <input type="submit" class="btn btn-primary" value="Search">
                            </div>

                        </form>

                            <div class="text-center"> Showing results between <b><?php echo date("M d, Y", strtotime($start)); ?></b> and <b><?php echo date("M d, Y", strtotime($end)); ?></b></div>
                            <div class="text-center"> Total Results: <?php echo $total; ?></div>
                            <br />


                        <div class="panel-group" id="accordion">
                            <?php



                                $i=0;
                                if (mysql_num_rows($result) > 0){
                                    while($row = mysql_fetch_assoc($result)){

                                        if ($row['multiple_eqps'] == "N"){
                                            $rsvdate = date('M d, Y', strtotime($row['rsvdate']));
                                            $slotdesc = db_get_slotdesc($row['slotcd']);
                                            $eqpdesc = db_get_eqpdesc($row['eqpcd']);
                                            $allEqpsDesc = $eqpdesc;

                                            echo "<input type='hidden' id='multipleEqps-" . $row['requestid'] . "' value='N'>";

                                        }

                                        else if ($row['multiple_eqps'] == "Y"){
                                            $rsvdate = date('M d, Y', strtotime($row['rsvdate']));
                                            $slotdesc = db_get_slotdesc($row['slotcd']);

                                            $allEqps = explode(":", $row['eqpcd']);
                                            $allEqpsDesc = "";
                                            foreach($allEqps as $eqpcd){
                                                $eqpdesc = db_get_eqpdesc($eqpcd);
                                                $allEqpsDesc .= $eqpdesc . ", ";

                                            }
                                            $allEqpsDesc = rtrim($allEqpsDesc, ", ");

                                            echo "<input type='hidden' id='multipleEqps-" . $row['requestid'] . "'' value='Y'>";



                                        }

                                        echo '<div class="panel panel-default panel-min-blue">
                                              <div class="panel-heading" style="height: 35px !important;">
                                                    <h4 class="panel-title">
                                                        <div class="pull-left">
                                                             <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i . '">Request for ' . $rsvdate . '</a>
                                                        </div>
                                                        <div class="pull-right">';

                                        if ($row['multiple_eqps'] == "N" ){
                                            echo '<badge class="label label-info">Single Equipment</badge>';
                                        }
                                        else{
                                            echo '<badge class="label label-success">Multiple Equipment</badge>';
                                        }

                                        echo'                     </div>
                                                    </h4>

                                              </div>
                                              <div id="collapse' . $i . '" class="panel-collapse collapse">
                                                    <div class="panel-body">';
                                        echo                "<table class='table table-striped table-bordered' >
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Equipment needed </td>  <td>  <label name='eqpdesc'>" . $allEqpsDesc . "</label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Request ID </td>  <td>  <label name='requestid'>" . $row['requestid'] . "</label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Date when needed </td>  <td> <label name='date'> " . $rsvdate ."</label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Slot </td>  <td> <label name='slotdesc'>" .  $slotdesc  . " </label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Pick-Up Time </td>  <td> <label name='PickTime'>" .  $row['picktime']. " </label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Return Time </td>  <td> <label name='PickMin'>"  . $row['endtime']  . " </label> </td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Name </td>   <td>"  .  $row['fstname'] . " " . $row['lstname'] ." </td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Email address </td>   <td>".   $row['email'] ."</td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Status </td>   <td>". $row['status'] ."</td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Location </td>   <td>".  $row['location'] ."</td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Any other needs </td>   <td>". $row['else'] ."</td></tr>
                                                            <tr height='40' valign='middle' ><td width='50%' style='padding-left:10px'> Other comments or notes </td>   <td>".  $row['comments'] ."</td></tr>
                                                        </table>";

                                        echo        '
                                                     </div>

                                                     <br>
                                              </div>
                                        </div>';


                                        echo "<br />";

                                        $i++;
                                    }
                                }
                                else{
                                    echo "<h5 align='center'>There are no requests</h5>";
                                }

                            ?>


                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'includes/footer.php' ?>