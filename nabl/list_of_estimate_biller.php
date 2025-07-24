<?php include("header.php"); ?>
<?php
if ($_SESSION['name'] == "") {
?>
    <script>
        window.location.href = "<?php echo $base_url; ?>index.php";
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


    <section class="content" style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
        <?php include("menu.php") ?>

        <div class="row">

            <h1 style="text-align:center;">
                List Of Estimate
            </h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        <a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
                        <br>
                        <br>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Agency:</label>
                                </div>
                                <div class="col-md-3">
                                    <label>Estimate No:</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="sel_agency_ids" id="sel_agency_ids" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
                                        <option value="">Select-Agency</option>
                                        <?php
                                        $sel_agencys = "select * from agency_master where `isdeleted`=0";
                                        $query_agencys = mysqli_query($conn, $sel_agencys);
                                        if (mysqli_num_rows($query_agencys) > 0) {
                                            while ($get_one_agency = mysqli_fetch_array($query_agencys)) { ?>
                                                <option value="<?php echo $get_one_agency['agency_id']; ?>"><?php echo $get_one_agency['agency_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="search_bill_no" id="search_bill_no" placeholder="Enter Bill No" class="form-control">
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_agency" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
                                </div>
                            </div>
                        </div>
                        <div id="display_data_report">
                            <table id="example2" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Prints</th>
                                        <th style="text-align:center;">Serial No</th>
                                        <th style="text-align:center;">Type</th>
                                        <th style="text-align:center;">Job No</th>
                                        <th style="text-align:center;">Invoice Name</th>
                                        <th style="text-align:center;">Estimate No</th>
                                        <th style="text-align:center;">Estimate Date</th>
                                        <th style="text-align:center;">Total Amount</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $query = "select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='0' AND `which_made`='1' ORDER BY est_id DESC LIMIT 0,200";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $count++;

                                        $get_one_trf_no = explode(",", $row['trf_no']);
                                        $one_trf_no = $get_one_trf_no[0];
                                        $query_job = "select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
                                        $result_job = mysqli_query($conn, $query_job);

                                        $sel_agency_id = $row["agency_id"];
                                        $sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;
                                        $result_agency = mysqli_query($conn, $sel_agency);
                                        $row_agency = mysqli_fetch_array($result_agency);
                                        $agency_name = $row_agency["agency_name"];



                                        $row_job = mysqli_fetch_array($result_job);
                                        $customer_name = $row_job['clientname'];
                                        if ($row["perfoma_type"] == "direct_perfoma") {
                                            $customer_name = $row['customer_name'];
                                        }

                                        $name_of_work = strip_tags(html_entity_decode($row_job["nameofwork"]), "<strong><em>");

                                        if ($row['make_test_bill'] == "1") {
                                            $make_test_bill = '<img src="images/green_dot.png">';
                                        } else {
                                            $make_test_bill = "";
                                        }
                                        if ($row['make_material_bill'] == "1") {
                                            $make_material_bill = '<img src="images/green_dot.png">';
                                        } else {
                                            $make_material_bill = "";
                                        }
                                        if ($row['make_estimate'] == "1") {
                                            $make_estiamte = '<img src="images/green_dot.png">';
                                        } else {
                                            $make_estiamte = "";
                                        }

                                    ?>
                                        <tr>
                                            <td>
                                                <input type="text" class="print_counts" style="width: 90px;"  value="<?php echo $row["print_counts"]; ?>" data-id="<?php echo $row["est_id"]; ?>">
                                            </td>
                                            <td style="text-align:center;"><?php echo $count; ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                //if perfoma type is excel then only excel button view
                                                if ($row["perfoma_type"] == "excel") {
                                                    echo "EXCEL";
                                                }
                                                if ($row["perfoma_type"] == "direct_perfoma") {
                                                    echo "DIRECT PERFOMA";
                                                }
                                                if ($row["perfoma_type"] != "excel" && $row["perfoma_type"] != "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel") {
                                                    echo "REGULAR";
                                                }
                                                if ($row["perfoma_type"] == "direct_perfoma_excel") {
                                                    echo "DIRECT PERFOMA EXCEL";
                                                }
                                                ?>
                                            </td>
                                            <td style="white-space:nowrap;text-align:center;">
                                                <?php
                                                $explode_job = explode(",", $row['job_no']);
                                                $set_counts_job = 1;
                                                foreach ($explode_job as $keys => $one_jobs) {
                                                    if ($set_counts_job == 4) {
                                                        echo $one_jobs . "</br>";
                                                        $set_counts_job = 0;
                                                    } else {
                                                        echo $one_jobs . ",";
                                                    }

                                                    $set_counts_job++;
                                                }
                                                ?>
                                            </td>
                                            <td style="white-space:nowrap;text-align:center;">
                                                <?php
                                                //if($row["bill_to"]=="0"){ echo $agency_name; }else{ echo $customer_name;  }
                                                echo $row["bill_to_name"];
                                                ?>
                                            </td>
                                            <td style="white-space:nowrap;text-align:center;"><?php echo $row["estimate_numbers"]; ?></td>
                                            <td style="white-space:nowrap;text-align:center;"><?php
                                                                                                $date = new DateTime($row['estimating_date']);
                                                                                                echo $date->format('d-m-Y');
                                                                                                ?></td>
                                            <td style="white-space:nowrap;text-align:center;"><?php
                                                                                                echo $row['taxable_amnt']
                                                                                                ?></td>
                                            <td style="text-align:center;">

                                                <?php
                                                //if perfoma type is excel then only excel button view
                                                if ($row["perfoma_type"] == "direct_perfoma_excel") {
                                                ?>
                                                    <a href="span_edit_direct_perfoma_excel_upload.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;Direct perfoma Excel&nbsp;&nbsp;</a>

                                                    <a href="span_invoice_excel_upload_for_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
                                                    &nbsp;
                                                <?php
                                                } else if ($row["perfoma_type"] == "excel") {
                                                ?>
                                                    <a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) perfoma Excel&nbsp;&nbsp;</a>

                                                    <a href="span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
                                                    &nbsp;
                                                <?php



                                                } else {
                                                ?>
                                                    <?php
                                                    if ($row["perfoma_type"] == "direct_perfoma") {
                                                    ?>
                                                        <a href="span_edit_new_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D) perfoma&nbsp;&nbsp;</a>
                                                        &nbsp;

                                                        <a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_test_bill; ?> Invoice By Test&nbsp;&nbsp;</a>

                                                        <a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_material_bill; ?> Invoice By Material&nbsp;&nbsp;</a>

                                                        <a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no']; ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_estiamte; ?> Estimate&nbsp;&nbsp;</a>

                                                        <?php
                                                    } else {
                                                        if ($row["make_by"] == "0") {
                                                        ?>
                                                            <!--<a href="update_perfoma.php?perfoma_nos=<?php //echo $row['perfoma_no'];
                                                                                                        ?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->
                                                            &nbsp;
                                                            <a href="estimate_print.php?perfoma_nos=<?php echo $row['perfoma_no']; ?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Print&nbsp;&nbsp;</a>
                                                            &nbsp;
                                                        <?php } else { ?>
                                                            <!--<a href="update_perfoma_by_material.php?perfoma_nos=<?php //echo $row['perfoma_no'];
                                                                                                                    ?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->

                                                            <a href="estimate_print_by_material.php?perfoma_nos=<?php echo $row['perfoma_no']; ?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Print&nbsp;&nbsp;</a>
                                                            &nbsp;
                                                        <?php } ?>

                                                        <!--<a href="make_bill.php?perfoma_nos=<?php //echo $row['perfoma_no'];
                                                                                                ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Invoice&nbsp;&nbsp;</a>

												<a href="perfoma_print_by_material.php?perfoma_nos=<?php //echo $row['perfoma_no'];
                                                                                                    ?>&&print_counts=<?php //echo base64_encode($row["print_counts"]);
                                                                                                                        ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Estimate&nbsp;&nbsp;</a>-->


                                                        <!--<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php //echo $row['trf_no'];
                                                                                                                            ?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span><?php //echo $make_estiamte;
                                                                                                                                                                                                                    ?> &nbsp;Estimate&nbsp;&nbsp;</a>-->
                                                    <?php


                                                    }
                                                }

                                                if ($row["perfoma_type"] != "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel") {
                                                    ?>
                                                    <a href="list_of_multi_trf.php?chk_array=<?php echo $row['trf_no']; ?>" class="btn btn-success" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> &nbsp;Trf&nbsp;&nbsp;</a>

                                                    &nbsp;
                                                <?php
                                                }
                                                ?>




                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>

                        </div>


                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 90%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="display_data_for_update" style="text-align:center;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php include("footer.php"); ?>

<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            'autoWidth': true,
            'scrollX': true,
            "lengthMenu": [
                [100, 200, 250, -1],
                [100, 200, 250, "All"]
            ],
            buttons: ['copy'],
            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'excel',
                    footer: true,
                }
            ],
        });
        $(function() {
            $('.select2').select2()
        })

    });

    $(document).on("click", ".get_bill_for_edit", function() {
        var abc = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
            data: 'action_type=get_bill_for_edit&abc=' + abc,
            success: function(html) {
                $('#display_data_for_update').html(html);
            }
        });
    });

    $(document).on("click", ".cancel_bill_by_id", function() {
        var abc = $(this).attr('data-id');
        $.confirm({
            title: "warning",
            content: "Are You Sure To Cancel This Bill ?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
                        data: 'action_type=cancel_bill_by_id&abc=' + abc,
                        success: function(html) {
                            window.location.href = "<?php echo $base_url; ?>list_of_final_bill_by_biller.php";
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        })
    });

    $(document).on("click", ".update_bill_by_id", function() {

        var cheque_date = $("#cheque_date").val();
        var chequeno = $("#chequeno").val();
        var bank_name = $("#bank_name").val();
        var old_bill_no = $("#old_bill_no").val();
        var bill_amt = $("#bill_amt").val();
        var tds = $("#tds").val();
        var paid_amt = $("#paid_amt").val();
        var remarks = $("#remarks").val();
        var cheque_amt = $("#cheque_amt").val();
        var hidden_what_and_ids = $("#hidden_what_and_ids").val();

        $.ajax({
            type: 'POST',
            url: '<?php $base_url; ?>save_span_perfoma_excel_upload.php',
            data: 'action_type=update_bill_by_id&&cheque_date=' + cheque_date + '&chequeno=' + chequeno + '&bank_name=' + bank_name + '&old_bill_no=' + old_bill_no + '&bill_amt=' + bill_amt + '&tds=' + tds + '&paid_amt=' + paid_amt + '&remarks=' + remarks + '&cheque_amt=' + cheque_amt + '&hidden_what_and_ids=' + hidden_what_and_ids,
            success: function(html) {
                window.location.href = "<?php echo $base_url; ?>list_of_final_bill_by_biller.php";

            }
        });

    });

    $(document).on("change", "input[name='gst_type']", function() {

        var gst_type = $('input[name=gst_type]:checked').val();
        var bill_amnts = $('#bill_amt').val();
        $('#tds_percent').val("0");

        if (gst_type == "direct") {

            $('#grand_total').val(bill_amnts);
        }
        if (gst_type == "cut_gst") {
            var gst_amt = (+bill_amnts) / 1.18;
            //var grands_total= (+bill_amnts)-(+gst_amt);
            $('#grand_total').val(gst_amt.toFixed(2));
        }
    });

    $(document).on("change", "#tds_percent", function() {

        var bill_amnts = $('#bill_amt').val();
        var grand_total = $('#grand_total').val();
        var tds_percent = $('#tds_percent').val();

        var tds_amt = (+grand_total) * (+tds_percent) / 100;
        $('#tds').val(tds_amt);
        var get_tds = $('#tds').val();
        var paid_total = (+bill_amnts) - (+get_tds);
        $('#paid_amt').val(paid_total.toFixed());
    });

    $(".search_job_by_agency").click(function() {

        var sel_agency_ids = $('#sel_agency_ids').val();
        var bill_no = $('#search_bill_no').val();


        if (sel_agency_ids == "" && bill_no == "") {
            alert("Please Atlist One select");
            return false;
        }
        var postData = '&type=search_all_job_for_admin&sel_agency_ids=' + sel_agency_ids + '&bill_no=' + bill_no;

        $.ajax({
            url: "<?php echo $base_url; ?>search_list_of_estimate_biller.php",
            type: "POST",
            data: postData,
            beforeSend: function() {
                document.getElementById("overlay_div").style.display = "block";
            },
            success: function(data, status, xhr) {
                document.getElementById("overlay_div").style.display = "none";
                $("#display_data_report").html(data);
            }
        });
    });
</script>