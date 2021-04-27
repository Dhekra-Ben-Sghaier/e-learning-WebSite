<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity
 */
class Avis
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_us", type="integer", nullable=false)
     * @ORM\Id
     *
     */
    private $idUs;

    /**
     * @var int
     *
     * @ORM\Column(name="id_form", type="integer", nullable=false)
     */
    private $idForm;

    /**
     * @var string
     *
     * @ORM\Column(name="avisuser", type="string", length=500, nullable=true)
     */
    private $avisuser="";

    /**
     * @return int
     */
    public function getIdUs(): int
    {
        return $this->idUs;
    }

    /**
     * @param int $idUs
     */
    public function setIdUs(int $idUs): void
    {
        $this->idUs = $idUs;
    }

    /**
     * @return int
     */
    public function getIdForm(): int
    {
        return $this->idForm;
    }

    /**
     * @param int $idForm
     */
    public function setIdForm(int $idForm): void
    {
        $this->idForm = $idForm;
    }

    /**
     * @return string
     */
    public function getAvisuser(): string
    {
        return $this->avisuser;
    }

    /**
     * @param string $avisuser
     */
    public function setAvisuser(string $avisuser): void
    {
        $this->avisuser = $avisuser;
    }


}
