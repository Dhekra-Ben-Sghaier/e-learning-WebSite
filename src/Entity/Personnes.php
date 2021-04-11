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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Formation", inversedBy="idUser")
     * @ORM\JoinTable(name="achat",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id", referencedColumnName="id")
     *   }
     * )
     */
    private $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
