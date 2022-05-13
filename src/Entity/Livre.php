<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert ;


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
     * @Assert\NotBlank(message="titre est vide ")
     * @ORM\Column(name="titreL", type="string", length=20, nullable=false)
     */
    private $titrel;

    /**
     * @var string
     *@Assert\NotBlank(message="auteur est vide ")
     * @ORM\Column(name="auteurL", type="string", length=20, nullable=false)
     */
    private $auteurl;

    /**
     * @var string
     *@Assert\NotBlank(message="Description est vide ")
     * @ORM\Column(name="descriptionL", type="string", length=20, nullable=false)
     */
    private $descriptionl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pdfivre", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $pdfivre = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="imageString", type="string", length=255, nullable=false)
     */
    private $imagestring;

    /**
     * @var \Bibliotheque
     *
     * @ORM\ManyToOne(targetEntity=Bibliotheque::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="intC", referencedColumnName="intC")
     * })
     */
    private $intc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image;


    private $RateTotal;

    /**
     * @return mixed
     */
    public function getRateTotal()
    {
        return $this->RateTotal;
    }

    /**
     * @param mixed $RateTotal
     */
    public function setRateTotal($RateTotal): void
    {
        $this->RateTotal = $RateTotal;
    } 

    public function getIdl(): ?int
    {
        return $this->idl;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }


    public function setImage(?string $image): void
    {
        $this->image = $image;
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

    public function getPdfivre(): ?string
    {
        return $this->pdfivre;
    }

    public function setPdfivre(?string $pdfivre): self
    {
        $this->pdfivre = $pdfivre;

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

    public function getIntc(): ?Bibliotheque
    {
        return $this->intc;
    }

    public function setIntc(?Bibliotheque $intc): self
    {
        $this->intc = $intc;

        return $this;
    }








    public function __toString(): string
    {
        return $this->getIntc();
    }




}

