<?php
namespace Pronamic\Twinfield\Browse\Mapper;

use DOMElement;
use Pronamic\Twinfield\Invoice\InvoicePaidStatus;
use Pronamic\Twinfield\Response\Response;

class BrowseMapper
{
    /**
     * @param Response $response
     *
     * @return InvoicePaidStatus[]
     */
    public static function mapInvoicePaidStatus(Response $response)
    {
        $responseDOM = $response->getResponseDocument();
        $result = array();

        $rows = $responseDOM->getElementsByTagName('tr');
        /** @var DomElement $row */
        foreach($rows as $row) {
            $fields = $row->getElementsByTagName('td');
            $invoicePaidStatus = new InvoicePaidStatus();
            /** @var DomElement $field */
            foreach($fields as $field) {
                $fieldName = $field->getAttribute('field');
                if($fieldName == 'fin.trs.head.number') {
                    $invoicePaidStatus->setInvoiceNumber((int) $field->textContent);
                }
                if($fieldName == 'fin.trs.head.status') {
                    $invoicePaidStatus->setStatus($field->textContent);
                }
                if($fieldName == 'fin.trs.line.valuesigned') {
                    $invoicePaidStatus->setTotalAmount((float) $field->textContent);
                }
                if($fieldName == 'fin.trs.line.openvaluesigned') {
                    $invoicePaidStatus->setAmountOpen((float) $field->textContent);
                }
            }
            $result[$invoicePaidStatus->getInvoiceNumber()] = $invoicePaidStatus;
        }

        return $result;
    }
}
