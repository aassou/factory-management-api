<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractManager implements CrudManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;
}
