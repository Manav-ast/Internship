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
            throw new \Exception('Record not found.');
        }

        return $result;
    }

    /**
     * Select data from a table with optional conditions and ordering
     * @param string $table The table name
     * @param array|string $columns Array of column names or * for all columns
     * @param array $where Associative array of conditions
     * @param array $orderBy Associative array of order by clauses
     * @return $this
     */
    public function select($table, $columns = '*', $where = [], $orderBy = []) {
        try {
            // Handle columns
            $cols = is_array($columns) ? implode(', ', $columns) : $columns;
            
            // Build basic query
            $query = "SELECT {$cols} FROM {$table}";
            
            // Add WHERE clause if conditions exist
            $params = [];
            if (!empty($where)) {
                $whereParts = array_map(function($key) {
                    return "{$key} = ?";
                }, array_keys($where));
                $query .= " WHERE " . implode(' AND ', $whereParts);
                $params = array_values($where);
            }
            
            // Add ORDER BY clause if specified
            if (!empty($orderBy)) {
                $orderParts = [];
                foreach ($orderBy as $column => $direction) {
                    $orderParts[] = "{$column} {$direction}";
                }
                $query .= " ORDER BY " . implode(', ', $orderParts);
            }
            
            return $this->query($query, $params);
        } catch (PDOException $e) {
            throw new PDOException("Select failed: " . $e->getMessage());
        }
    }

    /**
     * Insert data into a table
     * @param string $table The table name
     * @param array $data Associative array of column names and values
     * @return int The ID of the inserted row
     */
    public function insert($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));
            $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
            
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute(array_values($data));
            
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Insert failed: " . $e->getMessage());
        }
    }

    /**
     * Update data in a table
     * @param string $table The table name
     * @param array $data Associative array of column names and values to update
     * @param array $where Associative array of conditions
     * @return int Number of affected rows
     */
    public function update($table, $data, $where) {
        try {
            $setParts = array_map(function($key) {
                return "{$key} = ?";
            }, array_keys($data));
            
            $whereParts = array_map(function($key) {
                return "{$key} = ?";
            }, array_keys($where));
            
            $query = "UPDATE {$table} SET " . implode(', ', $setParts);
            if (!empty($whereParts)) {
                $query .= " WHERE " . implode(' AND ', $whereParts);
            }
            
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute(array_merge(array_values($data), array_values($where)));
            
            return $this->statement->rowCount();
        } catch (PDOException $e) {
            throw new PDOException("Update failed: " . $e->getMessage());
        }
    }

    /**
     * Delete data from a table
     * @param string $table The table name
     * @param array $where Associative array of conditions
     * @return int Number of affected rows
     */
    public function delete($table, $where) {
        try {
            $whereParts = array_map(function($key) {
                return "{$key} = ?";
            }, array_keys($where));
            
            $query = "DELETE FROM {$table}";
            if (!empty($whereParts)) {
                $query .= " WHERE " . implode(' AND ', $whereParts);
            }
            
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute(array_values($where));
            
            return $this->statement->rowCount();
        } catch (PDOException $e) {
            throw new PDOException("Delete failed: " . $e->getMessage());
        }
    }
}
