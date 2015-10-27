<?php
 namespace Hypersites\StockBundle\Model\Supplier;
 
 use Hypersites\StockBundle\Entity\Supplier as SupplierEntity;

/**
 * Description of Validator
 *
 * @author alexandretaz
 */
class Validator {
    
    protected $em;
    
    public function __construct(EntityManagerService $ems) {
        $this->em = $ems->getEm();
    }
    
    private function validateEntity(SupplierEntity $entity) {
        $answer = false;
        
    }   
    
    
    
}
