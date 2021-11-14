<?php
echo " ";
session_start();
?>
<html>
<head><title>Crear sesión</title></head>
<body>
<?php
echo "El identificador de la sesión es: " . session_id() .
    "<br>";
?>
</body>
</html>
