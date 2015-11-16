<?php


namespace Pronamic\Twinfield\Invoice;


class InvoicePaidStatus
{
    /**
     * @var int
     */
    protected $invoiceNumber;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var float
     */
    protected $totalAmount;
    /**
     * @var float
     */
    protected $amountOpen;

    const STATUS_FULLY_PAID = 'COMPLETE';
    const STATUS_PARTIALLY_PAID = 'PARTIAL';
    const STATUS_UNPAID = 'OPEN';

    /**
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param int $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getPaidAmount()
    {
        return $this->totalAmount - $this->amountOpen;
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return float
     */
    public function getAmountOpen()
    {
        return $this->amountOpen;
    }

    /**
     * @param float $amountOpen
     */
    public function setAmountOpen($amountOpen)
    {
        $this->amountOpen = $amountOpen;
    }
}