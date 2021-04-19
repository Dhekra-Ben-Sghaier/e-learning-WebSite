<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffreTravail
 *
 * @ORM\Table(name="offre_travail")
 * @ORM\Entity
 */
class OffreTravail
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_travail", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTravail;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_soc", type="string", length=500, nullable=false)
     */
    private $nomSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="Adr_mail_soc", type="string", length=500, nullable=false)
     */
    private $adrMailSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="Adr_soc", type="string", length=500, nullable=false)
     */
    private $adrSoc;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Date_pub", type="string", length=500, nullable=false)
     */
    private $datePub;

    /**
     * @var string
     *
     * @ORM\Column(name="Niv_etude", type="string", length=500, nullable=false)
     */
    private $nivEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="Certificat", type="string", length=500, nullable=false)
     */
    private $certificat;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_contrat", type="string", length=500, nullable=false)
     */
    private $typeContrat;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_societe", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=500, nullable=false)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="valide", type="integer", nullable=false)
     */
    private $valide;

    public function getIdTravail(): ?int
    {
        return $this->idTravail;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePub(): ?string
    {
        return $this->datePub;
    }

    public function setDatePub(string $datePub): self
    {
        $this->datePub = $datePub;

        return $this;
    }

    public function getNivEtude(): ?string
    {
        return $this->nivEtude;
    }

    public function setNivEtude(string $nivEtude): self
    {
        $this->nivEtude = $nivEtude;

        return $this;
    }

    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    public function setCertificat(string $certificat): self
    {
        $this->certificat = $certificat;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getIdSociete(): ?int
    {
        return $this->idSociete;
    }

    public function setIdSociete(int $idSociete): self
    {
        $this->idSociete = $idSociete;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getValide(): ?int
    {
        return $this->valide;
    }

    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }


}
