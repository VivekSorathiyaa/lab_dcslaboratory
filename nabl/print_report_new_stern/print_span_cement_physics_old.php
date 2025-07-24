<?php
include("../connection.php");
include("function_calling.php");
session_start();

error_reporting(0); ?>
<style>
	@page {
		margin: 0 40px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
	}
</style>
<html>

<body>
	<?php



	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	//$page_cont = round_up($no_of_rows / 5);
	//$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
	if ($cons == 0) {
		$con_sample = "Acceptable";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
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
			$mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$cement_brand = $row_select4['cement_brand'];
		$grade = $row_select4['cement_grade'];
		
	}
		$cnt=1;	
	?>



	<?php if ($row_select_pipe['chk_che'] == '0' ){ ?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
						<tr>
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="width: 80%;padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;width:20%;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 54.5%;padding: 0 2px;text-align: right;">&nbsp;Group:- Building Materials</td>
							<?php
								// $select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								// $result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);
			
								// while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
									// $flag++;
								?>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<?php //}?>
						</tr>
						
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: center;">&nbsp;Discipline:- Mechanical</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 14px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CEMENT</td>
					</tr>
				</table>
				<br>	
				<br>
<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border: 1px solid;">
   <?php if ($name_of_work != "") { ?>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Work </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $name_of_work;?></td>
    </tr>
	<?php }if ($agency_name != "") { ?>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>
	<?php }?>
	<tr>
		<?php
					if ($row_select['tpi_name'] != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Consultant </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select['tpi_name']; ?></td>
					<?php } if ($agreement_no != "") {?>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No</td>
		<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $agreement_no; ?></td>
					<?php }?>
	</tr>    
	
    <tr>
		<?php
						if ($clientname != "") {
						?>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Client </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $clientname;?></td>
						<?php }?>
		<td style="padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location</td>
							<td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>   
<tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Type & Brand of Cement </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($cement_brand));?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>	
    <!--<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Name of Agency </td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $agency_name;?></td>
    </tr>-->
    <tr>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
       <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php if ($material_location == 1) {echo "In Laboratory";} else {echo "In Field";} ?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
         <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Quantity from which<br> &nbsp;Sample is Collected</td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $ans['cc_identification_mark']; ?></td>
       
    </tr>
