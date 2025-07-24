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
		LIST OF BILL REGISTER
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
						<div id="display_data_report" style="height: 200px;">
								<div class="row">
									<div class="col-md-2">
										
									</div>
									<div class="col-md-3">
										<?php
											$count=0;
										$query="select count(*) as cntperforma from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='1' ORDER BY est_id";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
											$row_performa=mysqli_fetch_array($result)
										?>
										<a href="list_of_perfoma_register.php" class="btn btn-success btn-lg btn3d" title="PERFOMA REGISTER"><span class="glyphicon glyphicon-list-alt"></span> PERFOMA REGISTER (<?php echo $row_performa['cntperforma'];?>)</a>
										<?php
										}
										else
										{?>
										<a href="list_of_perfoma_register.php" class="btn btn-success btn-lg btn3d" title="PERFOMA REGISTER"><span class="glyphicon glyphicon-list-alt"></span> PERFOMA REGISTER (0)</a>
										<?php 
										}
										?>
									</div>
									<div class="col-md-3">
										<?php
										
										$query1="select count(*) as cntbill from estimate_total_span_bill_sequence WHERE `is_deleted`=0 ORDER BY bill_id";
										$result1=mysqli_query($conn,$query1);
										if(mysqli_num_rows($result1)>0)
										{
											$row_performa1=mysqli_fetch_array($result1)
										?>
										<a href="list_of_invoice_register.php" class="btn btn-success btn-lg btn3d" title="INVOICE REGISTER"><span class="glyphicon glyphicon-list-alt"></span> INVOICE REGISTER (<?php echo $row_performa1['cntbill'];?>)</a>
										<?php
										}
										else
										{?>
										<a href="list_of_invoice_register.php" class="btn btn-success btn-lg btn3d" title="INVOICE REGISTER"><span class="glyphicon glyphicon-list-alt"></span> INVOICE REGISTER (0)</a>
										<?php 
										}
										?>
										
									</div>
									<div class="col-md-3">
										<?php
										
										$query2="select count(*) as cntesti from estimate_total_span_only_for_estimate WHERE `est_isdeleted`=0 ORDER BY est_id";
										$result2=mysqli_query($conn,$query2);
										if(mysqli_num_rows($result2)>0)
										{
											$row_performa2=mysqli_fetch_array($result2)
										?>
										<a href="list_of_estimate_register.php" class="btn btn-success btn-lg btn3d" title="ESTIMATE REGISTER"><span class="glyphicon glyphicon-list-alt"></span> ESTIMATE REGISTER (<?php echo $row_performa2['cntesti'];?>)</a>
										<?php
										}
										else
										{?>
										<a href="list_of_estimate_register.php" class="btn btn-success btn-lg btn3d" title="ESTIMATE REGISTER"><span class="glyphicon glyphicon-list-alt"></span> ESTIMATE REGISTER (0)</a>
										<?php 
										}
										?>
										
									</div>
								
									<br>
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
