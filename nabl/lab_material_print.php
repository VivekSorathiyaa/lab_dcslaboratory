<style>
.tdclass{
    border: 1px solid black;
    font-size:15px;
	 font-family: arial;
}

td{
	padding:10px;
	    
}
</style>

<?php include("connection.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
$abc = explode("|",$_GET['pass_id']);
		$report_no = $abc[0];
		$job_number = $abc[1];

?>
		
<table class="table no-margin " style="color: black;" border="1">
										  <thead>
										  <tr>
										  <td colspan="4" class="tdclass">
										  <h1 style="text-align: center; padding-top:20px;"><b>Shree Soil House Management System</b></h1>
										  </td>
										  </tr>
		<tr>
		<th colspan="2" style="padding:10px;font-size:15px;width: 50%;" class="tdclass">Report Number : <?php echo $report_no;?></th>
		<th colspan="2" style="padding:10px;font-size:15px;width: 50%;" class="tdclass">Job Number : <?php echo $job_number;?></th>
		</tr>
										  <tr>
											<th class="tdclass">Material</th>
											<th class="tdclass">Lab No</th>
											<th class="tdclass">Test List</th>
											<th class="tdclass">Exp. Sub. Date</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
		
		$get_jobs="select  * from job where `report_no`='$report_no' AND `job_number`='$job_number'";
		$query_job=mysqli_query($conn,$get_jobs);
		$job_row=mysqli_fetch_array($query_job);
		
		$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$job_number' ORDER BY final_material_id DESC";
		$result=mysqli_query($conn,$query);
		$material_count=1;
		while($row=mysqli_fetch_array($result))
		{
			
		$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
		$result_cat=mysqli_query($conn,$sel_cate);
		$row_cat=mysqli_fetch_array($result_cat);
		
		$sel_mat="select * from material where `id`=".$row['material_id'];
		$result_mat=mysqli_query($conn,$sel_mat);
		$row_mat=mysqli_fetch_array($result_mat);
		  ?>
		  <tr style="padding:5px;">
			<td class="tdclass"><b><?php echo $row_mat["mt_name"];?></b>
			</td>
			<td class="tdclass">
			<?php echo $row['lab_no']; ?>
			</td>
			<td>
			<?php 
		 $test_query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `report_no`='$report_no' AND `job_number`='$job_number' ORDER BY material_assign_id DESC";
		$result_for_test=mysqli_query($conn,$test_query);
		$print_test="";
		while($rows=mysqli_fetch_array($result_for_test))
		{
			
		$sel_test="select * from test_master where `test_id`=".$rows['test'];
		$result_test=mysqli_query($conn,$sel_test);
		$row_test=mysqli_fetch_array($result_test);
			
			echo $row_test['test_name']." , ";
			$print_test .=$row_test['test_name']." , ";
		}
		
		?>
		
			
		</td>
			
			<td class="tdclass">
			  <?php echo date('d-m-Y',strtotime($row['expected_date'])); ?>
			</td>
			
			
		  </tr>
		<?php 
		$material_count++;
		} ?>
		
		  </tbody>
		</table>


	


<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			window.print();
		}, 
		1000);

}





 
</script>

