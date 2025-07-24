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
    font-size:10px;
	 font-family: Cambria;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family: Cambria;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family: Cambria;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Cambria;
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
				$cast_date = $row_select_pipe['cast_date'];
				$cast_time = $row_select_pipe['cast_time'];
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$detail_sample= $row_select3['mt_name'];
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
		
		
		<page size="A4" >
			<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-041</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION & CALCULATION SHEET FOR DRYING SHRINKAGE OF CONCRETE</b></center>
					</td>
				</tr>
			</table>
			<br>
			
			<table align="center" width="100%" class="test1" height="9%">
					<tr style="border: 1px solid black;">
						<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:3px 0px;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="text-align:center;width:5%;padding:5px 0px;"><b>1</b></td>
						<td style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Sample ID No.</b></td>
						<td style="border-left:1px solid;width:70%;text-align:left;padding:5px 0px;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="text-align:center;padding:5px 0px;"><b>2</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Job No.</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp;<?php echo $job_no; ?></td>
					</tr>
					
					<tr style="border: 1px solid black;">
						<td style="text-align:center;padding:5px 0px;"><b>4</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Grade of Concrete</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp;<?php echo $row_select_pipe['top_grade'];?></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="text-align:center;padding:5px 0px;"><b>5</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of receipt of sample</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
					</tr>
					<tr style="border: 1px solid black;">
						<td style="text-align:center;padding:5px 0px;"><b>6</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Size of sample</b></td>
						<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $row_select_pipe['cc_identification_mark'];?></td>
					</tr>
			</table>
			<br>
				
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria; margin-bottom: 10px;">
			<tr>
				<td>
				<table width="100%" class="test1" style="border: 0;font-family: Cambria;margin-top: 12px;margin-bottom: 0;" height="50px">
					<tr>
						<td style="padding: 6px;font-size: 13px;"><b>1. Drying Shrinkage of Concrete (IS : 516 Part-6 : 2020)</b></td>
						<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($end_date)); ?></b></td>
					</tr>
					<tr>
						
					</tr>
				</table>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="200px">
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
		<table align="center" width="100%" class="test1" style="" Height="20%">
			<tr style="font-size:15px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>


			<br>
			<table align="center" width="100%" class="test1" height="Auto" style="border-top:1px solid #ccc;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 00</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 01</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr>
				<td style="padding-top: 0px; text-align: center;">Page 1 of 1</td>
				</tr>
			</table>
			<!-- <table align="center" width="83%" style="" Height="5%">
				<tr style="font-size:15px;" >
					<td style="text-align:center;"><b>Page 1 of 1</b></td>
				</tr>		
			</table> -->
		</page>
		
	</body>
</html> 
		
	
<!-- <script type="text/javascript">
window.print();
</script> -->