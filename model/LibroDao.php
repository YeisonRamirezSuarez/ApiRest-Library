<?php

require_once 'Libro.php';

//_id
//Titulo_libro
//Autor_libro
//Cantidad_libro
//Url_libro
//Imagen_libro
//Descripcion_libro


class LibroDao
{
    public function GetAll()
    {
        include 'conexion.php';
        $result = array();
        $sentencia = $conexion->query("SELECT * FROM libros order by Titulo_libro asc");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            $libro = new Libro(
                $Res_sentencia['_id'],
                $Res_sentencia['Titulo_libro'],
                $Res_sentencia['Autor_libro'],
                $Res_sentencia['Cantidad_libro'],
                $Res_sentencia['Url_libro'],
                $Res_sentencia['Imagen_libro'],
                $Res_sentencia['Descripcion_libro']
            );
            $result[] = $libro;
        }
        $sentencia->close();
        $conexion->close();
        return $result;
    }

    public function GetById($id)
    {
        include 'conexion.php';
        $sentencia = $conexion->query("SELECT * FROM libros where _id = '$id' limit 1");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            return new Libro(
                $Res_sentencia['_id'],
                $Res_sentencia['Titulo_libro'],
                $Res_sentencia['Autor_libro'],
                $Res_sentencia['Cantidad_libro'],
                $Res_sentencia['Url_libro'],
                $Res_sentencia['Imagen_libro'],
                $Res_sentencia['Descripcion_libro']
            );

            $sentencia->close();
            $conexion->close();
        }
    }

    public function GetExistLibro($titulo)
    {
        include 'conexion.php';
        $sentencia = $conexion->query("SELECT * FROM libros where Titulo_libro = '$titulo' limit 1");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            return new Libro(
                $Res_sentencia['_id'],
                $Res_sentencia['Titulo_libro'],
                $Res_sentencia['Autor_libro'],
                $Res_sentencia['Cantidad_libro'],
                $Res_sentencia['Url_libro'],
                $Res_sentencia['Imagen_libro'],
                $Res_sentencia['Descripcion_libro']
            );
        }
        $sentencia->close();
        $conexion->close();
    }

    public function CreateLibro(Libro $libro)
    {
        include 'conexion.php';
        $consulta = "INSERT INTO libros(Titulo_libro, Autor_libro, Cantidad_libro, Url_libro, Imagen_libro, Descripcion_libro) VALUES ('{$libro->getTitulo()}',
        '{$libro->getAutor()}', '{$libro->getCantidad()}', '{$libro->getUrlLibro()}', '{$libro->getUrlImg()}', '{$libro->getDescripcion()}')";
        $sentencia = $conexion->query($consulta);

        //$sentencia->close();
        $conexion->close();

        return $sentencia == 1;
    }

    public function DeleteLibro($id){
        include 'conexion.php';
        $sentencia=$conexion->query("DELETE FROM libros WHERE _id = '$id'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }

    public function UpdateLibro(Libro $libro){
        include 'conexion.php';
        
        $sentencia=$conexion->query("UPDATE libros SET Titulo_libro = '{$libro->getTitulo()}', Autor_libro ='{$libro->getAutor()}', Cantidad_libro = '{$libro->getCantidad()}',
        Url_libro ='{$libro->getUrlLibro()}', Imagen_libro = '{$libro->getUrlImg()}', Descripcion_libro = '{$libro->getDescripcion()}' WHERE _id = '{$libro->getId()}'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }
}