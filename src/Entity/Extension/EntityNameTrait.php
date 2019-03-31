<?php

namespace App\Entity\Extension;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait EntityNameTrait
 * @package App\Entity\Extension
 */
trait EntityNameTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @return string|null
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

}