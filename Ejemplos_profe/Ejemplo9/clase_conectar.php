<?php
class Conectar {
    //Declado las variables privadas de la clase que se corresponden con los parámetros de conexión al servidor
	private $servidor;
    private $user;
    private $password;
	//Declaro la variable objeto de la conexión
    private $objetoConexion;	
	//Declaro el método constructor de la clase, al que le paso las variables de conexión al servidor
    public function __construct($servidor,$user,$password) {
        //Establezco el valor de cada variable de la clase al valor que he pasado al contructor al hacer la llamada en el momento de la definición de la clase
		$this->servidor=$servidor;
        $this->user=$user;
        $this->password=$password;
    }
	
	//Método cpara realizar la conexión al servidor.
    public function conectar() {
        //Mediante el try intenta realizar lo que se indica entre sus llaves
		try {
            //Realizamos la conexión mediante la clase PDO 
			$this->objetoConexion = new PDO($this->servidor,  $this->user ,  $this->password );
            //Establecemos los atributos correspondientes en caso de error 
			$this->objetoConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        //En caso de que el try no funcione, declaramos la variable ex de PDOException
		catch(PDOException $ex) {
            echo "Problemas al conectar con la base de datos";
        }
    }
    
	//Método para finalizar la conexión con la base de datos
	public function desconectar() {
        //Igualamos a null el objeto conexión
		$this->objetoConexion=null;
    }
    
	//Método para ejecutar la sentencia SQL que se pase como parámetro de la función
	public function ejecutar($strComando) {
        try {
            //La variable ejecutar es un objeto que instancia a la clase objetoConexión de la clase clase_conexion
			//Prepara la sentencia SQL limpiando de posibles problemas relacionados con injection SQL. 
			$ejecutar=$this->objetoConexion->prepare($strComando); 
            //Ejecuta la sentencia que le pasamos como parámetro strComando.
			$ejecutar->execute();		
        }
        catch(PDOException $ex) {
            //Devuelve la variable ex con la excepción que surja
			throw $ex;
        }
    }

    //Método para almacenar los datos devueltos por las consultas realizadas a la base de datos
    public function consultar($strComando) {
        try {
            $ejecutar=$this->objetoConexion->prepare($strComando); 
            //Ejecuta la sentencia que le pasamos como parámetro strComando. (http://php.net/manual/es/pdostatement.execute.php)
            $ejecutar->execute();
            //Guardamos en la variable row lo que devuelva la función fetchAll, es decir la consulta SQL. (http://php.net/manual/es/pdostatement.fetchall.php)
            $rows = $ejecutar->fetchAll();
            return $rows;

        }
        catch(PDOException $ex) {
            //Devuelve la variable ex con la excepción que surja
            throw $ex;
        }
    }
}







?>