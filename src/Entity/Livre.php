<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="livre", indexes={@ORM\Index(name="fk_livreBiblio", columns={"intC"})})
 * @ORM\Entity
 */
class Livre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idl;

    /**
     * @var string
     *
     * @ORM\Column(name="titreL", type="string", length=30, nullable=false)
     */
    private $titrel;

    /**
     * @var string
     *
     * @ORM\Column(name="auteurL", type="string", length=20, nullable=false)
     */
    private $auteurl;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionL", type="string", length=20, nullable=false)
     */
    private $descriptionl;

    /**
     * @var string
     *
     * @ORM\Column(name="imageString", type="string", length=255, nullable=false)
     */
    private $imagestring;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfivre", type="string", length=255, nullable=false)
     */
    private $pdfivre;

    /**
     * @var \Bibliotheque
     *
     * @ORM\ManyToOne(targetEntity="Bibliotheque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intC", referencedColumnName="intC")
     * })
     */
    private $intc;

    public function getIdl(): ?int
    {
        return $this->idl;
    }

    public function getTitrel(): ?string
    {
        return $this->titrel;
    }

    public function setTitrel(string $titrel): self
    {
        $this->titrel = $titrel;

        return $this;
    }

    public function getAuteurl(): ?string
    {
        return $this->auteurl;
    }

    public function setAuteurl(string $auteurl): self
    {
        $this->auteurl = $auteurl;

        return $this;
    }

    public function getDescriptionl(): ?string
    {
        return $this->descriptionl;
    }

    public function setDescriptionl(string $descriptionl): self
    {
        $this->descriptionl = $descriptionl;

        return $this;
    }

    public function getImagestring(): ?string
    {
        return $this->imagestring;
    }

    public function setImagestring(string $imagestring): self
    {
        $this->imagestring = $imagestring;

        return $this;
    }

    public function getPdfivre(): ?string
    {
        return $this->pdfivre;
    }

    public function setPdfivre(string $pdfivre): self
    {
        $this->pdfivre = $pdfivre;

        return $this;
    }

    public function getIntc(): ?Bibliotheque
    {
        return $this->intc;
    }

    public function setIntc(?Bibliotheque $intc): self
    {
        $this->intc = $intc;

        return $this;
    }


}
