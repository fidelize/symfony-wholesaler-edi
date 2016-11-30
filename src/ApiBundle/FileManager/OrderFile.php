<?php

namespace ApiBundle\FileManager;

use ApiBundle\Model\Order;

class OrderFile extends AbstractFile
{
    /**
     * @var int Order identifier
     */
    protected $id;

    /**
     * @var Order Order object
     */
    protected $order;

    /**
     * @var \SplFileObject File object
     */
    protected $file;

    /**
     * OrderFile constructor.
     *
     * @param int    $id        Order identifier
     * @param string $directory Directory address
     * @param Order  $order     Order object
     */
    public function __construct(int $id, string $directory, Order $order)
    {
        $this->id = $id;
        $this->order = $order;
        parent::__construct($directory);
    }

    /**
     * {@inheritdoc}
     */
    protected function createFilename(): string
    {
        return implode('_', [
                'PEDIDO',
                str_pad($this->id, 10, '0'),
                str_pad($this->order->getWholesalerCode(), 14, '0'),
                $this->order->getProjectCode(),
            ]).'.PED.'.rand(1, 99999);
    }

    /**
     * Write the header line.
     *
     * @param string $posCode        Pos code
     * @param string $email          E-mail
     * @param string $wholesalerCode Wholesaler code
     * @param string $term           Term
     * @param string $conditionCode  Condition code
     * @param string $orderClient    Order client
     * @param int    $id             Order identifier
     * @param string $markup         Markup
     *
     * @return string Header line
     */
    protected function writeHeader(
        string $posCode,
        string $email,
        string $wholesalerCode,
        string $term,
        string $conditionCode,
        string $orderClient,
        int $id,
        string $markup
    ): string {
        return implode(';', [
                1,
                $posCode,
                $email,
                $wholesalerCode,
                $term,
                $conditionCode,
                $orderClient,
                $id,
                $markup,
            ]).PHP_EOL;
    }

    /**
     * Write the product line.
     *
     * @param string $ean      EAN
     * @param int    $amount   Amount
     * @param float  $discount Discount
     * @param float  $netPrice Net price
     *
     * @return string Product line
     */
    protected function writeProduct(string $ean, int $amount, float $discount, float $netPrice): string
    {
        return implode(';', [
                2,
                $ean,
                $amount,
                $discount,
                $netPrice,
            ]).PHP_EOL;
    }

    /**
     * Write the footer line.
     *
     * @param int $totalItens Total itens on Order
     *
     * @return string Footer line
     */
    protected function writeFooter(int $totalItens): string
    {
        return implode(';', [
                9,
                $totalItens,
            ]).PHP_EOL;
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->file->fwrite($this->writeHeader(
            $this->order->getPosCode(),
            $this->order->getEmail(),
            $this->order->getWholesalerCode(),
            $this->order->getTerm(),
            $this->order->getConditionCode(),
            $this->order->getOrderClient(),
            $this->id,
            $this->order->getMarkup()
        ));
        /** @var Order\Item $item */
        foreach ($this->order->getItens() as $item) {
            $this->file->fwrite($this->writeProduct(
                $item->getEan(),
                $item->getAmount(),
                $item->getDiscount(),
                $item->getNetPrice()
            ));
        }
        $this->file->fwrite($this->writeFooter(count($this->order->getItens())));

        return;
    }
}
