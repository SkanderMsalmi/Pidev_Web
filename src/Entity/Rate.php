<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate", indexes={@ORM\Index(name="fk_livre", columns={"idL"})})
 * @ORM\Entity
 */
class Rate
{
    /**
     * @var int
     *
     * @ORM\Column(name="idr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idr;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $rate;

    /**
     * @var \Livre
     *
     * @ORM\ManyToOne(targetEntity="Livre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idL", referencedColumnName="idL")
     * })
     */
    private $idl;

    public function getIdr(): ?int
    {
        return $this->idr;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getIdl(): ?Livre
    {
        return $this->idl;
    }

    public function setIdl(?Livre $idl): self
    {
        $this->idl = $idl;

        return $this;
    }


}
