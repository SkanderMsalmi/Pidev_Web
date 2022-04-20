<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Competance
 *
 * @ORM\Table(name="competance", indexes={@ORM\Index(name="fk_competencePersonne", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="App\Repository\CompetanceRepository")
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
     * @Assert\NotBlank(message="vous devez entrer nom du competence")
     * @ORM\Column(name="nomCompetance", type="string", length=30, nullable=false)
     */
    private $nomcompetance;

    /**
     * @var string
     * @Assert\NotBlank(message="vous devez entrer votre niveau")
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $idUser;

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

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
