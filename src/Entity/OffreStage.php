<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OffreStage
 *
 * @ORM\Table(name="offre_stage")
 * @ORM\Entity
 */
class OffreStage
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Stage", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStage;

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
     * @var int
     *
     * @ORM\Column(name="Duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_fin", type="date", nullable=false)
     */
    private $dateFin;

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

    public function getIdStage(): ?int
    {
        return $this->idStage;
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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

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


}
