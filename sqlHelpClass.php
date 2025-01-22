<?php

/**
 * Class DatabaseHelper
 * 
 * A class-based approach to database operations.
 * 
 * To use, just put a required for the file and use the class methods.
 * 
 * For example (in the file you want to the use the class):
 * $users = $dbHelper->basicSelectAll('users');
 * 
 * Quick Debugging Guide:
 * 
 * Ensure you have the correct database connection parameters set in the constructor.
 * Ensure that you put the correct table names and column names in the methods.
 * Ensure that you have the correct WHERE conditions in the methods.
 * Ensure that you have the correct data to insert or update in the methods.
 * Ensure that you have the correct number of columns and values in the bulk insert method.
 * 
 * GLHF!
 * 
 * - Past Henry
 * D.O.C 22/1/2025
 * 
 */
class DatabaseHelper
{
    private $pdo;

    /**
     * Constructor to initialize the PDO connection.
     *
     * @throws PDOException If the database connection fails.
     */
    public function __construct()
    {
        // Database connection parameters
        $host = 'localhost'; // Database host
        $db = 'toka'; // Database name
        $user = 'root'; // Database username
        $pass = 'root'; // Database password
        $charset = 'utf8mb4';

        // Set up the DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // Initialize the PDO connection
        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            // Set error mode to exception to catch errors
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

        // Start a session if none exists
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Basic function for a basic SELECT * FROM query, not based on any conditions.
     * 
     * @param string $tableName The name of the table to query.
     * 
     * @return array The result of the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->basicSelectAll('users');
     * @example $dbHelper->basicSelectAll($users);
     * 
     */
    public function basicSelectAll($tableName)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Basic function for a basic SELECT * FROM query, based on a WHERE condition.
     * 
     * @param string $tableName The name of the table to query.
     * @param string $where The WHERE condition to use in the query.
     * 
     * @return array The result of the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->basicSelectAllWhere('users', "user_id = 1");
     * @example $dbHelper->basicSelectAllWhere('users', "user_id = $id");
     * 
     */
    public function basicSelectAllWhere($tableName, $where)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE $where");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Inserts a new record into a table.
     * 
     * @param string $tableName The name of the table to insert into.
     * @param array $data An associative array of column names and values to insert.
     * 
     * @return int The ID of the newly inserted record.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->insertRecord('users', ['name' => 'John Doe', 'email' => 'john@gmail.com']);
     * @example $dbHelper->insertRecord('users', ['name' => $name, 'email' => $email]);
     * 
     */
    public function insertRecord($tableName, $data)
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $stmt = $this->pdo->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");
            $stmt->execute($data);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Updates a record in a table based on a WHERE condition.
     * 
     * @param string $tableName The name of the table to update.
     * @param array $data An associative array of column names and values to update.
     * @param string $where The WHERE condition to use in the query.
     * 
     * @return int The number of rows affected by the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->updateRecord('users', ['name' => 'Jane Doe'], 'user_id = 1');
     * @example $dbHelper->updateRecord('users', ['name' => $name], "user_id = $id");
     * 
     */
    public function updateRecord($tableName, $data, $where)
    {
        try {
            $set = [];
            foreach ($data as $key => $value) {
                $set[] = "$key = :$key";
            }
            $set = implode(", ", $set);
            $stmt = $this->pdo->prepare("UPDATE $tableName SET $set WHERE $where");
            $stmt->execute($data);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Deletes records from a table based on a WHERE condition.
     * 
     * @param string $tableName The name of the table to delete from.
     * @param string $where The WHERE condition to use in the query.
     * 
     * @return int The number of rows affected by the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->deleteRecord('users', 'user_id = 1');
     * @example $dbHelper->deleteRecord('users', "user_id = $id");
     * 
     */
    public function deleteRecord($tableName, $where)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE $where");
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Counts the number of records in a table based on a WHERE condition.
     * 
     * @param string $tableName The name of the table to count records in.
     * @param string $where The WHERE condition to use in the query.
     * 
     * @return int The number of records in the table.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->countRecords('users');
     * @example $dbHelper->countRecords('users', "tier = 'free'");
     * @example $dbHelper->countRecords('users', "tier = $tier");
     * 
     */
    public function countRecords($tableName, $where = null)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM $tableName" . ($where ? " WHERE $where" : ""));
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Searches for records with optional pagination.
     * 
     * @param string $tableName The name of the table to search in.
     * @param string $where The WHERE condition to use in the query.
     * @param int $limit The number of records to return.
     * @param int $offset The number of records to skip.
     * 
     * @return array The result of the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->searchRecords('users');
     * @example $dbHelper->searchRecords('users', "tier = 'free', 10, 0");
     * @example $dbHelper->searchRecords('users', "tier = $tier", 10, 0");
     * @example $dbHelper->searchRecords('users', "tier = 'free', $limit, $offset");
     * 
     */
    public function searchRecords($tableName, $where = null, $limit = 10, $offset = 0)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName" . ($where ? " WHERE $where" : "") . " LIMIT $limit OFFSET $offset");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Fetches a single record based on a WHERE condition.
     * 
     * @param string $tableName The name of the table to fetch from.
     * @param string $where The WHERE condition to use in the query.
     * 
     * @return array The result of the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->fetchSingleRecord('users', 'user_id = 1');
     * @example $dbHelper->fetchSingleRecord('users', "user_id = $id");
     * 
     */
    public function fetchSingleRecord($tableName, $where)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $tableName WHERE $where");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    /**
     * Inserts multiple records into a table at once.
     * 
     * @param string $tableName The name of the table to insert into.
     * @param array $data An array of associative arrays of column names and values to insert.
     * 
     * @return int The number of rows affected by the query.
     * 
     * @throws PDOException If the query fails.
     * 
     * @example $dbHelper->bulkInsert('users', [['name' => 'John Doe', 'email' => 'john@gmail.com'], ['name' => 'Jane Doe', 'email' => 'jane@gmail.com']]);
     * @example $dbHelper->bulkInsert('users', [['name' => $name, 'email' => $email], ['name' => $nameTwo, 'email' => $emailTwo]]);
     * 
     */
    public function bulkInsert($tableName, $data)
    {
        try {
            $columns = implode(", ", array_keys($data[0]));
            $placeholders = "(" . implode(", ", array_fill(0, count($data[0]), "?")) . ")";
            $query = "INSERT INTO $tableName ($columns) VALUES " . implode(", ", array_fill(0, count($data), $placeholders));
            $stmt = $this->pdo->prepare($query);
            $flatValues = [];
            foreach ($data as $row) {
                $flatValues = array_merge($flatValues, array_values($row));
            }
            $stmt->execute($flatValues);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }
}

$dbHelper = new DatabaseHelper();