<?php 
include("header.php");
error_reporting(1);
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
/* required style*/ 
.none{display: none;}

/* optional styles */
.row{ margin:20px 0px;width: 100%;}
.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;}
a.glyphicon-trash{margin-left: 10px;}

</style>
	<div class="content-wrapper" style="margin-left: 0px !important;">
		<!-- Main content -->
		<section class="content" style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
				<h1 style="text-align:center;"></h1>
			</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
				<!-- left column -->
				<div class="col-md-12 task-asigner-box">
				
				<!-- general form elements -->
					<div class="box box-primary">
						<div class="panel panel-default mts-content">
							<div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
				<div class="col-md-12" style="float:unset;">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pending_task" data-toggle="tab">Pending Task</a></li>
              <li><a href="#comp_task" data-toggle="tab">Completed Task</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="pending_task">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="3%">Sr no.</th>
                  <th width="10%">Assign To Name</th>
                  <th width="5%">Task No.</th>
                  <th width="10%">Task Name</th>
                  <th width="10%">End Date</th>
                  <th width="10%">Due Date</th>
                  <th width="15%">Narration</th>
                  <th width="5%">Files</th>
                  <th width="5%">Status</th>
                  <th width="20%">Admin Comment</th>
                  <!--<th>Action</th>-->
                </tr>
                </thead>
                <tbody>
				<?php
					$today_date = date('Y-m-d');
					$select_data = "SELECT * FROM `tasks` WHERE `task_deleted`='0' AND `accept_by_assiner`='0' AND `accept_by_admin`='0' AND `task_view_date` <= '$today_date' AND `task_completed`='0' AND `staff` LIKE '%".$_SESSION["id"]."%'";
					$result_data = mysqli_query($conn, $select_data);
					if(mysqli_num_rows($result_data) > 0){
					$count=1;
					while($row_data = mysqli_fetch_array($result_data)){
				
				?>
					<tr>
						<td><?php echo $count;?></td>
						<td>
							<?php 
								$get_assign_to = "SELECT * FROM `task_user` WHERE `id`=".$row_data['task_asign_to'];
								$res_assign_to = mysqli_query($conn, $get_assign_to);
								$row_assign_to = mysqli_fetch_array($res_assign_to);
								echo $row_assign_to['user_name'];
							?>
						</td>
						<td><?php echo $row_data['task_u_id'];?></td>
						<td><?php echo $row_data['task_name'];?></td>
						<td><?php echo date('d/m/Y',strtotime($row_data['task_end_date']));?></td>
						<td><?php echo date('d/m/Y',strtotime($row_data['task_end_date']));?></td>
						<td><?php echo $row_data['task_narr'];?></td>
						<td>
							<?php 
								$url = explode('/', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
								//$base_url = $url[0]."/".$url[1]."/".$url[2]."/";
								
								if($row_data['upload1'] != ""){
									$full_ulr = $base_url."task_upload/".$row_data['task_u_id']."/".$row_data['upload1'];
									echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 1' target='_blank'><i class='fa fa-eye'></i></a>";
								}
								if($row_data['upload2'] != ""){
									$full_ulr = $base_url."task_upload/".$row_data['task_u_id']."/".$row_data['upload2'];
									echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 2' target='_blank'><i class='fa fa-eye'></i></a>";
								}
								if($row_data['upload3'] != ""){
									$full_ulr = $base_url."task_upload/".$row_data['task_u_id']."/".$row_data['upload3'];
									echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 3' target='_blank'><i class='fa fa-eye'></i></a>";
								}
								if($row_data['upload4'] != ""){
									$full_ulr = $base_url."task_upload/".$row_data['task_u_id']."/".$row_data['upload4'];
									echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 4' target='_blank'><i class='fa fa-eye'></i></a>";
								}
								if($row_data['upload5'] != ""){
									$full_ulr = $base_url."task_upload/".$row_data['task_u_id']."/".$row_data['upload5'];
									echo "<a href='$full_ulr' style='margin:3px;' title='Uploaded File 5' target='_blank'><i class='fa fa-eye'></i></a>";
								}
							?>
						</td>
						<td>
							<?php 
								if($row_data['submit_by_viewer'] == "0"){ 
									echo "<span class='badge bg-red'>Pending</span>"; 
								}else{
									echo "<span class='badge bg-green'>Completed</span>"; 
								}
							?>
						
						</td>
						<td>
							<!--<a href="#" class="btn btn-primary view_task" data-toggle="modal" data-target=".bd-example-modal-lg" id="<?php echo $row_data['task_id'];?>"><i class="fa fa-eye"></i></a>-->
							
							
							<a href="#" class="btn btn-primary submit_task <?php if($row_data['submit_by_viewer'] != "0"){ echo "disabled"; }?>" id="<?php echo $row_data['task_id'];?>">Submit</a>
							<a href="#" class="btn btn-success accept_by_assiner <?php if($row_data['submit_by_viewer'] == "0"){ echo "disabled"; }?>" id="<?php echo $row_data['task_id'];?>">Accept</a>
							
							
							<!--<a href="#" class="btn btn-success rework <?php if($row_data['task_completed'] == "0"){ echo "disabled"; }?>" id="<?php echo $row_data['task_id'];?>">Rework</a>-->
						
						
						</td>
						<!--<td>
							<a href="#" data-id="<?php echo $row_data['task_id'];?>" 
										data-task_asign_to="<?php echo $row_data['task_asign_to'];?>"
										data-task_name="<?php echo $row_data['task_name'];?>"
										data-task_narr="<?php echo $row_data['task_narr'];?>"
										data-task_end_date="<?php echo $row_data['task_end_date'];?>"
							style="font-size:16px; margin:2px;" class="edit_task"><i class="fa fa-edit"></i></a>
							
							
							<a href="#" data-id="<?php echo $row_data['task_id'];?>" style="font-size:16px; margin:2px;" class="dlt_task"><i class="fa fa-trash"></i></a>
						</td>-->
					</tr>
				<?php
				$count++;
				}
				}
				?>
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="comp_task">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr no.</th>
                  <th>Asign To</th>
                  <th>Task Name</th>
                  <th>End Date</th>
                  <th>Due Date</th>
                  <th>Narration</th>
                  <th>Status</th>
                 
                  <!--<th>Action</th>-->
                </tr>
                </thead>
                <tbody>
				<?php
					$today_date = date('Y-m-d');
					$select_data = "SELECT * FROM `tasks` WHERE `task_deleted`='0' AND `accept_by_assiner`='1' AND `accept_by_admin`='0' AND `task_completed`='0' AND `staff`=".$_SESSION["id"];
					$result_data = mysqli_query($conn, $select_data);
					if(mysqli_num_rows($result_data) > 0){
					$count=1;
					while($row_data = mysqli_fetch_array($result_data)){
				
				?>
					<tr>
						<td><?php echo $count;?></td>
						<td>
							<?php 
								$get_assign_to = "SELECT * FROM `task_user` WHERE `id`=".$row_data['task_asign_to'];
								$res_assign_to = mysqli_query($conn, $get_assign_to);
								$row_assign_to = mysqli_fetch_array($res_assign_to);
								echo $row_assign_to['user_name'];
							?>
						</td>
						<td><?php echo $row_data['task_name'];?></td>
						<td><?php echo date('d/m/Y',strtotime($row_data['task_end_date']));?></td>
						<td><?php echo date('d/m/Y',strtotime($row_data['task_end_date']));?></td>
						<td><?php echo $row_data['task_narr'];?></td>
						<td><span class="badge bg-green">Completed</span> <?php //echo $row_data['task_completed'];?></td>
						
						<!--<td>
							<a href="#" data-id="<?php echo $row_data['task_id'];?>" 
										data-task_asign_to="<?php echo $row_data['task_asign_to'];?>"
										data-task_name="<?php echo $row_data['task_name'];?>"
										data-task_narr="<?php echo $row_data['task_narr'];?>"
										data-task_end_date="<?php echo $row_data['task_end_date'];?>"
							style="font-size:16px; margin:2px;" class="edit_task"><i class="fa fa-edit"></i></a>
							
							
							<a href="#" data-id="<?php echo $row_data['task_id'];?>" style="font-size:16px; margin:2px;" class="dlt_task"><i class="fa fa-trash"></i></a>
						</td>-->
					</tr>
				<?php
				$count++;
				}
				}
				?>
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
			
            </div>
            <!-- /.box-body -->
          </div>
							
							
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	
	
	
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<h2 align="center">Submit Task</h2>
							<input type="hidden" id="task_id_submit">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Remarks</label>
								<div class="col-sm-12">
									<textarea class="form-control" name="task_remarks" id="task_remarks"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Upload Documents - 1</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="task_file_1" id="task_file_1">		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Upload Documents - 2</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="task_file_2" id="task_file_2">		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Upload Documents - 3</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="task_file_3" id="task_file_3">		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Upload Documents - 4</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="task_file_4" id="task_file_4">		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Upload Documents - 5</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="task_file_5" id="task_file_5">		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" class="form-control btn btn-primary" name="task_submit" id="task_submit" value="Submit Task">		
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

<?php 
include("footer.php");

//include("connection.php");

?>

<script>
// Tommorow Date
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var tommorow = now.getFullYear()+"-"+(month)+"-"+((+day)+1) ;
$('#task_end_date').val(tommorow);

//Display Data Function
/*function display_data(){
	var ajaxParameter = "action_type=display_data";
	$.ajax({
		type: 'POST',
		url: 'task_save.php',
		data: ajaxParameter,
		success:function(data){
			$('tbody').append(data);
		}
	});
}

$(document).ready(function(){
	display_data();
})*/




$('.submit_task').click(function(){
	var task_id = $(this).attr('id');
	$('#task_id_submit').val(task_id);
	$('.bd-example-modal-lg').modal('show');
})

$('#task_submit').click(function(){
	var task_submit_id = $('#task_id_submit').val();
	var task_remarks = $('#task_remarks').val();
	var task_file_1 = $("#task_file_1").prop("files")[0];
	var task_file_2 = $("#task_file_2").prop("files")[0];
	var task_file_3 = $("#task_file_3").prop("files")[0];
	var task_file_4 = $("#task_file_4").prop("files")[0];
	var task_file_5 = $("#task_file_5").prop("files")[0];
	var form_data = new FormData();
	form_data.append("action_type", 'submit_by_viewer');
	form_data.append("task_submit_id", task_submit_id);
	form_data.append("task_remarks", task_remarks);
	form_data.append("task_file_1", task_file_1);
	form_data.append("task_file_2", task_file_2);
	form_data.append("task_file_3", task_file_3);
	form_data.append("task_file_4", task_file_4);
	form_data.append("task_file_5", task_file_5);
	
	if(task_remarks != ""){
		$.ajax({
			type: 'POST',
			url: 'task_save.php',
			processData: false,
			contentType: false,
			data: form_data,
			success:function(data){
				if(data == "success"){
					$('.bd-example-modal-lg').modal('hide');
					swal('Congratulations!', 'Task Submited Successfully', 'success');
					window.location.href='task_asigner.php';
				}
			}
		});
	}else{
		alert('Please Enter Remarks');
	}
})


$('.accept_by_assiner').click(function(){
	var task_id = $(this).attr('id');
	var ajaxParameter = "action_type=task_accept_by_assiner&task_id="+task_id;
	swal({
		title: "Are you sure?",
		text: "IF You Want Accept This Task then Click OK!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
		  $.ajax({
				type: 'POST',
				url: 'task_save.php',
				data: ajaxParameter,
				success:function(data){
					if(data == "success"){
						swal('Congratulations!', 'Task Accepted', 'success');
						window.location.href='task_asigner.php';
					}
				}
			});
	  } else {
		swal("Task not Accept.");
	  }
	});
	
})



  $(function () {
    $('#example1').DataTable({
		'paging'      : false,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : false,
		'info'        : true,
		'autoWidth'   : false
	})
    $('#example2').DataTable({
		'paging'      : false,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : false,
		'info'        : true,
		'autoWidth'   : false
    })
  })
</script>