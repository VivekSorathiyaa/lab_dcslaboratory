<?php
include("connection.php");

/*$columns = array( 
// datatable column index  => database column name
    0 => 'id',
    1 => 'job_no',
    2 => 'days',
    3 => 'date',
    4 => 'ref_name',
    5 => 'ref_date',
    6 => 'id_brand',
    7 => 'detail_sample',
    8 => 'id_mark',
    9 => 'start_date',
    10 => 'end_date',
    11=> 'con_sample',
);*/
			
		
			 //$data = $_POST['id'];
			// echo $data; exit;
			
			//-------------------
			
			 $sql = "select * from metal_40_mm WHERE sr_no='$_REQUEST[id]'";
			$resultset = mysqli_query($conn, $sql);
			$data = array();
			while( $rows = mysqli_fetch_assoc($resultset) ) {
			$data[] = $rows;
			//$data1[] = "<td style='text-align:center;' width='10%'><a href='javascript:void(0);' class='glyphicon glyphicon-edit' onclick='editData('')'></a><a href='javascript:void(0);' class='glyphicon glyphicon-trash' onclick='return confirm('Are you sure to delete data?')?saveMetal('delete',''):false;'></a></td>";
			}
			

			$results = array(
			"sEcho" => 1,
			
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data);
			//echo "<pre>";
			//print_r($results);
			//echo "</pre>";
			echo json_encode($results);
			exit;
			
			//echo json_encode($fill);

?>