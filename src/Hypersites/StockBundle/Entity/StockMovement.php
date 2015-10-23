<?php

namespace Hypersites\StockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StockMovement
 *
 * @ORM\Table(name="stock_movement")
 * @ORM\Entity(repositoryClass="Hypersites\StockBundle\Entity\StockMovementRepository")
 */
class StockMovement
{
    
    const ENTERED_FROM_SUPPLIER = 1;
    const SELLED = 2;
    const RETURNED_BY_CUSTOMER = 3;
    const RETURNED_TO_SUPPLIER = 4;
    const INTERNAL_USE = 5;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="kind_movement", type="smallint")
     */
    private $kindMovement;

    /**
     * @var string
     *
     * @ORM\Column(name="moved_by", type="string", length=45)
     */
    private $movedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="movement_date", type="datetime")
     */
    private $movementDate;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Item", mappedBy="movements")
     */
    private $items;
    
    public function __construct() {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set kindMovement
     *
     * @param integer $kindMovement
     *
     * @return StockMovement
     */
    public function setKindMovement($kindMovement)
    {
        $this->kindMovement = $kindMovement;

        return $this;
    }

    /**
     * Get kindMovement
     *
     * @return integer
     */
    public function getKindMovement()
    {
        return $this->kindMovement;
    }

    /**
     * Set movedBy
     *
     * @param string $movedBy
     *
     * @return StockMovement
     */
    public function setMovedBy($movedBy)
    {
        $this->movedBy = $movedBy;

        return $this;
    }

    /**
     * Get movedBy
     *
     * @return string
     */
    public function getMovedBy()
    {
        return $this->movedBy;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return StockMovement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set movementDate
     *
     * @param \DateTime $movementDate
     *
     * @return StockMovement
     */
    public function setMovementDate($movementDate)
    {
        $this->movementDate = $movementDate;

        return $this;
    }

    /**
     * Get movementDate
     *
     * @return \DateTime
     */
    public function getMovementDate()
    {
        return $this->movementDate;
    }
}

