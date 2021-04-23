<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnes
 *
 * @ORM\Table(name="personnes")
 * @ORM\Entity
 */
class Personnes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cin", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $cin = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $prenom = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=10000, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUtilisateur", type="string", length=50, nullable=false)
     */
    private $nomutilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="centreInteret", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $centreinteret = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="domaine", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $domaine = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=false)
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=1000, nullable=true, options={"default"="NULL"})
     */
    private $code = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="blob", length=0, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomSociete", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $nomsociete = 'NULL';

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getCentreinteret(): ?string
    {
        return $this->centreinteret;
    }

    public function setCentreinteret(?string $centreinteret): self
    {
        $this->centreinteret = $centreinteret;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(?string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNomsociete(): ?string
    {
        return $this->nomsociete;
    }

    public function setNomsociete(?string $nomsociete): self
    {
        $this->nomsociete = $nomsociete;

        return $this;
    }


}
