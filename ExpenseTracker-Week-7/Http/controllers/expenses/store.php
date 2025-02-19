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

$created_at = $_POST['created_at'];
$created_at = date('Y-m-d', strtotime($created_at));

$db->query("INSERT INTO expenses (name, amount, group_id, created_at) VALUES (:name, :amount, :group_id, :created_at)", [
    'name' => $_POST['name'],
    'amount' => $_POST['amount'],
    'group_id' => $_POST['group_id'],
    'created_at' => $created_at 
]);

header('Location: /expenses');
die();

