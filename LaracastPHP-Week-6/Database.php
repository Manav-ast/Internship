<?php

class Database {

    public $connection;

    public function __construct($config, $username = 'root', $password = 'root') {

        $dsn = 'mysql:'. http_build_query($config, '', ';');

        // $dsn = "mysql:host={$config['host']}:{$config['port']};dbname={$config['dbname']};user=root;password=root;charset={$config['charset']};";

        // $dsn = "mysql:host=localhost:3306;dbname=myapp;user=root;password=root;charset=utf8mb4;";
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $parameters = []) {
        
        $statement =  $this->connection->prepare($query);
        $statement->execute($parameters);
        
        return $statement;
    }
}