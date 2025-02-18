<?php

$router->get('/', 'index.php');
$router->get('/expenses', 'expenses/index.php');

$router->get('/groups', 'groups/index.php');
$router->get('/group', 'groups/show.php');
$router->delete('/group', 'groups/destroy.php');

$router->get('/group/edit', 'groups/edit.php');
$router->patch('/group', 'groups/update.php');

$router->get('/groups/create', 'groups/create.php');
$router->post('/groups', 'groups/store.php');

$router->get('/expenses', 'expenses/index.php');
$router->get('/expenses/create', 'expenses/create.php');
$router->post('/expenses', 'expenses/store.php');
$router->delete('/expenses', 'expenses/destroy.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');


$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/sessions', 'sessions/destroy.php')->only('auth');