
<?php
session_start();
include("connection.php");
error_reporting(1);
$sel_links = "select * from whatsapp_link_api where `is_deleted`=0";
$result_links = mysqli_query($conn, $sel_links);
$row_links = mysqli_fetch_array($result_links);
$ulrs_links = $row_links["urls"];
$wht_api = $row_links["apis"];
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'send_msg') {
		$sele_materials = "select * from send_list where `is_deleted`=0 AND `sent_msg`=0 ORDER BY msg_id ASC LIMIT 0,1";
		$result_materials = mysqli_query($conn, $sele_materials);
		if (mysqli_num_rows($result_materials) > 0) {
			$row_materials = mysqli_fetch_array($result_materials);
			$msg_id = $row_materials["msg_id"];


			$sele_msg = "select * from whatapp_msg where `is_deleted`=0 AND `msg_id`=" . $msg_id;
			$result_msg = mysqli_query($conn, $sele_msg);
			$row_msg = mysqli_fetch_array($result_msg);
			//$message="ThisisTestmessage";
			//$message="ThisisTestmessage";
			$phone_column = $row_msg["phone_column"];
			$numbes = $row_msg[$phone_column];
			$message = $row_materials["text_msg"];

			//$ulrs="http://bulkwhatsapp.live/wapp/api/send?apikey=3e636ed2805449e1bcf848e8a079470f&mobile=".$numbes."&msg=".$message;
			$ulrs = $ulrs_links . "apikey=" . $wht_api . "&mobile=" . $numbes . "&msg=" . $message;
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $ulrs);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);
			if (empty($buffer)) {

				$upd_list = "update send_list set `sent_msg`=2 where `msg_id`=" . $msg_id;
				mysqli_query($conn, $upd_list);

				$upd = "update whatapp_msg set `msg_send`=2,`delivery_status`='Nothing returned from url' where `msg_id`=" . $msg_id;
				mysqli_query($conn, $upd);
			} else {
				//print $buffer;
				$serilizes = serialize($buffer);
				$upd_list = "update send_list set `sent_msg`=1,`delivery_status`='$serilizes' where `msg_id`=" . $msg_id;
				mysqli_query($conn, $upd_list);

				$upd = "update whatapp_msg set `msg_send`=1,`delivery_status`='$serilizes' where `msg_id`=" . $msg_id;
				mysqli_query($conn, $upd);
			}
		}
	} else if ($_POST['action_type'] == 'try_id') {

		$sel_mssg = "select * from text_msg LIMIT 0,1";
		$get_msg = mysqli_query($conn, $sel_mssg);
		$results_msg = mysqli_fetch_array($get_msg);

		$sel_wht = "select * from whatapp_msg LIMIT 0,1";
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
		$replced = str_replace("[ent]", "%20%0A", $replced);
		$replced = str_replace("|", "%7C", $replced);


		//$ulrs="http://bulkwhatsapp.live/wapp/api/send?apikey=3e636ed2805449e1bcf848e8a079470f&mobile=".$numbes."&msg=".$message;
		$ulrs = $ulrs_links . "apikey=" . $wht_api . "&mobile=9726513790" . "&msg=" . $replced;
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $ulrs);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		if (empty($buffer)) {

			echo "Success";
		} else {
			echo "Fail";
		}
	}
}