</table>				
				
				
				<br>
			</td>
		</tr>
		</table>
		<br>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-right:1px solid;border-top: 1px solid;border-bottom: 1px solid;">
			<tr style="">
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%" rowspan="2" colspan="2"> Test</td>
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Test Result</td>                            
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Testing Method</td>                            
                
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%" colspan="2">Requirements as per IS : 269-2020</td>
            </tr>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">Garde 43</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">Garde 53</td>
            </tr>
			<?php 
			if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != null && $row_select_pipe['final_consistency'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Standard <br>&nbsp;Consistancy (%)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['final_consistency']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">IS 4031 PART-4</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2"></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != null && $row_select_pipe['ss_area'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Fineness by Blain Air<br>&nbsp;Permeability (m2/Kg)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['ss_area']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">IS 4031 PART-2</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2">Minimum 225</td>
            </tr>
			
			<?php 
			}
			if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Compressive <br>&nbsp;Strength(N/mm<sup>2</sup>)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" rowspan="4">IS 4031 PART-6</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Note less Than</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Note less Than</td>
            </tr>
			<tr style="">
				 <td style="font-size:11px;text-align:center;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
			   <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;72 ± 1 Hours</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com_1']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">23</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">27</td>
            </tr>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
				<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;168 ± 2 Hours</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com_2']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">33</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">37</td>
            </tr>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
				<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;672 ± 4 Hours</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['avg_com_3']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">43</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">53</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Setting Time (Min.)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" rowspan="3">IS 4031 PART-5</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2"></td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != null && $row_select_pipe['initial_time'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Initial</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['initial_time']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2">Not Less than 30</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != null && $row_select_pipe['final_time'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Final</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['final_time']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2">Not More than 600</td>
            </tr>
			<?php 
			}
			if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;font-weight:bold;">&nbsp;Soundness by <br>&nbsp;Le-chatelier (mm)</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $row_select_pipe['soundness']?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">IS 4031 PART-3</td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;" colspan="2">Note More than 10</td>
            </tr>
			<?php } ?>
			
	</table>
	<br>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;padding-left:60px;" colspan="2">1) Test results related to sample collected by Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">2) Results/Reports are issued with the specific understanding that Stern Testing & Consultancy Pvt. Ltd. will not, in any case, be involved in action following the interpretation of test results.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;padding-left:60px;" colspan="2">3) The reports/results are not supposed to be used for Publicity.</td>
						</tr>
						
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:50px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;">Stern Testing & Consultancy Pvt. Ltd.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;width:70%;padding-top:80px;"></td>
							<td style="padding: 1px 2px;font-weight: bold;width:30%;padding-left:5%;">Authorized Signature</td>
						</tr>
						
					</table>
				</td>
			</tr>

		</table>
	<!--<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - cement</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 22%;padding: 0 2px;text-align: left;">&nbsp;Sample ID No :-</td>
							<td style="padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;width:11%;">&nbsp;Report Date :-</td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:22%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part ->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;width: 22%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					<tr>
						<td style="border: 1px solid;padding: 1px 0;text-align: left;" colspan="4"></td>
						
					</tr>
					
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $row_select4['cement_brand']; ?> (<?php echo $row_select4['cement_grade'];?>)</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;width:5%;font-weight: bold;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 0px solid;text-align: left;font-weight: bold;"colspan="2">&nbsp;To &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;--</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Location of Test :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;At Lab.</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Identification No. :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $lab_no;?> <?php if($row_select4['week_number']!=""){echo "Week No. : ".$row_select4['week_number'];}?></td>
					</tr>
					
					
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>-->
					
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>-->
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mark :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mark; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Class :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_specification'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: right;">&nbsp;Size :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_size'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;</td>
					</tr>->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				
				</table>
				
			</td>
		</tr>
	</table>
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-left:2px solid; border-right:2px solid;border-top: 0;">
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;padding:1px;"></td>	
				
			</tr>
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;">TEST RESULT</td>	
				
			</tr>
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;padding:1px;"></td>	
				
			</tr>
	</table>
	
			<?php $cnt = 1; ?>
			
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-right:2px solid;border-LEFt:1px solid;border-bottom:1px solid;">

						<tr style="">
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;">Sr. No.</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:30%;" colspan=2>Particular of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Method of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Results</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Units</td>
							<?php if ($row_select_pipe['type_of_cement'] == 'OPC' ){?>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Requirement Specification <br> IS 269 : 2015</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Requirement Specification <br> IS 1489 : 2015</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Requirement Specification <br> IS 455 : 2015</td>
							<?php }?>
							

						</tr>
						
						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;" colspan=2> Consistency</td>
							<td style="border:1px solid;border-right:0px;text-align:center;">IS:4031 (Part-4): 1988</td>
							
							<td style="border:1px solid;border-right:0px;text-align:center;">
							<?php if ($row_select_pipe['final_consistency'] == "" || $row_select_pipe['final_consistency'] == null || $row_select_pipe['final_consistency'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['final_consistency'], 1);
																																			} ?>
							</td>
							<td style="border:1px solid;border-right:0px;text-align:center;">--</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;">--</td>
							<?php }?>
						</tr>

					
						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;" rowspan="2"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" rowspan="2">Setting Time</td>
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;">Initial Setting Time</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" rowspan="2">IS:4031 (Part-5): 1988</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;"><?php if ($row_select_pipe['initial_time'] == "" || $row_select_pipe['initial_time'] == null || $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">miniute</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 60 minute</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 30 minute</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 30 minute</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 30 minute</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 30 minute</td>
							<?php }?>
						</tr>
						
						<tr style="">
							
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;">Final Setting Time</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;"><?php if ($row_select_pipe['final_time'] == "" || $row_select_pipe['final_time'] == null || $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">miniute</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 600 minute</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 600 minute</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 600 minute</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 600 minute</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 600 minute</td>
							<?php }?>
						</tr>
						

						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" colspan=2> Soundness by Le'chatlier method</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">IS:4031 (Part-3): 1988</td>
							
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">
							<?php if ($row_select_pipe['soundness'] == "" || $row_select_pipe['soundness'] == null || $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?>
							</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">mm</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 10 mm</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 10 mm</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 10 mm</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 10 mm</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Max. 10 mm</td>
							<?php }?>
						</tr>
					

						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" colspan=2> Fineness By Blain Air Permeability</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">IS:4031 (Part-2): 1988</td>
							
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">
							<?php if ($row_select_pipe['ss_area'] == "" || $row_select_pipe['ss_area'] == null || $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?>
							</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">m<sup>2</sup>/kg</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 225 m<sup>2</sup>/kg</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 370 m<sup>2</sup>/kg</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 370 m<sup>2</sup>/kg</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 300 m<sup>2</sup>/kg</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 225 m<sup>2</sup>/kg</td>
							<?php }?>
						</tr>


						

						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" colspan=2> Density by Le'chatlier Flask</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">IS:4031 (Part-11): 1988</td>
							
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">
							<?php if ($row_select_pipe['avg_density'] == "" || $row_select_pipe['avg_density'] == null || $row_select_pipe['avg_density'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_density'], 2);
																																			} ?>
							</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">g/cc</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }?>
						</tr>
						
						<?php if ($row_select_pipe['avg_fbs'] != "" && $row_select_pipe['avg_fbs'] != null && $row_select_pipe['avg_fbs'] == "0") {?>

						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;" colspan=2> Fineness by Dry Sieving</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">IS:4031 (Part-1): 1988</td>
							
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">
							<?php if ($row_select_pipe['avg_fbs'] == "" || $row_select_pipe['avg_fbs'] == null || $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?>
							</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">%</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">--</td>
							<?php }?>
						</tr>
						
						
						
						<?php }?>
						<tr style="">
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;border-bottom:0px;" rowspan="3"> <?php echo $cnt++; ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;border-bottom:0px;" rowspan="3">Compressive Strength</td>
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;">3 Days - 72 ± 1  hours</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;border-bottom:0px;" rowspan="3">IS : 4031 (Part-6) : 1988</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;"><?php if ($row_select_pipe['avg_com_1'] != "" || $row_select_pipe['avg_com_1'] != null || $row_select_pipe['avg_com_1'] != "0" || $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">Mpa</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 27 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 23 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 16 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 16 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 16 Mpa</td>
							<?php }?>
						</tr>
						
						<tr style="">
							
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;">7 Days - 168 ± 2 hours</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;"><?php if ($row_select_pipe['avg_com_2'] != "" || $row_select_pipe['avg_com_2'] != null || $row_select_pipe['avg_com_2'] != "0" || $row_select_pipe['avg_com_2'] != "NaN") {echo number_format($row_select_pipe['avg_com_2'], 1);} else {echo "-";} ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;">Mpa</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 37 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 33 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 22 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 22 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;">Min. 22 Mpa</td>
							<?php }?>
						</tr>



						<tr style="">
							
							<td style="border:1px solid;border-right:0px;text-align:center;padding:5px 4px;border-top:0px;border-bottom:0px;">28 Days - 672 ± 4 hours</td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;border-bottom:0px;"><?php if ($row_select_pipe['avg_com_3'] != "" || $row_select_pipe['avg_com_3'] != null || $row_select_pipe['avg_com_3'] != "0" || $row_select_pipe['avg_com_3'] != "NaN") {echo number_format($row_select_pipe['avg_com_3'], 1);} else {echo "-";} ?></td>
							<td style="border:1px solid;border-right:0px;text-align:center;border-top:0px;border-bottom:0px;">Mpa</td>
							<?php if ($row_select_pipe['cement_grade'] == '53 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;border-bottom:0px;">Min. 53 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '43 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;border-bottom:0px;">Min. 43 Mpa</td>
							<?php }else if ($row_select_pipe['cement_grade'] == '33 OPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;border-bottom:0px;">Min. 33 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PPC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;border-bottom:0px;">Min. 33 Mpa</td>
							<?php }else if ($row_select_pipe['type_of_cement'] == 'PSC' ){?>
							<td style="border:1px solid;text-align:center;border-top:0px;border-bottom:0px;">Min. 33 Mpa</td>
							<?php }?>
						</tr>
						

						<tr style="">
							
							<td style="padding:1px;border:1px solid;border-bottom:0px; " colspan="7"></td>
							
							
						</tr>
						
						

						

					</table>


			
		

		
		<!-- footer design ->
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
		

	<?php } else { ?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - cement</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 22%;padding: 0 2px;text-align: left;">&nbsp;Sample ID No :-</td>
							<td style="padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;width:11%;">&nbsp;Report Date :-</td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:22%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part ->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;width: 22%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					<tr>
						<td style="border: 1px solid;padding: 1px 0;text-align: left;" colspan="4"></td>
						
					</tr>
					
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;width:5%;font-weight: bold;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 0px solid;text-align: left;font-weight: bold;"colspan="2">&nbsp;To &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;">&nbsp;Type Of Cement :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['type_of_cement'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_grade'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;">&nbsp;Brand :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_brand'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;">&nbsp;Week No. :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['week_number'];?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>-->
					
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>-->
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mark :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mark; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Class :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_specification'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: right;">&nbsp;Size :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_size'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;</td>
					</tr>->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				
				</table>
				
			</td>
		</tr>
	</table>
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-left:2px solid; border-right:2px solid;border-top: 0;">
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;">TEST RESULT</td>	
				
			</tr>
	</table>
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid;border-left:1px solid;">
						<tr style="">
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;width:7%;">Sr. No.</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Praticular of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Specification Requirement (LS 269-2015) , Tabel-2, Clause:6.1</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Method of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Total Loss on Ignition(%) by Mass (LI)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 4%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px; ">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['ig4'], 2); ?></td>
						</tr>

						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Total Sulphur Content Calculated as sulphuric Anhydride <br> (SO<sub>3</sub>), (%) by Mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 3.5%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px; padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['so4'] == "" && $row_select_pipe['so4'] == null && $row_select_pipe['so4'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['so4'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Insoluble Residue(%) by Mass (IR)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 5%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['res4'] == "" && $row_select_pipe['res4'] == null && $row_select_pipe['res4'] == "0") {																												echo "-";
																																								} else {
																																									echo number_format($row_select_pipe['res4'], 2);
																																								} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Magnesia (MGO), (%) by Mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 6%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['mgo4'] == "" && $row_select_pipe['mgo4'] == null && $row_select_pipe['mgo4'] == "0") {
																																									echo "-";
																																								} else {
																																									echo number_format($row_select_pipe['mgo4'], 2);
																																								} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Chloride(%)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 0.1%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px; ">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['cl6'], 3); ?></td>
						</tr>


						<!-- <tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:2px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Tri Calcium Aluminate (C<sub>3</sub>A) Content(%) </td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 10%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;">-</td>
						</tr> ->

						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:2px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Alumina Oxide (Al<sub>2</sub>O<sub>3</sub>) , (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985 </td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['alo1'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Silica Oxide (SiO<sub>2</sub>) , (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985 </td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['sio7'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Iron Oxide Fe<sub>2</sub>O<sub>3</sub> (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['feo3'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Calcium Oxide CaO (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['cao4'], 2); ?></td>
						</tr>
					
					    
						
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding-left:7px;padding:5px 4px;">Ratio of % of Line to percentage of Silica , Alumina and Iron Oxide <br>
						    CaO-(0.7xSO<sub>3</sub>)/(2.8xSiO<sub>2</sub>)+(1.2xAl<sub>2</sub>O<sub>3</sub>)+(0.65xFe<sub>2</sub>O<sub>3</sub>)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:5px 4px;">0.80 to 1.02</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:5px 4px;"><?php echo number_format($row_select_pipe['per1'], 2); ?></td>
						</tr>

						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:5px 4px;">Ratio of percentage of Alumina to That of Iron Oxide <br> (Al<sub>2</sub>O<sub>3</sub>/Fe<sub>2</sub>O<sub>3</sub>)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:5px 4px;">Min 0.66</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:5px 4px;"><?php if ($row_select_pipe['alo1'] == "" && $row_select_pipe['alo1'] == null && $row_select_pipe['alo1'] == "0") {
																																										echo "-";
																																									} else {
																																										echo number_format(($row_select_pipe['alo1'] / $row_select_pipe['feo3']), 2);
																																									} ?>																													</td>
						</tr>
					</table>
			
		<!-- footer design ->
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
			
	<?php } ?>




<!-- old code -->


		<!-- <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:80px;">
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr.<br>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bar Dia (mm) *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Mass in Kg/m</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area (mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Yield Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Tensile Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Elongation %</td>
							<td colspan="15" style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bend & Rebend Test</td>
						</tr>

						<?php
								$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);

								while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								
								?>
						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"> <?php echo $cnt++; ?></td>
								

							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe2['dia_1'];  ?></td>
							


		<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['w_1'] != "" || $row_select_pipe2['w_1'] != null || $row_select_pipe2['w_1'] != "0") {
																															if ($row_select_pipe2['dia_1'] == "8 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "10 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "12 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "16 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "20 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "25 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "32 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "4 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "5 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "6 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "28 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "36 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "40 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "45 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "50 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) . "<br>" . "(15.42)";
																															};
																																	} else {
																																		echo "-";
																																	} ?></td>

							
					<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['cs_1'] != "" || $row_select_pipe2['cs_1'] != null || $row_select_pipe2['cs_1'] != "0") {echo $row_select_pipe2['cs_1'];} else {echo "-";} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ys_1'] != "" || $row_select_pipe2['ys_1'] != null || $row_select_pipe2['ys_1'] != "0") {echo $row_select_pipe2['ys_1'];} else {echo "-";} ?></td>

					
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ten_1'] != "" || $row_select_pipe2['ten_1'] != null || $row_select_pipe2['ten_1'] != "0") {
																																								echo $row_select_pipe2['ten_1'];
																																							} else {
																																								echo "-";
																																							} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['elo_1'] != "" || $row_select_pipe2['elo_1'] != null || $row_select_pipe2['elo_1'] != "0") {
																																							echo $row_select_pipe2['elo_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>

						
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['bend_1'] != "" || $row_select_pipe2['bend_1'] != null || $row_select_pipe2['bend_1'] != "0" || $row_select_pipe2['bend_1'] != "undefined") {
																																							echo $row_select_pipe2['bend_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							



						
					</tr>
					<?php
								/* if ($flag6 == 5) {
									break;
								} */
							}

							?>

						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>Method of Test</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1786-2008</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>IS 1608-2022 (Part-1)</td>
							<td colspan="15" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1599-2019</td>
						</tr>
					</table>


				</td>
			</tr>

			    <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 600</b></td>
										</tr>
										
										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Yield Stress (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Tensile Stress N/mm<sup>2</sup> . Min/ % more than actual Yield stress</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">485 / 10%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">500 / 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">545 / 81%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">565 / 10%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">585 / 6%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600 / 8%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">660 / 6%</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Elongation % (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">14.5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">18</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">12</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">16</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">14.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
										</tr>

										<tr>
											<td style="font-size:11px;text-align:left;border:1px solid black;padding:5px 4px;" >&nbsp; Bend Test</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;padding:5px 4px;" colspan=7> There Shall not be any transverse crack/ruputre in the bent portion</td>
                           				 </tr>
								</table>

							</td>
            </tr>


			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI6.3 & 7.2.3</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;margin-bottom:10px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Diameter in mm</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>4</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>5</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>6</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>8</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>10</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>12</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>16</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>20</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>25</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>28</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>32</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>36</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>40</b></td>
										</tr>
										
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Mass per meter (Kg)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.099</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.154</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.222</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.395</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.617</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.888</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">1.580</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">2.470</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.850</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.830</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">6.310</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">7.990</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">9.860</td>
											</tr>
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Tolerances on Nominal Mass</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="5">-8%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="2">-6%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;" colspan="6">-4%</td>
											</tr>
								</table>

							</td>
            </tr>			
		</table> -->

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>
	<?php

	/*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}*/


	/*}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>