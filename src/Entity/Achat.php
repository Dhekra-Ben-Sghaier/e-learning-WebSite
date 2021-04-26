<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table(name="achat", indexes={@ORM\Index(name="id_fk", columns={"id"}), @ORM\Index(name="id_user_fk", columns={"id_user"})})
 * @ORM\Entity
 */
class Achat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
