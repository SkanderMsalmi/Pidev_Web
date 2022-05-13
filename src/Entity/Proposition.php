<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table(name="proposition", indexes={@ORM\Index(name="fk_propositionQuestion", columns={"idQuestion"})})
 * @ORM\Entity(repositoryClass="App\Repository\PropositionRepository")
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
     * @Assert\Length(
     * 
     * min = 1,
     * max = 255,
     * minMessage = "Une proposition valide doit avoir 1 caractere au minimum et 255 caracteres au maximum"
     * )
     * @Assert\NotBlank
     * @Assert\IsNull
     */
    private $proposition;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     *  @ORM\JoinColumn(name="idQuestion", referencedColumnName="idQuestion")
     *  @ORM\JoinColumn(name="idQuestion", onDelete="CASCADE")
     * 
     * 
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

    public function getIdquestion()
    {
        return $this->idquestion;
    }

    public function setIdquestion($idquestion): self
    {
        $this->idquestion = $idquestion;

        return $this;
    }


}
