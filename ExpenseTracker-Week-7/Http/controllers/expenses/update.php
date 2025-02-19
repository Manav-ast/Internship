<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$expense = $db->query("SELECT * FROM expenses WHERE id = :id", [
    'id' => $_POST['id']
])->findOrFail();

$errors = [];

if (! Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'A body should be between 1 and 1000 characters long.';
}

if (count($errors)) {
    return view("expenses", [
        'heading' => 'Expenses',
        'errors' => $errors,
        'expense' => $expense
    ]);
}

$created_at = $_POST['date'];
$created_at = date('Y-m-d', strtotime($created_at));

//update note
$db->query("UPDATE expenses SET name = :name, amount = :amount, group_id= :group_id, created_at= :date WHERE id = :id", [
    'name' => $_POST['name'],
    'id' => $_POST['id'],
    'amount' => $_POST['amount'],
    'group_id' => $_POST['group_id'],
    'date' => $created_at
]);

header('Location: /expenses');
die();