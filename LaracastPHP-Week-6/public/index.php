<?php

session_start();

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);


// const BASE_PATH = __DIR__ . '/../';

// require BASE_PATH . 'functions.php';

// spl_autoload_register(function ($class) {
//     require base_path("Core/{$class}.php");
// });
// require base_path('router.php');



// $id = $_GET['id'] ?? null;
// $query = "SELECT * FROM posts WHERE id = ?";
// $query = "SELECT * FROM posts WHERE id = :id";

// $posts = $db->query($query, [$id])->fetchAll(PDO::FETCH_ASSOC);
// $posts = $db->query($query, ['id' => $id])->fetchAll(PDO::FETCH_ASSOC);

// dd($posts); 

