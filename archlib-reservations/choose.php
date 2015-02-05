<?php include 'includes/header.php' ?>

<div id="page-wrapper">
    <div class="row">
        <br>
        <br>
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Select Time Slot and Equipment</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Equipment</th>

                            <th>Reserve Date</th>
                            <th>Slot Status</th>
                            <th>Action</th>
                        </tr>
                        <?php


                        $date = $_GET['date'];
                        $get_day = db_get_weekslots($date);


                        $rowindex=0;

                        while ($row = mysql_fetch_array($get_day))
                        {
                            $getavlslots = db_get_totalslots($date, $row['eqpcd']);

                            if ($row['eqpdesc'])
                            {
                                echo"<tr height=30>";

                                // EQUIPMENT
                                echo"<td align = 'left'>";
                                    if (strtoupper(substr($row['eqpdesc'], 0, 6)) == "LAPTOP"){
                                        echo "<i class='fa fa-laptop'></i> &nbsp; ";
                                    }
                                    elseif (strtoupper(substr($row['eqpdesc'], 0, 4)) == "IPAD"){
                                        echo "<i class='fa fa-tablet'></i> &nbsp; ";
                                    }
                                    elseif (strtoupper(substr($row['eqpdesc'], 0, 9)) == "PROJECTOR"){
                                        echo "<img src='img/projector-icon.png' style='width: 17px;'> &nbsp; ";
                                    }
                                    elseif (strtoupper(substr($row['eqpdesc'], 0, 6)) == "CAMERA"){
                                        echo "<i class='fa fa-camera'></i> &nbsp;";
                                    }
                                    elseif (strtoupper(substr($row['eqpdesc'], 0, 11)) == "POWER CABLE"){
                                        echo "<i class='fa fa-bolt'></i> &nbsp;";
                                    }
                                    else{
                                        echo "<i class='fa fa-gears'></i> &nbsp; ";
                                    }
                                    echo $row['eqpdesc'];
                                echo"</td>";


                                // REQUEST ID
                                /*echo "<td align='left'>";
                                    if ($row['requestid']){
                                        echo $row['requestid'];
                                    }
                                    else{
                                        echo "";
                                    }
                                echo "</td>";*/

                                //DATE
                                echo"<td align = 'left'>";
                                echo    date("M d, Y", strtotime($date));
                                echo"</td>";

                                // SLOT STATUS
                                echo"<td align = 'left'>";
                                if ($getavlslots['avlslots'] >= 1){
                                    if ($getavlslots['avlslots'] > 1){
                                        echo $getavlslots['avlslots'] ." slots available ";
                                    }
                                    else{
                                        echo $getavlslots['avlslots'] ." slot available ";
                                    }
                                }
                                else{
                                    echo "-";
                                }
                                echo"</td>";


                                // ACTION
                                echo"<td align = 'left'>";
                                    if($getavlslots['avlslots'] == 0)
                                        echo "<span class='label label-danger'> All Reserved / Requested </span><br>&nbsp;";
                                    elseif($getavlslots['avlslots'] > 0)
                                        echo "<a href = 'form.php?date=$date" . "&eqpcd=" . $row['eqpcd'] . "&eqpdesc=" . urlencode($row['eqpdesc']) . "'><button class='btn btn-primary'>Reserve</button></a>";
                                    else
                                        echo "-";
                                echo"</td>";


                                echo"</tr>";


                                if ($row['slotcd'] == '')
                                {
                                    $rowindex++;
                                    continue;
                                }

                                $rowindex++;
                            }

                            $eqpdesc=$row['eqpdesc'];








                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>