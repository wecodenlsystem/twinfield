<?php

use Pronamic\Twinfield\Customer\DOM\CustomersDocument;

/**
 * Class CustomersDocumentTest
 */
class CustomersDocumentTest extends \PHPUnit_Framework_TestCase
{
    public function testAddCustomerWithCodeAndOffice()
    {
        $customer = new \Pronamic\Twinfield\Customer\Customer();
        $customer->setCode('0001');
        $customer->setOffice('0123');

        $document = new CustomersDocument();
        $document->addCustomer($customer);

        $xml = $document->saveXML();
        $this->assertContains('<code>0001</code>', $xml);
        $this->assertContains('<office>0123</office>', $xml);
    }

    public function testAddCustomerWithoutCodeAndOffice()
    {
        $customer = new \Pronamic\Twinfield\Customer\Customer();

        $document = new CustomersDocument();
        $document->addCustomer($customer);

        $xml = $document->saveXML();
        $this->assertNotContains('<code></code>', $xml);
        $this->assertNotContains('</code>', $xml);
        $this->assertNotContains('<office></office>', $xml);
        $this->assertNotContains('</office>', $xml);
    }
}