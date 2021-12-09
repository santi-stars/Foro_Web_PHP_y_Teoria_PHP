<?php
include_once 'C:\xampp\htdocs\Teoria\Ejemplos_profe\Ejemplo5\model\MyConnection.php';

// el models es la representación de la información con la cual el sistema opera,
// por lo tanto gestiona todos los accesos a dicha información, tanto consultas
// como actualizaciones
class Model
{
    private $connection;

    public function __construct()
    {
        // se inicia la conexión y se habilitan las funciones internas de notificación de mysqli
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function connectCheckDb()
    {
        // se crea la conexión, la base de datos (si no existe), se selecciona la base de datos,
        // y se crea la tabla  (si no existe)
        $this->connection = (new MyConnection())->createConnection();
        $this->createDB();
        mysqli_select_db($this->connection, "ejemplo5");
        $this->createTable();
    }


    public function createDB()
    {
        // se crea la base de datos (si no existe)
        $query = "CREATE DATABASE IF NOT EXISTS ejemplo5";
        mysqli_query($this->connection, $query);
    }

    public function createTable()
    {
        // se crea la tabla en la base de datos (si no existe)
        $query = "CREATE TABLE IF NOT EXISTS user (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            password VARCHAR(255) NOT NULL
            )";
        mysqli_query($this->connection, $query);
    }


    public function inputExists($input, $value)
    {
        // comprueba si un campo (username o email) existe en la base de datos con un determinado valor (value) 

        // se inicia la conexión con la base de datos
        $this->connectCheckDb();

        switch ($input) {
                // se prepara el prepared statement: en este caso dependiendo del campo, se usará uno u otro
            case 'username':
                if (!$query = $this->connection->prepare("SELECT * FROM ejemplo5.user WHERE username = ?")) {
                    die('Error de preparación (' . htmlspecialchars($this->connection->error) . ') ');
                }
                break;

            case 'email':
                if (!$query = $this->connection->prepare("SELECT * FROM ejemplo5.user WHERE email = ?")) {
                    die('Error de preparación (' . htmlspecialchars($this->connection->error) . ') ');
                }
                break;

            default:
                # code...
                break;
        }

        // se agregan variables al prepared statement como parámetros
        if (!$query->bind_param("s", $value)) {
            die('Error de asignación (' . htmlspecialchars($query->error) . ') ');
        }

        // se ejecuta el prepared statement
        if (!$query->execute()) {
            die('Error de ejecución (' . htmlspecialchars($query->error) . ') ');
        }

        // se obtiene un conjunto de resultados del prepared statement y se almacenan en una variable
        $result = $query->get_result();

        // se determina el número de filas del resultado y se almacenan en una variable
        $num_of_rows = $result->num_rows;

        // se libera la memoria de los resultados asociados con el statement
        $query->free_result();

        // se cierra el statement
        $query->close();

        // se cierra la conexión con la base de datos
        $this->connection->close();

        // si el número de resultados es mayor que 0, significa que el campo ya está guardado en la base
        // de datos con ese valor
        if ($num_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userPassCheck($username, $md5password)
    {
        // comprueba si la pareja de valores usuario y contraseña existe en la base de datos

        // se inicia la conexión con la base de datos
        $this->connectCheckDb();

        // se prepara el prepared statement
        if (!$query = $this->connection->prepare("SELECT * FROM user WHERE username = ? AND password = ?")) {
            die('Error de preparación (' . htmlspecialchars($this->connection->error) . ') ');
        }

        // se agregan variables al prepared statement como parámetros
        if (!$query->bind_param('ss', $username, $md5password)) {
            die('Error de asignación (' . htmlspecialchars($query->error) . ') ');
        }

        // se ejecuta el prepared statement
        if (!$query->execute()) {
            die('Error de ejecución (' . htmlspecialchars($query->error) . ') ');
        }

        // se obtiene un conjunto de resultados del prepared statement y se almacenan en una variable
        $result = $query->get_result();

        // se determina el número de filas del resultado y se almacenan en una variable
        $num_of_rows = $result->num_rows;

        // se libera la memoria de los resultados asociados con el statement
        $query->free_result();

        // se cierra el statement
        $query->close();

        // se cierra la conexión con la base de datos
        $this->connection->close();

        // si el número de resultados es mayor que 0, significa que la pareja ya está guardada en la base
        // de datos
        if ($num_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function register($username, $email, $md5password)
    {
        // guarda una entrada en la base de datos con los campos especificados

        // se inicia la conexión con la base de datos
        $this->connectCheckDb();

        // se prepara el prepared statement: en este caso dependiendo del campo, se usará uno u otro
        if (!$query = $this->connection->prepare("INSERT INTO user(username, email, password) VALUES (?, ?, ?)")) {
            die('Error de preparación (' . htmlspecialchars($this->connection->error) . ') ');
        }

        // se agregan variables al prepared statement como parámetros
        if (!$query->bind_param('sss', $username, $email, $md5password)) {
            die('Error de asignación (' . htmlspecialchars($query->error) . ') ');
        }

        // se ejecuta el prepared statement
        if (!$query->execute()) {
            die('Error de ejecución (' . htmlspecialchars($query->error) . ') ');
        }

        // se libera la memoria de los resultados asociados con el statement
        $query->free_result();

        // se cierra el statement
        $query->close();

        // se cierra la conexión con la base de datos
        $this->connection->close();

        return true;
    }
}
