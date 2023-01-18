<?php

class LibroPrestado{
    private $id;
    private $id_libro;
    private $titulo;
    private $autor;
    private $url_libro;
    private $url_img;
    private $descripcion;
    private $fecha;
    private $correo_user;
    private $nombre_user;
    private $telefono_user;

    public function __construct($id, $id_libro, $titulo, $autor, $url_libro, $url_img, $descripcion, $fecha, $correo_user, $nombre_user, $telefono_user)
    {
        $this->id = $id;
        $this->id_libro = $id_libro;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->url_libro = $url_libro;
        $this->url_img = $url_img;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->correo_user = $correo_user;
        $this->nombre_user = $nombre_user;
        $this->telefono_user = $telefono_user;
    }
    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_libro
     */
    public function getIdLibro()
    {
        return $this->id_libro;
    }

    /**
     * Set the value of id_libro
     */
    public function setIdLibro($id_libro): self
    {
        $this->id_libro = $id_libro;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of url_libro
     */
    public function getUrlLibro()
    {
        return $this->url_libro;
    }

    /**
     * Set the value of url_libro
     */
    public function setUrlLibro($url_libro): self
    {
        $this->url_libro = $url_libro;

        return $this;
    }

    /**
     * Get the value of url_img
     */
    public function getUrlImg()
    {
        return $this->url_img;
    }

    /**
     * Set the value of url_img
     */
    public function setUrlImg($url_img): self
    {
        $this->url_img = $url_img;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of correo_user
     */
    public function getCorreoUser()
    {
        return $this->correo_user;
    }

    /**
     * Set the value of correo_user
     */
    public function setCorreoUser($correo_user): self
    {
        $this->correo_user = $correo_user;

        return $this;
    }

    /**
     * Get the value of nombre_user
     */
    public function getNombreUser()
    {
        return $this->nombre_user;
    }

    /**
     * Set the value of nombre_user
     */
    public function setNombreUser($nombre_user): self
    {
        $this->nombre_user = $nombre_user;

        return $this;
    }

    /**
     * Get the value of telefono_user
     */
    public function getTelefonoUser()
    {
        return $this->telefono_user;
    }

    /**
     * Set the value of telefono_user
     */
    public function setTelefonoUser($telefono_user): self
    {
        $this->telefono_user = $telefono_user;

        return $this;
    }
}