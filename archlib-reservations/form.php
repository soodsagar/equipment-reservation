<?php include 'includes/header.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <br>
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Step 1: Enter your details</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" name="eqpform" action="confirm.php" onsubmit="return processForm()" id="eqpform">
                            <input class='form-control' name="urlPrevious" type="hidden"   value="<?php echo $_SERVER["REQUEST_URI"]?>" >
                            <input class='form-control' name="eqpcd" type="hidden"   value="<?php echo $_GET['eqpcd']?>" >
                            <input class='form-control' name="eqpcd" type="hidden"   value="<?php echo $_GET['eqpcd']?>" >
                            <input class='form-control' name="eqpdesc" type="hidden"   value="<?php echo $_GET['eqpdesc']?>" >
                            <input class='form-control' name="date" type="hidden"   value="<?php echo $_GET['date']?>" >


                            <table class="table table-striped" border="0" align="left" cellspacing="0" >


                                <tr height='40' valign='middle'>
                                    <td width="40%" style="padding-left:10px"> Date when the equipment is needed </td>
                                    <td>:</td>
                                    <td style="padding-left:10px">
                                        <label name="date"><input type="hidden" class="date-needed" value="<?php echo date("M d, Y", strtotime($_GET['date'])); ?>"><?php echo date("M d, Y", strtotime($_GET['date'])); ?> </label>
                                    </td>
                                    <td>
                                        <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                    </td>
                                </tr>

                                <tr height="40" valign="middle" >
                                    <td width="40%"  style="padding-left:10px"> Name </td>
                                    <td>:</td>
                                    <td style="padding-left:10px">
                                        <input class='form-control'type="Text" name="fstname"  style="width: 200px; display: inline !important" placeholder="First" >
                                        <input class='form-control'type="Text" name="lstname"  style="width: 200px; display: inline !important" placeholder="Last" >
                                    </td>
                                    <td>
                                        <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                    </td>
                                </tr>



                                <tr height="40" valign="middle" >
                                    <td width="40%"  style="padding-left:10px"> Email address </td>
                                    <td>:</td>
                                    <td style="padding-left:10px">
                                        <input class='form-control' type="Text" name="email" style="width: 404px; display: inline !important" >
                                    </td>
                                    <td>
                                        <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                    </td>
                                </tr>

                                <tr height="40" valign="middle" >
                                    <td width="40%"  style="padding-left:10px"> Who are you? </td>
                                    <td>:</td>
                                    <td style="padding-left:10px">
                                        <input type="Radio" name="status" value="faculty">&nbsp Faculty&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type="Radio" name="status" value="student" checked>&nbsp Student&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <input type="Radio" name="status" value="staff">&nbsp Staff
                                    </td>
                                    <td>
                                        <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                    </td>

                                </tr>






                             <tr height="40" valign="middle" >
                                <td width="40%"  style="padding-left:10px"> What course or activity is this for? </td>
                                <td>:</td>
                                <td style="padding-left:10px">
                                    <input class='form-control'type="Text" name="course" style="width: 404px; display: inline !important" placeholder="Ex. IS 684">

                                </td>
                                 <td>
                                     <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                 </td>
                            </tr>

                            <tr height="40" valign="middle" >
                                <td width="40%"  style="padding-left:10px"> Where will this equipment be used (building and room number)? </td>
                                <td>:</td>
                                <td style="padding-left:10px">
                                    <input class='form-control'type="Text" name="location" style="width: 404px; display: inline !important" placeholder="Ex. GITC 1100">

                                </td>
                                <td>
                                    <div style="text-align: right; display: inline !important"><label class="label label-default">required</label></div>
                                </td>
                            </tr>




                            <tr height="40" valign="middle" >
                                <td width="40%"  style="padding-left:10px"> What else do you need? </td>
                                <td>: </td>
                                <td style="padding-left:10px">
                                    <input class='form-control'type="Text" name="else" align="RIGHT" size="50">
                                </td>
                            </tr>

                            <tr height="40" valign="middle" >
                                <td width="40%"  style="padding-left:10px"> Any other comments or notes? </td>
                                <td>: </td>
                                <td style='padding-left:10px; padding-top:10px; padding-bottom:10px'>
                                    <textarea class='form-control' name="comments" rows="4" cols="55" ></textarea>
                                </td>
                            </tr>


                            </table>




                    </div>
                </div>






            </div>
        </div>
        <div class="row">
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Step 2: Choose your equipment</h4>

                    </div>

                    <div class="panel-body">
                        <div class="text-center" style="width: 100%;">
                            Choose Time slot :
                            &nbsp;&nbsp;&nbsp;

                            <?
                                $selectbox='<select style="width: 300px; display:inline;" class="form-control" name="slotcd" id="cboslot"><option value="null"></option>';

                                // check functions.php for this function
                                //$slots = db_get_slottimes($_GET['date'], $_GET['eqpcd']);

                                $slots = db_get_allslots();
                                while ($row = mysql_fetch_assoc($slots)){
                                    $selectbox.='<option value="' . $row['slotcd'] . '">' . $row['slotdesc'] . '</option>';
                                }

                                $selectbox.='</select>';
                                mysql_free_result($slots);
                                echo $selectbox;
                            ?>

                            <label class="label label-default">required</label>

                        </div>


                        <br><br>
                        <table class="table table-striped table-bordered" id="eqp-table" style="width: 70% !important; margin: 10px auto 10px auto;display:none; ">
                            <th style="width: 10% !important;">Select</th>
                            <th style="width: 40% !important;">Equipment</th>
                            <th style="width: 40% !important;">Availability</th>

                        <?php

                        $date = $_GET['date'];
                        $get_day = db_get_weekslots($date);



                        $rowindex=0;

                        while ($row = mysql_fetch_array($get_day))
                        {
                            $getavlslots = db_get_totalslots($date, $row['eqpcd']);

                            if ($row['eqpdesc'])
                            {
                                echo "<tr>";

                                echo "<td><input type='checkbox' class='allEqps' name='chosenEqps[]' data-eqpcd='" . $row['eqpcd'] . "' value='" . $row['eqpcd'] . "' id='eqp-" . $row['eqpcd'] . "'></td>";


                                echo "<td>";
                                if (strtoupper(substr($row['eqpdesc'], 0, 6)) == "LAPTOP"){
                                    echo "<i class='fa fa-laptop'></i> &nbsp; ";
                                }
                                elseif (strtoupper(substr($row['eqpdesc'], 0, 4)) == "IPAD"){
                                    echo "<i class='fa fa-tablet fa-fw'></i> &nbsp; ";
                                }
                                elseif (strtoupper(substr($row['eqpdesc'], 0, 9)) == "PROJECTOR"){
                                    echo "<img src='img/projector-icon.png' style='width: 17px;'> &nbsp; ";
                                }
                                elseif (strtoupper(substr($row['eqpdesc'], 0, 6)) == "CAMERA"){
                                    echo "<i class='fa fa-camera fa-fw''></i> &nbsp;";
                                }
                                elseif (strtoupper(substr($row['eqpdesc'], 0, 11)) == "POWER CABLE"){
                                    echo "<i class='fa fa-bolt fa-fw''></i> &nbsp;";
                                }
                                else{
                                    echo "<i class='fa fa-gears fa-fw''></i> &nbsp; ";
                                }
                                echo $row['eqpdesc'] . "</td>";

                                // check if slot avail for date+time for particular equip








                                echo "<td><div class='avail-" . $row['eqpcd'] . "'></div></td>";



                                echo "</tr>";

                            }


                            $rowindex++;

                        }



                        ?>



                    </table>


                    <br />


                    <div class="text-center">
                        <table class="table" style="margin: 10px auto 10px auto; width: 50%">

                        <tr height="40" valign="middle" >
                            <td width="20%"  style="padding-left:10px"> Pick-up Time </td>
                            <td style="padding-left:10px">
                                <div class="input-group" style="width: 100px; display: inline-table">
                                    <span class="input-group-addon" style="">Hr</span>
                                    <select name="PickTimeHrs" class="form-control" style="width: 150px;">
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                    </select>
                                </div>

                                <div class="input-group" style="width: 100px; display: inline-table">
                                    <span class="input-group-addon">Min</span>
                                    <select name="PickTimeMin" class="form-control" style="width: 150px;">
                                        <option>00</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>

                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>

                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>

                                        <option>31</option>
                                        <option>32</option>
                                        <option>33</option>
                                        <option>34</option>
                                        <option>35</option>
                                        <option>36</option>
                                        <option>37</option>
                                        <option>38</option>
                                        <option>39</option>
                                        <option>40</option>

                                        <option>41</option>
                                        <option>42</option>
                                        <option>43</option>
                                        <option>44</option>
                                        <option>45</option>
                                        <option>46</option>
                                        <option>47</option>
                                        <option>48</option>
                                        <option>49</option>
                                        <option>50</option>

                                        <option>51</option>
                                        <option>52</option>
                                        <option>53</option>
                                        <option>54</option>
                                        <option>55</option>
                                        <option>56</option>
                                        <option>57</option>
                                        <option>58</option>
                                        <option>59</option>
                                        <option>60</option>
                                    </select>
                                </div>

                            </td>
                        </tr>

                        <tr height="40" valign="middle" >
                            <td width="20%"  style="padding-left:10px"> Return Time </td>
                            <td style="padding-left:10px">
                                <div class="input-group" style="width: 100px; display: inline-table">
                                    <span class="input-group-addon" style="">Hr</span>
                                    <select name="ReturnTimeHrs" class="form-control" style="width: 150px;">
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                    </select>
                                </div>

                                <div class="input-group" style="width: 100px; display: inline-table">
                                    <span class="input-group-addon">Min</span>
                                    <select name="ReturnTimeMin" class="form-control" style="width: 150px;">
                                        <option>00</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>

                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>

                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>

                                        <option>31</option>
                                        <option>32</option>
                                        <option>33</option>
                                        <option>34</option>
                                        <option>35</option>
                                        <option>36</option>
                                        <option>37</option>
                                        <option>38</option>
                                        <option>39</option>
                                        <option>40</option>

                                        <option>41</option>
                                        <option>42</option>
                                        <option>43</option>
                                        <option>44</option>
                                        <option>45</option>
                                        <option>46</option>
                                        <option>47</option>
                                        <option>48</option>
                                        <option>49</option>
                                        <option>50</option>

                                        <option>51</option>
                                        <option>52</option>
                                        <option>53</option>
                                        <option>54</option>
                                        <option>55</option>
                                        <option>56</option>
                                        <option>57</option>
                                        <option>58</option>
                                        <option>59</option>
                                        <option>60</option>
                                    </select>
                                </div>

                            </td>
                        </tr>


                        </table>

                        </div>



                     </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <br>
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Step 3: Choose Recurrence <label class="label label-info" style="font-size: 11px"> Optional </label></h4>
                        </div>
                        <div class="panel-body">
                            <input type="checkbox" name="recurCheckbox" id="recurCheckbox" /> I would like to reserve the above equipment recurrently. (ex. weekly)

                            <br><br><br>

                            <div class="well" id="recurOptions" style="display: none;">
                                <p>
                                    Reserve the equipment:

                                    <br>
                                    <table class="table">
                                        <tr>
                                            <td><input type="radio" name="recur" id="recurRadio" value="every_week" /> Every week </td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="recur" id="recurRadio" value="every_other_week" /> Every other week </td>
                                        </tr>
                                    </table>

                                    <br>
                                    <p>
                                        <b>Starting on: &nbsp; &nbsp; </b>
                                        <span class='startDateRecur' name="startDateRecur" value='<?php echo date("m-d-Y", strtotime($_GET['date'])); ?>'><?php echo date("m-d-Y", strtotime($_GET['date'])); ?></span>
                                        <input type='hidden' name='startDateRec' value='<?php echo date("Y-m-d", strtotime($_GET['date'])); ?>'>
                                    </p>
                                    <p>
                                        <b>Ending on:  &nbsp; &nbsp; &nbsp;</b>
                                       <input class='endDateRecur' name="endDateRecur" type="date">
                                    </p>


                                </p>
                                <br>
                                <p align="center">Maximum recurrent reservations can only be made till the end of semester</p>

                            </div>


                        </div>
                    </div>
                </div>
            </div>


        <br>
        <div class="alert alert-danger" id="error" style="display: none"></div>
        <br>
        <input class='btn btn-block btn-info' style="width: 80%; margin: 10px auto 10px auto;font-weight: bold" name="Submit" type="submit" value="Submit Request">


        <br />
        <br />
        <br />
        <br />
        <br />

        </div>



    </form>





