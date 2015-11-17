<?php
namespace Pronamic\Twinfield\Browse\DOM;


use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;

class BrowsePaymentStatusDocument extends DOMDocument
{
    protected $rootElement;

    const BASE_XML = '<columns code="100">
       <column>
          <field>fin.trs.head.code</field>
          <label>Transaction type</label>
          <visible>false</visible>
          <ask>true</ask>
          <operator>equal</operator>
          <from>VRK</from>
       </column>
       <column>
          <field>fin.trs.head.number</field>
          <label>Trans. no.</label>
          <visible>true</visible>
       </column>
       <column>
          <field>fin.trs.head.status</field>
          <label>Status</label>
          <visible>true</visible>
          <ask>true</ask>
          <operator>equal</operator>
          <from>normal</from>
          <to></to>
       </column>
       <column>
          <field>fin.trs.line.dim2</field>
          <label>Customer</label>
          <visible>true</visible>
          <ask>true</ask>
          <operator>between</operator>
          <from></from>
          <to></to>
       </column>
       <column>
          <field>fin.trs.line.valuesigned</field>
          <label>Value</label>
          <visible>true</visible>
       </column>
       <column>
          <field>fin.trs.line.openvaluesigned</field>
          <label>Open amount</label>
          <visible>true</visible>
       </column>
       <column>
          <field>fin.trs.line.matchstatus</field>
          <label>Payment status</label>
          <visible>false</visible>
          <ask>true</ask>
          <operator>equal</operator>
          <from>available</from>
       </column>
    </columns>';

    public function __construct()
    {
        parent::__construct();

        $this->loadXML(self::BASE_XML);
    }

    public function setQueryStatus($status) {
        $columns = $this->getElementsByTagName('column');
        /** @var DomElement $column */
        foreach($columns as $column) {
            $field = $column->getElementsByTagName('field')->item(0);
            if($field->textContent == 'fin.trs.line.matchstatus') {
                $node = $column->getElementsByTagName('from')->item(0);
                $node->removeChild($node->firstChild);
                $node->appendChild(new DOMText($status));
            }
        }
    }


}