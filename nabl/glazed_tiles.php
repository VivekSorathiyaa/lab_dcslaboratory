<?php
session_start();
include("header.php");
//REMOVE SIDE BAR
/*include("sidebar.php");*/
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
    $job_no_main = $_GET['job_no'];
}
if (isset($_GET['ulr'])) {
    $ulr = $_GET['ulr'];
}
if (isset($_GET['lab_no'])) {
    $lab_no = $_GET['lab_no'];
    $aa    = $_GET['lab_no'];
}
$select_query3 = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0' ";
$result_select3 = mysqli_query($conn, $select_query3);

if (mysqli_num_rows($result_select3) > 0) {
    $row_select3 = mysqli_fetch_assoc($result_select3);
    $rec_sample_date = $row_select3['sample_rec_date'];
}

$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
$result_select2 = mysqli_query($conn, $select_query2);

if (mysqli_num_rows($result_select2) > 0) {
    $row_select2 = mysqli_fetch_assoc($result_select2);
    $start_date = $row_select2['start_date'];
    $end_date = $row_select2['end_date'];
}

?>


<div class="content-wrapper" style="margin-left:0px !important;">

    <section class="content common_material p-0">
        <?php include("menu.php") ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h2 style="text-align:center;">GLAZED TILES</h2>
                    </div>
                    <div class="box-default">
                        <form class="form" id="Glazed" method="post">
                            <!-- REPORT NO AND JOB NO PUT VAIBHAV-->
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <!--<label for="inputEmail3" class="col-sm-2 control-label">Report No.:</label>-->

                                        <div class="col-sm-10">
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
                                <div class="col-lg-6">
										<div class="form-group">
										 <div class="col-sm-4">
													<label>Amend Date. :</label>
												</div>								 
										  <div class="col-sm-8">
											<input type="text" class="form-control amend_date" tabindex="4" id="amend_date" name="amend_date">
										  </div>
										</div>
									</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">


                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control inputs" tabindex="4" id="ulr" value="<?php echo $_SESSION['fy_ulr_no'] . $ulr; ?>" name="ulr" ReadOnly>
                                            <label>COLOR :</label>
                                            <input type="text" class="form-control inputs" tabindex="4" id="color" name="color" value="CRYSTAL FLOOR TILES (COLOUR - CEMENTO GREY)">
                                        </div>

                                        <div class="col-sm-6">
                                            <label>SIZE :</label>
                                            <input type="text" class="form-control inputs col-sm-4" tabindex="4" id="size1" name="size1" value="600">
                                            <input type="text" class="form-control inputs col-sm-4" tabindex="4" id="size2" name="size2" value="600">
                                            <input type="text" class="form-control inputs col-sm-4" tabindex="4" id="size3" name="size3" value="8">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <br>


                            <hr>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <div class="col-md-3">
                                                                <a class="btn btn-info" href="invert_excel_export.php?trf_no=<?php echo $trf_no; ?>&&reports_nos=<?php echo $report_no; ?>&&lab_no=<?php echo $lab_no; ?>">Row Data</a>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="inputEmail3" class="col-md-12 control-label">Upload Excel :</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="file" class="form-control" id="upload_excel" name="upload_excel">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="button" class="btn btn-info pull-right" id="btn_upload_excel" name="btn_upload_excel" tabindex="14">Upload</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="view_excel_from_table">
                                                            <table border="1px solid black" align="center" width="100%">
                                                                <tr>
                                                                    <th>Download</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                <?php
                                                                $query_file = "select * from excel_upload_from_report WHERE lab_no='$lab_no' and job_no='$job_no_main' and report_no='$report_no'";
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
                                            </div>
                                            <br>
                                        </div>
                                    <?php }     ?>

                                    <!-- TEST WISE LOGIC VAIBHAV-->
                                    <?php
                                    $test_check;
                                    $select_query1 = "select * from span_material_assign,test_master WHERE span_material_assign.test = test_master.test_id and  span_material_assign.trf_no='$_GET[trf_no]' AND span_material_assign.job_number='$_GET[job_no]' AND span_material_assign.lab_no='$_GET[lab_no]' and span_material_assign.isdeleted='0'";
                                    $result_select1 = mysqli_query($conn, $select_query1);
                                    while ($r1 = mysqli_fetch_array($result_select1)) {

                                        if ($r1['test_code'] == "dim") {
                                            $test_check .= "dim,";
                                    ?>
                                            <div class="panel panel-default" id="dim">
                                                <div class="panel-heading" id="txtdim">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                            <h4 class="panel-title">
                                                                <b>Dimensions & Surface Quality </b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_dim">1.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_dim" id="chk_dim" value="chk_dim"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">Dimensions & Surface Quality</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">1</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">2</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">3</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">4</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">5</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">6</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">7</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">8</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">9</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">10</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Average</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Length (mm)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len1" name="len1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len2" name="len2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len3" name="len3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len4" name="len4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len5" name="len5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len6" name="len6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len7" name="len7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len8" name="len8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len9" name="len9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="len10" name="len10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avglen" name="avglen">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Width (mm)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid1" name="wid1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid2" name="wid2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid3" name="wid3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid4" name="wid4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid5" name="wid5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid6" name="wid6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid7" name="wid7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid8" name="wid8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid9" name="wid9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wid10" name="wid10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgwid" name="avgwid">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Thickness (mm)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk1" name="thk1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk2" name="thk2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk3" name="thk3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk4" name="thk4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk5" name="thk5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk6" name="thk6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk7" name="thk7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk8" name="thk8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk9" name="thk9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="thk10" name="thk10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgthk" name="avgthk">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Straightness Deviation (%)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str1" name="str1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str2" name="str2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str3" name="str3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str4" name="str4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str5" name="str5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str6" name="str6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str7" name="str7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str8" name="str8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str9" name="str9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="str10" name="str10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgstr" name="avgstr">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Rectangularity Deviation (%)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec1" name="rec1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec2" name="rec2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec3" name="rec3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec4" name="rec4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec5" name="rec5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec6" name="rec6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec7" name="rec7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec8" name="rec8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec9" name="rec9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="rec10" name="rec10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgrec" name="avgrec">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Surface Flatness Deviation (%)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur1" name="sur1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur2" name="sur2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur3" name="sur3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur4" name="sur4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur5" name="sur5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur6" name="sur6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur7" name="sur7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur8" name="sur8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur9" name="sur9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur10" name="sur10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgsur" name="avgsur">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Surface Quality</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="sur_qua" name="sur_qua">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        <?php } else if ($r1['test_code'] == "phy") {
                                            $test_check .= "phy,";

                                        ?>
                                            <div class="panel panel-default" id="phy">
                                                <div class="panel-heading" id="txtphy">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                            <h4 class="panel-title">
                                                                <b>PHYSICAL PROPERTIES</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse2" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_phy">8.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_phy" id="chk_phy" value="chk_phy"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-4 control-label label-right">PHYSICAL PROPERTIES</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">1</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">2</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">3</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">4</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">5</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">6</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">7</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">8</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">9</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">10</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Average</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Water Absorption (%)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wtr1" name="wtr1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wtr2" name="wtr2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wtr3" name="wtr3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wtr4" name="wtr4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="wtr5" name="wtr5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgwtr" name="avgwtr">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Breaking Strength (N)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk1" name="brk1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk2" name="brk2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk3" name="brk3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk4" name="brk4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk5" name="brk5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk6" name="brk6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk7" name="brk7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk8" name="brk8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk9" name="brk9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="brk10" name="brk10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgbrk" name="avgbrk">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Modulus of Rupture (N/mm2)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod1" name="mod1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod2" name="mod2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod3" name="mod3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod4" name="mod4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod5" name="mod5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod6" name="mod6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod7" name="mod7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod8" name="mod8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod9" name="mod9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="mod10" name="mod10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgmod" name="avgmod">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Scratch Hardness of surface ( Moh's Scale )</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hrd1" name="hrd1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hrd2" name="hrd2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hrd3" name="hrd3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avghrd" name="avghrd">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Density (gm/cc)</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den1" name="den1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den2" name="den2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den3" name="den3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den4" name="den4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den5" name="den5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den6" name="den6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den7" name="den7">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den8" name="den8">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den9" name="den9">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="den10" name="den10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgden" name="avgden">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else if ($r1['test_code'] == "che") {
                                            $test_check .= "che,"; ?>

                                            <div class="panel panel-default" id="che">
                                                <div class="panel-heading" id="txtche">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                            <h4 class="panel-title">
                                                                <b>CHEMICAL PROPERTIES</b>
                                                            </h4>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="col-sm-1">
                                                                        <label for="chk_che">3.</label>
                                                                        <input type="checkbox" class="visually-hidden" name="chk_che" id="chk_che" value="chk_che"><br>
                                                                    </div>
                                                                    <label for="inputEmail3" class="col-sm-11 control-label label-right">CHEMICAL PROPERTIES</label>

                                                                </div>
                                                            </div>



                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">1</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">2</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">3</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">4</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">5</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">6</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">7</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">8</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">9</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">10</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Average</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Resistance to Staining of glazed tiles</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="res1" name="res1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="res2" name="res2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="res3" name="res3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="res4" name="res4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="res5" name="res5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgres" name="avgres">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Resistance to Household Chemicals</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hou1" name="hou1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hou2" name="hou2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hou3" name="hou3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hou4" name="hou4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="hou5" name="hou5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avghou" name="avghou">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label for="inputEmail3" class="control-label">Resistance to Acid and Alkali</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="alk1" name="alk1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="alk2" name="alk2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="alk3" name="alk3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="alk4" name="alk4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="alk5" name="alk5">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" id="avgalk" name="avgalk">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>





                                                    </div>
                                                </div>
                                            </div>
                                    </div>
								<?php	
		}else if($r1['test_code']=="WAT")
		{
			$test_check.="WAT,";
	?>
	<div class="panel panel-default" id ="wtr">
		<div class="panel-heading" id="txtwtr">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse_wtr">
					<h4 class="panel-title"><b>WATER ABSORPTION</b></h4>
				</a>
			</h4>
		</div>
		<div id="collapse_wtr" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">									
					<div class="col-lg-12">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="chk_wtr">2.</label>
								<input type="checkbox" class="visually-hidden" name="chk_wtr"  id="chk_wtr" value="chk_wtr"><br>
							</div>
							<label for="inputEmail3" class="col-sm-4 control-label label-right">WATER ABSORPTION</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">Sr No.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Weight of Oven Dry Sample in gm (A)</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Weight of saturated Surface Dry in gm (B)</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Water Absorption in % 100 (B-A)/A </label></center>
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">1.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_1"  id="wtr_a_1">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_1"  id="wtr_b_1">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_1"  id="wtr_1">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">2.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_2"  id="wtr_a_2">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_2"  id="wtr_b_2">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_2"  id="wtr_2">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">3.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_3"  id="wtr_a_3">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_3"  id="wtr_b_3">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_3"  id="wtr_3">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">4.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_4"  id="wtr_a_4">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_4"  id="wtr_b_4">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_4"  id="wtr_4">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">5.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_5"  id="wtr_a_5">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_5"  id="wtr_b_5">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_5"  id="wtr_5">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">6.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_6"  id="wtr_a_6">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_6"  id="wtr_b_6">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_6"  id="wtr_6">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">7.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_7"  id="wtr_a_7">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_7"  id="wtr_b_7">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_7"  id="wtr_7">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">8.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_8"  id="wtr_a_8">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_8"  id="wtr_b_8">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_8"  id="wtr_8">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">9.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_9"  id="wtr_a_9">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_9"  id="wtr_b_9">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_9"  id="wtr_9">
						</div>
					</div>
				</div>
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							<center><label class="control-label text-center">10.</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_a_10"  id="wtr_a_10">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_b_10"  id="wtr_b_10">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="wtr_10"  id="wtr_10">
						</div>
					</div>
				</div>
				
				<br>
				<div class="row">									
					<div class="col-sm-1">
						<div class="form-group">
							
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<center><label class="control-label text-center">Average</label></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input type="text" class="form-control" name="avg_wtr_1"  id="avg_wtr_1">
						</div>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
                            <?php
                                        }
                                    }    ?>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">

                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-info pull-right" onclick="javascript:history.go(-1)">Back</button>
                                            <input type="hidden" class="form-control" name="idEdit" id="idEdit" />

                                        </div>
                                        <div class="col-sm-2">
                                            <!-- SAVE BUTTON LOGIC VAIBHAV-->
                                            <?php
                                            $querys_job1 = "SELECT * FROM glazed_tiles WHERE `is_deleted`='0' and lab_no='$lab_no'";
                                            $qrys_jobno = mysqli_query($conn, $querys_job1);
                                            $rows = mysqli_num_rows($qrys_jobno);
                                            if ($rows < 1) { ?>
                                                <button type="button" class="btn btn-info pull-right" onclick="saveMetal('add')" name="btn_save" id="btn_save" tabindex="14">Save</button>
                                            <?php }
                                            ?>


                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-info pull-right" onclick="saveMetal('edit')" id="btn_edit_data" name="btn_edit_data">Update</button>

                                        </div>
                                        <!-- REPORT AND BACK CAL BUTTON LOGIC VAIBHAV-->
                                        <?php
                                        /*$val =  $_SESSION['isadmin'];
											if($val == 0 || $val == 5 || $val == 6 || $_SESSION['nabl_type']=="direct_nabl" || $_SESSION['nabl_type']=="direct_non_nabl") {*/
                                        ?>
                                        <div class="col-sm-2">
                                            <a target='_blank' href="<?php echo $base_url; ?>print_report/report_glazed_tiles.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>" class="btn btn-info pull-right" id="btn_report" name="btn_report"><b>Report</b></a>

                                        </div>
                                        <div class="col-sm-2">
                                            <a target='_blank' href="<?php echo $base_url; ?>back_cal_report/back_glazed_tiles.php?job_no=<?php echo $_GET['job_no']; ?>&&report_no=<?php echo $_GET['report_no']; ?>&&lab_no=<?php echo $_GET['lab_no']; ?>&&trf_no=<?php echo $_GET['trf_no']; ?>&&tbl_name=tiles" class="btn btn-info pull-right" id="btn_cal_report" name="btn_cal_report"><b>Calculation Report</b></a>
                                        </div>
                                        <?php //}
                                        ?>
                                        <div class="col-sm-2">


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- DISPLAY DATA LOGIC VAIBHAV-->
                            <div id="display_data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table border="1px solid black" align="center" width="100%" id="aaaa">
                                            <tr>
                                                <th style="text-align:center;" width="10%"><label>Actions</label></th>
                                                <!--<th style="text-align:center;"><label>Report No.</label></th>-->
                                                <th style="text-align:center;"><label>Lab No.</label></th>
                                                <th style="text-align:center;"><label>Job No.</label></th>



                                            </tr>
                                            <?php
                                            $query = "select * from glazed_tiles WHERE lab_no='$aa'  and `is_deleted`='0'";

                                            $result = mysqli_query($conn, $query);


                                            if (mysqli_num_rows($result) > 0) {
                                                while ($r = mysqli_fetch_array($result)) {

                                                    if ($r['is_deleted'] == 0) {
                                            ?>
                                                        <tr>
                                                            <td style="text-align:center;" width="10%">

                                                                <a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
                                                                <?php
                                                                //$val =  $_SESSION['isadmin'];
                                                                //if($val == 0 || $val == 5){
                                                                ?>
                                                                <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
                                                                <?php
                                                                //}
                                                                ?>
                                                            </td>
                                                            <!--<td style="text-align:center;"><?php //echo $r['report_no'];
                                                                                                ?></td>-->
                                                            <td style="text-align:center;"><?php echo $r['job_no']; ?></td>
                                                            <td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>

                                        </table>
                                    </div>
                                </div>

                                <hr>
                            </div> <!-- TEST LIST FILD VAIBHAV-->
                            <input type="hidden" class="form-control" id="test_list" name="test_list" value="<?php echo rtrim($test_check, ','); ?>">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>





<?php include("footer.php"); ?>
<script>
    $(function() {
        $('.select2').select2();
    })
    $('.amend_date').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    });
    $(document).ready(function() {
        $('#btn_edit_data').hide();
        $('#alert').hide();

        //dimenstion
        function dim_auto() {
            $('#txtdim').css("background-color", "var(--success)");

            var avg_len = randomNumberFromRange(0.10, 0.20).toFixed(2);
            var avg_wid = randomNumberFromRange(0.10, 0.20).toFixed(2);
            var avg_thk = randomNumberFromRange(0.10, 0.20).toFixed(2);
            var avg_str = randomNumberFromRange(0.02, 0.04).toFixed(2);
            var avg_rec = randomNumberFromRange(0.02, 0.05).toFixed(2);
            var avg_sur = randomNumberFromRange(0.02, 0.05).toFixed(2);
            var i = randomNumberFromRange(1, 99).toFixed();
            $('#avglen').val(avg_len);
            $('#avgwid').val(avg_wid);
            $('#avgthk').val(avg_thk);
            $('#avgstr').val(avg_str);
            $('#avgrec').val(avg_rec);
            $('#avgsur').val(avg_sur);
            var avglen = $('#avglen').val();
            var avgwid = $('#avgwid').val();
            var avgthk = $('#avgthk').val();
            var avgstr = $('#avgstr').val();
            var avgrec = $('#avgrec').val();
            var avgsur = $('#avgsur').val();
            if (i % 2 == 0) {
                var len2 = (+avglen) - (+0.03);
                var len3 = (+avglen) - (+0.05);
                var len5 = (+avglen) - (+0.06);
                var len6 = (+avglen) - (+0.08);
                var len7 = (+avglen) - (+0.03);
                var len9 = (+avglen) - (+0.04);

                var len1 = (+avglen) + (+0.02);
                var len4 = (+avglen) + (+0.07);
                var len8 = (+avglen) + (+0.12);
                var len10 = (+avglen) + (+0.08);


                var wid1 = (+avgwid) - (+0.03);
                var wid2 = (+avgwid) - (+0.05);
                var wid10 = (+avgwid) - (+0.06);
                var wid9 = (+avgwid) - (+0.08);
                var wid3 = (+avgwid) - (+0.03);
                var wid4 = (+avgwid) - (+0.04);

                var wid5 = (+avgwid) + (+0.02);
                var wid6 = (+avgwid) + (+0.07);
                var wid7 = (+avgwid) + (+0.12);
                var wid8 = (+avgwid) + (+0.08);


                var thk1 = (+avgthk) + (+0.03);
                var thk2 = (+avgthk) + (+0.05);
                var thk10 = (+avgthk) + (+0.06);
                var thk9 = (+avgthk) + (+0.08);
                var thk3 = (+avgthk) + (+0.03);
                var thk4 = (+avgthk) + (+0.04);

                var thk5 = (+avgthk) - (+0.02);
                var thk6 = (+avgthk) - (+0.07);
                var thk7 = (+avgthk) - (+0.12);
                var thk8 = (+avgthk) - (+0.08);

                var str1 = (+avgstr) + (+0.01);
                var str3 = (+avgstr) + (+0.02);
                var str5 = (+avgstr) + (+0.03);
                var str6 = (+avgstr) + (+0.02);
                var str9 = (+avgstr) + (+0.01);
                var str2 = (+avgstr) - (+0.03);
                var str4 = (+avgstr) - (+0.02);
                var str7 = (+avgstr) - (+0.01);
                var str8 = (+avgstr) - (+0.02);
                var str10 = (+avgstr) - (+0.01);

                var rec1 = (+avgrec) + (+0.01);
                var rec3 = (+avgrec) + (+0.04);
                var rec5 = (+avgrec) + (+0.02);
                var rec6 = (+avgrec) + (+0.02);
                var rec9 = (+avgrec) + (+0.01);
                var rec2 = (+avgrec) - (+0.02);
                var rec4 = (+avgrec) - (+0.02);
                var rec7 = (+avgrec) - (+0.01);
                var rec8 = (+avgrec) - (+0.04);
                var rec10 = (+avgrec) - (+0.01);

                var sur1 = (+avgsur) - (+0.01);
                var sur3 = (+avgsur) - (+0.04);
                var sur5 = (+avgsur) - (+0.02);
                var sur6 = (+avgsur) - (+0.02);
                var sur9 = (+avgsur) - (+0.01);
                var sur2 = (+avgsur) + (+0.02);
                var sur4 = (+avgsur) + (+0.02);
                var sur7 = (+avgsur) + (+0.01);
                var sur8 = (+avgsur) + (+0.04);
                var sur10 = (+avgsur) + (+0.01);



            } else {
                var len8 = (+avglen) - (+0.03);
                var len7 = (+avglen) - (+0.05);
                var len6 = (+avglen) - (+0.06);
                var len5 = (+avglen) - (+0.08);
                var len4 = (+avglen) - (+0.03);
                var len3 = (+avglen) - (+0.04);

                var len2 = (+avglen) + (+0.02);
                var len1 = (+avglen) + (+0.07);
                var len10 = (+avglen) + (+0.12);
                var len9 = (+avglen) + (+0.08);


                var wid1 = (+avgwid) + (+0.03);
                var wid2 = (+avgwid) + (+0.05);
                var wid10 = (+avgwid) + (+0.06);
                var wid9 = (+avgwid) + (+0.08);
                var wid3 = (+avgwid) + (+0.03);
                var wid4 = (+avgwid) + (+0.04);

                var wid5 = (+avgwid) - (+0.02);
                var wid6 = (+avgwid) - (+0.07);
                var wid7 = (+avgwid) - (+0.12);
                var wid8 = (+avgwid) - (+0.08);

                var thk1 = (+avgthk) - (+0.03);
                var thk2 = (+avgthk) - (+0.05);
                var thk10 = (+avgthk) - (+0.06);
                var thk9 = (+avgthk) - (+0.08);
                var thk3 = (+avgthk) - (+0.03);
                var thk4 = (+avgthk) - (+0.04);

                var thk5 = (+avgthk) + (+0.02);
                var thk6 = (+avgthk) + (+0.07);
                var thk7 = (+avgthk) + (+0.12);
                var thk8 = (+avgthk) + (+0.08);

                var str1 = (+avgstr) - (+0.01);
                var str3 = (+avgstr) - (+0.02);
                var str5 = (+avgstr) - (+0.03);
                var str6 = (+avgstr) - (+0.02);
                var str9 = (+avgstr) - (+0.01);
                var str2 = (+avgstr) + (+0.03);
                var str4 = (+avgstr) + (+0.02);
                var str7 = (+avgstr) + (+0.01);
                var str8 = (+avgstr) + (+0.02);
                var str10 = (+avgstr) + (+0.01);

                var rec1 = (+avgrec) - (+0.01);
                var rec3 = (+avgrec) - (+0.03);
                var rec5 = (+avgrec) - (+0.02);
                var rec6 = (+avgrec) - (+0.02);
                var rec9 = (+avgrec) - (+0.01);
                var rec2 = (+avgrec) + (+0.02);
                var rec4 = (+avgrec) + (+0.02);
                var rec7 = (+avgrec) + (+0.01);
                var rec8 = (+avgrec) + (+0.03);
                var rec10 = (+avgrec) + (+0.01);


                var sur1 = (+avgsur) + (+0.01);
                var sur3 = (+avgsur) + (+0.04);
                var sur5 = (+avgsur) + (+0.02);
                var sur6 = (+avgsur) + (+0.02);
                var sur9 = (+avgsur) + (+0.01);
                var sur2 = (+avgsur) - (+0.02);
                var sur4 = (+avgsur) - (+0.02);
                var sur7 = (+avgsur) - (+0.01);
                var sur8 = (+avgsur) - (+0.04);
                var sur10 = (+avgsur) - (+0.01);
            }

            $('#len1').val(len1.toFixed(2));
            $('#len2').val(len2.toFixed(2));
            $('#len3').val(len3.toFixed(2));
            $('#len4').val(len4.toFixed(2));
            $('#len5').val(len5.toFixed(2));
            $('#len6').val(len6.toFixed(2));
            $('#len7').val(len7.toFixed(2));
            $('#len8').val(len8.toFixed(2));
            $('#len9').val(len9.toFixed(2));
            $('#len10').val(len10.toFixed(2));

            $('#wid1').val(wid1.toFixed(2));
            $('#wid2').val(wid2.toFixed(2));
            $('#wid3').val(wid3.toFixed(2));
            $('#wid4').val(wid4.toFixed(2));
            $('#wid5').val(wid5.toFixed(2));
            $('#wid6').val(wid6.toFixed(2));
            $('#wid7').val(wid7.toFixed(2));
            $('#wid8').val(wid8.toFixed(2));
            $('#wid9').val(wid9.toFixed(2));
            $('#wid10').val(wid10.toFixed(2));

            $('#thk1').val(thk1.toFixed(2));
            $('#thk2').val(thk2.toFixed(2));
            $('#thk3').val(thk3.toFixed(2));
            $('#thk4').val(thk4.toFixed(2));
            $('#thk5').val(thk5.toFixed(2));
            $('#thk6').val(thk6.toFixed(2));
            $('#thk7').val(thk7.toFixed(2));
            $('#thk8').val(thk8.toFixed(2));
            $('#thk9').val(thk9.toFixed(2));
            $('#thk10').val(thk10.toFixed(2));

            $('#str1').val(str1.toFixed(2));
            $('#str2').val(str2.toFixed(2));
            $('#str3').val(str3.toFixed(2));
            $('#str4').val(str4.toFixed(2));
            $('#str5').val(str5.toFixed(2));
            $('#str6').val(str6.toFixed(2));
            $('#str7').val(str7.toFixed(2));
            $('#str8').val(str8.toFixed(2));
            $('#str9').val(str9.toFixed(2));
            $('#str10').val(str10.toFixed(2));

            $('#rec1').val(rec1.toFixed(2));
            $('#rec2').val(rec2.toFixed(2));
            $('#rec3').val(rec3.toFixed(2));
            $('#rec4').val(rec4.toFixed(2));
            $('#rec5').val(rec5.toFixed(2));
            $('#rec6').val(rec6.toFixed(2));
            $('#rec7').val(rec7.toFixed(2));
            $('#rec8').val(rec8.toFixed(2));
            $('#rec9').val(rec9.toFixed(2));
            $('#rec10').val(rec10.toFixed(2));

            $('#sur1').val(sur1.toFixed(2));
            $('#sur2').val(sur2.toFixed(2));
            $('#sur3').val(sur3.toFixed(2));
            $('#sur4').val(sur4.toFixed(2));
            $('#sur5').val(sur5.toFixed(2));
            $('#sur6').val(sur6.toFixed(2));
            $('#sur7').val(sur7.toFixed(2));
            $('#sur8').val(sur8.toFixed(2));
            $('#sur9').val(sur9.toFixed(2));
            $('#sur10').val(sur10.toFixed(2));
            $('#sur_qua').val("Surface area is free from Visible Defects");


        }
        $('#chk_dim').change(function() {
            if (this.checked) {
                dim_auto();


            } else {
                $('#txtdim').css("background-color", "white");
                $('#len1').val(null);
                $('#len2').val(null);
                $('#len3').val(null);
                $('#len4').val(null);
                $('#len5').val(null);
                $('#len6').val(null);
                $('#len7').val(null);
                $('#len8').val(null);
                $('#len9').val(null);
                $('#len10').val(null);
                $('#avglen').val(null);

                $('#wid1').val(null);
                $('#wid2').val(null);
                $('#wid3').val(null);
                $('#wid4').val(null);
                $('#wid5').val(null);
                $('#wid6').val(null);
                $('#wid7').val(null);
                $('#wid8').val(null);
                $('#wid9').val(null);
                $('#wid10').val(null);
                $('#avgwid').val(null);

                $('#thk1').val(null);
                $('#thk2').val(null);
                $('#thk3').val(null);
                $('#thk4').val(null);
                $('#thk5').val(null);
                $('#thk6').val(null);
                $('#thk7').val(null);
                $('#thk8').val(null);
                $('#thk9').val(null);
                $('#thk10').val(null);
                $('#avgthk').val(null);

                $('#str1').val(null);
                $('#str2').val(null);
                $('#str3').val(null);
                $('#str4').val(null);
                $('#str5').val(null);
                $('#str6').val(null);
                $('#str7').val(null);
                $('#str8').val(null);
                $('#str9').val(null);
                $('#str10').val(null);
                $('#avgstr').val(null);

                $('#rec1').val(null);
                $('#rec2').val(null);
                $('#rec3').val(null);
                $('#rec4').val(null);
                $('#rec5').val(null);
                $('#rec6').val(null);
                $('#rec7').val(null);
                $('#rec8').val(null);
                $('#rec9').val(null);
                $('#rec10').val(null);
                $('#avgrec').val(null);

                $('#sur1').val(null);
                $('#sur2').val(null);
                $('#sur3').val(null);
                $('#sur4').val(null);
                $('#sur5').val(null);
                $('#sur6').val(null);
                $('#sur7').val(null);
                $('#sur8').val(null);
                $('#sur9').val(null);
                $('#sur10').val(null);
                $('#avgsur').val(null);
                $('#sur_qua').val(null);
            }

        });

        $('#avglen').change(function() {
            var avglen = $('#avglen').val();

            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {
                var len2 = (+avglen) - (+0.03);
                var len3 = (+avglen) - (+0.05);
                var len5 = (+avglen) - (+0.06);
                var len6 = (+avglen) - (+0.08);
                var len7 = (+avglen) - (+0.03);
                var len9 = (+avglen) - (+0.04);

                var len1 = (+avglen) + (+0.02);
                var len4 = (+avglen) + (+0.07);
                var len8 = (+avglen) + (+0.12);
                var len10 = (+avglen) + (+0.08);




            } else {
                var len8 = (+avglen) - (+0.03);
                var len7 = (+avglen) - (+0.05);
                var len6 = (+avglen) - (+0.06);
                var len5 = (+avglen) - (+0.08);
                var len4 = (+avglen) - (+0.03);
                var len3 = (+avglen) - (+0.04);

                var len2 = (+avglen) + (+0.02);
                var len1 = (+avglen) + (+0.07);
                var len10 = (+avglen) + (+0.12);
                var len9 = (+avglen) + (+0.08);


            }

            $('#len1').val(len1.toFixed(2));
            $('#len2').val(len2.toFixed(2));
            $('#len3').val(len3.toFixed(2));
            $('#len4').val(len4.toFixed(2));
            $('#len5').val(len5.toFixed(2));
            $('#len6').val(len6.toFixed(2));
            $('#len7').val(len7.toFixed(2));
            $('#len8').val(len8.toFixed(2));
            $('#len9').val(len9.toFixed(2));
            $('#len10').val(len10.toFixed(2));


        });

        $('#avgwid').change(function() {

            var avgwid = $('#avgwid').val();

            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {


                var wid1 = (+avgwid) - (+0.03);
                var wid2 = (+avgwid) - (+0.05);
                var wid10 = (+avgwid) - (+0.06);
                var wid9 = (+avgwid) - (+0.08);
                var wid3 = (+avgwid) - (+0.03);
                var wid4 = (+avgwid) - (+0.04);

                var wid5 = (+avgwid) + (+0.02);
                var wid6 = (+avgwid) + (+0.07);
                var wid7 = (+avgwid) + (+0.12);
                var wid8 = (+avgwid) + (+0.08);





            } else {



                var wid1 = (+avgwid) + (+0.03);
                var wid2 = (+avgwid) + (+0.05);
                var wid10 = (+avgwid) + (+0.06);
                var wid9 = (+avgwid) + (+0.08);
                var wid3 = (+avgwid) + (+0.03);
                var wid4 = (+avgwid) + (+0.04);

                var wid5 = (+avgwid) - (+0.02);
                var wid6 = (+avgwid) - (+0.07);
                var wid7 = (+avgwid) - (+0.12);
                var wid8 = (+avgwid) - (+0.08);


            }



            $('#wid1').val(wid1.toFixed(2));
            $('#wid2').val(wid2.toFixed(2));
            $('#wid3').val(wid3.toFixed(2));
            $('#wid4').val(wid4.toFixed(2));
            $('#wid5').val(wid5.toFixed(2));
            $('#wid6').val(wid6.toFixed(2));
            $('#wid7').val(wid7.toFixed(2));
            $('#wid8').val(wid8.toFixed(2));
            $('#wid9').val(wid9.toFixed(2));
            $('#wid10').val(wid10.toFixed(2));


        });


        $('#avgthk').change(function() {

            var avgthk = $('#avgthk').val();

            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {

                var thk1 = (+avgthk) + (+0.03);
                var thk2 = (+avgthk) + (+0.05);
                var thk10 = (+avgthk) + (+0.06);
                var thk9 = (+avgthk) + (+0.08);
                var thk3 = (+avgthk) + (+0.03);
                var thk4 = (+avgthk) + (+0.04);

                var thk5 = (+avgthk) - (+0.02);
                var thk6 = (+avgthk) - (+0.07);
                var thk7 = (+avgthk) - (+0.12);
                var thk8 = (+avgthk) - (+0.08);



            } else {

                var thk1 = (+avgthk) - (+0.03);
                var thk2 = (+avgthk) - (+0.05);
                var thk10 = (+avgthk) - (+0.06);
                var thk9 = (+avgthk) - (+0.08);
                var thk3 = (+avgthk) - (+0.03);
                var thk4 = (+avgthk) - (+0.04);

                var thk5 = (+avgthk) + (+0.02);
                var thk6 = (+avgthk) + (+0.07);
                var thk7 = (+avgthk) + (+0.12);
                var thk8 = (+avgthk) + (+0.08);


            }



            $('#thk1').val(thk1.toFixed(2));
            $('#thk2').val(thk2.toFixed(2));
            $('#thk3').val(thk3.toFixed(2));
            $('#thk4').val(thk4.toFixed(2));
            $('#thk5').val(thk5.toFixed(2));
            $('#thk6').val(thk6.toFixed(2));
            $('#thk7').val(thk7.toFixed(2));
            $('#thk8').val(thk8.toFixed(2));
            $('#thk9').val(thk9.toFixed(2));
            $('#thk10').val(thk10.toFixed(2));


        });


        $('#avgstr').change(function() {

            var avgstr = $('#avgstr').val();

            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {

                var str1 = (+avgstr) + (+0.01);
                var str3 = (+avgstr) + (+0.02);
                var str5 = (+avgstr) + (+0.03);
                var str6 = (+avgstr) + (+0.02);
                var str9 = (+avgstr) + (+0.01);
                var str2 = (+avgstr) - (+0.03);
                var str4 = (+avgstr) - (+0.02);
                var str7 = (+avgstr) - (+0.01);
                var str8 = (+avgstr) - (+0.02);
                var str10 = (+avgstr) - (+0.01);




            } else {

                var str1 = (+avgstr) - (+0.01);
                var str3 = (+avgstr) - (+0.02);
                var str5 = (+avgstr) - (+0.03);
                var str6 = (+avgstr) - (+0.02);
                var str9 = (+avgstr) - (+0.01);
                var str2 = (+avgstr) + (+0.03);
                var str4 = (+avgstr) + (+0.02);
                var str7 = (+avgstr) + (+0.01);
                var str8 = (+avgstr) + (+0.02);
                var str10 = (+avgstr) + (+0.01);

            }


            $('#str1').val(str1.toFixed(2));
            $('#str2').val(str2.toFixed(2));
            $('#str3').val(str3.toFixed(2));
            $('#str4').val(str4.toFixed(2));
            $('#str5').val(str5.toFixed(2));
            $('#str6').val(str6.toFixed(2));
            $('#str7').val(str7.toFixed(2));
            $('#str8').val(str8.toFixed(2));
            $('#str9').val(str9.toFixed(2));
            $('#str10').val(str10.toFixed(2));


        });


        $('#avgrec').change(function() {

            var avgrec = $('#avgrec').val();

            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {

                var rec1 = (+avgrec) + (+0.01);
                var rec3 = (+avgrec) + (+0.04);
                var rec5 = (+avgrec) + (+0.02);
                var rec6 = (+avgrec) + (+0.02);
                var rec9 = (+avgrec) + (+0.01);
                var rec2 = (+avgrec) - (+0.02);
                var rec4 = (+avgrec) - (+0.02);
                var rec7 = (+avgrec) - (+0.01);
                var rec8 = (+avgrec) - (+0.04);
                var rec10 = (+avgrec) - (+0.01);



            } else {

                var rec1 = (+avgrec) - (+0.01);
                var rec3 = (+avgrec) - (+0.03);
                var rec5 = (+avgrec) - (+0.02);
                var rec6 = (+avgrec) - (+0.02);
                var rec9 = (+avgrec) - (+0.01);
                var rec2 = (+avgrec) + (+0.02);
                var rec4 = (+avgrec) + (+0.02);
                var rec7 = (+avgrec) + (+0.01);
                var rec8 = (+avgrec) + (+0.03);
                var rec10 = (+avgrec) + (+0.01);



            }


            $('#rec1').val(rec1.toFixed(2));
            $('#rec2').val(rec2.toFixed(2));
            $('#rec3').val(rec3.toFixed(2));
            $('#rec4').val(rec4.toFixed(2));
            $('#rec5').val(rec5.toFixed(2));
            $('#rec6').val(rec6.toFixed(2));
            $('#rec7').val(rec7.toFixed(2));
            $('#rec8').val(rec8.toFixed(2));
            $('#rec9').val(rec9.toFixed(2));
            $('#rec10').val(rec10.toFixed(2));


        });


        $('#avgsur').change(function() {
            var avgrec = $('#avgrec').val();
            var avgsur = $('#avgsur').val();
            var i = randomNumberFromRange(1, 99).toFixed();
            if (i % 2 == 0) {

                var sur1 = (+avgsur) - (+0.01);
                var sur3 = (+avgsur) - (+0.04);
                var sur5 = (+avgsur) - (+0.02);
                var sur6 = (+avgsur) - (+0.02);
                var sur9 = (+avgsur) - (+0.01);
                var sur2 = (+avgsur) + (+0.02);
                var sur4 = (+avgsur) + (+0.02);
                var sur7 = (+avgsur) + (+0.01);
                var sur8 = (+avgsur) + (+0.04);
                var sur10 = (+avgsur) + (+0.01);



            } else {


                var sur1 = (+avgsur) + (+0.01);
                var sur3 = (+avgsur) + (+0.04);
                var sur5 = (+avgsur) + (+0.02);
                var sur6 = (+avgsur) + (+0.02);
                var sur9 = (+avgsur) + (+0.01);
                var sur2 = (+avgsur) - (+0.02);
                var sur4 = (+avgsur) - (+0.02);
                var sur7 = (+avgsur) - (+0.01);
                var sur8 = (+avgsur) - (+0.04);
                var sur10 = (+avgsur) - (+0.01);
            }


            $('#sur1').val(sur1.toFixed(2));
            $('#sur2').val(sur2.toFixed(2));
            $('#sur3').val(sur3.toFixed(2));
            $('#sur4').val(sur4.toFixed(2));
            $('#sur5').val(sur5.toFixed(2));
            $('#sur6').val(sur6.toFixed(2));
            $('#sur7').val(sur7.toFixed(2));
            $('#sur8').val(sur8.toFixed(2));
            $('#sur9').val(sur9.toFixed(2));
            $('#sur10').val(sur10.toFixed(2));
        });


        function phy_auto() {
            $('#txtphy').css("background-color", "var(--success)");

            var avg_wtr = randomNumberFromRange(12.00, 14.00).toFixed(1);
            var size3 = $('#size3').val();
            if (size3 > 7.5) {
                var avg_brk = randomNumberFromRange(785.0, 792.0).toFixed(1);
                var avg_mod = randomNumberFromRange(17.0, 18.9).toFixed(1);
            } else {
                var avg_brk = randomNumberFromRange(730.0, 740.0).toFixed(2);
                var avg_mod = randomNumberFromRange(13.0, 14.5).toFixed(1);
            }

            var avg_hrd = randomNumberFromRange(4, 5).toFixed();
            var avg_den = randomNumberFromRange(1.94, 1.97).toFixed(2);

            var i = randomNumberFromRange(1, 99).toFixed();
            $('#avgwtr').val(avg_wtr);
            $('#avgbrk').val(avg_brk);
            $('#avgmod').val(avg_mod);
            $('#avghrd').val(avg_hrd);
            $('#avgden').val(avg_den);

            var avgwtr = $('#avgwtr').val();
            var avgbrk = $('#avgbrk').val();
            var avgmod = $('#avgmod').val();
            var avghrd = $('#avghrd').val();
            var avgden = $('#avgden').val();

            if (i % 2 == 0) {
                var wtr1 = (+avgwtr) - (+0.10);
                var wtr2 = (+avgwtr) + (+0.30);
                var wtr3 = (+avgwtr) - (+0.20);
                var wtr4 = (+avgwtr) + (+0.20);
                var wtr5 = (+avgwtr) - (+0.10);




                var brk1 = (+avgbrk) - (+1.10);
                var brk2 = (+avgbrk) - (+2.20);
                var brk10 = (+avgbrk) - (+3.30);
                var brk9 = (+avgbrk) - (+2.20);
                var brk3 = (+avgbrk) - (+1.40);
                var brk4 = (+avgbrk) - (+3.20);

                var brk5 = (+avgbrk) + (+2.30);
                var brk6 = (+avgbrk) + (+4.40);
                var brk7 = (+avgbrk) + (+5.20);
                var brk8 = (+avgbrk) + (+1.50);


                var mod1 = (+avgmod) + (+0.1);
                var mod2 = (+avgmod) + (+0.1);
                var mod10 = (+avgmod) + (+0.1);
                var mod9 = (+avgmod) + (+0.2);
                var mod3 = (+avgmod) + (+0.3);
                var mod4 = (+avgmod) + (+0.3);

                var mod5 = (+avgmod) - (+0.2);
                var mod6 = (+avgmod) - (+0.3);
                var mod7 = (+avgmod) - (+0.2);
                var mod8 = (+avgmod) - (+0.4);

                var hrd1 = avghrd;
                var hrd2 = avghrd;
                var hrd3 = avghrd;


                var den1 = (+avgden) + (+0.01);
                var den3 = (+avgden) + (+0.03);
                var den5 = (+avgden) + (+0.02);
                var den6 = (+avgden) + (+0.02);
                var den9 = (+avgden) + (+0.01);
                var den2 = (+avgden) - (+0.02);
                var den4 = (+avgden) - (+0.02);
                var den7 = (+avgden) - (+0.01);
                var den8 = (+avgden) - (+0.03);
                var den10 = (+avgden) - (+0.01);



            } else {
                var wtr1 = (+avgwtr) + (+0.10);
                var wtr2 = (+avgwtr) - (+0.30);
                var wtr3 = (+avgwtr) + (+0.20);
                var wtr4 = (+avgwtr) - (+0.20);
                var wtr5 = (+avgwtr) + (+0.10);


                var brk1 = (+avgbrk) + (+1.10);
                var brk2 = (+avgbrk) + (+2.20);
                var brk10 = (+avgbrk) + (+3.30);
                var brk9 = (+avgbrk) + (+2.20);
                var brk3 = (+avgbrk) + (+1.40);
                var brk4 = (+avgbrk) + (+3.20);

                var brk5 = (+avgbrk) - (+2.30);
                var brk6 = (+avgbrk) - (+4.40);
                var brk7 = (+avgbrk) - (+5.20);
                var brk8 = (+avgbrk) - (+1.50);

                var mod1 = (+avgmod) - (+0.1);
                var mod2 = (+avgmod) - (+0.1);
                var mod10 = (+avgmod) - (+0.1);
                var mod9 = (+avgmod) - (+0.2);
                var mod3 = (+avgmod) - (+0.3);
                var mod4 = (+avgmod) - (+0.3);

                var mod5 = (+avgmod) + (+0.2);
                var mod6 = (+avgmod) + (+0.3);
                var mod7 = (+avgmod) + (+0.2);
                var mod8 = (+avgmod) + (+0.4);

                var hrd1 = avghrd;
                var hrd2 = avghrd;
                var hrd3 = avghrd;


                var den1 = (+avgden) - (+0.01);
                var den3 = (+avgden) - (+0.03);
                var den5 = (+avgden) - (+0.02);
                var den6 = (+avgden) - (+0.02);
                var den9 = (+avgden) - (+0.01);
                var den2 = (+avgden) + (+0.02);
                var den4 = (+avgden) + (+0.02);
                var den7 = (+avgden) + (+0.01);
                var den8 = (+avgden) + (+0.03);
                var den10 = (+avgden) + (+0.01);



            }

            $('#wtr1').val(wtr1.toFixed(2));
            $('#wtr2').val(wtr2.toFixed(2));
            $('#wtr3').val(wtr3.toFixed(2));
            $('#wtr4').val(wtr4.toFixed(2));
            $('#wtr5').val(wtr5.toFixed(2));


            $('#brk1').val(brk1.toFixed(2));
            $('#brk2').val(brk2.toFixed(2));
            $('#brk3').val(brk3.toFixed(2));
            $('#brk4').val(brk4.toFixed(2));
            $('#brk5').val(brk5.toFixed(2));
            $('#brk6').val(brk6.toFixed(2));
            $('#brk7').val(brk7.toFixed(2));
            $('#brk8').val(brk8.toFixed(2));
            $('#brk9').val(brk9.toFixed(2));
            $('#brk10').val(brk10.toFixed(2));

            $('#mod1').val(mod1.toFixed(1));
            $('#mod2').val(mod2.toFixed(1));
            $('#mod3').val(mod3.toFixed(1));
            $('#mod4').val(mod4.toFixed(1));
            $('#mod5').val(mod5.toFixed(1));
            $('#mod6').val(mod6.toFixed(1));
            $('#mod7').val(mod7.toFixed(1));
            $('#mod8').val(mod8.toFixed(1));
            $('#mod9').val(mod9.toFixed(1));
            $('#mod10').val(mod10.toFixed(1));

            $('#hrd1').val(hrd1);
            $('#hrd2').val(hrd2);
            $('#hrd3').val(hrd3);


            $('#den1').val(den1.toFixed(2));
            $('#den2').val(den2.toFixed(2));
            $('#den3').val(den3.toFixed(2));
            $('#den4').val(den4.toFixed(2));
            $('#den5').val(den5.toFixed(2));
            $('#den6').val(den6.toFixed(2));
            $('#den7').val(den7.toFixed(2));
            $('#den8').val(den8.toFixed(2));
            $('#den9').val(den9.toFixed(2));
            $('#den10').val(den10.toFixed(2));



        }



        $('#chk_phy').change(function() {
            if (this.checked) {
                phy_auto();


            } else {
                $('#txtphy').css("background-color", "white");
                $('#wtr1').val(null);
                $('#wtr2').val(null);
                $('#wtr3').val(null);
                $('#wtr4').val(null);
                $('#wtr5').val(null);

                $('#avgwtr').val(null);

                $('#brk1').val(null);
                $('#brk2').val(null);
                $('#brk3').val(null);
                $('#brk4').val(null);
                $('#brk5').val(null);
                $('#brk6').val(null);
                $('#brk7').val(null);
                $('#brk8').val(null);
                $('#brk9').val(null);
                $('#brk10').val(null);
                $('#avgbrk').val(null);

                $('#mod1').val(null);
                $('#mod2').val(null);
                $('#mod3').val(null);
                $('#mod4').val(null);
                $('#mod5').val(null);
                $('#mod6').val(null);
                $('#mod7').val(null);
                $('#mod8').val(null);
                $('#mod9').val(null);
                $('#mod10').val(null);
                $('#avgmod').val(null);

                $('#den1').val(null);
                $('#den2').val(null);
                $('#den3').val(null);
                $('#den4').val(null);
                $('#den5').val(null);
                $('#den6').val(null);
                $('#den7').val(null);
                $('#den8').val(null);
                $('#den9').val(null);
                $('#den10').val(null);
                $('#avgden').val(null);

                $('#hrd1').val(null);
                $('#hrd2').val(null);
                $('#hrd3').val(null);

                $('#avghrd').val(null);

            }

        });

        $('#avgwtr').change(function() {

            var i = randomNumberFromRange(1, 99).toFixed();

            var avgwtr = $('#avgwtr').val();

            if (i % 2 == 0) {
                var wtr1 = (+avgwtr) - (+0.10);
                var wtr2 = (+avgwtr) + (+0.30);
                var wtr3 = (+avgwtr) - (+0.20);
                var wtr4 = (+avgwtr) + (+0.20);
                var wtr5 = (+avgwtr) - (+0.10);




            } else {
                var wtr1 = (+avgwtr) + (+0.10);
                var wtr2 = (+avgwtr) - (+0.30);
                var wtr3 = (+avgwtr) + (+0.20);
                var wtr4 = (+avgwtr) - (+0.20);
                var wtr5 = (+avgwtr) + (+0.10);



            }

            $('#wtr1').val(wtr1.toFixed(2));
            $('#wtr2').val(wtr2.toFixed(2));
            $('#wtr3').val(wtr3.toFixed(2));
            $('#wtr4').val(wtr4.toFixed(2));
            $('#wtr5').val(wtr5.toFixed(2));


        });

        $('#avgbrk').change(function() {
            var i = randomNumberFromRange(1, 99).toFixed();

            var avgbrk = $('#avgbrk').val();

            if (i % 2 == 0) {

                var brk1 = (+avgbrk) - (+1.10);
                var brk2 = (+avgbrk) - (+2.20);
                var brk10 = (+avgbrk) - (+3.30);
                var brk9 = (+avgbrk) - (+2.20);
                var brk3 = (+avgbrk) - (+1.40);
                var brk4 = (+avgbrk) - (+3.20);

                var brk5 = (+avgbrk) + (+2.30);
                var brk6 = (+avgbrk) + (+4.40);
                var brk7 = (+avgbrk) + (+5.20);
                var brk8 = (+avgbrk) + (+1.50);




            } else {


                var brk1 = (+avgbrk) + (+1.10);
                var brk2 = (+avgbrk) + (+2.20);
                var brk10 = (+avgbrk) + (+3.30);
                var brk9 = (+avgbrk) + (+2.20);
                var brk3 = (+avgbrk) + (+1.40);
                var brk4 = (+avgbrk) + (+3.20);

                var brk5 = (+avgbrk) - (+2.30);
                var brk6 = (+avgbrk) - (+4.40);
                var brk7 = (+avgbrk) - (+5.20);
                var brk8 = (+avgbrk) - (+1.50);



            }



            $('#brk1').val(brk1.toFixed(2));
            $('#brk2').val(brk2.toFixed(2));
            $('#brk3').val(brk3.toFixed(2));
            $('#brk4').val(brk4.toFixed(2));
            $('#brk5').val(brk5.toFixed(2));
            $('#brk6').val(brk6.toFixed(2));
            $('#brk7').val(brk7.toFixed(2));
            $('#brk8').val(brk8.toFixed(2));
            $('#brk9').val(brk9.toFixed(2));
            $('#brk10').val(brk10.toFixed(2));


        });

        $('#avgmod').change(function() {
            var i = randomNumberFromRange(1, 99).toFixed();

            var avgmod = $('#avgmod').val();

            if (i % 2 == 0) {


                var mod1 = (+avgmod) + (+0.1);
                var mod2 = (+avgmod) + (+0.1);
                var mod10 = (+avgmod) + (+0.1);
                var mod9 = (+avgmod) + (+0.2);
                var mod3 = (+avgmod) + (+0.3);
                var mod4 = (+avgmod) + (+0.3);

                var mod5 = (+avgmod) - (+0.2);
                var mod6 = (+avgmod) - (+0.3);
                var mod7 = (+avgmod) - (+0.2);
                var mod8 = (+avgmod) - (+0.4);



            } else {

                var mod1 = (+avgmod) - (+0.1);
                var mod2 = (+avgmod) - (+0.1);
                var mod10 = (+avgmod) - (+0.1);
                var mod9 = (+avgmod) - (+0.2);
                var mod3 = (+avgmod) - (+0.3);
                var mod4 = (+avgmod) - (+0.3);

                var mod5 = (+avgmod) + (+0.2);
                var mod6 = (+avgmod) + (+0.3);
                var mod7 = (+avgmod) + (+0.2);
                var mod8 = (+avgmod) + (+0.4);




            }


            $('#mod1').val(mod1.toFixed(1));
            $('#mod2').val(mod2.toFixed(1));
            $('#mod3').val(mod3.toFixed(1));
            $('#mod4').val(mod4.toFixed(1));
            $('#mod5').val(mod5.toFixed(1));
            $('#mod6').val(mod6.toFixed(1));
            $('#mod7').val(mod7.toFixed(1));
            $('#mod8').val(mod8.toFixed(1));
            $('#mod9').val(mod9.toFixed(1));
            $('#mod10').val(mod10.toFixed(1));


        });

        $('#avghrd').change(function() {


            var avghrd = $('#avghrd').val();



            var hrd1 = avghrd;
            var hrd2 = avghrd;
            var hrd3 = avghrd;



            $('#hrd1').val(hrd1);
            $('#hrd2').val(hrd2);
            $('#hrd3').val(hrd3);



        });

        $('#avgden').change(function() {
            var i = randomNumberFromRange(1, 99).toFixed();


            var avgden = $('#avgden').val();

            if (i % 2 == 0) {

                var den1 = (+avgden) + (+0.01);
                var den3 = (+avgden) + (+0.03);
                var den5 = (+avgden) + (+0.02);
                var den6 = (+avgden) + (+0.02);
                var den9 = (+avgden) + (+0.01);
                var den2 = (+avgden) - (+0.02);
                var den4 = (+avgden) - (+0.02);
                var den7 = (+avgden) - (+0.01);
                var den8 = (+avgden) - (+0.03);
                var den10 = (+avgden) - (+0.01);



            } else {


                var den1 = (+avgden) - (+0.01);
                var den3 = (+avgden) - (+0.03);
                var den5 = (+avgden) - (+0.02);
                var den6 = (+avgden) - (+0.02);
                var den9 = (+avgden) - (+0.01);
                var den2 = (+avgden) + (+0.02);
                var den4 = (+avgden) + (+0.02);
                var den7 = (+avgden) + (+0.01);
                var den8 = (+avgden) + (+0.03);
                var den10 = (+avgden) + (+0.01);



            }




            $('#den1').val(den1.toFixed(2));
            $('#den2').val(den2.toFixed(2));
            $('#den3').val(den3.toFixed(2));
            $('#den4').val(den4.toFixed(2));
            $('#den5').val(den5.toFixed(2));
            $('#den6').val(den6.toFixed(2));
            $('#den7').val(den7.toFixed(2));
            $('#den8').val(den8.toFixed(2));
            $('#den9').val(den9.toFixed(2));
            $('#den10').val(den10.toFixed(2));
        });

        function che_auto() {
            $('#txtche').css("background-color", "var(--success)");
            $('#avgres').val("I");
            $('#res1').val("I");
            $('#res2').val("I");
            $('#res3').val("I");
            $('#res4').val("I");
            $('#res5').val("I");

            $('#hou1').val("AA");
            $('#hou2').val("AA");
            $('#hou3').val("AA");
            $('#hou4').val("AA");
            $('#hou5').val("AA");

            $('#avghou').val("AA");


            $('#alk1').val("AA");
            $('#alk2').val("AA");
            $('#alk3').val("AA");
            $('#alk4').val("AA");
            $('#alk5').val("AA");

            $('#avgalk').val("AA");


        }

        $('#chk_che').change(function() {
            if (this.checked) {
                che_auto();


            } else {
                $('#txtche').css("background-color", "white");
                $('#res1').val(null);
                $('#res2').val(null);
                $('#res3').val(null);
                $('#res4').val(null);
                $('#res5').val(null);

                $('#avgres').val(null);

                $('#hou1').val(null);
                $('#hou2').val(null);
                $('#hou3').val(null);
                $('#hou4').val(null);
                $('#hou5').val(null);

                $('#avghou').val(null);


                $('#alk1').val(null);
                $('#alk2').val(null);
                $('#alk3').val(null);
                $('#alk4').val(null);
                $('#alk5').val(null);

                $('#avgalk').val(null);


            }

        });
		
		function wtr_auto()
	{
		$('#txtwtr').css("background-color","var(--success)");
		var avg_wtr_1 = randomNumberFromRange(8.00,9.99).toFixed(2);
		$('#avg_wtr_1').val(avg_wtr_1);	
		
		var avg_wtr_1 = $('#avg_wtr_1').val();	
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var wtr_1 = (+avg_wtr_1) + 0.23;
			var wtr_2 = (+avg_wtr_1) - 0.19;
			var wtr_3 = (+avg_wtr_1) + 0.04;
			var wtr_4 = (+avg_wtr_1) - 0.27;
			var wtr_5 = (+avg_wtr_1) + 0.19;
			var wtr_6 = (+avg_wtr_1) - 0.23;
			var wtr_7 = (+avg_wtr_1) + 0.19;
			var wtr_8 = (+avg_wtr_1) - 0.04;
			var wtr_9 = (+avg_wtr_1) + 0.27;
			var wtr_10 = (+avg_wtr_1) - 0.19;
			
		}else{
			var wtr_1 = (+avg_wtr_1) - 0.18;
			var wtr_2 = (+avg_wtr_1) - 0.21;
			var wtr_3 = (+avg_wtr_1) + 0.06;
			var wtr_4 = (+avg_wtr_1) + 0.21;
			var wtr_5 = (+avg_wtr_1) + 0.12;
			var wtr_6 = (+avg_wtr_1) + 0.18;
			var wtr_7 = (+avg_wtr_1) + 0.21;
			var wtr_8 = (+avg_wtr_1) - 0.06;
			var wtr_9 = (+avg_wtr_1) - 0.21;
			var wtr_10 = (+avg_wtr_1) - 0.12;
			
		}
		
		$('#wtr_1').val((+wtr_1).toFixed(2));	
		$('#wtr_2').val((+wtr_2).toFixed(2));	
		$('#wtr_3').val((+wtr_3).toFixed(2));	
		$('#wtr_4').val((+wtr_4).toFixed(2));	
		$('#wtr_5').val((+wtr_5).toFixed(2));
		$('#wtr_6').val((+wtr_6).toFixed(2));
		$('#wtr_7').val((+wtr_7).toFixed(2));
		$('#wtr_8').val((+wtr_8).toFixed(2));
		$('#wtr_9').val((+wtr_9).toFixed(2));
		$('#wtr_10').val((+wtr_10).toFixed(2));

		var weight_a = randomNumberFromRange(4040.000,4095.000).toFixed(3);
		
		var wtr_a_1 = (+weight_a) + 3.630;
		var wtr_a_2 = (+weight_a) + 2.841;
		var wtr_a_3 = (+weight_a) - 3.216;
		var wtr_a_4 = (+weight_a) + 1.635;
		var wtr_a_5 = (+weight_a) - 2.914;
		var wtr_a_6 = (+weight_a) - 3.630;
		var wtr_a_7 = (+weight_a) - 2.841;
		var wtr_a_8 = (+weight_a) + 3.216;
		var wtr_a_9 = (+weight_a) - 1.635;
		var wtr_a_10 = (+weight_a) + 2.914;
		
		$('#wtr_a_1').val((+wtr_a_1).toFixed(3));	
		$('#wtr_a_2').val((+wtr_a_2).toFixed(3));	
		$('#wtr_a_3').val((+wtr_a_3).toFixed(3));	
		$('#wtr_a_4').val((+wtr_a_4).toFixed(3));	
		$('#wtr_a_5').val((+wtr_a_5).toFixed(3));
		$('#wtr_a_6').val((+wtr_a_6).toFixed(3));
		$('#wtr_a_7').val((+wtr_a_7).toFixed(3));
		$('#wtr_a_8').val((+wtr_a_8).toFixed(3));
		$('#wtr_a_9').val((+wtr_a_9).toFixed(3));
		$('#wtr_a_10').val((+wtr_a_10).toFixed(3));
		
		var wtr_a_1 = $('#wtr_a_1').val();	
		var wtr_a_2 = $('#wtr_a_2').val();	
		var wtr_a_3 = $('#wtr_a_3').val();	
		var wtr_a_4 = $('#wtr_a_4').val();	
		var wtr_a_5 = $('#wtr_a_5').val();
		var wtr_a_6 = $('#wtr_a_6').val();
		var wtr_a_7 = $('#wtr_a_7').val();
		var wtr_a_8 = $('#wtr_a_8').val();
		var wtr_a_9 = $('#wtr_a_9').val();
		var wtr_a_10 = $('#wtr_a_10').val();
		
		var wtr_1 = $('#wtr_1').val();	
		var wtr_2 = $('#wtr_2').val();	
		var wtr_3 = $('#wtr_3').val();	
		var wtr_4 = $('#wtr_4').val();	
		var wtr_5 = $('#wtr_5').val();
		var wtr_6 = $('#wtr_6').val();
		var wtr_7 = $('#wtr_7').val();
		var wtr_8 = $('#wtr_8').val();
		var wtr_9 = $('#wtr_9').val();
		var wtr_10 = $('#wtr_10').val();

		var wtr_b_1 = (((+wtr_1) * (+wtr_a_1)) + (100 * (+wtr_a_1))) / 100;
		var wtr_b_2 = (((+wtr_2) * (+wtr_a_2)) + (100 * (+wtr_a_2))) / 100;
		var wtr_b_3 = (((+wtr_3) * (+wtr_a_3)) + (100 * (+wtr_a_3))) / 100;
		var wtr_b_4 = (((+wtr_4) * (+wtr_a_4)) + (100 * (+wtr_a_4))) / 100;
		var wtr_b_5 = (((+wtr_5) * (+wtr_a_5)) + (100 * (+wtr_a_5))) / 100;
		var wtr_b_6 = (((+wtr_6) * (+wtr_a_6)) + (100 * (+wtr_a_6))) / 100;
		var wtr_b_7 = (((+wtr_7) * (+wtr_a_7)) + (100 * (+wtr_a_7))) / 100;
		var wtr_b_8 = (((+wtr_8) * (+wtr_a_8)) + (100 * (+wtr_a_8))) / 100;
		var wtr_b_9 = (((+wtr_9) * (+wtr_a_9)) + (100 * (+wtr_a_9))) / 100;
		var wtr_b_10 = (((+wtr_10) * (+wtr_a_10)) + (100 * (+wtr_a_10))) / 100;
		
		$('#wtr_b_1').val((+wtr_b_1).toFixed(3));	
		$('#wtr_b_2').val((+wtr_b_2).toFixed(3));	
		$('#wtr_b_3').val((+wtr_b_3).toFixed(3));	
		$('#wtr_b_4').val((+wtr_b_4).toFixed(3));	
		$('#wtr_b_5').val((+wtr_b_5).toFixed(3));
		$('#wtr_b_6').val((+wtr_b_6).toFixed(3));
		$('#wtr_b_7').val((+wtr_b_7).toFixed(3));
		$('#wtr_b_8').val((+wtr_b_8).toFixed(3));
		$('#wtr_b_9').val((+wtr_b_9).toFixed(3));
		$('#wtr_b_10').val((+wtr_b_10).toFixed(3));
		
	}
	$('#chk_wtr').change(function(){
        if(this.checked)
		{
			wtr_auto();
		}
        else
		{
			$('#txtwtr').css("background-color","white");
			$('#wtr_a_1').val(null);	
			$('#wtr_a_2').val(null);	
			$('#wtr_a_3').val(null);	
			$('#wtr_a_4').val(null);	
			$('#wtr_a_5').val(null);
			$('#wtr_a_6').val(null);
			$('#wtr_a_7').val(null);
			$('#wtr_a_8').val(null);
			$('#wtr_a_9').val(null);
			$('#wtr_a_10').val(null);
			$('#wtr_b_1').val(null);	
			$('#wtr_b_2').val(null);	
			$('#wtr_b_3').val(null);	
			$('#wtr_b_4').val(null);	
			$('#wtr_b_5').val(null);
			$('#wtr_b_6').val(null);
			$('#wtr_b_7').val(null);
			$('#wtr_b_8').val(null);
			$('#wtr_b_9').val(null);
			$('#wtr_b_10').val(null);
			$('#wtr_1').val(null);	
			$('#wtr_2').val(null);	
			$('#wtr_3').val(null);	
			$('#wtr_4').val(null);	
			$('#wtr_5').val(null);	
			$('#wtr_6').val(null);	
			$('#wtr_7').val(null);	
			$('#wtr_8').val(null);	
			$('#wtr_9').val(null);	
			$('#wtr_10').val(null);	
		}
    });
	
	$('#wtr_a_1, #wtr_a_2, #wtr_a_3, #wtr_a_4, #wtr_a_5, #wtr_b_1, #wtr_b_2, #wtr_b_3, #wtr_b_4, #wtr_b_5, #wtr_b_6, #wtr_b_7, #wtr_b_8, #wtr_b_9, #wtr_b_10').change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		
		var wtr_a_1 = $('#wtr_a_1').val();
		var wtr_a_2 = $('#wtr_a_2').val();
		var wtr_a_3 = $('#wtr_a_3').val();
		var wtr_a_4 = $('#wtr_a_4').val();
		var wtr_a_5 = $('#wtr_a_5').val();
		var wtr_a_6 = $('#wtr_a_6').val();
		var wtr_a_7 = $('#wtr_a_7').val();
		var wtr_a_8 = $('#wtr_a_8').val();
		var wtr_a_9 = $('#wtr_a_9').val();
		var wtr_a_10 = $('#wtr_a_10').val();
		
		var wtr_b_1 = $('#wtr_b_1').val();
		var wtr_b_2 = $('#wtr_b_2').val();
		var wtr_b_3 = $('#wtr_b_3').val();
		var wtr_b_4 = $('#wtr_b_4').val();
		var wtr_b_5 = $('#wtr_b_5').val();
		var wtr_b_6 = $('#wtr_b_6').val();
		var wtr_b_7 = $('#wtr_b_7').val();
		var wtr_b_8 = $('#wtr_b_8').val();
		var wtr_b_9 = $('#wtr_b_9').val();
		var wtr_b_10 = $('#wtr_b_10').val();
		
		var wtr_1 = (100 * ((+wtr_b_1) - (+wtr_a_1))) / (+wtr_a_1);
		var wtr_2 = (100 * ((+wtr_b_2) - (+wtr_a_2))) / (+wtr_a_2);
		var wtr_3 = (100 * ((+wtr_b_3) - (+wtr_a_3))) / (+wtr_a_3);
		var wtr_4 = (100 * ((+wtr_b_4) - (+wtr_a_4))) / (+wtr_a_4);
		var wtr_5 = (100 * ((+wtr_b_5) - (+wtr_a_5))) / (+wtr_a_5);
		var wtr_6 = (100 * ((+wtr_b_6) - (+wtr_a_6))) / (+wtr_a_6);
		var wtr_7 = (100 * ((+wtr_b_7) - (+wtr_a_7))) / (+wtr_a_7);
		var wtr_8 = (100 * ((+wtr_b_8) - (+wtr_a_8))) / (+wtr_a_8);
		var wtr_9 = (100 * ((+wtr_b_9) - (+wtr_a_9))) / (+wtr_a_9);
		var wtr_10 = (100 * ((+wtr_b_10) - (+wtr_a_10))) / (+wtr_a_10);
		
		$('#wtr_1').val((+wtr_1).toFixed(2));
		$('#wtr_2').val((+wtr_2).toFixed(2));
		$('#wtr_3').val((+wtr_3).toFixed(2));
		$('#wtr_4').val((+wtr_4).toFixed(2));
		$('#wtr_5').val((+wtr_5).toFixed(2));
		$('#wtr_6').val((+wtr_6).toFixed(2));
		$('#wtr_7').val((+wtr_7).toFixed(2));
		$('#wtr_8').val((+wtr_8).toFixed(2));
		$('#wtr_9').val((+wtr_9).toFixed(2));
		$('#wtr_10').val((+wtr_10).toFixed(2));
		
		var wtr_1 = $('#wtr_1').val();
		var wtr_2 = $('#wtr_2').val();
		var wtr_3 = $('#wtr_3').val();
		var wtr_4 = $('#wtr_4').val();
		var wtr_5 = $('#wtr_5').val();
		var wtr_6 = $('#wtr_6').val();
		var wtr_7 = $('#wtr_7').val();
		var wtr_8 = $('#wtr_8').val();
		var wtr_9 = $('#wtr_9').val();
		var wtr_10 = $('#wtr_10').val();
		
		var avg_wtr_1 = ((+wtr_1) + (+wtr_2) + (+wtr_3) + (+wtr_4) + (+wtr_5) + (+wtr_6) + (+wtr_7) + (+wtr_8) + (+wtr_9) + (+wtr_10)) / 10;
		$('#avg_wtr_1').val((+avg_wtr_1).toFixed(2));
    });
	
	$('#avg_wtr_1').change(function(){
		$('#txtwtr').css("background-color","var(--success)");
		var avg_wtr_1 = $('#avg_wtr_1').val();	
		if((+randomNumberFromRange(1,9).toFixed())%2==0){
			var wtr_1 = (+avg_wtr_1) + 0.23;
			var wtr_2 = (+avg_wtr_1) - 0.19;
			var wtr_3 = (+avg_wtr_1) + 0.04;
			var wtr_4 = (+avg_wtr_1) - 0.27;
			var wtr_5 = (+avg_wtr_1) + 0.19;
			var wtr_6 = (+avg_wtr_1) - 0.23;
			var wtr_7 = (+avg_wtr_1) + 0.19;
			var wtr_8 = (+avg_wtr_1) - 0.04;
			var wtr_9 = (+avg_wtr_1) + 0.27;
			var wtr_10 = (+avg_wtr_1) - 0.19;
			
		}else{
			var wtr_1 = (+avg_wtr_1) - 0.18;
			var wtr_2 = (+avg_wtr_1) - 0.21;
			var wtr_3 = (+avg_wtr_1) + 0.06;
			var wtr_4 = (+avg_wtr_1) + 0.21;
			var wtr_5 = (+avg_wtr_1) + 0.12;
			var wtr_6 = (+avg_wtr_1) + 0.18;
			var wtr_7 = (+avg_wtr_1) + 0.21;
			var wtr_8 = (+avg_wtr_1) - 0.06;
			var wtr_9 = (+avg_wtr_1) - 0.21;
			var wtr_10 = (+avg_wtr_1) - 0.12;
			
		}
		
		$('#wtr_1').val((+wtr_1).toFixed(2));	
		$('#wtr_2').val((+wtr_2).toFixed(2));	
		$('#wtr_3').val((+wtr_3).toFixed(2));	
		$('#wtr_4').val((+wtr_4).toFixed(2));	
		$('#wtr_5').val((+wtr_5).toFixed(2));
		$('#wtr_6').val((+wtr_6).toFixed(2));
		$('#wtr_7').val((+wtr_7).toFixed(2));
		$('#wtr_8').val((+wtr_8).toFixed(2));
		$('#wtr_9').val((+wtr_9).toFixed(2));
		$('#wtr_10').val((+wtr_10).toFixed(2));

		var weight_a = randomNumberFromRange(4040.000,4095.000).toFixed(3);
		
		var wtr_a_1 = (+weight_a) + 3.630;
		var wtr_a_2 = (+weight_a) + 2.841;
		var wtr_a_3 = (+weight_a) - 3.216;
		var wtr_a_4 = (+weight_a) + 1.635;
		var wtr_a_5 = (+weight_a) - 2.914;
		var wtr_a_6 = (+weight_a) - 3.630;
		var wtr_a_7 = (+weight_a) - 2.841;
		var wtr_a_8 = (+weight_a) + 3.216;
		var wtr_a_9 = (+weight_a) - 1.635;
		var wtr_a_10 = (+weight_a) + 2.914;
		
		$('#wtr_a_1').val((+wtr_a_1).toFixed(3));	
		$('#wtr_a_2').val((+wtr_a_2).toFixed(3));	
		$('#wtr_a_3').val((+wtr_a_3).toFixed(3));	
		$('#wtr_a_4').val((+wtr_a_4).toFixed(3));	
		$('#wtr_a_5').val((+wtr_a_5).toFixed(3));
		$('#wtr_a_6').val((+wtr_a_6).toFixed(3));
		$('#wtr_a_7').val((+wtr_a_7).toFixed(3));
		$('#wtr_a_8').val((+wtr_a_8).toFixed(3));
		$('#wtr_a_9').val((+wtr_a_9).toFixed(3));
		$('#wtr_a_10').val((+wtr_a_10).toFixed(3));
		
		var wtr_a_1 = $('#wtr_a_1').val();	
		var wtr_a_2 = $('#wtr_a_2').val();	
		var wtr_a_3 = $('#wtr_a_3').val();	
		var wtr_a_4 = $('#wtr_a_4').val();	
		var wtr_a_5 = $('#wtr_a_5').val();
		var wtr_a_6 = $('#wtr_a_6').val();
		var wtr_a_7 = $('#wtr_a_7').val();
		var wtr_a_8 = $('#wtr_a_8').val();
		var wtr_a_9 = $('#wtr_a_9').val();
		var wtr_a_10 = $('#wtr_a_10').val();
		
		var wtr_1 = $('#wtr_1').val();	
		var wtr_2 = $('#wtr_2').val();	
		var wtr_3 = $('#wtr_3').val();	
		var wtr_4 = $('#wtr_4').val();	
		var wtr_5 = $('#wtr_5').val();
		var wtr_6 = $('#wtr_6').val();
		var wtr_7 = $('#wtr_7').val();
		var wtr_8 = $('#wtr_8').val();
		var wtr_9 = $('#wtr_9').val();
		var wtr_10 = $('#wtr_10').val();

		var wtr_b_1 = (((+wtr_1) * (+wtr_a_1)) + (100 * (+wtr_a_1))) / 100;
		var wtr_b_2 = (((+wtr_2) * (+wtr_a_2)) + (100 * (+wtr_a_2))) / 100;
		var wtr_b_3 = (((+wtr_3) * (+wtr_a_3)) + (100 * (+wtr_a_3))) / 100;
		var wtr_b_4 = (((+wtr_4) * (+wtr_a_4)) + (100 * (+wtr_a_4))) / 100;
		var wtr_b_5 = (((+wtr_5) * (+wtr_a_5)) + (100 * (+wtr_a_5))) / 100;
		var wtr_b_6 = (((+wtr_6) * (+wtr_a_6)) + (100 * (+wtr_a_6))) / 100;
		var wtr_b_7 = (((+wtr_7) * (+wtr_a_7)) + (100 * (+wtr_a_7))) / 100;
		var wtr_b_8 = (((+wtr_8) * (+wtr_a_8)) + (100 * (+wtr_a_8))) / 100;
		var wtr_b_9 = (((+wtr_9) * (+wtr_a_9)) + (100 * (+wtr_a_9))) / 100;
		var wtr_b_10 = (((+wtr_10) * (+wtr_a_10)) + (100 * (+wtr_a_10))) / 100;
		
		$('#wtr_b_1').val((+wtr_b_1).toFixed(3));	
		$('#wtr_b_2').val((+wtr_b_2).toFixed(3));	
		$('#wtr_b_3').val((+wtr_b_3).toFixed(3));	
		$('#wtr_b_4').val((+wtr_b_4).toFixed(3));	
		$('#wtr_b_5').val((+wtr_b_5).toFixed(3));
		$('#wtr_b_6').val((+wtr_b_6).toFixed(3));
		$('#wtr_b_7').val((+wtr_b_7).toFixed(3));
		$('#wtr_b_8').val((+wtr_b_8).toFixed(3));
		$('#wtr_b_9').val((+wtr_b_9).toFixed(3));
		$('#wtr_b_10').val((+wtr_b_10).toFixed(3));
    });
		

        $('#chk_auto').change(function() {
            if (this.checked) {
                var temp = $('#test_list').val();
                var aa = temp.split(",");
                //dim
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "dim") {
                        $('#txtdim').css("background-color", "var(--success)");
                        $("#chk_dim").prop("checked", true);
                        dim_auto();
                        break;
                    }
                }

                //phy
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "phy") {
                        $('#txtphy').css("background-color", "var(--success)");
                        $("#chk_phy").prop("checked", true);
                        phy_auto();
                        break;
                    }
                }

                //che
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "che") {
                        $('#txtche').css("background-color", "var(--success)");
                        $("#chk_che").prop("checked", true);
                        che_auto();
                        break;
                    }
                }
				
				//WAT
				for(var i=0;i<aa.length;i++)
				{
					if(aa[i]=="WAT")
					{
						$("#chk_wtr").prop("checked", true); 
						wtr_auto();
						break;
					}					
				}



            }
        });



    });

    function randomNumberFromRange(min, max) {
        //return Math.floor(Math.random()*(max-min+1)+min);
        return Math.random() * (max - min) + min;
    }



    $("#btn_upload_excel").click(function() {
        form_data = new FormData();
        var acb = $('#upload_excel').val();
        if (acb == "") {
            alert("Upload excel First");
            return false;
        }
        var lab_no = "<?php echo $lab_no; ?>";
        var job_no = "<?php echo $job_no_main; ?>";
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
        var job_no = "<?php echo $job_no_main; ?>";
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


    $("#btn_edit_data").click(function() {
        $('#btn_edit_data').hide();

    });

    function getGlazedTiles() {
        var lab_no = $('#lab_no').val();
        var report_no = $('#report_no').val();
        var job_no = $('#job_no').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_glazed_tiles.php',
            data: 'action_type=view&' + $("#Glazed").serialize() + '&lab_no=' + lab_no,
            success: function(html) {
                $('#display_data').html(html);

            }
        });
    }



    function saveMetal(type, id) {
        id = (typeof id == "undefined") ? '' : id;
        var statusArr = {
            add: "added",
            edit: "updated",
            delete: "deleted"
        };
        var billData = '';
        if (type == 'add') {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();
            var color = $('#color').val();
            var size1 = $('#size1').val();
            var size2 = $('#size2').val();
            var size3 = $('#size3').val();

            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //dim
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "dim") {
                    if (document.getElementById('chk_dim').checked) {
                        var chk_dim = "1";
                    } else {
                        var chk_dim = "0";
                    }



                    var len1 = $('#len1').val();
                    var len2 = $('#len2').val();
                    var len3 = $('#len3').val();
                    var len4 = $('#len4').val();
                    var len5 = $('#len5').val();
                    var len6 = $('#len6').val();
                    var len7 = $('#len7').val();
                    var len8 = $('#len8').val();
                    var len9 = $('#len9').val();
                    var len10 = $('#len10').val();


                    var wid1 = $('#wid1').val();
                    var wid2 = $('#wid2').val();
                    var wid3 = $('#wid3').val();
                    var wid4 = $('#wid4').val();
                    var wid5 = $('#wid5').val();
                    var wid6 = $('#wid6').val();
                    var wid7 = $('#wid7').val();
                    var wid8 = $('#wid8').val();
                    var wid9 = $('#wid9').val();
                    var wid10 = $('#wid10').val();

                    var thk1 = $('#thk1').val();
                    var thk2 = $('#thk2').val();
                    var thk3 = $('#thk3').val();
                    var thk4 = $('#thk4').val();
                    var thk5 = $('#thk5').val();
                    var thk6 = $('#thk6').val();
                    var thk7 = $('#thk7').val();
                    var thk8 = $('#thk8').val();
                    var thk9 = $('#thk9').val();
                    var thk10 = $('#thk10').val();

                    var str1 = $('#str1').val();
                    var str2 = $('#str2').val();
                    var str3 = $('#str3').val();
                    var str4 = $('#str4').val();
                    var str5 = $('#str5').val();
                    var str6 = $('#str6').val();
                    var str7 = $('#str7').val();
                    var str8 = $('#str8').val();
                    var str9 = $('#str9').val();
                    var str10 = $('#str10').val();

                    var rec1 = $('#rec1').val();
                    var rec2 = $('#rec2').val();
                    var rec3 = $('#rec3').val();
                    var rec4 = $('#rec4').val();
                    var rec5 = $('#rec5').val();
                    var rec6 = $('#rec6').val();
                    var rec7 = $('#rec7').val();
                    var rec8 = $('#rec8').val();
                    var rec9 = $('#rec9').val();
                    var rec10 = $('#rec10').val();

                    var sur1 = $('#sur1').val();
                    var sur2 = $('#sur2').val();
                    var sur3 = $('#sur3').val();
                    var sur4 = $('#sur4').val();
                    var sur5 = $('#sur5').val();
                    var sur6 = $('#sur6').val();
                    var sur7 = $('#sur7').val();
                    var sur8 = $('#sur8').val();
                    var sur9 = $('#sur9').val();
                    var sur10 = $('#sur10').val();
                    var sur_qua = $('#sur_qua').val();
                    var avglen = $('#avglen').val();
                    var avgwid = $('#avgwid').val();
                    var avgthk = $('#avgthk').val();
                    var avgstr = $('#avgstr').val();
                    var avgrec = $('#avgrec').val();
                    var avgsur = $('#avgsur').val();

                    break;
                } else {
                    var chk_dim = "0";
                    var len1 = "0";
                    var len2 = "0";
                    var len3 = "0";
                    var len4 = "0";
                    var len5 = "0";
                    var len6 = "0";
                    var len7 = "0";
                    var len8 = "0";
                    var len9 = "0";
                    var len10 = "0";


                    var wid1 = "0";
                    var wid2 = "0";
                    var wid3 = "0";
                    var wid4 = "0";
                    var wid5 = "0";
                    var wid6 = "0";
                    var wid7 = "0";
                    var wid8 = "0";
                    var wid9 = "0";
                    var wid10 = "0";

                    var thk1 = "0";
                    var thk2 = "0";
                    var thk3 = "0";
                    var thk4 = "0";
                    var thk5 = "0";
                    var thk6 = "0";
                    var thk7 = "0";
                    var thk8 = "0";
                    var thk9 = "0";
                    var thk10 = "0";

                    var str1 = "0";
                    var str2 = "0";
                    var str3 = "0";
                    var str4 = "0";
                    var str5 = "0";
                    var str6 = "0";
                    var str7 = "0";
                    var str8 = "0";
                    var str9 = "0";
                    var str10 = "0";

                    var rec1 = "0";
                    var rec2 = "0";
                    var rec3 = "0";
                    var rec4 = "0";
                    var rec5 = "0";
                    var rec6 = "0";
                    var rec7 = "0";
                    var rec8 = "0";
                    var rec9 = "0";
                    var rec10 = "0";

                    var sur1 = "0";
                    var sur2 = "0";
                    var sur3 = "0";
                    var sur4 = "0";
                    var sur5 = "0";
                    var sur6 = "0";
                    var sur7 = "0";
                    var sur8 = "0";
                    var sur9 = "0";
                    var sur10 = "0";
                    var sur_qua = "0";
                    var avglen = "0";
                    var avgwid = "0";
                    var avgthk = "0";
                    var avgstr = "0";
                    var avgrec = "0";
                    var avgsur = "0";
                }

            }
            //phy
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "phy") {
                    if (document.getElementById('chk_phy').checked) {
                        var chk_phy = "1";
                    } else {
                        var chk_phy = "0";
                    }



                    var wtr1 = $('#wtr1').val();
                    var wtr2 = $('#wtr2').val();
                    var wtr3 = $('#wtr3').val();
                    var wtr4 = $('#wtr4').val();
                    var wtr5 = $('#wtr5').val();



                    var brk1 = $('#brk1').val();
                    var brk2 = $('#brk2').val();
                    var brk3 = $('#brk3').val();
                    var brk4 = $('#brk4').val();
                    var brk5 = $('#brk5').val();
                    var brk6 = $('#brk6').val();
                    var brk7 = $('#brk7').val();
                    var brk8 = $('#brk8').val();
                    var brk9 = $('#brk9').val();
                    var brk10 = $('#brk10').val();

                    var mod1 = $('#mod1').val();
                    var mod2 = $('#mod2').val();
                    var mod3 = $('#mod3').val();
                    var mod4 = $('#mod4').val();
                    var mod5 = $('#mod5').val();
                    var mod6 = $('#mod6').val();
                    var mod7 = $('#mod7').val();
                    var mod8 = $('#mod8').val();
                    var mod9 = $('#mod9').val();
                    var mod10 = $('#mod10').val();

                    var hrd1 = $('#hrd1').val();
                    var hrd2 = $('#hrd2').val();
                    var hrd3 = $('#hrd3').val();


                    var den1 = $('#den1').val();
                    var den2 = $('#den2').val();
                    var den3 = $('#den3').val();
                    var den4 = $('#den4').val();
                    var den5 = $('#den5').val();
                    var den6 = $('#den6').val();
                    var den7 = $('#den7').val();
                    var den8 = $('#den8').val();
                    var den9 = $('#den9').val();
                    var den10 = $('#den10').val();


                    var avgden = $('#avgden').val();
                    var avghrd = $('#avghrd').val();
                    var avgmod = $('#avgmod').val();
                    var avgbrk = $('#avgbrk').val();
                    var avgwtr = $('#avgwtr').val();

                    break;
                } else {
                    var chk_phy = "0";
                    var wtr1 = "0";
                    var wtr2 = "0";
                    var wtr3 = "0";
                    var wtr4 = "0";
                    var wtr5 = "0";



                    var brk1 = "0";
                    var brk2 = "0";
                    var brk3 = "0";
                    var brk4 = "0";
                    var brk5 = "0";
                    var brk6 = "0";
                    var brk7 = "0";
                    var brk8 = "0";
                    var brk9 = "0";
                    var brk10 = "0";

                    var mod1 = "0";
                    var mod2 = "0";
                    var mod3 = "0";
                    var mod4 = "0";
                    var mod5 = "0";
                    var mod6 = "0";
                    var mod7 = "0";
                    var mod8 = "0";
                    var mod9 = "0";
                    var mod10 = "0";

                    var hrd1 = "0";
                    var hrd2 = "0";
                    var hrd3 = "0";


                    var den1 = "0";
                    var den2 = "0";
                    var den3 = "0";
                    var den4 = "0";
                    var den5 = "0";
                    var den6 = "0";
                    var den7 = "0";
                    var den8 = "0";
                    var den9 = "0";
                    var den10 = "0";


                    var avgden = "0";
                    var avghrd = "0";
                    var avgmod = "0";
                    var avgbrk = "0";
                    var avgwtr = "0";

                }

            }
            //che
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "che") {
                    if (document.getElementById('chk_che').checked) {
                        var chk_che = "1";
                    } else {
                        var chk_che = "0";
                    }



                    var res1 = $('#res1').val();
                    var res2 = $('#res2').val();
                    var res3 = $('#res3').val();
                    var res4 = $('#res4').val();
                    var res5 = $('#res5').val();

                    var hou1 = $('#hou1').val();
                    var hou2 = $('#hou2').val();
                    var hou3 = $('#hou3').val();
                    var hou4 = $('#hou4').val();
                    var hou5 = $('#hou5').val();

                    var alk1 = $('#alk1').val();
                    var alk2 = $('#alk2').val();
                    var alk3 = $('#alk3').val();
                    var alk4 = $('#alk4').val();
                    var alk5 = $('#alk5').val();




                    var avgres = $('#avgres').val();
                    var avghou = $('#avghou').val();
                    var avgalk = $('#avgalk').val();


                    break;
                } else {
                    var chk_che = "0";
                    var res1 = "0";
                    var res2 = "0";
                    var res3 = "0";
                    var res4 = "0";
                    var res5 = "0";

                    var hou1 = "0";
                    var hou2 = "0";
                    var hou3 = "0";
                    var hou4 = "0";
                    var hou5 = "0";

                    var alk1 = "0";
                    var alk2 = "0";
                    var alk3 = "0";
                    var alk4 = "0";
                    var alk5 = "0";




                    var avgres = "0";
                    var avghou = "0";
                    var avgalk = "0";

                }

            }
			
			//WATER ABSORPTION
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="WAT")
				{
					if(document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					}
					else{
						var chk_wtr = "0";
					}
					var wtr_a_1 = $('#wtr_a_1').val();
					var wtr_a_2 = $('#wtr_a_2').val();
					var wtr_a_3 = $('#wtr_a_3').val();
					var wtr_a_4 = $('#wtr_a_4').val();
					var wtr_a_5 = $('#wtr_a_5').val();
					var wtr_a_6 = $('#wtr_a_6').val();
					var wtr_a_7 = $('#wtr_a_7').val();
					var wtr_a_8 = $('#wtr_a_8').val();
					var wtr_a_9 = $('#wtr_a_9').val();
					var wtr_a_10 = $('#wtr_a_10').val();
					var wtr_b_1 = $('#wtr_b_1').val();
					var wtr_b_2 = $('#wtr_b_2').val();
					var wtr_b_3 = $('#wtr_b_3').val();
					var wtr_b_4 = $('#wtr_b_4').val();
					var wtr_b_5 = $('#wtr_b_5').val();
					var wtr_b_6 = $('#wtr_b_6').val();
					var wtr_b_7 = $('#wtr_b_7').val();
					var wtr_b_8 = $('#wtr_b_8').val();
					var wtr_b_9 = $('#wtr_b_9').val();
					var wtr_b_10 = $('#wtr_b_10').val();
					var wtr_1 = $('#wtr_1').val();
					var wtr_2 = $('#wtr_2').val();
					var wtr_3 = $('#wtr_3').val();
					var wtr_4 = $('#wtr_4').val();
					var wtr_5 = $('#wtr_5').val();
					var wtr_6 = $('#wtr_6').val();
					var wtr_7 = $('#wtr_7').val();
					var wtr_8 = $('#wtr_8').val();
					var wtr_9 = $('#wtr_9').val();
					var wtr_10 = $('#wtr_10').val();
					var avg_wtr_1 = $('#avg_wtr_1').val();
					break;
				}
				else
				{
					var chk_wtr = "0";
					var wtr_a_1 = "0";
					var wtr_a_2 = "0";
					var wtr_a_3 = "0";
					var wtr_a_4 = "0";
					var wtr_a_5 = "0";
					var wtr_a_6 = "0";
					var wtr_a_7 = "0";
					var wtr_a_8 = "0";
					var wtr_a_9 = "0";
					var wtr_a_10 = "0";
					var wtr_b_1 = "0";
					var wtr_b_2 = "0";
					var wtr_b_3 = "0";
					var wtr_b_4 = "0";
					var wtr_b_5 = "0";
					var wtr_b_6 = "0";
					var wtr_b_7 = "0";
					var wtr_b_8 = "0";
					var wtr_b_9 = "0";
					var wtr_b_10 = "0";
					var wtr_1 = "0";
					var wtr_2 = "0";
					var wtr_3 = "0";
					var wtr_4 = "0";
					var wtr_5 = "0";
					var wtr_6 = "0";
					var wtr_7 = "0";
					var wtr_8 = "0";
					var wtr_9 = "0";
					var wtr_10 = "0";
					var avg_wtr_1 = "0";
				}
			}






            billData = '&action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&color=' + color + '&size1=' + size1 + '&size2=' + size2 + '&size3=' + size3 + '&ulr=' + ulr + '&chk_dim=' + chk_dim + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&len4=' + len4 + '&len5=' + len5 + '&len6=' + len6 + '&len7=' + len7 + '&len8=' + len8 + '&len9=' + len9 + '&len10=' + len10 + '&avglen=' + avglen + '&wid1=' + wid1 + '&wid2=' + wid2 + '&wid3=' + wid3 + '&wid4=' + wid4 + '&wid5=' + wid5 + '&wid6=' + wid6 + '&wid7=' + wid7 + '&wid8=' + wid8 + '&wid9=' + wid9 + '&wid10=' + wid10 + '&avgwid=' + avgwid + '&thk1=' + thk1 + '&thk2=' + thk2 + '&thk3=' + thk3 + '&thk4=' + thk4 + '&thk5=' + thk5 + '&thk6=' + thk6 + '&thk7=' + thk7 + '&thk8=' + thk8 + '&thk9=' + thk9 + '&thk10=' + thk10 + '&avgthk=' + avgthk + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&str4=' + str4 + '&str5=' + str5 + '&str6=' + str6 + '&str7=' + str7 + '&str8=' + str8 + '&str9=' + str9 + '&str10=' + str10 + '&avgstr=' + avgstr + '&rec1=' + rec1 + '&rec2=' + rec2 + '&rec3=' + rec3 + '&rec4=' + rec4 + '&rec5=' + rec5 + '&rec6=' + rec6 + '&rec7=' + rec7 + '&rec8=' + rec8 + '&rec9=' + rec9 + '&rec10=' + rec10 + '&avgrec=' + avgrec + '&sur1=' + sur1 + '&sur2=' + sur2 + '&sur3=' + sur3 + '&sur4=' + sur4 + '&sur5=' + sur5 + '&sur6=' + sur6 + '&sur7=' + sur7 + '&sur8=' + sur8 + '&sur9=' + sur9 + '&sur10=' + sur10 + '&avgsur=' + avgsur + '&sur_qua=' + sur_qua + '&chk_phy=' + chk_phy + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&wtr4=' + wtr4 + '&wtr5=' + wtr5 + '&avgwtr=' + avgwtr + '&brk1=' + brk1 + '&brk2=' + brk2 + '&brk3=' + brk3 + '&brk4=' + brk4 + '&brk5=' + brk5 + '&brk6=' + brk6 + '&brk7=' + brk7 + '&brk8=' + brk8 + '&brk9=' + brk9 + '&brk10=' + brk10 + '&avgbrk=' + avgbrk + '&mod1=' + mod1 + '&mod2=' + mod2 + '&mod3=' + mod3 + '&mod4=' + mod4 + '&mod5=' + mod5 + '&mod6=' + mod6 + '&mod7=' + mod7 + '&mod8=' + mod8 + '&mod9=' + mod9 + '&mod10=' + mod10 + '&avgmod=' + avgmod + '&hrd1=' + hrd1 + '&hrd2=' + hrd2 + '&hrd3=' + hrd3 + '&avghrd=' + avghrd + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&den5=' + den5 + '&den6=' + den6 + '&den7=' + den7 + '&den8=' + den8 + '&den9=' + den9 + '&den10=' + den10 + '&avgden=' + avgden + '&chk_che=' + chk_che + '&res1=' + res1 + '&res2=' + res2 + '&res3=' + res3 + '&res4=' + res4 + '&res5=' + res5 + '&avgres=' + avgres + '&hou1=' + hou1 + '&hou2=' + hou2 + '&hou3=' + hou3 + '&hou4=' + hou4 + '&hou5=' + hou5 + '&avghou=' + avghou + '&alk1=' + alk1 + '&alk2=' + alk2 + '&alk3=' + alk3 + '&alk4=' + alk4 + '&alk5=' + alk5 + '&avgalk=' + avgalk+'&chk_wtr='+chk_wtr+'&wtr_a_1='+wtr_a_1+'&wtr_a_2='+wtr_a_2+'&wtr_a_3='+wtr_a_3+'&wtr_a_4='+wtr_a_4+'&wtr_a_5='+wtr_a_5+'&wtr_a_6='+wtr_a_6+'&wtr_a_7='+wtr_a_7+'&wtr_a_8='+wtr_a_8+'&wtr_a_9='+wtr_a_9+'&wtr_a_10='+wtr_a_10+'&wtr_b_1='+wtr_b_1+'&wtr_b_2='+wtr_b_2+'&wtr_b_3='+wtr_b_3+'&wtr_b_4='+wtr_b_4+'&wtr_b_5='+wtr_b_5+'&wtr_b_6='+wtr_b_6+'&wtr_b_7='+wtr_b_7+'&wtr_b_8='+wtr_b_8+'&wtr_b_9='+wtr_b_9+'&wtr_b_10='+wtr_b_10+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&wtr_4='+wtr_4+'&wtr_5='+wtr_5+'&wtr_6='+wtr_6+'&wtr_7='+wtr_7+'&wtr_8='+wtr_8+'&wtr_9='+wtr_9+'&wtr_10='+wtr_10+'&avg_wtr_1='+avg_wtr_1+'&amend_date='+amend_date;




        } else if (type == 'edit') {

            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            var ulr = $('#ulr').val();
            var amend_date = $('#amend_date').val();
            var color = $('#color').val();
            var size1 = $('#size1').val();
            var size2 = $('#size2').val();
            var size3 = $('#size3').val();
            var temp = $('#test_list').val();
            var aa = temp.split(",");

            //dim
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "dim") {
                    if (document.getElementById('chk_dim').checked) {
                        var chk_dim = "1";
                    } else {
                        var chk_dim = "0";
                    }



                    var len1 = $('#len1').val();
                    var len2 = $('#len2').val();
                    var len3 = $('#len3').val();
                    var len4 = $('#len4').val();
                    var len5 = $('#len5').val();
                    var len6 = $('#len6').val();
                    var len7 = $('#len7').val();
                    var len8 = $('#len8').val();
                    var len9 = $('#len9').val();
                    var len10 = $('#len10').val();


                    var wid1 = $('#wid1').val();
                    var wid2 = $('#wid2').val();
                    var wid3 = $('#wid3').val();
                    var wid4 = $('#wid4').val();
                    var wid5 = $('#wid5').val();
                    var wid6 = $('#wid6').val();
                    var wid7 = $('#wid7').val();
                    var wid8 = $('#wid8').val();
                    var wid9 = $('#wid9').val();
                    var wid10 = $('#wid10').val();

                    var thk1 = $('#thk1').val();
                    var thk2 = $('#thk2').val();
                    var thk3 = $('#thk3').val();
                    var thk4 = $('#thk4').val();
                    var thk5 = $('#thk5').val();
                    var thk6 = $('#thk6').val();
                    var thk7 = $('#thk7').val();
                    var thk8 = $('#thk8').val();
                    var thk9 = $('#thk9').val();
                    var thk10 = $('#thk10').val();

                    var str1 = $('#str1').val();
                    var str2 = $('#str2').val();
                    var str3 = $('#str3').val();
                    var str4 = $('#str4').val();
                    var str5 = $('#str5').val();
                    var str6 = $('#str6').val();
                    var str7 = $('#str7').val();
                    var str8 = $('#str8').val();
                    var str9 = $('#str9').val();
                    var str10 = $('#str10').val();

                    var rec1 = $('#rec1').val();
                    var rec2 = $('#rec2').val();
                    var rec3 = $('#rec3').val();
                    var rec4 = $('#rec4').val();
                    var rec5 = $('#rec5').val();
                    var rec6 = $('#rec6').val();
                    var rec7 = $('#rec7').val();
                    var rec8 = $('#rec8').val();
                    var rec9 = $('#rec9').val();
                    var rec10 = $('#rec10').val();

                    var sur1 = $('#sur1').val();
                    var sur2 = $('#sur2').val();
                    var sur3 = $('#sur3').val();
                    var sur4 = $('#sur4').val();
                    var sur5 = $('#sur5').val();
                    var sur6 = $('#sur6').val();
                    var sur7 = $('#sur7').val();
                    var sur8 = $('#sur8').val();
                    var sur9 = $('#sur9').val();
                    var sur10 = $('#sur10').val();
                    var sur_qua = $('#sur_qua').val();
                    var avglen = $('#avglen').val();
                    var avgwid = $('#avgwid').val();
                    var avgthk = $('#avgthk').val();
                    var avgstr = $('#avgstr').val();
                    var avgrec = $('#avgrec').val();
                    var avgsur = $('#avgsur').val();

                    break;
                } else {
                    var chk_dim = "0";
                    var len1 = "0";
                    var len2 = "0";
                    var len3 = "0";
                    var len4 = "0";
                    var len5 = "0";
                    var len6 = "0";
                    var len7 = "0";
                    var len8 = "0";
                    var len9 = "0";
                    var len10 = "0";


                    var wid1 = "0";
                    var wid2 = "0";
                    var wid3 = "0";
                    var wid4 = "0";
                    var wid5 = "0";
                    var wid6 = "0";
                    var wid7 = "0";
                    var wid8 = "0";
                    var wid9 = "0";
                    var wid10 = "0";

                    var thk1 = "0";
                    var thk2 = "0";
                    var thk3 = "0";
                    var thk4 = "0";
                    var thk5 = "0";
                    var thk6 = "0";
                    var thk7 = "0";
                    var thk8 = "0";
                    var thk9 = "0";
                    var thk10 = "0";

                    var str1 = "0";
                    var str2 = "0";
                    var str3 = "0";
                    var str4 = "0";
                    var str5 = "0";
                    var str6 = "0";
                    var str7 = "0";
                    var str8 = "0";
                    var str9 = "0";
                    var str10 = "0";

                    var rec1 = "0";
                    var rec2 = "0";
                    var rec3 = "0";
                    var rec4 = "0";
                    var rec5 = "0";
                    var rec6 = "0";
                    var rec7 = "0";
                    var rec8 = "0";
                    var rec9 = "0";
                    var rec10 = "0";

                    var sur1 = "0";
                    var sur2 = "0";
                    var sur3 = "0";
                    var sur4 = "0";
                    var sur5 = "0";
                    var sur6 = "0";
                    var sur7 = "0";
                    var sur8 = "0";
                    var sur9 = "0";
                    var sur10 = "0";
                    var sur_qua = "0";
                    var avglen = "0";
                    var avgwid = "0";
                    var avgthk = "0";
                    var avgstr = "0";
                    var avgrec = "0";
                    var avgsur = "0";
                }

            }
            //phy
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "phy") {
                    if (document.getElementById('chk_phy').checked) {
                        var chk_phy = "1";
                    } else {
                        var chk_phy = "0";
                    }



                    var wtr1 = $('#wtr1').val();
                    var wtr2 = $('#wtr2').val();
                    var wtr3 = $('#wtr3').val();
                    var wtr4 = $('#wtr4').val();
                    var wtr5 = $('#wtr5').val();



                    var brk1 = $('#brk1').val();
                    var brk2 = $('#brk2').val();
                    var brk3 = $('#brk3').val();
                    var brk4 = $('#brk4').val();
                    var brk5 = $('#brk5').val();
                    var brk6 = $('#brk6').val();
                    var brk7 = $('#brk7').val();
                    var brk8 = $('#brk8').val();
                    var brk9 = $('#brk9').val();
                    var brk10 = $('#brk10').val();

                    var mod1 = $('#mod1').val();
                    var mod2 = $('#mod2').val();
                    var mod3 = $('#mod3').val();
                    var mod4 = $('#mod4').val();
                    var mod5 = $('#mod5').val();
                    var mod6 = $('#mod6').val();
                    var mod7 = $('#mod7').val();
                    var mod8 = $('#mod8').val();
                    var mod9 = $('#mod9').val();
                    var mod10 = $('#mod10').val();

                    var hrd1 = $('#hrd1').val();
                    var hrd2 = $('#hrd2').val();
                    var hrd3 = $('#hrd3').val();


                    var den1 = $('#den1').val();
                    var den2 = $('#den2').val();
                    var den3 = $('#den3').val();
                    var den4 = $('#den4').val();
                    var den5 = $('#den5').val();
                    var den6 = $('#den6').val();
                    var den7 = $('#den7').val();
                    var den8 = $('#den8').val();
                    var den9 = $('#den9').val();
                    var den10 = $('#den10').val();


                    var avgden = $('#avgden').val();
                    var avghrd = $('#avghrd').val();
                    var avgmod = $('#avgmod').val();
                    var avgbrk = $('#avgbrk').val();
                    var avgwtr = $('#avgwtr').val();

                    break;
                } else {
                    var chk_phy = "0";
                    var wtr1 = "0";
                    var wtr2 = "0";
                    var wtr3 = "0";
                    var wtr4 = "0";
                    var wtr5 = "0";



                    var brk1 = "0";
                    var brk2 = "0";
                    var brk3 = "0";
                    var brk4 = "0";
                    var brk5 = "0";
                    var brk6 = "0";
                    var brk7 = "0";
                    var brk8 = "0";
                    var brk9 = "0";
                    var brk10 = "0";

                    var mod1 = "0";
                    var mod2 = "0";
                    var mod3 = "0";
                    var mod4 = "0";
                    var mod5 = "0";
                    var mod6 = "0";
                    var mod7 = "0";
                    var mod8 = "0";
                    var mod9 = "0";
                    var mod10 = "0";

                    var hrd1 = "0";
                    var hrd2 = "0";
                    var hrd3 = "0";


                    var den1 = "0";
                    var den2 = "0";
                    var den3 = "0";
                    var den4 = "0";
                    var den5 = "0";
                    var den6 = "0";
                    var den7 = "0";
                    var den8 = "0";
                    var den9 = "0";
                    var den10 = "0";


                    var avgden = "0";
                    var avghrd = "0";
                    var avgmod = "0";
                    var avgbrk = "0";
                    var avgwtr = "0";

                }

            }
            //che
            for (var i = 0; i < aa.length; i++) {
                if (aa[i] == "che") {
                    if (document.getElementById('chk_che').checked) {
                        var chk_che = "1";
                    } else {
                        var chk_che = "0";
                    }



                    var res1 = $('#res1').val();
                    var res2 = $('#res2').val();
                    var res3 = $('#res3').val();
                    var res4 = $('#res4').val();
                    var res5 = $('#res5').val();

                    var hou1 = $('#hou1').val();
                    var hou2 = $('#hou2').val();
                    var hou3 = $('#hou3').val();
                    var hou4 = $('#hou4').val();
                    var hou5 = $('#hou5').val();

                    var alk1 = $('#alk1').val();
                    var alk2 = $('#alk2').val();
                    var alk3 = $('#alk3').val();
                    var alk4 = $('#alk4').val();
                    var alk5 = $('#alk5').val();




                    var avgres = $('#avgres').val();
                    var avghou = $('#avghou').val();
                    var avgalk = $('#avgalk').val();


                    break;
                } else {
                    var chk_che = "0";
                    var res1 = "0";
                    var res2 = "0";
                    var res3 = "0";
                    var res4 = "0";
                    var res5 = "0";

                    var hou1 = "0";
                    var hou2 = "0";
                    var hou3 = "0";
                    var hou4 = "0";
                    var hou5 = "0";

                    var alk1 = "0";
                    var alk2 = "0";
                    var alk3 = "0";
                    var alk4 = "0";
                    var alk5 = "0";




                    var avgres = "0";
                    var avghou = "0";
                    var avgalk = "0";

                }

            }
			
			//WATER ABSORPTION
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="WAT")
				{
					if(document.getElementById('chk_wtr').checked) {
						var chk_wtr = "1";
					}
					else{
						var chk_wtr = "0";
					}
					var wtr_a_1 = $('#wtr_a_1').val();
					var wtr_a_2 = $('#wtr_a_2').val();
					var wtr_a_3 = $('#wtr_a_3').val();
					var wtr_a_4 = $('#wtr_a_4').val();
					var wtr_a_5 = $('#wtr_a_5').val();
					var wtr_a_6 = $('#wtr_a_6').val();
					var wtr_a_7 = $('#wtr_a_7').val();
					var wtr_a_8 = $('#wtr_a_8').val();
					var wtr_a_9 = $('#wtr_a_9').val();
					var wtr_a_10 = $('#wtr_a_10').val();
					var wtr_b_1 = $('#wtr_b_1').val();
					var wtr_b_2 = $('#wtr_b_2').val();
					var wtr_b_3 = $('#wtr_b_3').val();
					var wtr_b_4 = $('#wtr_b_4').val();
					var wtr_b_5 = $('#wtr_b_5').val();
					var wtr_b_6 = $('#wtr_b_6').val();
					var wtr_b_7 = $('#wtr_b_7').val();
					var wtr_b_8 = $('#wtr_b_8').val();
					var wtr_b_9 = $('#wtr_b_9').val();
					var wtr_b_10 = $('#wtr_b_10').val();
					var wtr_1 = $('#wtr_1').val();
					var wtr_2 = $('#wtr_2').val();
					var wtr_3 = $('#wtr_3').val();
					var wtr_4 = $('#wtr_4').val();
					var wtr_5 = $('#wtr_5').val();
					var wtr_6 = $('#wtr_6').val();
					var wtr_7 = $('#wtr_7').val();
					var wtr_8 = $('#wtr_8').val();
					var wtr_9 = $('#wtr_9').val();
					var wtr_10 = $('#wtr_10').val();
					var avg_wtr_1 = $('#avg_wtr_1').val();
					break;
				}
				else
				{
					var chk_wtr = "0";
					var wtr_a_1 = "0";
					var wtr_a_2 = "0";
					var wtr_a_3 = "0";
					var wtr_a_4 = "0";
					var wtr_a_5 = "0";
					var wtr_a_6 = "0";
					var wtr_a_7 = "0";
					var wtr_a_8 = "0";
					var wtr_a_9 = "0";
					var wtr_a_10 = "0";
					var wtr_b_1 = "0";
					var wtr_b_2 = "0";
					var wtr_b_3 = "0";
					var wtr_b_4 = "0";
					var wtr_b_5 = "0";
					var wtr_b_6 = "0";
					var wtr_b_7 = "0";
					var wtr_b_8 = "0";
					var wtr_b_9 = "0";
					var wtr_b_10 = "0";
					var wtr_1 = "0";
					var wtr_2 = "0";
					var wtr_3 = "0";
					var wtr_4 = "0";
					var wtr_5 = "0";
					var wtr_6 = "0";
					var wtr_7 = "0";
					var wtr_8 = "0";
					var wtr_9 = "0";
					var wtr_10 = "0";
					var avg_wtr_1 = "0";
				}
			}



            var idEdit = $('#idEdit').val();

            billData = $("#Glazed").find('.form').serialize() + '&action_type=' + type + '&idEdit=' + idEdit + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no + '&color=' + color + '&size1=' + size1 + '&size2=' + size2 + '&size3=' + size3 + '&ulr=' + ulr + '&chk_dim=' + chk_dim + '&len1=' + len1 + '&len2=' + len2 + '&len3=' + len3 + '&len4=' + len4 + '&len5=' + len5 + '&len6=' + len6 + '&len7=' + len7 + '&len8=' + len8 + '&len9=' + len9 + '&len10=' + len10 + '&avglen=' + avglen + '&wid1=' + wid1 + '&wid2=' + wid2 + '&wid3=' + wid3 + '&wid4=' + wid4 + '&wid5=' + wid5 + '&wid6=' + wid6 + '&wid7=' + wid7 + '&wid8=' + wid8 + '&wid9=' + wid9 + '&wid10=' + wid10 + '&avgwid=' + avgwid + '&thk1=' + thk1 + '&thk2=' + thk2 + '&thk3=' + thk3 + '&thk4=' + thk4 + '&thk5=' + thk5 + '&thk6=' + thk6 + '&thk7=' + thk7 + '&thk8=' + thk8 + '&thk9=' + thk9 + '&thk10=' + thk10 + '&avgthk=' + avgthk + '&str1=' + str1 + '&str2=' + str2 + '&str3=' + str3 + '&str4=' + str4 + '&str5=' + str5 + '&str6=' + str6 + '&str7=' + str7 + '&str8=' + str8 + '&str9=' + str9 + '&str10=' + str10 + '&avgstr=' + avgstr + '&rec1=' + rec1 + '&rec2=' + rec2 + '&rec3=' + rec3 + '&rec4=' + rec4 + '&rec5=' + rec5 + '&rec6=' + rec6 + '&rec7=' + rec7 + '&rec8=' + rec8 + '&rec9=' + rec9 + '&rec10=' + rec10 + '&avgrec=' + avgrec + '&sur1=' + sur1 + '&sur2=' + sur2 + '&sur3=' + sur3 + '&sur4=' + sur4 + '&sur5=' + sur5 + '&sur6=' + sur6 + '&sur7=' + sur7 + '&sur8=' + sur8 + '&sur9=' + sur9 + '&sur10=' + sur10 + '&avgsur=' + avgsur + '&sur_qua=' + sur_qua + '&chk_phy=' + chk_phy + '&wtr1=' + wtr1 + '&wtr2=' + wtr2 + '&wtr3=' + wtr3 + '&wtr4=' + wtr4 + '&wtr5=' + wtr5 + '&avgwtr=' + avgwtr + '&brk1=' + brk1 + '&brk2=' + brk2 + '&brk3=' + brk3 + '&brk4=' + brk4 + '&brk5=' + brk5 + '&brk6=' + brk6 + '&brk7=' + brk7 + '&brk8=' + brk8 + '&brk9=' + brk9 + '&brk10=' + brk10 + '&avgbrk=' + avgbrk + '&mod1=' + mod1 + '&mod2=' + mod2 + '&mod3=' + mod3 + '&mod4=' + mod4 + '&mod5=' + mod5 + '&mod6=' + mod6 + '&mod7=' + mod7 + '&mod8=' + mod8 + '&mod9=' + mod9 + '&mod10=' + mod10 + '&avgmod=' + avgmod + '&hrd1=' + hrd1 + '&hrd2=' + hrd2 + '&hrd3=' + hrd3 + '&avghrd=' + avghrd + '&den1=' + den1 + '&den2=' + den2 + '&den3=' + den3 + '&den4=' + den4 + '&den5=' + den5 + '&den6=' + den6 + '&den7=' + den7 + '&den8=' + den8 + '&den9=' + den9 + '&den10=' + den10 + '&avgden=' + avgden + '&chk_che=' + chk_che + '&res1=' + res1 + '&res2=' + res2 + '&res3=' + res3 + '&res4=' + res4 + '&res5=' + res5 + '&avgres=' + avgres + '&hou1=' + hou1 + '&hou2=' + hou2 + '&hou3=' + hou3 + '&hou4=' + hou4 + '&hou5=' + hou5 + '&avghou=' + avghou + '&alk1=' + alk1 + '&alk2=' + alk2 + '&alk3=' + alk3 + '&alk4=' + alk4 + '&alk5=' + alk5 + '&avgalk=' + avgalk+'&chk_wtr='+chk_wtr+'&wtr_a_1='+wtr_a_1+'&wtr_a_2='+wtr_a_2+'&wtr_a_3='+wtr_a_3+'&wtr_a_4='+wtr_a_4+'&wtr_a_5='+wtr_a_5+'&wtr_a_6='+wtr_a_6+'&wtr_a_7='+wtr_a_7+'&wtr_a_8='+wtr_a_8+'&wtr_a_9='+wtr_a_9+'&wtr_a_10='+wtr_a_10+'&wtr_b_1='+wtr_b_1+'&wtr_b_2='+wtr_b_2+'&wtr_b_3='+wtr_b_3+'&wtr_b_4='+wtr_b_4+'&wtr_b_5='+wtr_b_5+'&wtr_b_6='+wtr_b_6+'&wtr_b_7='+wtr_b_7+'&wtr_b_8='+wtr_b_8+'&wtr_b_9='+wtr_b_9+'&wtr_b_10='+wtr_b_10+'&wtr_1='+wtr_1+'&wtr_2='+wtr_2+'&wtr_3='+wtr_3+'&wtr_4='+wtr_4+'&wtr_5='+wtr_5+'&wtr_6='+wtr_6+'&wtr_7='+wtr_7+'&wtr_8='+wtr_8+'&wtr_9='+wtr_9+'&wtr_10='+wtr_10+'&avg_wtr_1='+avg_wtr_1+'&amend_date='+amend_date;
        } else {
            var report_no = $('#report_no').val();
            var job_no = $('#job_no').val();
            var lab_no = $('#lab_no').val();
            billData = 'action_type=' + type + '&report_no=' + report_no + '&job_no=' + job_no + '&lab_no=' + lab_no;
        }


        $.ajax({
            type: 'POST',
            url: '<?php echo $base_url; ?>save_glazed_tiles.php',
            data: billData,
            dataType: 'JSON',
            success: function(msg) {
                $('#btn_save').hide();
                getGlazedTiles();
                var report_no = $('#report_no').val();
                var job_no = $('#job_no').val();
                //window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?report_no="+report_no+"&&job_no="+job_no;
            }
        });
    }

    function editData(id) {
        var lab_no = $('#lab_no').val();
        var report_no = $('#report_no').val();
        var job_no = $('#job_no').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?php echo $base_url; ?>save_glazed_tiles.php',
            data: 'action_type=data&id=' + id + '&lab_no=' + lab_no,
            success: function(data) {
                $('#idEdit').val(data.id);
                var idEdit = $('#idEdit').val();
                $('#report_no').val(data.report_no);
                $('#job_no').val(data.job_no);
                $('#lab_no').val(data.lab_no);
                $('#ulr').val(data.ulr);
                $('#amend_date').val(data.amend_date);
                $('#color').val(data.color);
                $('#size1').val(data.size1);
                $('#size2').val(data.size2);
                $('#size3').val(data.size3);


                var temp = $('#test_list').val();
                var aa = temp.split(",");

                //dim
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "dim") {

                        var chk_dim = data.chk_dim;
                        if (chk_dim == "1") {
                            $('#txtdim').css("background-color", "var(--success)");
                            $("#chk_dim").prop("checked", true);
                        } else {
                            $('#txtdim').css("background-color", "white");
                            $("#chk_dim").prop("checked", false);
                        }


                        $('#len1').val(data.len1);
                        $('#len2').val(data.len2);
                        $('#len3').val(data.len3);
                        $('#len4').val(data.len4);
                        $('#len5').val(data.len5);
                        $('#len6').val(data.len6);
                        $('#len7').val(data.len7);
                        $('#len8').val(data.len8);
                        $('#len9').val(data.len9);
                        $('#len10').val(data.len10);

                        $('#wid1').val(data.wid1);
                        $('#wid2').val(data.wid2);
                        $('#wid3').val(data.wid3);
                        $('#wid4').val(data.wid4);
                        $('#wid5').val(data.wid5);
                        $('#wid6').val(data.wid6);
                        $('#wid7').val(data.wid7);
                        $('#wid8').val(data.wid8);
                        $('#wid9').val(data.wid9);
                        $('#wid10').val(data.wid10);

                        $('#thk1').val(data.thk1);
                        $('#thk2').val(data.thk2);
                        $('#thk3').val(data.thk3);
                        $('#thk4').val(data.thk4);
                        $('#thk5').val(data.thk5);
                        $('#thk6').val(data.thk6);
                        $('#thk7').val(data.thk7);
                        $('#thk8').val(data.thk8);
                        $('#thk9').val(data.thk9);
                        $('#thk10').val(data.thk10);

                        $('#str1').val(data.str1);
                        $('#str2').val(data.str2);
                        $('#str3').val(data.str3);
                        $('#str4').val(data.str4);
                        $('#str5').val(data.str5);
                        $('#str6').val(data.str6);
                        $('#str7').val(data.str7);
                        $('#str8').val(data.str8);
                        $('#str9').val(data.str9);
                        $('#str10').val(data.str10);

                        $('#rec1').val(data.rec1);
                        $('#rec2').val(data.rec2);
                        $('#rec3').val(data.rec3);
                        $('#rec4').val(data.rec4);
                        $('#rec5').val(data.rec5);
                        $('#rec6').val(data.rec6);
                        $('#rec7').val(data.rec7);
                        $('#rec8').val(data.rec8);
                        $('#rec9').val(data.rec9);
                        $('#rec10').val(data.rec10);

                        $('#sur1').val(data.sur1);
                        $('#sur2').val(data.sur2);
                        $('#sur3').val(data.sur3);
                        $('#sur4').val(data.sur4);
                        $('#sur5').val(data.sur5);
                        $('#sur6').val(data.sur6);
                        $('#sur7').val(data.sur7);
                        $('#sur8').val(data.sur8);
                        $('#sur9').val(data.sur9);
                        $('#sur10').val(data.sur10);
                        $('#sur_qua').val(data.sur_qua);
                        $('#avgsur').val(data.avgsur);
                        $('#avgrec').val(data.avgrec);
                        $('#avgstr').val(data.avgstr);
                        $('#avgthk').val(data.avgthk);
                        $('#avgwid').val(data.avgwid);
                        $('#avglen').val(data.avglen);


                        break;
                    } else {

                    }

                }

                //phy
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "phy") {



                        var chk_phy = data.chk_phy;
                        if (chk_phy == "1") {
                            $('#txtphy').css("background-color", "var(--success)");
                            $("#chk_phy").prop("checked", true);
                        } else {
                            $('#txtphy').css("background-color", "white");
                            $("#chk_phy").prop("checked", false);
                        }


                        $('#wtr1').val(data.wtr1);
                        $('#wtr2').val(data.wtr2);
                        $('#wtr3').val(data.wtr3);
                        $('#wtr4').val(data.wtr4);
                        $('#wtr5').val(data.wtr5);
                        $('#avgwtr').val(data.avgwtr);

                        $('#hrd1').val(data.hrd1);
                        $('#hrd2').val(data.hrd2);
                        $('#hrd3').val(data.hrd3);

                        $('#avghrd').val(data.avghrd);

                        $('#brk1').val(data.brk1);
                        $('#brk2').val(data.brk2);
                        $('#brk3').val(data.brk3);
                        $('#brk4').val(data.brk4);
                        $('#brk5').val(data.brk5);
                        $('#brk6').val(data.brk6);
                        $('#brk7').val(data.brk7);
                        $('#brk8').val(data.brk8);
                        $('#brk9').val(data.brk9);
                        $('#brk10').val(data.brk10);
                        $('#avgbrk').val(data.avgbrk);

                        $('#mod1').val(data.mod1);
                        $('#mod2').val(data.mod2);
                        $('#mod3').val(data.mod3);
                        $('#mod4').val(data.mod4);
                        $('#mod5').val(data.mod5);
                        $('#mod6').val(data.mod6);
                        $('#mod7').val(data.mod7);
                        $('#mod8').val(data.mod8);
                        $('#mod9').val(data.mod9);
                        $('#mod10').val(data.mod10);
                        $('#avgmod').val(data.avgmod);

                        $('#den1').val(data.den1);
                        $('#den2').val(data.den2);
                        $('#den3').val(data.den3);
                        $('#den4').val(data.den4);
                        $('#den5').val(data.den5);
                        $('#den6').val(data.den6);
                        $('#den7').val(data.den7);
                        $('#den8').val(data.den8);
                        $('#den9').val(data.den9);
                        $('#den10').val(data.den10);
                        $('#avgden').val(data.avgden);

                        break;
                    } else {

                    }

                }

                //che
                for (var i = 0; i < aa.length; i++) {
                    if (aa[i] == "che") {

                        var chk_che = data.chk_che;
                        if (chk_che == "1") {
                            $('#txtche').css("background-color", "var(--success)");
                            $("#chk_che").prop("checked", true);
                        } else {
                            $('#txtche').css("background-color", "white");
                            $("#chk_che").prop("checked", false);
                        }
                        $('#res1').val(data.res1);
                        $('#res2').val(data.res2);
                        $('#res3').val(data.res3);
                        $('#res4').val(data.res4);
                        $('#res5').val(data.res5);
                        $('#avgres').val(data.avgres);

                        $('#hou1').val(data.hou1);
                        $('#hou2').val(data.hou2);
                        $('#hou3').val(data.hou3);
                        $('#hou4').val(data.hou4);
                        $('#hou5').val(data.hou5);
                        $('#avghou').val(data.avghou);

                        $('#alk1').val(data.alk1);
                        $('#alk2').val(data.alk2);
                        $('#alk3').val(data.alk3);
                        $('#alk4').val(data.alk4);
                        $('#alk5').val(data.alk5);
                        $('#avgalk').val(data.avgalk);


                        break;
                    } else {

                    }

                }
				
				//WATER ABSORPTION
			for(var i=0;i<aa.length;i++)
			{
				if(aa[i]=="WAT")
				{
					var chk_wtr = data.chk_wtr;
					if(chk_wtr=="1")
					{
						$('#txtwtr').css("background-color","var(--success)");	
						$("#chk_wtr").prop("checked", true); 
					}else{
						$('#txtkwtr').css("background-color","white");	
						$("#chk_wtr").prop("checked", false); 
					}
					$('#wtr_a_1').val(data.wtr_a_1);
					$('#wtr_a_2').val(data.wtr_a_2);
					$('#wtr_a_3').val(data.wtr_a_3);
					$('#wtr_a_4').val(data.wtr_a_4);
					$('#wtr_a_5').val(data.wtr_a_5);
					$('#wtr_a_6').val(data.wtr_a_6);
					$('#wtr_a_7').val(data.wtr_a_7);
					$('#wtr_a_8').val(data.wtr_a_8);
					$('#wtr_a_9').val(data.wtr_a_9);
					$('#wtr_a_10').val(data.wtr_a_10);
					$('#wtr_b_1').val(data.wtr_b_1);
					$('#wtr_b_2').val(data.wtr_b_2);
					$('#wtr_b_3').val(data.wtr_b_3);
					$('#wtr_b_4').val(data.wtr_b_4);
					$('#wtr_b_5').val(data.wtr_b_5);
					$('#wtr_b_6').val(data.wtr_b_6);
					$('#wtr_b_7').val(data.wtr_b_7);
					$('#wtr_b_8').val(data.wtr_b_8);
					$('#wtr_b_9').val(data.wtr_b_9);
					$('#wtr_b_10').val(data.wtr_b_10);
					$('#wtr_1').val(data.wtr_1);
					$('#wtr_2').val(data.wtr_2);
					$('#wtr_3').val(data.wtr_3);
					$('#wtr_4').val(data.wtr_4);
					$('#wtr_5').val(data.wtr_5);
					$('#wtr_6').val(data.wtr_6);
					$('#wtr_7').val(data.wtr_7);
					$('#wtr_8').val(data.wtr_8);
					$('#wtr_9').val(data.wtr_9);
					$('#wtr_10').val(data.wtr_10);
					$('#avg_wtr_1').val(data.avg_wtr_1);
					break;
				}
			}
				
                $('#btn_edit_data').show();
                $('#btn_save').hide();
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