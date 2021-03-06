<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\Length(
     * 
     * min = 10,
     * max = 255,
     * minMessage = "Un enonce valide doit avoir 10 caracteres au minimum et 255 caracteres au maximum"
     * )
     * @Assert\NotBlank
     */
    private $enonce;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=30, nullable=false)
     *     @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Vous ne pouvez pas utiliser des numéros pour le domaine"
     * )
     * @Assert\NotBlank
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="reponseCorrecte", type="string", length=30, nullable=false)
     * @Assert\NotBlank
     */
    private $reponsecorrecte;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proposition",mappedBy="Question", cascade={"persist"})
     */
    protected $propositions;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
    }


 /*   public function getPropositions(): Collection
    {
       $props = new ArrayCollection($this->propositions);
        return $props;
    }*/

    public function getPropositions()
    {
        return $this->propositions;
    }

    public function setPropositions($propositionsP)
    {
        $this->propositions = $propositionsP;
    }

    public function setIdquestion($idquestion)
    {
        $this->idquestion = $idquestion;
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
        $this->propositions->removeElement($proposition);
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->domaine;
        // to show the id of the Category in the select
        // return $this->id;
    }
}

