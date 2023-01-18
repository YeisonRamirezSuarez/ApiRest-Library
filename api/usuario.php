<?php

header('Content-Type: application/json');
require_once '../model/UsuarioDao.php';

$method = $_SERVER['REQUEST_METHOD'];

$id = $_REQUEST['id'] ?? null;
$correo = $_REQUEST['email'] ?? null;
$update = $_REQUEST['update'] ?? null;
$delete = $_REQUEST['delete'] ?? null;


if ($method == 'GET' && !$id && !$correo) index();

if ($method == 'GET' && $id) showById($id);

if ($method == 'GET' && $correo) showByEmailUser($correo);

if ($method == 'POST' && !$id && !$correo) Create();

if ($method == 'POST' && $delete && $id) Delete($id);

if ($method == 'POST' && $update && $id) Update();

//_id,
//Nombre_Usuario, 
//Correo_Electronico,
//Telefono_Usuario,
//Direccion_Usuario,
//Contrasena_Usuario,
//Rol_Usuario

function index()
{
    $dao = new UsuarioDao();
    $usuarios = $dao->GetAll();
    foreach ($usuarios as $usuario) {
        $result[] = [
            'id' => $usuario->getId(),
            'name' => $usuario->getNombre(),
            'email' => $usuario->getCorreo(),
            'phone' => $usuario->getTelefono(),
            'address' => $usuario->getDireccion(),
            'password' => $usuario->getPassword(),
            'rol' => $usuario->getRol()
        ];
    }
    echo json_encode($result);
    exit;
}

function showById($id)
{
    $dao = new UsuarioDao();
    $usuario = $dao->GetById($id);
    if ($usuario) {
        echo json_encode([
            'id' => $usuario->getId(),
            'name' => $usuario->getNombre(),
            'email' => $usuario->getCorreo(),
            'phone' => $usuario->getTelefono(),
            'address' => $usuario->getDireccion(),
            'password' => $usuario->getPassword(),
            'rol' => $usuario->getRol()
        ]);

        http_response_code(201);
        exit;
    }
    echo json_encode(['error' => 'La persona a consultar no se encuentra en la base de datos.']);
    http_response_code(404);
    exit;
}

function showByEmailUser($correo)
{
    $dao = new UsuarioDao();
    $usuario = $dao->GetExistUser($correo);
    if ($usuario) {
        echo json_encode([
            'id' => $usuario->getId(),
            'name' => $usuario->getNombre(),
            'email' => $usuario->getCorreo(),
            'phone' => $usuario->getTelefono(),
            'address' => $usuario->getDireccion(),
            'password' => $usuario->getPassword(),
            'rol' => $usuario->getRol()
        ]);

        http_response_code(201);
        exit;
    }
    echo json_encode(['error' => 'La persona a consultar no se encuentra en la base de datos.']);
    http_response_code(404);
    exit;
}

//"name",
//"email",
//"phone"",
//"address"",
//"password",
//"rol"


function Create()
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new UsuarioDao();
    if (
        empty($data->name) || empty($data->email) || empty($data->phone) || empty($data->address)
        || empty($data->password) || empty($data->rol)
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'No se aceptan objetos incompletos.']);
    } else {
        $usuario = $dao->GetExistUser($data->email);
        if ($usuario) {
            http_response_code(400);
            echo json_encode(['error' => 'La persona ya se encuentra registrada en la base de datos.']);
            exit;
        }

        $usuario = new Usuario(null, $data->name, $data->email, $data->phone, $data->address, $data->password, $data->rol);
        if ($dao->CreateUser($usuario)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'La persona se registró correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error registrando en la base de datos.']);
        exit;
    }
}


function Delete($id)
{
    $dao = new UsuarioDao();
    $usuario = $dao->GetById($id);
    if ($usuario) {
        if($dao->DeleteUser($id)){
            http_response_code(201);
            echo json_encode(['mensaje' => 'La persona se eliminó correctamente.']);
            exit;
        }
    }else{
        http_response_code(400);
        echo json_encode(['error' => 'La persona no se encuentra registrada en la base de datos.']);
        exit;
    }

    http_response_code(500);
    echo json_encode(['error' => 'Error eliminación usuario en la base de datos.']);
    exit;
}


function Update(){
    $data = json_decode(file_get_contents('php://input'));
    $dao = new UsuarioDao();
    if (
        empty($data->name) || empty($data->email) || empty($data->phone) || empty($data->address)
        || empty($data->password) || empty($data->rol)
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'No se aceptan objetos incompletos.']);
        exit;
    } else {
        $usuario = $dao->GetExistUser($data->email);
      
        if ($usuario) {
            $id = $usuario->getId();
        }else{
            http_response_code(440);
            echo json_encode(['error' => 'Correo electronico no se puede modificar.']);
            //echo json_encode(['error' => 'No se encuentra informacion para actualizar.']);
            exit;
        }

        $usuario = new Usuario($id, $data->name, $data->email, $data->phone, $data->address, $data->password, $data->rol);
        if ($dao->UpdateUser($usuario)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'La persona se actualizó correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error registrando en la base de datos.']);
        exit;
    }
}
