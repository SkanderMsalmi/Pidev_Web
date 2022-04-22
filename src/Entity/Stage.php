<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stage
 *
 * @ORM\Table(name="stage", indexes={@ORM\Index(name="fk_stagePersonne", columns={"idPersonne"})})
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
{
    /**
     * @var int
     *
     * @ORM\Column(name="idStage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idstage;

    /**
     * @var int
     *@Assert\NotBlank(message="Durèe Doit ètre Non Vide")
     *@Assert\Positive(message="Durèe Doit ètre Positive")
      * @Assert\Range(
     *      min = 1,
     *      max = 6,
     *      notInRangeMessage = "Durèe Doit ètre Entre {{ min }} et {{ max }}",
     * )
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var string
     *@Assert\NotBlank(message="Type Doit ètre Non Vide")
    *@Assert\Length(
     *     min=5,
     *     minMessage="Entrer Un Type Au Moins De 5 Caractère")  
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var string
     *@Assert\NotBlank(message="Domaine Doit ètre Non Vide")
     *@Assert\Length(
     *     min=5,
     *     minMessage="Entrer Un Domaine Au Moins De 5 Caractère")     
     * @ORM\Column(name="domaine", type="string", length=30, nullable=false)
     */
    private $domaine;

    /**
     * @var string
     *@Assert\NotBlank(message="Description Doit ètre Non Vide")
     *@Assert\Length(
     *     min=20,
     *     minMessage="Il Faut Bien Dècrire Votre Stage")
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *@Assert\NotBlank(message="Sujet Doit ètre Non Vide")
     *@Assert\Length(
     *     min=20,
     *     minMessage="Entrer Un Sujet Au Moins De 20 Caractère")
     * @ORM\Column(name="sujet", type="string", length=30, nullable=false)
     */
    private $sujet;

    /**
     * @var \DateTime
     *     * @Assert\Range(
     *      min = "now",
     *      max = "+7 months",
     *      notInRangeMessage = "Entre {{ min }} et {{ max }}",
     * )
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;

    public function getIdstage(): ?int
    {
        return $this->idstage;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getIdpersonne(): ?User
    {
        return $this->$idpersonne;
    }

    public function setIdpersonne(?Personne $idpersonne): self
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    public function __toString(): String
    {
        return  $this->getSujet() ;
    }

}
