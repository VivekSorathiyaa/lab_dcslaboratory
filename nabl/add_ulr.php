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
					ULR MASTER
						
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
							 <label>Ulr No:</label>
							 <input type="text" name="txt_ulr" id="txt_ulr" placeholder="Enter Ulr No">
							 </div>
							 <div class="col-md-4">
							 <button type="button" class="btn btn-info"  onclick="savedata('add_ulr')" name="btn_add_data_save" id="btn_add_data_save" style="width:20%;font-size:20px;" >Add</button>
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
function savedata(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_ulr') {
				var txt_ulr = $('#txt_ulr').val(); 
				
				if(txt_ulr == "")
				{
					alert("Enter Ulr No First");
				}else if(txt_ulr.length !=8){
					alert("Please Enter 8 Character Number");
				}
				else
				{
						
					billData = '&action_type='+type+'&txt_ulr='+txt_ulr;
						$.ajax({
							type: 'POST',
							url: '<?php $base_url; ?>save_ulr.php',
						    data: billData,
							beforeSend: function(){
								document.getElementById("overlay_div").style.display="block";
							},
							success:function(msg){
								document.getElementById("overlay_div").style.display="none";
								window.location.href="<?php echo $base_url; ?>ulr.php";				  
							}														
							});
				}
										
									
						
				}
				
    }
   




</script>