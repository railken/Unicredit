<?php

namespace Railken\Unicredit\IGFS_CG_API\init;

use Railken\Unicredit\IGFS_CG_API\BaseIgfsCg;

abstract class BaseIgfsCgInit extends BaseIgfsCg
{
    public $shopID; // chiave messaggio

    public function __construct()
    {
        parent::__construct();
    }

    protected function resetFields()
    {
        parent::resetFields();
        $this->shopID = null;
    }

    protected function checkFields()
    {
        parent::checkFields();
        if ($this->shopID == null || "" == $this->shopID) {
            throw new IgfsMissingParException("Missing shopID");
        }
    }

    protected function buildRequest()
    {
        $request = parent::buildRequest();
        $request = $this->replaceRequest($request, "{shopID}", $this->shopID);
        return $request;
    }

    protected function getServicePort()
    {
        return "PaymentInitGatewayPort";
    }
}
