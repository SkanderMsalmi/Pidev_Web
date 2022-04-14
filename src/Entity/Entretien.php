<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entretien
 *
 * @ORM\Table(name="entretien", indexes={@ORM\Index(name="fk_entretienStage", columns={"idStage"})})
 * @ORM\Entity
 */
class Entretien
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEntretien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identretien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEntretien", type="date", nullable=false)
     */
    private $dateentretien;

    /**
     * @var string
     *
     * @ORM\Column(name="heureEntretien", type="string", length=30, nullable=false)
     */
    private $heureentretien;

    /**
     * @var string
     *
     * @ORM\Column(name="lienEntretien", type="string", length=255, nullable=false)
     */
    private $lienentretien;

    /**
     * @var \Stage
     *
     * @ORM\ManyToOne(targetEntity="Stage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idStage", referencedColumnName="idStage")
     * })
     */
    private $idstage;


}
