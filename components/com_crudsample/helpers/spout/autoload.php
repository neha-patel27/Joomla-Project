<?php
// ❌ DO NOT add namespace here

require_once __DIR__ . '/Psr4Autoloader.php';

use Box\Spout\Autoloader\Psr4Autoloader;

// This MUST point to src/Spout
$srcBaseDirectory = __DIR__ . '/src/Spout';

$loader = new Psr4Autoloader();
$loader->register();

// Map: Box\Spout\* → src/Spout/*
$loader->addNamespace('Box\\Spout', $srcBaseDirectory);
