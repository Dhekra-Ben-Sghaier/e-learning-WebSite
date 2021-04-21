<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostulerTravail
 *
 * @ORM\Table(name="postuler_travail")
 * @ORM\Entity
 */
class PostulerTravail
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_travail", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idTravail;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_Societe", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSociete;

    public function getIdTravail(): ?int
    {
        return $this->idTravail;
    }

    public function getIdSociete(): ?int
    {
        return $this->idSociete;
    }


}
