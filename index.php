<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('main', 'PostController');
Routing::post('login', 'AuthController');
Routing::post('logout', 'AuthController');
Routing::post('createPost', 'PostController');
Routing::post('search', 'PostController');
Routing::post('categorySearch', 'PostController');
Routing::get('post', 'PostController');
Routing::post('createComment', 'PostController');

Routing::run($path);