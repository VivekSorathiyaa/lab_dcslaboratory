<?php
session_start();
include 'connection.php';
error_reporting(1);

if (isset($_POST['add_tpi_name'])) {

	// $add_tpi_names = str_replace("zxctxavb","'",$_POST['add_tpi_name']);
	$add_tpi_name = str_replace("qwerfdsa", "&", $_POST['add_tpi_name']);
	$add_tpi_mobile = $_POST['add_tpi_mobile'];
	$add_tpi_email = $_POST['add_tpi_email'];
	$curr_date = date("Y-m-d");


	$serial = "SELECT * FROM tpi ORDER BY tpi_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["tpi_code"] + 1;
	} else {
		$ser_no = 1;
	}

	$query = "INSERT INTO `tpi`(`tpi_code`,`tpi_name`,`tpi_phone`,`tpi_email`,`tpicreatedby`,`tpicreateddate`,`tpimodifiedby`,`tpimodifieddate`) values(
						'$ser_no',
						'$add_tpi_name',
						'$add_tpi_mobile',
						'$add_tpi_email',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$query_run = mysqli_query($conn, $query);
}
?>
<option value="">Select Tpi</option>
<?php
$get_client = "SELECT * FROM tpi where `tpiisdeleted`=0 ORDER BY tpi_id DESC";
$client_res = mysqli_query($conn, $get_client);
if (mysqli_num_rows($client_res) > 0) {
	while ($r = mysqli_fetch_array($client_res)) { ?>
		<option value="<?php echo $r["tpi_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['tpi_name']); ?></option>
<?php
	}
}
?>