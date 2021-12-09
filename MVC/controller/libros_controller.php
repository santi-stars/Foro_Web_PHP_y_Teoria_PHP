<?php

function listar()
{
//Incluye el modelo que corresponde
    require 'C:\xampp\htdocs\Teoria\MVC\model\libros_model.php';
//Le pide al modelo todos los libros
    $libros = getLibros();
//Pasa a la vista toda la información que se desea representar
    include 'C:\xampp\htdocs\Teoria\MVC\view\libros_listar.php';
}

function ver()
{
    if (!isset ($_GET ['id']))
        die("No has especificado un identificador de libro.");
    $id = $_GET ['id'];
//Incluimos el modelo correspondiente
    require 'C:\xampp\htdocs\Teoria\MVC\model\libros_model.php';
//Le pide al modelo el libro con id = $id
    $libro = getLibro($id);
    if ($libro === null)
        die("Identificador de libro incorrecto");
//Pasamos a la vista toda la información que se desea representar
    include 'C:\xampp\htdocs\Teoria\MVC\view\libros_listar.php';
}