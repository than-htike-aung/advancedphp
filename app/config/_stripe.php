<?php

use App\classes\Session;
use Stripe\Stripe;

$stripe = [
    "secret_key" => getenv("STRIPE_SECRET_KEY"),
    "publishable_key" => getenv("STRIPE_PUBLISHABLE_KEY")
];

Session::replace("publishable_key", $stripe["publishable_key"]);

Stripe::setApiKey($stripe["secret_key"]);
