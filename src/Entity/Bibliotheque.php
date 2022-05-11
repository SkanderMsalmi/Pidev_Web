<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Bibliotheque
 *
 * @ORM\Table(name="bibliotheque")
 * @ORM\Entity
 */
class Bibliotheque
{
    /**
     * @var int
     *
     * @ORM\Column(name="intC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $intc;

    /**
     * @var string
     * @Assert\NotBlank(message="Nom est vide ")
     * @ORM\Column(name="nomC", type="string", length=20, nullable=false)
     */
    private $nomc;

    /**
     * @var string
     *@Assert\NotBlank(message="Description est vide ")
     * @ORM\Column(name="descriptionC", type="string", length=20, nullable=false)
     */
    private $descriptionc;

    /**
     *
     * @var string
     *@Assert\NotBlank(message="Domaine est vide ")
     * @ORM\Column(name="domaineC", type="string", length=20, nullable=false)
     */
    private $domainec;

    public function getIntc(): ?int
    {
        return $this->intc;
    }

    public function getNomc(): ?string
    {
        return $this->nomc;
    }

    public function setNomc(string $nomc): self
    {
        $this->nomc = $nomc;

        return $this;
    }

    public function getDescriptionc(): ?string
    {
        return $this->descriptionc;
    }

    public function setDescriptionc(string $descriptionc): self
    {
        $this->descriptionc = $descriptionc;

        return $this;
    }

    public function getDomainec(): ?string
    {
        return $this->domainec;
    }

    public function setDomainec(string $domainec): self
    {
        $this->domainec = $domainec;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getIntc();
    }




}
