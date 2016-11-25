<?php

namespace ApiBundle\Model;

use ApiBundle\Model\Order\Item;

class Order
{
    /**
     * @var int Order identifier
     */
    protected $id;

    /**
     * @var string Project code
     */
    protected $projectCode;

    /**
     * @var string Pos code
     */
    protected $posCode;

    /**
     * @var string E-mail
     */
    protected $email;

    /**
     * @var string Wholesaler code
     */
    protected $wholesalerCode;

    /**
     * @var string Term
     */
    protected $term;

    /**
     * @var string Condition code
     */
    protected $conditionCode;

    /**
     * @var string Order client
     */
    protected $orderClient;

    /**
     * @var string Markup
     */
    protected $markup;

    /**
     * @var array Order itens
     */
    protected $itens;

    public function __construct()
    {
        $this->itens = [];
    }

    /**
     * Return order identifier.
     *
     * @return int Order identifier
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define order identifier.
     *
     * @param int $id Order identifier
     *
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Return project code.
     *
     * @return string Project code
     */
    public function getProjectCode(): string
    {
        return $this->projectCode;
    }

    /**
     * Define project code.
     *
     * @param string $projectCode Project code
     *
     * @return Order
     */
    public function setProjectCode(string $projectCode): Order
    {
        $this->projectCode = $projectCode;

        return $this;
    }

    /**
     * Return pos code.
     *
     * @return string Pos code
     */
    public function getPosCode(): string
    {
        return $this->posCode;
    }

    /**
     * Define pos code.
     *
     * @param string $posCode Pos code
     *
     * @return Order
     */
    public function setPosCode(string $posCode): Order
    {
        $this->posCode = $posCode;

        return $this;
    }

    /**
     * Return e-mail.
     *
     * @return string E-mail
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Define e-mail.
     *
     * @param string $email E-mail
     *
     * @return Order
     */
    public function setEmail(string $email): Order
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Return wholesaler code.
     *
     * @return string Wholesaler code
     */
    public function getWholesalerCode(): string
    {
        return $this->wholesalerCode;
    }

    /**
     * Define wholesaler code.
     *
     * @param string $wholesalerCode Wholesaler code
     *
     * @return Order
     */
    public function setWholesalerCode(string $wholesalerCode): Order
    {
        $this->wholesalerCode = $wholesalerCode;

        return $this;
    }

    /**
     * Return term.
     *
     * @return string Term
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * Define term.
     *
     * @param string $term Term
     *
     * @return Order
     */
    public function setTerm(string $term): Order
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Return condition code.
     *
     * @return string Condition code
     */
    public function getConditionCode(): string
    {
        return $this->conditionCode;
    }

    /**
     * Define condition code.
     *
     * @param string $conditionCode Condition code
     *
     * @return Order
     */
    public function setConditionCode(string $conditionCode): Order
    {
        $this->conditionCode = $conditionCode;

        return $this;
    }

    /**
     * Return order client.
     *
     * @return string Order client
     */
    public function getOrderClient(): string
    {
        return $this->orderClient;
    }

    /**
     * Define order client.
     *
     * @param string $orderClient Order client
     *
     * @return Order
     */
    public function setOrderClient(string $orderClient): Order
    {
        $this->orderClient = $orderClient;

        return $this;
    }

    /**
     * Return markup.
     *
     * @return string Markup
     */
    public function getMarkup(): string
    {
        return $this->markup;
    }

    /**
     * Define markup.
     *
     * @param string $markup Markup
     *
     * @return Order
     */
    public function setMarkup(string $markup): Order
    {
        $this->markup = $markup;

        return $this;
    }

    /**
     * Return a order itens collection.
     *
     * @return array Order itens
     */
    public function getItens(): array
    {
        return $this->itens;
    }

    /**
     * Add a item to the order.
     *
     * @param Item $item Order item
     *
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->itens[] = $item;

        return $this;
    }

    /**
     * Remove a item to the order.
     *
     * @param Item $item Order item
     *
     * @return $this
     */
    public function removeItem(Item $item)
    {
        $key = array_search($item, $this->itens, true);
        if ($key === false) {
            unset($this->itens[$key]);
        }

        return $this;
    }

    /**
     * Define a order itens collection.
     *
     * @param array $itens Order itens
     *
     * @return Order
     */
    public function setItens(array $itens): Order
    {
        foreach ($itens as &$item) {
            if ($item instanceof Item) {
                $this->itens[] = $item;
            }
        }

        return $this;
    }
}
