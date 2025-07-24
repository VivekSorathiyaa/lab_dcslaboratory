<?php

session_start();
include("connection.php");
error_reporting(1);

if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'add') {

		$iscorh = $_POST['iscorh'];
		$name_receiver = $_POST['name_receiver'];
		$mobileno = $_POST['mobileno'];
		$city = $_POST['city'];
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$paytype = $_POST['paytype'];
		$chequeno = $_POST['chequeno'];
		$delivered_by = $_POST['delivered_by'];
		$c_charge = $_POST['c_charge'];
		$bill = $_POST['bill'];
		$rbt = $_POST['rbt'];

		$end_day = substr($_POST['ch_date'], 0, 2);
		$end_month = substr($_POST['ch_date'], 3, 2);
		$end_year = substr($_POST['ch_date'], 6, 4);
		$ch_date = $end_year . "-" . $end_month . "-" . $end_day;

		$curr = date('Y-m-d');

		$job_update = "update estimate_total_span_only_bill SET `iscorh`='$iscorh',`name_receiver`='$name_receiver',`mobileno`='$mobileno',`city`='$city',`paytype`='$paytype',`ch_date`='$ch_date',`chequeno`='$chequeno',`delivered_by`='$delivered_by',`rbt`='$rbt',`bill`='$bill',`est_modifydate`='$curr',`c_charge`='$c_charge' WHERE `report_no`='$report_no' AND `job_no`='$job_no'";
		$result_of_update_only_job = mysqli_query($conn, $job_update);

		if ($bill == 1 && $rbt == 1) {
			$set_light = 5;
		} else {
			$set_light = 4;
		}

		$job_update = "update job SET `admin_special_light`=$set_light WHERE `report_no`='$report_no'";
		$result_of_total_update = mysqli_query($conn, $job_update);

		$fill = array($result_of_update_only_job);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'sendbill') {


		$report_no1 = $_POST['report_no'];
		$job_update1 = "update estimate_total_span SET `is_delivered`='1' WHERE `report_no`='$report_no1'";
		$result_of_update_only_job1 = mysqli_query($conn, $job_update1);
		$fill = array($result_of_update_only_job1);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'get_jobing_for_first_reception') {
?>
		<table class="table no-margin" id="example1" width="100%">
			<thead>
				<tr>
					<th>Report No </th>
					<th>Job No </th>
					<th>Estimaste No </th>
					<th>Agency Name</th>
					<th>Bill Amount</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sel_estimate = "select * from estimate_total_span where `est_isdeleted`=0 AND `is_billing`=1 AND `is_delivered` =0";
				$query_estimate = mysqli_query($conn, $sel_estimate);

				if (mysqli_num_rows($query_estimate) > 0) {
					while ($get_estimate = mysqli_fetch_array($query_estimate)) {

				?>
						<tr>
							<td><?php echo $get_estimate["report_no"]; ?></td>
							<td><?php echo $get_estimate["job_no"]; ?></td>
							<td><?php echo $get_estimate["estimate_no"]; ?></td>
							<td><?php
								$age_id = $get_estimate["agency_id"];
								$sel_agency = "select * from agency_master where `agency_id`=" . $age_id;
								$query_agency = mysqli_query($conn, $sel_agency);
								$result_agency = mysqli_fetch_array($query_agency);

								echo $result_agency["agency_name"];
								?>
							</td>
							<td><?php echo $get_estimate["total_amt"]; ?></td>

							<td>

								<?php
								$sel_jobs = "select * from job where `report_no`='$get_estimate[report_no]'";
								$result_jobs = mysqli_query($conn, $sel_jobs);
								$get_jobs = mysqli_fetch_array($result_jobs);

								if ($get_jobs["jobcreatedby_id"] == $_SESSION['u_id']) {
								?>

									<a href="span_bill_print.php?report_no=<?php echo $get_estimate['report_no']; ?>&&job_no=<?php echo $get_estimate['job_no']; ?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print</a>

									<?php if ($get_estimate['iscorh'] == NULL) { ?>

										<a href="dilevery_detail.php?report_no=<?php echo $get_estimate['report_no']; ?>&&job_no=<?php echo $get_estimate['job_no']; ?>" class="btn btn-success btn-lg btn3d" data-id="<?php echo $get_estimate['report_no']; ?>" title="Fill Receiver Details"><span class="glyphicon glyphicon-question-ok"></span> Fill Receiver Details </a>
									<?php
									} else { ?>
										<a href="dilevery_detail.php?report_no=<?php echo $get_estimate['report_no']; ?>&&job_no=<?php echo $get_estimate['job_no']; ?>" class="btn btn-info btn-lg btn3d" data-id="<?php echo $get_estimate['report_no']; ?>" title="Fill Receiver Details"><span class="glyphicon glyphicon-question-ok"></span> Edit Delivery Data </a>
										<?php if ($get_estimate["rbt"] == 1 && $get_estimate["bill"] == 1) { ?>
											<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d send_to_second" data-id="<?php echo $get_estimate['report_no']; ?>" title="Fill Receiver Details"><span class="glyphicon glyphicon-question-ok"></span>Submit</a>


									<?php
										}
									}
									?>
								<?php
								} else {
									echo "****";
								}
								?>
							</td>
						</tr>
				<?php
					}
				}

				?>

			</tbody>
		</table>

<?php
	}



	exit;
}
?>
