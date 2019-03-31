<?php

namespace App\Entity;

use App\Entity\Extension\EntityIdTrait;
use App\Entity\Extension\EntityNameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Service
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="services")
 */
class Service
{
    use EntityIdTrait, EntityNameTrait;
}