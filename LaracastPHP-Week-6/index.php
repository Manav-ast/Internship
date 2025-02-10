<?php

require 'functions.php';
// require 'router.php';

$uri = $_SERVER['REQUEST_URI'];

if($uri === '/') {
    require 'controllers/index.php';
}