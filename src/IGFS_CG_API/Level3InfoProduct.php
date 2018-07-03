<?php

namespace Railken\Unicredit\IGFS_CG_API;

use SimpleXMLElement;

class Level3InfoProduct
{
    public $productCode;
    public $productDescription;
    public $items;
    public $amount;
    public $imgURL;

    public function __construct()
    {
    }

    public function toXml()
    {
        $sb = "";
        $sb .= "<product>";
        if ($this->productCode != null) {
            $sb .= "<productCode><![CDATA[";
            $sb .= $this->productCode;
            $sb .= "]]></productCode>";
        }
        if ($this->productDescription != null) {
            $sb .= "<productDescription><![CDATA[";
            $sb .= $this->productDescription;
            $sb .= "]]></productDescription>";
        }
        if ($this->items != null) {
            $sb .= "<items><![CDATA[";
            $sb .= $this->items;
            $sb .= "]]></items>";
        }
        if ($this->amount != null) {
            $sb .= "<amount><![CDATA[";
            $sb .= $this->amount;
            $sb .= "]]></amount>";
        }
        if ($this->imgURL != null) {
            $sb .= "<imgURL><![CDATA[";
            $sb .= $this->imgURL;
            $sb .= "]]></imgURL>";
        }
        $sb .= "</product>";
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
        $product = null;
        if (isset($response) && count($response)>0) {
            $product = new Level3InfoProduct();
            $product->productCode = (IgfsUtils::getValue($response, "productCode"));
            $product->productDescription = (IgfsUtils::getValue($response, "productDescription"));
            $product->items = (IgfsUtils::getValue($response, "items"));
            $product->amount = (IgfsUtils::getValue($response, "amount"));
            $product->imgURL = (IgfsUtils::getValue($response, "imgURL"));
        }
        return $product;
    }
}
