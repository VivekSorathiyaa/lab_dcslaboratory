<?php
session_start();
include("header.php");
include("connection.php");
if ($_SESSION['name'] == "") {
?>
    <script>
        window.location.href = "<?php echo $base_url; ?>index.php";
    </script>
<?php
}


?>
<style>
    #billing label {
        display: block;
        text-align: center;
        line-height: 150%;
        font-size: .85em;
    }

    .visually-hidden {
        position: absolute;
        left: -100vw;

        /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
    }

    .disp_bandh {
        display: none;
    }
</style>
<?php

// GET DATA FROM URL VAIBHAV
if (isset($_GET['report_no'])) {
    $report_no = $_GET['report_no'];
}
if (isset($_GET['trf_no'])) {
    $trf_no = $_GET['trf_no'];
}
if (isset($_GET['job_no'])) {
    $job_no = $_GET['job_no'];
    $job_no_main = $_GET['job_no'];
}
if (isset($_GET['lab_no'])) {
    $lab_no = $_GET['lab_no'];
    $aa    = $_GET['lab_no'];
}
if (isset($_GET['ulr'])) {
    $ulr = $_GET['ulr'];
}
$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
    $row_select4 = mysqli_fetch_assoc($result_select4);
    $grade = $row_select4['upv_grade'];
    $ultra_qty = $row_select4['ultra_qty'];
}

$test = "";
$select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
$result_select1 = mysqli_query($conn, $select_query1);
while ($r1 = mysqli_fetch_array($result_select1)) {

    $test .= $r1['test_name'] . ",";
}

/*$select_query11 = "select chk_len from span_material_assign,job,upv WHERE 
		
		upv.lab_no = span_material_assign.lab_no and  
		job.trf_no = span_material_assign.trf_no"; 
		$result_select11 = mysqli_query($conn, $select_query11);
		echo $result_select11;
		*/

