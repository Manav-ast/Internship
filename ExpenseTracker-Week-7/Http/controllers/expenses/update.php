<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$group = $db->query("SELECT * FROM expenses WHERE id = :id", [
    'id' => $_POST['id']
])->findOrFail();

$errors = [];

if (! Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'A body should be between 1 and 1000 characters long.';
}

if (count($errors)) {
    return view("groups/edit.view.php", [
        'heading' => 'Edit group',
        'errors' => $errors,
        'group' => $group
    ]);
}

//update note
$db->query("UPDATE expenses SET name = :body WHERE id = :id", [
    'body' => $_POST['name'],
    'id' => $_POST['id']
]);

header('Location: /expenses');
die();