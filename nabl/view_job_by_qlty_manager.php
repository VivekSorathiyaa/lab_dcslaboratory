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
// code for get test by report no and job no

$select_test_wise = "select * from test_wise_material_rate where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs' AND `temporary_trf_no`='$temporary_trf_no'";
$select_test_wise_query = mysqli_query($conn, $select_test_wise);

// get_estimate if available
$sel_estiamte = "select * from estimate_total_span where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs'";

$estiamte_query = mysqli_query($conn, $sel_estiamte);
if (mysqli_num_rows($estiamte_query) > 0) {

    $get_estimate = mysqli_fetch_array($estiamte_query);
    $get_rate_type = $get_estimate["rate_type"];
    $get_gst_type = $get_estimate["gst_type"];
    $get_c_gst_amt = $get_estimate["c_gst_amt"];
    $get_s_gst_amt = $get_estimate["s_gst_amt"];
    $get_grand_total = $get_estimate["grand_total"];
    $get_total_amount = $get_estimate["total_amt"];
    $get_total_amt_in_word = $get_estimate["total_amt_in_word"];
} else {
    $get_rate_type = "";
    $get_gst_type = "";
    $get_c_gst_amt = "";
    $get_s_gst_amt = "";
    $get_grand_total = "";
    $get_total_amount = "";
    $get_total_amt_in_word = "";
}

// update job table by report no and lab no
$up_job = "update job set `report_received`=1 where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs' AND `temporary_trf_no`='$temporary_trf_no'";

//$up_job="update job set `report_received`=1,`job_owner_eng_and_qm`=2 where `report_no`='$txt_report' AND `job_number`='$txt_jobs'";
mysqli_query($conn, $up_job);

// update engineer light 
$up_eng_light = "update job_for_engineer set `eng_light_status`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs' AND `eng_light_status`='0'";
mysqli_query($conn, $up_eng_light);
?>

