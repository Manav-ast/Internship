<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body should be between 1 and 1000 characters long.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create a note',
        'errors' => $errors
    ]);
}
$db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)", [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('Location: /notes');
die();

