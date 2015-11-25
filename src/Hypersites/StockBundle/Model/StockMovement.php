<?php
namespace Hypersites\StockBundle\Model;

use Hypersites\StockBundle\Entity\StockMovement as MovementEntity;
use Hypersites\StockBundle\Entity\ProductVariation;
use Hypersites\StockBundle\Entity\Item;


/**
 * Description of StockMovement
 *
 * @author aandrade
 */
class StockMovement {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }
    
    public function getItemsForInternalOperations(ProductVariation $productVariation) {
        
        return $this->em->getRepository("HypersitesStockBundle:Item")->getPossibleForInternalUse($productVariation);
        
    }
    
    public function sell() {
        
    }
    
    public function buy() {
        
    }
    
    public function sendToService() {
        
    }
    
    public function receiveFromCustomer() {
        
    }
    
    public function rent() {
        
    }
    
}
