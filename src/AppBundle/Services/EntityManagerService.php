<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Description of EntityManagerService
 *
 * @author aandrade
 */
class EntityManagerService {
     
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function getEm() {
        return $this->em;
    }
}
