<?php

use Core\App;
// use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

// $errors = [];

// if (! Validator::string($_POST['name'], 1, 1000)) {
//     $errors['name'] = 'A body should be between 1 and 1000 characters long.';
// }

// if (! empty($errors)) {
//     return view("notes/create.view.php", [
//         'heading' => 'Create a note',
//         'errors' => $errors
//     ]);
// }
$db->query("INSERT INTO expenses (name, amount, group_id) VALUES (:name, :amount, :group_id)", [
    'name' => $_POST['name'],
    'amount' => $_POST['amount'],
    'group_id' => $_POST['group_id']
]);

header('Location: /expenses');
die();

