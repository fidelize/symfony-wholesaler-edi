<?php

namespace ApiBundle\Model\Order;

class Item
{
    /**
     * @var string EAN code
     */
    protected $ean;

    /**
     * @var int Item amount
     */
    protected $amount;

    /**
     * @var bool Monitored
     */
    protected $monitored;

    /**
     * @var float Discount
     */
    protected $discount;

    /**
     * @var float Net price
     */
    protected $netPrice;

    /**
     * Return EAN code.
     *
     * @return string EAN code
     */
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * Define EAN code.
     *
     * @param string $ean EAN code
     *
     * @return Item
     */
    public function setEan(string $ean): Item
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Return amount.
     *
     * @return int Amount
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Define amount.
     *
     * @param int $amount Amount
     *
     * @return Item
     */
    public function setAmount(int $amount): Item
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Verify monitored.
     *
     * @return bool Monitored
     */
    public function isMonitored(): bool
    {
        return $this->monitored;
    }

    /**
     * Define monitored.
     *
     * @param bool $monitored Monitored
     *
     * @return Item
     */
    public function setMonitored(bool $monitored):Item
    {
        $this->monitored = $monitored;

        return $this;
    }

    /**
     * Return item discount.
     *
     * @return float Discount
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Define item discount.
     *
     * @param float $discount Discount
     *
     * @return Item
     */
    public function setDiscount(float $discount): Item
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Return net price.
     *
     * @return float Net price
     */
    public function getNetPrice(): float
    {
        return $this->netPrice;
    }

    /**
     * Define net price.
     *
     * @param float $netPrice Net price
     *
     * @return Item
     */
    public function setNetPrice(float $netPrice): Item
    {
        $this->netPrice = $netPrice;

        return $this;
    }
}
