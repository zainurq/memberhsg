<?php
include 'layouts/session.php';
include 'layouts/config.php';

if ($login == 'true' && isset($_POST['memberid'])) {
    $memberid = $_POST['memberid'];
    
    // Perform account deletion
    $deleteQuery = "DELETE FROM member_hsg WHERE memberid = ?";
    $deleteStmt = mysqli_prepare($link, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, 's', $memberid);
    mysqli_stmt_execute($deleteStmt);

    // Destroy the session (optional if you want to log out the user immediately)
    session_destroy();

    // Send a success response to the client (you can customize the response as needed)
    echo json_encode(['success' => true]);
} else {
    // Send a failure response if the request is not valid
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
