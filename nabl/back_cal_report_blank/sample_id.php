<?php 

$mt_cat_id = $row_select3['mat_category_id'];
			
$sql = mysqli_query($conn,"select * from material_category where material_cat_id = $mt_cat_id");
if(mysqli_num_rows($sql) == 1)
{
	$fetch = mysqli_fetch_assoc($sql);
	$cat_prefix = $fetch['cat_prefix'];
	
	$year = date('y', strtotime($rec_sample_date));
	$month = date('m', strtotime($rec_sample_date));
	
	$parts = explode('-', $lab_no);
	$first = $parts[1];
				
	$sample_id = "$first/$month"."$year/$cat_prefix";
	
}

?>