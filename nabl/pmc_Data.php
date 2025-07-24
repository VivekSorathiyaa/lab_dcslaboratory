<?php
session_start();
include 'connection.php';
error_reporting(1);

if (isset($_POST['add_pmc_name'])) {

	// $add_pmc_names = str_replace("zxctxavb","'",$_POST['add_pmc_name']);
	$add_pmc_name = str_replace("qwerfdsa", "&", $_POST['add_pmc_name']);
	$add_pmc_mobile = $_POST['add_pmc_mobile'];
	$add_pmc_email = $_POST['add_pmc_email'];
	$curr_date = date("Y-m-d");


	$serial = "SELECT * FROM pmc ORDER BY pmc_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["pmc_code"] + 1;
	} else {
		$ser_no = 1;
	}

	$query = "INSERT INTO `pmc`(`pmc_code`,`pmcname`,`pmcphone`,`email`,`pmccreatedby`,`pmccreateddate`,`pmcmodifiedby`,`pmcmodifieddate`) values(
						'$ser_no',
						'$add_pmc_name',
						'$add_pmc_mobile',
						'$add_pmc_email',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$query_run = mysqli_query($conn, $query);
}
?>
<option value="">Select pmc</option>
<?php
$get_client = "SELECT * FROM pmc where `pmcisdeleted`=0 ORDER BY pmc_id DESC";
$client_res = mysqli_query($conn, $get_client);
if (mysqli_num_rows($client_res) > 0) {
	while ($r = mysqli_fetch_array($client_res)) { ?>
		<option value="<?php echo $r["pmc_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['pmcname']); ?></option>
<?php
	}
}
?>