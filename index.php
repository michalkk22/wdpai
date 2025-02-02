<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('main', 'PostController');
Routing::post('login', 'AuthController');
Routing::post('createPost', 'PostController');
Routing::post('search', 'PostController');
Routing::post('categorySearch', 'PostController');

Routing::run($path);