<?php
session_start();
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
include("connection.php");
error_reporting(1);
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
    $paver_shape = $row_select4['paver_shape'];
    $paver_age = $row_select4['paver_age'];
    $paver_color = $row_select4['paver_color'];
    $paver_thickness = $row_select4['paver_thickness'];
    $paver_grade = $row_select4['paver_grade'];
}

?>
<div class="content-wrapper" style="margin-left:0px !important;">

    <section class="content common_material p-0">
        <?php include("menu.php") ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h2 style="text-align:center;">GRANITE STONE</h2>
                    </div>
                    <div class="box-default">
                        <form class="form" id="Glazed" method="post">
                            <!-- REPORT NO AND JOB NO PUT VAIBHAV-->
                            <div class="row">
                                <br>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

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
                            </div>
                            <!--<br>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<div class="col-sm-2">
												<label for="chk_auto">TILE BRAND :</label>
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="tiles_brand" name="tiles_brand">
											</div>
										</div>
									</div>
								</div>-->


                            <!--<label for="inputEmail3" class="col-sm-2 control-label">Grade :</label>-
										  <div class="col-sm-2">
											<input type="hidden" class="form-control inputs" tabindex="4" id="top_grade" value="<?php echo $paver_grade; ?>" name="top_grade" ReadOnly>
										  </div>

										   <label for="inputEmail3" class="col-sm-2 control-label">Thickness :</label>
										  <div class="col-sm-2">
											<input type="text" class="form-control inputs" tabindex="4" id="top_thickness" value="<?php echo $paver_thickness; ?>" name="top_thickness" >
										  </div>

										</div>
									</div>

								</div>
								<br>
							<!-- LAB NO PUT VAIBHAV-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Shape :</label>-->
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control inputs" tabindex="4" id="top_shape" value="<?php echo $paver_shape; ?>" name="top_shape" ReadOnly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!--<label for="inputEmail3" class="col-sm-2 control-label">Age :</label>									 -->
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control inputs" tabindex="4" id="top_age" value="<?php echo $paver_age; ?>" name="top_age" ReadOnly>
                                        </div>
                                        <!--<label for="inputEmail3" class="col-sm-2 control-label">ULR No. :</label>	-->
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $ulr; ?>" name="ulr" ReadOnly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- LAB NO PUT VAIBHAV-->
                            <!--<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Weight,gm :</label>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt1" name="wt1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="wt2" name="wt2">
										  </div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Area,mm<sup>2</sup> :</label>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar1" name="ar1">
										  </div>
										  <div class="col-sm-5">
											<input type="text" class="form-control inputs" tabindex="4" id="ar2" name="ar2">
										  </div>
										</div>
									</div>

								</div>-->
                            <br>
                            <!-- LAB NO PUT VAIBHAV-->
                            <!--<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Splitting Length,mm :</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="sp_len" name="sp_len">
										  </div>

										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full Length,mm :</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_len" name="full_len">
										  </div>

										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
										 <label for="inputEmail3" class="col-sm-2 control-label">Flexural Full width,mm :</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control inputs" tabindex="4" id="full_width" name="full_width">
										  </div>

										</div>
									</div>



								</div>-->

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
                                            $querys_job1 = "SELECT * FROM granite_stone WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
                                        /*$val =  $_SESSION['isadmin'];
												if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
                                        ?>
                                        <div class="col-sm-2">
                                            <a target='_blank' href="<?php echo $base_url; ?>print_report/print_building_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

                                        </div>

                                        <?php //}
                                        ?>
                                        <div class="col-sm-2">
                                            <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/print_building_stone.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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
                                    <?php }     ?>

                                    <?php
                                    $test_check;
                                    $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
                                    $result_select1 = mysqli_query($conn, $select_query1);
                                    while ($r1 = mysqli_fetch_array($result_select1)) {

                                        if ($r1['test_code'] == "spg") {
                                            $test_check .= "spg,";
                                    ?>
                                            <div class="panel panel-default" id="spg">
                                                <div class="panel-heading" id="txtspg">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_spg">
                                                            <h4 class="panel-title">
                                                                <b>SPECIFIC GRAVITY</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_spg" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_spg">1.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_spg" id="chk_spg" value="chk_spg"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">SPECIFIC GRAVITY</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Sr No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Particulars</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Observation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of the bottle with stopper and powder in gm - W<sub>2</sub></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w2_1" name="w2_1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w2_2" name="w2_2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w2_3" name="w2_3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_w2" name="avg_w2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of the empty specific gravity bottle with stopper in gm - W<sub>1</sub></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w1_1" name="w1_1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w1_2" name="w1_2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w1_3" name="w1_3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_w1" name="avg_w1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of the bottle with stopper filled with distilled water at room temperature in gm - W<sub>4</sub></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w4_1" name="w4_1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w4_2" name="w4_2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w4_3" name="w4_3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_w4" name="avg_w4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of the bottle with stopper powder and distilled water to fill rest of the bottle at room temperature in gm - W<sub>3</sub></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w3_1" name="w3_1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w3_2" name="w3_2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="w3_3" name="w3_3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_w3" name="avg_w3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">True Specific Gravity = </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="spg_1" name="spg_1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="spg_2" name="spg_2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="spg_3" name="spg_3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_spg" name="avg_spg">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>



                                        <?php
                                        }
                                        if ($r1['test_code'] == "wtr") {
                                            $test_check .= "wtr,";
                                        ?>
                                            <div class="panel panel-default" id="wtr">
                                                <div class="panel-heading" id="txtpor">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_por">
                                                            <h4 class="panel-title">
                                                                <b>WATER ABSORPTION, APPARENT SPECIFIC GRAVITY AND POROSITY</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_por" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_por">2.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_por" id="chk_por" value="chk_por"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-6 control-label label-right">WATER ABSORPTION, APPARENT SPECIFIC GRAVITY AND POROSITY</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Sr No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Perticulars</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Observation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of Oven Dry Test Piece in gm = A</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="a1" name="a1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="a2" name="a2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="a3" name="a3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_a" name="avg_a">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Quantity of Water added in 1000ml jar containing the test piece in gm =C</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="c1" name="c1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="c2" name="c2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="c3" name="c3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_c" name="avg_c">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Weight of saturated surface dry test piece in gm = B</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="b1" name="b1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="b2" name="b2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="b3" name="b3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="avg_b" name="avg_b">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Apparent specific gravity = A / 1000 - C</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="asg1" name="asg1" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="asg2" name="asg2" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="asg3" name="asg3" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_asg" name="avg_asg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">5.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Water Absorption % = (B - A) / A X 100</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="wtr1" name="wtr1" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="wtr2" name="wtr2" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="wtr3" name="wtr3" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_wtr" name="avg_wtr">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">6.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Apparent Porosity % = (B - A) / (1000 - C) X 100</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="por1" name="por1" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="por2" name="por2" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="por3" name="por3" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_por" name="avg_por" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">7.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">True Specific Gravity</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tspg1" name="tspg1" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tspg2" name="tspg2" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tspg3" name="tspg3" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_tspg" name="avg_tspg" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">8.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">True Porosity = </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tpor1" name="tpor1" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tpor2" name="tpor2" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="tpor3" name="tpor3" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_tpor" name="avg_tpor" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>





                                        <?php
                                        }
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
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_com">3.</label>
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
                                                                    <label for="inputEmail3" class="control-label text-center">Lab ID No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Condition Dry/Wet</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Length (B)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Height (H) mm or Diameter (D)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Width (W) mm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Length (Diameter) / Height Ratio</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Cross Sectional Area (cm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Maximum Load (kN)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Compressive Strength Cc (N/mm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average Compressive Strength (kg/cm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con1" name="con1" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len1" name="len1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h1" name="h1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w1" name="w1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio1" name="ratio1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area1" name="area1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load1" name="load1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com1" name="com1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con2" name="con2" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len2" name="len2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h2" name="h2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w2" name="w2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio2" name="ratio2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area2" name="area2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load2" name="load2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com2" name="com2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con3" name="con3" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len3" name="len3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h3" name="h3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w3" name="w3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio3" name="ratio3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area3" name="area3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load3" name="load3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com3" name="com3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con4" name="con4" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len4" name="len4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h4" name="h4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w4" name="w4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio4" name="ratio4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area4" name="area4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load4" name="load4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com4" name="com4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">5.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con5" name="con5" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len5" name="len5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h5" name="h5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w5" name="w5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio5" name="ratio5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area5" name="area5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load5" name="load5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com5" name="com5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_com1" name="avg_com1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">6.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con6" name="con6" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len6" name="len6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h6" name="h6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w6" name="w6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio6" name="ratio6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area6" name="area6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load6" name="load6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com6" name="com6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">7.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con7" name="con7" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len7" name="len7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h7" name="h7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w7" name="w7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio7" name="ratio7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area7" name="area7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load7" name="load7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com7" name="com7">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">8.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con8" name="con8" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len8" name="len8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h8" name="h8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w8" name="w8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio8" name="ratio8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area8" name="area8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load8" name="load8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com8" name="com8">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">9.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con9" name="con9" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len9" name="len9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h9" name="h9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w9" name="w9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio9" name="ratio9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area9" name="area9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load9" name="load9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com9" name="com9">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">10.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con10" name="con10" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len10" name="len10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h10" name="h10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w10" name="w10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio10" name="ratio10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area10" name="area10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load10" name="load10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com10" name="com10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_com2" name="avg_com2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">11.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con11" name="con11" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len11" name="len11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h11" name="h11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w11" name="w11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio11" name="ratio11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area11" name="area11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load11" name="load11">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com11" name="com11">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">12.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con12" name="con12" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len12" name="len12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h12" name="h12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w12" name="w12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio12" name="ratio12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area12" name="area12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load12" name="load12">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com12" name="com12">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">13.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con13" name="con13" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len13" name="len13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h13" name="h13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w13" name="w13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio13" name="ratio13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area13" name="area13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load13" name="load13">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com13" name="com13">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">14.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con14" name="con14" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len14" name="len14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h14" name="h14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w14" name="w14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio14" name="ratio14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area14" name="area14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load14" name="load14">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com14" name="com14">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">15.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con15" name="con15" value="dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len15" name="len15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h15" name="h15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w15" name="w15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio15" name="ratio15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area15" name="area15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load15" name="load15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com15" name="com15">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_com3" name="avg_com3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">16.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con16" name="con16" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len16" name="len16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h16" name="h16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w16" name="w16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio16" name="ratio16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area16" name="area16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load16" name="load16">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com16" name="com16">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">17.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con17" name="con17" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len17" name="len17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h17" name="h17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w17" name="w17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio17" name="ratio17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area17" name="area17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load17" name="load17">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com17" name="com17">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">18.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con18" name="con18" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len18" name="len18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h18" name="h18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w18" name="w18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio18" name="ratio18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area18" name="area18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load18" name="load18">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com18" name="com18">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">19.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con19" name="con19" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len19" name="len19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h19" name="h19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w19" name="w19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio19" name="ratio19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area19" name="area19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load19" name="load19">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com19" name="com19">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">20.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con20" name="con20" value="wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len20" name="len20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="h20" name="h20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="w20" name="w20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ratio20" name="ratio20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="area20" name="area20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="load20" name="load20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="com20" name="com20">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_com4" name="avg_com4">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <br>





                                                    </div>
                                                </div>
                                            </div>






                                        <?php
                                        }
                                        if ($r1['test_code'] == "TRA") {
                                            $test_check .= "TRA,";
                                        ?>
                                            <div class="panel panel-default" id="tra">
                                                <div class="panel-heading" id="txttra">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_tra">
                                                            <h4 class="panel-title">
                                                                <b>TRANSVERSE STRENGTH</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_tra" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_tra">4.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_tra" id="chk_tra" value="chk_tra"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">TRANSVERSE STRENGTH</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Lab ID No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Condition Dry/Wet</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Length (L) (cm)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Width (b) cm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Depth (D)cm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Central Breaking Load (W) (kN)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Transverse strength (R) (Nkg/cm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average Compressive Strength (kg/cm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon1" name="tcon1" value="Dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl1" name="tl1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb1" name="tb1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta1" name="ta1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb1" name="cb1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra1" name="tra1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon2" name="tcon2" value="Dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl2" name="tl2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb2" name="tb2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta2" name="ta2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb2" name="cb2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra2" name="tra2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon3" name="tcon3" value="Dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl3" name="tl3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb3" name="tb3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta3" name="ta3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb3" name="cb3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra3" name="tra3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon4" name="tcon4" value="Dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl4" name="tl4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb4" name="tb4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta4" name="ta4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb4" name="cb4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra4" name="tra4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">5.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon5" name="tcon5" value="Dry">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl5" name="tl5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb5" name="tb5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta5" name="ta5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb5" name="cb5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra5" name="tra5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_tra1" name="avg_tra1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">6.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon6" name="tcon6" value="Wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl6" name="tl6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb6" name="tb6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta6" name="ta6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb6" name="cb6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra6" name="tra6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">7.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon7" name="tcon7" value="Wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl7" name="tl7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb7" name="tb7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta7" name="ta7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb7" name="cb7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra7" name="tra7">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">8.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon8" name="tcon8" value="Wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl8" name="tl8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb8" name="tb8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta8" name="ta8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb8" name="cb8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra8" name="tra8">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">9.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon9" name="tcon9" value="Wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl9" name="tl9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb9" name="tb9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta9" name="ta9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb9" name="cb9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra9" name="tra9">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">10.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tcon10" name="tcon10" value="Wet">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tl10" name="tl10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tb10" name="tb10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ta10" name="ta10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="cb10" name="cb10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tra10" name="tra10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_tra2" name="avg_tra2">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>


                                        <?php
                                        }
                                        if ($r1['test_code'] == "tes") {
                                            $test_check .= "tes,";
                                        ?>

                                            <div class="panel panel-default" id="tes">
                                                <div class="panel-heading" id="txtten">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_ten">
                                                            <h4 class="panel-title">
                                                                <b>TENSILE STRENGTH</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_ten" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_ten">5.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_ten" id="chk_ten" value="chk_ten"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">TENSILE STRENGTH</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <br>
                                                        <div class="row">

                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Lab ID No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Condition Dry/Wet</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Diameter (d) (cm)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Lengths (I) cm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Spliting Load (W) (KN)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Split tensile strength S (N/mm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average Compressive Strength (kg/cm<sup>2</sup>)</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon1" name="scon1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd1" name="sd1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl1" name="sl1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload1" name="sload1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten1" name="ten1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon2" name="scon2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd2" name="sd2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl2" name="sl2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload2" name="sload2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten2" name="ten2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon3" name="scon3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd3" name="sd3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl3" name="sl3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload3" name="sload3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten3" name="ten3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">4.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon4" name="scon4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd4" name="sd4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl4" name="sl4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload4" name="sload4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten4" name="ten4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">5.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon5" name="scon5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd5" name="sd5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl5" name="sl5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload5" name="sload5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten5" name="ten5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_ten1" name="avg_ten1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">6.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon6" name="scon6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd6" name="sd6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl6" name="sl6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload6" name="sload6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten6" name="ten6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">7.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon7" name="scon7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd7" name="sd7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl7" name="sl7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload7" name="sload7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten7" name="ten7">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">8.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon8" name="scon8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd8" name="sd8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl8" name="sl8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload8" name="sload8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten8" name="ten8">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">9.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon9" name="scon9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd9" name="sd9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl9" name="sl9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload9" name="sload9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten9" name="ten9">
                                                                </div>
                                                            </div>
                                                        </div> <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">10.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="scon10" name="scon10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sd10" name="sd10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sl10" name="sl10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="sload10" name="sload10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="ten10" name="ten10">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="avg_ten2" name="avg_ten2">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($r1['test_code'] == "hrd") {
                                            $test_check .= "hrd,";
                                        ?>

                                            <div class="panel panel-default" id="hrd">
                                                <div class="panel-heading" id="txthrd">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_hrd">
                                                            <h4 class="panel-title">
                                                                <b>MOHS' SCALE HARDNESS</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_hrd" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_hrd">6.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_hrd" id="chk_hrd" value="chk_hrd"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">MOHS' SCALE HARDNESS</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <br>

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">MOHS' SCALE HARDNESS VALUE</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="hardness" name="hardness">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($r1['test_code'] == "DIM") {
                                            $test_check .= "DIM,";
                                        ?>

                                            <div class="panel panel-default" id="DIM">
                                                <div class="panel-heading" id="txtdim">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_dim">
                                                            <h4 class="panel-title">
                                                                <b>DIMENTIONS</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_dim" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_dim">6.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">DIMENTIONS</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <br>

                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Sr No.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Length</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Width</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Height</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">S-1</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_length1" name="dim_length1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_width1" name="dim_width1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_height1" name="dim_height1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">S-2</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_length2" name="dim_length2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_width2" name="dim_width2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_height2" name="dim_height2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">S-3</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_length3" name="dim_length3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_width3" name="dim_width3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_height3" name="dim_height3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label text-center">Average</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_length_avg" name="dim_length_avg">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_width_avg" name="dim_width_avg">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="dim_height_avg" name="dim_height_avg">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($r1['test_code'] == "MOI") {
                                            $test_check .= "MOI,"; ?>
                                            <div class="panel panel-default" id="MOI">
                                                <div class="panel-heading" id="txtmoc">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_moi">
                                                            <h4 class="panel-title">
                                                                <b>MOISTURE CONTENT</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_moi" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_moi">8.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_moi" id="chk_moi" value="chk_moi"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">MOISTURE CONTENT ( WATER CONTENT )</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <label class="control-label text-center">Sr No.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="control-label text-center">M1</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="control-label text-center">M2</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="control-label text-center">M3</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="control-label text-center">Moisture Content</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <label class="control-label">1.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc1_1' name='moc1_1'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc1_2' name='moc1_2'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc1_3' name='moc1_3'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc1_4' name='moc1_4'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <label class="control-label">2.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc2_1' name='moc2_1'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc2_2' name='moc2_2'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc2_3' name='moc2_3'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc2_4' name='moc2_4'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <label class="control-label">3.</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc3_1' name='moc3_1'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc3_2' name='moc3_2'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc3_3' name='moc3_3'>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='moc3_4' name='moc3_4'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label class="control-label">Average</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id='avg_moc' name='avg_moc'>
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



                                                            </tr>
                                                            <?php
                                                            $query = "select * from granite_stone WHERE lab_no='$aa'  and `is_deleted`='0'";

                                                            $result = mysqli_query($conn, $query);


                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($r = mysqli_fetch_array($result)) {

                                                                    if ($r['is_deleted'] == 0) {
                                                            ?>
                                                                        <tr>

                                                                            <td style="text-align:center;" width="10%">

                                                                                <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
                                                                                <?php
                                                                                //	$val =  $_SESSION['isadmin'];
                                                                                //	if($val == 0 || $val == 5){
                                                                                ?>
                                                                                <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
                                                                                <?php
                                                                                //	}
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
                                            </div> <!-- TEST LIST FILD VAIBHAV-->
                                            <input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>








<?php include("footer.php"); ?>
<script>
    $('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });


    $("#btn_upload_excel").click(function() {
        form_data = new FormData();
        var acb = $('#upload_excel').val();
        if (acb == "") {
            alert("Upload excel First");
            return false;
        }
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no; ?>";
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

    $(function() {
        $('.select2').select2();
    })
    $(document).ready(function() {

        $('#btn_edit_data').hide();
        $('#alert').hide();

        function spg_auto() {
            $('#txtspg').css("background-color", "var(--success)");
            var w1_1 = randomNumberFromRange(28.1111, 30.3333);
            var w1_2 = randomNumberFromRange(28.2846, 30.4542);
            var w1_3 = randomNumberFromRange(28.3485, 30.6586);
            $('#w1_1').val((+w1_1).toFixed(4));
            $('#w1_2').val((+w1_2).toFixed(4));
            $('#w1_3').val((+w1_3).toFixed(4));

            var w_1_1 = $('#w1_1').val();
            var w_1_2 = $('#w1_2').val();
            var w_1_3 = $('#w1_3').val();

            var w_2_1 = randomNumberFromRange(15.1051, 15.2542);
            var w_2_2 = randomNumberFromRange(15.2631, 15.3451);
            var w_2_3 = randomNumberFromRange(15.1256, 15.4562);

            var w2_1 = (+w_1_1) + (+w_2_1);
            var w2_2 = (+w_1_2) + (+w_2_2);
            var w2_3 = (+w_1_3) + (+w_2_3);
            $('#w2_1').val((+w2_1).toFixed(4));
            $('#w2_2').val((+w2_2).toFixed(4));
            $('#w2_3').val((+w2_3).toFixed(4));

            var w4_1 = randomNumberFromRange(82.1051, 83.2542);
            var w4_2 = randomNumberFromRange(82.2631, 83.3451);
            var w4_3 = randomNumberFromRange(82.1256, 83.4562);

            $('#w4_1').val((+w4_1).toFixed(4));
            $('#w4_2').val((+w4_2).toFixed(4));
            $('#w4_3').val((+w4_3).toFixed(4));

            var avg_spg = randomNumberFromRange(2.54, 3.10);
            $('#avg_spg').val((+avg_spg).toFixed(2));
            var avg_spg = $('#avg_spg').val();
            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) + 0.01;
                var spg_2 = (+avg_spg) - 0.01;
                var spg_3 = (+avg_spg);
            } else if ((+randomNumberFromRange(4, 8).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) - 0.02;
                var spg_2 = (+avg_spg);
                var spg_3 = (+avg_spg) + 0.02;
            } else if ((+randomNumberFromRange(1, 6).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) + 0.02;
                var spg_2 = (+avg_spg);
                var spg_3 = (+avg_spg) - 0.02;
            } else {
                var spg_1 = (+avg_spg) - 0.02;
                var spg_2 = (+avg_spg) + 0.01;
                var spg_3 = (+avg_spg) - 0.01;
            }


            $('#spg_1').val((+spg_1).toFixed(2));
            $('#spg_2').val((+spg_2).toFixed(2));
            $('#spg_3').val((+spg_3).toFixed(2));

            //W2
            var w2_1 = $('#w2_1').val();
            var w2_2 = $('#w2_2').val();
            var w2_3 = $('#w2_3').val();

            //W1
            var w1_1 = $('#w1_1').val();
            var w1_2 = $('#w1_2').val();
            var w1_3 = $('#w1_3').val();

            //W4
            var w4_1 = $('#w4_1').val();
            var w4_2 = $('#w4_2').val();
            var w4_3 = $('#w4_3').val();

            //TSG
            var spg_1 = $('#spg_1').val();
            var spg_2 = $('#spg_2').val();
            var spg_3 = $('#spg_3').val();

            var w3_1 = (+w4_1) - (+w1_1) + (+w2_1) - (((+w2_1) - (+w1_1)) / (+spg_1));
            var w3_2 = (+w4_2) - (+w1_2) + (+w2_2) - (((+w2_2) - (+w1_2)) / (+spg_2));
            var w3_3 = (+w4_3) - (+w1_3) + (+w2_3) - (((+w2_3) - (+w1_3)) / (+spg_3));

            $('#w3_1').val((+w3_1).toFixed(4));
            $('#w3_2').val((+w3_2).toFixed(4));
            $('#w3_3').val((+w3_3).toFixed(4));

            var spg1 = $('#spg_1').val();
            var spg2 = $('#spg_2').val();
            var spg3 = $('#spg_3').val();
            var avg_spg = ((+spg1) + (+spg2) + (+spg3)) / 3;

            $('#avg_spg').val((+avg_spg).toFixed(2));

            $('#tspg1').val((+spg1).toFixed(2));
            $('#tspg2').val((+spg2).toFixed(2));
            $('#tspg3').val((+spg3).toFixed(2));
            $('#avg_tspg').val((+avg_spg).toFixed(2));
        }


        $('#avg_spg').change(function() {
            $('#txtspg').css("background-color", "var(--success)");
            var w1_1 = randomNumberFromRange(28.1111, 30.3333);
            var w1_2 = randomNumberFromRange(28.2846, 30.4542);
            var w1_3 = randomNumberFromRange(28.3485, 30.6586);
            $('#w1_1').val((+w1_1).toFixed(4));
            $('#w1_2').val((+w1_2).toFixed(4));
            $('#w1_3').val((+w1_3).toFixed(4));

            var w_1_1 = $('#w1_1').val();
            var w_1_2 = $('#w1_2').val();
            var w_1_3 = $('#w1_3').val();

            var w_2_1 = randomNumberFromRange(15.1051, 15.2542);
            var w_2_2 = randomNumberFromRange(15.2631, 15.3451);
            var w_2_3 = randomNumberFromRange(15.1256, 15.4562);

            var w2_1 = (+w_1_1) + (+w_2_1);
            var w2_2 = (+w_1_2) + (+w_2_2);
            var w2_3 = (+w_1_3) + (+w_2_3);
            $('#w2_1').val((+w2_1).toFixed(4));
            $('#w2_2').val((+w2_2).toFixed(4));
            $('#w2_3').val((+w2_3).toFixed(4));

            var w4_1 = randomNumberFromRange(82.1051, 83.2542);
            var w4_2 = randomNumberFromRange(82.2631, 83.3451);
            var w4_3 = randomNumberFromRange(82.1256, 83.4562);

            $('#w4_1').val((+w4_1).toFixed(4));
            $('#w4_2').val((+w4_2).toFixed(4));
            $('#w4_3').val((+w4_3).toFixed(4));

            var avg_spg = $('#avg_spg').val();
            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) + 0.01;
                var spg_2 = (+avg_spg) - 0.01;
                var spg_3 = (+avg_spg);
            } else if ((+randomNumberFromRange(4, 8).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) - 0.02;
                var spg_2 = (+avg_spg);
                var spg_3 = (+avg_spg) + 0.02;
            } else if ((+randomNumberFromRange(1, 6).toFixed()) % 2 == 0) {
                var spg_1 = (+avg_spg) + 0.02;
                var spg_2 = (+avg_spg);
                var spg_3 = (+avg_spg) - 0.02;
            } else {
                var spg_1 = (+avg_spg) - 0.02;
                var spg_2 = (+avg_spg) + 0.01;
                var spg_3 = (+avg_spg) - 0.01;
            }
            $('#spg_1').val((+spg_1).toFixed(2));
            $('#spg_2').val((+spg_2).toFixed(2));
            $('#spg_3').val((+spg_3).toFixed(2));

            //W2
            var w2_1 = $('#w2_1').val();
            var w2_2 = $('#w2_2').val();
            var w2_3 = $('#w2_3').val();

            //W1
            var w1_1 = $('#w1_1').val();
            var w1_2 = $('#w1_2').val();
            var w1_3 = $('#w1_3').val();

            //W4
            var w4_1 = $('#w4_1').val();
            var w4_2 = $('#w4_2').val();
            var w4_3 = $('#w4_3').val();

            //TSG
            var spg_1 = $('#spg_1').val();
            var spg_2 = $('#spg_2').val();
            var spg_3 = $('#spg_3').val();

            var w3_1 = (+w4_1) - (+w1_1) + (+w2_1) - (((+w2_1) - (+w1_1)) / (+spg_1));
            var w3_2 = (+w4_2) - (+w1_2) + (+w2_2) - (((+w2_2) - (+w1_2)) / (+spg_2));
            var w3_3 = (+w4_3) - (+w1_3) + (+w2_3) - (((+w2_3) - (+w1_3)) / (+spg_3));

            $('#w3_1').val((+w3_1).toFixed(4));
            $('#w3_2').val((+w3_2).toFixed(4));
            $('#w3_3').val((+w3_3).toFixed(4));

            var spg1 = $('#spg_1').val();
            var spg2 = $('#spg_2').val();
            var spg3 = $('#spg_3').val();
            var avg_spg = ((+spg1) + (+spg2) + (+spg3)) / 3;

            $('#avg_spg').val((+avg_spg).toFixed(2));

            $('#tspg1').val((+spg1).toFixed(2));
            $('#tspg2').val((+spg2).toFixed(2));
            $('#tspg3').val((+spg3).toFixed(2));
            $('#avg_tspg').val((+avg_spg).toFixed(2));
        });

        $('#w1_1,#w1_2,#w1_3,#w2_1,#w2_2,#w2_3,#w3_1,#w3_2,#w3_3,#w4_1,#w4_2,#w4_3').change(function() {
            var w_2_1 = $('#w2_1').val();
            var w_2_2 = $('#w2_2').val();
            var w_2_3 = $('#w2_3').val();

            var w_1_1 = $('#w1_1').val();
            var w_1_2 = $('#w1_2').val();
            var w_1_3 = $('#w1_3').val();

            var w_4_1 = $('#w4_1').val();
            var w_4_2 = $('#w4_2').val();
            var w_4_3 = $('#w4_3').val();

            var w_3_1 = $('#w3_1').val();
            var w_3_2 = $('#w3_2').val();
            var w_3_3 = $('#w3_3').val();

            var eq1_1 = (+w_2_1) - (+w_1_1);
            var eq1_2 = (+w_4_1) - (+w_1_1);
            var eq1_3 = (+w_3_1) - (+w_2_1);

            var spg_1 = ((+eq1_1) / ((+eq1_2) - (+eq1_3)));

            var eq2_1 = (+w_2_2) - (+w_1_2);
            var eq2_2 = (+w_4_2) - (+w_1_2);
            var eq2_3 = (+w_3_2) - (+w_2_2);

            var spg_2 = ((+eq2_1) / ((+eq2_2) - (+eq2_3)));

            var eq3_1 = (+w_2_3) - (+w_1_3);
            var eq3_2 = (+w_4_3) - (+w_1_3);
            var eq3_3 = (+w_3_3) - (+w_2_3);

            var spg_3 = ((+eq3_1) / ((+eq3_2) - (+eq3_3)));

            $('#spg_1').val((+spg_1).toFixed(2));
            $('#spg_2').val((+spg_2).toFixed(2));
            $('#spg_3').val((+spg_3).toFixed(2));


            var spg1 = $('#spg_1').val();
            var spg2 = $('#spg_2').val();
            var spg3 = $('#spg_3').val();
            var avg_spg = ((+spg1) + (+spg2) + (+spg3)) / 3;

            $('#avg_spg').val((+avg_spg).toFixed(2));

            $('#tspg1').val((+spg1).toFixed(2));
            $('#tspg2').val((+spg2).toFixed(2));
            $('#tspg3').val((+spg3).toFixed(2));
            $('#avg_tspg').val((+avg_spg).toFixed(2));

        });


        //SPECIFIC GRAVITY
        $('#chk_spg').change(function() {
            if (this.checked) {
                spg_auto();

            } else {
                $('#txtspg').css("background-color", "white");
                $('#w1_1').val(null);
                $('#w1_2').val(null);
                $('#w1_3').val(null);
                $('#avg_w1').val(null);
                $('#w2_1').val(null);
                $('#w2_2').val(null);
                $('#w2_3').val(null);
                $('#avg_w2').val(null);
                $('#w3_1').val(null);
                $('#w3_2').val(null);
                $('#w3_3').val(null);
                $('#avg_w3').val(null);
                $('#w4_1').val(null);
                $('#w4_2').val(null);
                $('#w4_3').val(null);
                $('#avg_w4').val(null);
                $('#spg_1').val(null);
                $('#spg_2').val(null);
                $('#spg_3').val(null);
                $('#avg_spg').val(null);

            }
        });

        function hrd_auto() {
            $('#txthrd').css("background-color", "var(--success)");
            $('#hardness').val(6);
        }
        //Hardness
        $('#chk_hrd').change(function() {
            if (this.checked) {
                hrd_auto();

            } else {
                $('#txthrd').css("background-color", "white");
                $('#hardness').val(null);
            }
        });





        function por_auto() {
            $('#txtpor').css("background-color", "var(--success)");

            var avgasg = randomNumberFromRange(2.780, 2.989).toFixed(3);
            $('#avg_asg').val(avgasg);
            var avg_asg = $('#avg_asg').val();
            if ((+randomNumberFromRange(0, 50)) % 2 == 0) {
                var asg1 = (+avg_asg) + (+0.011);
                var asg2 = (+avg_asg) - (+0.033);
                var asg3 = (+avg_asg) + (+0.022);
            } else {
                var asg1 = (+avg_asg) - (+0.019);
                var asg2 = (+avg_asg) + (+0.033);
                var asg3 = (+avg_asg) - (+0.014);
            }

            $('#asg1').val((+asg1).toFixed(3));
            $('#asg2').val((+asg2).toFixed(3));
            $('#asg3').val((+asg3).toFixed(3));

            var avgwtr = randomNumberFromRange(0.39, 0.48).toFixed(2);
            $('#avg_wtr').val(avgwtr);
            var avg_wtr = $('#avg_wtr').val();
            if ((+randomNumberFromRange(0, 50)) % 2 == 0) {
                var wtr1 = (+avg_wtr) + (+0.02);
                var wtr2 = (+avg_wtr) - (+0.04);
                var wtr3 = (+avg_wtr) + (+0.02);
            } else {
                var wtr1 = (+avg_wtr) - (+0.02);
                var wtr2 = (+avg_wtr) + (+0.03);
                var wtr3 = (+avg_wtr) - (+0.01);
            }
            $('#wtr1').val((+wtr1).toFixed(2));
            $('#wtr2').val((+wtr2).toFixed(2));
            $('#wtr3').val((+wtr3).toFixed(2));

            var avgpor = randomNumberFromRange(1.10, 1.40).toFixed(2);
            $('#avg_por').val(avgpor);
            var avg_por = $('#avg_por').val();
            if ((+randomNumberFromRange(0, 50)) % 2 == 0) {
                var por1 = (+avg_por) + (+0.01);
                var por2 = (+avg_por) - (+0.02);
                var por3 = (+avg_por) + (+0.01);
            } else {
                var por1 = (+avg_por) - (+0.03);
                var por2 = (+avg_por) + (+0.06);
                var por3 = (+avg_por) - (+0.03);
            }

            $('#por1').val((+por1).toFixed(2));
            $('#por2').val((+por2).toFixed(2));
            $('#por3').val((+por3).toFixed(2));

            var a1 = randomNumberFromRange(1002.1, 1100.0);
            var a2 = randomNumberFromRange(1002.1, 1100.0);
            var a3 = randomNumberFromRange(1002.1, 1100.0);

            $('#a1').val((+a1).toFixed(1));
            $('#a2').val((+a2).toFixed(1));
            $('#a3').val((+a3).toFixed(1));

            var a_1 = $('#a1').val();
            var a_2 = $('#a2').val();
            var a_3 = $('#a3').val();

            var wtr_1 = $('#wtr1').val();
            var wtr_2 = $('#wtr2').val();
            var wtr_3 = $('#wtr3').val();

            var b1 = (((+wtr_1) / 100) * (+a_1)) + (+a_1);
            var b2 = (((+wtr_2) / 100) * (+a_2)) + (+a_2);
            var b3 = (((+wtr_3) / 100) * (+a_3)) + (+a_3);

            $('#b1').val((+b1).toFixed(1));
            $('#b2').val((+b2).toFixed(1));
            $('#b3').val((+b3).toFixed(1));

            var asg1 = $('#asg1').val();
            var asg2 = $('#asg2').val();
            var asg3 = $('#asg3').val();

            var c1 = (((+asg1) * (+1000)) - (+a_1)) / (+asg1);
            var c2 = (((+asg2) * (+1000)) - (+a_2)) / (+asg2);
            var c3 = (((+asg3) * (+1000)) - (+a_3)) / (+asg3);

            $('#c1').val((+c1).toFixed(1));
            $('#c2').val((+c2).toFixed(1));
            $('#c3').val((+c3).toFixed(1));





            /*var c_1 = $('#c1').val();
            var c_2 = $('#c2').val();
            var c_3 = $('#c3').val();
            */

            /*var por1 = $('#por1').val();
            var por2 = $('#por2').val();
            var por3 = $('#por3').val();

            var b1 = $('#b1').val();
            var b2 = $('#b2').val();
            var b3 = $('#b3').val();

            var a1 = $('#a1').val();
            var a2 = $('#a2').val();
            var a3 = $('#a3').val();

            var c1 = 1000 - ((((+b1) - (+a1)) * 100) / (+por1));
            var c2 = 1000 - ((((+b2) - (+a2)) * 100) / (+por2));
            var c3 = 1000 - ((((+b3) - (+a3)) * 100) / (+por3));
            $('#c1').val((+c1).toFixed(1));
            $('#c2').val((+c2).toFixed(1));
            $('#c3').val((+c3).toFixed(1));*/








            /*
            var upe1 = (+b_1) - (+a_1);
            var upe2 = (+b_2) - (+a_2);
            var upe3 = (+b_3) - (+a_3);

            var dpe1 = (+1000) - (+c_1);
            var dpe2 = (+1000) - (+c_2);
            var dpe3 = (+1000) - (+c_3);


            var euq1 = (+upe1) / (+dpe1);
            var euq2 = (+upe2) / (+dpe2);
            var euq3 = (+upe3) / (+dpe3);

            var ans1 = (+euq1) * (+100);
            var ans2 = (+euq2) * (+100);
            var ans3 = (+euq3) * (+100);

            $('#por1').val((+ans1).toFixed(2));
            $('#por2').val((+ans2).toFixed(2));
            $('#por3').val((+ans3).toFixed(2));





            var por_1 = $('#por1').val();
            var por_2 = $('#por2').val();
            var por_3 = $('#por3').val();

            var avg_por = ((+por_1) + (+por_2) + (+por_3))/3;
            $('#avg_por').val((+avg_por).toFixed(2));



            var tspg1 = $('#tspg1').val();
            var tspg2 = $('#tspg2').val();
            var tspg3 = $('#tspg3').val();



            var tpor1 = (+tspg1) - (+asg1)/(+tspg1);
            var tpor2 = (+tspg2) - (+asg2)/(+tspg2);
            var tpor3 = (+tspg3) - (+asg3)/(+tspg3);

            $('#tpor1').val((+tpor1).toFixed(2));
            $('#tpor2').val((+tpor2).toFixed(2));
            $('#tpor3').val((+tpor3).toFixed(2));

            var t_por1 = $('#tpor1').val();
            var t_por2 = $('#tpor2').val();
            var t_por3 = $('#tpor3').val();

            var avg_tpor = ((+t_por1) + (+t_por2) + (+t_por3))/3;
            $('#avg_tpor').val((+avg_tpor).toFixed(2));*/


            //Siddhu
            var a1_ = $('#a1').val();
            var a2_ = $('#a2').val();
            var a3_ = $('#a3').val();

            var c1_ = $('#c1').val();
            var c2_ = $('#c2').val();
            var c3_ = $('#c3').val();

            var b1_ = $('#b1').val();
            var b2_ = $('#b2').val();
            var b3_ = $('#b3').val();

            var wtr1_ = (((+b1_) - (+a1_)) / (+a1_)) * 100;
            var wtr2_ = (((+b2_) - (+a2_)) / (+a2_)) * 100;
            var wtr3_ = (((+b3_) - (+a3_)) / (+a3_)) * 100;

            $('#wtr1').val((+wtr1_).toFixed(2));
            $('#wtr2').val((+wtr2_).toFixed(2));
            $('#wtr3').val((+wtr3_).toFixed(2));

            var wr1 = $('#wtr1').val();
            var wr2 = $('#wtr2').val();
            var wr3 = $('#wtr3').val();

            var avg_wtrs = ((+wr1) + (+wr2) + (+wr3)) / 3;
            $('#avg_wtr').val((+avg_wtrs).toFixed(2));

            var asg1_ = (+a1_) / ((+1000) - (+c1_));
            var asg2_ = (+a2_) / ((+1000) - (+c2_));
            var asg3_ = (+a3_) / ((+1000) - (+c3_));

            $('#asg1').val((+asg1_).toFixed(2));
            $('#asg2').val((+asg2_).toFixed(2));
            $('#asg3').val((+asg3_).toFixed(2));

            var as1 = $('#asg1').val();
            var as2 = $('#asg2').val();
            var as3 = $('#asg3').val();

            var avg_as = ((+as1) + (+as2) + (+as3)) / 3;
            $('#avg_asg').val((+avg_as).toFixed(2));

            var tspg1_ = $('#tspg1').val();
            var tspg2_ = $('#tspg2').val();
            var tspg3_ = $('#tspg3').val();

            var asg1__ = $('#asg1').val();
            var asg2__ = $('#asg2').val();
            var asg3__ = $('#asg3').val();


            var upe1_ = (+b1_) - (+a1_);
            var upe2_ = (+b2_) - (+a2_);
            var upe3_ = (+b3_) - (+a3_);

            var dpe1_ = (+1000) - (+c1_);
            var dpe2_ = (+1000) - (+c2_);
            var dpe3_ = (+1000) - (+c3_);


            var euq1_ = (+upe1_) / (+dpe1_);
            var euq2_ = (+upe2_) / (+dpe2_);
            var euq3_ = (+upe3_) / (+dpe3_);

            var ans1_ = (+euq1_) * (+100);
            var ans2_ = (+euq2_) * (+100);
            var ans3_ = (+euq3_) * (+100);

            $('#por1').val((+ans1_).toFixed(2));
            $('#por2').val((+ans2_).toFixed(2));
            $('#por3').val((+ans3_).toFixed(2));

            var por_1_ = $('#por1').val();
            var por_2_ = $('#por2').val();
            var por_3_ = $('#por3').val();

            var avg_por_ = ((+por_1_) + (+por_2_) + (+por_3_)) / 3;
            $('#avg_por').val((+avg_por_).toFixed(2));

            var tpor1_ = (+tspg1_) - (+asg1__) / (+tspg1_);
            var tpor2_ = (+tspg2_) - (+asg2__) / (+tspg2_);
            var tpor3_ = (+tspg3_) - (+asg3__) / (+tspg3_);

            $('#tpor1').val((+tpor1_).toFixed(2));
            $('#tpor2').val((+tpor2_).toFixed(2));
            $('#tpor3').val((+tpor3_).toFixed(2));

            var tpor1__ = $('#tpor1').val();
            var tpor2__ = $('#tpor2').val();
            var tpor3__ = $('#tpor3').val();

            var avg_tpor_ = ((+tpor1__) + (+tpor2__) + (+tpor3__)) / 3;
            $('#avg_tpor').val((+avg_tpor_).toFixed(2));
        }




        //POROSITY
        $('#chk_por').change(function() {
            if (this.checked) {
                por_auto();
            } else {
                $('#txtpor').css("background-color", "white");
                $('#a1').val(null);
                $('#a2').val(null);
                $('#a3').val(null);
                $('#avg_a').val(null);
                $('#b1').val(null);
                $('#b2').val(null);
                $('#b3').val(null);
                $('#avg_b').val(null);
                $('#c1').val(null);
                $('#c2').val(null);
                $('#c3').val(null);
                $('#avg_c').val(null);
                $('#asg1').val(null);
                $('#asg2').val(null);
                $('#asg3').val(null);
                $('#avg_asg').val(null);
                $('#wtr1').val(null);
                $('#wtr2').val(null);
                $('#wtr3').val(null);
                $('#avg_wtr').val(null);
                $('#por1').val(null);
                $('#por2').val(null);
                $('#por3').val(null);
                $('#avg_por').val(null);
                $('#tpor1').val(null);
                $('#tpor2').val(null);
                $('#tpor3').val(null);
                $('#avg_tpor').val(null);
            }
        });

        $('#a1, #a2, #a3,#b1,#b2,#b3,#c1,#c2,#c3').change(function() {
            var a1_ = $('#a1').val();
            var a2_ = $('#a2').val();
            var a3_ = $('#a3').val();

            var c1_ = $('#c1').val();
            var c2_ = $('#c2').val();
            var c3_ = $('#c3').val();

            var b1_ = $('#b1').val();
            var b2_ = $('#b2').val();
            var b3_ = $('#b3').val();

            var wtr1_ = (((+b1_) - (+a1_)) / (+a1_)) * 100;
            var wtr2_ = (((+b2_) - (+a2_)) / (+a2_)) * 100;
            var wtr3_ = (((+b3_) - (+a3_)) / (+a3_)) * 100;

            $('#wtr1').val((+wtr1_).toFixed(2));
            $('#wtr2').val((+wtr2_).toFixed(2));
            $('#wtr3').val((+wtr3_).toFixed(2));

            var wr1 = $('#wtr1').val();
            var wr2 = $('#wtr2').val();
            var wr3 = $('#wtr3').val();

            var avg_wtrs = ((+wr1) + (+wr2) + (+wr3)) / 3;
            $('#avg_wtr').val((+avg_wtrs).toFixed(2));

            var asg1_ = (+a1_) / ((+1000) - (+c1_));
            var asg2_ = (+a2_) / ((+1000) - (+c2_));
            var asg3_ = (+a3_) / ((+1000) - (+c3_));

            $('#asg1').val((+asg1_).toFixed(2));
            $('#asg2').val((+asg2_).toFixed(2));
            $('#asg3').val((+asg3_).toFixed(2));

            var as1 = $('#asg1').val();
            var as2 = $('#asg2').val();
            var as3 = $('#asg3').val();

            var avg_as = ((+as1) + (+as2) + (+as3)) / 3;
            $('#avg_asg').val((+avg_as).toFixed(2));

            var tspg1_ = $('#tspg1').val();
            var tspg2_ = $('#tspg2').val();
            var tspg3_ = $('#tspg3').val();

            var asg1__ = $('#asg1').val();
            var asg2__ = $('#asg2').val();
            var asg3__ = $('#asg3').val();


            var upe1_ = (+b1_) - (+a1_);
            var upe2_ = (+b2_) - (+a2_);
            var upe3_ = (+b3_) - (+a3_);

            var dpe1_ = (+1000) - (+c1_);
            var dpe2_ = (+1000) - (+c2_);
            var dpe3_ = (+1000) - (+c3_);


            var euq1_ = (+upe1_) / (+dpe1_);
            var euq2_ = (+upe2_) / (+dpe2_);
            var euq3_ = (+upe3_) / (+dpe3_);

            var ans1_ = (+euq1_) * (+100);
            var ans2_ = (+euq2_) * (+100);
            var ans3_ = (+euq3_) * (+100);

            $('#por1').val((+ans1_).toFixed(2));
            $('#por2').val((+ans2_).toFixed(2));
            $('#por3').val((+ans3_).toFixed(2));

            var por_1_ = $('#por1').val();
            var por_2_ = $('#por2').val();
            var por_3_ = $('#por3').val();

            var avg_por_ = ((+por_1_) + (+por_2_) + (+por_3_)) / 3;
            $('#avg_por').val((+avg_por_).toFixed(2));

            var tpor1_ = (+tspg1_) - (+asg1__) / (+tspg1_);
            var tpor2_ = (+tspg2_) - (+asg2__) / (+tspg2_);
            var tpor3_ = (+tspg3_) - (+asg3__) / (+tspg3_);

            $('#tpor1').val((+tpor1_).toFixed(2));
            $('#tpor2').val((+tpor2_).toFixed(2));
            $('#tpor3').val((+tpor3_).toFixed(2));

            var tpor1__ = $('#tpor1').val();
            var tpor2__ = $('#tpor2').val();
            var tpor3__ = $('#tpor3').val();

            var avg_tpor_ = ((+tpor1__) + (+tpor2__) + (+tpor3__)) / 3;
            $('#avg_tpor').val((+avg_tpor_).toFixed(2));

        })


        $('#avg_asg,#avg_wtr').change(function() {
            var a1 = randomNumberFromRange(1001.1, 1020.9);
            var a2 = randomNumberFromRange(1001.1, 1020.9);
            var a3 = randomNumberFromRange(1001.1, 1020.9);

            $('#a1').val((+a1).toFixed(1));
            $('#a2').val((+a2).toFixed(1));
            $('#a3').val((+a3).toFixed(1));

            /*var c1 = randomNumberFromRange(645.0, 725.0);
            var c2 = randomNumberFromRange(645.0, 725.0);
            var c3 = randomNumberFromRange(645.0, 725.0);

            */

            var avg_asg = $('#avg_asg').val();
            if ((+randomNumberFromRange(0, 50)) % 2 == 0) {
                var asg1 = (+avg_asg) + (+0.01);
                var asg2 = (+avg_asg) - (+0.03);
                var asg3 = (+avg_asg) + (+0.02);
            } else {
                var asg1 = (+avg_asg) - (+0.01);
                var asg2 = (+avg_asg) + (+0.03);
                var asg3 = (+avg_asg) - (+0.02);
            }

            $('#asg1').val((+asg1).toFixed(2));
            $('#asg2').val((+asg2).toFixed(2));
            $('#asg3').val((+asg3).toFixed(2));

            var avg_wtr = $('#avg_wtr').val();
            if ((+randomNumberFromRange(0, 50)) % 2 == 0) {
                var wtr1 = (+avg_wtr) + (+0.02);
                var wtr2 = (+avg_wtr) - (+0.04);
                var wtr3 = (+avg_wtr) + (+0.02);
            } else {
                var wtr1 = (+avg_wtr) - (+0.02);
                var wtr2 = (+avg_wtr) + (+0.03);
                var wtr3 = (+avg_wtr) - (+0.01);
            }
            $('#wtr1').val((+wtr1).toFixed(2));
            $('#wtr2').val((+wtr2).toFixed(2));
            $('#wtr3').val((+wtr3).toFixed(2));


            /* var avgpor = randomNumberFromRange(1.06, 1.25).toFixed(2);
            $('#avg_por').val(avgpor);
            var avg_por = $('#avg_por').val();
            if((+randomNumberFromRange(0,50))%2==0)
            {
            	var por1 = (+avg_por)+(+0.01);
            	var por2 = (+avg_por)-(+0.02);
            	var por3 = (+avg_por)+(+0.01);
            }
            else
            {
            	var por1 = (+avg_por)-(+0.03);
            	var por2 = (+avg_por)+(+0.06);
            	var por3 = (+avg_por)-(+0.03);
            }

            $('#por1').val((+por1).toFixed(2));
            $('#por2').val((+por2).toFixed(2));
            $('#por3').val((+por3).toFixed(2));
             */


            var a_1 = $('#a1').val();
            var a_2 = $('#a2').val();
            var a_3 = $('#a3').val();

            var wtr_1 = $('#wtr1').val();
            var wtr_2 = $('#wtr2').val();
            var wtr_3 = $('#wtr3').val();

            var temp_wtr1 = (+wtr_1) / 100;
            var temp_wtr2 = (+wtr_2) / 100;
            var temp_wtr3 = (+wtr_3) / 100;

            var temp_od1 = (+temp_wtr1) * (+a_1);
            var temp_od2 = (+temp_wtr2) * (+a_2);
            var temp_od3 = (+temp_wtr3) * (+a_3);

            var b1 = (+temp_od1) + (+a_1);
            var b2 = (+temp_od2) + (+a_2);
            var b3 = (+temp_od3) + (+a_3);

            $('#b1').val((+b1).toFixed(1));
            $('#b2').val((+b2).toFixed(1));
            $('#b3').val((+b3).toFixed(1));

            var asg1 = $('#asg1').val();
            var asg2 = $('#asg2').val();
            var asg3 = $('#asg3').val();

            var cal1 = (+asg1) * (+1000);
            var cal2 = (+asg2) * (+1000);
            var cal3 = (+asg3) * (+1000);

            var cal_1 = (+cal1) - (+a_1);
            var cal_2 = (+cal2) - (+a_2);
            var cal_3 = (+cal3) - (+a_3);

            var c1 = (+cal_1) / (+asg1);
            var c2 = (+cal_2) / (+asg2);
            var c3 = (+cal_3) / (+asg3);

            $('#c1').val((+c1).toFixed(1));
            $('#c2').val((+c2).toFixed(1));
            $('#c3').val((+c3).toFixed(1));


            var c_1 = $('#c1').val();
            var c_2 = $('#c2').val();
            var c_3 = $('#c3').val();

            var b_1 = $('#b1').val();
            var b_2 = $('#b2').val();
            var b_3 = $('#b3').val();


            var upe1 = (+b_1) - (+a_1);
            var upe2 = (+b_2) - (+a_2);
            var upe3 = (+b_3) - (+a_3);

            var dpe1 = (+1000) - (+c_1);
            var dpe2 = (+1000) - (+c_2);
            var dpe3 = (+1000) - (+c_3);


            var euq1 = (+upe1) / (+dpe1);
            var euq2 = (+upe2) / (+dpe2);
            var euq3 = (+upe3) / (+dpe3);

            var ans1 = (+euq1) * (+100);
            var ans2 = (+euq2) * (+100);
            var ans3 = (+euq3) * (+100);

            $('#por1').val((+ans1).toFixed(2));
            $('#por2').val((+ans2).toFixed(2));
            $('#por3').val((+ans3).toFixed(2));

            var por_1 = $('#por1').val();
            var por_2 = $('#por2').val();
            var por_3 = $('#por3').val();

            var avg_por = ((+por_1) + (+por_2) + (+por_3)) / 3;
            $('#avg_por').val((+avg_por).toFixed(2));



            var tspg1 = $('#tspg1').val();
            var tspg2 = $('#tspg2').val();
            var tspg3 = $('#tspg3').val();



            var tpor1 = (+tspg1) - (+asg1) / (+tspg1);
            var tpor2 = (+tspg2) - (+asg2) / (+tspg2);
            var tpor3 = (+tspg3) - (+asg3) / (+tspg3);

            $('#tpor1').val((+tpor1).toFixed(2));
            $('#tpor2').val((+tpor2).toFixed(2));
            $('#tpor3').val((+tpor3).toFixed(2));

            var t_por1 = $('#tpor1').val();
            var t_por2 = $('#tpor2').val();
            var t_por3 = $('#tpor3').val();

            var avg_tpor = ((+t_por1) + (+t_por2) + (+t_por3)) / 3;
            $('#avg_tpor').val((+avg_tpor).toFixed(2));


        })







        function com_auto() {
            $('#txtcom').css("background-color", "var(--success)");
            var com_str = randomNumberFromRange(90.0, 200.0).toFixed(1);
            var avg_com1 = (+com_str) + (+randomNumberFromRange(17.0, 20.0).toFixed(1));
            var avg_com2 = (+com_str) + (+randomNumberFromRange(12.0, 15.0).toFixed(1));
            var avg_com3 = (+com_str) + (+randomNumberFromRange(7.0, 10.0).toFixed(1));
            var avg_com4 = (+com_str) + (+randomNumberFromRange(1.0, 4.0).toFixed(1));

            $('#avg_com1').val((+avg_com1).toFixed(2));
            $('#avg_com2').val((+avg_com2).toFixed(2));
            $('#avg_com3').val((+avg_com3).toFixed(2));
            $('#avg_com4').val((+avg_com4).toFixed(2));

            var avg_com1 = $('#avg_com1').val();
            var avg_com2 = $('#avg_com2').val();
            var avg_com3 = $('#avg_com3').val();
            var avg_com4 = $('#avg_com4').val();

            if ((randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var com1 = (+avg_com1) + 3.1;
                var com2 = (+avg_com1) + 3.1;
                var com3 = (+avg_com1) - 4.1;
                var com4 = (+avg_com1) - 4.5;
                var com5 = (+avg_com1) + 2.6;

                var com6 = (+avg_com2) + 2.9;
                var com7 = (+avg_com2) - 3.7;
                var com8 = (+avg_com2) + 3.1;
                var com9 = (+avg_com2) - 3.9;
                var com10 = (+avg_com2) + 1.6;

                var com11 = (+avg_com3) - 2.3;
                var com12 = (+avg_com3) - 1.9;
                var com13 = (+avg_com3) - 0.9;
                var com14 = (+avg_com3) + 2.3;
                var com15 = (+avg_com3) + 2.5;

                var com16 = (+avg_com4) - 0.8;
                var com17 = (+avg_com4) - 0.3;
                var com18 = (+avg_com4) + 0.5;
                var com19 = (+avg_com4) + 2.1;
                var com20 = (+avg_com4) - 1.5;
            } else {
                var com1 = (+avg_com1) + 3.1;
                var com2 = (+avg_com1) + 3.1;
                var com3 = (+avg_com1) - 4.1;
                var com4 = (+avg_com1) - 4.5;
                var com5 = (+avg_com1) + 2.6;

                var com6 = (+avg_com2) + 2.9;
                var com7 = (+avg_com2) - 3.7;
                var com8 = (+avg_com2) + 3.1;
                var com9 = (+avg_com2) - 3.9;
                var com10 = (+avg_com2) + 1.6;

                var com11 = (+avg_com3) - 2.3;
                var com12 = (+avg_com3) - 1.9;
                var com13 = (+avg_com3) - 0.9;
                var com14 = (+avg_com3) + 2.3;
                var com15 = (+avg_com3) + 2.5;

                var com16 = (+avg_com4) - 0.8;
                var com17 = (+avg_com4) - 0.3;
                var com18 = (+avg_com4) + 0.5;
                var com19 = (+avg_com4) + 2.1;
                var com20 = (+avg_com4) - 1.5;
            }

            $('#com1').val((+com1).toFixed(2));
            $('#com2').val((+com2).toFixed(2));
            $('#com3').val((+com3).toFixed(2));
            $('#com4').val((+com4).toFixed(2));
            $('#com5').val((+com5).toFixed(2));
            $('#com6').val((+com6).toFixed(2));
            $('#com7').val((+com7).toFixed(2));
            $('#com8').val((+com8).toFixed(2));
            $('#com9').val((+com9).toFixed(2));
            $('#com10').val((+com10).toFixed(2));
            $('#com11').val((+com11).toFixed(2));
            $('#com12').val((+com12).toFixed(2));
            $('#com13').val((+com13).toFixed(2));
            $('#com14').val((+com14).toFixed(2));
            $('#com15').val((+com15).toFixed(2));
            $('#com16').val((+com16).toFixed(2));
            $('#com17').val((+com17).toFixed(2));
            $('#com18').val((+com18).toFixed(2));
            $('#com19').val((+com19).toFixed(2));
            $('#com20').val((+com20).toFixed(2));

            var len1 = randomNumberFromRange(48.22, 52.11);
            var len2 = randomNumberFromRange(48.22, 52.11);
            var len3 = randomNumberFromRange(48.22, 52.11);
            var len4 = randomNumberFromRange(48.22, 52.11);
            var len5 = randomNumberFromRange(48.22, 52.11);
            var len6 = randomNumberFromRange(48.22, 52.11);
            var len7 = randomNumberFromRange(48.22, 52.11);
            var len8 = randomNumberFromRange(48.22, 52.11);
            var len9 = randomNumberFromRange(48.22, 52.11);
            var len10 = randomNumberFromRange(48.22, 52.11);
            var len11 = randomNumberFromRange(48.22, 52.11);
            var len12 = randomNumberFromRange(48.22, 52.11);
            var len13 = randomNumberFromRange(48.22, 52.11);
            var len14 = randomNumberFromRange(48.22, 52.11);
            var len15 = randomNumberFromRange(48.22, 52.11);
            var len16 = randomNumberFromRange(48.22, 52.11);
            var len17 = randomNumberFromRange(48.22, 52.11);
            var len18 = randomNumberFromRange(48.22, 52.11);
            var len19 = randomNumberFromRange(48.22, 52.11);
            var len20 = randomNumberFromRange(48.22, 52.11);

            var h1 = randomNumberFromRange(48.22, 52.11);
            var h2 = randomNumberFromRange(48.22, 52.11);
            var h3 = randomNumberFromRange(48.22, 52.11);
            var h4 = randomNumberFromRange(48.22, 52.11);
            var h5 = randomNumberFromRange(48.22, 52.11);
            var h6 = randomNumberFromRange(48.22, 52.11);
            var h7 = randomNumberFromRange(48.22, 52.11);
            var h8 = randomNumberFromRange(48.22, 52.11);
            var h9 = randomNumberFromRange(48.22, 52.11);
            var h10 = randomNumberFromRange(48.22, 52.11);
            var h11 = randomNumberFromRange(48.22, 52.11);
            var h12 = randomNumberFromRange(48.22, 52.11);
            var h13 = randomNumberFromRange(48.22, 52.11);
            var h14 = randomNumberFromRange(48.22, 52.11);
            var h15 = randomNumberFromRange(48.22, 52.11);
            var h16 = randomNumberFromRange(48.22, 52.11);
            var h17 = randomNumberFromRange(48.22, 52.11);
            var h18 = randomNumberFromRange(48.22, 52.11);
            var h19 = randomNumberFromRange(48.22, 52.11);
            var h20 = randomNumberFromRange(48.22, 52.11);

            var w1 = randomNumberFromRange(48.22, 52.11);
            var w2 = randomNumberFromRange(48.22, 52.11);
            var w3 = randomNumberFromRange(48.22, 52.11);
            var w4 = randomNumberFromRange(48.22, 52.11);
            var w5 = randomNumberFromRange(48.22, 52.11);
            var w6 = randomNumberFromRange(48.22, 52.11);
            var w7 = randomNumberFromRange(48.22, 52.11);
            var w8 = randomNumberFromRange(48.22, 52.11);
            var w9 = randomNumberFromRange(48.22, 52.11);
            var w10 = randomNumberFromRange(48.22, 52.11);
            var w11 = randomNumberFromRange(48.22, 52.11);
            var w12 = randomNumberFromRange(48.22, 52.11);
            var w13 = randomNumberFromRange(48.22, 52.11);
            var w14 = randomNumberFromRange(48.22, 52.11);
            var w15 = randomNumberFromRange(48.22, 52.11);
            var w16 = randomNumberFromRange(48.22, 52.11);
            var w17 = randomNumberFromRange(48.22, 52.11);
            var w18 = randomNumberFromRange(48.22, 52.11);
            var w19 = randomNumberFromRange(48.22, 52.11);
            var w20 = randomNumberFromRange(48.22, 52.11);




            $('#len1').val((+len1).toFixed(2));
            $('#len2').val((+len2).toFixed(2));
            $('#len3').val((+len3).toFixed(2));
            $('#len4').val((+len4).toFixed(2));
            $('#len5').val((+len5).toFixed(2));
            $('#len6').val((+len6).toFixed(2));
            $('#len7').val((+len7).toFixed(2));
            $('#len8').val((+len8).toFixed(2));
            $('#len9').val((+len9).toFixed(2));
            $('#len10').val((+len10).toFixed(2));
            $('#len11').val((+len11).toFixed(2));
            $('#len12').val((+len12).toFixed(2));
            $('#len13').val((+len13).toFixed(2));
            $('#len14').val((+len14).toFixed(2));
            $('#len15').val((+len15).toFixed(2));
            $('#len16').val((+len16).toFixed(2));
            $('#len17').val((+len17).toFixed(2));
            $('#len18').val((+len18).toFixed(2));
            $('#len19').val((+len19).toFixed(2));
            $('#len20').val((+len20).toFixed(2));

            $('#h1').val((+h1).toFixed(2));
            $('#h2').val((+h2).toFixed(2));
            $('#h3').val((+h3).toFixed(2));
            $('#h4').val((+h4).toFixed(2));
            $('#h5').val((+h5).toFixed(2));
            $('#h6').val((+h6).toFixed(2));
            $('#h7').val((+h7).toFixed(2));
            $('#h8').val((+h8).toFixed(2));
            $('#h9').val((+h9).toFixed(2));
            $('#h10').val((+h10).toFixed(2));
            $('#h11').val((+h11).toFixed(2));
            $('#h12').val((+h12).toFixed(2));
            $('#h13').val((+h13).toFixed(2));
            $('#h14').val((+h14).toFixed(2));
            $('#h15').val((+h15).toFixed(2));
            $('#h16').val((+h16).toFixed(2));
            $('#h17').val((+h17).toFixed(2));
            $('#h18').val((+h18).toFixed(2));
            $('#h19').val((+h19).toFixed(2));
            $('#h20').val((+h20).toFixed(2));

            $('#w1').val((+w1).toFixed(2));
            $('#w2').val((+w2).toFixed(2));
            $('#w3').val((+w3).toFixed(2));
            $('#w4').val((+w4).toFixed(2));
            $('#w5').val((+w5).toFixed(2));
            $('#w6').val((+w6).toFixed(2));
            $('#w7').val((+w7).toFixed(2));
            $('#w8').val((+w8).toFixed(2));
            $('#w9').val((+w9).toFixed(2));
            $('#w10').val((+w10).toFixed(2));
            $('#w11').val((+w11).toFixed(2));
            $('#w12').val((+w12).toFixed(2));
            $('#w13').val((+w13).toFixed(2));
            $('#w14').val((+w14).toFixed(2));
            $('#w15').val((+w15).toFixed(2));
            $('#w16').val((+w16).toFixed(2));
            $('#w17').val((+w17).toFixed(2));
            $('#w18').val((+w18).toFixed(2));
            $('#w19').val((+w19).toFixed(2));
            $('#w20').val((+w20).toFixed(2));

            var len_1 = $('#len1').val();
            var len_2 = $('#len2').val();
            var len_3 = $('#len3').val();
            var len_4 = $('#len4').val();
            var len_5 = $('#len5').val();
            var len_6 = $('#len6').val();
            var len_7 = $('#len7').val();
            var len_8 = $('#len8').val();
            var len_9 = $('#len9').val();
            var len_10 = $('#len10').val();
            var len_11 = $('#len11').val();
            var len_12 = $('#len12').val();
            var len_13 = $('#len13').val();
            var len_14 = $('#len14').val();
            var len_15 = $('#len15').val();
            var len_16 = $('#len16').val();
            var len_17 = $('#len17').val();
            var len_18 = $('#len18').val();
            var len_19 = $('#len19').val();
            var len_20 = $('#len20').val();

            var h_1 = $('#h1').val();
            var h_2 = $('#h2').val();
            var h_3 = $('#h3').val();
            var h_4 = $('#h4').val();
            var h_5 = $('#h5').val();
            var h_6 = $('#h6').val();
            var h_7 = $('#h7').val();
            var h_8 = $('#h8').val();
            var h_9 = $('#h9').val();
            var h_10 = $('#h10').val();
            var h_11 = $('#h11').val();
            var h_12 = $('#h12').val();
            var h_13 = $('#h13').val();
            var h_14 = $('#h14').val();
            var h_15 = $('#h15').val();
            var h_16 = $('#h16').val();
            var h_17 = $('#h17').val();
            var h_18 = $('#h18').val();
            var h_19 = $('#h19').val();
            var h_20 = $('#h20').val();

            var ratio1 = (+len_1) / (+h_1);
            var ratio2 = (+len_2) / (+h_2);
            var ratio3 = (+len_3) / (+h_3);
            var ratio4 = (+len_4) / (+h_4);
            var ratio5 = (+len_5) / (+h_5);
            var ratio6 = (+len_6) / (+h_6);
            var ratio7 = (+len_7) / (+h_7);
            var ratio8 = (+len_8) / (+h_8);
            var ratio9 = (+len_9) / (+h_9);
            var ratio10 = (+len_10) / (+h_10);
            var ratio11 = (+len_11) / (+h_11);
            var ratio12 = (+len_12) / (+h_12);
            var ratio13 = (+len_13) / (+h_13);
            var ratio14 = (+len_14) / (+h_14);
            var ratio15 = (+len_15) / (+h_15);
            var ratio16 = (+len_16) / (+h_16);
            var ratio17 = (+len_17) / (+h_17);
            var ratio18 = (+len_18) / (+h_18);
            var ratio19 = (+len_19) / (+h_19);
            var ratio20 = (+len_20) / (+h_20);

            $('#ratio1').val((+ratio1).toFixed(2));
            $('#ratio2').val((+ratio2).toFixed(2));
            $('#ratio3').val((+ratio3).toFixed(2));
            $('#ratio4').val((+ratio4).toFixed(2));
            $('#ratio5').val((+ratio5).toFixed(2));
            $('#ratio6').val((+ratio6).toFixed(2));
            $('#ratio7').val((+ratio7).toFixed(2));
            $('#ratio8').val((+ratio8).toFixed(2));
            $('#ratio9').val((+ratio9).toFixed(2));
            $('#ratio10').val((+ratio10).toFixed(2));
            $('#ratio11').val((+ratio11).toFixed(2));
            $('#ratio12').val((+ratio12).toFixed(2));
            $('#ratio13').val((+ratio13).toFixed(2));
            $('#ratio14').val((+ratio14).toFixed(2));
            $('#ratio15').val((+ratio15).toFixed(2));
            $('#ratio16').val((+ratio16).toFixed(2));
            $('#ratio17').val((+ratio17).toFixed(2));
            $('#ratio18').val((+ratio18).toFixed(2));
            $('#ratio19').val((+ratio19).toFixed(2));
            $('#ratio20').val((+ratio20).toFixed(2));

            var w_1 = $('#w1').val();
            var w_2 = $('#w2').val();
            var w_3 = $('#w3').val();
            var w_4 = $('#w4').val();
            var w_5 = $('#w5').val();
            var w_6 = $('#w6').val();
            var w_7 = $('#w7').val();
            var w_8 = $('#w8').val();
            var w_9 = $('#w9').val();
            var w_10 = $('#w10').val();
            var w_11 = $('#w11').val();
            var w_12 = $('#w12').val();
            var w_13 = $('#w13').val();
            var w_14 = $('#w14').val();
            var w_15 = $('#w15').val();
            var w_16 = $('#w16').val();
            var w_17 = $('#w17').val();
            var w_18 = $('#w18').val();
            var w_19 = $('#w19').val();
            var w_20 = $('#w20').val();

            var area1 = (+len_1) * (+w_1);
            var area2 = (+len_2) * (+w_2);
            var area3 = (+len_3) * (+w_3);
            var area4 = (+len_4) * (+w_4);
            var area5 = (+len_5) * (+w_5);
            var area6 = (+len_6) * (+w_6);
            var area7 = (+len_7) * (+w_7);
            var area8 = (+len_8) * (+w_8);
            var area9 = (+len_9) * (+w_9);
            var area10 = (+len_10) * (+w_10);
            var area11 = (+len_11) * (+w_11);
            var area12 = (+len_12) * (+w_12);
            var area13 = (+len_13) * (+w_13);
            var area14 = (+len_14) * (+w_14);
            var area15 = (+len_15) * (+w_15);
            var area16 = (+len_16) * (+w_16);
            var area17 = (+len_17) * (+w_17);
            var area18 = (+len_18) * (+w_18);
            var area19 = (+len_19) * (+w_19);
            var area20 = (+len_20) * (+w_20);

            $('#area1').val((+area1).toFixed(2));
            $('#area2').val((+area2).toFixed(2));
            $('#area3').val((+area3).toFixed(2));
            $('#area4').val((+area4).toFixed(2));
            $('#area5').val((+area5).toFixed(2));
            $('#area6').val((+area6).toFixed(2));
            $('#area7').val((+area7).toFixed(2));
            $('#area8').val((+area8).toFixed(2));
            $('#area9').val((+area9).toFixed(2));
            $('#area10').val((+area10).toFixed(2));
            $('#area11').val((+area11).toFixed(2));
            $('#area12').val((+area12).toFixed(2));
            $('#area13').val((+area13).toFixed(2));
            $('#area14').val((+area14).toFixed(2));
            $('#area15').val((+area15).toFixed(2));
            $('#area16').val((+area16).toFixed(2));
            $('#area17').val((+area17).toFixed(2));
            $('#area18').val((+area18).toFixed(2));
            $('#area19').val((+area19).toFixed(2));
            $('#area20').val((+area20).toFixed(2));

            var com_1 = $('#com1').val();
            var com_2 = $('#com2').val();
            var com_3 = $('#com3').val();
            var com_4 = $('#com4').val();
            var com_5 = $('#com5').val();
            var com_6 = $('#com6').val();
            var com_7 = $('#com7').val();
            var com_8 = $('#com8').val();
            var com_9 = $('#com9').val();
            var com_10 = $('#com10').val();
            var com_11 = $('#com11').val();
            var com_12 = $('#com12').val();
            var com_13 = $('#com13').val();
            var com_14 = $('#com14').val();
            var com_15 = $('#com15').val();
            var com_16 = $('#com16').val();
            var com_17 = $('#com17').val();
            var com_18 = $('#com18').val();
            var com_19 = $('#com19').val();
            var com_20 = $('#com20').val();


            var area_1 = $('#area1').val();
            var area_2 = $('#area2').val();
            var area_3 = $('#area3').val();
            var area_4 = $('#area4').val();
            var area_5 = $('#area5').val();
            var area_6 = $('#area6').val();
            var area_7 = $('#area7').val();
            var area_8 = $('#area8').val();
            var area_9 = $('#area9').val();
            var area_10 = $('#area10').val();
            var area_11 = $('#area11').val();
            var area_12 = $('#area12').val();
            var area_13 = $('#area13').val();
            var area_14 = $('#area14').val();
            var area_15 = $('#area15').val();
            var area_16 = $('#area16').val();
            var area_17 = $('#area17').val();
            var area_18 = $('#area18').val();
            var area_19 = $('#area19').val();
            var area_20 = $('#area20').val();



            var load1 = ((+area_1) * (+com_1)) / 1000;
            var load2 = ((+area_2) * (+com_2)) / 1000;
            var load3 = ((+area_3) * (+com_3)) / 1000;
            var load4 = ((+area_4) * (+com_4)) / 1000;
            var load5 = ((+area_5) * (+com_5)) / 1000;
            var load6 = ((+area_6) * (+com_6)) / 1000;
            var load7 = ((+area_7) * (+com_7)) / 1000;
            var load8 = ((+area_8) * (+com_8)) / 1000;
            var load9 = ((+area_9) * (+com_9)) / 1000;
            var load10 = ((+area_10) * (+com_10)) / 1000;
            var load11 = ((+area_11) * (+com_11)) / 1000;
            var load12 = ((+area_12) * (+com_12)) / 1000;
            var load13 = ((+area_13) * (+com_13)) / 1000;
            var load14 = ((+area_14) * (+com_14)) / 1000;
            var load15 = ((+area_15) * (+com_15)) / 1000;
            var load16 = ((+area_16) * (+com_16)) / 1000;
            var load17 = ((+area_17) * (+com_17)) / 1000;
            var load18 = ((+area_18) * (+com_18)) / 1000;
            var load19 = ((+area_19) * (+com_19)) / 1000;
            var load20 = ((+area_20) * (+com_20)) / 1000;

            $('#load1').val((+load1).toFixed(2));
            $('#load2').val((+load2).toFixed(2));
            $('#load3').val((+load3).toFixed(2));
            $('#load4').val((+load4).toFixed(2));
            $('#load5').val((+load5).toFixed(2));
            $('#load6').val((+load6).toFixed(2));
            $('#load7').val((+load7).toFixed(2));
            $('#load8').val((+load8).toFixed(2));
            $('#load9').val((+load9).toFixed(2));
            $('#load10').val((+load10).toFixed(2));
            $('#load11').val((+load11).toFixed(2));
            $('#load12').val((+load12).toFixed(2));
            $('#load13').val((+load13).toFixed(2));
            $('#load14').val((+load14).toFixed(2));
            $('#load15').val((+load15).toFixed(2));
            $('#load16').val((+load16).toFixed(2));
            $('#load17').val((+load17).toFixed(2));
            $('#load18').val((+load18).toFixed(2));
            $('#load19').val((+load19).toFixed(2));
            $('#load20').val((+load20).toFixed(2));

        }

        //COMPRESSIVE STRENGTH
        $('#chk_com').change(function() {
            if (this.checked) {
                com_auto();

            } else {
                $('#txtcom').css("background-color", "white");
                $('#len1').val(null);
                $('#len2').val(null);
                $('#len3').val(null);
                $('#len4').val(null);
                $('#len5').val(null);
                $('#len6').val(null);
                $('#len7').val(null);
                $('#len8').val(null);
                $('#len9').val(null);
                $('#len10').val(null);
                $('#len11').val(null);
                $('#len12').val(null);
                $('#len13').val(null);
                $('#len14').val(null);
                $('#len15').val(null);
                $('#len16').val(null);
                $('#len17').val(null);
                $('#len18').val(null);
                $('#len19').val(null);
                $('#len20').val(null);
                $('#h1').val(null);
                $('#h2').val(null);
                $('#h3').val(null);
                $('#h4').val(null);
                $('#h5').val(null);
                $('#h6').val(null);
                $('#h7').val(null);
                $('#h8').val(null);
                $('#h9').val(null);
                $('#h10').val(null);
                $('#h11').val(null);
                $('#h12').val(null);
                $('#h13').val(null);
                $('#h14').val(null);
                $('#h15').val(null);
                $('#h16').val(null);
                $('#h17').val(null);
                $('#h18').val(null);
                $('#h19').val(null);
                $('#h20').val(null);
                $('#w1').val(null);
                $('#w2').val(null);
                $('#w3').val(null);
                $('#w4').val(null);
                $('#w5').val(null);
                $('#w6').val(null);
                $('#w7').val(null);
                $('#w8').val(null);
                $('#w9').val(null);
                $('#w10').val(null);
                $('#w11').val(null);
                $('#w12').val(null);
                $('#w13').val(null);
                $('#w14').val(null);
                $('#w15').val(null);
                $('#w16').val(null);
                $('#w17').val(null);
                $('#w18').val(null);
                $('#w19').val(null);
                $('#w20').val(null);
                $('#ratio1').val(null);
                $('#ratio2').val(null);
                $('#ratio3').val(null);
                $('#ratio4').val(null);
                $('#ratio5').val(null);
                $('#ratio6').val(null);
                $('#ratio7').val(null);
                $('#ratio8').val(null);
                $('#ratio9').val(null);
                $('#ratio10').val(null);
                $('#ratio11').val(null);
                $('#ratio12').val(null);
                $('#ratio13').val(null);
                $('#ratio14').val(null);
                $('#ratio15').val(null);
                $('#ratio16').val(null);
                $('#ratio17').val(null);
                $('#ratio18').val(null);
                $('#ratio19').val(null);
                $('#ratio20').val(null);
                $('#area1').val(null);
                $('#area2').val(null);
                $('#area3').val(null);
                $('#area4').val(null);
                $('#area5').val(null);
                $('#area6').val(null);
                $('#area7').val(null);
                $('#area8').val(null);
                $('#area9').val(null);
                $('#area10').val(null);
                $('#area11').val(null);
                $('#area12').val(null);
                $('#area13').val(null);
                $('#area14').val(null);
                $('#area15').val(null);
                $('#area16').val(null);
                $('#area17').val(null);
                $('#area18').val(null);
                $('#area19').val(null);
                $('#area20').val(null);
                $('#load1').val(null);
                $('#load2').val(null);
                $('#load3').val(null);
                $('#load4').val(null);
                $('#load5').val(null);
                $('#load6').val(null);
                $('#load7').val(null);
                $('#load8').val(null);
                $('#load9').val(null);
                $('#load10').val(null);
                $('#load11').val(null);
                $('#load12').val(null);
                $('#load13').val(null);
                $('#load14').val(null);
                $('#load15').val(null);
                $('#load16').val(null);
                $('#load17').val(null);
                $('#load18').val(null);
                $('#load19').val(null);
                $('#load20').val(null);
                $('#com1').val(null);
                $('#com2').val(null);
                $('#com3').val(null);
                $('#com4').val(null);
                $('#com5').val(null);
                $('#com6').val(null);
                $('#com7').val(null);
                $('#com8').val(null);
                $('#com9').val(null);
                $('#com10').val(null);
                $('#com11').val(null);
                $('#com12').val(null);
                $('#com13').val(null);
                $('#com14').val(null);
                $('#com15').val(null);
                $('#com16').val(null);
                $('#com17').val(null);
                $('#com18').val(null);
                $('#com19').val(null);
                $('#com20').val(null);
                $('#avg_com1').val(null);
                $('#avg_com2').val(null);
                $('#avg_com3').val(null);
                $('#avg_com4').val(null);
            }
        });

        $("#avg_com1").change(function() {
            $('#chk_com').prop('checked', true);
            $('#txtcom').css("background-color", "var(--success)");

            var avg_com_1 = $('#avg_com1').val();

            var diff = (+randomNumberFromRange(1, 8)).toFixed();
            if (diff % 2 == 0) {
                var com1 = (+avg_com_1) + 5.55;
                var com2 = (+avg_com_1) + 4.15;
                var com3 = (+avg_com_1) - 2.03
                var com4 = (+avg_com_1) - 3.20;
                var com5 = (+avg_com_1) - 4.47;


            } else {
                var com1 = (+avg_com_1) + 4.15;
                var com2 = (+avg_com_1) + 1.12
                var com3 = (+avg_com_1) + 2.89;
                var com4 = (+avg_com_1) - 4.01;
                var com5 = (+avg_com_1) - 4.15;

            }

            $('#com1').val((+com1).toFixed(2));
            $('#com2').val((+com2).toFixed(2));
            $('#com3').val((+com3).toFixed(2));
            $('#com4').val((+com4).toFixed(2));
            $('#com5').val((+com5).toFixed(2));

            var com_1 = $('#com1').val();
            var com_2 = $('#com2').val();
            var com_3 = $('#com3').val();
            var com_4 = $('#com4').val();
            var com_5 = $('#com5').val();

            var area_1 = $('#area1').val();
            var area_2 = $('#area2').val();
            var area_3 = $('#area3').val();
            var area_4 = $('#area4').val();
            var area_5 = $('#area5').val();

            var load1 = ((+area_1) * (+com_1)) / 1000;
            var load2 = ((+area_2) * (+com_2)) / 1000;
            var load3 = ((+area_3) * (+com_3)) / 1000;
            var load4 = ((+area_4) * (+com_4)) / 1000;
            var load5 = ((+area_5) * (+com_5)) / 1000;

            $('#load1').val((+load1).toFixed(2));
            $('#load2').val((+load2).toFixed(2));
            $('#load3').val((+load3).toFixed(2));
            $('#load4').val((+load4).toFixed(2));
            $('#load5').val((+load5).toFixed(2));
        })

        $("#avg_com2").change(function() {
            $('#chk_com').prop('checked', true);
            $('#txtcom').css("background-color", "var(--success)");

            var avg_com2 = $('#avg_com2').val();

            var diff = (+randomNumberFromRange(1, 8)).toFixed();
            if (diff % 2 == 0) {
                var com6 = (+avg_com2) - 3.55;
                var com7 = (+avg_com2) + 4.54;
                var com8 = (+avg_com2) - 2.22;
                var com9 = (+avg_com2) - 2.32;
                var com10 = (+avg_com2) + 3.55;


            } else {
                var com6 = (+avg_com2) + 3.55;
                var com7 = (+avg_com2) - 4.54;
                var com8 = (+avg_com2) + 2.22;
                var com9 = (+avg_com2) + 2.32;
                var com10 = (+avg_com2) - 3.55;

            }

            $('#com6').val((+com6).toFixed(2));
            $('#com7').val((+com7).toFixed(2));
            $('#com8').val((+com8).toFixed(2));
            $('#com9').val((+com9).toFixed(2));
            $('#com10').val((+com10).toFixed(2));

            var com_6 = $('#com6').val();
            var com_7 = $('#com7').val();
            var com_8 = $('#com8').val();
            var com_9 = $('#com9').val();
            var com_10 = $('#com10').val();

            var area_6 = $('#area6').val();
            var area_7 = $('#area7').val();
            var area_8 = $('#area8').val();
            var area_9 = $('#area9').val();
            var area_10 = $('#area10').val();

            var load6 = ((+area_6) * (+com_6)) / 1000;
            var load7 = ((+area_7) * (+com_7)) / 1000;
            var load8 = ((+area_8) * (+com_8)) / 1000;
            var load9 = ((+area_9) * (+com_9)) / 1000;
            var load10 = ((+area_10) * (+com_10)) / 1000;

            $('#load6').val((+load6).toFixed(2));
            $('#load7').val((+load7).toFixed(2));
            $('#load8').val((+load8).toFixed(2));
            $('#load9').val((+load9).toFixed(2));
            $('#load10').val((+load10).toFixed(2));
        })

        $("#avg_com3").change(function() {
            $('#chk_com').prop('checked', true);
            $('#txtcom').css("background-color", "var(--success)");

            var avg_com3 = $('#avg_com3').val();

            var diff = (+randomNumberFromRange(1, 8)).toFixed();
            if (diff % 2 == 0) {
                var com11 = (+avg_com3) + 2.56;
                var com12 = (+avg_com3) - 5.30;
                var com13 = (+avg_com3) - 3.67;
                var com14 = (+avg_com3) + 2.11;
                var com15 = (+avg_com3) + 4.30;


            } else {
                var com11 = (+avg_com3) - 2.56;
                var com12 = (+avg_com3) + 5.30;
                var com13 = (+avg_com3) + 3.67;
                var com14 = (+avg_com3) - 2.11;
                var com15 = (+avg_com3) - 4.30;
            }

            $('#com11').val((+com11).toFixed(2));
            $('#com12').val((+com12).toFixed(2));
            $('#com13').val((+com13).toFixed(2));
            $('#com14').val((+com14).toFixed(2));
            $('#com15').val((+com15).toFixed(2));

            var com_11 = $('#com11').val();
            var com_12 = $('#com12').val();
            var com_13 = $('#com13').val();
            var com_14 = $('#com14').val();
            var com_15 = $('#com15').val();

            var area_11 = $('#area11').val();
            var area_12 = $('#area12').val();
            var area_13 = $('#area13').val();
            var area_14 = $('#area14').val();
            var area_15 = $('#area15').val();

            var load11 = ((+area_11) * (+com_11)) / 1000;
            var load12 = ((+area_12) * (+com_12)) / 1000;
            var load13 = ((+area_13) * (+com_13)) / 1000;
            var load14 = ((+area_14) * (+com_14)) / 1000;
            var load15 = ((+area_15) * (+com_15)) / 1000;

            $('#load11').val((+load11).toFixed(2));
            $('#load12').val((+load12).toFixed(2));
            $('#load13').val((+load13).toFixed(2));
            $('#load14').val((+load14).toFixed(2));
            $('#load15').val((+load15).toFixed(2));
        })

        $("#avg_com4").change(function() {
            $('#chk_com').prop('checked', true);
            $('#txtcom').css("background-color", "var(--success)");

            var avg_com4 = $('#avg_com4').val();

            var diff = (+randomNumberFromRange(1, 8)).toFixed();
            if (diff % 2 == 0) {
                var com16 = (+avg_com4) + 4.65;
                var com17 = (+avg_com4) - 2.84;
                var com18 = (+avg_com4) - 7.65;
                var com19 = (+avg_com4) + 1.54;
                var com20 = (+avg_com4) + 4.30;

            } else {
                var com16 = (+avg_com4) - 4.65;
                var com17 = (+avg_com4) + 2.84;
                var com18 = (+avg_com4) + 7.65;
                var com19 = (+avg_com4) - 1.54;
                var com20 = (+avg_com4) - 4.30;
            }

            $('#com16').val((+com16).toFixed(2));
            $('#com17').val((+com17).toFixed(2));
            $('#com18').val((+com18).toFixed(2));
            $('#com19').val((+com19).toFixed(2));
            $('#com20').val((+com20).toFixed(2));

            var com_16 = $('#com16').val();
            var com_17 = $('#com17').val();
            var com_18 = $('#com18').val();
            var com_19 = $('#com19').val();
            var com_20 = $('#com20').val();

            var area_16 = $('#area16').val();
            var area_17 = $('#area17').val();
            var area_18 = $('#area18').val();
            var area_19 = $('#area19').val();
            var area_20 = $('#area20').val();

            var load16 = ((+area_16) * (+com_16)) / 1000;
            var load17 = ((+area_17) * (+com_17)) / 1000;
            var load18 = ((+area_18) * (+com_18)) / 1000;
            var load19 = ((+area_19) * (+com_19)) / 1000;
            var load20 = ((+area_20) * (+com_20)) / 1000;

            $('#load16').val((+load16).toFixed(2));
            $('#load17').val((+load17).toFixed(2));
            $('#load18').val((+load18).toFixed(2));
            $('#load19').val((+load19).toFixed(2));
            $('#load20').val((+load20).toFixed(2));
        })

        $("#len1,#len2,#len3,#len4,#len5,#len6,#len7,#len8,#len9,#len10,#len11,#len12,#len13,#len14,#len15,#len16,#len17,#len18,#len19,#len20,#h1,#h2,#h3,#h4,#h5,#h6,#h7,#h8,#h9,#h10,#h11,#h12,#h13,#h14,#h15,#h16,#h17,#h18,#h19,#h20,#w1,#w2,#w3,#w4,#w5,#w6,#w7,#w8,#w9,#w10,#w11,#w12,#w13,#w14,#w15,#w16,#w17,#w18,#w19,#w20,#load1,#load2,#load3,#load4,#load5,#load6,#load7,#load8,#load9,#load10,#load11,#load12,#load13,#load14,#load15,#load16,#load17,#load18,#load19,#load20").change(function() {

            var len_1 = $('#len1').val();
            var len_2 = $('#len2').val();
            var len_3 = $('#len3').val();
            var len_4 = $('#len4').val();
            var len_5 = $('#len5').val();
            var len_6 = $('#len6').val();
            var len_7 = $('#len7').val();
            var len_8 = $('#len8').val();
            var len_9 = $('#len9').val();
            var len_10 = $('#len10').val();
            var len_11 = $('#len11').val();
            var len_12 = $('#len12').val();
            var len_13 = $('#len13').val();
            var len_14 = $('#len14').val();
            var len_15 = $('#len15').val();
            var len_16 = $('#len16').val();
            var len_17 = $('#len17').val();
            var len_18 = $('#len18').val();
            var len_19 = $('#len19').val();
            var len_20 = $('#len20').val();

            var h_1 = $('#h1').val();
            var h_2 = $('#h2').val();
            var h_3 = $('#h3').val();
            var h_4 = $('#h4').val();
            var h_5 = $('#h5').val();
            var h_6 = $('#h6').val();
            var h_7 = $('#h7').val();
            var h_8 = $('#h8').val();
            var h_9 = $('#h9').val();
            var h_10 = $('#h10').val();
            var h_11 = $('#h11').val();
            var h_12 = $('#h12').val();
            var h_13 = $('#h13').val();
            var h_14 = $('#h14').val();
            var h_15 = $('#h15').val();
            var h_16 = $('#h16').val();
            var h_17 = $('#h17').val();
            var h_18 = $('#h18').val();
            var h_19 = $('#h19').val();
            var h_20 = $('#h20').val();

            var ratio1 = (+len_1) / (+h_1);
            var ratio2 = (+len_2) / (+h_2);
            var ratio3 = (+len_3) / (+h_3);
            var ratio4 = (+len_4) / (+h_4);
            var ratio5 = (+len_5) / (+h_5);
            var ratio6 = (+len_6) / (+h_6);
            var ratio7 = (+len_7) / (+h_7);
            var ratio8 = (+len_8) / (+h_8);
            var ratio9 = (+len_9) / (+h_9);
            var ratio10 = (+len_10) / (+h_10);
            var ratio11 = (+len_11) / (+h_11);
            var ratio12 = (+len_12) / (+h_12);
            var ratio13 = (+len_13) / (+h_13);
            var ratio14 = (+len_14) / (+h_14);
            var ratio15 = (+len_15) / (+h_15);
            var ratio16 = (+len_16) / (+h_16);
            var ratio17 = (+len_17) / (+h_17);
            var ratio18 = (+len_18) / (+h_18);
            var ratio19 = (+len_19) / (+h_19);
            var ratio20 = (+len_20) / (+h_20);

            $('#ratio1').val((+ratio1).toFixed(2));
            $('#ratio2').val((+ratio2).toFixed(2));
            $('#ratio3').val((+ratio3).toFixed(2));
            $('#ratio4').val((+ratio4).toFixed(2));
            $('#ratio5').val((+ratio5).toFixed(2));
            $('#ratio6').val((+ratio6).toFixed(2));
            $('#ratio7').val((+ratio7).toFixed(2));
            $('#ratio8').val((+ratio8).toFixed(2));
            $('#ratio9').val((+ratio9).toFixed(2));
            $('#ratio10').val((+ratio10).toFixed(2));
            $('#ratio11').val((+ratio11).toFixed(2));
            $('#ratio12').val((+ratio12).toFixed(2));
            $('#ratio13').val((+ratio13).toFixed(2));
            $('#ratio14').val((+ratio14).toFixed(2));
            $('#ratio15').val((+ratio15).toFixed(2));
            $('#ratio16').val((+ratio16).toFixed(2));
            $('#ratio17').val((+ratio17).toFixed(2));
            $('#ratio18').val((+ratio18).toFixed(2));
            $('#ratio19').val((+ratio19).toFixed(2));
            $('#ratio20').val((+ratio20).toFixed(2));

            var w_1 = $('#w1').val();
            var w_2 = $('#w2').val();
            var w_3 = $('#w3').val();
            var w_4 = $('#w4').val();
            var w_5 = $('#w5').val();
            var w_6 = $('#w6').val();
            var w_7 = $('#w7').val();
            var w_8 = $('#w8').val();
            var w_9 = $('#w9').val();
            var w_10 = $('#w10').val();
            var w_11 = $('#w11').val();
            var w_12 = $('#w12').val();
            var w_13 = $('#w13').val();
            var w_14 = $('#w14').val();
            var w_15 = $('#w15').val();
            var w_16 = $('#w16').val();
            var w_17 = $('#w17').val();
            var w_18 = $('#w18').val();
            var w_19 = $('#w19').val();
            var w_20 = $('#w20').val();

            var area1 = (+len_1) * (+w_1);
            var area2 = (+len_2) * (+w_2);
            var area3 = (+len_3) * (+w_3);
            var area4 = (+len_4) * (+w_4);
            var area5 = (+len_5) * (+w_5);
            var area6 = (+len_6) * (+w_6);
            var area7 = (+len_7) * (+w_7);
            var area8 = (+len_8) * (+w_8);
            var area9 = (+len_9) * (+w_9);
            var area10 = (+len_10) * (+w_10);
            var area11 = (+len_11) * (+w_11);
            var area12 = (+len_12) * (+w_12);
            var area13 = (+len_13) * (+w_13);
            var area14 = (+len_14) * (+w_14);
            var area15 = (+len_15) * (+w_15);
            var area16 = (+len_16) * (+w_16);
            var area17 = (+len_17) * (+w_17);
            var area18 = (+len_18) * (+w_18);
            var area19 = (+len_19) * (+w_19);
            var area20 = (+len_20) * (+w_20);

            $('#area1').val((+area1).toFixed(2));
            $('#area2').val((+area2).toFixed(2));
            $('#area3').val((+area3).toFixed(2));
            $('#area4').val((+area4).toFixed(2));
            $('#area5').val((+area5).toFixed(2));
            $('#area6').val((+area6).toFixed(2));
            $('#area7').val((+area7).toFixed(2));
            $('#area8').val((+area8).toFixed(2));
            $('#area9').val((+area9).toFixed(2));
            $('#area10').val((+area10).toFixed(2));
            $('#area11').val((+area11).toFixed(2));
            $('#area12').val((+area12).toFixed(2));
            $('#area13').val((+area13).toFixed(2));
            $('#area14').val((+area14).toFixed(2));
            $('#area15').val((+area15).toFixed(2));
            $('#area16').val((+area16).toFixed(2));
            $('#area17').val((+area17).toFixed(2));
            $('#area18').val((+area18).toFixed(2));
            $('#area19').val((+area19).toFixed(2));
            $('#area20').val((+area20).toFixed(2));

            var area_1 = $('#area1').val();
            var area_2 = $('#area2').val();
            var area_3 = $('#area3').val();
            var area_4 = $('#area4').val();
            var area_5 = $('#area5').val();
            var area_6 = $('#area6').val();
            var area_7 = $('#area7').val();
            var area_8 = $('#area8').val();
            var area_9 = $('#area9').val();
            var area_10 = $('#area10').val();
            var area_11 = $('#area11').val();
            var area_12 = $('#area12').val();
            var area_13 = $('#area13').val();
            var area_14 = $('#area14').val();
            var area_15 = $('#area15').val();
            var area_16 = $('#area16').val();
            var area_17 = $('#area17').val();
            var area_18 = $('#area18').val();
            var area_19 = $('#area19').val();
            var area_20 = $('#area20').val();

            var load1 = $('#load1').val();
            var load2 = $('#load2').val();
            var load3 = $('#load3').val();
            var load4 = $('#load4').val();
            var load5 = $('#load5').val();
            var load6 = $('#load6').val();
            var load7 = $('#load7').val();
            var load8 = $('#load8').val();
            var load9 = $('#load9').val();
            var load10 = $('#load10').val();
            var load11 = $('#load11').val();
            var load12 = $('#load12').val();
            var load13 = $('#load13').val();
            var load14 = $('#load14').val();
            var load15 = $('#load15').val();
            var load16 = $('#load16').val();
            var load17 = $('#load17').val();
            var load18 = $('#load18').val();
            var load19 = $('#load19').val();
            var load20 = $('#load20').val();

            var com1 = ((+load1) / (+area_1)) * (+1000);
            var com2 = ((+load2) / (+area_2)) * (+1000);
            var com3 = ((+load3) / (+area_3)) * (+1000);
            var com4 = ((+load4) / (+area_4)) * (+1000);
            var com5 = ((+load5) / (+area_5)) * (+1000);
            var com6 = ((+load6) / (+area_6)) * (+1000);
            var com7 = ((+load7) / (+area_7)) * (+1000);
            var com8 = ((+load8) / (+area_8)) * (+1000);
            var com9 = ((+load9) / (+area_9)) * (+1000);
            var com10 = ((+load10) / (+area_10)) * (+1000);
            var com11 = ((+load11) / (+area_11)) * (+1000);
            var com12 = ((+load12) / (+area_12)) * (+1000);
            var com13 = ((+load13) / (+area_13)) * (+1000);
            var com14 = ((+load14) / (+area_14)) * (+1000);
            var com15 = ((+load15) / (+area_15)) * (+1000);
            var com16 = ((+load16) / (+area_16)) * (+1000);
            var com17 = ((+load17) / (+area_17)) * (+1000);
            var com18 = ((+load18) / (+area_18)) * (+1000);
            var com19 = ((+load19) / (+area_19)) * (+1000);
            var com20 = ((+load20) / (+area_20)) * (+1000);

            $('#com1').val((+com1).toFixed(2));
            $('#com2').val((+com2).toFixed(2));
            $('#com3').val((+com3).toFixed(2));
            $('#com4').val((+com4).toFixed(2));
            $('#com5').val((+com5).toFixed(2));
            $('#com6').val((+com6).toFixed(2));
            $('#com7').val((+com7).toFixed(2));
            $('#com8').val((+com8).toFixed(2));
            $('#com9').val((+com9).toFixed(2));
            $('#com10').val((+com10).toFixed(2));
            $('#com11').val((+com11).toFixed(2));
            $('#com12').val((+com12).toFixed(2));
            $('#com13').val((+com13).toFixed(2));
            $('#com14').val((+com14).toFixed(2));
            $('#com15').val((+com15).toFixed(2));
            $('#com16').val((+com16).toFixed(2));
            $('#com17').val((+com17).toFixed(2));
            $('#com18').val((+com18).toFixed(2));
            $('#com19').val((+com19).toFixed(2));
            $('#com20').val((+com20).toFixed(2));


            var com_1 = $('#com1').val();
            var com_2 = $('#com2').val();
            var com_3 = $('#com3').val();
            var com_4 = $('#com4').val();
            var com_5 = $('#com5').val();
            var com_6 = $('#com6').val();
            var com_7 = $('#com7').val();
            var com_8 = $('#com8').val();
            var com_9 = $('#com9').val();
            var com_10 = $('#com10').val();
            var com_11 = $('#com11').val();
            var com_12 = $('#com12').val();
            var com_13 = $('#com13').val();
            var com_14 = $('#com14').val();
            var com_15 = $('#com15').val();
            var com_16 = $('#com16').val();
            var com_17 = $('#com17').val();
            var com_18 = $('#com18').val();
            var com_19 = $('#com19').val();
            var com_20 = $('#com20').val();

            var avg_com1 = ((+com_1) + (+com_2) + (+com_3) + (+com_4) + (+com_5)) / 5;
            $('#avg_com1').val((+avg_com1).toFixed(2));

            var avg_com2 = ((+com_6) + (+com_7) + (+com_8) + (+com_9) + (+com_10)) / 5;
            $('#avg_com2').val((+avg_com2).toFixed(2));

            var avg_com3 = ((+com_11) + (+com_12) + (+com_13) + (+com_14) + (+com_15)) / 5;
            $('#avg_com3').val((+avg_com3).toFixed(2));

            var avg_com4 = ((+com_16) + (+com_17) + (+com_18) + (+com_19) + (+com_20)) / 5;
            $('#avg_com5').val((+avg_com4).toFixed(2));

        });

        function tra_auto() {
            $('#txttra').css("background-color", "var(--success)");
            var com_dry = $('#avg_com1').val();
            var com_wet = $('#avg_com4').val();
            var tra_per = randomNumberFromRange(10.00, 12.00).toFixed(2)

            var avg_tra1 = ((+com_dry) * (+tra_per)) / 100;
            var avg_tra2 = ((+com_wet) * (+tra_per)) / 100;

            $('#avg_tra1').val((+avg_tra1).toFixed(2));
            $('#avg_tra2').val((+avg_tra2).toFixed(2));
            var avg_tra1 = $('#avg_tra1').val();
            var avg_tra2 = $('#avg_tra2').val();

            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var tra1 = (+avg_tra1) + 1.20;
                var tra2 = (+avg_tra1) + 0.41;
                var tra3 = (+avg_tra1) + 0.89;
                var tra4 = (+avg_tra1) - 1.30;
                var tra5 = (+avg_tra1) - 1.20;

                var tra6 = (+avg_tra2) - 0.54;
                var tra7 = (+avg_tra2) - 0.81;
                var tra8 = (+avg_tra2) + 0.94;
                var tra9 = (+avg_tra2) - 0.13;
                var tra10 = (+avg_tra2) + 0.54;
            } else {
                var tra1 = (+avg_tra1) - 1.01;
                var tra2 = (+avg_tra1) + 1.01;
                var tra3 = (+avg_tra1) + 2.29;
                var tra4 = (+avg_tra1) - 0.74;
                var tra5 = (+avg_tra1) - 1.55;

                var tra6 = (+avg_tra2) + 1.08;
                var tra7 = (+avg_tra2) - 0.61;
                var tra8 = (+avg_tra2) + 0.79;
                var tra9 = (+avg_tra2) - 0.79;
                var tra10 = (+avg_tra2) - 0.47;
            }

            $('#tra1').val((+tra1).toFixed(2));
            $('#tra2').val((+tra2).toFixed(2));
            $('#tra3').val((+tra3).toFixed(2));
            $('#tra4').val((+tra4).toFixed(2));
            $('#tra5').val((+tra5).toFixed(2));
            $('#tra6').val((+tra6).toFixed(2));
            $('#tra7').val((+tra7).toFixed(2));
            $('#tra8').val((+tra8).toFixed(2));
            $('#tra9').val((+tra9).toFixed(2));
            $('#tra10').val((+tra10).toFixed(2));


            $('#tl1').val(150);
            $('#tl2').val(150);
            $('#tl3').val(150);
            $('#tl4').val(150);
            $('#tl5').val(150);
            $('#tl6').val(150);
            $('#tl7').val(150);
            $('#tl8').val(150);
            $('#tl9').val(150);
            $('#tl10').val(150);

            var tra_width1 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width2 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width3 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width4 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width5 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width6 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width7 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width8 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width9 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_width10 = randomNumberFromRange(0.00, 1.50).toFixed(2);

            var tb1 = (+tra_width1) + 50.00;
            var tb2 = (+tra_width2) + 50.00;
            var tb3 = (+tra_width3) + 50.00;
            var tb4 = (+tra_width4) + 50.00;
            var tb5 = (+tra_width5) + 50.00;
            var tb6 = (+tra_width6) + 50.00;
            var tb7 = (+tra_width7) + 50.00;
            var tb8 = (+tra_width8) + 50.00;
            var tb9 = (+tra_width9) + 50.00;
            var tb10 = (+tra_width10) + 50.00;

            $('#tb1').val((+tb1).toFixed(2));
            $('#tb2').val((+tb2).toFixed(2));
            $('#tb3').val((+tb3).toFixed(2));
            $('#tb4').val((+tb4).toFixed(2));
            $('#tb5').val((+tb5).toFixed(2));
            $('#tb6').val((+tb6).toFixed(2));
            $('#tb7').val((+tb7).toFixed(2));
            $('#tb8').val((+tb8).toFixed(2));
            $('#tb9').val((+tb9).toFixed(2));
            $('#tb10').val((+tb10).toFixed(2));



            /*var tra_thk1 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk2 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk3 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk4 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk5 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk6 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk7 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk8 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk9 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var tra_thk10 = randomNumberFromRange(0.00, 1.50).toFixed(2);

            var ta1 = (+tra_thk1) + 50.00;
            var ta2 = (+tra_thk2) + 50.00;
            var ta3 = (+tra_thk3) + 50.00;
            var ta4 = (+tra_thk4) + 50.00;
            var ta5 = (+tra_thk5) + 50.00;
            var ta6 = (+tra_thk6) + 50.00;
            var ta7 = (+tra_thk7) + 50.00;
            var ta8 = (+tra_thk8) + 50.00;
            var ta9 = (+tra_thk9) + 50.00;
            var ta10 = (+tra_thk10) + 50.00;

            $('#ta1').val((+ta1).toFixed(2));
            $('#ta2').val((+ta2).toFixed(2));
            $('#ta3').val((+ta3).toFixed(2));
            $('#ta4').val((+ta4).toFixed(2));
            $('#ta5').val((+ta5).toFixed(2));
            $('#ta6').val((+ta6).toFixed(2));
            $('#ta7').val((+ta7).toFixed(2));
            $('#ta8').val((+ta8).toFixed(2));
            $('#ta9').val((+ta9).toFixed(2));
            $('#ta10').val((+ta10).toFixed(2));*/

            var tra_load = randomNumberFromRange(4.000, 9.000).toFixed(3);
            var tra_diff = randomNumberFromRange(1, 9).toFixed();
            if (tra_diff % 2 == 0) {
                var cb1 = (+tra_load) + 0.220;
                var cb2 = (+tra_load) + 0.600;
                var cb3 = (+tra_load) + 0.678;
                var cb4 = (+tra_load) + 0.248;
                var cb5 = (+tra_load) + 0.687;
                var cb6 = (+tra_load) + 0.128;
                var cb7 = (+tra_load) + 0.365;
                var cb8 = (+tra_load) + 0.043;
                var cb9 = (+tra_load) + 0.403;
                var cb10 = (+tra_load) + 0.342;
            } else {
                var cb1 = (+tra_load) + 0.403;
                var cb2 = (+tra_load) + 0.125;
                var cb3 = (+tra_load) + 0.529;
                var cb4 = (+tra_load) + 0.349;
                var cb5 = (+tra_load) + 0.296;
                var cb6 = (+tra_load) + 0.174;
                var cb7 = (+tra_load) + 0.382;
                var cb8 = (+tra_load) + 0.419;
                var cb9 = (+tra_load) + 0.617;
                var cb10 = (+tra_load) + 0.361;
            }

            $('#cb1').val((+cb1).toFixed(3));
            $('#cb2').val((+cb2).toFixed(3));
            $('#cb3').val((+cb3).toFixed(3));
            $('#cb4').val((+cb4).toFixed(3));
            $('#cb5').val((+cb5).toFixed(3));
            $('#cb6').val((+cb6).toFixed(3));
            $('#cb7').val((+cb7).toFixed(3));
            $('#cb8').val((+cb8).toFixed(3));
            $('#cb9').val((+cb9).toFixed(3));
            $('#cb10').val((+cb10).toFixed(3));

            var tl1 = $('#tl1').val();
            var tl2 = $('#tl2').val();
            var tl3 = $('#tl3').val();
            var tl4 = $('#tl4').val();
            var tl5 = $('#tl5').val();
            var tl6 = $('#tl6').val();
            var tl7 = $('#tl7').val();
            var tl8 = $('#tl8').val();
            var tl9 = $('#tl9').val();
            var tl10 = $('#tl10').val();

            var tb1 = $('#tb1').val();
            var tb2 = $('#tb2').val();
            var tb3 = $('#tb3').val();
            var tb4 = $('#tb4').val();
            var tb5 = $('#tb5').val();
            var tb6 = $('#tb6').val();
            var tb7 = $('#tb7').val();
            var tb8 = $('#tb8').val();
            var tb9 = $('#tb9').val();
            var tb10 = $('#tb10').val();

            var cb1 = $('#cb1').val();
            var cb2 = $('#cb2').val();
            var cb3 = $('#cb3').val();
            var cb4 = $('#cb4').val();
            var cb5 = $('#cb5').val();
            var cb6 = $('#cb6').val();
            var cb7 = $('#cb7').val();
            var cb8 = $('#cb8').val();
            var cb9 = $('#cb9').val();
            var cb10 = $('#cb10').val();

            var tra1 = $('#tra1').val();
            var tra2 = $('#tra2').val();
            var tra3 = $('#tra3').val();
            var tra4 = $('#tra4').val();
            var tra5 = $('#tra5').val();
            var tra6 = $('#tra6').val();
            var tra7 = $('#tra7').val();
            var tra8 = $('#tra8').val();
            var tra9 = $('#tra9').val();
            var tra10 = $('#tra10').val();

            var ta1 = ((+3) * (+cb1) * (+tl1) * (+1000)) / ((+2) * (+tb1) * (+tra1));
            var ta2 = ((+3) * (+cb2) * (+tl2) * (+1000)) / ((+2) * (+tb2) * (+tra2));
            var ta3 = ((+3) * (+cb3) * (+tl3) * (+1000)) / ((+2) * (+tb3) * (+tra3));
            var ta4 = ((+3) * (+cb4) * (+tl4) * (+1000)) / ((+2) * (+tb4) * (+tra4));
            var ta5 = ((+3) * (+cb5) * (+tl5) * (+1000)) / ((+2) * (+tb5) * (+tra5));
            var ta6 = ((+3) * (+cb6) * (+tl6) * (+1000)) / ((+2) * (+tb6) * (+tra6));
            var ta7 = ((+3) * (+cb7) * (+tl7) * (+1000)) / ((+2) * (+tb7) * (+tra7));
            var ta8 = ((+3) * (+cb8) * (+tl8) * (+1000)) / ((+2) * (+tb8) * (+tra8));
            var ta9 = ((+3) * (+cb9) * (+tl9) * (+1000)) / ((+2) * (+tb9) * (+tra9));
            var ta10 = ((+3) * (+cb10) * (+tl10) * (+1000)) / ((+2) * (+tb10) * (+tra10));

            $('#ta1').val(Math.sqrt(+ta1).toFixed(2));
            $('#ta2').val(Math.sqrt(+ta2).toFixed(2));
            $('#ta3').val(Math.sqrt(+ta3).toFixed(2));
            $('#ta4').val(Math.sqrt(+ta4).toFixed(2));
            $('#ta5').val(Math.sqrt(+ta5).toFixed(2));
            $('#ta6').val((+ta6).toFixed(2));
            $('#ta7').val((+ta7).toFixed(2));
            $('#ta8').val((+ta8).toFixed(2));
            $('#ta9').val((+ta9).toFixed(2));
            $('#ta10').val((+ta10).toFixed(2));
        }

        //TRANSVERSE STRENGTH
        $('#chk_tra').change(function() {
            if (this.checked) {
                tra_auto();
            } else {
                $('#txttra').css("background-color", "white");
                $('#tl1').val(null);
                $('#tl2').val(null);
                $('#tl3').val(null);
                $('#tl4').val(null);
                $('#tl5').val(null);
                $('#tl6').val(null);
                $('#tl7').val(null);
                $('#tl8').val(null);
                $('#tl9').val(null);
                $('#tl10').val(null);
                $('#tb1').val(null);
                $('#tb2').val(null);
                $('#tb3').val(null);
                $('#tb4').val(null);
                $('#tb5').val(null);
                $('#tb6').val(null);
                $('#tb7').val(null);
                $('#tb8').val(null);
                $('#tb9').val(null);
                $('#tb10').val(null);
                $('#ta1').val(null);
                $('#ta2').val(null);
                $('#ta3').val(null);
                $('#ta4').val(null);
                $('#ta5').val(null);
                $('#ta6').val(null);
                $('#ta7').val(null);
                $('#ta8').val(null);
                $('#ta9').val(null);
                $('#ta10').val(null);
                $('#cb1').val(null);
                $('#cb2').val(null);
                $('#cb3').val(null);
                $('#cb4').val(null);
                $('#cb5').val(null);
                $('#cb6').val(null);
                $('#cb7').val(null);
                $('#cb8').val(null);
                $('#cb9').val(null);
                $('#cb10').val(null);
                $('#tra1').val(null);
                $('#tra2').val(null);
                $('#tra3').val(null);
                $('#tra4').val(null);
                $('#tra5').val(null);
                $('#tra6').val(null);
                $('#tra7').val(null);
                $('#tra8').val(null);
                $('#tra9').val(null);
                $('#tra10').val(null);
                $('#avg_tra1').val(null);
                $('#avg_tra2').val(null);

            }
        });


        $('#avg_tra1').change(function() {
            var avg_tra1 = $('#avg_tra1').val();
            var tra_diff = randomNumberFromRange(1, 9).toFixed();
            if (tra_diff % 2 == 0) {
                var tra1 = (+avg_tra1) - 0.08;
                var tra2 = (+avg_tra1) + 0.16;
                var tra3 = (+avg_tra1) - 0.12;
                var tra4 = (+avg_tra1) + 0.38;
                var tra5 = (+avg_tra1) - 0.34;


            } else {
                var tra5 = (+avg_tra1) + 0.08;
                var tra4 = (+avg_tra1) - 0.16;
                var tra2 = (+avg_tra1) + 0.12;
                var tra1 = (+avg_tra1) - 0.38;
                var tra3 = (+avg_tra1) + 0.34;

            }

            $('#tra1').val((+tra1).toFixed(2));
            $('#tra2').val((+tra2).toFixed(2));
            $('#tra3').val((+tra3).toFixed(2));
            $('#tra4').val((+tra4).toFixed(2));
            $('#tra5').val((+tra5).toFixed(2));

            var tl1 = $('#tl1').val();
            var tl2 = $('#tl2').val();
            var tl3 = $('#tl3').val();
            var tl4 = $('#tl4').val();
            var tl5 = $('#tl5').val();

            var tb1 = $('#tb1').val();
            var tb2 = $('#tb2').val();
            var tb3 = $('#tb3').val();
            var tb4 = $('#tb4').val();
            var tb5 = $('#tb5').val();

            var ta1 = $('#ta1').val();
            var ta2 = $('#ta2').val();
            var ta3 = $('#ta3').val();
            var ta4 = $('#ta4').val();
            var ta5 = $('#ta5').val();

            var cb1 = $('#cb1').val();
            var cb2 = $('#cb2').val();
            var cb3 = $('#cb3').val();
            var cb4 = $('#cb4').val();
            var cb5 = $('#cb5').val();

            var tra1 = $('#tra1').val();
            var tra2 = $('#tra2').val();
            var tra3 = $('#tra3').val();
            var tra4 = $('#tra4').val();
            var tra5 = $('#tra5').val();

            var for1 = (+tra1) * (+2) * (+tb1) * (+ta1) * (+ta1);
            var for2 = (+tra2) * (+2) * (+tb2) * (+ta2) * (+ta2);
            var for3 = (+tra3) * (+2) * (+tb3) * (+ta3) * (+ta3);
            var for4 = (+tra4) * (+2) * (+tb4) * (+ta4) * (+ta4);
            var for5 = (+tra5) * (+2) * (+tb5) * (+ta5) * (+ta5);

            var down1 = (+3) * (+tl1) * (+1000);
            var down2 = (+3) * (+tl2) * (+1000);
            var down3 = (+3) * (+tl3) * (+1000);
            var down4 = (+3) * (+tl4) * (+1000);
            var down5 = (+3) * (+tl5) * (+1000);

            var loa1 = (+for1) / (+down1);
            var loa2 = (+for2) / (+down2);
            var loa3 = (+for3) / (+down3);
            var loa4 = (+for4) / (+down4);
            var loa5 = (+for5) / (+down5);

            $('#cb1').val((+loa1).toFixed(3));
            $('#cb2').val((+loa2).toFixed(3));
            $('#cb3').val((+loa3).toFixed(3));
            $('#cb4').val((+loa4).toFixed(3));
            $('#cb5').val((+loa5).toFixed(3));



        });

        $('#avg_tra2').change(function() {
            var avg_tra2 = $('#avg_tra2').val();


            var tra_diff = randomNumberFromRange(1, 9).toFixed();
            if (tra_diff % 2 == 0) {
                var tra6 = (+avg_tra2) + 0.07;
                var tra7 = (+avg_tra2) - 0.38;
                var tra8 = (+avg_tra2) + 0.32;
                var tra9 = (+avg_tra2) - 0.17;
                var tra10 = (+avg_tra2) + 0.16;
            } else {

                var tra8 = (+avg_tra2) - 0.07;
                var tra9 = (+avg_tra2) + 0.38;
                var tra10 = (+avg_tra2) - 0.32;
                var tra7 = (+avg_tra2) + 0.17;
                var tra6 = (+avg_tra2) - 0.16;
            }

            var tl6 = $('#tl6').val();
            var tl7 = $('#tl7').val();
            var tl8 = $('#tl8').val();
            var tl9 = $('#tl9').val();
            var tl10 = $('#tl10').val();

            var tb6 = $('#tb6').val();
            var tb7 = $('#tb7').val();
            var tb8 = $('#tb8').val();
            var tb9 = $('#tb9').val();
            var tb10 = $('#tb10').val();

            var ta6 = $('#ta6').val();
            var ta7 = $('#ta7').val();
            var ta8 = $('#ta8').val();
            var ta9 = $('#ta9').val();
            var ta10 = $('#ta10').val();

            var cb6 = $('#cb6').val();
            var cb7 = $('#cb7').val();
            var cb8 = $('#cb8').val();
            var cb9 = $('#cb9').val();
            var cb10 = $('#cb10').val();

            $('#tra6').val((+tra6).toFixed(2));
            $('#tra7').val((+tra7).toFixed(2));
            $('#tra8').val((+tra8).toFixed(2));
            $('#tra9').val((+tra9).toFixed(2));
            $('#tra10').val((+tra10).toFixed(2));

            var tra6 = $('#tra6').val();
            var tra7 = $('#tra7').val();
            var tra8 = $('#tra8').val();
            var tra9 = $('#tra9').val();
            var tra10 = $('#tra10').val();

            var for6 = (+tra6) * (+2) * (+tb6) * (+ta6) * (+ta6);
            var for7 = (+tra7) * (+2) * (+tb7) * (+ta7) * (+ta7);
            var for8 = (+tra8) * (+2) * (+tb8) * (+ta8) * (+ta8);
            var for9 = (+tra9) * (+2) * (+tb9) * (+ta9) * (+ta9);
            var for10 = (+tra10) * (+2) * (+tb10) * (+ta10) * (+ta10);

            var down6 = (+3) * (+tl6) * (+1000);
            var down7 = (+3) * (+tl7) * (+1000);
            var down8 = (+3) * (+tl8) * (+1000);
            var down9 = (+3) * (+tl9) * (+1000);
            var down10 = (+3) * (+tl10) * (+1000);

            var loa6 = (+for6) / (+down6);
            var loa7 = (+for7) / (+down7);
            var loa8 = (+for8) / (+down8);
            var loa9 = (+for9) / (+down9);
            var loa10 = (+for10) / (+down10);

            $('#cb6').val((+loa6).toFixed(3));
            $('#cb7').val((+loa7).toFixed(3));
            $('#cb8').val((+loa8).toFixed(3));
            $('#cb9').val((+loa9).toFixed(3));
            $('#cb10').val((+loa10).toFixed(3));




        });

        $('#tl1,#tl2,#tl3,#tl4,#tl5,#tl6,#tl7,#tl8,#tl9,#tl10,#tb1,#tb2,#tb3,#tb4,#tb5,#tb6,#tb7,#tb8,#tb9,#tb10,#ta1,#ta2,#ta3,#ta4,#ta5,#ta6,#ta7,#ta8,#ta9,#ta10,#cb1,#cb2,#cb3,#cb4,#cb5,#cb6,#cb7,#cb8,#cb9,#cb10').change(function() {

            var tl1 = $('#tl1').val();
            var tl2 = $('#tl2').val();
            var tl3 = $('#tl3').val();
            var tl4 = $('#tl4').val();
            var tl5 = $('#tl5').val();
            var tl6 = $('#tl6').val();
            var tl7 = $('#tl7').val();
            var tl8 = $('#tl8').val();
            var tl9 = $('#tl9').val();
            var tl10 = $('#tl10').val();

            var tb1 = $('#tb1').val();
            var tb2 = $('#tb2').val();
            var tb3 = $('#tb3').val();
            var tb4 = $('#tb4').val();
            var tb5 = $('#tb5').val();
            var tb6 = $('#tb6').val();
            var tb7 = $('#tb7').val();
            var tb8 = $('#tb8').val();
            var tb9 = $('#tb9').val();
            var tb10 = $('#tb10').val();

            var ta1 = $('#ta1').val();
            var ta2 = $('#ta2').val();
            var ta3 = $('#ta3').val();
            var ta4 = $('#ta4').val();
            var ta5 = $('#ta5').val();
            var ta6 = $('#ta6').val();
            var ta7 = $('#ta7').val();
            var ta8 = $('#ta8').val();
            var ta9 = $('#ta9').val();
            var ta10 = $('#ta10').val();

            var cb1 = $('#cb1').val();
            var cb2 = $('#cb2').val();
            var cb3 = $('#cb3').val();
            var cb4 = $('#cb4').val();
            var cb5 = $('#cb5').val();
            var cb6 = $('#cb6').val();
            var cb7 = $('#cb7').val();
            var cb8 = $('#cb8').val();
            var cb9 = $('#cb9').val();
            var cb10 = $('#cb10').val();

            var tra1 = ((3 * (+cb1) * (+tl1)) / (2 * (+tb1) * (+ta1) * (+ta1))) * 1000;
            var tra2 = ((3 * (+cb2) * (+tl2)) / (2 * (+tb2) * (+ta2) * (+ta2))) * 1000;
            var tra3 = ((3 * (+cb3) * (+tl3)) / (2 * (+tb3) * (+ta3) * (+ta3))) * 1000;
            var tra4 = ((3 * (+cb4) * (+tl4)) / (2 * (+tb4) * (+ta4) * (+ta4))) * 1000;
            var tra5 = ((3 * (+cb5) * (+tl5)) / (2 * (+tb5) * (+ta5) * (+ta5))) * 1000;
            var tra6 = ((3 * (+cb6) * (+tl6)) / (2 * (+tb6) * (+ta6) * (+ta6))) * 1000;
            var tra7 = ((3 * (+cb7) * (+tl7)) / (2 * (+tb7) * (+ta7) * (+ta7))) * 1000;
            var tra8 = ((3 * (+cb8) * (+tl8)) / (2 * (+tb8) * (+ta8) * (+ta8))) * 1000;
            var tra9 = ((3 * (+cb9) * (+tl9)) / (2 * (+tb9) * (+ta9) * (+ta9))) * 1000;
            var tra10 = ((3 * (+cb10) * (+tl10)) / (2 * (+tb10) * (+ta10) * (+ta10))) * 1000;

            $('#tra1').val((+tra1).toFixed(2));
            $('#tra2').val((+tra2).toFixed(2));
            $('#tra3').val((+tra3).toFixed(2));
            $('#tra4').val((+tra4).toFixed(2));
            $('#tra5').val((+tra5).toFixed(2));
            $('#tra6').val((+tra6).toFixed(2));
            $('#tra7').val((+tra7).toFixed(2));
            $('#tra8').val((+tra8).toFixed(2));
            $('#tra9').val((+tra9).toFixed(2));
            $('#tra10').val((+tra10).toFixed(2));

            var tra1 = $('#tra1').val();
            var tra2 = $('#tra2').val();
            var tra3 = $('#tra3').val();
            var tra4 = $('#tra4').val();
            var tra5 = $('#tra5').val();
            var tra6 = $('#tra6').val();
            var tra7 = $('#tra7').val();
            var tra8 = $('#tra8').val();
            var tra9 = $('#tra9').val();
            var tra10 = $('#tra10').val();

            var avg_tra1 = ((+tra1) + (+tra2) + (+tra3) + (+tra4) + (+tra5)) / 5;
            var avg_tra2 = ((+tra6) + (+tra7) + (+tra8) + (+tra9) + (+tra10)) / 5;


            $('#avg_tra1').val((+avg_tra1).toFixed(2));
            $('#avg_tra2').val((+avg_tra2).toFixed(2));

        });


        function ten_auto() {
            $('#txtten').css("background-color", "var(--success)");
            var com_dry = $('#avg_com1').val();
            var com_wet = $('#avg_com4').val();
            var ten_per = randomNumberFromRange(8.00, 10.00).toFixed(2)

            var avg_ten1 = ((+com_dry) * (+ten_per)) / 100;
            var avg_ten2 = ((+com_wet) * (+ten_per)) / 100;

            $('#avg_ten1').val((+avg_ten1).toFixed(2));
            $('#avg_ten2').val((+avg_ten2).toFixed(2));
            var avg_ten1 = $('#avg_ten1').val();
            var avg_ten2 = $('#avg_ten2').val();

            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var ten1 = (+avg_ten1) + 1.20;
                var ten2 = (+avg_ten1) + 0.41;
                var ten3 = (+avg_ten1) + 0.89;
                var ten4 = (+avg_ten1) - 1.30;
                var ten5 = (+avg_ten1) - 1.20;

                var ten6 = (+avg_ten2) - 0.54;
                var ten7 = (+avg_ten2) - 0.81;
                var ten8 = (+avg_ten2) + 0.94;
                var ten9 = (+avg_ten2) - 0.13;
                var ten10 = (+avg_ten2) + 0.54;
            } else {
                var ten1 = (+avg_ten1) - 1.01;
                var ten2 = (+avg_ten1) + 1.01;
                var ten3 = (+avg_ten1) + 2.29;
                var ten4 = (+avg_ten1) - 0.74;
                var ten5 = (+avg_ten1) - 1.55;

                var ten6 = (+avg_ten2) + 1.08;
                var ten7 = (+avg_ten2) - 0.61;
                var ten8 = (+avg_ten2) + 0.79;
                var ten9 = (+avg_ten2) - 0.79;
                var ten10 = (+avg_ten2) - 0.47;
            }

            $('#ten1').val((+ten1).toFixed(2));
            $('#ten2').val((+ten2).toFixed(2));
            $('#ten3').val((+ten3).toFixed(2));
            $('#ten4').val((+ten4).toFixed(2));
            $('#ten5').val((+ten5).toFixed(2));
            $('#ten6').val((+ten6).toFixed(2));
            $('#ten7').val((+ten7).toFixed(2));
            $('#ten8').val((+ten8).toFixed(2));
            $('#ten9').val((+ten9).toFixed(2));
            $('#ten10').val((+ten10).toFixed(2));

            var sl1 = randomNumberFromRange(99.00, 102.00);
            var sl2 = randomNumberFromRange(99.00, 102.00);
            var sl3 = randomNumberFromRange(99.00, 102.00);
            var sl4 = randomNumberFromRange(99.00, 102.00);
            var sl5 = randomNumberFromRange(99.00, 102.00);
            var sl6 = randomNumberFromRange(99.00, 102.00);
            var sl7 = randomNumberFromRange(99.00, 102.00);
            var sl8 = randomNumberFromRange(99.00, 102.00);
            var sl9 = randomNumberFromRange(99.00, 102.00);
            var sl10 = randomNumberFromRange(99.00, 102.00);

            $('#sl1').val((+sl1).toFixed(2));
            $('#sl2').val((+sl2).toFixed(2));
            $('#sl3').val((+sl3).toFixed(2));
            $('#sl4').val((+sl4).toFixed(2));
            $('#sl5').val((+sl5).toFixed(2));
            $('#sl6').val((+sl6).toFixed(2));
            $('#sl7').val((+sl7).toFixed(2));
            $('#sl8').val((+sl8).toFixed(2));
            $('#sl9').val((+sl9).toFixed(2));
            $('#sl10').val((+sl10).toFixed(2));

            var ten_dia1 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia2 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia3 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia4 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia5 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia6 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia7 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia8 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia9 = randomNumberFromRange(0.00, 1.50).toFixed(2);
            var ten_dia10 = randomNumberFromRange(0.00, 1.50).toFixed(2);

            var sd1 = (+ten_dia1) + 50.00;
            var sd2 = (+ten_dia2) + 50.00;
            var sd3 = (+ten_dia3) + 50.00;
            var sd4 = (+ten_dia4) + 50.00;
            var sd5 = (+ten_dia5) + 50.00;
            var sd6 = (+ten_dia6) + 50.00;
            var sd7 = (+ten_dia7) + 50.00;
            var sd8 = (+ten_dia8) + 50.00;
            var sd9 = (+ten_dia9) + 50.00;
            var sd10 = (+ten_dia10) + 50.00;

            $('#sd1').val((+sd1).toFixed(2));
            $('#sd2').val((+sd2).toFixed(2));
            $('#sd3').val((+sd3).toFixed(2));
            $('#sd4').val((+sd4).toFixed(2));
            $('#sd5').val((+sd5).toFixed(2));
            $('#sd6').val((+sd6).toFixed(2));
            $('#sd7').val((+sd7).toFixed(2));
            $('#sd8').val((+sd8).toFixed(2));
            $('#sd9').val((+sd9).toFixed(2));
            $('#sd10').val((+sd10).toFixed(2));

            var ten1 = $('#ten1').val();
            var ten2 = $('#ten2').val();
            var ten3 = $('#ten3').val();
            var ten4 = $('#ten4').val();
            var ten5 = $('#ten5').val();
            var ten6 = $('#ten6').val();
            var ten7 = $('#ten7').val();
            var ten8 = $('#ten8').val();
            var ten9 = $('#ten9').val();
            var ten10 = $('#ten10').val();

            var sd1 = $('#sd1').val();
            var sd2 = $('#sd2').val();
            var sd3 = $('#sd3').val();
            var sd4 = $('#sd4').val();
            var sd5 = $('#sd5').val();
            var sd6 = $('#sd6').val();
            var sd7 = $('#sd7').val();
            var sd8 = $('#sd8').val();
            var sd9 = $('#sd9').val();
            var sd10 = $('#sd10').val();

            var sl1 = $('#sl1').val();
            var sl2 = $('#sl2').val();
            var sl3 = $('#sl3').val();
            var sl4 = $('#sl4').val();
            var sl5 = $('#sl5').val();
            var sl6 = $('#sl6').val();
            var sl7 = $('#sl7').val();
            var sl8 = $('#sl8').val();
            var sl9 = $('#sl9').val();
            var sl10 = $('#sl10').val();


            var sload1 = ((+ten1) * (+0.7853981634) * (+sd1) * (+sl1)) / (+2000);
            var sload2 = ((+ten2) * (+0.7853981634) * (+sd2) * (+sl2)) / (+2000);
            var sload3 = ((+ten3) * (+0.7853981634) * (+sd3) * (+sl3)) / (+2000);
            var sload4 = ((+ten4) * (+0.7853981634) * (+sd4) * (+sl4)) / (+2000);
            var sload5 = ((+ten5) * (+0.7853981634) * (+sd5) * (+sl5)) / (+2000);
            var sload6 = ((+ten6) * (+0.7853981634) * (+sd6) * (+sl6)) / (+2000);
            var sload7 = ((+ten7) * (+0.7853981634) * (+sd7) * (+sl7)) / (+2000);
            var sload8 = ((+ten8) * (+0.7853981634) * (+sd8) * (+sl8)) / (+2000);
            var sload9 = ((+ten9) * (+0.7853981634) * (+sd9) * (+sl9)) / (+2000);
            var sload10 = ((+ten10) * (+0.7853981634) * (+sd10) * (+sd10)) / (+2000);

            $('#sload1').val((+sload1).toFixed(2));
            $('#sload2').val((+sload2).toFixed(2));
            $('#sload3').val((+sload3).toFixed(2));
            $('#sload4').val((+sload4).toFixed(2));
            $('#sload5').val((+sload5).toFixed(2));
            $('#sload6').val((+sload6).toFixed(2));
            $('#sload7').val((+sload7).toFixed(2));
            $('#sload8').val((+sload8).toFixed(2));
            $('#sload9').val((+sload9).toFixed(2));
            $('#sload10').val((+sload10).toFixed(2));
            /*var ten_load = randomNumberFromRange(5.00, 13.00);
            var ten_diff = randomNumberFromRange(1,9).toFixed();
            if(ten_diff % 2 == 0){
            	var sload1 = (+ten_load) + 0.52;
            	var sload2 = (+ten_load) + 0.67;
            	var sload3 = (+ten_load) + 1.01;
            	var sload4 = (+ten_load) + 0.63;
            	var sload5 = (+ten_load) + 1.03;
            	var sload6 = (+ten_load) + 1.49;
            	var sload7 = (+ten_load) + 1.35;
            	var sload8 = (+ten_load) + 1.21;
            	var sload9 = (+ten_load) + 0.97;
            	var sload10 = (+ten_load) + 1.38;
            }else{
            	var sload1 = (+ten_load) + 1.01;
            	var sload2 = (+ten_load) + 0.34;
            	var sload3 = (+ten_load) + 0.52;
            	var sload4 = (+ten_load) + 1.09;
            	var sload5 = (+ten_load) + 0.91;
            	var sload6 = (+ten_load) + 1.49;
            	var sload7 = (+ten_load) + 0.99;
            	var sload8 = (+ten_load) + 1.48;
            	var sload9 = (+ten_load) + 1.21;
            	var sload10 = (+ten_load) + 1.36;
            }

            $('#sload1').val((+sload1).toFixed(2));
            $('#sload2').val((+sload2).toFixed(2));
            $('#sload3').val((+sload3).toFixed(2));
            $('#sload4').val((+sload4).toFixed(2));
            $('#sload5').val((+sload5).toFixed(2));
            $('#sload6').val((+sload6).toFixed(2));
            $('#sload7').val((+sload7).toFixed(2));
            $('#sload8').val((+sload8).toFixed(2));
            $('#sload9').val((+sload9).toFixed(2));
            $('#sload10').val((+sload10).toFixed(2));











            var sd1 = $('#sd1').val();
            var sd2 = $('#sd2').val();
            var sd3 = $('#sd3').val();
            var sd4 = $('#sd4').val();
            var sd5 = $('#sd5').val();
            var sd6 = $('#sd6').val();
            var sd7 = $('#sd7').val();
            var sd8 = $('#sd8').val();
            var sd9 = $('#sd9').val();
            var sd10 = $('#sd10').val();

            var sl1 = $('#sl1').val();
            var sl2 = $('#sl2').val();
            var sl3 = $('#sl3').val();
            var sl4 = $('#sl4').val();
            var sl5 = $('#sl5').val();
            var sl6 = $('#sl6').val();
            var sl7 = $('#sl7').val();
            var sl8 = $('#sl8').val();
            var sl9 = $('#sl9').val();
            var sl10 = $('#sl10').val();

            var sload1 = $('#sload1').val();
            var sload2 = $('#sload2').val();
            var sload3 = $('#sload3').val();
            var sload4 = $('#sload4').val();
            var sload5 = $('#sload5').val();
            var sload6 = $('#sload6').val();
            var sload7 = $('#sload7').val();
            var sload8 = $('#sload8').val();
            var sload9 = $('#sload9').val();
            var sload10 = $('#sload10').val();

            var ten1 = (2 * (+sload1) / (0.7853981634 * (+sl1) * (+sd1)))*1000;
            var ten2 = (2 * (+sload2) / (0.7853981634 * (+sl2) * (+sd2)))*1000;
            var ten3 = (2 * (+sload3) / (0.7853981634 * (+sl3) * (+sd3)))*1000;
            var ten4 = (2 * (+sload4) / (0.7853981634 * (+sl4) * (+sd4)))*1000;
            var ten5 = (2 * (+sload5) / (0.7853981634 * (+sl5) * (+sd5)))*1000;
            var ten6 = (2 * (+sload6) / (0.7853981634 * (+sl6) * (+sd6)))*1000;
            var ten7 = (2 * (+sload7) / (0.7853981634 * (+sl7) * (+sd7)))*1000;
            var ten8 = (2 * (+sload8) / (0.7853981634 * (+sl8) * (+sd8)))*1000;
            var ten9 = (2 * (+sload9) / (0.7853981634 * (+sl9) * (+sd9)))*1000;
            var ten10 = (2 * (+sload10) / (0.7853981634 * (+sl10) * (+sd10)))*1000;

            $('#ten1').val((+ten1).toFixed(2));
            $('#ten2').val((+ten2).toFixed(2));
            $('#ten3').val((+ten3).toFixed(2));
            $('#ten4').val((+ten4).toFixed(2));
            $('#ten5').val((+ten5).toFixed(2));
            $('#ten6').val((+ten6).toFixed(2));
            $('#ten7').val((+ten7).toFixed(2));
            $('#ten8').val((+ten8).toFixed(2));
            $('#ten9').val((+ten9).toFixed(2));
            $('#ten10').val((+ten10).toFixed(2));

            var ten1 = $('#ten1').val();
            var ten2 = $('#ten2').val();
            var ten3 = $('#ten3').val();
            var ten4 = $('#ten4').val();
            var ten5 = $('#ten5').val();
            var ten6 = $('#ten6').val();
            var ten7 = $('#ten7').val();
            var ten8 = $('#ten8').val();
            var ten9 = $('#ten9').val();
            var ten10 = $('#ten10').val();

            var avg_ten1 = ((+ten1) + (+ten2) + (+ten3) + (+ten4) + (+ten5))/5;
            var avg_ten2 = ((+ten6) + (+ten7) + (+ten8) + (+ten9) + (+ten10))/5;

            $('#avg_ten1').val((+avg_ten1).toFixed(2));
            $('#avg_ten2').val((+avg_ten2).toFixed(2));*/
        }

        $('#chk_ten').change(function() {
            if (this.checked) {
                ten_auto();

            } else {
                $('#txtten').css("background-color", "white");

                $('#sd1').val(null);
                $('#sd2').val(null);
                $('#sd3').val(null);
                $('#sd4').val(null);
                $('#sd5').val(null);
                $('#sd6').val(null);
                $('#sd7').val(null);
                $('#sd8').val(null);
                $('#sd9').val(null);
                $('#sd10').val(null);
                $('#sl1').val(null);
                $('#sl2').val(null);
                $('#sl3').val(null);
                $('#sl4').val(null);
                $('#sl5').val(null);
                $('#sl6').val(null);
                $('#sl7').val(null);
                $('#sl8').val(null);
                $('#sl9').val(null);
                $('#sl10').val(null);
                $('#sload1').val(null);
                $('#sload2').val(null);
                $('#sload3').val(null);
                $('#sload4').val(null);
                $('#sload5').val(null);
                $('#sload6').val(null);
                $('#sload7').val(null);
                $('#sload8').val(null);
                $('#sload9').val(null);
                $('#sload10').val(null);
                $('#ten1').val(null);
                $('#ten2').val(null);
                $('#ten3').val(null);
                $('#ten4').val(null);
                $('#ten5').val(null);
                $('#ten6').val(null);
                $('#ten7').val(null);
                $('#ten8').val(null);
                $('#ten9').val(null);
                $('#ten10').val(null);
                $('#avg_ten1').val(null);
                $('#avg_ten2').val(null);
            }
        });

        $('#sl1,#sl2,#sl3,#sl4,#sl5,#sl6,#sl7,#sl8,#sl9,#sl10,#sd1,#sd2,#sd3,#sd4,#sd5,#sd6,#sd7,#sd8,#sd9,#sd10,#sload1,#sload2,#sload3,#sload4,#sload5,#sload6,#sload7,#sload8,#sload9,#sload10').change(function() {

            var sd1 = $('#sd1').val();
            var sd2 = $('#sd2').val();
            var sd3 = $('#sd3').val();
            var sd4 = $('#sd4').val();
            var sd5 = $('#sd5').val();
            var sd6 = $('#sd6').val();
            var sd7 = $('#sd7').val();
            var sd8 = $('#sd8').val();
            var sd9 = $('#sd9').val();
            var sd10 = $('#sd10').val();

            var sl1 = $('#sl1').val();
            var sl2 = $('#sl2').val();
            var sl3 = $('#sl3').val();
            var sl4 = $('#sl4').val();
            var sl5 = $('#sl5').val();
            var sl6 = $('#sl6').val();
            var sl7 = $('#sl7').val();
            var sl8 = $('#sl8').val();
            var sl9 = $('#sl9').val();
            var sl10 = $('#sl10').val();

            var sload1 = $('#sload1').val();
            var sload2 = $('#sload2').val();
            var sload3 = $('#sload3').val();
            var sload4 = $('#sload4').val();
            var sload5 = $('#sload5').val();
            var sload6 = $('#sload6').val();
            var sload7 = $('#sload7').val();
            var sload8 = $('#sload8').val();
            var sload9 = $('#sload9').val();
            var sload10 = $('#sload10').val();

            var ten1 = (2 * (+sload1) / (0.7853981634 * (+sl1) * (+sd1))) * 1000;
            var ten2 = (2 * (+sload2) / (0.7853981634 * (+sl2) * (+sd2))) * 1000;
            var ten3 = (2 * (+sload3) / (0.7853981634 * (+sl3) * (+sd3))) * 1000;
            var ten4 = (2 * (+sload4) / (0.7853981634 * (+sl4) * (+sd4))) * 1000;
            var ten5 = (2 * (+sload5) / (0.7853981634 * (+sl5) * (+sd5))) * 1000;
            var ten6 = (2 * (+sload6) / (0.7853981634 * (+sl6) * (+sd6))) * 1000;
            var ten7 = (2 * (+sload7) / (0.7853981634 * (+sl7) * (+sd7))) * 1000;
            var ten8 = (2 * (+sload8) / (0.7853981634 * (+sl8) * (+sd8))) * 1000;
            var ten9 = (2 * (+sload9) / (0.7853981634 * (+sl9) * (+sd9))) * 1000;
            var ten10 = (2 * (+sload10) / (0.7853981634 * (+sl10) * (+sd10))) * 1000;

            $('#ten1').val((+ten1).toFixed(2));
            $('#ten2').val((+ten2).toFixed(2));
            $('#ten3').val((+ten3).toFixed(2));
            $('#ten4').val((+ten4).toFixed(2));
            $('#ten5').val((+ten5).toFixed(2));
            $('#ten6').val((+ten6).toFixed(2));
            $('#ten7').val((+ten7).toFixed(2));
            $('#ten8').val((+ten8).toFixed(2));
            $('#ten9').val((+ten9).toFixed(2));
            $('#ten10').val((+ten10).toFixed(2));

            var ten1 = $('#ten1').val();
            var ten2 = $('#ten2').val();
            var ten3 = $('#ten3').val();
            var ten4 = $('#ten4').val();
            var ten5 = $('#ten5').val();
            var ten6 = $('#ten6').val();
            var ten7 = $('#ten7').val();
            var ten8 = $('#ten8').val();
            var ten9 = $('#ten9').val();
            var ten10 = $('#ten10').val();

            var avg_ten1 = ((+ten1) + (+ten2) + (+ten3) + (+ten4) + (+ten5)) / 5;
            var avg_ten2 = ((+ten6) + (+ten7) + (+ten8) + (+ten9) + (+ten10)) / 5;

            $('#avg_ten1').val((+avg_ten1).toFixed(2));
            $('#avg_ten2').val((+avg_ten2).toFixed(2));
        });



        $('#avg_ten1').change(function() {
            var avg_ten1 = $('#avg_ten1').val();


            var tra_diff = randomNumberFromRange(1, 9).toFixed();
            if (tra_diff % 2 == 0) {
                var tra1 = (+avg_ten1) - 0.08;
                var tra2 = (+avg_ten1) + 0.16;
                var tra3 = (+avg_ten1) - 0.12;
                var tra4 = (+avg_ten1) + 0.38;
                var tra5 = (+avg_ten1) - 0.34;


            } else {
                var tra5 = (+avg_ten1) + 0.08;
                var tra4 = (+avg_ten1) - 0.16;
                var tra2 = (+avg_ten1) + 0.12;
                var tra1 = (+avg_ten1) - 0.38;
                var tra3 = (+avg_ten1) + 0.34;

            }



            $('#ten1').val((+tra1).toFixed(2));
            $('#ten2').val((+tra2).toFixed(2));
            $('#ten3').val((+tra3).toFixed(2));
            $('#ten4').val((+tra4).toFixed(2));
            $('#ten5').val((+tra5).toFixed(2));

            var ten1 = $('#ten1').val();
            var ten2 = $('#ten2').val();
            var ten3 = $('#ten3').val();
            var ten4 = $('#ten4').val();
            var ten5 = $('#ten5').val();

            var sd1 = $('#sd1').val();
            var sd2 = $('#sd2').val();
            var sd3 = $('#sd3').val();
            var sd4 = $('#sd4').val();
            var sd5 = $('#sd5').val();

            var sl1 = $('#sl1').val();
            var sl2 = $('#sl2').val();
            var sl3 = $('#sl3').val();
            var sl4 = $('#sl4').val();
            var sl5 = $('#sl5').val();

            var up1 = (+ten1) * (+0.7853981634) * (+sl1) * (+sd1);
            var up2 = (+ten2) * (+0.7853981634) * (+sl2) * (+sd2);
            var up3 = (+ten3) * (+0.7853981634) * (+sl3) * (+sd3);
            var up4 = (+ten4) * (+0.7853981634) * (+sl4) * (+sd4);
            var up5 = (+ten5) * (+0.7853981634) * (+sl5) * (+sd5);

            var fina1 = (+up1) / (+200000);
            var fina2 = (+up2) / (+200000);
            var fina3 = (+up3) / (+200000);
            var fina4 = (+up4) / (+200000);
            var fina5 = (+up5) / (+200000);

            $('#load1').val((+fina1).toFixed(2));
            $('#load2').val((+fina2).toFixed(2));
            $('#load3').val((+fina3).toFixed(2));
            $('#load4').val((+fina4).toFixed(2));
            $('#load5').val((+fina5).toFixed(2));


        });

        $('#avg_ten2').change(function() {
            var avg_ten2 = $('#avg_ten2').val();


            var tra_diff = randomNumberFromRange(1, 9).toFixed();
            if (tra_diff % 2 == 0) {
                var tra6 = (+avg_ten2) + 0.07;
                var tra7 = (+avg_ten2) - 0.38;
                var tra8 = (+avg_ten2) + 0.32;
                var tra9 = (+avg_ten2) - 0.17;
                var tra10 = (+avg_ten2) + 0.16;
            } else {

                var tra8 = (+avg_ten2) - 0.07;
                var tra9 = (+avg_ten2) + 0.38;
                var tra10 = (+avg_ten2) - 0.32;
                var tra7 = (+avg_ten2) + 0.17;
                var tra6 = (+avg_ten2) - 0.16;
            }


            $('#ten6').val((+tra6).toFixed(2));
            $('#ten7').val((+tra7).toFixed(2));
            $('#ten8').val((+tra8).toFixed(2));
            $('#ten9').val((+tra9).toFixed(2));
            $('#ten10').val((+tra10).toFixed(2));

            var ten6 = $('#ten').val();
            var ten7 = $('#ten').val();
            var ten8 = $('#ten').val();
            var ten9 = $('#ten').val();
            var ten10 = $('#ten10').val();


            var sd6 = $('#sd6').val();
            var sd7 = $('#sd7').val();
            var sd8 = $('#sd8').val();
            var sd9 = $('#sd9').val();
            var sd10 = $('#sd10').val();

            var sl6 = $('#sl6').val();
            var sl7 = $('#sl7').val();
            var sl8 = $('#sl8').val();
            var sl9 = $('#sl9').val();
            var sl10 = $('#sl10').val();

            var up6 = (+ten6) * (+0.7853981634) * (+sl6) * (+sd6);
            var up7 = (+ten7) * (+0.7853981634) * (+sl7) * (+sd7);
            var up8 = (+ten8) * (+0.7853981634) * (+sl8) * (+sd8);
            var up9 = (+ten9) * (+0.7853981634) * (+sl9) * (+sd9);
            var up1 = (+ten10) * (+0.7853981634) * (+sl10) * (+sd10);

            var fina6 = (+up6) / (+200000);
            var fina7 = (+up7) / (+200000);
            var fina8 = (+up8) / (+200000);
            var fina9 = (+up9) / (+200000);
            var fina10 = (+up10) / (+200000);

            $('#load6').val((+fina6).toFixed(2));
            $('#load7').val((+fina7).toFixed(2));
            $('#load8').val((+fina8).toFixed(2));
            $('#load9').val((+fina9).toFixed(2));
            $('#load10').val((+fina10).toFixed(2));


        });

        function moi_auto() {
            $('#txtmoc').css("background-color", "var(--success)");

            var moc1_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            var moc2_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            var moc3_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            $('#moc1_1').val((+moc1_1).toFixed(1));
            $('#moc2_1').val((+moc2_1).toFixed(1));
            $('#moc3_1').val((+moc3_1).toFixed(1));

            var moc1_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            var moc2_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            var moc3_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            $('#moc1_3').val((+moc1_3).toFixed(1));
            $('#moc2_3').val((+moc2_3).toFixed(1));
            $('#moc3_3').val((+moc3_3).toFixed(1));

            var avg_moc = randomNumberFromRange(0.10, 0.30).toFixed(2);
            $('#avg_moc').val((+avg_moc).toFixed(2));
            var avg_moc = $('#avg_moc').val();
            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var moc1_4 = (+avg_moc) + 0.01;
                var moc2_4 = (+avg_moc) - 0.03;
                var moc3_4 = (+avg_moc) + 0.02;
            } else {
                var moc1_4 = (+avg_moc) - 0.03;
                var moc2_4 = (+avg_moc) - 0.01;
                var moc3_4 = (+avg_moc) + 0.04;
            }
            $('#moc1_4').val((+moc1_4).toFixed(2));
            $('#moc2_4').val((+moc2_4).toFixed(2));
            $('#moc3_4').val((+moc3_4).toFixed(2));


            var moc1_1 = $('#moc1_1').val();
            var moc2_1 = $('#moc2_1').val();
            var moc3_1 = $('#moc3_1').val();

            var moc1_3 = $('#moc1_3').val();
            var moc2_3 = $('#moc2_3').val();
            var moc3_3 = $('#moc3_3').val();

            var moc1_4 = $('#moc1_4').val();
            var moc2_4 = $('#moc2_4').val();
            var moc3_4 = $('#moc3_4').val();

            var moc1_2 = (((+moc1_4) / 100) * ((+moc1_3) - (+moc1_1))) + (+moc1_3);
            var moc2_2 = (((+moc2_4) / 100) * ((+moc2_3) - (+moc2_1))) + (+moc2_3);
            var moc3_2 = (((+moc3_4) / 100) * ((+moc3_3) - (+moc3_1))) + (+moc3_3);
            $('#moc1_2').val((+moc1_2).toFixed(1));
            $('#moc2_2').val((+moc2_2).toFixed(1));
            $('#moc3_2').val((+moc3_2).toFixed(1));
        }
        $('#chk_moi').change(function() {
            if (this.checked) {
                moi_auto();
            } else {
                $('#txtmoc').css("background-color", "#FFFFFF");
                $('#moc1_1').val(null);
                $('#moc1_2').val(null);
                $('#moc1_3').val(null);
                $('#moc1_4').val(null);
                $('#moc2_1').val(null);
                $('#moc2_2').val(null);
                $('#moc2_3').val(null);
                $('#moc2_4').val(null);
                $('#moc3_1').val(null);
                $('#moc3_2').val(null);
                $('#moc3_3').val(null);
                $('#moc3_4').val(null);
                $('#avg_moc').val(null);
            }
        });

        $('#moc1_1,#moc2_1,#moc3_1,#moc1_2,#moc2_2,#moc3_2,#moc1_3,#moc2_3,#moc3_3').change(function() {
            $('#txtmoc').css("background-color", "var(--success)");
            var moc1_1 = $('#moc1_1').val();
            var moc1_2 = $('#moc1_2').val();
            var moc1_3 = $('#moc1_3').val();

            var moc2_1 = $('#moc2_1').val();
            var moc2_2 = $('#moc2_2').val();
            var moc2_3 = $('#moc2_3').val();

            var moc3_1 = $('#moc3_1').val();
            var moc3_2 = $('#moc3_2').val();
            var moc3_3 = $('#moc3_3').val();

            var moc1_4 = (((+moc1_2) - (+moc1_3)) / ((+moc1_3) - (+moc1_1))) * 100;
            var moc2_4 = (((+moc2_2) - (+moc2_3)) / ((+moc2_3) - (+moc2_1))) * 100;
            var moc3_4 = (((+moc3_2) - (+moc3_3)) / ((+moc3_3) - (+moc3_1))) * 100;

            $('#moc1_4').val((+moc1_4).toFixed(2));
            $('#moc2_4').val((+moc2_4).toFixed(2));
            $('#moc3_4').val((+moc3_4).toFixed(2));

            var moc1_4 = $('#moc1_4').val();
            var moc2_4 = $('#moc2_4').val();
            var moc3_4 = $('#moc3_4').val();

            var avg_moc = ((+moc1_4) + (+moc2_4) + (+moc3_4)) / 3;
            $('#avg_moc').val((+avg_moc).toFixed(2));
        });

        $('#avg_moc').change(function() {
            $('#txtmoc').css("background-color", "var(--success)");

            var moc1_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            var moc2_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            var moc3_1 = randomNumberFromRange(45.0, 60.0).toFixed(1);
            $('#moc1_1').val((+moc1_1).toFixed(1));
            $('#moc2_1').val((+moc2_1).toFixed(1));
            $('#moc3_1').val((+moc3_1).toFixed(1));

            var moc1_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            var moc2_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            var moc3_3 = randomNumberFromRange(520.0, 700.0).toFixed(1);
            $('#moc1_3').val((+moc1_3).toFixed(1));
            $('#moc2_3').val((+moc2_3).toFixed(1));
            $('#moc3_3').val((+moc3_3).toFixed(1));

            var avg_moc = $('#avg_moc').val();
            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var moc1_4 = (+avg_moc) + 0.01;
                var moc2_4 = (+avg_moc) - 0.03;
                var moc3_4 = (+avg_moc) + 0.02;
            } else {
                var moc1_4 = (+avg_moc) - 0.03;
                var moc2_4 = (+avg_moc) - 0.01;
                var moc3_4 = (+avg_moc) + 0.04;
            }
            $('#moc1_4').val((+moc1_4).toFixed(2));
            $('#moc2_4').val((+moc2_4).toFixed(2));
            $('#moc3_4').val((+moc3_4).toFixed(2));


            var moc1_1 = $('#moc1_1').val();
            var moc2_1 = $('#moc2_1').val();
            var moc3_1 = $('#moc3_1').val();

            var moc1_3 = $('#moc1_3').val();
            var moc2_3 = $('#moc2_3').val();
            var moc3_3 = $('#moc3_3').val();

            var moc1_4 = $('#moc1_4').val();
            var moc2_4 = $('#moc2_4').val();
            var moc3_4 = $('#moc3_4').val();

            var moc1_2 = (((+moc1_4) / 100) * ((+moc1_3) - (+moc1_1))) + (+moc1_3);
            var moc2_2 = (((+moc2_4) / 100) * ((+moc2_3) - (+moc2_1))) + (+moc2_3);
            var moc3_2 = (((+moc3_4) / 100) * ((+moc3_3) - (+moc3_1))) + (+moc3_3);
            $('#moc1_2').val((+moc1_2).toFixed(1));
            $('#moc2_2').val((+moc2_2).toFixed(1));
            $('#moc3_2').val((+moc3_2).toFixed(1));
        });

        function dim_auto() {
            $('#txtdim').css("background-color", "var(--success)");

            var dim_length_avg = randomNumberFromRange(298.0, 302.0).toFixed(1);
            var dim_width_avg = randomNumberFromRange(298.0, 302.0).toFixed(1);
            var dim_height_avg = randomNumberFromRange(18.1, 21.9).toFixed(1);
            $('#dim_length_avg').val((+dim_length_avg).toFixed(1));
            $('#dim_width_avg').val((+dim_width_avg).toFixed(1));
            $('#dim_height_avg').val((+dim_height_avg).toFixed(1));

            var dim_length_avg = $('#dim_length_avg').val();
            var dim_width_avg = $('#dim_width_avg').val();
            var dim_height_avg = $('#dim_height_avg').val();


            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var dim_length1 = (+dim_length_avg) + 1.2;
                var dim_length2 = (+dim_length_avg) + 0.2;
                var dim_length3 = (+dim_length_avg) - 1.4;

                var dim_width1 = (+dim_width_avg) + 1.2;
                var dim_width2 = (+dim_width_avg) + 0.2;
                var dim_width3 = (+dim_width_avg) - 1.4;

                var dim_height1 = (+dim_height_avg) + 0.2;
                var dim_height2 = (+dim_height_avg) + 0.5;
                var dim_height3 = (+dim_height_avg) - 0.7;
            } else {
                var dim_length1 = (+dim_length_avg) + 0.7;
                var dim_length2 = (+dim_length_avg) - 1.1;
                var dim_length3 = (+dim_length_avg) + 0.4;

                var dim_width1 = (+dim_width_avg) + 0.7;
                var dim_width2 = (+dim_width_avg) - 1.1;
                var dim_width3 = (+dim_width_avg) + 0.4;

                var dim_height1 = (+dim_height_avg) + 0.3;
                var dim_height2 = (+dim_height_avg) - 0.9;
                var dim_height3 = (+dim_height_avg) + 0.6;
            }

            $('#dim_length1').val((+dim_length1).toFixed(1));
            $('#dim_length2').val((+dim_length2).toFixed(1));
            $('#dim_length3').val((+dim_length3).toFixed(1));

            $('#dim_width1').val((+dim_width1).toFixed(1));
            $('#dim_width2').val((+dim_width2).toFixed(1));
            $('#dim_width3').val((+dim_width3).toFixed(1));

            $('#dim_height1').val((+dim_height1).toFixed(1));
            $('#dim_height2').val((+dim_height2).toFixed(1));
            $('#dim_height3').val((+dim_height3).toFixed(1));
        }
        $('#chk_dim').change(function() {
            if (this.checked) {
                dim_auto();
            } else {
                $('#txtmoc').css("background-color", "#FFFFFF");
                $('#dim_length1').val(null);
                $('#dim_length2').val(null);
                $('#dim_length3').val(null);
                $('#dim_width1').val(null);
                $('#dim_width2').val(null);
                $('#dim_width3').val(null);
                $('#dim_height1').val(null);
                $('#dim_height2').val(null);
                $('#dim_height3').val(null);
                $('#dim_length_avg').val(null);
                $('#dim_width_avg').val(null);
                $('#dim_height_avg').val(null);
            }
        });

        $('#dim_length1,#dim_length2,#dim_length3,#dim_width1,#dim_width2,#dim_width3,#dim_height1,#dim_height2,#dim_height3').change(function() {
            $('#txtdim').css("background-color", "var(--success)");

            var dim_length1 = $('#dim_length1').val();
            var dim_length2 = $('#dim_length2').val();
            var dim_length3 = $('#dim_length3').val();

            var dim_width1 = $('#dim_width1').val();
            var dim_width2 = $('#dim_width2').val();
            var dim_width3 = $('#dim_width3').val();

            var dim_height1 = $('#dim_height1').val();
            var dim_height2 = $('#dim_height2').val();
            var dim_height3 = $('#dim_height3').val();

            var dim_length_avg = ((+dim_length1) + (+dim_length2) + (+dim_length3)) / 3;
            var dim_width_avg = ((+dim_width1) + (+dim_width2) + (+dim_width3)) / 3;
            var dim_height_avg = ((+dim_height1) + (+dim_height2) + (+dim_height3)) / 3;

            $('#dim_length_avg').val((+dim_length_avg).toFixed(1));
            $('#dim_width_avg').val((+dim_width_avg).toFixed(1));
            $('#dim_height_avg').val((+dim_height_avg).toFixed(1));

        });

        $('#dim_length_avg,#dim_width_avg,#dim_height_avg').change(function() {
            $('#txtdim').css("background-color", "var(--success)");

            var dim_length_avg = $('#dim_length_avg').val();
            var dim_width_avg = $('#dim_width_avg').val();
            var dim_height_avg = $('#dim_height_avg').val();

            if ((+randomNumberFromRange(1, 9).toFixed()) % 2 == 0) {
                var dim_length1 = (+dim_length_avg) + 1.2;
                var dim_length2 = (+dim_length_avg) + 0.2;
                var dim_length3 = (+dim_length_avg) - 1.4;

                var dim_width1 = (+dim_width_avg) + 1.2;
                var dim_width2 = (+dim_width_avg) + 0.2;
                var dim_width3 = (+dim_width_avg) - 1.4;

                var dim_height1 = (+dim_height_avg) + 0.2;
                var dim_height2 = (+dim_height_avg) + 0.5;
                var dim_height3 = (+dim_height_avg) - 0.7;
            } else {
                var dim_length1 = (+dim_length_avg) + 0.7;
                var dim_length2 = (+dim_length_avg) - 1.1;
                var dim_length3 = (+dim_length_avg) + 0.4;

                var dim_width1 = (+dim_width_avg) + 0.7;
                var dim_width2 = (+dim_width_avg) - 1.1;
                var dim_width3 = (+dim_width_avg) + 0.4;

                var dim_height1 = (+dim_height_avg) + 0.3;
                var dim_height2 = (+dim_height_avg) - 0.9;
                var dim_height3 = (+dim_height_avg) + 0.6;
            }

            $('#dim_length1').val((+dim_length1).toFixed(1));
            $('#dim_length2').val((+dim_length2).toFixed(1));
            $('#dim_length3').val((+dim_length3).toFixed(1));

            $('#dim_width1').val((+dim_width1).toFixed(1));
            $('#dim_width2').val((+dim_width2).toFixed(1));
            $('#dim_width3').val((+dim_width3).toFixed(1));

            $('#dim_height1').val((+dim_height1).toFixed(1));
            $('#dim_height2').val((+dim_height2).toFixed(1));
            $('#dim_height3').val((+dim_height3).toFixed(1));
        });




        //chk_auto
        $('#chk_auto').change(function() {
            if (this.checked) {
                //$('#txtabr').css("background-color","var(--success)");
                //$('#txtwtr').css("background-color","var(--success)");


                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //SPECIFIC GRAVITY
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "spg") {
                        $('#txtspg').css("background-color", "var(--success)");
                        $("#chk_spg").prop("checked", true);
                        spg_auto();
                        break;
                    }
                }

                //POROSITY
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "wtr") {
                        $('#txtpor').css("background-color", "var(--success)");
                        $("#chk_por").prop("checked", true);
                        por_auto();
                        break;
                    }
                }

                //HARDNESS
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "hrd") {
                        $('#txthrd').css("background-color", "var(--success)");
                        $("#chk_hrd").prop("checked", true);
                        hrd_auto();
                        break;
                    }
                }

                //COMPRESSIVE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "com") {
                        $('#txtcom').css("background-color", "var(--success)");
                        $("#chk_com").prop("checked", true);
                        com_auto();
                        break;
                    }
                }

                //TRANSVERSE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "TRA") {
                        $('#txttra').css("background-color", "var(--success)");
                        $("#chk_tra").prop("checked", true);
                        tra_auto();
                        break;
                    }
                }

                //TENSILE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "tes") {
                        $('#txtten').css("background-color", "var(--success)");
                        $("#chk_ten").prop("checked", true);
                        ten_auto();
                        break;
                    }
                }
                //DIMENTIONS
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "DIM") {
                        $('#txtdim').css("background-color", "var(--success)");
                        $("#chk_dim").prop("checked", true);
                        dim_auto();
                        break;
                    }
                }
                //MOISTURE CONTENT
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "MOI") {
                        $('#txtmoc').css("background-color", "var(--success)");
                        $("#chk_moi").prop("checked", true);
                        moi_auto();
                        break;
                    }
                }


            }

        });

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
            url: '<?php echo $base_url; ?>save_granite_stone.php',
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

            //SPECIFIC GRAVITY
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "spg") {
                    if (document.getElementById('chk_spg').checked) {
                        var chk_spg = "1";
                    } else {
                        var chk_spg = "0";
                    }
                    var w2_1 = $('#w2_1').val();
                    var w2_2 = $('#w2_2').val();
                    var w2_3 = $('#w2_3').val();
                    var w1_1 = $('#w1_1').val();
                    var w1_2 = $('#w1_2').val();
                    var w1_3 = $('#w1_3').val();
                    var w4_1 = $('#w4_1').val();
                    var w4_2 = $('#w4_2').val();
                    var w4_3 = $('#w4_3').val();
                    var w3_1 = $('#w3_1').val();
                    var w3_2 = $('#w3_2').val();
                    var w3_3 = $('#w3_3').val();
                    var spg_1 = $('#spg_1').val();
                    var spg_2 = $('#spg_2').val();
                    var spg_3 = $('#spg_3').val();
                    var avg_spg = $('#avg_spg').val();
                    break;
                } else {
                    var chk_spg = "0";
                    var w2_1 = "0";
                    var w2_2 = "0";
                    var w2_3 = "0";
                    var w1_1 = "0";
                    var w1_2 = "0";
                    var w1_3 = "0";
                    var w4_1 = "0";
                    var w4_2 = "0";
                    var w4_3 = "0";
                    var w3_1 = "0";
                    var w3_2 = "0";
                    var w3_3 = "0";
                    var spg_1 = "0";
                    var spg_2 = "0";
                    var spg_3 = "0";
                    var avg_spg = "0";
                }
            }

            //POROSITY
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "wtr") {
                    if (document.getElementById('chk_por').checked) {
                        var chk_por = "1";
                    } else {
                        var chk_por = "0";
                    }
                    var a1 = $('#a1').val();
                    var a2 = $('#a2').val();
                    var a3 = $('#a3').val();
                    var b1 = $('#b1').val();
                    var b2 = $('#b2').val();
                    var b3 = $('#b3').val();
                    var c1 = $('#c1').val();
                    var c2 = $('#c2').val();
                    var c3 = $('#c3').val();
                    var asg1 = $('#asg1').val();
                    var asg2 = $('#asg2').val();
                    var asg3 = $('#asg3').val();
                    var avg_asg = $('#avg_asg').val();
                    var wtr1 = $('#wtr1').val();
                    var wtr2 = $('#wtr2').val();
                    var wtr3 = $('#wtr3').val();
                    var avg_wtr = $('#avg_wtr').val();
                    var por1 = $('#por1').val();
                    var por2 = $('#por2').val();
                    var por3 = $('#por3').val();
                    var avg_por = $('#avg_por').val();
                    var tspg1 = $('#tspg1').val();
                    var tspg2 = $('#tspg2').val();
                    var tspg3 = $('#tspg3').val();
                    var avg_tspg = $('#avg_tspg').val();
                    var tpor1 = $('#tpor1').val();
                    var tpor2 = $('#tpor2').val();
                    var tpor3 = $('#tpor3').val();
                    var avg_tpor = $('#avg_tpor').val();
                    break;
                } else {
                    var chk_por = "0";
                    var a1 = "0";
                    var a2 = "0";
                    var a3 = "0";
                    var b1 = "0";
                    var b2 = "0";
                    var b3 = "0";
                    var c1 = "0";
                    var c2 = "0";
                    var c3 = "0";
                    var asg1 = "0";
                    var asg2 = "0";
                    var asg3 = "0";
                    var avg_asg = "0";
                    var wtr1 = "0";
                    var wtr2 = "0";
                    var wtr3 = "0";
                    var avg_wtr = "0";
                    var por1 = "0";
                    var por2 = "0";
                    var por3 = "0";
                    var avg_por = "0";
                    var tspg1 = "0";
                    var tspg2 = "0";
                    var tspg3 = "0";
                    var avg_tspg = "0";
                    var tpor1 = "0";
                    var tpor2 = "0";
                    var tpor3 = "0";
                    var avg_tpor = "0";
                }
            }


            //COMPRESSIVE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "com") {
                    if (document.getElementById('chk_com').checked) {
                        var chk_com = "1";
                    } else {
                        var chk_com = "0";
                    }
                    var con1 = $('#con1').val();
                    var con2 = $('#con2').val();
                    var con3 = $('#con3').val();
                    var con4 = $('#con4').val();
                    var con5 = $('#con5').val();
                    var con6 = $('#con6').val();
                    var con7 = $('#con7').val();
                    var con8 = $('#con8').val();
                    var con9 = $('#con9').val();
                    var con10 = $('#con10').val();
                    var con11 = $('#con11').val();
                    var con12 = $('#con12').val();
                    var con13 = $('#con13').val();
                    var con14 = $('#con14').val();
                    var con15 = $('#con15').val();
                    var con16 = $('#con16').val();
                    var con17 = $('#con17').val();
                    var con18 = $('#con18').val();
                    var con19 = $('#con19').val();
                    var con20 = $('#con20').val();
                    var len1 = $('#len1').val();
                    var len2 = $('#len2').val();
                    var len3 = $('#len3').val();
                    var len4 = $('#len4').val();
                    var len5 = $('#len5').val();
                    var len6 = $('#len6').val();
                    var len7 = $('#len7').val();
                    var len8 = $('#len8').val();
                    var len9 = $('#len9').val();
                    var len10 = $('#len10').val();
                    var len11 = $('#len11').val();
                    var len12 = $('#len12').val();
                    var len13 = $('#len13').val();
                    var len14 = $('#len14').val();
                    var len15 = $('#len15').val();
                    var len16 = $('#len16').val();
                    var len17 = $('#len17').val();
                    var len18 = $('#len18').val();
                    var len19 = $('#len19').val();
                    var len20 = $('#len20').val();
                    var h1 = $('#h1').val();
                    var h2 = $('#h2').val();
                    var h3 = $('#h3').val();
                    var h4 = $('#h4').val();
                    var h5 = $('#h5').val();
                    var h6 = $('#h6').val();
                    var h7 = $('#h7').val();
                    var h8 = $('#h8').val();
                    var h9 = $('#h9').val();
                    var h10 = $('#h10').val();
                    var h11 = $('#h11').val();
                    var h12 = $('#h12').val();
                    var h13 = $('#h13').val();
                    var h14 = $('#h14').val();
                    var h15 = $('#h15').val();
                    var h16 = $('#h16').val();
                    var h17 = $('#h17').val();
                    var h18 = $('#h18').val();
                    var h19 = $('#h19').val();
                    var h20 = $('#h20').val();
                    var w1 = $('#w1').val();
                    var w2 = $('#w2').val();
                    var w3 = $('#w3').val();
                    var w4 = $('#w4').val();
                    var w5 = $('#w5').val();
                    var w6 = $('#w6').val();
                    var w7 = $('#w7').val();
                    var w8 = $('#w8').val();
                    var w9 = $('#w9').val();
                    var w10 = $('#w10').val();
                    var w11 = $('#w11').val();
                    var w12 = $('#w12').val();
                    var w13 = $('#w13').val();
                    var w14 = $('#w14').val();
                    var w15 = $('#w15').val();
                    var w16 = $('#w16').val();
                    var w17 = $('#w17').val();
                    var w18 = $('#w18').val();
                    var w19 = $('#w19').val();
                    var w20 = $('#w20').val();
                    var ratio1 = $('#ratio1').val();
                    var ratio2 = $('#ratio2').val();
                    var ratio3 = $('#ratio3').val();
                    var ratio4 = $('#ratio4').val();
                    var ratio5 = $('#ratio5').val();
                    var ratio6 = $('#ratio6').val();
                    var ratio7 = $('#ratio7').val();
                    var ratio8 = $('#ratio8').val();
                    var ratio9 = $('#ratio9').val();
                    var ratio10 = $('#ratio10').val();
                    var ratio11 = $('#ratio11').val();
                    var ratio12 = $('#ratio12').val();
                    var ratio13 = $('#ratio13').val();
                    var ratio14 = $('#ratio14').val();
                    var ratio15 = $('#ratio15').val();
                    var ratio16 = $('#ratio16').val();
                    var ratio17 = $('#ratio17').val();
                    var ratio18 = $('#ratio18').val();
                    var ratio19 = $('#ratio19').val();
                    var ratio20 = $('#ratio20').val();
                    var area1 = $('#area1').val();
                    var area2 = $('#area2').val();
                    var area3 = $('#area3').val();
                    var area4 = $('#area4').val();
                    var area5 = $('#area5').val();
                    var area6 = $('#area6').val();
                    var area7 = $('#area7').val();
                    var area8 = $('#area8').val();
                    var area9 = $('#area9').val();
                    var area10 = $('#area10').val();
                    var area11 = $('#area11').val();
                    var area12 = $('#area12').val();
                    var area13 = $('#area13').val();
                    var area14 = $('#area14').val();
                    var area15 = $('#area15').val();
                    var area16 = $('#area16').val();
                    var area17 = $('#area17').val();
                    var area18 = $('#area18').val();
                    var area19 = $('#area19').val();
                    var area20 = $('#area20').val();
                    var load1 = $('#load1').val();
                    var load2 = $('#load2').val();
                    var load3 = $('#load3').val();
                    var load4 = $('#load4').val();
                    var load5 = $('#load5').val();
                    var load6 = $('#load6').val();
                    var load7 = $('#load7').val();
                    var load8 = $('#load8').val();
                    var load9 = $('#load9').val();
                    var load10 = $('#load10').val();
                    var load11 = $('#load11').val();
                    var load12 = $('#load12').val();
                    var load13 = $('#load13').val();
                    var load14 = $('#load14').val();
                    var load15 = $('#load15').val();
                    var load16 = $('#load16').val();
                    var load17 = $('#load17').val();
                    var load18 = $('#load18').val();
                    var load19 = $('#load19').val();
                    var load20 = $('#load20').val();
                    var com1 = $('#com1').val();
                    var com2 = $('#com2').val();
                    var com3 = $('#com3').val();
                    var com4 = $('#com4').val();
                    var com5 = $('#com5').val();
                    var com6 = $('#com6').val();
                    var com7 = $('#com7').val();
                    var com8 = $('#com8').val();
                    var com9 = $('#com9').val();
                    var com10 = $('#com10').val();
                    var com11 = $('#com11').val();
                    var com12 = $('#com12').val();
                    var com13 = $('#com13').val();
                    var com14 = $('#com14').val();
                    var com15 = $('#com15').val();
                    var com16 = $('#com16').val();
                    var com17 = $('#com17').val();
                    var com18 = $('#com18').val();
                    var com19 = $('#com19').val();
                    var com20 = $('#com20').val();
                    var avg_com1 = $('#avg_com1').val();
                    var avg_com2 = $('#avg_com2').val();
                    var avg_com3 = $('#avg_com3').val();
                    var avg_com4 = $('#avg_com4').val();
                    break;
                } else {
                    var chk_com = "";
                    var con1 = "";
                    var con2 = "";
                    var con3 = "";
                    var con4 = "";
                    var con5 = "";
                    var con6 = "";
                    var con7 = "";
                    var con8 = "";
                    var con9 = "";
                    var con10 = "";
                    var con11 = "";
                    var con12 = "";
                    var con13 = "";
                    var con14 = "";
                    var con15 = "";
                    var con16 = "";
                    var con17 = "";
                    var con18 = "";
                    var con19 = "";
                    var con20 = "";
                    var len1 = "";
                    var len2 = "";
                    var len3 = "";
                    var len4 = "";
                    var len5 = "";
                    var len6 = "";
                    var len7 = "";
                    var len8 = "";
                    var len9 = "";
                    var len10 = "";
                    var len11 = "";
                    var len12 = "";
                    var len13 = "";
                    var len14 = "";
                    var len15 = "";
                    var len16 = "";
                    var len17 = "";
                    var len18 = "";
                    var len19 = "";
                    var len20 = "";
                    var h1 = "";
                    var h2 = "";
                    var h3 = "";
                    var h4 = "";
                    var h5 = "";
                    var h6 = "";
                    var h7 = "";
                    var h8 = "";
                    var h9 = "";
                    var h10 = "";
                    var h11 = "";
                    var h12 = "";
                    var h13 = "";
                    var h14 = "";
                    var h15 = "";
                    var h16 = "";
                    var h17 = "";
                    var h18 = "";
                    var h19 = "";
                    var h20 = "";
                    var w1 = "";
                    var w2 = "";
                    var w3 = "";
                    var w4 = "";
                    var w5 = "";
                    var w6 = "";
                    var w7 = "";
                    var w8 = "";
                    var w9 = "";
                    var w10 = "";
                    var w11 = "";
                    var w12 = "";
                    var w13 = "";
                    var w14 = "";
                    var w15 = "";
                    var w16 = "";
                    var w17 = "";
                    var w18 = "";
                    var w19 = "";
                    var w20 = "";
                    var ratio1 = "";
                    var ratio2 = "";
                    var ratio3 = "";
                    var ratio4 = "";
                    var ratio5 = "";
                    var ratio6 = "";
                    var ratio7 = "";
                    var ratio8 = "";
                    var ratio9 = "";
                    var ratio10 = "";
                    var ratio11 = "";
                    var ratio12 = "";
                    var ratio13 = "";
                    var ratio14 = "";
                    var ratio15 = "";
                    var ratio16 = "";
                    var ratio17 = "";
                    var ratio18 = "";
                    var ratio19 = "";
                    var ratio20 = "";
                    var area1 = "";
                    var area2 = "";
                    var area3 = "";
                    var area4 = "";
                    var area5 = "";
                    var area6 = "";
                    var area7 = "";
                    var area8 = "";
                    var area9 = "";
                    var area10 = "";
                    var area11 = "";
                    var area12 = "";
                    var area13 = "";
                    var area14 = "";
                    var area15 = "";
                    var area16 = "";
                    var area17 = "";
                    var area18 = "";
                    var area19 = "";
                    var area20 = "";
                    var load1 = "";
                    var load2 = "";
                    var load3 = "";
                    var load4 = "";
                    var load5 = "";
                    var load6 = "";
                    var load7 = "";
                    var load8 = "";
                    var load9 = "";
                    var load10 = "";
                    var load11 = "";
                    var load12 = "";
                    var load13 = "";
                    var load14 = "";
                    var load15 = "";
                    var load16 = "";
                    var load17 = "";
                    var load18 = "";
                    var load19 = "";
                    var load20 = "";
                    var com1 = "";
                    var com2 = "";
                    var com3 = "";
                    var com4 = "";
                    var com5 = "";
                    var com6 = "";
                    var com7 = "";
                    var com8 = "";
                    var com9 = "";
                    var com10 = "";
                    var com11 = "";
                    var com12 = "";
                    var com13 = "";
                    var com14 = "";
                    var com15 = "";
                    var com16 = "";
                    var com17 = "";
                    var com18 = "";
                    var com19 = "";
                    var com20 = "";
                    var avg_com1 = "";
                    var avg_com2 = "";
                    var avg_com3 = "";
                    var avg_com4 = "";
                }
            }

            //TRANSVERSE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "TRA") {
                    if (document.getElementById('chk_tra').checked) {
                        var chk_tra = "1";
                    } else {
                        var chk_tra = "0";
                    }
                    var tcon1 = $('#tcon1').val();
                    var tcon2 = $('#tcon2').val();
                    var tcon3 = $('#tcon3').val();
                    var tcon4 = $('#tcon4').val();
                    var tcon5 = $('#tcon5').val();
                    var tcon6 = $('#tcon6').val();
                    var tcon7 = $('#tcon7').val();
                    var tcon8 = $('#tcon8').val();
                    var tcon9 = $('#tcon9').val();
                    var tcon10 = $('#tcon10').val();
                    var tl1 = $('#tl1').val();
                    var tl2 = $('#tl2').val();
                    var tl3 = $('#tl3').val();
                    var tl4 = $('#tl4').val();
                    var tl5 = $('#tl5').val();
                    var tl6 = $('#tl6').val();
                    var tl7 = $('#tl7').val();
                    var tl8 = $('#tl8').val();
                    var tl9 = $('#tl9').val();
                    var tl10 = $('#tl10').val();
                    var tb1 = $('#tb1').val();
                    var tb2 = $('#tb2').val();
                    var tb3 = $('#tb3').val();
                    var tb4 = $('#tb4').val();
                    var tb5 = $('#tb5').val();
                    var tb6 = $('#tb6').val();
                    var tb7 = $('#tb7').val();
                    var tb8 = $('#tb8').val();
                    var tb9 = $('#tb9').val();
                    var tb10 = $('#tb10').val();
                    var ta1 = $('#ta1').val();
                    var ta2 = $('#ta2').val();
                    var ta3 = $('#ta3').val();
                    var ta4 = $('#ta4').val();
                    var ta5 = $('#ta5').val();
                    var ta6 = $('#ta6').val();
                    var ta7 = $('#ta7').val();
                    var ta8 = $('#ta8').val();
                    var ta9 = $('#ta9').val();
                    var ta10 = $('#ta10').val();
                    var cb1 = $('#cb1').val();
                    var cb2 = $('#cb2').val();
                    var cb3 = $('#cb3').val();
                    var cb4 = $('#cb4').val();
                    var cb5 = $('#cb5').val();
                    var cb6 = $('#cb6').val();
                    var cb7 = $('#cb7').val();
                    var cb8 = $('#cb8').val();
                    var cb9 = $('#cb9').val();
                    var cb10 = $('#cb10').val();
                    var tra1 = $('#tra1').val();
                    var tra2 = $('#tra2').val();
                    var tra3 = $('#tra3').val();
                    var tra4 = $('#tra4').val();
                    var tra5 = $('#tra5').val();
                    var tra6 = $('#tra6').val();
                    var tra7 = $('#tra7').val();
                    var tra8 = $('#tra8').val();
                    var tra9 = $('#tra9').val();
                    var tra10 = $('#tra10').val();
                    var avg_tra1 = $('#avg_tra1').val();
                    var avg_tra2 = $('#avg_tra2').val();
                    break;
                } else {
                    var chk_tra = "";
                    var tcon1 = "";
                    var tcon2 = "";
                    var tcon3 = "";
                    var tcon4 = "";
                    var tcon5 = "";
                    var tcon6 = "";
                    var tcon7 = "";
                    var tcon8 = "";
                    var tcon9 = "";
                    var tcon10 = "";
                    var tl1 = "";
                    var tl2 = "";
                    var tl3 = "";
                    var tl4 = "";
                    var tl5 = "";
                    var tl6 = "";
                    var tl7 = "";
                    var tl8 = "";
                    var tl9 = "";
                    var tl10 = "";
                    var tb1 = "";
                    var tb2 = "";
                    var tb3 = "";
                    var tb4 = "";
                    var tb5 = "";
                    var tb6 = "";
                    var tb7 = "";
                    var tb8 = "";
                    var tb9 = "";
                    var tb10 = "";
                    var ta1 = "";
                    var ta2 = "";
                    var ta3 = "";
                    var ta4 = "";
                    var ta5 = "";
                    var ta6 = "";
                    var ta7 = "";
                    var ta8 = "";
                    var ta9 = "";
                    var ta10 = "";
                    var cb1 = "";
                    var cb2 = "";
                    var cb3 = "";
                    var cb4 = "";
                    var cb5 = "";
                    var cb6 = "";
                    var cb7 = "";
                    var cb8 = "";
                    var cb9 = "";
                    var cb10 = "";
                    var tra1 = "";
                    var tra2 = "";
                    var tra3 = "";
                    var tra4 = "";
                    var tra5 = "";
                    var tra6 = "";
                    var tra7 = "";
                    var tra8 = "";
                    var tra9 = "";
                    var tra10 = "";
                    var avg_tra1 = "";
                    var avg_tra2 = "";
                }
            }

            //TENSILE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "tes") {
                    if (document.getElementById('chk_ten').checked) {
                        var chk_ten = "1";
                    } else {
                        var chk_ten = "0";
                    }
                    var scon1 = $('#scon1').val();
                    var scon2 = $('#scon2').val();
                    var scon3 = $('#scon3').val();
                    var scon4 = $('#scon4').val();
                    var scon5 = $('#scon5').val();
                    var scon6 = $('#scon6').val();
                    var scon7 = $('#scon7').val();
                    var scon8 = $('#scon8').val();
                    var scon9 = $('#scon9').val();
                    var scon10 = $('#scon10').val();
                    var sd1 = $('#sd1').val();
                    var sd2 = $('#sd2').val();
                    var sd3 = $('#sd3').val();
                    var sd4 = $('#sd4').val();
                    var sd5 = $('#sd5').val();
                    var sd6 = $('#sd6').val();
                    var sd7 = $('#sd7').val();
                    var sd8 = $('#sd8').val();
                    var sd9 = $('#sd9').val();
                    var sd10 = $('#sd10').val();
                    var sl1 = $('#sl1').val();
                    var sl2 = $('#sl2').val();
                    var sl3 = $('#sl3').val();
                    var sl4 = $('#sl4').val();
                    var sl5 = $('#sl5').val();
                    var sl6 = $('#sl6').val();
                    var sl7 = $('#sl7').val();
                    var sl8 = $('#sl8').val();
                    var sl9 = $('#sl9').val();
                    var sl10 = $('#sl10').val();
                    var sload1 = $('#sload1').val();
                    var sload2 = $('#sload2').val();
                    var sload3 = $('#sload3').val();
                    var sload4 = $('#sload4').val();
                    var sload5 = $('#sload5').val();
                    var sload6 = $('#sload6').val();
                    var sload7 = $('#sload7').val();
                    var sload8 = $('#sload8').val();
                    var sload9 = $('#sload9').val();
                    var sload10 = $('#sload10').val();
                    var ten1 = $('#ten1').val();
                    var ten2 = $('#ten2').val();
                    var ten3 = $('#ten3').val();
                    var ten4 = $('#ten4').val();
                    var ten5 = $('#ten5').val();
                    var ten6 = $('#ten6').val();
                    var ten7 = $('#ten7').val();
                    var ten8 = $('#ten8').val();
                    var ten9 = $('#ten9').val();
                    var ten10 = $('#ten10').val();
                    var avg_ten1 = $('#avg_ten1').val();
                    var avg_ten2 = $('#avg_ten2').val();
                    break;
                } else {
                    var chk_ten = "";
                    var scon1 = "";
                    var scon2 = "";
                    var scon3 = "";
                    var scon4 = "";
                    var scon5 = "";
                    var scon6 = "";
                    var scon7 = "";
                    var scon8 = "";
                    var scon9 = "";
                    var scon10 = "";
                    var sd1 = "";
                    var sd2 = "";
                    var sd3 = "";
                    var sd4 = "";
                    var sd5 = "";
                    var sd6 = "";
                    var sd7 = "";
                    var sd8 = "";
                    var sd9 = "";
                    var sd10 = "";
                    var sl1 = "";
                    var sl2 = "";
                    var sl3 = "";
                    var sl4 = "";
                    var sl5 = "";
                    var sl6 = "";
                    var sl7 = "";
                    var sl8 = "";
                    var sl9 = "";
                    var sl10 = "";
                    var sload1 = "";
                    var sload2 = "";
                    var sload3 = "";
                    var sload4 = "";
                    var sload5 = "";
                    var sload6 = "";
                    var sload7 = "";
                    var sload8 = "";
                    var sload9 = "";
                    var sload10 = "";
                    var ten1 = "";
                    var ten2 = "";
                    var ten3 = "";
                    var ten4 = "";
                    var ten5 = "";
                    var ten6 = "";
                    var ten7 = "";
                    var ten8 = "";
                    var ten9 = "";
                    var ten10 = "";
                    var avg_ten1 = "";
                    var avg_ten2 = "";
                }
            }

            //HARDNESS
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "hrd") {
                    if (document.getElementById('chk_hrd').checked) {
                        var chk_hrd = "1";
                    } else {
                        var chk_hrd = "0";
                    }
                    var hardness = $('#hardness').val();
                    break;
                } else {
                    var chk_hrd = "0";
                    var hardness = "0";
                }
            }

            //DIMENTIONS
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "DIM") {
                    if (document.getElementById('chk_dim').checked) {
                        var chk_dim = "1";
                    } else {
                        var chk_dim = "0";
                    }
                    var dim_length1 = $('#dim_length1').val();
                    var dim_length2 = $('#dim_length2').val();
                    var dim_length3 = $('#dim_length3').val();
                    var dim_width1 = $('#dim_width1').val();
                    var dim_width2 = $('#dim_width2').val();
                    var dim_width3 = $('#dim_width3').val();
                    var dim_height1 = $('#dim_height1').val();
                    var dim_height2 = $('#dim_height2').val();
                    var dim_height3 = $('#dim_height3').val();
                    var dim_length_avg = $('#dim_length_avg').val();
                    var dim_width_avg = $('#dim_width_avg').val();
                    var dim_height_avg = $('#dim_height_avg').val();
                    break;
                } else {
                    var chk_dim = "";
                    var dim_length1 = "";
                    var dim_length2 = "";
                    var dim_length3 = "";
                    var dim_width1 = "";
                    var dim_width2 = "";
                    var dim_width3 = "";
                    var dim_height1 = "";
                    var dim_height2 = "";
                    var dim_height3 = "";
                    var dim_length_avg = "";
                    var dim_width_avg = "";
                    var dim_height_avg = "";
                }
            }

            //MOISTURE CONTENT
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "MOI") {
                    if (document.getElementById('chk_moi').checked) {
                        var chk_moi = "1";
                    } else {
                        var chk_moi = "0";
                    }
                    var moc1_1 = $('#moc1_1').val();
                    var moc1_2 = $('#moc1_2').val();
                    var moc1_3 = $('#moc1_3').val();
                    var moc1_4 = $('#moc1_4').val();
                    var moc2_1 = $('#moc2_1').val();
                    var moc2_2 = $('#moc2_2').val();
                    var moc2_3 = $('#moc2_3').val();
                    var moc2_4 = $('#moc2_4').val();
                    var moc3_1 = $('#moc3_1').val();
                    var moc3_2 = $('#moc3_2').val();
                    var moc3_3 = $('#moc3_3').val();
                    var moc3_4 = $('#moc3_4').val();
                    var avg_moc = $('#avg_moc').val();
                    break;
                } else {
                    var chk_moi = "";
                    var moc1_1 = "";
                    var moc1_2 = "";
                    var moc1_3 = "";
                    var moc1_4 = "";
                    var moc2_1 = "";
                    var moc2_2 = "";
                    var moc2_3 = "";
                    var moc2_4 = "";
                    var moc3_1 = "";
                    var moc3_2 = "";
                    var moc3_3 = "";
                    var moc3_4 = "";
                    var avg_moc = "";
                }
            }

            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_spg=' + chk_spg + '&w2_1=' + w2_1 + '&w2_2=' + w2_2 + '&w2_3=' + w2_3 + '&w1_1=' + w1_1 + '&w1_2=' + w1_2 + '&w1_3=' + w1_3 + '&w4_1=' + w4_1 + '&w4_2=' + w4_2 + '&w4_3=' + w4_3 + '&w3_1=' + w3_1 + '&w3_2=' + w3_2 + '&w3_3=' + w3_3 + '&spg_1=' + spg_1 + '&spg_2=' + spg_2 + '&spg_3=' + spg_3 + '&avg_spg=' + avg_spg + '&chk_por=' + chk_por + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&asg1=' + asg1 + '&asg2=' + asg2 + '&asg3=' + asg3 + '&avg_asg=' + avg_asg + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&avg_wtr=' + avg_wtr + '&por1=' + por1 + '&por2=' + por2 + '&por3=' + por3 + '&avg_por=' + avg_por + '&tspg1=' + tspg1 + '&tspg2=' + tspg2 + '&tspg3=' + tspg3 + '&avg_tspg=' + avg_tspg + '&tpor1=' + tpor1 + '&tpor2=' + tpor2 + '&tpor3=' + tpor3 + '&avg_tpor=' + avg_tpor + '&chk_com=' + chk_com + '&con1=' + con1 + '&con2=' + con2 + '&con3=' + con3 + '&con4=' + con4 + '&con5=' + con5 + '&con6=' + con6 + '&con7=' + con7 + '&con8=' + con8 + '&con9=' + con9 + '&con10=' + con10 + '&con11=' + con11 + '&con12=' + con12 + '&con13=' + con13 + '&con14=' + con14 + '&con15=' + con15 + '&con16=' + con16 + '&con17=' + con17 + '&con18=' + con18 + '&con19=' + con19 + '&con20=' + con20 + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&len4=' + len4 + '&len5=' + len5 + '&len6=' + len6 + '&len7=' + len7 + '&len8=' + len8 + '&len9=' + len9 + '&len10=' + len10 + '&len11=' + len11 + '&len12=' + len12 + '&len13=' + len13 + '&len14=' + len14 + '&len15=' + len15 + '&len16=' + len16 + '&len17=' + len17 + '&len18=' + len18 + '&len19=' + len19 + '&len20=' + len20 + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&h4=' + h4 + '&h5=' + h5 + '&h6=' + h6 + '&h7=' + h7 + '&h8=' + h8 + '&h9=' + h9 + '&h10=' + h10 + '&h11=' + h11 + '&h12=' + h12 + '&h13=' + h13 + '&h14=' + h14 + '&h15=' + h15 + '&h16=' + h16 + '&h17=' + h17 + '&h18=' + h18 + '&h19=' + h19 + '&h20=' + h20 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&w4=' + w4 + '&w5=' + w5 + '&w6=' + w6 + '&w7=' + w7 + '&w8=' + w8 + '&w9=' + w9 + '&w10=' + w10 + '&w11=' + w11 + '&w12=' + w12 + '&w13=' + w13 + '&w14=' + w14 + '&w15=' + w15 + '&w16=' + w16 + '&w17=' + w17 + '&w18=' + w18 + '&w19=' + w19 + '&w20=' + w20 + '&ratio1=' + ratio1 + '&ratio2=' + ratio2 + '&ratio3=' + ratio3 + '&ratio4=' + ratio4 + '&ratio5=' + ratio5 + '&ratio6=' + ratio6 + '&ratio7=' + ratio7 + '&ratio8=' + ratio8 + '&ratio9=' + ratio9 + '&ratio10=' + ratio10 + '&ratio11=' + ratio11 + '&ratio12=' + ratio12 + '&ratio13=' + ratio13 + '&ratio14=' + ratio14 + '&ratio15=' + ratio15 + '&ratio16=' + ratio16 + '&ratio17=' + ratio17 + '&ratio18=' + ratio18 + '&ratio19=' + ratio19 + '&ratio20=' + ratio20 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&area4=' + area4 + '&area5=' + area5 + '&area6=' + area6 + '&area7=' + area7 + '&area8=' + area8 + '&area9=' + area9 + '&area10=' + area10 + '&area11=' + area11 + '&area12=' + area12 + '&area13=' + area13 + '&area14=' + area14 + '&area15=' + area15 + '&area16=' + area16 + '&area17=' + area17 + '&area18=' + area18 + '&area19=' + area19 + '&area20=' + area20 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&load5=' + load5 + '&load6=' + load6 + '&load7=' + load7 + '&load8=' + load8 + '&load9=' + load9 + '&load10=' + load10 + '&load11=' + load11 + '&load12=' + load12 + '&load13=' + load13 + '&load14=' + load14 + '&load15=' + load15 + '&load16=' + load16 + '&load17=' + load17 + '&load18=' + load18 + '&load19=' + load19 + '&load20=' + load20 + '&com1=' + com1 + '&com2=' + com2 + '&com3=' + com3 + '&com4=' + com4 + '&com5=' + com5 + '&com6=' + com6 + '&com7=' + com7 + '&com8=' + com8 + '&com9=' + com9 + '&com10=' + com10 + '&com11=' + com11 + '&com12=' + com12 + '&com13=' + com13 + '&com14=' + com14 + '&com15=' + com15 + '&com16=' + com16 + '&com17=' + com17 + '&com18=' + com18 + '&com19=' + com19 + '&com20=' + com20 + '&avg_com1=' + avg_com1 + '&avg_com2=' + avg_com2 + '&avg_com3=' + avg_com3 + '&avg_com4=' + avg_com4 + '&chk_tra=' + chk_tra + '&tcon1=' + tcon1 + '&tcon2=' + tcon2 + '&tcon3=' + tcon3 + '&tcon4=' + tcon4 + '&tcon5=' + tcon5 + '&tcon6=' + tcon6 + '&tcon7=' + tcon7 + '&tcon8=' + tcon8 + '&tcon9=' + tcon9 + '&tcon10=' + tcon10 + '&tl1=' + tl1 + '&tl2=' + tl2 + '&tl3=' + tl3 + '&tl4=' + tl4 + '&tl5=' + tl5 + '&tl6=' + tl6 + '&tl7=' + tl7 + '&tl8=' + tl8 + '&tl9=' + tl9 + '&tl10=' + tl10 + '&tb1=' + tb1 + '&tb2=' + tb2 + '&tb3=' + tb3 + '&tb4=' + tb4 + '&tb5=' + tb5 + '&tb6=' + tb6 + '&tb7=' + tb7 + '&tb8=' + tb8 + '&tb9=' + tb9 + '&tb10=' + tb10 + '&ta1=' + ta1 + '&ta2=' + ta2 + '&ta3=' + ta3 + '&ta4=' + ta4 + '&ta5=' + ta5 + '&ta6=' + ta6 + '&ta7=' + ta7 + '&ta8=' + ta8 + '&ta9=' + ta9 + '&ta10=' + ta10 + '&cb1=' + cb1 + '&cb2=' + cb2 + '&cb3=' + cb3 + '&cb4=' + cb4 + '&cb5=' + cb5 + '&cb6=' + cb6 + '&cb7=' + cb7 + '&cb8=' + cb8 + '&cb9=' + cb9 + '&cb10=' + cb10 + '&tra1=' + tra1 + '&tra2=' + tra2 + '&tra3=' + tra3 + '&tra4=' + tra4 + '&tra5=' + tra5 + '&tra6=' + tra6 + '&tra7=' + tra7 + '&tra8=' + tra8 + '&tra9=' + tra9 + '&tra10=' + tra10 + '&avg_tra1=' + avg_tra1 + '&avg_tra2=' + avg_tra2 + '&chk_ten=' + chk_ten + '&scon1=' + scon1 + '&scon2=' + scon2 + '&scon3=' + scon3 + '&scon4=' + scon4 + '&scon5=' + scon5 + '&scon6=' + scon6 + '&scon7=' + scon7 + '&scon8=' + scon8 + '&scon9=' + scon9 + '&scon10=' + scon10 + '&sd1=' + sd1 + '&sd2=' + sd2 + '&sd3=' + sd3 + '&sd4=' + sd4 + '&sd5=' + sd5 + '&sd6=' + sd6 + '&sd7=' + sd7 + '&sd8=' + sd8 + '&sd9=' + sd9 + '&sd10=' + sd10 + '&sl1=' + sl1 + '&sl2=' + sl2 + '&sl3=' + sl3 + '&sl4=' + sl4 + '&sl5=' + sl5 + '&sl6=' + sl6 + '&sl7=' + sl7 + '&sl8=' + sl8 + '&sl9=' + sl9 + '&sl10=' + sl10 + '&sload1=' + sload1 + '&sload2=' + sload2 + '&sload3=' + sload3 + '&sload4=' + sload4 + '&sload5=' + sload5 + '&sload6=' + sload6 + '&sload7=' + sload7 + '&sload8=' + sload8 + '&sload9=' + sload9 + '&sload10=' + sload10 + '&ten1=' + ten1 + '&ten2=' + ten2 + '&ten3=' + ten3 + '&ten4=' + ten4 + '&ten5=' + ten5 + '&ten6=' + ten6 + '&ten7=' + ten7 + '&ten8=' + ten8 + '&ten9=' + ten9 + '&ten10=' + ten10 + '&avg_ten1=' + avg_ten1 + '&avg_ten2=' + avg_ten2 + '&chk_hrd=' + chk_hrd + '&hardness=' + hardness + '&chk_dim=' + chk_dim + '&dim_length1=' + dim_length1 + '&dim_length2=' + dim_length2 + '&dim_length3=' + dim_length3 + '&dim_width1=' + dim_width1 + '&dim_width2=' + dim_width2 + '&dim_width3=' + dim_width3 + '&dim_height1=' + dim_height1 + '&dim_height2=' + dim_height2 + '&dim_height3=' + dim_height3 + '&dim_length_avg=' + dim_length_avg + '&dim_width_avg=' + dim_width_avg + '&dim_height_avg=' + dim_height_avg + '&chk_moi=' + chk_moi + '&moc1_1=' + moc1_1 + '&moc1_2=' + moc1_2 + '&moc1_3=' + moc1_3 + '&moc1_4=' + moc1_4 + '&moc2_1=' + moc2_1 + '&moc2_2=' + moc2_2 + '&moc2_3=' + moc2_3 + '&moc2_4=' + moc2_4 + '&moc3_1=' + moc3_1 + '&moc3_2=' + moc3_2 + '&moc3_3=' + moc3_3 + '&moc3_4=' + moc3_4 + '&avg_moc=' + avg_moc+ '&amend_date=' + amend_date;


        } else if (type == 'edit') {

            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var tiles_brand = $('#tiles_brand').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();

            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //SPECIFIC GRAVITY
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "spg") {
                    if (document.getElementById('chk_spg').checked) {
                        var chk_spg = "1";
                    } else {
                        var chk_spg = "0";
                    }
                    var w2_1 = $('#w2_1').val();
                    var w2_2 = $('#w2_2').val();
                    var w2_3 = $('#w2_3').val();
                    var w1_1 = $('#w1_1').val();
                    var w1_2 = $('#w1_2').val();
                    var w1_3 = $('#w1_3').val();
                    var w4_1 = $('#w4_1').val();
                    var w4_2 = $('#w4_2').val();
                    var w4_3 = $('#w4_3').val();
                    var w3_1 = $('#w3_1').val();
                    var w3_2 = $('#w3_2').val();
                    var w3_3 = $('#w3_3').val();
                    var spg_1 = $('#spg_1').val();
                    var spg_2 = $('#spg_2').val();
                    var spg_3 = $('#spg_3').val();
                    var avg_spg = $('#avg_spg').val();
                    break;
                } else {
                    var chk_spg = "0";
                    var w2_1 = "0";
                    var w2_2 = "0";
                    var w2_3 = "0";
                    var w1_1 = "0";
                    var w1_2 = "0";
                    var w1_3 = "0";
                    var w4_1 = "0";
                    var w4_2 = "0";
                    var w4_3 = "0";
                    var w3_1 = "0";
                    var w3_2 = "0";
                    var w3_3 = "0";
                    var spg_1 = "0";
                    var spg_2 = "0";
                    var spg_3 = "0";
                    var avg_spg = "0";
                }
            }

            //POROSITY
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "wtr") {
                    if (document.getElementById('chk_por').checked) {
                        var chk_por = "1";
                    } else {
                        var chk_por = "0";
                    }
                    var a1 = $('#a1').val();
                    var a2 = $('#a2').val();
                    var a3 = $('#a3').val();
                    var b1 = $('#b1').val();
                    var b2 = $('#b2').val();
                    var b3 = $('#b3').val();
                    var c1 = $('#c1').val();
                    var c2 = $('#c2').val();
                    var c3 = $('#c3').val();
                    var asg1 = $('#asg1').val();
                    var asg2 = $('#asg2').val();
                    var asg3 = $('#asg3').val();
                    var avg_asg = $('#avg_asg').val();
                    var wtr1 = $('#wtr1').val();
                    var wtr2 = $('#wtr2').val();
                    var wtr3 = $('#wtr3').val();
                    var avg_wtr = $('#avg_wtr').val();
                    var por1 = $('#por1').val();
                    var por2 = $('#por2').val();
                    var por3 = $('#por3').val();
                    var avg_por = $('#avg_por').val();
                    var tspg1 = $('#tspg1').val();
                    var tspg2 = $('#tspg2').val();
                    var tspg3 = $('#tspg3').val();
                    var avg_tspg = $('#avg_tspg').val();
                    var tpor1 = $('#tpor1').val();
                    var tpor2 = $('#tpor2').val();
                    var tpor3 = $('#tpor3').val();
                    var avg_tpor = $('#avg_tpor').val();
                    break;
                } else {
                    var chk_por = "0";
                    var a1 = "0";
                    var a2 = "0";
                    var a3 = "0";
                    var b1 = "0";
                    var b2 = "0";
                    var b3 = "0";
                    var c1 = "0";
                    var c2 = "0";
                    var c3 = "0";
                    var asg1 = "0";
                    var asg2 = "0";
                    var asg3 = "0";
                    var avg_asg = "0";
                    var wtr1 = "0";
                    var wtr2 = "0";
                    var wtr3 = "0";
                    var avg_wtr = "0";
                    var por1 = "0";
                    var por2 = "0";
                    var por3 = "0";
                    var avg_por = "0";
                    var tspg1 = "0";
                    var tspg2 = "0";
                    var tspg3 = "0";
                    var avg_tspg = "0";
                    var tpor1 = "0";
                    var tpor2 = "0";
                    var tpor3 = "0";
                    var avg_tpor = "0";
                }
            }


            //COMPRESSIVE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "com") {
                    if (document.getElementById('chk_com').checked) {
                        var chk_com = "1";
                    } else {
                        var chk_com = "0";
                    }
                    var con1 = $('#con1').val();
                    var con2 = $('#con2').val();
                    var con3 = $('#con3').val();
                    var con4 = $('#con4').val();
                    var con5 = $('#con5').val();
                    var con6 = $('#con6').val();
                    var con7 = $('#con7').val();
                    var con8 = $('#con8').val();
                    var con9 = $('#con9').val();
                    var con10 = $('#con10').val();
                    var con11 = $('#con11').val();
                    var con12 = $('#con12').val();
                    var con13 = $('#con13').val();
                    var con14 = $('#con14').val();
                    var con15 = $('#con15').val();
                    var con16 = $('#con16').val();
                    var con17 = $('#con17').val();
                    var con18 = $('#con18').val();
                    var con19 = $('#con19').val();
                    var con20 = $('#con20').val();
                    var len1 = $('#len1').val();
                    var len2 = $('#len2').val();
                    var len3 = $('#len3').val();
                    var len4 = $('#len4').val();
                    var len5 = $('#len5').val();
                    var len6 = $('#len6').val();
                    var len7 = $('#len7').val();
                    var len8 = $('#len8').val();
                    var len9 = $('#len9').val();
                    var len10 = $('#len10').val();
                    var len11 = $('#len11').val();
                    var len12 = $('#len12').val();
                    var len13 = $('#len13').val();
                    var len14 = $('#len14').val();
                    var len15 = $('#len15').val();
                    var len16 = $('#len16').val();
                    var len17 = $('#len17').val();
                    var len18 = $('#len18').val();
                    var len19 = $('#len19').val();
                    var len20 = $('#len20').val();
                    var h1 = $('#h1').val();
                    var h2 = $('#h2').val();
                    var h3 = $('#h3').val();
                    var h4 = $('#h4').val();
                    var h5 = $('#h5').val();
                    var h6 = $('#h6').val();
                    var h7 = $('#h7').val();
                    var h8 = $('#h8').val();
                    var h9 = $('#h9').val();
                    var h10 = $('#h10').val();
                    var h11 = $('#h11').val();
                    var h12 = $('#h12').val();
                    var h13 = $('#h13').val();
                    var h14 = $('#h14').val();
                    var h15 = $('#h15').val();
                    var h16 = $('#h16').val();
                    var h17 = $('#h17').val();
                    var h18 = $('#h18').val();
                    var h19 = $('#h19').val();
                    var h20 = $('#h20').val();
                    var w1 = $('#w1').val();
                    var w2 = $('#w2').val();
                    var w3 = $('#w3').val();
                    var w4 = $('#w4').val();
                    var w5 = $('#w5').val();
                    var w6 = $('#w6').val();
                    var w7 = $('#w7').val();
                    var w8 = $('#w8').val();
                    var w9 = $('#w9').val();
                    var w10 = $('#w10').val();
                    var w11 = $('#w11').val();
                    var w12 = $('#w12').val();
                    var w13 = $('#w13').val();
                    var w14 = $('#w14').val();
                    var w15 = $('#w15').val();
                    var w16 = $('#w16').val();
                    var w17 = $('#w17').val();
                    var w18 = $('#w18').val();
                    var w19 = $('#w19').val();
                    var w20 = $('#w20').val();
                    var ratio1 = $('#ratio1').val();
                    var ratio2 = $('#ratio2').val();
                    var ratio3 = $('#ratio3').val();
                    var ratio4 = $('#ratio4').val();
                    var ratio5 = $('#ratio5').val();
                    var ratio6 = $('#ratio6').val();
                    var ratio7 = $('#ratio7').val();
                    var ratio8 = $('#ratio8').val();
                    var ratio9 = $('#ratio9').val();
                    var ratio10 = $('#ratio10').val();
                    var ratio11 = $('#ratio11').val();
                    var ratio12 = $('#ratio12').val();
                    var ratio13 = $('#ratio13').val();
                    var ratio14 = $('#ratio14').val();
                    var ratio15 = $('#ratio15').val();
                    var ratio16 = $('#ratio16').val();
                    var ratio17 = $('#ratio17').val();
                    var ratio18 = $('#ratio18').val();
                    var ratio19 = $('#ratio19').val();
                    var ratio20 = $('#ratio20').val();
                    var area1 = $('#area1').val();
                    var area2 = $('#area2').val();
                    var area3 = $('#area3').val();
                    var area4 = $('#area4').val();
                    var area5 = $('#area5').val();
                    var area6 = $('#area6').val();
                    var area7 = $('#area7').val();
                    var area8 = $('#area8').val();
                    var area9 = $('#area9').val();
                    var area10 = $('#area10').val();
                    var area11 = $('#area11').val();
                    var area12 = $('#area12').val();
                    var area13 = $('#area13').val();
                    var area14 = $('#area14').val();
                    var area15 = $('#area15').val();
                    var area16 = $('#area16').val();
                    var area17 = $('#area17').val();
                    var area18 = $('#area18').val();
                    var area19 = $('#area19').val();
                    var area20 = $('#area20').val();
                    var load1 = $('#load1').val();
                    var load2 = $('#load2').val();
                    var load3 = $('#load3').val();
                    var load4 = $('#load4').val();
                    var load5 = $('#load5').val();
                    var load6 = $('#load6').val();
                    var load7 = $('#load7').val();
                    var load8 = $('#load8').val();
                    var load9 = $('#load9').val();
                    var load10 = $('#load10').val();
                    var load11 = $('#load11').val();
                    var load12 = $('#load12').val();
                    var load13 = $('#load13').val();
                    var load14 = $('#load14').val();
                    var load15 = $('#load15').val();
                    var load16 = $('#load16').val();
                    var load17 = $('#load17').val();
                    var load18 = $('#load18').val();
                    var load19 = $('#load19').val();
                    var load20 = $('#load20').val();
                    var com1 = $('#com1').val();
                    var com2 = $('#com2').val();
                    var com3 = $('#com3').val();
                    var com4 = $('#com4').val();
                    var com5 = $('#com5').val();
                    var com6 = $('#com6').val();
                    var com7 = $('#com7').val();
                    var com8 = $('#com8').val();
                    var com9 = $('#com9').val();
                    var com10 = $('#com10').val();
                    var com11 = $('#com11').val();
                    var com12 = $('#com12').val();
                    var com13 = $('#com13').val();
                    var com14 = $('#com14').val();
                    var com15 = $('#com15').val();
                    var com16 = $('#com16').val();
                    var com17 = $('#com17').val();
                    var com18 = $('#com18').val();
                    var com19 = $('#com19').val();
                    var com20 = $('#com20').val();
                    var avg_com1 = $('#avg_com1').val();
                    var avg_com2 = $('#avg_com2').val();
                    var avg_com3 = $('#avg_com3').val();
                    var avg_com4 = $('#avg_com4').val();
                    break;
                } else {
                    var chk_com = "";
                    var con1 = "";
                    var con2 = "";
                    var con3 = "";
                    var con4 = "";
                    var con5 = "";
                    var con6 = "";
                    var con7 = "";
                    var con8 = "";
                    var con9 = "";
                    var con10 = "";
                    var con11 = "";
                    var con12 = "";
                    var con13 = "";
                    var con14 = "";
                    var con15 = "";
                    var con16 = "";
                    var con17 = "";
                    var con18 = "";
                    var con19 = "";
                    var con20 = "";
                    var len1 = "";
                    var len2 = "";
                    var len3 = "";
                    var len4 = "";
                    var len5 = "";
                    var len6 = "";
                    var len7 = "";
                    var len8 = "";
                    var len9 = "";
                    var len10 = "";
                    var len11 = "";
                    var len12 = "";
                    var len13 = "";
                    var len14 = "";
                    var len15 = "";
                    var len16 = "";
                    var len17 = "";
                    var len18 = "";
                    var len19 = "";
                    var len20 = "";
                    var h1 = "";
                    var h2 = "";
                    var h3 = "";
                    var h4 = "";
                    var h5 = "";
                    var h6 = "";
                    var h7 = "";
                    var h8 = "";
                    var h9 = "";
                    var h10 = "";
                    var h11 = "";
                    var h12 = "";
                    var h13 = "";
                    var h14 = "";
                    var h15 = "";
                    var h16 = "";
                    var h17 = "";
                    var h18 = "";
                    var h19 = "";
                    var h20 = "";
                    var w1 = "";
                    var w2 = "";
                    var w3 = "";
                    var w4 = "";
                    var w5 = "";
                    var w6 = "";
                    var w7 = "";
                    var w8 = "";
                    var w9 = "";
                    var w10 = "";
                    var w11 = "";
                    var w12 = "";
                    var w13 = "";
                    var w14 = "";
                    var w15 = "";
                    var w16 = "";
                    var w17 = "";
                    var w18 = "";
                    var w19 = "";
                    var w20 = "";
                    var ratio1 = "";
                    var ratio2 = "";
                    var ratio3 = "";
                    var ratio4 = "";
                    var ratio5 = "";
                    var ratio6 = "";
                    var ratio7 = "";
                    var ratio8 = "";
                    var ratio9 = "";
                    var ratio10 = "";
                    var ratio11 = "";
                    var ratio12 = "";
                    var ratio13 = "";
                    var ratio14 = "";
                    var ratio15 = "";
                    var ratio16 = "";
                    var ratio17 = "";
                    var ratio18 = "";
                    var ratio19 = "";
                    var ratio20 = "";
                    var area1 = "";
                    var area2 = "";
                    var area3 = "";
                    var area4 = "";
                    var area5 = "";
                    var area6 = "";
                    var area7 = "";
                    var area8 = "";
                    var area9 = "";
                    var area10 = "";
                    var area11 = "";
                    var area12 = "";
                    var area13 = "";
                    var area14 = "";
                    var area15 = "";
                    var area16 = "";
                    var area17 = "";
                    var area18 = "";
                    var area19 = "";
                    var area20 = "";
                    var load1 = "";
                    var load2 = "";
                    var load3 = "";
                    var load4 = "";
                    var load5 = "";
                    var load6 = "";
                    var load7 = "";
                    var load8 = "";
                    var load9 = "";
                    var load10 = "";
                    var load11 = "";
                    var load12 = "";
                    var load13 = "";
                    var load14 = "";
                    var load15 = "";
                    var load16 = "";
                    var load17 = "";
                    var load18 = "";
                    var load19 = "";
                    var load20 = "";
                    var com1 = "";
                    var com2 = "";
                    var com3 = "";
                    var com4 = "";
                    var com5 = "";
                    var com6 = "";
                    var com7 = "";
                    var com8 = "";
                    var com9 = "";
                    var com10 = "";
                    var com11 = "";
                    var com12 = "";
                    var com13 = "";
                    var com14 = "";
                    var com15 = "";
                    var com16 = "";
                    var com17 = "";
                    var com18 = "";
                    var com19 = "";
                    var com20 = "";
                    var avg_com1 = "";
                    var avg_com2 = "";
                    var avg_com3 = "";
                    var avg_com4 = "";
                }
            }

            //TRANSVERSE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "TRA") {
                    if (document.getElementById('chk_tra').checked) {
                        var chk_tra = "1";
                    } else {
                        var chk_tra = "0";
                    }
                    var tcon1 = $('#tcon1').val();
                    var tcon2 = $('#tcon2').val();
                    var tcon3 = $('#tcon3').val();
                    var tcon4 = $('#tcon4').val();
                    var tcon5 = $('#tcon5').val();
                    var tcon6 = $('#tcon6').val();
                    var tcon7 = $('#tcon7').val();
                    var tcon8 = $('#tcon8').val();
                    var tcon9 = $('#tcon9').val();
                    var tcon10 = $('#tcon10').val();
                    var tl1 = $('#tl1').val();
                    var tl2 = $('#tl2').val();
                    var tl3 = $('#tl3').val();
                    var tl4 = $('#tl4').val();
                    var tl5 = $('#tl5').val();
                    var tl6 = $('#tl6').val();
                    var tl7 = $('#tl7').val();
                    var tl8 = $('#tl8').val();
                    var tl9 = $('#tl9').val();
                    var tl10 = $('#tl10').val();
                    var tb1 = $('#tb1').val();
                    var tb2 = $('#tb2').val();
                    var tb3 = $('#tb3').val();
                    var tb4 = $('#tb4').val();
                    var tb5 = $('#tb5').val();
                    var tb6 = $('#tb6').val();
                    var tb7 = $('#tb7').val();
                    var tb8 = $('#tb8').val();
                    var tb9 = $('#tb9').val();
                    var tb10 = $('#tb10').val();
                    var ta1 = $('#ta1').val();
                    var ta2 = $('#ta2').val();
                    var ta3 = $('#ta3').val();
                    var ta4 = $('#ta4').val();
                    var ta5 = $('#ta5').val();
                    var ta6 = $('#ta6').val();
                    var ta7 = $('#ta7').val();
                    var ta8 = $('#ta8').val();
                    var ta9 = $('#ta9').val();
                    var ta10 = $('#ta10').val();
                    var cb1 = $('#cb1').val();
                    var cb2 = $('#cb2').val();
                    var cb3 = $('#cb3').val();
                    var cb4 = $('#cb4').val();
                    var cb5 = $('#cb5').val();
                    var cb6 = $('#cb6').val();
                    var cb7 = $('#cb7').val();
                    var cb8 = $('#cb8').val();
                    var cb9 = $('#cb9').val();
                    var cb10 = $('#cb10').val();
                    var tra1 = $('#tra1').val();
                    var tra2 = $('#tra2').val();
                    var tra3 = $('#tra3').val();
                    var tra4 = $('#tra4').val();
                    var tra5 = $('#tra5').val();
                    var tra6 = $('#tra6').val();
                    var tra7 = $('#tra7').val();
                    var tra8 = $('#tra8').val();
                    var tra9 = $('#tra9').val();
                    var tra10 = $('#tra10').val();
                    var avg_tra1 = $('#avg_tra1').val();
                    var avg_tra2 = $('#avg_tra2').val();
                    break;
                } else {
                    var chk_tra = "";
                    var tcon1 = "";
                    var tcon2 = "";
                    var tcon3 = "";
                    var tcon4 = "";
                    var tcon5 = "";
                    var tcon6 = "";
                    var tcon7 = "";
                    var tcon8 = "";
                    var tcon9 = "";
                    var tcon10 = "";
                    var tl1 = "";
                    var tl2 = "";
                    var tl3 = "";
                    var tl4 = "";
                    var tl5 = "";
                    var tl6 = "";
                    var tl7 = "";
                    var tl8 = "";
                    var tl9 = "";
                    var tl10 = "";
                    var tb1 = "";
                    var tb2 = "";
                    var tb3 = "";
                    var tb4 = "";
                    var tb5 = "";
                    var tb6 = "";
                    var tb7 = "";
                    var tb8 = "";
                    var tb9 = "";
                    var tb10 = "";
                    var ta1 = "";
                    var ta2 = "";
                    var ta3 = "";
                    var ta4 = "";
                    var ta5 = "";
                    var ta6 = "";
                    var ta7 = "";
                    var ta8 = "";
                    var ta9 = "";
                    var ta10 = "";
                    var cb1 = "";
                    var cb2 = "";
                    var cb3 = "";
                    var cb4 = "";
                    var cb5 = "";
                    var cb6 = "";
                    var cb7 = "";
                    var cb8 = "";
                    var cb9 = "";
                    var cb10 = "";
                    var tra1 = "";
                    var tra2 = "";
                    var tra3 = "";
                    var tra4 = "";
                    var tra5 = "";
                    var tra6 = "";
                    var tra7 = "";
                    var tra8 = "";
                    var tra9 = "";
                    var tra10 = "";
                    var avg_tra1 = "";
                    var avg_tra2 = "";
                }
            }

            //TENSILE STRENGTH
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "tes") {
                    if (document.getElementById('chk_ten').checked) {
                        var chk_ten = "1";
                    } else {
                        var chk_ten = "0";
                    }
                    var scon1 = $('#scon1').val();
                    var scon2 = $('#scon2').val();
                    var scon3 = $('#scon3').val();
                    var scon4 = $('#scon4').val();
                    var scon5 = $('#scon5').val();
                    var scon6 = $('#scon6').val();
                    var scon7 = $('#scon7').val();
                    var scon8 = $('#scon8').val();
                    var scon9 = $('#scon9').val();
                    var scon10 = $('#scon10').val();
                    var sd1 = $('#sd1').val();
                    var sd2 = $('#sd2').val();
                    var sd3 = $('#sd3').val();
                    var sd4 = $('#sd4').val();
                    var sd5 = $('#sd5').val();
                    var sd6 = $('#sd6').val();
                    var sd7 = $('#sd7').val();
                    var sd8 = $('#sd8').val();
                    var sd9 = $('#sd9').val();
                    var sd10 = $('#sd10').val();
                    var sl1 = $('#sl1').val();
                    var sl2 = $('#sl2').val();
                    var sl3 = $('#sl3').val();
                    var sl4 = $('#sl4').val();
                    var sl5 = $('#sl5').val();
                    var sl6 = $('#sl6').val();
                    var sl7 = $('#sl7').val();
                    var sl8 = $('#sl8').val();
                    var sl9 = $('#sl9').val();
                    var sl10 = $('#sl10').val();
                    var sload1 = $('#sload1').val();
                    var sload2 = $('#sload2').val();
                    var sload3 = $('#sload3').val();
                    var sload4 = $('#sload4').val();
                    var sload5 = $('#sload5').val();
                    var sload6 = $('#sload6').val();
                    var sload7 = $('#sload7').val();
                    var sload8 = $('#sload8').val();
                    var sload9 = $('#sload9').val();
                    var sload10 = $('#sload10').val();
                    var ten1 = $('#ten1').val();
                    var ten2 = $('#ten2').val();
                    var ten3 = $('#ten3').val();
                    var ten4 = $('#ten4').val();
                    var ten5 = $('#ten5').val();
                    var ten6 = $('#ten6').val();
                    var ten7 = $('#ten7').val();
                    var ten8 = $('#ten8').val();
                    var ten9 = $('#ten9').val();
                    var ten10 = $('#ten10').val();
                    var avg_ten1 = $('#avg_ten1').val();
                    var avg_ten2 = $('#avg_ten2').val();
                    break;
                } else {
                    var chk_ten = "";
                    var scon1 = "";
                    var scon2 = "";
                    var scon3 = "";
                    var scon4 = "";
                    var scon5 = "";
                    var scon6 = "";
                    var scon7 = "";
                    var scon8 = "";
                    var scon9 = "";
                    var scon10 = "";
                    var sd1 = "";
                    var sd2 = "";
                    var sd3 = "";
                    var sd4 = "";
                    var sd5 = "";
                    var sd6 = "";
                    var sd7 = "";
                    var sd8 = "";
                    var sd9 = "";
                    var sd10 = "";
                    var sl1 = "";
                    var sl2 = "";
                    var sl3 = "";
                    var sl4 = "";
                    var sl5 = "";
                    var sl6 = "";
                    var sl7 = "";
                    var sl8 = "";
                    var sl9 = "";
                    var sl10 = "";
                    var sload1 = "";
                    var sload2 = "";
                    var sload3 = "";
                    var sload4 = "";
                    var sload5 = "";
                    var sload6 = "";
                    var sload7 = "";
                    var sload8 = "";
                    var sload9 = "";
                    var sload10 = "";
                    var ten1 = "";
                    var ten2 = "";
                    var ten3 = "";
                    var ten4 = "";
                    var ten5 = "";
                    var ten6 = "";
                    var ten7 = "";
                    var ten8 = "";
                    var ten9 = "";
                    var ten10 = "";
                    var avg_ten1 = "";
                    var avg_ten2 = "";
                }
            }

            //HARDNESS
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "hrd") {
                    if (document.getElementById('chk_hrd').checked) {
                        var chk_hrd = "1";
                    } else {
                        var chk_hrd = "0";
                    }
                    var hardness = $('#hardness').val();
                    break;
                } else {
                    var chk_hrd = "0";
                    var hardness = "0";
                }
            }

            //DIMENTIONS
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "DIM") {
                    if (document.getElementById('chk_dim').checked) {
                        var chk_dim = "1";
                    } else {
                        var chk_dim = "0";
                    }
                    var dim_length1 = $('#dim_length1').val();
                    var dim_length2 = $('#dim_length2').val();
                    var dim_length3 = $('#dim_length3').val();
                    var dim_width1 = $('#dim_width1').val();
                    var dim_width2 = $('#dim_width2').val();
                    var dim_width3 = $('#dim_width3').val();
                    var dim_height1 = $('#dim_height1').val();
                    var dim_height2 = $('#dim_height2').val();
                    var dim_height3 = $('#dim_height3').val();
                    var dim_length_avg = $('#dim_length_avg').val();
                    var dim_width_avg = $('#dim_width_avg').val();
                    var dim_height_avg = $('#dim_height_avg').val();
                    break;
                } else {
                    var chk_dim = "";
                    var dim_length1 = "";
                    var dim_length2 = "";
                    var dim_length3 = "";
                    var dim_width1 = "";
                    var dim_width2 = "";
                    var dim_width3 = "";
                    var dim_height1 = "";
                    var dim_height2 = "";
                    var dim_height3 = "";
                    var dim_length_avg = "";
                    var dim_width_avg = "";
                    var dim_height_avg = "";
                }
            }

            //MOISTURE CONTENT
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "MOI") {
                    if (document.getElementById('chk_moi').checked) {
                        var chk_moi = "1";
                    } else {
                        var chk_moi = "0";
                    }
                    var moc1_1 = $('#moc1_1').val();
                    var moc1_2 = $('#moc1_2').val();
                    var moc1_3 = $('#moc1_3').val();
                    var moc1_4 = $('#moc1_4').val();
                    var moc2_1 = $('#moc2_1').val();
                    var moc2_2 = $('#moc2_2').val();
                    var moc2_3 = $('#moc2_3').val();
                    var moc2_4 = $('#moc2_4').val();
                    var moc3_1 = $('#moc3_1').val();
                    var moc3_2 = $('#moc3_2').val();
                    var moc3_3 = $('#moc3_3').val();
                    var moc3_4 = $('#moc3_4').val();
                    var avg_moc = $('#avg_moc').val();
                    break;
                } else {
                    var chk_moi = "";
                    var moc1_1 = "";
                    var moc1_2 = "";
                    var moc1_3 = "";
                    var moc1_4 = "";
                    var moc2_1 = "";
                    var moc2_2 = "";
                    var moc2_3 = "";
                    var moc2_4 = "";
                    var moc3_1 = "";
                    var moc3_2 = "";
                    var moc3_3 = "";
                    var moc3_4 = "";
                    var avg_moc = "";
                }
            }

            var idEdit = $('#idEdit').val();

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_spg=' + chk_spg + '&w2_1=' + w2_1 + '&w2_2=' + w2_2 + '&w2_3=' + w2_3 + '&w1_1=' + w1_1 + '&w1_2=' + w1_2 + '&w1_3=' + w1_3 + '&w4_1=' + w4_1 + '&w4_2=' + w4_2 + '&w4_3=' + w4_3 + '&w3_1=' + w3_1 + '&w3_2=' + w3_2 + '&w3_3=' + w3_3 + '&spg_1=' + spg_1 + '&spg_2=' + spg_2 + '&spg_3=' + spg_3 + '&avg_spg=' + avg_spg + '&chk_por=' + chk_por + '&a1=' + a1 + '&a2=' + a2 + '&a3=' + a3 + '&b1=' + b1 + '&b2=' + b2 + '&b3=' + b3 + '&c1=' + c1 + '&c2=' + c2 + '&c3=' + c3 + '&asg1=' + asg1 + '&asg2=' + asg2 + '&asg3=' + asg3 + '&avg_asg=' + avg_asg + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&avg_wtr=' + avg_wtr + '&por1=' + por1 + '&por2=' + por2 + '&por3=' + por3 + '&avg_por=' + avg_por + '&tspg1=' + tspg1 + '&tspg2=' + tspg2 + '&tspg3=' + tspg3 + '&avg_tspg=' + avg_tspg + '&tpor1=' + tpor1 + '&tpor2=' + tpor2 + '&tpor3=' + tpor3 + '&avg_tpor=' + avg_tpor + '&chk_com=' + chk_com + '&con1=' + con1 + '&con2=' + con2 + '&con3=' + con3 + '&con4=' + con4 + '&con5=' + con5 + '&con6=' + con6 + '&con7=' + con7 + '&con8=' + con8 + '&con9=' + con9 + '&con10=' + con10 + '&con11=' + con11 + '&con12=' + con12 + '&con13=' + con13 + '&con14=' + con14 + '&con15=' + con15 + '&con16=' + con16 + '&con17=' + con17 + '&con18=' + con18 + '&con19=' + con19 + '&con20=' + con20 + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&len4=' + len4 + '&len5=' + len5 + '&len6=' + len6 + '&len7=' + len7 + '&len8=' + len8 + '&len9=' + len9 + '&len10=' + len10 + '&len11=' + len11 + '&len12=' + len12 + '&len13=' + len13 + '&len14=' + len14 + '&len15=' + len15 + '&len16=' + len16 + '&len17=' + len17 + '&len18=' + len18 + '&len19=' + len19 + '&len20=' + len20 + '&h1=' + h1 + '&h2=' + h2 + '&h3=' + h3 + '&h4=' + h4 + '&h5=' + h5 + '&h6=' + h6 + '&h7=' + h7 + '&h8=' + h8 + '&h9=' + h9 + '&h10=' + h10 + '&h11=' + h11 + '&h12=' + h12 + '&h13=' + h13 + '&h14=' + h14 + '&h15=' + h15 + '&h16=' + h16 + '&h17=' + h17 + '&h18=' + h18 + '&h19=' + h19 + '&h20=' + h20 + '&w1=' + w1 + '&w2=' + w2 + '&w3=' + w3 + '&w4=' + w4 + '&w5=' + w5 + '&w6=' + w6 + '&w7=' + w7 + '&w8=' + w8 + '&w9=' + w9 + '&w10=' + w10 + '&w11=' + w11 + '&w12=' + w12 + '&w13=' + w13 + '&w14=' + w14 + '&w15=' + w15 + '&w16=' + w16 + '&w17=' + w17 + '&w18=' + w18 + '&w19=' + w19 + '&w20=' + w20 + '&ratio1=' + ratio1 + '&ratio2=' + ratio2 + '&ratio3=' + ratio3 + '&ratio4=' + ratio4 + '&ratio5=' + ratio5 + '&ratio6=' + ratio6 + '&ratio7=' + ratio7 + '&ratio8=' + ratio8 + '&ratio9=' + ratio9 + '&ratio10=' + ratio10 + '&ratio11=' + ratio11 + '&ratio12=' + ratio12 + '&ratio13=' + ratio13 + '&ratio14=' + ratio14 + '&ratio15=' + ratio15 + '&ratio16=' + ratio16 + '&ratio17=' + ratio17 + '&ratio18=' + ratio18 + '&ratio19=' + ratio19 + '&ratio20=' + ratio20 + '&area1=' + area1 + '&area2=' + area2 + '&area3=' + area3 + '&area4=' + area4 + '&area5=' + area5 + '&area6=' + area6 + '&area7=' + area7 + '&area8=' + area8 + '&area9=' + area9 + '&area10=' + area10 + '&area11=' + area11 + '&area12=' + area12 + '&area13=' + area13 + '&area14=' + area14 + '&area15=' + area15 + '&area16=' + area16 + '&area17=' + area17 + '&area18=' + area18 + '&area19=' + area19 + '&area20=' + area20 + '&load1=' + load1 + '&load2=' + load2 + '&load3=' + load3 + '&load4=' + load4 + '&load5=' + load5 + '&load6=' + load6 + '&load7=' + load7 + '&load8=' + load8 + '&load9=' + load9 + '&load10=' + load10 + '&load11=' + load11 + '&load12=' + load12 + '&load13=' + load13 + '&load14=' + load14 + '&load15=' + load15 + '&load16=' + load16 + '&load17=' + load17 + '&load18=' + load18 + '&load19=' + load19 + '&load20=' + load20 + '&com1=' + com1 + '&com2=' + com2 + '&com3=' + com3 + '&com4=' + com4 + '&com5=' + com5 + '&com6=' + com6 + '&com7=' + com7 + '&com8=' + com8 + '&com9=' + com9 + '&com10=' + com10 + '&com11=' + com11 + '&com12=' + com12 + '&com13=' + com13 + '&com14=' + com14 + '&com15=' + com15 + '&com16=' + com16 + '&com17=' + com17 + '&com18=' + com18 + '&com19=' + com19 + '&com20=' + com20 + '&avg_com1=' + avg_com1 + '&avg_com2=' + avg_com2 + '&avg_com3=' + avg_com3 + '&avg_com4=' + avg_com4 + '&chk_tra=' + chk_tra + '&tcon1=' + tcon1 + '&tcon2=' + tcon2 + '&tcon3=' + tcon3 + '&tcon4=' + tcon4 + '&tcon5=' + tcon5 + '&tcon6=' + tcon6 + '&tcon7=' + tcon7 + '&tcon8=' + tcon8 + '&tcon9=' + tcon9 + '&tcon10=' + tcon10 + '&tl1=' + tl1 + '&tl2=' + tl2 + '&tl3=' + tl3 + '&tl4=' + tl4 + '&tl5=' + tl5 + '&tl6=' + tl6 + '&tl7=' + tl7 + '&tl8=' + tl8 + '&tl9=' + tl9 + '&tl10=' + tl10 + '&tb1=' + tb1 + '&tb2=' + tb2 + '&tb3=' + tb3 + '&tb4=' + tb4 + '&tb5=' + tb5 + '&tb6=' + tb6 + '&tb7=' + tb7 + '&tb8=' + tb8 + '&tb9=' + tb9 + '&tb10=' + tb10 + '&ta1=' + ta1 + '&ta2=' + ta2 + '&ta3=' + ta3 + '&ta4=' + ta4 + '&ta5=' + ta5 + '&ta6=' + ta6 + '&ta7=' + ta7 + '&ta8=' + ta8 + '&ta9=' + ta9 + '&ta10=' + ta10 + '&cb1=' + cb1 + '&cb2=' + cb2 + '&cb3=' + cb3 + '&cb4=' + cb4 + '&cb5=' + cb5 + '&cb6=' + cb6 + '&cb7=' + cb7 + '&cb8=' + cb8 + '&cb9=' + cb9 + '&cb10=' + cb10 + '&tra1=' + tra1 + '&tra2=' + tra2 + '&tra3=' + tra3 + '&tra4=' + tra4 + '&tra5=' + tra5 + '&tra6=' + tra6 + '&tra7=' + tra7 + '&tra8=' + tra8 + '&tra9=' + tra9 + '&tra10=' + tra10 + '&avg_tra1=' + avg_tra1 + '&avg_tra2=' + avg_tra2 + '&chk_ten=' + chk_ten + '&scon1=' + scon1 + '&scon2=' + scon2 + '&scon3=' + scon3 + '&scon4=' + scon4 + '&scon5=' + scon5 + '&scon6=' + scon6 + '&scon7=' + scon7 + '&scon8=' + scon8 + '&scon9=' + scon9 + '&scon10=' + scon10 + '&sd1=' + sd1 + '&sd2=' + sd2 + '&sd3=' + sd3 + '&sd4=' + sd4 + '&sd5=' + sd5 + '&sd6=' + sd6 + '&sd7=' + sd7 + '&sd8=' + sd8 + '&sd9=' + sd9 + '&sd10=' + sd10 + '&sl1=' + sl1 + '&sl2=' + sl2 + '&sl3=' + sl3 + '&sl4=' + sl4 + '&sl5=' + sl5 + '&sl6=' + sl6 + '&sl7=' + sl7 + '&sl8=' + sl8 + '&sl9=' + sl9 + '&sl10=' + sl10 + '&sload1=' + sload1 + '&sload2=' + sload2 + '&sload3=' + sload3 + '&sload4=' + sload4 + '&sload5=' + sload5 + '&sload6=' + sload6 + '&sload7=' + sload7 + '&sload8=' + sload8 + '&sload9=' + sload9 + '&sload10=' + sload10 + '&ten1=' + ten1 + '&ten2=' + ten2 + '&ten3=' + ten3 + '&ten4=' + ten4 + '&ten5=' + ten5 + '&ten6=' + ten6 + '&ten7=' + ten7 + '&ten8=' + ten8 + '&ten9=' + ten9 + '&ten10=' + ten10 + '&avg_ten1=' + avg_ten1 + '&avg_ten2=' + avg_ten2 + '&chk_hrd=' + chk_hrd + '&hardness=' + hardness + '&chk_dim=' + chk_dim + '&dim_length1=' + dim_length1 + '&dim_length2=' + dim_length2 + '&dim_length3=' + dim_length3 + '&dim_width1=' + dim_width1 + '&dim_width2=' + dim_width2 + '&dim_width3=' + dim_width3 + '&dim_height1=' + dim_height1 + '&dim_height2=' + dim_height2 + '&dim_height3=' + dim_height3 + '&dim_length_avg=' + dim_length_avg + '&dim_width_avg=' + dim_width_avg + '&dim_height_avg=' + dim_height_avg + '&chk_moi=' + chk_moi + '&moc1_1=' + moc1_1 + '&moc1_2=' + moc1_2 + '&moc1_3=' + moc1_3 + '&moc1_4=' + moc1_4 + '&moc2_1=' + moc2_1 + '&moc2_2=' + moc2_2 + '&moc2_3=' + moc2_3 + '&moc2_4=' + moc2_4 + '&moc3_1=' + moc3_1 + '&moc3_2=' + moc3_2 + '&moc3_3=' + moc3_3 + '&moc3_4=' + moc3_4 + '&avg_moc=' + avg_moc+ '&amend_date=' + amend_date;

        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_granite_stone.php',
            data: billData,
            dataType: 'JSON',
            success: function(msg) {
                $('#btn_save').hide();
                getGlazedTiles();
                var report_no = $('#report_no').val();
                var job_no = $('#job_no').val();
                var lab_no = $('#lab_no').val();
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
            url: '<?php echo $base_url; ?>save_granite_stone.php',
            data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
            success: function(data) {
                $('#idEdit').val(data.id);

                var idEdit = $('#idEdit').val();
                $('#report_no').val(data.report_no);
                $('#job_no').val(data.job_no);
                $('#lab_no').val(data.lab_no);
                $('#ulr').val(data.ulr);
                $('#amend_date').val(data.amend_date);
                $('#tiles_brand').val(data.tiles_brand);

                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //SPECIFIC GRAVITY
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "spg") {
                        var chk_spg = data.chk_spg;
                        if (chk_spg == "1") {
                            $('#txtspg').css("background-color", "var(--success)");
                            $("#chk_spg").prop("checked", true);
                        } else {
                            $('#txtspg').css("background-color", "white");
                            $("#chk_spg").prop("checked", false);
                        }
                        $('#w2_1').val(data.w2_1);
                        $('#w2_2').val(data.w2_2);
                        $('#w2_3').val(data.w2_3);
                        $('#w1_1').val(data.w1_1);
                        $('#w1_2').val(data.w1_2);
                        $('#w1_3').val(data.w1_3);
                        $('#w4_1').val(data.w4_1);
                        $('#w4_2').val(data.w4_2);
                        $('#w4_3').val(data.w4_3);
                        $('#w3_1').val(data.w3_1);
                        $('#w3_2').val(data.w3_2);
                        $('#w3_3').val(data.w3_3);
                        $('#spg_1').val(data.spg_1);
                        $('#spg_2').val(data.spg_2);
                        $('#spg_3').val(data.spg_3);
                        $('#avg_spg').val(data.avg_spg);
                        break;
                    }
                }

                //WATER ABSORPTION, APPARENT SPECIFIC GRAVITY AND POROSITY
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "wtr") {
                        var chk_por = data.chk_por;
                        if (chk_por == "1") {
                            $('#txtpor').css("background-color", "var(--success)");
                            $("#chk_por").prop("checked", true);
                        } else {
                            $('#txtpor').css("background-color", "white");
                            $("#chk_por").prop("checked", false);
                        }
                        $('#a1').val(data.a1);
                        $('#a2').val(data.a2);
                        $('#a3').val(data.a3);
                        $('#b1').val(data.b1);
                        $('#b2').val(data.b2);
                        $('#b3').val(data.b3);
                        $('#c1').val(data.c1);
                        $('#c2').val(data.c2);
                        $('#c3').val(data.c3);
                        $('#asg1').val(data.asg1);
                        $('#asg2').val(data.asg2);
                        $('#asg3').val(data.asg3);
                        $('#avg_asg').val(data.avg_asg);
                        $('#wtr1').val(data.wtr1);
                        $('#wtr2').val(data.wtr2);
                        $('#wtr3').val(data.wtr3);
                        $('#avg_wtr').val(data.avg_wtr);
                        $('#por1').val(data.por1);
                        $('#por2').val(data.por2);
                        $('#por3').val(data.por3);
                        $('#avg_por').val(data.avg_por);
                        $('#tspg1').val(data.tspg1);
                        $('#tspg2').val(data.tspg2);
                        $('#tspg3').val(data.tspg3);
                        $('#avg_tspg').val(data.avg_tspg);
                        $('#tpor1').val(data.tpor1);
                        $('#tpor2').val(data.tpor2);
                        $('#tpor3').val(data.tpor3);
                        $('#avg_tpor').val(data.avg_tpor);
                        break;
                    }
                }

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
                        $('#con1').val(data.con1);
                        $('#con2').val(data.con2);
                        $('#con3').val(data.con3);
                        $('#con4').val(data.con4);
                        $('#con5').val(data.con5);
                        $('#con6').val(data.con6);
                        $('#con7').val(data.con7);
                        $('#con8').val(data.con8);
                        $('#con9').val(data.con9);
                        $('#con10').val(data.con10);
                        $('#con11').val(data.con11);
                        $('#con12').val(data.con12);
                        $('#con13').val(data.con13);
                        $('#con14').val(data.con14);
                        $('#con15').val(data.con15);
                        $('#con16').val(data.con16);
                        $('#con17').val(data.con17);
                        $('#con18').val(data.con18);
                        $('#con19').val(data.con19);
                        $('#con20').val(data.con20);
                        $('#len1').val(data.len1);
                        $('#len2').val(data.len2);
                        $('#len3').val(data.len3);
                        $('#len4').val(data.len4);
                        $('#len5').val(data.len5);
                        $('#len6').val(data.len6);
                        $('#len7').val(data.len7);
                        $('#len8').val(data.len8);
                        $('#len9').val(data.len9);
                        $('#len10').val(data.len10);
                        $('#len11').val(data.len11);
                        $('#len12').val(data.len12);
                        $('#len13').val(data.len13);
                        $('#len14').val(data.len14);
                        $('#len15').val(data.len15);
                        $('#len16').val(data.len16);
                        $('#len17').val(data.len17);
                        $('#len18').val(data.len18);
                        $('#len19').val(data.len19);
                        $('#len20').val(data.len20);
                        $('#h1').val(data.h1);
                        $('#h2').val(data.h2);
                        $('#h3').val(data.h3);
                        $('#h4').val(data.h4);
                        $('#h5').val(data.h5);
                        $('#h6').val(data.h6);
                        $('#h7').val(data.h7);
                        $('#h8').val(data.h8);
                        $('#h9').val(data.h9);
                        $('#h10').val(data.h10);
                        $('#h11').val(data.h11);
                        $('#h12').val(data.h12);
                        $('#h13').val(data.h13);
                        $('#h14').val(data.h14);
                        $('#h15').val(data.h15);
                        $('#h16').val(data.h16);
                        $('#h17').val(data.h17);
                        $('#h18').val(data.h18);
                        $('#h19').val(data.h19);
                        $('#h20').val(data.h20);
                        $('#w1').val(data.w1);
                        $('#w2').val(data.w2);
                        $('#w3').val(data.w3);
                        $('#w4').val(data.w4);
                        $('#w5').val(data.w5);
                        $('#w6').val(data.w6);
                        $('#w7').val(data.w7);
                        $('#w8').val(data.w8);
                        $('#w9').val(data.w9);
                        $('#w10').val(data.w10);
                        $('#w11').val(data.w11);
                        $('#w12').val(data.w12);
                        $('#w13').val(data.w13);
                        $('#w14').val(data.w14);
                        $('#w15').val(data.w15);
                        $('#w16').val(data.w16);
                        $('#w17').val(data.w17);
                        $('#w18').val(data.w18);
                        $('#w19').val(data.w19);
                        $('#w20').val(data.w20);
                        $('#ratio1').val(data.ratio1);
                        $('#ratio2').val(data.ratio2);
                        $('#ratio3').val(data.ratio3);
                        $('#ratio4').val(data.ratio4);
                        $('#ratio5').val(data.ratio5);
                        $('#ratio6').val(data.ratio6);
                        $('#ratio7').val(data.ratio7);
                        $('#ratio8').val(data.ratio8);
                        $('#ratio9').val(data.ratio9);
                        $('#ratio10').val(data.ratio10);
                        $('#ratio11').val(data.ratio11);
                        $('#ratio12').val(data.ratio12);
                        $('#ratio13').val(data.ratio13);
                        $('#ratio14').val(data.ratio14);
                        $('#ratio15').val(data.ratio15);
                        $('#ratio16').val(data.ratio16);
                        $('#ratio17').val(data.ratio17);
                        $('#ratio18').val(data.ratio18);
                        $('#ratio19').val(data.ratio19);
                        $('#ratio20').val(data.ratio20);
                        $('#area1').val(data.area1);
                        $('#area2').val(data.area2);
                        $('#area3').val(data.area3);
                        $('#area4').val(data.area4);
                        $('#area5').val(data.area5);
                        $('#area6').val(data.area6);
                        $('#area7').val(data.area7);
                        $('#area8').val(data.area8);
                        $('#area9').val(data.area9);
                        $('#area10').val(data.area10);
                        $('#area11').val(data.area11);
                        $('#area12').val(data.area12);
                        $('#area13').val(data.area13);
                        $('#area14').val(data.area14);
                        $('#area15').val(data.area15);
                        $('#area16').val(data.area16);
                        $('#area17').val(data.area17);
                        $('#area18').val(data.area18);
                        $('#area19').val(data.area19);
                        $('#area20').val(data.area20);
                        $('#load1').val(data.load1);
                        $('#load2').val(data.load2);
                        $('#load3').val(data.load3);
                        $('#load4').val(data.load4);
                        $('#load5').val(data.load5);
                        $('#load6').val(data.load6);
                        $('#load7').val(data.load7);
                        $('#load8').val(data.load8);
                        $('#load9').val(data.load9);
                        $('#load10').val(data.load10);
                        $('#load11').val(data.load11);
                        $('#load12').val(data.load12);
                        $('#load13').val(data.load13);
                        $('#load14').val(data.load14);
                        $('#load15').val(data.load15);
                        $('#load16').val(data.load16);
                        $('#load17').val(data.load17);
                        $('#load18').val(data.load18);
                        $('#load19').val(data.load19);
                        $('#load20').val(data.load20);
                        $('#com1').val(data.com1);
                        $('#com2').val(data.com2);
                        $('#com3').val(data.com3);
                        $('#com4').val(data.com4);
                        $('#com5').val(data.com5);
                        $('#com6').val(data.com6);
                        $('#com7').val(data.com7);
                        $('#com8').val(data.com8);
                        $('#com9').val(data.com9);
                        $('#com10').val(data.com10);
                        $('#com11').val(data.com11);
                        $('#com12').val(data.com12);
                        $('#com13').val(data.com13);
                        $('#com14').val(data.com14);
                        $('#com15').val(data.com15);
                        $('#com16').val(data.com16);
                        $('#com17').val(data.com17);
                        $('#com18').val(data.com18);
                        $('#com19').val(data.com19);
                        $('#com20').val(data.com20);
                        $('#avg_com1').val(data.avg_com1);
                        $('#avg_com2').val(data.avg_com2);
                        $('#avg_com3').val(data.avg_com3);
                        $('#avg_com4').val(data.avg_com4);
                        break;
                    }
                }

                //TRANSVERSE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "TRA") {
                        var chk_tra = data.chk_tra;
                        if (chk_tra == "1") {
                            $('#txttra').css("background-color", "var(--success)");
                            $("#chk_tra").prop("checked", true);
                        } else {
                            $('#txttra').css("background-color", "white");
                            $("#chk_tra").prop("checked", false);
                        }
                        $('#tcon1').val(data.tcon1);
                        $('#tcon2').val(data.tcon2);
                        $('#tcon3').val(data.tcon3);
                        $('#tcon4').val(data.tcon4);
                        $('#tcon5').val(data.tcon5);
                        $('#tcon6').val(data.tcon6);
                        $('#tcon7').val(data.tcon7);
                        $('#tcon8').val(data.tcon8);
                        $('#tcon9').val(data.tcon9);
                        $('#tcon10').val(data.tcon10);
                        $('#tl1').val(data.tl1);
                        $('#tl2').val(data.tl2);
                        $('#tl3').val(data.tl3);
                        $('#tl4').val(data.tl4);
                        $('#tl5').val(data.tl5);
                        $('#tl6').val(data.tl6);
                        $('#tl7').val(data.tl7);
                        $('#tl8').val(data.tl8);
                        $('#tl9').val(data.tl9);
                        $('#tl10').val(data.tl10);
                        $('#tb1').val(data.tb1);
                        $('#tb2').val(data.tb2);
                        $('#tb3').val(data.tb3);
                        $('#tb4').val(data.tb4);
                        $('#tb5').val(data.tb5);
                        $('#tb6').val(data.tb6);
                        $('#tb7').val(data.tb7);
                        $('#tb8').val(data.tb8);
                        $('#tb9').val(data.tb9);
                        $('#tb10').val(data.tb10);
                        $('#ta1').val(data.ta1);
                        $('#ta2').val(data.ta2);
                        $('#ta3').val(data.ta3);
                        $('#ta4').val(data.ta4);
                        $('#ta5').val(data.ta5);
                        $('#ta6').val(data.ta6);
                        $('#ta7').val(data.ta7);
                        $('#ta8').val(data.ta8);
                        $('#ta9').val(data.ta9);
                        $('#ta10').val(data.ta10);
                        $('#cb1').val(data.cb1);
                        $('#cb2').val(data.cb2);
                        $('#cb3').val(data.cb3);
                        $('#cb4').val(data.cb4);
                        $('#cb5').val(data.cb5);
                        $('#cb6').val(data.cb6);
                        $('#cb7').val(data.cb7);
                        $('#cb8').val(data.cb8);
                        $('#cb9').val(data.cb9);
                        $('#cb10').val(data.cb10);
                        $('#tra1').val(data.tra1);
                        $('#tra2').val(data.tra2);
                        $('#tra3').val(data.tra3);
                        $('#tra4').val(data.tra4);
                        $('#tra5').val(data.tra5);
                        $('#tra6').val(data.tra6);
                        $('#tra7').val(data.tra7);
                        $('#tra8').val(data.tra8);
                        $('#tra9').val(data.tra9);
                        $('#tra10').val(data.tra10);
                        $('#avg_tra1').val(data.avg_tra1);
                        $('#avg_tra2').val(data.avg_tra2);
                        break;
                    }
                }

                //TENSILE STRENGTH
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "tes") {
                        var chk_ten = data.chk_ten;
                        if (chk_ten == "1") {
                            $('#txtten').css("background-color", "var(--success)");
                            $("#chk_ten").prop("checked", true);
                        } else {
                            $('#txtten').css("background-color", "white");
                            $("#chk_ten").prop("checked", false);
                        }
                        $('#scon1').val(data.scon1);
                        $('#scon2').val(data.scon2);
                        $('#scon3').val(data.scon3);
                        $('#scon4').val(data.scon4);
                        $('#scon5').val(data.scon5);
                        $('#scon6').val(data.scon6);
                        $('#scon7').val(data.scon7);
                        $('#scon8').val(data.scon8);
                        $('#scon9').val(data.scon9);
                        $('#scon10').val(data.scon10);
                        $('#sd1').val(data.sd1);
                        $('#sd2').val(data.sd2);
                        $('#sd3').val(data.sd3);
                        $('#sd4').val(data.sd4);
                        $('#sd5').val(data.sd5);
                        $('#sd6').val(data.sd6);
                        $('#sd7').val(data.sd7);
                        $('#sd8').val(data.sd8);
                        $('#sd9').val(data.sd9);
                        $('#sd10').val(data.sd10);
                        $('#sl1').val(data.sl1);
                        $('#sl2').val(data.sl2);
                        $('#sl3').val(data.sl3);
                        $('#sl4').val(data.sl4);
                        $('#sl5').val(data.sl5);
                        $('#sl6').val(data.sl6);
                        $('#sl7').val(data.sl7);
                        $('#sl8').val(data.sl8);
                        $('#sl9').val(data.sl9);
                        $('#sl10').val(data.sl10);
                        $('#sload1').val(data.sload1);
                        $('#sload2').val(data.sload2);
                        $('#sload3').val(data.sload3);
                        $('#sload4').val(data.sload4);
                        $('#sload5').val(data.sload5);
                        $('#sload6').val(data.sload6);
                        $('#sload7').val(data.sload7);
                        $('#sload8').val(data.sload8);
                        $('#sload9').val(data.sload9);
                        $('#sload10').val(data.sload10);
                        $('#ten1').val(data.ten1);
                        $('#ten2').val(data.ten2);
                        $('#ten3').val(data.ten3);
                        $('#ten4').val(data.ten4);
                        $('#ten5').val(data.ten5);
                        $('#ten6').val(data.ten6);
                        $('#ten7').val(data.ten7);
                        $('#ten8').val(data.ten8);
                        $('#ten9').val(data.ten9);
                        $('#ten10').val(data.ten10);
                        $('#avg_ten1').val(data.avg_ten1);
                        $('#avg_ten2').val(data.avg_ten2);
                        break;
                    }
                }

                //HARDNESS
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "hrd") {
                        var chk_hrd = data.chk_hrd;
                        if (chk_hrd == "1") {
                            $('#txthrd').css("background-color", "var(--success)");
                            $("#chk_hrd").prop("checked", true);
                        } else {
                            $('#txthrd').css("background-color", "white");
                            $("#chk_hrd").prop("checked", false);
                        }

                        $('#hardness').val(data.hardness);
                        break;
                    }
                }

                //DIMENTIONS
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "DIM") {
                        var chk_dim = data.chk_dim;
                        if (chk_dim == "1") {
                            $('#txtdim').css("background-color", "var(--success)");
                            $("#chk_dim").prop("checked", true);
                        } else {
                            $('#txtdim').css("background-color", "white");
                            $("#chk_dim").prop("checked", false);
                        }
                        $('#dim_length1').val(data.dim_length1);
                        $('#dim_length2').val(data.dim_length2);
                        $('#dim_length3').val(data.dim_length3);
                        $('#dim_width1').val(data.dim_width1);
                        $('#dim_width2').val(data.dim_width2);
                        $('#dim_width3').val(data.dim_width3);
                        $('#dim_height1').val(data.dim_height1);
                        $('#dim_height2').val(data.dim_height2);
                        $('#dim_height3').val(data.dim_height3);
                        $('#dim_length_avg').val(data.dim_length_avg);
                        $('#dim_width_avg').val(data.dim_width_avg);
                        $('#dim_height_avg').val(data.dim_height_avg);
                        break;
                    }
                }

                //MOISTURE CONTENT
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "MOI") {
                        var chk_moi = data.chk_moi;
                        if (chk_moi == "1") {
                            $('#txtmoc').css("background-color", "var(--success)");
                            $("#chk_moi").prop("checked", true);
                        } else {
                            $('#txtmoc').css("background-color", "white");
                            $("#chk_moi").prop("checked", false);
                        }
                        $('#moc1_1').val(data.moc1_1);
                        $('#moc1_2').val(data.moc1_2);
                        $('#moc1_3').val(data.moc1_3);
                        $('#moc1_4').val(data.moc1_4);
                        $('#moc2_1').val(data.moc2_1);
                        $('#moc2_2').val(data.moc2_2);
                        $('#moc2_3').val(data.moc2_3);
                        $('#moc2_4').val(data.moc2_4);
                        $('#moc3_1').val(data.moc3_1);
                        $('#moc3_2').val(data.moc3_2);
                        $('#moc3_3').val(data.moc3_3);
                        $('#moc3_4').val(data.moc3_4);
                        $('#avg_moc').val(data.avg_moc);
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
</script>
