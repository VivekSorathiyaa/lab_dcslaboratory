 <?php 
 
 include ("connection.php");
		$select_auth = $_POST['select_auth'];
		$authority_query = "select * from authority WHERE id='$select_auth' AND `auth_isdeleted`='0'";
		$result_authority = mysqli_query($conn, $authority_query);

		if (mysqli_num_rows($result_authority) > 0) {
			while($row_authority = mysqli_fetch_assoc($result_authority)) {
			$auth_name= $row_authority['auth_name'];
		}
		 $fill = array(
        'auth_name' => $auth_name);
		 echo json_encode($fill);
	
}?>