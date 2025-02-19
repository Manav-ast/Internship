<?php

// use Core\App;
// use Core\Validator;
// use Core\Database;

// $db = App::resolve(Database::class);

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

// $created_at = $_POST['created_at'];
// $created_at = date('Y-m-d', strtotime($created_at));

// $db->query("INSERT INTO expenses (name, amount, group_id, created_at) VALUES (:name, :amount, :group_id, :created_at)", [
//     'name' => $_POST['name'],
//     'amount' => $_POST['amount'],
//     'group_id' => $_POST['group_id'],
//     'created_at' => $created_at 
// ]);

// header('Location: /expenses');
// die();

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

// Validate group selection
if (empty($_POST['group_id'])) {
    $errors['group_id'] = 'Please select an expense group.';
}

// Validate expense name
if (!Validator::string($_POST['name'], 1, 100)) {
    $errors['name'] = 'Expense name must be between 1 and 100 characters.';
}

// Validate amount
if (!isset($_POST['amount']) || $_POST['amount'] <= 0) {
    $errors['amount'] = 'Amount must be greater than zero.';
}

// Validate date
if (empty($_POST['created_at'])) {
    $errors['created_at'] = 'Please select a date.';
}

// If there are errors, reload the form with previous input and groups
if (!empty($errors)) {
    $groups = $db->query("SELECT * FROM expense_groups")->get(); // Ensure groups are fetched
    return view("expenses/create.view.php", [
        'heading' => 'Add Expense',
        'errors' => $errors,
        'groups' => $groups
    ]);
}


$created_at = $_POST['created_at'];
$created_at = date('Y-m-d', strtotime($created_at));


// Insert into the database if no errors
$db->query("INSERT INTO expenses (group_id, name, amount, created_at) VALUES (:group_id, :name, :amount, :created_at)", [
    'group_id' => $_POST['group_id'],
    'name' => $_POST['name'],
    'amount' => $_POST['amount'],
    'created_at' => $created_at
]);

header('Location: /expenses');
die();