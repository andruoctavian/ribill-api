<?php

namespace App\Service;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DatabaseService
{
    /** @var RegistryInterface */
    private $doctrine;

    /**
     * DatabaseService constructor.
     * @param RegistryInterface $doctrine
     */
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param string|null $name
     * @return ObjectManager
     */
    public function getManager(?string $name = null): ObjectManager
    {
        return $this->doctrine->getManager($name);
    }

    /**
     * @param string $className
     * @param string|null $manager
     * @return ObjectRepository
     */
    public function getRepository(string $className, ?string $manager = null): ObjectRepository
    {
        return $this->getManager($manager)->getRepository($className);
    }

    /**
     * @param string $class
     * @param $id
     * @return object|null
     */
    public function find(string $class, $id)
    {
        return $this->getRepository($class)->find($id);
    }

    /**
     * @param string $class
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return object[]
     */
    public function findBy(string $class, array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->getRepository($class)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param string $class
     * @param array $criteria
     * @return object|null
     */
    public function findOneBy(string $class, array $criteria)
    {
        return $this->getRepository($class)->findOneBy($criteria);
    }

    /**
     * @param string $class
     * @return object[]
     */
    public function findAll(string $class): array
    {
        return $this->getRepository($class)->findAll();
    }

    /**
     * @param $object
     */
    public function save($object): void
    {
        /** @var ObjectManager $om */
        $om = $this->getManager();

        $om->persist($object);
        $om->flush();
    }

    /**
     * @param $object
     */
    public function delete($object): void
    {
        /** @var ObjectManager $om */
        $om = $this->getManager();

        $om->remove($object);
        $om->flush();
    }
}