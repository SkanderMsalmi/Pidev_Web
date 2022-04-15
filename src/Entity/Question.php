<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="idQuestion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idquestion;

    /**
     * @var string
     *
     * @ORM\Column(name="enonce", type="string", length=30, nullable=false)
     */
    private $enonce;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=30, nullable=false)
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="reponseCorrecte", type="string", length=30, nullable=false)
     */
    private $reponsecorrecte;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposition",mappedBy="Question", cascade={"persist"})
     */
    protected $propositions;

    public function __construct() {
        $this->propositions = new ArrayCollection();
    }


    public function getPropositions() : Collection
    {
        return $this->propositions;
    }

    public function getIdquestion(): ?int
    {
        return $this->idquestion;
    }

    public function getEnonce(): ?string
    {
        return $this->enonce;
    }

    public function setEnonce(string $enonce): self
    {
        $this->enonce = $enonce;

        return $this;
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

    public function getReponsecorrecte(): ?string
    {
        return $this->reponsecorrecte;
    }

    public function setReponsecorrecte(string $reponsecorrecte): self
    {
        $this->reponsecorrecte = $reponsecorrecte;

        return $this;
    }

    public function addProposition(Proposition $proposition): void
    {
        $proposition->setIdquestion($this->idquestion);
        
        $this->propositions->add($proposition);
    }

    public function removeProposition(Proposition $proposition): void
    {
        # code...
    }

}
