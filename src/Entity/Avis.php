<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="id_user_fk", columns={"id_us"}), @ORM\Index(name="id_form_fk", columns={"id_form"})})
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_us", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUs;

    /**
     * @var int
     *
     * @ORM\Column(name="id_form", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idForm;

    /**
     * @var int
     *
     * @ORM\Column(name="avisuser", type="integer", nullable=false)
     */
    private $avisuser;


}
