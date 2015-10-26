<?php
namespace Hypersites\StockBundle\Model;
use Hypersites\StockBundle\Entity\Supplier as SupplierEntity;
use Hypersites\StockBundle\Entity\SupplierRepository; 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supplier
 *
 * @author aandrade
 */
class Supplier extends StockModel {
    
    public function getList( array $filters= array() ) {
        $em = $this->em;
        $entities = $em->getRepository('HypersitesStockBundle:Supplier')->find();
        return $entities;
    }
    
    /**
     * Static Methods
     */
    
    public static function getFullList($em) {
        $_instance = new self($em);
        return $_instance->getList();
    }
    
    public static function getPartial($em) {
        $_instance = new self($em);
        
    }
    
}
