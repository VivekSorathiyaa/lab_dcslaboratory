<?php
session_start();
include("connection.php");
			if(isset($_FILES["file"]["name"]))
			{
				$lab_no = $_POST['lab_no'];
				$job_no = $_POST['job_no'];
				$report_no = $_POST['report_no'];
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename= "EXCEL_".rand(999,99999)."_".$report_no.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'uploaded_excel/';
				$final_path = $path.$filename;
				move_uploaded_file($tmp_name,$path.$filename);
				$tbl="";
				$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$job_no' AND `lab_no`='$lab_no' ORDER BY final_material_id DESC";
				$result=mysqli_query($conn,$query);
				while($row=mysqli_fetch_array($result))
				{
					$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
					$result_cat=mysqli_query($conn,$sel_cate);
					$row_cat=mysqli_fetch_array($result_cat);
					
					$sel_mat="select * from material where `id`=".$row['material_id'];
					$result_mat=mysqli_query($conn,$sel_mat);
					$row_mat=mysqli_fetch_array($result_mat);
					$mat_prefix= $row_mat["mt_prefix"];
					
					$tbl =  $row_mat["table_name"];
				}
				
				 $insert = "INSERT INTO `excel_upload_from_report`(`lab_no`, `job_no`, `report_no`, `excel_sheet`,`table_name`) VALUES ('$lab_no','$job_no','$report_no','$final_path','$tbl')";
				$qry = mysqli_query($conn,$insert);
				
			}
			else if($_POST['action_type'] == 'get_excel_record')
			{
				$lab_no = $_POST['lab_no'];
				$job_no = $_POST['job_no'];
				$report_no = $_POST['report_no'];
				?>
				<table border="1px solid black" align="center" width="100%">
					<tr>
						<th>Download </th>
						<th>Action</th>
					</tr>
			<?php
				$query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no' and report_no='$report_no'";
				$result_file = mysqli_query($conn, $query_file);
				if (mysqli_num_rows($result_file) > 0)
				{
					while($r_file = mysqli_fetch_array($result_file))
					{
					?>
					<tr>
						<td><a href="<?php echo $base_url.$r_file['excel_sheet'];?>" download><?php echo $r_file['excel_sheet'];?></a></td>
						<td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id'];?>">Delete</a></td>
					</tr>
				<?php		
					}
				}
				?>
				</table>
			<?php
			}else if($_POST['action_type'] == 'delete_excels')
			{
				$clicked_id = $_POST['clicked_id'];
				
				$query_file = "select * from excel_upload_from_report WHERE id=".$clicked_id;
				$result_file = mysqli_query($conn, $query_file);
				$r_file = mysqli_fetch_array($result_file);
				$paths=$r_file['excel_sheet'];
				@unlink($paths);
				$deles = "delete from excel_upload_from_report WHERE id=".$clicked_id;
				$result_file = mysqli_query($conn, $deles);
				
			}
?>