<?php 

    require_once("conexion/conexion.php");
    class Usuarios_modelo{
        public $alias;
        public $nombre;
        public $apellido;
        public $email;
            
        /** 
        * __construct
        * function($alias, $nombre, $apellido, $email) 
        * Constructor del objeto Usuarios_modelo  
        *
        * usuarios_modelo.php
        *
        * @param String $alias
        * @param String $nombre
        * @param String $apellido
        * @param String $email
        */
        function __construct($alias,$nombre, $apellido, $email){ 
            
            $this->alias = $alias;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->email = $email; 
        }
        
        /** 
        * function
        * get_usuario($alias, $password) 
        * Devuelve Boolean o String en caso de error
        *
        * usuarios_modelo.php
        *
        * @param String $alias
        * @param String $password
        * @return Usuarios_modelo
        */
        public static function get_usuario($alias, $password){
            try{
                $password = self::cryptconmd5($password);
                $conexion = Conexion::Conexion();
                
                //Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
                if(gettype($conexion) == "string"){
                    return $conexion;
                }
                
                $sql = "SELECT USUARIO, NOMBRE, APELLIDO, EMAIL FROM USUARIOS WHERE USUARIO=:usuario AND PASSWORD=:password";
                $respuesta = $conexion->prepare($sql);
                $respuesta->execute(array(':usuario'=>$alias, ':password'=>$password));
                $respuesta = $respuesta->fetch(PDO::FETCH_ASSOC);
                
                // Si el array no está vacío, crea y devuelve un objeto Usuario.
                if($respuesta){
                    $usuario = new Usuarios_modelo($respuesta["USUARIO"], $respuesta["NOMBRE"], $respuesta["APELLIDO"], $respuesta["EMAIL"]); 
                    return $usuario;
                }else{
                    return $usuario = null;
                }
                $respuesta->closeCursor();
                $conexion = null;
                
            }catch(PDOException $e){
                return Conexion::mensajes($e->getCode());
            }
        }
        
        /** 
        * function
        * registrar($usuario, $password) 
        * Devuelve Boolean o String en caso de error
        *
        * usuarios_modelo.php
        *
        * @param Object $usuario
        * @param String $password
        * @return Boolean
        */
        public static function registrar($usuario, $password){
            try{
                $password = self::cryptconmd5($password);
                $conexion = Conexion::Conexion();
                if(gettype($conexion) == "string"){
                    return $conexion;
                }
                
                $sql = "INSERT INTO USUARIOS (USUARIO, NOMBRE, APELLIDO, EMAIL, PASSWORD) VALUES (:USU, :NOM, :APE, :EMAIL, :PASS)";
                $respuesta = $conexion->prepare($sql); 
                $respuesta = $respuesta->execute(array(":USU"=>$usuario->alias, ":NOM"=>$usuario->nombre, ":APE"=>$usuario->apellido, ":EMAIL"=>$usuario->email, ":PASS"=>$password));
                return $respuesta;
                
                $respuesta->closeCursor();
                $conexion = null;
                
            }catch(PDOException $e){
                return Conexion::mensajes($e->getCode());
            }
        }
        
        /** 
        * function
        * actualizar($usuario, $password) 
        * Devuelve Integer o String en caso de error  
        * 
        * usuarios_modelo.php
        *
        * @param Object $usuario
        * @param String $password
        * @return Integer
        */
        public static function actualizar($usuario, $password){
            try{
                $password = self::cryptconmd5($password);
                $sql= 'UPDATE USUARIOS SET NOMBRE=:NOM, APELLIDO=:APE, EMAIL=:EMAIL WHERE USUARIO=:USU AND PASSWORD=:PASS';
                $conexion = Conexion::Conexion();
                if(gettype($conexion) == "string"){
                    return $conexion;
                }
                $conexion =$conexion->prepare($sql);
                $conexion->execute(array(":NOM"=>$usuario->nombre, ":APE"=>$usuario->apellido, ":EMAIL"=>$usuario->email, ":USU"=>$usuario->alias, ":PASS"=>$password));
                return $respuesta = $conexion->rowCount();
                
                $respuesta->closeCursor();
                $conexion = null;
                
            }catch(PDOException $e){
                return Conexion::mensajes($e->getCode());
            }
            
        }
        
        /** 
        * function
        * cambiapass($alias, $password_actual, $password_nuevo) 
        * Devuelve Integer o String en caso de error  
        * 
        * usuarios_modelo.php
        *
        * @param String $alias
        * @param String $password_actual
        * @param String $password_nuevo
        * @return Integer
        */
        public static function cambiapass($alias, $password_actual, $password_nuevo){
            
            try{
                $password_nuevo = self::cryptconmd5($password_nuevo);
                $usuario = self::get_usuario($alias, $password_actual);

                if(gettype($usuario) == "string"){
                    return $usuario;
                }elseif($usuario == null){
                    return '<p class="error-form">Contraseña incorrecta. No se a cambiado su clave de usuario</p>';
                }
                $sql= 'UPDATE USUARIOS SET PASSWORD=:PASSNUEVO WHERE USUARIO=:USU AND PASSWORD=:PASS';
                $conexion = Conexion::Conexion();
                if(gettype($conexion) == "string"){
                    return $conexion;
                }
                $conexion =$conexion->prepare($sql);
                $password_actual = self::cryptconmd5($password_actual);  
                $conexion->execute(array(":PASSNUEVO"=>$password_nuevo,":USU"=>$usuario->alias, ":PASS"=>$password_actual));
                
                return $respuesta = $conexion->rowCount();
                
                $respuesta->closeCursor();
                $conexion = null;
                
            }catch(PDOException $e){
                return Conexion::mensajes($e->getCode());
            }
            
        }
        
        /** 
        * function
        * eliminar($alias, $password) 
        * Devuelve Integer o String en caso de error  
        * 
        * usuarios_modelo.php
        *
        * @param String $alias
        * @param String $password
        * @return Integer
        */
        public static function eliminar($alias, $password){
            try{
                $password = self::cryptconmd5($password);
                $sql= 'DELETE FROM USUARIOS WHERE USUARIO=:USU AND PASSWORD=:PASS';
                $conexion = Conexion::Conexion()->prepare($sql);
                $conexion->execute(array(":USU"=>$alias, ":PASS"=>$password));
                
                return $respuesta = $conexion->rowCount();
      
                $respuesta->closeCursor();
                $conexion = null;
            }catch(PDOException $e){
                return Conexion::mensajes($e->getCode());
            }
        }
        
        /**
        * function
        * cryptconmd5($password) 
        * Devuelve clave encriptada  
        * 
        * usuarios_modelo.php
        *
        * @param String $password
        * @return String
        */
        public static function cryptconmd5($password) {
            //Crea un salt 
            $salt = md5($password."%*4!#$;.k~’(_@"); 
            $password = md5($salt.$password.$salt);  
            return $password;
        }   
        
    }//end clase


?>