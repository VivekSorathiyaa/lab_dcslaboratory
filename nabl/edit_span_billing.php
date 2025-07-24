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

<?php
$get_id= $_GET["id"];
$sel_bill="select * from span_bill where `id`=".$get_id;
$query_bill=mysqli_query($conn,$sel_bill);
$get_bill= mysqli_fetch_array($query_bill);

$date_explode=explode("-",$get_bill["billdate"]);

$billdate=  $date_explode[2]."/".$date_explode[1]."/".$date_explode[0];
$bill_month=$get_bill["month"];
$bill_no=$get_bill["billno"];
$bill_div=$get_bill["division"];
$bill_sub_div=$get_bill["subdivision"];
$nameofwork=$get_bill["nameofwork"];
$billnet=$get_bill["billnet"];
$sgst=$get_bill["sgst"];
$cgst=$get_bill["cgst"];
$igst=$get_bill["igst"];
$gst_types=$get_bill["rbt"];
$billtotal=$get_bill["billtotal"];
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
					Span Billing
						
					</h1>
				</div>
				<a class="btn btn-primary" href="span_billing_listing.php">Bill List</a>
			<hr style="border: 1px solid;">
			<br>
			<div class="row" style="margin: 0px 0px 0px 0px;">
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Bill Date:</label>
				</div>
				<div class="col-md-3">
					<input type="text" name="billdate" id="billdate" class="form-control" placeholder="Bill Date" value="<?php echo $billdate;?>">
				</div>
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Bill Month:</label>
				</div>
				<div class="col-md-3">
					<input type="text" name="billmonth" id="billmonth" class="form-control" placeholder="Bill Month" disabled value="<?php echo $bill_month;?>">
				</div>
				
				<div class="col-md-1">
					<label for="inputEmail3" class="control-label">Bill No:</label>
				</div>
				<div class="col-md-3">
					<input type="text" name="billno" id="billno" class="form-control" placeholder="Bill No" value="<?php echo $bill_no;?>">
				</div>
			</div>
			
	  <br>
	  <div class="row" style="margin: 0px 0px 0px 0px;">
	  
	  
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Division:</label>
		</div>
		<div class="col-md-5">
			<input type="text" name="division" id="division" class="form-control" placeholder="Division" value="<?php echo $bill_div;?>">
		</div>
		
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Sub Division:</label>
		</div>
		<div class="col-md-5">
			<input type="text" name="subdivision" id="subdivision" class="form-control" placeholder="Sub Division" value="<?php echo $bill_sub_div;?>">
		</div>
	  

	  
	  </div>
	  <br>
	  <div class="row" style="margin: 0px 0px 0px 0px;">
	  
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Name Of Work:</label>
		</div>
		<div class="col-md-11">
			<textarea id="editor1"  name="editor1">
			<?php echo $nameofwork;?>
			</textarea>
		</div>
		
	  </div>
	  
	  <br>
	  <div class="row" style="margin: 0px 0px 0px 0px;">
	  
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Bill Amount:</label>
		</div>
		<div class="col-md-5">
			<input type="text" name="billamt" id="billamt" class="form-control" placeholder="Bill Amount" value="<?php echo $billnet;?>">
		</div>
		
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Type:</label>
		</div>
		<div class="col-md-5">
			<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if($gst_types=="with_gst"){ echo "checked";}?>><span style="font-size:20px;" ><b>With GST</b></span>
	  <input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst" <?php if($gst_types=="without_gst"){ echo "checked";}?>><span style="font-size:20px;"><b>Without GST<b></span>
	  <input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst" <?php if($gst_types=="with_igst"){ echo "checked";}?>><span style="font-size:20px;"><b>With IGST<b></span>
		</div>
	
	  </div>
	  
	  <br>
	  <div class="row" style="margin: 0px 0px 0px 0px;">
	  
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Cgst Amount:</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="cgst" id="cgst" class="form-control" placeholder="Cgst Amout" value="<?php echo $cgst;?>">
		</div>
		
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Sgst Amount:</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="sgst" id="sgst" class="form-control" placeholder="Sgst Amout" value="<?php echo $sgst;?>">
		</div>
		
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Igst Amount:</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="igst" id="igst" class="form-control" placeholder="Igst Amout" value="<?php echo $igst;?>">
		</div>
		
		<div class="col-md-1">
			<label for="inputEmail3" class="control-label">Total Amount:</label>
		</div>
		<div class="col-md-2">
			<input type="text" name="total_amt" id="total_amt" class="form-control" placeholder="Total Amout" value="<?php echo $billtotal;?>">
		</div>
			<input type="text" name="hidden_id" id="hidden_id"  value="<?php echo $_GET['id'];?>">
	  </div>
	   <br>
	   <br>
	   <br>
	   <div class="row">
	    <div class="col-md-12" style="text-align:center;">
	    <button type="button" class="btn btn-info" id="btn_add_data" onclick="addData('edit')" name="btn_add_data" id="btn_add_data" tabindex="25" >Save</button>
		</div>
	    </div>
		<br>
	   <br>
	   <br>
	  </div>
			<!-- /.row -->
		</section>
	</div>
<?php 
include("footer.php");
?>	
<script>
$(document).ready(function(){
	
	var currentDate = new Date();
	var day = currentDate.getDate();
	var month = currentDate.getMonth() + 1;
	var year = currentDate.getFullYear();
	var today_dates= day + "/" + month + "/" + year;
	
	var monthsinv = ["January", "February", "March", "April", "May", "June",
           "July", "August", "September", "October", "November", "December"];
	var monthsainvo = monthsinv[(today_dates.split('/')[1]-1)];
		
	 $('#billmonth').val(monthsainvo);
	 $('#billmonth').val(monthsainvo);

})
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
  
  $('#billdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	
$('#billdate').datepicker().on("change", function() {
		
		var ref_inv = $('#billdate').val();
		var monthsinv = ["January", "February", "March", "April", "May", "June",
           "July", "August", "September", "October", "November", "December"];
		var monthsainvo = monthsinv[(ref_inv.split('/')[1]-1)];
		
		 $('#billmonth').val(monthsainvo);
	});
	

$("input[name='gst_type']").change(
    function(e)
    {
		
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var bill_amt=$('#billamt').val();
		if(bill_amt==""){
			alert("Fill Bill Amounty First");
			return false;
		}
		billData = '&action_type=set_rate_by_gst&gst_type='+gst_type+'&bill_amt='+bill_amt;			
   
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_billing_save.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          
		  $('#cgst').val(msg.cgst_amt);
		  $('#sgst').val(msg.sgst_amt);
		  $('#igst').val(msg.igst_amt);
		  $('#total_amt').val(msg.final_amt);
		  
        }
    });
		
});

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';
    if (type == 'edit') {
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
				var hidden_id = $('#hidden_id').val();
				
				if(billamt!=""){
				billData = '&action_type='+type+'&billdate='+billdate+'&billmonth='+billmonth+'&billno='+billno+'&division='+division+'&subdivision='+subdivision+'&txtarea_work='+txtarea_work+'&billamt='+billamt+'&gst_type='+gst_type+'&cgst='+cgst+'&sgst='+sgst+'&igst='+igst+'&total_amt='+total_amt+'&hidden_id='+hidden_id;
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