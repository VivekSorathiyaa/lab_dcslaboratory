<?php
error_reporting(1);
session_start();
include("connection.php");
?>
<?php
if ($_SESSION['name'] == "") {
    ?>
    <script>
        window.location.href = "<?php echo $base_url; ?>index.php";
    </script>
    <?php
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGenLIMS Technologiestax invoice</title>
</head>

<body>
    <?php
    // get estimate by report no and job no
    $perfoma_nos = $_GET["perfoma_nos"];
    $print_counts = base64_decode($_GET["print_counts"]);
    //$plused_counts=intval($print_counts)+2;
    $plused_counts = 28;

    $sel_estiamte = "select * from estimate_total_span where `perfoma_no`='$perfoma_nos'";
    $result_estiamte = mysqli_query($conn, $sel_estiamte);
    $row_estiamte = mysqli_fetch_array($result_estiamte);

    $explode_trf_no = explode(",", $row_estiamte["trf_no"]);
    $one_trf_no = $explode_trf_no[0];


    // get name of agency by report no and job no from agency table
    $sel_agency_id = $row_estiamte["agency_id"];
    $hsn_codes = $row_estiamte["hsn_codes"];
    $bill_no = $row_estiamte["bill_no"];
    $bill_to = $row_estiamte["bill_to"];
    $gst_type = $row_estiamte["gst_type"];
    $gst_in_or_ex = $row_estiamte["gst_in_or_ex"];
    $discount_percent = $row_estiamte["discount_percent"];
    $discount_amount = $row_estiamte["discount_amount"];
    $invoice_date = $row_estiamte["estimate_date"];

    $letter_heading = $row_estiamte["letter_heading"];
    $letter_nos = $row_estiamte["letter_nos"];
    $letter_dated = $row_estiamte["letter_dated"];

    $est_id = $row_estiamte["est_id"];
    $branch_short_code = $row_estiamte["branch_short_code"];

    $sel_branch = "select * from branches where `branch_short_code`='$branch_short_code'";
    $query_branch = mysqli_query($conn, $sel_branch);
    $row_branch = mysqli_fetch_array($query_branch);
    $company_name = $row_branch["company_name"];
    $company_logo = $row_branch["company_logo"];
    $company_address = $row_branch["company_address"];
    $contact_mobile = $row_branch["contact_mobile"];
    $branch_name = $row_branch["branch_name"];
    $bank_name = $row_branch["bank_name"];
    $bank_account_no = $row_branch["bank_account_no"];
    $ifsc_code = $row_branch["ifsc_code"];
    $pan_no = $row_branch["pan_no"];
    $branch_gst_no = $row_branch["gst_no"];

    $sel_agency = "select * from agency_master where `isdeleted`=0 and `agency_id`=" . $sel_agency_id;
    $result_agency = mysqli_query($conn, $sel_agency);
    $row_agency = mysqli_fetch_array($result_agency);
    $agency_name = $row_agency["agency_name"];
    $agency_address = $row_agency["agency_address"];
    $agency_gst = $row_agency["agency_gstno"];


    // get name of work from job by report no
    $sel_job = "select * from job where `trf_no`='$one_trf_no'";
    $result_job = mysqli_query($conn, $sel_job);
    $row_job = mysqli_fetch_array($result_job);
    $name_of_work = strip_tags(html_entity_decode($row_job["nameofwork"]), "<strong><em>");

    $get_report_to = $row_job["report_sent_to"];
    $clientname = $row_job["clientname"];
    $agreement_no = $row_job["agreement_no"];
    $client_gstno = $row_job["client_gstno"];

    // set report  send to
    if ($bill_to == "1") {

        $sel_agency = "select * from agency_master where `isdeleted`=0 AND `agency_id`=" . $row_estiamte["bill_to_id"];
        $result_agency = mysqli_query($conn, $sel_agency);
        $row_agency = mysqli_fetch_array($result_agency);

        $sel_city = "select * from city where `id`='$row_agency[agency_city]'";
        $result_city = mysqli_query($conn, $sel_city);
        $row_city = mysqli_fetch_array($result_city);

        $get_clients_name = $row_agency["agency_name"];
        $get_clients_address = $row_agency["agency_address"] . "," . $row_city["city_name"];
        $gst_nos = $row_agency["agency_gstno"];
    }
    if ($bill_to == "0") {

        $sel_city = "select * from city where `id`='$row_agency[agency_city]'";
        $result_city = mysqli_query($conn, $sel_city);
        $row_city = mysqli_fetch_array($result_city);
        $gst_nos = $row_job["client_gstno"];

        $get_clients_name = $agency_name;
        $get_clients_address = $agency_address . "," . $row_city["city_name"];
        $gst_nos = $agency_gst;
    }
    if ($bill_to == "2") {



        $get_clients_name = $row_estiamte["other_customer_name"];
        $get_clients_address = $row_estiamte["other_customer_address"];
        $gst_nos = $row_estiamte["other_customer_gst_no"];
    }
    $gst_no = $gst_nos;


    //get from tax
    /*  $sel_tax="select * from tax";
        $result_tax =mysqli_query($conn,$sel_tax);
        $get_tax =mysqli_fetch_array($result_tax); */

    $mat_ids_array = explode(",", $row_estiamte["mat_ids"]);
    $mat_name_array = explode(",", $row_estiamte["mate_name"]);
    $test_ids_array = explode(",", $row_estiamte["test_ids"]);
    $test_name_array = explode(",", $row_estiamte["test_name"]);
    $test_qty_array = explode(",", $row_estiamte["test_qty"]);
    $test_rates_array = explode(",", $row_estiamte["test_rates"]);
    $test_totals_array = explode(",", $row_estiamte["test_totals"]);
    $trf_no_array = explode(",", $row_estiamte["trf_no_array"]);

    $grand_total = $row_estiamte["grand_total"];
    $discount_percent = $row_estiamte["discount_percent"];
    $discount_amount = $row_estiamte["discount_amount"];

    $charge_one = $row_estiamte["charge_one"];
    $charge_one_percentage = $row_estiamte["charge_one_percentage"];
    $charge_one_amount = $row_estiamte["charge_one_amount"];

    $charge_two = $row_estiamte["charge_two"];
    $charge_two_percentage = $row_estiamte["charge_two_percentage"];
    $charge_two_amount = $row_estiamte["charge_two_amount"];

    $discount_percentage = $row_estiamte["discount_percentage"];
    $discount_amnt = $row_estiamte["discount_amnt"];
    $taxable_amnt = $row_estiamte["taxable_amnt"];

    $c_gst_amt = $row_estiamte["c_gst_amt"];
    $s_gst_amt = $row_estiamte["s_gst_amt"];
    $i_gst_amt = $row_estiamte["i_gst_amt"];

    $round_up_amnt = $row_estiamte["round_up_amnt"];
    $total_amt = $row_estiamte["total_amt"];
    $which_made = $row_estiamte["which_made"];

    $refno = "";
    $now_arraying = array();
    $refno_arraying = array();
    $reference_arraying = array();
    foreach ($explode_trf_no as $one_trf_nos) {
        $sel_job = "select * from job where `trf_no`='$one_trf_nos'";
        $result_job = mysqli_query($conn, $sel_job);
        $row_job = mysqli_fetch_array($result_job);
        $refno .= '<span style="min-width:100px;">' . $row_job["refno"] . '</span>' . "&nbsp;&nbsp;&nbsp;&nbsp;Date:-&nbsp;&nbsp;" . date('Y-m-d', strtotime($row_job["date"])) . "<br>";

        if (!in_array($row_job["nameofwork"], $now_arraying)) {
            if ($row_job["refno"] != "") {
                $refno_arraying[$one_trf_nos] = $row_job["refno"] . " Dated:" . date('d-m-Y', strtotime($row_job["date"]));
                $now_arraying[$one_trf_nos] = $row_job["nameofwork"];
                $reference_arraying[$one_trf_nos] = "Reference:";
            }
        } else {
            if ($row_job["refno"] != "") {
                $keys = array_search($row_job["nameofwork"], $now_arraying);
                $plus = $refno_arraying[$keys] . ", " . $row_job["refno"] . " Dated:" . date('d-m-Y', strtotime($row_job["date"]));
                $refno_arraying[$keys] = $plus;
                $reference_arraying[$keys] = "Reference:";
            }
        }

        $update_jobs = "update job set `print_done_by_biller_for_qm_see`=1 where `trf_no`='$one_trf_nos'";
        $results_jobs = mysqli_query($conn, $update_jobs);
    }

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <bR><br><Br><bR><br><Br>
    <table width="92%" style="margin-left: auto;margin-right: auto;text-align:center;">
        <tr>
            <td style="font-size:16px;" colspan="4"><b>PROFORMA</b></td>
        </tr>
    </table>
    <table width="92%" cellspacing="0" style="margin-left: auto;margin-right: auto; border:1px solid black;">
        <tr>
            <td style="font-size:14px; vertical-align: top;" colspan="2"><b><?php echo $company_name; ?></b></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;border-top:0px;width:20%;">
                <small>Proforma No</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-top:0px;border-right:0px;width:20%;">
                <small>Dated</small></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2" rowspan="2"><?php echo $company_address; ?></td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;">
                <b>A000092</b></td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;">
                <b>23-Jan-25</b></td>
        </tr>
        <tr>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Delivery Note</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Mode/Terms of Payment</small></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2">GSTIN/UIN: <?php echo $branch_gst_no; ?></td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2">State Name : Himachal Pradesh , Code : 02</td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Reference No. & Date.</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Other References</small></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2"> E-Mail : officialdcspvtltd@gmail.com</td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid black; vertical-align: top; " colspan="2"><small>Consignee (Ship
                    to)</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Buyer's Order No.</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Dated</small></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2" rowspan="2"><b><?php echo $get_clients_name; ?></b></td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
        </tr>
        <tr>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Dispatch Doc No.</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Delivery Note Date</small></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2" rowspan="3"> <?php echo $get_clients_address; ?></b></td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
        </tr>
        <tr>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Dispatched through</small></td>
            <td
                style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;">
                <small>Destination</small></td>
        </tr>
        <tr>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"><b></b>
            </td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2">GSTIN/UIN :<?php echo $gst_no; ?></td>
            <td style="font-size:12px;vertical-align:top;border:1px solid black;border-bottom:0px;border-right:0px;width:20%;"
                colspan="2"><small>Terms of Delivery</small></td>

        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2"> State Name :Himachal Pradesh, Code : 02</td>
            <td style="font-size:12px;border:1px solid black;border-top:0px;border-bottom:0px;border-right:0px;"
                rowspan="9"><b></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid black; vertical-align: top;" colspan="2"><small>Buyer (Bill to)</small>
            </td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2"><b><?php echo $get_clients_name; ?></b></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2"> <?php echo $get_clients_address; ?></b></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2">GSTIN/UIN :<?php echo $gst_no; ?></td>
        </tr>
        <tr>
            <td style="font-size:13px;" colspan="2"> State Name :Himachal Pradesh, Code : 02</td>
        </tr>
    </table>
    <table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto;border: 1px solid; border-top:0px;">
        <tr align="center">
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">SI
                <br>no.</td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">
                Description of<br>Services</td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">
                HSN/SAC</td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">
                Quantity</td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">
                Rate<br><small>(Incl. of Tax)</small></td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">Rate
            </td>
            <td style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px;">per
            </td>
            <td
                style="font-size: 13px; vertical-align: top; border: 1px solid; border-top: 0px; border-left: 0px; border-right: 0px;">
                Amount</td>
        </tr>
        <?php
        $now_array = array();
        $contings = 0;
        $set_page_no = 0;
        if ($test_name_array == $print_counts) {

            $total_counts = ceil(count($test_name_array) / $print_counts);
        } else {

            $total_counts = ceil(count($test_name_array) / ($print_counts + 1));
        }
        if ($total_counts == 0) {
            $total_counts = 1;
        }
        foreach ($explode_trf_no as $one_chk_array) {
            $sel_jobs = "select nameofwork,refno from job where `trf_no`='$one_chk_array'";
            $query_jobs = mysqli_query($conn, $sel_jobs);
            $get_now = mysqli_fetch_array($query_jobs);
            $name_of_works = $get_now["nameofwork"];
            /*  if (!in_array($name_of_works, $now_array))
             { */
            foreach ($test_name_array as $one_key => $one_tests) {
                if ($one_chk_array == $trf_no_array[$one_key]) {
                    $contings++;
                    ?>
                    <tr align="center">
                        <td style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px; border-bottom: 0px;">
                            <b><?php echo $one_key + 1; ?></b></td>
                        <td
                            style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;text-align: left; border-bottom: 0; ">
                            <b>Inspection of <?php echo $mat_name_array[$one_key]; ?></b></td>
                        <td style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;  border-bottom: 0;">998346
                        </td>
                        <td
                            style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;text-align: right;  border-bottom: 0;">
                            <b><?php echo $test_qty_array[$one_key]; ?> No.</b></td>
                        <td
                            style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;text-align: right;  border-bottom: 0;">
                            <?php echo number_format(($test_rates_array[$one_key] + $test_rates_array[$one_key] * 0.18), 2); ?></td>
                        <td
                            style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;text-align: right;  border-bottom: 0;">
                            <?php echo $test_rates_array[$one_key]; ?></td>
                        <td style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;  border-bottom: 0;">No.
                        </td>
                        <td
                            style="font-size: 13px; border: 1px solid; border-top: 0px; border-left: 0px;text-align: right;  border-bottom: 0; border-right: 0px;">
                            <b><?php echo $test_totals_array[$one_key] . ".00"; ?></b></td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px; border-right: 1px solid; border-top: 0;"></td>
                        <td style="font-size: 13px; border-top: 0px; border-right: 1px solid;"><small><i>
                                    <?php echo strip_tags($name_of_works); ?></i></small></td>
                        <td style="border-right: 1px solid; border-top: 0;"></td>
                        <td style="border-right: 1px solid; border-top: 0;"></td>
                        <td style="border-right: 1px solid; border-top: 0;"></td>
                        <td style="border-right: 1px solid; border-top: 0;"></td>
                        <td style="border-right: 1px solid; border-top: 0;"></td>
                        <td style="border-top: 0;"></td>
                    </tr>
                    <?php
                }
            }
        }

        /* for($i=$plused_counts;$i>$contings;$i--)
        {
        echo '<tr><td colspan="7" style="border: 0px;">&nbsp;</td></tr>';
        } */


        ?>

        <?php
        if ($s_gst_amt != "0") {
            ?>
            <tr>
                <td style="font-size: 13px; border-right: 1px solid; border-top: 0;"></td>
                <td style="font-size: 13px; border-top: 0px; border-right: 1px solid; text-align: right;"><b>SGST</b></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-top: 0; text-align: right;"><b><?php echo $s_gst_amt; ?></b></td>
            </tr>
            <?php
        }
        ?>

        <?php
        if ($c_gst_amt != "0") {
            ?>
            <tr>
                <td style="font-size: 13px; border-right: 1px solid; border-top: 0;"></td>
                <td style="font-size: 13px; border-top: 0px; border-right: 1px solid; text-align: right;"><b>CGST</b></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-top: 0; text-align: right;"><b><?php echo $c_gst_amt; ?></b></td>
            </tr>
            <?php
        }
        ?>
        <?php
        if ($i_gst_amt != "0") {
            ?>
            <tr>
                <td style="font-size: 13px; border-right: 1px solid; border-top: 0;"></td>
                <td style="font-size: 13px; border-top: 0px; border-right: 1px solid; text-align: right;"><b>IGST</b></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-top: 0; text-align: right;"><b><?php echo $i_gst_amt; ?></b></td>
            </tr>
            <?php
        }
        ?>
        <?php
        if ($round_up_amnt != "0") {
            ?>
            <tr>
                <td style="font-size: 13px; border-right: 1px solid; border-top: 0;"></td>
                <td style="font-size: 13px; border-top: 0px; border-right: 1px solid; text-align: right;"><b>Round off</b>
                </td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-right: 1px solid; border-top: 0;"></td>
                <td style="border-top: 0; text-align: right;"><b><?php echo $round_up_amnt; ?></b></td>
            </tr>
            <?php
        }
        ?>
        <tr align="center">
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px; border-bottom: 0px;"></td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;text-align: right; border-bottom: 0; ">
                Total</td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;  border-bottom: 0;"></td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;text-align: right;  border-bottom: 0;"><b>1
                    No.</b></td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;text-align: right;  border-bottom: 0;">
            </td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;text-align: right;  border-bottom: 0;">
            </td>
            <td style="font-size: 13px; border: 1px solid;  border-left: 0px;  border-bottom: 0;"></td>
            <td
                style="font-size: 13px; border: 1px solid;  border-left: 0px;text-align: right;  border-bottom: 0; border-right: 0px;">
                <b>₹ <?php echo number_format($total_amt, 2); ?></b></td>
        </tr>
    </table>
    <table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto;border: 1px solid; border-top:0px;">
        <tr>
            <td colspan="8"><small>Amount Chargeable (in words)</small></td>
            <td style="text-align: right;"><small>E. & O.E</small></td>
        </tr>
        <tr>
            <td colspan="8" style="font-size: 13px;text-transform: uppercase;"><b>INR
                    <?php echo getIndianCurrency($total_amt); ?></b></td>
            <td></td>
        </tr>
        <tr align="center">
            <td rowspan="2" style="border: 1px solid; border-left: 0px; border-bottom:0px; width: 41%;">
                <small>HSN/SAC</small></td>
            <td rowspan="2" style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Taxable
                    <br>Value</small></td>
            <td colspan="2" style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>CGST</small></td>
            <td colspan="2" style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>SGST/UTGST</small>
            </td>
            <td colspan="2" style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>IGST</small></td>
            <td rowspan="2" style="border: 1px solid; border-left: 0px;  border-bottom:0px; border-right: 0px;">
                <small>Total<br>Tax Amount</small></td>
        </tr>
        <tr align="center">
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Rate</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Amount</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Rate</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Amount</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Rate</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>Amount</small></td>
        </tr>
        <tr align="center">
            <td style="border: 1px solid; border-left: 0px; border-bottom:0px; width: 41%;"><small>998346</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;">
                <small><?php echo $taxable_amnt; ?></small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>9%</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small><?php echo $c_gst_amt; ?></small>
            </td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>9%</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small><?php echo $s_gst_amt; ?></small>
            </td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small>18%</small></td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px;"><small><?php echo $i_gst_amt; ?></small>
            </td>
            <td style="border: 1px solid; border-left: 0px;  border-bottom:0px; border-right: 0px;"><small><?php
            $gst_totals = $s_gst_amt + $c_gst_amt + $i_gst_amt;
            echo number_format($gst_totals, 2);
            ?></small></td>
        </tr>
        <tr align="center">
            <td style="border: 1px solid; border-left: 0px;  width: 41%; text-align: right;"><small><b>Total</b></small>
            </td>
            <td style="border: 1px solid; border-left: 0px;"><small><?php echo $taxable_amnt; ?></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small><?php echo $c_gst_amt; ?></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small><?php echo $s_gst_amt; ?></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small></small></td>
            <td style="border: 1px solid; border-left: 0px; "><small><?php echo $i_gst_amt; ?></small></td>
            <td style="border: 1px solid; border-left: 0px;  border-right: 0px;"><small><?php
            $gst_totals = $s_gst_amt + $c_gst_amt + $i_gst_amt;
            echo number_format($gst_totals, 2); ?>
        </tr>
        <tr>
            <td colspan="8" style="text-transform: uppercase;"><small>Tax Amount (in words) : <b> INR
                        <?php echo getIndianCurrency($gst_totals); ?></b></small></td>
        </tr>
        <tr>
            <td><small>Declaration</small></td>
            <td><small>Company's Bank Details</small></td>
        </tr>
        <tr>
            <td><small>We declare that this invoice shows the actual price of the <br>Goods described and that all
                    particulars are true and correct.</small></td>
            <td><small>Bank name:<b>HDFC</b></small><br>
                <small>A/c No.: <b> 50200096119971</b></small><br>
                <small>Branch & IFS Code: <b> PAPROLA & HDFC0007667</b></small>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid; border-bottom: 0px; border-right: 0px; vertical-align:top;"><small>Customer's
                    Seal and Signature</small></td>
            <td style="border: 1px solid; text-align: right; border-bottom: 0px; border-right: 0px;" colspan="8">
                <b><small>for NextGenLIMS TechnologiesENGINEERS AND CONSULTANT PVT
                        LTD</small></b><br><bR><br><br><bR><br></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid;"><small></small></td>
            <td style=" text-align: right; font-size: 15px;" colspan="8"><small>Authorised Signatory</small></td>
        </tr>
    </table>
    <input
        style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;"
        type="button" name="print_button" id="print_button" value="PRINT">


    <?php if ($which_made == "0") { ?>

        <a href="update_perfoma.php?perfoma_nos=<?php echo $_GET['perfoma_nos']; ?>" class="btn btn-primary" title=""
            style="" id="edit_button">
            <input
                style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;"
                type="button" name="print_button" id="print_button" value="EDIT">

        </a>

        <a href="javascript:void(0);" class=" btn-danger perfoma_deletes" data-id="<?php echo $est_id; ?>"
            title="Material Assign" style="" id="delete_button">
            <input
                style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;"
                type="button" name="print_button" id="print_button" value="DELETE">
        </a>
    <?php } ?>
</body>

</html>
<link rel="stylesheet" href="bower_components/custom/jquery-confirm.min.css">
<script src="bower_components/jquery-confirm.min.js"></script>
<?php

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else
            $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . " Only";
}
?>
<script type="text/javascript">
    $("#print_button").on("click", function () {
        $('#print_button').hide();
        $('#edit_button').hide();
        $('#delete_button').hide();
        window.print();
    });

    $(document).on("click", ".perfoma_deletes", function () {
        var clicked_id = $(this).attr("data-id");
        $.confirm({
            title: "warning",
            content: "Are You Sure To Delete This Perfoma ?",
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_engineer.php',
                        data: 'action_type=perfoma_deletes&clicked_id=' + clicked_id,
                        success: function (html) {
                            window.location.href = "<?php echo $base_url; ?>list_of_completed_perfoma_for_biller.php";

                        }
                    });

                },
                cancel: function () {
                    return;
                }
            }
        })
    });
</script>