<?php

namespace Railken\Unicredit\IGFS_CG_API\init;

use Railken\Unicredit\IGFS_CG_API\init\BaseIgfsCgInit;
use Railken\Unicredit\IGFS_CG_API\init\InitTerminalInfo;
use Railken\Unicredit\IGFS_CG_API\Level3Info;
use Railken\Unicredit\IGFS_CG_API\MandateInfo;
use Railken\Unicredit\IGFS_CG_API\IgfsUtils;
use Railken\Unicredit\IGFS_CG_API\IgfsMissingParException;

class IgfsCgInit extends BaseIgfsCgInit
{
    public $shopUserRef;
    public $shopUserName;
    public $shopUserAccount;
    public $shopUserMobilePhone;
    public $trType = "AUTH";
    public $amount;
    public $currencyCode;
    public $langID = "IT";
    public $notifyURL;
    public $errorURL;
    public $callbackURL;
    public $addInfo1;
    public $addInfo2;
    public $addInfo3;
    public $addInfo4;
    public $addInfo5;
    public $payInstrToken;
    public $regenPayInstrToken;
    public $keepOnRegenPayInstrToken;
    public $payInstrTokenExpire;
    public $payInstrTokenUsageLimit;
    public $accountName;
    public $level3Info;
    public $mandateInfo;
    public $description;
    public $recurrent;
    public $paymentReason;
    public $topUpID;
    public $firstTopUp;
    public $payInstrTokenAsTopUpID;
    public $validityExpire;
    public $minExpireMonth;
    public $minExpireYear;
    public $termInfo;

    public $paymentID;
    public $redirectURL;

    public function __construct()
    {
        parent::__construct();
    }

    protected function resetFields()
    {
        parent::resetFields();
        $this->shopUserRef = null;
        $this->shopUserName = null;
        $this->shopUserAccount = null;
        $this->shopUserMobilePhone = null;
        $this->trType = "AUTH";
        $this->amount = null;
        $this->currencyCode = null;
        $this->langID = "IT";
        $this->notifyURL = null;
        $this->errorURL = null;
        $this->callbackURL = null;
        $this->addInfo1 = null;
        $this->addInfo2 = null;
        $this->addInfo3 = null;
        $this->addInfo4 = null;
        $this->addInfo5 = null;
        $this->payInstrToken = null;
        $this->regenPayInstrToken = null;
        $this->keepOnRegenPayInstrToken = null;
        $this->payInstrTokenExpire = null;
        $this->payInstrTokenUsageLimit = null;
        $this->accountName = null;
        $this->level3Info = null;
        $this->mandateInfo = null;
        $this->description = null;
        $this->recurrent = null;
        $this->paymentReason = null;
        $this->topUpID = null;
        $this->firstTopUp = null;
        $this->payInstrTokenAsTopUpID = null;
        $this->validityExpire = null;
        $this->minExpireMonth = null;
        $this->minExpireYear = null;
        $this->termInfo = null;

        $this->paymentID = null;
        $this->redirectURL = null;
    }

    protected function checkFields()
    {
        parent::checkFields();
        if ($this->trType == null) {
            throw new IgfsMissingParException("Missing trType");
        }
        // if ($this->trType == "TOKENIZE") {}
        // elseif ($this->trType == "DELETE") {}
        // elseif ($this->trType == "VERIFY") {}
        // else {
        // if ($this->amount == NULL)
        // throw new IgfsMissingParException("Missing amount");
        // if ($this->currencyCode == NULL)
        // throw new IgfsMissingParException("Missing currencyCode");
        // }
        if ($this->langID == null) {
            throw new IgfsMissingParException("Missing langID");
        }
        if ($this->notifyURL == null) {
            throw new IgfsMissingParException("Missing notifyURL");
        }
        if ($this->errorURL == null) {
            throw new IgfsMissingParException("Missing errorURL");
        }
        if ($this->payInstrToken != null) {
            // Se è stato impostato il payInstrToken verifico...
            if ($this->payInstrToken == "") {
                throw new IgfsMissingParException("Missing payInstrToken");
            }
        }
        if ($this->level3Info != null) {
            $i = 0;
            if ($this->level3Info->product != null) {
                foreach ($this->level3Info->product as $product) {
                    if ($product->productCode == null) {
                        throw new IgfsMissingParException("Missing productCode[" . i . "]");
                    }
                    if ($product->productDescription == null) {
                        throw new IgfsMissingParException("Missing productDescription[" . i . "]");
                    }
                }
                $i++;
            }
        }
        if ($this->mandateInfo != null) {
            if ($this->mandateInfo->mandateID == null) {
                throw new IgfsMissingParException("Missing mandateID");
            }
        }
    }

