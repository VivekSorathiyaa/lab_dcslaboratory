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
		LIST OF TRF  
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
						<div id="display_data_report">
								<div class="row">
								<div class="col-xs-3">
									<?php
										
										$chk_array=explode(",",$_GET["chk_array"]);
										foreach($chk_array as $one_chk_array)
										{?>
											
												<a href="print_trf.php?trf_no=<?php echo $one_chk_array;?>&&job_no=<?php echo $one_chk_array;?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-list-alt"></span> TRF OF <?php echo $one_chk_array;?> NO</a>
											&nbsp;
											
											
									<?php
										}	
									?>
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
