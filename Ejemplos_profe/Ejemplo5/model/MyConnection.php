<?php
// el fichero MyConnection contiene la información relevante para realizar la conexión a la base de datos
class MyConnection
{

  private $host = 'localhost';
  private $user = 'root';
  private $pass = 'contraseñaForoMotos';

  public function __construct()
  { }

  public function createConnection()
  {
    $connection = mysqli_connect($this->host, $this->user, $this->pass);

    if ($connection->connect_error) {
      die('Error de Conexión (' . $connection->connect_errno . ') '
        . $connection->connect_error);
    }

    return $connection;
  }
}
