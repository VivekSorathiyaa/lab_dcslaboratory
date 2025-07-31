<?php include("connection.php");
include("selbi.php");


session_start();
if (isset($_SESSION['nabl_type']) && $_SESSION['nabl_type'] != "") {
    if ($_SESSION['nabl_type'] == "nabl") {
        ?>
        <script>
            window.location.href = "<?php echo $_SESSION['branch_name'] ?>/direct_nabl/task_asigner.php?a=rec";
        </script>
        <?php
    }

    if ($_SESSION['nabl_type'] == "non_nabl") {
        ?>
        <script>
            window.location.href = "<?php echo $_SESSION['branch_name'] ?>_n/direct_nabl/task_asigner.php?a=rec";
        </script>
        <?php
    }

    if ($_SESSION['nabl_type'] == "blank") {
        ?>
        <script>
            window.location.href = "<?php echo $_SESSION['branch_name'] ?>_n/non_nabl/master_forms.php";
        </script>
        <?php
    }
}
?>
<?php


$query = "select * from desktop_images ORDER BY desk_img_id DESC";
$result = mysqli_query($conn, $query);
$set_array = array();
while ($one_images = mysqli_fetch_array($result)) {
    array_push($set_array, "images/desk_gallery/" . $one_images["desk_img"]);
}



