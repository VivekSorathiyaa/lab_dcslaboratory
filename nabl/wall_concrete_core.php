<?php
include("header.php");
include("connection.php");
error_reporting(1);
session_start();

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

$jobQuery = "SELECT * FROM `job` WHERE `trf_no`='$trf_no' AND `job_number`='$job_no'";
$resQuery = mysqli_query($conn, $jobQuery);
$rowQuery = mysqli_fetch_array($resQuery);
$sample_rec_date = $rowQuery['sample_rec_date'];


$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
    $row_select4 = mysqli_fetch_assoc($result_select4);
    $tank_no = $row_select4['tanker_no'];
    $lot_no = $row_select4['lot_no'];
    $bitumin_grade = $row_select4['bitumin_grade'];
    $bitumin_make = $row_select4['bitumin_make'];
}

$get_final_table = "SELECT * FROM `final_material_assign_master` WHERE `trf_no`='$trf_no' AND `job_no`='$job_no' AND `lab_no`='$lab_no'";
$res_final_table = mysqli_query($conn, $get_final_table);
if (mysqli_num_rows($res_final_table) > 0) {
    $row_final_table = mysqli_fetch_array($res_final_table);
    $core_qty = $row_final_table['core_qty'];
    $amend_date = $row_final_table['amend_date'];
}


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
                        <h2 style="text-align:center;"> WALL CONCRETE CORE</h2>
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
                                        <input type="hidden" class="form-control" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <br>
                        <!-- LAB NO PUT VAIBHAV-->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="chk_auto">Job No. :</label>
                                        <input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="chk_auto">Sample QTY:</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="cc_sample_qty" value="<?php echo $core_qty; ?>" onchange="set_sample_qty()" name="cc_sample_qty">
                                        <input type="hidden" class="form-control" id="cc_sample_qty_old" value="<?php echo $cc_sample_qty; ?>" name="cc_sample_qty_old">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="chk_auto">Remarks :</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="re1" name="re1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                            <label>Grade :</label>
                                        </div>								 
                                    <div class="col-sm-8">
                                    <!--<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">-->
									<select class="form-control" id="amend_date" name="amend_date" value="<?php echo $amend_date; ?>">
												<option value="">Grade</option>
												<option value="M-5">M - 5</option>
												<option value="M-7.5">M - 7.5</option>
												<option value="M-10">M - 10</option>
												<option value="M-15">M - 15</option>
												<option value="M-20">M - 20</option>
												<option value="M-25">M - 25</option>
												<option value="M-30">M - 30</option>
												<option value="M-35">M - 35</option>
												<option value="M-40">M - 40</option>
												<option value="M-45">M - 45</option>
												<option value="M-50">M - 50</option>
												<option value="1:3:6">1:3:6</option>
												<option value="1:2:4">1:2:4</option>
												<option value="1:1.5:3">1:1.5:3</option>
												<option value="1:5">1:5</option>
												<option value="1:3">1:3</option>

											</select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
                                        <input type="hidden" class="form-control" name="idEdit" id="idEdit" />

                                    </div>
                                    <div class="col-sm-2">
                                        <!-- SAVE BUTTON LOGIC VAIBHAV-->
                                        <?php
                                        $querys_job1 = "SELECT * FROM wall_concrete_core WHERE `is_deleted`='0' and lab_no='$lab_no'";
                                        $qrys_jobno = mysqli_query($conn, $querys_job1);
                                        $rows = mysqli_num_rows($qrys_jobno);
                                        //if($rows < $cc_sample_qty){ 
                                        ?>
                                        <button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
                                        <?php //}													
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>
                                    </div>
                                    <!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
                                    <?php
                                    $val =  $_SESSION['isadmin'];
                                    //if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {
                                    ?>
                                    <div class="col-sm-2">
                                        <a target='_blank' href="<?php echo $base_url; ?>print_report/print_wall_concrete_core.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
                                    </div>

                                    <? php // } 
                                    ?>
                                    <div class="col-sm-2">
                                        <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_wall_concrete_core.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="panel-group" id="accordion">
                            <?php
                            $is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

                            $result_upload = mysqli_query($conn, $is_upload);
                            if (mysqli_num_rows($result_upload) > 0) { ?>

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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-sm-4">
                                                            <div class="col-sm-2">
                                                                <a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>">Row Data</a>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="inputEmail3" class="control-label">Upload Excel :</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="file" class="form-control" id="upload_excel" name="upload_excel">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
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
                                        </div>
                                        <br>
                                    </div>
                                    <?php }
                                $test_check;
                                $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
                                $result_select1 = mysqli_query($conn, $select_query1);
                                while ($r1 = mysqli_fetch_array($result_select1)) {
                                    if ($r1['test_code'] == "com") {
                                        $test_check .= "com,";
                                    ?>
                                        <div class="panel panel-default" id="com">
                                            <div class="panel-heading" id="txtcom">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_com">
                                                        <h4 class="panel-title">
                                                            <b>COMPRESSIVE STRENGTH</b>
                                                        </h4>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_com" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label for="chk_com">1.</label>
                                                                    <input type="checkbox" class="visually-hidden" name="chk_com" id="chk_com" value="chk_com"><br>
                                                                </div>
                                                                <label for="inputEmail3" class="col-sm-4 control-label label-right">COMPRESSIVE STRENGTH</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
													<div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Road No.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Chainage</label>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Location on Road</label>
                                                            </div>
                                                        </div>
														
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Binder Content (%)</label>
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='road_no' name='road_no'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='Chainage' name='Chainage'>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='location1' name='location1'>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='bic_1' name='bic_1'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Weight (gm)</label>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Dia (mm)</label>
                                                            </div>
                                                        </div>
														
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">length (mm)</label>
                                                            </div>
                                                        </div>
														
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">width (mm)</label>
                                                            </div>
                                                        </div>
														
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Height (mm)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Area (mm<sup>2</sup>)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">H/D Ratio</label>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='weight1' name='weight1'>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='dia1' name='dia1'>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='length1' name='length1'>
                                                            </div>
                                                        </div>
                                                        
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='width1' name='width1'> 
                                                            </div>
                                                        </div>
                                                       
													   <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='height1' name='height1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='area1' name='area1' disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='hd_ratio1' name='hd_ratio1'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                     <div class="row">
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Volume (m3)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Density (gm / cm<sup>3</sup>)</label>
                                                            </div>
                                                        </div>
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Density (gm / cc)</label>
                                                            </div>
                                                        </div>
														
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Load (kN)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Compressive Strength (N/mm2)</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Diameter Correction</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">H/D Correction</label>
                                                            </div>
                                                        </div>
                                                    </div>
													
                                                    <br>
                                                     <div class="row">
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='vol1' name='vol1'disabled>
                                                            </div>
                                                        </div>
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='den1' name='den1'>
                                                            </div>
                                                        </div>
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='den2' name='den2'disabled>
                                                            </div>
                                                        </div>
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='load1' name='load1'>
                                                            </div>
                                                        </div>
														<div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='com1' name='com1'disabled>
                                                            </div>
                                                        </div>
                                                         <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='dia_corr1' name='dia_corr1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='hd_corr1' name='hd_corr1'>
                                                            </div>
                                                        </div>
														
                                                        
                                                        
                                                       
                                                    </div>
                                                    <br>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Corrected Compressive Strength</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Equiv. Cube Strength (N/mm2)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Casting Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="control-label text-center">Age of Concrete</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='corr_com1' name='corr_com1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='eq_cube1' name='eq_cube1'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control startdate_class" id='casting_date' name='casting_date'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id='age1' name='age1'>
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
                                <hr>
                                <div id="display_data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table border="1px solid black" align="center" width="100%" id="aaaa">
                                                <tr>
                                                    <th style="text-align:center;" width="2%"><label>Actions</label></th>
                                                    <th style="text-align:center;width:10%;"><label>Lab No.</label></th>
                                                    <!--<th style="text-align:center;"><label>Job No.</label></th>-->
                                                    <th style="text-align:center;width:5%;"><label>Weight</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Dia</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Height</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Area</label></th>
                                                    <th style="text-align:center;width:5%;"><label>H/D <br> Ratio</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Volume</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Density</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Load</label></th>
                                                    <th style="text-align:center;width:5%;"><label>Comp. Str.</label></th>
                                                    <th style="text-align:center;width:8%;"><label>Diameter <br> Correction</label></th>
                                                    <th style="text-align:center;width:8%;"><label>H/D <br> Correction</label></th>
                                                    <th style="text-align:center;width:8%;"><label>Corrected <br> Comp. Str.</label></th>
                                                    <th style="text-align:center;width:8%;"><label>Equiv. Cube <br> Strength</label></th>
                                                </tr>
                                                <?php
                                                $query = "select * from wall_concrete_core WHERE lab_no='$aa'  and `is_deleted`='0'";
                                                $result = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($r = mysqli_fetch_array($result)) {
                                                        if ($r['is_deleted'] == 0) {
                                                ?>
                                                            <tr>
                                                                <td style="text-align:center;" width="2%">
                                                                    <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
                                                                    <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
                                                                </td>
                                                                <td style="text-align:center;"><?php echo $r['job_no']; ?></td>
                                                                <!--<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>-->
                                                                <td style="text-align:center;"><?php echo $r['weight1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['dia1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['height1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['area1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['hd_ratio1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['vol1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['den1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['load1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['com1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['dia_corr1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['hd_corr1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['corr_com1']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['eq_cube1']; ?></td>
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
                                </div>
                                <!-- TEST LIST FILD VAIBHAV-->
                                <input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("footer.php"); ?>
<script>
    $(function() {
        $('.select2').select2();
    });
    $('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
    $('.startdate_class').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd'
	});




    $(document).ready(function() {
        $('#btn_edit_data').hide();
        $('#alert').hide();

        function com_auto() {
            $('#txtcom').css("background-color", "var(--success)");
            var eq_cube1 = randomNumberFromRange(26.00, 40.00);
            $('#eq_cube1').val((+eq_cube1).toFixed(2));

            var eq_cube1 = $('#eq_cube1').val();
            var corr_com1 = (+eq_cube1) / 1.25;
            $('#corr_com1').val((+corr_com1).toFixed(2));

            var weight1 = randomNumberFromRange(610.0, 631.00);
            $('#weight1').val((+weight1).toFixed(1));
			
			var length1 = randomNumberFromRange(149.0, 151.00);
            $('#length1').val((+length1).toFixed(1));

			var width1 = randomNumberFromRange(149.0, 151.00);
            $('#width1').val((+width1).toFixed(1));

            var dia1 = randomNumberFromRange(53.50, 54.90);
            $('#dia1').val((+dia1).toFixed(2));
            var dia1 = $('#dia1').val();

            var area1 = ((+3.141592653589793238) / 4 * (+dia1) * (+dia1));
            $('#area1').val((+area1).toFixed(2));

            var hd_ratio1 = randomNumberFromRange(1.92, 2.00);
            $('#hd_ratio1').val((+hd_ratio1).toFixed(2));
            var hd_ratio1 = $('#hd_ratio1').val();

            var height1 = (+dia1) * (+hd_ratio1);
            $('#height1').val((+height1).toFixed(2));

            var height1 = $('#height1').val();
            var area1 = $('#area1').val();

            var vol1 = ((+area1) * (+height1)) / 1000000000;
            $('#vol1').val((+vol1).toFixed(5));

            var weight1 = $('#weight1').val();
            var vol1 = $('#vol1').val();

            var den1 = ((+weight1) / 1000) / (+vol1);
            $('#den1').val((+den1).toFixed(1));
			
			var den2 = $('#den1').val(); 
			var den2 = ((+den2) / (+1000));
 			$('#den2').val(den2.toFixed(3));

            if ((+$('#dia1').val()) > 70) {
                $('#dia_corr1').val(1.03);
            } else {
                $('#dia_corr1').val(1.06);
            }

            var hd_corr1 = $('#hd_corr1').val();
            var hd_corr1 = (+0.11) * (+hd_ratio1) + (+0.78);
            $('#hd_corr1').val((+hd_corr1).toFixed(3));


            var corr_com1 = $('#corr_com1').val();
            var hd_corr1 = $('#hd_corr1').val();
            var dia_corr1 = $('#dia_corr1').val();

            var com1 = (+corr_com1) / (+hd_corr1) / (+dia_corr1);
            $('#com1').val((+com1).toFixed(2));

            var area1 = $('#area1').val();
            var com1 = $('#com1').val();

            var load1 = ((+area1) * (+com1)) / 1000;
            $('#load1').val((+load1).toFixed(2));
        }

        $('#chk_com').change(function() {
            if (this.checked) {
                com_auto();
            } else {
                $('#txtcom').css("background-color", "white");
                $('#location1').val(null);
                $('#road_no').val(null);
                $('#Chainage').val(null);
                $('#bic_1').val(null);
                $('#location3').val(null);
                $('#location4').val(null);
                $('#weight1').val(null);
                $('#weight2').val(null);
                $('#weight3').val(null);
                $('#weight4').val(null);
                $('#dia1').val(null);
                $('#length1').val(null);
                $('#width1').val(null);
                $('#dia2').val(null);
                $('#dia3').val(null);
                $('#dia4').val(null);
                $('#height1').val(null);
                $('#height2').val(null);
                $('#height3').val(null);
                $('#height4').val(null);
                $('#area1').val(null);
                $('#area2').val(null);
                $('#area3').val(null);
                $('#area4').val(null);
                $('#hd_ratio1').val(null);
                $('#hd_ratio2').val(null);
                $('#hd_ratio3').val(null);
                $('#hd_ratio4').val(null);
                $('#vol1').val(null);
                $('#vol2').val(null);
                $('#vol3').val(null);
                $('#vol4').val(null);
                $('#den1').val(null);
                $('#den2').val(null);
                $('#den3').val(null);
                $('#den4').val(null);
                $('#load1').val(null);
                $('#load2').val(null);
                $('#load3').val(null);
                $('#load4').val(null);
                $('#com1').val(null);
                $('#com2').val(null);
                $('#com3').val(null);
                $('#com4').val(null);
                $('#dia_corr1').val(null);
                $('#dia_corr2').val(null);
                $('#dia_corr3').val(null);
                $('#dia_corr4').val(null);
                $('#hd_corr1').val(null);
                $('#hd_corr2').val(null);
                $('#hd_corr3').val(null);
                $('#hd_corr4').val(null);
                $('#corr_com1').val(null);
                $('#corr_com2').val(null);
                $('#corr_com3').val(null);
                $('#corr_com4').val(null);
                $('#eq_cube1').val(null);
                $('#eq_cube2').val(null);
                $('#eq_cube3').val(null);
                $('#eq_cube4').val(null);
                $('#casting_date').val(null);
                $('#age1').val(null);
                $('#re1').val(null);
            }
        });
		
		// sahil change
		
		$('#weight1,#height1,#length1,#width1,#load1').change(function(){
			
			var length1 = $('#length1').val();
 			var width1 = $('#width1').val();
 			var load1 = $('#load1').val();
 			var height1 = $('#height1').val();
 			var weight1 = $('#weight1').val();
 			
			
			var area1 = ((+length1) * (+width1));
 			$('#area1').val(area1.toFixed(2));
 			var area1 = $('#area1').val();
			
			var vol1 = ((+length1) * (+width1) * (+height1)) / (+1000000000);
 			$('#vol1').val(vol1.toFixed(4));
 			var vol1 = $('#vol1').val();
			
			var com1 = ((+load1) * (+1000)) / (+area1);
 			$('#com1').val(com1.toFixed(2));
 			$('#eq_cube1').val(com1.toFixed(2));
			var com1 = $('#com1').val();
			
			var den1 = ((+weight1) / (+1000)) / (+vol1);
 			$('#den1').val(den1.toFixed(2));
			
			var den2 = $('#den1').val(); 
			var den2 = ((+den2) / (+1000));
 			$('#den2').val(den2.toFixed(3));
			
			var corr_com1 = ((+com1) / (+1.25));
 			$('#corr_com1').val(corr_com1.toFixed(2));
			
		
		
		})
		$('#den1').change(function(){
			
			var den2 = $('#den1').val(); 
			var den2 = ((+den2) / (+1000));
 			$('#den2').val(den2.toFixed(3));
		
		})
		
		// sahil's Calculation done


        function randomNumberFromRange(min, max) {
            //return Math.floor(Math.random()*(max-min+1)+min);
            return Math.random() * (max - min) + min;
        }

        $('#chk_auto').change(function() {
            if (this.checked) {
                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //Compressive Strength
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "com") {
                        $('#txtcom').css("background-color", "var(--success)");
                        $("#chk_com").prop("checked", true);
                        com_auto();
                        break;
                    }
                }
            }

        });
    });




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

    $("#btn_edit_data").click(function() {
        $('#btn_edit_data').hide();

    });



    function getGlazedTiles() {
        var lab_no = $('#lab_no').val();
        var report_no = $('#report_no').val();
        var job_no = $('#job_no').val();
        var trf_no = $('#trf_no').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_wall_concrete_core.php',
            data: 'action_type=view&' + $("#Glazed").serialize() + '&lab_no=' + lab_no + '&job_no=' + job_no + '&trf_no=' + trf_no,
            success: function(html) {
                $('#display_data').html(html);
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
            var tank_no = $('#tank_no').val();
            var lot_no = $('#lot_no').val();
            var bitumin_grade = $('#bitumin_grade').val();
            var bitumin_make = $('#bitumin_make').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();
            var re1 = $('#re1').val();

            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //COMPRESSIVE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "com") {
                    if (document.getElementById('chk_com').checked) {
                        var chk_com = "1";
                    } else {
                        var chk_com = "0";
                    }

                    var location1 = $('#location1').val();
                    var location2 = $('#location2').val();
                    var location3 = $('#location3').val();
                    var location4 = $('#location4').val();
                    var road_no = $('#road_no').val();
                    var bic_1 = $('#bic_1').val();
                    var Chainage = $('#road_no').val();
                    var weight1 = $('#weight1').val();
                    var weight2 = $('#weight2').val();
                    var weight3 = $('#weight3').val();
                    var weight4 = $('#weight4').val();
                    var dia1 = $('#dia1').val();
                    var length1 = $('#length1').val();
                    var width1 = $('#width1').val();
                    var dia2 = $('#dia2').val();
                    var dia3 = $('#dia3').val();
                    var dia4 = $('#dia4').val();
                    var height1 = $('#height1').val();
                    var height2 = $('#height2').val();
                    var height3 = $('#height3').val();
                    var height4 = $('#height4').val();
                    var area1 = $('#area1').val();
                    var area2 = $('#area2').val();
                    var area3 = $('#area3').val();
                    var area4 = $('#area4').val();
                    var hd_ratio1 = $('#hd_ratio1').val();
                    var hd_ratio2 = $('#hd_ratio2').val();
                    var hd_ratio3 = $('#hd_ratio3').val();
                    var hd_ratio4 = $('#hd_ratio4').val();
                    var vol1 = $('#vol1').val();
                    var vol2 = $('#vol2').val();
                    var vol3 = $('#vol3').val();
                    var vol4 = $('#vol4').val();
                    var den1 = $('#den1').val();
                    var den2 = $('#den2').val();
                    var den3 = $('#den3').val();
                    var den4 = $('#den4').val();
                    var load1 = $('#load1').val();
                    var load2 = $('#load2').val();
                    var load3 = $('#load3').val();
                    var load4 = $('#load4').val();
                    var com1 = $('#com1').val();
                    var com2 = $('#com2').val();
                    var com3 = $('#com3').val();
                    var com4 = $('#com4').val();
                    var dia_corr1 = $('#dia_corr1').val();
                    var dia_corr2 = $('#dia_corr2').val();
                    var dia_corr3 = $('#dia_corr3').val();
                    var dia_corr4 = $('#dia_corr4').val();
                    var hd_corr1 = $('#hd_corr1').val();
                    var hd_corr2 = $('#hd_corr2').val();
                    var hd_corr3 = $('#hd_corr3').val();
                    var hd_corr4 = $('#hd_corr4').val();
                    var corr_com1 = $('#corr_com1').val();
                    var corr_com2 = $('#corr_com2').val();
                    var corr_com3 = $('#corr_com3').val();
                    var corr_com4 = $('#corr_com4').val();
                    var eq_cube1 = $('#eq_cube1').val();
                    var eq_cube2 = $('#eq_cube2').val();
                    var eq_cube3 = $('#eq_cube3').val();
                    var eq_cube4 = $('#eq_cube4').val();
                    var casting_date = $('#casting_date').val();
                    var age1 = $('#age1').val();
                    break;
                } else {
                    var chk_com = "0";
                    var location1 = "0";
                    var location2 = "0";
                    var location3 = "0";
                    var location4 = "0";
                    var Chainage = "0";
                    var bic_1 = "0";
                    var road_no = "0";
                    var weight1 = "0";
                    var weight2 = "0";
                    var weight3 = "0";
                    var weight4 = "0";
                    var dia1 = "0";
                    var length1 = "0";
                    var width1 = "0";
                    var dia2 = "0";
                    var dia3 = "0";
                    var dia4 = "0";
                    var height1 = "0";
                    var height2 = "0";
                    var height3 = "0";
                    var height4 = "0";
                    var area1 = "0";
                    var area2 = "0";
                    var area3 = "0";
                    var area4 = "0";
                    var hd_ratio1 = "0";
                    var hd_ratio2 = "0";
                    var hd_ratio3 = "0";
                    var hd_ratio4 = "0";
                    var vol1 = "0";
                    var vol2 = "0";
                    var vol3 = "0";
                    var vol4 = "0";
                    var den1 = "0";
                    var den2 = "0";
                    var den3 = "0";
                    var den4 = "0";
                    var load1 = "0";
                    var load2 = "0";
                    var load3 = "0";
                    var load4 = "0";
                    var com1 = "0";
                    var com2 = "0";
                    var com3 = "0";
                    var com4 = "0";
                    var dia_corr1 = "0";
                    var dia_corr2 = "0";
                    var dia_corr3 = "0";
                    var dia_corr4 = "0";
                    var hd_corr1 = "0";
                    var hd_corr2 = "0";
                    var hd_corr3 = "0";
                    var hd_corr4 = "0";
                    var corr_com1 = "0";
                    var corr_com2 = "0";
                    var corr_com3 = "0";
                    var corr_com4 = "0";
                    var eq_cube1 = "0";
                    var eq_cube2 = "0";
                    var eq_cube3 = "0";
                    var eq_cube4 = "0";
                    var casting_date = "";
                    var age1 = "0";
                }
            }

            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&ulr=' + ulr + '&chk_com=' + chk_com + '&location1=' + location1 + '&location2=' + location2 + '&location3=' + location3 + '&location4=' + location4 + '&road_no=' + road_no + '&Chainage=' + Chainage + '&bic_1=' + bic_1 + '&weight1=' + weight1 + '&weight2=' + weight2 + '&weight3=' + weight3 + '&weight4=' + weight4 + '&dia1=' + dia1 + '&length1=' + length1 + '&width1=' + width1 + '&dia2=' + dia2 + '&dia3=' + dia3 + '&dia4=' + dia4 + '&height1=' + height1 + '&height2=' + height2 + '&height3=' + height3 + '&height4=' + height4 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&area4=' + area4 + '&hd_ratio1=' + hd_ratio1 + '&hd_ratio2=' + hd_ratio2 + '&hd_ratio3=' + hd_ratio3 + '&hd_ratio4=' + hd_ratio4 + '&vol1=' + vol1 + '&vol2=' + vol2 + '&vol3=' + vol3 + '&vol4=' + vol4 + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&com1=' + com1 + '&com2=' + com2 + '&com3=' + com3 + '&com4=' + com4 + '&dia_corr1=' + dia_corr1 + '&dia_corr2=' + dia_corr2 + '&dia_corr3=' + dia_corr3 + '&dia_corr4=' + dia_corr4 + '&hd_corr1=' + hd_corr1 + '&hd_corr2=' + hd_corr2 + '&hd_corr3=' + hd_corr3 + '&hd_corr4=' + hd_corr4 + '&corr_com1=' + corr_com1 + '&corr_com2=' + corr_com2 + '&corr_com3=' + corr_com3 + '&corr_com4=' + corr_com4 + '&eq_cube1=' + eq_cube1 + '&eq_cube2=' + eq_cube2 + '&eq_cube3=' + eq_cube3 + '&eq_cube4=' + eq_cube4+ '&casting_date=' + casting_date+ '&age1=' + age1+ '&re1=' + re1+ '&amend_date=' + amend_date;

        } else if (type == 'edit') {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var tank_no = $('#tank_no').val();
            var lot_no = $('#lot_no').val();
            var bitumin_grade = $('#bitumin_grade').val();
            var bitumin_make = $('#bitumin_make').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();
            var re1 = $('#re1').val();

            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //COMPRESSIVE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "com") {
                    if (document.getElementById('chk_com').checked) {
                        var chk_com = "1";
                    } else {
                        var chk_com = "0";
                    }

                    var location1 = $('#location1').val();
                    var location2 = $('#location2').val();
                    var location3 = $('#location3').val();
                    var location4 = $('#location4').val();
                    var road_no = $('#road_no').val();
                    var bic_1 = $('#bic_1').val();
                    var Chainage = $('#road_no').val();
                    var weight1 = $('#weight1').val();
                    var weight2 = $('#weight2').val();
                    var weight3 = $('#weight3').val();
                    var weight4 = $('#weight4').val();
                    var dia1 = $('#dia1').val();
                    var length1 = $('#length1').val();
                    var width1 = $('#width1').val();
                    var dia2 = $('#dia2').val();
                    var dia3 = $('#dia3').val();
                    var dia4 = $('#dia4').val();
                    var height1 = $('#height1').val();
                    var height2 = $('#height2').val();
                    var height3 = $('#height3').val();
                    var height4 = $('#height4').val();
                    var area1 = $('#area1').val();
                    var area2 = $('#area2').val();
                    var area3 = $('#area3').val();
                    var area4 = $('#area4').val();
                    var hd_ratio1 = $('#hd_ratio1').val();
                    var hd_ratio2 = $('#hd_ratio2').val();
                    var hd_ratio3 = $('#hd_ratio3').val();
                    var hd_ratio4 = $('#hd_ratio4').val();
                    var vol1 = $('#vol1').val();
                    var vol2 = $('#vol2').val();
                    var vol3 = $('#vol3').val();
                    var vol4 = $('#vol4').val();
                    var den1 = $('#den1').val();
                    var den2 = $('#den2').val();
                    var den3 = $('#den3').val();
                    var den4 = $('#den4').val();
                    var load1 = $('#load1').val();
                    var load2 = $('#load2').val();
                    var load3 = $('#load3').val();
                    var load4 = $('#load4').val();
                    var com1 = $('#com1').val();
                    var com2 = $('#com2').val();
                    var com3 = $('#com3').val();
                    var com4 = $('#com4').val();
                    var dia_corr1 = $('#dia_corr1').val();
                    var dia_corr2 = $('#dia_corr2').val();
                    var dia_corr3 = $('#dia_corr3').val();
                    var dia_corr4 = $('#dia_corr4').val();
                    var hd_corr1 = $('#hd_corr1').val();
                    var hd_corr2 = $('#hd_corr2').val();
                    var hd_corr3 = $('#hd_corr3').val();
                    var hd_corr4 = $('#hd_corr4').val();
                    var corr_com1 = $('#corr_com1').val();
                    var corr_com2 = $('#corr_com2').val();
                    var corr_com3 = $('#corr_com3').val();
                    var corr_com4 = $('#corr_com4').val();
                    var eq_cube1 = $('#eq_cube1').val();
                    var eq_cube2 = $('#eq_cube2').val();
                    var eq_cube3 = $('#eq_cube3').val();
                    var eq_cube4 = $('#eq_cube4').val();
                    var casting_date = $('#casting_date').val();
                    var age1 = $('#age1').val();
                    break;
                } else {
                    var chk_com = "0";
                    var location1 = "0";
                    var location2 = "0";
                    var location3 = "0";
                    var location4 = "0";
                    var Chainage = "0";
                    var bic_1 = "0";
                    var road_no = "0";
                    var weight1 = "0";
                    var weight2 = "0";
                    var weight3 = "0";
                    var weight4 = "0";
                    var dia1 = "0";
                    var length1 = "0";
                    var width1 = "0";
                    var dia2 = "0";
                    var dia3 = "0";
                    var dia4 = "0";
                    var height1 = "0";
                    var height2 = "0";
                    var height3 = "0";
                    var height4 = "0";
                    var area1 = "0";
                    var area2 = "0";
                    var area3 = "0";
                    var area4 = "0";
                    var hd_ratio1 = "0";
                    var hd_ratio2 = "0";
                    var hd_ratio3 = "0";
                    var hd_ratio4 = "0";
                    var vol1 = "0";
                    var vol2 = "0";
                    var vol3 = "0";
                    var vol4 = "0";
                    var den1 = "0";
                    var den2 = "0";
                    var den3 = "0";
                    var den4 = "0";
                    var load1 = "0";
                    var load2 = "0";
                    var load3 = "0";
                    var load4 = "0";
                    var com1 = "0";
                    var com2 = "0";
                    var com3 = "0";
                    var com4 = "0";
                    var dia_corr1 = "0";
                    var dia_corr2 = "0";
                    var dia_corr3 = "0";
                    var dia_corr4 = "0";
                    var hd_corr1 = "0";
                    var hd_corr2 = "0";
                    var hd_corr3 = "0";
                    var hd_corr4 = "0";
                    var corr_com1 = "0";
                    var corr_com2 = "0";
                    var corr_com3 = "0";
                    var corr_com4 = "0";
                    var eq_cube1 = "0";
                    var eq_cube2 = "0";
                    var eq_cube3 = "0";
                    var eq_cube4 = "0";
                    var casting_date = "";
                    var age1 = "0";
                }
            }

            var idEdit = $('#idEdit').val();

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&ulr=' + ulr + '&chk_com=' + chk_com + '&location1=' + location1 + '&location2=' + location2 + '&location3=' + location3 + '&location4=' + location4 + '&road_no=' + road_no + '&Chainage=' + Chainage + '&bic_1=' + bic_1 + '&weight1=' + weight1 + '&weight2=' + weight2 + '&weight3=' + weight3 + '&weight4=' + weight4 + '&dia1=' + dia1 + '&length1=' + length1 + '&width1=' + width1 + '&dia2=' + dia2 + '&dia3=' + dia3 + '&dia4=' + dia4 + '&height1=' + height1 + '&height2=' + height2 + '&height3=' + height3 + '&height4=' + height4 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&area4=' + area4 + '&hd_ratio1=' + hd_ratio1 + '&hd_ratio2=' + hd_ratio2 + '&hd_ratio3=' + hd_ratio3 + '&hd_ratio4=' + hd_ratio4 + '&vol1=' + vol1 + '&vol2=' + vol2 + '&vol3=' + vol3 + '&vol4=' + vol4 + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&com1=' + com1 + '&com2=' + com2 + '&com3=' + com3 + '&com4=' + com4 + '&dia_corr1=' + dia_corr1 + '&dia_corr2=' + dia_corr2 + '&dia_corr3=' + dia_corr3 + '&dia_corr4=' + dia_corr4 + '&hd_corr1=' + hd_corr1 + '&hd_corr2=' + hd_corr2 + '&hd_corr3=' + hd_corr3 + '&hd_corr4=' + hd_corr4 + '&corr_com1=' + corr_com1 + '&corr_com2=' + corr_com2 + '&corr_com3=' + corr_com3 + '&corr_com4=' + corr_com4 + '&eq_cube1=' + eq_cube1 + '&eq_cube2=' + eq_cube2 + '&eq_cube3=' + eq_cube3 + '&eq_cube4=' + eq_cube4+ '&casting_date=' + casting_date+ '&age1=' + age1+ '&re1=' + re1+ '&amend_date=' + amend_date;
        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&id=' + id;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_wall_concrete_core.php',
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
            url: '<?php echo $base_url; ?>save_wall_concrete_core.php',
            data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
            success: function(data) {
                $('#idEdit').val(data.id);
                var idEdit = $('#idEdit').val();
                $('#report_no').val(data.report_no);
                $('#job_no').val(data.job_no);
                $('#lab_no').val(data.lab_no);
                $('#ulr').val(data.ulr);
                $('#amend_date').val(data.amend_date);
                $('#re1').val(data.re1);

                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //COMPRESSIVE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "com") {
                        var chk_com = data.chk_com;
                        if (chk_com == "1") {
                            $('#txtcom').css("background-color", "var(--success)");
                            $("#chk_com").prop("checked", true);

                        } else {
                            $('#txtcom').css("background-color", "white");
                            $("#chk_com").prop("checked", false);

                        }
                        $('#location1').val(data.location1);
                        $('#location2').val(data.location2);
                        $('#location3').val(data.location3);
                        $('#location4').val(data.location4);
                        $('#road_no').val(data.road_no);
                        $('#bic_1').val(data.bic_1);
                        $('#Chainage').val(data.Chainage);
                        $('#weight1').val(data.weight1);
                        $('#weight2').val(data.weight2);
                        $('#weight3').val(data.weight3);
                        $('#weight4').val(data.weight4);
                        $('#dia1').val(data.dia1);
                        $('#length1').val(data.length1);
                        $('#width1').val(data.width1);
                        $('#dia2').val(data.dia2);
                        $('#dia3').val(data.dia3);
                        $('#dia4').val(data.dia4);
                        $('#height1').val(data.height1);
                        $('#height2').val(data.height2);
                        $('#height3').val(data.height3);
                        $('#height4').val(data.height4);
                        $('#area1').val(data.area1);
                        $('#area2').val(data.area2);
                        $('#area3').val(data.area3);
                        $('#area4').val(data.area4);
                        $('#hd_ratio1').val(data.hd_ratio1);
                        $('#hd_ratio2').val(data.hd_ratio2);
                        $('#hd_ratio3').val(data.hd_ratio3);
                        $('#hd_ratio4').val(data.hd_ratio4);
                        $('#vol1').val(data.vol1);
                        $('#vol2').val(data.vol2);
                        $('#vol3').val(data.vol3);
                        $('#vol4').val(data.vol4);
                        $('#den1').val(data.den1);
                        $('#den2').val(data.den2);
                        $('#den3').val(data.den3);
                        $('#den4').val(data.den4);
                        $('#load1').val(data.load1);
                        $('#load2').val(data.load2);
                        $('#load3').val(data.load3);
                        $('#load4').val(data.load4);
                        $('#com1').val(data.com1);
                        $('#com2').val(data.com2);
                        $('#com3').val(data.com3);
                        $('#com4').val(data.com4);
                        $('#dia_corr1').val(data.dia_corr1);
                        $('#dia_corr2').val(data.dia_corr2);
                        $('#dia_corr3').val(data.dia_corr3);
                        $('#dia_corr4').val(data.dia_corr4);
                        $('#hd_corr1').val(data.hd_corr1);
                        $('#hd_corr2').val(data.hd_corr2);
                        $('#hd_corr3').val(data.hd_corr3);
                        $('#hd_corr4').val(data.hd_corr4);
                        $('#corr_com1').val(data.corr_com1);
                        $('#corr_com2').val(data.corr_com2);
                        $('#corr_com3').val(data.corr_com3);
                        $('#corr_com4').val(data.corr_com4);
                        $('#eq_cube1').val(data.eq_cube1);
                        $('#eq_cube2').val(data.eq_cube2);
                        $('#eq_cube3').val(data.eq_cube3);
                        $('#eq_cube4').val(data.eq_cube4);
                        $('#casting_date').val(data.casting_date);
                        $('#age1').val(data.age1);
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
            url: '<?php echo $base_url; ?>save_wall_concrete_core.php',
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
</script>