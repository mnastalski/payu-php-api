<?php

namespace Payu\Order;

use Payu\Entity\Entity;
use Payu\Entity\Product;

class Order extends Entity
{
    const API_ENDPOINT = 'orders/';
    const API_METHOD = 'post';

    protected $ext_order_id;
    protected $notify_url;
    protected $order_url;
    protected $customer_ip;
    protected $validity_time;
    protected $description;
    protected $description_extra;
    protected $currency_code;
    protected $total_amount;
    protected $continue_url;
    protected $settings;
    protected $buyer;
    protected $shipping_methods;
    protected $products;
    protected $pay_methods;

    public function __construct(array $data = [])
    {
        $this->setCustomerIp($_SERVER['REMOTE_ADDR']);

        $this->loadFromArray($data);
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @return mixed
     */
    public function getExtOrderId()
    {
        return $this->ext_order_id;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setExtOrderId($value)
    {
        $this->ext_order_id = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setNotifyUrl($value)
    {
        $this->notify_url = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderUrl()
    {
        return $this->order_url;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setOrderUrl($value)
    {
        $this->order_url = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerIp()
    {
        return $this->customer_ip;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setCustomerIp($value)
    {
        $this->customer_ip = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidityTime()
    {
        return $this->validity_time;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setValidityTime($value)
    {
        $this->validity_time = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setDescription($value)
    {
        $this->description = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionExtra()
    {
        return $this->description_extra;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setDescriptionExtra($value)
    {
        $this->description_extra = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setCurrencyCode($value)
    {
        $this->currency_code = strtoupper($value);

        return $this;

    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param mixed $value
     * @param bool $modify
     * @return Order
     */
    public function setTotalAmount($value, $modify = true)
    {
        $this->total_amount = $modify ? (int) $value * 100 : (int) $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContinueUrl()
    {
        return $this->continue_url;
    }

    /**
     * @param mixed $value
     * @return Order
     */
    public function setContinueUrl($value)
    {
        $this->continue_url = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     * @return Order
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param mixed $buyer
     * @return Order
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingMethods()
    {
        return $this->shipping_methods;
    }

    /**
     * @param mixed $shipping_methods
     * @return Order
     */
    public function setShippingMethods($shipping_methods)
    {
        $this->shipping_methods = $shipping_methods;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        $products = [];

        foreach ($this->products as $product)
        {
            $products[] = $product->getParameters();
        }

        return $products;
    }

    /**
     * @param array $products
     * @return $this
     * @throws \Exception
     */
    public function setProducts(array $products)
    {
        /*
        foreach ($products as $product) {
            if (!$product instanceof Product) {
                throw new \Exception('Products must be an instance of Product');
            }
        }
        */

        $this->products = $products;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayMethods()
    {
        return $this->pay_methods;
    }

    /**
     * @param mixed $pay_methods
     * @return Order
     */
    public function setPayMethods($pay_methods)
    {
        $this->pay_methods = $pay_methods;

        return $this;
    }
}
