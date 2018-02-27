<?php

namespace Railken\Unicredit\IGFS_CG_API;

class ConnectionException extends IOException
{
    public function __construct($url, $message)
    {
        parent::__construct("[" . $url . "] " . $message);
    }
}
