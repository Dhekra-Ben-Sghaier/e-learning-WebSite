<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostulerStage
 *
 * @ORM\Table(name="postuler_stage")
 * @ORM\Entity
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


}
