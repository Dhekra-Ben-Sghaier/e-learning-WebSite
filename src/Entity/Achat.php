<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achat
 *
 * @ORM\Table(name="achat", indexes={@ORM\Index(name="id_user_fk", columns={"id_users"}), @ORM\Index(name="id_form_fk", columns={"id"})})
 * @ORM\Entity
 */
class Achat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_users", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUsers;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    public function getIdUsers(): ?int
    {
        return $this->idUsers;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
