<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraint\NotBlank;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="App\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     
     */
    private $idReclamation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adressem", type="string", length=50, nullable=true, options={"default"="NULL"})
     * @Assert\Email(
     *     message="Cet e-mail '{{ value }}' n'est pas une adresse e-mail valide.")

     */
    private $adressem = 'NULL';

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="examen", type="string", length=50, nullable=false)

     */
    private $examen;

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="date", type="string", length=100, nullable=false)

     */
    private $date;

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="nom_formateur", type="string", length=50, nullable=false)

     */
    private $nomFormateur;

    /**
     * @var string
     *@Assert\NotBlank(message="Cette valeur ne doit pas être vide.")
     * @ORM\Column(name="description", type="string", length=50, nullable=false)

     */
    private $description;

    public function getIdReclamation(): ?int
    {
        return $this->idReclamation;
    }

    public function getAdressem(): ?string
    {
        return $this->adressem;
    }

    public function setAdressem(?string $adressem): self
    {
        $this->adressem = $adressem;

        return $this;
    }

    public function getExamen(): ?string
    {
        return $this->examen;
    }

    public function setExamen(string $examen): self
    {
        $this->examen = $examen;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

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
