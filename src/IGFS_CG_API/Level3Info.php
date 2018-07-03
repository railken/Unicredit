<?php

namespace Railken\Unicredit\IGFS_CG_API;

use Railken\Unicredit\IGFS_CG_API\Level3InfoProduct;
use SimpleXMLElement;

class Level3Info
{
    public $invoiceNumber;
    public $senderPostalCode;
    public $senderCountryCode;
    public $destinationName;
    public $destinationStreet;
    public $destinationStreet2;
    public $destinationStreet3;
    public $destinationCity;
    public $destinationState;
    public $destinationPostalCode;
    public $destinationCountryCode;
    public $destinationPhone;
    public $destinationFax;
    public $destinationEmail;
    public $destinationDate;
    public $billingName;
    public $billingStreet;
    public $billingStreet2;
    public $billingStreet3;
    public $billingCity;
    public $billingState;
    public $billingPostalCode;
    public $billingCountryCode;
    public $billingPhone;
    public $billingFax;
    public $billingEmail;
    public $freightAmount;
    public $taxAmount;
    public $vat;
    public $note;
    public $product;

    public function __construct()
    {
    }


    public function toXml()
    {
        $sb = "";
        $sb .= "<level3Info>";
        if ($this->invoiceNumber != null) {
            $sb .= "<invoiceNumber><![CDATA[";
            $sb .= $this->invoiceNumber;
            $sb .= "]]></invoiceNumber>";
        }
        if ($this->senderPostalCode != null) {
            $sb .= "<senderPostalCode><![CDATA[";
            $sb .= $this->senderPostalCode;
            $sb .= "]]></senderPostalCode>";
        }
        if ($this->senderCountryCode != null) {
            $sb .= "<senderCountryCode><![CDATA[";
            $sb .= $this->senderCountryCode;
            $sb .= "]]></senderCountryCode>";
        }
        if ($this->destinationName != null) {
            $sb .= "<destinationName><![CDATA[";
            $sb .= $this->destinationName;
            $sb .= "]]></destinationName>";
        }
        if ($this->destinationStreet != null) {
            $sb .= "<destinationStreet><![CDATA[";
            $sb .= $this->destinationStreet;
            $sb .= "]]></destinationStreet>";
        }
        if ($this->destinationStreet2 != null) {
            $sb .= "<destinationStreet2><![CDATA[";
            $sb .= $this->destinationStreet2;
            $sb .= "]]></destinationStreet2>";
        }
        if ($this->destinationStreet3 != null) {
            $sb .= "<destinationStreet3><![CDATA[";
            $sb .= $this->destinationStreet3;
            $sb .= "]]></destinationStreet3>";
        }
        if ($this->destinationCity != null) {
            $sb .= "<destinationCity><![CDATA[";
            $sb .= $this->destinationCity;
            $sb .= "]]></destinationCity>";
        }
        if ($this->destinationState != null) {
            $sb .= "<destinationState><![CDATA[";
            $sb .= $this->destinationState;
            $sb .= "]]></destinationState>";
        }
        if ($this->destinationPostalCode != null) {
            $sb .= "<destinationPostalCode><![CDATA[";
            $sb .= $this->destinationPostalCode;
            $sb .= "]]></destinationPostalCode>";
        }
        if ($this->destinationCountryCode != null) {
            $sb .= "<destinationCountryCode><![CDATA[";
            $sb .= $this->destinationCountryCode;
            $sb .= "]]></destinationCountryCode>";
        }
        if ($this->destinationPhone != null) {
            $sb .= "<destinationPhone><![CDATA[";
            $sb .= $this->destinationPhone;
            $sb .= "]]></destinationPhone>";
        }
        if ($this->destinationFax != null) {
            $sb .= "<destinationFax><![CDATA[";
            $sb .= $this->destinationFax;
            $sb .= "]]></destinationFax>";
        }
        if ($this->destinationEmail != null) {
            $sb .= "<destinationEmail><![CDATA[";
            $sb .= $this->destinationEmail;
            $sb .= "]]></destinationEmail>";
        }
        if ($this->destinationDate != null) {
            $sb .= "<destinationDate><![CDATA[";
            $sb .= IgfsUtils::formatXMLGregorianCalendar($this->destinationDate);
            $sb .= "]]></destinationDate>";
        }
        if ($this->billingName != null) {
            $sb .= "<billingName><![CDATA[";
            $sb .= $this->billingName;
            $sb .= "]]></billingName>";
        }
        if ($this->billingStreet != null) {
            $sb .= "<billingStreet><![CDATA[";
            $sb .= $this->billingStreet;
            $sb .= "]]></billingStreet>";
        }
        if ($this->billingStreet2 != null) {
            $sb .= "<billingStreet2><![CDATA[";
            $sb .= $this->billingStreet2;
            $sb .= "]]></billingStreet2>";
        }
        if ($this->billingStreet3 != null) {
            $sb .= "<billingStreet3><![CDATA[";
            $sb .= $this->billingStreet3;
            $sb .= "]]></billingStreet3>";
        }
        if ($this->billingCity != null) {
            $sb .= "<billingCity><![CDATA[";
            $sb .= $this->billingCity;
            $sb .= "]]></billingCity>";
        }
        if ($this->billingState != null) {
            $sb .= "<billingState><![CDATA[";
            $sb .= $this->billingState;
            $sb .= "]]></billingState>";
        }
        if ($this->billingPostalCode != null) {
            $sb .= "<billingPostalCode><![CDATA[";
            $sb .= $this->billingPostalCode;
            $sb .= "]]></billingPostalCode>";
        }
        if ($this->billingCountryCode != null) {
            $sb .= "<billingCountryCode><![CDATA[";
            $sb .= $this->billingCountryCode;
            $sb .= "]]></billingCountryCode>";
        }
        if ($this->billingPhone != null) {
            $sb .= "<billingPhone><![CDATA[";
            $sb .= $this->billingPhone;
            $sb .= "]]></billingPhone>";
        }
        if ($this->billingFax != null) {
            $sb .= "<billingFax><![CDATA[";
            $sb .= $this->billingFax;
            $sb .= "]]></billingFax>";
        }
        if ($this->billingEmail != null) {
            $sb .= "<billingEmail><![CDATA[";
            $sb .= $this->billingEmail;
            $sb .= "]]></billingEmail>";
        }
        if ($this->freightAmount != null) {
            $sb .= "<freightAmount><![CDATA[";
            $sb .= $this->freightAmount;
            $sb .= "]]></freightAmount>";
        }
        if ($this->taxAmount != null) {
            $sb .= "<taxAmount><![CDATA[";
            $sb .= $this->taxAmount;
            $sb .= "]]></taxAmount>";
        }
        if ($this->vat != null) {
            $sb .= "<vat><![CDATA[";
            $sb .= $this->vat;
            $sb .= "]]></vat>";
        }
        if ($this->note != null) {
            $sb .= "<note><![CDATA[";
            $sb .= $this->note;
            $sb .= "]]></note>";
        }
        if ($this->product != null) {
            foreach ($this->product as $item) {
                $sb .= $item->toXml();
            }
        }
        $sb .= "</level3Info>";
        return $sb;
    }

