<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Faculte
 *
 * @ORM\Table(name="faculte")
 * @ORM\Entity(repositoryClass="App\Repository\FaculteRepository")
 */
class Faculte
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFaculte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfaculte;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFaculte", type="string", length=30, nullable=false)
     */
    private $nomfaculte;

    /**
     * @var string
     *
     * @ORM\Column(name="acronyme", type="string", length=30, nullable=false)
     */
    private $acronyme;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="idfaculte")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdfaculte($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIdfaculte() === $this) {
                $user->setIdfaculte(null);
            }
        }

        return $this;
    }

    public function getIdfaculte(): ?int
    {
        return $this->idfaculte;
    }

    public function getNomfaculte(): ?string
    {
        return $this->nomfaculte;
    }

    public function setNomfaculte(string $nomfaculte): self
    {
        $this->nomfaculte = $nomfaculte;

        return $this;
    }

    public function getAcronyme(): ?string
    {
        return $this->acronyme;
    }

    public function setAcronyme(string $acronyme): self
    {
        $this->acronyme = $acronyme;

        return $this;
    }

    public function __toString()
    {
        return $this->nomfaculte;
    }


}
