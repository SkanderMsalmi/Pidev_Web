<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz", indexes={@ORM\Index(name="fk_question4", columns={"idQuestion4"}), @ORM\Index(name="fk_question1", columns={"idQuestion1"}), @ORM\Index(name="fk_question5", columns={"idQuestion5"}), @ORM\Index(name="fk_question2", columns={"idQuestion2"}), @ORM\Index(name="fk_question3", columns={"idQuestion3"})})
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Column(name="idQuiz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idquiz;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=30, nullable=false)
     */
    private $domaine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datecreation = 'CURRENT_TIMESTAMP';

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion4", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion4;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion3", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion3;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion2", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion2;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion5", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion5;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion1", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion1;


}
