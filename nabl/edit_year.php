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

$ids=base64_decode($_GET["year_ids"]);

$sel_ulr="select * from fyearmaster where `id`=".$ids;
$result_of_ulr=mysqli_query($conn,$sel_ulr);
$get_ulrs=mysqli_fetch_array($result_of_ulr);
?>



<style>
/* required style*/ 
.none{display: none;}

/* optional styles */
table tr th, table tr td{font-size: 1.2rem;}

.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;}


</style>
	<div class="content-wrapper" style="margin-left: 0px !important;">
		
		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					YEAR MASTER
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default citys-content">
							
							<div class="row">
							 <div class="col-md-2">
							 <label>Year Name:</label>
							 <input type="text" name="txt_year" id="txt_year" placeholder="Enter Year Name" value="<?php echo $get_ulrs['fy_name'];?>">
							 <input type="hidden" name="" id="txt_ids"  value="<?php echo $get_ulrs['id'];?>">
							 </div>
							 <div class="col-md-4">
								<label>Start Date</label><br>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="start_date" name="start_date" value="<?php echo $get_ulrs['fy_startdate'];?>">
									</div>
							 </div>
							 <div class="col-md-4">
								<label>End Date</label><br>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="end_date" name="end_date" value="<?php echo $get_ulrs['fy_enddate'];?>">
									</div>
							 </div>
							 <div class="col-md-4">
							 <button type="button" class="btn btn-info"  onclick="savedata('update_year')" name="btn_add_data_save" id="btn_add_data_save" style="width:20%;font-size:20px;" >Update</button>
							 </div>
							</div>
						</div>
					</div>
					<!-- /.box -->
				</div>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>

<?php 
include("footer.php");

//include("connection.php");

?>
<script>
$('#start_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
$('#end_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
function savedata(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'update_year') {
				var txt_year = $('#txt_year').val(); 
				var txt_ids = $('#txt_ids').val(); 
				var start_date = $('#start_date').val(); 
				var end_date = $('#end_date').val(); 
				
				if(txt_year == "")
				{
					alert("Enter Year First");
				}
				else
				{
						
					billData = '&action_type='+type+'&txt_year='+txt_year+'&start_date='+start_date+'&end_date='+end_date+'&txt_ids='+txt_ids;
						$.ajax({
							type: 'POST',
							url: '<?php $base_url; ?>save_year.php',
						    data: billData,
							beforeSend: function(){
								document.getElementById("overlay_div").style.display="block";
							},
							success:function(msg){
								document.getElementById("overlay_div").style.display="none";
								window.location.href="<?php echo $base_url; ?>year.php";				  
							}														
							});
				}
										
									
						
				}
				
    }
   




</script>