<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hypersites\StockBundle\Exceptions;

/**
 * Description of SupplierException
 *
 * @author aandrade
 */
class SupplierException extends \Exception{
    
    const INVALID_FISCAL_DOCUMENT = 1;
    
    const REPETEAD_FISCAL_DOCUMENT = 2;
    
    const INVALID_EMAIL = 3;
    
    const DEFAULT_EXCEPTION = 0;
    
    const DEFAULT_MESSAGE = "You tried to create a invalid supplier";
    
    public function __construct($message="", $code=0, \Exception $previous = null) {
        $this->setMessage($message, $code);
    }
    
    public function setMessage( $message, $code ) {
        
        switch ($code) {
            case self::INVALID_EMAIL:
                $message = "The email you supplied was invalid or was already on our database";
            break;
            case self::REPETEAD_FISCAL_DOCUMENT:
                $message = "You already have a supplier with this fiscal document";
            break;
            case self::INVALID_FISCAL_DOCUMENT:
                $message = "The fiscal documented you inserted is invalid";
            break;
            case self::DEFAULT_EXCEPTION:
                $message = self::DEFAULT_MESSAGE;
            break;
        }
        $this->message = $message;
        return $this;
    }
    
    
}
