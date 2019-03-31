<?php

namespace App\Entity\Extension;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait EntityIdTrait
 * @package App\Entity\Extension
 */
trait EntityIdTrait
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}