<style>
    #billing label {
        display: block;
        text-align: center;
        line-height: 150%;
        font-size: .85em;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px !important;">


    <section class="content p-0 view-job-by-qlty-manager">
        <?php include("menu.php") ?>
        <div class="row">

            <h1 style="text-align:center;">
                View Reports
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
                            </div>

                            <div class="col-sm-6">
                                <label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $_GET['trf_no']; ?>" id="txt_trf_no" name="txt_trf_no" disabled>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $_GET['job_no']; ?>" id="txt_job_no" name="txt_job_no" disabled>
                                <input type="hidden" class="form-control" value="<?php echo $_GET['temporary_trf_no']; ?>" id="temporary_trf_no" name="temporary_trf_no" disabled>
                            </div>
                        </div>
                        <br>


                        <div class="panel-group view-job-by-qlty-box">
                            <div class="box box-info-inner">
                                <div class="box-body">
                                    <div class="table-responsive" id="display_data">
                                        <table class="table table-bordered no-margin">
                                            <thead>
                                                <tr>
                                                    <th>material</th>
                                                    <th> No</th>
                                                    <th>Test List</th>
                                                    <th>Start Date</th>
                                                    <th>Days</th>
                                                    <th>End Date</th>
                                                    <th>Issue Date</th>
                                                    <!--<th>Exp. Sub. Date</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $sel_static_ulr = "select  * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
                                                $query_static_ulr = mysqli_query($conn, $sel_static_ulr);
                                                $result_static_ulr = mysqli_fetch_array($query_static_ulr);
                                                $static_ulr = $result_static_ulr["ulr_no"];

                                                $get_jobs = "select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `morr`='r'";
                                                $query_job = mysqli_query($conn, $get_jobs);
                                                $job_row = mysqli_fetch_array($query_job);

                                                $query = "select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]' ORDER BY final_material_id DESC";
                                                $result = mysqli_query($conn, $query);
                                                $material_count = 1;
                                                while ($row = mysqli_fetch_array($result)) {

                                                    // get lab id to check record

                                                    $sel_eng = "Select * from job_for_engineer where `lab_no`='$row[lab_no]'";
                                                    $query_eng = mysqli_query($conn, $sel_eng);
                                                    if (mysqli_num_rows($query_eng) > 0) {
                                                        $is_est = 1;
                                                        $get_eng = mysqli_fetch_array($query_eng);
                                                    } else {
                                                        $is_est = 0;
                                                    }

                                                    if ($is_est == 1 && $get_eng["appoved_by_qm_to_print"] == "1") {
                                                        $set_status = "no";
                                                    }
                                                    if ($is_est == 1 && $get_eng["appoved_by_qm_to_print"] == "0") {
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
                                                    $table_names = $row_mat["table_name"];
                                                    $mat_prefix = $row_mat["mt_prefix"];
                                                    if ($set_status == "yes") {
                                                ?>
                                                        <tr>
                                                            <td><b>
                                                                    <?php
                                                                    //echo $row_mat["mt_name"];

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
                                                              <b>Report No:</b> <?php echo $row['report_no']; ?><br>
																 <b>Unique Identity No:</b> <?php echo $row['lab_no']; ?><br>
																 <b>Ulr No:</b> <?php echo $static_ulr.$row['ulr_no']."F"; ?>

                                                                <input type="hidden" name="labno" class="form-control" id="labno_<?php echo $material_count; ?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
                                                            </td>
                                                            <td style="width:250px;">
                                                                <?php
                                                                $test_query = "select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' ORDER BY material_assign_id DESC";
                                                                $result_for_test = mysqli_query($conn, $test_query);


                                                                $print_test = "";
                                                                $tested_by = "";
                                                                while ($rows = mysqli_fetch_array($result_for_test)) {


                                                                    $sel_test = "select * from test_master where `test_id`=" . $rows['test'];
                                                                    $result_test = mysqli_query($conn, $sel_test);
                                                                    $row_test = mysqli_fetch_array($result_test);

                                                                    echo $row_test['test_name'] . " , ";
                                                                    $print_test .= $row_test['test_name'] . " , ";

                                                                    $result_expected_date = $rows['expected_date'];
                                                                    $tested_by = $rows['tested_by'];

                                                                    $casting_date_of_span = $rows['casting_date'];
                                                                    $span_days = $rows['cc_day'];
                                                                }

                                                                if ($mat_prefix == "CC") {
                                                                    $starting_date = $casting_date_of_span;
                                                                    $span_daying = $span_days;
                                                                    $ending_date = date('Y-m-d', strtotime($starting_date . ' + ' . $span_daying . ' days'));
                                                                } else {
                                                                    $starting_date = $job_row['sample_rec_date'];
                                                                    $span_daying = "";
                                                                    $ending_date = $result_expected_date;
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


                                                            <!--<td></td>-->
                                                            <input type="hidden" name="expdate" class="form-control expdate_class" id="expdate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($get_eng['expected_date']));
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                        } ?>" style="width: 120px;">
                                                            </td>

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
                                                                <input type="text" name="day" class="form-control day" id="day_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                            echo $get_eng['days'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $days_to_put;
                                                                                                                                                                        } ?>" style="width: 50px;">
                                                            </td>

                                                            <td>
                                                                <input type="text" name="enddate" class="form-control enddate_class" id="enddate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($get_eng['end_date']));
                                                                                                                                                                                            $var_na_name = date('d-m-Y', strtotime($get_eng['end_date']));
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                            $var_na_name = date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                        } ?>" style="width: 100%;">
                                                                <?php if (date('l', strtotime($var_na_name)) == "Wednesday") {
                                                                    $colored = "#F70000";
                                                                } else {
                                                                    $colored = "#004500";
                                                                } ?>
                                                                <span style="color:<?php echo $colored; ?>;font-weight:bold;font-size:15px;display:block;text-align:center;margin-top:5px;"><?php echo date('l', strtotime($var_na_name)); ?></span>
                                                            </td>

                                                            <td>
                                                                <input type="text" name="issuedate" class="form-control issuedate_class" id="issuedate_<?php echo $material_count; ?>" value="<?php if ($is_est == 1) {
                                                                                                                                                                                                    echo date('d-m-Y', strtotime($get_eng['issue_date']));
                                                                                                                                                                                                    $var_na_name_is = date('d-m-Y', strtotime($get_eng['issue_date']));
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                                    $var_na_name_is = date('d-m-Y', strtotime($ending_date));
                                                                                                                                                                                                } ?>" style="width: 100%;">
                                                                <?php if (date('l', strtotime($var_na_name_is)) == "Wednesday") {
                                                                    $colored_i = "#F70000";
                                                                } else {
                                                                    $colored_i = "#004500";
                                                                } ?>
                                                                <span style="color:<?php echo $colored_i; ?>;font-weight:bold;font-size:15px;display:block;text-align:center;margin-top:5px;"><?php echo date('l', strtotime($var_na_name_is)); ?></span>
                                                            </td>

                                                            <td>
                                                                <a href="edit_reports_by_qm.php?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr . $row['ulr_no'] . "F"; ?>&&table_names=<?php echo $table_names; ?>&&mt_prefix=<?php echo $mat_prefix; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Edit</a>


                                                                <a href="<?php echo $base_url . $row_mat["filename"]; ?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr . $row['ulr_no'] . "F"; ?>" class="btn btn-warning btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>
                                                                <?php
                                                                $query11 = "select * from $table_names WHERE lab_no='$row[lab_no]' ";
                                                                $result12 = mysqli_query($conn, $query11);
                                                                $cnns_no_rows =  mysqli_num_rows($result12);
                                                                if ($cnns_no_rows > 0) { ?>
                                                                    <!--<a href="javascript:void(0);" class="btn btn-danger delete_one_report btn3d btn-lg" data-id="<?php echo $row['lab_no'] . '|' . $row['trf_no'] . "|" . $tested_by; ?>" title=""><span class="glyphicon glyphicon-question-ok"></span>Delete Report</a>-->
                                                                <?php
                                                                }

                                                                if ($get_eng["report_sent_to_qm"] == "1") {
                                                                ?>


                                                                    <?php
                                                                    //if scan document available in job

                                                                    $sel_jobs = "select * from job where`trf_no`='$row[trf_no]' AND `job_number`='$row[job_no]' AND `temporary_trf_no`='$row[temporary_trf_no]' AND `morr`='r'";
                                                                    $query_jobs = mysqli_query($conn, $sel_jobs);
																	
																	$query = "select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_no]' AND `trf_no`='$row[trf_no]' AND `temporary_trf_no`='$row[temporary_trf_no]' ORDER BY final_material_id DESC";
																	$result = mysqli_query($conn, $query);

                                                                    if (mysqli_num_rows($result) > 0) {

                                                                        $get_jobs = mysqli_fetch_array($result);
                                                                        if ($get_jobs['upload_obs'] != "") {
                                                                    ?>

                                                                            <!--<a href="<?php echo $base_url . "upload_wriiten_obs/" . $get_jobs['upload_obs'] ?>" class="btn btn-success  btn3d" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Download</a>-->
																			
																			<a href="upload_wriiten_obs/<?php echo  $get_jobs['upload_obs'];?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT"><span class="fa fa-eye"></span></a>

                                                                    <?php }
                                                                    } ?>

                                                                    <!--<a href="<?php //echo $base_url.$row_mat["filename"];
                                                                                    ?>?lab_no=<?php //echo $row['lab_no']; 
                                                                                                ?>&&job_no=<? php // echo $_GET['job_no']; 
                                                                                                            ?>&&report_no=<?php //echo $_GET['report_no']; 
                                                                                                                                                                    ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>-->
                                                                    &nbsp;
                                                                    <?php

                                                                    if ($get_eng["accepted_by_qm"] == 2) {

                                                                        $date_today = date("Y/m/d");
                                                                        $ender_dates = date('Y/m/d', strtotime($var_na_name));
                                                                        if ($ender_dates > $date_today) {
                                                                            $dis_date = "disabled";
                                                                        } else {

                                                                            $dis_date = "ff";
                                                                        }
                                                                    ?>
                                                                        <a href="javascript:void(0);" class="btn btn-light-primary btn-lg btn3d report_send_to_eng" data-id="<?php echo $row['lab_no'] . "|" . $tested_by ?>" title="Reward"><span class="glyphicon glyphicon-question-list"></span> Reward</a>

                                                                        <a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_accept <?php echo $dis_date; ?>" data-id="<?php echo $row['lab_no'].'|'.$var_na_name_is.'|'.$row['nabl_type'].'|'.$table_names; ?>" title="Report Send To Accept"><span class="glyphicon glyphicon-question-list"></span> Accept Report</a>
                                                                        <!--<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d report_send_to_eng" data-id="<?php //echo $row['lab_no'];
                                                                                                                                                                            ?>" title="Report Send To Engineer"><span class="glyphicon glyphicon-question-list"></span> Reward</a>-->
                                                                        <?php } else {
                                                                        if ($get_eng["appoved_by_qm_to_print"] == 0) {
                                                                        ?>
                                                                            <!-- <a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d report_send_to_print" data-id="<?php echo $row['lab_no']; ?>" title="Report Send To Accept"><span class="glyphicon glyphicon-question-list"></span>Send To Print</a> -->

                                                                <?php } else {
																	$sel_HA1 = "SELECT * FROM job WHERE `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs' AND `temporary_trf_no`='$temporary_trf_no'";
																								$query_HA1=mysqli_query($conn,$sel_HA1);
																								$row_HA1=mysqli_fetch_array($query_HA1);

																								$verify_HA1=$row_HA1['reported_by_authorize'];
																								$user_name = "select * from `multi_login` WHERE `id`='$verify_HA1'";
																								$result_for_select = mysqli_query($conn, $user_name);
																								$user = mysqli_fetch_array($result_for_select);
																								
																								$a_name = $user['staff_fullname'];
                                                                           echo '<span style="color:green;font-size: 18px;">Report Sent To ' . $a_name . '</span>';

                                                                        }
                                                                    }
                                                                } else {

                                                                    echo '<span style="color:#f39c12;font-size: 18px; margin: 0 0 0 10px;">Pending</span>';
                                                                }

                                                                ?>