?>
<!-- STYLE PUT VAIBHAV-->
<div class="content-wrapper" style="margin-left:0px !important;">
    <!-- Content Header (Page header) -->
    <section class="content common_material p-0">
        <!-- MENU INCLUDE VAIBHAV-->
        <?php include("menu.php") ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h2 style="text-align:center;">Ultrasonic Pulse Vilocity</h2>
                    </div>
                    <!--<div class="box-default">-->
                    <form class="form" id="Glazed" method="post">
                        <!-- REPORT NO AND JOB NO PUT VAIBHAV-->
                        <div class="row">
                            <Br>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no; ?>" name="report_no" ReadOnly>
                                        <input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <br>
                        <!-- LAB NO PUT VAIBHAV-->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="chk_auto">Job No. :</label>
                                        <input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" id="cc_sample_qty" value="<?php echo $ultra_qty; ?>" onchange="set_sample_qty()" name="cc_sample_qty">
                                        <input type="hidden" class="form-control" id="cc_sample_qty_old" value="<?php echo $cc_sample_qty; ?>" name="cc_sample_qty_old">
										<input type="hidden" class="form-control" tabindex="4" id="upv_qty" value="<?php echo $ultra_qty; ?>" name="upv_qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="grade">Grade :</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="grade" id="grade">
                                            <option value="M-10">M - 10</option>
                                            <option value="M-15">M - 15</option>
                                            <option value="M-20">M - 20</option>
                                            <option value="M-25">M - 25</option>
                                            <option value="M-30">M - 30</option>
                                            <option value="M-35">M - 35</option>
                                            <option value="M-40">M - 40</option>
                                            <option value="M-45">M - 45</option>
                                            <option value="M-50">M - 50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Nikunj Code Start-->
                        <?php
                        $is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

                        $result_upload = mysqli_query($conn, $is_upload);
                        if (mysqli_num_rows($result_upload) > 0) {


                        ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_file">
                                            <h4 class="panel-title">
                                                <b>FILE UPLOAD</b>
                                            </h4>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_file" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="col-sm-2">
                                                        <a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="inputEmail3" class="control-label">Upload Excel :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" class="form-control" id="upload_excel" name="upload_excel">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div id="view_excel_from_table">
                                                    <table border="1px solid black" align="center" width="100%">
                                                        <tr>
                                                            <th>Download</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php
                                                        $query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no_main' and report_no='$report_no'";
                                                        $result_file = mysqli_query($conn, $query_file);
                                                        if (mysqli_num_rows($result_file) > 0) {
                                                            while ($r_file = mysqli_fetch_array($result_file)) {
                                                        ?>
                                                                <tr>
                                                                    <td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
                                                                    <td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id']; ?>">Delete</a></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            <?php }     ?>
                            <?php
                            $test_check;
                            $select_query12 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
                            $result_select12 = mysqli_query($conn, $select_query12);
                            while ($r12 = mysqli_fetch_array($result_select12)) {
                                if ($r12['test_code'] == "upv") {
                                    $test_check .= "upv,";
                            ?>
                                    <div class="panel panel-default" id="upv">
                                        <div class="panel-heading" id="txtupv">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_upv">
                                                    <h4 class="panel-title">
                                                        <b>ULTRASOLIC PULSE VILOCITY</b>
                                                    </h4>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_upv" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <div class="col-sm-1">
                                                                <label for="chk_upv">1.</label>
                                                                <input type="checkbox" class="visually-hidden" name="chk_upv" id="chk_upv" value="chk_upv"><br>
                                                            </div>
                                                            <label for="inputEmail3" class="col-sm-4 control-label label-right">ULTRASOLIC PULSE VILOCITY</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Structure Details</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Pulse Travel Time <br>(μsec)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Element Length <br> (mm)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"> Velocity <br> (km/Sec)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">Concrete Quality <br> Grading</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">1.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="upv_detailes" name="upv_detailes">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="time_1" name="time_1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="dist_1" name="dist_1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="velo_1" name="velo_1" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="grading_1" name="grading_1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">2.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">D-Bldg,2nd Floor Beam B- 02 <br> Age/Casting - Above 28 Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="time_2" name="time_2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="dist_2" name="dist_2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="velo_2" name="velo_2" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="grading_2" name="grading_2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">3.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">D-Bldg,2nd Floor Beam B- 03 <br> Age/Casting - Above 28 Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="time_3" name="time_3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="dist_3" name="dist_3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="velo_3" name="velo_3" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="grading_3" name="grading_3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">4.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">D-Bldg,2nd Floor Beam B- 04 <br> Age/Casting - Above 28 Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="time_4" name="time_4">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="dist_4" name="dist_4">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="velo_4" name="velo_4" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="grading_4" name="grading_4">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">5.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label">D-Bldg,2nd Floor Beam B- 05 <br> Age/Casting - Above 28 Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="time_5" name="time_5">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="dist_5" name="dist_5">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="velo_5" name="velo_5" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="grading_5" name="grading_5">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            }
                            ?>

                            </div>

                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <?php
                                            $query = "select * from upv WHERE lab_no='$_GET[lab_no]' and `is_deleted`='0'";
                                            $result = mysqli_query($conn, $query);
                                            $r = mysqli_fetch_array($result);
                                            ?>
                                            <a href="javascript:void(0);" class="btn btn-info pull-right" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;">DELETE ALL REPORT</a>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
                                            <input type="hidden" class="form-control" name="idEdit" id="idEdit" />

                                        </div>
                                        <div class="col-sm-2">
                                            <!--<button type="button" class="btn btn-info pull-right" id="btn_auto" name="btn_auto" tabindex="14" >Auto</button>
											
											
											<button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)" >Back</button>
											<input type="hidden" class="form-control" name="id" id="idEdit"/>
										</div>
										<div class="col-sm-2">
											<!-- SAVE BUTTON LOGIC VAIBHAV-->

                                            <?php
                                            $querys_job1 = "SELECT * FROM upv WHERE `is_deleted`='0' and lab_no='$lab_no'";
                                            $qrys_jobno = mysqli_query($conn, $querys_job1);
                                            $rows = mysqli_num_rows($qrys_jobno);
                                            //if ($rows < ($ultra_qty)) { ?>
                                                <button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
                                            <?php //}
                                            ?>
                                        </div>

                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>
                                        </div>
                                        <!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
                                        <?php
                                        $val1 =  $_SESSION['isadmin'];
                                        $val = explode(",", $val1);

                                        // Code For Reception 1	
                                        // if (in_array(0, $val) || in_array(5, $val) || in_array(6, $val)) {
                                        ?>
                                            <div class="col-sm-2">
                                                <a target='_blank' href="<?php echo $base_url; ?>print_report/report_upv_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $ulr; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
                                            </div>


                                        <?php// } ?>
                                        <div class="col-sm-2">
                                            <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_upv_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Sheet</b></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- DISPLAY DATA LOGIC VAIBHAV-->
                            <div id="display_data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table border="1px solid black" align="center" width="100%" id="aaaa">
                                            <tr>
                                                <th style="text-align:center;" width="10%"><label>Actions</label></th>
                                                <!--<th style="text-align:center;"><label>Report No.</label></th>-->
                                                <th style="text-align:center;"><label>Lab No.</label></th>
                                                <th style="text-align:center;"><label>Job No.</label></th>
                                                <th style="text-align:center;"><label>Dia</label></th>
                                                <th style="text-align:center;"><label>Heat No.</label></th>
                                                <th style="text-align:center;"><label>Sample Id</label></th>



                                            </tr>
                                            <?php
                                            $query = "select * from upv WHERE lab_no='$aa'  and `is_deleted`='0'";

                                            $result = mysqli_query($conn, $query);


                                            if (mysqli_num_rows($result) > 0) {
                                                while ($r = mysqli_fetch_array($result)) {

                                                    if ($r['is_deleted'] == 0) {
                                            ?>
                                                        <tr>
                                                            <td style="text-align:center;" width="10%">

                                                                <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
                                                                <?php
                                                                //$val =  $_SESSION['isadmin'];
                                                                //if($val == 0 || $val == 5){
                                                                ?>
                                                                <!-- <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?ccDelete(<? php // echo $r['id']; 
                                                                                                                                                                                                ?>):false;"></a> -->
                                                                <?php
                                                                //}
                                                                ?>
                                                            </td>
                                                            <!--<td style="text-align:center;"><?php //echo $r['report_no'];
                                                                                                ?></td>-->
                                                            <td style="text-align:center;"><?php echo $r['job_no']; ?></td>
                                                            <td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
                                                            <td style="text-align:center;"><?php echo $r['dia']; ?></td>
                                                            <td style="text-align:center;"><?php echo $r['heat_no']; ?></td>
                                                            <td style="text-align:center;"><?php echo $r['labno1']; ?></td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>

                                        </table>
                                    </div>
                                </div>

                                <hr>
                            </div> <!-- TEST LIST FILD VAIBHAV-->
                            <input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("footer.php"); ?>
<script>
    getGlazedTiles();
    $("#btn_upload_excel").click(function() {
        form_data = new FormData();
        var acb = $('#upload_excel').val();
        if (acb == "") {
            alert("Upload excel First");
            return false;
        }
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no_main; ?>";
        var report_no = "<?php echo $report_no; ?>";

        var file_data = $('#upload_excel').prop('files')[0];
        var form_data = new FormData(); // Create a FormData object
        form_data.append('file', file_data); // Append all element in FormData  object
        form_data.append('lab_no', lab_no); // Append all element in FormData  object
        form_data.append('job_no', job_no); // Append all element in FormData  object
        form_data.append('report_no', report_no); // Append all element in FormData  object

        $.ajax({
            url: '<?php $base_url; ?>excel_upload_test.php', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(output) {
                get_excel_record(); // display response from the PHP script, if any
            }
        });
        $('#upload_excel').val('');


    });

    function get_excel_record() {
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no_main; ?>";
        var report_no = "<?php echo $report_no; ?>";
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>excel_upload_test.php',
            data: 'action_type=get_excel_record&lab_no=' + lab_no + '&job_no=' + job_no + '&report_no=' + report_no,
            success: function(html) {
                $('#view_excel_from_table').html(html);

            }
        });
    }

    $(function() {
        $('.select2').select2();
    })
    $(document).ready(function() {
        $('#btn_edit_data').hide();
        $('#alert').hide();
    });


    function upv_auto() {
        $('#txtupv').css("background-color", "var(--success)");
        $('#time_1').val(1);
        $('#dist_1').val(1);
        $('#velo_1').val(1);
        $('#grading_1').val(1);
        $('#time_2').val(1);
        $('#dist_2').val(1);
        $('#velo_2').val(1);
        $('#grading_2').val(1);
        $('#time_3').val(1);
        $('#dist_3').val(1);
        $('#velo_3').val(1);
        $('#grading_3').val(1);
        $('#time_4').val(1);
        $('#dist_4').val(1);
        $('#velo_4').val(1);
        $('#grading_4').val(1);
        $('#time_5').val(1);
        $('#dist_5').val(1);
        $('#velo_5').val(1);
        $('#grading_5').val(1);
    }

    $('#chk_upv').change(function() {
        if (this.checked) {
            upv_auto();
        } else {
            $('#txtupv').css("background-color", "white");
            $('#time_1').val(null);
            $('#dist_1').val(null);
            $('#velo_1').val(null);
            $('#grading_1').val(null);
            $('#time_2').val(null);
            $('#dist_2').val(null);
            $('#velo_2').val(null);
            $('#grading_2').val(null);
            $('#time_3').val(null);
            $('#dist_3').val(null);
            $('#velo_3').val(null);
            $('#grading_3').val(null);
            $('#time_4').val(null);
            $('#dist_4').val(null);
            $('#velo_4').val(null);
            $('#grading_4').val(null);
            $('#time_5').val(null);
            $('#dist_5').val(null);
            $('#velo_5').val(null);
            $('#grading_5').val(null);
        }
    });

    $('#time_1, #dist_1').change(function() {
        var time_1 = $('#time_1').val();
        var dist_1 = $('#dist_1').val();
        var velo_1 = (+dist_1) / (+time_1);
        $('#velo_1').val((+velo_1).toFixed(2));
        var velo_1 = $('#velo_1').val();
        if ((+velo_1) > 4.50) {
            $('#grading_1').val('Excellent');
        } else if (((+velo_1) > 3.75) && ((+velo_1) < 4.50)) {
            $('#grading_1').val('Good');
        } else {
            $('#grading_1').val('Doubtful');
        }



    });





    $('#chk_auto').change(function() {
        if (this.checked) {
            $("#chk_upv").prop("checked", true);
            upv_auto();
        }
    });

    function randomNumberFromRange(min, max) {
        //return Math.floor(Math.random()*(max-min+1)+min);
        return Math.random() * (max - min) + min;
    }

    $("#btn_edit_data").click(function() {
        $('#btn_edit_data').hide();
        $('#btn_save').show();
    });

    function getGlazedTiles() {
        var lab_no = $('#lab_no').val();
        var report_no = $('#report_no').val();
        var job_no = $('#job_no').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: 'action_type=view&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
            success: function(html) {
                $('#display_data').html(html);
            }
        });

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: 'action_type=chk&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
            success: function(data) {
                var save_data = data.total_row;
				 var sam_qty = $('#cc_sample_qty').val();
                var up_data = $('#report_cnt').val();
                // if(save_data < up_data)
                // {
                	// $('#btn_save').show();

                // }
                // else
                // {
                	// $('#btn_save').hide();

                // }

            }
        });
    }

    function ccDelete(id) {
        var lab_no = $('#lab_no').val();
        var job_no = $('#job_no').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: 'action_type=delete&id=' + id + '&lab_no=' + lab_no + '&job_no=' + job_no,
            dataType: 'JSON',
            success: function(msg) {

                getGlazedTiles();
                location.reload();


            }
        });
    }


    function saveMetal(type, id) {
        id = (typeof id == "undefined") ? '' : id;
        var statusArr = {
            add: "added",
            edit: "updated",
            delete: "deleted"
        };
        var billData = '';
        if (type == 'add') {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var ulr = $('#ulr').val();

            var grade = $('#grade').val();

            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //UPV Properties
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "upv") {
                    if (document.getElementById('chk_upv').checked) {
                        var chk_upv = "1";
                    } else {
                        var chk_upv = "0";
                    }
                    var upv_detailes = $('#upv_detailes').val();
                    var time_1 = $('#time_1').val();
                    var dist_1 = $('#dist_1').val();
                    var velo_1 = $('#velo_1').val();
                    var grading_1 = $('#grading_1').val();
                    var time_2 = $('#time_2').val();
                    var dist_2 = $('#dist_2').val();
                    var velo_2 = $('#velo_2').val();
                    var grading_2 = $('#grading_2').val();
                    var time_3 = $('#time_3').val();
                    var dist_3 = $('#dist_3').val();
                    var velo_3 = $('#velo_3').val();
                    var grading_3 = $('#grading_3').val();
                    var time_4 = $('#time_4').val();
                    var dist_4 = $('#dist_4').val();
                    var velo_4 = $('#velo_4').val();
                    var grading_4 = $('#grading_4').val();
                    var time_5 = $('#time_5').val();
                    var dist_5 = $('#dist_5').val();
                    var velo_5 = $('#velo_5').val();
                    var grading_5 = $('#grading_5').val();
                    break;
                }
            }

            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&grade=' + grade + '&chk_upv=' + chk_upv + '&time_1=' + time_1 + '&dist_1=' + dist_1 + '&velo_1=' + velo_1 + '&grading_1=' + grading_1 + '&time_2=' + time_2 + '&dist_2=' + dist_2 + '&velo_2=' + velo_2 + '&grading_2=' + grading_2 + '&time_3=' + time_3 + '&dist_3=' + dist_3 + '&velo_3=' + velo_3 + '&grading_3=' + grading_3 + '&time_4=' + time_4 + '&dist_4=' + dist_4 + '&velo_4=' + velo_4 + '&grading_4=' + grading_4 + '&time_5=' + time_5 + '&dist_5=' + dist_5 + '&velo_5=' + velo_5 + '&grading_5=' + grading_5 + '&upv_detailes=' + upv_detailes;
        } else if (type == 'edit') {

            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var grade = $('#grade').val();

            var idEdit = $('#idEdit').val();
            var temp = $('#test_list').val();
            var aa = temp.split(",");


            //UPV Properties
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "upv") {
                    if (document.getElementById('chk_upv').checked) {
                        var chk_upv = "1";
                    } else {
                        var chk_upv = "0";
                    }
                    var upv_detailes = $('#upv_detailes').val();
                    var time_1 = $('#time_1').val();
                    var dist_1 = $('#dist_1').val();
                    var velo_1 = $('#velo_1').val();
                    var grading_1 = $('#grading_1').val();
                    var time_2 = $('#time_2').val();
                    var dist_2 = $('#dist_2').val();
                    var velo_2 = $('#velo_2').val();
                    var grading_2 = $('#grading_2').val();
                    var time_3 = $('#time_3').val();
                    var dist_3 = $('#dist_3').val();
                    var velo_3 = $('#velo_3').val();
                    var grading_3 = $('#grading_3').val();
                    var time_4 = $('#time_4').val();
                    var dist_4 = $('#dist_4').val();
                    var velo_4 = $('#velo_4').val();
                    var grading_4 = $('#grading_4').val();
                    var time_5 = $('#time_5').val();
                    var dist_5 = $('#dist_5').val();
                    var velo_5 = $('#velo_5').val();
                    var grading_5 = $('#grading_5').val();
                    break;
                }
            }

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&grade=' + grade + '&chk_upv=' + chk_upv + '&time_1=' + time_1 + '&dist_1=' + dist_1 + '&velo_1=' + velo_1 + '&grading_1=' + grading_1 + '&time_2=' + time_2 + '&dist_2=' + dist_2 + '&velo_2=' + velo_2 + '&grading_2=' + grading_2 + '&time_3=' + time_3 + '&dist_3=' + dist_3 + '&velo_3=' + velo_3 + '&grading_3=' + grading_3 + '&time_4=' + time_4 + '&dist_4=' + dist_4 + '&velo_4=' + velo_4 + '&grading_4=' + grading_4 + '&time_5=' + time_5 + '&dist_5=' + dist_5 + '&velo_5=' + velo_5 + '&grading_5=' + grading_5 + '&upv_detailes=' + upv_detailes;
        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: billData,
            dataType: 'JSON',
            success: function(msg) {
				
				var sam_qty = $('#cc_sample_qty').val();
                if (msg.row_count >= (+sam_qty)) {
                    $('#btn_save').hide();
                } else {
                    $('#btn_save').show();
                }
				
                getGlazedTiles();
                var report_no = $('#report_no').val();
                var job_no = $('#job_no').val();
                //window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;

                location.reload();
            }
        });
    }

    function editData(id) {
        var lab_no = $('#lab_no').val();
        var report_no = $('#report_no').val();
        var job_no = $('#job_no').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
            success: function(data) {
                $('#idEdit').val(data.id);
                var idEdit = $('#idEdit').val();
                $('#report_no').val(data.report_no);
                $('#job_no').val(data.job_no);
                $('#lab_no').val(data.lab_no);
                $('#grade').val(data.grade);

                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //UPV Properties
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "upv") {
                        var chk_upv = data.chk_upv;
                        if (chk_upv == "1") {
                            $('#txtupv').css("background-color", "var(--success)");
                            $("#chk_upv").prop("checked", true);
                        } else {
                            $('#txtupv').css("background-color", "white");
                            $("#chk_upv").prop("checked", false);
                        }

                        $('#upv_detailes').val(data.upv_detailes);
                        $('#time_1').val(data.time_1);
                        $('#dist_1').val(data.dist_1);
                        $('#velo_1').val(data.velo_1);
                        $('#grading_1').val(data.grading_1);
                        $('#time_2').val(data.time_2);
                        $('#dist_2').val(data.dist_2);
                        $('#velo_2').val(data.velo_2);
                        $('#grading_2').val(data.grading_2);
                        $('#time_3').val(data.time_3);
                        $('#dist_3').val(data.dist_3);
                        $('#velo_3').val(data.velo_3);
                        $('#grading_3').val(data.grading_3);
                        $('#time_4').val(data.time_4);
                        $('#dist_4').val(data.dist_4);
                        $('#velo_4').val(data.velo_4);
                        $('#grading_4').val(data.grading_4);
                        $('#time_5').val(data.time_5);
                        $('#dist_5').val(data.dist_5);
                        $('#velo_5').val(data.velo_5);
                        $('#grading_5').val(data.grading_5);
                        break;
                    }
                }

                $('#btn_edit_data').show();
                $('#btn_save').hide();
            }
        });
    }



    $(document).on("click", ".delete_excels", function() {
        var clicked_id = $(this).attr("data-id");


        $.confirm({
            title: "warning",
            content: "Are You Sure To Delete This Excel?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>excel_upload_test.php',
                        data: 'action_type=delete_excels&clicked_id=' + clicked_id,
                        success: function(html) {
                            location.reload();

                        }
                    });

                },
                cancel: function() {
                    return;
                }
            }
        })
    });
	function set_sample_qty() {
        var trf_no = $('#trf_no').val();
        var job_no = $('#job_no').val();
        var lab_no = $('#lab_no').val();
        var cc_sample_qty = $('#cc_sample_qty').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_upv_test.php',
            data: 'action_type=set_sample_qty&trf_no=' + trf_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&cc_sample_qty=' + cc_sample_qty,
            dataType: 'JSON',
            success: function(msg) {
                if (msg.status == 'success') {
                    alert('Sample QTY Set Successfull.');
                    var cc_sample_qty_old = $('#cc_sample_qty_old').val();
                    if ((+cc_sample_qty > (+cc_sample_qty_old))) {
                        $('#btn_save').show();
                    } else {
                        $('#btn_save').hide();
                    }
                } else {
                    alert('Sample QTY Set Failed.');
                }
            }
        });
    }

    /*
    $(document).on("change", "#l_1", function () {
    				var clicked_id = $(this).val();  
    			var multipling= parseFloat(clicked_id)*10000;	
    			$('#len_1').val(multipling);
    			alert("jjj"+multipling);
        
    });	*/
</script>