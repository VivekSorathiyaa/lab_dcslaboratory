<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>
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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from `np2_pipe` WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
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
			include_once 'sample_id.php';
			if (
				strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "Seal Coat") !== false ||
				strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {
				$mt_name = $row_select3['mt_name'];
			} else {
				$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
				$explodeing = explode(")", $ans);
				$mt_name = $explodeing[0];
			}
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}


	?>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
						<tr>
							<td style="width:40%;padding: 0 2px;text-align: left;">&nbsp;<?php echo $report_no; ?></td>
							
							<td style="width:30%;padding: 0 2px;text-align: left;">&nbsp;<?php if(strlen($_GET['ulr'])>15){echo $_GET['ulr'];}?></td>
							<td style="width:30%;padding: 0 2px;text-align: right;">&nbsp;Page 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 0 2px;text-align: left;border-top:1px solid;" colspan="2">&nbsp;Prepared by : Technical Manager</td>
							<td style="padding: 0 2px;text-align: right;border-top:1px solid;">&nbsp;Approved by : Quality Manager</td>
						</tr>
						
				</table>
				<br>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;">
						<tr>
							<td style="width: 54.5%;padding: 0 2px;text-align: right;">&nbsp;Group:- Building Materials</td>
							<td style="padding: 0 2px;width:45%;text-align: right;">&nbsp;Date:<?php echo date('d/m/Y', strtotime($issue_date));?></td>
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF RCC PIPE
						</td>
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
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample </td>
        <td style="border-bottom: 0px solid;padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
        <td style="text-align: left;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $r_name; ?>&nbsp;&nbsp;<?php
            if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
            ?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
            } else {
            }
        ?></td>
    </tr>
    
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>From</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
        <td style="padding:2px;text-align: center;">&nbsp;To</td>
        <td style="padding:2px;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
        <td style="padding:2px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;Date <b>&nbsp; : &nbsp;</b> <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition </td>
        <td style="padding:2px;text-align: left;font-weight:bold;" colspan="2"><b>&nbsp; : &nbsp;</b>Temperature</td>
        <td style="padding:2px;text-align: center;"><b>&nbsp; : &nbsp;</b>27˚± 2 ˚c</td>
        <td style="padding:2px;text-align: center;"><b></td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Type</td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b>RCC Pipe <?php echo $row_select_pipe['avg_dia'];?> dia.</td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>NP2</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
