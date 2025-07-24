
<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0px 40px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Book Antiqua;
	}

	.test {
		border-collapse: collapse;
		font-size: 11px;
		font-family: Book Antiqua;
	}

	.test1 {
		font-size: 11px;
		border-collapse: collapse;
		font-family: Book Antiqua;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Book Antiqua;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
	.report-cell {
        font-size: 16px; /* or use 'large', '18px', etc. */
        padding: 5px 8px;
        font-family: Arial, sans-serif;
    }
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$tbl = $_GET['tbl_name'];
	$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	


$tested_by = $row_select['tested_by'];
			$verify_by = $row_select['reported_by_review'];
$user_name = "select * from `multi_login` WHERE `id`='$tested_by'";
	$result_for_select = mysqli_query($conn, $user_name);
	$user = mysqli_fetch_array($result_for_select);
	
	$u_name = $user['staff_fullname'];
	
	$verify_name = "select * from `multi_login` WHERE `id`='$verify_by'";
	$result_for_verify_select = mysqli_query($conn, $verify_name);
	$user_1 = mysqli_fetch_array($result_for_verify_select);	

	$v_name = $user_1['staff_fullname'];
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$detail_sample = $row_select3['mt_name'];
			$mark = $row_select3['fine_agg_type'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$sample_de = $row_select4['sample_de'];
	}
	$totalcnt = 0;
	$pagecnt = 1;
	if (($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['silt_content'] != "" && $row_select_pipe['silt_content'] != "0" && $row_select_pipe['silt_content'] != null) || ($row_select_pipe['alk_a1'] != "" && $row_select_pipe['alk_a1'] != "0" && $row_select_pipe['alk_a1'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
		$totalcnt++;
	}

	//if (($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null)) {

	?>

		
		<page size="A4">
		<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null) {?>
		<br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
                <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $_GET['job_no'];?></td>
                    <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;<?php echo $detail_sample;?>&nbsp;(SIEVE ANALYSIS)</td>
                </tr>
                <tr>
                    <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $row_select_pipe['s_des'];?></td>
                    <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;font-size:12px" colspan="4">&nbsp;Method:&nbsp;As per MORTH
                specification</td>
                </tr>
                <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?> </td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;1</td>
            </tr>
			<tr>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;" colspan="3">
        &nbsp;Sample Qty:&nbsp;<?php// echo $row_select_pipe['cc_qty'];?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2">
        &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?>
    </td>
    <td class="report-cell" style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">
        &nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?>
    </td>
</tr>      
    </table>
       <br><br><br>			
        <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
            <tr>
                <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7"><?php echo $detail_sample;?>  (SIEVE ANALYSIS)</td>
            </tr>
        </table>
        <br>
        <table align="center" style="width: 95%;">
            <tr>
                <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;"> 
                    Sieve Analysis <?php echo $detail_sample;?> GRADE <u>&nbsp;&nbsp;I&nbsp;&nbsp;</u> [As Per MORTH Specification]</td>
            </tr>
            </table>
            <br>
            <table align="center" style="width: 95%;">
            <tr>
                <td>Wt. of Sample for Test<u>&nbsp;&nbsp;<?php echo $row_select_pipe['sample_taken'];?>&nbsp;&nbsp;</u> gm</td>
            </tr>
        </table>
        </table>
        <table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">IS Sieve <br>(mm)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Retained</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"> % age Weight  <br>Retained 
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Cumulative Wt.  <br>Retained%</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">% Passing</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Limits</td>
            </tr>
           <?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != null) {?>
<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_1'];?></td>
        </tr>
				<?php } if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_2'];?></td>
        </tr>
				<?php } if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_3'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_4'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_5'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_6'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_7'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_8'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_9'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_9'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_9'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_9'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_9'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_9'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_10'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_10'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_10'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_10'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_10'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_10'];?></td>
        </tr>
		<?php } if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_11'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_11'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_11'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_11'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_11'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_11'];?></td>
        </tr>
		<?php }?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;">Pan</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php //echo $row_select_pipe['cum_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php //echo $row_select_pipe['ret_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php //echo $row_select_pipe['cum_ret_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php //echo $row_select_pipe['pass_sample_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php// echo $row_select_pipe['pass_range_1'];?></td>
        </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
               <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>
		<?php } if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != null && $row_select_pipe['cru_value'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
           <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;(CRUSHING VALUE)</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;2</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7"> (AGGREGATE CRUSHING VALUE)</td>
        </tr>
    </table>
    <br>
    <table align="center" style="width: 95%;" cellpadding="10px">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;text-align:center;">  Aggregate Crushing Value [IS 2386 (Part-4)-1963 RA 2016]</td>
        </tr>
		
  </table>
			
	<table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Aggregate Size (mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Container (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Of Container + Aggregate (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Of Aggregate before Crushing (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Aggregate retained on 2.36 mm Sieve (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Aggregate Passing from 2.36 mm Sieve (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Aggregate Crushing Value %</td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"></td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">1</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">2</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">3 = 2-1</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">4</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">5</td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">6=(5/3)x100</td>
        </tr>
		
				<?php if ($row_select_pipe['cru_value_1'] != "" && $row_select_pipe['cru_value_1'] != null) {?>
<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"rowspan="2">10</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_c_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_d_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_a_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_e_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_b_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['cru_value_1'];?></td>
        </tr>
				<?php } if ($row_select_pipe['cru_value_2'] != "" && $row_select_pipe['cru_value_2'] != null) {?>
		<tr>
             <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_c_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_d_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_a_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_e_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cr_b_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['cru_value_2'];?></td>
        </tr>
		<?php }?>
				<?php //} if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != null && $row_select_pipe['cum_wt_gm_5'] != "0") {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;" colspan="6">AVERAGE</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['cru_value'];?></td>
        </tr>
				
			</table>
				<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
           <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != null && $row_select_pipe['imp_value'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;IMPACT VALUE</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;3</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7"> (AGGREGATE IMPACT VALUE)</td>
        </tr>
    </table>
    <br>
    <table align="center" style="width: 95%;" cellpadding="10px">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;text-align:center;">  Aggregate Impact Value [IS 2386 (Part-4)-1963 RA 2016]</td>
        </tr>
		
  </table>
			
	<table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Aggregate Size (mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Container (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Of Container + Aggregate (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Of Aggregate before Impact (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Aggregate retained on 2.36 mm Sieve (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. of Aggregate Passing from 2.36 mm Sieve (gm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Aggregate Impact Value %</td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"></td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">1</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">2</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">3 = 2-1</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">4</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">5</td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">6=(5/3)x100</td>
        </tr>
		
				<?php if ($row_select_pipe['imp_value_1'] != "" && $row_select_pipe['imp_value_1'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"rowspan="2">10</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_a_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_b_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_c_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['imp_value_1'];?></td>
        </tr>
				<?php } if ($row_select_pipe['imp_value_2'] != "" && $row_select_pipe['imp_value_2'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_a_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_b_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['imp_w_m_c_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['imp_value_2'];?></td>
        </tr>
		<?php }?>
				<?php //} if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != null && $row_select_pipe['cum_wt_gm_5'] != "0") {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;" colspan="6">AVERAGE</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['imp_value'];?></td>
        </tr>
				
			</table>
				<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
            <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != null && $row_select_pipe['fines_value'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;(10% Fine Value)</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;4</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">(TEN PERCENT FINES VALUE) IS: 2386 (Part-4)</td>
        </tr>
    </table>
    <br>
			
	<table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">DITERMINATION </td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Trial No.1</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Trial No.2</td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Weight of surface Dry Sample passing 12.5 mm and retained on 10.0mm IS Sieve A(gm)</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_a_1'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_a_2'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Penetration of plunger 10 min. of about 15 mm for rounder/Partial rounder aggregate  20 mm for normal crushed agg. 24 mm for honey agg.</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_1'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_4'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Load at required Penetration (X) Tonnes</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_2'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_5'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Wt. of fraction passing by IS Sieve, After the test B gm</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_c_1'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_c_2'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">% of fraction passing by IS Sieve 2.36= )B/A*100</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_d_1'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_d_2'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Mean % of fine from two test (Y)</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_3'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['fine_6'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Load required foe 10 Percent fines in tones</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_b_1'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['f_b_2'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;text-align:left;">Average</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"><?php echo $row_select_pipe['avg_f_d'];?></td>
            <td style="width:16%;border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"><?php echo $row_select_pipe['avg_f_c'];?></td>
        </tr>
		<tr>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold;text-align:left;">10 % Fine Value = 14 x X / Y + 4</td>
            <td style="width:14%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold; border-right:1px solid;" colspan="2"><?php echo $row_select_pipe['fines_value'];?></td>
        </tr>
			</table>
				<br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
          <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != null && $row_select_pipe['avg_wom'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Bulk Density (Compacted)</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;5</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">BULK DENSITY (COMPACTED)</td>
        </tr>
    </table>
    <br>
			
	 <table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;"  cellspacing="0" cellpadding="5px">
                <tr>
                    <td style="font-weight: bold;border-right: 1px solid;">S.No</td>
                    <td style="font-weight: bold;border-right: 1px solid;">Description</td>
                    <td style="font-weight: bold;border-right: 1px solid;width: 20%;">1</td>
                    <td style="font-weight: bold;width: 20%;">2</td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">1</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Volume of Container (Ltr)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['m11'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['m12'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">2</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt. of Empty Container (Kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['m21'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['m22'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">3</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt.of Empty Container + Agg.(kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['m31'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['m32'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">4</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt.of Agg.(Kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['den_mo_vol1'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['den_liter'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">5</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Bulk Density (Kg/Ltr)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['den_mo_vol2'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['den_kg_lit'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">6</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Average</td>
                    <td style="border-top: 1px solid;" colspan="2"><?php echo $row_select_pipe['avg_wom'];?></td>
                </tr>
            </table>
				<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
         <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['avg_wom1'] != "" && $row_select_pipe['avg_wom1'] != null && $row_select_pipe['avg_wom1'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
           <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Bulk Density (Loose)</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;6</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">BULK DENSITY (LOOSE)</td>
        </tr>
    </table>
    <br>
			
	<table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;"  cellspacing="0" cellpadding="5px">
                <tr>
                    <td style="font-weight: bold;border-right: 1px solid;">S.No</td>
                    <td style="font-weight: bold;border-right: 1px solid;">DESCRIPTION</td>
                    <td style="font-weight: bold;border-right: 1px solid;width: 20%;">1</td>
                    <td style="font-weight: bold;width: 20%;">2</td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">1</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Volume of Container (Ltr)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['m13'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['m23'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">2</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt. of Empty Container (Kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['m33'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['den_voids_1'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">3</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt.of Empty Container + Agg.(kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['weight_1'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['weight_2'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">4</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Wt.of Agg.(Kg)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['asd_1'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['asd_2'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">5</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Bulk Density (Kg/Ltr)</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['den_voids'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['den_voids1'];?></td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;">6</td>
                    <td style="border-right: 1px solid;border-top: 1px solid;text-align: left;">Average</td>
                    <td style="border-top: 1px solid;" colspan="2"><?php echo $row_select_pipe['avg_wom1'];?></td>
                </tr>
            </table>
				<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
            <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != null && $row_select_pipe['fi_index'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
			
			
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td  class="report-cell"   class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Flakiness And Elongation</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;7</td>
            </tr>
			 <tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7">FLAKINESS & ELONGATION INDEX</td>
        </tr>
    </table>
	<table align="center" style="width: 95%;" cellpadding="5px">
        <tr>
            <td style="font-family: 'calibri';font-size: 14px;font-weight: bold;text-align:left;">  Flakiness Index (IS 2386 (Part-1)-RA 2016</td>
        </tr>
		
  </table>
			
	<table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;font-size: 12px;"  cellspacing="0" cellpadding="5px">
                <tr>
                    <td style="width:16%;font-weight: bold;border-right: 1px solid;">IS Sieves</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weight Retained (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">% Retained (gm) (X)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Mass of Pieces taken (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weight of Pieces  passing TG (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">% pieces Passing TG (Y)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weighted Percentage (X x Y)/100</td>
                    <td style="width:12%;font-weight: bold;">% Flakiness</td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s11'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_xy1'];?></td>
                    <td style="border-top: 1px solid;" rowspan="9"><?php echo $row_select_pipe['fi_index'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s12'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y2'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy2'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s13'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y3'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy3'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s14'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y4'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy4'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s15'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y5'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy5'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s16'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y6'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy6'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s17'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y7'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy7'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s18'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y8'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy8'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s19'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_x9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['b9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['flk_y9'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['flk_xy9'];?></td>
                </tr>
				
            </table>
			<table align="center" style="width: 95%;" cellpadding="5px">
        <tr>
            <td style="font-family: 'calibri';font-size: 14px;font-weight: bold;font-size: 12px;text-align:left;">  Elongation Index (IS 2386 (Part-1)-RA 2016</td>
        </tr>
		
  </table>
			
	<table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;font-size: 12px;"  cellspacing="0" cellpadding="5px">
                <tr>
                    <td style="width:16%;font-weight: bold;border-right: 1px solid;">IS Sieves</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weight Retained (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">% Retained (gm) (X)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Mass of Pieces taken (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weight of Pieces  passing TG (gm)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">% pieces Passing TG (Y)</td>
                    <td style="width:12%;font-weight: bold;border-right: 1px solid;">Weighted Percentage (X x Y)/100</td>
                    <td style="width:12%;font-weight: bold;">% Elongation</td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s11'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_10'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y1'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_xy1'];?></td>
                    <td style="border-top: 1px solid;" rowspan="9"><?php echo $row_select_pipe['ei_index'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s12'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_11'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd2'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y2'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy2'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s13'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_12'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd3'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y3'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy3'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s14'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['a4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_13'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd4'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y4'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy4'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s15'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_14'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd5'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y5'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy5'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s16'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_15'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd6'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y6'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy6'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s17'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_16'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd7'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y7'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy7'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s18'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_17'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd8'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y8'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy8'];?></td>
                </tr>
				<tr>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['s19'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['aa9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_x9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['fle_18'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['dd9'];?></td>
                    <td style="border-right: 1px solid;border-top: 1px solid;"><?php echo $row_select_pipe['elo_y9'];?></td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['elo_xy9'];?></td>
                </tr>
				
            </table>
				<br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
           <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_1_1'] != null && $row_select_pipe['dele_1_1'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Deleterious Material</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;8</td>
            </tr>
			 <tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br>
	<table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" colspan="2"> DELETERIOUS MATERIAL AS PER IS: 2386 P-1&2 </td>
        </tr>
		<tr>
            <td style="width:80%;border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">(I) Weight of Sample in gm (A)=</td>
            <td style="width:20%;border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_1_1'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Weight of Washed Retained Sample on 75 micron IS Sieve (after Oven dried) in gm (B)=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_1_2'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">% of Material finer than 75 micron IS Sieve (A-B)x100/A=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_1_4'];?></td>
        </tr>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">(II) Weight of Oven Sample in gm (A)=</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_2_1'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Weight of Sample after removed of clay lump in gm (B)=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_2_2'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">% of clay & Lump (A-B) X 100 / A=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_2_3'];?></td>
        </tr>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">(III) Weight of Sample in gm (A)=</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_3_1'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">Weight of decanted pieces in gm (B)=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_3_2'];?></td>
        </tr>
		<tr>
            <td style="border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">% of coal & lignite (B/A)X100=</td>
            <td style="border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo $row_select_pipe['dele_3_3'];?></td>
        </tr>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;text-align:left;">(IV) Total Deleterious material</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;"><?php echo number_format(($row_select_pipe['dele_1_4'] + $row_select_pipe['dele_2_3'] + $row_select_pipe['dele_3_3']),2);?></td>
        </tr>
	</table>
		<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
            <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php } if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {?>
	<div class="pagebreak"></div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $detail_sample;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Specific Gravity & Water Absorption</td>
            </tr>
			<tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;9</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br>
	 <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px">
        <tr>
            <td style="font-family: 'Calibri', 'Trebuchet MS', sans-serif;font-size: 35px
            px;font-weight: bolder;" colspan="7">  SPECIFIC GRAVITY/WATER ABSORPTION  (FA) <br>As Per IS : 2386 PART-3</td>
        </tr>
    </table>
    <br>
    <table align="center" style="width: 95%;">
    <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;">Specific Gravity/Water Absorption of Coarse Aggregates As Per IS 2386 Part-3</td>
    </tr>
    </table>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="width:30%;border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;" colspan="2"></td>
            <td style="width:10%;border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">Unit</td>
            <td style="width:15%;border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">1</td>
            <td style="width:15%;border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">2</td>
            <td style="width:15%;border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">Average</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass  of Oven Dry Aggregate in Air</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">A</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_s_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_s_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass  of SSD Aggregate in Air</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">B</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            
        
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass  of Saturated Aggregate in Water</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">C</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_sur_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_sur_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Loss of Mass</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_1'] - $row_select_pipe['sp_w_sur_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_2'] - $row_select_pipe['sp_w_sur_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Specific Gravity  based on dry aggregate</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">A/(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Specific Gravity  based on SSD weight</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">B/(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo number_format(($row_select_pipe['sp_wt_st_1'] / ($row_select_pipe['sp_wt_st_1'] - $row_select_pipe['sp_w_sur_1'])),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo number_format(($row_select_pipe['sp_wt_st_2'] / ($row_select_pipe['sp_wt_st_2'] - $row_select_pipe['sp_w_sur_2'])),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo $row_select_pipe['sp_specific_gravity'];?></td>
        </tr>
         <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Apparent Specific Gravity</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">A/(A-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo number_format(($row_select_pipe['sp_w_s_1'] / ($row_select_pipe['sp_w_s_1'] - $row_select_pipe['sp_w_sur_1'])),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo number_format(($row_select_pipe['sp_w_s_2'] / ($row_select_pipe['sp_w_s_2'] - $row_select_pipe['sp_w_sur_2'])),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo $row_select_pipe['r_sam'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;border-bottom: 1px solid;width: 500px;">Water Absorption</td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 600px;">(B-A)/AX100</td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 200px;"><?php echo $row_select_pipe['sp_water_abr_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 200px;"><?php echo $row_select_pipe['sp_water_abr_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 100px;"><?php echo $row_select_pipe['sp_water_abr'];?></td>
        </tr>
    </table>
		<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
            <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
      </tr>
    </table>
	<?php }?>
			</page>

</body>

</html>


<script type="text/javascript">


</script>