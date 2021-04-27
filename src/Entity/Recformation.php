<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recformation
 *
 * @ORM\Table(name="recformation")
 * @ORM\Entity
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
     *
     * @ORM\Column(name="adressemail", type="string", length=50, nullable=true)
     */
    private $adressemail;

    /**
     * @var string
     *
     * @ORM\Column(name="formation", type="string", length=50, nullable=false)
     */
    private $formation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_formateur", type="string", length=50, nullable=false)
     */
    private $nomFormateur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;


}
