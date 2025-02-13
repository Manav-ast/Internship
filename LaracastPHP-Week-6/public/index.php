<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('Core/router.php');

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

