<?php
error_reporting(1);
session_start();
include("connection.php");

if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
    if ($_POST['action_type'] == 'get_data_by_rate') {

        $select_rate = $_POST["select_rate"];
        // get all id by explode
        $test_id_array = explode(",", $_POST["test_id_array"]);
        $test_qty_array = explode(",", $_POST["test_qty_array"]);
        $test_wise_rate_array = array();
        $test_wise_total_array = array();

        foreach ($test_id_array as $keys => $one_test_id) {

            // get test record by test id
            $sel_test = "select * from test_master where `test_id`=" . $one_test_id;
            $sel_test_query = mysqli_query($conn, $sel_test);
            $get_test_record = mysqli_fetch_array($sel_test_query);

            //check type of rate(G,P,O)?
            if ($select_rate == "0") {
                $get_rates = $get_test_record["test_rate_gov"];
                array_push($test_wise_rate_array, $get_rates);
                array_push($test_wise_total_array, ($get_rates * $test_qty_array[$keys]));
            }
            if ($select_rate == "1") {

                $get_rates = $get_test_record["test_rate_private"];
                array_push($test_wise_rate_array, $get_rates);
                array_push($test_wise_total_array, ($get_rates * $test_qty_array[$keys]));
            }
            if ($select_rate == "2") {
                $get_rates = $get_test_record["test_rate"];
                array_push($test_wise_rate_array, $get_rates);
                array_push($test_wise_total_array, ($get_rates * $test_qty_array[$keys]));
            }
        }
        $fill = array("test_wise_rate_array" => $test_wise_rate_array, "test_wise_total_array" => $test_wise_total_array);

        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'get_table_after_update') {
        // get all id by explode
        $select_exploded = explode("|", $_POST["id"]);
        $gst_type = $select_exploded[0];
        $in_or_ex = $select_exploded[1];
        $txt_grand = number_format($select_exploded[2], 2, '.', '');
        $txt_charge_one_percentage = $select_exploded[3];
        if ($txt_charge_one_percentage == "") {
            $txt_charge_one_percentage = 0;
        }
        $txt_charge_two_percentage = $select_exploded[4];
        if ($txt_charge_two_percentage == "") {
            $txt_charge_two_percentage = 0;
        }
        $txt_discount_percentage = $select_exploded[5];
        if ($txt_discount_percentage == "") {
            $txt_discount_percentage = 0;
        }
        $select_rate = $select_exploded[6];

        if ($select_rate == "0") {
            $in_or_ex = "include";
            //$gst_type="with_igst";
        }

        //$charge_one=$txt_grand * $txt_charge_one_percentage / 100;
        //$charge_two=$txt_grand * $txt_charge_two_percentage / 100;
        $taxable_amnt = $txt_grand;
        $discount_amnt = number_format($txt_grand * $txt_discount_percentage / 100, 2, '.', '');


        // with gst code include
        if ($gst_type == "with_gst" && $in_or_ex == "include") {

            $taxable_amnt = number_format($txt_grand / 1.18, 2, '.', '');
            $cgst = number_format(($txt_grand - $taxable_amnt) / 2, 2, '.', '');
            $sgst = number_format(($txt_grand - $taxable_amnt) / 2, 2, '.', '');
            $igst = 0;

            $grand_total = $taxable_amnt - $both_gst_c_s;
            $charge_one = 0;
            $charge_two = 0;
        }

        // with gst code exclude
        if ($gst_type == "with_gst" && $in_or_ex == "exclude") {

          
			$charge_one = $txt_grand * $txt_charge_one_percentage / 100;
            $charge_two = $txt_grand * $txt_charge_two_percentage / 100;
            $taxable_amnt = $txt_grand + $charge_one + $charge_two - $discount_amnt;
            $count_gst = $taxable_amnt * 1.09;
            $both_gst_c_s = $count_gst - $taxable_amnt;
            $cgst = number_format($both_gst_c_s, 2, '.', '');
            $sgst = number_format($both_gst_c_s, 2, '.', '');
            $igst = 0;

            $grand_total = $txt_grand;
        }

        // with igst code include
        if ($gst_type == "with_igst" && $in_or_ex == "include") {

            $taxable_amnt = number_format($txt_grand / 1.18, 2, '.', '');
            $cgst = 0;
            $sgst = 0;
            $igst = number_format(($txt_grand - $taxable_amnt), 2, '.', '');;

            $grand_total = $taxable_amnt - $both_gst_c_s;
            $charge_one = 0;
            $charge_two = 0;
        }

        // with igst code exclude
        if ($gst_type == "with_igst" && $in_or_ex == "exclude") {

            $charge_one = $txt_grand * $txt_charge_one_percentage / 100;
            $charge_two = $txt_grand * $txt_charge_two_percentage / 100;
            $taxable_amnt = $txt_grand + $charge_one + $charge_two - $discount_amnt;
            $count_gst = $taxable_amnt * 1.18;
            $both_gst_c_s = $count_gst - $taxable_amnt;
            $cgst = 0;
            $sgst = 0;
            $igst = $both_gst_c_s;

            $grand_total = $txt_grand;
        }
        $net_total = $taxable_amnt + $cgst + $sgst + $igst;
        $get_total_amt_in_word = numtowords($net_total);
        $net_rounded = number_format($net_total, 0, '.', '');
        $round_off_total = number_format($net_rounded - $net_total, 2, '.', '');
        $fill = array("cgst" => number_format($cgst, 2, '.', ''), "sgst" => number_format($sgst, 2, '.', ''), "igst" => number_format($igst, 2, '.', ''), "grand_total" => number_format($grand_total, 2, '.', ''), "taxable_amnt" => number_format($taxable_amnt, 2, '.', ''), "net_total" => $net_rounded, "round_off_total" => $round_off_total, "get_total_amt_in_word" => $get_total_amt_in_word, "charge_one_amnt" => number_format($charge_one, 2, '.', ''), "charge_two_amnt" => number_format($charge_two, 2, '.', ''), "txt_discount_percentage" => $txt_discount_percentage, "discount_amnt" => $discount_amnt);

        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'add_estimate_only_for_material') {


        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $hidden_gst_in_ex = $_POST["hidden_gst_in_ex"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];
        $txt_sub_total = $_POST["txt_sub_total"];
        $txt_discount_percent = $_POST["txt_discount_percent"];
        $txt_discount_amount = $_POST["txt_discount_amount"];
        $txt_bill_to = $_POST["txt_bill_to"];

        $all_hsn_codes = $_POST["all_hsn_codes"];
        $all_material_id = $_POST["all_material_id"];
        $all_material_name = $_POST["all_material_name"];
        $all_material_qty = $_POST["all_material_qty"];
        $all_material_rates = $_POST["all_material_rates"];
        $all_material_amt = $_POST["all_material_amt"];

        $sel_estimate = "select * from estimate_total_span_only_for_material where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
        $result_estimate = mysqli_query($conn, $sel_estimate);

        if (mysqli_num_rows($result_estimate) > 0) {

            $update_est = "update estimate_total_span_only_for_material set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`bill_to`='$txt_bill_to',`agency_id`='$hidden_agency',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`sub_total`='$txt_sub_total',`discount_percent`='$txt_discount_percent',`discount_amount`='$txt_discount_amount',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`hsn_codes`='$all_hsn_codes',`all_material_id`='$all_material_id',`all_material_name`='$all_material_name',`all_material_qty`='$all_material_qty',`all_material_rates`='$all_material_rates',`all_material_amt`='$all_material_amt' where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_estimate = mysqli_query($conn, $update_est);
        } else {
            // bill sequence logic
            $sel_estiamte_for_bill_no = "select * from estimate_total_span_bill_sequence  ORDER BY bill_id DESC";
            $query_estiamte_for_bill_no = mysqli_query($conn, $sel_estiamte_for_bill_no);

            if (mysqli_num_rows($query_estiamte_for_bill_no) > 0) {
                $result_estiamte_for_bill_no = mysqli_fetch_assoc($query_estiamte_for_bill_no);
                $explode_bill_no = explode("/", $result_estiamte_for_bill_no["bill_no"]);

                $first_explode = $explode_bill_no[0];
                $second_explode = $explode_bill_no[1];
                $third_explode = $explode_bill_no[2];
                $l_trim_third_explode = ltrim($third_explode, "0");
                $plus_of_bill = intval($l_trim_third_explode) + 1;
                $final_bill_no = sprintf('%04d', $plus_of_bill);

                $sel_year = "select * from fyearmaster where `fy_isactive`=0";
                $query_year = mysqli_query($conn, $sel_year);
                $result_year = mysqli_fetch_array($query_year);
                $year_name = $result_year["fy_name"];
                $today_date = date("Ymd");

                $set_bill_no = $first_explode . "/" . $year_name . "/" . $final_bill_no;
            } else {
                $sel_year = "select * from fyearmaster where `fy_isactive`=0";
                $query_year = mysqli_query($conn, $sel_year);
                $result_year = mysqli_fetch_array($query_year);
                $year_name = $result_year["fy_name"];
                $today_date = date("Ymd");

                $set_bill_no = "GST/" . $year_name . "/0001";
            }

            //insert entry in estimate_sequence_maintain
            $todays = date("Y-m-d");
            $insert_sequence = "insert into estimate_total_span_bill_sequence(`trf_no`,`job_no`,`bill_no`,`estimate_type`,`estimate_date`,`created_date`,`created_by`,`created_name`) values('$txt_trf_no','$txt_job_no','$set_bill_no','for_material','$invoice_date','$todays','$_SESSION[u_id]','$_SESSION[name]')";
            $result_insert_sequence = mysqli_query($conn, $insert_sequence);

            $insert_estimate = "insert into estimate_total_span_only_for_material (`trf_no`,`job_no`,`estimate_no`,`estimate_date`,`bill_to`,`bill_no`,`agency_id`,`gst_type`,`gst_in_or_ex`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`sub_total`,`discount_percent`,`discount_amount`,`grand_total`,`total_amt`,`total_amt_in_word`,`hsn_codes`,`all_material_id`,`all_material_name`,`all_material_qty`,`all_material_rates`,`all_material_amt`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`)
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$txt_bill_to',
						'$set_bill_no',
						'$hidden_agency',
						'$hidden_gst_type',
						'$hidden_gst_in_ex',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_sub_total',
						'$txt_discount_percent',
						'$txt_discount_amount',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$all_hsn_codes',
						'$all_material_id',
						'$all_material_name',
						'$all_material_qty',
						'$all_material_rates',
						'$all_material_amt',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00')";
            $result_insert_estimate = mysqli_query($conn, $insert_estimate);

            //$update_save_material_assign="update save_material_assign set `is_estimate`=1,`invoice_by_material`=1 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            //$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
        }
    } else if ($_POST['action_type'] == 'set_c_s_and_amt_on_rate_change') {


        // get all id by explode
        $gst_type = $_POST["gst_type"];
        $all_material_qty = $_POST["all_material_qty"];
        $all_material_rates = $_POST["all_material_rates"];
        $all_material_amt = $_POST["all_material_amt"];

        $explode_all_material_qty = explode(",", $_POST["all_material_qty"]);
        $explode_all_material_rates = explode(",", $_POST["all_material_rates"]);

        $sum_of_all_mate_amt = 0;

        //array_for_amt_textbox
        $push_amont = array();

        foreach ($explode_all_material_qty as $mate_keys => $one_all_material_qty) {

            $multific_qty_and_mate_rates = $explode_all_material_rates[$mate_keys] * $one_all_material_qty;
            $sum_of_all_mate_amt += $multific_qty_and_mate_rates;

            array_push($push_amont, $multific_qty_and_mate_rates);
        }
        $get_total_amt = $sum_of_all_mate_amt;



        if ($gst_type == "with_gst") {

            $sel_tax = "select * from tax";
            $query_tax = mysqli_query($conn, $sel_tax);
            $get_tax = mysqli_fetch_array($query_tax);

            $cgst = $get_total_amt * $get_tax["tax_cgst"] / 100;
            $sgst = $get_total_amt * $get_tax["tax_sgst"] / 100;
            $igst = 0;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $cgst + $sgst;
            $get_total_amt_in_word = numtowords($net_total);
        } elseif ($gst_type == "with_igst") {

            $sel_tax = "select * from tax";
            $query_tax = mysqli_query($conn, $sel_tax);
            $get_tax = mysqli_fetch_array($query_tax);

            $cgst = 0;
            $sgst = 0;
            $igst = $get_total_amt * $get_tax["tax_igst"] / 100;;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $igst;
            $get_total_amt_in_word = numtowords($net_total);
        } else {

            $cgst = 0;
            $sgst = 0;
            $igst = 0;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $cgst + $sgst;
            $get_total_amt_in_word = numtowords($net_total);
        }

        $fill = array("cgst" => round($cgst), "sgst" => round($sgst), "igst" => round($igst), "grand_total" => round($grand_total), "net_total" => round($net_total), "get_total_amt_in_word" => $get_total_amt_in_word, "push_amont" => $push_amont);

        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'set_c_s_and_amt') {

        // get all id by explode
        $gst_type = $_POST["gst_type"];
        $in_or_ex = $_POST["in_or_ex"];
        $all_material_qty = $_POST["all_material_qty"];
        $all_material_rates = $_POST["all_material_rates"];
        $all_material_amt = $_POST["all_material_amt"];

        $get_total_amt = $all_material_amt;



        if ($gst_type == "with_gst") {

            $sel_tax = "select * from tax";
            $query_tax = mysqli_query($conn, $sel_tax);
            $get_tax = mysqli_fetch_array($query_tax);

            $cgst = $get_total_amt * $get_tax["tax_cgst"] / 100;
            $sgst = $get_total_amt * $get_tax["tax_sgst"] / 100;
            $igst = 0;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $cgst + $sgst;
            $get_total_amt_in_word = numtowords($net_total);
        }
        if ($gst_type == "with_igst") {

            $sel_tax = "select * from tax";
            $query_tax = mysqli_query($conn, $sel_tax);
            $get_tax = mysqli_fetch_array($query_tax);

            $cgst = 0;
            $sgst = 0;
            $igst = $get_total_amt * $get_tax["tax_igst"] / 100;;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $igst;
            $get_total_amt_in_word = numtowords($net_total);
        }
        if ($gst_type == "without_gst" && $in_or_ex == "") {

            $cgst = 0;
            $sgst = 0;
            $igst = 0;
            $grand_total = $get_total_amt;
            $net_total = $grand_total + $cgst + $sgst;
            $get_total_amt_in_word = numtowords($net_total);
        }

        $fill = array("cgst" => round($cgst), "sgst" => round($sgst), "igst" => round($igst), "grand_total" => round($grand_total), "net_total" => round($net_total), "get_total_amt_in_word" => $get_total_amt_in_word);

        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'update_rates') {

        // get all id by explode
        $get_rate = $_POST["get_rate"];
        $get_qty = $_POST["get_qty"];
        $get_amts = $get_rate * $get_qty;
        $get_test_id = $_POST["get_test_id"];

        $update_test_wise = "update test_wise_material_rate set `rate`='$get_rate',`amt`='$get_amts' where `test_wise_id`=" . $get_test_id;
        $result_update_test_wise = mysqli_query($conn, $update_test_wise);
    } else if ($_POST['action_type'] == 'add_estimate') {

        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];


        $get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
        $resultset = mysqli_query($conn, $get_job_data);
        if (mysqli_num_rows($resultset) > 0) {
            $get_datas = mysqli_fetch_array($resultset);
            $report_sent_to = $get_datas['report_sent_to'];
            if ($report_sent_to == "0") {
                $update_gst = "update job set client_gstno='$gst_no' where `trf_no`='$txt_trf_no'";
            } else {
                $update_gst = "update job set agency_gstno='$gst_no' where `trf_no`='$txt_trf_no'";
            }
            $result_updategst = mysqli_query($conn, $update_gst);
        }

        $sel_estimate = "select * from estimate_total_span where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
        $result_estimate = mysqli_query($conn, $sel_estimate);

        if (mysqli_num_rows($result_estimate) > 0) {

            $update_est = "update estimate_total_span set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_estimate = mysqli_query($conn, $update_est);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        } else {
            $todays = date("Y-m-d");
            $insert_estimate = "insert into estimate_total_span (`trf_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`)
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
						'$select_rate',
						'$hidden_gst_type',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'$todays',
						'',
						'0000-00-00')";
            $result_insert_estimate = mysqli_query($conn, $insert_estimate);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        }
    } else if ($_POST['action_type'] == 'save_next_estimate') {

        $txt_report_no = $_POST["txt_report_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];


        $get_job_data = "select * from job WHERE `report_no`='$txt_report_no'";
        $resultset = mysqli_query($conn, $get_job_data);
        if (mysqli_num_rows($resultset) > 0) {
            $get_datas = mysqli_fetch_array($resultset);
            $report_sent_to = $get_datas['report_sent_to'];
            if ($report_sent_to == "0") {
                $update_gst = "update job set client_gstno='$gst_no' where `report_no`='$txt_report_no'";
            } else {
                $update_gst = "update job set agency_gstno='$gst_no' where `report_no`='$txt_report_no'";
            }
            $result_updategst = mysqli_query($conn, $update_gst);
        }

        $sel_estimate = "select * from estimate_total_span where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
        $result_estimate = mysqli_query($conn, $sel_estimate);

        if (mysqli_num_rows($result_estimate) > 0) {

            $update_est = "update estimate_total_span set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_estimate = mysqli_query($conn, $update_est);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        } else {
            $todays = date("Y-m-d");
            $insert_estimate = "insert into estimate_total_span (`report_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`)
						values(
						'$txt_report_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
						'$hidden_gst_type',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'$todays',
						'',
						'0000-00-00')";
            $result_insert_estimate = mysqli_query($conn, $insert_estimate);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        }

        // get morr by report no andjob no
        $sel_span_mate = "select * from span_material_assign where `report_no`='$txt_report_no' AND `job_number`='$txt_job_no'";
        $query_span_mate = mysqli_query($conn, $sel_span_mate);
        $get_span_mate = mysqli_fetch_assoc($query_span_mate);

        $get_morr = $get_span_mate["morr"];
        $get_job_number = $get_span_mate["job_number"];
        $expected_date = $get_span_mate["expected_date"];
        $tested_by = $get_span_mate["tested_by"];
        $reported_by = $get_span_mate["reported_by"];


        // code to get sample receve date from job table
        $sel_jobs = "select * from job where `report_no`='$txt_report_no'";
        $query_jobs = mysqli_query($conn, $sel_jobs);
        $result_jobs = mysqli_fetch_array($query_jobs);
        $get_sample_rec_date = $result_jobs["sample_rec_date"];


        // update  morr and job_lab_assign in job table

        if ($get_morr == "m") {
            $j_n_progress = 0;
            $report_printing = 0;
            $set_expected_date = "0000-00-00";
            $set_re_sample_date = "0000-00-00";
        } else {
            $j_n_progress = 1;
            $report_printing = 1;
            $set_expected_date = $expected_date;
            $set_re_sample_date = $get_sample_rec_date;
        }



        $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=3 where `report_no`='$txt_report_no'";
        $query_update_jobs = mysqli_query($conn, $update_jobs);
    } else if ($_POST['action_type'] == 'save_next_estimate_only_save') {

        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $hsn_codes = $_POST["hsn_codes"];
        $squence_no = $_POST["squence_no"];
        $perfoma_no = $_POST["perfoma_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $hidden_gst_in_ex = $_POST["hidden_gst_in_ex"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];
        $test_ids_array = $_POST["test_ids_array"];
        $raw_post = file_get_contents('php://input');

        $branch_short_code = $_POST["branch_short_code"];
		
        $invoice_dates = date("Y", strtotime($replace_date));

        // jo invoice date ma perfoma hoy to
		$sel_estiamte_by_date = "SELECT * FROM estimate_total_span ORDER BY max_number DESC LIMIT 0,1";
        $query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);


        if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) {
            $result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
            $plus_squence = intval($result_estimate["max_number"]) + 1;
            $plused = sprintf('%04d', $plus_squence);
			$max_number=$plus_squence;
        } else {
            $plused = "0001";
            $max_number = 1;
        }
        $set_perfoma_no = $perfoma_first_parts.$plused;

        //$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
        $filear = explode("&test_name_array=", $raw_post);

        foreach ($filear as $array_dat) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $data_list = $array_dat;
        }
        $datas = explode("&test_qty_array=", $data_list);
        foreach ($datas as $array_dat1) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $datas[] = $array_dat1;
        }

        $test_name_array = $datas[0];
        //$test_name_array= $_POST["test_name_array"];
        $test_qty_array = $_POST["test_qty_array"];
        $test_rates_array = $_POST["test_rates_array"];
        $test_trf_id_array = $_POST["test_trf_id_array"];
        $test_amnt_array = $_POST["test_amnt_array"];
        //$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
        $filear1 = explode("&test_mate_array=", $raw_post);

        foreach ($filear1 as $array_dat1) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $data_list1 = $array_dat1;
        }
        $datas1 = explode("&test_mate_id_array=", $data_list1);
        foreach ($datas1 as $array_dat11) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $datas1[] = $array_dat11;
        }


        $test_mate_array = $datas1[0];

        $test_mate_id_array = $_POST["test_mate_id_array"];
        $txt_bill_to = $_POST["txt_bill_to"];
        $other_customer_name = $_POST["other_customer_name"];
        $other_customer_address = $_POST["other_customer_address"];
        $other_customer_gst_no = $_POST["other_customer_gst_no"];
        $letter_heading = $_POST["letter_heading"];
        $letter_nos = $_POST["letter_nos"];
        $letter_dated = $_POST["letter_dated"];

        $txt_charge_one = $_POST["txt_charge_one"];
        $txt_charge_one_percentage = $_POST["txt_charge_one_percentage"];
        $txt_charge_two = $_POST["txt_charge_two"];
        $txt_charge_two_percentage = $_POST["txt_charge_two_percentage"];
        $txt_taxable = $_POST["txt_taxable"];
        $txt_round_up = $_POST["txt_round_up"];
        $txt_charge_one_amnt = $_POST["txt_charge_one_amnt"];
        $txt_charge_two_amnt = $_POST["txt_charge_two_amnt"];
        $txt_discount_percentage = $_POST["txt_discount_percentage"];
        $txt_discount_amnt = $_POST["txt_discount_amnt"];
        $bill_to_id = $_POST["bill_to_id"];
        $nabl_type = $_POST["nabl_type"];
        //echo$bill_to_name= $_POST["bill_to_name"];exit;
        $bill_to_name = str_replace("QQQ", "&", $_POST["bill_to_name"]);

        $sel_agency = "select * from agency_master where `agency_id`=" . $bill_to_id;
        $query_agency = mysqli_query($conn, $sel_agency);
        $result_agency = mysqli_fetch_array($query_agency);

        if ($result_agency["agency_gstno"] == "" && $gst_no != "24aaa") {
            $update_agency = "update agency_master set `agency_gstno`='$gst_no' where `agency_id`=" . $bill_to_id;
            mysqli_query($conn, $update_agency);
        }

        $todays = date("Y-m-d");
        $insert_estimate = "insert into estimate_total_span (`trf_no`,`job_no`,`estimate_no`,`perfoma_no`,`gst_no`,`hsn_codes`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`test_ids`,`test_name`,`test_qty`,`test_rates`,`test_totals`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`,`trf_no_array`,`mate_name`,`mat_ids`,`bill_to`,`other_customer_name`,`other_customer_address`,`other_customer_gst_no`,`letter_heading`,`letter_nos`,`letter_dated`,`charge_one`,`charge_one_percentage`,`charge_two`,`charge_two_percentage`,`taxable_amnt`,`round_up_amnt`,`charge_one_amount`,`charge_two_amount`,`discount_percentage`,`discount_amnt`,`bill_to_id`,`bill_to_name`,`nabl_type`,`branch_short_code`,`max_number`)
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$set_perfoma_no',
						'$gst_no',
						'$hsn_codes',
						'$invoice_date',
						'$hidden_agency',
						'$select_rate',
						'$hidden_gst_type',
						'$hidden_gst_in_ex',
						'$test_ids_array',
						'$test_name_array',
						'$test_qty_array',
						'$test_rates_array',
						'$test_amnt_array',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'$todays',
						'',
						'0000-00-00',
						'$test_trf_id_array',
						'$test_mate_array',
						'$test_mate_id_array',
						'$txt_bill_to',
						'$other_customer_name',
						'$other_customer_address',
						'$other_customer_gst_no',
						'$letter_heading',
						'$letter_nos',
						'$letter_dated',
						'$txt_charge_one',
						'$txt_charge_one_percentage',
						'$txt_charge_two',
						'$txt_charge_two_percentage',
						'$txt_taxable',
						'$txt_round_up',
						'$txt_charge_one_amnt',
						'$txt_charge_two_amnt',
						'$txt_discount_percentage',
						'$txt_discount_amnt',
						'$bill_to_id',
						'$bill_to_name',
						'$nabl_type',
						'$branch_short_code',
						$max_number
						)";
        $result_insert_estimate = mysqli_query($conn, $insert_estimate);
        //}


        $explode_trf = explode(",", $txt_trf_no);
        foreach ($explode_trf as $one_trf) {
            $txt_trf_no = $one_trf;
            $txt_job_no = $one_trf;

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);

            $get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
            $resultset = mysqli_query($conn, $get_job_data);
            if (mysqli_num_rows($resultset) > 0) {
                $get_datas = mysqli_fetch_array($resultset);
                $report_sent_to = $get_datas['report_sent_to'];
                if ($report_sent_to == "0") {
                    $update_gst = "update job set client_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                } else {
                    $update_gst = "update job set agency_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                }
                $result_updategst = mysqli_query($conn, $update_gst);
            }

            // get morr by report no andjob no
            $sel_span_mate = "select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no'";
            $query_span_mate = mysqli_query($conn, $sel_span_mate);
            $get_span_mate = mysqli_fetch_assoc($query_span_mate);

            $get_morr = $get_span_mate["morr"];
            $get_job_number = $get_span_mate["job_number"];
            $expected_date = $get_span_mate["expected_date"];
            $tested_by = $get_span_mate["tested_by"];
            $reported_by = $get_span_mate["reported_by"];


            // code to get sample receve date from job table
            $sel_jobs = "select * from job where `trf_no`='$txt_trf_no'";
            $query_jobs = mysqli_query($conn, $sel_jobs);
            $result_jobs = mysqli_fetch_array($query_jobs);
            $get_sample_rec_date = $result_jobs["sample_rec_date"];


            // update  morr and job_lab_assign in job table

            if ($get_morr == "m") {
                $j_n_progress = 0;
                $report_printing = 0;
                $set_expected_date = "0000-00-00";
                $set_re_sample_date = "0000-00-00";
            } else {
                $j_n_progress = 1;
                $report_printing = 1;
                $set_expected_date = $expected_date;
                $set_re_sample_date = $get_sample_rec_date;
            }



            $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`admin_special_light`=3 where `trf_no`='$txt_trf_no'";
            $query_update_jobs = mysqli_query($conn, $update_jobs);
        }
    } else if ($_POST['action_type'] == 'save_by_material') {

        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $hsn_codes = $_POST["hsn_codes"];
        $squence_no = $_POST["squence_no"];
        $perfoma_no = $_POST["perfoma_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $hidden_gst_in_ex = $_POST["hidden_gst_in_ex"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];
        $test_ids_array = $_POST["test_ids_array"];
        $raw_post = file_get_contents('php://input');
        $branch_short_code = $_POST["branch_short_code"];

        $invoice_dates = date("Y", strtotime($replace_date));
        $sel_fy = "select * from fyearmaster where `fyyear`='$invoice_dates'";
        $query_fy = mysqli_query($conn, $sel_fy);
        $result_fy = mysqli_fetch_assoc($query_fy);
        $first_char = $result_fy["ulr_prefix"];
        
		
		// jo invoice date ma perfoma hoy to
		$sel_estiamte_by_date = "SELECT * FROM estimate_total_span ORDER BY max_number DESC LIMIT 0,1";
        $query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);


        if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) {
            $result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
            $plus_squence = intval($result_estimate["max_number"]) + 1;
            $plused = sprintf('%04d', $plus_squence);
			$max_number=$plus_squence;
        } else {
            $plused = "001";
            $max_number = 1;
        }
        $set_perfoma_no = $perfoma_first_parts.$plused;
		
        $test_trf_id_array = $_POST["test_trf_id_array"];
        $test_mate_id_array = $_POST["test_mate_id_array"];
        $test_mate_array = $_POST["test_mate_array"];
        $mate_qty_array = $_POST["mate_qty_array"];
        $mate_rates_array = $_POST["mate_rates_array"];
        $mat_amnt_array = $_POST["mat_amnt_array"];



        $txt_bill_to = $_POST["txt_bill_to"];
        $other_customer_name = $_POST["other_customer_name"];
        $other_customer_address = $_POST["other_customer_address"];
        $other_customer_gst_no = $_POST["other_customer_gst_no"];
        $letter_heading = $_POST["letter_heading"];
        $letter_nos = $_POST["letter_nos"];
        $letter_dated = $_POST["letter_dated"];

        $txt_charge_one = $_POST["txt_charge_one"];
        $txt_charge_one_percentage = $_POST["txt_charge_one_percentage"];
        $txt_charge_two = $_POST["txt_charge_two"];
        $txt_charge_two_percentage = $_POST["txt_charge_two_percentage"];
        $txt_taxable = $_POST["txt_taxable"];
        $txt_round_up = $_POST["txt_round_up"];
        $txt_charge_one_amnt = $_POST["txt_charge_one_amnt"];
        $txt_charge_two_amnt = $_POST["txt_charge_two_amnt"];
        $txt_discount_percentage = $_POST["txt_discount_percentage"];
        $txt_discount_amnt = $_POST["txt_discount_amnt"];
        $bill_to_id = $_POST["bill_to_id"];
        $nabl_type = $_POST["nabl_type"];
        //echo$bill_to_name= $_POST["bill_to_name"];exit;
        $bill_to_name = str_replace("QQQ", "&", $_POST["bill_to_name"]);

        $sel_agency = "select * from agency_master where `agency_id`=" . $bill_to_id;
        $query_agency = mysqli_query($conn, $sel_agency);
        $result_agency = mysqli_fetch_array($query_agency);

        if ($result_agency["agency_gstno"] == "" && $gst_no != "24aaa") {
            $update_agency = "update agency_master set `agency_gstno`='$gst_no' where `agency_id`=" . $bill_to_id;
            mysqli_query($conn, $update_agency);
        }

        $todays = date("Y-m-d");
         $insert_estimate = "insert into estimate_total_span (`trf_no`,`job_no`,`estimate_no`,`perfoma_no`,`gst_no`,`hsn_codes`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`,`trf_no_array`,`mate_name`,`mat_ids`,`material_qty`,`material_rates`,`material_amnt`,`bill_to`,`other_customer_name`,`other_customer_address`,`other_customer_gst_no`,`letter_heading`,`letter_nos`,`letter_dated`,`charge_one`,`charge_one_percentage`,`charge_two`,`charge_two_percentage`,`taxable_amnt`,`round_up_amnt`,`charge_one_amount`,`charge_two_amount`,`make_by`,`discount_percentage`,`discount_amnt`,`bill_to_id`,`bill_to_name`,`nabl_type`,`branch_short_code`,`max_number`)
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$set_perfoma_no',
						'$gst_no',
						'$hsn_codes',
						'$invoice_date',
						'$hidden_agency',
						'$select_rate',
						'$hidden_gst_type',
						'$hidden_gst_in_ex',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'$todays',
						'',
						'0000-00-00',
						'$test_trf_id_array',
						'$test_mate_array',
						'$test_mate_id_array',
						'$mate_qty_array',
						'$mate_rates_array',
						'$mat_amnt_array',
						'$txt_bill_to',
						'$other_customer_name',
						'$other_customer_address',
						'$other_customer_gst_no',
						'$letter_heading',
						'$letter_nos',
						'$letter_dated',
						'$txt_charge_one',
						'$txt_charge_one_percentage',
						'$txt_charge_two',
						'$txt_charge_two_percentage',
						'$txt_taxable',
						'$txt_round_up',
						'$txt_charge_one_amnt',
						'$txt_charge_two_amnt',
						'1',
						'$txt_discount_percentage',
						'$txt_discount_amnt',
						'$bill_to_id',
						'$bill_to_name',
						'$nabl_type',
						'$branch_short_code',
						$max_number)";
        $result_insert_estimate = mysqli_query($conn, $insert_estimate);
        //}


        $explode_trf = explode(",", $txt_trf_no);
        foreach ($explode_trf as $one_trf) {
            $txt_trf_no = $one_trf;
			
			$sel_job1 = "select * from job where `trf_no`='$txt_trf_no'";
$query_job1 = mysqli_query($conn, $sel_job1);
$result_job1 = mysqli_fetch_array($query_job1);
$txt_job_no = $result_job1["job_number"];
        

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);

            $get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
            $resultset = mysqli_query($conn, $get_job_data);
            if (mysqli_num_rows($resultset) > 0) {
                $get_datas = mysqli_fetch_array($resultset);
                $report_sent_to = $get_datas['report_sent_to'];
                if ($report_sent_to == "0") {
                    $update_gst = "update job set client_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                } else {
                    $update_gst = "update job set agency_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                }
                $result_updategst = mysqli_query($conn, $update_gst);
            }

            // get morr by report no andjob no
            $sel_span_mate = "select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no'";
            $query_span_mate = mysqli_query($conn, $sel_span_mate);
            $get_span_mate = mysqli_fetch_assoc($query_span_mate);

            $get_morr = $get_span_mate["morr"];
            $get_job_number = $get_span_mate["job_number"];
            $expected_date = $get_span_mate["expected_date"];
            $tested_by = $get_span_mate["tested_by"];
            $reported_by = $get_span_mate["reported_by"];


            // code to get sample receve date from job table
            $sel_jobs = "select * from job where `trf_no`='$txt_trf_no'";
            $query_jobs = mysqli_query($conn, $sel_jobs);
            $result_jobs = mysqli_fetch_array($query_jobs);
            $get_sample_rec_date = $result_jobs["sample_rec_date"];


            // update  morr and job_lab_assign in job table

            if ($get_morr == "m") {
                $j_n_progress = 0;
                $report_printing = 0;
                $set_expected_date = "0000-00-00";
                $set_re_sample_date = "0000-00-00";
            } else {
                $j_n_progress = 1;
                $report_printing = 1;
                $set_expected_date = $expected_date;
                $set_re_sample_date = $get_sample_rec_date;
            }



            $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`admin_special_light`=3 where `trf_no`='$txt_trf_no'";
            $query_update_jobs = mysqli_query($conn, $update_jobs);
        }
    } else if ($_POST['action_type'] == 'update_by_material') {

        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $hsn_codes = $_POST["hsn_codes"];
        $squence_no = $_POST["squence_no"];
        $perfoma_no = $_POST["perfoma_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $hidden_gst_in_ex = $_POST["hidden_gst_in_ex"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];
        $test_ids_array = $_POST["test_ids_array"];
        $raw_post = file_get_contents('php://input');

        $test_trf_id_array = $_POST["test_trf_id_array"];
        $test_mate_id_array = $_POST["test_mate_id_array"];
        $test_mate_array = $_POST["test_mate_array"];
        $mate_qty_array = $_POST["mate_qty_array"];
        $mate_rates_array = $_POST["mate_rates_array"];
        $mat_amnt_array = $_POST["mat_amnt_array"];



        $txt_bill_to = $_POST["txt_bill_to"];
        $other_customer_name = $_POST["other_customer_name"];
        $other_customer_address = $_POST["other_customer_address"];
        $other_customer_gst_no = $_POST["other_customer_gst_no"];
        $letter_heading = $_POST["letter_heading"];
        $letter_nos = $_POST["letter_nos"];
        $letter_dated = $_POST["letter_dated"];

        $txt_charge_one = $_POST["txt_charge_one"];
        $txt_charge_one_percentage = $_POST["txt_charge_one_percentage"];
        $txt_charge_two = $_POST["txt_charge_two"];
        $txt_charge_two_percentage = $_POST["txt_charge_two_percentage"];
        $txt_taxable = $_POST["txt_taxable"];
        $txt_round_up = $_POST["txt_round_up"];
        $txt_charge_one_amnt = $_POST["txt_charge_one_amnt"];
        $txt_charge_two_amnt = $_POST["txt_charge_two_amnt"];
        $txt_discount_percentage = $_POST["txt_discount_percentage"];
        $txt_discount_amnt = $_POST["txt_discount_amnt"];
        $bill_to_id = $_POST["bill_to_id"];
        $bill_to_name = $_POST["bill_to_name"];

        $sel_agency = "select * from agency_master where `agency_id`=" . $bill_to_id;
        $query_agency = mysqli_query($conn, $sel_agency);
        $result_agency = mysqli_fetch_array($query_agency);

        if ($result_agency["agency_gstno"] == "" && $gst_no != "24aaa") {
            $update_agency = "update agency_master set `agency_gstno`='$gst_no' where `agency_id`=" . $bill_to_id;
            mysqli_query($conn, $update_agency);
        }

        $sel_perfomas = "select * from estimate_total_span where `perfoma_no`='$perfoma_no'";
        $result_perfomas = mysqli_query($conn, $sel_perfomas);
        $get_perfomas = mysqli_fetch_array($result_perfomas);
        $est_id = $get_perfomas["est_id"];
        $which_made = $get_perfomas["which_made"];

        $todays = date("Y-m-d");
        $update_est = "update estimate_total_span set `gst_no`='$gst_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`material_qty`='$mate_qty_array',`material_rates`='$mate_rates_array',`material_amnt`='$mat_amnt_array',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_sgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`mate_name`='$test_mate_array',`mat_ids`='$test_mate_id_array',`bill_to`='$txt_bill_to',`other_customer_name`='$other_customer_name',`other_customer_address`='$other_customer_address',`other_customer_gst_no`='$other_customer_gst_no',`letter_heading`='$letter_heading',`letter_nos`='$letter_nos',`letter_dated`='$letter_dated',`charge_one`='$txt_charge_one',`charge_one_percentage`='$txt_charge_one_percentage',`charge_one_amount`='$txt_charge_one_amnt',`charge_two`='$txt_charge_two',`charge_two_percentage`='$txt_charge_two_percentage',`charge_two_amount`='$txt_charge_two_amnt',`taxable_amnt`='$txt_taxable',`round_up_amnt`='$txt_round_up',`discount_percentage`='$txt_discount_percentage',`discount_amnt`='$txt_discount_amnt',`bill_to_id`='$bill_to_id',`bill_to_name`='$bill_to_name' where `perfoma_no`='$perfoma_no'";
        $result_insert_estimate = mysqli_query($conn, $update_est);
        //}



        $explode_trf = explode(",", $txt_trf_no);
        foreach ($explode_trf as $one_trf) {
            $txt_trf_no = $one_trf;
            $txt_job_no = $one_trf;

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);

            $get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
            $resultset = mysqli_query($conn, $get_job_data);
            if (mysqli_num_rows($resultset) > 0) {
                $get_datas = mysqli_fetch_array($resultset);
                $report_sent_to = $get_datas['report_sent_to'];
                if ($report_sent_to == "0") {
                    $update_gst = "update job set client_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                } else {
                    $update_gst = "update job set agency_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                }
                $result_updategst = mysqli_query($conn, $update_gst);
            }

            // get morr by report no andjob no
            $sel_span_mate = "select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no'";
            $query_span_mate = mysqli_query($conn, $sel_span_mate);
            $get_span_mate = mysqli_fetch_assoc($query_span_mate);

            $get_morr = $get_span_mate["morr"];
            $get_job_number = $get_span_mate["job_number"];
            $expected_date = $get_span_mate["expected_date"];
            $tested_by = $get_span_mate["tested_by"];
            $reported_by = $get_span_mate["reported_by"];


            // code to get sample receve date from job table
            $sel_jobs = "select * from job where `trf_no`='$txt_trf_no'";
            $query_jobs = mysqli_query($conn, $sel_jobs);
            $result_jobs = mysqli_fetch_array($query_jobs);
            $get_sample_rec_date = $result_jobs["sample_rec_date"];


            // update  morr and job_lab_assign in job table

            if ($get_morr == "m") {
                $j_n_progress = 0;
                $report_printing = 0;
                $set_expected_date = "0000-00-00";
                $set_re_sample_date = "0000-00-00";
            } else {
                $j_n_progress = 1;
                $report_printing = 1;
                $set_expected_date = $expected_date;
                $set_re_sample_date = $get_sample_rec_date;
            }



            $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`admin_special_light`=3 where `trf_no`='$txt_trf_no'";
            $query_update_jobs = mysqli_query($conn, $update_jobs);
        }
    } else if ($_POST['action_type'] == 'update_perfoma') {

        $txt_trf_no = $_POST["txt_trf_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $perfoma_no = $_POST["perfoma_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $hidden_gst_in_ex = $_POST["hidden_gst_in_ex"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];
        $test_ids_array = $_POST["test_ids_array"];
        $raw_post = file_get_contents('php://input');
        //$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
        $filear = explode("&test_name_array=", $raw_post);

        foreach ($filear as $array_dat) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $data_list = $array_dat;
        }
        $datas = explode("&test_qty_array=", $data_list);
        foreach ($datas as $array_dat1) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $datas[] = $array_dat1;
        }

        $test_name_array = $datas[0];
        //$test_name_array= $_POST["test_name_array"];
        $test_qty_array = $_POST["test_qty_array"];
        $test_rates_array = $_POST["test_rates_array"];
        $test_trf_id_array = $_POST["test_trf_id_array"];
        $test_amnt_array = $_POST["test_amnt_array"];
        //$filearray = in_array(explode("&test_name_array=", $raw_post),$raw_post,false);
        $filear1 = explode("&test_mate_array=", $raw_post);

        foreach ($filear1 as $array_dat1) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $data_list1 = $array_dat1;
        }
        $datas1 = explode("&test_mate_id_array=", $data_list1);
        foreach ($datas1 as $array_dat11) {
            //$data_list[] = strstr($array_dat, '&test_name_array=');
            $datas1[] = $array_dat11;
        }


        $test_mate_array = $datas1[0];

        $test_mate_id_array = $_POST["test_mate_id_array"];
        $txt_bill_to = $_POST["txt_bill_to"];
        $other_customer_name = $_POST["other_customer_name"];
        $other_customer_address = $_POST["other_customer_address"];
        $other_customer_gst_no = $_POST["other_customer_gst_no"];
        $letter_heading = $_POST["letter_heading"];
        $letter_nos = $_POST["letter_nos"];
        $letter_dated = $_POST["letter_dated"];

        $txt_charge_one = $_POST["txt_charge_one"];
        $txt_charge_one_percentage = $_POST["txt_charge_one_percentage"];
        $txt_charge_two = $_POST["txt_charge_two"];
        $txt_charge_two_percentage = $_POST["txt_charge_two_percentage"];
        $txt_taxable = $_POST["txt_taxable"];
        $txt_round_up = $_POST["txt_round_up"];
        $txt_charge_one_amnt = $_POST["txt_charge_one_amnt"];
        $txt_charge_two_amnt = $_POST["txt_charge_two_amnt"];
        $txt_discount_percentage = $_POST["txt_discount_percentage"];
        $txt_discount_amnt = $_POST["txt_discount_amnt"];
        $bill_to_id = $_POST["bill_to_id"];
        $bill_to_name = $_POST["bill_to_name"];

        $sel_agency = "select * from agency_master where `agency_id`=" . $bill_to_id;
        $query_agency = mysqli_query($conn, $sel_agency);
        $result_agency = mysqli_fetch_array($query_agency);
        $bill_to_name = $result_agency["agency_name"];

        if ($result_agency["agency_gstno"] == "" && $gst_no != "24aaa") {
            $update_agency = "update agency_master set `agency_gstno`='$gst_no' where `agency_id`=" . $bill_to_id;
            mysqli_query($conn, $update_agency);
        }

        $sel_perfomas = "select * from estimate_total_span where `perfoma_no`='$perfoma_no'";
        $result_perfomas = mysqli_query($conn, $sel_perfomas);
        $get_perfomas = mysqli_fetch_array($result_perfomas);
        $est_id = $get_perfomas["est_id"];
        $which_made = $get_perfomas["which_made"];

        $update_est = "update estimate_total_span set `gst_no`='$gst_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`test_ids`='$test_ids_array',`test_name`='$test_name_array',`test_qty`='$test_qty_array',`test_rates`='$test_rates_array',`test_totals`='$test_amnt_array',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_sgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`mate_name`='$test_mate_array',`mat_ids`='$test_mate_id_array',`bill_to`='$txt_bill_to',`other_customer_name`='$other_customer_name',`other_customer_address`='$other_customer_address',`other_customer_gst_no`='$other_customer_gst_no',`letter_heading`='$letter_heading',`letter_nos`='$letter_nos',`letter_dated`='$letter_dated',`charge_one`='$txt_charge_one',`charge_one_percentage`='$txt_charge_one_percentage',`charge_one_amount`='$txt_charge_one_amnt',`charge_two`='$txt_charge_two',`charge_two_percentage`='$txt_charge_two_percentage',`charge_two_amount`='$txt_charge_two_amnt',`taxable_amnt`='$txt_taxable',`round_up_amnt`='$txt_round_up',`discount_percentage`='$txt_discount_percentage',`discount_amnt`='$txt_discount_amnt',`bill_to_id`='$bill_to_id',`bill_to_name`='$bill_to_name' where `perfoma_no`='$perfoma_no'";

        mysqli_query($conn, $update_est);



        $explode_trf = explode(",", $txt_trf_no);
        foreach ($explode_trf as $one_trf) {
            $txt_trf_no = $one_trf;
            $txt_job_no = $one_trf;

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);

            $get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
            $resultset = mysqli_query($conn, $get_job_data);
            if (mysqli_num_rows($resultset) > 0) {
                $get_datas = mysqli_fetch_array($resultset);
                $report_sent_to = $get_datas['report_sent_to'];
                if ($report_sent_to == "0") {
                    $update_gst = "update job set client_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                } else {
                    $update_gst = "update job set agency_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no'";
                }
                $result_updategst = mysqli_query($conn, $update_gst);
            }

            // get morr by report no andjob no
            $sel_span_mate = "select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no'";
            $query_span_mate = mysqli_query($conn, $sel_span_mate);
            $get_span_mate = mysqli_fetch_assoc($query_span_mate);

            $get_morr = $get_span_mate["morr"];
            $get_job_number = $get_span_mate["job_number"];
            $expected_date = $get_span_mate["expected_date"];
            $tested_by = $get_span_mate["tested_by"];
            $reported_by = $get_span_mate["reported_by"];


            // code to get sample receve date from job table
            $sel_jobs = "select * from job where `trf_no`='$txt_trf_no'";
            $query_jobs = mysqli_query($conn, $sel_jobs);
            $result_jobs = mysqli_fetch_array($query_jobs);
            $get_sample_rec_date = $result_jobs["sample_rec_date"];


            // update  morr and job_lab_assign in job table

            if ($get_morr == "m") {
                $j_n_progress = 0;
                $report_printing = 0;
                $set_expected_date = "0000-00-00";
                $set_re_sample_date = "0000-00-00";
            } else {
                $j_n_progress = 1;
                $report_printing = 1;
                $set_expected_date = $expected_date;
                $set_re_sample_date = $get_sample_rec_date;
            }



            $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`admin_special_light`=3 where `trf_no`='$txt_trf_no'";
            $query_update_jobs = mysqli_query($conn, $update_jobs);
        }
    } else if ($_POST['action_type'] == 'save_final_bill') {

        $replace_date = str_replace("/", "-", $_POST['invoice_dates']);
        $years = date('y', strtotime($replace_date));
        $invoice_dates = date('Y-m-d', strtotime($replace_date));
        $estimate_perfoma_no = $_POST['estimate_perfoma_no'];
		$explodes_perfoma=explode("/",$estimate_perfoma_no);
		$branch_short_code=$explodes_perfoma[0];
		
		$sel_branch = "select * from branches where `branch_short_code`='$branch_short_code'";
		$query_branch = mysqli_query($conn, $sel_branch);
		$row_branch = mysqli_fetch_array($query_branch);
		$reciept_start=$row_branch["reciept_start"];
		
        $est_id = $_POST['est_id'];
        $trf_no = $_POST['trf_no'];
        $todays = date('Y-m-d');

        $sel_invoice = "SELECT * FROM estimate_total_span_bill_sequence  ORDER BY max_number DESC LIMIT 0,1";
        $query_invoice = mysqli_query($conn, $sel_invoice);


        if (mysqli_num_rows($query_invoice) > 0) {
            $result_invoice = mysqli_fetch_assoc($query_invoice);
            $max_number = $result_invoice["max_number"];
            $plus_squence = intval($max_number) + 1;
            $set_max = $plus_squence;
            $plused = sprintf('%04d', $plus_squence);
        } else {
            $plused = "0001";
            $set_max = 1;
        }
        $set_inv_no = $invoice_first_parts.$years."/".$plused;

        $insert_sqnce = "insert into estimate_total_span_bill_sequence (trf_no,job_no,nabl_type,max_number,bill_no,perfoma_no,estimate_type,estimate_date,created_date,created_by,created_name)
					values(
					'$trf_no',
					'$trf_no',
					'--',
					$set_max,
					'$set_inv_no',
					'$estimate_perfoma_no',
					'--',
					'$invoice_dates',
					'$todays',
					'biller',
					'biller')";
        mysqli_query($conn, $insert_sqnce);

        $update_perfomas = "update estimate_total_span set `invoice_no`='$set_inv_no',`invoice_date`='$invoice_dates',`invoice_character`='T',`which_made`='2' where `perfoma_no`='$estimate_perfoma_no'";
        $query_perfoma = mysqli_query($conn, $update_perfomas);
        $fill = array("set_status" => "1", "msg" => "Invoice Successfully Saved Invoice No: $set_inv_no");
        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'save_final_estimate') {
        $replace_date = str_replace("/", "-", $_POST['estimate_dates']);
        $estimate_dates = date('Y-m-d', strtotime($replace_date));
        $estimate_perfoma_no = $_POST['estimate_perfoma_no'];
		$explodes_perfoma=explode("/",$estimate_perfoma_no);
		$branch_short_code=$explodes_perfoma[0];
		
		$sel_branch = "select * from branches where `branch_short_code`='$branch_short_code'";
		$query_branch = mysqli_query($conn, $sel_branch);
		$row_branch = mysqli_fetch_array($query_branch);
		$estimate_start=$row_branch["estimate_start"];
		
        $estimate_number = $_POST['estimate_number'];
        $est_id = $_POST['est_id'];
        $nabl_type = $_POST['nabl_type'];

        //set estimate no
        $sel_estimate_no="select MAX(estimate_numbers) as maxes from estimate_total_span where estimate_numbers !='0' order by est_id ASC LIMIT 0,1";
		$query_estimate_no=mysqli_query($conn,$sel_estimate_no);
		if(mysqli_num_rows($query_estimate_no) > 0)
		{
			$result_est_no = mysqli_fetch_array($query_estimate_no);
			$estiamtes_no=$result_est_no["maxes"];
			$explode_esti_no=explode("/",$estiamtes_no);
			$plus_nos= intval(end($explode_esti_no)) + 1;
			
			$set_est_no= sprintf('%04d', $plus_nos);
			$estimates_no=$estimate_start.$set_est_no;
		}
		else
		{
			$estimates_no=$estimate_start."0001";
		}



        $update_perfomas = "update estimate_total_span set `estimate_numbers`='$estimates_no',`estimating_date`='$estimate_dates',`which_made`='1' where `perfoma_no`='$estimate_perfoma_no'";
        $query_perfoma = mysqli_query($conn, $update_perfomas);

        $fill = array("set_status" => "1", "msg" => "Estimate Successfully Saved");
        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'set_perfoma_no_by_invoice_date') {
        $dating = str_replace('/', '-', $_POST["invoice_date"]);
        $invoice_dates = date("Y", strtotime($dating));
        $sel_fy = "select * from fyearmaster where `fyyear`='$invoice_dates'";
        $query_fy = mysqli_query($conn, $sel_fy);
        $result_fy = mysqli_fetch_assoc($query_fy);
        $first_char = $result_fy["ulr_prefix"];
        // jo invoice date ma perfoma hoy to
        $sel_estiamte_by_date = "SELECT * FROM estimate_total_span  ORDER BY est_id DESC";
        $query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);


        if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) {
            $result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
            $get_sequence = $result_estimate["perfoma_no"];
            $explode_perfoma = explode("/", $get_sequence);
            $plus_squence = intval($explode_perfoma[2]) + 1;
            $plused = sprintf('%04d', $plus_squence);
        } else {
            $plused = "0001";
        }
        $set_perfoma_no = $first_char . "-PI-" . $plused;
        $fill = array("set_perfoma_no" => $set_perfoma_no);

        echo json_encode($fill);
    } else if ($_POST['action_type'] == 'save_next_estimate_only_save_final_bill') {

        $txt_report_no = $_POST["txt_report_no"];
        $txt_job_no = $_POST["txt_job_no"];
        $gst_no = $_POST["gst_no"];
        $txt_invoice_no = $_POST["txt_invoice_no"];
        $replace_date = str_replace("/", "-", $_POST['invoice_date']);
        $invoice_date = date('Y-m-d', strtotime($replace_date));
        $select_rate_explode = explode("|", $_POST["select_rate"]);
        $select_rate = $select_rate_explode[0];
        $hidden_gst_type = $_POST["hidden_gst_type"];
        $txt_cgst = $_POST["txt_cgst"];
        $txt_sgst = $_POST["txt_sgst"];
        $txt_igst = $_POST["txt_igst"];
        $txt_grand = $_POST["txt_grand"];
        $txt_amt_in_word = $_POST["txt_amt_in_word"];
        $total_amt = $_POST["total_amt"];
        $hidden_agency = $_POST["hidden_agency"];


        $get_job_data = "select * from job WHERE `report_no`='$txt_report_no'";
        $resultset = mysqli_query($conn, $get_job_data);
        if (mysqli_num_rows($resultset) > 0) {
            $get_datas = mysqli_fetch_array($resultset);
            $report_sent_to = $get_datas['report_sent_to'];
            if ($report_sent_to == "0") {
                $update_gst = "update job set client_gstno='$gst_no' where `report_no`='$txt_report_no'";
            } else {
                $update_gst = "update job set agency_gstno='$gst_no' where `report_no`='$txt_report_no'";
            }
            $result_updategst = mysqli_query($conn, $update_gst);

            $clients_ids = $get_datas['client_code'];
            $authority = $get_datas['person_name'];
            $agreement_no = $get_datas['agreement_no'];
        } else {
            $clients_ids = 0;
            $authority = "";
            $agreement_no = "";
        }

        $sel_estimate = "select * from estimate_total_span_only_bill where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
        $result_estimate = mysqli_query($conn, $sel_estimate);

        if (mysqli_num_rows($result_estimate) > 0) {

            $update_est = "update estimate_total_span_only_bill set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`client_id`=$clients_ids,`authority`='$authority',`agreement_no`='$agreement_no',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_estimate = mysqli_query($conn, $update_est);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        } else {

            $insert_estimate = "insert into estimate_total_span_only_bill (`report_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`client_id`,`authority`,`agreement_no`,`rate_type`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`)
						values(
						'$txt_report_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
						 $clients_ids,
						'$authority',
						'$agreement_no',
						'$select_rate',
						'$hidden_gst_type',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00')";
            $result_insert_estimate = mysqli_query($conn, $insert_estimate);

            $update_save_material_assign = "update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
            $result_save_material_assign = mysqli_query($conn, $update_save_material_assign);
        }

        // get morr by report no andjob no
        $sel_span_mate = "select * from span_material_assign where `report_no`='$txt_report_no' AND `job_number`='$txt_job_no'";
        $query_span_mate = mysqli_query($conn, $sel_span_mate);
        $get_span_mate = mysqli_fetch_assoc($query_span_mate);

        $get_morr = $get_span_mate["morr"];
        $get_job_number = $get_span_mate["job_number"];
        $expected_date = $get_span_mate["expected_date"];
        $tested_by = $get_span_mate["tested_by"];
        $reported_by = $get_span_mate["reported_by"];


        // code to get sample receve date from job table
        $sel_jobs = "select * from job where `report_no`='$txt_report_no'";
        $query_jobs = mysqli_query($conn, $sel_jobs);
        $result_jobs = mysqli_fetch_array($query_jobs);
        $get_sample_rec_date = $result_jobs["sample_rec_date"];


        // update  morr and job_lab_assign in job table

        if ($get_morr == "m") {
            $j_n_progress = 0;
            $report_printing = 0;
            $set_expected_date = "0000-00-00";
            $set_re_sample_date = "0000-00-00";
        } else {
            $j_n_progress = 1;
            $report_printing = 1;
            $set_expected_date = $expected_date;
            $set_re_sample_date = $get_sample_rec_date;
        }



        $update_jobs = "update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=4 where `report_no`='$txt_report_no'";
        $query_update_jobs = mysqli_query($conn, $update_jobs);
    } else if ($_POST['action_type'] == 'get_material_by_category') {

        $explode_cate_id = explode("|", $_POST["select_material_category"]);
        $cate_id = $explode_cate_id[0];
        $get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0'";
        $select_result = mysqli_query($conn, $get_query);





        $out_materials = '<option value="" >Select Material</option>';


        if (mysqli_num_rows($select_result) > 0) {
            while ($row = mysqli_fetch_assoc($select_result)) {

                $out_materials .= '<option value="' . $row['id'] . "|" . $row['mt_name'] . '" >' . $row['mt_name'] . '</option>';
            }
        }


        $get_query_test = "select * from test_master WHERE `mat_category_id`='$cate_id' AND `test_isdeleted`='0'";
        $select_result_test = mysqli_query($conn, $get_query_test);

        $out_tests = '';

        if (mysqli_num_rows($select_result_test) > 0) {

            while ($rows = mysqli_fetch_assoc($select_result_test)) {

                $out_tests .= '<option value="' . $rows['test_id'] . '" >' . $rows['test_name'] . '</option>';
            }
        }

        $fill = array('all_material' => $out_materials, 'out_tests' => $out_tests);
        echo json_encode($fill);
    } elseif ($_POST['action_type'] == 'get_lab_by_material') {

        $explode_cate_id = explode("|", $_POST["select_material_category"]);
        $select_material_category = $explode_cate_id[0];
        $explode_material = explode("|", $_POST["select_material"]);
        $material_id = $explode_material[0];

        // get test by cate id and material id
        //$get_query_test = "select * from particular_test WHERE `mate_cat_id`=$select_material_category AND `mate_id`=$material_id  AND `is_deleted`=0";

        $get_query_test = "select * from test_master WHERE `mat_category_id`='$select_material_category' AND `test_isdeleted`=0";
        $select_result_test = mysqli_query($conn, $get_query_test);

        $out_tests = '<option value="" >Select Test</option>';
        if (mysqli_num_rows($select_result_test) > 0) {
            while ($result_test_array = mysqli_fetch_array($select_result_test)) {

                $out_tests .= '<option value="' . $result_test_array['test_id'] . "|" . $result_test_array['test_name'] . '" >' . $result_test_array['test_name'] . '</option>';
            }
        }

        $fill = array('out_tests' => $out_tests);
        echo json_encode($fill);
    } elseif ($_POST['action_type'] == 'insert_in_test_wise_table') {

        $mat_cat_id = $_POST["mat_cat_id"];
        $explode_material = explode("|", $_POST["select_material"]);
        $material_id = $explode_material[0];
        $select_test_explode = explode("|", $_POST["select_test"]);
        $select_test = $select_test_explode[0];

        // get test by cate id and material id
        //$get_query_test = "select * from particular_test WHERE `mate_cat_id`=$select_material_category AND `mate_id`=$material_id  AND `is_deleted`=0";
        //$select_result_test = mysqli_query($conn, $get_query_test);

        $insert_test_wise = "insert into test_wise_material_rate (`material_cat_id`,`material_id`,`test_id`,`qty`,`rate`,`amt`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deleted`)
						values(
						'$mat_cat_id',
						'$material_id',
						'$select_test',
						'',
						'',
						'',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00',
						'0')";
        $result_insert_test_wise = mysqli_query($conn, $insert_test_wise);


        $fill = array('msg' => "Done");
        echo json_encode($fill);
    } elseif ($_POST['action_type'] == 'get_material_by_category_more') {

        $explode_cate_id = explode("|", $_POST["select_material_category"]);
        $cate_id = $explode_cate_id[0];
        $get_more_count = $_POST["get_more_count"];
        $get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0' LIMIT $get_more_count,20";
        $select_result = mysqli_query($conn, $get_query);
        $out_materials = '';
        $get_rows_counts = mysqli_num_rows($select_result);

        if (mysqli_num_rows($select_result) > 0) {
            while ($row = mysqli_fetch_assoc($select_result)) {

                $out_materials .= '<option value="' . $row['id'] . '" >' . $row['mt_name'] . '</option>';
            }
        }

        $sel_mate_cat = "select * from material_category where `material_cat_id`=" . $cate_id;
        $query_catgory = mysqli_query($conn, $sel_mate_cat);
        $result_category = mysqli_fetch_assoc($query_catgory);
        $category_names = "";
        $category_names .= $result_category["material_cat_name"];

        $fill = array('all_material' => $out_materials, 'get_rows_counts' => $get_rows_counts, 'category_names' => $category_names);
        echo json_encode($fill);
    }
}

// convert in word function_exists
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
    return $result . "Rupees  Only";
}
