<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\ItemRepository")
 */
class Item
{
    const ON_STOCK = 1;
    
    const ON_INTERNAL_USE = 2;
    
    const SOLD = 3;
    
    const SENT_TO_SERVICE = 4;
    
    const RETURNED_BY_CUSTOMER = 5;
    
    const RENTED = 6;
    
    const LOST = 7;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ProductVariation", inversedBy="items")
     * @ORM\JoinColumn(name="product_variation_id", referencedColumnName="id")
     **/
    private $productVariation;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=255, nullable=true)
     */
    private $serial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="addedToStock", type="datetime")
     */
    private $addedToStock;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastMoved", type="datetime")
     */
    private $lastMoved;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;
    
    /**
     * @ORM\ManyToMany(targetEntity="StockMovement", inversedBy="items")
     * @ORM\JoinTable(name="stock_movement_has_item")
     **/
    private $movements;
    
    public function __construct() {
        $this->movements = new ArrayCollection() ;
        $this->addedToStock =  new \DateTime();
        $this->lastMoved = clone $this->addedToStock;
        $this->setStatus(self::ON_STOCK);
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productVariation
     *
     * @param \stdClass $productVariation
     *
     * @return Item
     */
    public function setProductVariation($productVariation)
    {
        $this->productVariation = $productVariation;

        return $this;
    }

    /**
     * Get productVariation
     *
     * @return \stdClass
     */
    public function getProductVariation()
    {
        return $this->productVariation;
    }

    /**
     * Set serial
     *
     * @param string $serial
     *
     * @return Item
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set addedToStock
     *
     * @param \DateTime $addedToStock
     *
     * @return Item
     */
    public function setAddedToStock($addedToStock)
    {
        $this->addedToStock = $addedToStock;

        return $this;
    }

    /**
     * Get addedToStock
     *
     * @return \DateTime
     */
    public function getAddedToStock()
    {
        return $this->addedToStock;
    }

    /**
     * Set lastMoved
     *
     * @param \DateTime $lastMoved
     *
     * @return Item
     */
    public function setLastMoved($lastMoved)
    {
        $this->lastMoved = $lastMoved;

        return $this;
    }

    /**
     * Get lastMoved
     *
     * @return \DateTime
     */
    public function getLastMoved()
    {
        return $this->lastMoved;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Item
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getMovements() {
        return $this->movements;
    }


}

