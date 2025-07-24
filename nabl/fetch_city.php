
<?php 
include_once("connection.php");

$sql = "select city_name from city";
	
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	
	while($row = mysqli_fetch_array($res)){
		array_push($result, 
				array('city_name'=>$row['city_name']));
	}
	
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>