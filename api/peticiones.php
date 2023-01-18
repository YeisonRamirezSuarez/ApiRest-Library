<?php

header('Content-Type: application/json');
require_once '../model/LibroDao.php';

$methods = $_SERVER['REQUEST_METHOD'];

$id = $_REQUEST['id'] ?? null;
$cantidad = $_REQUEST['cantidad_libro'] ?? null;
$prestado = $_REQUEST['prestado'] ?? null;
$disponible = $_REQUEST['prestados'] ?? null;
$prestar = $_REQUEST['prestar'] ?? null;
$Pcantidad = $_REQUEST['cantidad'] ?? null;
$delete = $_REQUEST['delete'] ?? null;



if ($methods == 'GET' && $prestado && $id) libroHistory($id);

if ($methods == 'GET' && $prestado) index();

if ($methods == 'GET' && $disponible) libroPrestados();

if ($methods == 'POST' && $delete) DeleteLibroPrestado($id);

if ($methods == 'POST' && $prestar) prestarLibro();

if ($methods == 'POST' && $Pcantidad) UpdateCantidad($id, $cantidad);



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
    $libros = $dao->GetLibroPrestadoDisponible();
    $result = ["data" => []];
    foreach ($libros as $libro) {
        array_push($result["data"],[
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
    exit;
}

function libroHistory($id)
{
    $dao = new LibroDao();
    $libros = $dao->GetLibroPrestadoGetById($id);
    $result = ["data" => []];
    foreach ($libros as $libro) {
        array_push($result["data"],[
            'email_user' => $libro->getCorreoUser(),
            'name_user' => $libro->getNombreUser(),
            'phone_user' => $libro->getTelefonoUser()
        ]);
    }
    echo json_encode($result);
    exit;
}

function libroPrestados()
{
    $dao = new LibroDao();
    $libros = $dao->GetLibroPrestadoDisponible();
    $result = ["data" => []];
    foreach ($libros as $libro) {
        array_push($result["data"],[
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
    exit;
}

function prestarLibro()
{
    $data = json_decode(file_get_contents('php://input'));
    $dao = new LibroDao();
    if (
        empty($data->id_book) ||  empty($data->title) || empty($data->author)  || empty($data->book_url)
        || empty($data->image_url) || empty($data->description)  || empty($data->date)  || empty($data->email_user)  
        || empty($data->name_user)  || empty($data->phone_user)
    ) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'No se aceptan objetos incompletos.']);
    } else {
        /*$libro = $dao->GetExistLibro($data->title);
        if ($libro) {
            http_response_code(400);
            echo json_encode(['mensaje' => 'El libro ya se encuentra registrada en la base de datos.']);
            exit;
        }*/

        $libro = new LibroPrestado(null, $data->id_book, $data->title, $data->author, $data->book_url, $data->image_url, $data->description
    ,$data->date, $data->email_user, $data->name_user, $data->phone_user);
        if ($dao->PrestarLibro($libro)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Libro prestado correctamente.']);
            exit;
        }

        http_response_code(500);
        echo json_encode(['mensaje' => 'Error registrando en la base de datos.']);
        exit;
    }

    
}

function UpdateCantidad($id, $cantidad)
{

    $dao = new LibroDao();
    if ($dao->UpdateCantidades($id, $cantidad)) {
        http_response_code(201);
        echo json_encode(['mensaje' => 'El libro cantidad se actualizó correctamente.']);
        exit;
    }

    http_response_code(500);
    echo json_encode(['mensaje' => 'Error registrando en la base de datos.']);
    exit;
}

/*function DeleteLibroPrestado($id)
{
    $dao = new LibroDao();
    $usuario = $dao->DeleteLibroPres($id);
    if ($usuario) {
        if ($dao->DeleteLibroPres($id)) {
            http_response_code(201);
            echo "El libro prestado se eliminó correctamente.";
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
}*/



