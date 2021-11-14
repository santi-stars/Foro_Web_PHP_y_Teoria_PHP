<?php // ABRIR Fichero
// fopen(string $filename , string $mode [, bool $use_include_path = false ] );

// $filename: el fichero a abrir y será la ruta del archivo
// $mode: será modo de apertura; r,r+,w,w+,a,a+,x,x+,c o c+.
// $use_include_path: (opcional) puede ser establecido a ‘1’ o TRUE, si se desea buscar un archivo en include_pat
// para Windows la ruta por defecto es include_path=".;c:\php\includes"

$fichero = @fopen("contador.txt", "r") or die("El fichero no ha podido ser abierto");

$fichero = @fopen("contad2or.txt", "w"); //si el fichero no existe, lo intenta crear