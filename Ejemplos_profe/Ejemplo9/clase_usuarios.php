<?php
require_once("clase_conectar.php");
class Usuario {
    //Declaramos las variables públicas de la clase Usuario_clase, se corresponderan con los campos de la tabla usuarios de la base de datos feedback
    public $nombre_usuario;
	public $contrasena;
    public $email;
    public $nombre_origen;
    public $email_origen;
    public $asunto;
    public $mensaje;
    public $formato;
    public $headers;
    public $objetoConexion;
	//Declaro el método constructor de la clase Usuario_clase al que le pasamos las variables de la propia clase
	public function __construct($nombre_usuario,$email) {
        $this->nombre_usuario=$nombre_usuario;
		$this->email=$email;
        $this->nombre_origen = "admin";
        $this->email_origen = "root@localhost";
        $this->asunto = "Usuario creado en ejercicio feedback";
        $this->mensaje = "Su cuenta con nombre de usuario:".$this->nombre_usuario."se ha creado correctamente.";
        $this->formato = "html";
        $this->objetoConexion=new Conexion('mysql:host=localhost;dbname=ejemplo9','root','contraseñaForoMotos');
    }

    //Función que impedirá crear el usuario si no cumple con las condiciones
    public function comprobaciones () {
        $this->objetoConexion->conectar();
        //Comprobamos que los campos no estén vacíos
        if ($this->nombre_usuario == '' || $this->contrasena == '' || $this->email == '') {
            echo "<div id='msg'>Por favor, introduce todos los campos requeridos</div>";
            return false;
        }
        //Comprobamos que la dirección de correo sea válida
        elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "<div id='msg'><br/>La dirección de correo electrónico <i>".$this->email."</i> es inválida. Por favor, introduzca una correcta.</div>";
            return false;
        }
        //Comprobamos que el nombre no esté ya registrado
        else {
            //Consultamos los registros y su valor en la columna user y los almacenamos en el array $rw
            $rw = $this->objetoConexion->consultar("SELECT user from usuarios");
            if (count($rw)) {
                    //Recorremos el array y en el caso de que el nombre introducido corresponda con alguno ya registrado impedirá el registro
                    for ($i=0;$i<count($rw);$i++) {
                        if ($rw[$i]['user'] == $this->nombre_usuario) {
                            echo "<div id='msg'>Nombre de usuario ya registrado. Por favor elija otro.</div>";
                            return false;
                            break;
                        }
                    }
            }
        }
    }
    //Función que registra los datos del usuario en la base de datos
    public function nuevo() {     
        try {
            $this->objetoConexion->conectar();
            $this->objetoConexion->ejecutar("INSERT usuarios SET user='$this->nombre_usuario', password='$this->contrasena', email='$this->email'");
            //Crea un objeto correo cuyos parámetros son el nombre de usuario y el email introducido para posteriormente llamar al método enviar() y mandarle el correo
            $this->enviar();
            $this->objetoConexion->desconectar();
        }
        catch (PDOException $ex) {
            //Devuelve la excepción en caso de no poder insertar el usuario
            throw $ex;
        }
        $this->objetoConexion->desconectar();
    }

    //Método que envía el correo y devuelve un error si no es posible
    public function enviar() {
        $this->headers = "To: ".$this->nombre_usuario ."<".$this->email."> \r \n";
        $this->headers .= "From: ".$this->nombre_origen." <".$this->email_origen."> \r \n";
        $this->headers .= "Return-path: <".$this->email_origen."> \r \n";
        $this->headers .= "Reply-to: ".$this->email_origen ."\r \n";
        $this->headers .= "MIME-Version: 1.0 \r \n";
        if ($this->formato == "html") {
            $this->headers .= "Content-Type: text/html; charset = utf-8 \r \n";
        }
        else {
            $this->headers .= "Content-Type: text/plain; charset = utf-8 \r \n";
        }
        
        if (@mail ($this->email, $this->asunto, $this->mensaje, $this->headers)) {
            echo "Su correo se envió";
        }
        else {
            echo "Error al enviar correo";
        }
    }

    public function encriptar($enc){
        $this->objetoConexion->conectar();
        $pass = password_hash($enc, PASSWORD_DEFAULT);
        $this->contrasena=$pass;
        return $this->contrasena;
        $this->objetoConexion->desconectar();
    }

    public function verificar($user,$pass){
        try {   
            $this->objetoConexion->conectar();
            //Recogemos todas las filas con las columnas user y password y las almacenamos en el array $rw
            $rw = $this->objetoConexion->consultar("SELECT user, password FROM usuarios");
            if(count($rw)) {
                //Recorremos todas las filas del array
                for ($i=0;$i<count($rw);$i++) {
                    /*Si el usuario introducido coincide con uno almacenado en la base de datos y la función password_verify confirma 
                    que la contraseña introducida coincide con el hash de la almacenada, la función devuelve true para que el usuario pueda loguear*/
                    if ($rw[$i]['user'] == $user && password_verify($pass,$rw[$i]['password'])) {
                        echo "Contraseña correcta";
                        return true;
                        break;
                    }
                }
            }
            $this->objetoConexion->desconectar();
        }
        catch (PDOException $ex) {
            throw $ex;
        }
    }
}


?>