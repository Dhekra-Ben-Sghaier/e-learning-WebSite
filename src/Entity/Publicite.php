<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity
 */
class Publicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=50, nullable=false)
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="Affichage", type="string", length=130, nullable=false)
     */
    private $affichage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="blob", length=0, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="Prix", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $prix = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lien", type="string", length=500, nullable=true, options={"default"="NULL"})
     */
    private $lien = 'NULL';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom():? string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom():? string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail():? string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDomaine():? string
    {
        return $this->domaine;
    }

    /**
     * @param string $domaine
     */
    public function setDomaine(string $domaine): void
    {
        $this->domaine = $domaine;
    }

    /**
     * @return string
     */
    public function getAffichage():? string
    {
        return $this->affichage;
    }

    /**
     * @param string $affichage
     */
    public function setAffichage(string $affichage): void
    {
        $this->affichage = $affichage;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    /**
     * @param int|null $prix
     */
    public function setPrix(?int $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return string|null
     */
    public function getLien(): ?string
    {
        return $this->lien;
    }

    /**
     * @param string|null $lien
     */
    public function setLien(?string $lien): void
    {
        $this->lien = $lien;
    }


}
