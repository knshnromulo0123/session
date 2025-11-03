<?php
// Central session initializer to include at the top of every script
// It re-uses the auth helpers from includes/auth.php and ensures
// $_SESSION['user_id'] is available for legacy code that expects it.
require_once __DIR__ . '/includes/auth.php';

// Ensure session is started and normalized
init_session();

// Normalize a simple user id into $_SESSION['user_id'] for APIs
if (!empty($_SESSION['user']) && empty($_SESSION['user_id'])) {
    // prefer common keys used by different user tables
    $id = $_SESSION['user']['id'] ?? $_SESSION['user']['user_id'] ?? null;
    if ($id !== null) {
        $_SESSION['user_id'] = $id;
    }
}

// Simple helper used by cart endpoints
function require_login_json()
{
    // caller should have already included this file so session is active
    if (empty($_SESSION['user_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Please log in to use the cart.']);
        exit;
    }
    return (int) $_SESSION['user_id'];
}

?>
