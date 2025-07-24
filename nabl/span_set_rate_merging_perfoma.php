<?php include("header.php"); ?>
<?php
if ($_SESSION['name'] == "") {
?>
    <script>
        window.location.href = "<?php echo $base_url; ?>index.php";
    </script>
<?php
}


$get_chk_array = explode(",", $_GET["chk_array"]);

$txt_trf_no = $get_chk_array[0];
$temporary_trf_no = $_GET["temporary_trf_no"];

$sel_job1 = "select * from job where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
$query_job1 = mysqli_query($conn, $sel_job1);
$result_job1 = mysqli_fetch_array($query_job1);
$txt_jobs = $result_job1["job_number"];


// to get job for agency id
$sel_job = "select * from job where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
$query_job = mysqli_query($conn, $sel_job);
$result_job = mysqli_fetch_array($query_job);
$get_agency_id = $result_job["agency"];
$agency_city = $result_job["agency_city"];
$clientnaming = $result_job["clientname"];
$clientid = $result_job["client_code"];
$nabl_type = $result_job["nabl_type"];
$branch_short_code=$result_job["branch_short_code"];

$sel_client_code = $result_job["billing_to_id"];
$sel_client = "select `clientname` from client where `client_code`='$sel_client_code'";
$result_client = mysqli_query($conn, $sel_client);
$row_client = mysqli_fetch_array($result_client);
$clientnaming = $row_client["clientname"];
$clientid = $row_client["billing_to_id"];

$sel_agency = "select * from agency_master where `isdeleted`=0 AND `agency_id`=" . $result_job["billing_to_id"];
$query_agency = mysqli_query($conn, $sel_agency);
$result_agency = mysqli_fetch_array($query_agency);
$get_agency_gst_no = $result_agency["agency_gstno"];
$agency_naming = $result_agency["agency_name"];
$agency_ids = $result_agency["agency_id"];
$perfoma_make_by = $result_agency["perfoma_make_by"];
$rate_by = $result_agency["rate_by"];

$sel_estimates = "select `bill_to_id` from estimate_total_span where `bill_to_id`='$agency_ids' ORDER BY `est_id` DESC";
$query_estimates = mysqli_query($conn, $sel_estimates);
if (mysqli_num_rows($query_estimates) > 0) {
    $result_estimates = mysqli_fetch_array($query_estimates);
    $get_rate_type = $result_estimates["rate_type"];
} else {
    $get_rate_type = "1";
}


$get_gst_type = "";
$get_c_gst_amt = "";
$get_s_gst_amt = "";
$get_i_gst_amt = "";
$get_grand_total = "";
$get_total_amount = "";
$get_total_amt_in_word = "";
//$get_total_amt = "";
$hsn_codes = "";
$estimate_perfoma_no = "";
$bill_to = $result_estimates["bill_to"];
$other_customer_name = "";
$other_customer_address = "";
$other_customer_gst_no = "";

$is_estimate_avail = "not_available";

$gst_in_or_ex = "";


// jo invoice date ma perfoma hoy to
$sel_estiamte_by_date = "SELECT * FROM estimate_total_span ORDER BY max_number DESC LIMIT 0,1";
$query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);


if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) {
    $result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
    $plus_squence = intval($result_estimate["max_number"]) + 1;
    $plused = sprintf('%04d', $plus_squence);
} else {
    $plused = "0001";
}
$set_perfoma_no = $perfoma_first_parts.$plused;

//get trf print also for biller view
$merge_upload_document = '';
foreach ($get_chk_array as $one_chk_array) {
    $sel_jobs_doc = "select * from `job` where `trf_no`='$one_chk_array'";
    $query_jobs_doc = mysqli_query($conn, $sel_jobs_doc);
    $result_jobs_doc = mysqli_fetch_array($query_jobs_doc);
    if ($result_jobs_doc["scan_document"] != "") {
        $merge_upload_document .= '<iframe src="' . $base_url . 'scan_document/' . $result_jobs_doc["scan_document"] . '" style="height:1120px;width:1105px;"></iframe>';
    }
}

$today = date("Y-m-d");
$sel_fy_years = "select * from fyearmaster where `id`='$_SESSION[fy_id]'";
$query_f_year = mysqli_query($conn, $sel_fy_years);
$result_f_year = mysqli_fetch_array($query_f_year);

$starting_date = date('Y-m-d H:i:s', strtotime($result_f_year["fy_startdate"]));


$end_year_date = date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));

