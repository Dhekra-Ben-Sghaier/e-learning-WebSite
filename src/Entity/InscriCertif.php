<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriCertif
 *
 * @ORM\Table(name="inscri_certif")
 * @ORM\Entity
 */
class InscriCertif
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_inscri", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInscri;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_utilisateur", type="text", length=65535, nullable=false)
     */
    private $nomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_certificat", type="text", length=65535, nullable=false)
     */
    private $nomCertificat;

    public function getIdInscri(): ?int
    {
        return $this->idInscri;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getNomCertificat(): ?string
    {
        return $this->nomCertificat;
    }

    public function setNomCertificat(string $nomCertificat): self
    {
        $this->nomCertificat = $nomCertificat;

        return $this;
    }


}
