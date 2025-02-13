<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');

$db = new Database($config['database']);
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {


    if(! Validator::string($_POST['body'], 1, 1000)){
        $errors['body'] = 'A body should be between 1 and 1000 characters long.';
    }

    if(empty($errors)){
        $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)", [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}

view("notes/create.view.php",[
    'heading' => 'Create a note',
    'errors' => $errors
]);