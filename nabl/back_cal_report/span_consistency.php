			<?php
			session_start();
			include("../connection.php");
			error_reporting(1); ?>
			<style>
				@page {
					size: 4in 6in;
					margin: auto;
					margin-left: 40px;
					margin-right: 0px;
					margin-top: 0px;
					margin-bottom: 5px;
					padding-top: 10px;
				}

				.pagebreak {
					page-break-before: always;
				}

				@media print {
					@page {
						size: landscape
					}
				}
			</style>
			<style>
				.tdclass {
					border: 1px solid black;
					font-size: 11px;
					font-family : Calibri;
				}

				.test {
					border-collapse: collapse;
					font-size: 11px;
					font-family : Calibri;
				}

				.tdclass1 {

					font-size: 11px;
					font-family : Calibri;
				}
			</style>
			<html>

			<body>
				<?php
				/*$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
		 $select_tiles_query = "select * from bc_19_0_075_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
					$detail_sample= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source= $row_select4['agg_source'];
				}
				*/
				?>

				<br>
				<br>
				<br>
				<br>
				<br>


				<page size="A4" layout="landscape">
					<table align="center" width="90%" class="test" border="1px">
						<tr>
							<td colspan="12" style="font-size:13px">
								<center><b>Span Infrastructure Material Testing &amp; Consultancy Services-Palanpur</b></center>
							</td>
						</tr>
						<tr>
							<td colspan="8"><b>Work sheet for Consistency Test, Soundness by Lechatelier ,Setting Time, Density, Fineness By Blain air permeability and Compressive Strength of For Cement</b></td>
							<td colspan="4"><b>F/Material/10, Issue No. 01, Page No. 1 of 4</b></td>
						</tr>
					</table>
					<br>
					<table align="center" width="90%" class="test" border="1px">
						<tr>
							<td colspan="6">Type of Cement :</td>
							<td colspan="6">Manu, Week and Month :</td>
						</tr>
						<tr>
							<td colspan="6">Grade of Cement :</td>
							<td colspan="6">Sample Receive Date :</td>
						</tr>
						<tr>
							<td colspan="6">Identification Mark :</td>
							<td colspan="6">Laboratory ID No. :</td>
						</tr>
					</table>
					<br>
					<br>
					<table align="center" width="90%" class="test">
						<tr>
							<td colspan="6"><b>CONSISTENCY TEST (IS:4031 - Part IV)</b></td>
							<td colspan="6">Date of test :</td>
						</tr>
						<tr>
							<td colspan="6"></td>
							<td colspan="6">Temp :...........Humidity(%):</td>
						</tr>
						<tr>
							<td colspan="12"><b>Weight of Cement :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(400gm)</b></td>

						</tr>
					</table>
					<table align="center" width="90%" class="test" border="1px">
						<tr>
							<td width="10%">
								<center><b>Sr.No.</b></center>
							</td>
							<td width="20%">
								<center><b>Vol. of water<br>(CC)</b></center>
							</td>
							<td width="20%">
								<center><b>% of water</b>
									<center>
							</td>
							<td width="20%">
								<center><b>Reading on Vicat <br>(MM)</b>
									<center>
							</td>
							<td width="20%">
								<center><b>Remakes</b>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>1</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>2</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>3</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>4</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>5</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>6</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td width="10%">
								<center>7</center>
							</td>
							<td width="20%">
								<center></center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
							<td width="20%">
								<center>
									<center>
							</td>
						</tr>
						<tr>
							<td colspan="5">Final Consistency(%) :</td>
						</tr>
					</table>
					<br>
					<table align="center" width="90%" class="test" border="1px" height="5%">
						<tr>
							<td colspan="6">Tested by :</td>
							<td colspan="6">Checked by :</td>
						</tr>
					</table>

				</page>
				<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: gSTCn;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

			</body>

			</html>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>