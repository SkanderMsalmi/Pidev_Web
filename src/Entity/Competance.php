<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competance
 *
 * @ORM\Table(name="competance", indexes={@ORM\Index(name="fk_competencePersonne", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Competance
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCompetance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompetance;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCompetance", type="string", length=30, nullable=false)
     */
    private $nomcompetance;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=0, nullable=false)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="verifie", type="string", length=0, nullable=false)
     */
    private $verifie;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersonne", referencedColumnName="id")
     * })
     */
    private $idpersonne;


}
