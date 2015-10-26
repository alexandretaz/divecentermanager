<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hypersites\StockBundle\Model;
use Symfony\Component\DependencyInjection\ContainerAware;
use AppBundle\Services\EntityManagerService;
/**
 * Description of StockModel
 *
 * @author aandrade
 */
abstract class StockModel {
    protected $em;
    
    public function __construct(EntityManagerService $ems) {
        $this->em = $ems->getEm();
    }
    
}
