<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
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
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$branch_name = $row_select['branch_name'];
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];
        $issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name= $row_select3['mt_name'];
			
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$in_grade = $row_select4['in_grade'];
		$grd_zone = $row_select4['grd_zone'];
	}
	$cnt = 1;
	$pagecnt = 1;
	$totalcnt = 0;
	if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null)) {
		$totalcnt++;
	}
	
	if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['ans_lbd'] != "" && $row_select_pipe['ans_lbd'] != "0" && $row_select_pipe['ans_lbd'] != null) || ($row_select_pipe['fmc_7'] != "" && $row_select_pipe['fmc_7'] != "0" && $row_select_pipe['fmc_7'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) {
		$totalcnt++;
	}
	if (($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null) || ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null)) {
		$totalcnt++;
	}
	?>


	<br>
	<br>
	<br>
	<br>
	<page size="A4"> 
	
        <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
               <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Sieve Analysis)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>1</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
         <br>
         <table align="center" style="width: 95%;text-align: center;border: 1px solid black;"  cellspacing="5px" cellpadding="5px">
            <tr>
                <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7"> AGGREGATE DATA ENTRY SHEET FINE AGGREGATE (SIEVE ANALYSIS)</td>
            </tr>
        </table>
        <br>
        <table align="center" style="width: 95%;" cellpadding="20px">
            <tr>
                <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;"> 
                    Sieve Analysis Fine Aggregate [IS: 383-2016 Table 9]</td>
            </tr>
        </table>
        <table align="center" style="width: 95%;padding: 0 20px;">
            <tr>
                <td>Wt. of Sample for Test&nbsp;&nbsp;<u><?php echo $row_select_pipe['sample_taken'];?></u>&nbsp;&nbsp;gm</td>
            </tr>
        </table>
        </table>
        <table  align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="5px">
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" rowspan="2">IS Sieve <br>(mm)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" rowspan="2">Wt. Retained</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" rowspan="2"> % age Wt. <br>Retained <br>(gm)</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" rowspan="2">Cum. Wt. <br>Retained%</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" rowspan="2">% Passing</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold" colspan="4">Limits (IS 383: 2016)</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Zone I</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Zone II</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;">Zone III</td>
                <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;">Zone IV</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">10</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">100</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">4.75</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">90-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">90-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">90-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">90-100</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">2.36</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">60-95</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">75-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">85-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">95-100</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">1.18</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">30-70</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">55-90</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">75-100</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">90-100</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">0.600</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">15-34</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">35-59</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">60-79</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">80-100</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">0.300</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">5-20</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">8-30</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">12-40</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">15-50</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;">0.150</td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
                <td style="border-top: 1px solid;border-left: 1px solid;">0-10</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">0-10</td>
                <td style="border-top: 1px solid;border-left: 1px solid;">0-10</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">0-15</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;">Pan</td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
                <td style="border: 1px solid;"></td>
            </tr>  
        </table>
        <table align="center" style="width: 95%;" cellpadding="10px">
            <tr>
                <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;"> 
                    Sand Sample Passing through&nbsp;&nbsp;<u><?php echo $row_select_pipe['grd_zone'];?></u>&nbsp;&nbsp;Zone</td>
            </tr>
            <tr>
                <td  style="font-family: 'calibri';font-size: 16px;font-weight: bold;">Fineness Modulus of Sand = Cumulative % weight retained / 100&nbsp;&nbsp;=&nbsp;&nbsp;<u><?php echo $row_select_pipe['grd_fm'];?></u>&nbsp;&nbsp; </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>
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
	
		 <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
               <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Water Absorption)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>2</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
            <br>
			 <table align="center" style="width: 95%;text-align: center;border: 1px solid black;"  cellspacing="3px" cellpadding="3px">
            <tr>
                <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7"> Water Absorption of Fine Aggregate As Per (IS(2386:Part-3))</td>
            </tr>
        </table>
        <br>     
        <table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;"  cellspacing="0" cellpadding="5px">
            <tr>
                <td style="font-weight: bold;border-right: 1px solid;">S.No</td>
                <td style="font-weight: bold;border-right: 1px solid;">Description</td>
                <td style="font-weight: bold;border-right: 1px solid;">Sample No.1</td>
                <td style="font-weight: bold;">Sample No.2</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of saturated surface dry aggregate in air (W1)gm</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['finer_a'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['finer_a1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of oven dried aggregate in air (w2)gm</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['finer_b'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['finer_b1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Water absorption = (W1-W2)*100/W2(%)</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['avg_finer'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['avg_finer1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;" colspan="2">Average =</td>
                <td style="border-top: 1px solid;" colspan="2"><?php echo $row_select_pipe['avg_fin_1'];?></td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>
        <!-- ============================================density(compacted)================================== -->
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
         <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
                <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Bulk Density Compacted)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>3</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
            <br><br><br>
            <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
                <tr>
                    <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7">BULK DENSITY (COMPACTED)</td>
                </tr>
            </table>
            <br><br><br>
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
            <br><br><br><br><br><br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>
        <!-- ============================Clay and Lumps================================= -->
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
         <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
               <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Clay And Lumps)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>4</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
        <br>
         <table align="center" style="width: 95%;text-align: center;border:1px solid;"  cellspacing="5px" cellpadding="5px">
            <tr>
                <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7">Clay and Lumps IS 2386 Part-2 1963/R2016</td>
            </tr>
        </table>  
        <br> 
        <table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;"  cellspacing="0" cellpadding="5px">
            <tr>
                <td style="font-weight: bold;border-right: 1px solid;">S.No</td>
                <td style="font-weight: bold;border-right: 1px solid;">Description</td>
                <td style="font-weight: bold;border-right: 1px solid;">Trial-1</td>
                <td style="font-weight: bold;">Trial-2</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of Oven dry Sample in gms (A)</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_2_1'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_4_1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of Sample after removal of clay lump in gm (b)
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_2_2'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_4_2'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">3</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">% of Clay & Lump (A-B)/Ax100</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_2_3'];?></td>
                <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_4_3'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-right: 1px solid;">4</td>
                <td style="border-top: 1px solid;border-right: 1px solid; text-align: left;">Average</td>
                <td style="border-top: 1px solid;" colspan="2">
</td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>
            <!-- =============================material================================ -->
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
            <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
               <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Finer Than 75 Micron)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>5</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
            <br><br>
             <table align="center" style="width: 95%;text-align: center;border:1px solid;"  cellspacing="5px" cellpadding="5px">
                <tr>
                    <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7">Material Finer Than 75 Micron IS 2386 Part-1 1963/R2016</td>
                </tr>
            </table>
            <br> 
            <table align="center" style="width: 95%;text-align: center;font-family: 'calibri';border: 1px solid;"  cellspacing="0" cellpadding="5px">
                <tr>
                    <td style="font-weight: bold;border-right: 1px solid;">S.No</td>
                    <td style="font-weight: bold;border-right: 1px solid;">DTERMINATION</td>
                    <td style="font-weight: bold;border-right: 1px solid;width: 20%;">Trial-1</td>
                    <td style="font-weight: bold;width: 20%;">Trial-2</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid;border-right: 1px solid;">1</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of Sample in gms (A)</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_1_1'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_3_1'];?></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid;border-right: 1px solid;">2</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Wt.of Washed Retained Sample on 75 Micron IS Sieve (after the Oven dried) in gms</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_1_2'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_3_2'];?></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid;border-right: 1px solid;">3</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">% 75 micron IS Sieve (A-B)/Ax100</td>
                    <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['dele_1_4'];?></td>
                    <td style="border-top: 1px solid;"><?php echo $row_select_pipe['dele_3_4'];?></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid;border-right: 1px solid;">4</td>
                    <td style="border-top: 1px solid;border-right: 1px solid; text-align: left;">Average</td>
                    <td style="border-top: 1px solid;" colspan="2"></td>
                </tr>
            </table>
            <br><br><br><br><br><br>
            <table align="center" style="width: 92%;">
                <tr>
                    <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                    <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
              </tr>
            </table>
        <!-- =====================================silt=================================== -->
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
        <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
                <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Silt Content)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>6</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
        <br><br><br>
        <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="0" cellpadding="5px">
            <tr>
                <td style="font-family: 'Calibri', 'Trebuchet MS', sans-serif;font-size: 35px
                px;font-weight: bolder;" colspan="7">SILT CONTENT (As per CPWD)</td>
            </tr>
        </table>
        <br><br><br>
        <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="10px">
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">SNo.</td>
                <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">DESCRIPTION</td>
                <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">1</td>
                <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">2</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;border-right: 1px solid;">1</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Volume of Sample (V1), ml</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s1_1'];?></td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s2_1'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;border-right: 1px solid;">2</td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;">Volume of Silt after three hours (V2), ml </td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s1_2'];?></td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s2_2'];?></td>
            <tr>
                <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;border-right: 1px solid;">3 </td>
                <td style="border-top: 1px solid;border-right: 1px solid;text-align: left;"> Percentage Silt by Volume V2/V1X100 %</td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s1_3'];?></td>
                <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['slp_s2_3'];?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid;border-bottom: 1px solid;border-left: 1px solid;text-align: center;border-right: 1px solid;width: 80px;">4</td>
                <td style="border-top: 1px solid;border-bottom: 1px solid; border-right: 1px solid;text-align: left;">Average</td>
                <td style="border-top: 1px solid;border-bottom: 1px solid;border-right: 1px solid;width: 80px; " colspan="2"><?php echo $row_select_pipe['avg_sul'];?></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;text-align: center;height: auto;font-size: 14px;;margin-bottom: -15px;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Analyst</td></b>
          </tr>
        </table>
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
         <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
                <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Bulk Density Losse)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>7</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
            <br><br><br>
            <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
                <tr>
                    <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;" colspan="7">BULK DENSITY (LOOSE)</td>
                </tr>
            </table>
            <br><br><br>
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
            <br><br><br><br><br><br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>
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
		
		
		 <table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px">
                <tr>
              <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="8"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
           <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">(Formerly Known as DC Consultants)</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">DPR’s and other Civil Engineering Consultancy Services</td>
            </tr>
			<tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">CIN : U71100HP2024PTC010626,  GSTIN : 02AAKCD6125G1ZZ</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P) (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Mobile : +91-7018819894, 01894 295-074    E-mail : officialdcspvtltd@gmail.com</td>
            </tr>
                <tr>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-size: 15px;">Fine Aggregate</td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                    <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Job Card No:&nbsp;</b><?php echo $_GET['job_no'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Test:&nbsp;</b>Fine Aggregate&nbsp;(Specific Gravity & water Absorption)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="4"><b>&nbsp;Sample Description:&nbsp;</b><?php echo $row_select_pipe['s_des'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4"><b>&nbsp;Method:&nbsp;</b>IS 2386 (P-1)</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="2"><b>&nbsp;DOR:&nbsp;</b><?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;DOS:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2"><b>&nbsp;DOC:&nbsp;</b><?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2"><b>&nbsp;Page No:&nbsp;</b>8</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-top: 1px solid;" colspan="3"><b>&nbsp;Sample Qty:&nbsp;</b><?php echo $row_select_pipe['txt_qty'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"><b> &nbsp;Residual Sample:&nbsp;</b><?php echo $row_select_pipe['r_sam'];?></td>
                    <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3"><b>&nbsp;Sample Retention:&nbsp;</b><?php echo $row_select_pipe['s_ret'];?></td>
                </tr>         
        </table>
    <br>
    <!-- <hr style="border: 1px solid;"> -->
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
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">Unit</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">1</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">2</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;">Average</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass  of Saturated Surface Dry Aggregate</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">A</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_st_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass of Pycnometer contaning Aggregate and <br>Filled with Distilled Water </td>
            <td style="border-top: 1px solid;border-right: 1px solid;">B</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_bas1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_wt_bas2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            
        
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass of Pycnometer Filled with Distilled Water </td>
            <td style="border-top: 1px solid;border-right: 1px solid;">C</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_s_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_s_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Mass of Oven Dry Aggregate</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">D</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">gm</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_sur_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_w_sur_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Specific Gravity  based on dry aggregate</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">D/A-(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['sp_specific_gravity'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Specific Gravity  based on SSD weight</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">A/A-(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo number_format(($row_select_pipe['sp_wt_st_1'] / ($row_select_pipe['sp_wt_st_1'] - ($row_select_pipe['sp_wt_bas1'] - $row_select_pipe['sp_w_s_1']))),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo number_format(($row_select_pipe['sp_wt_st_2'] / ($row_select_pipe['sp_wt_st_2'] - ($row_select_pipe['sp_wt_bas2'] - $row_select_pipe['sp_w_s_2']))),2);?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo $row_select_pipe['sp_specific_gravity_2'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;">Apparent Specific Gravity</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">D/D-(B-C)</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php// echo $row_select_pipe['sp_apr1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo $row_select_pipe['sp_apr2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php //echo $row_select_pipe['sp_avg_apr'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: left;width: 50%;border-right: 1px solid;border-bottom: 1px solid;width: 500px;">Water Absorption</td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 600px;">(A-D)/DX100</td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;"></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 200px;"><?php //echo $row_select_pipe['sp_water_abr_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 200px;"><?php //echo $row_select_pipe['sp_water_abr_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;border-bottom: 1px solid;width: 100px;"><?php// echo $row_select_pipe['sp_water_abr'];?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table align="center" style="width: 92%;">
        <tr>
            <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Checked by</td></b>
            <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Analyst</td></b>
      </tr>
    </table>
		
		
		
        <!-- ==========================================deleterious========================== -->
        <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:1px solid black;font-size: 12px;font-family: 'calibri';"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-9816755805,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Deleterious Material</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;;font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $_GET['job_no'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:8</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['txt_qty'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?></td>
            </tr>  
        </table>
            <br><br><br>
        <table align="center" style="width: 95%;border:1px solid black;font-family: 'calibri';"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="font-weight: bold;font-size: 20px;text-align: center;border-bottom: 1px solid;">DELETERIOUS MATERIAL AS PER IS:2386 P-1&2</td>
            </tr>
            <tr>
                <td>(I)Weight of Sample in gm (A)=</td>
            </tr>
            <tr>
                <td>Weight of Washed Retained Sample on 75 micron IS Sieve (after Oven drived) in gm (B)=</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid;">% of Material finer than 75 micron IS Sieve (A-B)x100/A=</td>
            </tr>
            <tr>
                <td>(I)Weight of Oven Sample in gm (A)=</td>
            </tr>
            <tr>
                <td>Weight of Sample after removed of clay lump in gm (B)=</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid;">% of clay & Lump (A-B)x100/A=</td>
            </tr>
            <tr>
                <td>(I)Weight of Sample in gm (A)=</td>
            </tr>
            <tr>
                <td>Weight of decanted pieces in gm (B)=</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid;">% of coal & lignite (B/A)x100=</td>
            </tr>
            <tr>
                <td>Total Deleterious material</td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table align="center" style="width: 92%;">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri';"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri';"><b>Analyst</td></b>
          </tr>
        </table>-->
		
	</page>
	
	<?php //if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null)) {?>
	
			<br>
		<!--<page size="A4" >
		
		
		
		<!--New Table ->
		<table width="94%"  cellspacing="0"
        style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center; border-collapse: collapse;">
        <tr >
            <td style="border:1px solid">logo</td>
            <td colspan="2" style="border:1px solid">
                DCS ENGINEERS & CONSULTANT Pvt. Ltd.<br>
                <b>(Formerly known as DC Consultant)</b><br>
                Mobile: +91-7018819894, +91-9816755805, e-mail: officialdcspvtltd@gmail.com<br>
                <b>Regd, Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</b><br>
                <b>District Kangra Himachal Pradesh (176081)</b>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid"><b>Fine Aggregate</b></td>
            <td style="border:1px solid"><b>ANALYSIS DATA SHEET</b></td>
            <td style="border:1px solid;border-bottom:0px;"><b>QSF-1001</b></td>
        </tr>
    <tr>
    <table width="94%" cellspacing="0"
        style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;border-collapse: collapse;">
        <tr >
            <td style="border:1px solid;border-top:0px;" colspan="2">Job Card No : <?php echo $job_no ?> </td>
            <td style="border:1px solid;border-top:0px;" colspan="2">Test : Seive Analysis </td>
        </tr>
        <tr >
            <td colspan="2" style="border:1px solid;">Sample Description : <?php echo $mt_name; ?> </td>
            <td colspan="2" style="border:1px solid" >Method:IS:2386(Part 1) : 1963 </td>
        </tr>
        <tr>
            <td style="border:1px solid">DOR : <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?> </td>
            <td style="border:1px solid">DOS : <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
            <td style="border:1px solid">DOC : <?php echo date('d-m-Y', strtotime($end_date)); ?> </td>
            <td style="border:1px solid">Page No.1</td>
        </tr>
        <tr>
            <td style="border:1px solid">Sample Qty : 30 Kg</td>
            <td style="border:1px solid">Residual Sample : 27.8 Kg </td>
            <td style="border:1px solid" colspan="2">Sample Retention:</td>
        </tr>
    </table>
</tr>
</table>
		
		<br>
		<table align="center" width="94%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:CENTER ">AGGREGATE DATA ENTRY SHEET FINE AGGREGATE(SIEVE ANALYSIS)</td>
			
						</tr>
					
						
					</table>
				
				</td>
				</tr>
				</tr>
		
		</table>
		<br>
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;">
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;">Sieve Analysis Fine Aggregate[IS:383-2016 table 9]</td>
			
						</tr>
						
						<tr style="margin-top:5px"> 
							
							<td  style="width:20%;">Wt.of Sample for Test <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe["sample_taken"] ?></u> gm</td>
			
						</tr>
					
						
					</table>
				
				</td>
				</tr>
		
		</table>
		
		<table align="center" width="94%" class="test1"
					style="height: 20%; vertical-align: top; border-collapse: collapse;">
		
								<tr>
									<td style="border: 1px solid black; font-weight: bold; text-align: center;" rowspan="2">
										I.S. Sieve <br>(mm)
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" rowspan="2">
										Wt.Retained<br>(gm)
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" rowspan="2">
										% age Wt.Retained <br>(gm)
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" rowspan="2">
										Cum.Wt.<br>Retained
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" rowspan="2">
										% Passing
									</td>
									<td style="border: 1px solid black; font-weight: bold; text-align: center;" colspan="4">
										Limits (IS 383:2016)
									</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;"><strong>Zone
											I</strong></td>
									<td style="border: 1px solid black; text-align: center;"><strong>Zone
											II</strong></td>
									<td style="border: 1px solid black; text-align: center;"><strong>Zone
											III</strong></td>
									<td style="border: 1px solid black; text-align: center;"><strong>Zone
											IV</strong></td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">10 </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_1"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_1"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_1"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_1"] ?></td>
									<td style="border: 1px solid black; text-align: center;">100</td>
									<td style="border: 1px solid black; text-align: center;">100</td>
									<td style="border: 1px solid black; text-align: center;">100</td>
									<td style="border: 1px solid black; text-align: center;">100</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">4.75 </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_2"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_2"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_2"] ?></td>
									<td style="border: 1px solid black; text-align: center;">90-100</td>
									<td style="border: 1px solid black; text-align: center;">90-100</td>
									<td style="border: 1px solid black; text-align: center;">90-100</td>
									<td style="border: 1px solid black; text-align: center;">95-100</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">2.36 </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_3"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_3"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_3"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_3"] ?></td>
									<td style="border: 1px solid black; text-align: center;">60-95</td>
									<td style="border: 1px solid black; text-align: center;">75-100</td>
									<td style="border: 1px solid black; text-align: center;">85-100</td>
									<td style="border: 1px solid black; text-align: center;"> 95-100</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">1.18 </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_4"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_4"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_4"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_4"] ?></td>
									<td style="border: 1px solid black; text-align: center;">30-70 </td>
									<td style="border: 1px solid black; text-align: center;"> 55-90</td>
									<td style="border: 1px solid black; text-align: center;">75-100</td>
									<td style="border: 1px solid black; text-align: center;">90-100</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">0.600</td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_5"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_5"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_5"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_5"] ?></td>
									<td style="border: 1px solid black; text-align: center;">15-34 </td>
									<td style="border: 1px solid black; text-align: center;">35-59</td>
									<td style="border: 1px solid black; text-align: center;">60-79</td>
									<td style="border: 1px solid black; text-align: center;">80-100</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">0.300</td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_6"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_6"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_6"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_6"] ?></td>
									<td style="border: 1px solid black; text-align: center;">5-20 </td>
									<td style="border: 1px solid black; text-align: center;"> 8-30</td>
									<td style="border: 1px solid black; text-align: center;"> 12-40</td>
									<td style="border: 1px solid black; text-align: center;">15-50</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">0.150</td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_wt_gm_7"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["cum_ret_7"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["ret_wt_gm_7"] ?></td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["pass_sample_7"] ?></td>
									<td style="border: 1px solid black; text-align: center;">0-10</td>
									<td style="border: 1px solid black; text-align: center;">0-10</td>
									<td style="border: 1px solid black; text-align: center;">0-10</td>
									<td style="border: 1px solid black; text-align: center;">0-15</td>
								</tr>
								<tr>
									<td style="border: 1px solid black; text-align: center;">Pan </td>
									<td style="border: 1px solid black; text-align: center;"><?php echo $row_select_pipe["sample_taken"] - ($row_select_pipe["cum_wt_gm_1"] + $row_select_pipe["cum_wt_gm_2"]+$row_select_pipe["cum_wt_gm_3"]+$row_select_pipe["cum_wt_gm_4"]+$row_select_pipe["cum_wt_gm_5"]+$row_select_pipe["cum_wt_gm_6"]+$row_select_pipe["cum_wt_gm_7"] )?></td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"></td>
									<td style="border: 1px solid black; text-align: center;"></td>
									<td style="border: 1px solid black; text-align: center;"></td>
									<td style="border: 1px solid black; text-align: center;"></td>
								</tr>
			</table>
			<br>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;">
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;">Sand Sample Passing through <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe["grd_zone"] ?></u> Zone</td>
			
						</tr>
						
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;">Fineness Modulus of Sand = Cummulative % weight retained / 100 = <?php echo $row_select_pipe["grd_fm"] ?> </td>
			
						</tr>
						
					</table>
				
				</td>
				</tr>
		
		</table>
		<br><br><br><br><br>		<br><br><br><br><br>		<br><br><br><br><br> <br><br><br>
		
		<table align="end" width="94%" class="test1"   style=" font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px; padding-left:40px">Checked By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;">Analyst</td>
			</tr>
		</table>
		
		
		<div class="pagebreak"></div>
		<br>
		<br><br><br>

		<table width="94%" border="1" cellspacing="0"
        style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center; border-collapse: collapse;">
        <tr >
            <td style="border:1px solid">logo</td>
            <td colspan="2" style="border:1px solid">
                DCS ENGINEERS & CONSULTANT Pvt. Ltd.<br>
                <b>(Formerly known as DC Consultant)</b><br>
                Mobile: +91-7018819894, +91-9816755805, e-mail: officialdcspvtltd@gmail.com<br>
                <b>Regd, Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</b><br>
                <b>District Kangra Himachal Pradesh (176081)</b>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid"><b>S.G. of F.A. </b></td>
            <td style="border:1px solid"><b>ANALYSIS DATA SHEET</b></td>
            <td style="border:1px solid;border-bottom:0px;"><b>QSF-1001</b></td>
        </tr>
    </table>
    <table width="94%" cellspacing="0"
        style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;border-collapse: collapse;">
        <tr >
            <td style="border:1px solid;border-top:0px;" colspan="2">Job Card No:<?php echo $job_no ?> </td>
            <td style="border:1px solid;border-top:0px;" colspan="2">Test : Specfic Gravity / Water Absorption (F.A.) </td>
        </tr>
        <tr >
            <td colspan="2" style="border:1px solid;">Sample Description:<?php echo $mt_name; ?> </td>
            <td colspan="2" style="border:1px solid" >Method:IS:2386(Part 3) : 1963 </td>
        </tr>
        <tr>
            <td style="border:1px solid">DOR : <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?> </td>
            <td style="border:1px solid">DOS : <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
            <td style="border:1px solid">DOC : <?php echo date('d-m-Y', strtotime($end_date)); ?> </td>
            <td style="border:1px solid">Page No.2</td>
        </tr>
        <tr>
            <td style="border:1px solid">Sample Qty:30 Kg</td>
            <td style="border:1px solid">Residual Sample:26.5 Kg </td>
            <td style="border:1px solid" colspan="2">Sample Retention:</td>
        </tr>
    </table>
		<BR><BR>
		
		<table align="center" width="94%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:CENTER ">SPECIFIC GRAVITY/WATER ABSORPTION (FA) <BR> As Per IS: 2386 PART-3</td>
			
						</tr>
					
						
					</table>
				
				</td>
				</tr>
		
		</table>
		<br>
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;">
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:20%;font-weight:bold;">Specific Gravity/Water Absorption of Coarse Aggregates As Per IS 2386 Part-3</td>
			
						</tr>
					</table>
				
				</td>
				</tr>
		
		</table>
		<table align="center" width="94%" class="test1"
					style="height: 20%; vertical-align: top; border-collapse: collapse;">
		
								<tr>
									<td style="border: 1px solid black; font-weight: bold; text-align: center;" >
									
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" >
										
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" >
										Unit
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;">
										1
									</td><td style="border: 1px solid black; font-weight: bold; text-align: center;" >
										2
									</td>
									<td style="border: 1px solid black; font-weight: bold; text-align: center;">
										Average
									</td>
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Mass of Saturated Surface Dry Aggregate</td>
									<td style="border: 1px solid black; text-align: center;">A</td>
									<td style="border: 1px solid black; text-align: center;"> gm</td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_wt_st_1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_wt_st_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?></td>
									
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Mass of Pycnometercontaning Aggregate and <br> Filled with Distilled Water</td>
									<td style="border: 1px solid black; text-align: center;">B</td>
									<td style="border: 1px solid black; text-align: center;"> gm</td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_wt_bas1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_wt_bas2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?></td>
									
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Mass of Pycnometer Filled with Distilled Water</td>
									<td style="border: 1px solid black; text-align: center;">C</td>
									<td style="border: 1px solid black; text-align: center;"> gm</td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_w_sur_1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_w_sur_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?></td>
									
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Mass of Oven Dry Aggregate</td>
									<td style="border: 1px solid black; text-align: center;">D</td>
									<td style="border: 1px solid black; text-align: center;"> gm</td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_w_s_1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_w_s_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?></td>
									
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Specific Gravity based on dry Aggregate/ weight</td>
									<td style="border: 1px solid black; text-align: center;">D/A-(B-C)</td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_specific_gravity_1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_specific_gravity_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_specific_gravity"] ?></td>
									
								</tr>
								
								<!--<tr>
									<td style="border: 1px solid black; text-align: left;">Specific Gravity based on SSD </td>
									<td style="border: 1px solid black; text-align: center;">A/A-(B-C)</td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe[""] ?></td>
									
								</tr>-> 	
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Apparent Specific Gravity</td>
									<td style="border: 1px solid black; text-align: center;">D/D-(B-C)</td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_apr1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_apr2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_avg_apr"] ?></td>
									
								</tr>
								
								<tr>
									<td style="border: 1px solid black; text-align: left;">Water Absorption</td>
									<td style="border: 1px solid black; text-align: center;">(A-D)/DX100</td>
									<td style="border: 1px solid black; text-align: center;"> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_water_abr_1"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_water_abr_2"] ?> </td>
									<td style="border: 1px solid black; text-align: center;"> <?php echo $row_select_pipe["sp_water_abr"] ?></td>
									
								</tr>
								
								</table>


<br><br><br><br><br>		<br><br><br><br><br>		<br><br><br><br><br> <br><br><br>
		
		<table align="end" width="94%" class="test1"   style=" font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px; padding-left:40px">Checked By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;">Analyst</td>
			</tr>
		</table>
		

		
		
		
				<!--<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON FINE AGGREGATE</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">GRADATION (IS : 2386 (Part-1): 1963; IS 383:2016)</td>
				</tr>
			</table>
			
			
			<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Amount of Sample taken :-</td>
							<td style="padding: 5px;"><?php echo $row_select_pipe["sample_taken"] ?>&nbsp;&nbsp;gm</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Sieve Designation</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Weight Retained on <br> Individual Sieve</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Cummulative Weight <br> Retained</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Cummulative Weight <br> Retained Percentage</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Percentage Passing</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom:2px solid;">mm</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom:2px solid;">gm</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom:2px solid;">gm</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom:2px solid;">%</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom:2px solid;">%</td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">10.0</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_1"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_1"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">4.75</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_2"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_2"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_2"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_2"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">2.36</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_3"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_3"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_3"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_3"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">1.18</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_4"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_4"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_4"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_4"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">0.600</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_5"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_5"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_5"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_5"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">0.300</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_6"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_6"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_6"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_6"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">0.150</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_7"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_7"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_7"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_7"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">0.075</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_wt_gm_8"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["ret_wt_gm_8"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["cum_ret_8"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["pass_sample_8"] ?></td>
						</tr>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;border-bottom:2px solid;"><b>Total</b></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;border-bottom:2px solid;"><?php echo $row_select_pipe["blank_extra"] ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;border-bottom:2px solid;"></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;border-bottom:2px solid;"></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:2px solid;border-bottom:2px solid;"></td>
						</tr>
						<tr>
							<td style="text-align: left;padding: 5px;border: 0;" colspan="5"><b>Fineness Modulus = </b>(Summation of Cummulative Weight Retained Percentage on 10 mm to 150 micron Sieve) / 100 = &nbsp;<u><b><?php echo $row_select_pipe["grd_fm"] ?></b></u></td>
						</tr>
						<tr>
							<td style="text-align: left;padding: 5px;border: 0;"  colspan="2"><b>Zone Classification = &nbsp;<u><?php echo $row_select_pipe["grd_zone"] ?></b></u></td>
							<td style="padding: 5px;text-align: left;"  colspan="3"> &nbsp;&nbsp; (Zone-I/Zone-II/Zone-III/Zone-IV)</td>
						</tr>
					</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DENSITY (IS : 2386 (Part-3): 1963; Clause No.:3)</td>
				</tr>
			</table>
			
			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="5%"style="border: 1px solid black;width:5%;"><center><b>S.N.</b></center></td>
					<td width="46%"style="border: 1px solid black;width:60%;"><center><b>Particular</b></center></td>
					<td width="16.33%"style="border: 1px solid black;width:15%;"><center><b>(I)</b></center></td>
					<td width="16.33%"style="border: 1px solid black;width:15%;"><center><b>(II)</b></center></td>						
					<td width="16.33%"style="border: 1px solid black;width:15%;"><center><b>(III)</b></center></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>1</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of mould + material in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m11']!="" && $row_select_pipe['m11']!="0" && $row_select_pipe['m11']!=null){echo $row_select_pipe['m11']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m12']!="" && $row_select_pipe['m12']!="0" && $row_select_pipe['m12']!=null){echo $row_select_pipe['m12']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m13']!="" && $row_select_pipe['m13']!="0" && $row_select_pipe['m13']!=null){echo $row_select_pipe['m13']; }else{echo " <br>";}?></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>2</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of mould in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m21']!="" && $row_select_pipe['m21']!="0" && $row_select_pipe['m21']!=null){echo $row_select_pipe['m21']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m22']!="" && $row_select_pipe['m22']!="0" && $row_select_pipe['m22']!=null){echo $row_select_pipe['m22']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m23']!="" && $row_select_pipe['m23']!="0" && $row_select_pipe['m23']!=null){echo $row_select_pipe['m23']; }else{echo " <br>";}?></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>3</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of material in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m31']!="" && $row_select_pipe['m31']!="0" && $row_select_pipe['m31']!=null){echo $row_select_pipe['m31']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m32']!="" && $row_select_pipe['m32']!="0" && $row_select_pipe['m32']!=null){echo $row_select_pipe['m32']; }else{echo " <br>";}?></center></td>
					<td style="border: 1px solid black;"><center><?php if($row_select_pipe['m33']!="" && $row_select_pipe['m33']!="0" && $row_select_pipe['m33']!=null){echo $row_select_pipe['m33']; }else{echo " <br>";}?></center></td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;text-align:right;"><b>Average</b></td>
					<td colspan="3" style="border: 1px solid black;"><center><?php if($row_select_pipe['avg_wom']!="" && $row_select_pipe['avg_wom']!="0" && $row_select_pipe['avg_wom']!=null){echo $row_select_pipe['avg_wom']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:left;">&nbsp; <b>Average weight of material = <?php if($row_select_pipe['avg_wom']!="" && $row_select_pipe['avg_wom']!="0" && $row_select_pipe['avg_wom']!=null){echo number_format($row_select_pipe['avg_wom']/100,2); }else{echo "<br>";}?> kg</b></td>
					<td colspan="3" style=""><b>volume of mould = </b> <?php if($row_select_pipe['vol']!="" && $row_select_pipe['vol']!="0" && $row_select_pipe['vol']!=null){echo $row_select_pipe['vol']." m<sup>3</sup>"; }else{echo "<br>";}?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:left;">&nbsp; <b>Bulk loose density = Average weight of material / volume of mould = <?php if($row_select_pipe['bdl']!="" && $row_select_pipe['bdl']!="0" && $row_select_pipe['bdl']!=null){echo $row_select_pipe['bdl']; }else{echo "<br>";}?> kg/m<sup>3</sup></b></td>
				</tr>
			</table>
			
		
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF SPECIFIC GRAVITY & WATER ABSORPTION (IS : 2386 (Part-3): 1963; Clause No : 2.2 Larger than 10 mm)</td>
				</tr>
			</table>
			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				
				<tr>
					<td colspan="7" style="border: 1px solid black;">&nbsp;&nbsp; Weight of Pycnometer Bottle in Water A2= <?php if($row_select_pipe['sp_bask_water']!="" && $row_select_pipe['sp_bask_water']!="0" && $row_select_pipe['sp_bask_water']!=null){echo $row_select_pipe['sp_bask_water']; }else{echo "<br>";}?> gm</td>
				</tr>
			</table>
			<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
				<tr>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample in water with Pycnometer (gm) A1</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of saturated surface dry (gm) B</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample oven dry (gm) C</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample in water (gm) A = A1-A2</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Specific Gravity<br>=C/(B-A)</b></center></td>						
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>(%) water absorption in 24 hours = </b></center></td>						
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Apparent Specific Gravity<br>=C / (C-A)</b></center></td>						
										
				</tr>
				<tr>
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>(B-C)/C x 100</b></center></td>	
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center><b>1</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_bas1']!="" && $row_select_pipe['sp_wt_bas1']!="0" && $row_select_pipe['sp_wt_bas1']!=null){echo $row_select_pipe['sp_wt_bas1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_st_1']!="" && $row_select_pipe['sp_wt_st_1']!="0" && $row_select_pipe['sp_wt_st_1']!=null){echo $row_select_pipe['sp_wt_st_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_s_1']!="" && $row_select_pipe['sp_w_s_1']!="0" && $row_select_pipe['sp_w_s_1']!=null){echo $row_select_pipe['sp_w_s_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_sur_1']!="" && $row_select_pipe['sp_w_sur_1']!="0" && $row_select_pipe['sp_w_sur_1']!=null){echo $row_select_pipe['sp_w_sur_1']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_specific_gravity_1']!="" && $row_select_pipe['sp_specific_gravity_1']!="0" && $row_select_pipe['sp_specific_gravity_1']!=null){echo $row_select_pipe['sp_specific_gravity_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black; "><center><?php if($row_select_pipe['sp_water_abr_1']!="" && $row_select_pipe['sp_water_abr_1']!="0" && $row_select_pipe['sp_water_abr_1']!=null){echo $row_select_pipe['sp_water_abr_1']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black; "><center><?php if($row_select_pipe['sp_apr1']!="" && $row_select_pipe['sp_apr1']!="0" && $row_select_pipe['sp_apr1']!=null){echo $row_select_pipe['sp_apr1']; }else{echo " <br>";}?></center></td>						
									
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_bas2']!="" && $row_select_pipe['sp_wt_bas2']!="0" && $row_select_pipe['sp_wt_bas2']!=null){echo $row_select_pipe['sp_wt_bas2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_st_2']!="" && $row_select_pipe['sp_wt_st_2']!="0" && $row_select_pipe['sp_wt_st_2']!=null){echo $row_select_pipe['sp_wt_st_2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_s_2']!="" && $row_select_pipe['sp_w_s_2']!="0" && $row_select_pipe['sp_w_s_2']!=null){echo $row_select_pipe['sp_w_s_2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_sur_2']!="" && $row_select_pipe['sp_w_sur_2']!="0" && $row_select_pipe['sp_w_sur_2']!=null){echo $row_select_pipe['sp_w_sur_2']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_specific_gravity_2']!="" && $row_select_pipe['sp_specific_gravity_2']!="0" && $row_select_pipe['sp_specific_gravity_2']!=null){echo $row_select_pipe['sp_specific_gravity_2']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_water_abr_2']!="" && $row_select_pipe['sp_water_abr_2']!="0" && $row_select_pipe['sp_water_abr_2']!=null){echo $row_select_pipe['sp_water_abr_2']; }else{echo " <br>";}?></center></td>	
					<td  style="border: 1px solid black; "><center><?php if($row_select_pipe['sp_apr2']!="" && $row_select_pipe['sp_apr2']!="0" && $row_select_pipe['sp_apr2']!=null){echo $row_select_pipe['sp_apr2']; }else{echo " <br>";}?></center></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold;" align="right" colspan="5"><b>Average</b></td>
					<td style="border: 1px solid black; font-weight:bold;"><center><?php if($row_select_pipe['sp_specific_gravity']!="" && $row_select_pipe['sp_specific_gravity']!="0" && $row_select_pipe['sp_specific_gravity']!=null){echo $row_select_pipe['sp_specific_gravity']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black; font-weight:bold;"><center><?php if($row_select_pipe['sp_water_abr']!="" && $row_select_pipe['sp_water_abr']!="0" && $row_select_pipe['sp_water_abr']!=null){echo $row_select_pipe['sp_water_abr']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black; font-weight:bold;"><center><?php if($row_select_pipe['sp_avg_apr']!="" && $row_select_pipe['sp_avg_apr']!="0" && $row_select_pipe['sp_avg_apr']!=null){echo $row_select_pipe['sp_avg_apr']; }else{echo " <br>";}?></center></td>						
					
				</tr>
			</table>
			
			<table align="center" width="100%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
			<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr
			
		</table>
		
		
	<?php //}if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {?>
			
			<div class="pagebreak"></div>
			<br>
	
				<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON FINE AGGREGATE</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
			</table>
			
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF SOUNDNESS (IS:2386(Part-5):1963)</td>
				</tr>
			</table>
		
		<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				<tr>
					<td width="50%" colspan="2"  style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>Method Used :</b></td>
					<td width="50%" colspan="2" style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['sou_con']=="con2"){echo "MgSO<sub>4</sub>";}else{echo "Na<sub>2</sub>SO<sub>4</sub>";}?></td>
					
				</tr>
			</table>
			
			
			
			


			
			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					<td  colspan="2" style="border: 1px solid black;"><center>Sieve Size</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>Grading of <br> Original <br> sample %</center></td>
					<td  style="border: 1px solid black;width:20%;"><center>Weight of test <br> fractions before test In <br> g</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>% passing finer<br> sieve after test<br> (Actual % loss)</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>Weighted <br> average <br> (corrected % loss)</center></td>
					
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;font-weight:bold;width:16%;">Passing</td>
					<td  style="border: 1px solid black;font-weight:bold;width:16%;">Retained</td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;"><center><b>150 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><b>-</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go1']!="" && $row_select_pipe['go1']!="0" && $row_select_pipe['go1']!=null ){echo $row_select_pipe['go1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt1']!="" && $row_select_pipe['wt1']!="0" && $row_select_pipe['wt1']!=null ){echo $row_select_pipe['wt1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp1']!="" && $row_select_pipe['pp1']!="0" && $row_select_pipe['pp1']!=null ){echo $row_select_pipe['pp1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa1']!="" && $row_select_pipe['wa1']!="0" && $row_select_pipe['wa1']!=null ){echo $row_select_pipe['wa1']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>300 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><b>150 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go2']!="" && $row_select_pipe['go2']!="0" && $row_select_pipe['go2']!=null ){echo $row_select_pipe['go2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt2']!="" && $row_select_pipe['wt2']!="0" && $row_select_pipe['wt2']!=null ){echo $row_select_pipe['wt2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp2']!="" && $row_select_pipe['pp2']!="0" && $row_select_pipe['pp2']!=null ){echo $row_select_pipe['pp2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa2']!="" && $row_select_pipe['wa2']!="0" && $row_select_pipe['wa2']!=null ){echo $row_select_pipe['wa2']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>600 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><b>300 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go3']!="" && $row_select_pipe['go3']!="0" && $row_select_pipe['go3']!=null ){echo $row_select_pipe['go3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt3']!="" && $row_select_pipe['wt3']!="0" && $row_select_pipe['wt3']!=null ){echo $row_select_pipe['wt3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp3']!="" && $row_select_pipe['pp3']!="0" && $row_select_pipe['pp3']!=null ){echo $row_select_pipe['pp3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa3']!="" && $row_select_pipe['wa3']!="0" && $row_select_pipe['wa3']!=null ){echo $row_select_pipe['wa3']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>1.18 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>600 mic</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go4']!="" && $row_select_pipe['go4']!="0" && $row_select_pipe['go4']!=null ){echo $row_select_pipe['go4']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt4']!="" && $row_select_pipe['wt4']!="0" && $row_select_pipe['wt4']!=null ){echo $row_select_pipe['wt4']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp4']!="" && $row_select_pipe['pp4']!="0" && $row_select_pipe['pp4']!=null ){echo $row_select_pipe['pp4']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa4']!="" && $row_select_pipe['wa4']!="0" && $row_select_pipe['wa4']!=null ){echo $row_select_pipe['wa4']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>2.36 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>1.18 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go5']!="" && $row_select_pipe['go5']!="0" && $row_select_pipe['go5']!=null ){echo $row_select_pipe['go5']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt5']!="" && $row_select_pipe['wt5']!="0" && $row_select_pipe['wt5']!=null ){echo $row_select_pipe['wt5']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp5']!="" && $row_select_pipe['pp5']!="0" && $row_select_pipe['pp5']!=null ){echo $row_select_pipe['pp5']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa5']!="" && $row_select_pipe['wa5']!="0" && $row_select_pipe['wa5']!=null ){echo $row_select_pipe['wa5']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>4.75 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>2.36 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go6']!="" && $row_select_pipe['go6']!="0" && $row_select_pipe['go6']!=null ){echo $row_select_pipe['go6']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt6']!="" && $row_select_pipe['wt6']!="0" && $row_select_pipe['wt6']!=null ){echo $row_select_pipe['wt6']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp6']!="" && $row_select_pipe['pp6']!="0" && $row_select_pipe['pp6']!=null ){echo $row_select_pipe['pp6']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa6']!="" && $row_select_pipe['wa6']!="0" && $row_select_pipe['wa6']!=null ){echo $row_select_pipe['wa6']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>10 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>4.75 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['go7']!="" && $row_select_pipe['go7']!="0" && $row_select_pipe['go7']!=null ){echo $row_select_pipe['go7']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wt7']!="" && $row_select_pipe['wt7']!="0" && $row_select_pipe['wt7']!=null ){echo $row_select_pipe['wt7']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['pp7']!="" && $row_select_pipe['pp7']!="0" && $row_select_pipe['pp7']!=null ){echo $row_select_pipe['pp7']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['wa7']!="" && $row_select_pipe['wa7']!="0" && $row_select_pipe['wa7']!=null ){echo $row_select_pipe['wa7']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><b></b></td>
					<td  style="border: 1px solid black;"><b>Total</b></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null ){echo $row_select_pipe['soundness']; }else{echo "<br>";}?></center></td>
					
				</tr>
			</table>			
			
			<table align="center" width="100%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<!--<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr
			
		</table>
			
			
	<?php //}
	if (($row_select_pipe['ans_lbd'] != "" && $row_select_pipe['ans_lbd'] != "0" && $row_select_pipe['ans_lbd'] != null) || ($row_select_pipe['fmc_7'] != "" && $row_select_pipe['fmc_7'] != "0" && $row_select_pipe['fmc_7'] != null)) {?>
			<div class="pagebreak"></div>
		<br>
	
				<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON FINE AGGREGATE</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">BULKING OF SAND (IS : 2386 (Part-3): 1963 Reaffirmed 2021 clause no. 4.3.3)</td>
				</tr>
			</table>
			
			


			<table align="center" width="100%" class="test1"  height="10%" style="border: 1px solid black; font-family : Calibri;">
				<tr>
				<td colspan="4" style="">
				<b>% OF BULKING = (200/y)-1x100</b>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="">
				<b>where, y= surface of sand in the cylinder after filling water.</b>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="">
			<table align="center" width="41%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>y, ml</center></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['lbd_1']!="" && $row_select_pipe['lbd_1']!="0" && $row_select_pipe['lbd_1']!=null){echo $row_select_pipe['lbd_1']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;font-weight:bold;">% of Bulking</td>
					<td  style="border: 1px solid black;"><?php if($row_select_pipe['ans_lbd']!="" && $row_select_pipe['ans_lbd']!="0" && $row_select_pipe['ans_lbd']!=null){echo $row_select_pipe['ans_lbd']; }else{echo " <br>";}?></td>
					
				</tr>
				
			</table>
				</td></tr>
			</table>
			
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">SURFACE MOISTRURE IN AGGREGATE (IS : 2386 (Part-3): 1963)</td>
				</tr>
			</table>
			<table align="center" width="100%" class="test1"  height="10%" style="border: 1px solid black; font-family : Calibri;">
				<tr>
				<td colspan="4" style="">
				<b>Method of the Determination : By Weight</b>
				</td>
				</tr>
				<tr>
				<td colspan="4" style="">
				<b>Specific Gravity:</b><?php if($row_select_pipe['fmc_sp']!="" && $row_select_pipe['fmc_sp']!="0" && $row_select_pipe['fmc_sp']!=null){echo $row_select_pipe['fmc_sp']; }else{echo " <br>";}?>
				</td>
				</tr>
				
				<tr>
				<td colspan="4" style="text-align:center">
				<b>Observation Table</b>
				</td>
				</tr>
				
				<tr>
				<td colspan="4" style="">
			<table align="center" width="50%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>Sr. No.</center></td>
					<td colspan="2"style="border: 1px solid black;font-weight:bold;"><center>Description</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>Weight in g.</center></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>1</center></td>
					<td style="border: 1px solid black;font-weight:bold;">Mc =</td>
					<td style="border: 1px solid black;font-weight:bold;">Weight in g of container filled up to the mark with water</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_1']!="" && $row_select_pipe['fmc_1']!="0" && $row_select_pipe['fmc_1']!=null){echo $row_select_pipe['fmc_1']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>2</center></td>
					<td style="border: 1px solid black;font-weight:bold;">Ms =</td>
					<td style="border: 1px solid black;font-weight:bold;">Weight in g of the sample</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_2']!="" && $row_select_pipe['fmc_2']!="0" && $row_select_pipe['fmc_2']!=null){echo $row_select_pipe['fmc_2']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>3</center></td>
					<td style="border: 1px solid black;font-weight:bold;">M =</td>
					<td style="border: 1px solid black;font-weight:bold;">Weight in g of the sample and container filled to the mark with water</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_3']!="" && $row_select_pipe['fmc_3']!="0" && $row_select_pipe['fmc_3']!=null){echo $row_select_pipe['fmc_3']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>4</center></td>
					<td style="border: 1px solid black;font-weight:bold;">Vs =</td>
					<td style="border: 1px solid black;font-weight:bold;">Weight in g of the water displaced by the sample ( Mc + Ms -M )</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_4']!="" && $row_select_pipe['fmc_4']!="0" && $row_select_pipe['fmc_4']!=null){echo $row_select_pipe['fmc_4']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>5</center></td>
					<td style="border: 1px solid black;font-weight:bold;">Vd =</td>
					<td style="border: 1px solid black;font-weight:bold;">Weight of the sample (Ms) / Specific Gravity </td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_5']!="" && $row_select_pipe['fmc_5']!="0" && $row_select_pipe['fmc_5']!=null){echo $row_select_pipe['fmc_5']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>6</center></td>
					<td style="border: 1px solid black;font-weight:bold;">P1 =</td>
					<td style="border: 1px solid black;font-weight:bold;">(Vs - Vd / Ms - Vs) X 100</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_6']!="" && $row_select_pipe['fmc_6']!="0" && $row_select_pipe['fmc_6']!=null){echo $row_select_pipe['fmc_6']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>7</center></td>
					<td style="border: 1px solid black;font-weight:bold;">P2 =</td>
					<td style="border: 1px solid black;font-weight:bold;">(Vs - Vd / Ms - Vd) X 100</td>
					<td style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['fmc_7']!="" && $row_select_pipe['fmc_7']!="0" && $row_select_pipe['fmc_7']!=null){echo $row_select_pipe['fmc_7']; }else{echo " <br>";}?></td>
					
					
				</tr>
				
			</table>
				</td></tr>
				
			</table>
			<table align="center" width="100%" class="test1"  style="border-left: 1px solid black;border-right: 1px solid black; font-family : Calibri; ">
				<tr>
					<td width="50%" rowspan="2" colspan="2" >&nbsp;&nbsp; </td>
					
				</tr>
				
				
			</table>
			<table align="center" width="100%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<!--<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr
			
		</table>
	<?php }
	if (($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null)  || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null) || ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null)) {?>
		<div class="pagebreak"></div>
			<br>
	
				<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON FINE AGGREGATE</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Material finer than 75 micron sieve (IS 2386 (Part I) 1963)</td>
				</tr>
			</table>
		
			
			
			
			
			
			


			
			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					
					<td  style="border: 1px solid black;width:10%;"><center>Sr. No.</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Original Dry Weight, g (B)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Dry weight after washing, g (C)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Percentage of material finer than 75 microns, (A) , A=B-C*100/B)</center></td>
					
				</tr>
				
				<tr style="text-align:center;font-weight:bold;">
					
					<td  style="border: 1px solid black;"><center>1</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['finer_a']!="" && $row_select_pipe['finer_a']!="0" && $row_select_pipe['finer_a']!=null ){echo $row_select_pipe['finer_a']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['finer_b']!="" && $row_select_pipe['finer_b']!="0" && $row_select_pipe['finer_b']!=null ){echo $row_select_pipe['finer_b']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['avg_finer']!="" && $row_select_pipe['avg_finer']!="0" && $row_select_pipe['avg_finer']!=null ){echo $row_select_pipe['avg_finer']; }else{echo "<br>";}?></center></td>
				</tr>
				
			</table>			
		
		<table align="center" width="100%" class="test1"  style="border-left: 1px solid black;border-right: 1px solid black; font-family : Calibri; ">
				<tr>
					<td width="50%" rowspan="2" colspan="2" >&nbsp;&nbsp; </td>
					
				</tr>
				
				
			</table>
		

			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Clay Lump (IS 2386 (Part II) 1963)</td>
				</tr>
			</table>
		

			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					
					<td  style="border: 1px solid black;width:10%;"><center>Sr. No.</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Wt of Sample gm (W)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>After broken with finger then passing 2.36mm IS sieve gm (R)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>% Clay lumps = (W-R)/R X 100</center></td>
					
				</tr>
				
				<tr style="text-align:center;font-weight:bold;">
					
					<td  style="border: 1px solid black;"><center>1</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_1']!="" && $row_select_pipe['dele_2_1']!="0" && $row_select_pipe['dele_2_1']!=null ){echo $row_select_pipe['dele_2_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_2']!="" && $row_select_pipe['dele_2_2']!="0" && $row_select_pipe['dele_2_2']!=null ){echo $row_select_pipe['dele_2_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!="0" && $row_select_pipe['dele_2_3']!=null ){echo $row_select_pipe['dele_2_3']; }else{echo "<br>";}?></center></td>
				</tr>
			</table>			
		


			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">% Coal And Lignite (IS 2386 (Part II) 1963)</td>
				</tr>
			</table>

			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					
					<td  style="border: 1px solid black;width:10%;"><center>Sr. No.</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Wt of sample gm (W1)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Introduce in to heavy liquid wt gm (W2)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>% Coal & Ligntie = (W1-W2)/W1*100</center></td>
					
				</tr>
				
				<tr style="text-align:center;font-weight:bold;">
					
					<td  style="border: 1px solid black;"><center>1</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_1']!="" && $row_select_pipe['dele_3_1']!="0" && $row_select_pipe['dele_3_1']!=null ){echo $row_select_pipe['dele_3_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_2']!="" && $row_select_pipe['dele_3_2']!="0" && $row_select_pipe['dele_3_2']!=null ){echo $row_select_pipe['dele_3_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_3']!="" && $row_select_pipe['dele_3_3']!="0" && $row_select_pipe['dele_3_3']!=null ){echo $row_select_pipe['dele_3_3']; }else{echo "<br>";}?></center></td>
				</tr>
			</table>



			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">% Soft Particle (IS 2386 (Part II) 1963)</td>
				</tr>
			</table>

			<table align="center" width="100%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					
					<td  style="border: 1px solid black;width:10%;"><center>Sr. No.</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Weight of sample as per IS 2386(P-2), CL no 5.3.1 gms(A)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>Weight of soft particle broken from surfce after brass rod rubbing gms (B)</center></td>
					<td  style="border: 1px solid black;width:30%;"><center>% Soft particle = B/A *100</center></td>
					
				</tr>
				
				<tr style="text-align:center;font-weight:bold;">
					
					<td  style="border: 1px solid black;"><center>1</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_4_1']!="" && $row_select_pipe['dele_4_1']!="0" && $row_select_pipe['dele_4_1']!=null ){echo $row_select_pipe['dele_4_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_4_2']!="" && $row_select_pipe['dele_4_2']!="0" && $row_select_pipe['dele_4_2']!=null ){echo $row_select_pipe['dele_4_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_4_3']!="" && $row_select_pipe['dele_4_3']!="0" && $row_select_pipe['dele_4_3']!=null ){echo $row_select_pipe['dele_4_3']; }else{echo "<br>";}?></center></td>
				</tr>
				
			</table>















		<table align="center" width="100%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<!--<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr
		</table>-->
			
			
	<?php }
	?>
		

</body>

</html>


<script type="text/javascript">


</script>