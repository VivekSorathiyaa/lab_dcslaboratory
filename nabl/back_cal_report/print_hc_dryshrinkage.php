<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin:15px 40px 0; }
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
</style>
<html>
	<body>
						<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$branch_name = $row_select['branch_name'];
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
				$cast_date = $row_select2['cast_date'];
				$cast_time = $row_select2['cast_time'];
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
					$paver_shape= $row_select4['paver_shape'];
					$paver_age= $row_select4['paver_age'];
					$paver_color= $row_select4['paver_color'];
					$paver_thickness= $row_select4['paver_thickness'];
					$paver_grade= $row_select4['paver_grade'];
					$paver_size = $row_select4['dry_size'];

				}
				
				$pagecnt=1;
				$totalcnt=1;
				if($row_select_pipe['avgv']!="" && $row_select_pipe['avgv']!="0" && $row_select_pipe['avgv']!=null)
					{
						$totalcnt++;
					}
		?>
		
		<br><br><br>
		<page size="A4" >
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"><?php echo $mt_name; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS</td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $mt_name; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
			</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
		</table>

			<table align="center" width="100%" class="test1">
					<tr style="border: 1px solid black;border-top: 0;">
						<td style="text-align:center;padding:3px 0px;"><b>1</b></td>
						<td style="border-left:1px solid;text-align:left;padding:3px 0px;"><b>&nbsp; Grade of Concrete</b></td>
						<td style="border-left:1px solid;text-align:left;padding:3px 0px;">&nbsp;<?php echo $row_select_pipe['top_grade'];?></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="text-align:center;padding:5px 0px;"><b>2</b></td>
						<td style="border-left:1px solid;text-align:left;padding:3px 0px;"><b>&nbsp; Size of sample</b></td>
						<td style="border-left:1px solid;text-align:left;padding:3px 0px;">&nbsp; <?php echo $row_select_pipe['cc_identification_mark'];?></td>
					</tr>
			</table>
			<br>
				
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			<tr>
				<td>
				<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;">
					<tr>
						<td style="padding: 6px;font-size: 13px;"><b>1. Drying Shrinkage of Concrete (IS : 516 Part-6 : 2020)</b></td>
						<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
					</tr>
					<tr>
						
					</tr>
				</table>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="200px">
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>Sr. No.</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Length of Specimen (L) </b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Length of Specimen after Curing (L<sub>1</sub>) </b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Length of Specimen after Drying (L<sub>2</sub>) </b></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Drying Shrinkage = <br><u>L<sub>1</sub>-L<sub>2</u></sub> X100<br>L	</center></td>		
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>1</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_len_1']!="" && $row_select_pipe['dry_len_1']!="0" && $row_select_pipe['dry_len_1']!=null){echo $row_select_pipe['dry_len_1']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r1_1']!="" && $row_select_pipe['dry_r1_1']!="0" && $row_select_pipe['dry_r1_1']!=null){echo $row_select_pipe['dry_r1_1']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r6_1']!="" && $row_select_pipe['dry_r6_1']!="0" && $row_select_pipe['dry_r6_1']!=null){echo $row_select_pipe['dry_r6_1']; }else{echo " <br>";}  ?></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><?php if($row_select_pipe['dry_shr_1']!="" && $row_select_pipe['dry_shr_1']!="0" && $row_select_pipe['dry_shr_1']!=null){echo $row_select_pipe['dry_shr_1']; }else{echo " <br>";}  ?></b></center></td>		
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>2</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_len_2']!="" && $row_select_pipe['dry_len_2']!="0" && $row_select_pipe['dry_len_2']!=null){echo $row_select_pipe['dry_len_2']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r1_2']!="" && $row_select_pipe['dry_r1_2']!="0" && $row_select_pipe['dry_r1_2']!=null){echo $row_select_pipe['dry_r1_2']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r6_2']!="" && $row_select_pipe['dry_r6_2']!="0" && $row_select_pipe['dry_r6_2']!=null){echo $row_select_pipe['dry_r6_2']; }else{echo " <br>";}  ?></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><?php if($row_select_pipe['dry_shr_2']!="" && $row_select_pipe['dry_shr_2']!="0" && $row_select_pipe['dry_shr_2']!=null){echo $row_select_pipe['dry_shr_2']; }else{echo " <br>";}  ?></b></center></td>		
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>3</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_len_3']!="" && $row_select_pipe['dry_len_3']!="0" && $row_select_pipe['dry_len_3']!=null){echo $row_select_pipe['dry_len_3']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r1_3']!="" && $row_select_pipe['dry_r1_3']!="0" && $row_select_pipe['dry_r1_3']!=null){echo $row_select_pipe['dry_r1_3']; }else{echo " <br>";}  ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if($row_select_pipe['dry_r6_3']!="" && $row_select_pipe['dry_r6_3']!="0" && $row_select_pipe['dry_r6_3']!=null){echo $row_select_pipe['dry_r6_3']; }else{echo " <br>";}  ?></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><?php if($row_select_pipe['dry_shr_3']!="" && $row_select_pipe['dry_shr_3']!="0" && $row_select_pipe['dry_shr_3']!=null){echo $row_select_pipe['dry_shr_3']; }else{echo " <br>";}  ?></b></center></td>		
					</tr>
					<tr>
						<td colspan=4 style="border: 1px solid black;width:5%;padding: 2px 3px;text-align:right;"><b>Average</td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><?php echo $row_select_pipe['avg_dry_shr'];?></b></center></td>		
					</tr>
				</table>
				</td>
			</tr>																					
		</table>

					<br>
		<!-- footer design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="padding: 1px;border-left: 1px solid;border-right :1px solid;"  colspan="4"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  01</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
			</tr>
			
		</table>



		</page>
		
	</body>
</html> 
		
	
<!-- <script type="text/javascript">
window.print();
</script> -->