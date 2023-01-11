<?php

header('Content-Type: application/json');
require_once '../model/LibroDao.php';

$methods = $_SERVER['REQUEST_METHOD'];

$id = $_REQUEST['id'] ?? null;
$update = $_REQUEST['update'] ?? null;
$delete = $_REQUEST['delete'] ?? null;


if ($methods == 'GET' && !$id) index();

if ($methods == 'GET' && $id) showById($id);

if ($methods == 'POST' && !$id) CreateLibro();

if ($methods == 'POST' && $delete && $id) DeleteLibro($id);

if ($methods == 'POST' && $update && $id) UpdateLibro($id);

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
    $result = ['data' => []];
    foreach ($libros as $libro) {
        $result['data'][] = [
            'id' => $libro->getId(),
            'title' => $libro->getTitulo(),
            'author' => $libro->getAutor(),
            'quantity' => $libro->getCantidad(),
            'book_url' => $libro->getUrlLibro(),
            'image_url' => $libro->getUrlImg(),
            'description' => $libro->getDescripcion()
        ];
    }
    echo json_encode($result);
    exit;
}

function showById($id)
{
    $dao = new LibroDao();
    $libro = $dao->GetById($id);
    if ($libro) {
        echo json_encode(['data' => [
            'id' => $libro->getId(),
            'title' => $libro->getTitulo(),
            'author' => $libro->getAutor(),
            'quantity' => $libro->getCantidad(),
            'book_url' => $libro->getUrlLibro(),
            'image_url' => $libro->getUrlImg(),
            'description' => $libro->getDescripcion()
        ]]);

        http_response_code(201);
        exit;
    }
    echo json_encode(['error' => 'El libro a consultar no se encuentra en la base de datos.']);
    http_response_code(404);
    exit;
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
        echo json_encode(['error' => 'No se aceptan objetos incompletos.']);
    } else {
        $libro = $dao->GetExistLibro($data->title);
        if ($libro) {
            http_response_code(400);
            echo json_encode(['error' => 'El libro ya se encuentra registrada en la base de datos.']);
            exit;
        }

        $libro = new Libro(null, $data->title, $data->author, $data->quantity, $data->book_url, $data->image_url, $data->description);
        if ($dao->CreateLibro($libro)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'El libro se registró correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['error' => 'Error registrando en la base de datos.']);
        exit;
    }
}


function DeleteLibro($id)
{
    $dao = new LibroDao();
    $usuario = $dao->GetById($id);
    if ($usuario) {
        if($dao->DeleteLibro($id)){
            http_response_code(201);
            echo json_encode(['mensaje' => 'El libro se eliminó correctamente.']);
            exit;
        }
    }else{
        http_response_code(400);
        echo json_encode(['error' => 'El libro no se encuentra registrada en la base de datos.']);
        exit;
    }

    http_response_code(500);
    echo json_encode(['error' => 'Error eliminación usuario en la base de datos.']);
    exit;
}


function UpdateLibro($id){
    $data = json_decode(file_get_contents('php://input'));
    $dao = new LibroDao();
    if (
        empty($data->title) || empty($data->author) || empty($data->quantity) || empty($data->book_url)
        || empty($data->image_url) || empty($data->description)
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'No se aceptan objetos incompletos.']);
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
        echo json_encode(['error' => 'Error registrando en la base de datos.']);
        exit;
    }
}
