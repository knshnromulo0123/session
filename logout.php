<?php
require_once __DIR__ . '/includes/auth.php';
init_session();
logout_user();
$redirect = $_GET['redirect_to'] ?? $_SERVER['HTTP_REFERER'] ?? '/';
header('Location: ' . $redirect);
exit;
