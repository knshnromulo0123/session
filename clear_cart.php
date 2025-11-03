<?php
// Clear all items from the logged-in user's cart (used after checkout)
require_once __DIR__ . '/init_session.php';
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

$user_id = require_login_json();

try {
    // Find the cart
    $s = $pdo->prepare('SELECT cart_id FROM cart WHERE user_id = :user_id LIMIT 1');
    $s->execute([':user_id' => $user_id]);
    $cart = $s->fetch();
    if (!$cart) {
        echo json_encode(['success' => true, 'cleared' => true, 'message' => 'no_cart']);
        exit;
    }
    $cart_id = (int)$cart['cart_id'];

    // Delete items only for this cart (use cart_items table)
    $d = $pdo->prepare('DELETE FROM cart_items WHERE cart_id = :cart_id');
    $d->execute([':cart_id' => $cart_id]);

    // Optionally remove the cart row too. We'll keep the row but you can uncomment below to remove it.
    // $pdo->prepare('DELETE FROM cart WHERE cart_id = :cart_id')->execute([':cart_id' => $cart_id]);

    echo json_encode(['success' => true, 'cleared' => true]);
    exit;

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'server_error', 'message' => $e->getMessage()]);
    exit;
}

?>
