<?php

require_once 'Libro.php';
require_once 'LibroPrestado.php';


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

    public function GetByEmail($email)
    {
        include 'conexion.php';
        $result = array();
        $sentencia = $conexion->query("SELECT * FROM libros_prestados where Correo_Prestamo_libro = '$email'");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            $libro = new LibroPrestado(
                $Res_sentencia['_id'],
                $Res_sentencia['_id_Libro'],
                $Res_sentencia['Titulo_libro_Prestado'],
                $Res_sentencia['Autor_libro_Prestado'],
                $Res_sentencia['Url_libro_Prestado'],
                $Res_sentencia['Imagen_libro_Prestado'],
                $Res_sentencia['Descripcion_libro_Prestado'],
                $Res_sentencia['Fecha_Prestamo_libro'],
                $Res_sentencia['Correo_Prestamo_libro'],
                $Res_sentencia['Nombre_Usuario_Prestamo_libro'],
                $Res_sentencia['Telefono_Usuario_Prestamo_libro']
            );
            $result[] = $libro;
        }

        $sentencia->close();
        $conexion->close();
        return $result;
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

    public function DeleteLibroPres($id){
        include 'conexion.php';
        $sentencia=$conexion->query("DELETE FROM libros_prestados WHERE _id_Libro = '$id'");

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

    public function UpdateLibroPres(Libro $libro){
        include 'conexion.php';
        
        $sentencia=$conexion->query("UPDATE libros_prestados SET Titulo_libro_Prestado = '{$libro->getTitulo()}', Autor_libro_Prestado ='{$libro->getAutor()}', Url_libro_Prestado = '{$libro->getUrlLibro()}',
        Imagen_libro_Prestado = '{$libro->getUrlImg()}', Descripcion_libro_Prestado = '{$libro->getDescripcion()}' WHERE _id_Libro = '{$libro->getId()}'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }	
    //_id
    //_id_Libro
    //Titulo_libro_Prestado
    //Autor_libro_Prestado
    //Url_libro_Prestado
    //Imagen_libro_Prestado
    //Descripcion_libro_Prestado
    //Fecha_Prestamo_libro
    //Correo_Prestamo_libro
    //Nombre_Usuario_Prestamo_libro
    //Telefono_Usuario_Prestamo_libro
    public function GetLibroPrestadoDisponible()
    {
        include 'conexion.php';
        $result = array();
        $sentencia = $conexion->query("SELECT * FROM libros_prestados GROUP BY _id_Libro");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            $libro = new LibroPrestado(
                $Res_sentencia['_id'],
                $Res_sentencia['_id_Libro'],
                $Res_sentencia['Titulo_libro_Prestado'],
                $Res_sentencia['Autor_libro_Prestado'],
                $Res_sentencia['Url_libro_Prestado'],
                $Res_sentencia['Imagen_libro_Prestado'],
                $Res_sentencia['Descripcion_libro_Prestado'],
                $Res_sentencia['Fecha_Prestamo_libro'],
                $Res_sentencia['Correo_Prestamo_libro'],
                $Res_sentencia['Nombre_Usuario_Prestamo_libro'],
                $Res_sentencia['Telefono_Usuario_Prestamo_libro']
            );
            $result[] = $libro;
        }
        $sentencia->close();
        $conexion->close();
        return $result;
    }

    public function GetLibroPrestadoGetById($id)
    {
        include 'conexion.php';
        $result = array();
        $sentencia = $conexion->query("SELECT Nombre_Usuario_Prestamo_libro, Correo_Prestamo_libro, Telefono_Usuario_Prestamo_libro FROM libros_prestados WHERE _id_Libro = '$id'");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            $libro = new LibroPrestado(
                $Res_sentencia['_id'],
                $Res_sentencia['_id_Libro'],
                $Res_sentencia['Titulo_libro_Prestado'],
                $Res_sentencia['Autor_libro_Prestado'],
                $Res_sentencia['Url_libro_Prestado'],
                $Res_sentencia['Imagen_libro_Prestado'],
                $Res_sentencia['Descripcion_libro_Prestado'],
                $Res_sentencia['Fecha_Prestamo_libro'],
                $Res_sentencia['Correo_Prestamo_libro'],
                $Res_sentencia['Nombre_Usuario_Prestamo_libro'],
                $Res_sentencia['Telefono_Usuario_Prestamo_libro']
            );
            $result[] = $libro;
        }
        $sentencia->close();
        $conexion->close();
        return $result;
    }

    public function GetLibroPrestado()
    {
        include 'conexion.php';
        $result = array();
        $sentencia = $conexion->query("SELECT Nombre_Usuario_Prestamo_libro, Correo_Prestamo_libro, Telefono_Usuario_Prestamo_libro FROM libros_prestados WHERE _id_Libro = '$id'");
        while ($Res_sentencia = mysqli_fetch_array($sentencia)) {
            $libro = new LibroPrestado(
                $Res_sentencia['_id'],
                $Res_sentencia['_id_Libro'],
                $Res_sentencia['Titulo_libro_Prestado'],
                $Res_sentencia['Autor_libro_Prestado'],
                $Res_sentencia['Url_libro_Prestado'],
                $Res_sentencia['Imagen_libro_Prestado'],
                $Res_sentencia['Descripcion_libro_Prestado'],
                $Res_sentencia['Fecha_Prestamo_libro'],
                $Res_sentencia['Correo_Prestamo_libro'],
                $Res_sentencia['Nombre_Usuario_Prestamo_libro'],
                $Res_sentencia['Telefono_Usuario_Prestamo_libro']
            );
            $result[] = $libro;
        }
        $sentencia->close();
        $conexion->close();
        return $result;
    }
	
    //_id
    //_id_Libro
    //Titulo_libro_Prestado
    //Autor_libro_Prestado
    //Url_libro_Prestado
    //Imagen_libro_Prestado
    //Descripcion_libro_Prestado
    //Fecha_Prestamo_libro
    //Correo_Prestamo_libro
    //Nombre_Usuario_Prestamo_libro
    //Telefono_Usuario_Prestamo_libro
    public function PrestarLibro(LibroPrestado $libro)
    {
        include 'conexion.php';
        $consulta = "INSERT INTO libros_prestados(_id_Libro, Titulo_libro_Prestado, Autor_libro_Prestado, Url_libro_Prestado,
         Imagen_libro_Prestado, Descripcion_libro_Prestado, Fecha_Prestamo_libro, Correo_Prestamo_libro,
         Nombre_Usuario_Prestamo_libro, Telefono_Usuario_Prestamo_libro) VALUES ('{$libro->getIdLibro()}',
        '{$libro->getTitulo()}', '{$libro->getAutor()}', '{$libro->getUrlLibro()}', '{$libro->getUrlImg()}', '{$libro->getDescripcion()}', 
        '{$libro->getFecha()}', '{$libro->getCorreoUser()}', '{$libro->getNombreUser()}', '{$libro->getTelefonoUser()}')";
        $sentencia = $conexion->query($consulta);

        //$sentencia->close();
        $conexion->close();

        return $sentencia == 1;
    }

    public function UpdateCantidades($id, $cantidad){
        include 'conexion.php';
        
        $sentencia=$conexion->query("UPDATE libros SET Cantidad_libro = '$cantidad' WHERE _id = '$id'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }
}