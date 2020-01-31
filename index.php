<?php

require("env.php");
session_start();

if (isset($_GET["uri"]) && !empty($_GET["uri"])) {
    $page = $_GET["uri"];
} else {
    $page = "home";
}

$page = ucfirst($page);


if (file_exists('Controllers/' . $page . 'Controller.php')) {
    require_once('Controllers/' . $page . 'Controller.php');
} else {
    require_once('Controllers/404Controller.php');
}
