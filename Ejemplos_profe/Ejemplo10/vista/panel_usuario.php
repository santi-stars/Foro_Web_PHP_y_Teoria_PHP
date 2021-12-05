<?php session_start();

if(!isset($_SESSION["USUARIO"])){
   header("Location:login.php");
}else {?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio PHP - MySQL</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <header>
        <h1>PHP MYSQL</h1>
        <nav>
            <label for="check-menu">
                <input id="check-menu" type="checkbox">
                <div class="btn-menu">Menú</div>
                <ul class="ul-menu">
                    <li><a href="?cerrar">Cerrar Sesión</a></li>
                </ul>
            </label>
        </nav>
    </header>
    <section id="formaulario">
        <div id="recuadro">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php require_once("../controlador/usuarios_controlador.php");?> 

                
                <?php if(isset($_GET["cambiapass"])){ ?>
                <h2 class="title-form">Cambiar Contraseña</h2>
                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="no puedes cambiar el usuario">
                    <label class="label-user-form" id="label-form" for="usuario">Nombre de usuario</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña actual" autofocus>
                    <label class="label-user-form" id="label-form" for="password">Contraseña actual</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2" name="password2" placeholder="Contraseña nueva">
                    <label class="label-user-form" id="label-form" for="password2">Contraseña nueva</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2confirma" name="password2confirma" placeholder="Confirmar contraseña nueva">
                    <label class="label-user-form" id="label-form" for="password2confirma">Confirmar contraseña nueva</label>
                </div>
                <div class="btn-datos">
                    <input type="submit" id="cambiapass" name="cambiapass" value="Cambiar">
                    <input type="submit" id="cancelarpass" name="cancelarpass" value="Cancelar"></div>
                </div>
                <?php 
                    }elseif(isset($_GET["eliminar"])){ ?>
                <h2 class="title-form">Eliminar Cuenta</h2>
                <p class="warning-form">Estás por eliminar tu cuenta de usuario. Esta acción no puede deshacerse.</p>
                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="no puedes cambiar el usuario">
                    <label class="label-user-form" id="label-form" for="usuario">Nombre de usuario</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña" autofocus>
                    <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2" name="password2" placeholder="Confirmar contraseña">
                    <label class="label-user-form" id="label-form" for="password2">Confirmar contraseña</label>
                </div>
                
                <div class="btn-datos"><input type="submit" id="confirmareliminar" name="confirmareliminar" value="Confirmar">
                <input type="submit" id="cancelareliminar" name="cancelareliminar" value="Cancelar"></div>
                
                <?php }else{ ?>
                
                <h2 class="title-form">Mis Datos</h2>

                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="no puedes cambiar el usuario">
                    <label class="label-user-form" id="label-form" for="usuario">Nombre de usuario</label>
                </div>
                <div class="div-input">
                    <input type="text" class="user-form" id="nombre" name="nombre" placeholder="Nombre" <?php echo (isset($_SESSION["NOMBRE"]) ? 'value="'.$_SESSION["NOMBRE"].'"' : ''); echo (($campo == 'nombre' || $campo == null) ? 'autofocus':''); ?>>
                    <label class="label-user-form" id="label-form" for="nombre">Nombre</label>
                </div>
                <div class="div-input">
                    <input type="text" class="user-form" id="apellido" name="apellido" placeholder="Apellido" <?php echo (isset($_SESSION["APELLIDO"]) ? 'value="'.$_SESSION["APELLIDO"].'"' : ''); echo ( $campo == 'apellido' ? 'autofocus':''); ?>>
                    <label class="label-user-form" id="label-form" for="apellido">Apellido</label>
                </div>
                <div class="div-input">
                    <input type="text" class="user-form" id="email" name="email" placeholder="Email" <?php echo (isset($_SESSION["EMAIL"]) ? 'value="'.$_SESSION["EMAIL"].'"' : ''); echo ( $campo == 'email' ? 'autofocus':''); ?>>
                    <label class="label-user-form" id="label-form" for="email">Email</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña" <?php echo (isset($_SESSION["PASSWORD"]) ? 'value="'.$_SESSION["PASSWORD"].'"' : ''); echo ($campo == 'password' ? 'autofocus':''); ?>>
                    <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">
                    <label class="label-user-form" id="label-form" for="usuario">Confirmar contraseña</label>
                </div>
                <div>
                    <p><small><a class="log-reg" href="<?php echo $_SERVER['PHP_SELF']."?cambiapass"; ?>">Cambiar contraseña.</a></small></p>
                </div>
                <div class="btn-datos"><input type="submit" id="modificar" name="modificar" value="Modificar">
                <input type="submit" name="eliminar" value="Eliminar Cuenta"></div>
                <?php } ?>

            </form>
        </div>
    </section>
</body>

</html>
<?php } ?>
