<?php
	class Sesion {
		//Iniciamos la sesión
		function Sesion () {
			session_start();
		}

		//Método para registrar las variables de la sesión. Lo usaremos para guardar el nombre de usuario
		public function set($nombre,$valor) {
			$_SESSION[$nombre] = $valor;
		}

		//Recupera el valor del nombre de usuario
		public function get($user) {
			if (isset($_SESSION[$user])) {
				return $_SESSION[$user];
			} else {
				return false;
			}
		}

		//Borra la sesión y vuelve a la página inicial
		public function borrar_sesion() {
			$_SESSION = array();
			session_destroy();
			header("Location: index.php");
		}
	}
?>
