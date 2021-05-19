<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Quizz
 *
 * @ORM\Table(name="quizz")
 * @ORM\Entity
 */
class Quizz
{
    /**
     * @var int
     *
     * @ORM\Column(name="quizID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("quiz")
     */
    private $quizid;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     * @Groups("quiz")
     */
    private $nom;

    public function getQuizid(): ?int
    {
        return $this->quizid;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


}
