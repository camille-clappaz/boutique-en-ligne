<?php

require_once('../stripe/init.php');
require_once('../includes/keyStripe.php');
require_once('../includes/config.php');

\Stripe\Stripe::setApiKey($stripeSecretKey);

header('Content-Type: application/json');

function calculPrixTotal(array $products): int
{
    $total = 0;
    foreach ($products as $product) {
        $total += $product['prix'] * $product['quantite'];
    }
    $total += 4.99;
    return $total * 100;
}

try {
    $json = file_get_contents('php://input');
    $cart = json_decode($json, true);

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => calculPrixTotal($cart['products']),
        'currency' => 'eur',
        'payment_method_types' => [
            'card',
        ],
        'metadata' => [
            'user' => json_encode($cart['user']),
        ],
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

    echo json_encode($output);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
