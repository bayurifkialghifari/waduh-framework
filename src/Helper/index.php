<?php

use App\Utils\Url;
use App\Utils\Session;

function redirect($url) {
    $urlClass = Url::getInstance();
    $url = $urlClass->getBaseUrl() . $url;

    echo '<script>window.location.href = "' . $url . '"</script>';
}

function redirectBack() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function url($url) {
    $urlClass = Url::getInstance();
    return $urlClass->getBaseUrl() . $url;
}

function flash($key = 'success', $message = '') {
    $session = Session::getInstance();
    $session->flash($key, $message);
}

function getFlash($key = 'success') {
    $session = Session::getInstance();
    return $session->getFlash($key);
}

function unFlash() {
    $session = Session::getInstance();
    $session->unFlash();
}

function old($key) {
    $session = Session::getInstance();
    $key = 'old_' . $key;
    return $session->getFlash($key);
}

function error($key) {
    $session = Session::getInstance();
    $key = 'error_' . $key;
    return $session->getFlash($key);
}

function hasError($key) {
    $session = Session::getInstance();
    $key = 'error_' . $key;
    return $session->hasFlash($key);
}

function passwordHash($value, $cost = 12) {
    password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
}

function verifyHash($value, $hash) {
    password_verify($value, $hash);
}