<div class="row">
                                                                        <div class="col-md-3">
                                                                            <label for="reported_by_<?php echo $material_count; ?>">Authorized By<span class="mede_class">*</span>:</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
																							<select class="form-control " name="reported_by" id="reported_by" style="height:50px;">
																
																								<?php 
																								$sel_HA = "SELECT * FROM job WHERE `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs' AND `temporary_trf_no`='$temporary_trf_no'";
																								$query_HA=mysqli_query($conn,$sel_HA);
																								$row_HA=mysqli_fetch_array($query_HA);

																								$verify_HA=$row_HA['reported_by_review'];
																								$sel_staff = "SELECT * FROM multi_login WHERE `staff_isadmin` IN (5) and `id`!=$verify_HA";
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
                                                            </td>
                                                        </tr>

                                                <?php
                                                    }
                                                    $material_count++;

                                                    //on load insert record if not available

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
                                                    $temporary_trf_no = $_GET['temporary_trf_no'];
                                                    $get_expdate = date('Y-m-d', strtotime($row['expected_date']));

                                                    if (mysqli_num_rows($query_eng) < 1) {

                                                        $insert_eng = "insert into job_for_engineer (`material_id`,`trf_no`,`job_no`,`lab_no`,`test_list`,`start_date`,`end_date`,`issue_date`,`days`,`expected_date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`) values('$get_material_id','$get_trf_no','$get_job_no','$get_lab_id','$get_test_id','$starting_date','$ending_date','$ending_date','$days_to_put','$ending_date','$_SESSION[name]','0000-00-00','','0000-00-00')";

                                                        $result_insert_eng = mysqli_query($conn, $insert_eng);
                                                    }
                                                } ?>
                                          <!--   <tr>
                                                    <td colspan="8">&nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                    </td>
                                                    <td colspan="3">
                                                        <a href="javascript:void(0);" class="btn btn-danger delete_only_reports" data-id="<?php echo $get_trf_no.'|'.$temporary_trf_no; ?>" title=""><span class="glyphicon glyphicon-question-ok"></span> DELETE ALL REPORTS</a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $disabling = "";
                                                        $select_job_for_qm = "select `accepted_by_qm` from job_for_engineer where `accepted_by_qm`=0 AND `trf_no` ='$get_trf_no'";
                                                        $query_job_for_qm = mysqli_query($conn, $select_job_for_qm);
                                                        if (mysqli_num_rows($query_job_for_qm) > 0) {
                                                            $disabling = "disabled";
                                                        }
                                                        if ($job_row['accepted_by_qm'] == 0) {
                                                        ?>
                                                            <a href="javascript:void(0);" class="btn btn-success job_send_to_accept <?php echo $disabling; ?>" data-id="<?php echo $get_trf_no . "|" . $get_trf_no . "|" . $temporary_trf_no; ?>" title="Material Assign">ACCEPT JOB</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr> -->
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


    });

    $('.startdate_class').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    $('.enddate_class').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('.issuedate_class').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
    $('.expdate_class').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });

    //  start date change

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

        var issuedate = "#issuedate_" + only_id[1];
        var get_issuedate = $(issuedate).val();

        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();


        // perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate, get_issuedate);

    });

    //  end date change

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

        var issuedate = "#issuedate_" + only_id[1];

        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();

        $(issuedate).val(get_end_date);
        var get_issuedate = $(issuedate).val();


        // perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate, get_issuedate);
        location.reload();
    });

    $(document).on('change', '.issuedate_class', function() {

        var get_issuedate = $(this).val();

        var get_id = $(this).attr('id');
        var only_id = get_id.split("_");
        var set_id = "#startdate_" + only_id[1];
        var get_start_date = $(set_id).val();
        var set_end_id = "#enddate_" + only_id[1];
        var get_end_date = $(set_end_id).val();;

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

        if (get_issuedate < get_end_date) {
            alert("issue Date error...!");
            location.reload();
            return false;
        }
        update_issue_date(get_lab_id, get_issuedate);
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

        var issuedate = "#issuedate_" + only_id[1];
        $(issuedate).val(get_end_date);
        var get_issuedate = $(issuedate).val();

        var txt_trf_no = $("#txt_trf_no").val();
        var get_job_no = $("#txt_job_no").val();


        // perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
        update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate, get_issuedate);
        location.reload();
    });


    function update_table_job_for_engineer(get_start_date, get_end_date, diffDays, get_lab_id, get_material_id, get_test_id, txt_trf_no, get_job_no, get_expdate, get_issuedate) {

        var billData = '&action_type=update_engineer' + '&get_start_date=' + get_start_date + '&get_end_date=' + get_end_date + '&diffDays=' + diffDays + '&get_lab_id=' + get_lab_id + '&get_material_id=' + get_material_id + '&get_test_id=' + get_test_id + '&txt_trf_no=' + txt_trf_no + '&get_job_no=' + get_job_no + '&get_expdate=' + get_expdate + '&get_issuedate=' + get_issuedate;

        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_engineer.php',
            data: billData,
            success: function(msg) {

            }
        });

    }

    function update_issue_date(get_lab_id, get_issuedate) {

        var billData = '&action_type=update_issue_dates&get_issuedate=' + get_issuedate + '&get_lab_id=' + get_lab_id;

        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_engineer.php',
            data: billData,
            success: function(msg) {

            }
        });
    }
    //send report to accept by quality manager

    $(document).on("click", ".report_send_to_accept", function() {
        var clicked_id = $(this).attr("data-id");
        var txt_trf_no = $("#txt_trf_no").val();
        var job_no = $("#txt_job_no").val();
        var temporary_trf_no = $("#temporary_trf_no").val();
		var reported_by_authorize = $("#reported_by").val();
		

        $.confirm({
            title: "warning",
            content: "Are You Sure To Send This Report For Authorization?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_engineer.php',
                        data: 'action_type=report_send_to_accept&clicked_id=' + clicked_id + '&txt_trf_no=' + txt_trf_no + '&reported_by_authorize=' + reported_by_authorize,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>view_job_by_qlty_manager.php?trf_no=" + txt_trf_no + '&&job_no=' + job_no + '&&temporary_trf_no=' + temporary_trf_no;

                        }
                    });

                },
                cancel: function() {
                    return;
                }
            }
        })
    });

    $(document).on("click", ".report_send_to_eng", function() {
        var clicked_id = $(this).attr("data-id");
        var txt_trf_no = $("#txt_trf_no").val();
        var job_no = $("#txt_job_no").val();

        $.confirm({
            title: "warning",
            content: '' +
			'<form action="javascript:void(0);" class="formName">' +
			'<div class="form-group">' +
			'<label>Enter Remark:</label>' +
			'<textarea class="form-control" id="remark_text" rows="4" required></textarea>' +
			'</div>' +
			'</form>',
            buttons: {
                confirm: {
					text: 'Submit',
					btnClass: 'btn-blue',
					action: function () {
					var remark = this.$content.find('#remark_text').val();
                

					if (!remark) {
						$.alert('Please enter a remark.');
						return false;
					}
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_engineer.php',
                        data: 'action_type=report_send_to_eng&clicked_id=' + clicked_id + '&txt_trf_no=' + txt_trf_no + '&remark=' + remark,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>view_job_by_qlty_manager.php?trf_no=" + txt_trf_no + '&job_no=' + job_no;

                        }
                    });
					}
                },
                cancel: function() {
                    return;
                }
            }
        })
    });

    //send report to print by quality manager

    $(document).on("click", ".report_send_to_print", function() {
        var clicked_id = $(this).attr("data-id");
        var txt_trf_no = $("#txt_trf_no").val();
        var job_no = $("#txt_job_no").val();

        $.confirm({
            title: "warning",
            content: "Are You Sure To Print This Report?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_engineer.php',
                        data: 'action_type=report_send_to_print&clicked_id=' + clicked_id + '&txt_trf_no=' + txt_trf_no,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>view_job_by_qlty_manager.php?trf_no=" + txt_trf_no + '&&job_no=' + job_no;

                        }
                    });

                },
                cancel: function() {
                    return;
                }
            }
        })
    });


    $(document).on("click", ".delete_only_reports", function() {
        var clicked_id = $(this).attr("data-id");


        $.confirm({
            title: "warning",
            content: "All Data For This Job Will Delete, Are You Really Sure To Delete This Job?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>span_save_material.php',
                        data: 'action_type=delete_only_reports&clicked_id=' + clicked_id,
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == "1") {
                                alert(data.msg);
                            } else {
                                alert(data.msg);
                                window.location.href = "<?php echo $base_url; ?>list_of_completed_job_report_for_qm.php";
                            }
                        }
                    });

                },
                cancel: function() {
                    return;
                }
            }
        })
    });

    $(document).on("click", ".delete_one_report", function() {
        var clicked_id = $(this).attr("data-id");


        $.confirm({
            title: "warning",
            content: "Are You Really Sure To Delete This Report?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>span_save_material.php',
                        data: 'action_type=delete_one_report&clicked_id=' + clicked_id,
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == "1") {
                                alert(data.msg);
                            } else {
                                alert(data.msg);
                                //window.location.href="<?php echo $base_url; ?>list_of_completed_job_report_for_qm.php";
                                location.reload();
                            }
                        }
                    });

                },
                cancel: function() {
                    return;
                }
            }
        })
    });

    //send job to accept

    $(document).on("click", ".job_send_to_accept", function() {
        var clicked_id = $(this).attr("data-id");
        var splitings = clicked_id.split("|");

        $.confirm({
            title: "warning",
            content: "Are You Sure To Accept This Job ?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_engineer.php',
                        data: 'action_type=send_job_to_accept&clicked_id=' + clicked_id,
                        success: function(html) {
                            alert("Job No" + splitings[0] + " Is Accepted..");
                            window.location.href = "<?php echo $base_url; ?>list_of_job_report_for_qm.php";

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