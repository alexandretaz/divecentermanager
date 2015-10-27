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
    
    
    /**
     * 
     * @param array $filters
     * @param type $fields
     * @return array
     */
    public function getList( array $filters= array(), $fields=array()  ) {
        $em = $this->em;
        $entities = $em->getRepository('HypersitesStockBundle:Supplier')->getList($fields);
        return $entities;
    }
    
    public function save($entity) {
            $this->em->persist($entity);
            $this->em->flush();
    }
    
    /**
     * Static Methods
     */
    
    /**
     * 
     * @param type $em
     * @param array $fields
     * @return type
     */
    public static function getFullList($em, array $fields = array()) {
        $_instance = new self($em);
        return $_instance->getList(array(), $fields);
    }
    
    public static function process($em, $entity) {
        $_instance = new self($em);
        return $_instance->save($entity);
    }
    
    
    
}
