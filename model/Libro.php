<?php

class Libro{
    private $id;
    private $titulo;
    private $autor;
    private $cantidad;
    private $urlLibro;
    private $urlImg;
    private $descripcion;

    public function __construct($id, $titulo, $autor, $cantidad, $urlLibro, $urlImg, $descripcion)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->cantidad = $cantidad;
        $this->urlLibro = $urlLibro;
        $this->urlImg = $urlImg;
        $this->descripcion = $descripcion;
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
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     */
    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of urlLibro
     */
    public function getUrlLibro()
    {
        return $this->urlLibro;
    }

    /**
     * Set the value of urlLibro
     */
    public function setUrlLibro($urlLibro): self
    {
        $this->urlLibro = $urlLibro;

        return $this;
    }

    /**
     * Get the value of urlImg
     */
    public function getUrlImg()
    {
        return $this->urlImg;
    }

    /**
     * Set the value of urlImg
     */
    public function setUrlImg($urlImg): self
    {
        $this->urlImg = $urlImg;

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
}