</table>
				<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Size of Brick <?php echo $row_select4['brick_size'];?> Cm</td>
						</tr>
						
				</table>-->
				
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; padding-top:20px;border-bottom: 1px solid;">
			
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9.6%">Sr. No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Test</td>                            
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:9%">Result</td> 
            </tr>
			<?php $cnt=1;?>
			<?php if ($row_select_pipe['avg_dia'] != "" && $row_select_pipe['avg_dia'] != null && $row_select_pipe['avg_dia'] != "0") { 
			?>
			
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Dia of Pipe</td>
                <td style="border-right:1px solid;font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;"><?php echo $row_select_pipe['avg_dia'];?></td>
            </tr>
			<?php 
			} 
			if ($row_select_pipe['avg_str'] != "" && $row_select_pipe['avg_str'] != null && $row_select_pipe['avg_str'] != "0") { 
			?>
			<tr style="">
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;"><?php echo $cnt++; ?></td>
                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;">Crushing strength(Kg/cm<sup>2</sup>)</td>
                <td style="border-right:1px solid;font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:3px 0px;border-right:0px;border-bottom:0px;border-right:1px solid;"><?php echo $row_select_pipe['avg_str'];?></td>
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
			</td>
		</tr>
		</table>

	<!--<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; ">
		<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
				<input type="hidden" name="rec_date" id="rec_date" value="<?php echo date('Y-m-d',strtotime($rec_sample_date));?>"/>
		</tr>
		<tr>
				<td  style="text-align:center; font-size:11px; "><b><U>(In accordance with IS:458:2003, RA 2013)</u></b></td>
		</tr>
		<tr>
				<td  style="text-align:center; font-size:11px; "><b>&nbsp;</b></td>
		</tr>
		</table>
		<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
			
			<tr style="border: 1px solid black;height:20px;"> 
				<td  style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null){
					echo "<b>ULR:</b> ".$row_select_pipe['ulr'];}?></td>
				
				<td colspan="3" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
					echo " ".$report_no;}?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d/m/Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of Work</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; padding-left:10px;"><?php echo $name_of_work;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; RCC NP-2 Pipe <?php echo $np_dia; ?> &empty; </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submitted To </b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'"; 
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= "";
															}
															echo $clientname; ?> </td>
			</tr>
			
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $r_name." Date:".date('d/m/Y', strtotime($row_select2["letter_date"])); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b>Receipt Date of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Identification Mark</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; RCC NP-2 Pipe <?php echo $np_dia; ?> &empty; </td>
			</tr>
			
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'"; 
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1= $row_selectc1['city_name'];
															}
															echo $agency_name." ".$ct_nm1;?> </td>
			</tr>
			<!--<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php //echo $con_sample; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Client</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php //echo// $clientname; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Consultant</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php // echo $clientname; ?> </td>
			</tr>->
			
			<?php if($agreement_no != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Agreement No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
			</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $lab_no;?></td>
			</tr>
			<!--<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Grade:</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php ?></td>
			</tr>->
			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:right;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
			</tr>
			<?php 
				$first_tag = $row_select['first_tag'];
				$second_tag = $row_select['second_tag'];
				$third_tag = $row_select['third_tag'];
				$fourth_tag = $row_select['fourth_tag'];
				
				$first_txt = $row_select['first_txt'];
				$second_txt = $row_select['second_txt'];
				$third_txt = $row_select['third_txt'];
				$fourth_txt = $row_select['fourth_txt'];
				if($first_tag != null && $first_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt;?></td>				
				</tr>
				<?php }if($second_tag != null && $second_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt;?></td>				
				</tr>
				<?php }if($third_tag != null && $third_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt;?></td>				
				</tr>
				<?php }if($fourth_tag != null && $fourth_tag != ""){?>
				<tr >
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt;?></td>				
				</tr>
				<?php }?>
				<!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>->
		</table>
		<br>
		<table align="center" width="92%" height="100px" class="test"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;margin-left:35px;">
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Sr No.</td>	
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Class of Pipe</td>	
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Diameter of Pipe (mm)</td>	
				<td colspan="3" style="border: 1px solid black;text-align:center;font-weight:bold;width:50%;">Collar Dimention (mm)</td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Minmium<br>Caulking</td>	
				<td style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Minimum<br>Thickness</td>	
				<td style="border: 1px solid black;text-align:center;font-weight:bold;width:16%;">Minimum<br>Length</td>	
			
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">1</td>	
				<td style="border: 1px solid black; text-align:center;">R.C.C.<br>NP-2</td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['avg_dia'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['col1'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['col2'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['col3'];?></td>	
				
			</tr>
			
		</table>
		<br>
		<table align="center" width="92%" height="60px" class="test"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;margin-left:35px;">
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:15%;">Sr No.</td>	
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:40%;">Barrel Wall Thickness (mm)</td>	
				<td colspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;width:20%;">Internal diameter of pipes<br>(mm)</td>	
				<td  style="border: 1px solid black;text-align:center;font-weight:bold;width:20%;">Strength Test<br>Requirements for three<br>Edge Bearing Test</td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">Nominal</td>	
				<td style="border: 1px solid black; text-align:center;">Actual</td>	
				<td style="border: 1px solid black; text-align:center;">Load to produce 0.25 mm Crack KN/Linear metre</td>	
			
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">1</td>	
				
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['avg_thk'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['ini1'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['ini2'];?></td>	
				<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['avg_str'];?></td>	
				
			</tr>
			</table>
		<br>
	<table align="center" width="92%"  class="test" style="border:1px solid black;font-family : Calibri;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the SMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
			<tr>				
				<td colspan="2" style="border:0px solid black;border-bottom:0px solid black;"><input Style="width:100%; border:none; font-weight:bold;" type="text" value=" "></td>
			</tr>
		</table>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="92%" style="font-family : Calibri;">
				<tr>
					<td style="">
						<div style="float:right;" id="footer">
							
						</div>
					</td>
					<td colspan="2" style="width:25%;">
						<div style="float:right; text-align:center; padding-right:60px;" id="sign">
							<img src="../images/stamp.png" width="160px">
						</div>
					</td>
				</tr>
				
				<tr>
					<td style="width:40%;">
						<div style="margin-top:130px;">
							<b style="font-size:11px;font-weight:100;">F/PIPE/01, Issue No.01</b><br>
							<font style="font-size:11px;font-weight:100;">W.e.f. 01.11.2012</font><br>
						</div>
					</td>
					<td style="width:30%;">
						<div style="margin-top:130px;">
							<b style="font-size:15px;font-weight:100;"><b>&#8226;&#8226; End of Report &#8226;&#8226;</b>
						</div>
					</td>
						
					<td style="width:30%;">
						<div style="float:right;margin-top:130px;">
							<b style="font-size:11px;font-weight:100;">Page: 1<br>
						</div>
					</td>
				</tr>
			</table>-->

	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>