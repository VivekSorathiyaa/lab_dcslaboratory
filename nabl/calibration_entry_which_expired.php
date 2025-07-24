<?php include("header.php");
error_reporting(1); ?>
<?php
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}
?>

<style>
	#billing label {
		display: block;
		text-align: center;
		line-height: 150%;
		font-size: .85em;
	}

	/* only for 3d button effects */

	.btn3d {
		transition: all .08s linear;
		position: relative;
		outline: medium none;
		-moz-outline-style: none;
		border: 0px;
		margin-right: 10px;
		margin-top: 15px;
	}

	.btn3d:focus {
		outline: medium none;
		-moz-outline-style: none;
	}

	.btn3d:active {
		top: 9px;
	}

	.btn-primary {
		box-shadow: 0 0 0 1px #428bca inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #428bca;
	}

	.btn-success {
		box-shadow: 0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #5cb85c;
	}

	.btn-info {
		box-shadow: 0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #5bc0de;
	}

	.form-control {
		font-size: 20px;
		;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px !important;">


	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
		<?php include("menu.php") ?>
		<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">

					<!-- /.box-header -->

					<div class="box-body">
						<form class="form" id="billing" method="post">
							<div class="box-body">
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">CALIBRATION DATE :</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="calibration_date" name="calibration_date" value="<?php echo date("d/m/Y"); ?>" tabindex="1">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">DUE DATE :</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="due_date" name="due_date" value="<?php echo date("d/m/Y"); ?>" tabindex="1">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">REQUEST DATE :</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="request_date" name="request_date" value="<?php echo date("d/m/Y"); ?>" tabindex="1" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">CERTIFICATE NO.:</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="cer_no" name="cer_no" PLACEHOLDER=" Certificate no here..." tabindex="1">
											</div>
										</div>
									</div>
									<br><br><br>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">INSTUMENT NAME:</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="name_of_instu" name="name_of_instu" PLACEHOLDER=" Instument name here..." tabindex="2">
											</div>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">INSTUMENT SR. NO :</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="sr_no" name="sr_no" PLACEHOLDER=" Instument sr. no here..." tabindex="2">
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">INSTUMENT ID NO. :</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="instu_id_no" name="instu_id_no" PLACEHOLDER=" Instument id no here..." tabindex="2">
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">INSTUMENT MAKE:</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="instu_make" name="instu_make" PLACEHOLDER="Instument make here..." tabindex="1">
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">INSTUMENT MODEL :</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="make_model" name="make_model" PLACEHOLDER="Instument model here..." tabindex="2">
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">LOCATION :</label>

											<div class="col-sm-9">
												<input type="text" class="form-control pull-right" id="location" name="location" PLACEHOLDER=" Location  here..." tabindex="2">
											</div>
										</div>
									</div>


									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">CALIBRATED BY :</label>
											<div class="col-sm-9">

												<input type="text" class="form-control pull-right" id="cal_by" name="cal_by" PLACEHOLDER="Calibrated by  here..." tabindex="2">
											</div>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">REMARKS :</label>
											<div class="col-sm-9">
												<textarea name="remarks" id="remarks" class="col-sm-12 form-control" required></textarea>
											</div>
										</div>
									</div>


									<input type="hidden" class="form-control" name="idEdit" id="idEdit" />
								</div>
								<br>
								<div class="row">
									<div class="col-lg-4">

										<div class="form-group">

											<div class="col-sm-12">
												<!--<button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14" >SAVE</button>-->

											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">UPDATE</button>

									</div>
								</div>

							</div>


						</form>
						<hr style="border-top: 1px solid;">
						<br>
						<div class="row">
							<h1 style="text-align:center;color:red;">
								EXPIRED CALIBRATION
							</h1>
						</div>
						<div id="display_data">

							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center;" width="10%"><label>Actions</label></th>
										<th style="text-align:center;"><label>CALIBRATION DATE</label></th>
										<th style="text-align:center;"><label>DUE DATE</label></th>
										<th style="text-align:center;color:red;"><label>REQUEST DATE</label></th>
										<th style="text-align:center;"><label>CERTIFICATE NO.</label></th>
										<th style="text-align:center;"><label>INSTUMENT NAME</label></th>
										<th style="text-align:center;"><label>INSTUMENT SR NO</label></th>
										<th style="text-align:center;"><label>INSTUMENT ID NO </label></th>
										<th style="text-align:center;"><label>INSTUMENT MAKE </label></th>
										<th style="text-align:center;"><label>INSTUMENT MODEL </label></th>
										<th style="text-align:center;"><label>LOCATION </label></th>
										<th style="text-align:center;"><label>CALIBRATED BY </label></th>
										<th style="text-align:center;"><label>REMARKS </label></th>

									</tr>
								</thead>
								<tbody>
									<?php
									$todays = date("Y/m/d");
									$query = "select * from calibration_data WHERE `due_date`<='$todays' and isdeleted = '0'";

									$result = mysqli_query($conn, $query);

									if (mysqli_num_rows($result) > 0) {
										while ($r = mysqli_fetch_array($result)) {
									?>

											<tr>
												<td style="text-align:center;" width="10%">

													<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
													<?php

													//$val =  $_SESSION['isadmin'];
													//if($val == 0 || $val == 5){
													?>
													<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
													<?php
													//}
													?>
												</td>
												<td style="text-align:center;"><?php echo date('d-m-Y', strtotime($r['calibration_date'])); ?></td>
												<td style="text-align:center;"><?php echo date('d-m-Y', strtotime($r['due_date'])); ?></td>
												<td style="text-align:center;color:red;font-size:15px;"><?php echo date('d-m-Y', strtotime($r['due_date'])); ?></td>
												<td style="text-align:center;"><?php echo $r['cer_no']; ?></td>
												<td style="text-align:center;"><?php echo $r['name_of_instu']; ?></td>
												<td style="text-align:center;"><?php echo $r['sr_no']; ?></td>
												<td style="text-align:center;"><?php echo $r['instu_id_no']; ?></td>
												<td style="text-align:center;"><?php echo $r['instu_make']; ?></td>
												<td style="text-align:center;"><?php echo $r['location']; ?></td>
												<td style="text-align:center;"><?php echo $r['make_model']; ?></td>
												<td style="text-align:center;"><?php echo $r['cal_by']; ?></td>
												<td style="text-align:center;"><?php echo $r['remarks']; ?></td>
											</tr>

									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>


			</div>
		</div>
</div>
</div>

<!-- /.row -->
</section>
</div>

<?php include("footer.php"); ?>

<script>
	$(document).ready(function() {
		$('#btn_edit_data').hide();
		$('#billing').hide();
		var table = $('#example1').DataTable({
			//'autoWidth': true,
			'scrollX': true,
			buttons: ['copy'],
			dom: 'Bfrtip',
			buttons: [

				{
					extend: 'excel',
					footer: true,
				}
			],

		});


		var due_dating = new Date();

		var new_date = moment(due_dating, "DD/MM/YYYY");
		new_date.add(-10, 'days'); //minus 10 days to due_dating

		var aa = new_date.format("DD/MM/YYYY");
		$('#request_date').val(aa);


	});

	$('#calibration_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})
	$('#due_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})
	$('#request_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})


	$(function() {
		$('.select2').select2()
	})


	$("#btn_edit_data").click(function() {
		$('#btn_edit_data').hide();
		$('#billing').hide();

	});

	function getGlazedTiles() {

		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_calibratoin.php',
			data: 'action_type=view&' + $("#Glazed").serialize(),
			success: function(html) {
				$('#display_data').html(html);

			}
		});
	}

	function saveMetal(type, id) {

		id = (typeof id == "undefined") ? '' : id;
		var statusArr = {
			add: "added",
			edit: "updated",
			delete: "deleted"
		};
		var billData = '';

		if (type == 'edit') {

			var cer_no = $('#cer_no').val();
			var name_of_instu = $('#name_of_instu').val();
			var sr_no = $('#sr_no').val();
			var instu_id_no = $('#instu_id_no').val();
			var instu_make = $('#instu_make').val();
			var location = $('#location').val();
			var make_model = $('#make_model').val();
			var cal_by = $('#cal_by').val();
			var calibration_date = $('#calibration_date').val();
			var remarks = $('#remarks').val();
			var due_date = $('#due_date').val();
			var request_date = $('#request_date').val();
			var status = $('#status').val();
			alert(request_date);
			var txt_id1 = $('#idEdit').val();

			if (cer_no == "" || name_of_instu == "" || sr_no == "" || instu_id_no == "" || instu_make == "" || location == "" || make_model == "" || cal_by == "" || remarks == "") {

				alert(" All Field Required..");
				return false;
			}

			billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&cer_no=' + cer_no + '&name_of_instu=' + name_of_instu + '&sr_no=' + sr_no + '&instu_id_no=' + instu_id_no + '&instu_make=' + instu_make + '&location=' + location + '&make_model=' + make_model + '&cal_by=' + cal_by + '&calibration_date=' + calibration_date + '&remarks=' + remarks + '&due_date=' + due_date + '&request_date=' + request_date + '&status=' + status + '&txt_id1=' + txt_id1;



		} else {


			billData = 'action_type=' + type + '&id=' + id;
		}
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>save_calibratoin.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {
				//getGlazedTiles();
				window.location.href = "<?php $base_url; ?>calibration_entry_which_expired.php";
			}
		});
	}

	function editData(id) {

		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?php echo $base_url; ?>save_calibratoin.php',
			data: 'action_type=data&id=' + id,
			success: function(data) {
				$('#idEdit').val(data.id);
				var idEdit = $('#idEdit').val();

				$('#cer_no').val(data.cer_no);
				$('#name_of_instu').val(data.name_of_instu);
				$('#sr_no').val(data.sr_no);
				$('#instu_id_no').val(data.instu_id_no);
				$('#instu_make').val(data.instu_make);
				$('#location').val(data.location);
				$('#make_model').val(data.make_model);
				$('#remarks').val(data.remarks);
				$('#cal_by').val(data.cal_by);
				$('#calibration_date').val(data.calibration_date);
				$('#due_date').val(data.due_date);
				$('#request_date').val(data.request_date);
				$('#status').val(data.status);

				$('#btn_edit_data').show();
				$('#billing').show();
				$('#btn_save').hide();
			}
		});
	}


	$('#due_date').datepicker().on("change", function() {

		var due_dating = $('#due_date').val();

		var new_date = moment(due_dating, "DD/MM/YYYY");
		new_date.add(-10, 'days'); //minus 10 days to due_dating

		var aa = new_date.format("DD/MM/YYYY");
		$('#request_date').val(aa);;
	})
</script>