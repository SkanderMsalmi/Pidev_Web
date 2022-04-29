<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faculte
 *
 * @ORM\Table(name="faculte")
 * @ORM\Entity
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


}
