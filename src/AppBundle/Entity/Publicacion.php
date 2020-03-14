<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicacion
 *
 * @ORM\Table(name="publicacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionRepository")
 */
class Publicacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="obra", type="text")
     */
    private $obra;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_corta", type="string", length=250)
     */
    private $descripcionCorta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_larga", type="text")
     */
    private $descripcionLarga;

    /**
     * @var string
     *
     * @ORM\Column(name="autores", type="text")
     */
    private $autores;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=500)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", nullable=true)
     */
    private $imagen;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;

    public function __construct() {
        $this->activo = true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set obra
     *
     * @param string $obra
     *
     * @return Publicacion
     */
    public function setObra($obra)
    {
        $this->obra = $obra;

        return $this;
    }

    /**
     * Get obra
     *
     * @return string
     */
    public function getObra()
    {
        return $this->obra;
    }

    /**
     * Set descripcion_corta
     *
     * @param string $descripcionCorta
     *
     * @return Publicacion
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    /**
     * Get descripcion_corta
     *
     * @return string
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Set descripcion_larga
     *
     * @param string $descripcionLarga
     *
     * @return Publicacion
     */
    public function setDescripcionLarga($descripcionLarga)
    {
        $this->descripcionLarga = $descripcionLarga;

        return $this;
    }

    /**
     * Get descripcion_larga
     *
     * @return string
     */
    public function getDescripcionLarga()
    {
        return $this->descripcionLarga;
    }

    /**
     * Set autores
     *
     * @param string $autores
     *
     * @return Publicacion
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;

        return $this;
    }

    /**
     * Get autores
     *
     * @return string
     */
    public function getAutores()
    {
        return $this->autores;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Publicacion
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Publicacion
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Publicacion
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }
}
