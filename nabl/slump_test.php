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

$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
    $row_select4 = mysqli_fetch_assoc($result_select4);
    /* $tank_no= $row_select4['tanker_no'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_grade= $row_select4['bitumin_grade'];
					$bitumin_make= $row_select4['bitumin_make']; */
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
                        <h2 style="text-align:center;">SLUMP TEST</h2>
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                            <label>Amend Date. :</label>
                                        </div>								 
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
                                    </div>
                                </div>
                            </div>

                        </div><br>


                        <br>
                        <!-- LAB NO PUT VAIBHAV-->
                        <div class="row">

                        </div>
                        <br>
                        <!-- LAB NO PUT VAIBHAV-->
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No.:</label>-->
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
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
                                        $querys_job1 = "SELECT * FROM slump_test WHERE `is_deleted`='0' and lab_no='$lab_no'";
                                        $qrys_jobno = mysqli_query($conn, $querys_job1);
                                        $rows = mysqli_num_rows($qrys_jobno);
                                        if ($rows < 1) { ?>
                                            <button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>
                                    </div>
                                    <!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
                                    <?php
                                    $val =  $_SESSION['isadmin'];
                                    if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
                                    ?>
                                        <!--<div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/print_slump_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div>-->

                                    <?php } ?>
                                    <div class="col-sm-2">
                                        <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_slump_test.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
                                                                <a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
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
                                <?php }     ?>

                                <?php
                                $test_check;
                                $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
                                $result_select1 = mysqli_query($conn, $select_query1);
                                while ($r1 = mysqli_fetch_array($result_select1)) {

                                    if ($r1['test_code'] == "slm") {

                                        $test_check .= "slm,";
                                ?>
                                        <div class="panel panel-default" id="slm">
                                            <div class="panel-heading" id="txtslm">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                                        <h4 class="panel-title">
                                                            <b>SLUMP OBSERVATION</b>
                                                        </h4>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <br>
                                                    <div class="row">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label for="chk_slm">1.</label>
                                                                    <input type="checkbox" class="visually-hidden" name="chk_slm" id="chk_slm" value="chk_slm"><br>
                                                                </div>
                                                                <label for="inputEmail3" class="col-sm-4 control-label label-right">PROPORTION USED</label>
                                                            </div>
                                                        </div>
														<br><br><br>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-4 control-label label-right">MIX DESIGN GRADE :- </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" value="M :-" id="slm_temp" name="slm_temp">
                                                                </div>
                                                            </div>
                                                        </div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-4 control-label label-right">NO. of Cubes Casted:-</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="water" name="water" >
																</div>
															</div>
														</div>
														<!--<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-4 control-label label-right">Cement</label>
																<div class="col-sm-8">-->
																	<input type="hidden" class="form-control" id="cement" name="cement" >
																<!--</div>
															</div>
														</div>-->
                                                    </div>

                                                    <br>

                                                   <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Description</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">I</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">II</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">III</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">IV</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>-->

                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">By Weight (kg)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_1" name="or_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_2" name="or_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_3" name="or_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_4" name="or_4">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_3" name="sl_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_4" name="sl_4">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_5" name="sl_5">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_6" name="sl_6">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!--<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Flyash</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">-->
                                                                    <input type="hidden" class="form-control" id="af_1" name="af_1">
                                                               <!-- </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Admixture</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">-->
                                                                    <input type="hidden" class="form-control" id="af_2" name="af_2">
                                                                <!--</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">40mm</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">-->
                                                                    <input type="hidden" class="form-control" id="af_3" name="af_3">
                                                                <!--</div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">20mm</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">-->
                                                                    <input type="hidden" class="form-control" id="af_4" name="af_4">
                                                                <!--</div>
                                                            </div>-->

                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!--<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">10mm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">-->
                                                                    <input type="hidden" class="form-control" id="sl_1" name="sl_1">
                                                                <!--</div>
                                                            </div>-->
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">remarks :-</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_2" name="sl_2">
                                                                </div>
                                                            </div>
                                                            


                                                        </div>

                                                    </div>

                                                    <br>
                                                    <!--div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">AVERAGE PENETRATION (in 1/10 mm)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_pen" name="avg_pen" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">

										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">

										</div>
									</div>

								</div>

							</div-->
                                                

									
                                            
														<div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="col-sm-1">
                                                                    <label for="chk_slm">2.</label>
                                                                    <input type="checkbox" class="visually-hidden" name="chk_slm" id="chk_slm" value="chk_slm"><br>
                                                                </div>
                                                                <label for="inputEmail3" class="col-sm-4 control-label label-right">SLUMP Observation</label>
                                                            </div>
                                                        </div>
                                                               
                                                       <br>
                                                       <br>
                                                       <br>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-4 control-label label-right">Trial Mix</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="trial" name="trial" >
																</div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-4 control-label label-right">Cement</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="cement_1" name="cement_1" >
																</div>
															</div>
														</div>
                                                    </div>

                                                    <br>

                                                   <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Description</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">I</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">II</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">III</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">IV</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>-->

                                                    <br>
                                                    <!--<div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">By Weight (kg)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_1" name="or_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_2" name="or_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_3" name="or_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="or_4" name="or_4">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_3" name="sl_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_4" name="sl_4">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_5" name="sl_5">
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl_6" name="sl_6">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Dose of Admixture</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="Admixture" name="Admixture">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">initial</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="init" name="init">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">after 30 min</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="min_30" name="min_30">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">after 60 min</label>
                                                                </div>
                                                            </div>
															<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="min_60" name="min_60">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">after 90 min</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="min_90" name="min_90">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">after 120 min</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="min_120" name="min_120">
                                                                </div>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">after 150 min</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="min_150" name="min_150">
                                                                </div>
                                                            </div>
                                                            


                                                        </div>

                                                    </div>

                                                    <br>
                                                    <!--div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="inputEmail3" class="control-label">AVERAGE PENETRATION (in 1/10 mm)</label>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" id="avg_pen" name="avg_pen" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">

										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">

										</div>
									</div>

								</div>

							</div-->
                                                </div>



                                                <br>




                                            </div>



                                        </div>


                                <?php }
                                } ?>
                                </div>

                                <hr>
                                <div id="display_data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table border="1px solid black" align="center" width="100%" id="aaaa">
                                                <tr>
                                                    <th style="text-align:center;" width="10%"><label>Actions</label></th>
                                                    <!--<th style="text-align:center;"><label>Report No.</label></th>-->
                                                    <th style="text-align:center;"><label>Lab No.</label></th>
                                                    <th style="text-align:center;"><label>Job No.</label></th>



                                                </tr>
                                                <?php
                                                $query = "select * from slump_test WHERE lab_no='$aa'  and `is_deleted`='0'";

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
                                                                    <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
                                                                    <?php
                                                                    //}
                                                                    ?>
                                                                </td>
                                                                <!--<td style="text-align:center;"><?php //echo $r['report_no'];
                                                                                                    ?></td>-->
                                                                <td style="text-align:center;"><?php echo $r['job_no']; ?></td>
                                                                <td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
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
    $(document).ready(function() {
        $('#btn_edit_data').hide();
        $('#alert').hide();

        /* $('#caste_date1,#caste_date2,#caste_date3,#test_date1,#test_date2,#test_date3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
	});
	 */



        $('#chk_slm').change(function() {
            if (this.checked) {
                $('#txtslm').css("background-color", "var(--success)");
            } else {
                $('#txtslm').css("background-color", "white");
            }

        });


        /* var global_temp = randomNumberFromRange(26.0,28.5).toFixed(1);
	var pen_temp;
	var pen_1;
	var pen_2;
	var pen_3;
	var avg_pen;

	function pen_auto()
	{
		var pen_temp = global_temp;
			$('#pen_temp').val(pen_temp);
			var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avgpen = randomNumberFromRange(84.00,95.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();

				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen)- 2 ;



			}
			else if(grades=="vg-20")
			{
				var avgpen = randomNumberFromRange(65.00,75.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();

				var pen_3 = (+avg_pen)+ 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen) - 2;

			}
			else if(grades=="vg-30")
			{
				var avgpen = randomNumberFromRange(48.00,53.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();


				var pen_3 = (+avg_pen) - 2;
				var pen_2 = (+avg_pen) ;
				var pen_1 = (+avg_pen)  + 2;

			}
			else if(grades=="vg-40")
			{
				var avgpen = randomNumberFromRange(38.00,42.00).toFixed();
				$('#avg_pen').val(avgpen);
				var avg_pen = $('#avg_pen').val();

				var pen_3 = (+avg_pen) + 1;
				var pen_2 = (+avg_pen) - 1;
				var pen_1 = (+avg_pen);

			}

			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());





			$('#pen_temp').val(pen_temp.toString().substring(0, pen_temp.toString().indexOf(".") + 2));


	}

	$('#chk_pen').change(function(){
        if(this.checked)
		{
			pen_auto();

		}
		else
		{
			$('#avg_pen').val(null);
			$('#pen_1').val(null);
			$('#pen_2').val(null);
			$('#pen_3').val(null);
			$('#pen_temp').val(null);


		}
	});

	$('#avg_pen').change(function(){
		if ($("#chk_pen").is(':checked')) {
        var grades = $('#bitumin_grade').val();
			if(grades=="vg-10")
			{
				var avg_pen = $('#avg_pen').val();

				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{

				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2;
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2;
				}


			}
			else if(grades=="vg-20")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{

				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2;
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2;
				}
			}
			else if(grades=="vg-30")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{

				var pen_3 = parseInt(avg_pen) - 2;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 2;
				}
				else{
				var pen_3 = parseInt(avg_pen);
				var pen_2 = parseInt(avg_pen) + 2;
				var pen_1 = parseInt(avg_pen) - 2;
				}
			}
			else if(grades=="vg-40")
			{
				var avg_pen = $('#avg_pen').val();
				var gg = randomNumberFromRange(0,9).toFixed();
				if(gg % 2 == 0)
				{

				var pen_3 = parseInt(avg_pen) - 1;
				var pen_2 = parseInt(avg_pen);
				var pen_1 = parseInt(avg_pen) + 1;
				}
				else{
				var pen_3 = parseInt(avg_pen) + 1;
				var pen_2 = parseInt(avg_pen) - 1;
				var pen_1 = parseInt(avg_pen);
				}
			}
			$('#pen_1').val(pen_1.toFixed());
			$('#pen_2').val(pen_2.toFixed());
			$('#pen_3').val(pen_3.toFixed());

		}
		else
		{
			$('#txtpen').css("background-color","var(--success)");
		}

	});
	 */


        $('#chk_auto').change(function() {
            if (this.checked) {
                //$('#txtabr').css("background-color","var(--success)");
                //$('#txtwtr').css("background-color","var(--success)");


                var temp = $('#test_list').val();
                var temp = $('#temp').val();
                var aa = temp.split(",");
                //slm
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "slm") {
                        $('#txtslm').css("background-color", "var(--success)");
                        $("#chk_slm").prop("checked", true);
                        chk_auto();
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
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_slump_test.php',
            data: 'action_type=view&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
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
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();
            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //slm
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "slm") {
                    if (document.getElementById('chk_slm').checked) {
                        var chk_slm = "1";
                    } else {
                        var chk_slm = "0";
                    }

                    var slm_temp = $('#slm_temp').val();
                    var or_1 = $('#or_1').val();
                    var or_2 = $('#or_2').val();
                    var or_3 = $('#or_3').val();
                    var or_4 = $('#or_4').val();
                    var af_1 = $('#af_1').val();
                    var af_2 = $('#af_2').val();
                    var af_3 = $('#af_3').val();
                    var af_4 = $('#af_4').val();
                    var sl_1 = $('#sl_1').val();
                    var sl_2 = $('#sl_2').val();
                    var sl_3 = $('#sl_3').val();
                    var sl_4 = $('#sl_4').val();
                    var water = $('#water').val();
                    var cement = $('#cement').val();
                    var sl_5 = $('#sl_5').val();
                    var sl_6 = $('#sl_6').val();
					var trial = $('#trial').val();
					var cement_1 = $('#cement_1').val();
					var init = $('#init').val();
					var min_30 = $('#min_30').val();
					var min_60 = $('#min_60').val();
					var min_90 = $('#min_90').val();
					var min_120 = $('#min_120').val();
					var min_150 = $('#min_150').val();
					var Admixture = $('#Admixture').val();

                    break;
                } else {
                    var slm_temp = "0";
                    var or_1 = "0";
                    var or_2 = "0";
                    var or_3 = "0";
                    var or_4 = "0";
                    var af_1 = "0";
                    var af_2 = "0";
                    var af_3 = "0";
                    var af_4 = "0";
                    var sl_1 = "0";
                    var sl_2 = "0";
                    var sl_3 = "0";
                    var sl_4 = "0";
                    var water = "0";
                    var cement = "0";
                    var sl_5 = "0";
                    var sl_6 = "0";
					var trial = "";
					var cement_1 = "0";
					var init = "0";
					var min_30 = "0";
					var min_60 = "0";
					var min_90 = "0";
					var min_120 = "0";
					var min_150 = "0";
					var Admixture = "0";
					
                }

            }






            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_slm=' + chk_slm + '&slm_temp=' + slm_temp + '&or_1=' + or_1 + '&or_2=' + or_2 + '&or_3=' + or_3 + '&or_4=' + or_4 + '&af_1=' + af_1 + '&af_2=' + af_2 + '&af_3=' + af_3 + '&af_4=' + af_4 + '&sl_1=' + sl_1 + '&sl_2=' + sl_2 + '&sl_3=' + sl_3 + '&sl_4=' + sl_4 + '&water=' + water + '&cement=' + cement + '&sl_5=' + sl_5 + '&sl_6=' + sl_6 +  '&trial=' + trial +  '&cement_1=' + cement_1 +  '&init=' + init +  '&min_30=' + min_30 +  '&min_60=' + min_60 +  '&min_90=' + min_90 +  '&min_120=' + min_120 +  '&min_150=' + min_150 +  '&Admixture=' + Admixture +  '&ulr=' + ulr+  '&amend_date=' + amend_date;

        } else if (type == 'edit') {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();

            var temp = $('#test_list').val();
            var room_temp = $('#room_temp').val();
            var aa = temp.split(",");

            //penetration
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "slm") {
                    if (document.getElementById('chk_slm').checked) {
                        var chk_slm = "1";
                    } else {
                        var chk_slm = "0";
                    }

                    var slm_temp = $('#slm_temp').val();
                    var or_1 = $('#or_1').val();
                    var or_2 = $('#or_2').val();
                    var or_3 = $('#or_3').val();
                    var or_4 = $('#or_4').val();
                    var af_1 = $('#af_1').val();
                    var af_2 = $('#af_2').val();
                    var af_3 = $('#af_3').val();
                    var af_4 = $('#af_4').val();
                    var sl_1 = $('#sl_1').val();
                    var sl_2 = $('#sl_2').val();
                    var sl_3 = $('#sl_3').val();
                    var sl_4 = $('#sl_4').val();
                    var water = $('#water').val();
                    var cement = $('#cement').val();
                    var sl_5 = $('#sl_5').val();
                    var sl_6 = $('#sl_6').val();
					var trial = $('#trial').val();
					var cement_1 = $('#cement_1').val();
					var init = $('#init').val();
					var min_30 = $('#min_30').val();
					var min_60 = $('#min_60').val();
					var min_90 = $('#min_90').val();
					var min_120 = $('#min_120').val();
					var min_150 = $('#min_150').val();
					var Admixture = $('#Admixture').val();



                    break;
                } else {
                    var slm_temp = "0";
                    var or_1 = "0";
                    var or_2 = "0";
                    var or_3 = "0";
                    var or_4 = "0";
                    var af_1 = "0";
                    var af_2 = "0";
                    var af_3 = "0";
                    var af_4 = "0";
                    var sl_1 = "0";
                    var sl_2 = "0";
                    var sl_3 = "0";
                    var sl_4 = "0";
                    var water = "0";
                    var cement = "0";
                    var sl_5 = "0";
                    var sl_6 = "0";
					var trial = "";
					var cement_1 = "0";
					var init = "0";
					var min_30 = "0";
					var min_60 = "0";
					var min_90 = "0";
					var min_120 = "0";
					var min_150 = "0";
					var Admixture = "0";
					
                }

            }





            var idEdit = $('#idEdit').val();

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&slm_temp=' + slm_temp + '&or_1=' + or_1 + '&or_2=' + or_2 + '&or_3=' + or_3 + '&or_4=' + or_4 + '&af_1=' + af_1 + '&af_2=' + af_2 + '&af_3=' + af_3 + '&af_4=' + af_4 + '&sl_1=' + sl_1 + '&sl_2=' + sl_2 + '&sl_3=' + sl_3 + '&sl_4=' + sl_4 + '&water=' + water + '&cement=' + cement + '&sl_5=' + sl_5 + '&sl_6=' + sl_6 +  '&trial=' + trial +  '&cement_1=' + cement_1 +  '&init=' + init +  '&min_30=' + min_30 +  '&min_60=' + min_60 +  '&min_90=' + min_90 +  '&min_120=' + min_120 +  '&min_150=' + min_150 + '&Admixture=' + Admixture +  '&ulr=' + ulr+  '&amend_date=' + amend_date;
        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_slump_test.php',
            data: billData,
            dataType: 'JSON',
            success: function(msg) {
                $('#btn_save').hide();
                getGlazedTiles();
                var report_no = $('#report_no').val();
                var job_no = $('#job_no').val();
                //window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
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
            url: '<?php echo $base_url; ?>save_slump_test.php',
            data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
            success: function(data) {
                $('#idEdit').val(data.id);
                var idEdit = $('#idEdit').val();
                $('#report_no').val(data.report_no);
                $('#job_no').val(data.job_no);
                $('#lab_no').val(data.lab_no);
                $('#ulr').val(data.ulr);
                $('#amend_date').val(data.amend_date);

                var temp = $('#test_list').val();
                var room_temp = $('#room_temp').val();
                var aa = temp.split(",");
                //slm
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "slm") {

                        var chk_slm = data.chk_slm;
                        if (chk_slm == "1") {
                            $('#txtslm').css("background-color", "var(--success)");
                            $("#chk_slm").prop("checked", true);



                        } else {
                            $('#txtslm').css("background-color", "white");
                            $("#chk_slm").prop("checked", false);

                        }

                        $('#slm_temp').val(data.slm_temp);
                        $('#or_1').val(data.or_1);
                        $('#or_2').val(data.or_2);
                        $('#or_3').val(data.or_3);
                        $('#or_4').val(data.or_4);
                        $('#af_1').val(data.af_1);
                        $('#af_2').val(data.af_2);
                        $('#af_3').val(data.af_3);
                        $('#af_4').val(data.af_4);
                        $('#sl_1').val(data.sl_1);
                        $('#sl_2').val(data.sl_2);
                        $('#sl_3').val(data.sl_3);
                        $('#sl_4').val(data.sl_4);
                        $('#water').val(data.water);
                        $('#cement').val(data.cement);
                        $('#sl_5').val(data.sl_5);
                        $('#sl_6').val(data.sl_6);
						$('#trial').val(data.trial);
						$('#cement_1').val(data.cement_1);
						$('#init').val(data.init);
						$('#min_30').val(data.min_30);
						$('#min_60').val(data.min_60);
						$('#min_90').val(data.min_90);
						$('#min_120').val(data.min_120);
						$('#min_150').val(data.min_150);
						$('#Admixture').val(data.Admixture);

                        break;
                    } else {

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
</script>