<script>

    $(function(){


        if ($("#cboslot option:selected").text() == "" || $("#cboslot option:selected").text() == null){
            $("#eqp-table").hide();

        }

        $("#cboslot").change(function(){
            if ($("#cboslot option:selected").text() == "" || $("#cboslot option:selected").text() == null){
                $("#eqp-table").slideUp();

            }
            else{
                $("#eqp-table").slideDown();
            }
        })



        $('#recurCheckbox').change(function() {
            if($(this).is(":checked")) {
                $("#recurOptions").slideDown();
            }
            else{
                $("#recurOptions").slideUp();
            }
        });
    });






    function processForm(){
        var fname = document.forms["eqpform"]["fstname"].value;
        var lname = document.forms["eqpform"]["lstname"].value;
        var email = document.forms["eqpform"]["email"].value;
        var course = document.forms["eqpform"]["course"].value;
        var location = document.forms["eqpform"]["location"].value;
        var errors;

        // if required fields are empty
        if (fname == "" || lname == "" || email == "" || course == "" || location == "" || $("#cboslot option:selected").text() == "" || $("#cboslot option:selected").text() == null){
            if (fname == ""){
                errors = "<li>First Name</li>";
            }
            if (lname == ""){
                errors += "<li>Last Name</li>";
            }
            if (email == ""){
                errors += "<li>Email Address</li>";
            }



            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");
            if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
                errors += "<li>Invalid Email Address</li>";
            }

            if (course == ""){
                errors += "<li>What course or activity is this for?</li>";
            }
            if (location == ""){
                errors += "<li>Where will this equipment be used (building and room number)?</li>";
            }

            if ($("#cboslot option:selected").text() == ""){
                errors += "<li>Time Slot</li>"
            }
            if ($("#cboslot option:selected").text() == null){
                errors += "<li>Time Slot</li>"
            }


            errors = errors.replace("undefined", "");

            $("#error").fadeIn().html(
                "<i class='fa fa-exclamation-triangle'></i>  Please complete all required fields. You are missing the following:<br><ul>"+errors+"</ul>"
            );

            errors = "";
            return false;
        }



        // if they are not empty, then check for slot duplicate
        /*else{
            var data = {};
            data['date'] = '<?php //echo $_GET["date"]; ?>'
            data['eqpcd'] = '<?php //echo $_GET["eqpcd"]; ?>'
            data['slotcd'] = $("#cboslot").val();

            $.ajax({
                url: "js/ajax/check_slotusage.php",
                method: "post",
                data: data,
                success: function(duplicate){
                    if (duplicate == "FALSE"){
                        // Time slot is available, proceed to confirm page
                        return true;
                    }
                    if (duplicate == "TRUE"){
                        // Time slot is already taken
                        alert("Time slot is already taken by another user. Please choose a different time slot. ");
                        return false;
                    }
                    return false;
                },
                error: function(request, status, error){
                    alert("Error -> "+request.responseText + "\n" + status + "\n" + error.message);
                    return false;
                }

            });
        }*/

    }






</script>
<?php include 'includes/footer.php' ?>