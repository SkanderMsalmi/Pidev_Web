<?php

namespace App\Entity;

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stage
 * @ORM\Table(name="stage", indexes={@ORM\Index(name="fk_stagePersonne", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 * 
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
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     * *@Assert\NotBlank(message="Durèe Doit ètre Non Vide")
     *@Assert\Positive(message="Durèe Doit ètre Positive")
      * @Assert\Range(
     *      min = 1,
     *      max = 6,
     *      notInRangeMessage = "Durèe Doit ètre Entre {{ min }} et {{ max }}",
     * )
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     * *@Assert\NotBlank(message="Type Doit ètre Non Vide")
    *@Assert\Length(
     *     min=5,
     *     minMessage="Entrer Un Type Au Moins De 5 Caractère") 
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=255, nullable=false)
     *@Assert\NotBlank(message="Domaine Doit ètre Non Vide")

     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * *@Assert\NotBlank(message="Description Doit ètre Non Vide")
     *@Assert\Length(
     *     min=20,
     *     minMessage="Il Faut Bien Dècrire Votre Stage")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255, nullable=false)
     *  *@Assert\NotBlank(message="Sujet Doit ètre Non Vide")
     *@Assert\Length(
     *     min=20,
     *     minMessage="Entrer Un Sujet Au Moins De 20 Caractère")
     */
    private $sujet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     * * @Assert\Range(
     *      min = "now",
     *      max = "+7 months",
     *      notInRangeMessage = "Entre {{ min }} et {{ max }}",
     * )
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;

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

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSujet();
    }



}