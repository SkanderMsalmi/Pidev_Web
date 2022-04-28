<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_formation", columns={"idFormation"}), @ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "nom doit etre >=2 ",
     *      maxMessage = "nom doit etre <=100" )
     * @ORM\Column(type="string", length=1000)
     */
    private $nom;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="il faut choisir une date ")
     * @ORM\Column(name="dateReservation", type="date", nullable=true)
     */
    private $datereservation;

    /**
     * @var int
     *
     * @ORM\Column(name="idFormation", type="integer", nullable=true)
     */
    private $idformation;

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
    public function getIdreservation(): int
    {
        return $this->idreservation;
    }

    /**
     * @param int $idreservation
     */
    public function setIdreservation(int $idreservation): void
    {
        $this->idreservation = $idreservation;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return \DateTime
     */
    public function getDatereservation(): ?\DateTime
    {
        return $this->datereservation;
    }

    /**
     * @param \DateTime $datereservation
     */
    public function setDatereservation(\DateTime $datereservation): void
    {
        $this->datereservation = $datereservation;
    }

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
     * @return \User
     */
    public function getIdUser(): \User
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

# zedtha jdida

/*
     /**
     * @return \Formation
     */
/*    public function getFormation(): ?int
    {
        return $this->formation;
    }

    /*
     * @param \Formation
     */
/*   public function setFormation(int $formation): void
    {
        $this->formation = $formation;
    }
    */





}
