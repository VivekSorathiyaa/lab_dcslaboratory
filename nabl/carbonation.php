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
                        <h2 style="text-align:center;">CARBONATION TEST</h2>
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
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="chk_auto">TEMPERATURE :-</label>
                                        <input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control inputs" tabindex="4" id="temp" name="temp">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                                        $querys_job1 = "SELECT * FROM carbonation WHERE `is_deleted`='0' and lab_no='$lab_no'";
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
                                    // $val =  $_SESSION['isadmin'];
                                    // if ($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type'] == "direct_nabl" || $_SESSION['nabl_type'] == "direct_non_nabl") {
                                    ?>
                                        <!--div class="col-sm-2">
											<a target = '_blank' href="<?php echo $base_url; ?>print_report/report_carbonation.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>
										</div-->

                                    <?php// } ?>
                                    <div class="col-sm-2">
                                        <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_carbonation.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&ulr=<?php echo $_GET['ulr']; ?>" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>

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

                                    if ($r1['test_code'] == "crb") {

                                        $test_check .= "crb,";
                                ?>
                                        <div class="panel panel-default" id="crb">
                                            <div class="panel-heading" id="txtcrb">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                                        <h4 class="panel-title">
                                                            <b>CARBONATION TEST</b>
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
                                                                    <label for="chk_crb">1.</label>
                                                                    <input type="checkbox" class="visually-hidden" name="chk_crb" id="chk_crb" value="chk_crb"><br>
                                                                </div>
                                                                <label for="inputEmail3" class="col-sm-11 control-label label-right">CARBONATION TEST</label>
                                                            </div>
                                                        </div>
                                                        <!--div class="col-lg-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">Temperature :</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="crb_temp" name="crb_temp" >
											</div>
									</div>
								</div-->
                                                        <!--div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label label-right">CASTING DATE</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="caste_date1" name="caste_date1" >
											</div>
										</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label label-right">TESTING DATE :</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="test_date1" name="test_date1" >
											</div>
									</div>
								</div-->
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Points</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">1</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">2</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">3</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">4</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">5</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">6</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">7</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">8</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">9</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">10</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Concrete Elements</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_1" name="con_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_2" name="con_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_3" name="con_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_4" name="con_4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_5" name="con_5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_6" name="con_6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_7" name="con_7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_8" name="con_8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_9" name="con_9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="con_10" name="con_10">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Core Length ( mm )</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_1" name="len_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_2" name="len_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_3" name="len_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_4" name="len_4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_5" name="len_5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_6" name="len_6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_7" name="len_7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_8" name="len_8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_9" name="len_9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="len_10" name="len_10">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Avg Carbonation Depth,mm</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_1" name="acd_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_2" name="acd_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_3" name="acd_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_4" name="acd_4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_5" name="acd_5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_6" name="acd_6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_7" name="acd_7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_8" name="acd_8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_9" name="acd_9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="acd_10" name="acd_10">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="control-label">Average pH</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_1" name="aph_1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_2" name="aph_2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_3" name="aph_3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_4" name="aph_4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_5" name="aph_5">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_6" name="aph_6">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_7" name="aph_7">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_8" name="aph_8">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_9" name="aph_9">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="aph_10" name="aph_10">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
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
                                                $query = "select * from carbonation WHERE lab_no='$aa'  and `is_deleted`='0'";

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



        $('#chk_crb').change(function() {
            if (this.checked) {
                $('#txtcrb').css("background-color", "var(--success)");
            } else {
                $('#txtcrb').css("background-color", "white");
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
        function crb_auto() {
            $('#txtcrb').css("background-color", "var(--success)");

            $('#len_1').val(1);
            $('#len_2').val(1);
            $('#len_3').val(1);
            $('#len_4').val(1);
            $('#len_5').val(1);
            $('#len_6').val(1);
            $('#len_7').val(1);
            $('#len_8').val(1);
            $('#len_9').val(1);
            $('#len_10').val(1);
            $('#acd_1').val(1);
            $('#acd_2').val(1);
            $('#acd_3').val(1);
            $('#acd_4').val(1);
            $('#acd_5').val(1);
            $('#acd_6').val(1);
            $('#acd_7').val(1);
            $('#acd_8').val(1);
            $('#acd_9').val(1);
            $('#acd_10').val(1);
            $('#con_1').val(1);
            $('#con_2').val(1);
            $('#con_3').val(1);
            $('#con_4').val(1);
            $('#con_5').val(1);
            $('#con_6').val(1);
            $('#con_7').val(1);
            $('#con_8').val(1);
            $('#con_9').val(1);
            $('#con_10').val(1);
            $('#aph_1').val(1);
            $('#aph_2').val(1);
            $('#aph_3').val(1);
            $('#aph_4').val(1);
            $('#aph_5').val(1);
            $('#aph_6').val(1);
            $('#aph_7').val(1);
            $('#aph_8').val(1);
            $('#aph_9').val(1);
            $('#aph_10').val(1);
        }


        $('#chk_crb').change(function() {
            if (this.checked) {
                crb_auto();
            } else {
                $('#txtcrb').css("background-color", "white");
                $('#len_1').val(null);
                $('#len_2').val(null);
                $('#len_3').val(null);
                $('#len_4').val(null);
                $('#len_5').val(null);
                $('#len_6').val(null);
                $('#len_7').val(null);
                $('#len_8').val(null);
                $('#len_9').val(null);
                $('#len_10').val(null);
                $('#acd_1').val(null);
                $('#acd_2').val(null);
                $('#acd_3').val(null);
                $('#acd_4').val(null);
                $('#acd_5').val(null);
                $('#acd_6').val(null);
                $('#acd_7').val(null);
                $('#acd_8').val(null);
                $('#acd_9').val(null);
                $('#acd_10').val(null);
                $('#con_1').val(null);
                $('#con_2').val(null);
                $('#con_3').val(null);
                $('#con_4').val(null);
                $('#con_5').val(null);
                $('#con_6').val(null);
                $('#con_7').val(null);
                $('#con_8').val(null);
                $('#con_9').val(null);
                $('#con_10').val(null);
                $('#aph_1').val(null);
                $('#aph_2').val(null);
                $('#aph_3').val(null);
                $('#aph_4').val(null);
                $('#aph_5').val(null);
                $('#aph_6').val(null);
                $('#aph_7').val(null);
                $('#aph_8').val(null);
                $('#aph_9').val(null);
                $('#aph_10').val(null);
            }
        });

        $('#chk_auto').change(function() {
            if (this.checked) {
                //$('#txtabr').css("background-color","var(--success)"); 
                //$('#txtwtr').css("background-color","var(--success)"); 


                var temp = $('#test_list').val();
                var temp = $('#temp').val();
                var aa = temp.split(",");
                //crb
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "crb") {
                        $('#txtcrb').css("background-color", "var(--success)");
                        $("#chk_crb").prop("checked", true);
                        crb_auto();
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
            url: '<?php echo $base_url; ?>save_carbonation.php',
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

            //crb
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "crb") {
                    if (document.getElementById('chk_crb').checked) {
                        var chk_crb = "1";
                    } else {
                        var chk_crb = "0";
                    }

                    var len_1 = $('#len_1').val();
                    var len_2 = $('#len_2').val();
                    var len_3 = $('#len_3').val();
                    var len_4 = $('#len_4').val();
                    var len_5 = $('#len_5').val();
                    var len_6 = $('#len_6').val();
                    var len_7 = $('#len_7').val();
                    var len_8 = $('#len_8').val();
                    var len_9 = $('#len_9').val();
                    var len_10 = $('#len_10').val();
                    var acd_1 = $('#acd_1').val();
                    var acd_2 = $('#acd_2').val();
                    var acd_3 = $('#acd_3').val();
                    var acd_4 = $('#acd_4').val();
                    var acd_5 = $('#acd_5').val();
                    var acd_6 = $('#acd_6').val();
                    var acd_7 = $('#acd_7').val();
                    var acd_8 = $('#acd_8').val();
                    var acd_9 = $('#acd_9').val();
                    var acd_10 = $('#acd_10').val();
                    var con_1 = $('#con_1').val();
                    var con_2 = $('#con_2').val();
                    var con_3 = $('#con_3').val();
                    var con_4 = $('#con_4').val();
                    var con_5 = $('#con_5').val();
                    var con_6 = $('#con_6').val();
                    var con_7 = $('#con_7').val();
                    var con_8 = $('#con_8').val();
                    var con_9 = $('#con_9').val();
                    var con_10 = $('#con_10').val();
                    var aph_1 = $('#aph_1').val();
                    var aph_2 = $('#aph_2').val();
                    var aph_3 = $('#aph_3').val();
                    var aph_4 = $('#aph_4').val();
                    var aph_5 = $('#aph_5').val();
                    var aph_6 = $('#aph_6').val();
                    var aph_7 = $('#aph_7').val();
                    var aph_8 = $('#aph_8').val();
                    var aph_9 = $('#aph_9').val();
                    var aph_10 = $('#aph_10').val();
                    var temp = $('#temp').val();


                    break;
                } else {

                    var len_1 = "0";
                    var len_2 = "0";
                    var len_3 = "0";
                    var len_4 = "0";
                    var len_5 = "0";
                    var len_6 = "0";
                    var len_7 = "0";
                    var len_8 = "0";
                    var len_9 = "0";
                    var len_10 = "0";
                    var acd_1 = "0";
                    var acd_2 = "0";
                    var acd_3 = "0";
                    var acd_4 = "0";
                    var acd_5 = "0";
                    var acd_6 = "0";
                    var acd_7 = "0";
                    var acd_8 = "0";
                    var acd_9 = "0";
                    var acd_10 = "0";
                    var temp = "0";
                    var con_1 = "0";
                    var con_2 = "0";
                    var con_3 = "0";
                    var con_4 = "0";
                    var con_5 = "0";
                    var con_6 = "0";
                    var con_7 = "0";
                    var con_8 = "0";
                    var con_9 = "0";
                    var con_10 = "0";
                    var aph_1 = "0";
                    var aph_2 = "0";
                    var aph_3 = "0";
                    var aph_4 = "0";
                    var aph_5 = "0";
                    var aph_6 = "0";
                    var aph_7 = "0";
                    var aph_8 = "0";
                    var aph_9 = "0";
                    var aph_10 = "0";

                }

            }






            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&chk_crb=' + chk_crb + '&len_1=' + len_1 + '&len_2=' + len_2 + '&len_3=' + len_3 + '&len_4=' + len_4 + '&len_5=' + len_5 + '&len_6=' + len_6 + '&len_7=' + len_7 + '&len_8=' + len_8 + '&len_9=' + len_9 + '&len_10=' + len_10 + '&acd_1=' + acd_1 + '&acd_2=' + acd_2 + '&acd_3=' + acd_3 + '&acd_4=' + acd_4 + '&acd_5=' + acd_5 + '&acd_6=' + acd_6 + '&acd_7=' + acd_7 + '&acd_8=' + acd_8 + '&acd_9=' + acd_9 + '&acd_10=' + acd_10 + '&aph_1=' + aph_1 + '&aph_2=' + aph_2 + '&aph_3=' + aph_3 + '&aph_4=' + aph_4 + '&aph_5=' + aph_5 + '&aph_6=' + aph_6 + '&aph_7=' + aph_7 + '&aph_8=' + aph_8 + '&aph_9=' + aph_9 + '&aph_10=' + aph_10 + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&con_4=' + con_4 + '&con_5=' + con_5 + '&con_6=' + con_6 + '&con_7=' + con_7 + '&con_8=' + con_8 + '&con_9=' + con_9 + '&con_10=' + con_10 + '&temp=' + temp + '&ulr=' + ulr+ '&amend_date=' + amend_date;

        } else if (type == 'edit') {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();

            var temp = $('#test_list').val();
            var room_temp = $('#room_temp').val();
            var aa = temp.split(",");

            //crb
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "crb") {
                    if (document.getElementById('chk_crb').checked) {
                        var chk_crb = "1";
                    } else {
                        var chk_crb = "0";
                    }

                    var len_1 = $('#len_1').val();
                    var len_2 = $('#len_2').val();
                    var len_3 = $('#len_3').val();
                    var len_4 = $('#len_4').val();
                    var len_5 = $('#len_5').val();
                    var len_6 = $('#len_6').val();
                    var len_7 = $('#len_7').val();
                    var len_8 = $('#len_8').val();
                    var len_9 = $('#len_9').val();
                    var len_10 = $('#len_10').val();
                    var acd_1 = $('#acd_1').val();
                    var acd_2 = $('#acd_2').val();
                    var acd_3 = $('#acd_3').val();
                    var acd_4 = $('#acd_4').val();
                    var acd_5 = $('#acd_5').val();
                    var acd_6 = $('#acd_6').val();
                    var acd_7 = $('#acd_7').val();
                    var acd_8 = $('#acd_8').val();
                    var acd_9 = $('#acd_9').val();
                    var acd_10 = $('#acd_10').val();
                    var con_1 = $('#con_1').val();
                    var con_2 = $('#con_2').val();
                    var con_3 = $('#con_3').val();
                    var con_4 = $('#con_4').val();
                    var con_5 = $('#con_5').val();
                    var con_6 = $('#con_6').val();
                    var con_7 = $('#con_7').val();
                    var con_8 = $('#con_8').val();
                    var con_9 = $('#con_9').val();
                    var con_10 = $('#con_10').val();
                    var aph_1 = $('#aph_1').val();
                    var aph_2 = $('#aph_2').val();
                    var aph_3 = $('#aph_3').val();
                    var aph_4 = $('#aph_4').val();
                    var aph_5 = $('#aph_5').val();
                    var aph_6 = $('#aph_6').val();
                    var aph_7 = $('#aph_7').val();
                    var aph_8 = $('#aph_8').val();
                    var aph_9 = $('#aph_9').val();
                    var aph_10 = $('#aph_10').val();
                    var temp = $('#temp').val();


                    break;
                } else {

                    var len_1 = "0";
                    var len_2 = "0";
                    var len_3 = "0";
                    var len_4 = "0";
                    var len_5 = "0";
                    var len_6 = "0";
                    var len_7 = "0";
                    var len_8 = "0";
                    var len_9 = "0";
                    var len_10 = "0";
                    var acd_1 = "0";
                    var acd_2 = "0";
                    var acd_3 = "0";
                    var acd_4 = "0";
                    var acd_5 = "0";
                    var acd_6 = "0";
                    var acd_7 = "0";
                    var acd_8 = "0";
                    var acd_9 = "0";
                    var acd_10 = "0";
                    var temp = "0";
                    var con_1 = "0";
                    var con_2 = "0";
                    var con_3 = "0";
                    var con_4 = "0";
                    var con_5 = "0";
                    var con_6 = "0";
                    var con_7 = "0";
                    var con_8 = "0";
                    var con_9 = "0";
                    var con_10 = "0";
                    var aph_1 = "0";
                    var aph_2 = "0";
                    var aph_3 = "0";
                    var aph_4 = "0";
                    var aph_5 = "0";
                    var aph_6 = "0";
                    var aph_7 = "0";
                    var aph_8 = "0";
                    var aph_9 = "0";
                    var aph_10 = "0";

                }

            }





            var idEdit = $('#idEdit').val();

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&len_1=' + len_1 + '&len_2=' + len_2 + '&len_3=' + len_3 + '&len_4=' + len_4 + '&len_5=' + len_5 + '&len_6=' + len_6 + '&len_7=' + len_7 + '&len_8=' + len_8 + '&len_9=' + len_9 + '&len_10=' + len_10 + '&acd_1=' + acd_1 + '&acd_2=' + acd_2 + '&acd_3=' + acd_3 + '&acd_4=' + acd_4 + '&acd_5=' + acd_5 + '&acd_6=' + acd_6 + '&acd_7=' + acd_7 + '&acd_8=' + acd_8 + '&acd_9=' + acd_9 + '&acd_10=' + acd_10 + '&aph_1=' + aph_1 + '&aph_2=' + aph_2 + '&aph_3=' + aph_3 + '&aph_4=' + aph_4 + '&aph_5=' + aph_5 + '&aph_6=' + aph_6 + '&aph_7=' + aph_7 + '&aph_8=' + aph_8 + '&aph_9=' + aph_9 + '&aph_10=' + aph_10 + '&con_1=' + con_1 + '&con_2=' + con_2 + '&con_3=' + con_3 + '&con_4=' + con_4 + '&con_5=' + con_5 + '&con_6=' + con_6 + '&con_7=' + con_7 + '&con_8=' + con_8 + '&con_9=' + con_9 + '&con_10=' + con_10 + '&temp=' + temp + '&ulr=' + ulr+ '&amend_date=' + amend_date;
        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_carbonation.php',
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
            url: '<?php echo $base_url; ?>save_carbonation.php',
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
                //crb
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "crb") {

                        var chk_crb = data.chk_crb;
                        if (chk_crb == "1") {
                            $('#txtcrb').css("background-color", "var(--success)");
                            $("#chk_crb").prop("checked", true);


                        } else {
                            $('#txtcrb').css("background-color", "white");
                            $("#chk_crb").prop("checked", false);

                        }
                        $('#len_1').val(data.len_1);
                        $('#len_2').val(data.len_2);
                        $('#len_3').val(data.len_3);
                        $('#len_4').val(data.len_4);
                        $('#len_5').val(data.len_5);
                        $('#len_6').val(data.len_6);
                        $('#len_7').val(data.len_7);
                        $('#len_8').val(data.len_8);
                        $('#len_9').val(data.len_9);
                        $('#len_10').val(data.len_10);
                        $('#acd_1').val(data.acd_1);
                        $('#acd_2').val(data.acd_2);
                        $('#acd_3').val(data.acd_3);
                        $('#acd_4').val(data.acd_4);
                        $('#acd_5').val(data.acd_5);
                        $('#acd_6').val(data.acd_6);
                        $('#acd_7').val(data.acd_7);
                        $('#acd_8').val(data.acd_8);
                        $('#acd_9').val(data.acd_9);
                        $('#acd_10').val(data.acd_10);
                        $('#con_1').val(data.con_1);
                        $('#con_2').val(data.con_2);
                        $('#con_3').val(data.con_3);
                        $('#con_4').val(data.con_4);
                        $('#con_5').val(data.con_5);
                        $('#con_6').val(data.con_6);
                        $('#con_7').val(data.con_7);
                        $('#con_8').val(data.con_8);
                        $('#con_9').val(data.con_9);
                        $('#con_10').val(data.con_10);
                        $('#aph_1').val(data.aph_1);
                        $('#aph_2').val(data.aph_2);
                        $('#aph_3').val(data.aph_3);
                        $('#aph_4').val(data.aph_4);
                        $('#aph_5').val(data.aph_5);
                        $('#aph_6').val(data.aph_6);
                        $('#aph_7').val(data.aph_7);
                        $('#aph_8').val(data.aph_8);
                        $('#aph_9').val(data.aph_9);
                        $('#aph_10').val(data.aph_10);
                        $('#temp').val(data.temp);



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