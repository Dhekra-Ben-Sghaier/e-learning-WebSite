<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostulerTravail
 *
 * @ORM\Table(name="postuler_travail")
 * @ORM\Entity(repositoryClass="App\Repository\PostulerTravailRepository")
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

    /**
     * @return int
     */
    public function getIdTravail(): int
    {
        return $this->idTravail;
    }

    /**
     * @param int $idTravail
     */
    public function setIdTravail(int $idTravail): void
    {
        $this->idTravail = $idTravail;
    }

    /**
     * @return int
     */
    public function getIdSociete(): int
    {
        return $this->idSociete;
    }

    /**
     * @param int $idSociete
     */
    public function setIdSociete(int $idSociete): void
    {
        $this->idSociete = $idSociete;
    }



}
