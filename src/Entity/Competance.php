<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competance
 *
 * @ORM\Table(name="competance", indexes={@ORM\Index(name="fk_competencePersonne", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Competance
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCompetance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompetance;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCompetance", type="string", length=30, nullable=false)
     */
    private $nomcompetance;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=0, nullable=false)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="verifie", type="string", length=0, nullable=false)
     */
    private $verifie;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="id")
     * })
     */
    private $idpersonne;

    public function getIdcompetance(): ?int
    {
        return $this->idcompetance;
    }

    public function getNomcompetance(): ?string
    {
        return $this->nomcompetance;
    }

    public function setNomcompetance(string $nomcompetance): self
    {
        $this->nomcompetance = $nomcompetance;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getVerifie(): ?string
    {
        return $this->verifie;
    }

    public function setVerifie(string $verifie): self
    {
        $this->verifie = $verifie;

        return $this;
    }

    public function getIdpersonne(): ?User
    {
        return $this->idpersonne;
    }

    public function setIdpersonne(?User $idpersonne): self
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }


}
