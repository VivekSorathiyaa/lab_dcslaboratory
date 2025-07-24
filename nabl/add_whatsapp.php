
<?php 
session_start(); 
include("header.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

if(isset($_POST["subs"]))
{
	$filename=$_FILES["csv_file"]["tmp_name"];    
    
		  $sel_last="select * from whatapp_msg where `is_deleted`=0 ORDER BY msg_id ASC LIMIT 0,1";
			$result_last = mysqli_query($conn, $sel_last);
			if(mysqli_num_rows($result_last) > 0){
				$gets = mysqli_fetch_array($result_last);
				$plused= intval($gets["file_no"]) + 1 ;
			}else{
				$plused=1;
			}
			
		  $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
			
			$phone_column=$_POST["sel_var"];
			$sql = "INSERT into whatapp_msg (file_no,var_1,var_2,var_3,var_4,var_5,var_6,var_7,var_8,var_9,var_10,phone_column) 
                   values ('$plused','".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','$phone_column')";
                   $result = mysqli_query($conn, $sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              </script>";    
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"whatsapp.php\"
          </script>";
        }
           }
      
           fclose($file);  
     
}


?>

<style>
.form-control { 
font-size: 17px;; 
}

/* only for 3d button effects */

.


.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;


</style>

<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Content Header (Page header) -->

	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row">
		
		<h1 style="text-align:center;">
		Import Csv File
		</h1>
	</div>
	<div class="row">
			<div class="col-md-12">
			<?php include("whatsapp_menu.php") ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form method="post" enctype="multipart/form-data">
					   <div class="row">
									<div class="col-md-2">
									<label>upload CSV:</label>
										<input type="file" class="form-control select2" name="csv_file" id="csv_file" required>
									</div>
									<div class="col-md-2">
									<label>Mobile No Column:</label>
										<select name="sel_var" required class="form-control select2">
										<option value="">Select Var</option>
										<option value="var_1">var_1</option>
										<option value="var_2">var_2</option>
										<option value="var_3">var_3</option>
										<option value="var_4">var_4</option>
										<option value="var_5">var_5</option>
										<option value="var_6">var_6</option>
										<option value="var_7">var_7</option>
										<option value="var_8">var_8</option>
										<option value="var_9">var_9</option>
										<option value="var_10">var_10</option>
										</select>
									</div>
									<div class="col-md-6">	
									<label>&nbsp;&nbsp;&nbsp;</label>									
										<input type="submit" class="btn btn-primary" name="subs" value="Submit">
									</div>
					</div>
					</form>
					</div>
			 
					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
</section>
</div>
</div>	
<?php include("footer.php");?>