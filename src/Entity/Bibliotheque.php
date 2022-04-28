<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
     * @ORM\Column(name="nomC", type="string", length=20, nullable=false)
     */
    private $nomc;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionC", type="string", length=20, nullable=false)
     */
    private $descriptionc;

    /**
     * @var string
     *
     * @ORM\Column(name="domaineC", type="string", length=20, nullable=false)
     */
    private $domainec;


}
