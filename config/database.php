<?php

class Database {
    private $connection;

    public function __construct() {
        $username = "root";
        $password = "@.happy!";
        $database = "server_admin";
        $host = "localhost";

        $this->connection = new mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function login($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function signup($first_name, $last_name, $username, $password, $email) {
        $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, username, password, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $password, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct() {
        $this->connection->close();
    }
}

?>