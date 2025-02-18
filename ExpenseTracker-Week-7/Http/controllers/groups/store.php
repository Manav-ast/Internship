<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if (! Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'A body should be between 1 and 1000 characters long.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create a note',
        'errors' => $errors
    ]);
}
$db->query("INSERT INTO expense_groups (name) VALUES (:name)", [
    'name' => $_POST['name'],
]);

header('Location: /groups');
die();

