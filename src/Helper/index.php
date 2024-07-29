<?php

use App\Utils\Url;

function redirect($url) {
    $urlClass = new Url;
    $url = $urlClass->getBaseUrl() . $url;

    echo '<script>window.location.href = "' . $url . '"</script>';
}

function hash($value, $cost = 12) {
    password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
}

function verifyHash($value, $hash) {
    password_verify($value, $hash);
}