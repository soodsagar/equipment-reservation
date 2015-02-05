<?php session_start(); ?>
<?php include 'includes/header.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <br>
            <br>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         &nbsp;
                        <div class="pull-left">
                            <h4>Equipment Management</h4>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-success"  id="addNewEqp" data-toggle='modal' data-target='#modalAddNew'><i class="fa fa-plus-circle"></i> Add New</button>
                        </div>
                        &nbsp;<br>&nbsp;
                    </div>
                    <div class="panel-body">
                        <div class="text-center"></div>
                        <table class="table table-striped table-bordered">
                            <th><a href='eqp.php?sort=eqpcd'>ID <i class="fa fa-sort"></i></a></th>
                            <th><a href='eqp.php?sort=eqpdesc'> Equipment <i class="fa fa-sort"></i></a></th>
                            <th><a href='eqp.php?sort=active'>Status <i class="fa fa-sort"></i></a></th>
                            <th>Actions</th>

                            <?php

                                $sort = "eqpdesc";
                                if (isset($_GET['sort'])){
                                    $sort = $_GET['sort'];
                                }

                                $all_eqp = db_get_eqplist($sort);

                                while ($row = mysql_fetch_array($all_eqp)){
                                    echo "<tr>";
                                    echo "<td>" . $row['eqpcd'] . "</td>";
                                    echo "<td>" . $row['eqpdesc'] . "</td>";
                                    if ($row['active'] == "Y") {echo "<td><h5><span class='label label-success'><i class='fa fa-check-circle'></i> Active</span></h5></td>";}
                                    else {echo "<td ><h5><span class='label label-warning'><i class='fa fa-ban'></i> Inactive</span></h5></td>";}
                                    echo "<td>";
                                    echo    " <button class='btn btn-info btn-sm' id='edit-eqp' data-id='" . $row['eqpcd'] . "' data-toggle='modal' data-target='#modalEdit". $row["eqpcd"] . "'><i class='fa fa-pencil-square-o'></i> Edit</button>";
                                    echo    " <button class='btn btn-danger btn-sm delete-eqp id-" . $row['eqpcd'] . "' data-id='" . $row['eqpcd'] . "'' data-toggle='modal' data-target='#modalDelete" . $row["eqpcd"] . "'><i class='fa fa-trash-o'></i> Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";


                                    echo '
                                            <!-- Modal -->
                                                <div class="modal fade" id="modalEdit' . $row["eqpcd"] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Edit Equipment</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="text" id="EditEqpName' . $row["eqpcd"] . '" class="form-control" value="' . $row["eqpdesc"] . '">
                                                                <br>

                                                                <input type="radio" name="editStatus' . $row["eqpcd"] . '" value="active" checked> Active <br>
                                                                <input type="radio" name="editStatus' . $row["eqpcd"] . '" value="inactive"> Inactive
                                                                <input type="hidden" id="eqpID" value="' . $row["eqpcd"] . '">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <input type="submit" class="btn btn-primary saveEditEqp id-' . $row['eqpcd'] . '" data-id="' . $row["eqpcd"] . '"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';


                                }


                            ?>
                        </table>

                            <!-- "Add New" Modal -->
                            <div class="modal fade" id="modalAddNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add New Equipment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" placeholder="Equipment Name, Ex. Laptop 7" id="AddNewEqpName">
                                        <br>

                                        <input type="radio" name="AddNewStatus" value="active" checked="checked"> Active <br>
                                        <input type="radio" name="AddNewStatus" value="inactive"> Inactive

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="saveAddEqp"> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>




<script type="text/javascript">

    $(function(){

        //$("#edit-eqp").modal("show");   /// check if works on sandbox


    });






</script>

<?php include 'includes/footer.php' ?>