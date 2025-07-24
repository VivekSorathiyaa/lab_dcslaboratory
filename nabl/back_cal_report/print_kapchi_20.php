	<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>

	@page { 
	margin: 0; 
	}
	
	.pagebreak { 
	page-break-before: always; 
	}
	
	page[size="A4"] 
	{
	width: 29.7cm;
	height: 21cm;
	
	} 

</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family : Calibri;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family : Calibri;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family : Calibri;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family : Calibri;
}
.details{
	margin:0px auto;
	padding:0px;
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
			$tbl = $_GET['tbl_name'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];	


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
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
			}
			else
			{
				$con_sample = "Unsealed";
			}
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
			$result_select1 = mysqli_query($conn, $select_query1);

			if (mysqli_num_rows($result_select1) > 0) {
				$row_select1 = mysqli_fetch_assoc($result_select1);
				$agency_name= $row_select1['agency_name'];
			}
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$mt_name= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source= $row_select4['agg_source'];
					$sample_de= $row_select4['sample_de'];
					// include_once 'sample_id.php';
				}
				
				
				$totalcnt=0;
				$pagecnt=1;
				if(($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null) || ($row_select_pipe['cru_value']!="" && $row_select_pipe['cru_value']!="0" && $row_select_pipe['cru_value']!=null) || ($row_select_pipe['abr_index']!="" && $row_select_pipe['abr_index']!="0" && $row_select_pipe['abr_index']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
				{
					$totalcnt++;
				}
				
				
				if(($row_select_pipe['fi_index']!="" && $row_select_pipe['fi_index']!="0" && $row_select_pipe['fi_index']!=null))
				{
					$totalcnt++;
				}
				
				
				if(($row_select_pipe['pass_sample_1']!="" && $row_select_pipe['pass_sample_1']!="0" && $row_select_pipe['pass_sample_1']!=null) || ($row_select_pipe['sp_specific_gravity']!="" && $row_select_pipe['sp_specific_gravity']!="0" && $row_select_pipe['sp_specific_gravity']!=null) || ($row_select_pipe['bdl']!="" && $row_select_pipe['bdl']!="0" && $row_select_pipe['bdl']!=null))
				{
					$totalcnt++;
				}
				
				
				if(($row_select_pipe['strip_per']!="" && $row_select_pipe['strip_per']!="0" && $row_select_pipe['strip_per']!=null) || ($row_select_pipe['fines_value']!="" && $row_select_pipe['fines_value']!="0" && $row_select_pipe['fines_value']!=null))
				{
					$totalcnt++;
				}

				
				
				if(($row_select_pipe['omc_3']!="" && $row_select_pipe['omc_3']!="0" && $row_select_pipe['omc_3']!=null) || ($row_select_pipe['dele_3_3']!="" && $row_select_pipe['dele_3_3']!="0" && $row_select_pipe['dele_3_3']!=null) || ($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!="0" && $row_select_pipe['dele_2_3']!=null) || ($row_select_pipe['dele_1_3']!="" && $row_select_pipe['dele_1_3']!="0" && $row_select_pipe['dele_1_3']!=null) || ($row_select_pipe['alk_10']!="" && $row_select_pipe['alk_10']!="0" && $row_select_pipe['alk_10']!=null))
				{
					$totalcnt++;
				}				
				if($row_select_pipe['liquide_limit']!="" && $row_select_pipe['liquide_limit']!="0" && $row_select_pipe['liquide_limit']!=null)
				{
					$totalcnt++;
				}

				if($_GET['tbl_name'] == 'carpet_6_10_mm'){
					$row_select_pipe['pass_range_1'] = '90';
					$row_select_pipe['pass_range_2'] = '90-90';
					$row_select_pipe['pass_range_3'] = '10-30';
					$row_select_pipe['pass_range_4'] = '0-5';
					$row_select_pipe['pass_range_5'] = '';
					$row_select_pipe['pass_range_6'] = '';
					$row_select_pipe['pass_range_7'] = '';
					$row_select_pipe['pass_range_8'] = '';
					$row_select_pipe['pass_range_9'] = '';
					$row_select_pipe['pass_range_10'] = '';
					$row_select_pipe['pass_range_11'] = '';
					$row_select_pipe['pass_range_12'] = '';
				}else if($_GET['tbl_name'] == 'ca_10_12mm'){
					$row_select_pipe['pass_range_1'] = '90';
					$row_select_pipe['pass_range_2'] = '90-90';
					$row_select_pipe['pass_range_3'] = '40-85';
					$row_select_pipe['pass_range_4'] = '0-10';
					$row_select_pipe['pass_range_5'] = '';
					$row_select_pipe['pass_range_6'] = '';
					$row_select_pipe['pass_range_7'] = '';
					$row_select_pipe['pass_range_8'] = '';
					$row_select_pipe['pass_range_9'] = '';
					$row_select_pipe['pass_range_10'] = '';
					$row_select_pipe['pass_range_11'] = '';
					$row_select_pipe['pass_range_12'] = '';
				}else if($_GET['tbl_name'] == 'gsb_53_26_5_mm'){
					$row_select_pipe['pass_range_1'] = '90';
					$row_select_pipe['pass_range_2'] = '95-90';
					$row_select_pipe['pass_range_3'] = '65-90';
					$row_select_pipe['pass_range_4'] = '0-10';
					$row_select_pipe['pass_range_5'] = '0-5';
					$row_select_pipe['pass_range_6'] = '';
					$row_select_pipe['pass_range_7'] = '';
					$row_select_pipe['pass_range_8'] = '';
					$row_select_pipe['pass_range_9'] = '';
					$row_select_pipe['pass_range_10'] = '';
					$row_select_pipe['pass_range_11'] = '';
					$row_select_pipe['pass_range_12'] = '';
				}else if($_GET['tbl_name'] == 'carpet_10_20_mm'){
					$row_select_pipe['pass_range_1'] = '90';
					$row_select_pipe['pass_range_2'] = '85-90';
					$row_select_pipe['pass_range_3'] = '0-20';
					$row_select_pipe['pass_range_4'] = '0-5';
					$row_select_pipe['pass_range_5'] = '';
					$row_select_pipe['pass_range_6'] = '';
					$row_select_pipe['pass_range_7'] = '';
					$row_select_pipe['pass_range_8'] = '';
					$row_select_pipe['pass_range_9'] = '';
					$row_select_pipe['pass_range_10'] = '';
					$row_select_pipe['pass_range_11'] = '';
					$row_select_pipe['pass_range_12'] = '';
				}else if($_GET['tbl_name'] == 'dbm_26_5_19_0_mm'){
					$row_select_pipe['pass_range_6'] = '0-1.5';
					$row_select_pipe['pass_range_7'] = '';
					$row_select_pipe['pass_range_8'] = '';
					$row_select_pipe['pass_range_9'] = '';
					$row_select_pipe['pass_range_10'] = '';
					$row_select_pipe['pass_range_11'] = '';
					$row_select_pipe['pass_range_12'] = '';
				}
				
				
				
				//if(($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null) || ($row_select_pipe['cru_value']!="" && $row_select_pipe['cru_value']!="0" && $row_select_pipe['cru_value']!=null) || ($row_select_pipe['abr_index']!="" && $row_select_pipe['abr_index']!="0" && $row_select_pipe['abr_index']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null)){
		?>
		
		
			
		<page size="A4" >
		 <?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null) {?>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;<?php echo $mt_name;?>&nbsp;(SIEVE ANALYSIS)</td>
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
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;1</td>
            </tr>
			 <tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
            </tr>         
    </table>			
						
<br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="5px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 25px;font-weight: bold;" colspan="7"> <?php echo $mt_name;?> (SIEVE ANALYSIS)</td>
        </tr>
    </table>
    <br>
    <table align="center" style="width: 95%;" cellpadding="10px">
        <tr>
            <td style="font-family: 'calibri';font-size: 16px;font-weight: bold;">  Sieve Analysis <?php echo $mt_name;?> [As Per Morth’s Specification]</td>
        </tr>
        <tr>
            <td> Sieve Analysis Coarse Aggregate As Per [IS: 383-2016 Table 7]</td>
        </tr>
		 <tr>
            <td> Aggregate Size ………<?php echo $mt_name;?>…………………</td>
            <td> Wt. of Sample for Test <u>&nbsp; &nbsp; <?php echo $row_select_pipe['sample_taken'];?> &nbsp; &nbsp;</u>gm</td>
        </tr>
		
  </table>
			
	<table  align="center" style="width: 95%;text-align: center;border-bottom:1px solid;" cellspacing="0" cellpadding="5px">
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">IS Sieve <br>(mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Wt. Retained</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold"> % age Weight  <br>Retained 
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Cumulative % Wt.  <br>Retained</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">% Passing</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 15px;font-weight: bold">Limits</td>
        </tr>
				<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null) {?>
<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_1'];?></td>
        </tr>
				<?php } if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_2'];?></td>
        </tr>
				<?php } if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_3'];?></td>
        </tr>
		<?php } if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_4'];?></td>
        </tr>
		<?php } if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_5'];?></td>
        </tr>
		<?php } if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_6'];?></td>
        </tr>
		<?php } if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_7'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_7'];?></td>
        </tr>
		<?php } if ($row_select_pipe['pass_sample_8'] != "" && $row_select_pipe['pass_sample_8'] != null) {?>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sieve_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_wt_gm_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['ret_wt_gm_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['cum_ret_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['pass_sample_8'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pass_range_8'];?></td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
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
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;(IMPACT VALUE)</td>
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
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;3</td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
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
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;4</td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Bulk Density (Compacted)</td>
            </tr>
			<tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;5</td>
            </tr>
			 <tr>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Bulk Density (Loose)</td>
            </tr>
			<tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $sample_de;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;As per MORTH
            specification</td>
            </tr>
		    <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;6</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Flakiness And Elongation</td>
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
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;4</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Deleterious Material</td>
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
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;8</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 20px;"><?php echo $mt_name;?></td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
			<tr>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td  class="report-cell"  style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;Specific Gravity & Water Absorption</td>
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
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;5</td>
            </tr>
			 <tr>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php echo $row_select_pipe['qty_1'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php echo $row_select_pipe['r_sam'];?></td>
                <td class="report-cell"   style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php echo $row_select_pipe['s_ret'];?> </td>
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
				<!-- <table align="center" width="90%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
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
							
							<td  style="width:90%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF IMPACT VALUE (IS 2386 (Part-4):1963; Clause 4)</td>
				</tr>
			</table>
		
		<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Sr No.</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Net Weight of Aggregate, g (A)</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Weight of fraction passing 2.36mm IS Sieve, g (B)</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Weight of fraction retained on 2.36mm IS Sieve, g (C)</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Total<br>(B+C)</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;">Impact Value % <br> = B/A x 90</td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">1.</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_a_1']!="" && $row_select_pipe['imp_w_m_a_1']!="0" && $row_select_pipe['imp_w_m_a_1']!=null){echo $row_select_pipe['imp_w_m_a_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_b_1']!="" && $row_select_pipe['imp_w_m_b_1']!="0" && $row_select_pipe['imp_w_m_b_1']!=null){echo $row_select_pipe['imp_w_m_b_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_c_1']!="" && $row_select_pipe['imp_w_m_c_1']!="0" && $row_select_pipe['imp_w_m_c_1']!=null){echo $row_select_pipe['imp_w_m_c_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_b_1']!="" && $row_select_pipe['imp_w_m_b_1']!="0" && $row_select_pipe['imp_w_m_b_1']!=null){
						$b = floatVal($row_select_pipe['imp_w_m_b_1']);
						$c = floatVal($row_select_pipe['imp_w_m_c_1']);
						$ans1 = $b + $c;
						echo number_format($ans1,1); }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_value_1']!="" && $row_select_pipe['imp_value_1']!="0" && $row_select_pipe['imp_value_1']!=null){echo $row_select_pipe['imp_value_1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2.</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_a_2']!="" && $row_select_pipe['imp_w_m_a_2']!="0" && $row_select_pipe['imp_w_m_a_2']!=null){echo $row_select_pipe['imp_w_m_a_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_b_2']!="" && $row_select_pipe['imp_w_m_b_2']!="0" && $row_select_pipe['imp_w_m_b_2']!=null){echo $row_select_pipe['imp_w_m_b_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_c_2']!="" && $row_select_pipe['imp_w_m_c_2']!="0" && $row_select_pipe['imp_w_m_c_2']!=null){echo $row_select_pipe['imp_w_m_c_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_w_m_b_2']!="" && $row_select_pipe['imp_w_m_b_2']!="0" && $row_select_pipe['imp_w_m_b_2']!=null){
						$b1 = floatVal($row_select_pipe['imp_w_m_b_2']);
						$c1 = floatVal($row_select_pipe['imp_w_m_c_2']);
						$ans2 = $b1 + $c1;
						echo number_format($ans2,1); }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['imp_value_2']!="" && $row_select_pipe['imp_value_2']!="0" && $row_select_pipe['imp_value_2']!=null){echo $row_select_pipe['imp_value_2']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black; text-align:right;font-weight:bold;"> Average Impact Value, %</td>
					
					
					<td style="border: 1px solid black; text-align:center;">
						<?php 
						if(($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null) || ($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null)){
							
							
							 echo $row_select_pipe['imp_value'];
						}?>
					</td>
				</tr>
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: justify; padding: 5px;border-top: 0;" colspan="6">Note- If  the  total  weight  (B+C) is  less  than  the  initial  weight  (Weight  A)  by  more  than  one  gram,  the  result shall  be  discarded  and  fresh  test to be made.  </td>
				</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF CRUSHING VALUE (IS:2386 (Part-4):1963, Claue : 2)</td>
				</tr>
			</table>
		
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Sr. No.</td>
					<td width="30%" style="border: 1px solid black; font-weight:bold;text-align:center;"> Weight of Aggregate passing 12.5mm IS Sieve and retained on 10mm IS Sieve, g (A)</td>
					<td width="30%" style="border: 1px solid black; font-weight:bold;text-align:center;">Weight of fraction passing 2.36mm IS Sieve, g (B)</td>
					<td  width="30%"style="border: 1px solid black; font-weight:bold;text-align:center;">Crushing  Value=B/Ax100</td>
					
				</tr>
				<tr>
					<td   style="border: 1px solid black; text-align:center;">1</td>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cr_a_1']!="" && $row_select_pipe['cr_a_1']!="0" && $row_select_pipe['cr_a_1']!=null){echo $row_select_pipe['cr_a_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cr_b_1']!="" && $row_select_pipe['cr_b_1']!="0" && $row_select_pipe['cr_b_1']!=null){echo $row_select_pipe['cr_b_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cru_value_1']!="" && $row_select_pipe['cru_value_1']!="0" && $row_select_pipe['cru_value_1']!=null){echo $row_select_pipe['cru_value_1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td   style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cr_a_2']!="" && $row_select_pipe['cr_a_2']!="0" && $row_select_pipe['cr_a_2']!=null){echo $row_select_pipe['cr_a_2']; }else{echo " <br>";}?></td>										
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cr_b_2']!="" && $row_select_pipe['cr_b_2']!="0" && $row_select_pipe['cr_b_2']!=null){echo $row_select_pipe['cr_b_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cru_value_2']!="" && $row_select_pipe['cru_value_2']!="0" && $row_select_pipe['cru_value_2']!=null){echo $row_select_pipe['cru_value_2']; }else{echo " <br>";}?></td>
				</tr>
				
				<tr>
					
					<td colspan="3"  style="border: 1px solid black; font-weight:bold;text-align:right; "> Average Crushing Value, %</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;"><?php if($row_select_pipe['cru_value']!="" && $row_select_pipe['cru_value']!="0" && $row_select_pipe['cru_value']!=null){echo $row_select_pipe['cru_value']; }else{echo " <br>";}?></td>
				</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF ABRASION VALUE (IS:2386 (Part-4):1963, Claue : 5)</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Sr. No.</td>
					<td width="22%" style="border: 1px solid black; font-weight:bold;text-align:center;">Original Weight of Test Sample, g (A)</td>
					<td width="22%" style="border: 1px solid black; font-weight:bold;text-align:center;">Weight of Fraction of Sample retained on 1.7mm IS Sieve, g (B)</td>
					<td  width="22%"style="border: 1px solid black; font-weight:bold;text-align:center;">Weight of Fraction of sample passing on 1.7mm IS Sieve, g (C) = A - B  </td>
					<td  width="22%"style="border: 1px solid black; font-weight:bold;text-align:center;">Abrasion Value=C/Ax100</td>
					
				</tr>
				<tr>
					<td   style="border: 1px solid black; text-align:center;">1</td>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_a_1']!="" && $row_select_pipe['abr_wt_t_a_1']!="0" && $row_select_pipe['abr_wt_t_a_1']!=null){echo $row_select_pipe['abr_wt_t_a_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_b_1']!="" && $row_select_pipe['abr_wt_t_b_1']!="0" && $row_select_pipe['abr_wt_t_b_1']!=null){echo $row_select_pipe['abr_wt_t_b_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_c_1']!="" && $row_select_pipe['abr_wt_t_c_1']!="0" && $row_select_pipe['abr_wt_t_c_1']!=null){echo $row_select_pipe['abr_wt_t_c_1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_1']!="" && $row_select_pipe['abr_1']!="0" && $row_select_pipe['abr_1']!=null){echo $row_select_pipe['abr_1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td   style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_a_2']!="" && $row_select_pipe['abr_wt_t_a_2']!="0" && $row_select_pipe['abr_wt_t_a_2']!=null){echo $row_select_pipe['abr_wt_t_a_2']; }else{echo " <br>";}?></td>										
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_b_2']!="" && $row_select_pipe['abr_wt_t_b_2']!="0" && $row_select_pipe['abr_wt_t_b_2']!=null){echo $row_select_pipe['abr_wt_t_b_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_wt_t_c_2']!="" && $row_select_pipe['abr_wt_t_c_2']!="0" && $row_select_pipe['abr_wt_t_c_2']!=null){echo $row_select_pipe['abr_wt_t_c_2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['abr_2']!="" && $row_select_pipe['abr_2']!="0" && $row_select_pipe['abr_2']!=null){echo $row_select_pipe['abr_2']; }else{echo " <br>";}?></td>
				</tr>
				
				<tr>
					
					<td colspan="4"  style="border: 1px solid black; font-weight:bold;text-align:right; "> Average Abrasion Value, %</td>
					<td style="border: 1px solid black; text-align:center; font-weight:bold;"><?php if($row_select_pipe['abr_index']!="" && $row_select_pipe['abr_index']!="0" && $row_select_pipe['abr_index']!=null){echo $row_select_pipe['abr_index']; }else{echo " <br>";}?></td>
				</tr>
			</table>
			
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF SOUNDNESS (IS:2386(Part-5):1963, Clause No.: 3.0)</td>
				</tr>
			</table>
		
		<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				<tr>
					<td width="50%" colspan="2"  style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>Method Used :</b></td>
					<td width="50%" colspan="2" style="border: 1px solid black;">&nbsp;&nbsp; <?php if($row_select_pipe['sou_con']=="con2"){echo "MgSO<sub>4</sub>";}else{echo "Na<sub>2</sub>SO<sub>4</sub>";}?></td>
					
				</tr>
			</table>
			
			
			
			


			
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					<td  style="border: 1px solid black;"><center>Sieve Size</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>Grading of <br> Original <br> sample %</center></td>
					<td  style="border: 1px solid black;width:20%;"><center>Weight of test <br> fractions before test In <br> g</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>% passing finer<br> sieve after test<br> (Actual % loss)</center></td>
					<td  style="border: 1px solid black;width:16%;"><center>Weighted <br> average <br> (corrected % loss)</center></td>
					
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;font-weight:bold;width:16%;">Passing</td>
					<td  style="border: 1px solid black;font-weight:bold;width:16%;">Retained</td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s41']!="" && $row_select_pipe['s41']!="0" && $row_select_pipe['s41']!=null ){echo $row_select_pipe['s41']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s51']!="" && $row_select_pipe['s51']!="0" && $row_select_pipe['s51']!=null ){echo $row_select_pipe['s51']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s61']!="" && $row_select_pipe['s61']!="0" && $row_select_pipe['s61']!=null ){echo $row_select_pipe['s61']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>63 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>40 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s42']!="" && $row_select_pipe['s42']!="0" && $row_select_pipe['s42']!=null ){echo $row_select_pipe['s42']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s52']!="" && $row_select_pipe['s52']!="0" && $row_select_pipe['s52']!=null ){echo $row_select_pipe['s52']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s62']!="" && $row_select_pipe['s62']!="0" && $row_select_pipe['s62']!=null ){echo $row_select_pipe['s62']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>40 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>20 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s43']!="" && $row_select_pipe['s43']!="0" && $row_select_pipe['s43']!=null ){echo $row_select_pipe['s43']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s53']!="" && $row_select_pipe['s53']!="0" && $row_select_pipe['s53']!=null ){echo $row_select_pipe['s53']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s63']!="" && $row_select_pipe['s63']!="0" && $row_select_pipe['s63']!=null ){echo $row_select_pipe['s63']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>20 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>10 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s44']!="" && $row_select_pipe['s44']!="0" && $row_select_pipe['s44']!=null ){echo $row_select_pipe['s44']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s54']!="" && $row_select_pipe['s54']!="0" && $row_select_pipe['s54']!=null ){echo $row_select_pipe['s54']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s64']!="" && $row_select_pipe['s64']!="0" && $row_select_pipe['s64']!=null ){echo $row_select_pipe['s64']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center><b>10 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><b>4.75 MM</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s45']!="" && $row_select_pipe['s45']!="0" && $row_select_pipe['s45']!=null ){echo $row_select_pipe['s45']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s55']!="" && $row_select_pipe['s55']!="0" && $row_select_pipe['s55']!=null ){echo $row_select_pipe['s55']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['s65']!="" && $row_select_pipe['s65']!="0" && $row_select_pipe['s65']!=null ){echo $row_select_pipe['s65']; }else{echo "<br>";}?></center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><b></b></td>
					<td  style="border: 1px solid black;"><b>Total</b></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null ){echo $row_select_pipe['soundness']; }else{echo "<br>";}?></center></td>
					
				</tr>
			</table>			
			
			<table align="center" width="90%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			
		</table>
		<?php
				//}
			if(($row_select_pipe['ei_index']!="" && $row_select_pipe['ei_index']!="0" && $row_select_pipe['ei_index']!=null) || ($row_select_pipe['fi_index']!="" && $row_select_pipe['fi_index']!="0" && $row_select_pipe['fi_index']!=null))
				{
						
		?>
		<div class="pagebreak"></div>
			<br>
			<br>
		
				<table align="center" width="90%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
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
							
							<td  style="width:90%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF FLAKINESS (IS : 2386 (Part-1): 1963; Clause : 4)</td>
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				
				<?php//
				$scnt=0;
				if($row_select_pipe['flk_xy1']!="" && $row_select_pipe['flk_xy1']!="0" && $row_select_pipe['flk_xy1']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy2']!="" && $row_select_pipe['flk_xy2']!="0" && $row_select_pipe['flk_xy2']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy3']!="" && $row_select_pipe['flk_xy3']!="0" && $row_select_pipe['flk_xy3']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy4']!="" && $row_select_pipe['flk_xy4']!="0" && $row_select_pipe['flk_xy4']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy5']!="" && $row_select_pipe['flk_xy5']!="0" && $row_select_pipe['flk_xy5']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy6']!="" && $row_select_pipe['flk_xy6']!="0" && $row_select_pipe['flk_xy6']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy7']!="" && $row_select_pipe['flk_xy7']!="0" && $row_select_pipe['flk_xy7']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy8']!="" && $row_select_pipe['flk_xy8']!="0" && $row_select_pipe['flk_xy8']!=null){ $scnt++;}
				if($row_select_pipe['flk_xy9']!="" && $row_select_pipe['flk_xy9']!="0" && $row_select_pipe['flk_xy9']!=null){ $scnt++;}
				
				
				?>
				<tr>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Size of Sieve<br>(mm)</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Wt. of min.200 Pcs  of any fraction, g (1)</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Wt. of pieces passing through appropriate gauge, g (2)</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Percentage of  Wt. of total number of pieces pass in each fraction, % (x) =(2)/(1)x100</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Percentage of each fraction of pieces to the total Wt. of sample, % (y) =(1)/Ax100</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Weighted percentage of the Wt. of pieces passing, % (D)=(x)x(y)/90</td>
					<td width="10%"style="border: 1px solid black; font-weight:bold;text-align:center;">Flakiness Index<br>(%)<br><?php if($scnt!=0){echo "∑ D/".$scnt;}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">63-50</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a1']!="" && $row_select_pipe['a1']!="0" && $row_select_pipe['a1']!=null){echo $row_select_pipe['a1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x1']!="" && $row_select_pipe['flk_x1']!="0" && $row_select_pipe['flk_x1']!=null){echo $row_select_pipe['flk_x1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y1']!="" && $row_select_pipe['flk_y1']!="0" && $row_select_pipe['flk_y1']!=null){echo $row_select_pipe['flk_y1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy1']!="" && $row_select_pipe['flk_xy1']!="0" && $row_select_pipe['flk_xy1']!=null){echo $row_select_pipe['flk_xy1']; }else{echo " <br>";}?></td>
					<td rowspan="10" style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['fi_index']!="" && $row_select_pipe['fi_index']!="0" && $row_select_pipe['fi_index']!=null){echo $row_select_pipe['fi_index']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">50-40</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a2']!="" && $row_select_pipe['a2']!="0" && $row_select_pipe['a2']!=null){echo $row_select_pipe['a2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x2']!="" && $row_select_pipe['flk_x2']!="0" && $row_select_pipe['flk_x2']!=null){echo $row_select_pipe['flk_x2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y2']!="" && $row_select_pipe['flk_y2']!="0" && $row_select_pipe['flk_y2']!=null){echo $row_select_pipe['flk_y2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy2']!="" && $row_select_pipe['flk_xy2']!="0" && $row_select_pipe['flk_xy2']!=null){echo $row_select_pipe['flk_xy2']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">40-31.5</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a3']!="" && $row_select_pipe['a3']!="0" && $row_select_pipe['a3']!=null){echo $row_select_pipe['a3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x3']!="" && $row_select_pipe['flk_x3']!="0" && $row_select_pipe['flk_x3']!=null){echo $row_select_pipe['flk_x3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y3']!="" && $row_select_pipe['flk_y3']!="0" && $row_select_pipe['flk_y3']!=null){echo $row_select_pipe['flk_y3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy3']!="" && $row_select_pipe['flk_xy3']!="0" && $row_select_pipe['flk_xy3']!=null){echo $row_select_pipe['flk_xy3']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">31.5-25</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a4']!="" && $row_select_pipe['a4']!="0" && $row_select_pipe['a4']!=null){echo $row_select_pipe['a4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b4']!="" && $row_select_pipe['b4']!="0" && $row_select_pipe['b4']!=null){echo $row_select_pipe['b4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x4']!="" && $row_select_pipe['flk_x4']!="0" && $row_select_pipe['flk_x4']!=null){echo $row_select_pipe['flk_x4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y4']!="" && $row_select_pipe['flk_y4']!="0" && $row_select_pipe['flk_y4']!=null){echo $row_select_pipe['flk_y4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy4']!="" && $row_select_pipe['flk_xy4']!="0" && $row_select_pipe['flk_xy4']!=null){echo $row_select_pipe['flk_xy4']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">25-20</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a5']!="" && $row_select_pipe['a5']!="0" && $row_select_pipe['a5']!=null){echo $row_select_pipe['a5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b5']!="" && $row_select_pipe['b5']!="0" && $row_select_pipe['b5']!=null){echo $row_select_pipe['b5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x5']!="" && $row_select_pipe['flk_x5']!="0" && $row_select_pipe['flk_x5']!=null){echo $row_select_pipe['flk_x5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y5']!="" && $row_select_pipe['flk_y5']!="0" && $row_select_pipe['flk_y5']!=null){echo $row_select_pipe['flk_y5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy5']!="" && $row_select_pipe['flk_xy5']!="0" && $row_select_pipe['flk_xy5']!=null){echo $row_select_pipe['flk_xy5']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">20-16</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a6']!="" && $row_select_pipe['a6']!="0" && $row_select_pipe['a6']!=null){echo $row_select_pipe['a6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b6']!="" && $row_select_pipe['b6']!="0" && $row_select_pipe['b6']!=null){echo $row_select_pipe['b6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x6']!="" && $row_select_pipe['flk_x6']!="0" && $row_select_pipe['flk_x6']!=null){echo $row_select_pipe['flk_x6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y6']!="" && $row_select_pipe['flk_y6']!="0" && $row_select_pipe['flk_y6']!=null){echo $row_select_pipe['flk_y6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy6']!="" && $row_select_pipe['flk_xy6']!="0" && $row_select_pipe['flk_xy6']!=null){echo $row_select_pipe['flk_xy6']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">16-12.5</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a7']!="" && $row_select_pipe['a7']!="0" && $row_select_pipe['a7']!=null){echo $row_select_pipe['a7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b7']!="" && $row_select_pipe['b7']!="0" && $row_select_pipe['b7']!=null){echo $row_select_pipe['b7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x7']!="" && $row_select_pipe['flk_x7']!="0" && $row_select_pipe['flk_x7']!=null){echo $row_select_pipe['flk_x7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y7']!="" && $row_select_pipe['flk_y7']!="0" && $row_select_pipe['flk_y7']!=null){echo $row_select_pipe['flk_y7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy7']!="" && $row_select_pipe['flk_xy7']!="0" && $row_select_pipe['flk_xy7']!=null){echo $row_select_pipe['flk_xy7']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">12.5-10</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a8']!="" && $row_select_pipe['a8']!="0" && $row_select_pipe['a8']!=null){echo $row_select_pipe['a8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b8']!="" && $row_select_pipe['b8']!="0" && $row_select_pipe['b8']!=null){echo $row_select_pipe['b8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x8']!="" && $row_select_pipe['flk_x8']!="0" && $row_select_pipe['flk_x8']!=null){echo $row_select_pipe['flk_x8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y8']!="" && $row_select_pipe['flk_y8']!="0" && $row_select_pipe['flk_y8']!=null){echo $row_select_pipe['flk_y8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy8']!="" && $row_select_pipe['flk_xy8']!="0" && $row_select_pipe['flk_xy8']!=null){echo $row_select_pipe['flk_xy8']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">10-6.3</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['a9']!="" && $row_select_pipe['a9']!="0" && $row_select_pipe['a9']!=null){echo $row_select_pipe['a9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['b9']!="" && $row_select_pipe['b9']!="0" && $row_select_pipe['b9']!=null){echo $row_select_pipe['b9']; }else{echo " <br>";}?></td>
					
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_x9']!="" && $row_select_pipe['flk_x9']!="0" && $row_select_pipe['flk_x9']!=null){echo $row_select_pipe['flk_x9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_y9']!="" && $row_select_pipe['flk_y9']!="0" && $row_select_pipe['flk_y9']!=null){echo $row_select_pipe['flk_y9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['flk_xy9']!="" && $row_select_pipe['flk_xy9']!="0" && $row_select_pipe['flk_xy9']!=null){echo $row_select_pipe['flk_xy9']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">Total</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_a']!="" && $row_select_pipe['total_a']!="0" && $row_select_pipe['total_a']!=null){echo $row_select_pipe['total_a']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_b']!="" && $row_select_pipe['total_b']!="0" && $row_select_pipe['total_b']!=null){echo $row_select_pipe['total_b']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_flk_x']!="" && $row_select_pipe['total_flk_x']!="0" && $row_select_pipe['total_flk_x']!=null){echo $row_select_pipe['total_flk_x']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_flk_y']!="" && $row_select_pipe['total_flk_y']!="0" && $row_select_pipe['total_flk_y']!=null){echo $row_select_pipe['total_flk_y']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_flk_xy']!="" && $row_select_pipe['total_flk_xy']!="0" && $row_select_pipe['total_flk_xy']!=null){echo $row_select_pipe['total_flk_xy']; }else{echo " <br>";}?></td>
					
				</tr>
			</table>
			
		
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF ELONGATION (IS : 2386 (Part-1): 1963; Clause : 4)</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				<?php//
				$scnt1=0;
				if($row_select_pipe['flk_xy1']!="" && $row_select_pipe['flk_xy1']!="0" && $row_select_pipe['flk_xy1']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy2']!="" && $row_select_pipe['flk_xy2']!="0" && $row_select_pipe['flk_xy2']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy3']!="" && $row_select_pipe['flk_xy3']!="0" && $row_select_pipe['flk_xy3']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy4']!="" && $row_select_pipe['flk_xy4']!="0" && $row_select_pipe['flk_xy4']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy5']!="" && $row_select_pipe['flk_xy5']!="0" && $row_select_pipe['flk_xy5']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy6']!="" && $row_select_pipe['flk_xy6']!="0" && $row_select_pipe['flk_xy6']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy7']!="" && $row_select_pipe['flk_xy7']!="0" && $row_select_pipe['flk_xy7']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy8']!="" && $row_select_pipe['flk_xy8']!="0" && $row_select_pipe['flk_xy8']!=null){ $scnt1++;}
				if($row_select_pipe['flk_xy9']!="" && $row_select_pipe['flk_xy9']!="0" && $row_select_pipe['flk_xy9']!=null){ $scnt1++;}
				
				
				?>
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Size of Sieve<br>(mm)</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Wt. of min.200 Pcs  of any fraction, g (1)</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Wt. of pieces retained on  appropriate gauge, g (2)</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Percentage of  Wt. of total number of pcs retained in each fraction, % (x) =(2)/(1)x100</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Percentage of each fraction of pieces to the total Wt. of sample, % (y) =(1)/Ax100</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Weighted percentage of the Wt. of pieces retained, % (D)=(x)x(y)/90</td>
					<td width="10%" style="border: 1px solid black; font-weight:bold;text-align:center;">Elongation Index<br>(%)<br><?php if($scnt1!=0){echo "∑ D/".$scnt1;}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">63-50</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa1']!="" && $row_select_pipe['aa1']!="0" && $row_select_pipe['aa1']!=null){echo $row_select_pipe['aa1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd1']!="" && $row_select_pipe['dd1']!="0" && $row_select_pipe['dd1']!=null){echo $row_select_pipe['dd1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x1']!="" && $row_select_pipe['elo_x1']!="0" && $row_select_pipe['elo_x1']!=null){echo $row_select_pipe['elo_x1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y1']!="" && $row_select_pipe['elo_y1']!="0" && $row_select_pipe['elo_y1']!=null){echo $row_select_pipe['elo_y1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy1']!="" && $row_select_pipe['elo_xy1']!="0" && $row_select_pipe['elo_xy1']!=null){echo $row_select_pipe['elo_xy1']; }else{echo " <br>";}?></td>
					<td rowspan="10" style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['ei_index']!="" && $row_select_pipe['ei_index']!="0" && $row_select_pipe['ei_index']!=null){echo $row_select_pipe['ei_index']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">50-40</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa2']!="" && $row_select_pipe['aa2']!="0" && $row_select_pipe['aa2']!=null){echo $row_select_pipe['aa2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd2']!="" && $row_select_pipe['dd2']!="0" && $row_select_pipe['dd2']!=null){echo $row_select_pipe['dd2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x2']!="" && $row_select_pipe['elo_x2']!="0" && $row_select_pipe['elo_x2']!=null){echo $row_select_pipe['elo_x2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y2']!="" && $row_select_pipe['elo_y2']!="0" && $row_select_pipe['elo_y2']!=null){echo $row_select_pipe['elo_y2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy2']!="" && $row_select_pipe['elo_xy2']!="0" && $row_select_pipe['elo_xy2']!=null){echo $row_select_pipe['elo_xy2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">40-31.5</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa3']!="" && $row_select_pipe['aa3']!="0" && $row_select_pipe['aa3']!=null){echo $row_select_pipe['aa3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd3']!="" && $row_select_pipe['dd3']!="0" && $row_select_pipe['dd3']!=null){echo $row_select_pipe['dd3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x3']!="" && $row_select_pipe['elo_x3']!="0" && $row_select_pipe['elo_x3']!=null){echo $row_select_pipe['elo_x3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y3']!="" && $row_select_pipe['elo_y3']!="0" && $row_select_pipe['elo_y3']!=null){echo $row_select_pipe['elo_y3']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy3']!="" && $row_select_pipe['elo_xy3']!="0" && $row_select_pipe['elo_xy3']!=null){echo $row_select_pipe['elo_xy3']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">31.5-25</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa4']!="" && $row_select_pipe['aa4']!="0" && $row_select_pipe['aa4']!=null){echo $row_select_pipe['aa4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd4']!="" && $row_select_pipe['dd4']!="0" && $row_select_pipe['dd4']!=null){echo $row_select_pipe['dd4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x4']!="" && $row_select_pipe['elo_x4']!="0" && $row_select_pipe['elo_x4']!=null){echo $row_select_pipe['elo_x4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y4']!="" && $row_select_pipe['elo_y4']!="0" && $row_select_pipe['elo_y4']!=null){echo $row_select_pipe['elo_y4']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy4']!="" && $row_select_pipe['elo_xy4']!="0" && $row_select_pipe['elo_xy4']!=null){echo $row_select_pipe['elo_xy4']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">25-20</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa5']!="" && $row_select_pipe['aa5']!="0" && $row_select_pipe['aa5']!=null){echo $row_select_pipe['aa5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd5']!="" && $row_select_pipe['dd5']!="0" && $row_select_pipe['dd5']!=null){echo $row_select_pipe['dd5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x5']!="" && $row_select_pipe['elo_x5']!="0" && $row_select_pipe['elo_x5']!=null){echo $row_select_pipe['elo_x5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y5']!="" && $row_select_pipe['elo_y5']!="0" && $row_select_pipe['elo_y5']!=null){echo $row_select_pipe['elo_y5']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy5']!="" && $row_select_pipe['elo_xy5']!="0" && $row_select_pipe['elo_xy5']!=null){echo $row_select_pipe['elo_xy5']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">20-16</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa6']!="" && $row_select_pipe['aa6']!="0" && $row_select_pipe['aa6']!=null){echo $row_select_pipe['aa6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd6']!="" && $row_select_pipe['dd6']!="0" && $row_select_pipe['dd6']!=null){echo $row_select_pipe['dd6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x6']!="" && $row_select_pipe['elo_x6']!="0" && $row_select_pipe['elo_x6']!=null){echo $row_select_pipe['elo_x6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y6']!="" && $row_select_pipe['elo_y6']!="0" && $row_select_pipe['elo_y6']!=null){echo $row_select_pipe['elo_y6']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy6']!="" && $row_select_pipe['elo_xy6']!="0" && $row_select_pipe['elo_xy6']!=null){echo $row_select_pipe['elo_xy6']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">16-12.5</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa7']!="" && $row_select_pipe['aa7']!="0" && $row_select_pipe['aa7']!=null){echo $row_select_pipe['aa7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd7']!="" && $row_select_pipe['dd7']!="0" && $row_select_pipe['dd7']!=null){echo $row_select_pipe['dd7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x7']!="" && $row_select_pipe['elo_x7']!="0" && $row_select_pipe['elo_x7']!=null){echo $row_select_pipe['elo_x7']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y7']!="" && $row_select_pipe['elo_y7']!="0" && $row_select_pipe['elo_y7']!=null){echo $row_select_pipe['elo_y7']; }else{echo " <br>";}?></td>	
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy7']!="" && $row_select_pipe['elo_xy7']!="0" && $row_select_pipe['elo_xy7']!=null){echo $row_select_pipe['elo_xy7']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">12.5-10</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa8']!="" && $row_select_pipe['aa8']!="0" && $row_select_pipe['aa8']!=null){echo $row_select_pipe['aa8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd8']!="" && $row_select_pipe['dd8']!="0" && $row_select_pipe['dd8']!=null){echo $row_select_pipe['dd8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x8']!="" && $row_select_pipe['elo_x8']!="0" && $row_select_pipe['elo_x8']!=null){echo $row_select_pipe['elo_x8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y8']!="" && $row_select_pipe['elo_y8']!="0" && $row_select_pipe['elo_y8']!=null){echo $row_select_pipe['elo_y8']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy8']!="" && $row_select_pipe['elo_xy8']!="0" && $row_select_pipe['elo_xy8']!=null){echo $row_select_pipe['elo_xy8']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">10-6.3</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['aa9']!="" && $row_select_pipe['aa9']!="0" && $row_select_pipe['aa9']!=null){echo $row_select_pipe['aa9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['dd9']!="" && $row_select_pipe['dd9']!="0" && $row_select_pipe['dd9']!=null){echo $row_select_pipe['dd9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_x9']!="" && $row_select_pipe['elo_x9']!="0" && $row_select_pipe['elo_x9']!=null){echo $row_select_pipe['elo_x9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_y9']!="" && $row_select_pipe['elo_y9']!="0" && $row_select_pipe['elo_y9']!=null){echo $row_select_pipe['elo_y9']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['elo_xy9']!="" && $row_select_pipe['elo_xy9']!="0" && $row_select_pipe['elo_xy9']!=null){echo $row_select_pipe['elo_xy9']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">Total</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_aa']!="" && $row_select_pipe['total_aa']!="0" && $row_select_pipe['total_aa']!=null){echo $row_select_pipe['total_aa']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_dd']!="" && $row_select_pipe['total_dd']!="0" && $row_select_pipe['total_dd']!=null){echo $row_select_pipe['total_dd']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_elo_x']!="" && $row_select_pipe['total_elo_x']!="0" && $row_select_pipe['total_elo_x']!=null){echo $row_select_pipe['total_elo_x']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_elo_y']!="" && $row_select_pipe['total_elo_y']!="0" && $row_select_pipe['total_elo_y']!=null){echo $row_select_pipe['total_elo_y']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['total_elo_xy']!="" && $row_select_pipe['total_elo_xy']!="0" && $row_select_pipe['total_elo_xy']!=null){echo $row_select_pipe['total_elo_xy']; }else{echo " <br>";}?></td>
					
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">Combine Result :-</td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;"><?php if($row_select_pipe['combined_index']!="" && $row_select_pipe['combined_index']!="0" && $row_select_pipe['combined_index']!=null){echo $row_select_pipe['combined_index']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; font-weight:bold; text-align:center;">%</td>
					<td colspan="4" style="border: 1px solid black; font-weight:bold; text-align:center;"></td>
				</tr>
			</table>
			
		
			<table align="center" width="90%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
		</table>
		<?php//
				}
			if(($row_select_pipe['pass_sample_1']!="" && $row_select_pipe['pass_sample_1']!="0" && $row_select_pipe['pass_sample_1']!=null) || ($row_select_pipe['bdl']!="" && $row_select_pipe['bdl']!="0" && $row_select_pipe['bdl']!=null) || ($row_select_pipe['sp_specific_gravity']!="" && $row_select_pipe['sp_specific_gravity']!="0" && $row_select_pipe['sp_specific_gravity']!=null))
				{
						
		?>
		<div class="pagebreak"></div>
			<br>
			<br>
		
				<table align="center" width="90%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
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
							
							<td  style="width:90%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php// 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF GRADATION (IS : 2386 (Part-1): 1963; Caluse : 2)</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr style="border: 1px solid black;">
					<td colspan="5" style="border: 1px solid black;font-weight:bold;">Weight : <?php echo $row_select_pipe['sample_taken'];?> gm</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;"><center>Sieve Size, mm</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>Weight Retained on Individual Sieve, g</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>Cummulative Weight Retained, g</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>Cummulative % Retained</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>% Passing</center></td>
					
				</tr>
				<?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){ echo $row_select_pipe['sieve_1']; }else{echo "";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){echo $row_select_pipe['cum_wt_gm_1']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){echo $row_select_pipe['ret_wt_gm_1']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){echo $row_select_pipe['cum_ret_1'];  }else{echo " <br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_1']!="" && $row_select_pipe['sieve_1']!="0" && $row_select_pipe['sieve_1']!=null){echo $row_select_pipe['pass_sample_1']; }else{echo " <br>";}  ?></td>
					
				</tr>
				<?php } if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){ echo $row_select_pipe['sieve_2']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){echo $row_select_pipe['cum_wt_gm_2']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){echo $row_select_pipe['ret_wt_gm_2']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){echo $row_select_pipe['cum_ret_2']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_2']!="" && $row_select_pipe['sieve_2']!="0" && $row_select_pipe['sieve_2']!=null){echo $row_select_pipe['pass_sample_2']; }else{echo " <br>";} ?></td>
					
				</tr>
				<?php } if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null) {echo $row_select_pipe['sieve_3']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null) {echo $row_select_pipe['cum_wt_gm_3'];}else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null) {echo $row_select_pipe['ret_wt_gm_3']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null) {echo $row_select_pipe['cum_ret_3']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_3']!="" && $row_select_pipe['sieve_3']!="0" && $row_select_pipe['sieve_3']!=null) {echo $row_select_pipe['pass_sample_3']; }else{echo " <br>";} ?></td>
					
				</tr>
			<?php } if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){echo $row_select_pipe['sieve_4']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){echo $row_select_pipe['cum_wt_gm_4']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){echo $row_select_pipe['ret_wt_gm_4']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){echo $row_select_pipe['cum_ret_4'];  }else{echo " <br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_4']!="" && $row_select_pipe['sieve_4']!="0" && $row_select_pipe['sieve_4']!=null){echo $row_select_pipe['pass_sample_4']; }else{echo " <br>";} ?></td>
					
				</tr>
				<?php } if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){echo $row_select_pipe['sieve_5']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){echo $row_select_pipe['cum_wt_gm_5'];}else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){echo $row_select_pipe['ret_wt_gm_5']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){echo $row_select_pipe['cum_ret_5']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['sieve_5']!="" && $row_select_pipe['sieve_5']!="0" && $row_select_pipe['sieve_5']!=null){echo $row_select_pipe['pass_sample_5']; }else{echo " <br>";} ?></td>
					
				</tr>	
