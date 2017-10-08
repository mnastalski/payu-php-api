<?php

namespace Payu\Entity;

class Product extends Entity
{
    protected $name;
    protected $unit_price;
    protected $quantity;
    protected $virtual;
    protected $listing_date;

    public function __construct(array $data = [])
    {
        $this->loadFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $value
     * @return Product
     */
    public function setName($value)
    {
        $this->name = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * @param mixed $value
     * @param bool $modify
     * @return Product
     */
    public function setUnitPrice($value, $modify = true)
    {
        $this->unit_price = $modify ? (int) $value * 100 : (int) $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $value
     * @return Product
     */
    public function setQuantity($value)
    {
        $this->quantity = (int) $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVirtual()
    {
        return $this->virtual;
    }

    /**
     * @param mixed $value
     * @return Product
     */
    public function setVirtual($value)
    {
        $this->virtual = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getListingDate()
    {
        return $this->listing_date;
    }

    /**
     * @param mixed $value
     * @return Product
     */
    public function setListingDate($value)
    {
        $this->listing_date = $value;

        return $this;
    }
}
