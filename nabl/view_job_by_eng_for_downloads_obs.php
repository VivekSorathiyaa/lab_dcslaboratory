<?php include("header.php"); ?>

<?php
if ($_SESSION['name'] == "") {
?>
    <script>
        window.location.href = "<?php echo $base_url; ?>index.php";
    </script>
<?php
}

$txt_trf_no = $_GET["trf_no"];
$txt_jobs = $_GET["job_no"];
$temporary_trf_no = $_GET["temporary_trf_no"];

// update job table by report no and job no AND ALSO ENG LIGHT STATUS
$up_job = "update job set `report_received`=1,`eng_light_status`=1 where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs'";
mysqli_query($conn, $up_job);

// update final_material_assign_master table if report not available for this report no
$sel_final_material = "select * from final_material_assign_master where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$temporary_trf_no' AND `eng_light_status`!='2'";
$query_final_material = mysqli_query($conn, $sel_final_material);

if (!mysqli_num_rows($query_final_material) > 0) {
    $up_job = "update job set `eng_light_status`=2 where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$temporary_trf_no' AND `job_number`='$txt_jobs'";
    mysqli_query($conn, $up_job);
}
?>

<style>
    #billing label {
        display: block;
        text-align: center;
        line-height: 150%;
        font-size: .85em;
    }
    .action-container {
        padding: 10px 0;
    }
    .action-container .row {
        margin: 0;
        display: flex;
        align-items: center;
    }
    .action-container .form-group {
        margin-bottom: 0;
    }
    .action-container select {
        width: 100%;
    }
    .action-buttons {
        margin-bottom: 10px;
    }
</style>

