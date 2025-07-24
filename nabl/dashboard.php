<?php
// Start session at the very beginning
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the external connection file
require_once("connection.php");

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set timezone
date_default_timezone_set('Asia/Kolkata');

// Check if user is logged in
if (!isset($_SESSION['id']) || $_SESSION['id'] == 0) {
    header("Location: login.php");
    exit();
}

// Initialize session variables if not set
if (!isset($_SESSION['isadmin'])) {
    $_SESSION['isadmin'] = 0;
}

// Initialize variables
$today = date('d-m-Y');
$todayNotes = [];

// Fetch today's daily notes
try {
    $today_escaped = $conn->real_escape_string($today);
    $sql_notes = "SELECT * FROM daily_notes WHERE note_date = '$today_escaped' ORDER BY created_at DESC";
    $result_notes = mysqli_query($conn, $sql_notes);
    
    if ($result_notes) {
        while ($row_notes = mysqli_fetch_assoc($result_notes)) {
            $todayNotes[] = $row_notes;
        }
        mysqli_free_result($result_notes);
    } else {
        throw new Exception("Error fetching notes: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    error_log("Error in daily notes: " . $e->getMessage());
}

// Fetch approved leaves for the calendar
$approved_leaves = [];
try {
    $user_id = (int)$_SESSION['id'];
    $sql = "SELECT from_date, to_date FROM leave_applications WHERE status = 'approved' AND user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $start = new DateTime($row['from_date']);
            $end = new DateTime($row['to_date']);
            $interval = new DateInterval('P1D');
            $date_range = new DatePeriod($start, $interval, $end->modify('+1 day'));
            
            foreach ($date_range as $date) {
                $approved_leaves[] = $date->format('Y-m-d');
            }
        }
        mysqli_free_result($result);
    } else {
        throw new Exception("Error fetching leaves: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    error_log("Error in approved leaves: " . $e->getMessage());
}

// Handle AJAX requests for calendar events
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'get_event':
                    $id = (int)$_POST['id'];
                    $sql = "SELECT * FROM calendar_events WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $response['success'] = true;
                        $response['event'] = $row;
                    } else {
                        $response['message'] = 'Event not found';
                    }
                    if ($result) mysqli_free_result($result);
                    break;
                    
                case 'add_event':
                    $date = mysqli_real_escape_string($conn, $_POST['date']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $riders = mysqli_real_escape_string($conn, $_POST['riders']);
                    
                    $sql = "INSERT INTO calendar_events (event_date, event_title, event_riders) 
                            VALUES ('$date', '$title', '$riders')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                    } else {
                        throw new Exception("Error adding event: " . mysqli_error($conn));
                    }
                    break;
                    
                case 'delete_event':
                    $id = (int)$_POST['id'];
                    $sql = "DELETE FROM calendar_events WHERE id = $id";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                    } else {
                        throw new Exception("Error deleting event: " . mysqli_error($conn));
                    }
                    break;
                    
                case 'add_daily_note':
                    $note = mysqli_real_escape_string($conn, $_POST['note']);
                    $today = date('d-m-Y');
                    
                    $sql = "INSERT INTO daily_notes (note_date, note_text) VALUES ('$today', '$note')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                    } else {
                        throw new Exception("Error adding note: " . mysqli_error($conn));
                    }
                    break;
                    
                case 'delete_daily_note':
                    $id = (int)$_POST['id'];
                    $sql = "DELETE FROM daily_notes WHERE id = $id";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                    } else {
                        throw new Exception("Error deleting note: " . mysqli_error($conn));
                    }
                    break;

                case 'edit_event':
                    $id = (int)$_POST['id'];
                    $date = mysqli_real_escape_string($conn, $_POST['date']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $riders = mysqli_real_escape_string($conn, $_POST['riders']);
                    
                    $sql = "UPDATE calendar_events SET 
                            event_date = '$date', 
                            event_title = '$title', 
                            event_riders = '$riders' 
                            WHERE id = $id";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                    } else {
                        throw new Exception("Error updating event: " . mysqli_error($conn));
                    }
                    break;

                case 'apply_leave':
                    $user_id = (int)$_POST['user_id'];
                    $from_date = mysqli_real_escape_string($conn, $_POST['from_date']);
                    $to_date = mysqli_real_escape_string($conn, $_POST['to_date']);
                    $total_days = (int)$_POST['total_days'];
                    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
                    
                    // Handle file upload
                    $document_path = '';
                    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                        $upload_dir = 'uploads/leave_documents/';
                        if (!file_exists($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }
                        
                        $file_name = time() . '_' . basename($_FILES['document']['name']);
                        $target_path = $upload_dir . $file_name;
                        
                        if (move_uploaded_file($_FILES['document']['tmp_name'], $target_path)) {
                            $document_path = $target_path;
                        }
                    }
                    
                    $sql = "INSERT INTO leave_applications (user_id, from_date, to_date, total_days, reason, document_path) 
                            VALUES ($user_id, '$from_date', '$to_date', $total_days, '$reason', '$document_path')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                        $response['message'] = 'Leave application submitted successfully';
                    } else {
                        throw new Exception("Error submitting leave: " . mysqli_error($conn));
                    }
                    break;

                case 'update_leave_status':
                    if ($_SESSION['isadmin'] != 0) {
                        $response['message'] = 'Unauthorized access';
                        break;
                    }

                    $leave_id = (int)$_POST['leave_id'];
                    $status = mysqli_real_escape_string($conn, $_POST['status']);
                    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

                    if (!in_array($status, ['approved', 'rejected'])) {
                        $response['message'] = 'Invalid status value';
                        break;
                    }

                    $sql = "UPDATE leave_applications SET 
                            status = '$status', 
                            admin_remarks = '$remarks' 
                            WHERE id = $leave_id";

                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                        $response['message'] = 'Leave status updated successfully';
                    } else {
                        throw new Exception("Error updating leave status: " . mysqli_error($conn));
                    }
                    break;

                case 'delete_leave':
                    // Allow deletion if admin or if user is deleting their own leave
                    $leave_id = (int)$_POST['leave_id'];
                    $user_id_session = (int)$_SESSION['id'];

                    // Check if the user is admin or the owner of the leave request
                    if ($_SESSION['isadmin'] != 0) {
                        // If not admin, verify if the leave request belongs to the user
                        $sql_check_owner = "SELECT user_id FROM leave_applications WHERE id = $leave_id";
                        $result_check_owner = mysqli_query($conn, $sql_check_owner);

                        if ($result_check_owner && $row_owner = mysqli_fetch_assoc($result_check_owner)) {
                            if ($row_owner['user_id'] != $user_id_session) {
                                // User is not the owner and not admin, deny access
                                $response['message'] = 'Unauthorized access';
                                mysqli_free_result($result_check_owner);
                                break;
                            }
                            mysqli_free_result($result_check_owner);
                        } else {
                            // Leave not found or error checking owner
                             $response['message'] = 'Leave application not found or error.';
                             if ($result_check_owner) mysqli_free_result($result_check_owner);
                             break;
                        }
                    }

                    // First get the document path to delete the file if exists
                    $sql = "SELECT document_path FROM leave_applications WHERE id = $leave_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        if (!empty($row['document_path']) && file_exists($row['document_path'])) {
                            unlink($row['document_path']);
                        }
                    }
                    if ($result) mysqli_free_result($result);

                    // Delete the leave application
                    $sql = "DELETE FROM leave_applications WHERE id = $leave_id";

                    if (mysqli_query($conn, $sql)) {
                        $response['success'] = true;
                        $response['message'] = 'Leave application deleted successfully';
                    } else {
                        throw new Exception("Error deleting leave: " . mysqli_error($conn));
                    }
                    break;

                case 'get_user_approved_leaves':
                    // Allow admin to fetch any user's data, but non-admin only their own
                    $requested_user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0; // Get requested user ID, default to 0
                    $logged_in_user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0; // Get logged-in user ID, default to 0
                    $is_admin = (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 0);

                    // Basic validation for user IDs
                    if ($requested_user_id <= 0 || $logged_in_user_id <= 0) {
                         $response['message'] = 'Invalid user ID.';
                         error_log("Leave Graph: Invalid user ID provided. Requested: " . $requested_user_id . ", Logged-in: " . $logged_in_user_id);
                         break;
                    }

                    // Log requested and logged-in user IDs
                    error_log("Leave Graph: Requested User ID: " . $requested_user_id . ", Logged-in User ID: " . $logged_in_user_id . ", Is Admin: " . ($is_admin ? 'true' : 'false'));

                    if (!$is_admin && $requested_user_id !== $logged_in_user_id) {
                        $response['message'] = 'Unauthorized access: You can only view your own leave data.';
                        error_log("Leave Graph: Unauthorized access attempt.");
                        break;
                    }
                    
                    // Use the requested user ID (either the admin's requested ID or the logged-in user's ID)
                    $user_id_to_fetch = $is_admin ? $requested_user_id : $logged_in_user_id;

                    // Log the user ID being fetched
                    error_log("Leave Graph: Fetching data for User ID: " . $user_id_to_fetch);

                    // Use a more robust query and date handling
                    $sql = "SELECT from_date, to_date FROM leave_applications WHERE user_id = $user_id_to_fetch AND status = 'approved' ORDER BY from_date ASC";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $leave_dates = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $leave_dates[] = $row;
                        }
                        mysqli_free_result($result);
                    } else {
                        error_log("Leave Graph: Query failed: " . mysqli_error($conn));
                        $response['message'] = "Database error executing query.";
                    }

                    $stmt->close();
                    $response['success'] = true;
                    $response['leave_dates'] = $leave_dates;
                    
                    // Log the response data (will contain the leave dates array)
                    error_log("Leave Graph: Response Data: " . print_r($response, true));

                    break;

                case 'get_user_profile':
                    if ($_SESSION['isadmin'] != 0) {
                        $response['message'] = 'Unauthorized access';
                        break;
                    }
                    $user_id = (int)$_POST['user_id'];
                    // Fetch user profile data - updated to include more fields
                    $sql = "SELECT id, staff_fullname, staff_dob, staff_gender, staff_contactno, staff_email, staff_address FROM multi_login WHERE id = $user_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result && $profile_data = mysqli_fetch_assoc($result)) {
                        $response['success'] = true;
                        $response['profile'] = $profile_data;
                    } else {
                        $response['message'] = 'User not found or error fetching profile.';
                    }

                    if ($result) {
                        mysqli_free_result($result);
                    }
                    break;

                case 'get_user_leave_data':
                    if ($_SESSION['isadmin'] != 0) {
                        $response['message'] = 'Unauthorized access';
                        break;
                    }
                    $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;

                    if ($user_id <= 0) {
                        $response['message'] = 'Invalid user ID.';
                        break;
                    }

                    $sql = "SELECT
                                id AS leave_id,
                                from_date,
                                to_date,
                                total_days,
                                reason,
                                status,
                                document_path,
                                admin_remarks,
                                created_at
                            FROM leave_applications
                            WHERE user_id = $user_id
                            ORDER BY created_at DESC";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $leave_data = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $leave_data[] = $row;
                        }
                        mysqli_free_result($result);
                        $response['success'] = true;
                        $response['leave_data'] = $leave_data;
                    } else {
                        $response['message'] = 'Error fetching leave data.';
                        error_log("Error fetching user leave data: " . mysqli_error($conn));
                    }
                    break;
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            // Log exceptions
            error_log("Leave Graph: Exception: " . $e->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// Fetch calendar events
$events = [];
try {
    $sql = "SELECT * FROM calendar_events ORDER BY event_date";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $date = $row['event_date'];
            if (!isset($events[$date])) {
                $events[$date] = [];
            }
            $events[$date][] = [
                'id' => $row['id'],
                'title' => $row['event_title'],
                'riders' => explode(',', $row['event_riders'])
            ];
        }
        mysqli_free_result($result);
    } else {
        throw new Exception("Error fetching calendar events: " . mysqli_error($conn));
    }
} catch (Exception $e) {
    error_log("Error fetching calendar events: " . $e->getMessage());
}