    protected function buildRequest()
    {
        $request = parent::buildRequest();
        if ($this->shopUserRef != null) {
            $request = $this->replaceRequest($request, "{shopUserRef}", "<shopUserRef><![CDATA[" . $this->shopUserRef . "]]></shopUserRef>");
        } else {
            $request = $this->replaceRequest($request, "{shopUserRef}", "");
        }
        if ($this->shopUserName != null) {
            $request = $this->replaceRequest($request, "{shopUserName}", "<shopUserName><![CDATA[" . $this->shopUserName . "]]></shopUserName>");
        } else {
            $request = $this->replaceRequest($request, "{shopUserName}", "");
        }
        if ($this->shopUserAccount != null) {
            $request = $this->replaceRequest($request, "{shopUserAccount}", "<shopUserAccount><![CDATA[" . $this->shopUserAccount . "]]></shopUserAccount>");
        } else {
            $request = $this->replaceRequest($request, "{shopUserAccount}", "");
        }
        if ($this->shopUserMobilePhone != null) {
            $request = $this->replaceRequest($request, "{shopUserMobilePhone}", "<shopUserMobilePhone><![CDATA[" . $this->shopUserMobilePhone . "]]></shopUserMobilePhone>");
        } else {
            $request = $this->replaceRequest($request, "{shopUserMobilePhone}", "");
        }

        $request = $this->replaceRequest($request, "{trType}", $this->trType);
        if ($this->amount != null) {
            $request = $this->replaceRequest($request, "{amount}", "<amount><![CDATA[" . $this->amount . "]]></amount>");
        } else {
            $request = $this->replaceRequest($request, "{amount}", "");
        }
        if ($this->currencyCode != null) {
            $request = $this->replaceRequest($request, "{currencyCode}", "<currencyCode><![CDATA[" . $this->currencyCode . "]]></currencyCode>");
        } else {
            $request = $this->replaceRequest($request, "{currencyCode}", "");
        }

        $request = $this->replaceRequest($request, "{langID}", $this->langID);
        $request = $this->replaceRequest($request, "{notifyURL}", $this->notifyURL);
        $request = $this->replaceRequest($request, "{errorURL}", $this->errorURL);
        if ($this->callbackURL != null) {
            $request = $this->replaceRequest($request, "{callbackURL}", "<callbackURL><![CDATA[" . $this->callbackURL . "]]></callbackURL>");
        } else {
            $request = $this->replaceRequest($request, "{callbackURL}", "");
        }
        
        if ($this->addInfo1 != null) {
            $request = $this->replaceRequest($request, "{addInfo1}", "<addInfo1><![CDATA[" . $this->addInfo1 . "]]></addInfo1>");
        } else {
            $request = $this->replaceRequest($request, "{addInfo1}", "");
        }
        if ($this->addInfo2 != null) {
            $request = $this->replaceRequest($request, "{addInfo2}", "<addInfo2><![CDATA[" . $this->addInfo2 . "]]></addInfo2>");
        } else {
            $request = $this->replaceRequest($request, "{addInfo2}", "");
        }
        if ($this->addInfo3 != null) {
            $request = $this->replaceRequest($request, "{addInfo3}", "<addInfo3><![CDATA[" . $this->addInfo3 . "]]></addInfo3>");
        } else {
            $request = $this->replaceRequest($request, "{addInfo3}", "");
        }
        if ($this->addInfo4 != null) {
            $request = $this->replaceRequest($request, "{addInfo4}", "<addInfo4><![CDATA[" . $this->addInfo4 . "]]></addInfo4>");
        } else {
            $request = $this->replaceRequest($request, "{addInfo4}", "");
        }
        if ($this->addInfo5 != null) {
            $request = $this->replaceRequest($request, "{addInfo5}", "<addInfo5><![CDATA[" . $this->addInfo5 . "]]></addInfo5>");
        } else {
            $request = $this->replaceRequest($request, "{addInfo5}", "");
        }
        
        if ($this->payInstrToken != null) {
            $request = $this->replaceRequest($request, "{payInstrToken}", "<payInstrToken><![CDATA[" . $this->payInstrToken . "]]></payInstrToken>");
        } else {
            $request = $this->replaceRequest($request, "{payInstrToken}", "");
        }
        if ($this->regenPayInstrToken != null) {
            $request = $this->replaceRequest($request, "{regenPayInstrToken}", "<regenPayInstrToken><![CDATA[" . $this->regenPayInstrToken . "]]></regenPayInstrToken>");
        } else {
            $request = $this->replaceRequest($request, "{regenPayInstrToken}", "");
        }
        if ($this->keepOnRegenPayInstrToken != null) {
            $request = $this->replaceRequest($request, "{keepOnRegenPayInstrToken}", "<keepOnRegenPayInstrToken><![CDATA[" . $this->keepOnRegenPayInstrToken . "]]></keepOnRegenPayInstrToken>");
        } else {
            $request = $this->replaceRequest($request, "{keepOnRegenPayInstrToken}", "");
        }
        if ($this->payInstrTokenExpire != null) {
            $request = $this->replaceRequest($request, "{payInstrTokenExpire}", "<payInstrTokenExpire><![CDATA[" . IgfsUtils::formatXMLGregorianCalendar($this->payInstrTokenExpire) . "]]></payInstrTokenExpire>");
        } else {
            $request = $this->replaceRequest($request, "{payInstrTokenExpire}", "");
        }
        if ($this->payInstrTokenUsageLimit != null) {
            $request = $this->replaceRequest($request, "{payInstrTokenUsageLimit}", "<payInstrTokenUsageLimit><![CDATA[" . $this->payInstrTokenUsageLimit . "]]></payInstrTokenUsageLimit>");
        } else {
            $request = $this->replaceRequest($request, "{payInstrTokenUsageLimit}", "");
        }

        if ($this->accountName != null) {
            $request = $this->replaceRequest($request, "{accountName}", "<accountName><![CDATA[" . $this->accountName . "]]></accountName>");
        } else {
            $request = $this->replaceRequest($request, "{accountName}", "");
        }

        if ($this->level3Info != null) {
            $request = $this->replaceRequest($request, "{level3Info}", $this->level3Info->toXml());
        } else {
            $request = $this->replaceRequest($request, "{level3Info}", "");
        }
        if ($this->mandateInfo != null) {
            $request = $this->replaceRequest($request, "{mandateInfo}", $this->mandateInfo->toXml());
        } else {
            $request = $this->replaceRequest($request, "{mandateInfo}", "");
        }
        if ($this->description != null) {
            $request = $this->replaceRequest($request, "{description}", "<description><![CDATA[" . $this->description . "]]></description>");
        } else {
            $request = $this->replaceRequest($request, "{description}", "");
        }
        if ($this->recurrent != null) {
            $request = $this->replaceRequest($request, "{recurrent}", "<recurrent><![CDATA[" . $this->recurrent . "]]></recurrent>");
        } else {
            $request = $this->replaceRequest($request, "{recurrent}", "");
        }
        if ($this->paymentReason != null) {
            $request = $this->replaceRequest($request, "{paymentReason}", "<paymentReason><![CDATA[" . $this->paymentReason . "]]></paymentReason>");
        } else {
            $request = $this->replaceRequest($request, "{paymentReason}", "");
        }

        if ($this->topUpID != null) {
            $request = $this->replaceRequest($request, "{topUpID}", "<topUpID><![CDATA[" . $this->topUpID . "]]></topUpID>");
        } else {
            $request = $this->replaceRequest($request, "{topUpID}", "");
        }
        if ($this->firstTopUp != null) {
            $request = $this->replaceRequest($request, "{firstTopUp}", "<firstTopUp><![CDATA[" . $this->firstTopUp . "]]></firstTopUp>");
        } else {
            $request = $this->replaceRequest($request, "{firstTopUp}", "");
        }
        if ($this->payInstrTokenAsTopUpID != null) {
            $request = $this->replaceRequest($request, "{payInstrTokenAsTopUpID}", "<payInstrTokenAsTopUpID><![CDATA[" . $this->payInstrTokenAsTopUpID . "]]></payInstrTokenAsTopUpID>");
        } else {
            $request = $this->replaceRequest($request, "{payInstrTokenAsTopUpID}", "");
        }

        if ($this->validityExpire != null) {
            $request = $this->replaceRequest($request, "{validityExpire}", "<validityExpire><![CDATA[" . IgfsUtils::formatXMLGregorianCalendar($this->validityExpire) . "]]></validityExpire>");
        } else {
            $request = $this->replaceRequest($request, "{validityExpire}", "");
        }

        if ($this->minExpireMonth != null) {
            $request = $this->replaceRequest($request, "{minExpireMonth}", "<minExpireMonth><![CDATA[" . $this->minExpireMonth . "]]></minExpireMonth>");
        } else {
            $request = $this->replaceRequest($request, "{minExpireMonth}", "");
        }
        if ($this->minExpireYear != null) {
            $request = $this->replaceRequest($request, "{minExpireYear}", "<minExpireYear><![CDATA[" . $this->minExpireYear . "]]></minExpireYear>");
        } else {
            $request = $this->replaceRequest($request, "{minExpireYear}", "");
        }

        if ($this->termInfo != null) {
            $sb = "";
            foreach ($this->termInfo as $item) {
                $sb .= $item->toXml();
            }
            $request = $this->replaceRequest($request, "{termInfo}", $sb);
        } else {
            $request = $this->replaceRequest($request, "{termInfo}", "");
        }

        return $request;
    }

