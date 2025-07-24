<?php
session_start();
include 'connection.php';
error_reporting(1);

if (isset($_POST['add_client_name'])) {

	//$add_client_names = str_replace("zxctxavb","'",$_POST['add_client_name']);
	$add_client_name = str_replace("qwerfdsa", "&", $_POST['add_client_name']);
	$add_client_mobile = $_POST['add_client_mobile'];
	$add_client_email = $_POST['add_client_email'];
	$add_client_gst = $_POST['add_client_gst'];
	$add_client_address = $_POST['add_client_address'];
	$curr_date = date("Y-m-d");

	// $get_client="SELECT *FROM client where `clientphone`='$add_client_mobile'";
	//$client_res = mysqli_query($conn, $get_client);
	//if (mysqli_num_rows($client_res) > 0) 
	//{
	//	echo "client already exist";
	//	exit;
	//}else{
	$serial = "SELECT * FROM client ORDER BY client_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["client_code"] + 1;
	} else {
		$ser_no = 1;
	}
	$query = "INSERT INTO `client`(`client_code`, `clientname`, `clientphone`,`email`,`gst_no`,`clientaddress`,`clientcreatedby`,`clientcreateddate`,`clientmodifiedby`,`clientmodifieddate`) values(
						'$ser_no',
						'$add_client_name',
						'$add_client_mobile',
						'$add_client_email',
						'$add_client_gst',
						'$add_client_address',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$query_run = mysqli_query($conn, $query);
	//}




}
?>
<option value="">Select Customer</option>
<?php
$get_client = "SELECT * FROM client where `clientisdeleted`=0 ORDER BY client_id DESC";
$client_res = mysqli_query($conn, $get_client);
if (mysqli_num_rows($client_res) > 0) {
	while ($r = mysqli_fetch_array($client_res)) { ?>
		<option value="<?php echo $r["client_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['clientname']); ?></option>
<?php
	}
}
?>