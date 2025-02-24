<?php 
$router->get('/','controller/index.php');
$router->post('/addGroup','controller/group/storeGroup.php');
$router->delete('/deleteGroup','controller/group/deleteGroup.php');
$router->get('/getGroups','controller/group/getGroups.php');
$router->get('/getExpenses','controller/expense/getExpenses.php');

$router->post('/addExpense','controller/expense/storeExpense.php');
$router->delete('/deleteExpense','controller/expense/deleteExpense.php');
$router->patch('/editGroup','controller/group/editGroup.php');
$router->patch('/editExpense','controller/expense/editExpense.php');

?>