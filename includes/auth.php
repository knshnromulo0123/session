<?php
// Simple session helpers for the project
// Usage: require_once __DIR__ . '/includes/auth.php'; then call init_session();

/**
 * Initialize session safely.
 * Returns true when a session is active or was successfully started.
 * Returns false when headers already sent and session could not be (re)configured.
 */
function init_session(): bool {
    if (session_status() !== PHP_SESSION_NONE) {
        return true;
    }

    // If headers already sent we cannot set cookie params; try to start session anyway
    if (headers_sent()) {
        // Attempt to start session but suppress warnings — it will fail if headers already sent
        // Return false if session still isn't active.
        @session_start();
        return session_status() === PHP_SESSION_ACTIVE;
    }

    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'] ?? '',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
    return session_status() === PHP_SESSION_ACTIVE;
}

function login_user(array $userRow): void {
    init_session();
    // store minimal user info in session
    $_SESSION['user'] = [
        'id' => $userRow['id'] ?? ($userRow['user_id'] ?? ($userRow['userId'] ?? null)),
        'first_name' => $userRow['first_name'] ?? $userRow['firstName'] ?? '',
        'last_name' => $userRow['last_name'] ?? $userRow['lastName'] ?? '',
        'username' => $userRow['username'] ?? $userRow['user_name'] ?? '',
        'email' => $userRow['email'] ?? $userRow['email_address'] ?? ''
    ];
    // regenerate session id to mitigate fixation
    session_regenerate_id(true);
}

function is_logged_in(): bool {
    init_session();
    return !empty($_SESSION['user']);
}

function current_user(): ?array {
    init_session();
    return $_SESSION['user'] ?? null;
}

function logout_user(): void {
    init_session();
    // Unset all session variables
    $_SESSION = [];
    // Delete session cookie
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'] ?? '/', $params['domain'] ?? '', $params['secure'] ?? false, $params['httponly'] ?? true
        );
    }
    session_destroy();
}
