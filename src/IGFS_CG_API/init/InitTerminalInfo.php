<?php

namespace Railken\Unicredit\IGFS_CG_API\init;

class InitTerminalInfo
{
    public $tid;
    public $payInstrToken;

    public function __construct()
    {
    }

    public function toXml()
    {
        $sb = "";
        $sb .= "<termInfo>";
        if ($this->tid != null) {
            $sb .= "<tid><![CDATA[";
            $sb .= $this->tid;
            $sb .= "]]></tid>";
        }
        if ($this->payInstrToken != null) {
            $sb .= "<payInstrToken><![CDATA[";
            $sb .= $this->payInstrToken;
            $sb .= "]]></payInstrToken>";
        }
        $sb .= "</termInfo>";
        return $sb;
    }
}
