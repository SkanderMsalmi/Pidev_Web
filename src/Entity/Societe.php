<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity
 */
class Societe
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSociete", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsociete;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSociete", type="string", length=30, nullable=false)
     */
    private $nomsociete;

    public function getIdsociete(): ?int
    {
        return $this->idsociete;
    }

    public function getNomsociete(): ?string
    {
        return $this->nomsociete;
    }

    public function setNomsociete(string $nomsociete): self
    {
        $this->nomsociete = $nomsociete;

        return $this;
    }


}
