<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz", indexes={@ORM\Index(name="fk_question3", columns={"idQuestion3"}), @ORM\Index(name="fk_question4", columns={"idQuestion4"}), @ORM\Index(name="fk_question1", columns={"idQuestion1"}), @ORM\Index(name="fk_question5", columns={"idQuestion5"}), @ORM\Index(name="fk_question2", columns={"idQuestion2"})})
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

    public function getIdquiz(): ?int
    {
        return $this->idquiz;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getIdquestion4(): ?Question
    {
        return $this->idquestion4;
    }

    public function setIdquestion4(?Question $idquestion4): self
    {
        $this->idquestion4 = $idquestion4;

        return $this;
    }

    public function getIdquestion3(): ?Question
    {
        return $this->idquestion3;
    }

    public function setIdquestion3(?Question $idquestion3): self
    {
        $this->idquestion3 = $idquestion3;

        return $this;
    }

    public function getIdquestion2(): ?Question
    {
        return $this->idquestion2;
    }

    public function setIdquestion2(?Question $idquestion2): self
    {
        $this->idquestion2 = $idquestion2;

        return $this;
    }

    public function getIdquestion5(): ?Question
    {
        return $this->idquestion5;
    }

    public function setIdquestion5(?Question $idquestion5): self
    {
        $this->idquestion5 = $idquestion5;

        return $this;
    }

    public function getIdquestion1(): ?Question
    {
        return $this->idquestion1;
    }

    public function setIdquestion1(?Question $idquestion1): self
    {
        $this->idquestion1 = $idquestion1;

        return $this;
    }


}
