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
   
  
<section class="content"  style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
<?php include("menu.php") ?>
			
	<div class="row">
		
		<h1 style="text-align:center;">
		LIST OF CANCELATION
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
						<div id="display_data_report" style="height: 200px;">
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-2">
										<a href="list_of_completed_perfoma_for_biller_canceled.php" class="btn btn-danger btn-lg btn3d" title="CANCEL PERFOMA LIST"><span class="glyphicon glyphicon-list-alt"></span> PERFOMA CANCEL LIST</a>
									</div>
									<div class="col-md-2">
										<a href="list_of_final_bill_by_biller_canceled.php" class="btn btn-danger btn-lg btn3d" title=" CANCEL INVOICE LIST"><span class="glyphicon glyphicon-list-alt"></span> INVOICE CANCEL LIST</a>
									</div>
									
								</div>
								
							</div>
							
							
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>	
</div>
  
<?php include("footer.php");?>


</script>
