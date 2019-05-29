<?php

include "framework/Application.php";

session_start();

$app = new Application();

$app->dispatch($_SERVER['REQUEST_URI']);
