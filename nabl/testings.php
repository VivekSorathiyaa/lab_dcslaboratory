<?php
session_start();
include("header.php");
include("connection.php");
error_reporting(1);
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

    .visually-hidden {
        position: absolute;
        left: -100vw;
        /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
    }
</style>
<?php
// GET DATA FROM URL VAIBHAV
if (isset($_GET['report_no'])) {
    $report_no = $_GET['report_no'];
}
if (isset($_GET['trf_no'])) {
    $trf_no = $_GET['trf_no'];
}
if (isset($_GET['job_no'])) {
    $job_no = $_GET['job_no'];
}
if (isset($_GET['lab_no'])) {
    $lab_no = $_GET['lab_no'];
    $aa    = $_GET['lab_no'];
}
if (isset($_GET['ulr'])) {
    $ulr = $_GET['ulr'];
}


?>
<div class="content-wrapper" style="margin-left:0px !important;">
    <section class="content span-cement-box">
        <?php include("menu.php") ?>
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h2 style="text-align:center;">Excel Upload</h2>
                    </div>
                    <div class="box-default">
                        <form class="form" id="Glazed" method="post">
                            <!-- REPORT NO AND JOB NO PUT VAIBHAV-->
                            <div class="row">
                                <br>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" id="report_no" value="<?php echo $report_no; ?>" name="report_no" ReadOnly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <!--<label for="inputEmail3" class="col-sm-2 control-label">Job No.:</label>-->
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" tabindex="1" value="<?php echo $job_no; ?>" id="job_no" name="job_no" ReadOnly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                            <br>
                            <!-- LAB NO PUT VAIBHAV-->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label for="chk_auto">Job No. :</label>
                                            <input type="checkbox" class="visually-hidden" name="chk_auto" id="chk_auto" value="chk_auto">
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control inputs" tabindex="4" id="lab_no" value="<?php echo $lab_no; ?>" name="lab_no" ReadOnly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="panel-group" id="accordion">
                                <?php
                                $is_upload = "select * from span_material_assign WHERE `trf_no`='$trf_no' and `job_number`='$job_no'and isdeleted='0'";

                                $result_upload = mysqli_query($conn, $is_upload);
                                if (mysqli_num_rows($result_upload) > 0) { ?>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_file">
                                                    <h4 class="panel-title">
                                                        <b>FILE UPLOAD</b>
                                                    </h4>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_file" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-1">
                                                            <a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <label for="inputEmail3" class="col-sm-12 control-label">Upload Excel :</label>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <input type="file" class="form-control" id="upload_excel" name="upload_excel">
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
                                                        </div>

                                                    </div>
                                                    <div id="view_excel_from_table" class="col-sm-8">
                                                        <table border="1px solid black" align="center" width="100%">
                                                            <tr>
                                                                <th>Download</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            <?php
                                                            $query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no' and report_no='$report_no'";
                                                            $result_file = mysqli_query($conn, $query_file);
                                                            if (mysqli_num_rows($result_file) > 0) {
                                                                while ($r_file = mysqli_fetch_array($result_file)) {
                                                            ?>
                                                                    <tr>
                                                                        <td><a href="<?php echo $base_url . $r_file['excel_sheet']; ?>" download><?php echo $r_file['excel_sheet']; ?></a></td>
                                                                        <td><a href="javascript:void(0);" class="delete_excels" data-id="<?php echo $r_file['id']; ?>">Delete</a></td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>


                                                </div>
                                            </div>
                                            <br>
                                        </div>

                                    </div>
                                    <br>
                            </div>
                        <?php }     ?>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
                            <input type="hidden" class="form-control" name="idEdit" id="idEdit" />

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>

</div>

<?php include("footer.php"); ?>
<script>
    $("#btn_upload_excel").click(function() {
        form_data = new FormData();
        var acb = $('#upload_excel').val();
        if (acb == "") {
            alert("Upload excel First");
            return false;
        }
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no; ?>";
        var report_no = "<?php echo $report_no; ?>";

        var file_data = $('#upload_excel').prop('files')[0];
        var form_data = new FormData(); // Create a FormData object
        form_data.append('file', file_data); // Append all element in FormData  object
        form_data.append('lab_no', lab_no); // Append all element in FormData  object
        form_data.append('job_no', job_no); // Append all element in FormData  object
        form_data.append('report_no', report_no); // Append all element in FormData  object

        $.ajax({
            url: '<?php $base_url; ?>excel_upload_test.php', // point to server-side PHP script
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(output) {
                get_excel_record(); // display response from the PHP script, if any
            }
        });
        $('#upload_excel').val('');
    });

    function get_excel_record() {
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no; ?>";
        var report_no = "<?php echo $report_no; ?>";
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>excel_upload_test.php',
            data: 'action_type=get_excel_record&lab_no=' + lab_no + '&job_no=' + job_no + '&report_no=' + report_no,
            success: function(html) {
                $('#view_excel_from_table').html(html);
            }
        });
    }

    $(document).on("click", ".delete_excels", function() {
        var clicked_id = $(this).attr("data-id");
        $.confirm({
            title: "warning",
            content: "Are You Sure To Delete This Excel?",
            buttons: {
                confirm: function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?php $base_url; ?>excel_upload_test.php',
                        data: 'action_type=delete_excels&clicked_id=' + clicked_id,
                        success: function(html) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {
                    return;
                }
            }
        })
    });
</script>