<div class="content-wrapper" style="margin-left: 0px !important;">
    <section class="content view-job-by-eng" style="padding: 0px; margin-right: auto; margin-left: auto; padding-left: 0px; padding-right: 0px;">
        <?php include("menu.php") ?>
        <div class="row m-0">
            <h1 style="text-align:center;">
                View Job
            </h1>
        </div>
        <div class="row m-0">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <br>
                        <div class="row m-0">
                            <div class="col-sm-12">
                                <label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" value="<?php echo $_GET['job_no']; ?>" id="txt_trf_no" name="txt_trf_no">
                                <input type="hidden" class="form-control" value="<?php echo $_GET['temporary_trf_no']; ?>" id="temporary_trf_no" name="temporary_trf_no">
                                <input type="text" class="form-control" value="<?php echo $_GET['trf_no']; ?>" id="txt_job_no" name="txt_job_no" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="panel-group">
                            <div class="box box-info-inner">
                                <div class="box-body">
                                    <div class="table-responsive" id="display_data">
                                        <table class="table table-bordered no-margin">
                                            <thead>
                                                <tr>
                                                    <th>material</th>
                                                    <th>Job No</th>
                                                    <th>Test List</th>
                                                    <th>Start Date</th>
                                                    <th>Days</th>
                                                    <th>End Date</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counts = 0;
                                                $show_go_button_once = 0;
                                                $get_jobs = "select * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `morr`='r'";
                                                $query_job = mysqli_query($conn, $get_jobs);
                                                $job_row = mysqli_fetch_array($query_job);
                                                $getting_start_dates = date('d-m-Y', strtotime($job_row['sample_rec_date']));

                                                if ($job_row["morr"] == "r") {
                                                    $up_final = "update final_material_assign_master set `light_status`='2' where `trf_no`='$_GET[trf_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]'";
                                                    $query_up_final = mysqli_query($conn, $up_final);
                                                }

                                                $sel_span_tested_by = "select * from span_material_assign where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `tested_by`='$_SESSION[u_id]'";
                                                $query_span_tested_by = mysqli_query($conn, $sel_span_tested_by);

                                                $array_labs_nos = array();
                                                if (mysqli_num_rows($query_span_tested_by) > 0) {
                                                    while ($one_span_tested_by = mysqli_fetch_array($query_span_tested_by)) {
                                                        if (!in_array($one_span_tested_by["lab_no"], $array_labs_nos)) {
                                                            array_push($array_labs_nos, $one_span_tested_by["lab_no"]);
                                                        }
                                                    }
                                                }
                                                $count_of_materials = count($array_labs_nos);
                                                $material_count = 1;
                                                foreach ($array_labs_nos as $one_labs_nos) {
                                                    $query = "select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' AND `lab_no`='$one_labs_nos' AND `temporary_trf_no`='$_GET[temporary_trf_no]' ORDER BY final_material_id DESC";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $sel_eng = "Select * from job_for_engineer where `lab_no`='$row[lab_no]'";
                                                        $query_eng = mysqli_query($conn, $sel_eng);
                                                        if (mysqli_num_rows($query_eng) > 0) {
                                                            $is_est = 1;
                                                            $get_eng = mysqli_fetch_array($query_eng);
                                                        } else {
                                                            $is_est = 0;
                                                        }

                                                        if ($is_est == 1 && $get_eng["report_sent_to_qm"] == 1) {
                                                            $set_status = "no";
                                                        } elseif ($is_est == 1 && $get_eng["report_sent_to_qm"] == 0) {
                                                            $set_status = "yes";
                                                        } else {
                                                            $set_status = "yes";
                                                        }

                                                        $sel_cate = "select * from material_category where `material_cat_id`=" . $row['material_category'];
                                                        $result_cat = mysqli_query($conn, $sel_cate);
                                                        $row_cat = mysqli_fetch_array($result_cat);

                                                        $sel_mat = "select * from material where `id`=" . $row['material_id'];
                                                        $result_mat = mysqli_query($conn, $sel_mat);
                                                        $row_mat = mysqli_fetch_array($result_mat);
                                                        $mat_prefix = $row_mat["mt_prefix"];
                                                        $table_names = $row_mat["table_name"];
                                                        $print_back = $row_mat["print_back"];
														$upload=$row['upload_obs'];

                                                        // Check if report is saved (aligned with reference file)
                                                        $tbl = $row_mat["table_name"];
                                                        $query_check = "SELECT * FROM $tbl WHERE lab_no='$row[lab_no]'";
                                                        $result_check = mysqli_query($conn, $query_check);
                                                        $query_ex = "SELECT * FROM excel_upload_from_report WHERE lab_no='$row[lab_no]' AND job_no='$row[job_no]' AND `table_name`='$tbl'";
                                                        $result_ex = mysqli_query($conn, $query_ex);
                                                        $report_saved = mysqli_num_rows($result_check) > 0 || mysqli_num_rows($result_ex) > 0;
                                                        $button_class = $report_saved ? 'btn-warning' : 'btn-primary';
                                                        $submit_disabled = $report_saved ? '' : 'disabled';
                                                        ?>
                                                        <tr>
                                                            <td><b><?php
                                                                    if (
                                                                        strpos($row_mat["mt_name"], "WMM (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - I MIX (M4-1)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - II MIX (M4-2)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - III MIX (M4-1)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - IV MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - V MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - VI MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - I MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - III MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - II MIX (M5)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - I MIX (M4-2)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - II MIX (M4-1)") !== false ||
                                                                        strpos($row_mat["mt_name"], "GSB - III MIX (M4-2)") !== false ||
                                                                        strpos($row_mat["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "BUSG - CA") !== false ||
                                                                        strpos($row_mat["mt_name"], "BUSG - KA") !== false ||
                                                                        strpos($row_mat["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
                                                                        strpos($row_mat["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
                                                                    ) {
                                                                        $ansss = $row_mat["mt_name"];
                                                                    } else {
                                                                        if (
                                                                            strpos($row_mat["mt_name"], "WMM") !== false ||
                                                                            strpos($row_mat["mt_name"], "WBM") !== false ||
                                                                            strpos($row_mat["mt_name"], "RCC") !== false ||
                                                                            strpos($row_mat["mt_name"], "GSB") !== false ||
                                                                            strpos($row_mat["mt_name"], "BM") !== false ||
                                                                            strpos($row_mat["mt_name"], "BC") !== false ||
                                                                            strpos($row_mat["mt_name"], "SDBC") !== false ||
                                                                            strpos($row_mat["mt_name"], "MSS") !== false ||
                                                                            strpos($row_mat["mt_name"], "DBM") !== false ||
                                                                            strpos($row_mat["mt_name"], "BUSG") !== false
                                                                        ) {
                                                                            $ans = substr($row_mat["mt_name"], strpos($row_mat["mt_name"], "(") + 1);
                                                                            $explodeing = explode(")", $ans);
                                                                            $second = $explodeing[0];
                                                                            $ansss = $second;
                                                                        } else {
                                                                            if (strpos($row_mat["mt_name"], "C.C.Cube") !== false || strpos($row_mat["mt_name"], "Flexural Strength of Concrete Beam") !== false) {
                                                                                $ansss = "Concrete";
                                                                            } else {
                                                                                if (strpos($row_mat["mt_name"], "FLY ASH BRICK") !== false || strpos($row_mat["mt_name"], "BURNT CLAY BRICK") !== false) {
                                                                                    $ansss = "Brick";
                                                                                } else {
                                                                                    $ansss = $row_mat["mt_name"];
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    echo $ansss;
                                                                    ?></b>
                                                                <input type="hidden" value="<?php echo $row['material_id']; ?>" name="material_id_hidden" id="material_<?php echo $material_count; ?>">
                                                            </td>
                                                            <td>
                                                                <?php echo $row['job_no']; ?><br>
                                                                <input type="hidden" name="labno" class="form-control" id="labno_<?php echo $material_count; ?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
                                                            </td>
                                                            <td style="width:250px;">
                                                                <?php
                                                                $test_query = "select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' ORDER BY material_assign_id DESC";
                                                                $result_for_test = mysqli_query($conn, $test_query);
                                                                $print_test = "";
                                                                $array_day = array();
                                                                while ($rows = mysqli_fetch_array($result_for_test)) {
                                                                    $sel_test = "select * from test_master where `test_id`=" . $rows['test'];
                                                                    $result_test = mysqli_query($conn, $sel_test);
                                                                    $row_test = mysqli_fetch_array($result_test);
                                                                    echo $row_test['test_name'] . " , ";
                                                                    $print_test .= $row_test['test_name'] . " , ";
                                                                    $result_expected_date = $rows['expected_date'];
                                                                    $casting_date_of_span = $rows['casting_date'];
                                                                    $span_days = $rows['cc_day'];
                                                                    if (!in_array($row_test["per_day_limit"], $array_day)) {
                                                                        array_push($array_day, $row_test["per_day_limit"]);
                                                                    }
                                                                }
                                                                if ($mat_prefix == "CC") {
                                                                    $starting_date = $casting_date_of_span;
                                                                    $span_daying = $span_days;
                                                                    $ending_date = date('Y-m-d', strtotime($starting_date . ' + ' . $span_daying . ' days'));
                                                                } else {
                                                                    $starting_date = $job_row['sample_rec_date'];
                                                                    $span_daying = max($array_day);
                                                                    $sdate = $job_row['sample_rec_date'];
                                                                    $edate = $row['expected_date'];
                                                                    $date_diff = abs(strtotime($edate) - strtotime($sdate));
                                                                    $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                                    $ending_date = date('Y-m-d', strtotime($starting_date . ' + ' . $days . ' days'));
                                                                }
                                                                ?>
                                                                <input type="hidden" name="testlist" class="form-control" id="testlist_<?php echo $material_count; ?>" value="<?php echo $print_test; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="startdate" class="form-control startdate_class" id="startdate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                                    echo date('d-m-Y', strtotime($get_eng['start_date']));
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo date('d-m-Y', strtotime($starting_date));
                                                                                                                                                                                                } ?>" style="width: 120px;">
                                                            </td>
                                                            <input type="hidden" name="expdate" class="form-control expdate_class" id="expdate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($get_eng['expected_date']));
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                        } ?>" style="width: 120px;">
                                                            <?php
                                                            $sdate = $job_row['sample_rec_date'];
                                                            $edate = $row['expected_date'];
                                                            $date_diff = abs(strtotime($edate) - strtotime($sdate));
                                                            $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                            if ($span_daying != "") {
                                                                $days_to_put = $span_daying;
                                                            } else {
                                                                $days_to_put = $days;
                                                            }
                                                            ?>
                                                            <td>
                                                                <?php
                                                                if ($row['is_sample'] == "1") {
                                                                    $set_bolding = 'width: 50px;font-weight: bold;';
                                                                } else {
                                                                    $set_bolding = 'width: 50px;';
                                                                }
                                                                ?>
                                                                <input disabled type="text" name="day" class="form-control day" id="day_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                            echo $get_eng['days'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $days_to_put;
                                                                                                                                                                        } ?>" style="<?php echo $set_bolding; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="enddate" class="form-control enddate_class" id="enddate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($get_eng['end_date']));
                                                                                                                                                                                            $var_na_name = date('d-m-Y', strtotime($get_eng['end_date']));
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                            $var_na_name = date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                        } ?>" style="width: 120px;">
                                                                <?php if (date('l', strtotime($var_na_name)) == "Sunday") {
                                                                    $colored = "#F70000";
                                                                } else {
                                                                    $colored = "#004500";
                                                                } ?>
                                                                <span style="color:<?php echo $colored; ?>;font-weight:bold;font-size:17px;"><?php echo date('l', strtotime($var_na_name)); ?></span>
                                                            </td>
                                                            <td style="color:red;">
                                                                <?php echo $row["notes_by_tm"]; ?>
                                                            </td>
                                                            <td>
                                                                <div class="action-container">
                                                                    <div class="action-buttons">
                                                                        <?php if($row["obs_by_eng"]=="0"){ ?>
                                                                            <input type="file" class="btn-primary form-control uplodings" id="<?php echo str_replace("/","_",$row['lab_no']).'|'.$row['final_material_id'];?>" style="width: 145px;font-size: 18px;" multiple >
                                                                        <?php }else{ ?>
                                                                        <a href="upload_wriiten_obs/<?php echo $row['upload_obs'];?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT"><span class="fa fa-eye"></span></a>
                                                                        <a href="javascript:void(0);" class="btn btn-danger delete_scaned" data-id="<?php echo str_replace("/","_",$row['lab_no']).'|'.$row['final_material_id'].'|'.$row['upload_obs'];?>" title="DELETE UPLOADED FILE" ><span class="fa fa-trash"></span></a>
																		<?php } ?>
                                                                        <?php if($row["sent_eng_to_tm_upload"]=="0"){ ?>
                                                                            <a href="edit_reports_by_qm.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr . $row['ulr_no'] . "F"; ?>&&table_names=<?php echo $table_names; ?>&&mt_prefix=<?php echo $mat_prefix; ?>&&filename=<?php echo $row_mat["filename"]; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Edit</a>
                                                                            <a href="<?php echo $base_url . $row_mat["filename"]; ?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr . $row['ulr_no'] . "F"; ?>&&temporary_trf_no=<?php echo $row['temporary_trf_no']; ?>" class="btn <?php echo $button_class; ?> btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Report</a>
                                                                        
																		<?php if($row["obs_by_eng"]=="1"){ ?>
																			<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_q_manager <?php echo $submit_disabled; ?>" data-id="<?php echo $row['lab_no']; ?>" data-trf="<?php echo $row['trf_no']; ?>" data-job="<?php echo $row['job_no']; ?>" data-temp-trf="<?php echo $row['temporary_trf_no']; ?>" title="Report Send To Quality Manager" <?php echo $submit_disabled ? 'disabled' : ''; ?>><span class="glyphicon glyphicon-question-list"></span> Submit</a>
																		<?php }?>
																		
                                                                        <?php } else { ?>
                                                                            <span style="color:green;font-weight:bold;">Sent To Tm For Verify</span>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label for="reported_by_<?php echo $material_count; ?>">Verify By<span class="mede_class">*</span>:</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
																							<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
																<!--<option value="">Select Quality Manager</option>-->
																								<?php 
																								$sel_staff = "SELECT * FROM multi_login WHERE `staff_isadmin` IN (5, 6)";
																								$query_staff=mysqli_query($conn,$sel_staff);
																								if(mysqli_num_rows($query_staff) > 0){
																								while($rowss=mysqli_fetch_array($query_staff)){?>
																								<option value="<?php echo $rowss['id']?>"><?php echo $rowss['staff_fullname']?></option>
																								
																								<?php }}?>
																							</select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $sel_eng = "Select * from job_for_engineer where `lab_no`='$row[lab_no]'";
                                                        $query_eng = mysqli_query($conn, $sel_eng);
                                                        $start_date = date('Y-m-d', strtotime($job_row['sample_rec_date']));
                                                        $end_date = date('Y-m-d', strtotime($row['expected_date']));
                                                        $dayses = $days;
                                                        $get_lab_id = $row['lab_no'];
                                                        $get_material_id = $row['material_id'];
                                                        $get_test_id = $print_test;
                                                        $get_trf_no = $_GET['trf_no'];
                                                        $get_job_no = $_GET['job_no'];
                                                        $get_expdate = date('Y-m-d', strtotime($row['expected_date']));
                                                        if (mysqli_num_rows($query_eng) < 1) {
                                                            $ending_date = date('Y-m-d', strtotime($starting_date . ' + ' . $days_to_put . ' days'));
                                                            if ($ending_date == "1970-01-01") {
                                                                $ending_date = date('Y-m-d', strtotime($starting_date . ' + ' . $days_to_put . ' days'));
                                                            }
                                                            $insert_eng = "insert into job_for_engineer (`material_id`,`trf_no`,`job_no`,`lab_no`,`test_list`,`start_date`,`end_date`,`issue_date`,`days`,`expected_date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`) values('$get_material_id','$get_trf_no','$get_job_no','$get_lab_id','$get_test_id','$starting_date','$ending_date','$ending_date','$days_to_put','$ending_date','$_SESSION[name]','0000-00-00','','0000-00-00')";
                                                            $result_insert_eng = mysqli_query($conn, $insert_eng);
                                                        }
                                                    }
                                                    $material_count++;
                                                }
                                                $select_job_for_eng = "select * from job_for_engineer where `sent_eng_to_tm_upload`=0 AND `trf_no` = '$get_trf_no'";
                                                $query_job_for_eng = mysqli_query($conn, $select_job_for_eng);
                                                if (mysqli_num_rows($query_job_for_eng) == 0) {
                                                    $upd_jobs = "update job set `all_upload_come`='1' where `trf_no`='$get_trf_no'";
                                                    mysqli_query($conn, $upd_jobs);
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section>
</div>

<?php include("footer.php"); ?>

<script>
    $(document).ready(function() {
        $(".all_chk").click(function() {
            $(".chk_mate_class").prop('checked', $(this).prop('checked'));
        });
    });

    var count_of_materials = '<?php echo $count_of_materials; ?>';
    var getting_start_dates = '<?php echo $getting_start_dates; ?>';

    var i;
    for (i = 1; i <= count_of_materials; i++) {
        var set_start_ids = "#startdate_" + i;
        var set_end_ids = "#enddate_" + i;
        $(set_start_ids).datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            startDate: "'" + getting_start_dates + "'"
        });
        var get_start_dates = $(set_start_ids).val();
        $(set_end_ids).datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            startDate: "'" + get_start_dates + "'"
        });
    }

    $('.expdate_class').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $(document).on('change', '.startdate_class', function() {
        var get_start_date = $(this).val();
        var get_id = $(this).attr('id');
        var only_id = get_id.split("_");
        var set_id = "#enddate_" + only_id[1];
        var get_end_date = $(set_id).val();
        var a = moment(get_start_date, 'D/M/YYYY');
        var b = moment(get_end_date, 'D/M/YYYY');
        var diffDays = b.diff(a, 'days');
        var set_day = "#day_" + only_id[1];
        $(set_day).val(diffDays);
        var labs_id = "#labno_" + only_id[1];
        var get_lab_id = $(labs_id).val();
        var material_id = "#material_" + only_id[1];
        var get_material_id = $(material_id).val();
        var test_id = "#testlist_" + only_id[1];
        var get_test_id = $(test_id).val();
        var expdate = "#expdate_" + only_id[1];
        var get_expdate = $(expdate).val();
        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate);
        location.reload();
    });

    $(document).on('change', '.enddate_class', function() {
        var get_end_date = $(this).val();
        var get_id = $(this).attr('id');
        var only_id = get_id.split("_");
        var set_id = "#startdate_" + only_id[1];
        var get_start_date = $(set_id).val();
        var a = moment(get_start_date, 'D/M/YYYY');
        var b = moment(get_end_date, 'D/M/YYYY');
        var diffDays = b.diff(a, 'days');
        var set_day = "#day_" + only_id[1];
        $(set_day).val(diffDays);
        var labs_id = "#labno_" + only_id[1];
        var get_lab_id = $(labs_id).val();
        var material_id = "#material_" + only_id[1];
        var get_material_id = $(material_id).val();
        var test_id = "#testlist_" + only_id[1];
        var get_test_id = $(test_id).val();
        var expdate = "#expdate_" + only_id[1];
        var get_expdate = $(expdate).val();
        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate);
        location.reload();
    });

    $(document).on('change', '.day', function() {
        var diffDays = parseInt($(this).val());
        var get_id = $(this).attr('id');
        var only_id = get_id.split("_");
        var set_id = "#startdate_" + only_id[1];
        var get_start_date = $(set_id).val();
        var datePieces = get_start_date.split("-");
        var preFinalDate = [datePieces[2], datePieces[1], datePieces[0]];
        var someDate = new Date(preFinalDate.join("-"));
        someDate.setDate(someDate.getDate() + diffDays);
        var dd = someDate.getDate();
        var mm = someDate.getMonth() + 1;
        var y = someDate.getFullYear();
        var get_end_date = dd + '-' + mm + '-' + y;
        var set_end_date = "#enddate_" + only_id[1];
        $(set_end_date).val(get_end_date);
        var labs_id = "#labno_" + only_id[1];
        var get_lab_id = $(labs_id).val();
        var material_id = "#material_" + only_id[1];
        var get_material_id = $(material_id).val();
        var test_id = "#testlist_" + only_id[1];
        var get_test_id = $(test_id).val();
        var expdate = "#expdate_" + only_id[1];
        var get_expdate = $(expdate).val();
        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate);
    });

    function update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate) {
        var billData = '&action_type=update_engineer' + '&get_start_date=' + get_start_date + '&get_end_date=' + get_end_date + '&diffDays=' + diffDays + '&get_lab_id=' + get_lab_id + '&get_material_id=' + get_material_id + '&get_test_id=' + get_test_id + '&txt_trf_no=' + txt_trf_no + '&get_job_no=' + get_job_no + '&get_expdate=' + get_expdate;
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_span_engineer.php',
            data: billData,
            success: function(msg) {
                if (msg == "SORRY.. Something Went Wrong") {
                    alert(msg);
                }
            }
        });
    }

    $(document).on("click", ".report_send_to_q_manager", function() {
        var clicked_id = $(this).attr("data-id");
        var txt_trf_no = $(this).attr("data-trf");
        var job_no = $(this).attr("data-job");
        var temporary_trf_no = $(this).attr("data-temp-trf");
        var reported_by_review = $('#reported_by').val();
        
        if (reported_by_review=="") {
            alert("Please select a user in Reported By field");
            return false;
        }

        $.confirm({
            title: "warning",
            content: "Are You Sure To Send This Report For Verification?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>save_span_engineer.php',
                        data: 'action_type=send_to_qlty_manager&clicked_id=' + clicked_id + '&txt_trf_no=' + txt_trf_no + '&temporary_trf_no=' + temporary_trf_no + '&reported_by_review=' + reported_by_review,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>view_job_by_eng_for_downloads_obs.php";
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        });
    });

    $(document).on("click", ".all_report_send", function() {
        var arr_chk = [];
        $('input.chk_mate_class:checkbox:checked').each(function() {
            arr_chk.push($(this).val());
        });
        if (arr_chk && arr_chk.length == 0) {
            alert("Please Check Atlist One Checkbox");
            return false;
        }
        var txt_trf_no = $("#txt_trf_no").val();
        var job_no = $("#txt_job_no").val();
        var temporary_trf_no = $("#temporary_trf_no").val();
        var reported_by_review = $('#reported_by').val();
        
        if (!reported_by_review) {
            alert("Please select a user in Reported By field");
            return false;
        }

        $.confirm({
            title: "warning",
            content: "Are You Sure To Send All Report To Bill?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>save_span_engineer.php',
                        data: 'action_type=all_report_send&clicked_id=' + arr_chk + '&txt_trf_no=' + txt_trf_no + '&reported_by_review=' + reported_by_review + '&temporary_trf_no=' + temporary_trf_no,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>view_job_by_eng.php?trf_no=" + txt_trf_no + '&&job_no=' + job_no + '&&temporary_trf_no=' + temporary_trf_no;
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        });
    });

    $(document).on("click", ".job_send_to_complete", function() {
        var clicked_id = $(this).attr("data-id");
        var explode_report_job_no = clicked_id.split("|");
        var reports_no = explode_report_job_no[0];
        var jobs_no = explode_report_job_no[1];
        var reported_by_review = $('#reported_by').val();
        
        if (!reported_by_review) {
            alert("Please select a user in Reported By field");
            return false;
        }

        $.confirm({
            title: "warning",
            content: "Are You Sure To Sent To Bill This Job ?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>save_span_engineer.php',
                        data: 'action_type=job_send_to_complete&clicked_id=' + clicked_id + '&reported_by_review=' + reported_by_review,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>span_set_rate_final_bill.php?report_no=" + reports_no + "&&job_no=" + jobs_no;
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        });
    });

    $(document).on("click", ".job_send_to_qm", function() {
        var clicked_id = $(this).attr("data-id");
        var reported_by_review =$('#reported_by').val();
        
        if (!reported_by_review) {
            alert("Please select a user in Reported By field");
            return false;
        }

        $.confirm({
            title: "warning",
            content: "Are You Sure To Send This Job To Quality Manager?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>save_span_engineer.php',
                        data: 'action_type=send_job_to_qlty_manager&clicked_id=' + clicked_id + '&reported_by_review=' + reported_by_review,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>due_job_listing_for_engineer.php";
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        });
    });

    $(document).on("change", ".uplodings", function () {
        var fd = new FormData();
        var files = $(this)[0].files[0];
        var idss = $(this).attr("id");
        var acb = $(this).val();
        if (acb == "") {
            alert("Please Select File First");
            return false;
        }
        var totalfiles = $(this)[0].files.length;
        for (var index = 0; index < totalfiles; index++) {
            var sizes = $(this)[0].files[index].size;
            if (sizes < 15728640) {
                fd.append("file[]", $(this)[0].files[index]);
            }
        }
        fd.append('action_type', "upload_obs");
        fd.append('idss', idss);
        $.ajax({
            url: 'save_scanners.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload();
            },
        });
    });

    $(document).on("click", ".delete_scaned", function () {
        var clicked_id = $(this).attr("data-id");
        $.confirm({
            title: "warning",
            content: "Are You Sure To Delete This Uploaded Document?",
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $base_url; ?>save_scanners.php',
                        data: 'action_type=delete_eng_obs&clicked_id=' + clicked_id,
                        success: function(html) {
                            location.reload();
                        }
                    });
                },
                cancel: function () {
                    return;
                }
            }
        });
    });
</script>