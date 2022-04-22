<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entretien
 *
 * @ORM\Table(name="entretien", indexes={@ORM\Index(name="fk_entretienStage", columns={"idStage"}), @ORM\Index(name="idPersonne", columns={"idPersonne"})})
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
     * @Assert\Range(
     *      min = "now",
     *      max = "+15 days",
     *      notInRangeMessage = "Entre {{ min }} et {{ max }}",
     * )
     * @ORM\Column(name="dateEntretien", type="datetime", nullable=false)
     */
    private $dateentretien;

    

    /**
     * @var string
     * 
     * @Assert\NotBlank(message="Lien Entretien Doit ètre Non Vide")
     * @Assert\Url(relativeProtocol = false , protocols = {"http", "https", "ftp"}, checkDNS = "ANY")
     * @ORM\Column(name="lienEntretien", type="string", length=255, nullable=false)
     */
    private $lienentretien;

    /**
     * @var \Personne
     *
     * @ORM\ManyToOne(targetEntity="Personne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="idPersonne")
     * })
     */
    private $idpersonne;

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

    public function getDateentretien(): ?\DateTime
    {
        return $this->dateentretien;
    }

    public function setDateentretien(\DateTime $dateentretien): self
    {
        $this->dateentretien = $dateentretien;

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

    public function getIdpersonne(): ?Personne
    {
        return $this->idpersonne;
    }

    public function setIdpersonne(?Personne $idpersonne): self
    {
        $this->idpersonne = $idpersonne;

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
