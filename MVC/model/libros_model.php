<?php

function getConnection()
{
    $user = 'root';
    $pwd = 'contraseñaForoMotos';
    return new PDO('mysql:host=localhost;dbname=ejemplo9', $user, $pwd);
}

function getLibros()
{
    echo "NO conectado";
    $db = getConnection();
    echo "conectado";
    $result = $db->query('SELECT titulo, precio FROM libros');
    $libros = array();
    while ($libro = $result->fetch())
        $libros[] = $libro;
    return $libros;
}

function getLibro($id)
{
    $db = getConnection();
    $query = 'SELECT * FROM libros WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->execute(array($id));
    $libro = $stmt->fetch();
    return $libro;
}