<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="fk_personneAdresse", columns={"idPersonne"})})
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAdresse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadresse;

    /**
     * @var int
     *
     * @ORM\Column(name="rue", type="integer", nullable=false)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=30, nullable=false)
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer", nullable=false)
     */
    private $codepostal;

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
