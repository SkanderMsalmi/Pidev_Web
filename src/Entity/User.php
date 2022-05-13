<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * User
 * @UniqueEntity(
 * fields = {"email"},
 * message =" email déjà utilisé"
 * )
 * @UniqueEntity (
 * fields = {"username"},
 * message = "Username déjà utilisé"
 * )
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D649F85E0677", columns={"username"})}, indexes={@ORM\Index(name="IDX_8D93D6499DC564F", columns={"idSociete"}),@ORM\Index(columns={"username","email","nom","prenom"},flags={"fulltext"}), @ORM\Index(name="IDX_8D93D649132E57FE", columns={"idFaculte"})})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @Assert\NotBlank(message="entrer username")
     * @Assert\Length(
     *  min=4,
     *     max=10,
     *     minMessage = " username doit etre au moins 4 caractères",
     *     maxMessage = "username doit etre au max 10 caractères",
     *
     * )
     * @ORM\Column(type="string", length=180, unique=true, nullable=false)
     */
    private $username;

    /**
     * @var array
     * @ORM\Column(name="roles", type="json", nullable=false)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @Assert\NotBlank(message="entrer un mot passe")
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     * @Assert\NotBlank(message="entrer votre nom svp")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message="entrer votre prenom svp")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var int
     * @Assert\Length(
     *     min=8,
     *     max=8,
     *     minMessage = " username doit etre au moins 4 caractères",
     *     maxMessage = "username doit etre au max 10 caractères",
     *     allowEmptyString = false
     * )
     * @ORM\Column(name="tel", type="integer", nullable=false)

     */
    private $tel;

    /**
     * @var int
     * @Assert\Length(
     *  min=8,
     *     max=8,
     *     minMessage = " username doit etre au moins 4 caractères",
     *     maxMessage = "username doit etre au max 10 caractères",
     *     allowEmptyString = false
     * )
     * @ORM\Column(name="cin", type="integer", nullable=false)

     */
    private $cin;

    /**
     * @var string
     * @Assert\Email(
     *     message = "Email n'est pas valide.",
     * )
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var string|null
     * @ORM\Column(name="pdp", type="string", length=255, nullable=true)
     */
    private $pdp;

    /**
     * @ORM\Column(name="cv", type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @var \Date
     * @Assert\LessThan("-18 years",message="vous devez etre plus que 18 ans")
     * @ORM\Column(name="datenaissance", type="date", nullable=true)
     * @Assert\Expression (
     *     "this.getDatenaissance() != null",
     *     message="entrer date"
     * )
     */
    private $datenaissance;

    /**
     * @var string
     * @Assert\NotBlank(message="entrer votre profil")
     * @ORM\Column(name="profil", type="string", length=255, nullable=false)
     */
    private $profil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="infos", type="string", length=255, nullable=true)
     */
    private $infos;

    /**
     * @var int|null

     * @ORM\Column(name="note", type="integer", nullable=true)

     */
    private $note;

    /**
     * @var \Societe

     * @ORM\ManyToOne(targetEntity="Societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSociete", referencedColumnName="idSociete")
     * })
     */
    private $idsociete;

    /**
     * @var \Faculte

     * @ORM\ManyToOne(targetEntity="Faculte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFaculte", referencedColumnName="idFaculte")
     * })
     */
    private $idfaculte;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatBlock;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * A Visual identifier that represents this yuser.
     *
     * @see UserInterface
     */
    public function getUserIdentifier():string{
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPdp()
    {
        return $this->pdp;
    }

    public function setPdp($pdp)
    {
        $this->pdp = $pdp;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getInfos(): ?string
    {
        return $this->infos;
    }

    public function setInfos(?string $infos): self
    {
        $this->infos = $infos;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdsociete(): ?Societe
    {
        return $this->idsociete;
    }

    public function setIdsociete(?Societe $idsociete): self
    {
        $this->idsociete = $idsociete;

        return $this;
    }

    public function getIdfaculte(): ?Faculte
    {
        return $this->idfaculte;
    }

    public function setIdfaculte(?Faculte $idfaculte): self
    {
        $this->idfaculte = $idfaculte;

        return $this;
    }

    public function getEtatBlock(): ?bool
    {
        return $this->etatBlock;
    }

    public function setEtatBlock(bool $etatBlock): self
    {
        $this->etatBlock = $etatBlock;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCv(): ?string
    {
        return $this->cv;
    }

    /**
     * @param string|null $cv
     */
    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
    }
    public function __toString(): ?string
    {
        if($this->getNom()== "")
        return "";
        else{
            return $this->getNom();

        }
    }


}
