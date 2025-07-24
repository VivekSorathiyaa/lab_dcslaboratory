
<?php
session_start();
include("header.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

		if(isset($_GET['report_no'])){
			$report_no=$_GET['report_no'];

		}
		if(isset($_GET['job_no'])){
			$job_no=$_GET['job_no'];

		}


$serial="SELECT * FROM client ORDER BY client_id DESC";
$res = mysqli_query($conn, $serial);

if (mysqli_num_rows($res) > 0) {
	$r = mysqli_fetch_array($res);
	$ser_no=$r["client_code"]+1;
}else{
	$ser_no=1;
}

$today= date("Y-m-d");

//$job_serial="SELECT * FROM estimate_total_span_only_bill where job_no='$job_no' and report_no='$report_no' and est_isdeleted='0' and is_billing='1'";

$job_serial="SELECT * FROM estimate_total_span_only_bill where job_no='$job_no' and report_no='$report_no' and est_isdeleted='0'";
$job_res = mysqli_query($conn, $job_serial);

if (mysqli_num_rows($job_res) > 0) {
	$job_r = mysqli_fetch_array($job_res);

	$agency_id= $job_r["agency_id"];
	$total_amt= $job_r["total_amt"];

	$query_agency1="select * from agency_master where `agency_id`=".$agency_id;
	$result_agency1=mysqli_query($conn,$query_agency1);
	$row_result1=mysqli_fetch_array($result_agency1);
	$agencys =  $row_result1["agency_name"];

	$name_receiver= $job_r["name_receiver"];
	$mobileno= $job_r["mobileno"];
	$city= $job_r["city"];
	$chequeno= $job_r["chequeno"];
	$delivered_by= $job_r["delivered_by"];
	$c_charge= $job_r["c_charge"];
	$ch_date= $job_r["ch_date"];
	$iscorh= $job_r["iscorh"];
	$paytype= $job_r["paytype"];
	$rbt= $job_r["rbt"];
	$bill= $job_r["bill"];

}


?>

<?php

		if(isset($_POST["btn_save_job"]))
		{
			?>
			 <script>
			 alert("Bill And Report Deilvered Successfully.");
			 //window.location.href="<?php $base_url; ?>rec_bill_list.php";
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
.form-control {
font-size: 20px;;
}


</style>

<div class="content-wrapper" style="margin-left: 0px !important;">
	<!-- Content Header (Page header) -->
<?php
  $_SESSION['reporting_no']= $report_no;
  $_SESSION['jobing_no']= $job_no;
  ?>
	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row">

		<h1 style="text-align:center;">
		Bill And Report Delivery Form
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					    <div class="row">
									<div class="col-md-3">
										<input type="radio" class="col-sm-3" id="iscorh1" tabindex="0" name="iscorh" value="0" <?php if($iscorh == "0"){ echo "checked"; }?>>Hand To Hand
									</div>
									<div class="col-md-3">
										<input type="radio" class="col-sm-3 " id="iscorh2" tabindex="0" name="iscorh" value="1" <?php if($iscorh == "1"){ echo "checked"; }?>>Courier
									</div>
									<div class="col-md-6">
										<input type="text" class="col-sm-12 form-control" id="name_receiver" tabindex="1" name="name_receiver" placeholder="Enter Reveiver Name." value="<?php echo $name_receiver;?>"><span style="color:red;">*</span>
									</div>


					</div>
							<div class="row">
									<div class="col-md-4">
										<input type="text" class="col-sm-12 form-control" id="city" tabindex="2" name="city" placeholder="Enter City Name."  value="<?php echo $city;?>">
									</div>
									<div class="col-md-4">
										<input type="text" class="col-sm-12 form-control" id="mobileno" tabindex="3" name="mobileno" placeholder="Enter Mobile No." required value="<?php echo $mobileno;?>"><span style="color:red;">*</span>
									</div>

									<div class="col-md-4">
										<input type="text" class="col-sm-12 form-control" id="delivered_by" tabindex="5" name="delivered_by" placeholder="Delivery Person Name" value="<?php if($delivered_by !=  "" || $delivered_by != null
										)
										{
											echo $delivered_by;
										}
										else
										{
											echo $_SESSION['name'];
										}	?>" ><span style="color:red;">*</span>
									</div>

								</div>

								<hr style="border: 1px solid #ddd;">

								<div class="row">

									<div class="col-md-12">
													<label for="inputEmail3" class="control-label">BILL DETAILS</label>
												</div>

									</div>
									<div class="row">
												<div class="col-md-6">
													<input type="text" class="col-sm-12 form-control" id="report_no"  name="report_no" disabled value="<?php echo $report_no; ?>"><span style="color:red;">*</span>
												</div>

												<div class="col-md-6">
													<input type="text" class="col-sm-12 form-control" id="job_no"  name="job_no" disabled value="<?php echo $job_no; ?>"><span style="color:red;">*</span>
												</div>
									</div>
									<div class="row">
												<div class="col-md-6">
													<input type="text" class="col-sm-12 form-control" id="agency_name"  name="agency_name" disabled value="<?php echo $agencys; ?>">
												</div>

												<div class="col-md-6">
													<input type="text" class="col-sm-12 form-control" id="total_amt"  name="total_amt" disabled value="<?php echo $total_amt; ?>">
												</div>
									</div>
									<Br>
									<div class="row">
												<div class="col-md-1" >
													<input type="radio" class="col-sm-2" id="paytype0" tabindex="6" name="paytype" value="0" <?php if($paytype == "0"){ echo "checked"; }?> >CASH
												</div>
												<div class="col-md-1" >
													<input type="radio" class="col-sm-2" id="paytype1" tabindex="7" name="paytype" value="1" <?php if($paytype == "1"){ echo "checked"; }?>>CHEQUE
												</div>
												<div class="col-md-1" >
													<input type="radio" class="col-sm-2" id="paytype2" tabindex="8" name="paytype" value="2" <?php if($paytype == "2"){ echo "checked"; }?>>RTGS/NEFT
												</div>
												<div class="col-md-1" >
													<input type="radio" class="col-sm-2" id="paytype3" tabindex="9" name="paytype" value="3" <?php if($paytype == "3"){ echo "checked"; }?>>PENDING
												</div>

												<div class="col-md-4">
													<input type="text" class="col-sm-12 form-control" id="chequeno" tabindex="10" name="chequeno" placeholder="ENTER (CHEQUE NO / RTGS NO / NEFT NO)"  value="<?php echo $chequeno; ?>">
												</div>
												<div class="col-md-4">
													<input type="text" class="col-sm-12 form-control" id="ch_date" tabindex="11" name="ch_date" value="<?php if($ch_date !=  "" || $ch_date != null)
															{
																if($ch_date == "0000-00-00")
																{
																	echo date('d/m/Y');
																}
																else
																{
																echo date('d/m/Y',strtotime($ch_date));
																}
															}
															else
															{
																echo date('d/m/Y');
															}?>"  >
												</div>



								</div>
								<Br>
								<div class="row">
								<div class="col-md-12">
													<input type="text" class="col-sm-12 form-control" id="c_charge" tabindex="12" name="c_charge"  placeholder="ENTER COURIER CHARGE" value="<?php echo $c_charge; ?>">
												</div>
												</div>

								<div class="row">
								<div class="col-md-12">
													<input type="checkbox" class="col-sm-1" id="rbt" tabindex="13" name="rbt" <?php if($rbt == 1)
													{
														echo "checked";
													}
													else { echo ""; }?>>
													<span class="col-sm-2">REPORT</span>
													<input type="checkbox" class="col-sm-1" id="bill" tabindex="14" name="bill" <?php if($bill == 1)
													{
														echo "checked";
													}
													else { echo ""; }?>> <span class="col-sm-2">BILL</span>
												</div>
												</div>
								<hr width="80%">



							<div class="row">
									<div class="col-sm-4">
									</div>

									<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add')" style="margin-bottom:25px;    border-radius: 20px;"> SAVE</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>


									</div>

									<div class="col-sm-4">
									</div>
								</div>

								<div class="row">
									<div class="col-sm-4">
									</div>
									<div class="col-sm-4" style="text-align: center;">

										<a href="span_set_rate_final_bill.php?report_no=<?php echo $report_no;?>&&job_no=<?php echo $job_no;?>" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-question-list"></span> Edit Bill</a>


										<a href="span_bill_print_final_bill.php?report_no=<?php echo $report_no;?>&&job_no=<?php echo $job_no;?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print Bill</a>

									<?php if($rbt == 1 && $bill == 1){?>
													<a href="download_data.php?report_no=<?php echo $report_no;?>&&job_no=<?php echo $job_no;?>" class="btn btn-danger btn-lg btn3d" title="GENRATE REPORTS"><span class="glyphicon glyphicon-question-ok"></span>REPORTS</a>

												<?php
													}
												?>
									</div>
									<div class="col-sm-4">
									</div>
								</div>


						</form>
					</div>

					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
</section>
</div>
</div>


<?php include("footer.php");?>
<script>

 $('#ch_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	})

  $(function () {
    $('.select2').select2();
  });
$(document).ready(function()
	{


	 $("#iscorh1, #iscorh2").change(function () {
        if ($("#iscorh1").is(":checked")) {
			$('#c_charge').hide();
        }
        else if ($("#iscorh2").is(":checked")) {
            $('#c_charge').show();
        }

    });

	$("#paytype0, #paytype1, #paytype2, #paytype3").change(function () {
        if ($("#paytype0").is(":checked")) {
			$('#ch_date').hide();
			$('#chequeno').hide();
        }
        else if ($("#paytype1").is(":checked")) {
            $('#ch_date').show();
			$('#chequeno').show();
        }
		else if ($("#paytype2").is(":checked")) {
            $('#ch_date').show();
			$('#chequeno').show();
        }
		else if ($("#paytype3").is(":checked")) {
           $('#ch_date').hide();
			$('#chequeno').hide();
        }

    });

	});

// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {
				var report_no = $('#report_no').val();
				var job_no = $('#job_no').val();
				var corh =$('#iscorh1').prop('checked');
				if(corh==true)
				{
					var iscorh = "0";
					var c_charge = "0";
				}
				else
				{
					var iscorh = "1";
					var c_charge = $('#c_charge').val();
				}

				var pay0 =$('#paytype0').prop('checked');
				var pay1 =$('#paytype1').prop('checked');
				var pay2 =$('#paytype2').prop('checked');
				var pay3 =$('#paytype3').prop('checked');

				var paytype = "3";
				var chequeno = "";
				var ch_date = "00/00/0000";
				if(pay0==true)
				{
					var paytype = "0";
					var chequeno = "";
					var ch_date = "00/00/0000";
				}
				else if(pay1==true)
				{
					var paytype = "1";
					var chequeno = $('#chequeno').val();
					var ch_date = $('#ch_date').val();
				}
				else if(pay2==true)
				{
					var paytype = "2";
					var chequeno = $('#chequeno').val();
					var ch_date = $('#ch_date').val();
				}
				else if(pay3==true)
				{
					var paytype = "3";
					var chequeno = "";
					var ch_date = "00/00/0000";
				}

				var rbt0 =$('#rbt').prop('checked');
				if(rbt0==true)
				{
					var rbt = "1";
				}
				else
				{
					var rbt = "0";
				}

				var bill0 =$('#bill').prop('checked');
				if(bill0==true)
				{
					var bill = "1";
				}
				else
				{
					var bill = "0";
				}

				var name_receiver = $('#name_receiver').val();
				var mobileno = $('#mobileno').val();
				var city = $('#city').val();

				var delivered_by = $('#delivered_by').val();


			if(mobileno != "" && name_receiver != "" && delivered_by != "")
				{
				billData = '&action_type='+type+'&report_no='+report_no+'&job_no='+job_no+'&iscorh='+iscorh+'&paytype='+paytype+'&name_receiver='+name_receiver+'&mobileno='+mobileno+'&city='+city+'&chequeno='+chequeno+'&ch_date='+ch_date+'&delivered_by='+delivered_by+'&c_charge='+c_charge+'&rbt='+rbt+'&bill='+bill;
				}
				else{
					swal(
						  'Oops...',
						  'Please Fill all Required field!',

						)
				return false;

				}


	}
	/*else{


				billData = 'action_type='+type+'&id='+id;
    }
	*/


    $.ajax({
        url : "<?php $base_url; ?>saveDeilivery.php",
		type: "POST",
		dataType:'JSON',
		data : billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(data){
			document.getElementById("overlay_div").style.display="none";
			alert("Delivery Data Is Successfully Saved");
		    window.location.href="<?php $base_url; ?>dilevery_detail.php?report_no="+report_no+"&&job_no="+job_no;

        }
    });
  }
</script>
