<?php
// Your existing PHP code goes here, from the top of your original home.php
// This includes 'connection.php', 'selbi.php', session handling, and form submission logic.
// I'm skipping this part to focus on the new front-end, as you requested.
// Just copy and paste the entire PHP block from your original file here.
include("connection.php");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DCS ENGINEERS & CONSULTANT PVT. LTD. | Login</title>
    <link rel="icon" href="images/icon.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-color: #212529;
            --border-color: #dee2e6;
            --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            background-attachment: fixed;
            padding: 20px;
        }

        .login-container {
            display: flex;
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--box-shadow);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .login-form-wrapper {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-logo img {
            max-width: 200px;
            height: auto;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            padding-right: 40px;
            /* Space for the icon */
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        .form-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-login:hover {
            background-color: #0a58ca;
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .calendar-section {
            flex: 1;
            background: linear-gradient(135deg, #1f2b60 0%, #208381 100%);
            color: #fff;
            padding: 40px;
            border-radius: 0 16px 16px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            text-align: center;
        }

        .calendar-section h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .calendar-pro-container {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 20px;
        }

        .calendar-pro-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .calendar-pro-nav {
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 1.5rem;
            padding: 5px;
            transition: color 0.2s ease;
        }

        .calendar-pro-nav:hover {
            color: var(--primary-color);
        }

        .calendar-pro-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            text-align: center;
        }

        .calendar-pro-header-cell {
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 0;
            opacity: 0.8;
        }

        .calendar-pro-day {
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            position: relative;
            transition: background-color 0.2s ease;
            user-select: none;
        }

        .calendar-pro-day:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .calendar-pro-day.today {
            background-color: var(--primary-color);
            color: #fff;
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
        }

        .calendar-pro-day.has-note {
            cursor: pointer;
            border: 2px solid var(--primary-color);
        }

        .calendar-pro-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            display: block;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: #333;
            text-decoration: none;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .calendar-section {
                border-radius: 0 0 16px 16px;
                padding: 30px 20px;
            }

            .login-form-wrapper {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form-wrapper">
            <div class="login-logo">
                <img src="nabl/images/nextgen_logo.png" alt="Company Logo">
            </div>
            <h1 class="login-title">Login to Your Account</h1>

            <form action="#" method="post">
                <div class="form-group">
                    <label for="staff_email">Email Address</label>
                    <div style="position: relative;">
                        <input type="text" id="staff_email" name="staff_email" class="form-control"
                            placeholder="Enter your email" required>
                        <span class="form-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="staff_pass">Password</label>
                    <div style="position: relative;">
                        <input type="password" id="staff_pass" name="staff_pass" class="form-control"
                            placeholder="Enter your password" required>
                        <span class="form-icon"><i class="fas fa-lock"></i></span>
                    </div>
                </div>

                <div class="form-group" style="display:none;">
                    <label for="fy_year">Financial Year</label>
                    <select id="fy_year" name="fy_year" class="form-control" required>
                        <?php
                        // Your PHP code to populate the financial year dropdown goes here
                        $sel_branch = "select * from fyearmaster where `fy_isdeleted`=0 order by id DESC";
                        $query_branch = mysqli_query($conn, $sel_branch);
                        if (mysqli_num_rows($query_branch) > 0) {
                            while ($one_branch = mysqli_fetch_array($query_branch)) {
                                ?>
                                <option value="<?php echo $one_branch['id']; ?>"><?php echo $one_branch['fy_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnsubmit" class="btn-login">Login</button>
                </div>
            </form>
        </div>

        <div class="calendar-section">
            <h2>Upcoming Events & Notes</h2>
            <div class="calendar-pro-container">
                <div class="calendar-pro-header">
                    <button type="button" class="calendar-pro-nav" id="calPrev"><i
                            class="fas fa-chevron-left"></i></button>
                    <span id="calendar-pro-monthyear"></span>
                    <button type="button" class="calendar-pro-nav" id="calNext"><i
                            class="fas fa-chevron-right"></i></button>
                </div>
                <div class="calendar-pro-grid" id="calendar-pro-grid">
                </div>
            </div>
        </div>
    </div>

    <div id="calendarNoteModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeCalendarNoteModal()">&times;</span>
            <div id="calendarNoteModalBody"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        // Your existing Calendar JavaScript logic, unchanged, goes here
        let calYear, calMonth;
        function getDashboardNotesForDate(dateStr) {
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
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            days.forEach(d => {
                const cell = document.createElement('div');
                cell.className = 'calendar-pro-header-cell';
                cell.textContent = d;
                grid.appendChild(cell);
            });
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
                        const tooltip = document.createElement('div');
                        tooltip.className = 'calendar-pro-tooltip';
                        let tip = '';
                        if (notes.length > 0) tip += 'Notes:\n' + notes.map(n => '- ' + n.text).join('\n');
                        if (events.length > 0) tip += (tip ? '\n' : '') + 'Events:\n' + events.map(e => '- ' + e.title + (e.riders.length ? ' (' + e.riders.join(', ') + ')' : '')).join('\n');
                        tooltip.textContent = tip;
                        dayDiv.appendChild(tooltip);
                        const badge = document.createElement('span');
                        badge.className = 'calendar-pro-badge';
                        badge.title = `${notes.length > 0 ? notes.length + ' note(s)' : ''}${notes.length > 0 && events.length > 0 ? ', ' : ''}${events.length > 0 ? events.length + ' event(s)' : ''}`;
                        dayDiv.appendChild(badge);
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
</body>

</html>