if ($today < $end_year_date) {

    $ending_date = $today;
} else {
    $ending_date = date('Y-m-d H:i:s', strtotime($result_f_year["fy_enddate"]));
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

    <section class="content">
        <?php include("menu.php") ?>
        <div class="row">
            <h1 style="text-align:center;">
                Proforma
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body" style="border:1px groove #ddd;">
                        <br>
                        <div class="row">
                            <div class="col-sm-1">
                                <label for="inputEmail3" class="control-label">Bill To:</label>
                            </div>
                            <div class="col-sm-6">
                                <!--<input type="radio" style="width:20px;height:10px;" name="txt_bill_to" value="0" checked><span style="font-size:14px;" ><b>Agency (<?php //echo $agency_naming;
                                                                                                                                                                        ?>)</b></span>-->
                                <input type="radio" style="width:20px;height:10px;" name="txt_bill_to" value="1" checked><span style="font-size:14px;"><b>Client (<?php echo $agency_naming; ?>)<b></span>
                                <!--<input type="radio" style="width:20px;height:10px;"name="txt_bill_to" value="2"><span style="font-size:14px;"><b>Other<b></span>-->

                                <input type="hidden" name="" value="<?php echo $agency_ids; ?>" id="bill_to_id">
                                <input type="hidden" name="" value="<?php echo $agency_naming; ?>" id="bill_to_name">
                                <input type="hidden" name="" value="<?php echo $branch_short_code; ?>" id="branch_short_code">
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <a href="JavaScript:void(0)" class="put_iframe_in_modal btn btn-success" data-id='<?php echo $merge_upload_document; ?>' data-toggle='modal' data-target='#myModal' title='Add field'><b>VIEW UPLOADED DOCUMENT</b></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row" id="bill_to_hide_show" style="<?php if ($bill_to != "2") {
                                                                            echo "display:none";
                                                                        } else {
                                                                            echo "display:block";
                                                                        } ?>">


                            <div class="col-md-1">
                                <label for="inputEmail3" class="control-label">Customer Name:</label>
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="other_customer_name" class="form-control" id="other_customer_name" value="<?php echo $other_customer_name; ?>">
                            </div>

                            <div class="col-md-1">
                                <label for="inputEmail3" class="control-label">Customer Address:</label>
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="other_customer_address" class="form-control" id="other_customer_address" value="<?php echo $other_customer_address; ?>">
                            </div>

                            <div class="col-md-1">
                                <label for="inputEmail3" class="control-label">Customer GSt No:</label>
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="other_customer_gst_no" class="form-control" id="other_customer_gst_no" value="<?php echo $other_customer_gst_no; ?>">
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="inputEmail3" class="col-md-12 control-label">Report No:</label>
                            </div>

                            <div class="col-md-2">
                                <label for="inputEmail3" class="col-md-12 control-label">Invoice Date:</label>
                            </div>

                            <div class="col-md-2">
                                <label for="inputEmail3" class="col-md-12 control-label">Rate:</label>
                            </div>

                            <div class="col-md-2">
                                <label for="inputEmail3" class="col-md-12 control-label">Gst No:</label>
                            </div>

                            <div class="col-md-2">
                                <label for="inputEmail3" class="col-md-12 control-label">Proforma No:</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="<?php echo $_GET['chk_array']; ?>" id="txt_trf_no" name="txt_trf_no" disabled>

                                <input type="hidden" class="form-control" value="<?php echo $txt_jobs; ?>" id="txt_job_no" name="txt_job_no" disabled>

                                <input type="hidden" class="form-control" value="<?php echo $txt_trf_no; ?>" id="txt_one_trf" name="txt_one_trf" disabled>

                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y') ?>">

                            </div>

                            <div class="col-md-2">
                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <select class="form-control " name="select_rate" id="select_rate">
                                            <option value="0" <?php if ($rate_by == "0") {
                                                                    echo "selected";
                                                                } ?>>Government</option>
                                            <option value="1" <?php if ($rate_by == "1") {
                                                                    echo "selected";
                                                                } ?>>Private</option>
                                            <option value="2" <?php if ($rate_by == "2") {
                                                                    echo "selected";
                                                                } ?>>Other</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <input type="text" class="form-control" name="gst_no" id="gst_no" value="<?php echo $get_agency_gst_no; ?>">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="perfoma_no" id="perfoma_no" value="<?php if ($estimate_perfoma_no != "") {
                                                                                                                        echo $estimate_perfoma_no;
                                                                                                                    } else {
                                                                                                                        echo $set_perfoma_no;
                                                                                                                    } ?>">
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="letter_heading" id="letter_heading" placeholder="Reference/PO/Letter">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="letter_nos" id="letter_nos" placeholder="Reference/PO/Letter NO">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="letter_dated" id="letter_dated" placeholder="Dated">
                            </div>
                            <div class="col-md-3">
                                <input type="radio" style="width:20px;height:10px;" name="txt_make_by" value="0" <?php if ($perfoma_make_by == "0") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>><span style="font-size:14px;"><b>By Test</b></span>
                                <input type="radio" style="width:20px;height:10px;" name="txt_make_by" value="1" <?php if ($perfoma_make_by == "1") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>><span style="font-size:14px;"><b>By Material<b></span>

                            </div>
                        </div>
                        <br>
                        <div class="panel-group">
                            <div class="box box-info">
                                <div class="row">
                                    <div class="col-md-3">&nbsp;</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <!--<div class="col-sm-12">
												<select class="form-control select2" name="select_material_category" id="select_material_category" >
													<option value="">Select Category</option>
													<?php
                                                    //$sql = "select * from material_category where `material_cat_status`='1' AND `material_cat_isdelete`='0'";

                                                    //$result = mysqli_query($conn, $sql);

                                                    //	if (mysqli_num_rows($result) > 0) {
                                                    //		while($row = mysqli_fetch_assoc($result)) {

                                                    ?>

													<option value="<?php //echo $row['material_cat_id']."|".$row['material_cat_name'];
                                                                    ?>"><?php //echo $row['material_cat_name'];
                                                                        ?></option>
													<?php //}}
                                                    ?>
												</select>
											</div>-->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!--<div class="form-group">

											<div class="col-sm-12">
											<select class="form-control select2" name="select_material" id="select_material">
													<option value="">Select Material</option>

												</select>
												<!--<a href="javascript:void(0)" id="get_more" class=" btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i></a>-->
                                        <!--<input type="hidden" value="20" id="get_more_count">
											</div>
										</div>-->
                                    </div>
                                    <div class="col-md-2">
                                        <!--<div class="form-group">
											<div class="col-sm-12">
												<select class="form-control" name="select_test" id="select_test">
												<option value="">Select Test</option>
												</select>
											</div>
										</div>-->
                                    </div>
                                    <div class="col-md-1">
                                        <!--<div class="form-group">
											<div class="col-sm-3">
												<a href="JavaScript:void(0)" class="add_button btn btn-primary" title="Add field" style=""><b>Add Test</b></a>
											</div>
										</div>-->
                                    </div>

                                </div>
                                <div class="box-body">
                                    <div class="table-responsive" id="display_data">
                                        <table class="table no-margin class_tr_put">
                                            <thead>
                                            </thead>
                                            <tbody id="put_design">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="box box-info p-20">
                            <input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="with_gst">
                            <input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value="exclude">

                            <div class="row" id="" style="">
                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Sub Total</label>
                                </div>


                                <div class="col-md-1">
                                    <input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $get_grand_total; ?>" disabled>
                                </div>


                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 1:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_one" placeholder="Charge 1">
                                </div>


                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 1 %:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_one_percentage" placeholder="Charge One Percentage" value="">
                                </div>


                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 1 Amount:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_one_amnt" placeholder="Charge One amount" value="" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 2:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_two" placeholder="Charge 2">
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 2 %:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_two_percentage" placeholder="Charge Two Percentage" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row" id="" style="">

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Charge 2 Amount:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_charge_two_amnt" placeholder="Charge Two amount" value="0" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Discount(%):</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_discount_percentage" placeholder="Discount Percentage" value="">
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Discount Amount:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_discount_amnt" class="form-control" id="txt_discount_amnt" value="0" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Taxable Amount:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_taxable" class="form-control" id="txt_taxable" value="" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Sgst:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt; ?>" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Cgst:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt; ?>" disabled>
                                </div>


                            </div>
                            <div class="row" id="" style="">
                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Igst:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt; ?>" disabled>
                                </div>

                                <div class="col-md-1">
                                    <label for="inputEmail3" class="control-label">Round Up:</label>
                                </div>

                                <div class="col-md-1">
                                    <input type="text" name="txt_round_up" class="form-control" id="txt_round_up" value="" disabled>
                                </div>


                            </div>

                        </div>
                        <div class="box box-info p-20">
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="inputEmail3" class="control-label">Total Amount In Word:</label>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if ($get_total_amt_in_word != "") {
                                                                                                                                    echo $get_total_amt_in_word;
                                                                                                                                } else {
                                                                                                                                    echo numtowords($get_total_amt);
                                                                                                                                } ?>" disabled>
                                </div>

                                <div class="col-md-2">
                                    <label for="inputEmail3" class="control-label">Total Amount:</label>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if ($get_total_amount != "") {
                                                                                                                        echo $get_total_amount;
                                                                                                                    } else {
                                                                                                                        echo $get_total_amt;
                                                                                                                    } ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id; ?>">
                            <input type="hidden" name="nabl_type" id="nabl_type" value="<?php echo $nabl_type; ?>">
                            <div class="row">
                                <div class="col-md-3">&nbsp;</div>
                                <div class="col-md-6">

                                    <button type="button" class="btn btn-info" onclick="addData('save_next_estimate_only_save')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:14px;display:none">Save By Test</button>

                                    <button type="button" class="btn btn-info" onclick="add_material('save_by_material')" name="btn_add_data_by_mate" id="btn_add_data_by_mate" style="width:150px;font-size:14px;display:none">Save By Material</button>

                                    <a href="matt_perfoma_bill_print.php?chk_array=<?php echo $get_estimate['trf_no']; ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:14px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>


                                </div>
                                <div class="col-md-3">&nbsp;</div>

                            </div>
                        </div>



                    </div>

                </div>
            </div>
    </section>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 100%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="display_data_for_update" style="text-align:center;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<?php include("footer.php"); ?>

