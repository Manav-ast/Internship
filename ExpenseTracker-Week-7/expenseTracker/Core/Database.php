<?php 
namespace Core;

use PDO;
use PDOException;

class Database {

    public $connection;
    public $statement;

    // connect with db:
    public function __construct($config){
    
        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
            $this->connection = new PDO($dsn,'root','root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
    }

    // fire query on db
    public function query($query,$params = []){
    
        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);

            return $this;
        } catch (PDOException $e) {
            throw new PDOException("Query failed: " . $e->getMessage());
        }
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function findOrFail(){
        $result = $this->find();

        if(! $result)
        {
            abort();
        }

        return $result;
    }
}
