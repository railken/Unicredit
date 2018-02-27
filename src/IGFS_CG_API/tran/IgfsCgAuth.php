<?php

namespace Railken\Unicredit\IGFS_CG_API\tran;

use Railken\Unicredit\IGFS_CG_API\tran\BaseIgfsCgTran;
use Railken\Unicredit\IGFS_CG_API\Level3Info;

class IgfsCgAuth extends BaseIgfsCgTran
{
    public $shopUserRef;
    public $shopUserName;
    public $shopUserAccount;
    public $shopUserMobilePhone;
    public $shopUserIP;
    public $trType = "AUTH";
    public $amount;
    public $currencyCode;
    public $langID = "IT";
    public $callbackURL;
    public $pan;
    public $payInstrToken;
    public $regenPayInstrToken;
    public $keepOnRegenPayInstrToken;
    public $payInstrTokenExpire;
    public $payInstrTokenUsageLimit;
    public $cvv2;
    public $expireMonth;
    public $expireYear;
    public $accountName;
    public $enrStatus;
    public $authStatus;
    public $cavv;
    public $xid;
    public $level3Info;
    public $description;
    public $recurrent;
    public $paymentReason;
    public $topUpID;
    public $firstTopUp;
    public $payInstrTokenAsTopUpID;
    public $promoCode;
    public $payPassData;
    public $userAgent;
    public $fingerPrint;
    public $validityExpire;

    public $paymentID;
    public $authCode;
    public $brand;
    public $maskedPan;
    public $additionalFee;
    public $status;
    public $nssResult;
    public $receiptPdf;

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
        $this->shopUserIP = null;
        $this->trType = "AUTH";
        $this->amount = null;
        $this->currencyCode = null;
        $this->langID = "IT";
        $this->callbackURL = null;
        $this->pan = null;
        $this->payInstrToken = null;
        $this->regenPayInstrToken = null;
        $this->keepOnRegenPayInstrToken = null;
        $this->payInstrTokenExpire = null;
        $this->payInstrTokenUsageLimit = null;
        $this->cvv2 = null;
        $this->expireMonth = null;
        $this->expireYear = null;
        $this->accountName = null;
        $this->enrStatus = null;
        $this->authStatus = null;
        $this->cavv = null;
        $this->xid = null;
        $this->level3Info = null;
        $this->description = null;
        $this->recurrent = null;
        $this->paymentReason = null;
        $this->topUpID = null;
        $this->firstTopUp = null;
        $this->payInstrTokenAsTopUpID = null;
        $this->promoCode = null;
        $this->payPassData = null;
        $this->userAgent = null;
        $this->fingerPrint = null;
        $this->validityExpire = null;

