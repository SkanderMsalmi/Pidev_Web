<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RemembermeToken
 *
 * @ORM\Table(name="rememberme_token")
 * @ORM\Entity
 */
class RemembermeToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="series", type="string", length=88, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $series;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=88, nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUsed", type="datetime", nullable=false)
     */
    private $lastused;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=100, nullable=false)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=200, nullable=false)
     */
    private $username;


}
