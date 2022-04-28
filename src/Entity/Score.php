<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score", indexes={@ORM\Index(name="fk_scorePersonne", columns={"idUser"}), @ORM\Index(name="fk_scoreQuiz", columns={"idQuiz"})})
 * @ORM\Entity
 */
class Score
{
    /**
     * @var int
     *
     * @ORM\Column(name="idScore", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idscore;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer", nullable=false)
     */
    private $score;

    /**
     * @var \Quiz
     *
     * @ORM\ManyToOne(targetEntity="Quiz")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuiz", referencedColumnName="idQuiz")
     * })
     */
    private $idquiz;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;


}
