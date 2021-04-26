<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostulerStage
 *
 * @ORM\Table(name="postuler_stage")
 * @ORM\Entity(repositoryClass="App\Repository\PostulerStageRepository")
 */
class PostulerStage
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Stage", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idStage;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_Societe", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSociete;

    public function getIdStage(): ?int
    {
        return $this->idStage;
    }

    public function getIdSociete(): ?int
    {
        return $this->idSociete;
    }

    /**
     * @param int $idStage
     */
    public function setIdStage(int $idStage): void
    {
        $this->idStage = $idStage;
    }

    /**
     * @param int $idSociete
     */
    public function setIdSociete(int $idSociete): void
    {
        $this->idSociete = $idSociete;
    }


}
