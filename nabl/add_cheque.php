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


.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;
}

</style>
<div class="content-wrapper" style="margin-left: 0px !important;">
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					Add Cheque
						
					</h1>
				</div>
				<a class="btn btn-primary" href="cheque_bill_listing.php">Cheque Bill List</a>
			<hr style="border: 1px solid;">
			<br>
			<div class="row" style="margin: 0px 0px 0px 0px;">
				
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Cheque No:</label>
				</div>
				<div class="col-md-2">
					<input type="text" name="chequeno" id="chequeno" class="form-control" placeholder="Cheque No" >
				</div>
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Cheque Date:</label>
				</div>
				<div class="col-md-2">
					<input type="text" name="chequedate" id="chequedate" class="form-control" placeholder="Cheque Date" value="<?php echo date('d/m/Y');?>">
				</div>
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Cheque Amount:</label>
				</div>
				<div class="col-md-2">
					<input type="text" name="chequeamt" id="chequeamt" class="form-control" placeholder="Cheque Amount">
				</div>
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Division:</label>
				</div>
				<div class="col-md-2">
					<select name="sel_division" id="sel_division" class="form-control">
			<option value="">Select Division</option>
			<?php
			$sel="select * from division";
			$querys=mysqli_query($conn,$sel);
			if(mysqli_num_rows($querys)> 0){
			while($gets=mysqli_fetch_array($querys)){
			?>
			<option value="<?php echo $gets['div_id'];?>"><?php echo $gets['div_name'];?></option>
			<?php
			}}
			?>
			</select>
				</div>
			</div>
		<br>
	   <!--<div class="row">
	    <div class="col-md-12" style="text-align:center;">
	    <button type="button" class="btn btn-info" id="btn_add_data" onclick="addData('add')" name="btn_add_data" id="btn_add_data" tabindex="25" >Save</button>
		</div>
	    </div>-->
		<hr style="border-top: 1px solid;">
		<br>
		<div id="display_data">
			
		</div>
		<hr style="border-top: 1px solid;">
		<br>
		<div id="display_data_final">
			
		</div>
	  </div>
			<!-- /.row -->
		</section>
	</div>
<?php 
include("footer.php");
?>	
<script>
$(document).ready(function(){
	
	$('#chequedate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })

});
	$(document).on("click","#btn_update_data",function(){
			var arr = new Array();

		  $(".checkbox_bill:checked").each(function () {
			arr.push($(this).attr("rel"));
		  });
		  if (arr.length == 0) {
			  alert("Select bill first");
			return false;
		}
		  
		$.ajax
		({
			type: 'POST',
			url: '<?php echo $base_url; ?>span_billing_save.php',
			data: 'action_type=sel_division_final&arr='+arr,
			success:function(html)
			{
				$('#display_data_final').html(html);
				$('#display_data').hide();

			}
		});	
	});
	
	  $('#tds').on('change', function (e)
		{
			var bill_total_hidden = $('#bill_total_hidden').val();
			alert(bill_total_hidden);
		});
   $('#sel_division').on('change', function (e)
	{
		var division_value = $(e.target).val();
		$.ajax
		({
			type: 'POST',
			url: '<?php echo $base_url; ?>span_billing_save.php',
			data: 'action_type=sel_division&division_value='+division_value,
			success:function(html)
			{
				$('#display_data').show();
				$('#display_data').html("");
				$('#display_data_final').html("");
				$('#display_data').html(html);

			}
		});	
	});
	// on click main save bill button
	$(document).on("click","#btn_save_main_bills",function(){
	
		var counting=1;
		var bill_ids=[];
		var tds_amts=[];
		var final_amts=[];
		
		var chequeno=$("#chequeno").val();
		var chequedate=$("#chequedate").val();
		var chequeamt=$("#chequeamt").val();
		var main_division_id=$("#sel_division").val();
		
		$(".bill_class").each(function () {
			bill_ids.push($(this).val());
			
			var set_tds_id="#tds_"+counting;
			var set_final_bill_amt_id="#final_bill_amount_"+counting;
			
			tds_amts.push($(set_tds_id).val());
			final_amts.push($(set_final_bill_amt_id).val());
			
		  counting++;
		  });
		  var postData = 'action_type=save_main_bill_in_db&bill_ids='+bill_ids+'&tds_amts='+tds_amts+'&final_amts='+final_amts+'&chequeno='+chequeno+'&chequedate='+chequedate+'&chequeamt='+chequeamt+'&main_division_id='+main_division_id;
		 
		$.ajax
		({
			type: 'POST',
			url: '<?php echo $base_url; ?>span_billing_save.php',
			data: postData,
			success:function(html)
			{
			
				alert("successfully");
				window.location.href="<?php echo $base_url; ?>add_cheque.php";

			}
		});	
	});
	
	
	
  $('#billdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	
	
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    if (type == 'add') {
				var billdate = $('#billdate').val(); 
				var billmonth = $('#billmonth').val(); 
				var billno = $('#billno').val(); 
				var division = $('#division').val(); 
				var subdivision = $('#subdivision').val(); 
				var txtarea_work =CKEDITOR.instances.editor1.getData();
				var billamt = $('#billamt').val(); 
				var gst_type = $("input[name='gst_type']:checked").val();
				var cgst = $('#cgst').val(); 
				var sgst = $('#sgst').val(); 
				var igst = $('#igst').val(); 
				var total_amt = $('#total_amt').val();
				
				if(billamt!=""){
				billData = '&action_type='+type+'&billdate='+billdate+'&billmonth='+billmonth+'&billno='+billno+'&division='+division+'&subdivision='+subdivision+'&txtarea_work='+txtarea_work+'&billamt='+billamt+'&gst_type='+gst_type+'&cgst='+cgst+'&sgst='+sgst+'&igst='+igst+'&total_amt='+total_amt;
				}else{
					alert("Filled Are Required..");
					return false;
				}
	            
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_billing_save.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){ 
		document.getElementById("overlay_div").style.display="none";
		
		window.location.href="<?php echo $base_url; ?>span_billing_listing.php";
	
		}
    });
}
		
 
</script>