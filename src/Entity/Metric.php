<?php

namespace App\Entity;

use App\Entity\Extension\EntityIdTrait;
use App\Entity\Extension\EntityNameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Metric
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="metrics")
 */
class Metric
{
    use EntityIdTrait, EntityNameTrait;

    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="Service")
     */
    private $service;

    /**
     * @var string
     * @ORM\Column(type="string", length=16)
     */
    private $method;

    /**
     * @var string
     * @ORM\Column(type="string", length=256)
     */
    private $apiUrl;

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     * @return Metric
     */
    public function setService(Service $service): Metric
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Metric
     */
    public function setMethod(string $method): Metric
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return Metric
     */
    public function setApiUrl(string $apiUrl): Metric
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }
}