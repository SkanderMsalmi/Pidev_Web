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


}
