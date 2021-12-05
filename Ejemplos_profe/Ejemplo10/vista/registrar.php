
<section id="formaulario">
    <div id="recuadro">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <?php require_once("../controlador/usuarios_controlador.php"); ?>

            <h2 class="title-form">Registrar</h2>
            <div class="div-input">
                <input type="text" class="user-form" name="usuario" id="usuario" <?php echo (isset($alias) ? 'value="'.$alias.'"' : ''); echo (($campo == 'usuario' || $campo == null) ? 'autofocus':''); ?> placeholder="Nombre de usuario">
                <label id="label-form" for="usuario">Nombre de usuario</label>

            </div>
            <div class="div-input">
                <input type="text" class="user-form" name="nombre" id="nombre" <?php echo (isset($nombre) ? 'value="'.$nombre.'"' : ''); echo ( $campo == 'nombre' ? 'autofocus':''); ?> placeholder="Nombre">
                <label class="label-user-form" id="label-form" for="nombre">Nombre</label>

            </div>
            <div class="div-input">
                <input type="text" class="user-form" name="apellido" <?php echo (isset($apellido) ? 'value="'.$apellido.'"' : ''); echo ( $campo == 'apellido' ? 'autofocus':''); ?> placeholder="Apellido">
                <label class="label-user-form" id="label-form" for="nombre">Apellido</label>
            </div>

            <div class="div-input">
                <input type="text" class="user-form" name="email" <?php echo (isset($email) ? 'value="'.$email.'"' : ''); echo ( $campo == 'email' ? 'autofocus':''); ?> placeholder="Email">
                <label class="label-user-form" id="label-form" for="nombre">Email</label>
            </div>

            <div class="div-input">
                <input type="password" class="user-form" name="password" <?php echo ( $campo == ('password'||'password2') ? 'autofocus':''); ?> placeholder="Contraseña">
                <label class="label-user-form" id="label-form" for="nombre">Contraseña</label>
            </div>
            <div class="div-input">
                <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">
                <label class="label-user-form" id="label-form" for="nombre">Confirmar contraseña</label>
            </div>
            <input type="submit" name="registrar" value="Registrar">
        </form>
        <p class="p-registrar-login">Tienes una cuenta? <a class="log-reg" href="login.php">Iniciar sesión</a></p>
    </div>
</section>
