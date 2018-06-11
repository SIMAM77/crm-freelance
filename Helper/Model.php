<?php

namespace Helper;
use Doctrine\ORM\EntityManager;

/**
 * Model Class
 * @package Model
 */
abstract class Model
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Repository constructor
     */
    public function __construct()
    {
        $repositoryReflection = new \ReflectionClass($this);
        $this->entityManager = ServiceContainer::getService('EntityManager');
        // check if repository has $entity property

        try {
            $repositoryReflection->getProperty('entity');
        } catch (\ReflectionException $e) {
            throw new Exception(
                'Please set Entity property name in Repository.'
            );
        }
    }
}