    public static function fromXml($xml)
    {
        if ($xml=="" || $xml==null) {
            return;
        }

        $dom = new SimpleXMLElement($xml, LIBXML_NOERROR, false);
        if (count($dom)==0) {
            return;
        }

        $response = IgfsUtils::parseResponseFields($dom);
        $level3Info = null;
        if (isset($response) && count($response)>0) {
            $level3Info = new Level3Info();
            
            $level3Info->invoiceNumber = (IgfsUtils::getValue($response, "invoiceNumber"));
            $level3Info->senderPostalCode = (IgfsUtils::getValue($response, "senderPostalCode"));
            $level3Info->senderCountryCode = (IgfsUtils::getValue($response, "senderCountryCode"));

            $level3Info->destinationName = (IgfsUtils::getValue($response, "destinationName"));
            $level3Info->destinationStreet = (IgfsUtils::getValue($response, "destinationStreet"));
            $level3Info->destinationStreet2 = (IgfsUtils::getValue($response, "destinationStreet2"));
            $level3Info->destinationStreet3 = (IgfsUtils::getValue($response, "destinationStreet3"));
            $level3Info->destinationCity = (IgfsUtils::getValue($response, "destinationCity"));
            $level3Info->destinationState = (IgfsUtils::getValue($response, "destinationState"));
            $level3Info->destinationPostalCode = (IgfsUtils::getValue($response, "destinationPostalCode"));
            $level3Info->destinationCountryCode = (IgfsUtils::getValue($response, "destinationCountryCode"));
            $level3Info->destinationPhone = (IgfsUtils::getValue($response, "destinationPhone"));
            $level3Info->destinationFax = (IgfsUtils::getValue($response, "destinationFax"));
            $level3Info->destinationEmail = (IgfsUtils::getValue($response, "destinationEmail"));
            $level3Info->destinationDate = (IgfsUtils::parseXMLGregorianCalendar(IgfsUtils::getValue($response, "destinationDate")));

            $level3Info->billingName = (IgfsUtils::getValue($response, "billingName"));
            $level3Info->billingStreet = (IgfsUtils::getValue($response, "billingStreet"));
            $level3Info->billingStreet2 = (IgfsUtils::getValue($response, "billingStreet2"));
            $level3Info->billingStreet3 = (IgfsUtils::getValue($response, "billingStreet3"));
            $level3Info->billingCity = (IgfsUtils::getValue($response, "billingCity"));
            $level3Info->billingState = (IgfsUtils::getValue($response, "billingState"));
            $level3Info->billingPostalCode = (IgfsUtils::getValue($response, "billingPostalCode"));
            $level3Info->billingCountryCode = (IgfsUtils::getValue($response, "billingCountryCode"));
            $level3Info->billingPhone = (IgfsUtils::getValue($response, "billingPhone"));
            $level3Info->billingFax = (IgfsUtils::getValue($response, "billingFax"));
            $level3Info->billingEmail = (IgfsUtils::getValue($response, "billingEmail"));

            $level3Info->freightAmount = (IgfsUtils::getValue($response, "freightAmount"));
            $level3Info->taxAmount = (IgfsUtils::getValue($response, "taxAmount"));
            $level3Info->vat = (IgfsUtils::getValue($response, "vat"));
            $level3Info->note = (IgfsUtils::getValue($response, "note"));

            if (isset($response["product"])) {
                $product = array();
                foreach ($dom->children() as $item) {
                    if ($item->getName() == "product") {
                        $product[] = Level3InfoProduct::fromXml($item->asXML());
                    }
                }
                $level3Info->product = $product;
            }
        }
        return $level3Info;
    }
}
