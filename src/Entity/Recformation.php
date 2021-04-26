<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Recformation
 *
 * @ORM\Table(name="recformation")
 * @ORM\Entity(repositoryClass="App\Repository\RecformationRepository")
 */
class Recformation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_formation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormation;

    /**
     * @var string|null
     *@Assert\Email(
     *     message="Cet e-mail '{{ value }}' n'est pas une adresse e-mail valide.")
     * @ORM\Column(name="adressemail", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $adressemail = 'NULL';

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="formation", type="string", length=50, nullable=false)
     *
     */
    private $formation;

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="nom_formateur", type="string", length=50, nullable=false)
     */
    private $nomFormateur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    public function getIdFormation(): ?int
    {
        return $this->idFormation;
    }

    public function getAdressemail(): ?string
    {
        return $this->adressemail;
    }

    public function setAdressemail(?string $adressemail): self
    {
        $this->adressemail = $adressemail;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getNomFormateur(): ?string
    {
        return $this->nomFormateur;
    }

    public function setNomFormateur(string $nomFormateur): self
    {
        $this->nomFormateur = $nomFormateur;

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


}
