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



.btn-warning {
    box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#f0ad4e;
}


.form-control {
font-size: 16px;;
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
		DELETED JOB LIST
		</h1>
		</div>
		<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">

				<!-- /.box-header -->


						<div class="box-body">
						<div id="display_data_third">
								<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Reference No</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from save_material_assign WHERE `is_deleted`=1 AND `isstatus`=2 AND `created_by`='$_SESSION[u_id]'  ORDER BY sm_id DESC";

										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
										$query_ref_no="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$row[trf_no]'";
										$result_ref_no=mysqli_query($conn,$query_ref_no);
										$row_ref_no=mysqli_fetch_array($result_ref_no);

										$sel_agency_id=$row_ref_no["agency"];
										$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
										$result_agency =mysqli_query($conn,$sel_agency);
										$row_agency =mysqli_fetch_array($result_agency);
										$agency_name=$row_agency["agency_name"];

									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_ref_no['refno'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="text-align:center;">
											<a href="edit_span_material_assigning.php?trf_no=<?php echo $row['trf_no'];?>" class="btn btn-primary btn-lg btn3d">EDIT</a>

											&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d use_the_job" data-id="<?php echo $row['sm_id']."|".$row['trf_no']."|".$row['job_no'];?>" title="" ><span class="glyphicon glyphicon-question-ok"></span> USE</a>
											</td>
										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>

							</div>


						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>
</div>

<?php include("footer.php");?>

<script>
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );

	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );

	var table = $('#example3').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );
 } );

	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	})

	$(function () {
		$('.select2').select2()
	})
</script>
<script>








	$(document).on("click", ".send_to_perfoma", function () {
				var clicked_id = $(this).attr("data-id");
				var split_clicked= clicked_id.split("|");

	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Perfoma?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_to_perfoma&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
		}
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});



function get_save_material(){

    $.ajax({
        type: 'POST',
		dataType:'JSON',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_jobing_after_send_perfoma',
        success:function(html){
            $('#display_data_second').html(html.for_update_part);
            $('#display_data_third').html(html.for_perfoma_part);
        }
    });
}

//Work FOr Send Estimate to lab
 $(document).on("click", ".send_to_lab", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Submit?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_estimate_to_lab&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

 $(document).on("click", ".reward_save_material", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Reward To Update?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=reward_save_material&clicked_id='+clicked_id,
        success:function(html){
			get_save_material();
        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

 $(document).on("click", ".use_the_job", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Use This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=use_the_job&clicked_id='+clicked_id,
        success:function(html){
		window.location.href="<?php echo $base_url; ?>deleted_job_list_for_reception.php";

        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});


</script>
