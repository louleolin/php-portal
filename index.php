<?php

include "framework/Application.php";

$app = new Application();

$app->dispatch($_SERVER['REQUEST_URI']);
