<?php session_start();  ?>

<?php include 'includes/header.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <br>
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-pencil-square-o"></i>  Pending Requests</h4>
                    </div>

                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                            <?php
                                $result = db_get_allrequests();
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

                                        echo        '   <div class="text-center">
                                                            <button class="btn btn-success" id="approveBtn" onclick="approve(' . $row["requestid"] . ')"><i class="fa fa-check-circle"></i> Approve Request</button>
                                                            <button class="btn btn-danger" id="rejectBtn" data-toggle="modal" data-target="#myModal' . $row["requestid"] . '"  onclick="rrreject(' . $row["requestid"] . ')"><i class="fa fa-ban"></i> Reject Request</button>
                                                         </div>
                                                     </div>

                                                     <br>
                                              </div>
                                        </div>';



                                    echo "<br />";


                                    echo '
                                            <!-- Modal -->
                                                <div class="modal fade" id="myModal' . $row["requestid"] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Reject Request</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4>You are rejecting the request sent by ' . $row['fstname'] . " " . $row['lstname'] . ' for ' . $rsvdate . '</h4><br />
                                                                <p>Please provide a reason for not approving the request. This reason will be sent to ' . $row['fstname'] . " " . $row['lstname'] . '</p>
                                                                <p><textarea class="form-control" rows="7" name="staffcomments" id="staffcomments' . $row["requestid"] . '" data-useremail="' .  $row['email'] . '" placeholder="Please enter a reason for rejection..."></textarea></p>
                                                                <br />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <input type="submit" class="btn btn-primary" id="submitReject" onclick="reject(' . $row["requestid"] . ')"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';



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


        <div class="row">
            <br>
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-retweet"></i> Pending Recurrent Requests</h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <?php
                            $result = db_get_allrecrequests();
                            $i=0;
                            if (mysql_num_rows($result) > 0){
                                while($row = mysql_fetch_assoc($result)){

                                if ($row['multiple_eqps'] == "N"){
                                    $rsvdate = date('M d, Y', strtotime($row['startdate']));
                                    $slotdesc = db_get_slotdesc($row['slotcd']);
                                    $eqpdesc = db_get_eqpdesc($row['eqpcd']);
                                    $allEqpsDesc = $eqpdesc;

                                    echo "<input type='hidden' id='multipleEqps-" . $row['requestid'] . "'' value='N'>";

                                }

                                else if ($row['multiple_eqps'] == "Y"){
                                    $rsvdate = date('M d, Y', strtotime($row['startdate']));
                                    $slotdesc = db_get_slotdesc($row['slotcd']);

                                    $allEqps = explode(":", $row['eqpcd']);
                                    $allEqpsDesc = "";
                                    foreach($allEqps as $eqpcd){
                                        $eqpdesc = db_get_eqpdesc($eqpcd);
                                        $allEqpsDesc .= $eqpdesc . ", ";

                                    }
                                    $allEqpsDesc = rtrim($allEqpsDesc, ", ");

                                    echo "<input type='hidden' id='multipleEqps-" . $row['requestid'] . "' value='Y'>";



                                }

                                echo '<div class="panel panel-default panel-min-blue">
                                              <div class="panel-heading" style="height: 35px !important;">
                                                    <h4 class="panel-title">
                                                        <div class="pull-left">
                                                             <a data-toggle="collapse" data-parent="#accordion" href="#collapse-rec-' . $i . '">Recurrent requests for ' . $rsvdate . ' to ' . date('M d, Y', strtotime($row['enddate'])) . '</a>
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
                                              <div id="collapse-rec-' . $i . '" class="panel-collapse collapse">
                                                    <div class="panel-body">';
                                echo                "<table class='table table-striped table-bordered' >
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Equipment needed </td>  <td>  <label name='eqpdesc'>" . $allEqpsDesc . "</label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Request ID </td>  <td>  <label name='requestid'>" . $row['requestid'] . "</label> </td></tr>
                                                            <tr height='40' valign='middle' ><td style='background: #DCE3ED' width='50%' style='padding-left:10px'> Start Date </td>  <td style='background: #DCE3ED'> <label name='date'> " . date('M d, Y', strtotime($row['startdate'])) ."</label> </td></tr>
                                                            <tr height='40' valign='middle' style='background: #DCE3ED'><td width='50%' style='padding-left:10px'> End Date </td>  <td> <label name='date'> " . date('M d, Y', strtotime($row['enddate'])) ."</label> </td></tr>
                                                            <tr height='40' valign='middle'><td width='50%' style='padding-left:10px'> Frequency </td>  <td> <label name='date'> " . ucfirst(str_replace("_", " ", $row['recurtype'])) ."</label> </td></tr>
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

                                echo        '   <div class="text-center">
                                                            <button class="btn btn-success" id="approveBtn" onclick="approve_recur(' . $row["requestid"]  . ')"><i class="fa fa-check-circle"></i> Approve Request</button>
                                                            <button class="btn btn-danger" id="rejectBtn" data-toggle="modal" data-target="#myModalrec' . $row["requestid"] . '"  onclick="rrreject(' . $row["requestid"] . ')"><i class="fa fa-ban"></i> Reject Request</button>
                                                         </div>
                                                     </div>

                                                     <br>
                                              </div>
                                        </div>';



                                echo "<br />";


                                echo '
                                            <!-- REJECT REC Modal -->
                                                <div class="modal fade" id="myModalrec' . $row["requestid"] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabelRec" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="myModalLabelRec">Reject Recurrent Request</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4>You are rejecting the request sent by ' . $row['fstname'] . " " . $row['lstname'] . ' for ' . $rsvdate . '</h4><br />
                                                                <p>Please provide a reason for not approving the request. This reason will be sent to ' . $row['fstname'] . " " . $row['lstname'] . '</p>
                                                                <p><textarea class="form-control" rows="7" name="staffcomments" id="staffcomments' . $row["requestid"] . '" data-useremail="' .  $row['email'] . '" placeholder="Please enter a reason for rejection..."></textarea></p>
                                                                <br />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <input type="submit" class="btn btn-primary" id="submitReject" onclick="reject_recur(' . $row["requestid"] . ')"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';



                                echo '
                                            <!-- See Dates REC Modal -->
                                                <div class="modal fade" id="modalRecDates' . $row["requestid"] . '" tabindex="-1" role="dialog" aria-labelledby="seeDatesRecLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="seeDatesRecLabel">All Requested Dates</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                test
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';


                                $i++;
                            }
                            }
                            else{
                                echo "<h5 align='center'>There are no requests.</h5>";
                            }
                            ?>




                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>






        <script>


            function approve(requestid){
                var tag = "#multipleEqps-"+requestid;
                var multiple = $(tag).val();
                console.log(multiple);
                alertify.confirm("Are you sure you would like to approve this request?", function (conf) {
                    if (conf) {
                        var data = {};
                        data["action"] = "approve";
                        data["id"] = requestid;
                        data["multiple"] = multiple;
                        $.ajax({
                            url: "js/ajax/approve_reject.php",
                            data: data,
                            method: "post",
                            success: function(result){
                                alertify.confirm("Request has been <b>approved</b> and added to calender. <br>The requester has been notified. ", function (e){
                                    if (e){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                });

                            },
                            error: function(xhr, error){
                                alert("Error: " + error.message);
                            }
                        });
                    } else {
                        return false;
                    }
                });


            }


            function approve_recur(requestid){
                var tag = "#multipleEqps-"+requestid;
                var multiple = $(tag).val();
                alertify.confirm("Are you sure you would like to approve this request?", function (conf) {
                    if (conf) {
                        var data = {};
                        data["action"] = "approve";
                        data["id"] = requestid;
                        data["multiple"] = multiple;
                        $.ajax({
                            url: "js/ajax/approve_reject_recur.php",
                            data: data,
                            method: "post",
                            success: function(result){
                                alertify.confirm("Request has been <b>approved</b> and added to calender. <br>The requester has been notified. ", function(e){
                                    if (e){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                });
                            },
                            error: function(xhr, error){
                                alert("Error: " + error.message);
                            }
                        });
                    } else {
                        return false;
                    }
                });


            }

            function reject_recur(requestid){
                var staffcomID = "#staffcomments"+requestid;
                var staffcomments = $(staffcomID).val();
                var emailID = $(staffcomID).data("useremail");

                var data = {};
                data["action"] = "reject";
                data["id"] = requestid;
                data["comments"] = staffcomments;
                data["email"] = emailID;
                if (staffcomments == "" || staffcomments == " "){
                    $(staffcomID).css({border: "1px solid red"});
                }
                else{
                    $.ajax({
                        url: "js/ajax/approve_reject_recur.php",
                        data: data,
                        method: "post",
                        success: function(result){
                            var modalTag = "#myModal"+requestid;
                            $(modalTag).hide();
                            alertify.confirm("Request has been rejected and deleted from system. The requester has been notified. ", function(e){
                                if (e){
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            });

                        },
                        error: function(xhr, error){
                            alert("Error: " + error.message);
                        }
                    });
                }

            }


            $('#seeDatesRec').modal('show');

            $('#rejectBtn').modal('show');

            function reject(requestid){
                var staffcomID = "#staffcomments"+requestid;
                var staffcomments = $(staffcomID).val();
                var emailID = $(staffcomID).data("useremail");

                var data = {};
                data["action"] = "reject";
                data["id"] = requestid;
                data["comments"] = staffcomments;
                data["email"] = emailID;
                if (staffcomments == "" || staffcomments == " "){
                    $(staffcomID).css({border: "1px solid red"});
                }
                else{
                    $.ajax({
                        url: "js/ajax/approve_reject.php",
                        data: data,
                        method: "post",
                        success: function(result){
                            var modalTag = "#myModal"+requestid;
                            $(modalTag).hide();
                            alertify.confirm("Request has been rejected and deleted from system. The requester has been notified. ", function(e){
                                if (e){
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            });

                        },
                        error: function(xhr, error){
                            alert("Error: " + error.message);
                        }
                    });
                }

            }
        </script>

            <?php include 'includes/footer.php' ?>
















