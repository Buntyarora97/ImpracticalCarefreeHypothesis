<?php
session_start();
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/models/Order.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$status = $_POST['status'] ?? '';
$txnid = $_POST['txnid'] ?? '';
$amount = $_POST['amount'] ?? '';
$productinfo = $_POST['productinfo'] ?? '';
$email = $_POST['email'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$posted_hash = $_POST['hash'] ?? '';
$key = $_POST['key'] ?? '';
$salt = PAYU_SALT;

if ($salt === '') {
    error_log('PayU success callback received but PAYU_SALT is not configured.');
    header("Location: payu-failed.php?reason=payment_not_configured");
    exit;
}

$hashSequence = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
$calculated_hash = strtolower(hash('sha512', $hashSequence));

$orderNo = trim(str_replace('Order #', '', $productinfo));
$orderNo = explode('_', $orderNo)[0];

$stmt = db()->prepare("SELECT id FROM orders WHERE order_number = ?");
$stmt->execute([$orderNo]);
$order = $stmt->fetch();

if (!$order) {
    header("Location: index.php");
    exit;
}

// Check for both success and pending/other valid states if hash matches
if (hash_equals($calculated_hash, strtolower($posted_hash))) {
    $payment_status = ($status === 'success') ? 'paid' : 'pending';
    
    Order::updatePaymentStatus($order['id'], $payment_status, [
        'payment_id' => $_POST['payuMoneyId'] ?? $txnid,
        'bank_ref' => $_POST['bank_ref_no'] ?? '',
        'payment_response' => json_encode($_POST)
    ]);
    
    if ($status === 'success') {
        Order::updateStatus($order['id'], 'confirmed');
        unset($_SESSION['cart']);
        unset($_SESSION['pending_order_id']);
        header("Location: order-success.php?order_id=" . $order['id']);
    } else {
        header("Location: payu-failed.php?order_id=" . $order['id'] . "&status=" . $status);
    }
} else {
    // Hash mismatch
    header("Location: payu-failed.php?order_id=" . $order['id'] . "&reason=hash_mismatch");
}
exit;
