<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Formation
 *
 * @ORM\Table(name="formation", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 * @UniqueEntity("titre")

 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFormation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformation;

    /**
     * @Assert\NotBlank(message="description doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "description doit etre >=2 ",
     *      maxMessage = "description doit etre <=100" )
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @Assert\NotBlank(message=" titre doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un titre au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Assert\NotBlank(message=" type doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un type au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @Assert\NotBlank(message=" domaine doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un domaine au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $domaine;

    /**
     * @var float
     * @Assert\NotBlank(message="prix formation doit etre non vide")
     * @Assert\Positive
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="il faut choisir une date ")
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="il faut choisir une date ")
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

    /**
     * @return int
     */
    public function getIdformation(): ?int
    {
        return $this->idformation;
    }

    /**
     * @param int $idformation
     */
    public function setIdformation(int $idformation): void
    {
        $this->idformation = $idformation;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    /**
     * @param string $domaine
     */
    public function setDomaine(string $domaine): void
    {
        $this->domaine = $domaine;
    }

    /**
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut(): ?\DateTime
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut(\DateTime $datedebut): void
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return \DateTime
     */
    public function getDatefin(): ?\DateTime
    {
        return $this->datefin;
    }

    /**
     * @param \DateTime $datefin
     */
    public function setDatefin(\DateTime $datefin): void
    {
        $this->datefin = $datefin;
    }

    /**
     * @return \User
     */
    public function getIdUser(): ?\User
    {
        return $this->iduser;
    }

    /**
     * @param \User $iduser
     */
    public function setIdUser(\User $iduser): void
    {
        $this->iduser = $iduser;
    }



}