        $this->paymentID = null;
        $this->authCode = null;
        $this->brand = null;
        $this->maskedPan = null;
        $this->additionalFee = null;
        $this->status = null;
        $this->nssResult = null;
        $this->receiptPdf = null;
    }

    protected function checkFields()
    {
        parent::checkFields();
        if ($this->trType == null) {
            throw new IgfsMissingParException("Missing trType");
        }
        if ($this->trType == "VERIFY") {
        } else {
            if ($this->amount == null) {
                throw new IgfsMissingParException("Missing amount");
            }
            if ($this->currencyCode == null) {
                throw new IgfsMissingParException("Missing currencyCode");
            }
        }
        // Disabilitato per pagopoi
        // if ($this->pan == NULL) {
        //	if ($this->payInstrToken == NULL)
        //		throw new IgfsMissingParException("Missing pan");
        // }
        if ($this->pan != null) {
            // Se è stato impostato il pan verifico...
            if ($this->pan == "") {
                throw new IgfsMissingParException("Missing pan");
            }
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
        if ($this->shopUserIP != null) {
            $request = $this->replaceRequest($request, "{shopUserIP}", "<shopUserIP><![CDATA[" . $this->shopUserIP . "]]></shopUserIP>");
        } else {
            $request = $this->replaceRequest($request, "{shopUserIP}", "");
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
        if ($this->langID != null) {
            $request = $this->replaceRequest($request, "{langID}", "<langID><![CDATA[" . $this->langID . "]]></langID>");
        } else {
            $request = $this->replaceRequest($request, "{langID}", "");
        }

        if ($this->callbackURL != null) {
            $request = $this->replaceRequest($request, "{callbackURL}", "<callbackURL><![CDATA[" . $this->callbackURL . "]]></callbackURL>");
        } else {
            $request = $this->replaceRequest($request, "{callbackURL}", "");
        }

        if ($this->pan != null) {
            $request = $this->replaceRequest($request, "{pan}", "<pan><![CDATA[" . $this->pan . "]]></pan>");
        } else {
            $request = $this->replaceRequest($request, "{pan}", "");
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

        if ($this->cvv2 != null) {
            $request = $this->replaceRequest($request, "{cvv2}", "<cvv2><![CDATA[" . $this->cvv2 . "]]></cvv2>");
        } else {
            $request = $this->replaceRequest($request, "{cvv2}", "");
        }

        if ($this->expireMonth != null) {
            $request = $this->replaceRequest($request, "{expireMonth}", "<expireMonth><![CDATA[" . $this->expireMonth . "]]></expireMonth>");
        } else {
            $request = $this->replaceRequest($request, "{expireMonth}", "");
        }
        if ($this->expireYear != null) {
            $request = $this->replaceRequest($request, "{expireYear}", "<expireYear><![CDATA[" . $this->expireYear . "]]></expireYear>");
        } else {
            $request = $this->replaceRequest($request, "{expireYear}", "");
        }

        if ($this->accountName != null) {
            $request = $this->replaceRequest($request, "{accountName}", "<accountName><![CDATA[" . $this->accountName . "]]></accountName>");
        } else {
            $request = $this->replaceRequest($request, "{accountName}", "");
        }

        if ($this->enrStatus != null) {
            $request = $this->replaceRequest($request, "{enrStatus}", "<enrStatus><![CDATA[" . $this->enrStatus . "]]></enrStatus>");
        } else {
            $request = $this->replaceRequest($request, "{enrStatus}", "");
        }
        if ($this->authStatus != null) {
            $request = $this->replaceRequest($request, "{authStatus}", "<authStatus><![CDATA[" . $this->authStatus . "]]></authStatus>");
        } else {
            $request = $this->replaceRequest($request, "{authStatus}", "");
        }
        if ($this->cavv != null) {
            $request = $this->replaceRequest($request, "{cavv}", "<cavv><![CDATA[" . $this->cavv . "]]></cavv>");
        } else {
            $request = $this->replaceRequest($request, "{cavv}", "");
        }
        if ($this->xid != null) {
            $request = $this->replaceRequest($request, "{xid}", "<xid><![CDATA[" . $this->xid . "]]></xid>");
        } else {
            $request = $this->replaceRequest($request, "{xid}", "");
        }

        if ($this->level3Info != null) {
            $request = $this->replaceRequest($request, "{level3Info}", $this->level3Info->toXml());
        } else {
            $request = $this->replaceRequest($request, "{level3Info}", "");
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

        if ($this->promoCode != null) {
            $request = $this->replaceRequest($request, "{promoCode}", "<promoCode><![CDATA[" . $this->promoCode . "]]></promoCode>");
        } else {
            $request = $this->replaceRequest($request, "{promoCode}", "");
        }

        if ($this->payPassData != null) {
            $request = $this->replaceRequest($request, "{payPassData}", "<payPassData><![CDATA[" . $this->payPassData . "]]></payPassData>");
        } else {
            $request = $this->replaceRequest($request, "{payPassData}", "");
        }
            
        if ($this->userAgent != null) {
            $request = $this->replaceRequest($request, "{userAgent}", "<userAgent><![CDATA[" . $this->userAgent . "]]></userAgent>");
        } else {
            $request = $this->replaceRequest($request, "{userAgent}", "");
        }
            
        if ($this->fingerPrint != null) {
            $request = $this->replaceRequest($request, "{fingerPrint}", "<fingerPrint><![CDATA[" . $this->fingerPrint . "]]></fingerPrint>");
        } else {
            $request = $this->replaceRequest($request, "{fingerPrint}", "");
        }

        if ($this->validityExpire != null) {
            $request = $this->replaceRequest($request, "{validityExpire}", "<validityExpire><![CDATA[" . IgfsUtils::formatXMLGregorianCalendar($this->validityExpire) . "]]></validityExpire>");
        } else {
            $request = $this->replaceRequest($request, "{validityExpire}", "");
        }

        return $request;
    }

    protected function setRequestSignature($request)
    {
        // signature dove il buffer e' cosi composto APIVERSION|TID|SHOPID|SHOPUSERREF|SHOPUSERNAME|SHOPUSERACCOUNT|SHOPUSERMOBILEPHONE|SHOPUSERIP|TRTYPE|AMOUNT|CURRENCYCODE|CALLBACKURL|PAN|PAYINSTRTOKEN|CVV2|EXPIREMONTH|EXPIREYEAR|UDF1|UDF2|UDF3|UDF4|UDF5
        $fields = array(
                $this->getVersion(), // APIVERSION
                $this->tid, // TID
                $this->shopID, // SHOPID
                $this->shopUserRef, // SHOPUSERREF
                $this->shopUserName, // SHOPUSERNAME
                $this->shopUserAccount, // SHOPUSERACCOUNT
                $this->shopUserMobilePhone, //SHOPUSERMOBILEPHONE
                $this->shopUserIP, // SHOPUSERIP
                $this->trType,// TRTYPE
                $this->amount, // AMOUNT
                $this->currencyCode, // CURRENCYCODE
                $this->callbackURL, // CALLBACKURL
                $this->pan, // PAN
                $this->payInstrToken, // PAYINSTRTOKEN
                $this->cvv2, // CVV2
                $this->expireMonth, // EXPIREMONTH
                $this->expireYear, // EXPIREYEAR
                $this->addInfo1, // UDF1
                $this->addInfo2, // UDF2
                $this->addInfo3, // UDF3
                $this->addInfo4, // UDF4
                $this->addInfo5, // UDF5
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
        $this->authCode = IgfsUtils::getValue($response, "authCode");
        // Opzionale
        $this->brand = IgfsUtils::getValue($response, "brand");
        // Opzionale
        $this->maskedPan = IgfsUtils::getValue($response, "maskedPan");
        // Opzionale
        $this->payInstrToken = IgfsUtils::getValue($response, "payInstrToken");
        // Opzionale
        $this->additionalFee = IgfsUtils::getValue($response, "additionalFee");
        // Opzionale
        $this->status = IgfsUtils::getValue($response, "status");
        // Opzionale
        $this->nssResult = IgfsUtils::getValue($response, "nssResult");
        // Opzionale
        $this->topUpID = IgfsUtils::getValue($response, "topUpID");
        // Opzionale
        try {
            $this->receiptPdf = base64_decode(IgfsUtils::getValue($response, "receiptPdf"));
        } catch (Exception $e) {
            $this->receiptPdf = null;
        }
    }

    protected function getResponseSignature($response)
    {
        $fields = array(
                IgfsUtils::getValue($response, "tid"), // TID
                IgfsUtils::getValue($response, "shopID"), // SHOPID
                IgfsUtils::getValue($response, "rc"), // RC
                IgfsUtils::getValue($response, "errorDesc"),// ERRORDESC
                IgfsUtils::getValue($response, "tranID"), // ORDERID
                IgfsUtils::getValue($response, "date"), // TRANDATE
                IgfsUtils::getValue($response, "paymentID"), // PAYMENTID
                IgfsUtils::getValue($response, "authCode"));// AUTHCODE
        // signature dove il buffer e' cosi composto TID|SHOPID|RC|ERRORCODE|ORDERID|PAYMENTID|AUTHCODE
        return $this->getSignature($this->kSig, // KSIGN
                $fields);
    }
    
    protected function getFileName()
    {
        return "IGFS_CG_API/tran/IgfsCgAuth.request";
    }
}
