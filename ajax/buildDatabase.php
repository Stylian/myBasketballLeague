<?php
require_once "../classes/ConnectionManager.php";

// create schema
ConnectionManager::createSchema($_GET["season"]);

// add tables
$conMan = ConnectionManager::createDbInstance($_GET["season"]);
$conMan->createTables();

echo "{ }";
?>