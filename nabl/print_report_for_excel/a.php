<?php
session_start();
include("../connection.php");?>
<style>
@page { margin: 0; }
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
	 font-family: arial;
}
.test {
   border-collapse: collapse;
 font-size:10px;
	 font-family: arial;
}
	.tdclass1{

    font-size:11px;
	 font-family: arial;
}
</style>
<html>
	<body>
				<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);

			 $select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
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
			$sent_by= $row_select['report_sent_to'];
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");

			$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
			$result_select1 = mysqli_query($conn, $select_query1);

			if (mysqli_num_rows($result_select1) > 0) {
				$row_select1 = mysqli_fetch_assoc($result_select1);
				$agency_name= $row_select1['agency_name'];
			}

			$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
			$result_select2 = mysqli_query($conn, $select_query2);

			if (mysqli_num_rows($result_select2) > 0) {
				$row_select2 = mysqli_fetch_assoc($result_select2);
				$start_date= $row_select2['start_date'];
				$end_date= $row_select2['end_date'];
				$issue_date= $row_select2['issue_date'];


				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$mt_name= $row_select3['mt_name'];
				}

			}


			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$bitumin_grade= $row_select4['bitumin_grade'];
					$lot_no= $row_select4['lot_no'];
					$bitumin_make= $row_select4['bitumin_make'];
					$tank_no= $row_select4['tank_no'];

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



		<page size="A4">
		<table align="center" width="95%" style="height:auto;font-size:11px;font-family: arial;border:solid black;border-width:2;">
		<tr >


					<td style="font-size:13px;border:1px solid black;"><center><b>Test Report of Bitumen</b></center></td>

		</tr>
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Report No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $report_no;?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Report Date</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php

					$date = str_replace('/', '-', $end_date);
					echo date('d-m-Y', strtotime($date));?></td>
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Job No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $job_no;?></td>
					<td style="width:25%"></td>
					<td style="width:3%"></td>
					<td style="width:22%"></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Customer</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= $row_selectc['city_name'];
															}
															echo $clientname." ".$row_select['clientaddress']." ".$ct_nm;?>
					</td>

				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Agency</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%"> &nbsp;&nbsp;<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1= $row_selectc1['city_name'];
															}
															echo $agency_name." ".$ct_nm1;?>
					</td>
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Work</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php echo $name_of_work;?>
					</td>
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Ref. No & Date</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php echo $r_name;?>
					</td>
				</tr>


			</table>
			</td>
		</tr>



		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Type of Sample</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;Bitumen (<?php echo $bitumin_grade;?>)</td>
					<td style="width:25%">&nbsp;&nbsp;<b>Test Method Standard</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;IS :1202 to 1220</td>

				</tr>

				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Sample Received</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Environmental Condition</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;As per test procedure</td>
				</tr>

				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Condition Of Sample On Receipt</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;Satisfactory</td>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($start_date));?></td>
				</tr>

				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Sample Send by</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php  if($row_select['sample_sent_by']=="0"){echo "Customer";}else{echo "Agency";}?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($end_date));?></td>
				</tr>



			</table>
			</td>
		</tr>


		<tr>
			<td style="font-size:13px;border:1px solid black;"><center><b>Test Result</b></center></td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%" class="test" border="1px" style="height:auto;">

	<tr>
		<td rowspan="4"><center>IS <br>Sieve<br> Size</center></td>
		<td rowspan="4"><center>Individual <br> Weight <br> Retained <br> gm.</center></td>
		<td rowspan="4"><center>Cumulative<br>Weight<br>Retained<br>gm.</center></td>
		<td rowspan="4"><center>Cumulative<br>Percentage<br>Retained<br>%</center></td>
		<td rowspan="4"><center>Cumulative<br>Percentage<br>Passing<br>%</center></td>
		<td rowspan="4"><center>% Passing as per IS<br> IS : 383</center></td>
		<td rowspan="4" colspan="2"><center>Type<br> of <br>Test<br> - - </center></td>
		<td rowspan="4"><center>Test<br>Method  </center></td>
		<td rowspan="4"><center>Results<br>Obtained </center></td>
		<td rowspan="4"><center>Specification<br>As per<br>IS : 383 </center></td>
		<td rowspan="4"><center>Remarks</td>
	</tr>
				<tr>
		<td><center>80.00 mm</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_1'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_1'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_1'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_1'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>100</center></td>
		<td colspan="2"><center>Specific Gravity</center></td>
		<td><center>IS:2386 (P:3), RA 2016</center></td>
		<td><center><?php
		if($row_select_pipe['chk_sp'] == 1){
		echo $row_select_pipe['sp_specific_gravity'];}
		else
		{
			echo "-";
		}?></center></td>
		<td><center> - </center></td>
		<td rowspan="16"></td>

	</tr>
	<tr>
		<td><center>63.00 mm</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_2'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_2'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_2'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_2'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>85-100</center></td>
		<td colspan="2"><center>Water Absorption, %</center></td>
		<td><center>IS:2386 (P:3), RA 2011</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_sp'] == 1){
		echo $row_select_pipe['sp_water_abr'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 2 % </center></td>

	</tr>
	<tr>
		<td><center>40.00 mm</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_3'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_3'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_3'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_3'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>0-30</center></td>
		<td colspan="2"><center>Flakiness Index, %</center></td>
		<td><center>IS:2386 (P:1), RA 2011</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_flk'] == 1){
		echo $row_select_pipe['fi_index'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td rowspan="2"><center> F + E Not More Than 30 %</center></td>

	</tr>
	<tr>
		<td><center>20.00 mm</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_4'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_4'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_4'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_4'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>0-5</center></td>
		<td colspan="2"><center>Elongation Index, %</center></td>
		<td><center>IS:2386 (P:1), RA 2011</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_flk'] == 1){
		echo $row_select_pipe['ei_index'];}
		else
		{
			echo "-";
		}?>
		</center></td>


	</tr>


	<tr>
		<td><center>10.00 mm</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_5'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_5'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_5'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_5'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>0-5</center></td>
		<td colspan="2"><center>Crushing Value, %</center></td>
		<td><center>IS:2386 (P:4), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_crushing'] == 1){
		echo $row_select_pipe['cru_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 30%</center></td>

	</tr>
	<tr>
		<td><center>pan</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_wt_gm_6'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['ret_wt_gm_6'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['cum_ret_6'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['pass_sample_6'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center>-</center></td>
		<td colspan="2"><center>Abrasion Value, %</center></td>
		<td><center>IS:2386 (P:4), RA 2011</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_abr'] == 1){
		echo $row_select_pipe['abr_index'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 30% </center></td>

	</tr>


	<tr>
		<td><center>Total</center></td>
		<td><center><?php if($row_select_pipe['chk_grd'] == 1){ echo $row_select_pipe['blank_extra'];
		}
		else
		{
			echo "-";
		}
		?></center></td>
		<td><center></center></td>
		<td><center></center></td>
		<td><center></center></td>
		<td><center></center></td>
		<td colspan="2"><center>Alkali Reaction</center></td>
		<td><center>-</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_alkali'] == 1){
		echo $row_select_pipe['alkali_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> - </center></td>

	</tr>

	<tr>
		<td colspan="6" rowspan="9"><center>--</center></td>

		<td colspan="2"><center>Soundness by Na<sub>2</sub>SO<sub>4</sub>, %</center></td>
		<td><center>IS:2386 (P:5), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_sou'] == 1){
		echo $row_select_pipe['soundness'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 12% </center></td>

	</tr>
	<tr>

		<td colspan="2"><center>Impact Value, %</center></td>
		<td><center>IS:2386 (P:4), RA 2011</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_impact'] == 1){
		echo $row_select_pipe['imp_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 30% </center></td>

	</tr>
	<tr>

		<td colspan="2"><center>C.B.R. Value</center></td>
		<td><center>IS:2720 (P:16), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_cbr'] == 1){
		echo $row_select_pipe['cbr'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Min.30</center></td>
	</tr>
	<tr>

		<td colspan="2"><center>Bulk Density (Loose)</center></td>
		<td><center>IS:2386 (P:3), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_den'] == 1){
		echo $row_select_pipe['bdl'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center>-</center></td>
	</tr>
	<tr>

		<td colspan="2"><center>Bulk Density (Compact)</center></td>
		<td><center>IS:2386 (P:3), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_den'] == 1){
		echo $row_select_pipe['bdc'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center>-</center></td>
	</tr>


	<tr>


		<td colspan="2"><center>Stripping Value</center></td>
		<td><center>IS:6241 </center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_strip'] == 1){
		echo $row_select_pipe['stripping_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center>MIN 95%</center></td>

	</tr>
	<tr>

		<td colspan="2"><center>10% Fines value(tonne)</center></td>
		<td><center>IS:2386 (P:4), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_fines'] == 1){
		echo $row_select_pipe['fines_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Max 30%</center></td>

	</tr>
	<tr>

		<td colspan="2"><center>Liquid Limit,%</center></td>
		<td><center>IS:2720 (P:5), RA 2016</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_ll'] == 1){
		echo $row_select_pipe['liquide_limit'];
		}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center>Not Mor Than 25%</center></td>

	</tr>


	<tr>

		<td colspan="2"><center>plasticity index ,%</center></td>
		<td><center>IS:2720 (P:5)</center></td>
		<td><center>
		<?php
		if($row_select_pipe['chk_ll'] == 1){
		echo $row_select_pipe['pi_value'];}
		else
		{
			echo "-";
		}?>
		</center></td>
		<td><center> Not Mor Than 25%</center></td>

	</tr>


			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%" class="test" border="1px" style="height:auto;">
			<tr>
					<td style="font-size:13px;">for <b>Span Material Testing & Consultancy Services Limited<br><br><br><br><br><br><br><br><br>Authorised Signatory</b> <span style="padding-right:3px;float:right;">Page :- 1 of 1</span></td>

			</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%"  border="1px" class="test">
				<tr>

			<td style="transform: rotate(270deg);"><center><B>NOTES</B></center></td>
			<td style="padding:5px;"> *   The test result relates to the samples submitted by Customer/Agency.<br>*   The Results / Reports are issued with specific understanding that Span Material Testing & Consultancy Services Limited will not in way be involved in acting following interpretation of the test results.<br> *   The Results / Reports are not supposed to be used for publicity.</td>
				</tr>
			</table>
			</td>
		</tr>

		</table>



		</page>

	</body>
</html>


<script type="text/javascript">
window.onload = function(){
	setTimeout(function()
		{

			window.print();
		},
		1000);

}
</script>
