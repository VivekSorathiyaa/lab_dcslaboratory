<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

	
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	<div class="row">
		<h1 style="text-align:center;">
					CALIBRAION ENTRY						
		</h1>		
	</div>
<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
	<div class="col-md-12">
				<!-- general form elements -->
		<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">VIEW CALIBRAION DATA</h3>
				</div>
				<!-- /.box-header -->
					
			<div class="box-body">
			
		
			<div id="display_data">
					<table id="example1" class="table table-bordered table-striped">
					<thead>
							<tr>
								<th style="text-align:center;" width="10%"><label>Actions</label></th>
								<th style="text-align:center;"><label>UNIQUE ID.</label></th>	
								<th style="text-align:center;"><label>INSTUMENT  NAME</label></th>	
								<th style="text-align:center;"><label>RANGE </label></th>	
								<th style="text-align:center;"><label>ACCURACY  </label></th>	
								<th style="text-align:center;"><label>ACCEPTANCE CRITERIA </label></th>	
								<th style="text-align:center;"><label>LOCATION  </label></th>	
								<th style="text-align:center;"><label>MAKE/ MODEL  </label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DATE</label></th>	
								<th style="text-align:center;"><label>METHOD OF CALIBRATION  </label></th>	
								<th style="text-align:center;"><label>DUE DATE</label></th>	
								<th style="text-align:center;"><label>STATUS </label></th>	
								
							</tr>
							  </thead>
								<?php
							  $query = "select * from calibration_data WHERE `isdeleted`='0'";
						
								$result = mysqli_query($conn, $query);
			
								if (mysqli_num_rows($result) > 0) {
								while($r = mysqli_fetch_array($result)){
										?>
										<tbody>
										<tr>
										<td style="text-align:center;" width="10%">	
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
										<?php

											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
										<?php
											//}
										?>
										</td>
										<td style="text-align:center;"><?php echo $r['unique_id'];?></td>
										<td style="text-align:center;"><?php echo $r['name_of_instu'];?></td>
										<td style="text-align:center;"><?php echo $r['ranges'];?></td>					
										<td style="text-align:center;"><?php echo $r['accuracy'];?></td>					
										<td style="text-align:center;"><?php echo $r['acceptance_cri'];?></td>
										<td style="text-align:center;"><?php echo $r['location'];?></td>					
										<td style="text-align:center;"><?php echo $r['make_model'];?></td>					
										<td style="text-align:center;"><?php echo $r['method'];?></td>		
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['calibration_date']));?></td>			
										<td style="text-align:center;"><?php echo $r['rep_no'];?></td>
										<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($r['due_date']));?></td>					
										<td style="text-align:center;"><?php echo $r['status'];?></td>	 				
										</tr>
										</tbody>
										<?php
									}
								}
							?>
						</table>
					</div>
				</div>
			</div>	
					
					
			</div>			
		</div>
	</div>
</div>
	
      <!-- /.row -->
</section>	
</div>  
	
<?php include("footer.php");?>		   
		  
<script>
 
     $(document).ready(function() {
		$('#btn_edit_data').hide();
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		
    } );
 } );

	
	
</script>
