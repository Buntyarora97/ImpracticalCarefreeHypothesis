<?php

if (session_status() == PHP_SESSION_NONE && !headers_sent()) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 1 : 0);
    session_start();
}

require_once __DIR__ . '/database.php';

require_once __DIR__ . '/models/Product.php';
require_once __DIR__ . '/models/Category.php';
require_once __DIR__ . '/models/Admin.php';
require_once __DIR__ . '/models/Order.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/ContactInquiry.php';
require_once __DIR__ . '/models/Review.php';
require_once __DIR__ . '/models/ProductImage.php';
require_once __DIR__ . '/models/Setting.php';
require_once __DIR__ . '/models/Hero.php';
require_once __DIR__ . '/models/Story.php';

define('SITE_NAME', 'GLIMLACH');
define('SITE_DOMAIN', getenv('SITE_DOMAIN') ?: 'glimlach.in');
define('SITE_EMAIL', 'support@glimlach.in');
define('SITE_PHONE', '+91 8958489684');
define('SITE_ADDRESS', 'India');
define('SITE_TAGLINE', 'Wellness Starts with GLIMLACH');
define('CURRENCY', '₹');
define('FREE_SHIPPING_ABOVE', 300);

define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID') ?: '');
define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET') ?: '');

define('SHIPROCKET_BASE_URL', 'https://apiv2.shiprocket.in/v1/external');
define('SHIPROCKET_API_EMAIL', getenv('SHIPROCKET_API_EMAIL') ?: '');
define('SHIPROCKET_API_PASSWORD', getenv('SHIPROCKET_API_PASSWORD') ?: '');
define('SHIPROCKET_PICKUP_LOCATION', getenv('SHIPROCKET_PICKUP_LOCATION') ?: 'Warehouse Office');

define('PAYU_MERCHANT_KEY', getenv('PAYU_MERCHANT_KEY') ?: '');
define('PAYU_SALT', getenv('PAYU_SALT') ?: '');
define('PAYU_BASE_URL', 'https://secure.payu.in/_payment');
define('PAYU_SUCCESS_URL', (getenv('SITE_URL') ?: 'https://glimlach.in') . '/payu-success.php');
define('PAYU_FAILURE_URL', (getenv('SITE_URL') ?: 'https://glimlach.in') . '/payu-failure.php');

define('IM_API_KEY', getenv('IM_API_KEY') ?: '');
define('IM_AUTH_TOKEN', getenv('IM_AUTH_TOKEN') ?: '');

define('SITE_URL', getenv('SITE_URL') ?: 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:5000'));

define('CASHFREE_CLIENT_ID', getenv('CASHFREE_CLIENT_ID') ?: '');
define('CASHFREE_CLIENT_SECRET', getenv('CASHFREE_CLIENT_SECRET') ?: '');
define('CASHFREE_ENV', getenv('CASHFREE_ENV') ?: 'PROD');


function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += (($item['price'] ?? 0) * ($item['quantity'] ?? 0));
        }
    }
    return $total;
}

function getCartMrpTotal() {
    $total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += (($item['mrp'] ?? $item['price']) * ($item['quantity'] ?? 0));
        }
    }
    return $total;
}

function getGlobalOfferPercent() {
    try {
        $stmt = db()->prepare("SELECT value FROM settings WHERE key = 'global_offer_percent'");
        $stmt->execute();
        return (float)($stmt->fetchColumn() ?: 10);
    } catch (Exception $e) {
        return 10;
    }
}

function getShippingFee($subtotal) {
    if ($subtotal >= FREE_SHIPPING_ABOVE) {
        return 0;
    }
    return 50;
}

function e($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}

function productUrl($product) {
    $slug = $product['slug'] ?? '';
    if ($slug) {
        return 'product-detail.php?slug=' . urlencode($slug);
    }
    return 'product-detail.php?id=' . ($product['id'] ?? 0);
}

function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += ($item['quantity'] ?? 0);
        }
    }
    return $count;
}

define('UPI_ID', Setting::get('UPI_ID', getenv('UPI_ID') ?: '9953835017@ybl'));
define('UPI_HOLDER_NAME', Setting::get('UPI_HOLDER_NAME', 'GLIMLACH'));

function checkDelivery($pincode) {
    $available_pincodes = ['151001', '110001', '400001'];
    return in_array($pincode, $available_pincodes);
}
