<?php
// Propagación automática---------------------------------
ini_set("session.use_only_cookies","0");    // Esto se pone al principio del archivo para que no dé ERROR
ini_set("session.use_trans_sid","1");       //  "   "   "   "
// --------------------------------------------------------
session_start();
$_SESSION["nombre"] = "Silvia Ruiz";
$_SESSION["edad"] = 32;
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
} else {
    $_SESSION['contador']++;
}
// Propagación por URL------------------------------------
// $id_sesion = SID;
// echo "<a href=\"4.4.4.1 Ver sesion pasada por URL o AUTO.php?$id_sesion\">Pasar variables</ a>";
// --------------------------------------------------------

// Propagación automática---------------------------------
echo "<a href=\"4.4.4.1 Ver sesion pasada por URL o AUTO.php\">Pasar variables</ a>";
// --------------------------------------------------------