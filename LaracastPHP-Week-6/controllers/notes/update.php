<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;


$note = $db->query("SELECT * FROM notes WHERE id = :id", [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body should be between 1 and 1000 characters long.';
}

if (count($errors)) {
    return view("notes/edit.view.php", [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
}

//update note
$db->query("UPDATE notes SET body = :body WHERE id = :id", [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

header('Location: /notes');
die();