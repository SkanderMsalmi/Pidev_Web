<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandestage
 *
 * @ORM\Table(name="demandestage", indexes={@ORM\Index(name="fk_demandePersonne", columns={"idPersonne"}), @ORM\Index(name="fk_demandeStage", columns={"idStage"})})
 * @ORM\Entity(repositoryClass="App\Repository\DemandeStageRepository")
 */
class Demandestage
{
    /**
     * @var int
     *
     * @ORM\Column(name="idDemande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddemande;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=0, nullable=false)
     */
    private $etat;

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

    public function getIddemande(): ?int
    {
        return $this->iddemande;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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
