<?php

header('Content-Type: application/json');
require_once '../model/UsuarioDao.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') validarUser();

function validarUser()
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new UsuarioDao();
    
    if (
        empty($data->email) || empty($data->password)
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'No se aceptan objetos incompletos.']);
        exit;
    } else {

        $usuario = new Usuario(null, null, $data->email, null, null, $data->password, null);
        $login = $dao->Login($usuario);

        if ($login) {
            //$result = ['data' => []];
            foreach ($login as $usuario) {
                $result = [
                    'rol' => $usuario->getRol()
                ];
            }

            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(['rol' => 'No se encontro al usuario.']);
        }
       
        exit;
    }
}