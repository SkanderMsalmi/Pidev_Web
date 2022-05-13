<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Entretien
 *
 * @ORM\Table(name="entretien", indexes={@ORM\Index(name="fk_entretienStage", columns={"idStage"}), @ORM\Index(name="idUser", columns={"idUser"})})
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
     * 
     * @ORM\Column(name="dateEntretien", type="datetime", nullable=false)
     *  * @Assert\Range(
     *      min = "now",
     *      max = "+15 days",
     *      notInRangeMessage = "Entre {{ min }} et {{ max }}",
     * )
     */
    private $dateentretien;

    /**
     * @var string
     *
     * @ORM\Column(name="lienEntretien", type="string", length=255, nullable=false)
      * @Assert\NotBlank(message="Lien Entretien Doit ètre Non Vide")
     * @Assert\Url(relativeProtocol = false , protocols = {"http", "https", "ftp"}, checkDNS = "ANY")
     */
    private $lienentretien;

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
     * @var \Stage
     *
     * @ORM\ManyToOne(targetEntity="Stage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idStage", referencedColumnName="idStage")
     * })
     */
    private $idstage;

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

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

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


}
