<?php
session_start();

// Check if the user is logged in, if not, redirect to the index.php page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}
?>

<?php
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the index.php page
header('Location: index.php');
exit;
?>
