<?php
session_start();
$_SESSION["nombre"] = "Silvia Ruiz";
$_SESSION["edad"] = 32;
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
} else {
    $_SESSION['contador']++;
}
// Propagación por URL
$id_sesion = SID;
echo "<a href=\"4.4.4.1 Ver variables pasadas por URL.php?$id_sesion\">Pasar variables</ a>";

// Propagación automática   DA ERROR?¿?¿?¿
// ini_set("session.use_only_cookies","0");
// ini_set("session.use_trans_sid","1");
// echo "<a href=\"4.4.4.1 Ver variables pasadas por URL.php\">Pasar variables</a>";