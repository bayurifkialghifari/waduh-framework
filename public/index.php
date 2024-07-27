<?php

require_once realpath(__DIR__ . '/../vendor/autoload.php');

// Dot ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Start session
session_start();

// Route
require_once __DIR__ . '/../src/Route/index.php';
