<?php

require_once 'Usuario.php';

//_id,
//Nombre_Usuario, 
//Correo_Electronico,
//Telefono_Usuario,
//Direccion_Usuario,
//Contrasena_Usuario,
//Rol_Usuario


class UsuarioDao{
    public function GetAll(){
        include 'conexion.php';
        $result = array();
        $sentencia=$conexion->query("SELECT * FROM usuario order by Nombre_Usuario asc");
        while($Res_sentencia = mysqli_fetch_array($sentencia)){
            $usuarios = new Usuario($Res_sentencia['_id'],$Res_sentencia['Nombre_Usuario'],$Res_sentencia['Correo_Electronico'],
            $Res_sentencia['Telefono_Usuario'],$Res_sentencia['Direccion_Usuario'],$Res_sentencia['Contrasena_Usuario'],$Res_sentencia['Rol_Usuario']);
            $result[] = $usuarios;
        }
        $sentencia->close();
        $conexion->close(); 
        return $result;
    }

    public function GetById($id){
        include 'conexion.php';
        $sentencia=$conexion->query("SELECT * FROM usuario where _id = '$id' limit 1");
        while($Res_sentencia = mysqli_fetch_array($sentencia)){
            return new Usuario($Res_sentencia['_id'],$Res_sentencia['Nombre_Usuario'],$Res_sentencia['Correo_Electronico'],
            $Res_sentencia['Telefono_Usuario'],$Res_sentencia['Direccion_Usuario'],$Res_sentencia['Contrasena_Usuario'],$Res_sentencia['Rol_Usuario']);
        }
        $sentencia->close();
        $conexion->close(); 
    }

    public function GetExistUser($email){
        include 'conexion.php';
        $sentencia=$conexion->query("SELECT * FROM usuario where Correo_Electronico = '$email' limit 1");
        while($Res_sentencia = mysqli_fetch_array($sentencia)){
            return new Usuario($Res_sentencia['_id'],$Res_sentencia['Nombre_Usuario'],$Res_sentencia['Correo_Electronico'],
            $Res_sentencia['Telefono_Usuario'],$Res_sentencia['Direccion_Usuario'],$Res_sentencia['Contrasena_Usuario'],$Res_sentencia['Rol_Usuario']);
        }
        $sentencia->close();
        $conexion->close(); 
    }

    public function CreateUser(Usuario $usuario){
        include 'conexion.php';
        $consulta = "INSERT INTO usuario(Nombre_Usuario, Correo_Electronico, Telefono_Usuario, Direccion_Usuario, Contrasena_Usuario, Rol_Usuario) VALUES ('{$usuario->getNombre()}',
        '{$usuario->getCorreo()}', '{$usuario->getTelefono()}', '{$usuario->getDireccion()}', '{$usuario->getPassword()}', '{$usuario->getRol()}')";
        $sentencia=$conexion->query($consulta);

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }

    public function DeleteUser($id){
        include 'conexion.php';
        $sentencia=$conexion->query("DELETE FROM usuario WHERE _id = '$id'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }

    public function UpdateUser(Usuario $usuario){
        include 'conexion.php';
        
        $sentencia=$conexion->query("UPDATE usuario SET Nombre_Usuario = '{$usuario->getNombre()}', Correo_Electronico ='{$usuario->getCorreo()}', Telefono_Usuario = '{$usuario->getTelefono()}',
        Direccion_Usuario ='{$usuario->getDireccion()}', Contrasena_Usuario = '{$usuario->getPassword()}', Rol_Usuario = '{$usuario->getRol()}' WHERE _id = '{$usuario->getId()}'");

        //$sentencia->close();
        $conexion->close(); 

        return $sentencia == 1;
    }
}