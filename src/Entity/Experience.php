<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience", indexes={@ORM\Index(name="fk_personneExperience", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
{
    /**
     * @var int
     * @ORM\Column(name="idExperience", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexperience;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrer le poste svp")
     * @ORM\Column(name="poste", type="string", length=30, nullable=false)
     */
    private $poste;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrer le nom de societe svp")
     * @ORM\Column(name="societe", type="string", length=30, nullable=false)
     */
    private $societe;

    /**
     * @var string
     * @Assert\NotBlank(message="entrer vos competences mise en oeuvre")
     * @ORM\Column(name="competanMiseEnOuvre", type="string", length=30, nullable=false)
     */
    private $competanmiseenouvre;

    /**
     * @Assert\NotBlank(message="Inserer des informatiques a propos votre stage")
     * @Assert\Length(
     *  min=20,
     *     max=50,
     *     minMessage = " username doit etre au moins 20 caractères",
     *     maxMessage = "username doit etre au max 50 caractères",
     *
     * )
     * @ORM\Column(name="description",type="string",   nullable=true)
     */
    private $description;

    /**
     * @var \Date
     * @Assert\LessThan("today")
     * @Assert\Expression (
     *     "this.getDatedebut() != null",
     *     message="entrer date"
     * )
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \Date
     * @Assert\LessThan("today",message="Veuillez vous entrer votre experiencee apres qu'elle termine")
     * @Assert\Expression(
     *     "this.getDatefin() >= this.getDatedebut()",
     *     message="Impossible d'avoir date final avant date debut"
     * )
     * @Assert\Expression (
     *     "this.getDatefin() != null",
     *     message="entrer date"
     * )
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


    public function setDatedebut(?\DateTimeInterface $datedebut): self

    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self

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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


}
