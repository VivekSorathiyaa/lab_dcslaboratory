 <?php
session_start();
include("../connection.php");
error_reporting(1); ?>
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
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    //echo $select_tiles_query;
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
	$branch_name = $row_select['branch_name'];
	$cons = $row_select['condition_of_sample_receved'];
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
		$mark = $row_select4['mark'];
		$bitumin_grade = $row_select4['bitumin_grade'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	


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

	<!-- NEW REPORT 1 -->

	<page size="A4">
	<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
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
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
                </tr>
                <tr>
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
                </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Bitumen Ductility</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php //echo $job_no;?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php //echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;3</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php //echo $row_select_pipe['qty_1'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php //echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php //echo $row_select_pipe['s_ret'];?></td>
            </tr>  
        </table> 
            <br><br><br>
            <table align="center" style="width: 95%;">
                <tr>
                    <td style="font-family: 'Calibri';"><b>Pouring Temp</b>&nbsp;&nbsp;&nbsp; <u> <?php echo $row_select_pipe['duc_temp'];?> </u> &nbsp;&nbsp;&nbsp; <b>Period of Cooling in Air</b> &nbsp;&nbsp;&nbsp;<u> <?php echo $row_select_pipe['air_1'];?> </u> &nbsp;&nbsp;&nbsp;<b>  Period of Cooling in Water Bath </b> &nbsp;&nbsp;&nbsp;<u> <?php echo $row_select_pipe['bath_1'];?></u> </td>
                </tr>
            </table>  
            <br><br>
        </table>
    <table align="center" style="width: 95%;" cellspacing="0" cellpadding="10px" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid; text-align: center;font-family: 'calibri';font-size: 20px;font-weight: bold;" colspan="3">DUCTILITY TEST OF BITUMEN <br>(As Per IS: 1208)</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;font-family: 'calibri';font-size: 17px;font-weight: bold;" colspan="3">OBSERVATION TABLE</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;font-family: 'calibri'; font-weight: bold;width: 25%;">Sample</td>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;font-family: 'calibri';font-weight: bold;width: 25%;">Ductility in cm.</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-weight: bold;text-align: center;">Average</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;">1</td>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;"><?php echo $row_select_pipe['duc_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;"><?php echo $row_select_pipe['duc_2'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;">2</td>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;"><?php echo $row_select_pipe['duc_2'];?></td>
            <td style="border-left: 1px solid;border-right: 1px solid;text-align: center;"><?php echo $row_select_pipe[''];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;text-align: center;">3</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;text-align: center;"><?php echo $row_select_pipe['duc_3'];?></td>
            <td style="border-left: 1px solid;border-bottom: 1px solid;border-right: 1px solid;text-align: center;"><?php echo $row_select_pipe[''];?></td>
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
        <table style="width: 92%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>	
		<!-------------------------------------------------------------------------------------------------------------------------------->
<div class="pagebreak"></div>
		<br><br><br><br><br><br><br><br><br><br>
		<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
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
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
                </tr>
                <tr>
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
                </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Flash and Fire Point</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php //echo $job_no;?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php //echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;4</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php// echo $row_select_pipe['qty_1'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php //echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php //echo $row_select_pipe['s_ret'];?></td>
            </tr>  
        </table> 
            <br><br>
            <table align="center" style="width: 95%;font-family: 'Calibri';text-align: center;">
                <tr>
                    <td style="font-size: 15px;"><b>FLASH AND FIRE POINT</b></td>
                </tr>
                <tr>
                    <td style="font-size: 12px;"><b>As Per IS 1448 Part-69</b></td>
                </tr>
            </table>  
            <br>
        </table>
    <table align="center" style="width: 95%;font-family: 'calibri';" cellspacing="0" cellpadding="2px" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;font-weight: bold;width: 15%;">S.NO</td>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;font-weight: bold;width: 50%;">DETERMINATION</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-weight: bold;text-align: center;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;">Flash Point ˚C</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;text-align: center;font-weight: bold;">Average</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;">1</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sp_a_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;text-align: center;font-weight: bold;" rowspan="2"><?php echo $row_select_pipe['sp_1'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;">2</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sp_b_1'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;">Fire Point ˚C</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;text-align: center;font-weight: bold;">Average</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;">1</td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['sp_d_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;text-align: center;border-bottom: 1px solid;font-weight: bold;" rowspan="2"><?php echo $row_select_pipe['avg_sp'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;text-align: center;border-bottom: 1px solid;">2</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"><?php echo $row_select_pipe['sp_c_1'];?></td>
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
        <table style="width: 92%;" align="center">
            <tr>
             <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by : <u><?php echo $u_name; ?> </u></td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By: <u><?php echo $v_name; ?> </u></td></b>
          </tr>
        </table>	
	<!-------------------------------------------------------------------------------------------------------------------------------->
		<div class="pagebreak"></div>
		<br><br><br><br><br><br><br><br><br><br>
	 <table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
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
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
                </tr>
                <tr>
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
                </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Bitumen Penetration</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php //echo $job_no;?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php// echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php// echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;1</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php// echo $row_select_pipe['qty_1'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php //echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php// echo $row_select_pipe['s_ret'];?></td>
            </tr>         
    </table>
    <br><br><br><br>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="5px" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 20px;font-weight: bold;" colspan="5">PENETRATION TEST OF BITUMEN <br>(As Per IS :1203)</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 20px;font-weight: bold;" colspan="5">OBSERVATION TABLE</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-weight: bold;">SNo.</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-weight: bold;">Description</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-weight: bold;">Reading 1</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-weight: bold;">Reading 2</td>
            <td style="border-top: 1px solid;border-right: 1px solid;font-weight: bold;">Reading 3</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">1</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">Initial Dial Gauge Reading</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['idg_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['idg_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['idg_3'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">2</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">Final Dial Gauge Reading</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['fdg_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['fdg_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['fdg_3'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;">3</td>
            <td style="border-top: 1px solid;border-right: 1px solid;">Penetration <br> (in 1/10 of mm) in 5 seconds</td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pen_1'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pen_2'];?></td>
            <td style="border-top: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['pen_3'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left: 1px solid;border-right: 1px solid;font-weight: bold;" colspan="2">Average:</td>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-right: 1px solid;" colspan="3"><?php echo $row_select_pipe['avg_pen'];?></td>
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
		<!--------------------------------------------------------------------------------------------->
		
	<div class="pagebreak"></div>
		<br><br><br><br><br><br><br><br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
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
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
                </tr>
                <tr>
                    <td style="text-align: center;font-weight: bold;font-size: 11px;font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
                </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Softening Point</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php// echo $job_no;?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php //echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;
</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php //echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php// echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;2</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php //echo $row_select_pipe['qty_1'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php //echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php //echo $row_select_pipe['s_ret'];?></td>
            </tr>         
    </table>
    <br><br>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="2px" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 20px;font-weight: bold;" colspan="5">SOFTENING POINT  TEST OF BITUMEN<br>(As Per IS :1205)</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 20px;font-weight: bold;" colspan="5"><u>OBSERVATION TABLE</u></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;" colspan="2"><u>Ball-1</u></td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;border-right: 1px solid;" colspan="3"><u>Ball-2</u></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;font-size: 15px;">TIME ( MINUTES)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-size: 15px;">TEMP. OF WATER <br>BATH &deg;C</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-size: 15px;"colspan="2">TIME  <br>( MINUTES)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-size: 15px;border-right: 1px solid;">TEMP. OF WATER <br>BATH &deg;C</td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">0</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw1'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">0</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw2'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">1</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw3'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid"colspan="2">1</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw4'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">2</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw5'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">2</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw6'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">3</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw7'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">3</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw8'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">4</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw9'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">4</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw10'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">5</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw11'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">5</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw12'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">6</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw13'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">6</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw14'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">7</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw15'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">7</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw16'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">8</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw17'];?></td></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">8</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw18'];?></td></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">9</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw19'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">9</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw20'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">10</td>
            <td style="border-top: 1px solid;border-left : 1px solid;"><?php echo $row_select_pipe['tw21'];?></td>
            <td style="border-top: 1px solid;border-left : 1px solid;"colspan="2">10</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['tw22'];?></td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;" colspan="2" rowspan="2">TEST PROPERTY</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;" colspan="2">SAMPLE NO. 1</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;border-right: 1px solid;">Mean Value</td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;">Ball no.1</td>
            <td style="border-top: 1px solid;border-left : 1px solid;font-weight: bold;">Ball no.2</td>
            <td style="border-left : 1px solid;font-weight: bold;border-right: 1px solid;">Softening  Point</td>
        </tr> 
        <tr>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left : 1px solid;" colspan="2">Temperature &deg;C at which sample touches <br>bottom plate</td>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left : 1px solid;font-weight: bold;"><?php echo $row_select_pipe['bn_1'];?></td>
            <td style="border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;border-top:1px solid;"><?php echo $row_select_pipe['bn_2'];?></td>
            <td style="font-weight: bold;border: 1px solid;"><?php echo $row_select_pipe['avg_sof'];?></td>
        </tr> 
    </table>
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
<!-------------------------------------------------------------------------------------------------------------------------------->
    <!---<br><br><br><br><br><br><br><br>
        <table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-9816755805,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">Regd. Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Bitumen Content</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $job_no;?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;BITUMEN CONTENT</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:</td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Method:&nbsp;IRC SP-11
            &nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;3</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:</td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:</td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:</td>
            </tr>         
    </table>
    <br><br><br>
    <table align="center" style="width: 95%;text-align: center;border: 1px solid;"  cellspacing="2px" cellpadding="5px" bordercolor ="black">
        <tr>
            <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;">BITUMEN CONTENT</td>
        </tr>
    </table>
    <table align="center" style="width: 95%;"  cellspacing="5px" cellpadding="15px" >
        <tr>
            <td style="font-family: 'Calibri';font-size: 20px;font-weight: bold;">Bitumen Extraction Test For…………………………………………….[IRC SP-11]</td>
        </tr>
    </table>
    <table align="center" style="width: 95%;" cellspacing="0" cellpadding="2px" >
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;width: 40%;">&nbsp;Sample No.</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;" colspan="2"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of sample before Extraction</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;width: 40%;">A (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of sample after Extraction</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">B (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of filter paper before Extraction</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">C (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of filter paper after Extraction</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">D (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of Mineral  Aggregate</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">F= D-C (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of Total Aggregate</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">G= B+F (gm)</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;">&nbsp;Wt. of bitumen Extracted</td>
            <td style="border-top: 1px solid;border-left : 1px solid;text-align: center;">H= A-G (gm) </td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-right: 1px solid;"></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left : 1px solid;border-bottom: 1px solid;">&nbsp;% Bitumen content in mix</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-bottom: 1px solid;text-align: center;">(H/A) X 100</td>
            <td style="border-top: 1px solid;border-left : 1px solid;border-bottom: 1px solid;border-right: 1px solid;"></td>
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
        <table style="width: 92%;" align="center">
            <tr>
                <td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Checked by</td></b>
                <td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Analyst</td></b>
          </tr>
        </table>--->
<!------------------------------------------------------------------------------------------------------------------------------------>
        
        
	
		
		

		

		
	</page>
	

	


</body>

</html>

<script type="text/javascript">


</script>