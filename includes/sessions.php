<?php
session_start();
$user_Uid = $_SESSION['user_Uid'] ?? false;
echo $user_Uid;
header('location: logout.php');

function login()  // Remember user passed login
{
    session_regenerate_id(true); // Update session id
    $_SESSION['user_Uid'] = true; // Set logged_in key to true
}

function logout() // Terminate the session
{
    $_SESSION = []; // Clear contents of array
    $_SESSION['user_Uid'] = false;
    $params = session_get_cookie_params(); // Get session cookie parameters
    setcookie('PHPCookie', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // Delete session cookie

    session_destroy(); // Delete session file
}

function require_login($user_Uid) // Check if user logged in
{
    if ($user_Uid == false) {  // If not logged in
        header('Location: login.php');  // Send to login page
        exit; // Stop rest of page running
    }
}
