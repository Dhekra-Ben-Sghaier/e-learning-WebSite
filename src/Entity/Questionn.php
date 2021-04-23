<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", length=65535, nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="text", length=65535, nullable=false)
     */
    private $option1;

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="text", length=65535, nullable=false)
     */
    private $option2;

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="text", length=65535, nullable=false)
     */
    private $option3;

    /**
     * @var string
     *
     * @ORM\Column(name="option4", type="text", length=65535, nullable=false)
     */
    private $option4;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="text", length=65535, nullable=false)
     */
    private $reponse;

    /**
     * @var int
     *
     * @ORM\Column(name="idQuiz", type="integer", nullable=false)
     */
    private $idquiz;


}
