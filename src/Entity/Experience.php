<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience", indexes={@ORM\Index(name="fk_personneExperience", columns={"idUser"})})
 * @ORM\Entity
 */
class Experience
{
    /**
     * @var int
     *
     * @ORM\Column(name="idExperience", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexperience;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=30, nullable=false)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=30, nullable=false)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="competanMiseEnOuvre", type="string", length=30, nullable=false)
     */
    private $competanmiseenouvre;

    /**
     * @var \DateTime
     *
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;

    public function getIdexperience(): ?int
    {
        return $this->idexperience;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getCompetanmiseenouvre(): ?string
    {
        return $this->competanmiseenouvre;
    }

    public function setCompetanmiseenouvre(string $competanmiseenouvre): self
    {
        $this->competanmiseenouvre = $competanmiseenouvre;

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


}
