<?php
function tabla(int $i)
{
    echo "<p>Tabla de multiplicar del $i</p>";
    for ($j = 1; $j < 10; $j++) {
        echo $i . " X " . $j . " = " . $i * $j . "<br>";
    }
}

?>