<?php } if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){echo $row_select_pipe['sieve_6']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){echo $row_select_pipe['cum_wt_gm_6']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){echo $row_select_pipe['ret_wt_gm_6']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){echo $row_select_pipe['cum_ret_6']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_6']!="" && $row_select_pipe['sieve_6']!="0" && $row_select_pipe['sieve_6']!=null){echo $row_select_pipe['pass_sample_6']; }else{echo " <br>";} ?></td>
					
				</tr>
<?php } if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){ echo $row_select_pipe['sieve_7']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){echo $row_select_pipe['cum_wt_gm_7']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){echo $row_select_pipe['ret_wt_gm_7']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){echo $row_select_pipe['cum_ret_7']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_7']!="" && $row_select_pipe['sieve_7']!="0" && $row_select_pipe['sieve_7']!=null){echo $row_select_pipe['pass_sample_7']; }else{echo " <br>";} ?></td>
					
				</tr>	
<?php } if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){echo $row_select_pipe['sieve_8']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){echo $row_select_pipe['cum_wt_gm_8']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){echo $row_select_pipe['ret_wt_gm_8']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){echo $row_select_pipe['cum_ret_8']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_8']!="" && $row_select_pipe['sieve_8']!="0" && $row_select_pipe['sieve_8']!=null){echo $row_select_pipe['pass_sample_8']; }else{echo " <br>";} ?></td>
					
				</tr>
<?php } if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){echo $row_select_pipe['sieve_9']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){echo $row_select_pipe['cum_wt_gm_9']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){echo $row_select_pipe['ret_wt_gm_9']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){echo $row_select_pipe['cum_ret_9']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_9']!="" && $row_select_pipe['sieve_9']!="0" && $row_select_pipe['sieve_9']!=null){echo $row_select_pipe['pass_sample_9']; }else{echo " <br>";} ?></td>
					
				</tr>
<?php } if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){echo $row_select_pipe['sieve_10']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){echo $row_select_pipe['cum_wt_gm_10']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){echo $row_select_pipe['ret_wt_gm_10']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){echo $row_select_pipe['cum_ret_10']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_10']!="" && $row_select_pipe['sieve_10']!="0" && $row_select_pipe['sieve_10']!=null){echo $row_select_pipe['pass_sample_10']; }else{echo " <br>";} ?></td>
					
				</tr>
				<?php } if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){echo $row_select_pipe['sieve_11']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){echo $row_select_pipe['cum_wt_gm_11']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){echo $row_select_pipe['ret_wt_gm_11']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){echo $row_select_pipe['cum_ret_11']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_11']!="" && $row_select_pipe['sieve_11']!="0" && $row_select_pipe['sieve_11']!=null){echo $row_select_pipe['pass_sample_11']; }else{echo " <br>";} ?></td>
					
				</tr>
<?php } if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){?>				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;"><?php if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){echo $row_select_pipe['sieve_12']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){echo $row_select_pipe['cum_wt_gm_12']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){echo $row_select_pipe['ret_wt_gm_12']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){echo $row_select_pipe['cum_ret_12']; }else{echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php  if($row_select_pipe['sieve_12']!="" && $row_select_pipe['sieve_12']!="0" && $row_select_pipe['sieve_12']!=null){echo $row_select_pipe['pass_sample_12']; }else{echo " <br>";} ?></td>
					
				</tr>
				<?php } if($row_select_pipe['blank_extra']!="" && $row_select_pipe['blank_extra']!="0" && $row_select_pipe['blank_extra']!=null){?>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">Total </td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['blank_extra']!="" && $row_select_pipe['blank_extra']!="0" && $row_select_pipe['blank_extra']!=null){echo $row_select_pipe['blank_extra']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"></td>
					
				</tr>
				<?php }?>
			</table>
		
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF DENSITY (IS : 2386 (Part-3): 1963; Clause No : 3)</td>
				</tr>
			</table>
		
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
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
					<td colspan="2" style="text-align:left;">&nbsp; <b>Average weight of material = <?php if($row_select_pipe['avg_wom']!="" && $row_select_pipe['avg_wom']!="0" && $row_select_pipe['avg_wom']!=null){echo number_format($row_select_pipe['avg_wom']/90,2); }else{echo "<br>";}?> kg</b></td>
					<td colspan="3" style=""><b>volume of mould = </b> <?php if($row_select_pipe['vol']!="" && $row_select_pipe['vol']!="0" && $row_select_pipe['vol']!=null){echo $row_select_pipe['vol']." m<sup>3</sup>"; }else{echo "<br>";}?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:left;">&nbsp; <b>Bulk loose density = Average weight of material / volume of mould = <?php if($row_select_pipe['bdl']!="" && $row_select_pipe['bdl']!="0" && $row_select_pipe['bdl']!=null){echo $row_select_pipe['bdl']; }else{echo "<br>";}?> kg/m<sup>3</sup></b></td>
				</tr>
			</table>
		
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF SPECIFIC GRAVITY & WATER ABSORPTION <BR> IS : 2386 (Part-3): 1963; Clause No : 2.2 Larger than 10 mm</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				
				
				<tr>
					<td colspan="7" style="border: 1px solid black;">&nbsp;&nbsp; Weight of Basket /Pycnometer Bottle in Water A2= <?php if($row_select_pipe['sp_bask_water']!="" && $row_select_pipe['sp_bask_water']!="0" && $row_select_pipe['sp_bask_water']!=null){echo $row_select_pipe['sp_bask_water']; }else{echo "<br>";}?> gm</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="Auto">
				<tr>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample in water with basket (gm) A1</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of saturated surface dry (gm) B</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample oven dry (gm) C</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample in water (gm) A = A1-A2</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Specific Gravity<br>=C/(B-A)</b></center></td>						
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>(%) water absorption in 24 hours = </b></center></td>						
										
				</tr>
				<tr>
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>(B-C)/C x 90</b></center></td>	
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center><b>1</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_bas1']!="" && $row_select_pipe['sp_wt_bas1']!="0" && $row_select_pipe['sp_wt_bas1']!=null){echo $row_select_pipe['sp_wt_bas1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_st_1']!="" && $row_select_pipe['sp_wt_st_1']!="0" && $row_select_pipe['sp_wt_st_1']!=null){echo $row_select_pipe['sp_wt_st_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_s_1']!="" && $row_select_pipe['sp_w_s_1']!="0" && $row_select_pipe['sp_w_s_1']!=null){echo $row_select_pipe['sp_w_s_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_sur_1']!="" && $row_select_pipe['sp_w_sur_1']!="0" && $row_select_pipe['sp_w_sur_1']!=null){echo $row_select_pipe['sp_w_sur_1']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_specific_gravity_1']!="" && $row_select_pipe['sp_specific_gravity_1']!="0" && $row_select_pipe['sp_specific_gravity_1']!=null){echo $row_select_pipe['sp_specific_gravity_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black; "><center><?php if($row_select_pipe['sp_water_abr_1']!="" && $row_select_pipe['sp_water_abr_1']!="0" && $row_select_pipe['sp_water_abr_1']!=null){echo $row_select_pipe['sp_water_abr_1']; }else{echo " <br>";}?></center></td>						
									
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_bas2']!="" && $row_select_pipe['sp_wt_bas2']!="0" && $row_select_pipe['sp_wt_bas2']!=null){echo $row_select_pipe['sp_wt_bas2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_wt_st_2']!="" && $row_select_pipe['sp_wt_st_2']!="0" && $row_select_pipe['sp_wt_st_2']!=null){echo $row_select_pipe['sp_wt_st_2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_s_2']!="" && $row_select_pipe['sp_w_s_2']!="0" && $row_select_pipe['sp_w_s_2']!=null){echo $row_select_pipe['sp_w_s_2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_w_sur_2']!="" && $row_select_pipe['sp_w_sur_2']!="0" && $row_select_pipe['sp_w_sur_2']!=null){echo $row_select_pipe['sp_w_sur_2']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_specific_gravity_2']!="" && $row_select_pipe['sp_specific_gravity_2']!="0" && $row_select_pipe['sp_specific_gravity_2']!=null){echo $row_select_pipe['sp_specific_gravity_2']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['sp_water_abr_2']!="" && $row_select_pipe['sp_water_abr_2']!="0" && $row_select_pipe['sp_water_abr_2']!=null){echo $row_select_pipe['sp_water_abr_2']; }else{echo " <br>";}?></center></td>						
					
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold;" align="right" colspan="5"><b>Average</b></td>
					<td style="border: 1px solid black; font-weight:bold;"><center><?php if($row_select_pipe['sp_specific_gravity']!="" && $row_select_pipe['sp_specific_gravity']!="0" && $row_select_pipe['sp_specific_gravity']!=null){echo $row_select_pipe['sp_specific_gravity']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black; font-weight:bold;"><center><?php if($row_select_pipe['sp_water_abr']!="" && $row_select_pipe['sp_water_abr']!="0" && $row_select_pipe['sp_water_abr']!=null){echo $row_select_pipe['sp_water_abr']; }else{echo " <br>";}?></center></td>						
					
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
		</table>
		<?php//
				}
			 if(($row_select_pipe['fines_value']!="" && $row_select_pipe['fines_value']!="0" && $row_select_pipe['fines_value']!=null) || ($row_select_pipe['strip_per']!="" && $row_select_pipe['strip_per']!="0" && $row_select_pipe['strip_per']!=null) )
				{
						
		?>
		<div class="pagebreak"></div>
			<br>
			<br>
		
				<table align="center" width="90%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
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
							
							<td  style="width:90%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF 10 % FINE VALUE (IS:2386 (Part-4):1963)</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;text-align:center">
				<tr>
					<td style="border: 1px solid black;width:5%;height:Auto;"><center><b>Sr.<br>No.</b></center></td>
					<td style="border: 1px solid black;width:51%;height:15px;"><center><b>Particular</b></center></td>
					<td style="border: 1px solid black;width:22%;height:15px;"><center><b>1</b></center></td>
					<td style="border: 1px solid black;border-right: 2px solid black;width:22%;height:15px;"><center><b>2</b></center></td>									
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>1</b></center></td>
					<td style="border: 1px solid black;width:60%;text-align:left"><b>Weight of Surface Dry Sample taken for test (A) in gms</b></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_a_1']!="" && $row_select_pipe['f_a_1']!="0" && $row_select_pipe['f_a_1']!=null && $row_select_pipe['f_a_1']!="undefined"){echo $row_select_pipe['f_a_1']; }else{echo "<br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_a_2']!="" && $row_select_pipe['f_a_2']!="0" && $row_select_pipe['f_a_2']!=null && $row_select_pipe['f_a_2']!="undefined"){echo $row_select_pipe['f_a_2']; }else{echo "<br>";}?></td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>2</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Total Penetration of Plunger in 10 minutes in mm</b></td>
					<td style="border: 1px solid black;">5 mm</td>
					<td style="border: 1px solid black;">5 mm</td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>3</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Load required for penetration in KN</b></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_b_1']!="" && $row_select_pipe['f_b_1']!="0" && $row_select_pipe['f_b_1']!=null && $row_select_pipe['f_b_1']!="undefined"){echo $row_select_pipe['f_b_1']; }else{echo "<br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_b_2']!="" && $row_select_pipe['f_b_2']!="0" && $row_select_pipe['f_b_2']!=null && $row_select_pipe['f_b_2']!="undefined"){echo $row_select_pipe['f_b_2']; }else{echo "<br>";}?></td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>4</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Avgerage Load required for penetration in KN (X)</b></td>
					<td colspan="2" style="border: 1px solid black;"><?php if($row_select_pipe['avg_f_c']!="" && $row_select_pipe['avg_f_c']!="0" && $row_select_pipe['avg_f_c']!=null && $row_select_pipe['avg_f_c']!="undefined"){echo $row_select_pipe['avg_f_c']; }else{echo "<br>";}?></td>
								
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>5</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Weight of material passing on appropriate 2.36 mm I.S. Sieve .(B) in gms</b></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_c_1']!="" && $row_select_pipe['f_c_1']!="0" && $row_select_pipe['f_c_1']!=null && $row_select_pipe['f_c_1']!="undefined"){echo $row_select_pipe['f_c_1']; }else{echo "<br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_c_2']!="" && $row_select_pipe['f_c_2']!="0" && $row_select_pipe['f_c_2']!=null && $row_select_pipe['f_c_2']!="undefined"){echo $row_select_pipe['f_c_2']; }else{echo "<br>";}?></td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>6</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Weight of material retained on appropriate I.S. Sieve mm ('C) in gms</b></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_c_1']!="" && $row_select_pipe['f_c_1']!="0" && $row_select_pipe['f_c_1']!=null && $row_select_pipe['f_c_1']!="undefined"){
						$a = $row_select_pipe['f_a_1'];
						$c = $row_select_pipe['f_c_1'];
						$ans = floatval($a) - floatval($c);
						echo number_format($ans,0); }else{echo "<br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_c_2']!="" && $row_select_pipe['f_c_2']!="0" && $row_select_pipe['f_c_2']!=null && $row_select_pipe['f_c_2']!="undefined"){
						$a1 = $row_select_pipe['f_a_2'];
						$c1 = $row_select_pipe['f_c_2'];
						$ans1 = floatval($a1) - floatval($c1);
						echo number_format($ans1,0); }else{echo "<br>";}?></td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>7</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Percentage Fines = B x 90/A</b></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_d_1']!="" && $row_select_pipe['f_d_1']!="0" && $row_select_pipe['f_d_1']!=null && $row_select_pipe['f_d_1']!="undefined"){echo $row_select_pipe['f_d_1']; }else{echo "<br>";}?></td>
					<td style="border: 1px solid black;"><?php if($row_select_pipe['f_d_2']!="" && $row_select_pipe['f_d_2']!="0" && $row_select_pipe['f_d_2']!=null && $row_select_pipe['f_d_2']!="undefined"){echo $row_select_pipe['f_d_2']; }else{echo "<br>";}?></td>				
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>8</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>Average Percentage Fines (Y)</b></td>
					<td colspan="2" style="border: 1px solid black;"><?php if($row_select_pipe['avg_f_d']!="" && $row_select_pipe['avg_f_d']!="0" && $row_select_pipe['avg_f_d']!=null && $row_select_pipe['avg_f_d']!="undefined"){echo $row_select_pipe['avg_f_d']; }else{echo "<br>";}?></td>			
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>9</b></center></td>
					<td style="border: 1px solid black;text-align:left"><b>10 Percent Fines Value 14 * x /(Y+4)</b></td>
					<td colspan="2" style="border: 1px solid black;"><?php if($row_select_pipe['fines_value']!="" && $row_select_pipe['fines_value']!="0" && $row_select_pipe['fines_value']!=null && $row_select_pipe['fines_value']!="undefined"){echo $row_select_pipe['fines_value']; }else{echo "<br>";}?></td>
					
				</tr>
				
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF STRIPPING VALUE (IS:6241:1971)</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  height="10%" style="border: 1px solid black; font-family : Calibri;">
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; <b>Sample taken for test :- <?php echo $row_select_pipe['str_sample'];?> Binder Type :- <?php echo $row_select_pipe['str_type'];?></b></td>
				</tr>
				
				
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="Auto">
				<tr>
					
					<td rowspan="3" style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Aggregate Passing from 20mm IS sieve and retained on 12.5mm IS seive, g</b></center></td>
					<td rowspan="3" style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Bitumen Content, %</b></center></td>
					<td rowspan="2" colspan="2" style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Stripping Value =</b></center></td>						
					<td colspan="2" style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Uncovered Area</b></center></td>						
										
				</tr>
				<tr>
					
					
					
					<td colspan="2" style="border-right:1px solid black;border-top:1px solid black; font-weight:bold;width:12%;"><center><b>Total Area of Aggregate</b></center></td>						
					
										
				</tr>
				<tr>
					
					
					
					<td style="border-right:1px solid black;border-top:1px solid black; font-weight:bold;width:12%;"><center><b>Trail 1</b></center></td>						
					<td style="border-right:1px solid black;border-top:1px solid black; font-weight:bold;width:12%;"><center><b>Trail 2</b></center></td>						
					<td style="border-right:1px solid black;border-top:1px solid black; font-weight:bold;width:12%;"><center><b>Trail 3</b></center></td>						
					<td style="border-right:1px solid black;border-top:1px solid black; font-weight:bold;width:12%;"><center><b>Average / Mean</b></center></td>						
					
										
				</tr>
				
				<tr>
					
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['str_gm']!="" && $row_select_pipe['str_gm']!="0" && $row_select_pipe['str_gm']!=null){echo $row_select_pipe['str_gm']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['str_per']!="" && $row_select_pipe['str_per']!="0" && $row_select_pipe['str_per']!=null){echo $row_select_pipe['str_per']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['str_1']!="" && $row_select_pipe['str_1']!="0" && $row_select_pipe['str_1']!=null){echo $row_select_pipe['str_1']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['str_2']!="" && $row_select_pipe['str_2']!="0" && $row_select_pipe['str_2']!=null){echo $row_select_pipe['str_2']; }else{echo " <br>";}?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['str_3']!="" && $row_select_pipe['str_3']!="0" && $row_select_pipe['str_3']!=null){echo $row_select_pipe['str_3']; }else{echo " <br>";}?></center></td>
					<td  style="border: 1px solid black; "><center><?php if($row_select_pipe['stripping_value']!="" && $row_select_pipe['stripping_value']!="0" && $row_select_pipe['stripping_value']!=null){echo $row_select_pipe['stripping_value']; }else{echo " <br>";}?></center></td>						
									
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1"  height="10%" style="border: 1px solid black; font-family : Calibri;">
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; <b>Retaining Binder Coating :- (90 - Stripping Value) = <?php echo $row_select_pipe['strip_per'];?> %</b></td>
				</tr>
				
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; <b>Binder heated previously to 160 &deg;C if bitumen and 110 &deg;C if tar </b></td>
				</tr>
				
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; <b>The aggregates are also to be heated prior to mixing to a temperature of 150 &deg;C anf 90 &deg;C</b></td>
				</tr>
				
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; <b>Evaluation :</b>The stripping value shall be the ratio of the uncovered area observed visually to the total area of the aggregates in each test expressed as a percentage</td>
				</tr>
				
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td colspan="4" style="">&nbsp;&nbsp; </td>
				</tr>
				
				
			</table>
			
			<table align="center" width="90%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr>
			
		</table>
			<?php//
				}
				if(($row_select_pipe['omc_3']!="" && $row_select_pipe['omc_3']!="0" && $row_select_pipe['omc_3']!=null) || ($row_select_pipe['alk_10']!="" && $row_select_pipe['alk_10']!="0" && $row_select_pipe['alk_10']!=null) || ($row_select_pipe['dele_3_3']!="" && $row_select_pipe['dele_3_3']!="0" && $row_select_pipe['dele_3_3']!=null) || ($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!="0" && $row_select_pipe['dele_2_3']!=null))
				{
			
			
			?>
			<div class="pagebreak"></div>
			<br>
			<br>
			<table align="center" width="90%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
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
							
							<td  style="width:90%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF ALKALI REACTIVITY (IS:2386 (Part-4):1963)</td>
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>DISCRIPTION </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>1</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>2</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Length of Specimen after 24 hr </center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_1']!="" && $row_select_pipe['alk_1']!="0" && $row_select_pipe['alk_1']!=null){echo $row_select_pipe['alk_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_2']!="" && $row_select_pipe['alk_2']!="0" && $row_select_pipe['alk_2']!=null){echo $row_select_pipe['alk_2']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Length of Specimen after 7 days </center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_3']!="" && $row_select_pipe['alk_3']!="0" && $row_select_pipe['alk_3']!=null){echo $row_select_pipe['alk_3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_4']!="" && $row_select_pipe['alk_4']!="0" && $row_select_pipe['alk_4']!=null){echo $row_select_pipe['alk_4']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Length of Specimen after 28 days </center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_5']!="" && $row_select_pipe['alk_5']!="0" && $row_select_pipe['alk_5']!=null){echo $row_select_pipe['alk_5']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_6']!="" && $row_select_pipe['alk_6']!="0" && $row_select_pipe['alk_6']!=null){echo $row_select_pipe['alk_6']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>4.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Length of Specimen after 6 Months </center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_7']!="" && $row_select_pipe['alk_7']!="0" && $row_select_pipe['alk_7']!=null){echo $row_select_pipe['alk_7']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_8']!="" && $row_select_pipe['alk_8']!="0" && $row_select_pipe['alk_8']!=null){echo $row_select_pipe['alk_8']; }else{echo "<br>";}?></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>5.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Length of Specimen after 365 days </center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_9']!="" && $row_select_pipe['alk_9']!="0" && $row_select_pipe['alk_9']!=null){echo $row_select_pipe['alk_9']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['alk_10']!="" && $row_select_pipe['alk_10']!="0" && $row_select_pipe['alk_10']!=null){echo $row_select_pipe['alk_10']; }else{echo "<br>";}?></center></td>
				</tr>
			</table>
			<?php if($row_select_pipe['dele_3_1']!="" && $row_select_pipe['dele_3_1']!="0" && $row_select_pipe['dele_3_1']!=null){?>
			<table align="center" width="90%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">DETERMINATION OF DELETERIOUS MATERIALS (IS:2386 (Part-2):1963)</td>
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Particular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Dry weight in gm of decanted pieces (W1)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_1']!="" && $row_select_pipe['dele_3_1']!="0" && $row_select_pipe['dele_3_1']!=null){echo $row_select_pipe['dele_3_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Dry weight in gm of portion of sample coarser than 4.75mm IS Sieve (W3)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_2']!="" && $row_select_pipe['dele_3_2']!="0" && $row_select_pipe['dele_3_2']!=null){echo $row_select_pipe['dele_3_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="90%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Percentage of Coal &amp; Lignite (L)</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="10%" rowspan="2" style="text-align:center;"></td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">W1</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 90</td>
							</tr>
							<tr>
								<td style="text-align:center;">W3</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_3_3']!="" && $row_select_pipe['dele_3_3']!="0" && $row_select_pipe['dele_3_3']!=null){echo $row_select_pipe['dele_3_3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>Determine of Clay lumps</b></td>
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Particular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample (W)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_1']!="" && $row_select_pipe['dele_2_1']!="0" && $row_select_pipe['dele_2_1']!=null){echo $row_select_pipe['dele_2_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample after removal of clay lumps (R )</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_2']!="" && $row_select_pipe['dele_2_2']!="0" && $row_select_pipe['dele_2_2']!=null){echo $row_select_pipe['dele_2_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="90%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Percentage of clay lumps (L)</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="10%" rowspan="2" style="text-align:center;"></td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">W - R</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 90</td>
							</tr>
							<tr>
								<td style="text-align:center;">W</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!="0" && $row_select_pipe['dele_2_3']!=null){echo $row_select_pipe['dele_2_3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>Material finer than 75 micron sieve</b></td>
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Particular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Original Dry Weight (B)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_1_1']!="" && $row_select_pipe['dele_1_1']!="0" && $row_select_pipe['dele_1_1']!=null){echo $row_select_pipe['dele_1_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Dry weight after washing ©</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_1_2']!="" && $row_select_pipe['dele_1_2']!="0" && $row_select_pipe['dele_1_2']!=null){echo $row_select_pipe['dele_1_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="90%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Material Finer than 75 micron</td>
								<td width="10%" rowspan="2" style="text-align:center;">A =</td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">B-C</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 90</td>
							</tr>
							<tr>
								<td style="text-align:center;">B</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_1_4']!="" && $row_select_pipe['dele_1_4']!="0" && $row_select_pipe['dele_1_4']!=null){echo $row_select_pipe['dele_1_4']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>TOTAL DELETERIOUS MATERIAL (13.1+13.2+13.3)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!=null && $row_select_pipe['dele_2_3']!="0"){
					  $a = $row_select_pipe['dele_3_3'];
					  $b = $row_select_pipe['dele_2_3'];
					  $c = $row_select_pipe['dele_1_4'];
					
					$ans = floatval($a) + floatval($b) + floatval(c);
					
					
					echo number_format($ans,2);}else{echo "-";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>Natural Moisture Content : </b></td>
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Particular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Original Dry Weight (B</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['omc_1']!="" && $row_select_pipe['omc_1']!="0" && $row_select_pipe['omc_1']!=null){echo $row_select_pipe['omc_1']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>After 24 Hours Oven Dry Weight (A)</center></td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['omc_2']!="" && $row_select_pipe['omc_2']!="0" && $row_select_pipe['omc_2']!=null){echo $row_select_pipe['omc_2']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="90%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Natural Moisture Content</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">B-A</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 90</td>
							</tr>
							<tr>
								<td style="text-align:center;">A</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if($row_select_pipe['omc_3']!="" && $row_select_pipe['omc_3']!="0" && $row_select_pipe['omc_3']!=null){echo $row_select_pipe['omc_3']; }else{echo "<br>";}?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<?php }?>
			<table align="center" width="90%" class="test1"   style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;border: 1px solid;">Checked By (Testing Incharge)</td>
			</tr>
			<tr>
				<td colspan="2" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
			</tr>-->
			
			
			
			<?php//
				}
			?>
		
	</body>
</html> 
		
	
<script type="text/javascript">

</script>