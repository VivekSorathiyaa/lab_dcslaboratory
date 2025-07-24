<?php
include 'connection.php';
error_reporting(1);
$trf_no=$_GET["trf_no"];
$reports_nos=$_GET["reports_nos"];
$lab_no=$_GET["lab_no"];
$query = "SELECT * FROM `job` where `trf_no`='$trf_no'";
$query_result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($query_result);

$job_eng = "SELECT * FROM `job_for_engineer` WHERE `trf_no`='$trf_no'";
$res_job_eng = mysqli_query($conn, $job_eng);
$row_eng = mysqli_fetch_array($res_job_eng);

$get_estimate = "SELECT * FROM `estimate_total_span` WHERE `trf_no`='$trf_no'";
$res_estimate = mysqli_query($conn, $get_estimate);
$row_estimate = mysqli_fetch_array($res_estimate);

$get_span_mt_asign = "SELECT * FROM `span_material_assign` WHERE `trf_no`='$trf_no' AND `lab_no`='$lab_no'";
$res_span_mt_asign = mysqli_query($conn, $get_span_mt_asign);
$row_span_mt_asign = mysqli_fetch_array($res_span_mt_asign);

$get_job_eng = "SELECT * FROM `job_for_engineer` WHERE `trf_no`='$trf_no' AND `lab_no`='$lab_no'";
$res_job_engineers= mysqli_query($conn, $get_job_eng);
$row_engineers = mysqli_fetch_array($res_job_engineers);
$issue_date=$row_engineers["issue_date"];

$get_cat_mat_name = "SELECT * FROM `material_category` WHERE `material_cat_id`='$row_span_mt_asign[material_category]'";
$res_cat_mat_name = mysqli_query($conn, $get_cat_mat_name);
$row_cat_mat_name = mysqli_fetch_array($res_cat_mat_name);

$get_mat_name = "SELECT * FROM `material` WHERE `id`='$row_span_mt_asign[material_id]'";
$res_mat_name = mysqli_query($conn, $get_mat_name);
$row_mat_name = mysqli_fetch_array($res_mat_name);
$table_name=$row_mat_name["table_name"];

$sel_from_tables="select * from `final_material_assign_master` where `report_no`='$reports_nos'";
$res_table = mysqli_query($conn, $sel_from_tables);
if(mysqli_num_rows($res_table) > 0){
$row_tabs = mysqli_fetch_array($res_table);
$ulrs_nos=$row_tabs["ulr_no"];
}else{
	$ulrs_nos="-";
}

$sel_final="select * from final_material_assign_master where `report_no`='$reports_nos'";
$res_final = mysqli_query($conn, $sel_final);
$test_names="";
$material_categorys="";
$material_ids="";
if(mysqli_num_rows($res_final)> 0)
{
	$row_final = mysqli_fetch_array($res_final);
	$sel_test="select * from test_wise_material_rate where `final_material_id`='$row_final[final_material_id]'";
	$res_test = mysqli_query($conn, $sel_test);
	
	$material_categorys =$row_final["material_category"];
	$material_ids =$row_final["material_id"];
	if(mysqli_num_rows($res_test)> 0)
	{
		while($row_test = mysqli_fetch_array($res_test)){
		$sel_test_name="select * from test_master where `test_id`=".$row_test["test_id"];
		$res_test_name = mysqli_query($conn, $sel_test_name);
		$row_test_name = mysqli_fetch_array($res_test_name);
		$test_names .=$row_test_name["test_name"].",";
		
	}
	}
}

$counts_of_reports="select * from final_material_assign_master where `material_category`='$material_categorys' AND `material_id`='$material_ids' AND `trf_no`='$trf_no'";
$res_c_o_report = mysqli_query($conn, $counts_of_reports);
$get_counts= mysqli_num_rows($res_c_o_report);



$get_tested_name = "SELECT * FROM `multi_login` WHERE `id`='$row_cat_mat_name[material_engineer]'";
$res_tested_name = mysqli_query($conn, $get_tested_name);
$row_tested_name = mysqli_fetch_array($res_tested_name);

$get_repoted_by = "SELECT * FROM `multi_login` WHERE `id`='$row[reported_by]'";
$res_reported_by= mysqli_query($conn, $get_repoted_by);
$row_reported = mysqli_fetch_array($res_reported_by);

$get_agency = "SELECT * FROM `agency_master` WHERE `agency_id`=".$row["billing_to_id"];
$res_agency = mysqli_query($conn, $get_agency);
$row_agency = mysqli_fetch_array($res_agency);

$fields = array('S.R.F. No', $trf_no);
$excelData = implode("\t", array_values($fields)) . "\n";

$fields = array('Actual Inward Date', date('d-m-Y', strtotime($row["date"])));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('Report No', $reports_nos);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('Report Date',  date('d-m-Y', strtotime($issue_date)));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('Job Mode', $row["nabl_type"]);
$excelData .= implode("\t", array_values($fields)) . "\n";


if($row["nabl_type"]=="non_nabl"){ $ulrs_nos="-"; }
$fields = array('Ulr No', $ulrs_nos);
$excelData .= implode("\t", array_values($fields)) . "\n";


$fields = array('NAME OF CUSTOMER', $row["clientname"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('NAME OF AGENCY', $row["agency_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array($row["tpi_or_auth"], $row["tpi_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array($row["pmc_heading"], $row["pmc_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

 $rep=str_replace('&nbsp;', ' ', $row["nameofwork"]);
 $rep11=str_replace('&amp;', ' ', $rep);

$fields = array('NAME OF WORK', strip_tags($rep11));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('DESCRIPTION', strip_tags($row_span_mt_asign["excel_description"]));
$excelData .= implode("\t", array_values($fields)) . "\n";

if($row["refno"] !=""){
		$rrr=$row["refno"]." DATE:".date("d/m/Y",strtotime($row["date"]));
}else{
	$rrr="-";
}
$fields = array('REFERENCE NO. WITH DATE',$rrr);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('DATE OF RECEIPT', date("d-m-Y",strtotime($row["sw_date"])));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('DATE OF TEST STARTED', date("d-m-Y",strtotime($row_eng["start_date"])));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('DATE OF TEST COMPLETED', date("d-m-Y",strtotime($row_eng["end_date"])));
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('NO OF SAMPLE/REPORT', $get_counts);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('BILL TO', $row_agency["agency_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('MATERIAL CATAGORY', $row_cat_mat_name["material_cat_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('MATERIAL NAME', $row_mat_name["mt_name"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('EXPECT. SUBMISSION DATE', date("d-m-Y",strtotime($row_eng["expected_date"])));
$excelData .= implode("\t", array_values($fields)) . "\n";

if($row_span_mt_asign["condition"]=="1"){ $conds="poor";}else{ $conds="Good"; }
$fields = array('SAMPLE CONDITION', $conds);
$excelData .= implode("\t", array_values($fields)) . "\n";
if($row_span_mt_asign["material_location"]=="1"){ $locs="in Laboratory";}else{ $locs="On Site"; }
$fields = array('LOCATION', $locs);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('NO OF REPORT', "");
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('TESTS', $test_names);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('TESTED BY', $row_tested_name["staff_fullname"]);
$excelData .= implode("\t", array_values($fields)) . "\n";

$fields = array('REPORTED BY', $row_reported["staff_fullname"]);
$excelData .= implode("\t", array_values($fields)) . "\n";


$namings=$reports_nos." RD".".xls";
header("Content-Disposition: attachment; filename=$namings");
header("Content-type: application/vnd.ms-excel");
echo $excelData;
