<?php

header('Content-Type: application/json');
require_once '../model/LibroDao.php';

$methods = $_SERVER['REQUEST_METHOD'];

$id = $_REQUEST['id'] ?? null;
$email = $_REQUEST['email'] ?? null;
$update = $_REQUEST['update'] ?? null;
$prestado = $_REQUEST['prestado'] ?? null;
$delete = $_REQUEST['delete'] ?? null;
$delete_prestado = $_REQUEST['delete_prestado'] ?? null;

if ($methods == 'GET' && !$id && !$email) index();

if ($methods == 'GET' && $id) showById($id);

if ($methods == 'GET' && $email) showByEmail($email);

if ($methods == 'POST' && !$id  && !$delete && !$prestado && !$update) CreateLibro();

if ($methods == 'POST' && $delete && $id) DeleteLibro($id);

if ($methods == 'POST' && $delete_prestado && $id) DeleteLibroPrestado($id);

if ($methods == 'POST' && $update && $id) UpdateLibro($id);

if ($methods == 'POST' && $prestado && $id) UpdateLibroPrestado($id);



//_id
//Titulo_libro
//Autor_libro
//Cantidad_libro
//Url_libro
//Imagen_libro
//Descripcion_libro

function index()
{
    $dao = new LibroDao();
    $libros = $dao->GetAll();
    $result = ["data" => []];
    foreach ($libros as $libro) {
        array_push($result["data"], [
            'id' => $libro->getId(),
            'title' => $libro->getTitulo(),
            'author' => $libro->getAutor(),
            'quantity' => $libro->getCantidad(),
            'book_url' => $libro->getUrlLibro(),
            'image_url' => $libro->getUrlImg(),
            'description' => $libro->getDescripcion()
        ]);
    }
    echo json_encode($result);
    exit;
}

function showById($id)
{
    $dao = new LibroDao();
    $libro = $dao->GetById($id);
    $result = ["data" => []];
    if ($libro) {
        array_push($result["data"], [
            'id' => $libro->getId(),
            'title' => $libro->getTitulo(),
            'author' => $libro->getAutor(),
            'quantity' => $libro->getCantidad(),
            'book_url' => $libro->getUrlLibro(),
            'image_url' => $libro->getUrlImg(),
            'description' => $libro->getDescripcion()
        ]);
        echo json_encode($result);

        http_response_code(201);
        exit;
    }
    echo json_encode(['mensaje' => 'El libro a consultar no se encuentra en la base de datos.']);
    http_response_code(404);
    exit;
}

function showByEmail($email)
{
    $dao = new LibroDao();
    $libros = $dao->GetByEmail($email);
    if ($libros) {
        $result = ["data" => []];
        foreach ($libros as $libro) {
            array_push($result["data"], [
                'id' => $libro->getId(),
                'id_book' => $libro->getIdLibro(),
                'title' => $libro->getTitulo(),
                'author' => $libro->getAutor(),
                'book_url' => $libro->getUrlLibro(),
                'image_url' => $libro->getUrlImg(),
                'description' => $libro->getDescripcion(),
                'date' => $libro->getFecha(),
                'email_user' => $libro->getCorreoUser(),
                'name_user' => $libro->getNombreUser(),
                'phone_user' => $libro->getTelefonoUser()
            ]);
        }
        echo json_encode($result);

        http_response_code(201);
        exit;
    } else {
        $result = ["data" => []];
        echo json_encode($result);

        http_response_code(201);
        exit;
    }
}

function CreateLibro()
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new LibroDao();
    if (
        empty($data->title) || empty($data->author) || empty($data->quantity) || empty($data->book_url)
        || empty($data->image_url) || empty($data->description)
    ) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'No se aceptan objetos incompletos.']);
    } else {
        $libro = $dao->GetExistLibro($data->title);
        if ($libro) {
            http_response_code(400);
            echo json_encode(['mensaje' => 'El libro ya se encuentra registrada en la base de datos.']);
            exit;
        }

        $libro = new Libro(null, $data->title, $data->author, $data->quantity, $data->book_url, $data->image_url, $data->description);
        if ($dao->CreateLibro($libro)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'El libro se registró correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['mensaje' => 'Error registrando en la base de datos.']);
        exit;
    }
}


function DeleteLibro($id)
{
    $dao = new LibroDao();
    $usuario = $dao->GetById($id);
    if ($usuario) {
        if ($dao->DeleteLibro($id)) {
            http_response_code(201);
            echo "El libro se eliminó correctamente.";
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['mensaje' => 'El libro no se encuentra registrada en la base de datos.']);
        exit;
    }

    http_response_code(500);
    echo json_encode(['mensaje' => 'Error eliminación usuario en la base de datos.']);
    exit;
}


function DeleteLibroPrestado($id)
{
    $dao = new LibroDao();

    if ($dao->DeleteLibroPres($id)) {
        http_response_code(201);
        echo "El libro se eliminó correctamente.";
        exit;
    }


    http_response_code(500);
    echo json_encode(['mensaje' => 'Error eliminación usuario en la base de datos.']);
    exit;
}


function UpdateLibro($id)
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new LibroDao();
    if (
        empty($data->title) || empty($data->author) || empty($data->quantity) || empty($data->book_url)
        || empty($data->image_url) || empty($data->description)
    ) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'No se aceptan objetos incompletos.']);
        exit;
    } else {
        //$libro = $dao->GetExistLibro($data->title);

        //if ($libro) {
        //    $id = $libro->getId();
        //}
        /*else{
            http_response_code(440);
            echo json_encode(['error' => 'Correo electronico no se puede modificar.']);
            //echo json_encode(['error' => 'No se encuentra informacion para actualizar.']);
            exit;
        }*/

        $libro = new Libro($id, $data->title, $data->author, $data->quantity, $data->book_url, $data->image_url, $data->description);
        if ($dao->UpdateLibro($libro)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'El libro se actualizó correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['mensaje' => 'Error registrando en la base de datos.']);
        exit;
    }
}

function UpdateLibroPrestado($id)
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new LibroDao();
    if (
        empty($data->title) || empty($data->author) || empty($data->quantity) || empty($data->book_url)
        || empty($data->image_url) || empty($data->description)
    ) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'No se aceptan objetos incompletos.']);
        exit;
    } else {
        //$libro = $dao->GetExistLibro($data->title);

        //if ($libro) {
        //    $id = $libro->getId();
        //}
        /*else{
                http_response_code(440);
                echo json_encode(['error' => 'Correo electronico no se puede modificar.']);
                //echo json_encode(['error' => 'No se encuentra informacion para actualizar.']);
                exit;
            }*/

        $libro = new Libro($id, $data->title, $data->author, $data->quantity, $data->book_url, $data->image_url, $data->description);
        if ($dao->UpdateLibroPres($libro)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'El libro prestado se actualizó correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['mensaje' => 'Error registrando en la base de datos.']);
        exit;
    }
}
