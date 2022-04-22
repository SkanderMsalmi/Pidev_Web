<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition", indexes={@ORM\Index(name="fk_propositionQuestion", columns={"idQuestion"})})
 * @ORM\Entity
 */
class Proposition
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProposition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproposition;

    /**
     * @var string
     *
     * @ORM\Column(name="proposition", type="string", length=30, nullable=false)
     */
    private $proposition;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idQuestion", referencedColumnName="idQuestion")
     * })
     */
    private $idquestion;

    public function getIdproposition(): ?int
    {
        return $this->idproposition;
    }

    public function getProposition(): ?string
    {
        return $this->proposition;
    }

    public function setProposition(string $proposition): self
    {
        $this->proposition = $proposition;

        return $this;
    }

    public function getIdquestion(): ?Question
    {
        return $this->idquestion;
    }

    public function setIdquestion(?Question $idquestion): self
    {
        $this->idquestion = $idquestion;

        return $this;
    }


}
