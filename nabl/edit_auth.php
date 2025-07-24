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

$ids=base64_decode($_GET["auth_ids"]);

$sel_ulr="select * from sign_authority where `id`=".$ids;
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
					SIGN AUTHORITY
						
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
							 <label>Authority Name:</label>
							 <input type="text" name="auth_name" id="auth_name" placeholder="Enter Authority Name" value="<?php echo $get_ulrs['auth_name'];?>">
							  <input type="hidden" name="" id="txt_ids"  value="<?php echo $get_ulrs['id'];?>">
							 </div>
							 <div class="col-md-2">
							 <label>Authority Designation:</label>
							 <input type="text" name="auth_designation" id="auth_designation" placeholder="Enter Designation" value="<?php echo $get_ulrs['auth_designation'];?>">
							 </div>
							 
							 <div class="col-md-4">
							 <button type="button" class="btn btn-info"  onclick="savedata('update_auth')" name="btn_add_data_save" id="btn_add_data_save" style="width:20%;font-size:20px;" >Update</button>
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
    if (type == 'update_auth') {
				var auth_name = $('#auth_name').val(); 
				var auth_designation = $('#auth_designation').val(); 			
				var txt_ids = $('#txt_ids').val(); 
				
				
				if(auth_name == "" && auth_designation == "")
				{
					alert("Fill All Field..");
				}
				else
				{
						
					billData = '&action_type='+type+'&auth_name='+auth_name+'&auth_designation='+auth_designation+'&txt_ids='+txt_ids;
						$.ajax({
							type: 'POST',
							url: '<?php $base_url; ?>save_sign_auth.php',
						    data: billData,
							beforeSend: function(){
								document.getElementById("overlay_div").style.display="block";
							},
							success:function(msg){
								document.getElementById("overlay_div").style.display="none";
								window.location.href="<?php echo $base_url; ?>sign_auth.php";				  
							}														
							});
				}
										
									
						
				}
				
    }
   




</script>