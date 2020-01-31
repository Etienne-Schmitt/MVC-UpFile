<?php

$host = "localhost";
$dbname = "dbname_db;charset=utf8";
$user = "user";
$pass = "password";

$projectName = basename(__DIR__);
$projectNameLength = strlen($projectName) + 1;
$baseUrl = mb_substr($_SERVER['REQUEST_URI'], 0, $projectNameLength);
