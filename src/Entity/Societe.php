<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity
 */
class Societe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_soc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_soc", type="string", length=1000, nullable=false)
     */
    private $nomSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_mail_soc", type="string", length=1000, nullable=false)
     */
    private $adrMailSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_soc", type="string", length=1000, nullable=false)
     */
    private $adrSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=10000, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUtilisateur", type="string", length=1000, nullable=false)
     */
    private $nomutilisateur;

    public function getIdSoc(): ?int
    {
        return $this->idSoc;
    }

    public function getNomSoc(): ?string
    {
        return $this->nomSoc;
    }

    public function setNomSoc(string $nomSoc): self
    {
        $this->nomSoc = $nomSoc;

        return $this;
    }

    public function getAdrMailSoc(): ?string
    {
        return $this->adrMailSoc;
    }

    public function setAdrMailSoc(string $adrMailSoc): self
    {
        $this->adrMailSoc = $adrMailSoc;

        return $this;
    }

    public function getAdrSoc(): ?string
    {
        return $this->adrSoc;
    }

    public function setAdrSoc(string $adrSoc): self
    {
        $this->adrSoc = $adrSoc;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNomutilisateur(): ?string
    {
        return $this->nomutilisateur;
    }

    public function setNomutilisateur(string $nomutilisateur): self
    {
        $this->nomutilisateur = $nomutilisateur;

        return $this;
    }


}
