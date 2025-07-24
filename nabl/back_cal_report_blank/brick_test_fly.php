<?php 
session_start();
include("../connection.php");
error_reporting(1);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
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
/* body {
  background-image: url('letter_pad/letter_pad.jpg');
} */

</style>
<html>
	<body>
						<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
		 $select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$tested_by = $row_select['tested_by'];
			$verify_by = $row_select['reported_by_review'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];
			$branch_name = $row_select['branch_name'];			
			$type_of_material= $row_select['type_of_material'];		

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
			
			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
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
					$mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification'];
				}
		?>
		

		<br>
	<br>
	<br>
	<br>
		<page size="A4">
		<table align="center" style="width: 95%;text-align: center;border:1px solid;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px">
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
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;border-right: 1px solid;font-family: 'calibri';font-size: 15px;">Brick</td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;" colspan="6">  ANALYSIS DATA SHEET    </td>
                <td style="text-align: center;border-top: 1px solid;font-weight: bold;font-family: 'calibri';font-size: 20px;">     QSF-1001</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Job Card No:&nbsp;<?php echo $_GET['job_no'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;Test:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="4">&nbsp;Sample Description:&nbsp;<?php echo $row_select_pipe['s_des'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="4">&nbsp;&nbsp;Method:&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="2">&nbsp;DOR:&nbsp;<?php //echo date('d/m/Y', strtotime($row_select['sample_rec_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;DOS:&nbsp;<?php// echo date('d-m-y', strtotime($row_select2['start_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left: 1px solid;" colspan="2">&nbsp;DOC:&nbsp;<?php// echo date('d-m-y', strtotime($row_select2['end_date']));?></td>
                <td style="text-align: left;border-top: 1px solid;border-left:1px solid;" colspan="2">&nbsp;Page No:&nbsp;1</td>
            </tr>
            <tr>
                <td style=" text-align: left;border-top: 1px solid;" colspan="3">&nbsp;Sample Qty:&nbsp;<?php //echo $row_select_pipe['no_of_brick'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="2"> &nbsp;Residual Sample:&nbsp;<?php// echo $row_select_pipe['r_sam'];?></td>
                <td style="text-align: left;border-top: 1px solid;border-left : 1px solid;" colspan="3">&nbsp;Sample Retention:&nbsp;<?php// echo $row_select_pipe['s_ret'];?> </td>
            </tr>    
    </table>
     <br><br>
     <table  align="center" style="width: 95%;">
        <tr>
            <td style="font-family: 'calibri';font-size: 17px;font-weight: bold;padding: 0 30px;" colspan="10">1.0 Dimension Test of Brick</td>
        </tr>
    </table>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="0" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: left;font-family: 'calibri';font-size: 17px;font-weight: bold;" colspan="4">Dimension Test Of Brick As Per IS:1077:1992/R2016</td>
            
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;(i)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;(ii)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;">Avg</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;Length (mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;<?php echo $row_select_pipe['dim_length'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;<?php echo $row_select_pipe['dim_length1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;">&nbsp;<?php echo $row_select_pipe['avg_length'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;Width (mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;<?php echo $row_select_pipe['dim_width'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;">&nbsp;<?php echo $row_select_pipe['dim_width1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;">&nbsp;<?php echo $row_select_pipe['avg_width'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;border-bottom: 1px solid;">&nbsp;Height (mm)</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;border-bottom: 1px solid;">&nbsp;<?php echo $row_select_pipe['dim_height'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;text-align: left;border-bottom: 1px solid;">&nbsp;<?php echo $row_select_pipe['dim_height1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;border-right: 1px solid;border-bottom: 1px solid;">&nbsp;<?php echo $row_select_pipe['avg_height'];?></td>
        </tr>
    </table>
    <br>
     <table  align="center" style="width: 95%;">
        <tr>
            <td style="font-family: 'calibri';font-size: 17px;font-weight: bold;padding: 0 30px;" colspan="10">2.0 Compressive Test of Bricks</td>
        </tr>
    </table>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="0" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;text-align: center;font-family: 'calibri';font-size: 17px;font-weight: bold;" colspan="5">Compressive Strength N/mm2 As per IS:3495(1)1992/R2019</td>   
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;height: 30px;vertical-align: top;">Length mm</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;">Width mm</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;">Area mm2</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;">Load KN</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;border-right: 1px solid;">C/S N/mm2</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_b_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_area_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_load_1'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><br><?php echo $row_select_pipe['com_1'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_b_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_area_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_load_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_2'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_b_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_area_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_load_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_3'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_b_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_area_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_load_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_4'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_b_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_area_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_load_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_5'];?></td>
        </tr>
		<tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['com_l_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_b_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_area_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['com_load_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['com_6'];?></td>
        </tr>
		 <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"><br></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">Avg.</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;border-right: 1px solid;font-weight: bold;"><?php echo $row_select_pipe['avg_com'];?></td>
        </tr>
    </table>
    <br>
    <br>
<table  align="center" style="width: 95%;">
        <tr>
            <td style="font-family: 'calibri';font-size: 17px;font-weight: bold;padding: 0 30px;" colspan="10">3.0 Water Absorption </td>
        </tr>
    </table>
    <table align="center" style="width: 95%;text-align: center;" cellspacing="0" cellpadding="0" >
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;font-family: 'calibri';font-size: 17px;font-weight: bold;" colspan="4">Water Absorption %  As per  IS:3495(2)1992/R2019</td>   
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;height: 30px;vertical-align: top;">Oven Dry wt. <br>gm</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;">SDD wt. gm</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;">water wt (SSD-oven dry) gm</td>
            <td style="border-top: 1px solid;border-left: 1px solid;font-weight: bold;vertical-align: top;border-right: 1px solid;">water <br>Absorption %</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_1'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['wtr_w1_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['wtr_w2_2'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_2'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['wtr_w1_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['wtr_w2_3'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_3'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['wtr_w1_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['wtr_w2_4'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_4'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['wtr_w1_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['wtr_w2_5'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_5'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;"><br><?php echo $row_select_pipe['wtr_w1_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"><?php echo $row_select_pipe['wtr_w2_6'];?></td>
            <td style="border-top: 1px solid;border-left: 1px solid;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['wtr_6'];?></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;"><br></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;"></td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;font-weight: bold;">Avg.</td>
            <td style="border-top: 1px solid;border-left: 1px solid;border-bottom: 1px solid;border-right: 1px solid;"><?php echo $row_select_pipe['avg_wtr'];?></td>
        </tr>
    </table>
    <table  align="center" style="width: 95%;">
        <tr>
            <td style="font-family: 'calibri';font-size: 17px;font-weight: bold;padding: 0 30px;" colspan="10">4.0 Efflorescence =&nbsp;<?php echo $row_select_pipe['rbt_efflo1'];?></td>
        </tr>
    </table>
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
		</page>
		
		<!--<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
           <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 1</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BRICK</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;border-bottom:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-bottom:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
		<?php $cnt=1;?>
		<!--<tr>
				<td  style="text-align:center;font-size:14px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:14px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style=""> 
							
							<td  style="width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style=""> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $lab_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						
						<!--<tr style=""> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style=""> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($start_date));?></td>
						</tr>
						<tr style=""> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($end_date));?></td>
						</tr>->
						
					</table><br>
				
				</td>
		</tr> 
			<!-- header design ->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">Burnt Clay BRICK</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Job No :- </td>
                            <td style="padding: 5px;"> <?php echo $lab_no; ?></td>
						
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Format No :-</td>
                            <td style="padding: 5px;"> ICT-BRK-TST-01</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Brand/Sample ID :-</td>
                            <td style="padding: 5px;"> <?php echo $sample_id; ?></td>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 12%;">Testing Date :-</td>
                            <td style="padding: 5px;"><?php echo date('d/m/Y', strtotime($start_date)); ?>&nbsp; To &nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
                            <td style="padding: 5px;"><?php echo $mt_name; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;border: 1px solid;" colspan="4"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 10%;">Test Method :-</td>
                            <td style="padding: 5px;border-left: 1px solid;">IS : 3495 (Part 1) : 2019 , IS : 3495 (Part 2) : 2019 , IS : 3495 (Part 3) : 2019 , IS : 14858 : 2000 Reaffirmed 2021, <br>IS : 5454 :1978 Reaffirmed 2020 , IS : 1077 :1992 Reaffirmed 2021</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;border: 1px solid;" colspan="6"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
                        </tr>
						<tr>
                            <td  colspan="6"></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;border: 1px solid;" colspan="6"></td>
                        </tr>
                        <tr>
                            <td style="padding: 1px;border: 1px solid;" colspan="6">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>-->


			<!-- Table Start -->

			<!--<tr>
					<td>
						<table align="center" width="80%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-top: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 2px;border-top: 0;width:10%;">&nbsp; Job No.: -</td>
								<td style="padding: 2px;width:60%;"><?php echo $job_no;?></td>
								<td style="font-weight: bold;text-align: right;padding: 2px;border-top: 0;width:10%;">Date: -</td>
								<td style="padding: 2px;width:20%;"><?php echo date('d/m/Y', strtotime($start_date)); ?> &nbsp; to &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
								</tr>
						</table>
					</td>
				</tr>->
			<tr>
                <td>
				<br>
				<br>
				<br>
                    <?php $cnt=1; ?>
                    <table align="center" width="80%"  style="padding-top:100px;font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;">
                        
						<tr>
                            <td style="font-weight: bold;text-align: left;padding: 2px;border: 0px solid;" colspan="13">03. Water Absorption </td>
                        </tr>
						<tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="13"> Water Absorption % As per IS:3495(2)1992/R2019</td>
                        </tr>
						
						<tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="4">Sr. <br>No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-bottom: 1px solid;" rowspan="4">Identification Mark</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="3" rowspan="2">Individual Brick Dimensions</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="3">Compressive Strength (IS 3495 PART-1)</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="3">Water Absorption (IS 3495 PART-2)</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="4">Efflorescence<br>(IS 3495 PART-3)</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="4">Remarks</td>
                        </tr>
						<tr>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Area</td>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Observed Failure Load</td>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Strength</td>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Dry Weight</td>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Wet Weight</td>
						<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Water Absorption</td>
						</tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">L</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">B</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">H</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm²</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">P</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">P/(LxW) x 1000</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">M<sub>1</sub></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">M<sub>2</sub></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">( M<sub>2</sub>- M<sub>1</sub>/ M<sub>1</sub>) *100</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">mm</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">KN</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N/mm²</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">Kg</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">Kg</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">%</td>
                        </tr>
						<tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_lab_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_l_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_b_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_h_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_area_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_load_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w1_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w2_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["rbt_efflo1"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;" rowspan="5"><?php echo $row_select_pipe["remarks"] ?></td>
						</tr>
						<tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_lab_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_l_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_b_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_h_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_area_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_load_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w1_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w2_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_2"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["rbt_efflo2"] ?></td>
						</tr>
						<tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_lab_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_l_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_b_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_h_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_load_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_area_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w1_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w2_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_3"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["rbt_efflo3"] ?></td>
						</tr>
						<tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_lab_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_l_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_b_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_h_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_area_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_load_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w1_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w2_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_4"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["rbt_efflo4"] ?></td>
						</tr>
						<tr>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_lab_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_l_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_b_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_h_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_area_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_load_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["com_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w1_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_w2_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["wtr_5"] ?></td>
                            <td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe["rbt_efflo5"] ?></td>
						</tr>
						
					</table>
                </td>
            </tr>
			
			 <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid;border-left: 1px solid;border-right: 1px solid;">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 25px;border: 1px solid;border-top: 1px solid;width: 10%;">NOTE :-</td>
                            <td style="padding: 5px;border: 1px solid;font-weight: bold;"> Actual load is the one obtained after applying the calibration correction </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;border: 1px solid;" colspan="6"></td>
                        </tr>
						<br>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border: 0px solid; width: 8%;" colspan="6"></td>
                        </tr>
						<tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border: 2px solid; width: 8%;" colspan="6">Dimension Test (IS 1077-2011)</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border: 2px solid; width: 8%;" colspan="6">Observation Table:</td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
			
			<tr>
                <td>
                    <?php $cnt=1; ?>
                    <table align="center" width="70%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;">
                       
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid; width:10%;"rowspan="2" >Sr. No.</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:15%;"rowspan="2"> Identification Mark</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:15%;">Length (L) of <?php echo $row_select_pipe["no_of_brick"] ?> Bricks</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;width:15%;">Width (W) of <?php echo $row_select_pipe["no_of_brick"] ?> Bricks</td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;width:20%;">Height (H) of <?php echo $row_select_pipe["no_of_brick"] ?> Bricks</td>
						</tr>
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
						    <td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm</td>
						</tr>
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid; width:15%;">1</td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe["id_mark"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_length"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_width"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_height"] ?></td>
						</tr>
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid; width:15%;">2</td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_length1"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_width1"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["dim_height1"] ?></td>
						</tr>
						<tr>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid; width:15%;">3</td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["avg_length"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["avg_width"] ?></td>
						    <td style="font-weight: bold;text-align: center;padding: 10px;border: 1px solid;"><?php echo $row_select_pipe["avg_height"] ?></td>
						</tr>
					</table>
					<BR>
					<BR>
					<BR>
				</td>
			</tr>

			

			<!-- footer design ->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
        </table>-->

		<!-- <br>
		
	<page size="A4">
		
		<?php if ($branch_name == "Nadiad") {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php } else {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name;?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php }?>	
		<br><br>

		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of brick</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mt_name; ?> BURNT CLY BRICKS</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mark; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br><br>
		<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;">

					<table align="center" width="100%"  class="test1" cellspacing="0" cellpadding="0" style="font-family : Calibri;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" rowspan="2" colspan="2">&nbsp;&nbsp; A. &nbsp;&nbsp; Dimensions Tolerances &nbsp;&nbsp;</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?> </td>
						</tr>
						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; IS:1077-1992</td>
						</tr>
						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; No. of Brick = <?php if ($row_select_pipe['no_of_brick'] != "" && $row_select_pipe['no_of_brick'] != "0" && $row_select_pipe['no_of_brick'] != null) {
																												echo $row_select_pipe['no_of_brick'];
																											} else {
																												echo " <br>";
																											} ?> NO'S
							</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;">&nbsp;&nbsp; Dimensions & Tolerance</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;">&nbsp;&nbsp; Length (mm)</td>
							<td style="width:20%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid; text-align: center;"><?php echo $row_select_pipe['avg_length']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;text-align: center;">&nbsp;&nbsp; 4600 ± 80 mm</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;">&nbsp;&nbsp; Width (mm)</td>
							<td style="width:20%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;text-align: center;"><?php echo $row_select_pipe['avg_width']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;text-align: center;">&nbsp;&nbsp; 2200 ± 40 mm</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-right:1px solid;">&nbsp;&nbsp; Height (mm)</td>
							<td style="width:20%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-right:1px solid;text-align: center;"><?php echo $row_select_pipe['avg_height']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: center;">&nbsp;&nbsp; 1400 ± 40 mm</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family : Calibri;font-size: 12px;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;" rowspan="2" colspan="5">&nbsp;&nbsp; B. &nbsp;&nbsp; Compressive Strength</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;border-left:1px solid;" colspan="3">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;border-left:1px solid;" colspan="3">&nbsp;&nbsp; IS: 3495 (Part 1)-2019 </td>
						</tr>
						<tr style="">
							<th style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;text-align: center;" >&nbsp;&nbsp; Sr. No. </th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;">&nbsp;&nbsp; Sample I.D.</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Length in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Breadth in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Height  in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Area (mm<sup>2</sup>)</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Load in KN</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;">&nbsp;&nbsp; Compressive strength N/mm<sup>2</sup></th>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">CS1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_1'] != "" && $row_select_pipe['com_l_1'] != "0" && $row_select_pipe['com_l_1'] != null) {
																														echo $row_select_pipe['com_l_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_1'] != "" && $row_select_pipe['com_b_1'] != "0" && $row_select_pipe['com_b_1'] != null) {
																														echo $row_select_pipe['com_b_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_1'] != "" && $row_select_pipe['com_h_1'] != "0" && $row_select_pipe['com_h_1'] != null) {
																														echo $row_select_pipe['com_h_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_1'] != "" && $row_select_pipe['com_area_1'] != "0" && $row_select_pipe['com_area_1'] != null) {
																														echo $row_select_pipe['com_area_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_1'] != "" && $row_select_pipe['com_load_1'] != "0" && $row_select_pipe['com_load_1'] != null) {
																														echo $row_select_pipe['com_load_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">CS2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_2'] != "" && $row_select_pipe['com_l_2'] != "0" && $row_select_pipe['com_l_2'] != null) {
																														echo $row_select_pipe['com_l_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_2'] != "" && $row_select_pipe['com_b_2'] != "0" && $row_select_pipe['com_b_2'] != null) {
																														echo $row_select_pipe['com_b_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_2'] != "" && $row_select_pipe['com_h_2'] != "0" && $row_select_pipe['com_h_2'] != null) {
																														echo $row_select_pipe['com_h_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_2'] != "" && $row_select_pipe['com_area_2'] != "0" && $row_select_pipe['com_area_2'] != null) {
																														echo $row_select_pipe['com_area_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_2'] != "" && $row_select_pipe['com_load_2'] != "0" && $row_select_pipe['com_load_2'] != null) {
																														echo $row_select_pipe['com_load_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">CS3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_3'] != "" && $row_select_pipe['com_l_3'] != "0" && $row_select_pipe['com_l_3'] != null) {
																														echo $row_select_pipe['com_l_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_3'] != "" && $row_select_pipe['com_b_3'] != "0" && $row_select_pipe['com_b_3'] != null) {
																														echo $row_select_pipe['com_b_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_3'] != "" && $row_select_pipe['com_h_3'] != "0" && $row_select_pipe['com_h_3'] != null) {
																														echo $row_select_pipe['com_h_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">CS4</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_4'] != "" && $row_select_pipe['com_l_4'] != "0" && $row_select_pipe['com_l_4'] != null) {
																														echo $row_select_pipe['com_l_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_4'] != "" && $row_select_pipe['com_b_4'] != "0" && $row_select_pipe['com_b_4'] != null) {
																														echo $row_select_pipe['com_b_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_4'] != "" && $row_select_pipe['com_h_4'] != "0" && $row_select_pipe['com_h_4'] != null) {
																														echo $row_select_pipe['com_h_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_4'] != "" && $row_select_pipe['com_area_4'] != "0" && $row_select_pipe['com_area_4'] != null) {
																														echo $row_select_pipe['com_area_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_4'] != "" && $row_select_pipe['com_load_4'] != "0" && $row_select_pipe['com_load_4'] != null) {
																														echo $row_select_pipe['com_load_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																														echo $row_select_pipe['com_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">CS5</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_5'] != "" && $row_select_pipe[''] != "0" && $row_select_pipe['com_l_5'] != null) {
																														echo $row_select_pipe['com_l_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_5'] != "" && $row_select_pipe['com_b_5'] != "0" && $row_select_pipe['com_b_5'] != null) {
																														echo $row_select_pipe['com_b_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_5'] != "" && $row_select_pipe['com_h_5'] != "0" && $row_select_pipe['com_h_5'] != null) {
																														echo $row_select_pipe['com_h_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_5'] != "" && $row_select_pipe['com_area_5'] != "0" && $row_select_pipe['com_area_5'] != null) {
																														echo $row_select_pipe['com_area_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_5'] != "" && $row_select_pipe['com_load_5'] != "0" && $row_select_pipe['com_load_5'] != null) {
																														echo $row_select_pipe['com_load_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																														echo $row_select_pipe['com_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;" colspan="6"></td>
							<td style="border-top:1px solid;width:10%; text-align:right;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;">Average &nbsp;&nbsp;</td>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;"><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != "0" && $row_select_pipe['avg_com'] != null) {
																																				echo $row_select_pipe['avg_com'];
																																			} else {
																																				echo " <br>";
																																			} ?><span style=""></td>
						</tr>

					</table>

				</td>
			</tr>
		</table>
		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family : Calibri;font-size: 12px;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" rowspan="2" colspan="4">&nbsp;&nbsp; C. &nbsp;&nbsp; Water Absorption</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;border-left:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;border-left:1px solid;" colspan="2">&nbsp;&nbsp; IS : 3495-1992 PART -2 </td>
						</tr>
						<tr style="">
							<th style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;text-align: center;" >&nbsp;&nbsp; Sr. No. </th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;">&nbsp;&nbsp; Sample I.D.</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Oven Dry Weight in <br> (g) <br> W1</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; S. S. Dry <br> weight in  (g) <br> W2</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Difference <br> W2-W1 in (g)</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Water Absorption in percent <br> <span style="border-bottom:1px solid;">(𝑊2 − 𝑊1)</span> 𝑋100<br>𝑊1</th>
						</tr>
						
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">WA1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
																														echo $row_select_pipe['wtr_w1_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																														echo $row_select_pipe['wtr_w2_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																														echo (($row_select_pipe['wtr_w2_1']) - ($row_select_pipe['wtr_w1_1']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																														echo $row_select_pipe['wtr_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">WA2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
																														echo $row_select_pipe['wtr_w1_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo $row_select_pipe['wtr_w2_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo (($row_select_pipe['wtr_w2_2']) - ($row_select_pipe['wtr_w1_2']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																														echo $row_select_pipe['wtr_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">WA3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) {
																														echo $row_select_pipe['wtr_w1_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo $row_select_pipe['wtr_w2_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo (($row_select_pipe['wtr_w2_3']) - ($row_select_pipe['wtr_w1_3']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
																														echo $row_select_pipe['wtr_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">WA4</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_4'] != "" && $row_select_pipe['wtr_w1_4'] != "0" && $row_select_pipe['wtr_w1_4'] != null) {
																														echo $row_select_pipe['wtr_w1_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != "" && $row_select_pipe['wtr_w2_4'] != "0" && $row_select_pipe['wtr_w2_4'] != null) {
																														echo $row_select_pipe['wtr_w2_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != "" && $row_select_pipe['wtr_w2_4'] != "0" && $row_select_pipe['wtr_w2_4'] != null) {
																														echo (($row_select_pipe['wtr_w2_4']) - ($row_select_pipe['wtr_w1_4']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {
																														echo $row_select_pipe['wtr_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;">WA5</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_5'] != "" && $row_select_pipe['wtr_w1_5'] != "0" && $row_select_pipe['wtr_w1_5'] != null) {
																														echo $row_select_pipe['wtr_w1_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != "" && $row_select_pipe['wtr_w2_5'] != "0" && $row_select_pipe['wtr_w2_5'] != null) {
																														echo $row_select_pipe['wtr_w2_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != "" && $row_select_pipe['wtr_w2_5'] != "0" && $row_select_pipe['wtr_w2_5'] != null) {
																														echo (($row_select_pipe['wtr_w2_5']) - ($row_select_pipe['wtr_w1_5']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != "0" && $row_select_pipe['wtr_5'] != null) {
																														echo $row_select_pipe['wtr_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

						<tr>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;" colspan="4"></td>
							<td style="border-top:1px solid;width:10%; text-align:right;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;">Average &nbsp;&nbsp;</td>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;"><span style=""><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																																																				echo $row_select_pipe['avg_wtr'];
																																																			} else {
																																																				echo " <br>";
																																																			} ?></td>
						</tr>

					</table>

				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br><br>
		<br><br>
		<br><br>


		
		<?php if ($branch_name == "Nadiad") {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php } else {?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name;?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php }?>	

		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family : Calibri;font-size: 12px;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" rowspan="2" colspan="4">&nbsp;&nbsp; D. &nbsp;&nbsp;Efflorescence Visual observation After two cycle</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; IS: 3495 (Part 3)-2019 </td>
						</tr>
						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">MEASURE</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; " colspan=5>Mark in appropriate (√)</td>
						</tr>
						
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SAMPLE ID</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">NIL</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SLIGHT</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">MODERATE</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">HEAVY</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SERIOUS</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>


		<br>

		<table align="center" width="94%" class="test1" style="margin-bottom: 20px;" Height="20%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
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
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 2 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table> ->
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">
			
			
		</div>
		</page>-->
		
	</body>
</html> 
		
	
<script type="text/javascript">

</script>