    protected function setRequestSignature($request)
    {
        // signature dove il buffer e' cosi composto APIVERSION|TID|SHOPID|SHOPUSERREF|SHOPUSERNAME|SHOPUSERACCOUNT|SHOPUSERMOBILEPHONE|TRTYPE|AMOUNT|CURRENCYCODE|LANGID|NOTIFYURL|ERRORURL|CALLBACKURL
        $fields = array(
                $this->getVersion(), // APIVERSION
                $this->tid, // TID
                $this->shopID, // SHOPID
                $this->shopUserRef, // SHOPUSERREF
                $this->shopUserName, // SHOPUSERNAME
                $this->shopUserAccount, // SHOPUSERACCOUNT
                $this->shopUserMobilePhone, //SHOPUSERMOBILEPHONE
                $this->trType,// TRTYPE
                $this->amount, // AMOUNT
                $this->currencyCode, // CURRENCYCODE
                $this->langID, // LANGID
                $this->notifyURL, // NOTIFYURL
                $this->errorURL, // ERRORURL
                $this->callbackURL, // CALLBACKURL
                $this->addInfo1, // UDF1
                $this->addInfo2, // UDF2
                $this->addInfo3, // UDF3
                $this->addInfo4, // UDF4
                $this->addInfo5, // UDF5
                $this->payInstrToken, // PAYINSTRTOKEN
                $this->topUpID);
        $signature = $this->getSignature($this->kSig, // KSIGN
                $fields);
        $request = $this->replaceRequest($request, "{signature}", $signature);
        return $request;
    }

    protected function parseResponseMap($response)
    {
        parent::parseResponseMap($response);
        // Opzionale
        $this->paymentID = IgfsUtils::getValue($response, "paymentID");
        // Opzionale
        $this->redirectURL = IgfsUtils::getValue($response, "redirectURL");
    }

    protected function getResponseSignature($response)
    {
        $fields = array(
                IgfsUtils::getValue($response, "tid"), // TID
                IgfsUtils::getValue($response, "shopID"), // SHOPID
                IgfsUtils::getValue($response, "rc"), // RC
                IgfsUtils::getValue($response, "errorDesc"),// ERRORDESC
                IgfsUtils::getValue($response, "paymentID"), // PAYMENTID
                IgfsUtils::getValue($response, "redirectURL"));// REDIRECTURL
        // signature dove il buffer e' cosi composto TID|SHOPID|RC|ERRORDESC|PAYMENTID|REDIRECTURL
        return $this->getSignature($this->kSig, // KSIGN
                $fields);
    }
    
    protected function getFileName()
    {
        return "IGFS_CG_API/init/IgfsCgInit.request";
    }
}
