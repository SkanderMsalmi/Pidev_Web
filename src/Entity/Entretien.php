<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entretien
 *
 * @ORM\Table(name="entretien", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="fk_entretienStage", columns={"idStage"})})
 * @ORM\Entity
 */
class Entretien
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEntretien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identretien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntretien", type="date", nullable=false)
     */
    private $dateentretien;

    /**
     * @var string
     *
     * @ORM\Column(name="heureEntretien", type="string", length=30, nullable=false)
     */
    private $heureentretien;

    /**
     * @var string
     *
     * @ORM\Column(name="lienEntretien", type="string", length=255, nullable=false)
     */
    private $lienentretien;

    /**
     * @var \Stage
     *
     * @ORM\ManyToOne(targetEntity="Stage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idStage", referencedColumnName="idStage")
     * })
     */
    private $idstage;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;

    public function getIdentretien(): ?int
    {
        return $this->identretien;
    }

    public function getDateentretien(): ?\DateTimeInterface
    {
        return $this->dateentretien;
    }

    public function setDateentretien(\DateTimeInterface $dateentretien): self
    {
        $this->dateentretien = $dateentretien;

        return $this;
    }

    public function getHeureentretien(): ?string
    {
        return $this->heureentretien;
    }

    public function setHeureentretien(string $heureentretien): self
    {
        $this->heureentretien = $heureentretien;

        return $this;
    }

    public function getLienentretien(): ?string
    {
        return $this->lienentretien;
    }

    public function setLienentretien(string $lienentretien): self
    {
        $this->lienentretien = $lienentretien;

        return $this;
    }

    public function getIdstage(): ?Stage
    {
        return $this->idstage;
    }

    public function setIdstage(?Stage $idstage): self
    {
        $this->idstage = $idstage;

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
