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
    $select_tiles_query = "select * from clc_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
            $mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
    }

    $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
    $result_select4 = mysqli_query($conn, $select_query4);

    if (mysqli_num_rows($result_select4) > 0) {
        $row_select4 = mysqli_fetch_assoc($result_select4);
        /* $mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification']; */
        $material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
        $inl = $row_select4['inl'];
        $inw = $row_select4['inw'];
        $inh = $row_select4['inh'];
        $ingrade = $row_select4['ingrade'];
        $inden_1 = $row_select4['inden_1'];
		
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 15px;padding: 2px 0;"  colspan="4">TITLE : TEST REPORT OF CC BLOCK
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
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Density </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe['in_den'];?></td>
    </tr>
	
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b>Sample Collected by the Supplier</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Job No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $job_no;?></td>
    </tr>
    <tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark </td>
        <td style="padding:2px;text-align: left;" colspan="4"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe['in_l']; ?> x <?php echo $row_select_pipe['in_w']; ?> x <?php echo $row_select_pipe['in_h']; ?> mm</td>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Lab No. </td>
        <td style="padding:2px;text-align: left;"><b>&nbsp; : &nbsp;</b><?php echo $lab_no;?></td>
    </tr>
	<tr>
        <td style="padding:2px;text-align: left;font-weight: bold;">&nbsp;Grade</td>
        <td style="padding:2px;text-align: left;" colspan="6"><b>&nbsp; : &nbsp;</b><?php echo $row_select_pipe['in_grade'];?></td>
    </tr>
</table>		
				<!--<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 1px solid;border-bottom: 0;">
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Work :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $name_of_work;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Name of Client :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="6">&nbsp;<?php echo $clientname;?></td>
						</tr>				
						<tr>
							<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Receipt Sample :-</td>
							<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
							<td style="text-align: left;border-left: 1px solid;font-weight: bold;" rowspan="2">&nbsp;Sender's Reference</td>
							<td style="padding: 0 2px;text-align: left;border-left: 1px solid;" rowspan="2">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?></td>
						</tr>
						
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Date of Test Performed :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;From</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;To</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
							<!--<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Date :- <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>->
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Enviromental Condition :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight:bold;" colspan="2">&nbsp;Temperature :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;" colspan="2">&nbsp;27˚± 2 ˚c</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Grade</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['in_grade'];?></td>
						</tr>
						<tr>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sampling Method :-</td>
							<td style="border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;Sample Collected by the Supplier</td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Job No. :- </td>
							<td style="border-top: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $job_no;?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Identification Mark :-</td>
							<td style="border-bottom: 1px solid;border-top: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="4">&nbsp;<?php echo $row_select_pipe['in_l']; ?> x <?php echo $row_select_pipe['in_w']; ?> x <?php echo $row_select_pipe['in_h']; ?> mm</td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;font-weight: bold;">&nbsp;Lab No. :- </td>
							<td style="border-top: 1px solid;border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $lab_no;?></td>
						</tr>
						
				</table>
				<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;padding-top:20px;padding-bottom:20px;">
						<tr>
							<td style="width: 50%;padding: 0 2px;text-align: left;font-size:15px;">&nbsp;Dimensions Tolerances</td>
						</tr>
						
				</table>-->
				<?php if ($row_select_pipe['wa_1'] != "" && $row_select_pipe['wa_1'] != null && $row_select_pipe['wa_1'] != "0") { 
			?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; border-bottom: 1px solid;padding-top:20px;">
			<tr style="">
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:41%;border-right:1px solid;border-top:1px solid;">IS 2185-1</td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Specimen No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Wet Weight of Block <br>(gm) (W1)</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Dry Weight of Block<br> (gm) (W2)</td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">% water Absorption W1 - W2 / W2 x 100</td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">1</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['weight_1']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['w1']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['wa_1']; ?></td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">1</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['weight_2']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['w2']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['wa_2']; ?></td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">1</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['weight_3']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['w3']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['wa_3']; ?></td> 
            </tr>
			
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;" colspan="3">Avg</td>
                <td style="border-top:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['mc']; ?></td>
            </tr>
	</table>
	<?php 
			}
			if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") { 
			?>
	<br>
	<br>
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; borderpadding-top:20px;">
			<tr style="">
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;padding:3px 0px;width:19.6%"></td>
                <td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;width:41%;border-right:1px solid;border-top:1px solid;">IS:6441 P5-72 (2017)</td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Specimen No.</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Area of Block</td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Load (KN)</td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:3px 0px;">Compressive Strength (N/mm<sup>2</sup>)</td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">1</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['area_1']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['load_1']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['com_1']; ?></td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">2</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['area_2']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['load_2']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['com_2']; ?></td> 
            </tr>
			<tr style="">
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;">3</td>
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['area_3']; ?></td>                            
                <td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['load_3']; ?></td> 
                <td style="border-right:1px solid;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['com_3']; ?></td> 
            </tr>
			
			<tr style="">
                <td style="border-top:1px solid;border-bottom:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;" colspan="3">Avg</td>
                <td style="border-top:1px solid;border-bottom:1px solid;border-right:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;"><?php echo $row_select_pipe['avg_com']; ?></td>
            </tr>
			<tr style="">
                <td style="text-align:center;font-weight:bold;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;font-weight:bold;padding:3px 0px;width:19.6%"></td>
                <td style="text-align:center;font-weight:bold;padding:3px 0px;width:19.6%"></td>
                <td style="border-bottom:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;padding:3px 0px;width:41%;border-right:1px solid;"> Min  5 N/mm<sup>2</sup></td> 
            </tr>
	</table>
			<?php }?>
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
	<!--<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - CLC Block</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part ->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Length :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $inl; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Width :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $inw; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Height :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $inh; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $ingrade; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Density :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $inden_1; ?></td>
					</tr>
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

        <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;border-top:0px;">
            <tr>
                <!--OTHER START->
                <td>


                    <table align="left" width="100%" class="test" style="height:auto;width:100%;border-top:0px;border-bottom:0px;border-left:1px solid;border-right:1px solid;">
                        <tr style="text-align:center;">

                            <td style="border:1px solid black;border-left:0px solid black;width:7%;border-top:0px;"><b>Sr. No.</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;width:13%;border-top:0px;"><b>BulkDensity<br>(g/cm<sup>3</sup>)</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;width:10%;border-top:0px;"><b>Moisture Content<br>(%)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:11%;border-top:0px;"><b>Load<br>(KN)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:11%;border-top:0px;"><b>Area of<br>Brick<br>(mm<sup>2</sup>)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:12%;border-top:0px;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:13%;border-top:0px;"><b>Size of Specimen L X W X T<br>(mm)</b></td>
                            <td style="border:1px solid black;border-right:0px solid black;width:10%;border-top:0px;"><b>Drying Shrinkage<br>(%)</b></td>
                        </tr>

                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;">1</td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['den_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['wa_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['load_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['area_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['com_1']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['con_1'] . " X " . $row_select_pipe['con_wid_1'] . " X " . $row_select_pipe['con_thi_1']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;padding:4px 4px;"><?php echo $row_select_pipe['ds_1']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;">2</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['den_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wa_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_2']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_2'] . " X " . $row_select_pipe['con_wid_2'] . " X " . $row_select_pipe['con_thi_2']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ds_2']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;">3</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['den_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wa_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['load_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['area_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_3']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['con_3'] . " X " . $row_select_pipe['con_wid_3'] . " X " . $row_select_pipe['con_thi_3']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ds_3']; ?></td>
                        </tr>

                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><b>Average</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo round($row_select_pipe['mc']); ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>

                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo round($row_select_pipe['avg_com'], 1); ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>
                            <td style="border:1px solid black;border-left:0px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avg_shrink'] != "" && $row_select_pipe['avg_shrink'] != '0' && $row_select_pipe['avg_shrink'] != 'NAN') {
                                                                                                echo round($row_select_pipe['avg_shrink'], 2);
                                                                                            }  ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;">Method of<br>Testing</td>
                            <td colspan="2" style="border:1px solid black;border-left:0px solid black;">IS:6441 (P 1)-1972 RA. 2012</td>

                            <td colspan="3" style="border:1px solid black;border-left:0px solid black;">IS:6441 (P 5)-1972 RA. 2012</td>
                            <td colspan="2" style="border:1px solid black;border-left:0px solid black;border-right:0px solid black; ">IS:6441 (P 2)-1972 RA. 2012</td>

                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;">Req.<br>IS. 2185 (P 3) <br>1984 RA. 2015</td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['in_den'] ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;">---</td>

                            <td colspan="3" style="border:1px solid black;border-left:0px solid black;">Compressive Strength Shall Not be less than<br><?php if ($row_select_pipe['in_den'] == "451 to 550" && $row_select_pipe['in_grade'] == "grade 1") {
                                      echo "2.0";
                                        } else if ($row_select_pipe['in_den'] == "451 to 550" && $row_select_pipe['in_grade'] == "grade 2") {
                                            echo "1.5";
                                        } else if ($row_select_pipe['in_den'] == "551 to 650" && $row_select_pipe['in_grade'] == "grade 1") {
                                            echo "4.0";
                                       } else if ($row_select_pipe['in_den'] == "551 to 650" && $row_select_pipe['in_grade'] == "grade 2") {
                                            echo "3.0";
                                       } else if ($row_select_pipe['in_den'] == "651 to 750" && $row_select_pipe['in_grade'] == "grade 1") {
                                            echo "5.0";
                                       } else if ($row_select_pipe['in_den'] == "651 to 750" && $row_select_pipe['in_grade'] == "grade 2") {
                                            echo "4.0";
                                       } else if ($row_select_pipe['in_den'] == "751 to 850" && $row_select_pipe['in_grade'] == "grade 1") {
                                            echo "6.0";
                                       } else if ($row_select_pipe['in_den'] == "751 to 850" && $row_select_pipe['in_grade'] == "grade 2") {
                                            echo "5.0";
                                        } else if ($row_select_pipe['in_den'] == "851 to 1000" && $row_select_pipe['in_grade'] == "grade 1") {
                                            echo "7.0";
                                         } else if ($row_select_pipe['in_den'] == "851 to 1000" && $row_select_pipe['in_grade'] == "grade 2") {
                                             echo "6.0";
                                        }
                                         ?> N/mm<sup>2</sup></td>
                            <td colspan="2" style="border:1px solid black;border-left:0	px solid black;border-right:0px solid black;">
                                <?php
                                if ($row_select_pipe['in_grade'] == "grade 2") {
                                    echo "Max. 0.1 %";
                                } else {
                                    echo "Max. 0.05 %";
                                }

                                ?>
                            </td>

                        </tr>



                    </table>

                </td>

            </tr>
            <tr >
                <td style="border-left:1px solid;border-right:1px solid;"><br><br><br></td>
            </tr>


            <tr>
                <td>
                    <table align="left" class="test" style="height:Auto;width:100%;border-left:1px solid;border-right:1px solid;">
                        <tr style="text-align:center;">
                            <td style="width:40%;border:1px solid black;border-left:0px solid black;padding:4px 4px;">Dimension Test</td>
                            <td style="width:20%;border:1px solid black;border-left:0px solid black;">Length, mm</td>
                            <td style="width:20%;border:1px solid black;border-left:0px solid black;">Width, mm</td>
                            <td style="width:20%;border:1px solid black;border-right:0px solid black;">Thickness, mm</td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;padding:4px 4px;"><b>Results</b></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['dim_length']; ?></td>
                            <td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['dim_width']; ?></td>
                            <td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['dim_height']; ?></td>
                        </tr>
                        <tr style="text-align:center;">
                            <td style="border:1px solid black;border-left:0px solid black;border-bottom:0px;padding:4px 4px;">Requirement as per IS. 2185 (P-3)-1984 RA. 2015</td>
                            <td style="border:1px solid black;border-left:0px solid black;border-bottom:0px;">&plusmn; 5 mm</td>
                            <td style="border:1px solid black;border-left:0px solid black;border-bottom:0px;">&plusmn; 3 mm</td>
                            <td style="border:1px solid black;border-right:0px solid black;border-bottom:0px;">&plusmn; 3 mm</td>

                        </tr>


                    </table>

                </td>
            </tr>
        </table>


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

		</table>-->
       
    </page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
