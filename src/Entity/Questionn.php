<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Questionn
 *
 * @ORM\Table(name="questionn", indexes={@ORM\Index(name="idQuiz", columns={"idQuiz"})})
 * @ORM\Entity
 */
class Questionn
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("quest")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $option1;

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $option2;

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $option3;

    /**
     * @var string
     *
     * @ORM\Column(name="option4", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $option4;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="text", length=65535, nullable=false)
     * @Groups("quest")
     */
    private $reponse;

    /**
     *
     * @ORM\ManyToOne(targetEntity=Quizz::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idquiz", referencedColumnName="quizID",onDelete="CASCADE")
     * })
     * @Groups("quest")
     */
    private $idquiz;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): self
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(string $option2): self
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(string $option3): self
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option4;
    }

    public function setOption4(string $option4): self
    {
        $this->option4 = $option4;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdquiz()
    {
        return $this->idquiz;
    }

    /**
     * @param mixed $idquiz
     */
    public function setIdquiz($idquiz): void
    {
        $this->idquiz = $idquiz;
    }





}