<?php
function numtowords($num)
{
    $number = $num;
    $no = round($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        "." . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
    // return $result . "Rupees  " . $points;
    return $result . "Rupees  ";
}

?>
<script>
    $(document).ready(function() {
        var starting_date = '<?php echo $starting_date; ?>';
        var ending_date = '<?php echo $ending_date; ?>';

        var d = new Date(starting_date);

        var curr_date = d.getDate();
        var curr_month = d.getMonth() + 1; //Months are zero based
        var curr_year = d.getFullYear();
        var started_date = (curr_date + "/" + curr_month + "/" + curr_year);
        var d_one = new Date(ending_date);
        var curr_date1 = d_one.getDate();
        var curr_month1 = d_one.getMonth() + 1; //Months are zero based
        var curr_year1 = d_one.getFullYear();
        var ended_date = (curr_date1 + "/" + curr_month1 + "/" + curr_year1);

        $('#invoice_date').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            startDate: "'" + started_date + "'",
            endDate: "'" + ended_date + "'"
        });
        var maxField = 50; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.class_tr_put'); //Input field wrapper


        var count_of_append = 0;
        var x = 1; //Initial field counter is 1kkkkkkkkkkkk



        $(document).on("click", ".add_button", function(e) {
            count_of_append++;

            var select_material_category = $("#select_material_category").val();
            var select_material = $("#select_material").val();
            var select_test = $("#select_test").val();

            if (select_material_category == "") {
                alert("Select Category First...");
                return false;
            }
            if (select_material == "") {
                alert("Select Maerial First...");
                return false;
            }
            if (select_test == "") {
                alert("Select Test First...");
                return false;
            }

            var res_cates_id = select_material_category.split("|");
            var mat_cat_id = res_cates_id[0];
            var mat_cat_names = res_cates_id[1];

            var res_cates = select_material.split("|");
            var mat_id = res_cates[0];
            var mat_names = res_cates[1];

            var res_test = select_test.split("|");
            var test_id = res_test[0];
            var test_names = res_test[1];

            var fieldHTML = '<tr>';
            fieldHTML += '<td>';
            fieldHTML += '<input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_' + count_of_append + '" value="' + mat_cat_id + '">';
            fieldHTML += '<input type="text" name="mat_name[]" class="form-control class_mate_name" id="matename_' + count_of_append + '" value="' + mat_cat_names + '" disabled style="width:200px;font-weight:bold;">';
            fieldHTML += '</td>';

            //fieldHTML += '<tr>';

            fieldHTML += '<td>';
            fieldHTML += '<input type="hidden" name="test_id[]" class="class_test_id" id="testid_' + count_of_append + '" value="' + test_id + '">';
            fieldHTML += '<input type="text" name="test_name[]" class="form-control class_test" id="test_' + count_of_append + '" value="' + test_names + '" >';
            fieldHTML += '</td>';

            fieldHTML += '<td>';
            fieldHTML += '<input type="text" name="qty[]" class="form-control class_qty" id="qty_' + count_of_append + '" value="1">';
            fieldHTML += '</td>';

            fieldHTML += '<td>';
            fieldHTML += '<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_' + count_of_append + '" value="0">';
            fieldHTML += '</td>';

            fieldHTML += '<td>';
            fieldHTML += '<input type="text" name="amt[]" class="form-control class_amnt" id="amt_' + count_of_append + '" value="0" disabled>';
            fieldHTML += '</td>';

            fieldHTML += '<td>';
            fieldHTML += '<a href="JavaScript:void(0)" class="remove_button btn btn-primary" title="Remove field" style=""><b>X</b></a>';
            fieldHTML += '</td>';

            fieldHTML += '</tr>';


            var postData = 'action_type=insert_in_test_wise_table&p&select_material=' + select_material + '&select_test=' + select_test + '&mat_cat_id=' + mat_cat_id;

            $.ajax({
                url: "<?php $base_url; ?>save_span_set_rate_merging_perfoma.php",
                type: "POST",
                data: postData,
                dataType: 'JSON',
                success: function(data) {}
            });
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $('.class_tr_put').append(fieldHTML); //Add field html
            }

        });

        //Once remove button is clicked
        $(document).on('click', '.remove_button', function(e) {

            $(this).closest("tr").remove(); //Remove field html
            x--; //Decrement field counter

            var totals_amt_sum = 0;
            $('input[name=in_or_ex]').prop("checked", false);
            $('input[name=gst_type]').prop("checked", false);
            $('#hidden_gst_in_ex').val("");
            $('#hidden_gst_type').val("");
        });

        //get_table_after_update();
        on_loadings();
    });



    // on rate change

    $("#select_rate").change(function() {
        var select_rate = $('#select_rate').val();
        if (select_rate == "0") {
            $('#hidden_gst_in_ex').val("include");
            $('#txt_charge_one').val("");
            $('#txt_charge_two').val("");
            $('#txt_charge_one').attr('readonly', true);
            $('#txt_charge_two').attr('readonly', true);
            $('#txt_charge_one_percentage').val("0");
            $('#txt_charge_two_percentage').val("0");
            $('#txt_charge_one_percentage').attr('readonly', true);
            $('#txt_charge_two_percentage').attr('readonly', true);
            $('#txt_charge_one_amnt').val("0");
            $('#txt_charge_two_amnt').val("0");
        } else {
            $('#hidden_gst_in_ex').val("exclude");

            $('#txt_charge_one').attr('readonly', false);
            $('#txt_charge_two').attr('readonly', false);
            $('#txt_charge_one_percentage').attr('readonly', false);
            $('#txt_charge_two_percentage').attr('readonly', false);
        }
        on_loadings();
        get_table_after_update();
    });



    // on invoice_date change
    $(document).on("change", "#invoice_dateess", function() {
        var invoice_date = $('#invoice_date').val();
        var myDate = new Date('yyyy/mm/dd', invoice_date);
        var today = new Date();
        if (myDate > today) {
            alert("The date is wrong.");
            return false;
        }
        var postData = 'action_type=set_perfoma_no_by_invoice_date&invoice_date=' + invoice_date;

        $.ajax({
            url: "<?php $base_url; ?>save_span_set_rate_merging_perfoma.php",
            type: "POST",
            data: postData,
            dataType: 'JSON',
            success: function(data) {
                $('#perfoma_no').val(data.set_perfoma_no);

            }
        });
    });

    function get_table_after_update() {
        var billData = '';
        var gst_no = $('#gst_no').val();

        if (gst_no.indexOf("02") == 0) {
            $('#hidden_gst_type').val("with_gst");

        } else {

            $('#hidden_gst_type').val("with_igst");

        }


        var select_rate = $('#select_rate').val();
        var gst_type = $('#hidden_gst_type').val();
        //return false;
        var hidden_gst_in_ex = $('#hidden_gst_in_ex').val();
        var txt_charge_one_percentage = $('#txt_charge_one_percentage').val();
        var txt_charge_two_percentage = $('#txt_charge_two_percentage').val();
        var txt_discount_percentage = $('#txt_discount_percentage').val();
        var total_grand_amnt = 0;
        $(".class_amnt").each(function() {
            total_grand_amnt += parseInt($(this).val());

        });

        var send = gst_type + "|" + hidden_gst_in_ex + "|" + total_grand_amnt + "|" + txt_charge_one_percentage + "|" + txt_charge_two_percentage + "|" + txt_discount_percentage + "|" + select_rate;
        billData = '&action_type=get_table_after_update&id=' + send;

        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_set_rate_merging_perfoma.php',
            data: billData,
            dataType: 'JSON',
            success: function(msg) {
                //$('#display_data').html(msg.table_design);
				
                $('#txt_cgst').val(msg.cgst);
                $('#txt_sgst').val(msg.sgst);
                $('#txt_igst').val(msg.igst);
                $('#txt_grand').val(msg.grand_total);
                $('#txt_taxable').val(msg.taxable_amnt);
                $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
                $('#total_amt').val(msg.net_total);
                $('#txt_round_up').val(msg.round_off_total);
                $('#txt_charge_one_amnt').val(msg.charge_one_amnt);
                $('#txt_charge_two_amnt').val(msg.charge_two_amnt);
                $('#txt_discount_percentage').val(msg.txt_discount_percentage);
                $('#txt_discount_amnt').val(msg.discount_amnt);

            }
        });
    }

    $(document).on("change", "#txt_charge_one_percentage", function() {
        get_table_after_update();
    })
    $(document).on("change", "#txt_charge_two_percentage", function() {
        get_table_after_update();
    })
    $(document).on("blur", "#gst_no", function() {
        get_table_after_update();
    })
    $(document).on("change", "#txt_discount_percentage", function() {
        get_table_after_update();
    })
    // on rate change

    $(document).on("blur", ".txt_rate_class", function() {

        var get_rate = $(this).val();
        var get_id = $(this).attr("id");
        var split_data = get_id.split("_");
        var get_qty = $("#qty_" + split_data[1]).val();
        var txt_amnts = parseInt(get_rate) * parseInt(get_qty);

        $("#amt_" + split_data[1]).val(txt_amnts);
        // $('input[name=in_or_ex]').prop("checked", false);
        // $('#hidden_gst_in_ex').val("");
        get_table_after_update();
    });

    // on qty change

    $(document).on("blur", ".class_qty", function() {

        var get_qty = $(this).val();
        var get_id = $(this).attr("id");
        var split_data = get_id.split("_");
        var get_rate = $("#rate_" + split_data[1]).val();
        var txt_amnts = parseInt(get_rate) * parseInt(get_qty);

        $("#amt_" + split_data[1]).val(txt_amnts);
        // $('input[name=in_or_ex]').prop("checked", false);
        // $('#hidden_gst_in_ex').val("");
        get_table_after_update();
    });


    $(document).on("blur", ".class_material_rates", function() {

        var get_rate = $(this).val();
        var get_id = $(this).attr("id");
        var split_data = get_id.split("_");
        var get_qty = $("#materialqty_" + split_data[1]).val();
        var txt_amnts = parseInt(get_rate) * parseInt(get_qty);

        $("#materialtotals_" + split_data[1]).val(txt_amnts);
        // $('input[name=in_or_ex]').prop("checked", false);
        // $('#hidden_gst_in_ex').val("");
        get_table_after_update();
    });

    // on qty change

    $(document).on("blur", ".class_material_qty", function() {

        var get_qty = $(this).val();
        var get_id = $(this).attr("id");
        var split_data = get_id.split("_");
        var get_rate = $("#materialrating_" + split_data[1]).val();
        var txt_amnts = parseInt(get_rate) * parseInt(get_qty);

        $("#materialtotals_" + split_data[1]).val(txt_amnts);
        // $('input[name=in_or_ex]').prop("checked", false);
        // $('#hidden_gst_in_ex').val("");
        get_table_after_update();
    });

    $("input[name='gst_type']").change(
        function(e) {
            var gst_type = $('input[name=gst_type]:checked').val();
            $('input[name=in_or_ex]').prop("checked", false);
            var in_or_ex = "";
            if (gst_type == "with_gst") {
                $("#gst_hide_show").show();
                $('#hidden_gst_type').val("with_gst");
                $('#hidden_gst_in_ex').val("");
            } else if (gst_type == "with_igst") {
                $("#gst_hide_show").show();
                $('#hidden_gst_type').val("with_igst");
                $('#hidden_gst_in_ex').val("");
            } else {
                $("#gst_hide_show").hide();
                $('#hidden_gst_type').val("without_gst");
                $('#hidden_gst_in_ex').val("");
            }
            var txt_trf_no = $("#txt_trf_no").val();
            var total_grand_amnt = 0;
            $(".class_amnt").each(function() {
                total_grand_amnt += parseInt($(this).val());
            });
            var txt_job_no = $("#txt_job_no").val();
            var send = "0" + "|" + txt_trf_no + "|" + txt_job_no + "|" + gst_type + "|" + in_or_ex + "|" + total_grand_amnt;
            get_table_after_update();

        });

    $("input[name='txt_bill_to']").change(
        function(e) {
            var txt_bill_to = $('input[name=txt_bill_to]:checked').val();
            var txt_one_trf = $("#txt_one_trf").val();
            billData = '&action_type=on_bill_chages&txt_bill_to=' + txt_bill_to + '&txt_one_trf=' + txt_one_trf;
            $.ajax({
                type: 'POST',
                url: '<?php $base_url; ?>on_bill_to_changes.php',
                data: billData,
                dataType: 'JSON',
                success: function(msg) {
                    $('#gst_no').val(msg.set_gst_nos);
                    if (txt_bill_to == "2") {
                        $("#bill_to_hide_show").show();
                        $("#other_customer_name").val("");
                        $("#other_customer_address").val("");
                        $("#other_customer_gst_no").val("");
                    } else {
                        $("#bill_to_hide_show").hide();
                    }
                    $("#bill_to_id").val(msg.bill_to_id);
                    $("#bill_to_name").val(msg.bill_to_name);
                    if (msg.state_ids == "7") {
                        $("#hidden_gst_type").val("with_igst");

                    }
                    get_table_after_update();

                }
            });

        });

    $("input[name='in_or_ex']").change(
        function(e) {
            var gst_type = $('input[name=gst_type]:checked').val();
            var in_or_ex = $('input[name=in_or_ex]:checked').val();
            var txt_trf_no = $("#txt_trf_no").val();
            var txt_job_no = $("#txt_job_no").val();
            $('#hidden_gst_in_ex').val(in_or_ex);

            var total_grand_amnt = 0;
            $(".class_amnt").each(function() {
                total_grand_amnt += parseInt($(this).val());
            });
            var send = "0" + "|" + txt_trf_no + "|" + txt_job_no + "|" + gst_type + "|" + in_or_ex + "|" + total_grand_amnt;
            get_table_after_update();

        });

    // save By  test
    function addData(type, id) {
        id = (typeof id == "undefined") ? '' : id;
        var statusArr = {
            add: "added",
            edit: "updated",
            delete: "deleted"
        };
        var billData = '';
        if (type == 'save_next_estimate_only_save') {
            var txt_trf_no = $('#txt_trf_no').val();
            var txt_job_no = $('#txt_job_no').val();
            var invoice_date = $('#invoice_date').val();
            var gst_no = $('#gst_no').val();
            var select_rate = $('#select_rate').val();
            var hidden_gst_type = $('#hidden_gst_type').val();
            var hidden_gst_in_ex = $('#hidden_gst_in_ex').val();
            var txt_cgst = $('#txt_cgst').val();
            var txt_sgst = $('#txt_sgst').val();
            var txt_igst = $('#txt_igst').val();
            var txt_grand = $('#txt_grand').val();
            var txt_amt_in_word = $('#txt_amt_in_word').val();
            var total_amt = $('#total_amt').val();
            var perfoma_no = $('#perfoma_no').val();
            var hsn_codes = $('#hsn_codes').val();
            var txt_bill_to = $('input[name=txt_bill_to]:checked').val();
            var other_customer_name = $('#other_customer_name').val();
            var other_customer_address = $('#other_customer_address').val();
            var other_customer_gst_no = $('#other_customer_gst_no').val();
            var bill_to_id = $('#bill_to_id').val();
            var bill_to_name_f = $('#bill_to_name').val();
            var bill_to_name = bill_to_name_f.replace("&", "QQQ");
            var nabl_type = $('#nabl_type').val();
            var branch_short_code = $('#branch_short_code').val();

            if (gst_no == "") {
                alert("please Enter Gst First");
                return false;
            } else {

            }
            if (gst_no.length != 15) {
                if (gst_no != "02aaa") {
                    alert("Enter Gst No Properly...");
                    return false;
                } else {
					
				}
            }

            var test_ids_array = [];
            $(".class_test_id").each(function() {
                test_ids_array.push($(this).val());
            });

            var test_name_array = [];
            $(".class_test").each(function() {
                test_name_array.push($(this).val());
            });

            var test_qty_array = [];
            $(".class_qty").each(function() {
                test_qty_array.push($(this).val());
            });

            var test_rates_array = [];
            $(".txt_rate_class").each(function() {
                test_rates_array.push($(this).val());
            });

            var test_amnt_array = [];
            $(".class_amnt").each(function() {
                test_amnt_array.push($(this).val());
            });

            var test_mate_array = [];
            $(".class_mate_name").each(function() {
                test_mate_array.push($(this).val());
            });

            var test_mate_id_array = [];
            $(".class_mate_id").each(function() {
                test_mate_id_array.push($(this).val());
            });

            var test_trf_id_array = [];
            $(".class_trf_id").each(function() {
                test_trf_id_array.push($(this).val());
            });

            var hidden_agency = $('#hidden_agency').val();
            var letter_heading = $('#letter_heading').val();
            var letter_nos = $('#letter_nos').val();
            var letter_dated = $('#letter_dated').val();

            if (letter_heading != "" && letter_nos == "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_heading != "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_heading != "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_heading == "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_heading == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_heading == "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_heading == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }

            var txt_charge_one = $('#txt_charge_one').val();
            var txt_charge_one_percentage = $('#txt_charge_one_percentage').val();
            var txt_charge_two = $('#txt_charge_two').val();
            var txt_charge_two_percentage = $('#txt_charge_two_percentage').val();
            var txt_taxable = $('#txt_taxable').val();
            var txt_round_up = $('#txt_round_up').val();
            var txt_charge_one_amnt = $('#txt_charge_one_amnt').val();
            var txt_charge_two_amnt = $('#txt_charge_two_amnt').val();
            var txt_discount_percentage = $('#txt_discount_percentage').val();
            var txt_discount_amnt = $('#txt_discount_amnt').val(); 
            


            billData = '&action_type=' + type + '&id=' + id + '&txt_trf_no=' + txt_trf_no + '&txt_job_no=' + txt_job_no + '&invoice_date=' + invoice_date + '&select_rate=' + select_rate + '&hidden_gst_type=' + hidden_gst_type + '&txt_cgst=' + txt_cgst + '&txt_sgst=' + txt_sgst + '&txt_igst=' + txt_igst + '&txt_grand=' + txt_grand + '&txt_amt_in_word=' + txt_amt_in_word + '&total_amt=' + total_amt + '&hidden_agency=' + hidden_agency + '&gst_no=' + gst_no + '&test_ids_array=' + test_ids_array + '&test_name_array=' + test_name_array + '&test_qty_array=' + test_qty_array + '&test_rates_array=' + test_rates_array + '&test_amnt_array=' + test_amnt_array + '&hidden_gst_in_ex=' + hidden_gst_in_ex + '&hsn_codes=' + hsn_codes + '&perfoma_no=' + perfoma_no + '&test_mate_array=' + test_mate_array + '&test_mate_id_array=' + test_mate_id_array + '&txt_bill_to=' + txt_bill_to + '&other_customer_name=' + other_customer_name + '&other_customer_address=' + other_customer_address + '&other_customer_gst_no=' + other_customer_gst_no + '&test_trf_id_array=' + test_trf_id_array + '&letter_heading=' + letter_heading + '&letter_nos=' + letter_nos + '&letter_dated=' + letter_dated + '&txt_charge_one=' + txt_charge_one + '&txt_charge_one_percentage=' + txt_charge_one_percentage + '&txt_charge_two=' + txt_charge_two + '&txt_charge_two_percentage=' + txt_charge_two_percentage + '&txt_taxable=' + txt_taxable + '&txt_round_up=' + txt_round_up + '&txt_charge_one_amnt=' + txt_charge_one_amnt + '&txt_charge_two_amnt=' + txt_charge_two_amnt + '&txt_discount_percentage=' + txt_discount_percentage + '&txt_discount_amnt=' + txt_discount_amnt + '&bill_to_id=' + bill_to_id + '&bill_to_name=' + bill_to_name + '&nabl_type=' + nabl_type + '&branch_short_code=' + branch_short_code;

        }else {


            var billData = 'action_type=' + type + '&idsss=' + id;

        }

        var gst_no = $('#gst_no').val();
        var hidden_gst_type = $('#hidden_gst_type').val();

        if (invoice_date == "") {
            alert("Please Select Invoice Date..");
            return false;
        }
        if (hidden_gst_type == "") {
            alert("Please Select Gst..");
            return false;
        }
        if (select_rate == "") {
            alert("Please Select Rate Type");
            return false;
        }

        if (hidden_gst_in_ex == "") {

            alert("Please Select Include Or Exclude..");
        } else if (gst_no == null || gst_no == "") {
            alert("GST No. Require..");
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php $base_url; ?>save_span_set_rate_merging_perfoma.php',
                data: billData,
                beforeSend: function() {
                    document.getElementById("overlay_div").style.display = "block";
                },
                success: function(msg) {
                    document.getElementById("overlay_div").style.display = "none";
                    alert("Perfoma Saved By Test Successfully");
                    window.location.href = "<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";
                }
            });
        }
        }
        

    // code for save by material
    function add_material(type, id) {
        id = (typeof id == "undefined") ? '' : id;
        var statusArr = {
            add: "added",
            edit: "updated",
            delete: "deleted"
        };
        var billData = '';
        if (type == 'save_by_material') {
            var txt_trf_no = $('#txt_trf_no').val();
            var txt_job_no = $('#txt_job_no').val();
            var invoice_date = $('#invoice_date').val();
            var gst_no = $('#gst_no').val();
            var select_rate = $('#select_rate').val();
            var hidden_gst_type = $('#hidden_gst_type').val();
            var hidden_gst_in_ex = $('#hidden_gst_in_ex').val();
            var txt_cgst = $('#txt_cgst').val();
            var txt_sgst = $('#txt_sgst').val();
            var txt_igst = $('#txt_igst').val();
            var txt_grand = $('#txt_grand').val();
            var txt_amt_in_word = $('#txt_amt_in_word').val();
            var total_amt = $('#total_amt').val();
            var perfoma_no = $('#perfoma_no').val();
            var hsn_codes = $('#hsn_codes').val();
            var txt_bill_to = $('input[name=txt_bill_to]:checked').val();
            var other_customer_name = $('#other_customer_name').val();
            var other_customer_address = $('#other_customer_address').val();
            var other_customer_gst_no = $('#other_customer_gst_no').val();
            var bill_to_id = $('#bill_to_id').val();
            var bill_to_name_f = $('#bill_to_name').val();
            var bill_to_name = bill_to_name_f.replace("&", "QQQ");
            var nabl_type = $('#nabl_type').val();
            var branch_short_code = $('#branch_short_code').val();

            if (gst_no == "") {
                alert("please Enter Gst First");
                return false;
            } else {

            }

            if (gst_no.length != 15) {
                if (gst_no != "02aaa") {
                    alert("Enter Gst No Properly...");
                    return false;
                } else {}
            }

            var mate_qty_array = [];
            $(".class_material_qty").each(function() {
                mate_qty_array.push($(this).val());
            });

            var mate_rates_array = [];
            $(".class_material_rates").each(function() {
                mate_rates_array.push($(this).val());
            });

            var mat_amnt_array = [];
            $(".class_amnt").each(function() {
                mat_amnt_array.push($(this).val());
            });

            var test_mate_array = [];
            $(".class_material_name").each(function() {
                test_mate_array.push($(this).val());
            });

            var test_mate_id_array = [];
            $(".class_material_id").each(function() {
                test_mate_id_array.push($(this).val());
            });

            var test_trf_id_array = [];
            $(".class_trf_id").each(function() {
                test_trf_id_array.push($(this).val());
            });

            var hidden_agency = $('#hidden_agency').val();
            var letter_heading = $('#letter_heading').val();
            var letter_nos = $('#letter_nos').val();
            var letter_dated = $('#letter_dated').val();

            if (letter_heading != "" && letter_nos == "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_heading != "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_heading != "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_heading == "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_heading == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_nos != "" && letter_dated == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_heading == "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_heading == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }
            if (letter_dated != "" && letter_nos == "") {
                alert("Please Enter Letter Data Properly");
                return false;
            }

            var txt_charge_one = $('#txt_charge_one').val();
            var txt_charge_one_percentage = $('#txt_charge_one_percentage').val();
            var txt_charge_two = $('#txt_charge_two').val();
            var txt_charge_two_percentage = $('#txt_charge_two_percentage').val();
            var txt_taxable = $('#txt_taxable').val();
            var txt_round_up = $('#txt_round_up').val();
            var txt_charge_one_amnt = $('#txt_charge_one_amnt').val();
            var txt_charge_two_amnt = $('#txt_charge_two_amnt').val();
            var txt_discount_percentage = $('#txt_discount_percentage').val();
            var txt_discount_amnt = $('#txt_discount_amnt').val();



            billData = '&action_type=' + type + '&id=' + id + '&txt_trf_no=' + txt_trf_no + '&txt_job_no=' + txt_job_no + '&invoice_date=' + invoice_date + '&select_rate=' + select_rate + '&hidden_gst_type=' + hidden_gst_type + '&txt_cgst=' + txt_cgst + '&txt_sgst=' + txt_sgst + '&txt_igst=' + txt_igst + '&txt_grand=' + txt_grand + '&txt_amt_in_word=' + txt_amt_in_word + '&total_amt=' + total_amt + '&hidden_agency=' + hidden_agency + '&gst_no=' + gst_no + '&mate_qty_array=' + mate_qty_array + '&mate_rates_array=' + mate_rates_array + '&mat_amnt_array=' + mat_amnt_array + '&hidden_gst_in_ex=' + hidden_gst_in_ex + '&hsn_codes=' + hsn_codes + '&perfoma_no=' + perfoma_no + '&test_mate_array=' + test_mate_array + '&test_mate_id_array=' + test_mate_id_array + '&txt_bill_to=' + txt_bill_to + '&other_customer_name=' + other_customer_name + '&other_customer_address=' + other_customer_address + '&other_customer_gst_no=' + other_customer_gst_no + '&test_trf_id_array=' + test_trf_id_array + '&letter_heading=' + letter_heading + '&letter_nos=' + letter_nos + '&letter_dated=' + letter_dated + '&txt_charge_one=' + txt_charge_one + '&txt_charge_one_percentage=' + txt_charge_one_percentage + '&txt_charge_two=' + txt_charge_two + '&txt_charge_two_percentage=' + txt_charge_two_percentage + '&txt_taxable=' + txt_taxable + '&txt_round_up=' + txt_round_up + '&txt_charge_one_amnt=' + txt_charge_one_amnt + '&txt_charge_two_amnt=' + txt_charge_two_amnt + '&txt_discount_percentage=' + txt_discount_percentage + '&txt_discount_amnt=' + txt_discount_amnt + '&bill_to_id=' + bill_to_id + '&bill_to_name=' + bill_to_name + '&nabl_type=' + nabl_type + '&branch_short_code=' + branch_short_code;

        } else {


            billData = 'action_type=' + type + '&id=' + id;

        }
        var gst_no = $('#gst_no').val();
        var hidden_gst_type = $('#hidden_gst_type').val();

        if (invoice_date == "") {
            alert("Please Select Invoice Date..");
            return false;
        }
        if (hidden_gst_type == "") {
            alert("Please Select Gst..");
            return false;
        }
        if (select_rate == "") {
            alert("Please Select Rate Type");
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_set_rate_merging_perfoma.php',
            data: billData,
            beforeSend: function() {
                document.getElementById("overlay_div").style.display = "block";
            },
            success: function(msg) {
                document.getElementById("overlay_div").style.display = "none";
                alert("Perfoma Saved By Material Successfully");
                window.location.href = "<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";

            }
        });



    }
    // on category change
    $("#select_material_category").change(function() {
        var select_material_category = $('#select_material_category').val();
        var txt_report_no = $('#txt_report_no').val();
        var txt_job_no = $('#txt_job_no').val();
        var postData = 'action_type=get_material_by_category&select_material_category=' + select_material_category;

        $.ajax({
            url: "<?php $base_url; ?>save_span_set_rate_merging_perfoma.php",
            type: "POST",
            dataType: 'JSON',
            data: postData,
            beforeSend: function() {
                document.getElementById("overlay_div").style.display = "block";
            },
            success: function(data) {
                document.getElementById("overlay_div").style.display = "none";
                $('#select_material').html(data.all_material);
                $('#get_more_count').val(20);
                $("#get_more").prop("disabled", false);

            }
        });
    });

    // on material change

    $("#select_material").change(function() {
        var select_material = $('#select_material').val();
        var select_material_category = $('#select_material_category').val();
        var txt_job_no = $('#txt_job_no').val();
        var postData = 'action_type=get_lab_by_material&select_material=' + select_material + '&select_material_category=' + select_material_category;

        $.ajax({
            url: "<?php $base_url; ?>save_span_set_rate_merging_perfoma.php",
            type: "POST",
            dataType: 'JSON',
            data: postData,
            beforeSend: function() {
                document.getElementById("overlay_div").style.display = "block";
            },
            success: function(data) {
                document.getElementById("overlay_div").style.display = "none";
                $('#select_test').html(data.out_tests);

            }
        });
    });

    //get more material by category
    $(document).on('click', '#get_more', function(event) {

        var select_material_category = $('#select_material_category').val();
        var get_more_count = $('#get_more_count').val();
        if (select_material_category == 0) {
            alert("Slect Category First");
            return false;
        }
        var postData = 'action_type=get_material_by_category_more&select_material_category=' + select_material_category + '&get_more_count=' + get_more_count;

        $.ajax({
            url: "<?php $base_url; ?>save_span_set_rate_merging_perfoma.php",
            type: "POST",
            dataType: 'JSON',
            data: postData,
            beforeSend: function() {
                document.getElementById("overlay_div").style.display = "block";
            },
            success: function(data) {
                document.getElementById("overlay_div").style.display = "none";
                $('#select_material').append(data.all_material);
                get_more_count = parseInt(get_more_count) + 20;
                $('#get_more_count').val(get_more_count);

                if (data.get_rows_counts == 0) {
                    $("#get_more").prop("disabled", true);
                    alert("No More Material For " + data.category_names + " Category");
                }



            }
        });
    });

    $(document).on("click", ".put_iframe_in_modal", function() {
        var abc = $(this).attr('data-id');
        $('#display_data_for_update').html(abc);

    });

    $("input[name='txt_make_by']").change(
        function(e) {
            var txt_make_by = $('input[name=txt_make_by]:checked').val();
            var txt_trf_no = $('#txt_trf_no').val();
			var txt_job_no = $('#txt_job_no').val();
            var get_rate_type = $('#select_rate').val();
            var bill_to_id = $('#select_rate').val();
			
            billData = '&action_type=on_make_by_change&txt_make_by=' + txt_make_by + '&txt_trf_no=' + txt_trf_no + '&txt_job_no=' + txt_job_no + '&get_rate_type=' + get_rate_type + '&bill_to_id=' + bill_to_id;
            $.ajax({
                type: 'POST',
                url: '<?php $base_url; ?>on_bill_to_changes.php',
                data: billData,
                success: function(msg) {
                    $("#put_design").html(msg);
                    get_table_after_update();
                    if (txt_make_by == "0") {
                        $("#btn_add_data").show();
                        $("#z").hide();
                    } else {
                        $("#btn_add_data").hide();
                        $("#btn_add_data_by_mate").show();

                    }

                }
            });

        });

    function on_loadings() {
        var txt_make_by = $('input[name=txt_make_by]:checked').val();
        var txt_trf_no = $('#txt_trf_no').val();
        var get_rate_type = $('#select_rate').val();
        var bill_to_id = $('#bill_to_id').val();
        billData = '&action_type=on_make_by_change&txt_make_by=' + txt_make_by + '&txt_trf_no=' + txt_trf_no + '&get_rate_type=' + get_rate_type + '&bill_to_id=' + bill_to_id;
        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>on_bill_to_changes.php',
            data: billData,
            success: function(msg) {
                $("#put_design").html(msg);
                get_table_after_update();

                if (txt_make_by == "0") {
                    $("#btn_add_data").show();
                    $("#btn_add_data_by_mate").hide();
                } else {
                    $("#btn_add_data").hide();
                    $("#btn_add_data_by_mate").show();

                }

            }
        });

    };
</script>