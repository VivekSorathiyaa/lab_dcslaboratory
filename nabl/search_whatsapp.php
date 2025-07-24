<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'search') {
		$sel_var = $_POST["sel_var"];
		$where = " AND file_no='$sel_var' LIMIT 0,400";
?>

		<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
			<thead>
				<tr>
					<th style="text-align:center;">Serial no</th>
					<th style="text-align:center;"><input type="checkbox" id="chk_all">ALL </th>
					<th style="text-align:center;">File No</th>
					<th style="text-align:center;">var_1</th>
					<th style="text-align:center;">var_2</th>
					<th style="text-align:center;">var_3</th>
					<th style="text-align:center;">var_4</th>
					<th style="text-align:center;">var_5</th>
					<th style="text-align:center;">var_6</th>
					<th style="text-align:center;">var_7</th>
					<th style="text-align:center;">var_8</th>
					<th style="text-align:center;">var_9</th>
					<th style="text-align:center;">var_10</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$sele_materials = "select * from whatapp_msg where `msg_send`=0" . $where;
				$result_materials = mysqli_query($conn, $sele_materials);
				if (mysqli_num_rows($result_materials) > 0) {
					$counting = 1;
					while ($row_materials = mysqli_fetch_array($result_materials)) { ?>
						<tr>
							<td><?php echo $counting; ?></td>
							<td><input type="checkbox" class="chk_number" value=<?php echo $row_materials["msg_id"] ?>></td>
							<td><?php echo $row_materials["file_no"] ?></td>
							<td><?php echo $row_materials["var_1"] ?></td>
							<td><?php echo $row_materials["var_2"] ?></td>
							<td><?php echo $row_materials["var_3"] ?></td>
							<td><?php echo $row_materials["var_4"] ?></td>
							<td><?php echo $row_materials["var_5"] ?></td>
							<td><?php echo $row_materials["var_6"] ?></td>
							<td><?php echo $row_materials["var_7"] ?></td>
							<td><?php echo $row_materials["var_8"] ?></td>
							<td><?php echo $row_materials["var_9"] ?></td>
							<td><?php echo $row_materials["var_10"] ?></td>

						</tr>
				<?php
						$counting++;
					}
				}
				?>
			</tbody>
		</table>
		<?php
		$sel_links = "select * from whatsapp_link_api where `is_deleted`=0";
		$result_links = mysqli_query($conn, $sel_links);
		$row_links = mysqli_fetch_array($result_links);
		?>
		<div class="row">
			<div class="col-md-3">
				<label>Whatsapp Link</label>
			</div>
			<div class="col-md-3">
				<label>Whatsapp Api</label>
			</div>
			<div class="col-md-2">
				<label>&nbsp;</label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<input type="text" name="url_links" id="url_links" class="form-control" style="width:350px;" placeholder="Enter Whatsapp Link" value="<?php echo $row_links['urls']; ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="txt_api" id="txt_api" class="form-control" style="width:300px;" placeholder="Enter Whatsapp Api" value="<?php echo $row_links['apis']; ?>">
			</div>
			<div class="col-md-2">
				<a href="javascript:void(0)" id="update_links" class="btn btn-primary">Update</a>
			</div>
		</div>
		<br>
		<!--<div class="row">
						<div class="col-md-2">
						<label>Try Whatsapp -></label>
							<a href="javascript:void(0)" id="try_id" class="btn btn-primary">Try</a>
						</div>
					</div>-->

		<br>
		<a href="javascript:void(0)" id="save_for_whts" class="btn btn-primary">Submit</a>
<?php
	} elseif ($_POST['action_type'] == 'save_for_whts') {
		$sel_var = $_POST["sel_var"];
		$sel_msg = $_POST["sel_msg"];
		$txt_time = $_POST["txt_time"];
		$chk_number_arrray = $_POST["chk_number_arrray"];
		$explodings = explode(",", $chk_number_arrray);
		foreach ($explodings as $one_nos) {
			$sel_mssg = "select * from text_msg where `msg_id`=" . $sel_msg;
			$get_msg = mysqli_query($conn, $sel_mssg);
			$results_msg = mysqli_fetch_array($get_msg);

			$sel_wht = "select * from whatapp_msg where `msg_id`=" . $one_nos;
			$get_wht = mysqli_query($conn, $sel_wht);
			$results_wht = mysqli_fetch_array($get_wht);
			$var_1 = $results_wht["var_1"];
			$var_2 = $results_wht["var_2"];
			$var_3 = $results_wht["var_3"];
			$var_4 = $results_wht["var_4"];
			$var_5 = $results_wht["var_5"];
			$var_6 = $results_wht["var_6"];
			$var_7 = $results_wht["var_7"];
			$var_8 = $results_wht["var_8"];
			$var_9 = $results_wht["var_9"];
			$var_10 = $results_wht["var_10"];

			$message_text = $results_msg["msg"];


			$replced = str_replace('var_1', '$var_1', $message_text);
			$replced = str_replace('$var_1', $var_1, $replced);

			$replced = str_replace('var_2', '$var_2', $replced);
			$replced = str_replace('$var_2', $var_2, $replced);

			$replced = str_replace('var_3', '$var_3', $replced);
			$replced = str_replace('$var_3', $var_3, $replced);

			$replced = str_replace('var_4', '$var_4', $replced);
			$replced = str_replace('$var_4', $var_4, $replced);

			$replced = str_replace('var_5', '$var_5', $replced);
			$replced = str_replace('$var_5', $var_5, $replced);

			$replced = str_replace('var_6', '$var_6', $replced);
			$replced = str_replace('$var_6', $var_6, $replced);

			$replced = str_replace('var_7', '$var_7', $replced);
			$replced = str_replace('$var_7', $var_7, $replced);

			$replced = str_replace('var_8', '$var_8', $replced);
			$replced = str_replace('$var_8', $var_8, $replced);

			$replced = str_replace('var_9', '$var_9', $replced);
			$replced = str_replace('$var_9', $var_9, $replced);


			$replced = str_replace('var_10', '$var_10', $replced);

			$replced = str_replace('$var_10', $var_10, $replced);
			$replced = str_replace(" ", "%20", $replced);
			$replced = str_replace("&", "%26", $replced);
			$replced = str_replace("[ent]", "%20%0A", $replced);
			$replced = str_replace("|", "%7C", $replced);
			$ins = "insert into send_list (`msg_id`,`msg_title_id`,`file_no`,`time`,`text_msg`) VALUES('$one_nos','$sel_msg','$sel_var','$txt_time','$replced')";
			mysqli_query($conn, $ins);

			$update = "update whatapp_msg set msg_ready=1 where `msg_id`=" . $one_nos;
			mysqli_query($conn, $update);
		}
		$dels = "delete from whatapp_msg where `msg_id`=" . $ids;
		mysqli_query($conn, $dels);
	} elseif ($_POST['action_type'] == 'update_links') {
		$url_links = $_POST["url_links"];
		$txt_api = $_POST["txt_api"];

		$update = "update whatsapp_link_api set urls='$url_links',apis='$txt_api' where `ids`=1";
		mysqli_query($conn, $update);
	} elseif ($_POST['action_type'] == 'all_submit') {
		$chk_number_arrray = $_POST["chk_number_arrray"];
		$explodings = explode(",", $chk_number_arrray);
		foreach ($explodings as $one_nos) {
			$update = "update send_list set sent_msg=0,delivery_status='' where `send_id`=" . $one_nos;
			mysqli_query($conn, $update);
		}
	} elseif ($_POST['action_type'] == 'delete_data') {
		$ids = $_POST["ids"];
		$dels = "delete from whatapp_msg where `msg_id`=" . $ids;
		mysqli_query($conn, $dels);
	} elseif ($_POST['action_type'] == 'resend_it') {
		$ids = $_POST["ids"];
		$update = "update send_list set sent_msg=0,delivery_status='' where `send_id`=" . $ids;
		mysqli_query($conn, $update);
	} elseif ($_POST['action_type'] == 'delete_txt_msg') {
		$ids = $_POST["ids"];
		$dels = "delete from text_msg where `msg_id`=" . $ids;
		mysqli_query($conn, $dels);
	} elseif ($_POST['action_type'] == 'get_data') {
		$ids = $_POST["ids"];
		$dels = "select * from text_msg where `msg_id`=" . $ids;
		$datas = mysqli_query($conn, $dels);
		$result = mysqli_fetch_array($datas);
		$fill = array("ids" => $result["msg_id"], "title" => $result["title"], "msg" => $result["msg"]);
		echo json_encode($fill);
		exit;
	}
}
?>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
		var table = $('#example2').DataTable({
			'autoWidth': true,
			'scrollX': true,
			"pageLength": 400
		});

		$(function() {
			$('.select2').select2();
		})

	});
</script>