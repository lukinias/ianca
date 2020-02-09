<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CursoRepository")
 */
class Curso
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
     * @ORM\Column(name="nombre", type="string", length=500)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="horas", type="integer")
     */
    private $horas;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="mjn", type="integer", nullable=true)
     */
    private $mjn;

    /**
     * @var int
     *
     * @ORM\Column(name="mecaba", type="integer", nullable=true)
     */
    private $mecaba;

    /**
     * @var int
     *
     * @ORM\Column(name="cuidi", type="integer", nullable=true)
     */
    private $cuidi;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo='1';


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Curso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set horas
     *
     * @param integer $horas
     *
     * @return Curso
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;

        return $this;
    }

    /**
     * Get horas
     *
     * @return int
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Curso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set mjn
     *
     * @param integer $mjn
     *
     * @return Curso
     */
    public function setMjn($mjn)
    {
        $this->mjn = $mjn;

        return $this;
    }

    /**
     * Get mjn
     *
     * @return int
     */
    public function getMjn()
    {
        return $this->mjn;
    }

    /**
     * Set mecaba
     *
     * @param integer $mecaba
     *
     * @return Curso
     */
    public function setMecaba($mecaba)
    {
        $this->mecaba = $mecaba;

        return $this;
    }

    /**
     * Get mecaba
     *
     * @return int
     */
    public function getMecaba()
    {
        return $this->mecaba;
    }

    /**
     * Set cuidi
     *
     * @param integer $cuidi
     *
     * @return Curso
     */
    public function setCuidi($cuidi)
    {
        $this->cuidi = $cuidi;

        return $this;
    }

    /**
     * Get cuidi
     *
     * @return int
     */
    public function getCuidi()
    {
        return $this->cuidi;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Curso
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
