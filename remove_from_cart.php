<?php
// Remove a specific item from the user's cart
require_once __DIR__ . '/init_session.php';
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

$user_id = require_login_json();

$input = $_POST;
if (empty($input) && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true) ?? [];
}

$item_id = isset($input['item_id']) ? (int)$input['item_id'] : 0;
if ($item_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'invalid_input']);
    exit;
}

try {
    // verify ownership: join cart and cart_items
    $v = $pdo->prepare('SELECT ci.cart_item_id AS item_id FROM cart_items ci JOIN cart c ON c.cart_id = ci.cart_id WHERE ci.cart_item_id = :item_id AND c.user_id = :user_id LIMIT 1');
    $v->execute([':item_id' => $item_id, ':user_id' => $user_id]);
    if (!$v->fetch()) {
        echo json_encode(['success' => false, 'error' => 'not_found']);
        exit;
    }

    $d = $pdo->prepare('DELETE FROM cart_items WHERE cart_item_id = :item_id');
    $d->execute([':item_id' => $item_id]);

    echo json_encode(['success' => true, 'removed' => true]);
    exit;

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'server_error', 'message' => $e->getMessage()]);
    exit;
}

?>
