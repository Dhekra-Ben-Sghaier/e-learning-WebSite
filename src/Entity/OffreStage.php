<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * OffreStage
 *
 * @ORM\Table(name="offre_stage")
 * @ORM\Entity(repositoryClass="App\Repository\OffreStageeRepository")
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date_pub", type="date", length=500, nullable=false)
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

    /**
     * @var int
     *
     * @ORM\Column(name="valide", type="integer", nullable=false)
     */
    private $valide;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=65535, nullable=false)
     */
    private $logo;





    /**
     * @return int
     */
    public function getIdStage(): int
    {
        return $this->idStage;
    }

    /**
     * @param int $idStage
     */
    public function setIdStage(int $idStage): void
    {
        $this->idStage = $idStage;
    }

    /**
     * @return string
     */
    public function getNomSoc(): ?string
    {
        return $this->nomSoc;
    }

    /**
     * @param string $nomSoc
     */
    public function setNomSoc(string $nomSoc): void
    {
        $this->nomSoc = $nomSoc;
    }

    /**
     * @return string
     */
    public function getAdrMailSoc(): ?string
    {
        return $this->adrMailSoc;
    }

    /**
     * @param string $adrMailSoc
     */
    public function setAdrMailSoc(string $adrMailSoc): void
    {
        $this->adrMailSoc = $adrMailSoc;
    }

    /**
     * @return string
     */
    public function getAdrSoc(): ?string
    {
        return $this->adrSoc;
    }

    /**
     * @param string $adrSoc
     */
    public function setAdrSoc(string $adrSoc): void
    {
        $this->adrSoc = $adrSoc;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatePub(): \DateTime
    {
        return $this->datePub;
    }

    /**
     * @param \DateTime $datePub
     */
    public function setDatePub(\DateTime $datePub): void
    {
        $this->datePub = $datePub;
    }



    /**
     * @return string
     */
    public function getNivEtude(): ?string
    {
        return $this->nivEtude;
    }

    /**
     * @param string $nivEtude
     */
    public function setNivEtude(string $nivEtude): void
    {
        $this->nivEtude = $nivEtude;
    }

    /**
     * @return string
     */
    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    /**
     * @param string $certificat
     */
    public function setCertificat(string $certificat): void
    {
        $this->certificat = $certificat;
    }

    /**
     * @return int
     */
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut(\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin(\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return int
     */
    public function getIdSociete(): ?int
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

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return int
     */
    public function getValide(): ?int
    {
        return $this->valide;
    }

    /**
     * @param int $valide
     */
    public function setValide(int $valide): void
    {
        $this->valide = $valide;
    }

    /**
     * @return string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo( ?string $logo ): self
    {
        $this->logo = $logo;
        return $this;
    }


}