if (isset($_POST['btnsubmit'])) {
    $name = $_POST['staff_email'];
    $password = $_POST['staff_pass'];
    $fy_id = $_POST['fy_year'];
    $sel_fy_years = "select * from fyearmaster where id=" . $fy_id;
    $query_fy = mysqli_query($conn, $sel_fy_years);
    $row_fy = mysqli_fetch_array($query_fy);
    $fy_bill_no = $row_fy["bill_nos"];
    $ulr_nos = $row_fy["ulr_nos"];
    $fy_name = $row_fy["fy_name"];
    // for login of nabl part
    $select_staff_multi = "select * from multi_login where staff_email='$name' and staff_first_pass='$password'";
    $query_first = mysqli_query($conn, $select_staff_multi);
    $row_first = mysqli_fetch_array($query_first);
    $direct_non = "";
    if ($name == $row_first['staff_email'] && $password == $row_first['staff_first_pass']) {

        $_SESSION['id'] = $row_first['id'];
        $_SESSION['u_id'] = $row_first['id'];
        $_SESSION['name'] = $row_first['staff_fullname'];
        $_SESSION['isadmin'] = $row_first['staff_isadmin'];
        $_SESSION['fy_id'] = $fy_id;
        $_SESSION['fy_name'] = $fy_name;
        $_SESSION['fy_bill_no'] = $fy_bill_no;
        $_SESSION['fy_ulr_no'] = $ulr_nos;
        $_SESSION['billing_show'] = $row_first['billing_show'];
        ;
        $_SESSION['staff_email'] = $row_first['staff_email'];
        ;
        $direct_non = "manully";
    }



    //for admin and biller login
    $select_staff = "select * from staff where staff_email='$name' and staff_pass='$password'";
    $query = mysqli_query($conn, $select_staff);
    $row = mysqli_fetch_array($query);

    if ($name == $row['staff_email'] && $password == $row['staff_pass']) {

        $_SESSION['id'] = $row['id'];
        $_SESSION['u_id'] = $row['id'];
        $_SESSION['name'] = $row['staff_fullname'];
        $_SESSION['isadmin'] = $row['staff_isadmin'];
        $_SESSION['staff_email'] = $row['staff_email'];
        $_SESSION['fy_id'] = $fy_id;
        $_SESSION['fy_bill_no'] = $fy_bill_no;
        $_SESSION['fy_ulr_no'] = $ulr_nos;
        $direct_non = "admin";
    }

    //last condition to redirection to the pages
    /*if(isset($_SESSION['nabl_type']) && $_SESSION['nabl_type'] !="")
                {*/

    /*if($_SESSION['nabl_type']=="nabl")
                    {

                        ?>
                            <script>window.location.href= "<?php echo $_SESSION['branch_name'] ?>/direct_nabl/job_listing_for_direct_user.php?a=rec";</script>
                        <?php
                    }

                    if($_SESSION['nabl_type']=="non_nabl")
                    {

                        ?>
                            <script>window.location.href= "<?php echo $_SESSION['branch_name'] ?>_n/direct_non_nabl/job_listing_for_direct_user.php";</script>
                        <?php
                    }


                    if($_SESSION['nabl_type']=="blank")
                    {

                        ?>
                            <script>window.location.href="<?php echo $_SESSION['branch_name'] ?>_n/non_nabl/master_dashboard.php";</script>
                        <?php
                    }
                    */


    if ($direct_non == "manully") {
        if ($_SESSION['isadmin'] == "2") { ?>
            <script>
                window.location.href = "nabl/dashboard.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "3") { ?>
            <script>
                window.location.href = "nabl/dashbord_notice.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "4") { ?>
            <script>
                window.location.href = "nabl/dashboard.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "5") { ?>
            <script>
                window.location.href = "nabl/dashboard.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "9") { ?>
            <script>
                window.location.href = "nabl/task_asigner.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "11") { ?>
            <script>
                window.location.href = "nabl/arrival_jobs_list_from_rec_to_tm.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "888") { ?>
            <script>
                window.location.href = "nabl/list_of_completed_job_report_for_deleter.php";
            </script>
        <?php }
    } elseif ($direct_non == "direct") {
        if ($_SESSION['isadmin'] == "2") { ?>
            <script>
                window.location.href = "direct_nabl/task_asigner.php?a=rec";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "3") { ?>
            <script>
                window.location.href = "direct_nabl/dashbord_notice.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "4") { ?>
            <script>
                window.location.href = "direct_nabl/arrival_jobs_list_from_tm_to_eng.php?a=eng";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "5") { ?>
            <script>
                window.location.href = "direct_nabl/task_asigner.php?a=qm";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "11") { ?>
            <script>
                window.location.href = "direct_nabl/arrival_jobs_list_from_rec_to_tm.php";
            </script>
        <?php }
    } elseif ($direct_non == "admin") {
        if ($_SESSION['isadmin'] == "6") { ?>
            <script>
                window.location.href = "nabl/list_of_job_report_for_biller.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "7") { ?>
            <script>
                window.location.href = "nabl/office_biller_master_forms.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "8") { ?>
            <script>
                window.location.href = "nabl/calibration_entry_by_calibrator.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "0") { ?>
            <script>
                window.location.href = "nabl/dashboard.php";
            </script>
        <?php }
        if ($_SESSION['isadmin'] == "11") { ?>
            <script>
                window.location.href = "nabl/arrival_jobs_list_from_rec_to_tm.php";
            </script>
        <?php }
    } else {
        ?>
        <script>
            window.location.href = "index.php";
            alert("INVALID EMAIL ID OR PASSWORD.. \n PLEASE INSERT VALID DATA..");
        </script>
        <?php
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NextGenLIMS Technologies | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- shortcut icon -->
    <link rel="icon" href="images/icon.png" type="image/png">
    <!-- css -->
    <link rel="stylesheet" href="bower_components/css/style.css" type="text/css">
    <!-- google-font ---->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>



<body class="login-page"
    style="background-image: url('images/bg-img.png'); background-repeat: no-repeat; background-size: cover;background-attachment: fixed;background-size:100% 100%;background-color:#208381;">
    <div class="login-calendar-container">
        <div class="login-box-wrapper">
            <div class="login-box">
                <div class="login-logo">
                    <img src="nabl/images/nextgen_logo.png" style="margin-bottom: 10px;width:250px;">
                </div>
                <div class="login-box-body">
                    <h3 class="login-box-msg">Login</h3>
                    <form action="#" method="post" style="margin-bottom: 0px;">
                        <div class="form-group has-feedback form-margin-first">
                            <label>Email Address</label>
                            <input type="text" id="staff_email" name="staff_email" class="form-control"
                                placeholder="Email" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback form-margin-sec">
                            <label>Password</label>
                            <input type="password" id="staff_pass" name="staff_pass" class="form-control"
                                placeholder="Password" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback" style="display:none;">
                            <select id="fy_year" name="fy_year" class="form-control" required>
                                <?php
                                $sel_branch = "select * from fyearmaster where `fy_isdeleted`=0 order by id DESC";
                                $query_branch = mysqli_query($conn, $sel_branch);
                                if (mysqli_num_rows($query_branch) > 0) {
                                    while ($one_branch = mysqli_fetch_array($query_branch)) { ?>
                                        <option value="<?php echo $one_branch['id']; ?>"><?php echo $one_branch['fy_name']; ?>
                                        </option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if ($thater == "") { ?>
                                    <button type="submit" name="btnsubmit" id="btnsubmit"
                                        class="btn btn-primary btn-block btn-flat"
                                        style="border-color: unset !important;border-radius: 8px;">Login</button>
                                <?php } else { ?>
                                    <button type="button" name="btnsubmit" id="btnsubmit"
                                        class="btn btn-primary btn-block btn-flat"
                                        style="border-color: unset !important;border-radius: 8px;">Login</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <script>
            // Professional Calendar for Login Page
            let calYear, calMonth;
            function getDashboardNotesForDate(dateStr) {
                // Try to get both dailyNotes and calendarEvents from localStorage
                let notes = [];
                try {
                    const dailyNotes = JSON.parse(localStorage.getItem('dailyNotes')) || [];
                    notes = dailyNotes.filter(n => n.date === dateStr);
                } catch (e) { }
                let events = [];
                try {
                    const calendarEvents = JSON.parse(localStorage.getItem('calendarEvents')) || {};
                    if (calendarEvents[dateStr]) events = calendarEvents[dateStr];
                } catch (e) { }
                return { notes, events };
            }
            function renderProCalendar(year, month) {
                const grid = document.getElementById('calendar-pro-grid');
                const monthYear = document.getElementById('calendar-pro-monthyear');
                grid.innerHTML = '';
                // Header row
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                days.forEach(d => {
                    const cell = document.createElement('div');
                    cell.className = 'calendar-pro-header-cell';
                    cell.textContent = d;
                    grid.appendChild(cell);
                });
                // Dates
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                let cells = [];
                for (let i = 0; i < firstDay; i++) cells.push('');
                for (let i = 1; i <= daysInMonth; i++) cells.push(i);
                while (cells.length % 7 !== 0) cells.push('');
                const today = new Date();
                cells.forEach((val, idx) => {
                    const dayDiv = document.createElement('div');
                    dayDiv.className = 'calendar-pro-day';
                    if (val === '') {
                        dayDiv.style.background = 'none';
                        dayDiv.style.cursor = 'default';
                        dayDiv.style.boxShadow = 'none';
                        dayDiv.style.border = 'none';
                    } else {
                        dayDiv.textContent = val;
                        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(val).padStart(2, '0')}`;
                        const { notes, events } = getDashboardNotesForDate(dateStr);
                        if (notes.length > 0 || (events && events.length > 0)) {
                            dayDiv.classList.add('has-note');
                            // Tooltip
                            const tooltip = document.createElement('div');
                            tooltip.className = 'calendar-pro-tooltip';
                            let tip = '';
                            if (notes.length > 0) tip += 'Notes:\n' + notes.map(n => '- ' + n.text).join('\n');
                            if (events.length > 0) tip += (tip ? '\n' : '') + 'Events:\n' + events.map(e => '- ' + e.title + (e.riders.length ? ' (' + e.riders.join(', ') + ')' : '')).join('\n');
                            tooltip.textContent = tip;
                            dayDiv.appendChild(tooltip);
                            // Badge
                            const badge = document.createElement('span');
                            badge.className = 'calendar-pro-badge';
                            badge.title = `${notes.length > 0 ? notes.length + ' note(s)' : ''}${notes.length > 0 && events.length > 0 ? ', ' : ''}${events.length > 0 ? events.length + ' event(s)' : ''}`;
                            dayDiv.appendChild(badge);
                            // Click to show modal
                            dayDiv.style.cursor = 'pointer';
                            dayDiv.onclick = function (e) {
                                showCalendarNoteModal(dateStr, notes, events);
                                e.stopPropagation();
                            };
                        }
                        if (
                            val === today.getDate() &&
                            month === today.getMonth() &&
                            year === today.getFullYear()
                        ) {
                            dayDiv.classList.add('today');
                        }
                    }
                    grid.appendChild(dayDiv);
                });
                monthYear.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
            }
            function calPrevMonth() {
                if (calMonth === 0) {
                    calMonth = 11;
                    calYear--;
                } else {
                    calMonth--;
                }
                renderProCalendar(calYear, calMonth);
            }
            function calNextMonth() {
                if (calMonth === 11) {
                    calMonth = 0;
                    calYear++;
                } else {
                    calMonth++;
                }
                renderProCalendar(calYear, calMonth);
            }
            document.addEventListener('DOMContentLoaded', function () {
                const now = new Date();
                calYear = now.getFullYear();
                calMonth = now.getMonth();
                renderProCalendar(calYear, calMonth);
                document.getElementById('calPrev').onclick = calPrevMonth;
                document.getElementById('calNext').onclick = calNextMonth;
            });
            function showCalendarNoteModal(dateStr, notes, events) {
                const modal = document.getElementById('calendarNoteModal');
                const body = document.getElementById('calendarNoteModalBody');
                let html = `<div style='font-weight:600;color:#667eea;margin-bottom:8px;'>${dateStr}</div>`;
                if (notes.length > 0) {
                    html += `<div style='margin-bottom:6px;'><b>Notes:</b><ul style='margin:4px 0 0 16px;padding:0;'>` + notes.map(n => `<li>${n.text}</li>`).join('') + `</ul></div>`;
                }
                if (events.length > 0) {
                    html += `<div><b>Events:</b><ul style='margin:4px 0 0 16px;padding:0;'>` + events.map(e => `<li>${e.title}${e.riders.length ? ' <span style=\'color:#888;font-size:0.95em;\'>(' + e.riders.join(', ') + ')</span>' : ''}</li>`).join('') + `</ul></div>`;
                }
                if (notes.length === 0 && events.length === 0) {
                    html += `<div style='color:#888;'>No notes or events for this date.</div>`;
                }
                body.innerHTML = html;
                modal.style.display = 'flex';
            }
            function closeCalendarNoteModal() {
                document.getElementById('calendarNoteModal').style.display = 'none';
            }
            window.addEventListener('click', function (e) {
                const modal = document.getElementById('calendarNoteModal');
                if (e.target === modal) closeCalendarNoteModal();
            });
            window.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeCalendarNoteModal();
            });
        </script>
        <!-- jQuery 3 -->
        <script src="plugins/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>


        <!-- <script>
        $(document).ready(function() {});
        var images = <?php echo '["' . implode('", "', $set_array) . '"]' ?>;

        //var images=['images/b1.jpg','images/b2.jpg','images/b3.jpg','images/b4.jpg','images/b5.jpg','images/b6.jpg','images/b7.jpg','images/b8.jpg','images/b9.jpg','images/b10.jpg','images/b11.jpg','images/b12.jpg','images/b13.jpg','images/b14.jpg','images/b15.jpg','images/b16.jpg','images/b17.jpg','images/b18.jpg','images/b19.jpg'];

        setInterval(function() {
            var url = images[Math.floor(Math.random() * images.length)];
            document.body.style.backgroundImage = 'url(' + url + ')';
            document.body.style.backgroundRepeat = "no-repeat";
            document.body.style.backgroundSize = "100% 100%";
        }, 5000);
    </script> -->
        <!-- Sweet Alert -->

        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>