// Fetch today's daily notes




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Unified Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Orbitron:wght@700&display=swap" rel="stylesheet">
  <style>
    /* Basic Reset and Typography */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif; /* Use Inter as in the image */
        background-color: #f4f6f9; /* Light gray background like the image */
        color: #333;
        line-height: 1.6;
    }

    /* Header Styling (mimicking the image's header appearance) */
    .main-header-bar {
        background-color: #222d32; /* Dark background */
        color: #fff;
        padding: 0.75rem 1.5rem; /* Adjusted padding */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-content {
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-logo {
        font-size: 1.5rem; /* Font size like the image */
        font-weight: 600;
        color: #fff;
        text-decoration: none;
    }

    .header-nav {
        display: flex;
        gap: 1rem; /* Space between nav items */
    }

    .header-btn {
        padding: 0.5rem 1rem;
        border-radius: 4px; /* Slightly rounded corners */
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s ease;
        background-color: transparent; /* Transparent background */
        border: 1px solid rgba(255, 255, 255, 0.2); /* Subtle border */
    }

    .header-btn:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Subtle hover effect */
    }

    .header-btn.logout {
        background-color: #dc3545; /* Danger color for logout */
        border-color: #dc3545;
    }

    .header-btn.logout:hover {
        background-color: #c82333;
    }

    /* Dashboard Main Content Layout (Adjusted for non-sidebar layout) */
    .dashboard-main {
        max-width: 1200px; /* Adjusted max-width */
        margin: 1.5rem auto; /* Center content with margin */
        padding: 0 1rem; /* Padding on sides */
        display: flex; /* Use flexbox for main sections */
        flex-wrap: wrap; /* Allow wrapping on smaller screens */
        gap: 1.5rem; /* Space between sections */
    }

    /* Card Styling (Simplified) */
    .card-modern, .calendar-card, .calendar-events-box {
        background-color: #fff;
        border-radius: 4px; /* Slightly rounded corners like the image */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); /* Subtle shadow */
        padding: 1.5rem; /* Padding inside cards */
        flex: 1 1 300px; /* Allow cards to grow/shrink */
    }

    .card-header, .calendar-title, .calendar-events-header {
        font-size: 1.2rem; /* Adjusted font size */
        font-weight: 600;
        color: #333; /* Darker text */
        margin-bottom: 1rem; /* Space below header */
        border-bottom: 1px solid #eee; /* Separator line */
        padding-bottom: 0.75rem;
    }

    /* Clock Widget (Simplified) */
    .clock-widget {
        background-color: #eee; /* Light background */
        padding: 1.5rem;
        border-radius: 4px;
        text-align: center;
        margin-bottom: 1.5rem; /* Space below clock */
    }

    .time {
        font-size: 2rem; /* Adjusted time font size */
        font-weight: 700;
        color: #333; /* Darker color */
    }

    .date {
        font-size: 1rem; /* Adjusted date font size */
        color: #555;
    }

    /* Daily Notes */
    .daily-notes h5 {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 1rem;
    }

    .daily-notes form textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        min-height: 80px; /* Adjusted min-height */
        font-family: inherit;
    }

    .daily-notes form textarea:focus {
        outline: none;
        border-color: #007bff;
    }

    .daily-note-item {
        background-color: #f8f9fa; /* Light background */
        padding: 0.75rem; /* Adjusted padding */
        border-radius: 4px;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #eee; /* subtle border */
    }

    .delete-note-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 0.3rem 0.7rem; /* Adjusted padding */
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    /* Calendar Styling */
    .calendar-card {
        flex: 2 1 500px; /* Calendar takes more space */
    }

    .calendar-header-row {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px; /* Smaller gap */
        background-color: #17a2b8; /* Teal color like image */
        color: #fff;
        padding: 0.5rem 0;
        font-weight: 600;
        text-align: center;
        border-radius: 4px 4px 0 0;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px; /* Very small gap for cell borders */
        border: 1px solid #ccc; /* Outer border */
    }

    .day {
        min-height: 80px; /* Minimum height for day cells */
        padding: 8px;
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Align content to top-left */
        justify-content: flex-start;
        border: 1px solid #eee; /* Cell border */
        background-color: #fff;
        font-size: 0.9rem;
        position: relative; /* For positioning day number */
        cursor: pointer; /* Indicate clickable */
        transition: all 0.2s ease; /* Added transition for hover effect */
    }

    .day:hover:not(.empty) { /* Apply hover effect only to non-empty days */
        background-color: #f0f0f0; /* Subtle background change on hover */
        border-color: #ccc; /* Subtle border change on hover */
        transform: translateY(-2px); /* Slight lift effect */
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Subtle shadow on hover */
    }

    .day strong {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 1rem;
        font-weight: 600;
        color: #555; /* Day number color */
    }

     .day.today {
        background-color: #e9ecef; /* Light gray for today */
        border-color: #007bff; /* Highlight today's border */
    }

    .day.note-day {
        background-color: #d4edda; /* Light green for note day */
        border-color: #28a745;
    }

    .day.leave-day {
        background-color: #f8d7da; /* Light red for leave day */
        border-color: #dc3545;
    }

    .event {
        font-size: 0.8rem; /* Smaller event text */
        padding: 2px 4px;
        border-radius: 3px;
        margin-top: 4px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .event.business-lunch {
        background-color: #f8d7da; /* Example color from image */
        color: #721c24;
    }

    .event.meeting {
        background-color: #cce5ff; /* Example color from image */
        color: #004085;
    }

     .event.conference {
        background-color: #d4edda; /* Example color from image */
        color: #155724;
    }

    /* Event and Leave List Styling */
    .calendar-events-list {
        padding: 0;
    }

    .date-group {
        margin-bottom: 1rem;
        border: 1px solid #eee;
        border-radius: 4px;
        overflow: hidden;
    }

    .date-header {
        background-color: #f8f9fa; /* Light header background */
        padding: 0.75rem 1rem;
        font-weight: 600;
        border-bottom: 1px solid #eee;
    }

    .event-item, .leave-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #eee;
    }

    .event-item:last-child, .leave-item:last-child {
        border-bottom: none;
    }

    .event-date, .leave-item .event-date {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 0.25rem;
    }

    .event-title, .leave-item .event-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .event-riders, .leave-item .event-riders {
        font-size: 0.9rem;
        color: #777;
    }

    .event-actions, .leave-item .event-actions {
        margin-top: 0.75rem;
    }

    .event-actions button, .leave-item .event-actions button {
        padding: 0.3rem 0.7rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .edit-event-btn {
        background-color: #ffc107; /* Warning color */
        color: #212529;
        padding: 0.3rem 0.7rem; /* Ensure consistent padding */
        border-radius: 4px; /* Ensure consistent border-radius */
        border: none; /* Ensure no border */
    }

    .delete-event-btn, .delete-leave-btn {
        background-color: #dc3545; /* Danger color */
        color: #fff;
        padding: 0.3rem 0.7rem; /* Ensure consistent padding */
        border-radius: 4px; /* Ensure consistent border-radius */
        border: none; /* Ensure no border */
    }

    /* Add specific styles for Approve and Reject leave buttons */
    .approve-leave-btn {
        background-color: #28a745; /* Green color for Approve */
        color: white;
        border: none; /* Remove border */
        padding: 0.3rem 0.7rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .reject-leave-btn {
        background-color: #dc3545; /* Red color for Reject (same as delete for consistency) */
        color: white;
        border: none; /* Remove border */
        padding: 0.3rem 0.7rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    /* Add specific style for the View Profile button */
    .view-profile-styled-btn {
        background-color: #007bff; /* Blue color for View Profile */
        color: white;
        border: none; /* Remove border */
        padding: 0.3rem 0.7rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        margin-right: 5px; /* Add margin for spacing */
    }

    /* Modal Styling (Simplified) */
    .modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        display: none; /* Hidden by default */
        justify-content: center;
        align-items: center;
        z-index: 1000;
        overflow-y: auto; /* Add scrolling for full screen content */
    }

    .modal-content {
        padding: 2rem; /* Increased padding for full screen */
        border-radius: 4px; /* Keep subtle border radius */
        width: 95%; /* Make content wider */
        max-width: 800px; /* Increase max-width or remove for true full screen */
        /* You can remove max-width entirely for 100% width */
        /* max-width: none; */
        
        height: auto; /* Allow height to adjust based on content */
        max-height: 95vh; /* Limit max height to viewport height */
        
        display: flex;
        flex-direction: column;
        gap: 1.5rem; /* Increased spacing */
        background-color: #fff; /* White background for modal content */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        animation: modalIn 0.3s ease-out;
    }

    .modal-content h3 {
        margin-top: 0;
        margin-bottom: 1rem;
        color: #333; /* Darker heading color */
        font-size: 1.5rem; /* Larger heading font size */
        border-bottom: 1px solid #eee;
        padding-bottom: 0.75rem;
    }

     @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.98) translateY(20px); /* Adjust animation */
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-content #selected-date {
        font-size: 1rem;
        color: #555;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 0; /* Removed margin-bottom here as gap is on parent */
    }

    .modal-content label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1rem; /* Adjusted font size for labels */
        font-weight: 500; /* Adjusted font weight for labels */
        color: #333; /* Darker color for labels */
    }

    .modal-content input[type="text"],
    .modal-content textarea,
    .modal-content input[type="date"],
    .modal-content input[type="number"],
    .modal-content input[type="file"] {
        padding: 0.8rem; /* Increased padding */
        border: 1px solid #ccc; /* Subtle border */
        border-radius: 4px; /* Slightly rounded corners */
        width: 100%; /* Ensure inputs take full width */
        font-size: 1rem; /* Font size for input text */
        transition: border-color 0.2s ease; /* Smooth transition for focus */
    }

     .modal-content input[type="text"]:focus,
    .modal-content textarea:focus,
    .modal-content input[type="date"]:focus,
    .modal-content input[type="number"]:focus,
    .modal-content input[type="file"]:focus {
        outline: none;
        border-color: #007bff; /* Highlight border on focus */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Add a subtle glow on focus */
    }

    .form-actions {
        display: flex;
        justify-content: flex-end; /* Align buttons to the right */
        gap: 0.5rem; /* Space between buttons */
        margin-top: 2rem; /* Increased space above buttons */
    }

     .form-actions button {
        padding: 0.6rem 1.2rem; /* Adjusted button padding */
        border: 1px solid #ccc; /* Subtle border for buttons */
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500; /* Adjusted font weight */
        transition: background-color 0.2s ease, border-color 0.2s ease;
        width: auto; /* Allow buttons to size based on content */
        margin-top: 0; /* Remove margin-top here as gap is on parent */
        background-color: #e9ecef; /* Light gray background for buttons */
        color: #333; /* Dark text for buttons */
    }

     .form-actions button:hover {
        background-color: #dee2e6; /* Darker gray on hover */
        border-color: #c6cfd6;
    }

    #saveEventBtn {
        background-color: #007bff; /* Blue background for Save button */
        color: white; /* White text for Save button */
        border-color: #007bff;
    }

     #saveEventBtn:hover {
        background-color: #0056b3; /* Darker blue on hover */
        border-color: #004085;
    }

    #cancelEditBtn {
        background-color: #6c757d; /* Secondary color for Cancel button */
        color: white;
        border-color: #6c757d;
    }

    #cancelEditBtn:hover {
        background-color: #545b62;
        border-color: #4c5056;
    }

    /* Styles for leave application form within modal */
    #leaveForm .form-actions {
        justify-content: space-between; /* Distribute buttons for leave form */
        gap: 1rem; /* Space between buttons */
    }

    #leaveForm .form-actions button {
        width: 100%; /* Make leave form buttons full width */
    }

    #submitLeaveBtn {
        background-color: #28a745; /* Green background for Submit button */
        color: white;
         border-color: #28a745;
    }

    #submitLeaveBtn:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    #cancelLeaveBtn {
        background-color: #dc3545; /* Red background for Cancel button */
        color: white;
        border-color: #dc3545;
    }

    #cancelLeaveBtn:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Specific styles for the Add Event form */
    /* Adjust container for event form if needed, but modal-content should handle main layout */

    #modal-title {
        font-size: 1.5rem; /* Match image title size */
        font-weight: bold; /* Match image title weight */
        margin-bottom: 0.5rem; /* Space below title */
        color: #333; /* Darker color */
        border-bottom: none; /* No border below title in image */
        padding-bottom: 0; /* No padding below title in image */
    }

    /* Separator line after title in image */
    .modal-content > hr {
        margin-top: 0.5rem;
        margin-bottom: 1rem; /* Space below separator */
        border: none;
        border-top: 1px solid #eee; /* Light gray line */
    }

    #selected-date {
        font-size: 1rem; /* Match image date font size */
        color: #555; /* Match image date color */
        margin-bottom: 1.5rem; /* Space below date */
        padding-bottom: 0; /* No padding below date in image */
        border-bottom: none; /* No border below date in image */
    }

    .modal-content label {
        display: block;
        margin-bottom: 0.4rem; /* Space between label and input */
        font-size: 1rem; /* Match image label font size */
        font-weight: 500; /* Match image label weight */
        color: #333; /* Match image label color */
    }

    .modal-content input[type="text"],
    .modal-content textarea {
        padding: 0.6rem; /* Match image input padding */
        border: 1px solid #ccc; /* Match image input border */
        border-radius: 4px; /* Match image input border-radius */
        width: 100%; /* Ensure inputs take full width */
        font-size: 1rem; /* Match image input font size */
        transition: border-color 0.2s ease, box-shadow 0.2s ease; /* Smooth transition */
        margin-bottom: 1.5rem; /* Space below input/textarea */
    }

    .modal-content input[type="text"]:focus,
    .modal-content textarea:focus {
        outline: none;
        border-color: #007bff; /* Highlight border on focus */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Subtle glow on focus */
    }

    /* Style for the Save button */
    #saveEventBtn {
        padding: 0.75rem; /* Match image button padding */
        border: none; /* No border in image */
        border-radius: 4px; /* Match image button border-radius */
        background-color: #007bff; /* Solid blue background */
        color: white; /* White text */
        font-size: 1.1rem; /* Slightly larger font size */
        font-weight: 500; /* Match image button weight */
        width: 100%; /* Full width button */
        cursor: pointer;
        transition: background-color 0.2s ease, box-shadow 0.2s ease; /* Smooth transition */
         margin-top: 0.5rem; /* Space above button */
    }

    #saveEventBtn:hover {
        background-color: #0056b3; /* Darker blue on hover */
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.4); /* Subtle shadow on hover */
    }

    /* Hide the cancel button in the event form as it's not in the image */
    /* Show it for editing */
    #cancelEditBtn {
        /* default state - can be overridden by JS based on mode */
        display: none; /* Hidden by default based on Add form image */
        /* Styles for the Cancel button when visible */
        padding: 0.6rem 1.2rem; /* Consistent padding */
        border: 1px solid #ccc; /* Subtle border */
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        background-color: #6c757d; /* Secondary color for Cancel button */
        color: white;
        border-color: #6c757d;
    }

    #cancelEditBtn:hover {
        background-color: #545b62;
        border-color: #4c5056;
        box-shadow: 0 1px 6px rgba(108, 117, 125, 0.3); /* Subtle shadow on hover */
    }

    /* Adjust form actions to center/handle only the save button */
    /* The general .form-actions might need adjustment if it had other rules affecting layout */
    /* Re-evaluate .form-actions if the single button isn't centered or full-width correctly */
    /* Based on the image, the Save button is full width and not part of a flex row with other buttons */
    /* So, remove justify-content and gap from .form-actions if necessary for the event form */
    /* However, keeping the gap for the leave form is important. */
    /* Let's create a specific rule for the event form's form actions */

    #modal .form-actions {
        display: flex; /* Use flex to handle Save and Cancel buttons */
        justify-content: flex-end; /* Align buttons to the right */
        gap: 0.5rem; /* Space between buttons */
        margin-top: 1.5rem; /* Consistent space above buttons */
         text-align: right; /* Align content to the right */
    }

    #modal .form-actions button {
        width: auto; /* Allow buttons to size based on content */
        margin-right: 0; /* Ensure no extra margin */
    }

    /* Ensure leave form actions retain their styles */
    #leaveForm .form-actions {
        display: flex; /* Keep flex for leave form buttons */
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1.5rem; /* Consistent space */
        text-align: left; /* Reset text-align */
    }

     #leaveForm .form-actions button {
        width: 100%; /* Keep leave form buttons full width */
         margin-top: 0; /* Reset margin-top */
     }

    /* Leave Status Styling */
    .status {
        padding: 0.25rem 0.6rem; /* Smaller padding */
        border-radius: 4px;
        font-size: 0.8rem; /* Smaller font size */
        font-weight: 600;
    }

    .status.pending {
        background-color: #ffc107;
        color: #212529;
    }

    .status.approved {
        background-color: #28a745;
        color: white;
    }

    .status.rejected {
        background-color: #dc3545;
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main-header-bar {
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .header-nav {
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
        }

        .dashboard-main {
            flex-direction: column;
            gap: 1rem;
        }

        .card-modern, .calendar-card, .calendar-events-box {
            padding: 1rem;
        }

        .card-header, .calendar-title, .calendar-events-header {
             font-size: 1.1rem;
             margin-bottom: 0.75rem;
             padding-bottom: 0.5rem;
        }

        .calendar-header-row, .calendar {
            gap: 3px;
        }

        .day {
            min-height: 60px;
            padding: 4px;
            font-size: 0.8rem;
        }

         .day strong {
            font-size: 0.9rem;
        }

        .event {
            font-size: 0.7rem;
        }

        .event-item, .leave-item {
            padding: 0.5rem 0.75rem;
        }

        .modal-content {
            padding: 1rem;
        }
    }

    /* Add styles for the new leave tables */
    .leave-table {
        width: 100%;
        border-collapse: collapse; /* Collapse borders for a cleaner look */
        margin-top: 1rem; /* Space above the table */
        font-size: 0.9rem;
    }

    .leave-table th,
    .leave-table td {
        border: 1px solid #eee; /* Cell borders */
        padding: 0.75rem; /* Padding within cells */
        text-align: left; /* Align text to the left */
    }

    .leave-table th {
        background-color: #f8f9fa; /* Light background for headers */
        font-weight: 600;
        color: #333;
    }

    .leave-table tbody tr:nth-child(even) {
        background-color: #f8f9fa; /* Zebra striping for rows */
    }

    .leave-table tbody tr:hover {
        background-color: #e9ecef; /* Highlight row on hover */
    }

    .leave-table td .status {
        /* Reuse existing status styles */
        display: inline-block;
        padding: 0.25rem 0.6rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .leave-table td .event-actions button {
        /* Style buttons within table cells */
        padding: 0.3rem 0.7rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        margin-right: 5px;
    }

     @media (max-width: 600px) {
        .leave-table th,
        .leave-table td {
            padding: 0.5rem;
            font-size: 0.8rem;
        }

         .leave-table td .event-actions button {
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            margin-right: 3px;
        }

         .leave-table thead {
             display: none; /* Hide header on small screens */
         }

         .leave-table, .leave-table tbody, .leave-table tr, .leave-table td {
             display: block; /* Make table elements block for stacking */
             width: 100%;
         }

         .leave-table tr {
             margin-bottom: 1rem;
             border: 1px solid #eee;
             border-radius: 4px;
             overflow: hidden;
         }

         .leave-table td {
             border: none;
             border-bottom: 1px solid #eee;
             position: relative;
             padding-left: 50%; /* Space for the pseudo-element label */
             text-align: right; /* Align content to the right */
         }

         .leave-table td::before {
             content: attr(data-label);
             position: absolute;
             left: 0;
             width: 45%; /* Width of the label */
             padding-left: 10px;
             font-weight: 600;
             color: #333;
             text-align: left; /* Align label to the left */
         }

         .leave-table td:last-child {
             border-bottom: none;
         }

          .leave-table td .status {
            margin-top: 0; /* Remove top margin in stacked layout */
          }
     }

    /* Add these styles to your existing CSS */
    .leave-balance-summary {
        margin-left: auto;
        padding: 10px;
    }

    .leave-balance-box {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .balance-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 0;
    }

    .balance-label {
        font-weight: 600;
        color: #495057;
    }

    .balance-value {
        font-weight: 700;
        color: #2c3e50;
    }

    .calendar-events-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Add styles for leave tracking */
    .low-leave {
        color: #dc3545;
        font-weight: 600;
    }

    .leave-table td[data-label="Available Leave"] {
        font-weight: 500;
    }

    .leave-table td[data-label="Available Leave"] .low-leave {
        background-color: #fff3f3;
        padding: 2px 8px;
        border-radius: 4px;
    }

</style>
</head>
<body>

<!-- Modern Dashboard Header Bar -->
<header class="main-header-bar">
  <div class="header-left">
    <span class="header-logo">📊 My Dashboard</span>
    </div>
  <nav class="header-nav">
    <?php if($_SESSION['isadmin']==0){ ?>
    <a href="dashboard.php" class="header-btn">Dashboard</a>
    <a href="master_forms.php" class="header-btn">Master Forms</a>
    <a href="profile.php" class="header-btn">Profile</a>
    <a href="logout.php" class="header-btn logout">Logout</a>
    <?php } elseif($_SESSION['isadmin']==4){ ?>
    <a href="dashboard.php" class="header-btn">Dashboard</a>
	<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 2";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="arrival_jobs_list_from_tm_to_eng.php" title="Job List" style="position: relative;">
    Arrival Job
        <?php
$notif_query = "SELECT tested_by FROM job WHERE live_status = 2";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["tested_by"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>

<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 4";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="reward_job_for_engineer.php" title="Job List" style="position: relative;">
    Reward Jobs
        <?php
$notif_query = "SELECT tested_by FROM job WHERE live_status = 4";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["tested_by"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>



    <a href="job_listing_for_engineer.php" class="header-btn logout">Job List</a>
	
	<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 6";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="list_of_completed_jobs_work_for_engineer_to_view.php" title="Job List" style="position: relative;">
    Completed Job List
        <?php
$notif_query = "SELECT tested_by FROM job WHERE live_status = 6";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["tested_by"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>


    <a href="task_asigner.php" class="header-btn logout">Tasks</a>
    <a href="logout.php" class="header-btn logout">Logout</a>
    <?php } elseif($_SESSION['isadmin']==5){?>
    <a href="dashboard.php" class="header-btn">Dashboard</a>
	<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 1";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="arrival_jobs_list_from_rec_to_tm.php" title="Job List" style="position: relative;">
    Arrival Job
        <?php
$notif_query = "SELECT reported_by FROM job WHERE live_status = 1";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["reported_by"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>

<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 3";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="list_of_job_report_for_qm.php" title="Job List" style="position: relative;">
    Job For Verification
        <?php
$notif_query = "SELECT reported_by_review FROM job WHERE live_status = 3";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["reported_by_review"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>

<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 5";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="list_of_job_report_for_auth.php" title="Job List" style="position: relative;">
    Job For Authorization
        <?php
$notif_query = "SELECT reported_by_authorize FROM job WHERE live_status = 5";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["reported_by_authorize"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>

<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status = 6";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="list_of_completed_job_report_for_qm.php" title="Job List" style="position: relative;">
    Completed Job List
        <?php
$notif_query = "SELECT reported_by_authorize FROM job WHERE live_status = 6";
$result = mysqli_query($conn, $notif_query);

$new_jobs = 0;
$user_id = $_SESSION['u_id'];
$should_notify = false;

while ($row = mysqli_fetch_assoc($result)) {
    $explode_tested_by = explode(",", $row["reported_by_authorize"]);
    
    if (in_array($user_id, $explode_tested_by)) {
        $new_jobs++;
        $should_notify = true;
    }
}

if ($should_notify): ?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>


    <a href="sel_report_by_search.php" class="header-btn logout">Report List</a>
    <a href="task_asigner.php" class="header-btn logout">Tasks</a>
    <a href="logout.php" class="header-btn logout">Logout</a>
    <?php } elseif($_SESSION['isadmin']==2){?>
      <a href="dashboard.php" class="header-btn">Dashboard</a>
    <a href="client_form.php" class="header-btn">Inward</a>
    <a href="job_listing_for_second_reception.php" class="header-btn logout">Material Selection</a>
	<?php
		// Fetch number of new jobs (status = 1 means sent from reception to QM)
		$notif_query = "SELECT COUNT(*) as new_jobs FROM job WHERE live_status IN (6,7) AND print_done_by_biller_for_qm_see!=1";
		$result = mysqli_query($conn, $notif_query);
		$row = mysqli_fetch_assoc($result);
		$new_jobs = $row['new_jobs'];
		?>

		<a class="header-btn" href="list_of_completed_job_report_for_reception.php" title="Job List" style="position: relative;">
    Completed Job List
        <?php
//  $notif_query = "SELECT tested_by FROM job WHERE live_status = 6";
//  $result = mysqli_query($conn, $notif_query);

// $new_jobs = 0;
// $user_id = $_SESSION['u_id'];
// $should_notify = false;

// while ($row = mysqli_fetch_assoc($result)) {
//     $explode_tested_by = explode(",", $row["tested_by"]);
    
//     if (in_array($user_id, $explode_tested_by)) {
//         $new_jobs++;
//         $should_notify = true;
//     }
// }

if ($new_jobs>0) :?>
    <span style="
        position: absolute;
        top: -8px;
        right: -12px;
        min-width: 20px;
        height: 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        padding: 0 6px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 20px;
        box-shadow: 0 0 0 2px white;
    ">   
        <?php echo $new_jobs; ?>
    </span>
<?php endif; ?>
</a>

    <a href="un_dispatched_reports_for_rec.php" class="header-btn logout">Undispatch List</a>
    <a href="list_of_dispatched_report_for_reception.php" class="header-btn logout">Dispatch List</a>
    <a href="view_job_invert_register_for_rec.php" class="header-btn logout">Inward Register</a>
	<a href="ulr_listing.php" class="header-btn logout">Ulr List</a>
    <a href="logout.php" class="header-btn logout">Logout</a>
    <?php }?>
  </nav>
</header>

<div class="dashboard-main">
  <div class="card-modern notes">
    <div class="card-header"><span>📝</span> Daily Notes</div>
    <div class="clock-widget">
      <div id="current-time" class="time" aria-live="polite"></div>
      <div id="current-date" class="date" aria-live="polite"></div>
      <div class="analog-clock-wrapper">
        <canvas id="analog-clock" width="180" height="180" aria-label="Analog clock displaying current time"></canvas>
      </div>
    </div>
    <div class="daily-notes">
      <h5>Notes for <span id="today-date"><?php echo $today; ?></span></h5>
      
      <form id="dailyNoteForm">
        <label for="daily_note_text" class="sr-only">Daily Note</label>
        <?php if($_SESSION['isadmin']==0){ ?>
        <textarea name="daily_note" id="daily_note_text" rows="3" required placeholder="Write your daily note..." aria-required="true"></textarea>
        <button type="submit" class="btn" style="background-color: #28a745; color: white; width: 100%; margin-top: 8px; font-size:1.1em; font-weight:600;">Save Daily Note</button>
        <?php } ?>
      </form>

        <hr>
      <div id="dailyNotesList" aria-live="polite">
        <?php foreach ($todayNotes as $note): ?>
          <div class="daily-note-item">
          <span>• <?php echo htmlspecialchars($note['note_text']); ?></span>
          <?php if($_SESSION['isadmin']==0){ ?>
          <button class="delete-note-btn" data-id="<?php echo $note['id']; ?>" aria-label="Delete note">Delete</button>
          <?php } ?>    
          </div>
        <?php endforeach; ?>
    </div>
  </div>
  </div>
  <div class="calendar-card">
    <div class="calendar-title"><span>📅</span> Calendar</div>
    <div class="calendar-header-row">
        <div class="calendar-header-cell">Sun</div>
        <div class="calendar-header-cell">Mon</div>
        <div class="calendar-header-cell">Tue</div>
        <div class="calendar-header-cell">Wed</div>
        <div class="calendar-header-cell">Thu</div>
        <div class="calendar-header-cell">Fri</div>
        <div class="calendar-header-cell">Sat</div>
    </div>
    <div class="calendar" id="calendar"></div>
    
    <!-- Modal for both events and leave applications -->
    <div class="modal" id="modal" style="display: none;">
        <div class="modal-content">
            <?php if($_SESSION['isadmin'] == 0): ?>
            <!-- Event Form -->
            <h3 id="modal-title">Add Event</h3>
            <p id="selected-date"></p>
            <label for="event-title">Event Title:</label>
            <input type="text" id="event-title" placeholder="Event Title"/>
            <label for="event-riders">Riders (comma-separated):</label>
            <textarea id="event-riders" placeholder="Riders (comma-separated)"></textarea>
            <button id="saveEventBtn" onclick="saveEvent()">Save</button>
            <button id="cancelEditBtn" style="display:none;margin-top:8px;background:#aaa;" onclick="cancelEdit()">Cancel</button>
            <?php else: ?>
            <!-- Leave Application Form -->
            <h3 id="modal-title">Apply for Leave</h3>
            <form id="leaveForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="from-date">From Date:</label>
                    <input type="date" id="from-date" name="from_date" required onchange="calculateDays()"/>
                </div>
                <div class="form-group">
                    <label for="to-date">To Date:</label>
                    <input type="date" id="to-date" name="to_date" required onchange="calculateDays()"/>
                </div>
                <div class="form-group">
                    <label for="total-days">Total Days:</label>
                    <input type="number" id="total-days" name="total_days" readonly/>
                </div>
                <div class="form-group">
                    <label for="leave-reason">Reason for Leave:</label>
                    <textarea id="leave-reason" name="reason" required placeholder="Please provide a detailed reason for your leave"></textarea>
                </div>
                <div class="form-group">
                    <label for="leave-document">Supporting Document:</label>
                    <input type="file" id="leave-document" name="document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"/>
                </div>
                <div class="form-actions">
                    <button type="submit" id="submitLeaveBtn">Submit Application</button>
                    <button type="button" id="cancelLeaveBtn" onclick="closeModal()">Cancel</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add this after the calendar-card div -->
<div class="calendar-events-box">
    <div class="calendar-events-header">
        <span>📅</span> Calendar Notes
  </div>
    <div class="calendar-events-list" id="calendarEventsList">
        <?php
        // Fetch all events ordered by date and time
        $sql = "SELECT * FROM calendar_events ORDER BY event_date DESC, created_at DESC";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $currentDate = null;
            while ($row = mysqli_fetch_assoc($result)) {
                $date = new DateTime($row['event_date']);
                $time = new DateTime($row['created_at']);
                
                // If this is a new date, add a date header
                if ($currentDate !== $date->format('Y-m-d')) {
                    if ($currentDate !== null) {
                        echo '</div>'; // Close previous date group
                    }
                    $currentDate = $date->format('Y-m-d');
                    ?>
                    <div class="date-group">
                        <div class="date-header"><?php echo $date->format('F j, Y'); ?></div>
                <?php
                }
                ?>
                <div class="event-item">
                    <div class="event-time"><?php echo $time->format('g:i A'); ?></div>
                    <div class="event-title"><?php echo htmlspecialchars($row['event_title']); ?></div>
                    <div class="event-riders">Riders: <?php echo htmlspecialchars($row['event_riders']); ?></div>
                    <?php if($_SESSION['isadmin']==0){ ?>
                    <div class="event-actions">
                     
                        <button class="edit-event-btn" onclick="editEventFromList(<?php echo $row['id']; ?>)">Edit</button>
                        <button class="delete-event-btn" onclick="deleteEventFromList(<?php echo $row['id']; ?>)">Delete</button>
                      
                    </div>
                    <?php } ?>
                </div>
                <?php
            }
            if ($currentDate !== null) {
                echo '</div>'; // Close last date group
            }
        } else {
            echo '<div style="text-align: center; color: #666; padding: 20px;">No events found</div>';
        }
        ?>
    </div>
</div>

<?php if($_SESSION['isadmin'] == 0): ?>
<!-- Admin Leave Management Section -->
<div class="calendar-events-box">
    <div class="calendar-events-header">
        <span>📋</span> Pending Leaves
    </div>
    <div class="calendar-events-list">
        <table class="leave-table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                  
                    <th>Status</th>
                    
                    <th>Actions</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // Fetch all leave applications with proper JOIN
        $sql = "SELECT 
            la.id AS leave_id,
            ml.staff_fullname AS employee_name,
            la.user_id, -- Added user_id to select
            la.from_date,
            la.to_date,
            la.total_days,
            la.reason,
            la.status,
            la.document_path,
            la.admin_remarks,
            la.created_at
        FROM 
            leave_applications la
        JOIN 
            multi_login ml ON la.user_id = ml.id
        WHERE 
            la.status = 'pending'
        ORDER BY 
            la.created_at DESC";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = '';
                switch($row['status']) {
                    case 'pending':
                        $status_class = 'pending';
                        break;
                    case 'approved':
                        $status_class = 'approved';
                        break;
                    case 'rejected':
                        $status_class = 'rejected';
                        break;
                }
                ?>
                <tr>
                    <td data-label="Employee"><?php echo htmlspecialchars($row['employee_name']); ?></td>
                    <td data-label="From Date"><?php echo date('d-m-Y', strtotime($row['from_date'])); ?></td>
                    <td data-label="To Date"><?php echo date('d-m-Y', strtotime($row['to_date'])); ?></td>
                    <td data-label="Days"><?php echo $row['total_days']; ?></td>
                    <td data-label="Reason"><?php echo htmlspecialchars($row['reason']); ?></td>
                    
                    <td data-label="Status"><span class="status <?php echo $status_class; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                   
                    <td data-label="Actions">
                            <!-- Updated button classes -->
                            <button class="approve-leave-btn" onclick="confirmAction('approve', <?php echo $row['leave_id']; ?>)">Approve</button>
                            <button class="reject-leave-btn" onclick="confirmAction('reject', <?php echo $row['leave_id']; ?>)">Reject</button>
                    </td>
                     <td data-label="Profile">
                         <!-- Changed to button to trigger modal -->
                         <!-- Updated button class -->
                         <button class="view-profile-btn view-profile-styled-btn" data-user-id="<?php echo $row['user_id']; ?>">View Profile</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="10" style="text-align: center; color: #666; padding: 20px;">No pending leave applications found</td></tr>';
        }
        ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add a section for all leave applications -->
<div class="calendar-events-box">
    <div class="calendar-events-header">
        <span>📋</span> Historical Leave Applications
    </div>
    <div class="calendar-events-list">
         <table class="leave-table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // Fetch all leave applications with proper JOIN
        $sql = "SELECT 
            la.id AS leave_id,
            ml.staff_fullname AS employee_name,
            la.from_date,
            la.to_date,
            la.total_days,
            la.reason,
            la.status,
            la.document_path,
            la.admin_remarks,
            la.created_at
        FROM 
            leave_applications la
        INNER JOIN 
            multi_login ml ON la.user_id = ml.id
        ORDER BY 
            la.total_days DESC, la.created_at DESC"; // Sort by total_days descending, then created_at descending
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = '';
                switch($row['status']) {
                    case 'pending':
                        $status_class = 'pending';
                        break;
                    case 'approved':
                        $status_class = 'approved';
                        break;
                    case 'rejected':
                        $status_class = 'rejected';
                        break;
                }
                ?>
                <tr>
                    <td data-label="Employee"><?php echo htmlspecialchars($row['employee_name']); ?></td>
                    <td data-label="From Date"><?php echo date('d-m-Y', strtotime($row['from_date'])); ?></td>
                    <td data-label="To Date"><?php echo date('d-m-Y', strtotime($row['to_date'])); ?></td>
                    <td data-label="Days"><?php echo $row['total_days']; ?></td>
                    <td data-label="Reason"><?php echo htmlspecialchars($row['reason']); ?></td>
                     <td data-label="Document">
                        <?php if(!empty($row['document_path'])): ?>
                            <a href="<?php echo htmlspecialchars($row['document_path']); ?>" target="_blank">View</a>
                        <?php endif; ?>
                    </td>
                    <td data-label="Status"><span class="status <?php echo $status_class; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                    <td data-label="Remarks"><?php echo htmlspecialchars($row['admin_remarks']); ?></td>
                    <td data-label="Actions">
                         <button class="delete-leave-btn" onclick="confirmAction('delete', <?php echo $row['leave_id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="8" style="text-align: center; color: #666; padding: 20px;">No leave applications found</td></tr>';
        }
        ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Profile Modal Structure -->
<div class="modal" id="profileModal" style="display: none;">
    <div class="modal-content">
        <h3 id="profileModalTitle">User Profile</h3>
        <div id="profileDetails">
            <!-- Profile details will be loaded here -->
        </div>
        <div class="form-actions">
            <button type="button" onclick="closeProfileModal()">Close</button>
        </div>
    </div>
</div>

<!-- Add this after the calendar-events-box div containing "All Leave Applications" for admin section -->
<!-- Leave Graph Modal Structure -->

<!-- Admin Leave Tracking Section -->
<div class="calendar-events-box">
    <div class="calendar-events-header">
        <span>📊</span> Employee Leave Tracking
    </div>
    <div class="calendar-events-list">
        <table class="leave-table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Total Annual Leave</th>
                    <th>Approved Leave</th>
                    <th>Available Leave</th>
                    <th>Pending Leaves</th>
                    <th>Rejected Leaves</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Fetch all users and their leave counts
            $sql = "SELECT 
                ml.id,
                ml.staff_fullname,
                COUNT(la.id) as total_leaves,
                SUM(CASE WHEN la.status = 'approved' AND YEAR(la.from_date) = YEAR(CURDATE()) THEN la.total_days ELSE 0 END) as approved_days,
                SUM(CASE WHEN la.status = 'pending' AND YEAR(la.from_date) = YEAR(CURDATE()) THEN la.total_days ELSE 0 END) as pending_days,
                SUM(CASE WHEN la.status = 'rejected' AND YEAR(la.from_date) = YEAR(CURDATE()) THEN la.total_days ELSE 0 END) as rejected_days
            FROM 
                multi_login ml
            LEFT JOIN 
                leave_applications la ON ml.id = la.user_id
            WHERE 
                ml.staff_isdeleted = '0'
            GROUP BY 
                ml.id, ml.staff_fullname
            ORDER BY 
                approved_days DESC, ml.staff_fullname ASC"; // Sort by approved_days descending, then fullname ascending

            $result = mysqli_query($conn, $sql);
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $total_annual_leave = 24; // Total annual leave days
                    $approved_days = $row['approved_days'] ?? 0;
                    $pending_days = $row['pending_days'] ?? 0;
                    $rejected_days = $row['rejected_days'] ?? 0;
                    $available_leave = $total_annual_leave - $approved_days;
                    ?>
                    <tr>
                        <td data-label="Employee Name"><?php echo htmlspecialchars($row['staff_fullname']); ?></td>
                        <td data-label="Total Annual Leave"><?php echo $total_annual_leave; ?> days</td>
                        <td data-label="Approved Leave"><?php echo $approved_days; ?> days</td>
                        <td data-label="Available Leave">
                            <span class="<?php echo $available_leave < 5 ? 'low-leave' : ''; ?>">
                                <?php echo $available_leave; ?> days
                            </span>
                        </td>
                        <td data-label="Pending Leaves"><?php echo $pending_days; ?> days</td>
                        <td data-label="Rejected Leaves"><?php echo $rejected_days; ?> days</td>
                        <td data-label="Action">
                            <button class="view-profile-btn view-profile-styled-btn" data-user-id="<?php echo $row['id']; ?>">Profile</button>
                            <button class="view-leave-data-btn view-profile-styled-btn" data-user-id="<?php echo $row['id']; ?>" data-user-name="<?php echo htmlspecialchars($row['staff_fullname']); ?>">Leave Data</button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5" style="text-align: center; color: #666; padding: 20px;">No employee records found</td></tr>';
            }
            
            if ($result) {
                mysqli_free_result($result);
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<style>
/* Add styles for leave tracking */
.low-leave {
    color: #dc3545;
    font-weight: 600;
}

.leave-table td[data-label="Available Leave"] {
    font-weight: 500;
}

.leave-table td[data-label="Available Leave"] .low-leave {
    background-color: #fff3f3;
    padding: 2px 8px;
    border-radius: 4px;
}
</style>
<?php else: ?>
<!-- User Leave Status Section -->
<div class="calendar-events-box">
    <div class="calendar-events-header">
        <span>📋</span> My Leave Status
        <!-- Add Leave Balance Summary -->
        <div class="leave-balance-summary">
            <?php
            // Calculate total approved leaves
            $user_id = (int)$_SESSION['id'];
            $total_annual_leave = 24; // Total annual leave days
            
            // Get total approved leave days for the current year
            $current_year = date('Y');
            $sql_approved = "SELECT SUM(total_days) as total_approved FROM leave_applications 
                           WHERE user_id = $user_id AND status = 'approved' AND YEAR(from_date) = $current_year";
            $result_approved = mysqli_query($conn, $sql_approved);
            $total_approved = 0;
            
            if ($result_approved && $row = mysqli_fetch_assoc($result_approved)) {
                $total_approved = $row['total_approved'] ?? 0;
            }
            
            // Calculate available leave
            $available_leave = $total_annual_leave - $total_approved;
            ?>
            <div class="leave-balance-box">
                <div class="balance-item">
                    <span class="balance-label">Total Annual Leave:</span>
                    <span class="balance-value"><?php echo $total_annual_leave; ?> days</span>
                </div>
                <div class="balance-item">
                    <span class="balance-label">Approved Leave:</span>
                    <span class="balance-value"><?php echo $total_approved; ?> days</span>
                </div>
                <div class="balance-item">
                    <span class="balance-label">Available Leave:</span>
                    <span class="balance-value"><?php echo $available_leave; ?> days</span>
                </div>
            </div>
        </div>
    </div>
    <div class="calendar-events-list">
        <table class="leave-table">
            <thead>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    
                </tr>
            </thead>
            <tbody>
        <?php
        // Fetch user's leave applications with proper error handling
        $user_id = (int)$_SESSION['id'];
        $sql = "SELECT 
            id AS leave_id,
            from_date,
            to_date,
            total_days,
            reason,
            status,
            document_path,
            admin_remarks,
            created_at
        FROM leave_applications 
        WHERE user_id = $user_id 
        ORDER BY created_at DESC";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = '';
                switch($row['status']) {
                    case 'pending':
                        $status_class = 'pending';
                        break;
                    case 'approved':
                        $status_class = 'approved';
                        break;
                    case 'rejected':
                        $status_class = 'rejected';
                        break;
                }
                ?>
                <tr>
                    <td data-label="From Date"><?php echo date('d-m-Y', strtotime($row['from_date'])); ?></td>
                    <td data-label="To Date"><?php echo date('d-m-Y', strtotime($row['to_date'])); ?></td>
                    <td data-label="Days"><?php echo $row['total_days']; ?></td>
                    <td data-label="Reason"><?php echo htmlspecialchars($row['reason'] ?? ''); ?></td>
                    <td data-label="Document">
                        <?php if(!empty($row['document_path'])): ?>
                            <a href="<?php echo htmlspecialchars($row['document_path'] ?? ''); ?>" target="_blank">View</a>
                        <?php endif; ?>
                    </td>
                    <td data-label="Status"><span class="status <?php echo $status_class; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                    <td data-label="Remarks"><?php echo htmlspecialchars($row['admin_remarks'] ?? ''); ?></td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="8" style="text-align: center; color: #666; padding: 20px;">No leave applications found</td></tr>';
        }
        
        if ($result) {
            mysqli_free_result($result);
        }
        ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<script>
// Pass PHP variables to JavaScript
const events = <?php echo json_encode($events); ?>;
const today = '<?php echo $today; ?>';
const approvedLeaves = <?php echo json_encode($approved_leaves); ?>;
const isAdmin = <?php echo $_SESSION['isadmin'] == 0 ? 'true' : 'false'; ?>;

// Digital Clock
function updateClock() {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('en-GB');
    const dateStr = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('current-time').textContent = timeStr;
    document.getElementById('current-date').textContent = dateStr;
}
setInterval(updateClock, 1000);
updateClock(); // Initial call

// Analog Clock (Modern Glassy Look)
const canvas = document.getElementById("analog-clock");
const ctx = canvas.getContext("2d");
const radius = canvas.height / 2;
ctx.translate(radius, radius);
setInterval(drawAnalogClock, 1000);

function drawAnalogClock() {
    ctx.clearRect(-radius, -radius, canvas.width, canvas.height);
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
    drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
    let grad = ctx.createRadialGradient(0, 0, radius * 0.7, 0, 0, radius);
    grad.addColorStop(0, '#e3f0ff');
    grad.addColorStop(0.5, '#ffffff');
    grad.addColorStop(1, '#b3d1ff');
    ctx.beginPath();
    ctx.arc(0, 0, radius * 0.98, 0, 2 * Math.PI);
    ctx.fillStyle = grad;
    ctx.fill();
    ctx.save();
    ctx.shadowColor = '#007bff88';
    ctx.shadowBlur = 18;
    ctx.beginPath();
    ctx.arc(0, 0, radius * 0.98, 0, 2 * Math.PI);
    ctx.strokeStyle = '#007bff55';
    ctx.lineWidth = radius * 0.07;
    ctx.stroke();
    ctx.restore();
    ctx.save();
    ctx.shadowColor = '#28a745';
    ctx.shadowBlur = 10;
    ctx.beginPath();
    ctx.arc(0, 0, radius * 0.09, 0, 2 * Math.PI);
    ctx.fillStyle = '#28a745';
    ctx.fill();
    ctx.restore();
}

function drawNumbers(ctx, radius) {
    let ang, num;
    ctx.font = radius * 0.18 + "px 'Orbitron', Arial, sans-serif";
    ctx.textBaseline = "middle";
    ctx.textAlign = "center";
    ctx.fillStyle = '#007bff';
    for (num = 1; num < 13; num++) {
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius * 0.78);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius * 0.78);
        ctx.rotate(-ang);
    }
}

function drawTime(ctx, radius) {
    const now = new Date();
    let hour = now.getHours();
    let minute = now.getMinutes();
    let second = now.getSeconds();
    hour %= 12;
    hour = (hour * Math.PI / 6) + (minute * Math.PI / (6 * 60)) + (second * Math.PI / (360 * 60));
    drawHand(ctx, hour, radius * 0.5, radius * 0.09, '#222', 8);
    minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
    drawHand(ctx, minute, radius * 0.75, radius * 0.06, '#007bff', 6);
    second = (second * Math.PI / 30);
    drawHand(ctx, second, radius * 0.85, radius * 0.025, '#dc3545', 2, true);
}

function drawHand(ctx, pos, length, width, color, shadow = false) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.strokeStyle = color;
    if (shadow) {
        ctx.shadowColor = color + "88";
        ctx.shadowBlur = 10;
    } else {
        ctx.shadowBlur = 0;
    }
    ctx.moveTo(0, 0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}

// Daily Notes Form Handler
document.getElementById('dailyNoteForm').onsubmit = async function(e) {
    e.preventDefault();
    const text = document.getElementById('daily_note_text').value.trim();
    if (!text) {
        alert('Please enter a note before saving.');
        return;
    }

    try {
        const formData = new FormData();
        formData.append('action', 'add_daily_note');
        formData.append('note', text);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            location.reload();
        } else {
            alert(result.message || 'Error adding note');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error adding note. Please try again.');
    }
};

// Delete Note Handler
document.querySelectorAll('.delete-note-btn').forEach(btn => {
    btn.onclick = async function() {
        if (!confirm('Are you sure you want to delete this note?')) return;

        try {
            const id = this.getAttribute('data-id');
            const formData = new FormData();
            formData.append('action', 'delete_daily_note');
            formData.append('id', id);

            const response = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                location.reload();
            } else {
                alert(result.message || 'Error deleting note');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error deleting note. Please try again.');
        }
    };
});

// Calendar Event Handlers
let selectedDate = '';
let editingEventIndex = null;

function generateCalendar(year, month) {
    const calendarEl = document.getElementById('calendar');
    calendarEl.innerHTML = '';
    
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDay = firstDay.getDay();
    
    // Get today's date for comparison
    const today = new Date();
    const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;
    
    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDay; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'day empty';
        calendarEl.appendChild(emptyDay);
    }
    
    // Add days of the month
    for (let i = 1; i <= daysInMonth; i++) {
        const currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        const dayEl = document.createElement('div');
        dayEl.className = 'day';
        
        // Check if this is today's date
        if (isCurrentMonth && i === today.getDate()) {
            dayEl.classList.add('today');
        }
        
        // Check if this is an approved leave day
        if (approvedLeaves.includes(currentDate)) {
            dayEl.classList.add('leave-day');
        }
        
        if (events[currentDate]) {
            dayEl.classList.add('note-day');
        }
        
        dayEl.innerHTML = `<strong>${i}</strong>`;
        dayEl.onclick = () => openModal(currentDate);
        
        calendarEl.appendChild(dayEl);
    }
}

function openModal(date) {
    selectedDate = date;
    document.getElementById('modal').style.display = 'flex';
    
    if (isAdmin) {
        // Show event form for admin
        document.getElementById('modal-title').textContent = 'Add Event';
        document.getElementById('selected-date').textContent = `Date: ${date}`;
        document.getElementById('event-title').value = '';
        document.getElementById('event-riders').value = '';
        document.getElementById('saveEventBtn').textContent = 'Save';
        document.getElementById('cancelEditBtn').style.display = 'none';
    } else {
        // Show leave application form for users
        document.getElementById('modal-title').textContent = 'Apply for Leave';
        document.getElementById('from-date').value = date;
        document.getElementById('to-date').value = date;
        document.getElementById('total-days').value = '1';
        document.getElementById('leave-reason').value = '';
        document.getElementById('leave-document').value = '';
    }
}

async function saveEvent() {
    const title = document.getElementById('event-title').value.trim();
    const riders = document.getElementById('event-riders').value.split(',').map(r => r.trim()).filter(r => r);
    
    if (!title) {
        alert("Please enter an event title.");
        return;
    }
    
    // Check if we are editing (editingEventIndex will be set) or adding
    const action = editingEventIndex ? 'edit_event' : 'add_event';

    try {
        const formData = new FormData();
        formData.append('action', action);
        formData.append('date', selectedDate);
        formData.append('title', title);
        formData.append('riders', riders.join(','));
        
        // If editing, include the event ID
        if (editingEventIndex) {
            formData.append('id', editingEventIndex);
        }

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            // Close modal and reload page on success
            closeModal(); // Assuming closeModal exists and works correctly
            location.reload();
        } else {
            alert(result.message || 'Error saving event');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error saving event. Please try again.');
    }
}

async function deleteEventFromList(eventId) {
    if (!confirm('Are you sure you want to delete this event?')) return;
    
    try {
        const formData = new FormData();
        formData.append('action', 'delete_event');
        formData.append('id', eventId);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            location.reload();
        } else {
            alert(result.message || 'Error deleting event');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error deleting event. Please try again.');
    }
}

async function editEventFromList(eventId) {
    try {
        const response = await fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=get_event&id=${eventId}`
        });
        
        const result = await response.json();
        if (result.success) {
            const event = result.event;
            selectedDate = event.event_date;
            // Ensure the modal is shown for editing events
            document.getElementById('modal').style.display = 'flex';
            
            // Ensure the correct form section is visible if needed (currently only admin sees event form)
            // Assuming the event form is the only one visible for admin users when openModal is called
            // If openModal logic needs adjustment for editing vs adding, that should be reviewed.
            
            // Populate form fields
            document.getElementById('event-title').value = event.event_title;
            document.getElementById('event-riders').value = event.event_riders;
            
            // Update modal title and button text
            document.getElementById('modal-title').textContent = 'Edit Event';
            document.getElementById('saveEventBtn').textContent = 'Update';
            
            // Show cancel button for editing
            document.getElementById('cancelEditBtn').style.display = 'inline-block';
            
            // Store the ID of the event being edited
            editingEventIndex = eventId;
            
        } else {
            alert(result.message || 'Error fetching event details');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error fetching event details. Please try again.');
    }
}

// Add cancel edit function
function cancelEdit() {
    // Reset state when canceling edit
    editingEventIndex = null;
    document.getElementById('event-title').value = '';
    document.getElementById('event-riders').value = '';
    document.getElementById('modal-title').textContent = 'Add Event'; // Reset title
    document.getElementById('saveEventBtn').textContent = 'Save'; // Reset button text
    document.getElementById('cancelEditBtn').style.display = 'none'; // Hide cancel button
    // Optionally, clear the selectedDate if it's no longer relevant after cancelling
    selectedDate = '';
    closeModal(); // Close the modal
}

// Close modal on background click
window.onclick = (e) => {
    if (e.target === document.getElementById('modal')) {
        closeModal(); // Use the existing closeModal function
        // No need to call cancelEdit here, closeModal should handle necessary resets or you can add cancelEdit call inside closeModal
        // However, let's keep cancelEdit call here for now to ensure state reset when closing by background click
        cancelEdit();
    }
};

// Initialize calendar
generateCalendar(new Date().getFullYear(), new Date().getMonth());

// Add these functions to your existing JavaScript
function calculateDays() {
    const fromDate = new Date(document.getElementById('from-date').value);
    const toDate = new Date(document.getElementById('to-date').value);
    
    if (fromDate && toDate && fromDate <= toDate) {
        const diffTime = Math.abs(toDate - fromDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        document.getElementById('total-days').value = diffDays;
    } else {
        document.getElementById('total-days').value = '';
    }
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
    if (document.getElementById('leaveForm')) {
        document.getElementById('leaveForm').reset();
    }
}

// Add event listener for leave form submission
if (document.getElementById('leaveForm')) {
    document.getElementById('leaveForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append('action', 'apply_leave');
        formData.append('user_id', '<?php echo $_SESSION['id']; ?>');
        
        try {
            const response = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            if (result.success) {
                alert('Leave application submitted successfully!');
                closeModal();
                location.reload();
            } else {
                alert(result.message || 'Error submitting leave application');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error submitting leave application. Please try again.');
        }
    });
}

// Add this function to handle leave status updates
async function updateLeaveStatus(leaveId, status, remarks = '') {
    try {
        const formData = new FormData();
        formData.append('action', 'update_leave_status');
        formData.append('leave_id', leaveId);
        formData.append('status', status);
        formData.append('remarks', remarks || ''); // Ensure remarks is never null

        console.log('Sending update request:', {
            leaveId,
            status,
            remarks
        });

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        console.log('Update response:', result);

        if (result.success) {
            alert('Leave status updated successfully!');
            location.reload(); // Reload the page to show updated status
        } else {
            alert(result.message || 'Error updating leave status');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error updating leave status. Please try again.');
    }
}

// Add confirmation function
function confirmAction(action, leaveId) {
    let message = '';
    let remarks = '';

    switch(action) {
        case 'approve':
            message = 'Are you sure you want to approve this leave application?';
            remarks = prompt('Please enter remarks for approval (optional):');
            if (remarks === null) { // User clicked Cancel on prompt
                return;
            }
            break;
        case 'reject':
            message = 'Are you sure you want to reject this leave application?';
            remarks = prompt('Please enter rejection reason:');
            if (remarks === null) { // User clicked Cancel on prompt
                return;
            }
            break;
        case 'delete':
            message = 'Are you sure you want to delete this leave application? This action cannot be undone.';
            break;
    }

    if (confirm(message)) {
        if (action === 'delete') {
            deleteLeave(leaveId);
        } else {
            // Ensure status is properly set
            const status = action === 'approve' ? 'approved' : 'rejected';
            updateLeaveStatus(leaveId, status, remarks);
        }
    }
}

// Add new function for delete leave
async function deleteLeave(leaveId) {
    try {
        const formData = new FormData();
        formData.append('action', 'delete_leave');
        formData.append('leave_id', leaveId);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        if (result.success) {
            alert('Leave application deleted successfully!');
            location.reload();
        } else {
            alert(result.message || 'Error deleting leave application');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error deleting leave application. Please try again.');
    }
}

// Add these styles to ensure proper color coding
const style = document.createElement('style');
style.textContent = `
    .day.leave-day {
        background-color: #f8d7da; /* Light red for leave day */
        border-color: #dc3545;
    }
    .status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.9em;
        font-weight: 600;
        margin-top: 8px;
    }
    .status.pending {
        background: #ffc107;
        color: #000;
    }
    .status.approved {
        background: #28a745;
        color: white;
    }
    .status.rejected {
        background: #dc3545;
        color: white;
    }
`;
document.head.appendChild(style);

// New functions for Profile Modal
function openProfileModal(title, content) {
    document.getElementById('profileModalTitle').textContent = title;
    document.getElementById('profileDetails').innerHTML = content;
    document.getElementById('profileModal').style.display = 'flex';
}

function closeProfileModal() {
    document.getElementById('profileModal').style.display = 'none';
    document.getElementById('profileDetails').innerHTML = ''; // Clear content on close
}

// Function to fetch and display user profile
async function fetchAndDisplayProfile(userId) {
    try {
        const formData = new FormData();
        formData.append('action', 'get_user_profile');
        formData.append('user_id', userId);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            // Format profile details for display - updated to include more fields
            let profileContent = '<p><strong>Employee Name:</strong> ' + result.profile.staff_fullname + '</p>';
            profileContent += '<p><strong>Gender:</strong> ' + (result.profile.staff_gender || 'N/A') + '</p>';
            profileContent += '<p><strong>Contact Number:</strong> ' + (result.profile.staff_contactno || 'N/A') + '</p>';
            profileContent += '<p><strong>Email:</strong> ' + (result.profile.staff_email || 'N/A') + '</p>';
            profileContent += '<p><strong>Address:</strong> ' + (result.profile.staff_address || 'N/A') + '</p>';
            // Add other profile fields as needed

            openProfileModal('User Profile', profileContent);
        } else {
            alert(result.message || 'Error fetching profile data.');
        }
    } catch (error) {
        console.error('Error fetching profile data:', error);
        alert('Error fetching profile data. Please try again.');
    }
}

// Add event listeners to the View Profile buttons
document.addEventListener('DOMContentLoaded', function() {
    // ... existing event listeners ...

    const viewProfileButtons = document.querySelectorAll('.view-profile-btn');
    viewProfileButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            fetchAndDisplayProfile(userId);
        });
    });
});

// ... existing functions (calculateDays, closeModal, confirmAction, deleteLeave) ...

// Existing functions for Leave Graph Modal (can be reused)
function openGraphModal(title) { // Modified to take title instead of userName
    document.getElementById('leaveGraphModalTitle').textContent = title;
    document.getElementById('graphUserName').textContent = ''; // Clear user name span
    document.getElementById('leaveGraphModal').style.display = 'flex';
}

function closeGraphModal() {
    document.getElementById('leaveGraphModal').style.display = 'none';
    if (window.leaveHistoryChartInstance) {
        window.leaveHistoryChartInstance.destroy();
    }
}

// Function to fetch and display leave data for the current user
async function fetchAndDisplayUserLeaveGraph() {
    try {
        const formData = new FormData();
        formData.append('action', 'get_user_approved_leaves');
        // Pass the current user's ID from the PHP session variable
        formData.append('user_id', '<?php echo $_SESSION['id']; ?>'); 

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            openGraphModal('My Approved Leave History'); // Set modal title
            renderLeaveHistoryChart(result.leave_dates);
        } else {
            alert(result.message || 'Error fetching leave data.');
        }
    } catch (error) {
        console.error('Error fetching leave data:', error);
        alert('Error fetching leave data. Please try again.');
    }
}

// Reuse the renderLeaveHistoryChart function - no changes needed here
// ... existing renderLeaveHistoryChart function ...

// Add event listener to the Leave Graph button
document.addEventListener('DOMContentLoaded', function() {
    // ... existing event listeners ...

    const showLeaveGraphBtn = document.getElementById('showLeaveGraphBtn');
    if (showLeaveGraphBtn) { // Check if the button exists (only on user side)
        showLeaveGraphBtn.addEventListener('click', function() {
            fetchAndDisplayUserLeaveGraph();
        });
    }
});

// ... existing functions (calculateDays, closeModal, confirmAction, deleteLeave) ...

// New functions for View Leave Data Modal
function openLeaveDataModal(userId, userName) {
    document.getElementById('leaveDataModalTitle').textContent = `Leave Data for ${userName}`;
    // Clear previous data
    document.getElementById('leaveDataTableBody').innerHTML = '';
    document.getElementById('leaveDataModal').style.display = 'flex';
    fetchAndDisplayUserLeaveData(userId);
}

function closeLeaveDataModal() {
    document.getElementById('leaveDataModal').style.display = 'none';
}

async function fetchAndDisplayUserLeaveData(userId) {
    try {
        const formData = new FormData();
        formData.append('action', 'get_user_leave_data');
        formData.append('user_id', userId);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            populateLeaveDataTable(result.leave_data);
        } else {
            alert(result.message || 'Error fetching leave data.');
        }
    } catch (error) {
        console.error('Error fetching leave data:', error);
        alert('Error fetching leave data. Please try again.');
    }
}

function populateLeaveDataTable(leaveData) {
    const tbody = document.getElementById('leaveDataTableBody');
    tbody.innerHTML = ''; // Clear existing rows

    if (leaveData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center;">No leave records found.</td></tr>';
        return;
    }

    leaveData.forEach(leave => {
        const row = `
            <tr>
                <td>${new Date(leave.from_date).toLocaleDateString()}</td>
                <td>${new Date(leave.to_date).toLocaleDateString()}</td>
                <td>${leave.total_days}</td>
                <td>${escapeHTML(leave.reason)}</td>
                <td>${leave.document_path ? '<a href="' + escapeHTML(leave.document_path) + '" target="_blank">View</a>' : ''}</td>
                <td><span class="status ${leave.status}">${escapeHTML(leave.status)}</span></td>
                <td>${escapeHTML(leave.admin_remarks ?? '')}</td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

// Helper function to escape HTML entities
function escapeHTML(str) {
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}

// Update event listener for View Leave Data button
document.addEventListener('DOMContentLoaded', function() {
    // ... existing event listeners ...

    const viewLeaveDataButtons = document.querySelectorAll('.view-leave-data-btn');
    viewLeaveDataButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            openLeaveDataModal(userId, userName);
        });
    });
});

</script>

<!-- View Leave Data Modal Structure -->
<div class="modal" id="leaveDataModal" style="display: none;">
    <div class="modal-content">
        <h3 id="leaveDataModalTitle">Leave Data</h3>
        <table class="leave-table">
            <thead>
                <tr>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="leaveDataTableBody">
                <!-- Leave data will be loaded here -->
            </tbody>
        </table>
        <div class="form-actions">
            <button type="button" onclick="closeLeaveDataModal()">Close</button>
        </div>
    </div>
</div>

</body>
</html>